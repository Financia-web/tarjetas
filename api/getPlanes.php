<?php
require_once '../db.php';

$id_tarjeta = isset($_GET['id_tarjeta']) ? intval($_GET['id_tarjeta']) : 0;
//var_dump($_GET);die();
$stmt = $conexion->prepare("SELECT id, nombre FROM simulador_plan WHERE id_tarjeta = ?");
$stmt->bind_param("i", $id_tarjeta);
$stmt->execute();
$resultado = $stmt->get_result();

$planes = [];
while ($fila = $resultado->fetch_assoc()) {
    $planes[] = $fila;
}

header('Content-Type: application/json');
echo json_encode($planes);
