<?php
    //headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: DELETE');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../models/Quote.php';

    //Instantiate DB & Connect
    $database = new Database();
    $db = $database ->connect();

    //Instantiate Author Object
    $quote = new Quote($db);

    // get raw posted data
    // $data = json_decode(file_get_contents("php://input"));

    //set id to update
    if( isset($_REQUEST['id'])) {
        $id=$_REQUEST["id"];

    $quote->id = $id;

   //delete author
   if($category->delete()){
    //  echo json_encode(array("id" => $author->id,'message' => 'Author Deleted'));
    
    echo json_encode(array("id" => $category->id));
  } else {
    echo json_encode(array("id" => $id, 'message' => 'No Quotes Found'));
  }
} else {
  echo json_encode(array("id" => $category->id, 'message' => 'No Quotes Found'));
}

    ?>
