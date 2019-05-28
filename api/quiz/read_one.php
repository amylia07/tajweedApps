<?php 
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/quiz.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare question object
$quiz = new Quiz($db);
 
// set ID property of record to read
$quiz->userID = isset($_GET['userID']) ? $_GET['userID'] : die();

// read the details of question to be edited
$quiz->readOne();
 
if($quiz->userID!=null){
    // create array
    $quiz_arr = array(
        "userID" =>  $quiz->userID,
        "quizScore" => $quiz->quizScore,
        "quizPhase" => $quiz->quizPhase,
        "quizID" => $quiz->quizID
 
    );
 
    // set response code - 200 OK
    http_response_code(200);
 
    // make it json format
    echo json_encode($quiz_arr);
}
 
else{
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user product does not exist
    echo json_encode(array("message" => "Record does not exist."));
}
?>
