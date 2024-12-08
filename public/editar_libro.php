<?php
require_once '../clases/Biblioteca.php';

$biblioteca = new Biblioteca();
$error = '';
$mensaje = '';
$libro = null;

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $libro = current(array_filter($biblioteca->buscarLibrosPorTitulo(''), function ($item) use ($id) {
        return $item->getId() === $id;
    }));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? '';
    $titulo = $_POST['titulo'] ?? '';
    $autor = $_POST['autor'] ?? '';
    $categoria = $_POST['categoria'] ?? '';

    if ($id && $titulo && $autor && $categoria) {
        $actualizado = $biblioteca->editarLibro($id, [
            'titulo' => $titulo,
            'autor' => $autor,
            'categoria' => $categoria
        ]);
        if ($actualizado) {
            $mensaje = 'Libro actualizado con éxito.';
        } else {
            $error = 'No se pudo actualizar el libro.';
        }
    } else {
        $error = 'Por favor, complete todos los campos.';
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Libro</title>
</head>
<body>
    <h1>Editar Libro</h1>
    <?php if ($error): ?>
        <p style="color: red;"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>
    <?php if ($mensaje): ?>
        <p style="color: green;"><?= htmlspecialchars($mensaje) ?></p>
    <?php endif; ?>
    <form method="POST" action="">
        <input type="hidden" name="id" value="<?= htmlspecialchars($libro ? $libro->getId() : '') ?>">
        <label for="titulo">Título:</label><br>
        <input type="text" id="titulo" name="titulo" value="<?= htmlspecialchars($libro ? $libro->getTitulo() : '') ?>" required><br><br>

        <label for="autor">Autor:</label><br>
        <input type="text" id="autor" name="autor" value="<?= htmlspecialchars($libro ? $libro->getAutor() : '') ?>" required><br><br>

        <label for="categoria">Categoría:</label><br>
        <input type="text" id="categoria" name="categoria" value="<?= htmlspecialchars($libro ? $libro->getCategoria() : '') ?>" required><br><br>

        <button type="submit">Guardar Cambios</button>
    </form>
</body>
</html>
