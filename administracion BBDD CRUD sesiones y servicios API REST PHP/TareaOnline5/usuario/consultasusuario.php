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
                        <h3>Elige la consola para ver sus juegos</h3><br>
                        <?php
                        echo "<select name='dato'>";
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
                        echo "<input type='submit' value='Enviar' name='enviarconsulta1'>"
                        ?>
                    </form>
                </center>
                <center>
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                        <h3>Elige un estudio para ver sus juegos</h3><br>
                        <?php
                        echo "<select name='dato'>";
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
                        echo "<input type='submit' value='Enviar' name='enviarconsulta2'>"
                        ?>
                    </form>
                </center>
                <?php
                if (isset($_POST["enviarconsulta1"])) {
                    $id = $_POST["dato"];
                    $sql = "SELECT * FROM `juegos` WHERE Idconsola = $id";
                    $resultado = Conexion::ConexionBasica()->query($sql);
                    echo "<h2>Juegos</h2>";
                    echo "<hr>";
                    $contador = 1;
                    while ($fila = $resultado->fetch_assoc()) {
                        echo "<h3>" . $contador . "   " . $fila['nomjuego'] . "</h3><br>";
                        $contador++;
                    }
                    if ($contador == 1) {
                        echo "<h3>No hay juegos de esta consola</h3>";
                    }
                }
                if (isset($_POST["enviarconsulta2"])) {
                    $id = $_POST["dato"];
                    $sql = "SELECT * FROM `juegos` WHERE Idestudio = $id";
                    $resultado = Conexion::ConexionBasica()->query($sql);
                    echo "<h2>Juegos</h2>";
                    echo "<hr>";
                    $contador = 1;
                    while ($fila = $resultado->fetch_assoc()) {
                        echo "<h3>" . $contador . "   " . $fila['nomjuego'] . "</h3><br>";
                        $contador++;
                    }
                    if ($contador == 1) {
                        echo "<h3>No hay juegos de este estudio</h3>";
                    }
                }
                ?>
            </section>        
        </div>
        <footer>
            <h4>Francisco Javier Maté Barba</h4>
        </footer>       
    </body>
</html>

