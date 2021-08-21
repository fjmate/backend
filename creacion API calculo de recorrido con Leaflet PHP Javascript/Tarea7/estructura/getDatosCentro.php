<?php

require_once '../include/funciones.php';
require_once '../include/datos.php';

$datos = [];

//Obtenemos los datos del centro. Los utilizamos para dibujar el mapa posteriormente
$sql = "SELECT * FROM informacion";
$resultado = BD::ejecutarConsulta($sql);
$fila = $resultado->fetch_array();


while ($fila != null) {
    array_push($datos, ["nombre" => ($fila[0]), "direccion" => ($fila[2])]);

    $fila = $resultado->fetch_array();
}

header('Content-Type: application/json');

echo (json_encode($datos));
?>


