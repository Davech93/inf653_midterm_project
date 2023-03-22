<?php
    //headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
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

    $quote->quote = $data->quote;
    //if(isset($data->quote)){
     //create quote
     if($quote->create()){
      //  echo json_encode(array("id" => $quote->id,'message' => 'Author Deleted'));
       
        
      //  $quote->id = $id;
        echo json_encode(array( "id"=>$quote->id, "quote" => $quote->quote, "author_id"=> $quote->author_id, "category_id" => $quote->category_id));
      } else {
        echo json_encode(array('message' => 'Missing Required Parameters'));
    } 

    ?>