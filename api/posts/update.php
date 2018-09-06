<?php

header('Access-Controll-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Controll-Allow-Method: PUT');
header('Access-Controll-Allow-Header: Access-Controll-Allow-Header, Access-Controll-Allow-Method, Content-Type, Authorization, X-Requested-With');

require_once '../../config/Database.php';
require_once '../../models/Post.php';

// Instantiate Database
$database = new Database;
$db = $database->connect();

// Instantiate blog post and connect to DB
$post = new Post($db);

// Get inputed data
$data = json_decode(file_get_contents('php://input'));

$post->id = $data->id;
$post->title = $data->title;
$post->author = $data->author;
$post->body = $data->body;
$post->category_id = $data->category_id;

if($post->update()) {

	echo json_encode([
		"Message" => "Post updated!!"
	]);

} else {

	echo json_encode([
		"Message" => "Post NOT updated!"
	]);

}