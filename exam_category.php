<?php
session_start();

include 'exam.php';
include 'question.php';
include 'connection.php';
include "header_professor.php";
include "category.php";
include "professor.php";


$Error_name="";
$Error_timeExam="";
$Error_question="";
$Error_answer="";
$Error_option="";
$msg="";
$msg2="";

$db2=new Connection_db('login');
$conn=$db2->conn;
if(isset($_POST['submit'])){
    
    $name=$_POST["name"];
    $time=$_POST["Time"];
    $exam_category=$_POST["select"];

    if (empty($name)) {  
        
        $msg="<div class='alert alert-danger'> Name is required </div>"; 
        
    } else if (empty($time)) {  
        $Error_timeExam = "time is required";
        $msg="<div class='alert alert-danger'>$Error_timeExam</div>";  
        
    } else{
   
    $id_professor= Professor::selectIdProfessor($conn,$_SESSION['prof_name']);
    $exam=new Exam($name,$time,$id_professor,$exam_category);
    $insertion=$exam->insertExam($conn);
    if($insertion){
        $msg="<div class='alert alert-success'>Exam Added succesfully</div>";
        $_SESSION['exam_name']=$name;
        $_SESSION['exam_time']=$time;
        $exam_row=$exam->selectExamByName($conn,$name);
        $_SESSION['exam_id']=$exam_row['id'];

    }else{
        $msg="<div class='alert alert-danger'>somthing wrong</div>";
    }
    }

}

if(isset($_POST['submit2'])){
    $no_question=0;
    $question=$_POST["question"];
    $option1=$_POST["opt1"];
    $option2=$_POST["opt2"];
    $option3=$_POST["opt3"];
    $option4=$_POST["opt4"];
    $answer=$_POST["answer"];

    if (empty($question)) {  
         
        $msg2="<div class='alert alert-danger'>question is required</div>"; 
        
    } else if (empty($option1)||empty($option2)||empty($option3)||empty($option4)) {  
        $Error_option = "option is required";
        $msg2="<div class='alert alert-danger'>$Error_option</div>";  
        
    }else if(empty($answer)){
        $Error_answer = "answer is required";
        $msg2="<div class='alert alert-danger'>$Error_answer</div>"; 
    }else{
    $db2=new Connection_db('login');
    $conn=$db2->conn;
    
    
    $result=Questions::selectQuestionById_Exame($conn,$_SESSION['exam_id']);
    if(mysqli_num_rows($result)==0){
      $no_question++;
    }else{
      $no_question=0;

      while ($row = mysqli_fetch_assoc($result)) {
        $no_question++;
        Questions::UpdatNo_Question($no_question,$conn,$row['id']);
      }
      $no_question++;
    }



    $question1=new Questions($no_question,$question,$option1,$option2,$option3,$option4,$answer,$_SESSION['exam_id']);
    $insertion=$question1->insertQuestion($conn);
    if($insertion){
        $msg2="<div class='alert alert-success'>success</div>";

    }else{
        $msg2="<div class='alert alert-danger'>somthing wrong</div>";
    }
    }

}

?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <title>Exam</title>
  </head>
  <body>
    <!-- top navigation bar -->
    
    <main class="">
        <div class="row ">
          <div class="col-md-6 mb-3 mx-auto">
            <div class="card">
              <div class="card-header bg-dark">
                <span class="card-header bg-dark text-white fw-semibold"><i class="uil uil-plus"></i>  New Exam</span> 
              </div>
              <div class="card-body">
                    <form method="post">
                    <div><?php echo $msg ?></div>
                    <div class="input-group mb-3">
                     
                     <select class="form-select" id="inputGroupSelect04" aria-label="Example select with button addon" name="select">
                         <option selected>Choose...</option>
                           <?php   
                           $resultat=Category::SellectAllCategorys($conn);
                           while ($ligne = mysqli_fetch_array($resultat)) {
                             echo "<option value='$ligne[name]'>$ligne[name]</option>";
                           }
                           ?>
                           
                         </select>
                         <button class="btn btn-outline-secondary" type="submit">Select</button>   
                     </div>
                    <div class="mb-3">
                        <label for="exampleInputName" class="form-label">Exame name</label>
                        <input type="text" class="form-control" id="exampleInputName" aria-describedby="InputName" name="name">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputTime" class="form-label">Time In minute</label>
                        <input type="text" class="form-control" id="exampleInputTime" name="Time">
                    </div>
                    
                    <div class="d-grid gap-2 col-4 mx-auto">
                        <button type="submit" class="btn btn-danger fw-semibold" name="submit" >Submit</button>
                        
                    </div>
                    </form>
              </div>
            </div>
          </div>
        </div>
        <br><br>
        <div class="row">
          <div class="col-md-8 mb-3 mx-auto">
            <div class="card">
              <div  class="card-header bg-dark text-white fw-semibold card-header">
                <span  ><i class="uil uil-question-circle"></i> New Question</span> 
              </div>
              <div class="card-body">
                    <form method="post">
                        <div><h5>Exame_id: <?php echo $_SESSION['exam_id'] ?></h6></div><br>
                    <div><?php echo $msg2 ?></div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label fw-semibold">Question :</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="question"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputName" class="form-label">option 1:</label>
                        <input type="text" class="form-control" id="exampleInputName"  name="opt1">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputTime" class="form-label">option 2:</label>
                        <input type="text" class="form-control" id="exampleInputTime"  name="opt2">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputTime" class="form-label">option 2:</label>
                        <input type="text" class="form-control" id="exampleInputTime"  name="opt3">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputTime" class="form-label">option 4:</label>
                        <input type="text" class="form-control" id="exampleInputTime"  name="opt4">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputTime" class="form-label">Ansewer :</label>
                        <input type="text" class="form-control" id="exampleInputTime"  name="answer">
                    </div>
                    <div class="d-grid gap-2 col-4 mx-auto">
                        <button type="submit" class="btn btn-danger fw-semibold" name="submit2" >Submit</button>
                    </div>
                    </form>
              </div>
            </div>
          </div>
        </div>
        
      </div>
    </main>
    
  </body>
</html>
