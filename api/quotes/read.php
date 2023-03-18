<?php
    //headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Category.php';

    //Instantiate DB & Connect
    $database = new Database();
    try {
        // Connect to the database
        $db = $database->connect();
    
    } catch (PDOException $e) {
        // Log the error message to the browser console
        echo '<script>console.error(' . json_encode($e->getMessage()) . ');</script>';
    }

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
        $quote_arr['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);

            $quote_item = array(
                'quote' => $quote,
                'id' => $id,
                'author_id' => $author_id,
                'category_id' => $category_id
            );

            //push to "data
            array_push($quote_arr['data'], $quote_item);
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