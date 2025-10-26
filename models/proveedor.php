<?php
require_once __DIR__ . '/../config/Conexion.php';

class Proveedor {
    private $conn;

    public function __construct() {
        $conexion = new Conexion();
        $this->conn = $conexion->iniciar();
    }

    // Listar todos los proveedores
    public function listar() {
        $sql = "SELECT * FROM proveedor";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Agregar proveedor
    public function agregar($data) {
        $sql = "INSERT INTO proveedor (nombre, contacto, telefono, correo, direccion)
                VALUES (:nombre, :contacto, :telefono, :correo, :direccion)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute($data);
    }

    // Obtener un proveedor por ID
    public function obtener($id) {
        $stmt = $this->conn->prepare("SELECT * FROM proveedor WHERE id_proveedor = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Editar proveedor
    public function editar($data) {
        $sql = "UPDATE proveedor 
                SET nombre = :nombre, contacto = :contacto, telefono = :telefono, 
                    correo = :correo, direccion = :direccion
                WHERE id_proveedor = :id_proveedor";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute($data);
    }

    // Eliminar proveedor
    public function eliminar($id) {
        $stmt = $this->conn->prepare("DELETE FROM proveedor WHERE id_proveedor = ?");
        return $stmt->execute([$id]);
    }
}
