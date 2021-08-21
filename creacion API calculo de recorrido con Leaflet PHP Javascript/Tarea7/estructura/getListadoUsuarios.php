<?php

require_once '../include/funciones.php';
require_once '../include/datos.php';

$sql = "SELECT idusuario, CONVERT (nombre USING utf8),"
        . "CONVERT (apellidos USING utf8), telefono, CONVERT (direccion USING utf8)"
        . " FROM usuarios ORDER BY nombre";

$result = BD::ejecutarConsulta($sql);
$fila = $result->fetch_array();
$datos = [];

while ($fila != null) {
    array_push($datos, ["id" => ($fila[0]), "nombre" => ($fila[1]), "apellidos" => ($fila[2]),
        "telefono" => ($fila[3]), "direccion" => ($fila[4])]);

    $fila = $result->fetch_array();
}

header('Content-Type: application/json');
?>


