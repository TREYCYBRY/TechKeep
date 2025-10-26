<?php
require_once __DIR__ . '/../../models/Proveedor.php';
$proveedor = new Proveedor();
$lista = $proveedor->listar();
include __DIR__ . '/../includes/header.php';
?>

<h2>📦 Lista de Proveedores</h2>
<a href="proveedores_agregar.php" class="btn">➕ Nuevo proveedor</a>
<br><br>

<table border="1" cellpadding="8" style="border-collapse: collapse;">
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Contacto</th>
        <th>Teléfono</th>
        <th>Correo</th>
        <th>Dirección</th>
        <th>Acciones</th>
    </tr>
    <?php foreach ($lista as $p): ?>
    <tr>
        <td><?= $p['id_proveedor'] ?></td>
        <td><?= htmlspecialchars($p['nombre']) ?></td>
        <td><?= htmlspecialchars($p['contacto']) ?></td>
        <td><?= htmlspecialchars($p['telefono']) ?></td>
        <td><?= htmlspecialchars($p['correo']) ?></td>
        <td><?= htmlspecialchars($p['direccion']) ?></td>
        <td>
            <a href="proveedores_editar.php?id=<?= $p['id_proveedor'] ?>">✏️ Editar</a> |
            <a href="../../controllers/proveedorController.php?accion=eliminar&id=<?= $p['id_proveedor'] ?>"
               onclick="return confirm('¿Eliminar este proveedor?')">🗑️ Eliminar</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

<?php include __DIR__ . '/../includes/footer.php'; ?>
