<?php

class tajweed{
	private $conn;
	private $table_name = "tajweed";

	public $tajweedID;
	public $tajweedName;
	public $ImageDesc;
	public $TajweedDesc;
	public $TajweedDesc2;
	public $TajweedDesc3;
	public $TajweedDesc4;
	public $TajweedDesc5;

	public function __construct($db){
		$this->conn = $db;
	}

	// read tajweed
function read(){
 
    // select all query
    $query = "SELECT * FROM tajweed";
 
    // prepare query statement
    $stmt = $this->conn->prepare($query);
 
    // execute query
    $stmt->execute();
 
    return $stmt;
}

function readOne(){
 
    // query to read single record
    $query = "SELECT tajweedName,TajweedDesc, TajweedDesc2, TajweedDesc3, TajweedDesc4, TajweedDesc5 FROM tajweed WHERE tajweedID = ?";
 
    // prepare query statement
    $stmt = $this->conn->prepare( $query );
 
    // bind id of product to be updated
    $stmt->bindParam(1, $this->tajweedID);
 
    // execute query
    $stmt->execute();
 
    // get retrieved row
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
 
    // set values to object properties
    $this->tajweedName = $row['tajweedName'];
    $this->TajweedDesc = $row['TajweedDesc'];
    $this->TajweedDesc2 = $row['TajweedDesc2'];
    $this->TajweedDesc3 = $row['TajweedDesc3'];
    $this->TajweedDesc4 = $row['TajweedDesc4'];
    $this->TajweedDesc5 = $row['TajweedDesc5'];
}

}

?>