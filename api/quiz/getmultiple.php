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
$db = $database -> getConnection();

//int object
$quiz = new Quiz($db);
 
// set ID property of record to read
$quiz->userID = isset($_GET['userID']) ? $_GET['userID'] : die();

// read the details of question to be edited
$stmt = $quiz-> getMultipleRecord();
$num = $stmt -> rowCount();

//check if more than 0 record found
if ($num>0){

    //tajweed array
    $quiz_arr = array();
    $quiz_arr["records"]=array();

 while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
 
        $quiz_item=array(
            "quizID" => $quizID,
            "quizPhase" => $quizPhase,
            "quizScore" => $quizScore,
           
        );
 
        array_push($quiz_arr["records"], $quiz_item);
    }

    // set response code - 200 OK
    http_response_code(200);
 
    // show tajweed data in json format
    echo json_encode($quiz_arr);
}
 
// no tajweed found will be here
else{
 
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user no tajweed found
    echo json_encode(
        array("message" => "No quiz record found.")
    );
}

?>
 
