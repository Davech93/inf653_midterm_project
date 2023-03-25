<?php
    //headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: DELETE');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/Database.php';
    include '../../models/Quote.php';

    //Instantiate DB & Connect
    $database = new Database();
    $db = $database ->connect();

    //Instantiate Author Object
    $quote = new Quote($db);


    
    
    // get raw posted data
    $data = json_decode(file_get_contents("php://input"));
    

    if(isset($data->id)){
      $quote->id = $data->id;
    } else {
      echo json_encode(array('message' => 'Missing Required Parameters'));
        
       
          exit();
    }

    $result2 = $quote->isValidQuoId($quote);
    
    
    if ($result2 == false){
      echo json_encode(array("message"=>"No Quotes Found"));
      exit();
    } else{
      $quote->delete();
      echo json_encode(array("id"=>$result2));
    }
          
    

    ?>
