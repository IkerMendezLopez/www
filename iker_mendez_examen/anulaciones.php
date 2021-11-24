<!DOCTYPE html>
<?php
require 'funciones.php';
mysqli_set_charset($con, "utf8");
session_start();
$fechaHoy = date("Y-m-d");
$cancelaciones=false;
if(!isset($_SESSION['cursosHoy'])){
    $_SESSION['cursosHoy']=cursosDeHoy($fechaHoy);
}else{
    if(isset($_GET['restar'])){
        $arrCursos = $_SESSION['cursosHoy'];
        foreach($arrCursos as $curso){
            if($curso->idcurso==$_GET['restar']){
                $_SESSION['cambios'][] = ['idcurso'=>$curso->idcurso, 'asistentes'=>$curso->asistentes];
                $curso->asistentes--;
            }
        }
        $cancelaciones=true;
    }
}
if(isset($_GET['guardar'])){
    if(isset($_SESSION['cambios'])){
        $arrCambios = $_SESSION['cambios'];
        foreach ($arrCambios as $cambio) {
            guardarCambio($cambio['idcurso'], $cambio['asistentes']);
        }
    }
    echo "Se han guardado las anulaciones";
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style type="text/css">
        table, td, tr{
            border: 1px solid black;
        }
        td{

            padding: 0.5em;
        }
    </style>
</head>
<body>
    <?php 
        if(count($_SESSION['cursosHoy'])==0){
            echo "<span style='color: red'><strong>Hoy no hay cursos</strong></span>";
        }else{
            echo "<h2>CURSOS de hoy (". $fechaHoy . ")</h2>";
            $arrCursos = $_SESSION['cursosHoy'];
            echo "<table>";
            foreach($arrCursos as $curso){
                $id = $curso->idcurso;
                $asistentes = $curso->asistentes;
                echo "<tr>";
                echo "<td>Curso ".$id."(".getEdificio($id).", aula ". getAula($id).", ". getTemaByCurso($id). ")</td>";
                echo "<td>".$asistentes." asistentes</td>";
                if($asistentes>0){
                    echo "<td><a href='./anulaciones.php?restar=".$id."'>Cancelar 1 asistencia</a></td>";
                }else{
                    echo "<td></td>";
                }
                echo "</tr>";
            }
            echo "</table>";
            if($cancelaciones){
                echo "<a href='./anulaciones.php?guardar=true'>Guardar cambios</a>";
            }
        }
        
        
    ?>
    
</body>
</html>