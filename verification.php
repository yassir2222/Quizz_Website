
<?php   
session_start();
$Error_msg="";
if(isset($_POST['verify'])){
    $code=$_POST["code"];
    if($code==$_SESSION['code_verification']){
      
        header("Location: Home.php");
    }else{
        $Error_msg="<div class='alert alert-danger'>code note correct</div>"; 
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
    <title>verification code</title>
</head>
<body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

<div class="card mb-5 mx-auto mt-5" style="max-width: 900px;">
  <div class="row g-0">
    <div class="col-md-4" style="width: 400px;">
      <img src="image/login.png" class="img-fluid rounded-start" alt="..." style="height: 400px;">
    </div>
    <div class="col-md-8" style="width: 450px;">
      <div class="card-body">
        <h2 class="card-title mb-4">Enter the verification code</h2>
        <form action="" method="post">
        <div><?php echo $Error_msg ?></div>
            <div class="input-group flex-nowrap mb-3">
                <span class="input-group-text" id="addon-wrapping">#</span>
                <input type="text" class="form-control" placeholder="Code" aria-label="code" aria-describedby="addon-wrapping" name="code">
            </div>
            <button type="submit" class="btn btn-primary" name="verify">Verify</button>
        </form>
      </div>
    </div>
  </div>
</div>    
</body>
</html>