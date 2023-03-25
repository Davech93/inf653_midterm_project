<?php
    //headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: DELETE');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../models/Author.php';

    //Instantiate DB & Connect
    $database = new Database();
    $db = $database ->connect();

    //Instantiate Author Object
    $author = new Author($db);

    // get raw posted data
   
   if( isset($_REQUEST['id'])) {
   $id=$_REQUEST["id"];
   
    //set id to update
 
    $author->id = $id;

    //delete author
    if($author->delete()){
      
      
      echo json_encode(array("id" => $author->id));
    } else {
        echo json_encode(array("id" => $id,'message' => 'Author Not Deleted'));
    }
} else {
    echo json_encode(array("id" => '0'));
}

    ?>
