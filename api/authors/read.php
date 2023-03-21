<?php
    //headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Author.php';

    //Instantiate DB & Connect
    $database = new Database();
   // Connect to the database
    $db = $database->connect();
    
    

    //Instantiate Author Object
    $authors = new Author($db);

    //Author Query
    $result = $authors->read();

    //Get row count
    $num = $result->rowCount();

    //Check if any authors
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
        echo json_encode($authors_arr);

    } else {
        //No Authors
        echo json_encode(
            array('message' => 'No authors found')
        );
    }
    ?>