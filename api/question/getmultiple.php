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
$db = $database -> getConnection();

//int object
$question = new Question($db);
 
// set ID property of record to read
$question->quizPhase = isset($_GET['quizPhase']) ? $_GET['quizPhase'] : die();

// read the details of question to be edited
$stmt = $question-> getMultipleRecord();
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
		// $Options_arr = array();
		$Options_arr=array();
		$Options=array(
            "Option1" =>  $Option1,
	            "Option2" =>  $Option2,
	            "Option3" =>  $Option3,
	            "Option4" =>  $Option4
        );
    	
		array_push($Options_arr, $Options);
        $question_item=array(
            "QnID" =>  $QnID,
            "Qn" =>  $Qn,
            "ImageName" =>  $ImageName,
           	"Options" => $Options_arr,
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
        array("message" => "Not found.")
    );
}

?>
 
