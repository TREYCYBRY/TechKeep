<?php
require_once __DIR__ . '/../../models/equipo.php';
include __DIR__ . '/../includes/header.php';

$equipos = (new Equipo())->listar();
?>

<h2>➕ Agregar Componente</h2>

<form action="../../controllers/componenteController.php" method="POST">
    <input type="hidden" name="accion" value="agregar">

    <label>Equipo:</label><br>
    <select name="id_equipo" required>
        <option value="">-- Seleccione equipo --</option>
        <?php foreach ($equipos as $e): ?>
            <option value="<?= $e['id_equipo'] ?>"><?= htmlspecialchars($e['nombre']) ?></option>
        <?php endforeach; ?>
    </select><br><br>

    <label>Tipo:</label><br>
    <input type="text" name="tipo" required><br><br>

    <label>Marca:</label><br>
    <input type="text" name="marca"><br><br>

    <label>Modelo:</label><br>
    <input type="text" name="modelo"><br><br>

    <label>Número de serie:</label><br>
    <input type="text" name="numero_serie"><br><br>

    <label>Fecha de instalación:</label><br>
    <input type="date" name="fecha_instalacion"><br><br>

    <label>Estado:</label><br>
    <select name="estado">
        <option value="operativo">Operativo</option>
        <option value="dañado">Dañado</option>
        <option value="reemplazado">Reemplazado</option>
    </select><br><br>

    <button type="submit">💾 Guardar</button>
    <a href="listar.php">⬅ Volver</a>
</form>

<?php include __DIR__ . '/../includes/footer.php'; ?>
