<?php
/**
 * Headers
 */
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: DELETE');
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

/* Delete post */
if ($post->delete()) {
    echo json_encode(
        array('message' => 'Post Deleted')
    );
} else {
    echo json_encode(
        array('message' => 'Post Not Deleted')
    );
}