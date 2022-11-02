<?php
if(!isset($_SESSION)){ 
  session_start(); 
}
define('TITLE', 'My Course');
define('PAGE', 'mycourse');
include('./stuInclude/header.php'); 
include_once('../dbConnection.php');

 if(isset($_SESSION['is_login'])){
  $stuLogEmail = $_SESSION['stuLogEmail'];
 } else {
  echo "<script> location.href='../index.php'; </script>";
 }
?>

 <div class="container mt-1 ml-10">
  <div class="row">
   <div class="jumbotron">
    <h4 class="text-center">All Subject</h4>
    <?php 
   if(isset($stuLogEmail)){
    $sql = "SELECT co.payment_id, c.course_id, c.course_name, c.course_desc, c.course_img, c.course_lecturer, c.course_original_price, c.course_price FROM payment AS co JOIN course AS c ON c.course_id = co.course_id WHERE co.stu_email = '$stuLogEmail'";
    $result = $conn->query($sql);
    if($result->num_rows > 0) {
     while($row = $result->fetch_assoc()){ ?>
      <div class="bg-light mb-3">
        <h5 class="card-header"><?php echo $row['course_name']; ?></h5>
          <div class="row">
          
              <div class="col-sm-3">
                <img src="<?php echo $row['course_img']; ?>" class="card-img-top
                mt-4" alt="pic">
              </div>
              <div class="col-sm-6 mb-3">
                <div class="card-body">
                  <p class="card-title"><?php echo $row['course_desc']; ?></p>
                  
                  <small class="card-text">Instructor: <?php echo $row['course_lecturer']; ?></small><br/>
                  <p class="card-text d-inline">Price: <small><del>Rs <?php echo $row['course_original_price'] ?> </del></small> <span class="font-weight-bolder"><i class="fas fa-RUPEE-sign mr-3"></i> <?php echo $row['course_price']?> <span></p>
  
                  <a href="watchcourse.php?course_id=<?php echo $row['course_id'] ?>" class="btn btn-primary mt-5 float-right">Watch Subjects</a>
                </div>
              </div>
          
          </div>
          
      </div> 
    <?php
     }
    }
   }
  
    ?>
    <hr/>
   </div>
  </div>
 </div>

 </div> <!-- Close Row Div from header file -->
 <?php
include('./stuInclude/footer.php'); 
?>