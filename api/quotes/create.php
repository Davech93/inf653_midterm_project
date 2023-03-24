<?php
    //headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../models/Quote.php';
    include '../../models/Category.php';
    include '../../models/Author.php';

    //Instantiate DB & Connect
    $database = new Database();
    $db = $database ->connect();

    //Instantiate Author Object
    $quote = new Quote($db);
    $category = new Category($db);
    $author = new Author($db);

    // get raw posted data
    // $data = json_decode(file_get_contents("php://input"));
    $data = json_decode(file_get_contents("php://input"));
    // $data = $_REQUEST;
   if(isset($data->category_id)){
    $category->id= $data->category_id;
   } else{
    echo json_encode(array('message' => 'Missing Required Parameters'));
    exit();
   }
   if(isset($data->category_id)){
    $quote->category_id =$data->category_id;
  } else{
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
  } else{
    echo json_encode(array('message' => 'Missing Required Parameters'));
    exit();
  }
   if(isset($data->quote)){ 
     $quote->quote = $data->quote;
   }
   
     
     $result = $category->isValidCatId($category);
     $result2 = $author->isValidAutId($author);
     echo json_encode($result);
     echo json_encode($result2);
     
     if ($result == true && $result2 == true){
      $id= $quote->create();
   
     }
     if ($result == false) {
      echo json_encode(array("message"=>"category_id Not Found"));
      die();
     }
     if ($result2 == false){
      echo json_encode(array("message"=>"author_id Not Found"));
     
      die();
      }
    if($id>0){
     echo json_encode(array( "id"=>$id, "quote" => $quote->quote, "author_id"=> $quote->author_id, "category_id" => $quote->category_id));
        die();
     } else {
     echo json_encode(array('message' => 'Missing Required Parameters'));
      //echo json_encode(array( "id"=>null, "quote" => null, "author_id"=> null, "category_id" => null));
     
        die();
      }
    
   
        
      //  $quote->id = $id;

       
// seperate queries to the author or category tables WHERE id =
// and if nothing found return that
    ?>