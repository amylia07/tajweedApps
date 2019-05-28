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
$db = $database -> getConnection();

//int object
$example = new Example($db);
 
// set ID property of record to read
$example->tajweedID = isset($_GET['tajweedID']) ? $_GET['tajweedID'] : die();

// read the details of question to be edited
$stmt = $example-> getMultipleRecord();
$num = $stmt -> rowCount();

//check if more than 0 record found
if ($num>0){

    //tajweed array
    $example_arr = array();
    $example_arr["records"]=array();

 while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
 
        $example_item=array(
            "exSurah" => $exSurah,
            "exAyat" => $exAyat,
           
        );
 
        array_push($example_arr["records"], $example_item);
    }

    // set response code - 200 OK
    http_response_code(200);
 
    // show tajweed data in json format
    echo json_encode($example_arr);
}
 
// no tajweed found will be here
else{
 
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user no tajweed found
    echo json_encode(
        array("message" => "No example found.")
    );
}

?>
 
