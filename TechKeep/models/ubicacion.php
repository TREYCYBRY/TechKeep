<?php
require_once __DIR__ . '/../config/Conexion.php';

class Ubicacion {
    private $conn;

    public function __construct() {
        $conexion = new Conexion();
        $this->conn = $conexion->iniciar();
    }

    // Listar todas las ubicaciones
    public function listar() {
        $sql = "SELECT u.id_ubicacion, u.nombre, u.descripcion, u.piso, 
                       a.nombre_area AS area
                FROM ubicacion u
                LEFT JOIN area a ON u.id_area = a.id_area";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Agregar ubicación
    public function agregar($data) {
        $sql = "INSERT INTO ubicacion (nombre, descripcion, piso, id_area)
                VALUES (:nombre, :descripcion, :piso, :id_area)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute($data);
    }

    // Obtener una ubicación
    public function obtener($id) {
        $stmt = $this->conn->prepare("SELECT * FROM ubicacion WHERE id_ubicacion = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Editar ubicación
    public function editar($data) {
        $sql = "UPDATE ubicacion 
                SET nombre = :nombre, descripcion = :descripcion, piso = :piso, id_area = :id_area 
                WHERE id_ubicacion = :id_ubicacion";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute($data);
    }

    // Eliminar ubicación
    public function eliminar($id) {
        $stmt = $this->conn->prepare("DELETE FROM ubicacion WHERE id_ubicacion = ?");
        return $stmt->execute([$id]);
    }
}
