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
    if( isset($_REQUEST['id']) && isset($_REQUEST['author_id']) && isset($_REQUEST['category_id'])) {
      $id=$_REQUEST["id"];
      $quote->id = $id;
      $author_id=$_REQUEST['author_id'];
      $author->id = $author_id;
      $category_id=$REQUEST['category_id'];
      $category->id = $category_id;
    //if(isset($data->quote)){
     //create quote
     
     if($quote->create()){
      //  echo json_encode(array("id" => $quote->id,'message' => 'Author Deleted'));
        if(!$category->read_single($category_id) || (!isset(_REQUEST['category_id']))){
          echo json_encode(array("category_id Not Found"));
     
      } else if(!$author->read_single($author_id) || (!isset(_REQUEST['author_id']))){
          echo json_encode(array("author_id Not Found"));
        
     } else if ($author->read_single($author_id) && $category->read_single($category_id)){}
          
        echo json_encode(array( "id"=>$quote->id, "quote" => $quote->quote, "author_id"=> $quote->author_id, "category_id" => $quote->category_id));
      } 
      
      }else {
        echo json_encode(array('message' => 'Missing Required Parameters'));
      }
   
        
      //  $quote->id = $id;

       
// seperate queries to the author or category tables WHERE id =
// and if nothing found return that
    ?>