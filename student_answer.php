<?php 
class Student_Answer{
     public $id_student;
    public $id_question;
    public $id_exame;
    public $StudAnswer;
     
    public static $errorMsg = "";

    public static $successMsg=""; 
    

    public function __construct($id_student,$id_question,$id_exame,$StudAnswer)
    {
        $this->id_student=$id_student;
        $this->id_question=$id_question;
        $this->id_exame= $id_exame;
        $this->StudAnswer =$StudAnswer ;
    }

    public function insertStudentAnswer($conn){
        $query="INSERT INTO student_answer(id_student,id_question,id_exame,StudAnswer) VALUES('$this->id_student','$this->id_question','$this->id_exame','$this->StudAnswer')";
        
        if (mysqli_query($conn,$query)) {
            self::$successMsg='insertion Valide'. mysqli_error($conn);
        } else {
            self::$errorMsg='error'. mysqli_error($conn);
        }
            
        }


    public static function SelectStudentAnswer($conn,$id_exam,$id_student){
        $query="SELECT * FROM student_answer WHERE id_exame='$id_exam' AND id_student='$id_student'";
        $result=mysqli_query($conn,$query);
        
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $data[$row["id_question"]] = $row["StudAnswer"];
            }
            } else {
                 echo "0 results";
            }
            return $data;
            
    }

    public static function Select_Student_Answer_Question($conn,$id_exam,$id_student,$id_question){
        $query="SELECT * FROM student_answer WHERE id_exame='$id_exam' AND id_student='$id_student' AND id_question='$id_question'";
        $result=mysqli_query($conn,$query);
        
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $data[] =$row;
            }
            return $data;
            } else {
                 echo "0 results";
            }
            
            
    }
    public static function Delete_answer_student($conn,$id_exam,$id_student){
        $sql = "DELETE FROM student_answer WHERE id_exame=$id_exam AND id_student=$id_student";
        if (mysqli_query($conn, $sql)) {
            self::$successMsg= "Record deleted successfully";
        } else {
            self::$errorMsg= "Error deleting record: " . mysqli_error($conn);
        
        }
            
            
    }
}

?>