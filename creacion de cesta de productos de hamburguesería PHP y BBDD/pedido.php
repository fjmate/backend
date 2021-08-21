<?php
require_once('include/conexion.php');
require_once('include/CestaCompra.php');

// Recuperamos la información de la sesión
session_start();

// Y comprobamos que el usuario se haya autentificado
if (!isset($_SESSION['usuario'])) 
    die("Error - debe <a href='login.php'>identificarse</a>.<br />");

// Recuperamos la cesta de la compra
$cesta = CestaCompra::carga_cesta();

// Comprobamos si se ha enviado el formulario de vaciar la cesta
if (isset($_POST['vaciar'])) {
    unset($_SESSION['cesta']);
    $cesta = new CestaCompra();
}

// Comprobamos si se quiere añadir un producto a la cesta
if (isset($_POST['enviar'])) {
    $cesta->nuevo_articulo($_POST['nombre']);
    $cesta->guarda_cesta();
}

// Creamos una función para mostrar el listado de todos los productos 
function creaFormularioProductos() {
	$productos = DB::obtieneProductos();
	foreach ($productos as $p) {
		$codigo= $p->getcodigo();
		$nombre= $p->getnombre();
		$precio= $p->getprecio();
                $imagen= $p->getimagen();
		// Creamos el formulario en HTML para cada producto
		echo "<p><form id='$codigo' action='pedido.php' method='post'>";
        // Metemos ocultos los datos de los productos
        echo "<input type='hidden' name='codigo' value='".$codigo."'/>";
        echo "<input type='hidden' name='nombre' value='".$nombre."'/>";
        echo "<input type='hidden' name='precio' value='".$precio."'/>";
        echo " $nombre  ";
        echo "<img height='40' src='imagenes/$imagen'/>";
        echo " $precio euros ";
        echo "<input type='submit' name='enviar' value='Añadir'/>";
        echo "</form>"; 
        echo "</p>";
	}        
}

// Creamos una función para mostrar el listado de todos los productos 
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
//$_SESSION['datos'] = creaFormularioUsuario();
?>

<!DOCTYPE html>
<!-- Desarrollo Web en Entorno Servidor -->
<!-- Tema 5 : Programación orientada a objetos en PHP -->
<!-- Ejemplo Tienda Web: productos.php -->
<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <title>Hamburguesería</title>
</head>

<body class="pagproductos">

<div id="contenedor">
  <div id="encabezado">
    <h1>Listado de productos</h1>
  </div>
  <div id="cesta">
    <hr />
<?php	
	$productos= $cesta->get_productos();
	foreach($productos as $p => $producto) {
		$nombre= $producto->getnombre();
		echo "<span class='nombre'>$nombre </br> </span>";  
    } 
?>
    <form id='vaciar' action='pedido.php' method='post'>
        <input type='submit' name='vaciar' value='Vaciar Cesta' 
            <?php if ($cesta->vacia()) print "disabled='true'"; ?>
        />
    </form>
    <form id='comprar' action='cesta.php' method='post'>
        <input type='submit' name='comprar' value='Comprar' 
            <?php if ($cesta->vacia()) print "disabled='true'"; ?>
        />
    </form>
  </div>
  <div id="productos">
<?php		CreaFormularioProductos();  
?>
  </div>
  
  <br class="divisor" />
  <div id="pie">
    <form action='logoff.php' method='post'>
        <input type='submit' name='desconectar' value='Desconectar usuario <?php echo $_SESSION['usuario']; ?>'/>
    </form>        
<?php
    if (isset($error)) {
        print "<p class='error'>Error $error: $mensaje</p>";
    }
?>
  </div>
</div>
</body>
</html>
