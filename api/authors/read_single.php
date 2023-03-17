<?php
    //headers
    header('Acces-Control-Allow-Origin: *');
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

    //Get post
    $post->read_single();

    //create array
    $author_arr = array(
        'author' => $author->author,
        'id' => $author->id,
        'title' => $author->title,
        'body' => $author->body
    );
    
    //make json
    print_r(json_encode($author_arr));


    ?>