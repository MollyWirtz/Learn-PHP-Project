<?php 

class Helper{
    
    // Check if two passwords are equal
    public function passwordsMatch($pw1, $pw2) {
        if ($pw1 === $pw2)
            return true; 
        else 
            return false; 
    }
    
    // Check if length of string is between the min and max
    public function isValidLength($str, $min = 8, $max = 20) {
        if (strlen($str) < $min || $str.strlen($str) > $max)
            return false;
        else 
            return true; 
    }
    
    // Check if any of the elements in the array is an empty string 
    public function isEmpty($postValues) {
        foreach ($postValues as $value) {
            if ($value == false) {
                return true;
            }
        }
        return false; 
    }
    
    // Checks that password has at least once lowercase letter, one uppercase letter, and one digit 
    public function isSecure($pw) {
        if (preg_match("~[a-z]+~", $pw) && preg_match("~[A-Z]+~", $pw) && preg_match("~[0-9]+~", $pw))
            return true; 
        else 
            return false;        
    }
    
    // Preserve user input in a form when form is not processed successfully 
    //      $val - the values submitted by the user
    //      $type - the type of form element 
    //      $attr - string assigned to value attribute of a drop down list (default is '')
    public function keepValues($val, $type, $attr) {
        switch ($type) {
            case 'textbox':
                echo "value = '$val'";
                break; 
            case 'textarea':
                echo "value = '$val'"; // text between tags - not sure 
                break; 
            case 'select':
                if ($val == $attr) {
                    echo "value = '$val'"; 
                }
                break; 
            default:
                echo ''; 
        }
    }
    

}