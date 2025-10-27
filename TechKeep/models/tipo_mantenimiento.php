<?php
require_once __DIR__ . '/../config/conexion.php';

class TipoMantenimiento {
    private $conn;

    public function __construct() {
        $conexion = new Conexion();
        $this->conn = $conexion->iniciar();
    }

    public function listar() {
        $sql = "SELECT * FROM tipo_mantenimiento ORDER BY id_tipo DESC";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtener($id) {
        $sql = "SELECT * FROM tipo_mantenimiento WHERE id_tipo = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function agregar($data) {
        $sql = "INSERT INTO tipo_mantenimiento (nombre, descripcion, intervalo_dias) 
                VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            $data['nombre'],
            $data['descripcion'] ?? null,
            $data['intervalo_dias'] ?: null
        ]);
    }

    public function editar($data) {
        $sql = "UPDATE tipo_mantenimiento 
                SET nombre = ?, descripcion = ?, intervalo_dias = ?
                WHERE id_tipo = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            $data['nombre'],
            $data['descripcion'] ?? null,
            $data['intervalo_dias'] ?: null,
            $data['id_tipo']
        ]);
    }

    public function eliminar($id) {
        $sql = "DELETE FROM tipo_mantenimiento WHERE id_tipo = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$id]);
    }
}
?>
