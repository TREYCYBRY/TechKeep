<?php include __DIR__ . '/../includes/header.php'; ?>

<h2>➕ Registrar nueva categoría</h2>

<form action="../../controllers/categoriaController.php" method="POST">
    <input type="hidden" name="accion" value="agregar">

    <label>Nombre:</label><br>
    <input type="text" name="nombre" required><br><br>

    <label>Descripción:</label><br>
    <textarea name="descripcion" rows="3"></textarea><br><br>

    <button type="submit">💾 Guardar</button>
    <a href="../categoria_equipo/categorias_listar.php">⬅ Volver</a>
</form>

<?php include __DIR__ . '/../includes/footer.php'; ?>
