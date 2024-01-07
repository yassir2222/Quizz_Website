<?php 
include "connection.php";
include "category.php";
include "header_professor.php";
$msg="";
$name="";
$file_name="";
$image="";
$db=new Connection_db('login');
    $conn=$db->conn;

    if($_SERVER["REQUEST_METHOD"]=='GET' && isset($_GET["select"])){
 
      $row=Category::SellectCategoryByname($conn,$_GET["select"]);
      $image="<img class='mb-3 mx-auto' src='images_Upload/$row[file]' alt='' width='350px' height='350px'>";
      $folder= 'images_Upload/'.$row["file"];
      $name_avant=$row["name"];
          
    }

if(isset($_POST["updat"])){

    $name=$_POST["name"];
    $file_name=$_FILES['image']["name"];
    $tempname= $_FILES["image"]["tmp_name"];

if (empty($name)) {  
    $msg="<div class='alert alert-danger'> Category Name is required </div>"; 
    
} else if (empty($file_name)) {  
    $msg="<div class='alert alert-danger'> File is empty</div>";  
    Category::updateNameCategory($name,$conn,$_GET["select"]);
    $msg_updat=Category::$MsgSuccess;
    $msg="<div class='alert alert-success'> $msg_updat</div>";    
}else{
    $folder= 'images_Upload/'.$file_name;
    $category= new Category($name,$file_name);
    Category::updateCategory($category,$conn, $_GET["select"]);
    $msg_updat=Category::$MsgSuccess;
    $msg="<div class='alert alert-success'> $msg_updat</div>";    
}

}

if(isset($_POST["delete"])){
  Category::deleteExamCategory($conn,$_GET["select"]);
  $msg_updat=Category::$MsgSuccess;
  $msg="<div class='alert alert-success'> $msg_updat</div>";
}






?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    <title>Updat Or Delet Cetegory</title>
  </head>
  <body>
    <!-- top navigation bar -->
    
    <br><br>
        <div class="row ">
        <br><br>

          <div class="col-md-6 mb-3 mx-auto">
            <div class="card" style="box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
              <div class="card-header bg-danger">
                <span class="card-header bg-danger text-white fw-semibold"><i class="uil uil-wrench"></i> Updat Exam Category</span> 
              </div>
              <div class="card-body">
              <form method="get" >
                    <div><?php echo $msg ?></div>
                    <p>Nom De category:</p>
                    <div class="input-group mb-3">
                     
                    <select class="form-select" id="inputGroupSelect04" aria-label="Example select with button addon" name="select">
                        <option selected>Choose...</option>
                          <?php   
                          $resultat=Category::SellectAllCategorys($conn);
                          while ($ligne = mysqli_fetch_array($resultat)) {
                            echo "<option value='$ligne[name]'>$ligne[name]</option>";
                          }
                          ?>
                          
                        </select>
                        <button class="btn btn-outline-secondary" type="submit">Select</button>   
                    </div>
                    </form>
                    <form method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="exampleInputName" class="form-label">Category name :</label>
                        <input type="text" class="form-control" id="exampleInputName" aria-describedby="InputName" name="name" value=<?php if(isset($_GET["select"])){echo $_GET["select"];} ?>>
                    </div>
                    <p>Image:</p>
                    <?php echo $image; ?>
                    <div class="input-group mb-3">
                        <input type="file" class="form-control" id="inputGroupFile01" name="image">
                    </div>                    
                    <br>
                    
                        <button type="submit " class="btn btn-outline-primary fw-semibold" name="updat" >Updat</button>
                        <form method="post">
                        <button type="submit" class="btn btn-outline-danger fw-semibold" name="delete" >Delete</button>
                        </form>
                    </form>
              </div>
            </div>
          </div>
        </div>
</div>
<div> <?php Category::$MsgError;
?></div>
  </body>
</html>
