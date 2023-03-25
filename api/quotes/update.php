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
    $data = json_decode(file_get_contents("php://input"));
    echo json_encode($data->id);
    echo json_encode($data->quote);
    echo json_encode($data->author_id);
    echo json_encode($data->category_id);


    if(isset($data->id)){
        $quote->id = $data->id;
       } else {
        echo json_encode(array("message"=>"Missing Required Parameters"));
        exit();
       }
       if(isset($data->quote)){
        $quote->quote = $data->quote;
       } else {
        echo json_encode(array("message"=>"Missing Required Parameters"));
        exit();
       }
       if(isset($data->author_id)){
        $quote->author_id = $data->author_id;
       } else {
        echo json_encode(array("message"=>"Missing Required Parameters"));
        exit();
       }
       if(isset($data->category_id)){
        $quote->category_id = $data->category_id;
       } else {
        echo json_encode(array("message"=>"Missing Required Parameters"));
        exit();
       }
   


    
        $result1 = $quote->read_single3Param();
        
        echo json_encode($result1);
        
            
        if($result1 == false) {
        echo json_encode(array('message' => 'No Quotes Found'));
        exit();
         } 
            
            

            if($quote->update()){
            echo json_encode(array("id"=>$result1, "quote"=>$quote->quote, "author_id"=>$quote->author_id,"category_id"=>$quote->category_id ));
         } else {
            echo json_encode(array('message' => 'No Quotes Found'));
         }
    
    ?>
