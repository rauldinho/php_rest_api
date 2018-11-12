<?php
    // Encabezado
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: DELETE');
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

    //Crear Persona
    if ($persona->eliminar())
    {
        echo json_encode(['msj'=>'Persona eliminada']);
    }
    else
    {
        echo json_encode(['msj'=>'Persona no eliminada']);
    }