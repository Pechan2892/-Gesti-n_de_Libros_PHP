<?php
require_once '../clases/Biblioteca.php';

$biblioteca = new Biblioteca();

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $_POST['titulo'] ?? '';
    $autor = $_POST['autor'] ?? '';
    $categoria = $_POST['categoria'] ?? '';

    if ($titulo && $autor && $categoria) {
        $id = uniqid(); // Generar un ID único para el libro
        $nuevoLibro = new Libro($id, $titulo, $autor, $categoria);
        $biblioteca->agregarLibro($nuevoLibro);
        header('Location: index.php?success=1'); // Redirigir a la página principal
        exit();
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
    <title>Agregar Libro</title>
</head>
<body>
    <h1>Agregar Libro</h1>
    <?php if ($error): ?>
        <p style="color: red;"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>
    <form method="POST" action="">
        <label for="titulo">Título:</label><br>
        <input type="text" id="titulo" name="titulo" required><br><br>

        <label for="autor">Autor:</label><br>
        <input type="text" id="autor" name="autor" required><br><br>

        <label for="categoria">Categoría:</label><br>
        <input type="text" id="categoria" name="categoria" required><br><br>

        <button type="submit">Agregar</button>
    </form>
</body>
</html>
