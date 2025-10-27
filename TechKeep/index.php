<?php
// ============================================
// index.php — Panel principal del sistema
// ============================================

require_once __DIR__ . '/config/Conexion.php';
define('BASE_URL', 'http://localhost/Soporte/TechKeep/');

// (Opcional) Comprobar conexión
try {
    $conexion = new Conexion();
    $conn = $conexion->iniciar();
} catch (Exception $e) {
    die("<h3>Error de conexión a la base de datos:</h3> " . $e->getMessage());
}

include __DIR__ . '/views/includes/header.php';
?>
<!--
<div class="container" style="text-align:center; padding:30px;">
    <h1>📦 Sistema de Inventario y Mantenimiento</h1>
    <p>Gestión centralizada de equipos, componentes, mantenimientos y documentos.</p>

    <hr style="margin: 20px 0;">

    <div class="menu-grid" style="display:grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap:20px;">

        <a href="views/area/listar.php" class="menu-card">
            🏢 <strong>Áreas</strong>
            <p>Gestione las áreas y responsables de su institución.</p>
        </a>

        <a href="views/categoria_equipo/categorias_listar.php" class="menu-card">
            🧩 <strong>Categorías</strong>
            <p>Organice los tipos de equipos (computadoras, routers, impresoras...)</p>
        </a>

        <a href="views/proveedor/proveedores_listar.php" class="menu-card">
            🏭 <strong>Proveedores</strong>
            <p>Gestione los proveedores y contactos de compra.</p>
        </a>

        <a href="views/ubicacion/ubicaciones_listar.php" class="menu-card">
            📍 <strong>Ubicaciones</strong>
            <p>Administre los lugares donde se encuentran los equipos.</p>
        </a>

        <a href="views/usuario/listar.php" class="menu-card">
            👤 <strong>Usuarios</strong>
            <p>Administre técnicos, responsables y administradores.</p>
        </a>

        <a href="views/equipo/listar.php" class="menu-card">
            💻 <strong>Equipos</strong>
            <p>Registre, edite o dé de baja los equipos.</p>
        </a>

        <a href="views/componente/listar.php" class="menu-card">
            ⚙️ <strong>Componentes</strong>
            <p>Controle los componentes asociados a cada equipo.</p>
        </a>

        <a href="views/tipo_mantenimiento/listar.php" class="menu-card">
            🧰 <strong>Tipos de mantenimiento</strong>
            <p>Defina las rutinas o tipos de mantenimiento.</p>
        </a>

        <a href="views/mantenimiento/listar.php" class="menu-card">
            🔧 <strong>Mantenimientos</strong>
            <p>Registre y supervise los mantenimientos realizados.</p>
        </a>

        <a href="views/documento_movimiento/listar.php" class="menu-card">
            📄 <strong>Movimientos</strong>
            <p>Gestione entradas, salidas, traslados o bajas de equipos.</p>
        </a>

        <a href="views/reportes/general.php" class="menu-card">
            📊 <strong>Reportes</strong>
            <p>Visualice el reporte general de mantenimientos.</p>
        </a>
    </div>

    <hr style="margin: 30px 0;">
    <footer>
        <p>© <?= date('Y') ?> Sistema de Inventario — Desarrollado con PHP & MySQL</p>
    </footer>
</div>

<style>
body {
    background-color: #f9f9f9;
    font-family: Arial, sans-serif;
}
.menu-card {
    display: block;
    background: #fff;
    border-radius: 10px;
    padding: 20px;
    text-decoration: none;
    color: #333;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    transition: all 0.2s ease;
}
.menu-card:hover {
    background: #0078d7;
    color: #fff;
    transform: translateY(-3px);
}
.menu-card p {
    font-size: 14px;
    margin-top: 8px;
}
</style>
-->
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

    <div class="main-content">
        <img src="img3.jpg" class="main-image">
    <div class="image-overlay"></div>
    </div>

    <footer>
        <p>© 2025 Sistema de Inventario — Desarrollado con PHP & MySQL</p>
    </footer>

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

        /* Main Content - Image and Overlay */
        .main-content {
            position: relative;
            width: 100%;
            padding-top: 56.25%;
            overflow: hidden;
        }

        .main-image {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* New Overlay Styles */
        .image-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.4); /* Negro con 40% de opacidad */
            z-index: 0; /* Asegura que el overlay esté encima de la imagen pero debajo de cualquier texto que pudieras añadir */
        }

        /* Footer Styles (Nuevos) */
        footer {
            background-color: #ffffffff;
            color: #000000ff;
            text-align: center;
            padding: 15px 0;
            font-size: 12px;
            border-top: 3px solid #EF7722; /* Un detalle para conectar con el estilo de la navegación */
            width: 100%;
            margin-top: auto; /* Empuja el footer hacia el final de la página (gracias a flexbox) */
        }

        footer p {
            margin: 0;
            font-weight: 300;
        }

    </style>

<?php include __DIR__ . '/views/includes/footer.php'; ?>
