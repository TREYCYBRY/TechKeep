<?php
require_once __DIR__ . '/../models/Proveedor.php';

$proveedor = new Proveedor();
$accion = $_POST['accion'] ?? $_GET['accion'] ?? '';

switch ($accion) {
    case 'agregar':
        $proveedor->agregar([
            ':nombre' => $_POST['nombre'],
            ':contacto' => $_POST['contacto'] ?? null,
            ':telefono' => $_POST['telefono'] ?? null,
            ':correo' => $_POST['correo'] ?? null,
            ':direccion' => $_POST['direccion'] ?? null
        ]);
        header("Location: ../views/proveedor/proveedores_listar.php");
        break;

    case 'editar':
        $proveedor->editar([
            ':id_proveedor' => $_POST['id_proveedor'],
            ':nombre' => $_POST['nombre'],
            ':contacto' => $_POST['contacto'] ?? null,
            ':telefono' => $_POST['telefono'] ?? null,
            ':correo' => $_POST['correo'] ?? null,
            ':direccion' => $_POST['direccion'] ?? null
        ]);
        header("Location: ../views/proveedor/proveedores_listar.php");
        break;

    case 'eliminar':
        $proveedor->eliminar($_GET['id']);
        header("Location: ../views/proveedor/proveedores_listar.php");
        break;
}
