<?php 
include "exam.php";
include "connection.php";
include "question.php";
$db2=new Connection_db('login');
$conn=$db2->conn;
    
$exames=Exam::selectIdExam_IdProfessor($conn,6);

   


$message="";
if(isset($_POST["select"])){
    $Exame_name=$_POST['select_name'];
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
    <title>Bootstrap Example</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  </head>
  <body class="p-3 m-0 border-0 bd-example m-0 border-0">

    <!-- Example Code -->
    
    <nav class="navbar navbar-dark bg-dark fixed-top">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">Offcanvas dark navbar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
          <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">Dark offcanvas</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
          </div>
          <div class="offcanvas-body">
            <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Dropdown
                </a>
                <ul class="dropdown-menu dropdown-menu-dark">
                  <li><a class="dropdown-item" href="#">Action</a></li>
                  <li><a class="dropdown-item" href="#">Another action</a></li>
                  <li>
                    <hr class="dropdown-divider">
                  </li>
                  <li><a class="dropdown-item" href="#">Something else here</a></li>
                </ul>
              </li>
            </ul>
            <form class="d-flex mt-3" role="search">
              <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" data-listener-added_d77d362d="true">
              <button class="btn btn-success" type="submit">Search</button>
            </form>
          </div>
        </div>
      </div>
    </nav>
    
    <div class="row">
          <div class="col-md-7 mb-3 mx-auto">
            <div class="card">
              <div class="card-header">
                <span><i class="bi bi-clipboard-data"></i></span> Select Exam
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

        <div class="row">
          <div class="col-md-10 mb-3 mx-auto">
            <div class="card">
              <div class="card-header">
                <span><i class="bi bi-clipboard-data"></i></span> Question
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
                                $result=Questions::selectQuestionById_Exame($conn,$id_exame["id"]);

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