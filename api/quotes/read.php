<?php
    //headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Quote.php';

    //Instantiate DB & Connect
    $database = new Database();
    // Connect to the database
    $db = $database->connect();
    

    //Instantiate Category Object
    $quote = new Quote($db);

    //Author Query
    $result = $quote->read();

    //Get row count
    $num = $result->rowCount();

    //Check if any quote
    if($num > 0){
        //Author Array
        $quote_arr = array();


        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);

            $quote_item = array(
                'id' => $id,
                'quote' => $quote,
                'author_id' => $author_id,
                'category_id' => $category_id
            );

            array_push($quote_arr, $quote_item);

        }

        //turn to json & output
        echo json_encode($quote_arr);

    } else {
        //No Authors
        echo json_encode(
            array('message' => 'No categories found')
        );
    }
    ?>