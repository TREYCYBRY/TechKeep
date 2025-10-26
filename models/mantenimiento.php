<?php
require_once __DIR__ . '/../config/Conexion.php';

class Mantenimiento {
    private $conn;

    public function __construct() {
        $conexion = new Conexion();
        $this->conn = $conexion->iniciar();
    }

    public function listar() {
        $sql= "SELECT m.id_mantenimiento, 
                       e.nombre AS equipo, 
                       t.nombre AS tipo_mantenimiento,
                       u.nombres AS tecnico,
                       m.fecha,
                       m.descripcion,
                       m.acciones_realizadas,
                       m.piezas_utilizadas,
                       m.costo,
                       m.proximo_mantenimiento,
                       m.estado
                FROM mantenimiento m
                INNER JOIN equipo e ON m.id_equipo = e.id_equipo
                INNER JOIN tipo_mantenimiento t ON m.id_tipo = t.id_tipo
                LEFT JOIN usuario u ON m.id_tecnico = u.id_usuario
                ORDER BY m.fecha DESC";
         $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtener($id) {
        $sql = "SELECT * FROM mantenimiento WHERE id_mantenimiento = :id_mantenimiento";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id_mantenimiento' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function agregar($data) {
        $sql = "INSERT INTO mantenimiento (
                    id_equipo, id_tipo, id_tecnico, fecha, descripcion, 
                    acciones_realizadas, piezas_utilizadas, costo, 
                    proximo_mantenimiento, estado
                ) VALUES (
                    :id_equipo, :id_tipo, :id_tecnico, :fecha, :descripcion, 
                    :acciones_realizadas, :piezas_utilizadas, :costo, 
                    :proximo_mantenimiento, :estado
                )";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute($data);
    }

    public function editar($data) {
        $sql = "UPDATE mantenimiento SET
                    id_equipo = :id_equipo,
                    id_tipo = :id_tipo,
                    id_tecnico = :id_tecnico,
                    fecha = :fecha,
                    descripcion = :descripcion,
                    acciones_realizadas = :acciones_realizadas,
                    piezas_utilizadas = :piezas_utilizadas,
                    costo = :costo,
                    proximo_mantenimiento = :proximo_mantenimiento,
                    estado = :estado
                WHERE id_mantenimiento = :id_mantenimiento";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute($data);
    }

    public function eliminar($id) {
        $sql = "DELETE FROM mantenimiento WHERE id_mantenimiento = :id_mantenimiento";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute(['id_mantenimiento' => $id]);
    }
}
?>
