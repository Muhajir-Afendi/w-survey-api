
<?php

    // DB connection
    require_once "api/config.php";

    //  Validations
    require_once 'validator.php';
    $validator = new surveys_validator;

    // Modals
    require_once 'modal.php';
    $modals = new surveys_modal;
    	
    //The response
    $response = array();
    
    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        // Validations
        $validation = $validator->add_survey_validations($_POST);

        // If Validation Is success
        if (gettype($validation) === "array") {

            try {

                $name 	    = $validation["name"];
                $phone 	    = $validation["phone"];
                $gender 	= $validation["gender"];
                $district 	= $validation["district"];

                $is_voting 	    = $validation["is_voting"] === "yes" ? true : false;
                $voting_2024 	= $validation["voting_2024"];
                $voted_2017 	= $validation["voted_2017"];
                $reason_not_voting 	= $validation["reason_not_voting"];

                $latitude = $validation["latitude"];
                $longitude = $validation["longitude"];

                // Current Time
                $currentTime = date("Y-m-d H:i:s");

                $userId = $GLOBALS['user_id'];
                $INSERT = $modals->registeration_modal();
                $stmt = $conn -> prepare($INSERT);
                $stmt->bind_param("sssssssssssss", $name, $phone, $gender, $district, $is_voting, $userId, $latitude, $longitude, $voting_2024, $voted_2017, $reason_not_voting, $currentTime, $currentTime);

                if($stmt->execute()) {
                    $response['error'] = false;
                    $response['message'] = 'Saved Successfully';            
                }

                else {

                    if(mysqli_errno($conn) === 1062) {
                        $response['error'] = true;
                        $response['message'] = 'This survey is already registered <br> Please Retry '; 
                    }
                    else {
                        error_log(mysqli_error($conn));
                        $response['error'] = true;
                        $response['message'] = 'Please check your enteries and try again !!';
                    }

                }    

            } catch(Exception $e) {
                
                $response['error'] = true;
                
                if (strpos($e->getMessage(), 'Duplicate entry') !== false) {
                    $response['message'] = 'This survey is already registered';
                }
                else {
                    $response['message'] = "Error encountered Please try again!";            
                }
                
            }

		}

        else {
            $response['isError'] = true;
            $response['message'] = $validation;
			$response['data'] = [];
        }

    }
    else {
        $response['isError'] = true;
        $response['message'] = "Informal request format";
    }
	
    echo json_encode($response,JSON_PRETTY_PRINT);

?>