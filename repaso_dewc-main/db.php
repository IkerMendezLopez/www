<?php
$hostname = "localhost";
$database = "db_exa";
$username = "root";
$password = "";

$conexion = new mysqli($hostname, $username, $password, $database);
if (!$conexion){
    die("No se puede conectar a mysql");
}