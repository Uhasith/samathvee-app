<?php 
include_once('../dbConnection.php');
 if(!isset($_SESSION)){ 
   session_start(); 
 } 
 if(isset($_SESSION['is_teacher_login'])){
  $teachLogEmail = $_SESSION['teacherLogEmail'];
 } 
 // else {
 //  echo "<script> location.href='../index.php'; </script>";
 // }
 if(isset($teachLogEmail)){
  $sql = "SELECT teach_img FROM teacher WHERE teach_email = '$teachLogEmail'";
  $result = $conn->query($sql);
  $row = $result->fetch_assoc();
  $teach_img = $row['teach_img'];
 }
?>

<!DOCTYPE html>
<html lang="en">

<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <meta http-equiv="X-UA-Compatible" content="ie=edge">
 <title>
  <?php echo TITLE ?>
 </title>
 <!-- Bootstrap CSS -->
 <link rel="stylesheet" href="../css/bootstrap.min.css">

 <!-- Font Awesome CSS -->
 <link rel="stylesheet" href="../css/all.min.css">

  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">

 <!-- Custom CSS -->
 <link rel="stylesheet" href="../css/adminstyle.css">

</head>

<body>
 <!-- Top Navbar -->

 <nav class="navbar navbar-dark fixed-top p-0 shadow " style="background-color: #126180;">
  <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="teacherProfile.php">Samathvee <small class="text-white">Teacher Area</small></a> 
  <div class="card-footer">
        <a class="btn btn-primary text-white font-weight-bolder float-right" href="../index.php">Go Back</a>
      </div>
 </nav>
<!-- Side Bar -->

 <div class="container-fluid mb-5" style="margin-top:10px;">
  <div class="row">
   <nav class="col-sm-3 col-md-2 bg-dark sidebar py-5 d-print-none" style="border-radius: 10px;">
    <div class="sidebar-sticky">
     <ul class="nav flex-column">
     <li class="nav-item mb-2">
      <img src="<?php echo $teach_img ?>" alt="teacherimage" class="img-thumbnail rounded">
      </li>

     
    <li class="nav-item">
       <a class="nav-link <?php if(PAGE == 'profile') {echo 'active';} ?>" href="teacherProfile.php">
        <i class="fab fa-accessible-icon"></i>
        Profile
       </a>
      </li>

     <li class="nav-item">
       <a class="nav-link <?php if(PAGE == 'lessons') {echo 'active';} ?>" href="lessons.php">
       <i class="far fa-calendar-check"></i>
        Lessons
       </a>
      </li>

      <li class="nav-item">
       <a class="nav-link <?php if(PAGE == 'modelpaper') {echo 'active';} ?>" href="modelpaper.php">
       <i class="far fa-file-alt"></i>
        Model papers
       </a>
      </li>

      <li class="nav-item">
       <a class="nav-link <?php if(PAGE == 'releaseMarks') {echo 'active';} ?>" href="releaseMarks.php">
       <i class="fas fa-check-double"></i>
        Release Marks
       </a>
      </li>

    
     
     
      <li class="nav-item">
       <a class="nav-link <?php if(PAGE == 'changepass') {echo 'active';} ?>" href="teacherChangePass.php">
        <i class="fas fa-key"></i>
        Change Password
       </a>
      </li>
      <li class="nav-item">
       <a class="nav-link" href="../logout.php">
        <i class="fas fa-sign-out-alt"></i>
        Logout
       </a>
      </li>
     </ul>
    </div>
   </nav>