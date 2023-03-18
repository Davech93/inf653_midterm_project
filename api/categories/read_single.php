<?php
    //headers
    header('Acces-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Author.php';

    //Instantiate DB & Connect
    $database = new Database();
    $db = $database ->connect();

    //Instantiate Category Object
    $category = new Category($db);

    //get ID from url
    $category->id = isset($_GET['id']) ? $_GET['id'] : die();

    //Get post
    $category->read_single();

    //create array
    $category_arr = array(
        'category' => $category->category,
        'id' => $category->id
    );
    
    //make json
    print_r(json_encode($category_arr));


    ?>