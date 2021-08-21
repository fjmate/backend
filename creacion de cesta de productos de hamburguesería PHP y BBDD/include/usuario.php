<?php

class Usuario {
    protected $usuario;
    protected $calle;
    protected $numero;
    protected $cp;
    protected $localidad;
    protected $provincia;


    public function getusuario() {return $this->usuario; }
    public function getcalle() {return $this->calle; }
    public function getnumero() {return $this->numero; }
    public function getcp() {return $this->cp; }
    public function getlocalidad() {return $this->localidad; }
    public function getprovincia() {return $this->provincia; }
    
    public function __construct($row) {
        $this->usuario = $row['usuario'];
        $this->calle = $row['calle'];
        $this->numero = $row['numero'];
        $this->cp = $row['cp'];
        $this->localidad = $row['localidad'];
        $this->provincia = $row['provincia'];
    }
}

?>