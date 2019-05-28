<?php 
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/tajweed.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare question object
$tajweed = new Tajweed($db);
 
// set ID property of record to read
$tajweed->tajweedID = isset($_GET['tajweedID']) ? $_GET['tajweedID'] : die();

// read the details of question to be edited
$tajweed->readOne();
 
if($tajweed->tajweedName!=null){
    // create array
    $tajweed_arr = array(
        "tajweedID" =>  $tajweed->tajweedID,
        "tajweedName" => $tajweed->tajweedName,
        "ImageDesc" => $tajweed->ImageDesc,
        "TajweedDesc" => $tajweed->TajweedDesc,
        "TajweedDesc2" => $tajweed->TajweedDesc2,
        "TajweedDesc3" => $tajweed->TajweedDesc3,
        "TajweedDesc4" => $tajweed->TajweedDesc4,
        "TajweedDesc5" => $tajweed->TajweedDesc5
 
    );
 
    // set response code - 200 OK
    http_response_code(200);
 
    // make it json format
    echo json_encode($tajweed_arr);
}
 
else{
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user product does not exist
    echo json_encode(array("message" => "Tajweed does not exist."));
}
?>
