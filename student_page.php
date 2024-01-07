<?php 
include "connection.php";
include "question.php";
include "professor.php";
include "etudiant.php";
include "exam.php";
include "student_answer.php";
include "header.php";
$db2=new Connection_db('login');
$conn=$db2->conn;
$student=Etudiant::selectEtudiantByName($conn,$_SESSION['Username']);
$_SESSION["student_id"]=$student[0]["id"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    <title>Document</title>
</head>
<body>

<br><br>
<div class="row row-cols-1 row-cols-md-3 g-4 mx-5">
  <div class="col">
    <div class="card h-100" style="box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
      <img src="image/quizz2.jpg" class="card-img-top" alt="..." height="245px" width="325px">
      <div class="card-body">
        <h3 class="card-title">Quizz</h3>
        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
      </div>
      <div class="card-footer">
        <div class='d-grid gap-2 col-6 mx-auto'><a class='btn btn btn-warning fw-semibold' href='http://localhost/MYPHP/projet/category_page.php' style="background-color: #FF735C;">Enroll Now </a></div>
      </div>
    </div>
  </div>
  <div class="col">
    <div class="card h-100" style="box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
      <img src="image/exam.jpg" class="card-img-top" alt="..." height="245px" width="325px">
      <div class="card-body">
        <h3 class="card-title">Last exames</h3>
        <p class="card-text">This is a short card.</p>
      </div>
      <div class="card-footer">
        <div class='d-grid gap-2 col-6 mx-auto'><a class='btn btn btn-warning fw-semibold' href='http://localhost/MYPHP/projet/last_exams.php' >View ... </a></div>
      </div>
    </div>
  </div>
  <div class="col">
    <div class="card h-100" style="box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
      <img src="image/student.jpg" class="card-img-top" alt="..." height="245px" width="325px">
      <div class="card-body">
        <h3 class="card-title">Profile</h3>
        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content.</p>
      </div>
      <div class="card-footer">
        <div class='d-grid gap-2 col-6 mx-auto'><a class='btn btn-secondary fw-semibold' href='student_profile.php' >Enroll Now </a></div>
      </div>
    </div>
  </div>
  <div class="col">
    <div class="card h-100" style="box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
      <img src="image/quitter.jpg" class="card-img-top" alt="..." height="245px" width="325px">
      <div class="card-body">
        <h3 class="card-title">Logout</h3>
        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
      </div>
      <div class="card-footer">
        <div class='d-grid gap-2 col-6 mx-auto'><a class='btn btn btn-warning fw-semibold' href='' style="background-color: #FF735C;">Enroll Now </a></div>
      </div>
    </div>
  </div>
</div>
<br><br>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>
</html>
