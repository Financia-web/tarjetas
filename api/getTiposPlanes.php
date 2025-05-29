<?php
require_once '../db.php';

$query = "SELECT id, nombre FROM simulador_tipo_plan";
$resultado = $conexion->query($query);

$tipos = [];
while ($row = $resultado->fetch_assoc()) {
    $tipos[] = $row;
}

header('Content-Type: application/json');
echo json_encode($tipos);
