<?php
    //headers
    header('Acces_Control_Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Author.php';

    //Instantiate DB & Connect
    $database = new Database();
    $db = $database ->connect();

    //Instantiate Author Object
    echo "error4" . $db;
    $authors = new Author($db);

    //Author Query
    $result = $authors->read();

    //Get row count
    $num = $result->rowCount();

    //Check if any authors
    if($num > 0){
        //Author Array
        $authors_arr = array();
        $authors_arr['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);

            $author_item = array(
                'author' => $author,
                'id' => $id,
                'title' => $title,
                'body' => html_entity_decode($body)
            );

            //push to "data
            array_push($authors_arr['data'], $author_item);
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