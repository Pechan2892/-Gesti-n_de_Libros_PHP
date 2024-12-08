<?php
require_once '../clases/Biblioteca.php';

$biblioteca = new Biblioteca();
$libros = $biblioteca->buscarLibrosPorTitulo("El Quijote");

foreach ($libros as $libro) {
    echo "Título: " . $libro->getTitulo() . "<br>";
    echo "Autor: " . $libro->getAutor() . "<br>";
    echo "Categoría: " . $libro->getCategoria() . "<br>";
    echo "Estado: " . $libro->getEstado() . "<br><br>";
}
?>

