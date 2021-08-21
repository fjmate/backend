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
                        <h3>Introduce el nombre y la contraseña del nuevo administrador:</h3>
                        <input type="text" name="nombre" placeholder="Nombre">
                        <input type="password" name="password" placeholder="Contraseña">
                        <input type="submit" value="Insertar" name="insertar">
                    </form>
                </center>
                <?php
                if (isset($_POST["insertar"])) {
                    $nombre = $_POST['nombre'];
                    $password = $_POST['password'];
                    Conexion::insertarUsuario($nombre, $password);
                }
                ?>
            </section>        
        </div>
        <footer>
            <h4>Francisco Javier Maté Barba</h4>
        </footer>       
    </body>
</html>