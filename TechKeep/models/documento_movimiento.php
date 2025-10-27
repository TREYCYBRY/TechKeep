<?php
require_once __DIR__ . '/../config/Conexion.php';

class DocumentoMovimiento {
    private $conn;

    public function __construct() {
        $conexion = new Conexion();
        $this->conn = $conexion->iniciar();
    }

    public function listar() {
        $sql = "SELECT dm.id_mov, 
                       e.nombre AS equipo, 
                       dm.tipo_mov, 
                       dm.fecha, 
                       dm.descripcion, 
                       u.nombres AS realizado_por,
                       dm.destino
                FROM documento_movimiento dm
                INNER JOIN equipo e ON dm.id_equipo = e.id_equipo
                LEFT JOIN usuario u ON dm.realizado_por = u.id_usuario
                ORDER BY dm.fecha DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerPorId($id) {
        $sql = "SELECT * FROM documento_movimiento WHERE id_mov = :id_mov";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id_mov' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function agregar($data) {
        $sql = "INSERT INTO documento_movimiento (
                    id_equipo, tipo_mov, fecha, descripcion, realizado_por, destino
                ) VALUES (
                    :id_equipo, :tipo_mov, :fecha, :descripcion, :realizado_por, :destino
                )";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute($data);
    }

    public function editar($data) {
        $sql = "UPDATE documento_movimiento SET
                    id_equipo = :id_equipo,
                    tipo_mov = :tipo_mov,
                    fecha = :fecha,
                    descripcion = :descripcion,
                    realizado_por = :realizado_por,
                    destino = :destino
                WHERE id_mov = :id_mov";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute($data);
    }

    public function eliminar($id) {
        $sql = "DELETE FROM documento_movimiento WHERE id_mov = :id_mov";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute(['id_mov' => $id]);
    }
}
?>
