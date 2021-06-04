<?php


//HEADERS

header("Acces-Control-Allow-Origin: *");
header('Content-Type: aplication/json');


include_once '../../config/Database.php';
include_once '../../models/Category.php';



//Instantiate DB & connect
$database = new Database();
$db = $database->connect();



//instiate category 

$category = new Category($db);



$result = $category->read();


//GET row count

$num = $result->rowCount();

if ($num > 0 ) {
    // CATEGORY array

    $category_arr = array();
    $category_arr['data'] = array();
    
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $category_item = array(
            'id'=>$id,
            'name'=>$name
        );

        array_push($category_arr['data'], $category_item);

        //TURN TO JSON & OUTPUT
        

    }

    echo json_encode($category_arr);
}else{
    echo json_encode(
        [
            'message'=> 'No categories Found'
        ]
        );
}