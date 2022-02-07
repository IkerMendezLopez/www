<?php
$datos =json_encode($_POST);
echo $datos;
file_put_contents("../persona.json", $datos);
// $fp = fopen('../persona.json', 'w');
// fwrite($fp, json_encode($datos));
// fclose($fp);
?>