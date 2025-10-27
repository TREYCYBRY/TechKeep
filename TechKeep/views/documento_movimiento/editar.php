<?php
require_once __DIR__ . '/../../models/documento_movimiento.php';
require_once __DIR__ . '/../../models/equipo.php';
require_once __DIR__ . '/../../models/usuario.php';
include __DIR__ . '/../includes/header.php';
define('BASE_URL', 'http://localhost/Soporte/TechKeep/');

$mov = new DocumentoMovimiento();
$equipo = new Equipo();
$usuario = new Usuario();

$equipos = $equipo->listar();
$usuarios = $usuario->listar();

$id = $_GET['id'] ?? null;
$movimiento = $mov->obtenerPorId($id);
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

<h2>✏️ Editar movimiento</h2>

<form action="../../controllers/documentoMovimientoController.php" method="POST">
    <input type="hidden" name="accion" value="editar">
    <input type="hidden" name="id_mov" value="<?= $movimiento['id_mov'] ?>">

    <label>Equipo:</label><br>
    <select name="id_equipo" required>
        <?php foreach ($equipos as $e): ?>
            <option value="<?= $e['id_equipo'] ?>" <?= $e['id_equipo'] == $movimiento['id_equipo'] ? 'selected' : '' ?>>
                <?= htmlspecialchars($e['nombre']) ?>
            </option>
        <?php endforeach; ?>
    </select><br><br>

    <label>Tipo de movimiento:</label><br>
    <select name="tipo_mov" required>
        <?php
        $tipos = ['entrada','salida','traslado','baja'];
        foreach ($tipos as $t):
        ?>
            <option value="<?= $t ?>" <?= $t == $movimiento['tipo_mov'] ? 'selected' : '' ?>>
                <?= ucfirst($t) ?>
            </option>
        <?php endforeach; ?>
    </select><br><br>

    <label>Fecha:</label><br>
    <input type="date" name="fecha" value="<?= $movimiento['fecha'] ?>" required><br><br>

    <label>Descripción:</label><br>
    <textarea name="descripcion" rows="3"><?= htmlspecialchars($movimiento['descripcion']) ?></textarea><br><br>

    <label>Realizado por:</label><br>
    <select name="realizado_por">
        <option value="">-- Opcional --</option>
        <?php foreach ($usuarios as $u): ?>
            <option value="<?= $u['id_usuario'] ?>" <?= $u['id_usuario'] == $movimiento['realizado_por'] ? 'selected' : '' ?>>
                <?= htmlspecialchars($u['nombres']) ?>
            </option>
        <?php endforeach; ?>
    </select><br><br>

    <label>Destino:</label><br>
    <input type="text" name="destino" value="<?= htmlspecialchars($movimiento['destino']) ?>"><br><br>

    <button type="submit">💾 Guardar cambios</button>
    <a href="listar.php">⬅ Volver</a>
</form>

<?php include __DIR__ . '/../includes/footer.php'; ?>
