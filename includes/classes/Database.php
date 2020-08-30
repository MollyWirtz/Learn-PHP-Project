<?php

class Database{        

    const SELECTSINGLE = 1;
    const SELECTALL = 2;
    const EXECUTE = 3;
        
    private $pdo;

    public function __construct(){
        
        $this->pdo = new PDO("mysql:host=localhost;dbname=project", "project_admin", "admin");
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
        
    }

    // Function for querying our database
    //      $sql - the SQL statement to be executed
    //      $mode - whether the method needs to fetch any rows from the database 
    //      $values - binding variables to placeholders, default value of array()
    public function queryDB($sql, $mode, $values=array()) {
        $this->pdo = new PDO("mysql:host=localhost;dbname=project", "project_admin", "admin"); 
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
        
        $stmt = $this->pdo->prepare($sql); 
        
        foreach($values as $valueToBind) {
            $stmt->bindValue($valueToBind[0], $valueToBind[1]); 
        }
        
        $stmt->execute(); 
        
        if ($mode != Database::SELECTSINGLE && $mode != Database::SELECTALL && $mode != Database::EXECUTE) {
            throw new Exception('Invalid Mode'); 
        } else if ($mode === self::SELECTSINGLE) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } else if ($mode === self::SELECTALL) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }
    
}
    