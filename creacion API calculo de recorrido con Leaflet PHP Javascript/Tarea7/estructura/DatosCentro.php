<?php

require_once '../include/funciones.php';
require_once '../include/datos.php';

$sql = "SELECT * FROM informacion";
$result = BD::ejecutarConsulta($sql);
$fila = $result->fetch_array();
$datos = [];

echo "<div id='datosCentro'>";
echo "<h3>Centro/s:</h3>";
while ($fila != null) {
    echo ("<p><strong>Nombre:</strong> " . $fila[0] . "</p>");
    echo ("<p><strong>Dirección:</strong> " . $fila[2] . "</p>");

    $fila = $result->fetch_array();
}
echo "</div>";
?>


