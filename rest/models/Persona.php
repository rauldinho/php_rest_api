<?php
class Persona
{
    //Conexion DB
    private $conn;
    private $tabla = 'tbl_persona';

    //Propiedades de la Persona
    public $id;
    public $nombre;
    public $rut;
    public $correo;
    public $fecha_nacimiento;

    //Constructor
    public function __construct($db)
    {
        $this->conn = $db;
    }

    //Listar personas
    public function listar()
    {
        //Query
        $query = "SELECT * FROM {$this->tabla} ORDER BY id";

        //Preparar Query
        $stmt = $this->conn->prepare($query);

        //Ejecutar Query
        $stmt->execute();

        //Retornar resultado
        return $stmt;
    }

    //Buscar Persona
    public function buscar()
    {
        //Query
        $query = "SELECT * FROM {$this->tabla} WHERE id = ?";

        //Preparar Query
        $stmt = $this->conn->prepare($query);

        //Bind parametros
        $stmt->bindParam(1,$this->id);

        //Ejecutar Query
        $stmt->execute();

        //Retornar resultado
        $persona = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->id = $persona['id'];
        $this->nombre = $persona['nombre'];
        $this->rut = $persona['rut'];
        $this->correo = $persona['correo'];
        $this->fecha_nacimiento = $persona['fecha_nacimiento'];
    }

    //Crear persona
    public function crear()
    {
        //Query
        $query = "INSERT INTO {$this->tabla} 
            SET 
                nombre = :nombre,
                rut = :rut,
                correo = :correo,
                fecha_nacimiento = :fecha_nacimiento 
        ";

        //Preparar Query
        $stmt = $this->conn->prepare($query);

        //Limpiar Data
        $this->nombre = $this->nombre;
        $this->rut = $this->rut;
        $this->correo = $this->correo;
        $this->fecha_nacimiento = $this->fecha_nacimiento;

        //Bind Parametros
        $stmt->bindParam(':nombre', $this->nombre);
        $stmt->bindParam(':rut', $this->rut);
        $stmt->bindParam(':correo', $this->correo);
        $stmt->bindParam(':fecha_nacimiento', $this->fecha_nacimiento);

        //Ejecutar Query
        if ($stmt->execute())
        {
            return true;
        }
        
        //En caso de que ocurra un error
        printf("Error: %s", $stmt->error);
        return false;
    }

    //Modificar persona
    public function modificar()
    {
        //Query
        $query = "UPDATE {$this->tabla} 
            SET 
                nombre = :nombre,
                rut = :rut,
                correo = :correo,
                fecha_nacimiento = :fecha_nacimiento 
            WHERE
                id = :id
        ";

        //Preparar Query
        $stmt = $this->conn->prepare($query);

        //Limpiar Data
        $this->nombre = $this->nombre;
        $this->rut = $this->rut;
        $this->correo = $this->correo;
        $this->fecha_nacimiento = $this->fecha_nacimiento;

        //Bind Parametros
        $stmt->bindParam(':nombre', $this->nombre);
        $stmt->bindParam(':rut', $this->rut);
        $stmt->bindParam(':correo', $this->correo);
        $stmt->bindParam(':fecha_nacimiento', $this->fecha_nacimiento);
        $stmt->bindParam(':id', $this->id);

        //Ejecutar Query
        if ($stmt->execute())
        {
            return true;
        }
        
        //En caso de que ocurra un error
        printf("Error: %s", $stmt->error);
        return false;
    }

    public function eliminar()
    {
        //Query
        $query = "DELETE FROM {$this->tabla} WHERE id = :id";

        //Preparar Query
        $stmt = $this->conn->prepare($query);

        //Limpiar Data
        $this->id = $this->id;

        //Bind Parametros
        $stmt->bindParam(':id', $this->id);

        //Ejecutar Query
        if ($stmt->execute())
        {
            return true;
        }
        
        //En caso de que ocurra un error
        printf("Error: %s", $stmt->error);
        return false;

    }
}