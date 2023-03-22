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
    
    if($_GET['id'] == NULL){
        $a = array('message' => 'author_id Not Found');
        echo json_encode($a);
    } else {
        $author->read_single();

        if($author->id && $author->author) {
            $author_arr = array(
                'id' => $author->id,
                'author' => $author->author);
            echo json_encode($author_arr);
        }
        else {
            $a = array('message' => 'author_id Not Found');
            echo json_encode($a);
        }
        
    }
  




    ?>