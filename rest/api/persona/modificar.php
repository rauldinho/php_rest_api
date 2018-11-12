<?php
    // Encabezado
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: PUT');
    header('Access-Control-Allow-Headers:Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

    //Incluir Clases
    include_once '../../config/Database.php';
    include_once '../../models/Persona.php';

    //Instanciar DB
    $database = new Database();
    $db = $database->connect();

    //Instanciar Persona
    $persona = new Persona($db);

    //Obtener los datos a ingresar
    $data = json_decode(file_get_contents('php://input'));

    //Colocar ID
    $persona->id = $data->id;

    $persona->nombre = $data->nombre;
    $persona->correo = $data->correo;
    $persona->rut = $data->rut;
    $persona->fecha_nacimiento = $data->fecha_nacimiento;

    //Crear Persona
    if ($persona->modificar())
    {
        echo json_encode(['msj'=>'Persona modificada']);
    }
    else
    {
        echo json_encode(['msj'=>'Persona no modificada']);
    }