<?php

header('Access-Controll-Allow-Origin: *');
header('Content-Type: application/json');

require_once '../../config/Database.php';
require_once '../../models/Post.php';

// Instantiate new DB object
$database = new Database;
$db = $database->connect();

// Instantiate blog post and connect to DB
$post = new Post($db);

$result = isset($_GET['id']) ? $post->single($_GET['id']) : die();

$result = $result->fetch(PDO::FETCH_OBJ);

if($result != false) {

	$post_arr = [];
	$post_arr['data'] = [
		'title' => $result->title,
		'body' => $result->body,
		'author' => $result->author,
		'category_id' => $result->category_id
	];

	echo json_encode($post_arr);

} else {

	echo json_encode([
		"Message" => "No posts with selected id found!"
	]);
}