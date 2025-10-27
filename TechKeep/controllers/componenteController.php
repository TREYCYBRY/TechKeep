<?php
require_once __DIR__ . '/../models/componente.php';

$componente = new Componente();
$accion = $_POST['accion'] ?? $_GET['accion'] ?? '';

switch ($accion) {
    case 'agregar':
        $componente->agregar($_POST);
        header('Location: ../views/componente/listar.php');
        break;

    case 'editar':
        $componente->editar($_POST);
        header('Location: ../views/componente/listar.php');
        break;

    case 'eliminar':
        $id = $_GET['id'] ?? 0;
        if ($id) {
            $componente->eliminar($id);
        }
        header('Location: ../views/componente/listar.php');
        break;

    default:
        echo "Acción no válida";
        break;
}
?>
