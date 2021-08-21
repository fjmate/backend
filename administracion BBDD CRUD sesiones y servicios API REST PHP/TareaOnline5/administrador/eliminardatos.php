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
                        <h3>Elimina algún dato de la tabla:</h2><br>
                            <select name="tabla">
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
                            <input type="submit" name="enviar" value="Enviar">
                            </form>
                            </center>
                            <?php
                            if (isset($_POST["enviar"])) {
                                $tabla = $_POST["tabla"];
                                ?>
                                <center>
                                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                                        <?php
                                        echo "<h3>Escoge el dato a eliminar:</h2><br>";
                                        echo "<select name='datoeliminar'>";
                                        if ($tabla == 'consolas') {
                                            //Primero eliminamos la restriccion foreign key
                                            $sql = "ALTER TABLE juegos DROP FOREIGN KEY fk_consola; ";
                                            Conexion::ejecutaConsultaPlus($sql);
                                            $sql = "SELECT nomconsola AS nombre FROM consolas";
                                            $query = mysqli_query(Conexion::ConexionBasica(), $sql);
                                            while ($result = mysqli_fetch_array($query)) {
                                                $sql = "SELECT Idcon FROM consolas WHERE nomconsola = '{$result['nombre']}'";
                                                $res = mysqli_query(Conexion::ConexionBasica(), $sql);
                                                if (!$res) {
                                                    echo "<script>alert('La consulta está mal hecha');</script>";
                                                } else {
                                                    if (mysqli_num_rows($res) <= 0) {
                                                        echo "<script>alert('No existe informacion con esta variable');</script>";
                                                    } else {
                                                        $row = mysqli_fetch_array($res);
                                                        $in_div = (int) $row['Idcon'];
                                                    }
                                                }
                                                echo "<option value='" . $in_div . "'>" . $result['nombre'] . "</option>";
                                            }
                                        } else if ($tabla == 'estudios') {
                                            //Primero eliminamos la restriccion foreign key
                                            $sql = "ALTER TABLE juegos DROP FOREIGN KEY fk_estudio; ";
                                            Conexion::ejecutaConsultaPlus($sql);
                                            $sql = "SELECT nomestudio AS nombre FROM estudios";
                                            $query = mysqli_query(Conexion::ConexionBasica(), $sql);
                                            while ($result = mysqli_fetch_array($query)) {
                                                $sql = "SELECT Idest FROM estudios WHERE nomestudio = '{$result['nombre']}'";
                                                $res = mysqli_query(Conexion::ConexionBasica(), $sql);
                                                if (!$res) {
                                                    echo "<script>alert('La consulta está mal hecha');</script>";
                                                } else {
                                                    if (mysqli_num_rows($res) <= 0) {
                                                        echo "<script>alert('No existe informacion con esta variable');</script>";
                                                    } else {
                                                        $row = mysqli_fetch_array($res);
                                                        $in_div = (int) $row['Idest'];
                                                    }
                                                }
                                                echo "<option value='" . $in_div . "'>" . $result['nombre'] . "</option>";
                                            }
                                        } else if ($tabla == 'juegos') {
                                            $sql = "SELECT nomjuego AS nombre FROM juegos";
                                            $query = mysqli_query(Conexion::ConexionBasica(), $sql);
                                            while ($result = mysqli_fetch_array($query)) {
                                                $sql = "SELECT Idjuego FROM juegos WHERE nomjuego = '{$result['nombre']}'";
                                                $res = mysqli_query(Conexion::ConexionBasica(), $sql);
                                                if (!$res) {
                                                    echo "<script>alert('La consulta está mal hecha');</script>";
                                                } else {
                                                    if (mysqli_num_rows($res) <= 0) {
                                                        echo "<script>alert('No existe informacion con esta variable');</script>";
                                                    } else {
                                                        $row = mysqli_fetch_array($res);
                                                        $in_div = (int) $row['Idjuego'];
                                                    }
                                                }
                                                echo "<option value='" . $in_div . "'>" . $result['nombre'] . "</option>";
                                            }
                                        }
                                        $tablaasig = $tabla;
                                        echo "</select>";
                                        echo "<input name='tablaasig' type='hidden' value='{$tabla}'>";
                                        echo "<input type='submit' name='eliminar' value='Eliminar'>";
                                        echo "</form>";
                                        echo "</center>";
                                    }
                                    if (isset($_POST["eliminar"])) {
                                        $datoeliminar = $_POST["datoeliminar"];
                                        $tablaasig = $_POST["tablaasig"];
                                        Conexion::eliminarJuego($datoeliminar, $tablaasig);
                                    }
                                    ?>
                                    </section>        
                                    </div>
                                    <footer>
                                        <h4>Francisco Javier Maté Barba</h4>
                                    </footer>       
                                    </body>
                                    </html>

