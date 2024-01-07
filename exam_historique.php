<?php


class Exam_Historique{

public $id;
public $id_student;
public $id_examen;
public $grade;
 

public static $errorMsg = "";

public static $successMsg="";


public function __construct($id_student,$id_examen,$grade){
    $this->id_student=$id_student;
    $this->id_examen=$id_examen;
    $this->grade=$grade;
}

public function insertExam_historique($conn){

//insert a client in the database, and give a message to $successMsg and $errorMsg
$query="INSERT INTO exame_historique(id_student,id_exam,grade) VALUES('$this->id_student','$this->id_examen','$this->grade')";

if (mysqli_query($conn,$query)) {
    self::$successMsg="insertion valide";
} else {
    self::$errorMsg="erreur!";
}
    
}

public static function  selectAllExam_historique($conn){

//select all the client from database, and inset the rows results in an array $data[]
$sql = "SELECT * FROM exame_historique";
$result = mysqli_query($conn, $sql);
 return $result;

}
public static function  selectExam_historique_by_ID($conn,$id_student){

    $sql = "SELECT * FROM exame_historique where id_student='$id_student'";
    $result = mysqli_query($conn, $sql);
    return $result;
    
}


public static function  selectExam_historique_by_IDProf($conn,$id_exam){

    $sql = "SELECT * FROM exame_historique where id_exam='$id_exam'";
    $result = mysqli_query($conn, $sql);
    return $result;
}

public static function  selectExam_historique_by_IDExam($conn,$id_exam){

    $sql = "SELECT * FROM exame_historique where id_exam='$id_exam'";
    $result = mysqli_query($conn, $sql);
    $row=mysqli_fetch_assoc($result);
    return $row;
}

public static function Delete_Exam_historique($conn,$id_exam,$id_student){
    $sql = "DELETE FROM exame_historique WHERE id_exam=$id_exam AND id_student=$id_student";
    if (mysqli_query($conn, $sql)) {
        self::$successMsg= "Record deleted successfully";
    } else {
        self::$errorMsg= "Error deleting record: " . mysqli_error($conn);
    
    }
        
        
}
}
?>
