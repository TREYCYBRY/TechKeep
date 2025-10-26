<?php
require_once __DIR__ . '/../config/Conexion.php';

class CategoriaEquipo {
    private $conn;
    private $table = 'categoria_equipo';

    public function __construct() {
        $conexion = new Conexion();
        $this->conn = $conexion->iniciar();
    }

    // ✅ Listar todas las categorías
    public function listar() {
        $sql = "SELECT * FROM categoria_equipo ORDER BY id_categoria DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // ✅ Agregar nueva categoría
    public function agregar($data) {
        $sql = "INSERT INTO categoria_equipo (nombre, descripcion)
                VALUES (:nombre, :descripcion)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute($data);
    }

    // ✅ Obtener una categoría por ID
    public function obtener($id) {
        $stmt = $this->conn->prepare("SELECT * FROM categoria_equipo WHERE id_categoria = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // ✅ Editar categoría
    public function editar($data) {
        $sql = "UPDATE categoria_equipo 
                SET nombre = :nombre, descripcion = :descripcion
                WHERE id_categoria = :id_categoria";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute($data);
    }

    // ✅ Eliminar categoría
    public function eliminar($id) {
        $stmt = $this->conn->prepare("DELETE FROM categoria_equipo WHERE id_categoria = ?");
        return $stmt->execute([$id]);
    }
}
