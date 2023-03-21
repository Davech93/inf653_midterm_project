<?php
    //headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
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

    $author->author = $data->author;
    $author->id = $data->id;

    $author_arr = ();

    $author_item = array(
        'id' => $id,
        'author' => $author
    );

    array_push($authors_arr, $author_item);




    //create post
    if($author->create()){
        echo json_encode($authors_arr);
    } else {
        echo json_encode(
            array('message' => 'Author Not Created')    
        );
    }

    ?>