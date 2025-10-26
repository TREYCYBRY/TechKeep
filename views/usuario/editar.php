<?php
require_once __DIR__ . '/../../models/Usuario.php';
include __DIR__ . '/../includes/header.php';

// Obtener el ID por GET
$id = $_GET['id'] ?? null;

if (!$id) {
    echo "<p>Error: no se especificó un usuario.</p>";
    include __DIR__ . '/../includes/footer.php';
    exit;
}

$usuarioModel = new Usuario();
$usuario = $usuarioModel->obtener($id);

if (!$usuario) {
    echo "<p>Usuario no encontrado.</p>";
    include __DIR__ . '/../includes/footer.php';
    exit;
}
?>

<h2>✏️ Editar Usuario</h2>

<form action="../../controllers/usuarioController.php" method="POST">
    <input type="hidden" name="accion" value="editar">
    <input type="hidden" name="id_usuario" value="<?= htmlspecialchars($usuario['id_usuario']) ?>">

    <label>Nombres:</label><br>
    <input type="text" name="nombres" value="<?= htmlspecialchars($usuario['nombres']) ?>" required><br><br>

    <label>Apellidos:</label><br>
    <input type="text" name="apellidos" value="<?= htmlspecialchars($usuario['apellidos']) ?>" required><br><br>

    <label>Rol:</label><br>
    <select name="rol" required>
        <option value="administrador" <?= $usuario['rol'] === 'administrador' ? 'selected' : '' ?>>Administrador</option>
        <option value="tecnico" <?= $usuario['rol'] === 'tecnico' ? 'selected' : '' ?>>Técnico</option>
        <option value="responsable" <?= $usuario['rol'] === 'responsable' ? 'selected' : '' ?>>Responsable</option>
    </select><br><br>

    <label>Teléfono:</label><br>
    <input type="text" name="telefono" value="<?= htmlspecialchars($usuario['telefono']) ?>"><br><br>

    <label>Correo:</label><br>
    <input type="email" name="correo" value="<?= htmlspecialchars($usuario['correo']) ?>" required><br><br>

    <label>Activo:</label>
    <input type="checkbox" name="activo" <?= $usuario['activo'] ? 'checked' : '' ?>><br><br>

    <button type="submit">💾 Guardar Cambios</button>
    <a href="listar.php">⬅ Volver al listado</a>
</form>

<?php include __DIR__ . '/../includes/footer.php'; ?>
