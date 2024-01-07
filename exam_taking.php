<?php  
include "connection.php";
include "question.php";
include "professor.php";
include "etudiant.php";
include "exam.php";
include "exam_historique.php";
include "student_answer.php";
include "header.php";
$db2=new Connection_db('login');
$conn=$db2->conn;

    if(isset($_GET["id"])){
       $id=$_GET['id']; 
    }else if (isset($_GET["id_Retry"])){
        $id=$_GET['id_Retry'];
    }
    
    $row=Exam::selectExamById($conn,$id);
    $result=Questions::selectQuestionById_Exame($conn,$id);
    $_SESSION["exam_id"]=$id;
   




?>

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
  
         <span class="fs-5">the Exam Title is :  <span class="fw-bold fs-4"><?php echo $row["name"]; ?></span>
  <br>
         <span class="fs-5">Time :  <span class="fw-bold fs-4" id="countDown"></span>
</div>

<body>
<p id="Time_Exam" style="visibility: hidden;">Time : <span id="Time"><?php echo $row["time"]; ?></span></p>

    
<form method='get' action='http://localhost/MYPHP/projet/result_exam.php'>

        <?php 
        
        $number=0;
            while($row=mysqli_fetch_assoc($result)){
                $number++;
                
               echo "<div class='card border-info mb-4 mx-auto w-75'>

               <div class='d-flex justify-content-between align-items-center card-header bg-info text-white' id='h$number'>
               <span class='fw-bold' ></span><span class='fw-bold' >Question : $row[question_no]</span> 
                 <button type='button' data-toggle='collapse' data-target='#q$number' aria-expanded='false' aria-controls='q$number' class='btn btn-outline-light'><svg width='1em' height='1em' viewBox='0 0 16 16' class='bi bi-chevron-down' fill='currentColor' xmlns='http://www.w3.org/2000/svg'>
                     <path fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z' />
                   </svg>
                 </button>
               </div>
               <div id='q$number' class='collapse' aria-labelledby='h$number'>
                 <div class='card-body'>
                   <h5>$row[question]</h5><br>
           
                   <div class='form-check'>
                     <input class='form-check-input' type='radio' name='answer$row[question_no]' id='radio1$row[question_no]' value='$row[opt1]'>
                     <label class='form-check-label' for='radio1$row[question_no]'>
                     $row[opt1]
                     </label>
                   </div>
           
                   <div class='form-check'>
                     <input class='form-check-input' type='radio' name='answer$row[question_no]' id='radio2$row[question_no]' value='$row[opt2]'>
                     <label class='form-check-label' for='radio2$row[question_no]'>
                     $row[opt2]
                     </label>
                   </div>
           
                   <div class='form-check'>
                   <input class='form-check-input' type='radio' name='answer$row[question_no]' id='radio1$row[question_no]' value='$row[opt3]'>
                   <label class='form-check-label' for='radio3$row[question_no]'>
                   $row[opt3]
                   </label>
                 </div>

                   <div class='form-check'>
                     <input class='form-check-input' type='radio' name='answer$row[question_no]' id='radio4$row[question_no]' value='$row[opt4]'>
                     <label class='form-check-label' for='radio4$row[question_no]'>
                     $row[opt4]
                     </label>
                   </div>
           
                 </div>
           
               </div>
             </div>
             </div>             
             </div>

             "; 
            }
        
        ?>
    <div class="d-flex justify-content-center">
        <button type='submit' class='btn btn-success btn-lg mx-auto' name='submit'>submit</button>
    </div>
    <br><br><br>
</form>

    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.4.4/umd/popper.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js'></script>



</body>



<script>
const StartingMinutes=document.getElementById("Time").innerHTML;
let time=StartingMinutes*60;

const countDown=document.getElementById("countDown");
setInterval(updateCountdown,1000);

function updateCountdown(){
    const minutes=Math.floor(time/60);
    let seconds=time % 60;
    countDown.innerHTML =`${minutes}:${seconds}`;
    

    if(minutes==0 && time==0){
        alert("Time End");
        window.open("http://localhost/MYPHP/projet/student_main.php");
    }
    time--;
}
function blank(){
    minutes=10;
}





</script>
</html>