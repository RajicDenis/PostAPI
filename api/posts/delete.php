<?php

header('Access-Controll-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Controll-Allow-Method: DELETE');
header('Access-Controll-Allow-Header: Access-Controll-Allow-Header, Access-Controll-Allow-Method, Content-Type, Authorization, X-Requested-With');

require_once '../../config/Database.php';
require_once '../../models/Post.php';

// Instantiate Database
$database = new Database;
$db = $database->connect();

// Instantiate blog post and connect to DB
$post = new Post($db);

$data = json_decode(file_get_contents('php://input'));

$post->id = $data->id;

if($post->delete()) {

	echo json_encode([
		"Message" => "Post successfuly deleted!"
	]);
} else {

	echo json_encode([
		"Message" => "Post not deleted!"
	]);
}