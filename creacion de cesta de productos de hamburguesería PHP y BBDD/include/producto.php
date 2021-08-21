<?php

class Producto {
    protected $codigo;
    protected $nombre;
    protected $precio;
    protected $imagen;
    
    public function getcodigo() {return $this->codigo; }
    public function getnombre() {return $this->nombre; }
    public function getprecio() {return $this->precio; }
    public function getimagen() {return $this->imagen; }
    
    public function __construct($row) {
        $this->codigo = $row['codigo'];
        $this->nombre = $row['nombre'];
        $this->precio = $row['precio'];
        $this->imagen = $row['imagen'];
    }
}

?>

