<?php
require_once __DIR__ . '/../../models/tipo_mantenimiento.php';
include __DIR__ . '/../includes/header.php';

$model = new TipoMantenimiento();
$tipos = $model->listar();
?>

<h2>🧰 Tipos de Mantenimiento</h2>
<a href="agregar.php">➕ Nuevo tipo</a>
<br><br>

<table border="1" cellpadding="8" cellspacing="0">
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Descripción</th>
        <th>Intervalo (días)</th>
        <th>Acciones</th>
    </tr>

    <?php foreach ($tipos as $t): ?>
    <tr>
        <td><?= $t['id_tipo'] ?></td>
        <td><?= htmlspecialchars($t['nombre']) ?></td>
        <td><?= htmlspecialchars($t['descripcion']) ?></td>
        <td><?= htmlspecialchars($t['intervalo_dias']) ?></td>
        <td>
            <a href="editar.php?id=<?= $t['id_tipo'] ?>">✏️ Editar</a> |
            <a href="../../controllers/tipoMantenimientoController.php?accion=eliminar&id=<?= $t['id_tipo'] ?>"
               onclick="return confirm('¿Seguro de eliminar este tipo de mantenimiento?')">🗑️ Eliminar</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

<?php include __DIR__ . '/../includes/footer.php'; ?>
