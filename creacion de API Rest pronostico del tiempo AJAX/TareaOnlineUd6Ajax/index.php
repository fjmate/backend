<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Tarea Online Ud6 Ajax</title>
        <link rel="stylesheet" href="style.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script type="text/javascript" src="script.js"></script>       
    </head>
    <body>
        <form id='datos' action='index.php' method='post'>
            <div class="ciudad">
                <label for="ciudad">Escriba la ciudad para conocer su pronóstico:</label><br>
                <input id="ciudad" type="text" name="ciudad" placeholder="Ciudad" onkeyup="sugerirCiudades(this.value)">                 
                <input type="button" id="vertiempo" value="Ver tiempo">
                <label for="sugerencias"><strong>Sugerencias:</strong></label>
                <span id="sugerencias"></span>
            </div><br>
            <div id="respuesta"></div>
        </form> 
        <div class="ciudadsevilla">
            <h1>Pronóstico de SEVILLA</h1>
            <?php
            require 'funciones.php';
            obtenerTiempo();
            ?>
        </div>
        <script type="text/javascript">
            $(document).ready(function () {
                $('#vertiempo').click(function () {
                    var nombreCiudad = $('#ciudad').val();
                    $.ajax({
                        url: 'ciudades.php',
                        type: 'POST',
                        data: {nombreCiudad: nombreCiudad},
                        success: function (result) {
                            $('#respuesta').html(result);
                        }
                    });
                });
            });
        </script>
    </body>
</html>
