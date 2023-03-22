<?php
    //headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: PUT');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../models/Quote.php';

    //Instantiate DB & Connect
    $database = new Database();
    $db = $database ->connect();

    //Instantiate Category Object
    $quote = new Quote($db);

    // get raw posted data
    // $data = json_decode(file_get_contents("php://input"));
   

    $quote->id = $id;
    //set id to update
    $quote->id = $data->id;
    $quote->quote = $data->quote;
    $quote->author_id = $data->author_id;
    $quote->category_id = $data->category_id;


    if($quote->update()){
        echo json_encode(
            array('id'=>$quote->id, 'quote'=>$quote->quote, 'author_id'=>$quote->author_id, 'category_id'=>$quote->category_id)
        );
    } else if( !isset($_REQUEST['id'])) {
        echo json_encode(
            array('message' => 'No Quotes Found')    
        );
    } else if (!isset($_REQUEST['author_id'])){
        echo json_encode(
            array('message' => 'author_id Not Found') 
        );
    } else if (!isset($_REQUEST['category_id'])){
        echo json_encode(
            array('message' => 'author_id Not Found')
        );
    } else{
        echo json_encode(
            array('message' => 'Missing Required Parameters')
        );
    }
    ?>
