<?php

require_once '../include/funciones.php';
require_once '../include/datos.php';

$sql = "SELECT idusuario, nombre, apellidos, direccion FROM usuarios ORDER BY nombre";
$resultado = BD::ejecutarConsulta($sql);
$fila = $resultado->fetch_array();
$datos = [];

echo "<fieldset id='listaUsuarios'><br>";
echo "<form class='formespecial' id='usuariosElegidos' method='POST' action='ruta.php'>";
echo "<h3>Usuarios:</h3><br>";
while ($fila != null) {
    echo "<input type='checkbox' name='list[]' value='" . $fila[0] . "'/><h4>". $fila[1]." ".$fila[2]. " --> ".$fila[3]."</h4>";
    echo "<br>";

    $fila = $resultado->fetch_array();
}

echo "<br>";
echo "<button id='btnRecorrido' type='button' >Calcular recorrido</button>";
echo "</form>";
echo "</fieldset>";
?>


