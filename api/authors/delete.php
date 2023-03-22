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

    $author->id = isset($_GET['id']) ? $_GET['id'] : die();
    
    if($_GET['id'] == NULL){
        $a = array('message' => 'author_id Not Found');
        echo json_encode($a);
    } else {
        $author->delete();

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
