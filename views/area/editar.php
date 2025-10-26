<?php
include __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../../models/Area.php';
require_once __DIR__ . '/../../models/Usuario.php';


$id = $_GET['id']?? null;

$area = new Area();
$datos = $area->obtener($id);

if (!$datos) {
    die('⚠️ No se encontró el área.');
}

// Listar responsables disponibles
$responsable = new Usuario();
$responsables = $responsable->listarResponsables();
?>

<h2>Editar área</h2>

<form action="../../controllers/areaController.php" method="POST">
    <input type="hidden" name="accion" value="editar">
    <input type="hidden" name="id_area" value="<?= $datos['id_area'] ?>">

    <label><strong>Nombre:</strong></label><br>
    <input type="text" name="nombre" value="<?= htmlspecialchars($datos['nombre_area']) ?>" required><br><br>

    <label><strong>Responsable:</strong></label><br>
    <select name="responsable">
        <option value="">-- Seleccione --</option>
        <?php foreach ($responsables as $resp): ?>
            <option value="<?= $resp['id_usuario'] ?>"
                <?= ($resp['id_usuario'] == $datos['responsable']) ? 'selected' : '' ?>>
                <?= htmlspecialchars($resp['nombre_completo']) ?>
            </option>
        <?php endforeach; ?>
    </select><br><br>

    <button type="submit">💾 Guardar cambios</button>
    <a href="listar.php">⬅ Volver</a>
</form>

<?php include __DIR__ . '/../includes/footer.php'; ?>
