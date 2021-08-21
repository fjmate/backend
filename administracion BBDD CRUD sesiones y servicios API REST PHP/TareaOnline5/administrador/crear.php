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
            <div class="admin"></div>
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
                    <li><a>Eliminar</a>
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
                        <h3>Crea datos iniciales:</h3>
                        <h5>(Al hacerlo borrarás todo)</h5>
                        <input type="submit" name="crearminimo" value="Crear">
                    </form>
                </center>
                <?php
                if (isset($_POST["crearminimo"])) {
                    Conexion::creaTablas();
                    echo "<script>alert('Datos mínimos creados correctamente');</script>";
                }
                ?>
            </section>        
        </div>
        <footer>
            <h4>Francisco Javier Maté Barba</h4>
        </footer>       
    </body>
</html>