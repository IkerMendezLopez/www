<?php 

include 'db.php';


$tipo = $_GET['tipo'];
$procesador = $_GET['procesador'];

$arr = array();
if ($result = $conexion->query("select * from disco_duro where id_opcion1 = $tipo and id_opcion2 = $procesador ")) {
    while($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $arr[] = $row;
    }
    echo json_encode($arr);
}

$result->close();
$conexion->close();

