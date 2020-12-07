<?php
/**
 * Headers
 */
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
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

$post->title = $data->title;
$post->body = $data->body;
$post->author = $data->author;
$post->category_id = $data->category_id;

/* Create post */
if ($post->create()) {
    echo json_encode(
        array('message' => 'Post Created')
    );
} else {
    echo json_encode(
        array('message' => 'Post Not Created')
    );
}