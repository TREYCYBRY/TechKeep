<?php
require_once __DIR__ . '/../config/Conexion.php';

class Equipo {
    private $conn;
    private $table = 'equipo';

    public function __construct() {
        $conexion= new Conexion();
        $this->conn = $conexion->iniciar();
    }

    // Listar equipos
    public function listar() {
    $sql = "SELECT 
                e.id_equipo,
                e.codigo,
                e.nombre,
                e.marca,
                e.modelo,
                e.numero_serie,
                e.fecha_adquisicion,
                e.valor_adquisicion,
                e.estado,
                e.observaciones,
                e.fecha_baja,
                c.nombre AS categoria,
                p.nombre AS proveedor,
                u.nombre AS ubicacion,
                r.nombres AS responsable
            FROM equipo e
            LEFT JOIN categoria_equipo c ON e.id_categoria = c.id_categoria
            LEFT JOIN proveedor p ON e.id_proveedor = p.id_proveedor
            LEFT JOIN ubicacion u ON e.id_ubicacion = u.id_ubicacion
            LEFT JOIN usuario r ON e.id_responsable = r.id_usuario";
    
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


    // Insertar equipo
    public function agregar($data) {
        $sql = "INSERT INTO equipo 
                (codigo, nombre, id_categoria, marca, modelo, numero_serie, id_proveedor, id_ubicacion, id_responsable, fecha_adquisicion, valor_adquisicion, estado, observaciones)
                VALUES (:codigo, :nombre, :id_categoria, :marca, :modelo, :numero_serie, :id_proveedor, :id_ubicacion, :id_responsable, :fecha_adquisicion, :valor_adquisicion, :estado, :observaciones)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute($data);
    }

    // Obtener un equipo por ID
    public function obtener($id) {
        $stmt = $this->conn->prepare("SELECT * FROM equipo WHERE id_equipo = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Editar equipo
public function editar($data) {
    $sql = "UPDATE equipo SET
                codigo = :codigo, 
                nombre = :nombre,
                marca = :marca,
                modelo = :modelo,
                numero_serie = :numero_serie,
                id_categoria = :id_categoria,
                id_proveedor = :id_proveedor,
                id_ubicacion = :id_ubicacion,
                id_responsable = :id_responsable,
                fecha_adquisicion = :fecha_adquisicion,
                valor_adquisicion = :valor_adquisicion,
                estado = :estado,
                observaciones = :observaciones,
                fecha_baja = :fecha_baja
            WHERE id_equipo = :id_equipo";

    $stmt = $this->conn->prepare($sql);
    return $stmt->execute([
        'codigo' => $data['codigo'],
        'nombre' => $data['nombre'],
        'marca' => $data['marca'],
        'modelo' => $data['modelo'],
        'numero_serie' => $data['numero_serie'],
        'id_categoria' => $data['id_categoria'],
        'id_proveedor' => $data['id_proveedor'],
        'id_ubicacion' => $data['id_ubicacion'],
        'id_responsable' => $data['id_responsable'],
        'fecha_adquisicion' => $data['fecha_adquisicion'],
        'valor_adquisicion' => $data['valor_adquisicion'],
        'estado' => $data['estado'],
        'observaciones' => $data['observaciones'],
        'fecha_baja' => $data['fecha_baja'] ?? null,
        'id_equipo' => $data['id_equipo']
    ]);
}



    // Eliminar equipo
    public function eliminar($id) {
        $stmt = $this->conn->prepare("DELETE FROM equipo WHERE id_equipo = ?");
        return $stmt->execute([$id]);
    }
}
