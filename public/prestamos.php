<?php
require_once '../clases/Biblioteca.php';

$biblioteca = new Biblioteca();
$error = '';
$mensaje = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? '';
    $accion = $_POST['accion'] ?? ''; // 'prestar' o 'devolver'

    if ($id && $accion) {
        if ($accion === 'prestar') {
            $resultado = $biblioteca->registrarPrestamo($id);
            if ($resultado) {
                $mensaje = 'Préstamo registrado con éxito.';
            } else {
                $error = 'El libro no está disponible para préstamo.';
            }
        } elseif ($accion === 'devolver') {
            $resultado = $biblioteca->devolverLibro($id);
            if ($resultado) {
                $mensaje = 'Devolución registrada con éxito.';
            } else {
                $error = 'El libro no está prestado o no se encontró.';
            }
        }
    } else {
        $error = 'Por favor, seleccione un libro y una acción válida.';
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Préstamos</title>
</head>
<body>
    <h1>Gestión de Préstamos</h1>
    <?php if ($error): ?>
        <p style="color: red;"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>
    <?php if ($mensaje): ?>
        <p style="color: green;"><?= htmlspecialchars($mensaje) ?></p>
    <?php endif; ?>

    <form method="POST" action="">
        <label for="id">ID del Libro:</label><br>
        <input type="text" id="id" name="id" required><br><br>

        <label>Acción:</label><br>
        <input type="radio" id="prestar" name="accion" value="prestar" required>
        <label for="prestar">Prestar</label><br>
        <input type="radio" id="devolver" name="accion" value="devolver" required>
        <label for="devolver">Devolver</label><br><br>

        <button type="submit">Ejecutar</button>
    </form>
</body>
</html>
