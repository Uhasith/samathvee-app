<?php
  include('./dbConnection.php');
  
 
?>  
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    
     <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">

    <!-- Font Awesome CSS -->
    <link rel="stylesheet" type="text/css" href="css/all.min.css">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">

    <!-- Student Testimonial Owl Slider CSS -->
    <link rel="stylesheet" type="text/css" href="css/owl.min.css">
    <link rel="stylesheet" type="text/css" href="css/owl.theme.min.css">
    <link rel="stylesheet" type="text/css" href="css/testyslider.css">

    <!-- Custom Style CSS -->
    <link rel="stylesheet" type="text/css" href="./css/style.css" />
    <title>Marks</title>
  </head>
  <body>
     <!-- Start Nagigation -->
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark pl-5 fixed-top">
      <a href="index.php" class="navbar-brand">SAMATHVEE</a>
      <span class="navbar-text">Becom an Expert in Advanced Level</span>
      <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#myMenu">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="myMenu">
        <ul class="navbar-nav pl-5 custom-nav">
          <li class="nav-item custom-nav-item"><a href="index.php" class="nav-link">Home</a></li>
          <li class="nav-item custom-nav-item"><a href="courses.php" class="nav-link">Courses</a></li>
          <li class="nav-item custom-nav-item"><a href="paymentstatus.php" class="nav-link">Payment Status</a></li>
          <?php 
              session_start();   
              if (isset($_SESSION['is_login'])){ 
                echo '<li class="nav-item custom-nav-item"><a href="student/studentProfile.php" class="nav-link">My Profile</a></li>
                <li class="nav-item custom-nav-item"><a href="checkMarks.php" class="nav-link">Check Marks</a></li>
                      <li class="nav-item custom-nav-item"><a href="logout.php" class="nav-link">Logout</a></li>&nbsp;&nbsp;
                       '; 
              } else {
                echo '<li class="nav-item custom-nav-item"><a href="#login" class="nav-link" data-toggle="modal" data-target="#stuLoginModalCenter">Login</a></li>
                 <li class="nav-item custom-nav-item"><a href="#signup" class="nav-link" data-toggle="modal" data-target="#stuRegModalCenter">Signup</a></li>
                 <li class="nav-item custom-nav-item"><a href="Lectures.php" class="nav-link">Lectures</a></li>
                 ';
              }
          ?> 
           </ul>
      </div>
    </nav> <!-- End Navigation --><br><br>

<div class="col-sm-9 mt-5">
    <!--Table-->
    <p class=" bg-dark text-white p-2">List of Marks</p>
    <?php
    
    $sql = "SELECT * FROM marks";
      $result = $conn->query($sql);
      if($result->num_rows > 0){
       echo '<table class="table" align="center">
       <thead>
        <tr>
         <th scope="col">Marks Id</th>
         <th scope="col">Subject</th>
         
         <th scope="col">Description</th>
        </tr>
       </thead>
       <tbody>';
        while($row = $result->fetch_assoc()){
          echo '<tr>';
          echo '<th scope="row">'.$row["marks_id"].'</th>';
          echo '<td>'. $row["marks_subject"].'</td>';
          
          echo '<td>'.$row["marks_desc"].'</td>';
          echo '<td> <a href="/Samathvee/marks/">Download</a>
          </td>
         </tr>';
        }

        echo '</tbody>
        </table>';
      }
     ?>
  </div>
 </div> 


<?php 
    // Footer Include from mainInclude 
    include('./mainInclude/footer.php'); 
    
  ?>  