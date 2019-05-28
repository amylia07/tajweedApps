<?php 
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/example.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare question object
$example = new Example($db);
 
// set ID property of record to read
$example->tajweedID = isset($_GET['tajweedID']) ? $_GET['tajweedID'] : die();

// read the details of question to be edited
$example->readOne();
 
if($example->exID!=null){
    // create array
    $example_arr = array(
        "exID" =>  $example->exID,
        "exAPI" => $example->exAPI,
        "exSurah" => $example->exSurah,
        "exAyat" => $example->exAyat,
        "exImage" => $example->exImage,
        "exAudio" => $example->exAudio,
        "tajweedID" => $example->tajweedID
 
    );
 
    // set response code - 200 OK
    http_response_code(200);
 
    // make it json format
    echo json_encode($example_arr);
}
 
else{
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user product does not exist
    echo json_encode(array("message" => "Example does not exist."));
}
?>
