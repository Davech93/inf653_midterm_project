<?php
    //headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../models/Quote.php';
    include_once '../../models/Category.php';
    include_once '../../models/Author.php';

    //Instantiate DB & Connect
    $database = new Database();
    $db = $database ->connect();

    //Instantiate Author Object
    $quote = new Quote($db);
    $category = new Category($db);
    $author = new Author($db);

    // get raw posted data
   
    $data = json_decode(file_get_contents("php://input"));
    
   if(isset($data->category_id)){
    $category->id= $data->category_id;
   }
   
   if(isset($data->category_id)){
    $quote->category_id =$data->category_id;
  } else {
    echo json_encode(array('message' => 'Missing Required Parameters'));
      
     
        exit();
  }
    
   if(isset($data->author_id)){
     $author->id = $data->author_id;
   } else{
    echo json_encode(array('message' => 'Missing Required Parameters'));
     
     
        exit();
   }

   if(isset($data->author_id)){
    $quote->author_id=$data->author_id;
  }
   if(isset($data->quote)){ 
     $quote->quote = $data->quote;
   } else {
    echo json_encode(array('message' => 'Missing Required Parameters'));
     
     
        exit();
   }
   
     
     
     $result2 = $author->isValidAutId($author);
     $result = $category->isValidCatId($category);

     if ($result2 == false){
      echo json_encode(array("message"=>"author_id Not Found"));
      exit();
       } else if ($result == false) {
        echo json_encode(array("message"=>"category_id Not Found"));
        exit();
       } else if ($quote->create()){
        $result = $quote->lastId();
        echo json_encode(array("id" => $result, "quote" => $quote->quote, "author_id"=> $quote->author_id, "category_id" => $quote->category_id));
  } else {
    echo json_encode(array("message"=>"category_id Not Found"));
  }

       
        
    ?>