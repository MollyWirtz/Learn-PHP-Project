<?php

class BlogReader{

    const READER = 1;
    const MEMBER = 2;
    
    protected $db;
    protected $type;

    public function __construct(){
        
        $this->db = new Database();
        $this->type = BlogReader::READER;
    }    
    
    
    public function getPostsFromDB() {
        $sql = "SELECT id, unix_timestamp(post_date) as `post_date`, username, title, post, audience FROM posts WHERE audience <= :audience ORDER BY id DESC"; 
        
        // 2D array with inner array bound to placeholder :audience 
        $values = array(array(':audience', $this->type));
        
        // Use Database object to call queryDB(), passing sql statment, mode, and values array
        $result = $this->db->queryDB($sql, Database::SELECTALL, $values); 
        
        //isset?
        if ($result)
            return $result; 
        else 
            return false; 
    }
    
}
