<?php
    //headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: PUT');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../models/Author.php';

    //Instantiate DB & Connect
    $database = new Database();
    $db = $database ->connect();

    //Instantiate Author Object
    $author = new Author($db);

    // get raw posted data
    $data = json_decode(file_get_contents("php://input"));

       if(isset($data->id)){
        $author->id = $data->id;
       } else {
        echo json_encode(array("message"=>"Missing Required Parameters"));
        exit();
       }
       if(isset($data->author)){
        $author->author = $data->author;
       } else {
        echo json_encode(array("message"=>"Missing Required Parameters"));
        exit();
       }
    


    //update post
    if($author->update()){
        echo json_encode(
            array("id"=>$author->id, "author"=>$author->author)
        );
    } else {
        echo json_encode(
            array("message" => "Missing Required Parameters")    
        );
    }

    ?>
