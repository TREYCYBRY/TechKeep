<?php
require_once __DIR__ . '/../../models/equipo.php';
require_once __DIR__ . '/../../models/categoria.php';
require_once __DIR__ . '/../../models/ubicacion.php';
require_once __DIR__ . '/../../models/proveedor.php';
require_once __DIR__ . '/../../models/usuario.php';
require_once __DIR__ . '/../../models/area.php';
include __DIR__ . '/../includes/header.php';

// Obtener ID del equipo desde la URL
$id = $_GET['id'] ?? 0;

// Cargar el equipo
$equipoModel = new Equipo();
$equipo = $equipoModel->obtener($id);

// Cargar datos para los selects
$categoria = new CategoriaEquipo();
$ubicacion = new Ubicacion();
$proveedor = new Proveedor();
$responsable = new Usuario();

$categorias = $categoria->listar();
$ubicaciones = $ubicacion->listar();
$proveedores = $proveedor->listar();
$responsables = $responsable->listarResponsables();
?>

<h2>✏️ Editar equipo</h2>

<form action="../../controllers/equipoController.php" method="POST">
    <input type="hidden" name="accion" value="editar">
    <input type="hidden" name="id_equipo" value="<?= $equipo['id_equipo'] ?>">

    <label><strong>Código:</strong></label><br>
    <input type="text" name="codigo" value="<?= htmlspecialchars($equipo['codigo']) ?>" readonly><br><br>

    <label><strong>Nombre:</strong></label><br>
    <input type="text" name="nombre" value="<?= htmlspecialchars($equipo['nombre']) ?>" required><br><br>

    <label><strong>Marca:</strong></label><br>
    <input type="text" name="marca" value="<?= htmlspecialchars($equipo['marca']) ?>"><br><br>

    <label><strong>Modelo:</strong></label><br>
    <input type="text" name="modelo" value="<?= htmlspecialchars($equipo['modelo']) ?>"><br><br>

    <label><strong>Número de serie:</strong></label><br>
    <input type="text" name="numero_serie" value="<?= htmlspecialchars($equipo['numero_serie']) ?>"><br><br>

    <label><strong>Categoría:</strong></label><br>
    <select name="id_categoria" required>
        <option value="">-- Seleccione --</option>
        <?php foreach ($categorias as $cat): ?>
            <option value="<?= $cat['id_categoria'] ?>" <?= $cat['id_categoria'] == $equipo['id_categoria'] ? 'selected' : '' ?>>
                <?= htmlspecialchars($cat['nombre']) ?>
            </option>
        <?php endforeach; ?>
    </select><br><br>

    <label><strong>Proveedor:</strong></label><br>
    <select name="id_proveedor">
        <option value="">-- Ninguno --</option>
        <?php foreach ($proveedores as $prov): ?>
            <option value="<?= $prov['id_proveedor'] ?>" <?= $prov['id_proveedor'] == $equipo['id_proveedor'] ? 'selected' : '' ?>>
                <?= htmlspecialchars($prov['nombre']) ?>
            </option>
        <?php endforeach; ?>
    </select><br><br>

    <label><strong>Ubicación:</strong></label><br>
    <select name="id_ubicacion">
        <option value="">-- Seleccione --</option>
        <?php foreach ($ubicaciones as $ubi): ?>
            <option value="<?= $ubi['id_ubicacion'] ?>" <?= $ubi['id_ubicacion'] == $equipo['id_ubicacion'] ? 'selected' : '' ?>>
                <?= htmlspecialchars($ubi['nombre']) ?>
            </option>
        <?php endforeach; ?>
    </select><br><br>

    <label><strong>Responsable:</strong></label><br>
    <select name="id_responsable">
        <option value="">-- Seleccione --</option>
        <?php foreach ($responsables as $resp): ?>
            <option value="<?= $resp['id_usuario'] ?>" <?= $resp['id_usuario'] == $equipo['id_responsable'] ? 'selected' : '' ?>>
                <?= htmlspecialchars($resp['nombre_completo']) ?>
            </option>
        <?php endforeach; ?>
    </select><br><br>

    <label><strong>Fecha de adquisición:</strong></label><br>
    <input type="date" name="fecha_adquisicion" value="<?= htmlspecialchars($equipo['fecha_adquisicion']) ?>"><br><br>

    <label><strong>Valor de adquisición:</strong></label><br>
    <input type="number" step="0.01" name="valor_adquisicion" value="<?= htmlspecialchars($equipo['valor_adquisicion']) ?>"><br><br>

    <label><strong>Estado:</strong></label><br>
    <select name="estado" required>
        <option value="operativo" <?= $equipo['estado'] == 'operativo' ? 'selected' : '' ?>>Operativo</option>
        <option value="en_mantenimiento" <?= $equipo['estado'] == 'en_mantenimiento' ? 'selected' : '' ?>>En mantenimiento</option>
        <option value="fuera_de_servicio" <?= $equipo['estado'] == 'fuera_de_servicio' ? 'selected' : '' ?>>Fuera de servicio</option>
        <option value="dado_baja" <?= $equipo['estado'] == 'dado_baja' ? 'selected' : '' ?>>Dado de baja</option>
    </select><br><br>

    <label><strong>Observaciones:</strong></label><br>
    <textarea name="observaciones" rows="3" cols="40"><?= htmlspecialchars($equipo['observaciones']) ?></textarea><br><br>
    
    <label><strong>Fecha de baja:</strong></label><br>
<input type="date" name="fecha_baja" value="<?= htmlspecialchars($equipo['fecha_baja'] ?? '') ?>"><br><br>


    <button type="submit">💾 Actualizar equipo</button>
    <a href="listar.php">⬅ Volver al listado</a>
</form>

<?php include __DIR__ . '/../includes/footer.php'; ?>
