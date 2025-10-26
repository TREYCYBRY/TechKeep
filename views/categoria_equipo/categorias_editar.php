<?php
require_once __DIR__ . '/../../models/categoria.php';
$categoria = new CategoriaEquipo();
$id = $_GET['id'] ?? 0;
$cat = $categoria->obtener($id);
include __DIR__ . '/../includes/header.php';
?>

<h2>✏️ Editar categoría</h2>

<form action="../../controllers/categoriaController.php" method="POST">
    <input type="hidden" name="accion" value="editar">
    <input type="hidden" name="id_categoria" value="<?= $cat['id_categoria'] ?>">

    <label>Nombre:</label><br>
    <input type="text" name="nombre" value="<?= htmlspecialchars($cat['nombre']) ?>" required><br><br>

    <label>Descripción:</label><br>
    <textarea name="descripcion" rows="3"><?= htmlspecialchars($cat['descripcion']) ?></textarea><br><br>

    <button type="submit">💾 Actualizar</button>
    <a href="categorias_listar.php">⬅ Volver</a>
</form>

<?php include __DIR__ . '/../includes/footer.php'; ?>
