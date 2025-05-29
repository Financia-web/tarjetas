<?php
require_once '../db.php';

ini_set('display_errors', 1);
error_reporting(E_ALL);

$id_tipo = isset($_GET['id_tipo_plan']) ? intval($_GET['id_tipo_plan']) : 0;
//var_dump($_GET);die();
$stmt = $conexion->prepare("SELECT id, nombre FROM simulador_tarjetas WHERE id_tipo_plan = ?");
$stmt->bind_param("i", $id_tipo);
$stmt->execute();
$resultado = $stmt->get_result();
//console.log("Tarjetas:", $resultado);


$tarjetas = [];
while ($fila = $resultado->fetch_assoc()) {
    $tarjetas[] = $fila;
}

header('Content-Type: application/json');
echo json_encode($tarjetas);
