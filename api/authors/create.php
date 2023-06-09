<?php
    //headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../models/Author.php';
    

    //Instantiate DB & Connect
    $database = new Database();
    $db = $database ->connect();

    //Instantiate Author Object
    $author = new Author($db);

    // get raw posted data
    $data = json_decode(file_get_contents("php://input"));
    //print_r($data);
    

    if(isset($data->author)){
      $author->author = $data->author;
     } else {
      echo json_encode(array("message"=>"Missing Required Parameters"));
      exit();
     }
      
    
    
     if($author->create()){
      
      $result = $author->lastId();
        
     
        echo json_encode(array( "id"=>$result, "author" => $author->author));
      } else {
        $a = array("message" => "Missing Required Parameters");
        echo json_encode($a);
    } 
    
  
    ?>