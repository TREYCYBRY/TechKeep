<?php
require_once __DIR__ . '/../models/tipo_mantenimiento.php';

$tipo = new TipoMantenimiento();
$accion = $_POST['accion'] ?? $_GET['accion'] ?? '';

switch ($accion) {
    case 'agregar':
        $tipo->agregar($_POST);
        header('Location: ../views/tipo_mantenimiento/listar.php');
        break;

    case 'editar':
        $tipo->editar($_POST);
        header('Location: ../views/tipo_mantenimiento/listar.php');
        break;

    case 'eliminar':
        $id = $_GET['id'] ?? 0;
        if ($id) {
            $tipo->eliminar($id);
        }
        header('Location: ../views/tipo_mantenimiento/listar.php');
        break;

    default:
        echo "Acción no válida";
        break;
}
?>
