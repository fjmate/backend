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
                        <h3>Modifica algún dato de la siguiente tabla:</h2><br>
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
                            <input type="submit" name="enviar" value="Enviar">
                            </form>
                            </center>
                            <?php
                            if (isset($_POST["enviar"])) {
                                $tabla = $_POST["tabla"];
                                //Ahora creamos un formulario para recoger el nombre del registro a modificar
                                ?>
                                <center>
                                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                                        <?php
                                        echo "<h3>Escoge el dato a modificar:</h3><br>";
                                        echo "<select name='datomodificar'>";
                                        if ($tabla == 'consolas') {
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
                                        echo "<br><br><h4>Escribe el nombre que quieres darle:</h4><br>";
                                        echo "<input type='text' placeholder='Nombre' name='nuevonombre'>";
                                        echo "<input name='tablaasig' type='hidden' value='{$tabla}'>";
                                        echo "<input type='submit' name='modificar' value='Modificar'>";
                                        echo "</form>";
                                        echo "</center>";
                                    }
                                    if (isset($_POST["modificar"])) {
                                        $datomodificar = $_POST["datomodificar"];
                                        $nuevonombre = $_POST["nuevonombre"];
                                        $tablaasig = $_POST["tablaasig"];
                                        Conexion::modificarDatoUsuario($datomodificar, $nuevonombre, $tablaasig);
                                    }
                                    ?>
                                    </section>        
                                    </div>
                                    <footer>
                                        <h4>Francisco Javier Maté Barba</h4>
                                    </footer>       
                                    </body>
                                    </html>

