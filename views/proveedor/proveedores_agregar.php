<?php include __DIR__ . '/../includes/header.php'; ?>

<h2>➕ Registrar nuevo proveedor</h2>

<form action="../../controllers/proveedorController.php" method="POST">
    <input type="hidden" name="accion" value="agregar">

    <label>Nombre:</label><br>
    <input type="text" name="nombre" required><br><br>

    <label>Contacto:</label><br>
    <input type="text" name="contacto"><br><br>

    <label>Teléfono:</label><br>
    <input type="text" name="telefono"><br><br>

    <label>Correo:</label><br>
    <input type="email" name="correo"><br><br>

    <label>Dirección:</label><br>
    <textarea name="direccion" rows="3"></textarea><br><br>

    <button type="submit">💾 Guardar</button>
    <a href="proveedores_listar.php">⬅ Volver</a>
</form>

<?php include __DIR__ . '/../includes/footer.php'; ?>
