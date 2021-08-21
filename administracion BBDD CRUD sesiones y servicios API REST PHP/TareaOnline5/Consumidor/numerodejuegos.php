<?php
require '../include/Funciones.php';

$url = "http://localhost/Servicios/servicio.php";

$uri = "http://localhost/Servicios";

$cliente = new SoapClient(null, array('location' => $url, 'uri' => $uri));
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
                    <li><a href="../index.php">Inicio</a></li>
                    <li><a>Servicios Web</a>
                        <ul class="submenu">
                            <li><a href="../Consumidor/consumidor.php">Nº Juegos</a></li>
                            <li><a href="../Consumidor/juegosporletra.php">Juegos por letra</a></li>
                        </ul>
                </ul></nav>
        </header>
        <div class="contenido">
            <section>
                <p><h2>Aquí sabrá el número de juegos dependiendo de la consola:</h2></p>
            </section>        
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                <?php
                echo "<h3>Escoge la consola:</h2><br>";
                echo "<select name='dato'>";
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
                echo "</select>";
                echo "<input type='submit' name='enviar' value='Obtén colección'>";
                echo "</form>";
                echo "</center>";

                if (isset($_POST['enviar'])) {
                    $idcon = $_POST['dato'];
                    $consola = $cliente->consolaJuegos($idcon);
                    $numero = $cliente->numeroJuegos($idcon);
                    print("<h3>Hay " . $numero['total'] . " juego/s de la consola " . $consola['nomconsola'] . "</h3>");
                }
                ?>
        </div>
        <footer>
            <h4>Francisco Javier Maté Barba</h4>
        </footer>       
    </body>
</html>