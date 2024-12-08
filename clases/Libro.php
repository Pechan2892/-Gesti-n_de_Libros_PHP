<?php
// clases/Libro.php
class Libro {
    private $id;
    private $titulo;
    private $autor;
    private $categoria;
    private $estado; // disponible o prestado


    // Constructor
    public function __construct($id, $titulo, $autor, $categoria, $estado = 'disponible') {
        $this->id = $id;
        $this->titulo = $titulo;
        $this->autor = $autor;
        $this->categoria = $categoria;
        $this->estado = $estado;
    }
    // Metodos
    public function toArray() {
        return [
            'id' => $this->id,
            'titulo' => $this->titulo,
            'autor' => $this->autor,
            'categoria' => $this->categoria,
            'estado' => $this->estado,
        ];
    }

    // Getters y setters para cada propiedad
    public function getId() { return $this->id; }
    public function getTitulo() { return $this->titulo; }
    public function getAutor() { return $this->autor; }
    public function getCategoria() { return $this->categoria; }
    public function getEstado() { return $this->estado; }

    public function setTitulo($titulo) { $this->titulo = $titulo; }
    public function setAutor($autor) { $this->autor = $autor; }
    public function setCategoria($categoria) { $this->categoria = $categoria; }
    public function setEstado($estado) { $this->estado = $estado; }
}
