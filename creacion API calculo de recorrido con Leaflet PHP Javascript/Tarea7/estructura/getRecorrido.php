<?php

require_once '../include/funciones.php';
require_once '../include/datos.php';

$listado = $_POST['idChecked'];

$datos = [];

$sql = "SELECT * FROM informacion";
$result = BD::ejecutarConsulta($sql);
$fila = $result->fetch_array();


while ($fila != null) {
    array_push($datos, ["nombre" => ($fila[0]), "direccion" => ($fila[2])]);

    $fila = $result->fetch_array();
}

foreach ($listado as $usuario) {
    $sql = "SELECT idusuario, CONVERT (nombre USING utf8),"
            . "CONVERT (apellidos USING utf8), telefono, CONVERT (direccion USING utf8)"
            . " FROM usuarios WHERE idusuario='" . $usuario . "' ORDER BY nombre;";

    $result = BD::ejecutarConsulta($sql);
    $fila = $result->fetch_array();


    while ($fila != null) {
        array_push($datos, ["id" => ($fila[0]), "nombre" => ($fila[1]), "apellidos" => ($fila[2]),
            "telefono" => ($fila[3]), "direccion" => ($fila[4])]);

        $fila = $result->fetch_array();
    }
}


header('Content-Type: application/json');

echo (json_encode($datos));
?>


