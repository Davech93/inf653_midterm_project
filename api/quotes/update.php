<?php
    //headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: PUT');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../models/Quote.php';
    include_once '../../models/Category.php';
    include_once '../../models/Author.php';
    

    //Instantiate DB & Connect
    $database = new Database();
    $db = $database ->connect();

    //Instantiate Category Object
    $quote = new Quote($db);
    $category = new Category($db);
    $author = new Author($db);


    // get raw posted data
    $data = json_decode(file_get_contents("php://input"));
    // echo json_encode($data->id);
    // echo json_encode($data->quote);
    // echo json_encode($data->author_id);
    // echo json_encode($data->category_id);


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
        $quote->author_id = $data->author_id;
        
       } else {
        echo json_encode(array("message"=>"Missing Required Parameters"));
        exit();
       }
       if(isset($data->category_id)){
        $quote->category_id = $data->category_id;
       
       } else {
        echo json_encode(array("message"=>"Missing Required Parameters"));
        exit();
       }
       if(isset($data->category_id)){
        $category->id = $data->category_id;
       
       }
       if(isset($data->author_id)){
        $author->id = $data->category_id;
       
       }

    
        $result = $quote->isValid($quote, $quote->id);
        if ($result == false){
        echo json_encode(array('message' => 'No Quotes Found'));
        exit();   
        }  
        $result2 = $author->isValid($author, $author->id);
        if ($result2 == false){
         echo json_encode(array('message' => 'author_id Not Found'));
         exit();   
        }
        $result3 = $category->isValid($category, $category->id);
        if ($result3 == false){
        echo json_encode(array('message' => 'category_id Not Found'));
        exit();
        }

            $quote->update();
            echo json_encode(array('id' => $quote->id, 'quote' => $quote->quote, 'author_id' => $quote->author_id, 'category_id' => $quote->category_id));
    
   
    //    echo ($quote->author_id);
    //    echo ($quote->category_id);
       

        // $category->id = $data->category_id;
        // $author->id = $data->author_id;
    
        // $result1 = $quote->isValidQuoId($quote);
        // $result2 = $quote->isValidAutId();
        // $result3 = $quote->isValidCatId();
        // $result3 = $category->isValidCatId($category);
        
        // echo json_encode($result1);
        // echo json_encode($result2);
        // echo json_encode($result3);
         
        
            
        // if($result1 == false) {
        // echo json_encode(array('message' => 'No Quotes Found'));
        // exit();
        //  } else if ($result2 == false) {
        //     echo json_encode(array('message' => 'author_id Not Found'));
        //     exit();
        //     } else if ($result3 == false) {
        //         echo json_encode(array('message' => 'category_id Not Found'));
        //         exit();
        //         }  
                
    
    ?>
