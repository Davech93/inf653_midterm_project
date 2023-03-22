<?php
    //headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Quote.php';

    //Instantiate DB & Connect
    $database = new Database();
    $db = $database ->connect();

    //Instantiate Category Object
    $quote = new Quote($db);
    

    //get ID from url
    $quote->id = isset($_GET['id']) ? $_GET['id'] :die();

    if($_GET['id'] == NULL){
        $a = array('message' => 'quote_id Not Found');
        echo json_encode($a);
    } else {
        $quote->read_single();

        if($category->id && $category->category) {
            $quote_arr = array(
                'quote' => $quote->quote,
                'id' => $quote->id,
                'author' => $quote->author,
                'category' => $quote->category
            );
            echo json_encode($quote_arr);
        }
        else {
            $a = array('message' => 'quote_id Not Found');
            echo json_encode($a);
        }
    
    }



    ?>