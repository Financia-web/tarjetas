<?php
require_once '../db.php';

$id_plan = isset($_GET['id_plan_cuotas']) ? intval($_GET['id_plan_cuotas']) : 0;


$sql = "SELECT id, nombre FROM simulador_cuotas WHERE id_plan = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $id_plan);
$stmt->execute();
$res = $stmt->get_result();

$cuotas = [];
while ($row = $res->fetch_assoc()) {
    $cuotas[] = $row;
}

header('Content-Type: application/json');
echo json_encode($cuotas);

