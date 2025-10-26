<?php
require_once __DIR__ . '/../../models/mantenimiento.php';
require_once __DIR__ . '/../../models/equipo.php';
require_once __DIR__ . '/../../models/tipo_mantenimiento.php';
require_once __DIR__ . '/../../models/usuario.php';

$mantenimiento = new Mantenimiento();
$id = $_GET['id'] ?? 0;
$m = $mantenimiento->obtener($id);

$equipo = new Equipo();
$equipos = $equipo->listar();

$tipo = new TipoMantenimiento();
$tipos = $tipo->listar();

$usuario = new Usuario();
$tecnicos = $usuario->listarTecnicos();

include __DIR__ . '/../includes/header.php';
?>

<h2>✏️ Editar mantenimiento</h2>

<form action="../../controllers/mantenimientoController.php" method="POST">
    <input type="hidden" name="accion" value="editar">
    <input type="hidden" name="id_mantenimiento" value="<?= $m['id_mantenimiento'] ?>">

    <label>Equipo:</label><br>
    <select name="id_equipo" required>
        <?php foreach ($equipos as $e): ?>
            <option value="<?= $e['id_equipo'] ?>" <?= ($m['id_equipo'] == $e['id_equipo']) ? 'selected' : '' ?>>
                <?= htmlspecialchars($e['nombre']) ?>
            </option>
        <?php endforeach; ?>
    </select><br><br>

    <label>Tipo de mantenimiento:</label><br>
    <select name="id_tipo" required>
        <?php foreach ($tipos as $t): ?>
            <option value="<?= $t['id_tipo'] ?>" <?= ($m['id_tipo'] == $t['id_tipo']) ? 'selected' : '' ?>>
                <?= htmlspecialchars($t['nombre']) ?>
            </option>
        <?php endforeach; ?>
    </select><br><br>

    <label>Técnico:</label><br>
    <select name="id_tecnico">
        <option value="">-- Opcional --</option>
        <?php foreach ($tecnicos as $tec): ?>
            <option value="<?= $tec['id_usuario'] ?>" <?= ($m['id_tecnico'] == $tec['id_usuario']) ? 'selected' : '' ?>>
                <?= htmlspecialchars($tec['nombre_completo']) ?>
            </option>
        <?php endforeach; ?>
    </select><br><br>

    <label>Fecha:</label><br>
    <input type="date" name="fecha" value="<?= htmlspecialchars($m['fecha']) ?>" required><br><br>

    <label>Descripción:</label><br>
    <textarea name="descripcion" rows="3"><?= htmlspecialchars($m['descripcion']) ?></textarea><br><br>

    <label>Acciones realizadas:</label><br>
    <textarea name="acciones_realizadas" rows="3"><?= htmlspecialchars($m['acciones_realizadas']) ?></textarea><br><br>

    <label>Piezas utilizadas:</label><br>
    <textarea name="piezas_utilizadas" rows="3"><?= htmlspecialchars($m['piezas_utilizadas']) ?></textarea><br><br>

    <label>Costo:</label><br>
    <input type="number" name="costo" step="0.01" value="<?= htmlspecialchars($m['costo']) ?>"><br><br>

    <label>Próximo mantenimiento:</label><br>
    <input type="date" name="proximo_mantenimiento" value="<?= htmlspecialchars($m['proximo_mantenimiento']) ?>"><br><br>

    <label>Estado:</label><br>
    <select name="estado">
        <?php
        $estados = ['programado','en_proceso','realizado','cancelado'];
        foreach ($estados as $estado):
        ?>
            <option value="<?= $estado ?>" <?= ($m['estado'] == $estado) ? 'selected' : '' ?>><?= ucfirst($estado) ?></option>
        <?php endforeach; ?>
    </select><br><br>

    <button type="submit">💾 Actualizar</button>
    <a href="listar.php">⬅ Volver</a>
</form>

<?php include __DIR__ . '/../includes/footer.php'; ?>
