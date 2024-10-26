
<?php


	// JWT
	include './vendor/autoload.php';
	use Firebase\JWT\JWT;
	use Firebase\JWT\Key;
	
    // DB connection
    require_once "api/config.php";

    //  Validations
    require_once 'validator.php';
    $validator = new signin_validator;

    // Modals
    require_once 'modal.php';
    $modals = new signin_modal;
    	
    //The response
    $response = array();
    
    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        // Validations
        $validation = $validator->signin_validations($_POST);

        // If Validation Is success
        if (gettype($validation) === "array") {

			try {
					
				$phone 	= $validation["phone"];
				$password   = $validation["password"];
			
				$QUERY = $modals->signin_checking_modal();
				$stmt = $conn -> prepare($QUERY);
				$stmt->bind_param("s", $phone);
				
				$stmt->execute();
				$stmt->store_result();

				if ($stmt->num_rows === 0) {
					$response['isError'] = true;
					$response['message'] = 'No account found with this phone';
					$response['isRegistered'] = false;
				}
				else {

					$response['isRegistered'] = true;

					// initialize selected columns to vairable in order to access data
					$stmt->bind_result($account_id, $account_name, $account_phone, $pwd, $account_role, $account_suspened, $account_photo);

					// fetch data
					$stmt->fetch();

					if(password_verify($password,$pwd)) {

						if ($suspended) {
							$response['isError'] = true;
							$response['message'] = 'Sorry your account has been suspended';
							$response['data'] = [];           
						}
						else {
						
							$payload = [
								'iss' => "https://api.wadani-surveys.tech",
								'aud' => 'https://api.wadani-surveys.tech',
								'exp' => time() + 86400, // 24 hours
								'data' => [
									'id' => $account_id,
									'name' => $account_name,
									'phone' => $account_phone,
									'role' => $account_role,
									'image' => $image,
									'device' => $_SERVER['HTTP_USER_AGENT']
								],
							];
			
							$secret_key = "WadaniParty2024@TOekn";
							$jwt = JWT::encode($payload, $secret_key, 'HS256');

							$response['isError'] = false;
							$response['message'] = 'Signed successfully'; 
							$response['name'] = $account_name;                           
							$response['phone'] = $account_phone;  					
							$response['token'] = $jwt;       


						}
						
                    }
                    else {
                        $response['isError'] = true;
                        $response['message'] = 'Phone or password is wrong';
                    }

				}

			} catch(Exception $e) {
                $response['error'] = true;
                $response['message'] = "Error encountered Please try again!";            
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