<?php
    //headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Category.php';

    //Instantiate DB & Connect
    $database = new Database();
    $db = $database ->connect();

    //Instantiate Category Object
    $category = new Category($db);

    //get ID from url
    $category->id = isset($_GET['id']) ? $_GET['id'] : die();

    if($_GET['id'] == NULL){
        $a = array('message' => 'category_id Not Found');
        echo json_encode($a);
    } else {
        $category->read_single();

        if($category->id && $category->category) {
            $category_arr = array(
                'id' => $category->id,
                'category' => $category->category);
            echo json_encode($category_arr);
        }
        else {
            $a = array('message' => 'category_id Not Found');
            echo json_encode($a);
        }
        
    }


    ?>