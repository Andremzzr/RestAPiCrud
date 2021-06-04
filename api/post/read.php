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



$result = $post->read();


//GET row count

$num = $result->rowCount();

if ($num > 0 ) {
    // Post array

    $post_arr = [];
    $post_arr['data'] = array();
    
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        if ($category_name == null) {
            $category_name = 'This category was not found in the database';
        }

        $post_item = [
            'id'=>$id,
            'title'=>$title,
            'body' => html_entity_decode($body),
            'author' => $author,
            'category_id' => $category_id,
            'category_name' => $category_name
        ];

        array_push($post_arr['data'], $post_item);
    }
    //TURN TO JSON & OUTPUT
    echo json_encode($post_arr);
}else{
    echo json_encode(
        [
            'message'=> 'No posts Found'
        ]
        );
}