<?php

//hearder
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

//include db and object filee
include_once '../config/database.php';
include_once '../objects/question.php';

//int db and tajweed object
$database = new Database();
$db = $database -> getConnection();

//int object
$question = new Question($db);

//read tajweed start
$stmt = $question-> read();
$num = $stmt -> rowCount();

//check if more than 0 record found
if ($num>0){

	//tajweed array
	$question_arr = array();
	$question_arr["records"]=array();

 while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
 
        $question_item=array(

            "QnID" =>  $QnID,
            "Qn" =>  $Qn,
            "ImageName" =>  $ImageName,
            "Option1" =>  $Option1,
            "Option2" =>  $Option2,
            "Option3" =>  $Option3,
            "Option4" =>  $Option4,
            "Answer" =>  $Answer,
            "quizPhase" =>  $quizPhase
        );
 
        array_push($question_arr["records"], $question_item);
    }

    // set response code - 200 OK
    http_response_code(200);
 
    // show tajweed data in json format
    echo json_encode($question_arr);
}
 
// no tajweed found will be here
else{
 
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user no tajweed found
    echo json_encode(
        array("message" => "No question found.")
    );
}


