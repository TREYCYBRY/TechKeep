<?php
require_once __DIR__ . '/../../models/Usuario.php';
include __DIR__ . '/../includes/header.php';

$usuario = new Usuario();
$usuarios = $usuario->listar();
?>

<h2>Listado de Usuarios</h2>
<a href="agregar.php">➕ Agregar Usuario</a>
<br><br>

<table border="1" cellpadding="8">
    <tr>
        <th>ID</th>
        <th>Nombres</th>
        <th>Apellidos</th>
        <th>Rol</th>
        <th>Teléfono</th>
        <th>Correo</th>
        <th>Activo</th>
        <th>Acciones</th>
    </tr>

    <?php foreach ($usuarios as $u): ?>
    <tr>
        <td><?= $u['id_usuario'] ?></td>
        <td><?= htmlspecialchars($u['nombres']) ?></td>
        <td><?= htmlspecialchars($u['apellidos']) ?></td>
        <td><?= ucfirst($u['rol']) ?></td>
        <td><?= htmlspecialchars($u['telefono']) ?></td>
        <td><?= htmlspecialchars($u['correo']) ?></td>
        <td><?= $u['activo'] ? '✅' : '❌' ?></td>
        

        <td>
            <a href="editar.php?id=<?= $u['id_usuario'] ?>">✏️ Editar</a> |
            <form action="../../controllers/usuarioController.php" method="POST" style="display:inline;">
                <input type="hidden" name="accion" value="eliminar">
                <input type="hidden" name="id_usuario" value="<?= $u['id_usuario'] ?>">
                <button type="submit" onclick="return confirm('¿Eliminar este usuario?')">🗑 Eliminar</button>
            </form>
        </td>

        
    </tr>
    <?php endforeach; ?>
</table>

<?php include __DIR__ . '/../includes/footer.php'; ?>
