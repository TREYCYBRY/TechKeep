<?php
require_once __DIR__ . '/../config/Conexion.php';

class Usuario {
    private $conn;
    private $table = 'usuario';

    public function __construct() {
        $conexion = new Conexion();
        $this->conn = $conexion->iniciar();
    }

    // 🟢 Listar todos los usuarios
    public function listar() {
        $sql = "SELECT * FROM {$this->table} ORDER BY id_usuario DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // 🟢 Obtener un usuario por ID
    public function obtener($id) {
        $sql = "SELECT * FROM {$this->table} WHERE id_usuario = :id_usuario";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_usuario', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // 🟢 Agregar nuevo usuario
    public function agregar($data) {
        $sql = "INSERT INTO {$this->table} 
                (nombres, apellidos, rol, telefono, correo, activo)
                VALUES (:nombres, :apellidos, :rol, :telefono, :correo, :activo)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute($data);
    }

    // 🟢 Editar usuario existente
    public function editar($data) {
        $sql = "UPDATE {$this->table}
                SET nombres = :nombres,
                    apellidos = :apellidos,
                    rol = :rol,
                    telefono = :telefono,
                    correo = :correo,
                    activo = :activo
                WHERE id_usuario = :id_usuario";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute($data);
    }

    // 🟢 Eliminar usuario
    public function eliminar($id) {
        $sql = "DELETE FROM {$this->table} WHERE id_usuario = :id_usuario";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_usuario', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // 🟢 Cambiar estado activo/inactivo
    public function cambiarEstado($id, $activo) {
        $sql = "UPDATE {$this->table} SET activo = :activo WHERE id_usuario = :id_usuario";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':activo', $activo, PDO::PARAM_BOOL);
        $stmt->bindParam(':id_usuario', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // 🟢 Buscar usuario por correo
    public function buscarPorCorreo($correo) {
        $sql = "SELECT * FROM {$this->table} WHERE correo = :correo";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':correo', $correo, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
     public function listarResponsables() {
        $sql = "SELECT id_usuario, CONCAT(nombres, ' ', apellidos) AS nombre_completo, telefono, correo 
                FROM {$this->table}
                WHERE rol = 'responsable' AND activo = 1
                ORDER BY nombres ASC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function listarTecnicos() {
        $sql = "SELECT id_usuario, CONCAT(nombres, ' ', apellidos) AS nombre_completo, telefono, correo 
                FROM {$this->table}
                WHERE rol = 'tecnico' AND activo = 1
                ORDER BY nombres ASC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
