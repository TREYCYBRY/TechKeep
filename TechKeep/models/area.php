<?php
require_once __DIR__ . '/../config/Conexion.php';

class Area {
    private $conn;

    public function __construct() {
        $conexion = new Conexion();
        $this->conn = $conexion->iniciar();
    }

    // Listar todas las áreas
    public function listar() {
        $sql = "SELECT a.id_area, a.nombre_area, u.nombres AS responsable
                FROM area a
                LEFT JOIN usuario u ON a.responsable = u.id_usuario
                ORDER BY a.id_area ASC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Agregar nueva área
    public function agregar($data) {
        $sql = "INSERT INTO area (nombre_area, responsable)
                VALUES (:nombre_area, :responsable)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':nombre_area' => $data[':nombre_area'],
            ':responsable' => $data[':responsable']
        ]);
    }

    // Obtener una sola área
    public function obtener($id) {
        $stmt = $this->conn->prepare("SELECT * FROM area WHERE id_area = :id_area");
        $stmt->bindParam(':id_area', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Editar área
    public function editar($data) {
        $sql = "UPDATE area 
                SET nombre_area = :nombre_area, responsable = :responsable
                WHERE id_area = :id_area";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':id_area' => $data[':id_area'],
            ':nombre_area' => $data[':nombre_area'],
            ':responsable' => $data[':responsable']
        ]);
    }

    // Eliminar área
    public function eliminar($id) {
        $stmt = $this->conn->prepare("DELETE FROM area WHERE id_area = :id_area");
        $stmt->bindParam(':id_area', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
?>
