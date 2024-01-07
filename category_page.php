<?php  
include "connection.php";
include "header.php";
include "category.php";

$db=new Connection_db('login');
$conn=$db->conn;


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <br><br>
   <?php 
    $result =Category::SellectAllCategorys($conn);
    echo "<div class='row row-cols-1 row-cols-md-3 g-4 mx-5' mt-5> ";
   
    while($row=mysqli_fetch_assoc($result)){
       echo "<div class='col'>
       <div class='card'>
         <img src='images_Upload/$row[file]' class='card-img-top' alt='...' height='200px' width='345px'>
         <div class='card-body'>
           <h1 class='card-title'>$row[name]</h1>
           
         </div>
         <div class='d-grid gap-2 col-4 mx-auto'>
                <a class='btn btn-outline-dark fw-semibold' href='student_main.php?category=$row[name]'>Lets Go..</a>
            </div>
         <br>
       </div>
     </div>
     ";
    }
   echo "</div>"
   ?>
   <br><br> 