<?php include __DIR__ . '/../includes/header.php'; ?>

<h2>➕ Nuevo Tipo de Mantenimiento</h2>

<form action="../../controllers/tipoMantenimientoController.php" method="POST">
    <input type="hidden" name="accion" value="agregar">

    <label>Nombre:</label><br>
    <input type="text" name="nombre" required><br><br>

    <label>Descripción:</label><br>
    <textarea name="descripcion" rows="3" cols="40"></textarea><br><br>

    <label>Intervalo (días):</label><br>
    <input type="number" name="intervalo_dias" min="0"><br><br>

    <button type="submit">💾 Guardar</button>
    <a href="listar.php">⬅ Volver</a>
</form>

<?php include __DIR__ . '/../includes/footer.php'; ?>
