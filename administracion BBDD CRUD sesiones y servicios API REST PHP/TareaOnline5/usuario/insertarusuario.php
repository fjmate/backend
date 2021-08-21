<?php
require '../include/Funciones.php';
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
                    <li><a>USUARIO</a></li>
                    <li><a href="../index.php">Inicio</a></li>
                    <li><a href="insertarusuario.php">Insertar</a></li>
                    <li><a href="modificarusuario.php">Modificar</a>
                    <li><a href="eliminarusuario.php">Eliminar</a></li>
                    <li><a href="consultasusuario.php">Consultas</a></li>
                </ul></nav>
        </header>
        <div class="contenido">
            <section>
                <center>
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                        <h3>Introduce el nombre:</h3><br>
                        <input type="text" placeholder="Nombre" name="nombre">
                        <select  name="tabla">
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
                        <input type="submit" value="Insertar" name="insertar">
                    </form>
                </center>

                <?php
                if (isset($_POST["insertar"])) {
                    $nombre = $_POST["nombre"];
                    $tabla = $_POST["tabla"];
                    if ($tabla == "consolas") {
                        Conexion::insertarTablaUsuario($nombre, $tabla);
                    } else if ($tabla == "estudios") {
                        Conexion::insertarTablaUsuario($nombre, $tabla);
                    } else if ($tabla == "juegos") {
                        ?>
                        <center>
                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                                <h3>Elige la consola:</h3><br>
                                <select  name="consola">
                                    <?php
                                    //Aquí recorremos las tablas para verlas en el select
                                    $listadotablas = array_column(mysqli_fetch_all(Conexion::ConexionBasica()->query('SELECT nomconsola FROM `consolas` WHERE 1')), 0);
                                    for ($i = 0; $i < count($listadotablas); $i++) {
                                        if ($listadotablas[$i] != 'usuarios') {
                                            echo "<option value='{$listadotablas[$i]}'>$listadotablas[$i]</option>";
                                        }
                                    }
                                    ?>
                                </select><br><br>
                                <h3>Elige el estudio:</h3><br>
                                <select  name="estudio">
                                    <?php
                                    //Aquí recorremos las tablas para verlas en el select
                                    $listadotablas = array_column(mysqli_fetch_all(Conexion::ConexionBasica()->query('SELECT nomestudio FROM `estudios` WHERE 1')), 0);
                                    for ($i = 0; $i < count($listadotablas); $i++) {
                                        if ($listadotablas[$i] != 'usuarios') {
                                            echo "<option value='{$listadotablas[$i]}'>$listadotablas[$i]</option>";
                                        }
                                    }
                                    ?>
                                </select><br><br>
                                <?php
                                echo "<input type='text' value='$nombre' placeholder='Nombre' name='nombre'>";
                                ?>
                                <input type="submit" value="Insertar" name="insertarjuego">
                            </form>
                        </center>
                        <?php
                    }
                }
                if (isset($_POST["insertarjuego"])) {
                    $consola = $_POST["consola"];
                    $estudio = $_POST["estudio"];
                    $nombre = $_POST["nombre"];

                    Conexion::insertarJuegoUsuario($consola, $estudio, $nombre);
                }
                ?>
            </section>        
        </div>
        <footer>
            <h4>Francisco Javier Maté Barba</h4>
        </footer>       
    </body>
</html>