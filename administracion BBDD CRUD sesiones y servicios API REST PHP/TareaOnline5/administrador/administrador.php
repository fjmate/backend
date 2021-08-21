<?php
require '../include/Funciones.php';

// Comprobamos si ya se ha enviado el formulario
if (isset($_POST['enviar'])) {
    if (empty($_POST['usuario']) || empty($_POST['password']))
        $error = 'Debes introducir un nombre de usuario y una contraseña';
    else {
        // Comprobamos las credenciales con la base de datos
        if (Conexion::verificaCliente($_POST['usuario'], $_POST['password'])) {
            session_start();
            $_SESSION['usuario'] = $_POST['usuario'];
            header("Location: adminlogueado.php");
        } else {
            // Si las credenciales no son válidas, se vuelven a pedir
            $error = 'Usuario o contraseña no válidos!';
        }
    }
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
                    <li><a>ADMINISTRADOR</a></li>
                    <li><a href="../index.php">Inicio</a></li>
                </ul></nav>
        </header>
        <div class="contenido">
            <section>
                <p>  
                <center>
                    <form action='<?php echo $_SERVER['PHP_SELF']; ?>' method="POST">
                        <h3>Login:</h3>
                        <input type="text" name="usuario" placeholder="Usuario">
                        <input type="password" name="password" placeholder="Password">
                        <input type="submit" name="enviar" value="Enviar">
                    </form>
                </center></p>
            </section>        
        </div>
        <footer>
            <h4>Francisco Javier Maté Barba</h4>
        </footer>       
    </body>
</html>