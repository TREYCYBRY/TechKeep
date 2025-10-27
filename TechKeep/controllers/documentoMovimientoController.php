<?php
require_once __DIR__ . '/../models/documento_movimiento.php';

$mov = new DocumentoMovimiento();

$accion = $_POST['accion'] ?? $_GET['accion'] ?? '';

switch ($accion) {
    case 'agregar':
        $data = [
            'id_equipo' => $_POST['id_equipo'] ?? null,
            'tipo_mov' => $_POST['tipo_mov'] ?? null,
            'fecha' => $_POST['fecha'] ?? null,
            'descripcion' => $_POST['descripcion'] ?? null,
            'realizado_por' => $_POST['realizado_por'] !== '' ? $_POST['realizado_por'] : null,
            'destino' => $_POST['destino'] ?? null
        ];
        $mov->agregar($data);
        header("Location: ../views/documento_movimiento/listar.php");
        exit();

    case 'editar':
        $data = [
            'id_mov' => $_POST['id_mov'],
            'id_equipo' => $_POST['id_equipo'] ?? null,
            'tipo_mov' => $_POST['tipo_mov'] ?? null,
            'fecha' => $_POST['fecha'] ?? null,
            'descripcion' => $_POST['descripcion'] ?? null,
            'realizado_por' => $_POST['realizado_por'] !== '' ? $_POST['realizado_por'] : null,
            'destino' => $_POST['destino'] ?? null
        ];
        $mov->editar($data);
        header("Location: ../views/documento_movimiento/listar.php");
        exit();

    case 'eliminar':
        $mov->eliminar($_GET['id']);
        header("Location: ../views/documento_movimiento/listar.php");
        exit();

    default:
        echo "Acción no válida.";
}
?>
