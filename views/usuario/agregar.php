<?php include __DIR__ . '/../includes/header.php'; ?>

<h2>Registrar nuevo usuario</h2>

<form action="../../controllers/usuarioController.php" method="POST">
    <input type="hidden" name="accion" value="agregar">

    <label>Nombres:</label><br>
    <input type="text" name="nombres" required><br><br>

    <label>Apellidos:</label><br>
    <input type="text" name="apellidos" required><br><br>

    <label>Rol:</label><br>
    <select name="rol" required>
        <option value="administrador">Administrador</option>
        <option value="tecnico">Técnico</option>
        <option value="responsable" selected>Responsable</option>
    </select><br><br>

    <label>Teléfono:</label><br>
    <input type="text" name="telefono"><br><br>

    <label>Correo:</label><br>
    <input type="email" name="correo" required><br><br>

    <label>Activo:</label>
    <input type="checkbox" name="activo" checked><br><br>

    <button type="submit">💾 Guardar Usuario</button>
    <a href="listar.php">⬅ Volver al listado</a>
</form>

<?php include __DIR__ . '/../includes/footer.php'; ?>
