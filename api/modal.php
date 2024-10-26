<?php

    // Signin
    class signin_modal {

        // Fetch
        function signin_checking_modal() {

            return "SELECT `account_id`, `account_name`, `account_phone`, `account_password`, `account_role`, `account_suspened`, `account_photo` FROM `accounts` WHERE `account_phone` = ? ";            
        }

    }


    // Surveys Modal
    class surveys_modal {

        // New Survey
        function registeration_modal() {
            return "INSERT INTO `surveys`(`survey_name`, `survey_phone`, `survey_gender`, `survey_district`, `survey_isvoting`, `survey_staff`, `survey_latitude`, `survey_longitude`, `survey_vote2024`, `survey_vote2017`, `survey_reason`, `created_at`, `updated_at`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)";
        }

    }


?>
