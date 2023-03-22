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
    // $data = json_decode(file_get_contents("php://input"));
    if(!isset($_REQUEST['id'])) {
      $id=$_REQUEST["id"];
      $author->id = $id;
      $author->author = $author;
    
    
     
     //delete author
     if($author->create()){
      //  echo json_encode(array("id" => $author->id,'message' => 'Author Deleted'));
      
      echo json_encode(array("id" => $id, "author" => $author));
    } else {
        echo json_encode(array("id" => $id,'message' => 'Author Not Created'));
    } else {
    echo json_encode(array('message' => 'Missing Required Parameters'));
  }
}
    ?>