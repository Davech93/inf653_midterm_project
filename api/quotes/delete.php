<?php
    //headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: DELETE');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../models/Quote.php';

    //Instantiate DB & Connect
    $database = new Database();
    $db = $database ->connect();

    //Instantiate Author Object
    $quote = new Quote($db);

    // get raw posted data
    $data = json_decode(file_get_contents("php://input"));

    //set id to update

    $quote->id = $data->id;

    //delete author
    if($quote->delete()){
        echo json_encode(
            array('message' => 'Quote Deleted', 'id' => $quote->id)
        );
    } else {
        echo json_encode(
            array('message' => 'Quote Not Deleted')    
        );
    }

    ?>
