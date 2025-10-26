<?php
require_once __DIR__ . '/../config/conexion.php';

class Componente {

    private $conn;

    public function __construct() {
        $conexion = new Conexion();
        $this->conn = $conexion->iniciar();
    }

    public function listar() {
        $sql = "SELECT c.*, e.nombre AS equipo_nombre
                FROM componente c
                INNER JOIN equipo e ON c.id_equipo = e.id_equipo";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtener($id) {
        $sql = "SELECT * FROM componente WHERE id_componente = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function agregar($data) {
        $sql = "INSERT INTO componente 
                (id_equipo, tipo, marca, modelo, numero_serie, fecha_instalacion, estado)
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            $data['id_equipo'],
            $data['tipo'],
            $data['marca'] ?? null,
            $data['modelo'] ?? null,
            $data['numero_serie'] ?? null,
            $data['fecha_instalacion'] ?: null,
            $data['estado']
        ]);
    }

    public function editar($data) {
        $sql = "UPDATE componente SET
                id_equipo = ?, tipo = ?, marca = ?, modelo = ?, 
                numero_serie = ?, fecha_instalacion = ?, estado = ?
                WHERE id_componente = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            $data['id_equipo'],
            $data['tipo'],
            $data['marca'] ?? null,
            $data['modelo'] ?? null,
            $data['numero_serie'] ?? null,
            $data['fecha_instalacion'] ?: null,
            $data['estado'],
            $data['id_componente']
        ]);
    }

    public function eliminar($id) {
        $sql = "DELETE FROM componente WHERE id_componente = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$id]);
    }
}
?>
