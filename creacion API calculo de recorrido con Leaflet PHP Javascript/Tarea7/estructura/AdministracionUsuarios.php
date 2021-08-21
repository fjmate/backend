<?php
require_once '../include/funciones.php';
require_once '../include/datos.php';

$datos = new Datos();

switch (isset($_POST)) {
    case isset($_POST['btnInsertarU']):
        $datos->setDato($_POST['nombre']);
        $datos->setDato($_POST['apellidos']);
        $datos->setDato($_POST['telefono']);
        $datos->setDato($_POST['direccion']);
        $accion='usuario';

        BD::insertarDatos($accion, $datos);
        break;

    case isset($_POST['btnModificarDireccionU']):
        $datos->setDato($_POST['modifU']);
        $datos->setDato($_POST['nuevaDireccionU']);
        $accion = 'direccion';

        BD::modificarDatos($accion, $datos);
        break;

    case isset($_POST['btnBorrarU']):
        $datos->setDato($_POST['borrarU']);
        $accion='usuario';

        BD::borrarDatos($accion, $datos);
        break;
}
?>

<html>
    <head>
        <meta charset="UTF-8">
        <link href="../estilos/estilos.css" rel="stylesheet" type="text/css">
         <!--<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>-->
        <script src="../libreria/jquery-3.6.0.js"></script>
        <title>Usuarios del centro de día La Paz</title>
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
                <h2>Insertar datos:</h2> 
                        <form method="POST" action="">
                            <label for="nombre">Nombre: </label><br> 
                                    <input type="text" id="nombre" name="nombre"  maxlength="40" tabindex="0" required><br> 
                                    <label for="apellidos">Apellidos: </label><br> 
                                    <input type="text" id="apellidos" name="apellidos" maxlength="40" tabindex="0" required><br> 
                                    <label for="telefono">Teléfono: </label><br> 
                                    <input type="text" id="telefono" name="telefono" maxlength="9" tabindex="0" required><br>
                                    <label for="direccion">Dirección: </label><br> 
                                    <input type="text" id="direccion" name="direccion" maxlength="100" tabindex="0" required><br>
                                    <input value="Insertar" type="submit" name="btnInsertarU" >
                                </form>
                            <br>
                            <br>

                   <h2>Modificar direccion:</h2> 
                                <form method="POST" action="">                                                 
                                    <?php
                                    $sql = "SELECT * FROM usuarios ORDER BY nombre";
                                    $resultado = BD::ejecutarConsulta($sql);
                                    $fila = $resultado->fetch_array();

                                    echo"<label for='modifU'>Usuario: </label>";
                                    echo "<select id='modifU' name='modifU' required tabindex='0'>";
                                    echo "<option value=''>Elija un usuario: </option>";
                                    while ($fila != null) {
                                        echo "<option value='" . $fila[1] . "'>" . $fila[0] . ", " . $fila[2] . "</option>";
                                        $fila = $resultado->fetch_array();
                                    }
                                    echo "</select> <br>";
                                    ?>
                                    <br>
                                    <label for="nuevaDireccionU">Dirección: </label>
                                    <input type="text" id="nuevaDireccionU" name="nuevaDireccionU">
                                    <input value="Modificar" type="submit" name="btnModificarDireccionU" >
                                </form>
                            <br>
                            <br>
                            <h2>Borrar datos:</h2>
                                <form method="POST" action="">
                                    <?php
                                    $sql = "SELECT * FROM usuarios ORDER BY nombre";
                                    $resultado = BD::ejecutarConsulta($sql);
                                    $fila = $resultado->fetch_array();

                                    echo"<label for='borrarU'>Usuario: </label>";
                                    echo "<select id='borrarU' name='borrarU' required tabindex='0'>";
                                    echo "<option value=''>Elija un usuario: </option>";
                                    while ($fila != null) {
                                        echo "<option value='" . $fila[1] . "'>" . $fila[0] . ", " . $fila[2] . "</option>";

                                        $fila = $resultado->fetch_array();
                                    }
                                    echo "</select>";
                                    ?>
                                    
                                    <input value="Borrar" type="submit" name="btnBorrarU" >
                                    <div id="mostrarDatosBorrar"></div>  
                                </form>
        </section>
        </div>
        <footer>
            <h4>Francisco Javier Maté Barba</h4>
        </footer>
        <script src="../javascript/Usuarios.js"></script>        
    </body>
</html>
