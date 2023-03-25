<?php
    //headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: PUT');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../models/Quote.php';
    

    //Instantiate DB & Connect
    $database = new Database();
    $db = $database ->connect();

    //Instantiate Category Object
    $quote = new Quote($db);
    $author = new Author($db);
    $category = new Category($db);

    // get raw posted data
    // $data = json_decode(file_get_contents("php://input"));

    if(isset($_GET['id'])){
        $quote->id = $_GET['id'];
       } else {
        echo json_encode(array("message"=>"Missing Required Parameters"));
        exit();
       }
       if(isset($_GET['quote'])){
        $quote->quote = $_GET['quote'];
       } else {
        echo json_encode(array("message"=>"Missing Required Parameters"));
        exit();
       }
       if(isset($_GET['author_id'])){
        $quote->$author_id = $_GET['author_id'];
       } else {
        echo json_encode(array("message"=>"Missing Required Parameters"));
        exit();
       }
       if(isset($_GET['category_id'])){
        $quote->$category_id = $_GET['category_id'];
       } else {
        echo json_encode(array("message"=>"Missing Required Parameters"));
        exit();
       }
   


    
        $result1 = $quote->read_single3Param($quote);
        
        echo json_encode($result1);
        
            
        if($result1 == false) {
        echo json_encode(array('message' => 'No Quotes Found'));
        exit();
         } 
            
            

            if($quote->update()){
            echo json_encode(array("id"=>$result1, "quote"=>$quote->quote, "author_id"=>$author->id,"category_id"=>$category->id ));
         } else {
            echo json_encode(array('message' => 'No Quotes Found'));
         }
    
    ?>
