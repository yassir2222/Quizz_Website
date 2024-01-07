<?php  
include "header_professor.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">


<title>Professor </title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
<style type="text/css">
    	body{
margin-top:20px;
background-color: #f7f7ff;
}
.radius-10 {
    border-radius: 10px !important;
}

.border-info {
    border-left: 5px solid  #0dcaf0 !important;
}
.border-danger {
    border-left: 5px solid  #fd3550 !important;
}
.border-success {
    border-left: 5px solid  #15ca20 !important;
}
.border-warning {
    border-left: 5px solid  #ffc107 !important;
}


.card {
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 0px solid rgba(0, 0, 0, 0);
    border-radius: .25rem;
    margin-bottom: 1.5rem;
    box-shadow: 0 2px 6px 0 rgb(218 218 253 / 65%), 0 2px 6px 0 rgb(206 206 238 / 54%);
}
.bg-gradient-scooter {
    background: #17ead9;
    background: -webkit-linear-gradient( 
45deg
 , #17ead9, #6078ea)!important;
    background: linear-gradient( 
45deg
 , #17ead9, #6078ea)!important;
}
.widgets-icons-2 {
    width: 56px;
    height: 56px;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #ededed;
    font-size: 27px;
    border-radius: 10px;
}
.rounded-circle {
    border-radius: 50%!important;
}
.text-white {
    color: #fff!important;
}
.ms-auto {
    margin-left: auto!important;
}
.bg-gradient-bloody {
    background: #f54ea2;
    background: -webkit-linear-gradient( 
45deg
 , #f54ea2, #ff7676)!important;
    background: linear-gradient( 
45deg
 , #f54ea2, #ff7676)!important;
}

.bg-gradient-ohhappiness {
    background: #00b09b;
    background: -webkit-linear-gradient( 
45deg
 , #00b09b, #96c93d)!important;
    background: linear-gradient( 
45deg
 , #00b09b, #96c93d)!important;
}

.bg-gradient-blooker {
    background: #ffdf40;
    background: -webkit-linear-gradient( 
45deg
 , #ffdf40, #ff8359)!important;
    background: linear-gradient( 
45deg
 , #ffdf40, #ff8359)!important;
}
    </style>
</head>
<body>
    <br><br><br>
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
<div class="container">
<div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">

<div class="col">
<div class="card radius-10 border-start border-0 border-3 border-info" onclick="window.open('professor_profile.php')">
<div class="card-body">
<div class="d-flex align-items-center">
<div>
<p class="mb-0 text-secondary">Your Profile</p>
<h4 class="my-1 text-info"><?php  echo $_SESSION['Prof_Name']?></h4>
<p class="mb-0 font-13">View Detaille</p>
</div>
<div class="widgets-icons-2 rounded-circle bg-gradient-scooter text-white ms-auto"><i class="uil uil-user"></i></i>
</div>
</div>
</div>
</div>
</div>

<div class="col">
<div class="card radius-10 border-start border-0 border-3 border-danger" onclick="window.open('CRUD_question_prof.php')">
<div class="card-body">
<div class="d-flex align-items-center">
<div>
<p class="mb-0 text-secondary">if you need :</p>
<h4 class="my-1 text-danger">UPDATE Question</h4>
<p class="mb-0 font-13">View details</p>
</div>
<div class="widgets-icons-2 rounded-circle bg-gradient-bloody text-white ms-auto"><i class="uil uil-wrench"></i>
</div>
</div>
</div>
</div>
</div>

<div class="col">
<div class="card radius-10 border-start border-0 border-3 border-success" onclick="window.open('exam_category.php')">
<div class="card-body">
<div class="d-flex align-items-center">
<div>
<p class="mb-0 text-secondary">Start :</p>
<h4 class="my-1 text-success">New Exam</h4>
<p class="mb-0 font-13">lets go</p>
</div>
<div class="widgets-icons-2 rounded-circle bg-gradient-ohhappiness text-white ms-auto"><i class="uil uil-plus"></i>
</div>
</div>
</div>
</div>
</div>

<div class="col">
<div class="card radius-10 border-start border-0 border-3 border-warning" onclick="window.open('student_result.php')">
<div class="card-body">
<div class="d-flex align-items-center">
<div>
<p class="mb-0 text-secondary">Your students</p>
<h4 class="my-1 text-warning">Exam Results</h4>
<p class="mb-0 font-13">View details</p>
</div>
<div class="widgets-icons-2 rounded-circle bg-gradient-blooker text-white ms-auto"><i class="fa fa-users"></i>
</div>
</div>
</div>
</div>
</div>

<div class="col">
<div class="card radius-10 border-start border-0 border-3 border-danger" onclick="window.open('Creat_category.php')">
<div class="card-body">
<div class="d-flex align-items-center">
<div>
<p class="mb-0 text-secondary">Start:</p>
<h4 class="my-1 text-danger">New Category</h4>
<p class="mb-0 font-13">Lets Go</p>
</div>
<div class="widgets-icons-2 rounded-circle bg-gradient-bloody text-white ms-auto"><i class="uil uil-clipboard-notes"></i>
</div>
</div>
</div>
</div>
</div>

<div class="col">
<div class="card radius-10 border-start border-0 border-3 border-info" >
<div class="card-body">
<div class="d-flex align-items-center">
<div>
<p class="mb-0 text-secondary">You Need To:</p>
<h4 class="my-1 text-info">Logout</h4>
<p class="mb-0 font-13">Goode By</p>
</div>
<div class="widgets-icons-2 rounded-circle bg-gradient-scooter text-white ms-auto"><i class="uil uil-corner-up-right-alt"></i>
</div>
</div>
</div>
</div>
</div>

</div>
</div>
<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript">
	
</script>
</body>
</html>