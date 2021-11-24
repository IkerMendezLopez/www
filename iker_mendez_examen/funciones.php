<?php
    include 'config.php';
    
    $con = mysqli_connect(HOST, USER, PASS, BD);


    function getCategorias(){
        global $con;
        $categorias = array();
        
        $sql = "select distinct categoria from temas";
        $rs = mysqli_query($con, $sql);
        
        while($tupla = mysqli_fetch_object($rs)){
            $categorias [] = $tupla;
        }
        
        return $categorias;
    }
    
    
    function getTemas($catSeleccionada=""){
        global $con;
        $temas = array();
        
        if($catSeleccionada==""){
            $sql = "select * from temas";
        }else{
            $sql = "select * from temas where categoria='$catSeleccionada'";
        }
        
        $rs = mysqli_query($con, $sql);
        
        while($tupla = mysqli_fetch_object($rs)){
            $temas [] = $tupla;
        }
        
        return $temas;
    }

    function getCursosByTema($idTema){
        global $con;          
        $sql = "select idcurso, precio from cursos where IDTEMA ='$idTema'";
        $rs = mysqli_query($con, $sql);
        
        while($tupla = mysqli_fetch_object($rs)){ 
            $preciosCursos [] = $tupla;
        }
        
        return $preciosCursos;
    }
    
    function countCursosByTema($idTema){
        global $con;
        $sql = "select count(*) as cantCursos from cursos where IDTEMA='$idTema'";
        $rs = mysqli_query($con, $sql);
        
        if($tupla = mysqli_fetch_object($rs)){ 
            return $tupla->cantCursos;
        }
    }
    
    function changePrecio($idCurso, $precio){
        global $con;
        $sql = "update cursos set precio=$precio where IDCURSO=$idCurso";
        mysqli_query($con, $sql);
    }
    
    function cursosDeHoy($fecha){
        global $con; 
        $cursos = [];
        $sql = "select idcurso, asistentes from cursos where DIA='$fecha'";;
        $rs = mysqli_query($con, $sql);
        while($tupla = mysqli_fetch_object($rs)){ 
            $cursos [] = $tupla;
        }
        return $cursos;        
    }

    function getEdificio($idcurso){
        global $con;  
        $sql = "select nombre from edificios, cursos where edificios.idedificio=cursos.idedificio and idcurso=".$idcurso;
        $rs = mysqli_query($con, $sql);
        while($tupla = mysqli_fetch_object($rs)){ 
            return $tupla->nombre;
        }
    }
    function getAula($idcurso){
        global $con;  
        $sql = "select num_aula from cursos where idcurso=". $idcurso;
        $rs = mysqli_query($con, $sql);
        while($tupla = mysqli_fetch_object($rs)){ 
            return $tupla->num_aula;
        }
    }
    function getTemaByCurso($idcurso){
        global $con;
        $sql = "select tema from temas, cursos where temas.idtema=cursos.idtema and idcurso=".$idcurso;
        $rs = mysqli_query($con, $sql);
        while($tupla = mysqli_fetch_object($rs)){ 
            return $tupla->tema;
        }
    }

    function guardarCambio($id, $asistentes){
        global $con;
        $sql = "update cursos set asistentes=".$asistentes." where idcurso=". $id;
        mysqli_query($con, $sql);
    }

