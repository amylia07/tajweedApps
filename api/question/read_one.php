<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/question.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare question object
$question = new Question($db);
 
// set ID property of record to read
$question->quizPhase = isset($_GET['quizPhase']) ? $_GET['quizPhase'] : die();
 
// read the details of question to be edited
$question->readOne();
 
if($question->Qn!=null){
    // create array
    $question_arr = array(
        "QnID" =>  $question->QnID,
        "Qn" => $question->Qn,
        "ImageName" => $question->ImageName,
        "Option1" => $question->Option1,
        "Option2" => $question->Option2,
        "Option3" => $question->Option3,
        "Option4" => $question->Option4,
        "Answer" => $question->Answer,
        "quizPhase" => $question->quizPhase,
 
    );
 
    // set response code - 200 OK
    http_response_code(200);
 
    // make it json format
    echo json_encode($question_arr);
}
 
else{
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user product does not exist
    echo json_encode(array("message" => "Question does not exist."));
}
?>
