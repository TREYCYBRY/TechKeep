<?php
require_once __DIR__ . '/../models/Area.php';
$area = new Area();

$accion = $_POST['accion'] ?? $_GET['accion'] ?? '';

switch ($accion) {
    case 'agregar':
        $data = [
            ':nombre_area' => $_POST['nombre'],
            ':responsable' => $_POST['responsable']
        ];
        $area->agregar($data);
        header('Location: ../views/area/listar.php');
        exit;

    case 'editar':
        $data = [
            ':id_area' => $_POST['id_area'],
            ':nombre_area' => $_POST['nombre'],
            ':responsable' => $_POST['responsable']
        ];
        $area->editar($data);
        header('Location: ../views/area/listar.php');
        exit;

    case 'eliminar':
        $area->eliminar($_GET['id']);
        header('Location: ../views/area/listar.php');
        exit;
}
?>
