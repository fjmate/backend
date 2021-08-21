<?php

// Recuperamos la información de la sesión
session_start();

// Y la eliminamos
session_unset();
header("Refresh:0; url=index.php");

?>
