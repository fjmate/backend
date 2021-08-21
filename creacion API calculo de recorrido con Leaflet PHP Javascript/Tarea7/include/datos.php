<?php
Class Datos {
    private $dato = [];
    public function getDato() {
        return $this->dato;
    }
    public function setDato($dato) {
        $this->dato[] = $dato;
    }
}
