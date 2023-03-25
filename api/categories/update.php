<?php
    //headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: PUT');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../models/Category.php';

    //Instantiate DB & Connect
    $database = new Database();
    $db = $database ->connect();

    //Instantiate Category Object
    $category = new Category($db);

    // get raw posted data
    $data = json_decode(file_get_contents("php://input"));

    //set id to update
   
    if(isset($data->id)){
        $category->id = $data->id;
       } else {
        echo json_encode(array("message"=>"Missing Required Parameters"));
        exit();
       }
       if(isset($data->category)){
        $category->category = $data->category;
       } else {
        echo json_encode(array("message"=>"Missing Required Parameters"));
        exit();
       }


    //update post
    if($category->update()){
        echo json_encode(
            array('id'=>$category->id, 'category'=>$category->category)
        );
    } else {
        echo json_encode(
            array("message"=>"Missing Required Parameters")    
        );
    }

    ?>
