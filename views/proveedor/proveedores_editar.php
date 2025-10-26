<?php
require_once __DIR__ . '/../../models/Proveedor.php';
$proveedor = new Proveedor();
$id = $_GET['id'] ?? 0;
$p = $proveedor->obtener($id);
include __DIR__ . '/../includes/header.php';
?>

<h2>✏️ Editar proveedor</h2>

<form action="../../controllers/proveedorController.php" method="POST">
    <input type="hidden" name="accion" value="editar">
    <input type="hidden" name="id_proveedor" value="<?= $p['id_proveedor'] ?>">

    <label>Nombre:</label><br>
    <input type="text" name="nombre" value="<?= htmlspecialchars($p['nombre']) ?>" required><br><br>

    <label>Contacto:</label><br>
    <input type="text" name="contacto" value="<?= htmlspecialchars($p['contacto']) ?>"><br><br>

    <label>Teléfono:</label><br>
    <input type="text" name="telefono" value="<?= htmlspecialchars($p['telefono']) ?>"><br><br>

    <label>Correo:</label><br>
    <input type="email" name="correo" value="<?= htmlspecialchars($p['correo']) ?>"><br><br>

    <label>Dirección:</label><br>
    <textarea name="direccion" rows="3"><?= htmlspecialchars($p['direccion']) ?></textarea><br><br>

    <button type="submit">💾 Actualizar</button>
    <a href="proveedores_listar.php">⬅ Volver</a>
</form>

<?php include __DIR__ . '/../includes/footer.php'; ?>
