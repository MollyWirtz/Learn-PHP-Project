<?php

    $h = new Helper();
    $msg = '';
    $username = '';

    if (isset($_POST['submit'])) {
        
        $username = $_POST['username']; 
        
        if ($h->isEmpty(array($username, $_POST['password']))) {
            $msg = 'All fields are required'; 
        } 
        
        // Check username is between 6-100 characters
        else if (strlen($username) < 6 || strlen($username) > 100) {
                $msg = 'Username must be between 6 and 100 characters'; 
        }
                
        // Check password is between 8-20 characters
        else if (!$h->isValidLength($_POST['password'])) {
            $msg = 'Password must be between 8 and 20 characters';
        }
                
        // Check password has at least 1 lowercase letter, 1 uppercase letter, and one digit
        else if (!$h->isSecure($_POST['password'])) {
            $msg = 'Password must have at least 1 lowercase letter, 1 uppercase letter, and one digit'; 
        }
                        
        // Check password and confirm password match 
        else if (!$h->passwordsMatch($_POST['password'], $_POST['confirm_password'])) {
            $msg = 'Passwords do not match'; 
        }
                        
        else {
            $b = new BlogMember($username); 
            if ($b->isDuplicateID()) {
                $msg = 'This username already exists';
            } 
                            
            else {
                $b->insertIntoMemberDB($_POST['password']); 
                header("Location: index.php?new=1"); 
            }    
        }
    } 
            