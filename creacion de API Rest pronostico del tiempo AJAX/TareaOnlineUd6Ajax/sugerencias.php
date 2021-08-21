<?php

if (isset($_REQUEST['ciudad']) && !empty($_POST['ciudad'])) {
    $ciudad = $_POST['ciudad'];
    $ciudades = DateTimeZone::listIdentifiers();
    $numeroDeCiudades = 0;
    //Pasamos a minusculas todos los caracteres
    if (ctype_upper($ciudad)) {
        $ciudad = strtolower($ciudad);
    }
    //Pasamos el primer caracter a mayuscula
    if (ctype_lower(substr($ciudad, 0, 1))) {
        $ciudad = strtoupper(substr($ciudad, 0, 1)) . substr($ciudad, 1);
    }

    for ($i = 0; $i < sizeof($ciudades); $i++) {
        //Obtengo la posicion en la cadena de la (/)
        $zonaHoraria = strpos($ciudades[$i], "/") + 1;
        //Aquí sustraigo solo el nombre de la ciudad, evitando la zona horaria con substr.
        $ciudadObtenida = substr($ciudades[$i], $zonaHoraria, strlen(($ciudades[$i])));
        //Con strlen obtengo el numero de caracteres de la ciudad que ocupa la posición en ese momento. 
        //Si el texto obtenido es igual a la ciudad entonces... la comparación la hago con los caracteres que introduzco y los caracteres que ocupan el nº de la ciudad en la cadena
        if ($ciudad == substr($ciudadObtenida, 0, strlen($ciudad))) {
            $numeroDeCiudades++;
            //Estructura de control para verificar si existe más de una ciudad y a la hora de listarla incluirle una (,) para separar cada ciudad
            if ($numeroDeCiudades != 1) {
                print ", $ciudadObtenida";
            } else {
                print $ciudadObtenida;
            }
        }
    }
    if ($numeroDeCiudades == 0) {
        print "Lo sentimos, no tenemos resultados para $ciudad.";
    }
}
?>