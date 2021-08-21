<?php
require_once('conexion.php');

class CestaCompra {
    protected $productos = array();
    
    protected $usuarios = array();
    
    // Introduce un nuevo artículo en la cesta de la compra
    public function nuevo_articulo($codigo) {
        $producto = DB::obtieneProducto($codigo);
        $this->productos[] = $producto;
    }
    
    //Introduce el usuario en la cesta de la compra
    public function datos_usuario($usuario) {
        $usuario = DB::obtieneUsuario($usuario);
        $this->usuarios[] = $usuario;
    }
    
    public function get_usuarios() { return $this->usuarios;     }
    
    // Obtiene los artículos en la cesta
    public function get_productos() { return $this->productos; }
    
    // Obtiene el coste total de los artículos en la cesta
    public function get_coste() {
        $coste = 0;
        foreach($this->productos as $p) $coste += $p->getprecio();
        return $coste;
    }
    
    // Devuelve true si la cesta está vacía
    public function vacia() {
        if(count($this->productos) == 0) return true;
        return false;
    }
    
    // Guarda la cesta de la compra en la sesión del usuario
    public function guarda_cesta() { $_SESSION['cesta'] = $this; }
    
    // Recupera la cesta de la compra almacenada en la sesión del usuario
    public static function carga_cesta() {
        if (!isset($_SESSION['cesta'])) return new CestaCompra();
        else return $_SESSION['cesta'];
    }
}

?>
