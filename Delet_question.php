<?php 
include "connection.php";
include "question.php";
include "professor.php";
include "etudiant.php";
include "exam.php";
$db2=new Connection_db('login');
$conn=$db2->conn;


    if($_SERVER['REQUEST_METHOD']=='GET'){
        $id=$_GET['id'];
       Questions::deleteQuestion($conn,$id);
       header("Location:CRUD_question_prof.php");
    }


?>