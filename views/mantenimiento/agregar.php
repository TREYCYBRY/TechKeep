<?php
require_once __DIR__ . '/../../models/mantenimiento.php';
require_once __DIR__ . '/../../models/equipo.php';
require_once __DIR__ . '/../../models/tipo_mantenimiento.php';
require_once __DIR__ . '/../../models/usuario.php';

$equipo = new Equipo();
$equipos = $equipo->listar();

$tipo = new TipoMantenimiento();
$tipos = $tipo->listar();

$usuario = new Usuario();
$tecnicos = $usuario->listarTecnicos();

include __DIR__ . '/../includes/header.php';
?>

<h2>➕ Registrar nuevo mantenimiento</h2>

<form action="../../controllers/mantenimientoController.php" method="POST">
    <input type="hidden" name="accion" value="agregar">

    <label>Equipo:</label><br>
    <select name="id_equipo" required>
        <option value="">-- Seleccione equipo --</option>
        <?php foreach ($equipos as $e): ?>
            <option value="<?= $e['id_equipo'] ?>"><?= htmlspecialchars($e['nombre']) ?></option>
        <?php endforeach; ?>
    </select><br><br>

    <label>Tipo de mantenimiento:</label><br>
    <select name="id_tipo" required>
        <option value="">-- Seleccione tipo --</option>
        <?php foreach ($tipos as $t): ?>
            <option value="<?= $t['id_tipo'] ?>"><?= htmlspecialchars($t['nombre']) ?></option>
        <?php endforeach; ?>
    </select><br><br>

    <label>Técnico:</label><br>
    <select name="id_tecnico">
        <option value="">-- Opcional --</option>
        <?php foreach ($tecnicos as $tec): ?>
            <option value="<?= $tec['id_usuario'] ?>"><?= htmlspecialchars($tec['nombre_completo']) ?></option>
        <?php endforeach; ?>
    </select><br><br>

    <label>Fecha:</label><br>
    <input type="date" name="fecha" required><br><br>

    <label>Descripción:</label><br>
    <textarea name="descripcion" rows="3"></textarea><br><br>

    <label>Acciones realizadas:</label><br>
    <textarea name="acciones_realizadas" rows="3"></textarea><br><br>

    <label>Piezas utilizadas:</label><br>
    <textarea name="piezas_utilizadas" rows="3"></textarea><br><br>

    <label>Costo:</label><br>
    <input type="number" name="costo" step="0.01" value="0.00"><br><br>

    <label>Próximo mantenimiento:</label><br>
    <input type="date" name="proximo_mantenimiento"><br><br>

    <label>Estado:</label><br>
    <select name="estado">
        <option value="programado">Programado</option>
        <option value="en_proceso">En proceso</option>
        <option value="realizado" selected>Realizado</option>
        <option value="cancelado">Cancelado</option>
    </select><br><br>

    <button type="submit">💾 Guardar</button>
    <a href="listar.php">⬅ Volver</a>
</form>

<?php include __DIR__ . '/../includes/footer.php'; ?>
