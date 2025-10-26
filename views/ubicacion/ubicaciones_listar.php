<?php
require_once __DIR__ . '/../../models/ubicacion.php';
$ubicacion = new ubicacion();
$lista = $ubicacion->listar();

include __DIR__ . '/../includes/header.php';
?>

<h2>📍 Ubicaciones registradas</h2>
<a href="ubicaciones_agregar.php" class="btn">➕ Nueva ubicación</a>
<br><br>

<table border="1" cellpadding="8" style="border-collapse: collapse;">
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Descripción</th>
        <th>Piso</th>
        <th>Área</th>
        <th>Acciones</th>
    </tr>

    <?php foreach ($lista as $u): ?>
    <tr>
        <td><?= $u['id_ubicacion'] ?></td>
        <td><?= htmlspecialchars($u['nombre']) ?></td>
        <td><?= htmlspecialchars($u['descripcion'] ?? '—') ?></td>
        <td><?= htmlspecialchars($u['piso'] ?? '—') ?></td>
        <td><?= htmlspecialchars($u['area'] ?? 'Sin asignar') ?></td>
        <td>
            <a href="ubicaciones_editar.php?id=<?= $u['id_ubicacion'] ?>">✏️ Editar</a> |
            <a href="../../controllers/ubicacionController.php?accion=eliminar&id=<?= $u['id_ubicacion'] ?>" 
               onclick="return confirm('¿Seguro que deseas eliminar esta ubicación?')">🗑️ Eliminar</a>
        </td>
    </tr>
    <?php endforeach; ?>

</table>

<?php include __DIR__ . '/../includes/footer.php'; ?>
