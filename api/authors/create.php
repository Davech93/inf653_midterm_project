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
    
    $author->author = $data->author;


    if(!$data->author){
      echo json_encode(array("message" => "Missing Required Parameters"));
    }

    if(!$data->id){
      echo json_encode(array("message" => "Missing Required Parameters"));
    }
    //if(isset($data->author)){
     //create author
     if($author->create()){
      //  echo json_encode(array("id" => $author->id,'message' => 'Author Deleted'));
       
        
      //  $author->id = $id;
        echo json_encode(array( "id"=>$author->id, "author" => $author->author));
      } else {
        $a = array("message" => "Missing Required Parameters");
        echo json_encode($a);
    } 
    
  
    ?>