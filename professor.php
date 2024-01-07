<?php


class Professor{

public $id;
public $fullName;
public $speciality;
public $email;
public $password;
 

public static $errorMsg = "";

public static $successMsg="";


public function __construct($fullName,$speciality,$email,$password){

    //initialize the attributs of the class with the parameters, and hash the password
    $this->fullName=$fullName;
    $this->speciality=$speciality;
    $this->email=$email;
    $this->password=password_hash($password, PASSWORD_DEFAULT);
}

public function insertProfessor($conn){

//insert a client in the database, and give a message to $successMsg and $errorMsg
$query="INSERT INTO professor(name,speciality,email,password,code) VALUES('$this->fullName','$this->speciality','$this->email','$this->password',0)";

if (mysqli_query($conn,$query)) {
 return true;
} else {
    return false;
}
    
}

public static function  selectAllProfessor($conn){

//select all the client from database, and inset the rows results in an array $data[]
$sql = "SELECT * FROM professor";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
// output data of each ro
while($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}
} else {
     echo "0 results";
}
return $data;

}

public static function selectProfessorById($conn,$id){
$sql = "SELECT * FROM professor WHERE id=$id";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result)==1) {
$row = mysqli_fetch_assoc($result) ;
  return $row; 
} 

}

public static function selectIdProfessor($conn,$name){

$sql = "SELECT id FROM professor WHERE name='$name'";

$result = mysqli_query($conn, $sql);

$row = mysqli_fetch_assoc($result) ;
  return $row; 

}
public static function selectProfessorByname($conn,$name){

    $sql = "SELECT id FROM professor WHERE name='$name'";
    
    $result = mysqli_query($conn, $sql);
    
    return $result;
    
    }

public static function updateProfessor($client,$conn,$id){
    //update a Etudiant of $id, with the values of $client in parameter
    $sql = "UPDATE professor SET  name='$client->fullName' ,speciality='$client->speciality',email='$client->email',password='$client->password'  WHERE id='$id'";
    
if (mysqli_query($conn, $sql)) {
    self::$successMsg= " updated successfully";
    
} else {
    self::$errorMsg="Error updating record: " . mysqli_error($conn);
    
}
}
public static function updateProfessorWithoutPassword($speciality,$fullName,$email,$conn,$id){
    //update a Etudiant of $id, with the values of $client in parameter
    $sql = "UPDATE professor SET  name='$fullName' ,speciality='$speciality',email='$email'  WHERE id='$id'";
    
if (mysqli_query($conn, $sql)) {
    self::$successMsg= " updated successfully";
    
} else {
    self::$errorMsg="Error updating record: " . mysqli_error($conn);
    
}
}

public static function deleteProfessor($conn,$id){
    
    $sql = "DELETE FROM professor WHERE id=$id";
    if (mysqli_query($conn, $sql)) {
        $successMsg= "Record deleted successfully";
        return $successMsg;
} else {
    $errorMsg= "Error deleting record: " . mysqli_error($conn);
    return $errorMsg;
}

  
    }

}

?>
