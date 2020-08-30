<?php

    $h = new Helper();
    $msg = '';
    $username = '';

    // If submit has been clicked 
    if (isset($_POST['submit'])) {
        
        // Send username to server
        $username = $_POST['username'];               

        // Require username and password
        if ($h->isEmpty(array($username, $_POST['password']))) {
            $msg = 'All fields are required';     
        }
        else {
            $member = new BlogMember($username);

            // Check for valid credentials 
            if (!$member->isValidLogin($_POST['password'])) {
                $msg = "Invalid Username or Password";
            }
            // Save username as session var, redirect to read.php
            else {
                $_SESSION['username'] = $username;
                header("Location: read.php");                
            }
        }
            
    }