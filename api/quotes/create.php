<?php
    //headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../models/Category.php';

    //Instantiate DB & Connect
    $database = new Database();
    $db = $database ->connect();

    //Instantiate Author Object
    $quote = new Quote($db);

    // get raw posted data
    $data = json_decode(file_get_contents("php://input"));

    $quote->quote = $data->quote;
    $quote->id = $data->id;
    $quote->author_id = $data->author_id;
    $quote->category_id = $data->category_id;


    //create post
    if($quote->create()){
        echo json_encode(
            array('message' => 'Quote Created')
        );
    } else {
        echo json_encode(
            array('message' => 'Quote Not Created')    
        );
    }

    ?>