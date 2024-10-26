<?php

    //  Validations
    require_once 'validations.php';
    use inputValidations as validations;

    // Signin
    class signin_validator {

        function signin_validations($inputs) {

            $validatedInputs = array();
            $isError = false;
            $msg = "";

            // Check if $iable are POSTED
            $phone = isset($_POST['phone']) ? $_POST['phone'] : false ;
            $password = isset($_POST['password']) ? $_POST['password'] : false ;

            // Phone
            $validatedPhone = validations\validate_signin_phone($phone);
            if (!$validatedPhone) {
                $isError = true;
                $msg = "Phone or password is wrong 111";
            }
            else {

                $validatedInputs["phone"] = $validatedPhone;
            }
                
            // Password
            $validatedPassword = validations\validate_signin_password($password);
            if (!$validatedPassword) {
                $isError = true;
                $msg = "Phone or password is wrong 222";
            }
            else {

                $validatedInputs["password"] = $validatedPassword;
            }
            
            if ($isError) {
                return $msg;
            }
            else {
                return $validatedInputs; 
            }


        }

    }

    // Surveys
    class surveys_validator {

        function add_survey_validations($inputs) {

            $validatedInputs = array();
            $isError = false;
            $msg = "";

            // Check if $iable are POSTED
            $name = isset($_POST['name']) ? $_POST['name'] : false ;
            $phone = isset($_POST['phone']) ? $_POST['phone'] : false ;
            $gender = isset($_POST['gender']) ? $_POST['gender'] : false ;
            $district = isset($_POST['district']) ? $_POST['district'] : false ;

            $is_voting = isset($_POST['is_voting']) ? $_POST['is_voting'] : false ;
            $voting_2024 = isset($_POST['voting_2024']) ? $_POST['voting_2024'] : false ;
            $voted_2017 = isset($_POST['voted_2017']) ? $_POST['voted_2017'] : false ;
            $reason_not_voting = isset($_POST['reason_not_voting']) ? $_POST['reason_not_voting'] : false ;
            
            $latitude = isset($_POST['lat']) ? $_POST['lat'] : false ;
            $longitude = isset($_POST['long']) ? $_POST['long'] : false ;

            error_log($longitude);

            // Name
            $validatedName = validations\validate_name($name);
            if (!$validatedName) {
                $isError = true;
                $msg = "Name is not valid";
            }
            else {
                $validatedInputs["name"] = $validatedName;
            }
              
            // Phone
            $validatedPhone = validations\validate_phone($phone);
            if (!$validatedPhone) {
                $isError = true;
                $msg = "Phone is not valid";
            }
            else {
                $validatedInputs["phone"] = $validatedPhone;
            }            
            
            // Gender
            $validatedGender = validations\validate_gender($gender);
            if (!$validatedGender) {
                $isError = true;
                $msg = "Gender is not valid";
            }
            else {
                $validatedInputs["gender"] = $validatedGender;
            }
                  
            // District
            $validatedDistrict = validations\validate_location($district);
            if (!$validatedDistrict) {
                $isError = true;
                $msg = "District is not valid";
            }
            else {
                $validatedInputs["district"] = $validatedDistrict;
            }

            // Is Voting
            $validatedIsVoting = validations\validate_isVoting($is_voting);
            if (!$validatedIsVoting) {
                $isError = true;
                $msg = "Is Voting is not valid";
            }
            else {
                $validatedInputs["is_voting"] = $validatedIsVoting;
            }

            // Vote 2024
            $validatedVoting2024 = validations\validate_vote($voting_2024);
            if (!$validatedVoting2024 && $validatedIsVoting === "yes") {
                $isError = true;
                $msg = "Vote 2024 is not valid";
            }
            else {
                $validatedInputs["voting_2024"] = $validatedVoting2024;
            }

            // Vote 2017
            $validatedVoted2017 = validations\validate_vote($voted_2017);
            if (!$validatedVoted2017 && $validatedIsVoting === "yes") {
                $isError = true;
                $msg = "Vote 2017 is not valid";
            }
            else {
                $validatedInputs["voted_2017"] = $validatedVoted2017;
            }

            // Reason not voting
            $validatedReasonNotVoting = validations\validate_reasoning($reason_not_voting);
            if (!$validatedReasonNotVoting && $validatedIsVoting === "no") {
                $isError = true;
                $msg = "Reason not voting is not valid";
            }
            else {
                $validatedInputs["reason_not_voting"] = $validatedReasonNotVoting;
            }

            // Latitude
            $validatedLatitude = validations\validate_coordinates($latitude);
            if (!$validatedLatitude) {
                $isError = true;
                $msg = "Latitude is not valid";
            }
            else {
                $validatedInputs["latitude"] = $validatedLatitude;
            }

            // Logitude
            $validatedLongitude = validations\validate_coordinates($longitude);
            if (!$validatedLongitude) {
                $isError = true;
                $msg = $longitude . " - Longitude is not valid";
            }
            else {
                $validatedInputs["longitude"] = $validatedLongitude;
            }

            if ($isError) {
                return $msg;
            }
            else {
                return $validatedInputs; 
            }


        }

    }
    
?>