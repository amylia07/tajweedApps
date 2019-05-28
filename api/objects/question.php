<?php

class question{
	private $conn;
	private $table_name = "question";

	public $QnID;
	public $Qn;
	public $ImageName;
	public $Option1;
	public $Option2;
	public $Option3;
	public $Option4;
	public $Answer;
	public $quizPhase;

	public function __construct($db){
		$this->conn = $db;
	}

	// read tajweed
function read(){
 
    // select all query
    $query = "SELECT * FROM question";
 
    // prepare query statement
    $stmt = $this->conn->prepare($query);
 
    // execute query
    $stmt->execute();
 
    return $stmt;
}

// used when filling up the update product form
function readOne(){
 
    // query to read single record
    $query = "SELECT * FROM question WHERE quizPhase = ?";
 
    // prepare query statement
    $stmt = $this->conn->prepare( $query );
 
    // bind id of product to be updated
    $stmt->bindParam(1, $this->quizPhase);
 
    // execute query
    $stmt->execute();
 
    // get retrieved row
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
 
    // set values to object properties
    $this->QnID = $row['QnID'];
    $this->Qn = $row['Qn'];
    $this->ImageName = $row['ImageName'];
    $this->Option1 = $row['Option1'];
    $this->Option2 = $row['Option2'];
    $this->Option3 = $row['Option3'];
    $this->Option4 = $row['Option4'];
    $this->Answer = $row['Answer'];
    $this->quizPhase = $row['quizPhase'];
}

function getMultipleRecord() {


     $query = "SELECT * FROM question WHERE quizPhase = ?";
 
    // prepare query statement
    $stmt = $this->conn->prepare( $query );
 
    // bind id of product to be updated
    $stmt->bindParam(1, $this->quizPhase);
 
    // execute query
    $stmt->execute();
 
    return $stmt;
}

function readPhase(){
 
    // select all query
    $query = "SELECT DISTINCT quizPhase FROM question";
 
    // prepare query statement
    $stmt = $this->conn->prepare($query);
 
    // execute query
    $stmt->execute();
 
    return $stmt;
}
}

?>