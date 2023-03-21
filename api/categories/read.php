<?php
    //headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Category.php';

    //Instantiate DB & Connect
    $database = new Database();
    // Connect to the database
    $db = $database->connect();
    

    //Instantiate Category Object
    $category = new Category($db);

    //Author Query
    $result = $category->read();

    //Get row count
    $num = $result->rowCount();

    //Check if any category
    if($num > 0){
        //Author Array
        $category_arr = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);

            $category_item = array(
                'category' => $category,
                'id' => $id
            );

        }

        //turn to json & output
        echo json_encode($category_arr);

    } else {
        //No Authors
        echo json_encode(
            array('message' => 'No categories found')
        );
    }
    ?>