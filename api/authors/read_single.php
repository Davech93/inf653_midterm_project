<?php
    //headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Author.php';

    //Instantiate DB & Connect
    $database = new Database();
    $db = $database ->connect();

    //Instantiate Author Object
    $author = new Author($db);

    //get ID from url
    $author->id = isset($_GET['id']) ? $_GET['id'] : die();
    $data = json_decode(file_get_contents("php://input"));

    $result = $author->read_single();


    if($result == NULL){
        //No Authors
        print_r(json_encode(array('message' => 'author_id not found')));
        } else {
            $author_arr = array(
                'id' => $data->id,
                'author' => $data->author
            );
            print_r(json_encode($author_arr));
    }


    ?>