<?php
include "connection.php";
include "question.php";
include "professor.php";
include "etudiant.php";
include "exam.php";
include "header.php";
$db2=new Connection_db('login');
$conn=$db2->conn;  



?>



<!doctype html>
<html lang="en">
  
<body>

<?php 
$category_name=$_GET["category"];
$exams=Exam::selectExamByCategory($conn,$category_name);
$num=1;
echo "<br><br><div class='row row-cols-1 row-cols-md-2 g-4 mx-5'>";
while($row=mysqli_fetch_assoc($exams)){
    $prof=Professor::selectProfessorById($conn,$row['id']);

echo "<div class='col' >
<div class='card mb-3' style=' box-shadow: rgba(0, 0, 0, 0.16) 0px 3px 6px, rgba(0, 0, 0, 0.23) 0px 3px 6px;'>
<div class='row g-0'>
  <div class='col-md-4'>
    <img src='image/chek$num.png' class='rounded-start' alt='...' height='200px' width='190px'>
  </div>
  <div class='col-md-8'>
    <div class='card-body ms-4'>
      <h3 class='card-title'>$row[name]</h3>
      <p>Created By : $prof[name]</p>
      <p>Time <i class='uil uil-clock'></i> : $row[time]</p>
      <div class='d-grid gap-2 col-6 mx-auto'><a class='btn btn-outline-success fw-semibold' href='exam_taking.php?id=$row[id]' style=' box-shadow: rgba(0, 0, 0, 0.16) 0px 3px 6px, rgba(0, 0, 0, 0.23) 0px 3px 6px;'>Enroll Now </a></div>
    </div>
  </div>
</div>
</div>
</div>";
$num++;
if($num==4){
  $num=1;
}
}
echo "</div>";
?>



   

 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>       
  </body>
</html>