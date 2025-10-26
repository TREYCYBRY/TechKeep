<?php
require_once __DIR__ . '/../../models/categoria.php';
$categoria = new CategoriaEquipo();
$lista = $categoria->listar();
include __DIR__ . '/../includes/header.php';
?>

<h2>📋 Categorías registradas</h2>
<a href="categorias_agregar.php" class="btn">➕ Nueva categoría</a>
<br><br>

<table border="1" cellpadding="8" style="border-collapse: collapse;">
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Descripción</th>
        <th>Acciones</th>
    </tr>
    <?php foreach ($lista as $c): ?>
    <tr>
        <td><?= $c['id_categoria'] ?></td>
        <td><?= htmlspecialchars($c['nombre']) ?></td>
        <td><?= htmlspecialchars($c['descripcion']) ?></td>
        <td>
            <a href="categorias_editar.php?id=<?= $c['id_categoria'] ?>">✏️ Editar</a> |
            <a href="../../controllers/categoriaController.php?accion=eliminar&id=<?= $c['id_categoria'] ?>"
               onclick="return confirm('¿Seguro que deseas eliminar esta categoría?')">🗑️ Eliminar</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

<?php include __DIR__ . '/../includes/footer.php'; ?>
