<?php

class example{
	private $conn;
	private $table_name = "example";

	public $exID;
	public $exAPI;
	public $exSurah;
	public $exAyat;
	public $exImage;
    public $exAudio;
    public $tajweedID;

	public function __construct($db){
		$this->conn = $db;
	}

    function read(){
 
    // select all query
    $query = "SELECT * FROM example";
 
    // prepare query statement
    $stmt = $this->conn->prepare($query);
 
    // execute query
    $stmt->execute();
 
    return $stmt;
}

function readOne(){
 
    // query to read single record
    $query = "SELECT exID, exAPI, exSurah, exAyat, exImage, exAudio FROM example WHERE tajweedID = ?";
 
    // prepare query statement
    $stmt = $this->conn->prepare( $query );
 
    // bind id of product to be updated
    $stmt->bindParam(1, $this->tajweedID);
 
    // execute query
    $stmt->execute();
 
    // get retrieved row
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
 
    // set values to object properties
    $this->exID = $row['exID'];
    $this->exSurah = $row['exSurah'];
    $this->exAyat = $row['exAyat'];
    $this->exAPI = $row['exAPI'];
    $this->exAudio = $row['exAudio'];
    $this->exImage = $row['exImage'];
}

function getMultipleRecord() {


     $query = "SELECT exSurah, exAyat FROM example WHERE tajweedID = ?";
 
    // prepare query statement
    $stmt = $this->conn->prepare( $query );
 
    // bind id of product to be updated
    $stmt->bindParam(1, $this->tajweedID);
 
    // execute query
    $stmt->execute();
 
    return $stmt;
}
}

?>