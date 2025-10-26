<?php include __DIR__ . '/../includes/header.php'; 
require_once __DIR__ . '/../../models/Area.php';

// Obtenemos las áreas para el select
$area = new Area();
$areas = $area->listar();
?>

<h2>➕ Registrar nueva ubicación</h2>

<form action="../../controllers/ubicacionController.php" method="POST">
    <input type="hidden" name="accion" value="agregar">

    <label>Nombre:</label><br>
    <input type="text" name="nombre" required><br><br>

    <label>Descripción:</label><br>
    <textarea name="descripcion" rows="3"></textarea><br><br>

    <label>Piso:</label><br>
    <input type="text" name="piso"><br><br>

    <label>Área:</label><br>
    <select name="id_area" required>
        <option value="">-- Seleccione área --</option>
        <?php foreach ($areas as $a): ?>
            <option value="<?= $a['id_area'] ?>">
                <?= htmlspecialchars($a['nombre_area']) ?>
            </option>
        <?php endforeach; ?>
    </select><br><br>

    <button type="submit">💾 Guardar</button>
    <a href="ubicaciones_listar.php">⬅ Volver</a>
</form>

<?php include __DIR__ . '/../includes/footer.php'; ?>
