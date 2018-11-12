<?php
    // Encabezado
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    //Incluir Clases
    include_once '../../config/Database.php';
    include_once '../../models/Persona.php';

    //Instanciar DB
    $database = new Database();
    $db = $database->connect();

    //Instanciar Persona
    $persona = new Persona($db);

    //Obtener ID
    $persona->id = isset($_GET['id'])?$_GET['id']:die();

    //Persona buscar
    $persona->buscar();
    
    $setPersona = [
        'id'=>$persona->id,
        'nombre'=>$persona->nombre,
        'rut'=>$persona->rut,
        'correo'=>$persona->correo,
        'fecha_nacimiento'=>$persona->fecha_nacimiento
    ];

    //Convertir en JSON
    print_r(json_encode($setPersona));