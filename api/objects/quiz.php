<?php

class quiz{
	private $conn;
	private $table_name = "quiz";

	public $quizID;
	public $quizScore;
	public $userID;
	public $quizPhase;

	public function __construct($db){
		$this->conn = $db;
	}

	// create user
// create product
function create(){
 
    // query to insert record
    $query = "INSERT INTO quiz SET userID=:userID, quizScore=:quizScore, quizPhase=:quizPhase";
 
    // prepare query
    $stmt = $this->conn->prepare($query);
 
    // sanitize
    $this->quizScore=htmlspecialchars(strip_tags($this->quizScore));
    $this->userID=htmlspecialchars(strip_tags($this->userID));
    $this->quizPhase=htmlspecialchars(strip_tags($this->quizPhase));
 
    // bind values
    $stmt->bindParam(":quizScore", $this->quizScore);
    $stmt->bindParam(":userID", $this->userID);
    $stmt->bindParam(":quizPhase", $this->quizPhase);

    // execute query
    if($stmt->execute()){
        return true;
    }
 
    return false;
     
}

function createNull(){
 
    // query to insert record
    $query = "INSERT INTO quiz SET userID=:userID, quizPhase=:quizPhase";
 
    // prepare query
    $stmt = $this->conn->prepare($query);
 
    // sanitize
    $this->userID=htmlspecialchars(strip_tags($this->userID));
    $this->quizPhase=htmlspecialchars(strip_tags($this->quizPhase));
 
    // bind values
    $stmt->bindParam(":userID", $this->userID);
    $stmt->bindParam(":quizPhase", $this->quizPhase);

    // execute query
    if($stmt->execute()){
        return true;
    }
 
    return false;
     
}

// update the product
function update(){
 
    // update query
    $query = "UPDATE
                " . $this->table_name . "
            SET
                quizScore = :quizScore
            WHERE
                userID = :userID && quizPhase= :quizPhase";
 
    // prepare query statement
    $stmt = $this->conn->prepare($query);
 
    // sanitize
    $this->quizScore=htmlspecialchars(strip_tags($this->quizScore));
    $this->userID=htmlspecialchars(strip_tags($this->userID));
    $this->quizPhase=htmlspecialchars(strip_tags($this->quizPhase));
 
    // bind new values
    $stmt->bindParam(':quizScore', $this->quizScore);
    $stmt->bindParam(':userID', $this->userID);
    $stmt->bindParam(':quizPhase', $this->quizPhase);
 
    // execute the query
    if($stmt->execute()){
        return true;
    }
 
    return false;
}

function readOne(){
 
    // query to read single record
    $query = "SELECT * FROM quiz WHERE userID = ?";
 
    // prepare query statement
    $stmt = $this->conn->prepare( $query );
 
    // bind id of product to be updated
    $stmt->bindParam(1, $this->userID);

 
    // execute query
    $stmt->execute();
 
    // get retrieved row
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
 
    // set values to object properties
    $this->userID = $row['userID'];
    $this->quizPhase = $row['quizPhase'];
    $this->quizScore = $row['quizScore'];
    $this->quizID = $row['quizID'];
}

function getMultipleRecord() {


     $query = "SELECT quizID, quizPhase, quizScore FROM quiz WHERE userID = ?";
 
    // prepare query statement
    $stmt = $this->conn->prepare( $query );
 
    // bind id of product to be updated
    $stmt->bindParam(1, $this->userID);
 
    // execute query
    $stmt->execute();
 
    return $stmt;
}

}
?>