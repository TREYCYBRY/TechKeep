<?php
require_once __DIR__ . '/../../models/equipo.php';
require_once __DIR__ . '/../../models/categoria.php';
require_once __DIR__ . '/../../models/ubicacion.php';
require_once __DIR__ . '/../../models/proveedor.php';
require_once __DIR__ . '/../../models/usuario.php';
require_once __DIR__ . '/../../models/area.php';

include __DIR__ . '/../includes/header.php';

// Instanciamos modelos auxiliares para llenar los select
$categoria = new CategoriaEquipo();
$ubicacion = new ubicacion();
$proveedor = new proveedor();
$responsable = new usuario();

$categorias = $categoria->listar();
$ubicaciones = $ubicacion->listar();
$proveedores = $proveedor->listar();
$responsables = $responsable->listarResponsables();
?>

<h2>Registrar nuevo equipo</h2>

<form action="../../controllers/equipoController.php?accion=agregar" method="POST">

    <label><strong>Código:</strong></label><br>
    <input type="text" name="codigo" required><br><br>

    <label><strong>Nombre:</strong></label><br>
    <input type="text" name="nombre" required><br><br>

    <label><strong>Marca:</strong></label><br>
    <input type="text" name="marca"><br><br>

    <label><strong>Modelo:</strong></label><br>
    <input type="text" name="modelo"><br><br>

    <label><strong>Número de serie:</strong></label><br>
    <input type="text" name="numero_serie"><br><br>

    <label><strong>Categoría:</strong></label><br>
    <select name="id_categoria" required>
        <option value="">-- Seleccione --</option>
        <?php foreach ($categorias as $cat): ?>
            <option value="<?= $cat['id_categoria'] ?>"><?= htmlspecialchars($cat['nombre']) ?></option>
        <?php endforeach; ?>
    </select><br><br>

    <label><strong>Proveedor:</strong></label><br>
    <select name="id_proveedor">
        <option value="">-- Ninguno --</option>
        <?php foreach ($proveedores as $prov): ?>
            <option value="<?= $prov['id_proveedor'] ?>"><?= htmlspecialchars($prov['nombre']) ?></option>
        <?php endforeach; ?>
    </select><br><br>

    <label><strong>Ubicación:</strong></label><br>
    <select name="id_ubicacion">
        <option value="">-- Seleccione --</option>
        <?php foreach ($ubicaciones as $ubi): ?>
            <option value="<?= $ubi['id_ubicacion'] ?>"><?= htmlspecialchars($ubi['nombre']) ?></option>
        <?php endforeach; ?>
    </select><br><br>

    <label><strong>Responsable:</strong></label><br>
    <select name="id_responsable">
        <option value="">-- Seleccione --</option>
        <?php foreach ($responsables as $resp): ?>
            <option value="<?= $resp['id_usuario'] ?>"><?= htmlspecialchars($resp['nombre_completo']) ?></option>
        <?php endforeach; ?>
    </select><br><br>

    <label><strong>Fecha de adquisición:</strong></label><br>
    <input type="date" name="fecha_adquisicion"><br><br>

    <label><strong>Valor de adquisición:</strong></label><br>
    <input type="number" step="0.01" name="valor_adquisicion"><br><br>

    <label><strong>Estado:</strong></label><br>
    <select name="estado" required>
        <option value="operativo">Operativo</option>
        <option value="en_mantenimiento">En mantenimiento</option>
        <option value="fuera_de_servicio">Fuera de servicio</option>
        <option value="dado_baja">Dado de baja</option>
    </select><br><br>

    <label><strong>Observaciones:</strong></label><br>
    <textarea name="observaciones" rows="3" cols="40"></textarea><br><br>

    <button type="submit">💾 Guardar equipo</button>
    <a href="listar.php">⬅ Volver al listado</a>
</form>

<?php include __DIR__ . '/../includes/footer.php'; ?>
