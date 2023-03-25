<?php
    //headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: PUT');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../models/Quote.php';
    include_once '../../models/Author.php';
    include_once '../../models/Category.php';

    //Instantiate DB & Connect
    $database = new Database();
    $db = $database ->connect();

    //Instantiate Category Object
    $quote = new Quote($db);

    // get raw posted data
    $data = json_decode(file_get_contents("php://input"));

    if(isset($data->id)){
        $quote->id = $data->id;
       } else {
        echo json_encode(array("message"=>"Missing Required Parameters"));
        exit();
       }
       if(isset($data->quote)){
        $quote->quote = $data->quote;
       } else {
        echo json_encode(array("message"=>"Missing Required Parameters"));
        exit();
       }
       if(isset($data->author_id)){
        $author->id = $author->author_id;
       } else {
        echo json_encode(array("message"=>"Missing Required Parameters"));
        exit();
       }
       if(isset($data->category_id)){
        $category->id = $data->category_id;
       } else {
        echo json_encode(array("message"=>"Missing Required Parameters"));
        exit();
       }
   


    
        $result1 = $quote->isValidQuoId($quote);
        $result2 = $author->isValidAutId($author);
        $result3 = $category->isValidCatId($category);
            
        if($result1 == false) {
        echo json_encode(array('message' => 'No Quotes Found'));
        exit();
         } else if ($result2 == false){
        echo json_encode(array('message' => 'author_id Not Found'));
         } else if ($result3 == false){
        echo json_encode(array('message' => 'author_id Not Found'));
         } else {
            $quote->update();
            echo json_encode(array("id"=>$result1, "quote"=>$quote->quote, "author_id"=>$author->id,"category_id"=>$category->id ));
         }
    
    ?>
