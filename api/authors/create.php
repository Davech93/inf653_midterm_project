<?php
    //headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../models/Author.php';
    include_once 'index.php';

    //Instantiate DB & Connect
    $database = new Database();
    $db = $database ->connect();

    //Instantiate Author Object
    $author = new Author($db);

    // get raw posted data
    $data = json_decode(file_get_contents("php://input"));

    $author->author = $data->author;
    $author->id = $data->id;

    
        $myObj = json_encode(array('id' => $data->id, 'author' => $data->author), JSON_FORCE_OBJECT);
                

        //create post
    
        if(($data->id == NULL || $data->author == NULL) && $author->create()){
        $myObj2 = json_encode(array('message' => 'Missing Required Parameters'), JSON_FORCE_OBJECT);
        
        echo($myObj2);
        
    } else {
        echo($myObj);
    }
    ?>