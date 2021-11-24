<?php

class LibroModel extends CI_Model
{


	public function getGeneros()
	{
		$queryString = "SELECT distinct genero FROM libros;";
		$query = $this->db->query($queryString);
		return $query->result();
	}

	public function getLibros($genero = "")
	{
		$queryString = "SELECT idlibro, a.titulo, b.nombre as autor
						FROM libros a
						JOIN autores b on a.idautor=b.idautor";
		if ($genero != "") $queryString .= " WHERE a.genero=\"$genero\"";

		$query = $this->db->query($queryString);

		return $query->result();
	}


	public function prestarLibro($idlibro)
	{
		$queryString = "SELECT idprestamo, count(*) as cont
						FROM prestamos
						WHERE idlibro=$idlibro";
		$query = $this->db->query($queryString)->result();
		if ($query[0]->cont < 4 && $query[0]->idprestamo) {
			$fechaHoy = date("Y-m-d");
			$insertString = "INSERT INTO prestamos (fecha, idlibro) VALUES(\"$fechaHoy\", $idlibro)";
			$queryInsert = $this->db->query($insertString);
			return $queryInsert ? $query[0]->idprestamo : false;
		} else return false;
	}

	public function getPrestamos($mes="", $year="")
	{
		$queryString = "SELECT DAY(fecha) as dia, MONTH(fecha) as mes, YEAR(fecha) as ano
						FROM prestamos
						WHERE MONTH(fecha) = MONTH(CURRENT_DATE())
						AND YEAR(fecha) = YEAR(CURRENT_DATE())";
		$query = $this->db->query($queryString);
		
		if($query->num_rows() == 0) return [];
		$arrayDias = [];
		$query = $query->result();
		foreach($query as $value){
			$arrayDias[$value->dia] = base_url()."calendario/$value->ano/$value->mes/$value->dia";
		}

		return $arrayDias;
		
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
