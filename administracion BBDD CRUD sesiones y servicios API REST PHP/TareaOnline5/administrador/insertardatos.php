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
                        <h3>Introduce el nombre:</h3>
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
                        $sql = "INSERT INTO `$tabla`(`Idcon`, `nomconsola`) VALUES (null,'$nombre')";
                        Conexion::ejecutaConsultaPlus($sql);
                        echo "<script>alert('Consola insertada correctamente');</script>";
                        header("refresh:0; url=insertardatos.php");
                    } else if ($tabla == "estudios") {
                        $sql = "INSERT INTO `$tabla`(`Idest`, `nomestudio`) VALUES (null,'$nombre')";
                        Conexion::ejecutaConsultaPlus($sql);
                        echo "<script>alert('Estudio insertado correctamente');</script>";
                        header("refresh:0; url=insertardatos.php");
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
                                        echo "<option value='{$listadotablas[$i]}'>$listadotablas[$i]</option>";
                                    }
                                    ?>
                                </select><br><br>
                                <h3>Elige el estudio:</h3><br>
                                <select  name="estudio">
                                    <?php
                                    //Aquí recorremos las tablas para verlas en el select
                                    $listadotablas = array_column(mysqli_fetch_all(Conexion::ConexionBasica()->query('SELECT nomestudio FROM `estudios` WHERE 1')), 0);
                                    for ($i = 0; $i < count($listadotablas); $i++) {
                                        echo "<option value='{$listadotablas[$i]}'>$listadotablas[$i]</option>";
                                    }
                                    ?>
                                </select>
                                <?php
                                echo "<br><br><input type='text' value='$nombre' placeholder='Nombre' name='nombre'>";
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
                    Conexion::insertarJuego($consola, $estudio, $nombre);
                }
                ?>
            </section>        
        </div>
        <footer>
            <h4>Francisco Javier Maté Barba</h4>
        </footer>       
    </body>
</html>

