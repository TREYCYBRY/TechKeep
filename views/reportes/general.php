<?php
require_once '../../config/Conexion.php';

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

<div class="container mt-4">
    <h2 class="text-center mb-4">📊 Reporte General de Mantenimientos</h2>

    <div class="text-end mb-3">
        <button onclick="exportarExcel()" class="btn btn-success">📗 Exportar a Excel</button>
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
                    <th colspan="6" class="text-end">💰 Total General:</th>
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
