<?php
session_start();
require '../include/Funciones.php';
if (isset($_COOKIE['visitas'])) {
    setcookie('visitas', $_COOKIE['visitas'] + 1, time() + 365 * 24 * 60 * 60);
}
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <title>Tarea Online 5</title>
        <link rel="stylesheet" href="../estilos.css">
    </head>
    <body>
        <header>
            <center>
                <div class="titulo">
                    <h1>Colección de Videojuegos</h1>
                </div>
            </center>
            <nav class="navegacion">
                <ul class="menu">
                    <li><a href="adminlogueado.php">Admin.:<?php echo " " . $_SESSION['usuario']; ?></a></li>
                    <li><a href="../logoff.php">Salir</a></li>
                    <li><a href="crear.php">Crear</a></li>
                    <li><a href="administrador.php">Eliminar</a>
                        <ul class="submenu">
                            <li><a href="eliminar.php">Eliminar tabla</a></li>
                            <li><a href="eliminardatos.php">Eliminar datos</a></li>
                        </ul>
                    <li><a href="insertardatos.php">Insertar datos</a></li>
                    <li><a href="insertarusuarios.php">Insertar usuarios</a></li>
                </ul></nav>
        </header>
        <div class="contenido">
            <section>
                <center>
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                        <h3>Elimina una tabla:</h2><br>
                            <select  name="tablaeliminar">
                                <?php
                                //Aquí recorremos las tablas para verlas en el select
                                $listadotablas = array_column(mysqli_fetch_all(Conexion::ConexionBasica()->query('SHOW FULL TABLES FROM VIDEOJUEGOS')), 0);
                                for ($i = 0; $i < count($listadotablas); $i++) {
                                    if ($listadotablas[$i] != 'usuarios') {
                                        echo "<option value='{$listadotablas[$i]}'>$listadotablas[$i]</option>";
                                    }
                                }
                                ?>
                            </select>
                            <input type="submit" name="enviar" value="Eliminar">
                            </form>
                            </center>
                            <?php
                            if (isset($_POST["enviar"])) {
                                $tablaeliminar = $_POST["tablaeliminar"];
                                Conexion::eliminaTabla($tablaeliminar);
                            }
                            ?>
                            </section>        
                            </div>
                            <footer>
                                <h4>Francisco Javier Maté Barba</h4>
                            </footer>       
                            </body>
                            </html>