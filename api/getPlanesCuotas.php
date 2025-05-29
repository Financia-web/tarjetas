<?php
require_once '../db.php';

header('Content-Type: application/json');

$id_tarjeta = isset($_GET['id_tarjeta']) ? intval($_GET['id_tarjeta']) : 0;
//var_dump($_GET);die();

$stmt = $conexion->prepare("SELECT id, nombre FROM simulador_plan WHERE id_tarjeta = ?");
$stmt->bind_param("i", $id_tarjeta);
$stmt->execute();
$result = $stmt->get_result();

$planes_cuotas = [];
while ($row = $result->fetch_assoc()) {
    $planes_cuotas[] = $row;
}

echo json_encode($planes_cuotas);
