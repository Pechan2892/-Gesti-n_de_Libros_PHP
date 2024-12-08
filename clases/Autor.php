<?php

class Autor {
    private $id;
    private $nombre;

    public function __construct($id, $nombre) {
        $this->id = $id;
        $this->nombre = $nombre;
    }

    // Getters
    public function getId() { return $this->id; }
    public function getNombre() { return $this->nombre; }

    // Setters
    public function setNombre($nombre) { $this->nombre = $nombre; }

    // Convertir a array para exportar datos
    public function toArray() {
        return [
            'id' => $this->id,
            'nombre' => $this->nombre
        ];
    }
}
