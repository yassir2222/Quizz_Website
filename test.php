<?php  
include "connection.php";
include "question.php";
include "professor.php";
include "etudiant.php";
include "header.php";
include "exam.php";
include "student_answer.php";
include "exam_historique.php";
include "category.php";
session_start();
$db2=new Connection_db('login');
$conn=$db2->conn;
$correct=0;
$wrong=0;
$row=Questions::selectQuestionById_Exame($conn,14);
$row=mysqli_fetch_assoc($row);

var_dump($row);
echo Category::$MsgError;


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <button type="button" onclick="window.open('CRUD_question_prof.php')"></button>
</body>
</html>

