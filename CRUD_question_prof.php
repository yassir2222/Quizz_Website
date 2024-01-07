<?php 
include "exam.php";
include "connection.php";
include "question.php";
include "header_professor.php";
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
    <title>Edit Questions</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  </head>
  <body class="p-3 m-0 border-0 bd-example m-0 border-0">

    <div class="row">
          <div class="col-md-7 mb-3 mx-auto">
            <div class="card border" style="box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
              <div class="card-header bg-black">
                <span class="fs-5 text-light"><i class="bi bi-clipboard-data"></i> Select Exam</span> 
              </div>
              <div class="card-body">
                  <form method="post">
                    <div></div>
                    <div class="input-group">
                    <select class="form-select" id="inputGroupSelect04" aria-label="Example select with button addon" name="select_name">
                        <option selected>Choose...</option>
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
            <div class="card">
              <div class="card-header bg-black">
                <span class="fs-5 text-light"><i class="bi bi-clipboard-data"></i> Question</span> 
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
                                            <th scope="col">number Question</th>
                                            <th scope="col">option 1</th>
                                            <th scope="col">option 2</th>
                                            <th scope="col">option 3</th>
                                            <th scope="col">option 4</th>
                                            <th scope="col">answer</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>';
                                $result=Questions::selectQuestionById_Exame($conn,intval($id_exame["id"]));

                            while($row=mysqli_fetch_assoc($result)){
                                echo "
                                    <tr>
                                    <td>$row[question_no]</td>
                                    <td>$row[question]</td>
                                    <td>$row[opt1]</td>
                                    <td>$row[opt2]</td>
                                    <td>$row[opt3]</td>
                                    <td>$row[opt4]</td>
                                    <td>$row[answer]</td>
                                    <td>
                                        <a class='btn btn-outline-success btn-sm' href='updat_question.php?id=$row[id]'>edit </a>
                                        <a class='btn btn-outline-danger btn-sm' href='Delet_question.php?id=$row[id]'>Delet </a>
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