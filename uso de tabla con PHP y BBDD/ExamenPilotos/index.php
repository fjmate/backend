<?php

//Metemos el método conexion
require 'conexion.php';
//Si pulsamos eliminar mostramos la tabla del piloto eliminado
if (isset($_POST["eliminar"])) {
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellidos"];
    $imagen = $_POST["codigo"];
    $sql = "DELETE FROM `pilotos` WHERE `pilotos`.`nombre` = '$nombre'";
    if (!mysqli_query($conexion, $sql)) {
        echo "Error: " . $sql . "<br>" . mysqli_error($conexion);
    }
    if (mysqli_query($conexion, $sql)) {
        echo "<h2>Borrado de piloto</h2>"
        ?>
        <div>
            <table border="1">
                <tr>
                    <td><?php echo "<img src='imagenes/{$imagen}.jpg' width='130' height='50'>" ?></td>
                </tr>
                <tr>
                    <td name="nombre"><?php echo $nombre . " " . $apellido ?></td>
                </tr>
            </table>
        </div>
        <br>
        <?php
        echo "<h4>Se ha borrado 1 registro.</h4>";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conexion);
    }
    mysqli_close($conexion);
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Examen DWES</title>
        <link rel="stylesheet" href="main.css">
    </head>
    <body>
        <?php require 'conexion.php'; ?>
        <h2>Listado de Pilotos</h2>
        <!-- Metemos cada dato del piloto en una fila para poder acceder a el-->
        <?php foreach ($conexion->query('SELECT * from pilotos') as $fila) { ?> 
            <div>
                <form action="index.php" method="POST">
                    <table border="1">
                        <tr>
                            <td><?php echo "<img src='imagenes/{$fila['CodPiloto']}.jpg'>" ?></td>
                        </tr>
                        <tr>
                            <td name="nombre"><?php echo $fila['nombre'] . " " . $fila['apellidos'] ?></td>
                        </tr>
                        <tr>
                            <td><input type="submit" value="Eliminar" name="eliminar"></td>
                        </tr>
                    </table>
                    <br>
                    <!-- Mandamos los valores como ocultos para poder trabajar con ellos -->
                    <input type="hidden" name="nombre" value="<?php echo $fila['nombre']; ?>">
                    <input type="hidden" name="apellidos" value="<?php echo $fila['apellidos']; ?>">
                    <input type="hidden" name="codigo" value="<?php echo $fila['CodPiloto']; ?>">
                </form>
            </div>
            <?php
        }
        ?>
    </body>
</html>
