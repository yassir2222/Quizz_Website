<?php  
session_start();
include "connection.php";
$Error_email="";
$Error_Password="";
$msg="";

if(isset($_POST['submit'])){
    
  $username=$_POST['username'];
    $password=$_POST['Password'];

    if (empty($username)) {  
        $Error_email = "Username is required";
        $msg="<div class='alert alert-danger'>$Error_email</div>"; 
       
    } else if (empty($password)) {  
        $Error_Password = "Password is required";
        $msg="<div class='alert alert-danger'>$Error_Password</div>"; 
        
    }else if(strlen($password) < 8) {
      $Error_Password= 'Password should be at least 8 characters in length';
      $msg="<div class='alert alert-danger'>$Error_Password</div>";   
      
  }else {
        $db=new Connection_db('login');
        $conn=$db->conn;
      
        $sql="SELECT * FROM users WHERE username='{$username}'";
        $result = mysqli_query($conn, $sql);
        mysqli_num_rows($result);
        if(mysqli_num_rows($result)>0){
          $sql="SELECT password FROM users WHERE username='{$username}'";
          $result = mysqli_query($conn, $sql);
          $row_password= mysqli_fetch_assoc($result);
          if(password_verify( $password, $row_password['password'])){
          
            $_SESSION['Username']=$username;
            $id=Etudiant::selectEtudiantByName($conn,$username);
            $_SESSION["student_id"]=$id[0]["id"];
            header("Location: Home.php");
          }else{
            $msg="<div class='alert alert-danger'>Password not Matche</div>";
          }

            
        }else{
          $msg="<div class='alert alert-danger'>Invalid Username or Password</div>";
        }
    }

}
?>
<style>
#Card_login:hover{
  box-shadow: rgba(0, 0, 0, 0.56) 0px 22px 70px 4px;
  transition: 1s;
}
#Card_login{
  transition: 1s;
}
body{
  background-color: #408b9d !important;
}
.header__center1::before,
.header__center1::after {
    content: "";
    display: block;
    height: 3px;
    background-color: #49d7f4;
}

.header__center2,.header__center1,.header__center3,.header__center {
    font-size: 2rem;
    display: grid;
    grid-template-columns: 1fr max-content 1fr;
    grid-column-gap: 1.2rem;
    align-items: center;
}
</style>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    <title>Signe Up</title>
</head>
<body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

<div class="card mb-5 mx-auto mt-5" style="max-width: 900px;" id="Card_login">
  <div class="row g-0">
    <div class="col-md-4" style="width: 400px;">
      <img src="image/login.png" class="img-fluid rounded-start" alt="..." style="height: 390px; margin: 15px;">
    </div >
    <div class="col-md-8" style="width: 450px; padding: 15px;">
      <div class="card-body">
      <div class="header__center1"><h2 class="ms-2 text-center" id="title" >Login</h2></div><br>
        <form action="" method="post">
        <div><?php echo $msg ?></div>
            <div class="input-group flex-nowrap mb-3">
                <span class="input-group-text" id="addon-wrapping" ><i class="uil uil-chat-bubble-user"></i></span>
                <input type="text" class="form-control" placeholder="Username" aria-label="Email" aria-describedby="addon-wrapping" name="username">
            </div>
            
            <div class="input-group flex-nowrap mb-3">
                <span class="input-group-text" id="addon-wrapping"><i class="uil uil-padlock"></i></span>
                <input type="password" class="form-control" placeholder="Password" aria-label="Password" aria-describedby="addon-wrapping" name="Password">
            </div>
           
            <button type="submit" class="btn btn-outline-info btn-block" name="submit" style="width: 100%;"><span style="font-weight: 600;"> Login</span></button>
        </form>
      </div>
    </div>
  </div>
</div>    
</body>
</html>