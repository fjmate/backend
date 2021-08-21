<?php
require_once('include/conexion.php');

// Comprobamos si ya se ha enviado el formulario
    if (isset($_POST['enviar'])) {
        $usuario = $_POST['usuario'];
        $password = $_POST['password'];
       
        if (empty($usuario) || empty($password)) 
            $error = "Debes introducir un nombre de usuario y una contraseña";
        else {
            // Comprobamos las credenciales con la base de datos
            // Conectamos a la base de datos
            try {
                $opc = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");
                $dsn = "mysql:host=localhost;dbname=javiburguermb";
                $dwes = new PDO($dsn, "dwes", "dwes", $opc);
            }
            catch (PDOException $e) {
                die("Error: " . $e->getMessage());
            }

             // Ejecutamos la consulta para comprobar las credenciales
            $sql = "SELECT usuario FROM usuarios " .
            "WHERE usuario='$usuario' " .
            "AND contrasena='" . md5($password) . "'";
            
            if($resultado = $dwes->query($sql)) {
                $fila = $resultado->fetch();
                if ($fila != null) {
                    session_start();
                    $_SESSION['usuario']=$usuario;
                    header("Location: pedido.php");                    
                }
                else {
                    // Si las credenciales no son válidas, se vuelven a pedir
                    $error = "Usuario o contraseña no válidos!";
                }
                unset($resultado);
            }
            unset($dwes);            
        }
   }
?>

<!DOCTYPE html>
<!-- Desarrollo Web en Entorno Servidor -->
<!-- Tema 5 : Programación orientada a objetos en PHP -->
<!-- Ejemplo Tienda Web: login.php -->
<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <title>Hamburguesería</title>
</head>

<body>
    <div id='login'>
    <form action='<?php echo $_SERVER['PHP_SELF'];?>' method='post'>
    <fieldset >
        <legend>Login</legend>
        <div><span class='error'><?php if (isset($error)) echo $error; ?></span></div>
        <div class='campo'>
            <label for='usuario' >Usuario:</label><br/>
            <input type='text' name='usuario' value='dwes' id='usuario' maxlength="50" /><br/>
        </div>
        <div class='campo'>
            <label for='password' >Contraseña:</label><br/>
            <input type='password' name='password' value='dwes' id='password' maxlength="50" /><br/>
        </div>

        <div class='campo'>
            <input type='submit' name='enviar' value='Enviar' />
        </div>
    </fieldset>
    </form>
    </div>
</body>
</html>

