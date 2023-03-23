<?php
    //headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../models/Quote.php';
    include_once '../../models/Categories.php';
    include_once '../../models/Authors.php';

    //Instantiate DB & Connect
    $database = new Database();
    $db = $database ->connect();

    //Instantiate Author Object
    $quote = new Quote($db);
    $category = new Category($db);
    $author = new Author($db);

    // get raw posted data
    $data = json_decode(file_get_contents("php://input"));

    $author->id = $data->author_id;
    $category->id = $data->category_id;
    $quote->quote = $data->quote;
    //if(isset($data->quote)){
     //create quote
     
     if($quote->create()){
      //  echo json_encode(array("id" => $quote->id,'message' => 'Author Deleted'));
        if(!$category->read_single()){
          echo json_encode(array("category_id Not Found"));
     
      } else if(!$author->read_single()){
          echo json_encode(array("author_id Not Found"));
        
     } else if ($author->read_single() && $category->read_single()){}
          
        echo json_encode(array( "id"=>$quote->id, "quote" => $quote->quote, "author_id"=> $quote->author_id, "category_id" => $quote->category_id));
      } else {
        echo json_encode(array('message' => 'Missing Required Parameters'));
      }
   
        
      //  $quote->id = $id;

       
// seperate queries to the author or category tables WHERE id =
// and if nothing found return that
    ?>