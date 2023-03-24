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
    //$data = json_decode(file_get_contents("php://input"));
    $data = $_REQUEST;
    print_r($data);

     $author->id = $data['author_id'];
     $category->id= $data['category_id'];
     $quote->quote = $data['quote'];
    //if(isset($data->quote)){
      if (!$data['author_id'] || !$data['category_id']){
        echo json_encode(array('message' => 'Missing Required Parameters'));
        exit();
      }
     
     $result = $category->isValidCatId($category->id);
     $result2 = $author->isValidAutId($author->id);
     
     if ($result == true && $result2 == true){
        if($quote->create()){
      echo json_encode(array( "id"=>$quote->id, "quote" => $quote->quote, "author_id"=> $quote->author_id, "category_id" => $quote->category_id));
      } else if ($result1 == false) {
      echo json_encode(array("category_id Not Found"));
      exit();
     } else if ($result2 == false){
      echo json_encode(array("author_id Not Found"));
      exit();
     } else {
      echo json_encode(array('message' => 'Missing Required Parameters'));
      exit();
     }
    }

    
   
        
      //  $quote->id = $id;

       
// seperate queries to the author or category tables WHERE id =
// and if nothing found return that
    ?>