<?php 

session_start();

include 'professor.php';
include 'connection.php';
include 'email_verification.php';

require 'vendor/autoload.php';
$Error_name="";
$Error_speciality="";
$Error_email="";
$Error_Password="";
$Error_check="";
$msg="";
$ok=0;
if(isset($_POST['submit'])){
    
    $name=$_POST["FullName"];
    $speciality=$_POST["speciality"];
    $email=$_POST["Email"];
    $Password=$_POST["Password"];
  
    
    $code=rand(1000,9999);


    if (empty($speciality)) {  
        $Error_speciality = "Name is required";  
        $msg="<div class='alert alert-danger'>$Error_speciality</div>"; 
        
    } else if (empty($name)) {  
        $Error_name = "Name is required";
        $msg="<div class='alert alert-danger'>$Error_name</div>";  
        
     /*else if (!preg_match("/^[a-zA-Z ]*$/",$name)) {  
        $Error_name = "Only alphabets and white space are allowed";
        $msg="<div class='alert alert-danger'>$Error_name</div>"; */
        
    } else if (empty($email)) {  
        $Error_email = "Email is required";
        $msg="<div class='alert alert-danger'>$Error_email</div>"; 

    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {  
        $Error_email = "Invalid email format";
        $msg="<div class='alert alert-danger'>$Error_email</div>"; 
    } else  if (empty($Password)) {  
        $Error_Password = "Password is required";
        $msg="<div class='alert alert-danger'>$Error_Password</div>"; 
        
    }else if(strlen($Password) < 8) {
        $Error_Password= 'Password should be at least 8 characters in length';
        $msg="<div class='alert alert-danger'>$Error_Password</div>";   
        
    }else if(empty($_POST["check"])){
    $Error_check="Check the box to accept Terms and conditions";
    $msg="<div class='alert alert-danger'>$Error_check</div>";   
    
    }else{
    $db2=new Connection_db('login');
    $conn=$db2->conn;
    var_dump($conn);
    $professor=new Professor($name,$speciality,$email,$Password);
    $insertion=$professor->insertProfessor($conn);
    if($insertion){
        send_email($email,$code);
        $_SESSION['code_verification']=$code;
        $_SESSION['Prof_Name']=$name;
        header("Location: verification_professor.php");
    }else{
        $msg="<div class='alert alert-danger'>somthing wrong</div>";
    }
}
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    <title>Signe Up</title>
</head>

<style>
    body{
        background-color: #d5f8e7;
    }
    .header__center1::before,
    .header__center1::after {
    content: "";
    display: block;
    height: 3px;
    background-color: #d5f8e7;
    }

    .header__center2,.header__center1,.header__center3,.header__center {
    font-size: 2rem;
    display: grid;
    grid-template-columns: 1fr max-content 1fr;
    grid-column-gap: 1.2rem;
    align-items: center;
    }

    #Card_SigneUp:hover{
  box-shadow: rgba(0, 0, 0, 0.56) 0px 22px 70px 4px;
  transition: 1s;
}
#Card_SigneUp{
  transition: 1s;
}

</style>
<body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

<div class="card mb-5 mx-auto mt-5" style="max-width: 900px;" id="Card_SigneUp">
  <div class="row g-0">
    <div class="col-md-4" style="width: 400px;">
      <img src="image/prof.jpg" class="img-fluid rounded-start" style="height: 400px; margin: 15px;">
    </div>
    <div class="col-md-8" style="width: 450px;  padding: 15px;">
      <div class="card-body">
      <div class="header__center1"><h2 class="ms-2 text-center" id="title">Signe Up</h2></div><br>
        <form action="" method="post">
            <div><?php echo $msg ?></div>
            <div class="input-group flex-nowrap mb-3">
                <span class="input-group-text" id="addon-wrapping"><i class="uil uil-user"></i></span>
                <input type="text" class="form-control" placeholder="Full Name" aria-label="Full Name" aria-describedby="addon-wrapping" name="FullName">
            </div>
            <div class="input-group flex-nowrap mb-3">
                <span class="input-group-text" id="addon-wrapping"><i class="uil uil-chat-bubble-user"></i></span>
                <input type="text" class="form-control" placeholder="speciality" aria-label="speciality" aria-describedby="addon-wrapping" name="speciality">
            </div>
            <div class="input-group flex-nowrap mb-3">
                <span class="input-group-text" id="addon-wrapping"><i class="uil uil-envelope"></i></span>
                <input type="email" class="form-control" placeholder="E-mail" aria-label="Email" aria-describedby="addon-wrapping" name="Email">
            </div>
            <div class="input-group flex-nowrap mb-3">
                <span class="input-group-text" id="addon-wrapping"><i class="uil uil-padlock"></i></span>
                <input type="password" class="form-control" placeholder="Password" aria-label="Password" aria-describedby="addon-wrapping" name="Password">
            </div>
            <div class="mb-3 form-check mb-3">
                <input type="checkbox" class="form-check-input" id="exampleCheck1" name="check">
                <label class="form-check-label" for="exampleCheck1">Check me out</label>
            </div>
            <button type="submit" class="btn btn-success" name="submit" style="width: 100%;">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>    
</body>
</html>