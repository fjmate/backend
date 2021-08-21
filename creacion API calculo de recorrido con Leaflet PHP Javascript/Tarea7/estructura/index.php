 <!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <link href="../estilos/estilos.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
              integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
              crossorigin=""/>
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
                            <h1>Información general del centro</h1>
                            <p>
                                Aplicación para el cálculo de rutas entre varios puntos mediante Leaflet.
                            </p>
                            <h2>Localización</h2>
                            <div id="mapa"></div>
                    </section>
            </div>
        <footer>
                <h4>Francisco Javier Maté Barba</h4>
        </footer>
        <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
                integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
        crossorigin=""></script>
        <script src="../javascript/mapa.js"></script>
    </body>
</html>
