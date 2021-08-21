<?php
require_once '../include/funciones.php';
require_once '../include/datos.php';

$datos = new Datos();

switch (isset($_POST)) {
    case isset($_POST['btnInsertarC']):
        $accion = 'informacion';
        $datos->setDato($_POST['nombreC']);
        $datos->setDato($_POST['direccionC']);

        BD::insertarDatos($accion, $datos);
        break;

    case isset($_POST['btnModifDireccionC']):
        $datos->setDato($_POST['nombreC']);
        $datos->setDato($_POST['nuevaDireccionC']);
        $accion = 'direccionC';

        BD::modificarDatos($accion, $datos);
        break;

    case isset($_POST['btnBorrarC']):
        $accion = 'informacion';
        $datos->setDato($_POST['borrarC']);
        
        BD::borrarDatos($accion, $datos);
        break;

    default:
        break;
}
?>

<html>
    <head>
        <meta charset="UTF-8">
        <link href="../estilos/estilos.css" rel="stylesheet" type="text/css">        
        <script src="../libreria/jquery-3.6.0.js"></script>
        <title>Tarea Online UD7</title>
    </head>
    <body>
                 <header>
            <center>
                <div class="titulo">
                    <h1>Centro de Dia</h1>
                </div>
            </center>
            <nav class="navegacion">
                <ul class="menu">
                    <li><a href="index.php">Inicio</a></li> 
                    <li><a href="Recorrido.php">Ruta</a></li>  
                    <li><a href="AdministracionCentro.php">Zona Centro</a></li> 
                    <li><a href="AdministracionUsuarios.php">Zona Usuarios</a></li>   
                </ul></nav>
        </header>
        <div class="contenido">
            <section>
                            <div id="mostrarDatos"></div> 
                                <h2>Insertar datos:</h2>               
                                <form method="POST" action="">
                                    <label for="nombreC">Nombre: </label><br> 
                                    <input type="text" id="nombreC" name="nombreC"  maxlength="40" tabindex="0" required><br> 
                                    <label for="direccionC">Dirección: </label><br> 
                                    <input type="text" id="direccionC" name="direccionC" maxlength="80" tabindex="0" required><br>
                                    <input value="Insertar" type="submit" name="btnInsertarC" >
                                </form>
                            <br>
                            <br>
                                <h2>Modificar:</h2>
                                <form method="POST" action="">                                                                                     
                                    <label for="nuevaDireccionC">Dirección: </label><br>
                                    <input type="text" id="nombreC" placeholder="Nombre del centro a modificar" name="nombreC"><br>
                                    <input type="text" id="nuevaDireccionC" name="nuevaDireccionC">
                                    <input value="Modificar" type="submit" name="btnModifDireccionC" ><br>
                                </form>
                            <br>
                            <br>
                                <h2>Borrar datos:</h2>
                                <form method="POST" action="">
                                    <input type="text" id="borrarC" placeholder="Centro a borrar" name="borrarC">
                                    <input value="Borrar" type="submit" name="btnBorrarC" >
                                </form>
            </section>
            </div>
        <footer>
            <h4>Francisco Javier Maté Barba</h4>
        </footer>
        <script src="../javascript/Centro.js"></script>        
    </body>
</html>
