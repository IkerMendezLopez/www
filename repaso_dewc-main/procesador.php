<?php 

include 'db.php';
$tipo = $_GET['tipo'];

$arr = array();
if ($result = $conexion->query("select * from procesador where id_opcion1 = $tipo ")) {
    while($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $arr[] = $row;
    }
    echo json_encode($arr);
}

$result->close();
$conexion->close();

