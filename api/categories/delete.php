<?php
    //headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: DELETE');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../models/Category.php';

    //Instantiate DB & Connect
    $database = new Database();
    $db = $database ->connect();

    //Instantiate Author Object
    $category = new Category($db);

    // get raw posted data
    
    if( isset($_REQUEST['id'])) {
        $id=$_REQUEST["id"];

    //set id to update

    $category->id = $id;

     //delete author
     if($category->delete()){
        
        
        echo json_encode(array("id" => $category->id));
      } else {
          echo json_encode(array("id" => $id,"message" => "Category Not Deleted"));
      }
  } else {
      echo json_encode(array("id" => '0'));
  }

    ?>
