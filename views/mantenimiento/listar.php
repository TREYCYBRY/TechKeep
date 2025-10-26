<?php
require_once __DIR__ . '/../../models/mantenimiento.php';
$mantenimiento = new Mantenimiento();
$lista = $mantenimiento->listar();

include __DIR__ . '/../includes/header.php';
?>

<h2>🧰 Lista de Mantenimientos</h2>
<a href="agregar.php">➕ Nuevo Mantenimiento</a><br><br>

<table border="1" cellpadding="6">
    <thead>
        <tr>
            <th>ID</th>
            <th>Equipo</th>
            <th>Tipo</th>
            <th>Técnico</th>
            <th>Fecha</th>
            <th>Costo</th>
            <th>Estado</th>
            <th>Próximo</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($lista as $m): ?>
            <tr>
                <td><?= htmlspecialchars($m['id_mantenimiento']) ?></td>
                <td><?= htmlspecialchars($m['equipo']) ?></td>
                <td><?= htmlspecialchars($m['tipo_mantenimiento']) ?></td>
                <td><?= htmlspecialchars($m['tecnico'] ?? '—') ?></td>
                <td><?= htmlspecialchars($m['fecha']) ?></td>
                <td><?= htmlspecialchars(number_format($m['costo'], 2)) ?></td>
                <td><?= htmlspecialchars($m['estado']) ?></td>
                <td><?= htmlspecialchars($m['proximo_mantenimiento'] ?? '—') ?></td>
                <td>
                    <a href="editar.php?id=<?= $m['id_mantenimiento'] ?>">✏️ Editar</a> |
                    <a href="../../controllers/mantenimientoController.php?accion=eliminar&id=<?= $m['id_mantenimiento'] ?>" 
                       onclick="return confirm('¿Seguro de eliminar este mantenimiento?')">🗑 Eliminar</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php include __DIR__ . '/../includes/footer.php'; ?>
