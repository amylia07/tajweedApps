<?php

//hearder
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

//include db and object filee
include_once '../config/database.php';
include_once '../objects/example.php';

//int db and tajweed object
$database = new Database();
$db = $database -> getConnection();

//int object
$example = new Example($db);

//read tajweed start
$stmt = $example-> read();
$num = $stmt -> rowCount();

//check if more than 0 record found
if ($num>0){

	//tajweed array
	$example_arr = array();

 while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
 
        $example_item=array(
            "exID" => $exID,
            "exAPI" => $exAPI,
            "exSurah" => $exSurah,
            "exAyat" => $exAyat,
            "exImage" => $exImage,
            "exAudio" => $exAudio,
            "tajweedID" => $tajweedID,
        );
 
        array_push($example_arr, $example_item);
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


