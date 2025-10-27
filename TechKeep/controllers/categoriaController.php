<?php
require_once __DIR__ . '/../models/categoria.php';

$categoria = new CategoriaEquipo();

// Verificar qué acción se envió desde el formulario o enlace
$accion = $_POST['accion'] ?? $_GET['accion'] ?? '';

switch ($accion) {

    // ✅ AGREGAR CATEGORÍA
    case 'agregar':
        $data = [
            ':nombre' => $_POST['nombre'],
            ':descripcion' => $_POST['descripcion']
        ];
        if ($categoria->agregar($data)) {
            header('Location: ../views/categoria_equipo/categorias_listar.php?msg=agregado');
        } else {
            header('Location: ../views/categoria_equipo/categorias_agregar.php?msg=error');
        }
        break;

    // ✅ EDITAR CATEGORÍA
    case 'editar':
        $data = [
            ':id_categoria' => $_POST['id_categoria'],
            ':nombre' => $_POST['nombre'],
            ':descripcion' => $_POST['descripcion']
        ];
        if ($categoria->editar($data)) {
            header('Location: ../views/categoria_equipo/categorias_listar.php?msg=editado');
        } else {
            header('Location: ../views/categoria_equipo/categorias_editar.php?id=' . $_POST['id_categoria'] . '&msg=error');
        }
        break;

    // ✅ ELIMINAR CATEGORÍA
    case 'eliminar':
        $id = $_GET['id'] ?? 0;
        if ($categoria->eliminar($id)) {
            header('Location: ../views/categoria_equipo/categorias_listar.php?msg=eliminado');
        } else {
            header('Location: ../views/categoria_equipo/categorias_listar.php?msg=error');
        }
        break;

    // ✅ LISTAR (por defecto)
    default:
        $categorias = $categoria->listar();
        include __DIR__ . '/../views/categoria_equipo/categorias_listar.php';
        break;
}
