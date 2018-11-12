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

    //Persona leer
    $result = $persona->listar();

    //Contar totales
    $total = $result->rowCount();

    if ($total > 0)
    {
        $setPersonas = array();
        $setPersonas['data'] = array();

        while ($persona = $result->fetch(PDO::FETCH_ASSOC))
        {
            extract($persona);
            $persona = [
                'id'=>$id,
                'nombre'=>$nombre,
                'rut'=>$rut,
                'correo'=>$correo,
                'fecha_nacimiento'=>$fecha_nacimiento
            ];

            array_push($setPersonas['data'], $persona);
        }

        //Convertir en JSON
        echo json_encode($setPersonas);
    }
    else
    {
        echo json_encode([
            'msj'=>'No existen personas'
        ]);
    }
