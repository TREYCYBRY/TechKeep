<?php
require_once __DIR__ . '/../../models/ubicacion.php';
$ubicacion = new ubicacion();
$id = $_GET['id'] ?? 0;
$u = $ubicacion->obtener($id);
include __DIR__ . '/../includes/header.php';

require_once __DIR__ . '/../../models/Area.php';

// Obtenemos las áreas para el select
$area = new Area();
$areas = $area->listar();
?>

<h2>✏️ Editar ubicación</h2>

<form action="../../controllers/ubicacionController.php" method="POST">
    <input type="hidden" name="accion" value="editar">
    <input type="hidden" name="id_ubicacion" value="<?= $u['id_ubicacion'] ?>">

    <label>Nombre:</label><br>
    <input type="text" name="nombre" value="<?= htmlspecialchars($u['nombre']) ?>" required><br><br>

    <label>Descripción:</label><br>
    <textarea name="descripcion" rows="3"><?= htmlspecialchars($u['descripcion']) ?></textarea><br><br>

    <label>Piso:</label><br>
    <input type="text" name="piso" value="<?= htmlspecialchars($u['piso']) ?>"><br><br>

    <label>Área:</label><br>
<select name="id_area" required>
    <option value="">-- Seleccione área --</option>
    <?php foreach ($areas as $a): ?>
        <option value="<?= $a['id_area'] ?>" 
            <?= ($a['id_area'] == $u['id_area']) ? 'selected' : '' ?>>
            <?= htmlspecialchars($a['nombre_area']) ?>
        </option>
    <?php endforeach; ?>
</select><br><br>


    <button type="submit">💾 Actualizar</button>
    <a href="ubicaciones_listar.php">⬅ Volver</a>
</form>

<?php include __DIR__ . '/../includes/footer.php'; ?>
