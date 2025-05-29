<?php
require_once '../db.php';

header('Content-Type: application/json');

$id_cuota = isset($_GET['id_cuota']) ? intval($_GET['id_cuota']) : 0;



$stmt = $conexion->prepare("SELECT id, nombre FROM simulador_interes WHERE id = ?");
$stmt->bind_param("i", $id_cuota);
$stmt->execute();
$res = $stmt->get_result();


$detalle = $res->fetch_assoc();

echo json_encode($detalle);
