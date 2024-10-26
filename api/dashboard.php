
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
    $temp = array();
    $data = array();

    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        
        $fetch_modal = $modals->dashboard_modal();
        $stmt = $conn -> prepare($fetch_modal);

        $userId = "account_72943"; //$GLOBALS['user_id'];

        // Filter Based On Parameters
        $stmt->bind_param("s", $userId);

        $stmt->execute();

        $stmt->store_result();
                
        if ($stmt->num_rows === 0) {
            $response['error'] = true;
            $response['message'] = 'Not found  !!';
        }
        else
        {

            $stmt->bind_result($numberOfSurveys, $date);
            
            $response['error'] = false;
            $response['message'] = 'fetched successfully'; 

            // output data of each row
            while($stmt->fetch()) 
            {
                $temp['date']         = $date; 
                $temp['total']       = $numberOfSurveys;

                //Push the data to the array
                array_push($data,$temp);
            }

            // Data assign to response
            $response['data'] = $data;

        }

    }
    else {
        $response['isError'] = true;
        $response['message'] = "Informal request format";
    }
	
    echo json_encode($response,JSON_PRETTY_PRINT);

?>