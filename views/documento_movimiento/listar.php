<?php
require_once __DIR__ . '/../../models/documento_movimiento.php';
$mov = new DocumentoMovimiento();
$movimientos = $mov->listar();
include __DIR__ . '/../includes/header.php';
?>

<h2>📄 Registro de movimientos de equipos</h2>
<a href="agregar.php">➕ Nuevo movimiento</a>
<table border="1" cellpadding="8" cellspacing="0">
    <tr>
        <th>ID</th>
        <th>Equipo</th>
        <th>Tipo</th>
        <th>Fecha</th>
        <th>Descripción</th>
        <th>Realizado por</th>
        <th>Destino</th>
        <th>Acciones</th>
    </tr>

    <?php foreach ($movimientos as $m): ?>
        <tr>
            <td><?= $m['id_mov'] ?></td>
            <td><?= htmlspecialchars($m['equipo']) ?></td>
            <td><?= htmlspecialchars($m['tipo_mov']) ?></td>
            <td><?= htmlspecialchars($m['fecha']) ?></td>
            <td><?= htmlspecialchars($m['descripcion']) ?></td>
            <td><?= htmlspecialchars($m['realizado_por']) ?></td>
            <td><?= htmlspecialchars($m['destino']) ?></td>
            <td>
                <a href="editar.php?id=<?= $m['id_mov'] ?>">✏️ Editar</a> |
                <a href="../../controllers/documentoMovimientoController.php?accion=eliminar&id=<?= $m['id_mov'] ?>"
                   onclick="return confirm('¿Eliminar este movimiento?')">🗑️ Eliminar</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<?php include __DIR__ . '/../includes/footer.php'; ?>
