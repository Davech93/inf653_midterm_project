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
   

     $author->id = $data['author_id'];
     $category->id= $data['category_id'];
     $quote->quote = $data['quote'];
     $quote->category=$category;
     $quote->author=$author;
    //if(isset($data->quote)){
      if (!$data['author_id'] || !$data['category_id']){
        echo json_encode(array('message' => 'Missing Required Parameters'));
        exit();
      }
     
     $result = $category->isValidCatId($category);
     $result2 = $author->isValidAutId($author);
     
     if ($result == true && $result2 == true){
      $id= $quote->create();
    

        if($id>0){

      echo json_encode(array( "id"=>$id, "quote" => $quote->quote, "author_id"=> $quote->author_id, "category_id" => $quote->category_id));
      } else if ($result == false) {
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