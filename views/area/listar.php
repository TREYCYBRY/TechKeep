<?php
require_once __DIR__ . '/../../models/Area.php';
$area = new Area();
$lista = $area->listar();
include __DIR__ . '/../includes/header.php';
?>

<h2>Áreas registradas</h2>
<a href="agregar.php">➕ Nueva área</a><br><br>

<table border="1" cellpadding="8">
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Responsable</th>
        <th>Acciones</th>
    </tr>
    <?php foreach ($lista as $a): ?>
    <tr>
        <td><?= $a['id_area'] ?></td>
        <td><?= htmlspecialchars($a['nombre_area']) ?></td>
         <td><?= htmlspecialchars($a['responsable'] ?? '—') ?></td>
        <td>
            <a href="editar.php?id=<?= $a['id_area'] ?>">✏️ Editar</a> |
            <a href="../../controllers/areaController.php?accion=eliminar&id=<?= $a['id_area'] ?>" onclick="return confirm('¿Eliminar área?')">🗑 Eliminar</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

<?php include __DIR__ . '/../includes/footer.php'; ?>
