<?php
$host = "localhost";   
$usuario = "root"; 
$clave = "";     
$base = "tarjetas";

$conexion = new mysqli($host, $usuario, $clave, $base);

//var_dump($conexion);die();

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}
?>
