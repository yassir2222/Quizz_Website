<?php 
include "connection.php";
include "category.php";
include "header_professor.php";

$msg="";
$name="";
$file_name="";
$db=new Connection_db('login');
    $conn=$db->conn;
if(isset($_POST["submit"])){

    $name=$_POST["name"];
    $file_name=$_FILES['image']["name"];
    $tempname= $_FILES["image"]["tmp_name"];

if (empty($name)) {  
    $msg="<div class='alert alert-danger'> Category Name is required </div>"; 
    
} else if (empty($file_name)) {  
    $msg="<div class='alert alert-danger'> File is empty</div>";  
}else{
    $folder= 'images_Upload/'.$file_name;
    $category= new Category($name,$file_name);
    
    $category->InsertCategory($conn);

    if(move_uploaded_file($tempname, $folder)){
        $msg="<div class='alert alert-success'> Category added seccesfully</div>";  

    }
}

 
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
    <title>Creat category</title>
  </head>
  <body>
    <!-- top navigation bar -->
    
    <br><br>
        <div class="row ">
        <br><br>

          <div class="col-md-6 mb-3 mx-auto">
            <div class="card" style="box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
              <div class="card-header bg-secondary">
                <span class="card-header bg-secondary text-white fw-semibold"><i class="uil uil-plus"></i> New Exam Category</span> 
              </div>
              <div class="card-body">
                    <form method="post" enctype="multipart/form-data">
                    <div><?php echo $msg ?></div>
                    <div class="mb-3">
                        <label for="exampleInputName" class="form-label">Category name :</label>
                        <input type="text" class="form-control" id="exampleInputName" aria-describedby="InputName" name="name">
                    </div>
                    <p>Image:</p>
                    <div class="input-group mb-3">
                        <input type="file" class="form-control" id="inputGroupFile01" name="image">
                    </div>                    
                    <br>
                    <div class="d-grid gap-2 col-4 mx-auto ">
                        <button type="submit" class="btn btn-warning fw-semibold" name="submit" >Submit</button>
                        
                    </div>
                    </form>
              </div>
            </div>
          </div>
        </div>
        <br><br><br><br><br><br>
        <h2 class="text-center">Category</h2><br>
 <?php 
 $result =Category::SellectAllCategorys($conn);
 echo "<div class='row row-cols-1 row-cols-md-3 g-4 mx-auto ms-5 me-5'> ";

 while($row=mysqli_fetch_assoc($result)){
    echo "<div class='col'>
    <div class='card'>
      <img src='images_Upload/$row[file]' class='card-img-top' alt='...' height='200px' width='345px'>
      <div class='card-body'>
        <h1 class='card-title'>$row[name]</h1>
      </div>
      
      <br>
    </div>
  </div>";
 }
 
 echo "</div> ";
 ?>       
  <br><br>

                      <div class="d-grid gap-2 col-4 mx-auto ">
                        <button type="submit" class="btn btn-danger fw-semibold" name="submit" onclick="window.open('updat_delet_category.php')">Updat</button>
                      </div>
                      <br><br>
</div>
  </body>
</html>
