<?php

class user{
	private $conn;
	private $table_name = "user";

	public $userID;
	public $userName;
	public $userPassword;
	public $userEmail;
	public $fullName;

	public function __construct($db){
		$this->conn = $db;
	}

// create user
function create(){
 
    $query = "INSERT INTO user SET userName=:userName, userPassword=:userPassword, userEmail=:userEmail, fullName=:fullName";
 
    // prepare query
    $stmt = $this->conn->prepare($query);
 
    // sanitize
    $this->userName=htmlspecialchars(strip_tags($this->userName));
    $this->userPassword=htmlspecialchars(strip_tags($this->userPassword));
    $this->userEmail=htmlspecialchars(strip_tags($this->userEmail));
    $this->fullName=htmlspecialchars(strip_tags($this->fullName));
 
    // bind values
    $stmt->bindParam(":userName", $this->userName);
    $stmt->bindParam(":userPassword", $this->userPassword);
    $stmt->bindParam(":userEmail", $this->userEmail);
     $stmt->bindParam(":fullName", $this->fullName);

    // execute query
    if($stmt->execute()){
        return true;
    }
 
    return false;
     
}

// check if given email exist in the database
function userNameExists(){
 
    // query to check if email exists
    $query = "SELECT *
            FROM user
            WHERE userName = ?
            LIMIT 0,1";
 
    // prepare the query
    $stmt = $this->conn->prepare( $query );
 
    // sanitize
    $this->userName=htmlspecialchars(strip_tags($this->userName));
 
    // bind given email value
    $stmt->bindParam(1, $this->userName);
 
    // execute the query
    $stmt->execute();
 
    // get number of rows
    $num = $stmt->rowCount();
 
    // if email exists, assign values to object properties for easy access and use for php sessions
    if($num>0){
 
        // get record details / values
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
 
        // assign values to object properties
        $this->userID = $row['userID'];
        $this->userPassword = $row['userPassword'];
        $this->userEmail = $row['userEmail'];
        $this->fullName = $row['fullName'];
 
        // return true because email exists in the database
        return true;
    }
 
    // return false if email does not exist in the database
    return false;
}
 
// function login(){

//     $query = "SELECT * FROM user WHERE userName = ?";

//      $stmt = $this->conn->prepare($query);

//      $stmt->bindParam(1, $this->userName);

//      $stmt->execute();
 
//     // get retrieved row
//     $row = $stmt->fetch(PDO::FETCH_ASSOC);
 
//     // set values to object properties
//     // $this->userID = $row['userID'];
//     // $this->userName = $row['userName'];
//     // $this->userEmail = $row['userEmail'];
//     // $this->userPassword = $row['userPassword'];
//     // $this->fullName = $row['fullName'];

//     if($row["userName"]==$this->userName && $row['userPassword'];==$this->userPassword)
//         return true;
//     else
//         return false;
// }


function readOne(){
 
    // query to read single record
    $query = "SELECT * FROM user WHERE userName = ?";
 
    // prepare query statement
    $stmt = $this->conn->prepare( $query );
 
    // bind id of product to be updated
    $stmt->bindParam(1, $this->userName);

 
    // execute query
    $stmt->execute();
 
    // get retrieved row
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
 
    // set values to object properties
    $this->userID = $row['userID'];
    $this->userName = $row['userName'];
    $this->userEmail = $row['userEmail'];
    $this->userPassword = $row['userPassword'];
    $this->fullName = $row['fullName'];
}

// update the product
function update(){
 
    // update query
    $query = "UPDATE user
            SET
                userName = :userName,
                userEmail = :userEmail,
                userPassword = :userPassword,
                fullName = :fullName
            WHERE
                userID = :userID";
 
    // prepare query statement
    $stmt = $this->conn->prepare($query);
 
    // sanitize
    $this->userName=htmlspecialchars(strip_tags($this->userName));
    $this->userEmail=htmlspecialchars(strip_tags($this->userEmail));
    $this->userPassword=htmlspecialchars(strip_tags($this->userPassword));
    $this->fullName=htmlspecialchars(strip_tags($this->fullName));
    $this->userID=htmlspecialchars(strip_tags($this->userID));
 
    // bind new values
    $stmt->bindParam(':userName', $this->userName);
    $stmt->bindParam(':userEmail', $this->userEmail);
    $stmt->bindParam(':userPassword', $this->userPassword);
    $stmt->bindParam(':fullName', $this->fullName);
    $stmt->bindParam(':userID', $this->userID);
 
    // execute the query
    if($stmt->execute()){
        return true;
    }
 
    return false;
}
}

?>