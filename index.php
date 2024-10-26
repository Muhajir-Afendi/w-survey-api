<?php  

	ob_start();

    // TimeZone
    date_default_timezone_set('Africa/Nairobi');

    // JWT
	include './vendor/autoload.php';
	use Firebase\JWT\JWT;
	use Firebase\JWT\Key;
   

    // IS USER SIGNED
    function is_user_signed() {

        if (isset(getallheaders()['token']) && getallheaders()['token'] !== null && getallheaders()['token'] !== "") {
      
            try {
                $token = getallheaders()['token'];
                $key = "WadaniParty2024@TOekn";
                $jwt_decode = JWT::decode($token, new Key($key, 'HS256'));
                
                $data = $jwt_decode->data;

                error_log(print_r($jwt_decode->data, TRUE));

                if ($data->device !== $_SERVER['HTTP_USER_AGENT']) {
                    return false;
                }
                else {

                    $GLOBALS['user_id'] = $data->id;
                    $GLOBALS['name'] = $data->name;
                    $GLOBALS['phone'] = $data->phone;
                    $GLOBALS['role'] = $data->role;
                    $GLOBALS['image'] = $data->image;
                   
                    return true;

                }               
        
            }
            catch(Exception $e) {
                error_log($e);
                return false;
            }
            
        }
        else {
           return false;
        }
    
    }
    

    $request = $_SERVER['REQUEST_URI'];

    $keyword = "/wadani-api";

    if  (substr($request, 0, strlen($keyword)) === $keyword) {
        $request = substr($request, strlen($keyword));
    }

    // Remove query
    $request = strtok($request, '?');

    // Remove last /
    $request = rtrim($request, '/');
    
    // echo '{"isError": "true", "message": "Sorry, we have disabled AQOONDHISE during these examination days." }';

    // Not Secured Routes 
    $notSecuredRoutes = array(
        '/auth/login'
    );
    
    error_log($request);
    error_log("**********");

    // /*
    if ( !is_user_signed() && !in_array($request, $notSecuredRoutes)) {
        http_response_code(401);
        echo '{"isError": "true", "message": "You are not logged in" }';
    }
    else {

        switch ($request) {

            case '/':
                echo 'Home site adding omg';
                break;

            // Login
            case '/auth/login' :
                require __DIR__ . '/api/login.php';
                break;

            // Survey
            case '/survey' :
                require __DIR__ . '/api/survey.php';
                break; 

            // Dashboard
            case '/dashboard' :
                require __DIR__ . '/api/dashboard.php';
                break; 

            // 404
            default:
                http_response_code(404);
                echo '{"isError": "true", "message": "This page does not exist" }';
                break;
        }   

    }
    // */

?>