<?php

class BlogMember extends BlogReader {
    private $username; 
    
    public function __construct($pUsername) {
        
        parent::__construct(); 
        
        $this->username = $pUsername; 
        $this->type = BlogMember::MEMBER;
    }
    
    // Makes sure user signing up doesn't already exist
    public function isDuplicateID() {
        $sql = "SELECT count(username) AS num FROM members WHERE username = :username"; 
        
        $values = array(array(':username', $this->username));

        $result = $this->db->queryDB($sql, Database::SELECTSINGLE, $values); 
        
        if ($result['num'] == 0)
            return false; 
        else 
            return true; 
    }
    
    // Insert a new row into the members table when a new user signs up 
    public function insertIntoMemberDB($pPassword) {
        $sql = "INSERT INTO members (username, password) VALUES (:username, :password)"; 
        
        $values = array(
            array(':username', $this->username),
            array(':password', password_hash($pPassword, PASSWORD_DEFAULT))
        );
        
        $this->db->queryDB($sql, Database::EXECUTE, $values); 
    }
    
    // Checks if username and password are valid at login 
    public function isValidLogin($pPassword) {
        $sql = "SELECT password FROM members WHERE username = :username"; 
        
        $values = array(array(':username', $this->username)); 
        
        $result = $this->db->queryDB($sql, Database::SELECTSINGLE, $values); 
        
        // Check that queryDB fetched a password and user input matches it 
        if (isset($result['password']) && password_verify($pPassword, $result['password']))
            return true; 
        else
            return false;
    }
    
    // 
    private function getLatestPostID() {
        $sql = "SELECT max(id) AS max FROM posts"; 
        
        $result = $this->db->queryDB($sql, Database::SELECTSINGLE); 
        
        if (isset($result['max']))
            return $result['max']; 
        else 
            return 0;
    }
    
    // 
    public function updateLastViewedPost() {
        $max = $this->getLatestPostID(); 
        
        $sql = "UPDATE members SET last_viewed = :max WHERE username = :username"; 
        
        $values = array(
            array(':username', $this->username), 
            array(':max', $max), 
        ); 
        
        $this->db->queryDB($sql, Database::EXECUTE, $values); 
    }
    
    // 
    public function getLastViewedPost() {
        $sql = "SELECT last_viewed FROM members WHERE username = :username"; 
        
        $values = array(array(':username', $this->username)); 
        
        $result = $this->db->queryDB($sql, Database::SELECTSINGLE, $values); 
        
        if (isset($result['last_viewed']))
            return $result['last_viewed']; 
        else 
            return 0; 
    }
    
    
}



