<?php
require_once __DIR__ . '/../models/Ubicacion.php';

$ubicacion = new Ubicacion();
$accion = $_POST['accion'] ?? $_GET['accion'] ?? '';

switch ($accion) {
    case 'agregar':
        $ubicacion->agregar([
            ':nombre' => $_POST['nombre'],
            ':descripcion' => $_POST['descripcion'] ?? null,
            ':piso' => $_POST['piso'] ?? null,
            ':id_area' => $_POST['id_area'] ?? null
        ]);
        header("Location: ../views/ubicacion/ubicaciones_listar.php");
        break;

    case 'editar':
        $ubicacion->editar([
            ':id_ubicacion' => $_POST['id_ubicacion'],
            ':nombre' => $_POST['nombre'],
            ':descripcion' => $_POST['descripcion'] ?? null,
            ':piso' => $_POST['piso'] ?? null,
            ':id_area' => $_POST['id_area'] ?? null
        ]);
        header("Location: ../views/ubicacion/ubicaciones_listar.php");
        break;

    case 'eliminar':
        $ubicacion->eliminar($_GET['id']);
        header("Location: ../views/ubicacion/ubicaciones_listar.php");
        break;
}
