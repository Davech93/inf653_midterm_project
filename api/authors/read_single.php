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

    //Get row count
    $num = $result->rowCount();


    if($num > 0){
        //Author Array
        $authors_arr = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);

            $author_item = array(
                'id' => $id,
                'author' => $author
            );

            array_push($authors_arr, $author_item);
        }

        //turn to json & output
        echo json_encode(($authors_arr), JSON_FORCE_OBJECT);

    } else {
        //No Authors
        echo json_encode(array('message' => 'No authors found'), JSON_FORCE_OBJECT);
    }


    ?>