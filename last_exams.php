<?php 
session_start();
include 'connection.php';
include 'question.php';
include 'professor.php';
include 'etudiant.php';
include 'exam.php';
include 'student_answer.php';
include 'exam_historique.php';
$db2=new Connection_db('login');
$conn=$db2->conn;
$_SESSION['student_id']=40;



?>

<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN' crossorigin='anonymous'>
    <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js' integrity='sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL' crossorigin='anonymous'></script>
    <link rel='stylesheet' href='https://unicons.iconscout.com/release/v4.0.8/css/line.css'>
    <title>Document</title>
</head>
<body>
<nav class='navbar navbar-dark bg-dark fixed-top'>
  <div class='container-fluid'>
    <h2><a class='navbar-brand' href='#'><i class='uil uil-user'></i>  Student</a></h2>
    <button class='navbar-toggler' type='button' data-bs-toggle='offcanvas' data-bs-target='#offcanvasDarkNavbar' aria-controls='offcanvasDarkNavbar' aria-label='Toggle navigation'>
      <span class='navbar-toggler-icon'></span>
    </button>
    <div class='offcanvas offcanvas-end text-bg-dark' tabindex='-1' id='offcanvasDarkNavbar' aria-labelledby='offcanvasDarkNavbarLabel'>
      <div class='offcanvas-header'>
        <h5 class='offcanvas-title' id='offcanvasDarkNavbarLabel'><?php echo $_SESSION['Username'] ?></h5>
        <button type='button' class='btn-close btn-close-white' data-bs-dismiss='offcanvas' aria-label='Close'></button>
      </div>
      <div class='offcanvas-body'>
        <ul class='navbar-nav justify-content-end flex-grow-1 pe-3'>
          <li class='nav-item'>
            <a class='nav-link active' aria-current='page' href='#'>Home</a>
          </li>
          <li class='nav-item'>
            <a class='nav-link' href='#'>Logout</a>
          </li>
          <li class='nav-item dropdown'>
            <a class='nav-link dropdown-toggle' href='#' role='button' data-bs-toggle='dropdown' aria-expanded='false'>
              Dropdown
            </a>
            <ul class='dropdown-menu dropdown-menu-dark'>
              <li><a class='dropdown-item' href='student_main.php'>Enroll Exams</a></li>
              <li><a class='dropdown-item' href='#'>View Profil</a></li>
              <li><a class='dropdown-item' href='#'>View Last Exams</a></li>
            </ul>
          </li>
        </ul>
        <form class='d-flex mt-3' role='search'>
          <input class='form-control me-2' type='search' placeholder='Search' aria-label='Search'>
          <button class='btn btn-success' type='submit'>Search</button>
        </form>
      </div>
    </div>
  </div>
</nav>

<?php
$exam_historique=Exam_Historique::selectExam_historique_by_ID($conn,$_SESSION['student_id']);
$num=0;
echo "<div class='row row-cols-3 g-4 mt-5 mx-5'>";
while($row=mysqli_fetch_assoc($exam_historique)){
    $num++;
    $exam=Exam::selectExamById($conn,$row['id_exam']);
    $color='border-danger';
    
    if($row['grade']>=50){
      $color='border-success';
    }
    echo "
  <div class='col'>
    <div class='card bg-light mb-3 mt-1 border-top-0  border-end-0 border-bottom-0 $color border-4'>
      <div class='card-header'>Exame $num</div>
      <div class='card-body '>
        <h2 class='card-title'>$exam[name]</h2>
        <p> your Grade :<span class='fw-semibold'>$row[grade]%</span></p>
        <p>Last Update: <i class='uil uil-clock'></i> <span class='fw-semibold'>$row[reg_date]</span></p>
      </div>
      <div class='card-footer'>
        <div class='d-grid gap-2 d-md-flex justify-content-md-end'>
        <a class='btn btn-dark fw-semibold' href='historiqueExame.php?id_exam=$row[id_exam]'>View..</a>
        <button type='button' class='btn btn-dark fw-semibold' data-bs-toggle='modal' data-bs-target='#staticBackdrop'>Retry</button>
        </div>
      </div>
    </div>
  </div>




  <div class='modal fade ' id='staticBackdrop' data-bs-backdrop='static' data-bs-keyboard='false' tabindex='-1' aria-labelledby='staticBackdropLabel' aria-hidden='true'>
  <div class='modal-dialog bg-danger-subtle'>
    <div class='modal-content bg-danger-subtle'>
      <div class='modal-header bg-danger-subtle'>
        <h1 class='modal-title fs-5' id='staticBackdropLabel'>warning</h1>
        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
      </div>
      <div class='modal-body'>
        <h4>l'historique des réponse de cette examin vas étre detruit</h4>
      </div>
      <div class='modal-footer'>
        <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
        <a  class='btn btn-danger' href='exam_taking.php?id_Retry=$row[id_exam]' name='valide'>Understood</a>
      </div>
    </div>
  </div>
</div>
  ";
}
echo '</div>';
?>
<!-- Modal -->




</body>
</html>
