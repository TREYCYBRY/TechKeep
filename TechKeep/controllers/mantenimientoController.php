<?php
require_once __DIR__ . '/../models/mantenimiento.php';

$mantenimiento = new Mantenimiento();

$accion = $_POST['accion'] ?? $_GET['accion'] ?? '';

switch ($accion) {
    case 'agregar':
        $data = [
            'id_equipo' => $_POST['id_equipo'] ?? null,
            'id_tipo' => $_POST['id_tipo'] ?? null,
            'id_tecnico' => $_POST['id_tecnico'] !== '' ? $_POST['id_tecnico'] : null,
            'fecha' => $_POST['fecha'] ?? null,
            'descripcion' => $_POST['descripcion'] ?? null,
            'acciones_realizadas' => $_POST['acciones_realizadas'] ?? null,
            'piezas_utilizadas' => $_POST['piezas_utilizadas'] ?? null,
            'costo' => $_POST['costo'] ?? 0.00,
            'proximo_mantenimiento' => $_POST['proximo_mantenimiento'] ?? null,
            'estado' => $_POST['estado'] ?? 'realizado'
        ];

        $mantenimiento->agregar($data);
        header("Location: ../views/mantenimiento/listar.php");
        exit();

    case 'editar':
        $data = [
            'id_mantenimiento' => $_POST['id_mantenimiento'],
            'id_equipo' => $_POST['id_equipo'] ?? null,
            'id_tipo' => $_POST['id_tipo'] ?? null,
            'id_tecnico' => $_POST['id_tecnico'] !== '' ? $_POST['id_tecnico'] : null,
            'fecha' => $_POST['fecha'] ?? null,
            'descripcion' => $_POST['descripcion'] ?? null,
            'acciones_realizadas' => $_POST['acciones_realizadas'] ?? null,
            'piezas_utilizadas' => $_POST['piezas_utilizadas'] ?? null,
            'costo' => $_POST['costo'] ?? 0.00,
            'proximo_mantenimiento' => $_POST['proximo_mantenimiento'] ?? null,
            'estado' => $_POST['estado'] ?? 'realizado'
        ];

        $mantenimiento->editar($data);
        header("Location: ../views/mantenimiento/listar.php");
        exit();

    case 'eliminar':
        $mantenimiento->eliminar($_GET['id']);
        header("Location: ../views/mantenimiento/listar.php");
        exit();

    default:
        echo "Acción no válida.";
}
?>
