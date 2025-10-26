<?php
require_once __DIR__ . '/../../models/tipo_mantenimiento.php';
include __DIR__ . '/../includes/header.php';

$id = $_GET['id'] ?? 0;
$model = new TipoMantenimiento();
$tipo = $model->obtener($id);
?>

<h2>✏️ Editar Tipo de Mantenimiento</h2>

<form action="../../controllers/tipoMantenimientoController.php" method="POST">
    <input type="hidden" name="accion" value="editar">
    <input type="hidden" name="id_tipo" value="<?= $tipo['id_tipo'] ?>">

    <label>Nombre:</label><br>
    <input type="text" name="nombre" value="<?= htmlspecialchars($tipo['nombre']) ?>" required><br><br>

    <label>Descripción:</label><br>
    <textarea name="descripcion" rows="3" cols="40"><?= htmlspecialchars($tipo['descripcion']) ?></textarea><br><br>

    <label>Intervalo (días):</label><br>
    <input type="number" name="intervalo_dias" min="0" value="<?= htmlspecialchars($tipo['intervalo_dias']) ?>"><br><br>

    <button type="submit">💾 Actualizar</button>
    <a href="listar.php">⬅ Volver</a>
</form>

<?php include __DIR__ . '/../includes/footer.php'; ?>
