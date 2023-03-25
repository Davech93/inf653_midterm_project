<?php
    //headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: DELETE');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/Database.php';
    include '../../models/Quote.php';

    //Instantiate DB & Connect
    $database = new Database();
    $db = $database ->connect();

    //Instantiate Author Object
    $quote = new Quote($db);


    
    
    // get raw posted data
    $data = json_decode(file_get_contents("php://input"));
    // $quoteId = isset($_GET['id']) ? $_GET['id'] :die();

    if(isset($data->id)){
      $quote->id = $data->id;
    } else {
      echo json_encode(array('message' => 'Missing Required Parameters'));
        //echo json_encode(array( "id"=>null, "quote" => null, "author_id"=> null, "category_id" => null));
       
          exit();
    }

    $result2 = $quote->delete();
    echo json_encode($result2);
    
    if ($result2 == false){
      echo json_encode(array("message"=>"No Quotes Found"));
      exit();
    } else{
      echo json_encode(array("id"=>$result2);)
    }
          
    

    //set id to update
  


//   if(isset($_GET['id']) && $_GET['id'] == $quote->id){
//     $quote->delete();
//     $quote_arr = array('id' => $quote->id);
//         echo json_encode($quote_arr);
//         echo json_encode($_GET['id']);
//         echo json_encode($quote->id);
// } else {$a = array('message' => 'No Quotes Found');
//   echo json_encode($a);
// };

// $quote->id = isset($_GET['id']) ? $_GET['id'] :die();

// if($_GET['id'] == NULL){
//     $a = array('message' => 'No Quotes Found');
//     echo json_encode($a);
// } else {
//     $quote->read_single();

//     if($quote->id && $quote->quote) {
//         $quote->delete();
//         $quote_arr = array('id' => $quote->id);
//         echo json_encode($quote_arr);
//     }
//     else {
//         $a = array('message' => 'No Quotes Found');
//         echo json_encode($a);
//     }

// }




    ?>
