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
                            <li><a href="../Consumidor/numerosdejuegos.php">Nº Juegos</a></li>
                            <li><a href="../Consumidor/juegosporletra.php">Juegos por letra</a></li>
                        </ul>
                </ul></nav>
        </header>
        <div class="contenido">
            <section>
                <p><h2>Aquí sabrá los juegos que empiezan por la letra elegida:</h2></p>
            </section>        
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                <?php
                echo "<h3>Escribe la letra/numero</h2><br>";
                echo "<input type='text' name='letra'>";
                echo "<input type='submit' name='enviar' value='Enviar'>";
                echo "</form>";
                if (isset($_POST['enviar'])) {
                    $letra = $_POST['letra'];
                    $juegos = $cliente->juegosporLetra($letra);
                    $longitud = count($juegos);
                    $contadorjuegos = 1;
                    //Recorro todos los elementos
                    echo " <form><center><h1>Juegos ({$letra})</h1>";
                    if ($longitud != 0) {
                        for ($i = 0; $i < $longitud; $i++) {
                            print("<h3>Nº{$contadorjuegos}->  " . $juegos[$i]['nomjuego'] . "</h3>");
                            $contadorjuegos++;
                        }
                    } else {
                        echo "<h3>No hay juegos que empiecen por esa letra/numero.</h3>";
                    }
                    echo "</center></form>";
                }
                ?>
        </div>
        <footer>
            <h4>Francisco Javier Maté Barba</h4>
        </footer>       
    </body>
</html>