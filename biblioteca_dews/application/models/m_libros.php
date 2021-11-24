<?php

class m_libros extends CI_Model
{
    public function getGeneros()
    {
        $queryString = "SELECT distinct genero FROM libros;";
        $query = $this->db->query($queryString);
        return $query->result();
    }

    public function getLibros($genero = "null")
    {
        $queryString = "SELECT idlibro, a.titulo, b.nombre as autor
						FROM libros a
						JOIN autores b on a.idautor=b.idautor";
        if ($genero != "null") $queryString .= " WHERE a.genero=\"$genero\"";

        $query = $this->db->query($queryString);

        return $query->result();
    }

    public function prestamos()
    {
        $datos = [];
        $idLibros = $this->input->post()['idlibro'];
        foreach ($idLibros as $value) {
            $queryString = "SELECT idprestamo, count(*) as cont
						FROM prestamos
						WHERE idlibro=$value";
            $query = $this->db->query($queryString)->result();
            if ($query[0]->cont < 4 && $query[0]->idprestamo) {
                $fechaHoy = date("Y-m-d");
                $insertString = "INSERT INTO prestamos (fecha, idlibro) VALUES(\"$fechaHoy\", $value)";
                $queryInsert = $this->db->query($insertString);
                $datos['prestados'][] = $value;
            } else {
                $datos['noprestados'][] = $value;
            }
        }
        return $datos;
    }
    
    public function getPrestamos()
    {
        $queryString = "SELECT DAY(fecha) as dia, MONTH(fecha) as mes, YEAR(fecha) as anio
						FROM prestamos
						WHERE MONTH(fecha) = MONTH(CURRENT_DATE())
						AND YEAR(fecha) = YEAR(CURRENT_DATE())";
		$query = $this->db->query($queryString);
        if($query->num_rows() == 0) return [];
		$dias = [];
		$query = $query->result();
		foreach($query as $value){
			$dias[$value->dia] = site_url()."/calendar/$value->anio-$value->mes-$value->dia";
		}
		return $dias;
    }

    public function getPrestamosDia($fecha)
	{
		$queryString = "SELECT DISTINCT titulo 
		FROM prestamos a
        JOIN libros b on a.idlibro = b.idlibro
		WHERE fecha=\"$fecha\"";
		$query = $this->db->query($queryString);
		return $query->result();
	}
}
