<?php


class Exam{

public $id;
public $examName;
public $examTime;
public $id_professor;
public $category_name;

public static $errorMsg = "";

public static $successMsg="";


public function __construct($examName,$examTime,$id_professor,$category_name){

    //initialize the attributs of the class with the parameters, and hash the password
    $this->examName=$examName;
    $this->examTime=$examTime;
    $this->id_professor=$id_professor;
    $this->category_name=$category_name;
}

public function insertExam($conn){

//insert a client in the database, and give a message to $successMsg and $errorMsg
$query="INSERT INTO exam(name,time,id_professor,category_name) VALUES('$this->examName','$this->examTime','$this->id_professor','$this->category_name')";

if (mysqli_query($conn,$query)) {
 return true;
} else {
    return false;
}
    
}

public static function  selectAllExam($conn){

//select all the client from database, and inset the rows results in an array $data[]
$sql = "SELECT * FROM exam";
$result = mysqli_query($conn, $sql);
 return $result;

}
public static function  selectIdExameFromName($conn,$name_Exam){

    $sql = "SELECT id FROM exam where name='$name_Exam'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
        return $row;
    } else {
         echo "0 results";
    }
    }

public static function selectExamById($conn,$id1){
    //select a client by id, and return the row result
$sql = "SELECT * FROM exam WHERE id=$id1";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result)==1) {
$row = mysqli_fetch_assoc($result) ;
  return $row; 
} else {
     echo "0 results";
}

}

public static function selectExamByCategory($conn,$category){
    //select a client by id, and return the row result
$sql = "SELECT * FROM exam WHERE category_name='$category'";

$result = mysqli_query($conn, $sql);
  return $result; 

}

public static function selectIdExam_IdProfessor($conn,$id_Prof){
$sql = "SELECT name FROM exam WHERE id_professor=$id_Prof";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result)>0) {
    while($row = mysqli_fetch_assoc($result)) {
        $data[] = $row["name"];
    }
    return $data;
} else {
     return "";
}

}

public static function selectExamByName($conn,$name){
    //select a client by id, and return the row result
$sql = "SELECT id FROM exam WHERE name='$name'";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result)>0) {
$row = mysqli_fetch_assoc($result) ;
  return $row; 
} else {
     echo "0 results";
}

}
public static function selectExamByidProf($conn,$id_prof){
    //select a client by id, and return the row result
$sql = "SELECT * FROM exam WHERE id_professor='$id_prof'";

 return $result = mysqli_query($conn, $sql);


}

public static function updateExam($client,$conn,$id){
    //update a Etudiant of $id, with the values of $client in parameter
    $sql = "UPDATE exam SET  name='$client->examName' ,speciality='$client->examTime'WHERE id=$id";
    var_dump($sql).'<br>';
if (mysqli_query($conn, $sql)) {
    $successMsg= "Exame updated successfully";
    return  $successMsg;
} else {
    $errorMsg="Error updating record: " . mysqli_error($conn);
    return $errorMsg;
}
}

public static function deleteExam($conn,$id){
    
    $sql = "DELETE FROM professor WHERE id=$id";
    if (mysqli_query($conn, $sql)) {
        $successMsg= "Exam deleted successfully";
        return $successMsg;
} else {
    $errorMsg= "Exam deleting record: " . mysqli_error($conn);
    return $errorMsg;
}

  
    }

}

?>
