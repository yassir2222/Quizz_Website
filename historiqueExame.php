<?php

include 'connection.php';
include 'question.php';
include 'professor.php';
include 'etudiant.php';
include 'exam.php';
include 'student_answer.php';
include 'exam_historique.php';
$db2=new Connection_db('login');
$conn=$db2->conn;
if($_SERVER['REQUEST_METHOD'] == 'GET'){
  if(isset($_GET["id_student"])){
    $id_student=$_GET["id_student"];
    include "header_professor.php";
  }else{
    include 'header.php';
    $id_student=$_SESSION["student_id"];
   
  }
  $idExamen = $_GET['id_exam'];

    echo $_GET['id_exam'];
    $result=Questions::selectQuestionById_Exame($conn,$idExamen); 
    $exam=Exam::selectExamById($conn,$idExamen); 
    

}

?>

<!DOCTYPE html>

<html lang='en' >
<head>
  <meta charset='UTF-8'>
  <title>CodePen - Bootstrap Quiz Part 4</title>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css'>
  <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">

</head>
<body>
<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
  <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
  </symbol>
  <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
  </symbol>
  <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
  </symbol>
</svg>

<div class="alert alert-primary d-flex align-items-center mt-4 mx-auto w-75" role="alert" >
  <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Info:"><use xlink:href="#info-fill"/></svg>
  <div>
                <span class="fs-5">the Exam Title is :  <span class="fw-bold fs-4"><?php echo $exam["name"]; ?></span> </span>  

  </div>
</div>

<!-- partial:index.partial.html -->
<div class='container-fluid'>
 <?php 
 $number=0;
 while($row=mysqli_fetch_assoc($result)){
    $number++;
    $answer=Student_Answer::Select_Student_Answer_Question($conn,$idExamen,$id_student,$row["id"]);
    $stud_answer=$answer[0]["StudAnswer"];
    if($stud_answer==$row["answer"]){
            echo "
        <div class='card border-success  mb-4 mx-auto w-75'>

        <div class='d-flex justify-content-between align-items-center card-header bg-success text-white ' id='h$number'>
        <span class='fw-semibold'>Question $row[question_no]</span>
        <button type='button' data-toggle='collapse' data-target='#q$number' aria-expanded='false' aria-controls='q2' class='btn btn-outline-light'><svg width='1em' height='1em' viewBox='0 0 16 16' class='bi bi-chevron-down' fill='currentColor' xmlns='http://www.w3.org/2000/svg'>
            <path fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z' />
            </svg>
        </button>
        </div>
        <div id='q$number' class='collapse bg-success-subtle ' aria-labelledby='h$number'>
        <div class='card-body'>
            <p class='fw-semibold'>$row[question]</p>

            <div class='form-check'>
            <input class='form-check-input' type='radio'  id='q1_h$number' name='A_$number'>
            <label class='form-check-label' for='q1_h$number'>
            $row[opt1]
            </label>
            </div>

            <div class='form-check'>
            <input class='form-check-input' type='radio'  id='q2_h$number' name='A_$number'>
            <label class='form-check-label' for='q2_h$number'>
            $row[opt2]
            </label>
            </div>

            <div class='form-check'>
            <input class='form-check-input' type='radio'  id='q3_h$number' name='A_$number'>
            <label class='form-check-label' for='q3_h$number'>
            $row[opt3]
            </label>
            </div>

            <div class='form-check'>
            <input class='form-check-input' type='radio'  id='q4_h$number' name='A_$number'>
            <label class='form-check-label' for='q4_h$number'>
            $row[opt4]
            </label>
            </div>
            <br>
            <div>
                <p class='fw-bold text-success'>Your Answer is Correct</p>
                <p class='fw-semibold'>Your Answer is : $stud_answer</p>
                <p class='fw-semibold'> The Correct Answer is : $row[answer]</p>
            </div>

        </div>
        </div>
    </div>
        
        
        ";
    }else{
        echo "
        <div class='card border-danger  mb-4 mx-auto w-75'>

        <div class='d-flex justify-content-between align-items-center card-header bg-danger text-white' id='h$number'>
        <span class='fw-semibold'>Question $row[question_no]</span>
        <button type='button' data-toggle='collapse' data-target='#q$number' aria-expanded='false' aria-controls='q2' class='btn btn-outline-light'><svg width='1em' height='1em' viewBox='0 0 16 16' class='bi bi-chevron-down' fill='currentColor' xmlns='http://www.w3.org/2000/svg'>
            <path fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z' />
            </svg>
        </button>
        </div>
        <div id='q$number' class='collapse bg-danger-subtle' aria-labelledby='h$number'>
        <div class='card-body'>
            <p class='fw-semibold'>$row[question]</p>

            <div class='form-check'>
            <input class='form-check-input' type='radio'  id='q1_h' name='A_$number'>
            <label class='form-check-label' for='q1_h'>
            $row[opt1]
            </label>
            </div>

            <div class='form-check'>
            <input class='form-check-input' type='radio'  id='q2_h' name='A_$number'>
            <label class='form-check-label' for='q2_h'>
            $row[opt2]
            </label>
            </div>

            <div class='form-check'>
            <input class='form-check-input' type='radio'  id='q3_h' name='A_$number'>
            <label class='form-check-label' for='q3_h'>
            $row[opt3]
            </label>
            </div>

            <div class='form-check'>
            <input class='form-check-input' type='radio'  id='q4_h' name='A_$number'>
            <label class='form-check-label' for='q4_h'>
            $row[opt4]
            </label>
            </div>
            <br>
            <div>
            <p class='fw-bold text-danger'>Your Answer is Wrong </p>
                <p class='fw-semibold'>Your Answer is : $stud_answer</p>
                <p class='fw-semibold'> The Correct Answer is : $row[answer]</p>
            </div>

        </div>
        </div>
    </div>
        
        
        ";
    }
    
 }
 
 ?>
<div class="d-grid gap-2 col-3 mx-auto my-5">
  <button class="btn-outline-dark fs-5" type="button" onclick='window.open("http://localhost/MYPHP/projet/last_exams.php")'>Retour <i class="uil uil-angle-right"></i></button>
</div>
  
</div>
<!-- partial -->
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.4.4/umd/popper.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js'></script>
</body>
</html>
