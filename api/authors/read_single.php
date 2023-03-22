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

    
    $result = $author->read_single();

    if(!$author->id === NULL || !$author->author === NULL){
    $author_arr = array(
        'id' => $author->id,
        'author' => $author->author);
    print_r(json_encode($author_arr));
    } else {
    
    print_r(json_encode(array('message' => 'author_id not found')));

    }




    ?>