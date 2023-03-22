<?php
    //headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: DELETE');
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
    //set id to update
    $author->id = $data->id;

    //delete author
    if($author->delete() == 1){
        $author->id = echo (isset($_DELETE['id'])) ? (json_encode(array('message' => 'Author Not Deleted'))) : (json_encode(array('id'=>$author->id)));
    } else {
        echo json_encode(array('message' => 'Author Not Deleted'));
    }

    ?>
