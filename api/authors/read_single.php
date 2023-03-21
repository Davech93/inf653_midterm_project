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
    $myObj2 = json_encode(array('message' => 'No Authors Found'), JSON_FORCE_OBJECT);
    //Get post
    if(!$author->read_single()){
    print_r($myObj2);
    } else {

    //create array
    $author_arr = array(
        'author' => $author->author,
        'id' => $author->id
    );
    
    //make json
    print_r(json_encode($author_arr));
};

    ?>