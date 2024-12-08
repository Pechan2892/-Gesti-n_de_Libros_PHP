<?php


require_once 'Libro.php';

class Biblioteca {
    private $libros = [];
    private $rutaArchivo;
// Constructor
    public function __construct($rutaArchivo = '../datos/libros.json') {
        $this->rutaArchivo = $rutaArchivo;
        $this->cargarLibros();
    }

    // Cargar libros desde el archivo JSON
    private function cargarLibros() {
        if (file_exists($this->rutaArchivo)) {
            $data = json_decode(file_get_contents($this->rutaArchivo), true);
            foreach ($data as $item) {
                $this->libros[] = new Libro(
                    $item['id'], 
                    $item['titulo'], 
                    $item['autor'], 
                    $item['categoria'], 
                    $item['estado']
                );
            }
        }
    }

    // Guardar libros en el archivo JSON
    private function guardarLibros() {
        $data = array_map(function ($libro) {
            return $libro->toArray();
        }, $this->libros);

        file_put_contents($this->rutaArchivo, json_encode($data, JSON_PRETTY_PRINT));
    }

    // Agregar un nuevo libro
    public function agregarLibro($libro) {
        $this->libros[] = $libro;
        $this->guardarLibros();
    }

    // Buscar libros por título
    public function buscarLibrosPorTitulo($titulo) {
        return array_filter($this->libros, function ($libro) use ($titulo) {
            return stripos($libro->getTitulo(), $titulo) !== false;
        });
    }

    // Editar un libro existente
    public function editarLibro($id, $nuevosDatos) {
        foreach ($this->libros as $libro) {
            if ($libro->getId() === $id) {
                if (isset($nuevosDatos['titulo'])) {
                    $libro->setTitulo($nuevosDatos['titulo']);
                }
                if (isset($nuevosDatos['autor'])) {
                    $libro->setAutor($nuevosDatos['autor']);
                }
                if (isset($nuevosDatos['categoria'])) {
                    $libro->setCategoria($nuevosDatos['categoria']);
                }
                if (isset($nuevosDatos['estado'])) {
                    $libro->setEstado($nuevosDatos['estado']);
                }
                $this->guardarLibros();
                return true; // Edición exitosa
            }
        }
        return false; // Libro no encontrado
    }

    // Eliminar un libro
    public function eliminarLibro($id) {
        $this->libros = array_filter($this->libros, function ($libro) use ($id) {
            return $libro->getId() !== $id;
        });
        $this->guardarLibros();
    }

    // Registrar un préstamo de libro
    public function registrarPrestamo($id) {
        foreach ($this->libros as $libro) {
            if ($libro->getId() === $id && $libro->getEstado() === 'disponible') {
                $libro->setEstado('prestado');
                $this->guardarLibros();
                return true; // Préstamo registrado
            }
        }
        return false; // Libro no disponible o no encontrado
    }

    // Registrar la devolución de un libro
    public function devolverLibro($id) {
        foreach ($this->libros as $libro) {
            if ($libro->getId() === $id && $libro->getEstado() === 'prestado') {
                $libro->setEstado('disponible');
                $this->guardarLibros();
                return true; // Devolución registrada
            }
        }
        return false; // Libro no encontrado o no estaba prestado
    }

    // Buscar libros por autor
    public function buscarLibrosPorAutor($autor) {
        return array_filter($this->libros, function ($libro) use ($autor) {
            return stripos($libro->getAutor(), $autor) !== false;
        });
    }

    // Buscar libros por categoría
    public function buscarLibrosPorCategoria($categoria) {
        return array_filter($this->libros, function ($libro) use ($categoria) {
            return stripos($libro->getCategoria(), $categoria) !== false;
        });
    }
}
