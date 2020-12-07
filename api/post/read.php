<?php
/**
 * Headers
 */
header('Access-Control-Allow-Origin: *');
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
 * Blog post query
 */
$result = $post->read();

/**
 * Get row count
 */
$num = $result->rowCount();

/**
 * Verify posts
 */
if ($num > 0) {
    $posts_arr = array();
    $posts_arr['data'] = array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $post_item = array(
            'id' => $id,
            'title' => $title,
            'body' => html_entity_decode($body),
            'author' => $author,
            'category_id' => $category_id,
            'category_name' => $category_name,
        );

        /**
         * Push Data
         */
        array_push($posts_arr['data'], $post_item);
    }

    /**
     * Translate to JSON
     */
    echo json_encode($posts_arr);
} else {
    echo json_encode(
        array('message' => 'No Posts Found')
    );
}