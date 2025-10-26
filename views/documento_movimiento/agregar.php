<?php
require_once __DIR__ . '/../../models/equipo.php';
require_once __DIR__ . '/../../models/usuario.php';
include __DIR__ . '/../includes/header.php';

$equipo = new Equipo();
$equipos = $equipo->listar();

$usuario = new Usuario();
$usuarios = $usuario->listar();
?>

<h2>➕ Registrar movimiento</h2>

<form action="../../controllers/documentoMovimientoController.php" method="POST">
    <input type="hidden" name="accion" value="agregar">

    <label>Equipo:</label><br>
    <select name="id_equipo" required>
        <option value="">-- Seleccione --</option>
        <?php foreach ($equipos as $e): ?>
            <option value="<?= $e['id_equipo'] ?>"><?= htmlspecialchars($e['nombre']) ?></option>
        <?php endforeach; ?>
    </select><br><br>

    <label>Tipo de movimiento:</label><br>
    <select name="tipo_mov" required>
        <option value="">-- Seleccione --</option>
        <option value="entrada">Entrada</option>
        <option value="salida">Salida</option>
        <option value="traslado">Traslado</option>
        <option value="baja">Baja</option>
    </select><br><br>

    <label>Fecha:</label><br>
    <input type="date" name="fecha" required><br><br>

    <label>Descripción:</label><br>
    <textarea name="descripcion" rows="3"></textarea><br><br>

    <label>Realizado por:</label><br>
    <select name="realizado_por">
        <option value="">-- Opcional --</option>
        <?php foreach ($usuarios as $u): ?>
            <option value="<?= $u['id_usuario'] ?>"><?= htmlspecialchars($u['nombres']) ?></option>
        <?php endforeach; ?>
    </select><br><br>

    <label>Destino:</label><br>
    <input type="text" name="destino" maxlength="150"><br><br>

    <button type="submit">💾 Guardar</button>
    <a href="listar.php">⬅ Volver</a>
</form>

<?php include __DIR__ . '/../includes/footer.php'; ?>
