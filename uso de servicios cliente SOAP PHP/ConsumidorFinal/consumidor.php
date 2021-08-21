<?php
require '../AccesoAProductos/DBAccess.php';
require '../AccesoAProductos/ListaProductos.php';

$url = "http://localhost/ServidorFinal/servidor.php";

$uri = "http://localhost/ServidorFinal";

$cliente = new SoapClient(null, array('location' => $url, 'uri' => $uri));
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <title>Tarea Presencial </title>
    </head>
    <body>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <?php
            echo "<h3>Escribe el nombre del producto</h3><br>";
            echo "<input type='text' name='nombre'>";
            echo "<input type='submit' name='enviar' value='Enviar'>";
            echo "</form>";
            if (isset($_POST['enviar'])) {
                $nombre = $_POST['nombre'];
                $precio = $cliente->obtenPrecio($nombre);
                if ($precio == 0) {
                    print("El producto no existe");
                } else {
                    print("Precio: " . $precio);
                }
                echo "</form>";
            }
            ?>   
    </body>
</html>