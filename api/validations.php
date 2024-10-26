<?php

    namespace inputValidations;

    // Name
    function validate_name($input) {
        $input = trim($input);
        $input = filter_var($input, FILTER_SANITIZE_STRING);

        if (empty($input)) { 
            return false; 
        }
        else if(preg_match("/^[a-zA-Z\/ ]{3,100}$/",$input)) {
            return $input;
        }
        else {
            return false;
        }

    }

    // Gender
    function validate_gender($input) {
        $input = trim($input);
        $input = filter_var($input, FILTER_SANITIZE_STRING);

        if (empty($input)) { 
            return false; 
        }
        else if($input === "male" || $input === "female") {
            return $input;
        }
        else {
            return false;
        }

    }

    // Phone
    function validate_phone($input) {
        $input = trim($input);
        $input = filter_var($input, FILTER_SANITIZE_STRING);

        if (empty($input)) { 
            return false; 
        }
        else if(preg_match("/^[0-9+]{5,20}$/",$input)) {
            return $input;
        }
        else {
            return false;
        }

    }

    // Location
    function validate_location($input) {
        $input = trim($input);
        $input = filter_var($input, FILTER_SANITIZE_STRING);

        if (empty($input)) { 
            return false; 
        }
        else if(preg_match("/^[A-Za-z ]{3,50}$/",$input)) {
            return $input;
        }
        else {
            return false;
        }

    }
    
    // Is Voting
    function validate_isVoting($input) {
        $input = trim($input);
        $input = filter_var($input, FILTER_SANITIZE_STRING);

        if (empty($input)) { 
            return false; 
        }
        else if($input === "yes" || $input === "no") {
            return $input;
        }
        else {
            return false;
        }

    }
    
    // Vote 
    function validate_vote($input) {
        $input = trim($input);
        $input = filter_var($input, FILTER_SANITIZE_STRING);

        if (empty($input)) { 
            return false; 
        }
        else if($input === "muse" || $input === "cirro" || $input === "faysal") {
            return $input;
        }
        else {
            return false;
        }

    }

    // Reasonining 
    function validate_reasoning($input) {
        $input = trim($input);
        $input = filter_var($input, FILTER_SANITIZE_STRING);

        if (empty($input)) { 
            return false; 
        }
        else {
            return $input;
        }

    }

    // Coordinates 
    function validate_coordinates($input) {
        $input = trim($input);
        $input = filter_var($input, FILTER_SANITIZE_STRING);

        if (empty($input)) { 
            return false; 
        }
        // else if(preg_match("/^[-+]?([1-8]?\d(\.\d+)?|90(\.0+)?),\s*[-+]?((1[0-7]\d|\d{1,2})(\.\d+)?|180(\.0+)?)$/",$input)) {
        //     return $input;
        // }
        else {
            return $input;
        }

    }

    /* ========== SIGNIN ========== */

    // Signin Phone
    function validate_signin_phone($input) {
        $input = trim($input);
        $input = filter_var($input, FILTER_SANITIZE_STRING);

        if (empty($input)) { 
            return false; 
        }
        else if(preg_match("/^[0-9+]{5,20}$/",$input)) {
            return $input;
        }
        else {
            return false;
        }

    }

    // Signin Password
    function validate_signin_password($pwd) {
        $pwd = trim($pwd);
        $pwd = filter_var($pwd, FILTER_SANITIZE_STRING);

        if (empty($pwd)) { 
            return false; 
        }
        else if(preg_match("/^(?=.*\d)(?=.*[a-zA-Z]).{7,16}$/",$pwd)) {
            return $pwd;
        }
        else {
            return false;
        }

    }


?>