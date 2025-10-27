<?php
require_once '../../config/Conexion.php';
define('BASE_URL', 'http://localhost/Soporte/TechKeep/');

try {
    $conexion = new Conexion();
    $conn = $conexion->iniciar();

    // Consulta a la vista
    $sql = "SELECT * FROM reporte_general_mantenimiento";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $reportes = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    die("Error al cargar el reporte: " . $e->getMessage());
}

include '../includes/header.php';
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

<div class="container mt-4">
    <h2 class="text-center mb-4">Reporte General de Mantenimientos</h2>

    <div class="text-end mb-3">
        <button onclick="exportarExcel()" class="btn btn-success">Exportar a Excel</button>
    </div>

    <div class="table-responsive">
        <table id="tablaReporte" class="table table-striped table-bordered align-middle">
            <thead class="table-dark text-center">
                <tr>
                    <th>Código Equipo</th>
                    <th>Nombre Equipo</th>
                    <th>Categoría</th>
                    <th>Fecha</th>
                    <th>Tipo Mantenimiento</th>
                    <th>Técnico</th>
                    <th>Costo (S/)</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $total = 0;
                foreach ($reportes as $r):
                    $total += $r['costo'];
                ?>
                    <tr>
                        <td><?= htmlspecialchars($r['codigo_equipo']) ?></td>
                        <td><?= htmlspecialchars($r['nombre_equipo']) ?></td>
                        <td><?= htmlspecialchars($r['categoria']) ?></td>
                        <td><?= htmlspecialchars($r['fecha']) ?></td>
                        <td><?= htmlspecialchars($r['tipo_mantenimiento']) ?></td>
                        <td><?= htmlspecialchars($r['tecnico'] ?? 'Sin técnico') ?></td>
                        <td class="text-end"><?= number_format($r['costo'], 2) ?></td>
                        <td class="text-center">
                            <?php
                            $color = match($r['estado']) {
                                'programado' => 'secondary',
                                'en_proceso' => 'warning',
                                'realizado' => 'success',
                                'cancelado' => 'danger',
                                default => 'light'
                            };
                            ?>
                            <span class="badge bg-<?= $color ?>"><?= htmlspecialchars($r['estado']) ?></span>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot class="table-secondary">
                <tr>
                    <th colspan="6" class="text-end">Total General:</th>
                    <th class="text-end"><?= number_format($total, 2) ?></th>
                    <th></th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

<script>
// ===== Exportar a Excel =====
function exportarExcel() {
    const table = document.getElementById('tablaReporte').outerHTML;
    const dataType = 'application/vnd.ms-excel';
    const tableHTML = table.replace(/ /g, '%20');
    const a = document.createElement('a');
    a.href = 'data:' + dataType + ', ' + tableHTML;
    a.download = 'reporte_mantenimientos.xls';
    a.click();
}

// ===== Filtro dinámico =====
document.addEventListener("DOMContentLoaded", () => {
    const input = document.createElement("input");
    input.placeholder = "🔍 Buscar...";
    input.className = "form-control mb-3";
    document.querySelector(".container").insertBefore(input, document.querySelector(".table-responsive"));

    input.addEventListener("keyup", () => {
        const filtro = input.value.toLowerCase();
        document.querySelectorAll("#tablaReporte tbody tr").forEach(row => {
            row.style.display = row.innerText.toLowerCase().includes(filtro) ? "" : "none";
        });
    });
});
</script>

<style>
body {
    background: #f8f9fa;
}
.container {
    max-width: 1100px;
}
.table {
    border-radius: 10px;
    overflow: hidden;
}
h2 {
    font-weight: 600;
    color: #333;
}
</style>

<?php include '../includes/footer.php'; ?>
