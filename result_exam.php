
<?php 
include "connection.php";
include "question.php";
include "professor.php";
include "etudiant.php";
include "exam.php";
include "student_answer.php";
include "exam_historique.php";
session_start();
$db2=new Connection_db('login');
$conn=$db2->conn;
if($_SERVER['REQUEST_METHOD']=='GET'){
    $exam_id=$_SESSION["exam_id"];
    // supprimer old réponses
    Exam_Historique::Delete_Exam_historique($conn,$exam_id,$_SESSION["student_id"]);
    Student_Answer::Delete_answer_student($conn,$exam_id,$_SESSION["student_id"]);
    //insert new answer
    $result=Questions::selectQuestionById_Exame($conn,$exam_id);
    while($row=mysqli_fetch_assoc($result)){
        $answer= new Student_Answer($_SESSION["student_id"],$row["id"],$row["exam_id"],$_GET["answer$row[question_no]"]);
        $answer->insertStudentAnswer($conn);

    }
    $correct=0;
    $wrong=0;
    $result=Questions::selectQuestionById_Exame($conn,$_SESSION["exam_id"]);
    $answers_student=Student_Answer::SelectStudentAnswer($conn,$_SESSION["exam_id"],$_SESSION["student_id"]);
    while($row=mysqli_fetch_assoc($result)){
        if($answers_student[intval($row["id"])]==$row["answer"]){
            $correct++;
        }else{
            $wrong++;
        }

    }
   
    $grade=($correct/($correct+$wrong))*100;
    $grade= round($grade, 2);
    if($grade>=50){
        
    $message="<br><br>
    <div class='card mb-3 w-75 ms-5 border border-success' style='margin-left:70px;'><br>
      <div class='row g-0 ' >
        <div class='col-md-4'>
          <img src='image/win.jpg' class=' rounded-start' alt='...' width='400px' height='400px'>
        </div>
        <div class='col-md-8'>
          <div class='card-body' style='margin-left:200px;'>
            <h1 class='card-title'>Congratulation</h1>
            <h5 class='card-text'>Your Grade Is:  $grade%</h5><br>
            <p class='card-text'>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sunt sit consequatur ab voluptatem obcaecati. Veniam ipsa quo magnam eos. Excepturi.. Sunt sit consequatur ab voluptatem obcaecati. Veniam ipsa quo magnam eos. Excepturi.</p><br><br>
    
            <a href='http://localhost/MYPHP/projet/ecertificat/certificate.php'><button class='btn btn-success' > Get Certification</button></a>
          </div>
        </div>
      </div>
    </div>";
    }else{
        $message="<br><br>
        <div class='card mb-3 w-75 ms-5 border border-danger' style='margin-left:70px;'><br>
          <div class='row g-0 ' >
            <div class='col-md-4'>
              <img src='image/lose.jpg' class=' rounded-start' alt='...' width='400px' height='400px'>
            </div>
            <div class='col-md-8'>
              <div class='card-body' style='margin-left:200px;'>
                <h1 class='card-title'>You Fail</h1>
                <h5 class='card-text'>Your Grade Is:  $grade%</h5>
                <p class='card-text'>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sunt sit consequatur ab voluptatem obcaecati. Veniam ipsa quo magnam eos. Excepturi.. Sunt sit consequatur ab voluptatem obcaecati. Veniam ipsa quo magnam eos. Excepturi.</p><br><br>
        
                <button class='btn btn-danger'> Try Again</button>
              </div>
            </div>
          </div>
        </div>";
    }
    $exam=new Exam_Historique($_SESSION["student_id"],$_SESSION["exam_id"],$grade);
    $exam->insertExam_historique($conn);

}


?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css"
    />
</head>
<body>
    <div> <?php echo $message  ?></div>
</body>
</html>