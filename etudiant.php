<?php


class Etudiant{

public $id;
public $fullName;
public $UserName;
public $email;
public $password;
 

public static $errorMsg = "";

public static $successMsg="";


public function __construct($fullName,$UserName,$email,$password){

    //initialize the attributs of the class with the parameters, and hash the password
    $this->fullName=$fullName;
    $this->UserName=$UserName;
    $this->email=$email;
    $this->password=password_hash($password, PASSWORD_DEFAULT);
}

public function insertEtudiant($conn){

//insert a client in the database, and give a message to $successMsg and $errorMsg
$query="INSERT INTO users(name,username,email,password) VALUES('$this->fullName','$this->UserName','$this->email','$this->password')";
if (mysqli_query($conn,$query)) {
 return true;
} else {
    return false;
}
    
}

public static function  selectAllEtudiant($conn){

//select all the client from database, and inset the rows results in an array $data[]
$sql = "SELECT * FROM users";
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
public static function  selectEtudiantByName($conn,$username){

    //select all the client from database, and inset the rows results in an array $data[]
    $sql = "SELECT id FROM users WHERE username='$username'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) == 1) {
    // output data of each ro
    while($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
    return $data;
    } else {
         echo "0 results";
    }
    
    
    }

public static function selectEtudiantById($conn,$id){
    //select a client by id, and return the row result
$sql = "SELECT * FROM users WHERE id='$id'";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result)==1) {
$row = mysqli_fetch_assoc($result) ;
  return $row; 
} else {
     echo "0 results";
}

}

public static function updateEtudiant($client,$conn,$id){
    //update a Etudiant of $id, with the values of $client in parameter
    $sql = "UPDATE users SET  name='$client->fullName' ,username='$client->UserName',email='$client->email',password='$client->password'  WHERE id='$id'";

if (mysqli_query($conn, $sql)) {
    self::$successMsg= "Etudiant updated successfully";
} else {
    self::$errorMsg="Error updating record: " . mysqli_error($conn);
}
}

public static function updateEtudiantWithoutPassword($name,$username,$email,$conn,$id){
    //update a Etudiant of $id, with the values of $client in parameter
    $sql = "UPDATE users SET  name='$name' ,username='$username',email='$email' WHERE id='$id'";

if (mysqli_query($conn, $sql)) {
    self::$successMsg= "Etudiant updated successfully";

} else {
    self::$errorMsg="Error updating record: " . mysqli_error($conn);
}
}

public static function deleteEtudiant($conn,$id){
    
    $sql = "DELETE FROM users WHERE id=$id";
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
