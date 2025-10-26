<?php
require_once __DIR__ . '/../../models/componente.php';
require_once __DIR__ . '/../../models/equipo.php';
include __DIR__ . '/../includes/header.php';

$id = $_GET['id'] ?? 0;
$model = new Componente();
$componente = $model->obtener($id);

$equipos = (new Equipo())->listar();
?>

<h2>✏️ Editar Componente</h2>

<form action="../../controllers/componenteController.php" method="POST">
    <input type="hidden" name="accion" value="editar">
    <input type="hidden" name="id_componente" value="<?= $componente['id_componente'] ?>">

    <label>Equipo:</label><br>
    <select name="id_equipo" required>
        <?php foreach ($equipos as $e): ?>
            <option value="<?= $e['id_equipo'] ?>" <?= $e['id_equipo'] == $componente['id_equipo'] ? 'selected' : '' ?>>
                <?= htmlspecialchars($e['nombre']) ?>
            </option>
        <?php endforeach; ?>
    </select><br><br>

    <label>Tipo:</label><br>
    <input type="text" name="tipo" value="<?= htmlspecialchars($componente['tipo']) ?>" required><br><br>

    <label>Marca:</label><br>
    <input type="text" name="marca" value="<?= htmlspecialchars($componente['marca']) ?>"><br><br>

    <label>Modelo:</label><br>
    <input type="text" name="modelo" value="<?= htmlspecialchars($componente['modelo']) ?>"><br><br>

    <label>Número de serie:</label><br>
    <input type="text" name="numero_serie" value="<?= htmlspecialchars($componente['numero_serie']) ?>"><br><br>

    <label>Fecha de instalación:</label><br>
    <input type="date" name="fecha_instalacion" value="<?= htmlspecialchars($componente['fecha_instalacion']) ?>"><br><br>

    <label>Estado:</label><br>
    <select name="estado">
        <option value="operativo" <?= $componente['estado'] == 'operativo' ? 'selected' : '' ?>>Operativo</option>
        <option value="dañado" <?= $componente['estado'] == 'dañado' ? 'selected' : '' ?>>Dañado</option>
        <option value="reemplazado" <?= $componente['estado'] == 'reemplazado' ? 'selected' : '' ?>>Reemplazado</option>
    </select><br><br>

    <button type="submit">💾 Actualizar</button>
    <a href="listar.php">⬅ Volver</a>
</form>

<?php include __DIR__ . '/../includes/footer.php'; ?>
