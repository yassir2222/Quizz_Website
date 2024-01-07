<?php 
include "connection.php";
include "question.php";
include "professor.php";
include "etudiant.php";

$db=new Connection_db('login');
$conn=$db->conn;
$question="";
$option1="";
$option2="";
$option3="";
$option4="";
$answer="";
$id="";
$msg="";

if($_SERVER['REQUEST_METHOD']=='GET'){
    $id=$_GET['id'];
    $old_question=Questions::selectQuestionById($conn,$id);
    $row=mysqli_fetch_assoc($old_question);
    $question=$row["question"];
    $option1=$row["opt1"];
    $option2=$row["opt2"];
    $option3=$row["opt3"];
    $option4=$row["opt4"];
    $answer=$row["answer"];
}

if(isset($_POST["submit"])){
    $question=$_POST["question"];
    $option1=$_POST["opt1"];
    $option2=$_POST["opt2"];
    $option3=$_POST["opt3"];
    $option4=$_POST["opt4"];
    $answer=$_POST["answer"];
    $new_question=new Questions($id,$question,$option1,$option2,$option3,$option4,$answer," ");
    Questions::updatequestion($new_question,$conn,$id);
    $msg="<div class='alert alert-success'>Question Updated Seccussfully</div>";
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
    <title>Updat Question</title>
</head>
<body><br><br>
<div class="row">
          <div class="col-md-9 mb-3 mx-auto">
            <div class="card border border-black border-2" style="box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
              <div class="card-header bg-success">
                <span class="fw-semibold fs-4 text-light"><i class="bi bi-clipboard-data "></i> Updat Question </span>
              </div>
    <div class="card-body">
        <form method="post">

            <div><?php echo $msg ?></div>
            <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label fw-bold">Question</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="question"><?php echo $question?></textarea>
            </div>
            <div class="mb-3">
                <label for="exampleInputName" class="form-label fw-bold">option 1:</label>
                <input type="text" class="form-control" id="exampleInputName"  name="opt1" value=<?php echo $option1?>>
            </div>
            <div class="mb-3">
                <label for="exampleInputTime" class="form-label fw-bold">option 2:</label>
                <input type="text" class="form-control" id="exampleInputTime"  name="opt2" value=<?php echo $option2?>>
            </div>
            <div class="mb-3">
                <label for="exampleInputTime" class="form-label fw-bold">option 3:</label>
                 <input type="text" class="form-control" id="exampleInputTime"  name="opt3" value=<?php echo $option3?>>
            </div>
            <div class="mb-3">
                 <label for="exampleInputTime" class="form-label fw-bold">option 4:</label>
                <input type="text" class="form-control" id="exampleInputTime"  name="opt4"  value=<?php echo $option4?>>
            </div>
            <div class="mb-3">
                <label for="exampleInputTime" class="form-label fw-bold">Ansewer :</label>
                <input type="text" class="form-control" id="exampleInputTime"  name="answer" value=<?php echo $answer?>>
            </div>
            <div class=" row mb-3">
                <div class="offset-sm-1 col-sm-3 d-grid">
                        <button name="submit" type="submit" class="btn btn-outline-primary fw-bold">Submit</button>
                </div>
                <div class="offset-sm-1 col-sm-3 d-grid">
                <a href="CRUD_question_prof.php" class="btn btn-outline-success fw-bold">Cancel</a>
                </div>
            </div>
            </form>
    </div>
            </div></div></div>

</body>
</html>
