<?php
require_once __DIR__ . '/../../models/componente.php';
require_once __DIR__ . '/../../models/equipo.php';
include __DIR__ . '/../includes/header.php';

$model = new Componente();
$componentes = $model->listar();
?>

<h2>🧩 Listado de Componentes</h2>
<a href="agregar.php">➕ Agregar componente</a>
<br><br>

<table border="1" cellpadding="8" cellspacing="0">
    <tr>
        <th>ID</th>
        <th>Equipo</th>
        <th>Tipo</th>
        <th>Marca</th>
        <th>Modelo</th>
        <th>N° Serie</th>
        <th>Fecha instalación</th>
        <th>Estado</th>
        <th>Acciones</th>
    </tr>

    <?php foreach ($componentes as $c): ?>
    <tr>
        <td><?= $c['id_componente'] ?></td>
        <td><?= htmlspecialchars($c['equipo_nombre']) ?></td>
        <td><?= htmlspecialchars($c['tipo']) ?></td>
        <td><?= htmlspecialchars($c['marca']) ?></td>
        <td><?= htmlspecialchars($c['modelo']) ?></td>
        <td><?= htmlspecialchars($c['numero_serie']) ?></td>
        <td><?= htmlspecialchars($c['fecha_instalacion']) ?></td>
        <td><?= htmlspecialchars($c['estado']) ?></td>
        <td>
            <a href="editar.php?id=<?= $c['id_componente'] ?>">✏️ Editar</a> |
            <a href="../../controllers/componenteController.php?accion=eliminar&id=<?= $c['id_componente'] ?>" 
               onclick="return confirm('¿Seguro de eliminar este componente?')">🗑️ Eliminar</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

<?php include __DIR__ . '/../includes/footer.php'; ?>
