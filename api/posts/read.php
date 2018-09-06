<?php

header('Access-Controll-Allow-Origin: *');
header('Content-Type: application/json');

require_once '../../config/Database.php';
require_once '../../models/Post.php';

// Connect to DB
$database = new Database;
$db = $database->connect();

// Instantiate new blog post
$post = new Post($db);

// Get number of posts
$result = $post->read();
$num = $result->rowCount();

$post_arr = [];
$post_arr['data'] = [];

// Check if there are blog posts in db
if($num > 0) {

	while($row = $result->fetch(PDO::FETCH_ASSOC)) {
	extract($row);

	$post_item = [
		'title' => $title,
		'author' => $author,
		'body' => $body,
		'category_id' => $category_id,
	];

	array_push($post_arr['data'], $post_item);

	}

	echo json_encode($post_arr);

} else {

	// If no blog posts...
	echo json_encode([
		"Message" => "No Posts in database!"
	]);

}

