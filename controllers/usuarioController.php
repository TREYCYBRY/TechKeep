<?php
require_once __DIR__ . '/../models/Usuario.php';

$usuario = new Usuario();

// Verificar si se envía alguna acción
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $accion = $_POST['accion'] ?? '';

    switch ($accion) {
        case 'agregar':
            $data = [
                ':nombres' => $_POST['nombres'],
                ':apellidos' => $_POST['apellidos'],
                ':rol' => $_POST['rol'],
                ':telefono' => $_POST['telefono'],
                ':correo' => $_POST['correo'],
                ':activo' => isset($_POST['activo']) ? 1 : 0
            ];
            $usuario->agregar($data);
            header('Location: ../views/usuario/listar.php');
            exit;

        case 'editar':
            $data = [
                ':id_usuario' => $_POST['id_usuario'],
                ':nombres' => $_POST['nombres'],
                ':apellidos' => $_POST['apellidos'],
                ':rol' => $_POST['rol'],
                ':telefono' => $_POST['telefono'],
                ':correo' => $_POST['correo'],
                ':activo' => isset($_POST['activo']) ? 1 : 0
            ];
            $usuario->editar($data);
            header('Location: ../views/usuario/listar.php');
            exit;

        case 'eliminar':
            $usuario->eliminar($_POST['id_usuario']);
            header('Location: ../views/usuario/listar.php');
            exit;
    }
}
?>
