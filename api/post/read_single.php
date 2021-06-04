<?php

//HEADERS

header("Acces-Control-Allow-Origin: *");
header('Content-Type: aplication/json');


include_once '../../config/Database.php';
include_once '../../models/Post.php';

//Instantiate DB & connect
$database = new Database();
$db = $database->connect();

//instiate post 

$post = new Post($db);

//GET ID FROM URL

$post->id = isset($_GET['id']) ? $_GET['id'] : die();

$post->readSingle();

//RETURN JSON DATA

$post_array = [
    'id' => $post->id,
    'title' => $post->title,
    'body' => $post->body,
    'author' => $post->author,
    'category_id' => $post->category_id,
    'category_name' => $post->category_name
];


print_r(json_encode($post_array));