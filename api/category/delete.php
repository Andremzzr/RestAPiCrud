<?php


//HEADERS
header("Acces-Control-Allow-Origin: *");
header('Content-Type: aplication/json');
header('Acces-Control-Allow-Methods: DELETE');
header('Acess-Control-Allow-Headers: Acess-Control-Allow-Headers,Content-Type,Acces-Control-Allow-Methods,Authorization,X-Request-With');



include_once '../../config/Database.php';
include_once '../../models/Category.php';



//Instantiate DB & connect
$database = new Database();
$db = $database->connect();



//instiate category 

$category = new Category($db);


//GET RAW POSTED DATA

$data = json_decode(file_get_contents("php://input"));


$category->id = $data->id;





if ($category->delete()) {
    echo json_encode(
        array("message" => "Category Deleted")
    );
}else{
    echo json_encode(
        array("message" => "Category Not Deleted")
    );
}