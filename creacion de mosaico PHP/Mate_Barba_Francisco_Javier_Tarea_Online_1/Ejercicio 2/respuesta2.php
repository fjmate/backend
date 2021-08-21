<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" href="main.css">
    </head>
    <body>
        <?php  
        $alto = $_POST["alto"];
        $ancho = $_POST["ancho"];
        $area = $alto*$ancho;
        //Creamos el array de las baldosas
        $array = [];

        for($i=0;$i<$area;$i++){

            $array[$i] = $_POST["baldosa".$i];
        }

        //Hacemos aleatorio el array
        shuffle($array);
        
        echo "Su mosaico de baldosas queda así: <br>";
        echo"<table border='1'>";
        for($j=0;$j<$alto;$j++){
                echo "<tr>";
            for($k=0;$k<$ancho;$k++){
                //Vamos eliminando las baldosas ya usadas
                $color = array_pop($array);
                echo "<td style='background-color:".$color."' 'height=100px' 'width=100px'>";
                echo "</td>";
            }
            echo "</tr>";
        }
        echo "</table>";

        echo "<br> <input type='button' value='Atras' onClick='history.go(-1);'>";
        echo '<input type="button" value="Recargar página" onClick="location.reload();"';
        ?>
    </body>
</html>






