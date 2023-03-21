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
    $data = json_decode(file_get_contents("php://input"));

    $author->author = $data->author;
    $author->id = $data->id;

                $data->id =$row['id'];
                $check_arr = array('id' => $data->id, 'author' => $data->author);
                echo(json_encode($check_arr));
     

        //create post
    if($author->create()){
        echo json_encode(
            array('message' => 'Author Created')
        ); 
    } else {
        echo json_encode(
            array('message' => 'Author  Not Created')
        );
    }
    ?>