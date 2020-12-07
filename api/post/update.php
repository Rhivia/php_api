<?php
/**
 * Headers
 */
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Methods, X-Requested-With, Authorization');
header('Content-Type: application/json');

require_once '../../config/Database.php';
require_once '../../models/Post.php';

/**
 * Instantiate DB & Connect
 */
$database = new Database;
$conn = $database->connect();

/**
 * Instatiate blog post object
 */
$post = new Post($conn);

/**
 * Get posted data
 */
$data = json_decode(file_get_contents('php://input'));

$post->id = $data->id;
$post->title = $data->title;
$post->body = $data->body;
$post->author = $data->author;
$post->category_id = $data->category_id;

/* Update post */
if ($post->update()) {
    echo json_encode(
        array('message' => 'Post Updated')
    );
} else {
    echo json_encode(
        array('message' => 'Post Not Updated')
    );
}