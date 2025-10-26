<?php
include __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../../models/Usuario.php';

$responsable = new Usuario();
$responsables = $responsable->listarResponsables();


?>

<h2>Registrar nueva área</h2>

<form action="../../controllers/areaController.php" method="POST">
    <input type="hidden" name="accion" value="agregar">

    <label>Nombre del área:</label><br>
    <input type="text" name="nombre" required><br><br>

    <label><strong>Responsable:</strong></label><br>
    <select name="responsable" required>
        <option value="">-- Seleccione --</option>
        <?php foreach ($responsables as $resp): ?>
            <option value="<?= $resp['id_usuario'] ?>">
                <?= htmlspecialchars($resp['nombre_completo']) ?>
            </option>
        <?php endforeach; ?>
    </select><br><br>

    <button type="submit">💾 Guardar área</button>
    <a href="listar.php">⬅ Volver</a>
</form>

<?php include __DIR__ . '/../includes/footer.php'; ?>
