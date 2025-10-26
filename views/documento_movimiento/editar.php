<?php
require_once __DIR__ . '/../../models/documento_movimiento.php';
require_once __DIR__ . '/../../models/equipo.php';
require_once __DIR__ . '/../../models/usuario.php';
include __DIR__ . '/../includes/header.php';

$mov = new DocumentoMovimiento();
$equipo = new Equipo();
$usuario = new Usuario();

$equipos = $equipo->listar();
$usuarios = $usuario->listar();

$id = $_GET['id'] ?? null;
$movimiento = $mov->obtenerPorId($id);
?>

<h2>✏️ Editar movimiento</h2>

<form action="../../controllers/documentoMovimientoController.php" method="POST">
    <input type="hidden" name="accion" value="editar">
    <input type="hidden" name="id_mov" value="<?= $movimiento['id_mov'] ?>">

    <label>Equipo:</label><br>
    <select name="id_equipo" required>
        <?php foreach ($equipos as $e): ?>
            <option value="<?= $e['id_equipo'] ?>" <?= $e['id_equipo'] == $movimiento['id_equipo'] ? 'selected' : '' ?>>
                <?= htmlspecialchars($e['nombre']) ?>
            </option>
        <?php endforeach; ?>
    </select><br><br>

    <label>Tipo de movimiento:</label><br>
    <select name="tipo_mov" required>
        <?php
        $tipos = ['entrada','salida','traslado','baja'];
        foreach ($tipos as $t):
        ?>
            <option value="<?= $t ?>" <?= $t == $movimiento['tipo_mov'] ? 'selected' : '' ?>>
                <?= ucfirst($t) ?>
            </option>
        <?php endforeach; ?>
    </select><br><br>

    <label>Fecha:</label><br>
    <input type="date" name="fecha" value="<?= $movimiento['fecha'] ?>" required><br><br>

    <label>Descripción:</label><br>
    <textarea name="descripcion" rows="3"><?= htmlspecialchars($movimiento['descripcion']) ?></textarea><br><br>

    <label>Realizado por:</label><br>
    <select name="realizado_por">
        <option value="">-- Opcional --</option>
        <?php foreach ($usuarios as $u): ?>
            <option value="<?= $u['id_usuario'] ?>" <?= $u['id_usuario'] == $movimiento['realizado_por'] ? 'selected' : '' ?>>
                <?= htmlspecialchars($u['nombres']) ?>
            </option>
        <?php endforeach; ?>
    </select><br><br>

    <label>Destino:</label><br>
    <input type="text" name="destino" value="<?= htmlspecialchars($movimiento['destino']) ?>"><br><br>

    <button type="submit">💾 Guardar cambios</button>
    <a href="listar.php">⬅ Volver</a>
</form>

<?php include __DIR__ . '/../includes/footer.php'; ?>
