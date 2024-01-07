<?php

class Connection_db{

private $servername="localhost:3306";
private $username="root";
private $password="";
public $conn;




public function __construct($dbName){
// Create connection
$this->conn = mysqli_connect($this->servername,$this->username, $this->password,$dbName);

// Check connection
if (!$this->conn) {
die("Connection failed: " . mysqli_connect_error());
}

}


function createDatabase($dbName){
    //creating a database with the conn in the class ($this->conn)
    $sql = "CREATE DATABASE $dbName";
if (mysqli_query($this->conn, $sql)) {
    return true;
    echo "Database created successfully";
} else {
    return false;
    echo "Error creating database: " . mysqli_error($this->conn);
}

}

function selectDatabase($dbName){
    //select database with the conn of the class, using mysqli_select..
$db = mysqli_select_db($this->conn, $dbName);
      if(! $db ) {
         die('Could not select database: ' . mysqli_error($this->conn));
      }
      echo "Database $dbName selected successfully";
}

function createTable($query){
    
  //creating a table with the query
  if (mysqli_query($this->conn, $query)) {
        echo "Table  created successfully";
    } else {
        echo "Error creating table: " . mysqli_error($this->conn);
    }
}

}

?>
