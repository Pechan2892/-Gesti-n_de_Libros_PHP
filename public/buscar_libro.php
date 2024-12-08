<?php
require_once '../clases/Biblioteca.php';

$biblioteca = new Biblioteca();
$resultados = [];

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['titulo'])) {
    $titulo = $_GET['titulo'];
    $resultados = $biblioteca->buscarLibrosPorTitulo($titulo);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar Libro</title>
</head>
<body>
    <h1>Buscar Libro</h1>
    <form method="GET" action="">
        <label for="titulo">Título:</label><br>
        <input type="text" id="titulo" name="titulo" required><br><br>
        <button type="submit">Buscar</button>
    </form>

    <h2>Resultados:</h2>
    <?php if ($resultados): ?>
        <ul>
            <?php foreach ($resultados as $libro): ?>
                <li>
                    <strong><?= htmlspecialchars($libro->getTitulo()) ?></strong>
                    (Autor: <?= htmlspecialchars($libro->getAutor()) ?>, Categoría: <?= htmlspecialchars($libro->getCategoria()) ?>)
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>No se encontraron resultados.</p>
    <?php endif; ?>
</body>
</html>
