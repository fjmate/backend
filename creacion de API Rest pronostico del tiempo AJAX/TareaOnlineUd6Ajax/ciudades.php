<?php $ciudad = $_POST['nombreCiudad']; ?>

<div class="ciudadelegida">
    <h1>Pronóstico de <?php echo strtoupper($ciudad) ?></h1>               

    <?php

    function obtenerTiempo($ciudad) {
        $apikey = "a8aa3861ba5863c63236b1de1b42d197";
        $unidades = "&units=metric";
        $idioma = "&lang=es";
        $url = "http://api.openweathermap.org/data/2.5/weather?q=" . $ciudad . "," . $unidades . $idioma . "&APPID=" . $apikey;

        if ($ciudad == "") {
            echo "Debe escribir en el campo correspondiente.";
        } else {
            $datos = @file_get_contents($url);
            if ($datos === FALSE) {
                echo "Lo sentimos, no tenemos pronóstico para la ciudad $ciudad";
            } else {
                $jsonMaquetado = json_decode($datos, JSON_PRETTY_PRINT);
                $json = json_decode($datos);
                $estacion = $json->name;
                $pais = $json->sys->country;
                $lat = $json->coord->lat;
                $lon = $json->coord->lon;
                $temp = $json->main->temp;
                $tempmax = $json->main->temp_max;
                $tempmin = $json->main->temp_min;
                $presion = $json->main->pressure;
                $humedad = $json->main->humidity;
                $velocidadViento = $json->wind->speed;
                if (isset($json->wind->deg)) {
                    $direccionViento = $json->wind->deg;
                } else {
                    $direccionViento = "No disponible";
                }
                $estadoCielo = $json->weather[0]->main;
                $descripcion = $json->weather[0]->description;
                $icono = $json->weather[0]->icon;
                $URLicono = "http://openweathermap.org/img/w/" . $icono . ".png";
                $nubosidad = $json->clouds->all;
                $amanece = $json->sys->sunrise;
                $oscurece = $json->sys->sunset;

                echo "<h2>Datos</h2>";
                echo "<img src = '$URLicono' alt = '$estadoCielo' >";
                echo "<p>País: " . $pais . "</p>";
                echo "<p>Descripción: " . $descripcion . "</p>";
                echo "<p>Temperatura: " . $temp . " grados Celsius</p>";
                echo "<p>Humedad: " . $humedad . " %</p>";
                echo "<p>Fecha y hora del amanecer: " . date("d-m-Y G:i:s", $amanece) . "</p>";
                echo "<p>Fecha y hora del oscurecer: " . date("d-m-Y G:i:s", $oscurece) . "</p>";
            }
        }
    }

    obtenerTiempo($ciudad);
    echo "</div>";
    ?>
