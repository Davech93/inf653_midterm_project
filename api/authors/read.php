<?php
    //headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Author.php';

    //Instantiate DB & Connect
    $database = new Database();
    try {
        // Connect to the database
        $db = $database->connect();
    
        // Echo a JavaScript script tag to log the value of $conn to the console
        echo '<script>console.log(' . json_encode($db) . ');</script>';
    } catch (PDOException $e) {
        // Log the error message to the browser console
        echo '<script>console.error(' . json_encode($e->getMessage()) . ');</script>';
    }
    echo '<pre>';
    var_dump($db);

     echo "error 6" . getenv("USERNAME") . getenv("HOST");

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