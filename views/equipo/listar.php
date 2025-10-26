<?php
require_once __DIR__ . '/../../models/equipo.php';  // ✅ Ruta correcta hacia models
include __DIR__ . '/../includes/header.php';        // ✅ Ajustado el include

$equipo = new Equipo();
$lista = $equipo->listar();
?>

<h2>Equipos registrados</h2>
<a href="agregar.php" class="btn">➕ Nuevo equipo</a>

<table border="1" cellpadding="6">
    <tr>
        <th>ID</th>
        <th>Código</th>
        <th>Nombre</th>
        <th>Marca</th>
        <th>Modelo</th>
        <th>Estado</th>
        <th>Categoría</th>
        <th>Ubicación</th>
        <th>Fecha de baja</th>
        <th>Acciones</th>
    </tr>
    <?php foreach ($lista as $e): ?>
    <tr>
        <td><?= htmlspecialchars($e['id_equipo']) ?></td>
        <td><?= htmlspecialchars($e['codigo']) ?></td>
        <td><?= htmlspecialchars($e['nombre']) ?></td>
        <td><?= htmlspecialchars($e['marca']) ?></td>
        <td><?= htmlspecialchars($e['modelo']) ?></td>
        <td><?= htmlspecialchars($e['estado']) ?></td>
        <td><?= htmlspecialchars($e['categoria']) ?></td>
        <td><?= htmlspecialchars($e['ubicacion']) ?></td>
        <td><?= htmlspecialchars($e['fecha_baja']?? '---') ?></td>
        <td>
            <a href="editar.php?id=<?= urlencode($e['id_equipo']) ?>">Editar</a> |
            <a href="../../controllers/equipoController.php?accion=eliminar&id=<?= urlencode($e['id_equipo']) ?>"
               onclick="return confirm('¿Eliminar este equipo?')">Eliminar</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

<?php include __DIR__ . '/../includes/footer.php'; ?>
