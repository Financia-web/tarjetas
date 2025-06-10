<?php
require_once '../db.php';

header('Content-Type: application/json');

$id_cuota = isset($_GET['id_cuota']) ? intval($_GET['id_cuota']) : 0;



$stmt = $conexion->prepare("SELECT simulador_cuotas.nombre as id, simulador_interes.nombre FROM simulador_interes 
INNER JOIN simulador_cuotas ON (simulador_interes.id_cuotas = simulador_cuotas.id)
WHERE simulador_interes.id = ?");
$stmt->bind_param("i", $id_cuota);
$stmt->execute();
$res = $stmt->get_result();


$detalle = $res->fetch_assoc();

echo json_encode($detalle);
