<?php
    // Encabezado
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
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

    $persona->nombre = $data->nombre;
    $persona->correo = $data->correo;
    $persona->rut = $data->rut;
    $persona->fecha_nacimiento = $data->fecha_nacimiento;

    //Crear Persona
    if ($persona->crear())
    {
        echo json_encode(['msj'=>'Persona creada']);
    }
    else
    {
        echo json_encode(['msj'=>'Persona no creada']);
    }