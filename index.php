<?php
// ============================================
// index.php — Panel principal del sistema
// ============================================

require_once __DIR__ . '/config/Conexion.php';

// (Opcional) Comprobar conexión
try {
    $conexion = new Conexion();
    $conn = $conexion->iniciar();
} catch (Exception $e) {
    die("<h3>Error de conexión a la base de datos:</h3> " . $e->getMessage());
}

include __DIR__ . '/views/includes/header.php';
?>

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

<?php include __DIR__ . '/views/includes/footer.php'; ?>
