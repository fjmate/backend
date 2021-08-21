<html>
<body>
<?php 
      //Recogemos las variables de index.html dadas por el usuario
      $alto = $_POST["alto"];
      $ancho = $_POST["ancho"];
?>
Has elegido <?php echo $alto; ?> baldosas
de alto y <?php echo $ancho; ?> baldosas de ancho. <br>
<?php $area = $alto*$ancho; ?> 
Dispones de un area de <?php echo $area ?> baldosas

<form action="respuesta2.php" method="POST">
    <?php 
    //Elegimos los colores de cada baldosa
        for ($i = 0;$i < $area ; $i++ ){
    ?>    
    Color baldosa <?php echo $i+1 ?> <select name="baldosa<?php echo $i ?>">
        <option value="red">Rojo</option>
        <option value="blue">Azul</option>
        <option value="green">Verde</option>
        <option value="black">Negro</option>        
        <option value="yellow">Amarillo</option>        
        <option value="pink">Rosa</option>        
        <option value="brown">Marron</option>        
        <option value="orange">Naranja</option>        
        <option value="gray">Gris</option>        
        <option value="purple">Morado</option>
        <option value="white">Nada</option>        
    </select> <br>
 <?php   } ?> 
        <!-- Ocultamos los dos botones para enviar las variables alto y ancho -->
        <input type="hidden" name ="alto" value="<?php echo $alto?>">
        <input type="hidden" name ="ancho" value="<?php echo $ancho?>">
        <input type="submit" name ="enviar" value="Enviar">  
</form>
</body>
</html>
