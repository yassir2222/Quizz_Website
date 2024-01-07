
<?php 
include "exam.php";
include "connection.php";
include "question.php";
include "header_professor.php";
include "exam_historique.php";
include "etudiant.php";
$db2=new Connection_db('login');
$conn=$db2->conn;
$exames=Exam::selectIdExam_IdProfessor($conn,$_SESSION['Prof_Id']);

   


$message="";
if(isset($_POST["select"])){
    $Exame_name=$_POST["select_name"];
    $id_exame=Exam::selectIdExameFromName($conn,$Exame_name);
}

?>   
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <title>Student Results</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  </head>
  <body class="p-3 m-0 border-0 bd-example m-0 border-0">

    <div class="row">
          <div class="col-md-5 mb-3 mx-auto">
            <div class="card " style="box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
              <div class="card-header bg-secondary">
                <span class="fw-semibold text-light fs-5"><i class="bi bi-clipboard-data"></i>Select Exam</span> 
              </div>
              <div class="card-body">
                    <form method="post">
                    <div></div>
                    <div class="input-group">
                    <select class="form-select" id="inputGroupSelect04" aria-label="Example select with button addon" name="select_name">
                        <option selected>Choose Exam</option>
                        <?php foreach($exames as $exam): ?>
                        <option value=<?php echo $exam ?>> <?php echo $exam ?> </option>
                        <?php endforeach; ?>
                    </select>
                    
                    <button class="btn btn-outline-success" type="submit" name="select">Select</button>
                    </div>


                    </form>
              </div>
            </div>
          </div>
        </div>
         <br><br>
        <div class="row">
          <div class="col-md-10 mb-3 mx-auto">
            <div class="card" style="box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
              <div class="card-header bg-secondary">
                <span  class="fw-semibold text-light fs-5"><i class="bi bi-clipboard-data"></i>Statistiques</span> 
              </div>
              <div class="card-body">
                    <form method="post">
                    <div>
                        <?php
                            if(isset($_POST["select"]) ){


                                echo'<table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Student ID</th>
                                            <th scope="col">username Student</th>
                                            <th scope="col">Grade</th>
                                            <th scope="col">Date</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>';
                                $result=Exam::selectExamByidProf($conn,$_SESSION['Prof_Id']);

                            while($row=mysqli_fetch_assoc($result)){
                                $exam=Exam_Historique::selectExam_historique_by_IDExam($conn,$row["id"]);
                                $student=Etudiant::selectEtudiantById($conn,$exam["id_student"]);
                                echo "
                                    <tr>
                                    <td>$exam[id]</td>
                                    <td>$exam[id_student]</td>
                                    <td>$student[username]</td>
                                    <td>$exam[grade]%</td>
                                    <td>$exam[reg_date]</td>

                                    <td class='text-center'>
                                        <a class='btn btn-dark btn-sm text-center' href='historiqueExame.php?id_exam=$exam[id_exam]&id_student=$exam[id_student]'> View Details </a>
                                    </td>
                                    </tr>
                                ";
                            }
                            echo "</table>";
                            } 
                            
                            
                        ?>

                    </div>
                    </form>
              </div>
            </div>
          </div>
        </div>
  </body>
</html>