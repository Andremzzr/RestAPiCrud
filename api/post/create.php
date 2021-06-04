<?php

//HEADERS

header("Acces-Control-Allow-Origin: *");
header('Content-Type: aplication/json');
header('Acces-Control-Allow-Methods: POST');
header('Acess-Control-Allow-Headers: Acess-Control-Allow-Headers,Content-Type,Acces-Control-Allow-Methods,Authorization,X-Request-With');


include_once '../../config/Database.php';
include_once '../../models/Post.php';

//Instantiate DB & connect
$database = new Database();
$db = $database->connect();

//instiate post 

$post = new Post($db);


//GET RAW POSTED DATA

$data = json_decode(file_get_contents("php://input"));

$post->title = $data->title;
$post->body = $data->body;
$post->author = $data->author;
$post->category_id = $data->category_id;

if ($post->createPost()) {
    echo json_encode(
        array("message" => "Post Created")
    );
}else{
    echo json_encode(
        array("message" => "Post Not created")
    );
}