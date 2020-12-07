<?php
class Post
{
    // Database connection
    private $_conn;
    private $_table = 'posts';

    // Post properties
    public $id;
    public $category_id;
    public $category_name;
    public $title;
    public $body;
    public $author;
    public $created_at;

    /** 
     * Constructor
     * 
     * @param $db
     */
    public function __construct($db)
    {
        $this->_conn = $db;
    }

    /**
     * Get Posts
     */
    public function read()
    {
        /**
         * Create query
         */
        $query = 'SELECT 
                c.name as category_name,
                p.id,
                p.category_id,
                p.title,
                p.body,
                p.author,
                p.created_at
            FROM 
                ' . $this->_table . ' p 
            LEFT JOIN
                categories c ON p.category_id = c.id
            ORDER BY
                p.created_at DESC';

        /**
         * Prepate statement
         */
        $stmt = $this->_conn->prepare($query);

        /**
         * Execute query
         */
        $stmt->execute();

        return $stmt;
    }
}