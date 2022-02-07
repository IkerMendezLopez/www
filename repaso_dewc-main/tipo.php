<?php 

include 'db.php';


$arr = array();
if ($result = $conexion->query("select * from tipo ")) {
    while($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $arr[] = $row;
    }
    echo json_encode($arr);
}

$result->close();
$conexion->close();

