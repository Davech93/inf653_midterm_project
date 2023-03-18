<?php
    //headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Category.php';

    //Instantiate DB & Connect
    $database = new Database();
    $db = $database ->connect();

    //Instantiate Category Object
    $quote = new Quote($db);

    //get ID from url
    $quote->id = isset($_GET['id']) ? $_GET['id'] : die();

    //Get post
    $quote->read_single();

    //create array
    $quote_arr = array(
        'quote' => $quote->quote,
        'id' => $quote->id
        'author_id' => $quote->author_id;
        'category_id' => $quote->category_id;
    );
    
    //make json
    print_r(json_encode($quote_arr));


    ?>