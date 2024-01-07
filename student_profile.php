<?php  
include "header.php";
include "professor.php";
include "connection.php";
include "etudiant.php";

$db2=new Connection_db('login');
$conn=$db2->conn;
$student=Etudiant::selectEtudiantById($conn,$_SESSION["student_id"]);
$message="";
if(isset($_POST["submit"])){
    $username=$_POST["username"];
    $fullName=$_POST["fullName"];
    $email=$_POST["email"];
    $password=$_POST["password"];
    if(empty($password)){
        Etudiant::updateEtudiantWithoutPassword($fullName,$username,$email,$conn,$_SESSION["student_id"]);
        $mesg=Etudiant::$successMsg;
        $message="<div class='alert alert-success'>$mesg</div>";
        $_SESSION['Username']=$username;
    }else{
        $student= new Etudiant($fullName,$username,$email,$password);
    Etudiant::updateEtudiant($student,$conn,$_SESSION["student_id"]);
    $mesg=Etudiant::$successMsg;
    $message="<div class='alert alert-success'>$mesg</div>";
    $_SESSION['Username']=$username;
    }
    
    $student=Etudiant::selectEtudiantById($conn,$_SESSION["student_id"]);
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">


<title>bs5 edit profile account details - Bootdey.com</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
<style type="text/css">
    	body{margin-top:20px;
background-color:#f2f6fc;
color:#69707a;
}
.img-account-profile {
    height: 10rem;
}
.rounded-circle {
    border-radius: 50% !important;
}
.card {
    box-shadow: 0 0.15rem 1.75rem 0 rgb(33 40 50 / 15%);
}
.card .card-header {
    font-weight: 500;
}
.card-header:first-child {
    border-radius: 0.35rem 0.35rem 0 0;
}
.card-header {
    padding: 1rem 1.35rem;
    margin-bottom: 0;
    background-color: rgba(33, 40, 50, 0.03);
    border-bottom: 1px solid rgba(33, 40, 50, 0.125);
}
.form-control, .dataTable-input {
    display: block;
    width: 100%;
    padding: 0.875rem 1.125rem;
    font-size: 0.875rem;
    font-weight: 400;
    line-height: 1;
    color: #69707a;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #c5ccd6;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    border-radius: 0.35rem;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}

.nav-borders .nav-link.active {
    color: #0061f2;
    border-bottom-color: #0061f2;
}
.nav-borders .nav-link {
    color: #69707a;
    border-bottom-width: 0.125rem;
    border-bottom-style: solid;
    border-bottom-color: transparent;
    padding-top: 0.5rem;
    padding-bottom: 0.5rem;
    padding-left: 0;
    padding-right: 0;
    margin-left: 1rem;
    margin-right: 1rem;
}
    </style>
</head>
<body>
<div class="container-xl px-4 mt-4" >



<div class="row">
<div class="col-xl-4">

<div class="card mb-4 mb-xl-0 w-50 mx-auto">
<div class="card-header">Profile Picture</div>
<div class="card-body text-center">

<img class="img-account-profile rounded-circle mb-2" src="http://bootdey.com/img/Content/avatar/avatar6.png" alt><br>

</div>
</div>
</div>
<div class="col-xl-8">

<div class="card mb-4 w-75 mx-auto">
<div class="card-header ">Account Details</div>
<div class="card-body">
<form method="post">
<span> <?php echo $message ?></span>
<div class="row gx-3 mb-3">

<div class="col-md-6">
<label class="small mb-1" for="inputFirstName">full Name :</label>
<input class="form-control" id="inputFirstName" type="text" placeholder="Enter your Full name" value=<?php echo  $student["name"] ?>  name="fullName"required>

</div>

<div class="col-md-6">
<label class="small mb-1" for="inputLastName">Username</label>
<input class="form-control" id="inputLastName" type="text" placeholder="Enter your last name" value=<?php echo  $student["username"] ?> name="username" required>
</div>
</div>

<div class="row gx-3 mb-3">

<div class="col-md-6">
<label class="small mb-1" for="inputOrgName">Email :</label>
<input class="form-control" id="inputOrgName" type="email" placeholder="Enter your organization name" value=<?php echo  $student["email"] ?> name="email" required>
</div>

<div class="col-md-6">
<label class="small mb-1" for="inputLocation">password</label>
<input class="form-control" id="inputLocation" type="password" placeholder="Enter New Password" name="password">
</div>
</div>

<br>
<div class="d-grid gap-2 col-3 mx-auto">
  <button class="btn btn-dark" type="submit" name="submit">
     <span class="fw-semibold">Submit</span>
  </button>
</div>
</form>
</div>
</div>
</div>
</div>
</div>
<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript">
	
</script>
</body>
</html>