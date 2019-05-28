<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// get database connection
include_once '../config/database.php';
 
// instantiate product object
include_once '../objects/user.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// instantiate user object
$user = new User($db);
 
// get posted data
$data = json_decode(file_get_contents("php://input"));
//echo json_encode(array($data));
// set product property values
$user->userName = $data->userName;
$userName_exists = $user->userNameExists();
 
// check if email exists and if password is correct
if($userName_exists && ($data->userPassword==$user->userPassword)){
 
    $data = array(
           "userID" => $user->userID,
           "userName" => $user->userName,
           "userPassword" => $user->userPassword,
           "userEmail" => $user->userEmail,
           "fullName" => $user->fullName
    );
 
    // set response code
    http_response_code(200);
 
    echo json_encode(
            array(
                "message" => "Successful login."
            )
        );
 
}
 
// login failed
else{
 
    // set response code
    http_response_code(401);
 
    // tell the user login failed
    echo json_encode(array("message" => "Login failed."));
}
?>