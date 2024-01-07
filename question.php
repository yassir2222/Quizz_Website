<?php


class Questions{

public $id;
public $question_no;
public $question;
public $option1;
public $option2;
public $option3;
public $option4;
public $answer;
public $exam_id;


 

public static $errorMsg = "";

public static $successMsg="";


public function __construct($question_no,$question,$option1,$option2,$option3,$option4,$answer,$exam_id){

    //initialize the attributs of the class with the parameters, and hash the password
    $this->question_no=$question_no;
    $this->question=$question;
    $this->option1=$option1;
    $this->option2=$option2;
    $this->option3=$option3;
    $this->option4=$option4;
    $this->answer=$answer;
    $this->exam_id=$exam_id;

}

public function insertQuestion($conn){

//insert a client in the database, and give a message to $successMsg and $errorMsg
$query="INSERT INTO questions(question_no,question,opt1,opt2,opt3,opt4,answer,exam_id) VALUES('$this->question_no','$this->question','$this->option1','$this->option2','$this->option3','$this->option4','$this->answer','$this->exam_id')";

if (mysqli_query($conn,$query)) {
 return true;
} else {
    return false;
}

}

public static function  selectAllQuestion($conn){

//select all the client from database, and inset the rows results in an array $data[]
$sql = "SELECT * FROM question";
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
public static function selectQuestionById($conn,$id){
    //select a client by id, and return the row result
$sql = "SELECT * FROM questions WHERE id=$id";
$result = mysqli_query($conn, $sql);
return $result;
}

public static function selectQuestionById_Exame($conn,$id_exame){

$sql = "SELECT * FROM questions WHERE exam_id='$id_exame'";
$result = mysqli_query($conn, $sql);
return $result;
}
public static function updatequestion($question1,$conn,$id1){
    $sql = "UPDATE questions SET question='$question1->question',opt1='$question1->option1',opt2='$question1->option2',opt3='$question1->option3',opt4='$question1->option4',answer='$question1->answer' WHERE id='$id1'";
if (mysqli_query($conn, $sql)) {
    self::$successMsg= "question updated successfully";
} else {
    self::$errorMsg="Error updating record: " . mysqli_error($conn);
}
}

public static function UpdatNo_Question($new_number,$conn,$id){
    $sql = "UPDATE questions SET  question_no=$new_number  WHERE id=$id";

if (mysqli_query($conn, $sql)) {
    $successMsg= "question updated successfully";
    return  $successMsg;
} else {
    $errorMsg="Error updating record: " . mysqli_error($conn);
    return $errorMsg;
}
}


public static function deleteQuestion($conn,$id1){
    
    $sql = "DELETE FROM questions WHERE id=$id1";
    if (mysqli_query($conn, $sql)) {
        self::$successMsg= "Record deleted successfully";
} else {
    self::$errorMsg= "Error deleting record: " . mysqli_error($conn);
}

  
    }

}

?>
