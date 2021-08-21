<?php
require_once('include/CestaCompra.php');

// Recuperamos la información de la sesión
session_start();

// Y comprobamos que el usuario se haya autentificado
if (!isset($_SESSION['usuario'])) 
    die("Error - debe <a href='login.php'>identificarse</a>.<br />");

// Recuperamos la cesta de la compra
$cesta = CestaCompra::carga_cesta();

// Creamos una función para mostrar los datos del usuario del pedido
function creaFormularioUsuario() {
	$usuarios = DB::obtieneUsuarios();
	foreach ($usuarios as $u) {
		$usuario= $u->getusuario();
		$calle= $u->getcalle();
		$numero= $u->getnumero();
                $cp= $u->getcp();
                $localidad = $u->getlocalidad();
                $provincia = $u->getprovincia();
		// Creamos el formulario en HTML para cada producto
		echo "<p><form id='$usuario' action='pedido.php' method='post'>";
        // Metemos ocultos los datos de los productos
        echo "<input type='hidden' name='usuario' value='".$usuario."'/>";
        echo "<input type='hidden' name='calle' value='".$calle."'/>";
        echo "<input type='hidden' name='numero' value='".$numero."'/>";
        echo "<input type='hidden' name='cp' value='".$cp."'/>";
        echo "<input type='hidden' name='localidad' value='".$localidad."'/>";
        echo "<input type='hidden' name='provincia' value='".$provincia."'/>";
        echo "Datos de envío--> Nombre: $usuario -- C/$calle Nº$numero -- CP: $cp -- Localidad: $localidad -- Provincia: $provincia";
        echo "</form>"; 
        echo "</p>";
	}        
}
?>
<!DOCTYPE html>
<!-- Desarrollo Web en Entorno Servidor -->
<!-- Tema 5 : Programación orientada a objetos en PHP -->
<!-- Ejemplo Tienda Web: cesta.php -->
<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <title>Hamburguesería</title>
</head>

<body class="pagcesta">

<div id="contenedor">
  <div id="encabezado">
    <h1>Cesta de la compra</h1>
  </div>
  <div id="productos">
<?php
    creaFormularioUsuario();
	$productos= $cesta->get_productos();
    foreach($productos as $p => $producto) { 
                $codigo= $producto->getcodigo();
		$nombre= $producto->getnombre();
		$precio= $producto->getprecio();
        echo "<span class='nombre'>$nombre </span>";
        echo "<span class='precio'>$precio</span></p>"; 
       
    }
?>
      <hr />
      <p><span class='pagar'>Precio total: <?php print $cesta->get_coste(); ?> €</span></p>
      <form action='pagar.php' method='post'>
          <p>
              <span class='pagar'>
                    <input type='submit' name='pagar' value='Pagar'/>
              </span>
          </p>
      </form>
      <form action='pedido.php' method='post'>
          <p>
              <span class='pagar'>
                    <input type='submit' name='atras' value='Atras'/>
              </span>
          </p>
      </form>  
  </div>
  <br class="divisor" />
  <div id="pie">
    <form action='logoff.php' method='post'>
        <input type='submit' name='desconectar' value='Desconectar usuario <?php echo $_SESSION['usuario']; ?>'/>
    </form>        
  </div>
</div>
</body>
</html>
