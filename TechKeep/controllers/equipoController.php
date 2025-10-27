<?php
require_once __DIR__ . '/../models/Equipo.php';

$equipo = new Equipo();

// Aceptamos tanto GET como POST (según la acción)
$accion = $_POST['accion'] ?? $_GET['accion'] ?? '';

switch ($accion) {
    case 'agregar':
        $equipo->agregar($_POST);
        header("Location: ../views/equipo/listar.php");
        exit();

    case 'editar':
        $equipo->editar($_POST);
        header("Location: ../views/equipo/listar.php");
        exit();

    case 'eliminar':
        $id = $_GET['id'] ?? null;
        if ($id) {
            $equipo->eliminar($id);
        }
        header("Location: ../views/equipo/listar.php");
        exit();

    default:
        echo "⚠️ Acción no válida.";
        break;
}
