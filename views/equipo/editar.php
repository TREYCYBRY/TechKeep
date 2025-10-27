<?php
require_once __DIR__ . '/../../models/equipo.php';
require_once __DIR__ . '/../../models/categoria.php';
require_once __DIR__ . '/../../models/ubicacion.php';
require_once __DIR__ . '/../../models/proveedor.php';
require_once __DIR__ . '/../../models/usuario.php';
require_once __DIR__ . '/../../models/area.php';
include __DIR__ . '/../includes/header.php';
define('BASE_URL', 'http://localhost/Soporte/TechKeep/');

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

<!-- Barra de navegaccion -->
   <header class="header">
        <div class="header-left">
            Proyecto de Soporte Operativo
        </div>

        <div class="logo-container">
            <div class="logo-text-top">
                TECH
            </div>
            <div class="logo-text-bottom">
                KEEP
            </div>
        </div>

        <div class="header-right">
            2025
        </div>
    </header>

    <nav class="nav-bar">
        <div class="dropdown">
            <a href="<?= BASE_URL ?>" class="nav-item">INICIO</a>
        </div>
        <div class="dropdown">
            <span class="nav-item">ENTIDADES</span>
            <div class="dropdown-content">
                <a href="<?= BASE_URL ?>views/area/listar.php">Areas</a>
                <a href="<?= BASE_URL ?>views/categoria_equipo/categorias_listar.php">Categorias</a>
                <a href="<?= BASE_URL ?>views/proveedor/proveedores_listar.php">Proveedores</a>
                <a href="<?= BASE_URL ?>views/ubicacion/ubicaciones_listar.php">Ubicaciones</a>
                <a href="<?= BASE_URL ?>views/usuario/listar.php">Usuarios</a>
            </div>
        </div>

        <div class="dropdown">
            <span class="nav-item">GESTION DE ACTIVOS</span>
            <div class="dropdown-content">
                <a href="<?= BASE_URL ?>views/equipo/listar.php">Equipos</a>
                <a href="<?= BASE_URL ?>views/componente/listar.php">Componentes</a>
                <a href="<?= BASE_URL ?>views/tipo_mantenimiento/listar.php">Tipos de mantenimiento</a>
                <a href="<?= BASE_URL ?>views/mantenimiento/listar.php">Mantenimiento</a>
                <a href="<?= BASE_URL ?>views/documento_movimiento/listar.php">Movimiento</a>
            </div>
        </div>

        <div class="dropdown">
            <span class="nav-item">INFORMES</span>
            <div class="dropdown-content">
                <a href="<?= BASE_URL ?>views/reportes/general.php">Reportes</a>
            </div>
        </div>
    </nav>

    <style>
        /* Global Styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        /* Header and Navigation */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 40px;
            background-color: white;
            border-bottom: 1px solid #ddd;
            color: #333;
            font-size: 14px;
        }

        .header-left {
            display: flex;
            align-items: center;
            font-size: 16px;
        }

        .logo-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
        }

        .logo-text-top {
            font-size: 18px;
            font-weight: bold;
            letter-spacing: 5px;
            border: 2px solid black;
            border-bottom: none;
            padding: 2px 5px 0 5px;
            line-height: 1;
        }

        .logo-text-bottom {
            font-size: 8px;
            letter-spacing: 3px;
            margin-top: -1px;
            border: 2px solid black;
            border-top: none;
            padding: 0 5px 2px 5px;
            line-height: 1;
        }

        .nav-bar {
            width: 100%;
            background-color: white;
            display: flex;
            justify-content: center;
            padding: 10px 0;
            border-bottom: 1px solid #ddd;
        }

        /* Dropdown Container Styles */
        .dropdown {
            position: relative; /* Essential for positioning the dropdown content */
            display: inline-block;
            padding: 0 20px; /* Adjusted padding to accommodate the menus */
        }

        /* Nav Item Styles */
        .nav-item {
            text-transform: uppercase;
            font-weight: bold;
            color: #333;
            text-decoration: none;
            font-size: 14px;
            padding: 10px 20px;
            display: block; /* Make it a block element to properly align the dropdown */
            cursor: default; /* Show that it's interactive */
        }

        .nav-item:hover {
            color: #EF7722; /* Optional: highlight on hover */
        }

        /* Dropdown Content Styles (The actual menu) */
        .dropdown-content {
            display: none; /* Initially hide the dropdown content */
            position: absolute;
            background-color: #f9f9f9;
            min-width: 200px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1; /* Ensures the menu appears above other elements */
            top: 100%; /* Position it right below the main item */
            left: 50%;
            transform: translateX(-50%); /* Center the dropdown content under the menu item */
            border-top: 3px solid #EF7722; /* Optional: a little color accent */
        }

        .dropdown-content a {
            color: #333;
            padding: 12px 16px;
            text-decoration: none;
            display: block; /* Each link takes up the full width */
            text-align: left;
            font-weight: normal;
            text-transform: none;
            font-size: 13px;
            white-space: nowrap; /* Prevents options from wrapping */
        }

        .dropdown-content a:hover {
            background-color: #f1f1f1;
            color: #EF7722;
        }

        /* Show the dropdown menu on hover */
        .dropdown:hover .dropdown-content {
            display: block;
        }
    </style>
<!-- Fin Barra de navegaccion -->

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
