<?php
require_once(dirname(__FILE__).'/include/global.php');

$action = get_expected_api_parameter("action");
$username = trim(get_expected_api_parameter("username"));

$return_json = array('error' => '', 'status' => 200);


//either log them in, or check their token before continuing
if ($action == "login") {
    $password = get_expected_api_parameter("password");

    api_authenticate($username, $password);
} else {

   $token = get_expected_api_parameter("token");

    if(!$user->is_valid_token($username, $token)) {
        api_send_response(401, "Invalid credentials.");
    }
}

//if we got this far, they are good to go. Load the user details, then see what they want
$user->load_user($username);


if($action == "xyz"){


} elseif($action == "get_user_path_steps") {
    
    $thePath = get_path($user->get('user_id'));
    $return_json['the_path'] = $thePath;
    
    echo json_encode($return_json);
    exit();    

 
} elseif($action == "do something else"){


}


//When all else fails - send something
$return_json['error'] = "Invalid action (" . $action . ")";
echo json_encode($return_json);
exit();  