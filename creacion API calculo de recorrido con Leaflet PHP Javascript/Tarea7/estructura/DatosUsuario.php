<?php

require_once '../include/funciones.php';
require_once '../include/datos.php';

$idUsuario = $_POST['idUsuario'];

$sql = "SELECT direccion, telefono FROM usuarios WHERE idUsuario='" . $idUsuario . "';";
$result = BD::ejecutarConsulta($sql);
$fila = $result->fetch_array();
$datos = [];

// Los preparamos para mostrarlos en la página
echo "<p><h3>Usuarios:</h3></p>";
while ($fila != null) {
    echo ("<p><strong>Dirección:</strong> " . $fila[0] . "</p>");
    echo ("<p><strong>Teléfono:</strong> " . $fila[1] . "</p><br>");

    $fila = $result->fetch_array();
}
?>


