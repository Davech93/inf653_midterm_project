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
    // $data = json_decode(file_get_contents("php://input"));
    $auth_id = isset($_REQUEST['author_id']) ? $_REQUEST['author_id'] : die();
    $cat_id = isset($_REQUEST['category_id']) ? $_REQUEST['category_id'] : die();
    $quote->author_id = $auth_id;
    $quote->category_id = $cat_id;
     
    //if(isset($data->quote)){
      if (!$cat_id || !$auth_id){
        echo json_encode(array('message' => 'Missing Required Parameters'));
        exit();
      }
     
     $result = $category->isValidCatId($quote);
     $result2 = $author->isValidAutId($quote);
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