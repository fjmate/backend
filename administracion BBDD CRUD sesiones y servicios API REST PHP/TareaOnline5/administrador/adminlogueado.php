<?php
session_start();
//Creamos la cookie para contar las visitas
if (isset($_COOKIE['visitas'])) {
    setcookie('visitas', $_COOKIE['visitas'] + 1, time() + 365 * 24 * 60 * 60);
} else {
    setcookie('visitas', 1, time() + 365 * 24 * 60 * 60);
    echo "<script>alert('Bienvenido por primera vez a la zona de administrador');</script>";
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
                <p><h2>Bienvenido a la zona de administración --> <b><?php echo $_SESSION['usuario']; ?></b></h2></p>
            </section>        
        </div>
        <footer>
            <h4>Francisco Javier Maté Barba</h4>
        </footer>       
    </body>
</html>