<?php

//hearder
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

//include db and object filee
include_once '../config/database.php';
include_once '../objects/tajweed.php';

//int db and tajweed object
$database = new Database();
$db = $database -> getConnection();

//int object
$tajweed = new Tajweed($db);

//read tajweed start
$stmt = $tajweed-> read();
$num = $stmt -> rowCount();

//check if more than 0 record found
if ($num>0){

	//tajweed array
	$tajweed_arr = array();
	$tajweed_arr["records"]=array();

 while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
 
        $tajweed_item=array(
            "tajweedID" => $tajweedID,
            "tajweedName" => $tajweedName,
            "ImageDesc" => $ImageDesc,
            "TajweedDesc" => $TajweedDesc,
            "TajweedDesc2" => $TajweedDesc2,
            "TajweedDesc3" => $TajweedDesc3,
            "TajweedDesc4" => $TajweedDesc4,
            "TajweedDesc5" => $TajweedDesc5,
        );
 
        array_push($tajweed_arr["records"], $tajweed_item);
    }

    // set response code - 200 OK
    http_response_code(200);
 
    // show tajweed data in json format
    echo json_encode($tajweed_arr);
}
 
// no tajweed found will be here
else{
 
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user no tajweed found
    echo json_encode(
        array("message" => "No tajweed found.")
    );
}


