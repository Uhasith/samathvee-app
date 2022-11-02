<?php 
if(!isset($_SESSION)){ 
  session_start(); 
}
define('TITLE', 'Edit Course');
define('PAGE', 'courses');
include('./adminInclude/header.php'); 
include('../dbConnection.php');

 if(isset($_SESSION['is_admin_login'])){
  $adminEmail = $_SESSION['adminLogEmail'];
 } 
 else {
  echo "<script> location.href='../index.php'; </script>";
 }
 // Update
 if(isset($_REQUEST['requpdate'])){
  // Checking for Empty Fields
  if(($_REQUEST['course_id'] == "") || ($_REQUEST['course_name'] == "") || ($_REQUEST['course_desc'] == "") || ($_REQUEST['course_lecturer'] == "") ||  ($_REQUEST['course_price'] == "") || ($_REQUEST['course_original_price'] == "")){
   // msg displayed if required field missing
   $msg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2" role="alert"> Fill All Fileds </div>';
  } else {
    // Assigning User Values to Variable
    $cid = $_REQUEST['course_id'];
    $cname = $_REQUEST['course_name'];
    $cdesc = $_REQUEST['course_desc'];
    $clecturer = $_REQUEST['course_lecturer'];
    $cimg = '../image/courseimg/'. $_FILES['course_img']['name'];
    $cprice = $_REQUEST['course_price'];
    $coriginalprice = $_REQUEST['course_original_price'];
    
   $sql = "UPDATE course SET course_id = '$cid', 
                             course_name = '$cname',
                             course_desc = '$cdesc', 
                             course_lecturer='$clecturer',
                             course_img='$cimg',
                             course_price='$cprice', 
                             course_original_price='$coriginalprice' 
                         WHERE course_id = '$cid'";

    if($conn->query($sql) == TRUE){
     // below msg display on form submit success
     $msg = '<div class="alert alert-success col-sm-6 ml-5 mt-2" role="alert"> Updated Successfully </div>';
    } else {
     // below msg display on form submit failed
     $msg = '<div class="alert alert-danger col-sm-6 ml-5 mt-2" role="alert"> Unable to Update </div>';
    }
  }
  }
 ?>
<div class="col-sm-6 mt-5  mx-3 jumbotron">
  <h3 class="text-center">Update Subject Details</h3>
  <?php
 if(isset($_REQUEST['view'])){
  $sql = "SELECT * FROM course WHERE course_id = {$_REQUEST['id']}";
 $result = $conn->query($sql);
 $row = $result->fetch_assoc();
 }
 ?>
  <form action="" method="POST" enctype="multipart/form-data">
    <div class="form-group">
      <label for="course_id">SubjectID</label>
      <input type="text" class="form-control" id="course_id" name="course_id" value="<?php if(isset($row['course_id'])) {echo $row['course_id']; }?>" readonly>
    </div>
    <div class="form-group">
      <label for="course_name">Subject Name</label>
      <input type="text" class="form-control" id="course_name" name="course_name" value="<?php if(isset($row['course_name'])) {echo $row['course_name']; }?>">
    </div>


    <div class="form-group">
      <label for="course_desc">Subject Description</label>
      <textarea class="form-control" id="course_desc" name="course_desc" row=2><?php if(isset($row['course_desc'])) {echo $row['course_desc']; }?></textarea>
    </div>
    <div class="form-group">
      <label for="course_lecturer">Lecturer Name</label>
      <input type="text" class="form-control" id="course_lecturer" name="course_lecturer" value="<?php if(isset($row['course_lecturer'])) {echo $row['course_lecturer']; }?>">
    </div>

    <div class="form-group">
      <label for="course_img">Subject Image</label><br>
      <img src="<?php if(isset($row['course_img'])) {echo $row['course_img']; }?>" alt="courseimage" class="img-thumbnail" height="300px" width="300px">     
      <input type="file" class="form-control-file" id="course_img" name="course_img">
    </div>

    <div class="form-group">
      <label for="course_price">Subject Selling Price</label>
      <input type="text" class="form-control" id="course_price" name="course_price" onkeypress="isInputNumber(event)" value="<?php if(isset($row['course_price'])) {echo $row['course_price']; }?>">
    </div>

    <div class="form-group">
      <label for="course_original_price">Subject Original Price</label>
      <input type="text" class="form-control" id="course_original_price" name="course_original_price" onkeypress="isInputNumber(event)" value="<?php if(isset($row['course_original_price'])) {echo $row['course_original_price']; }?>">
    </div>
    

    <div class="text-center">
      <button type="submit" class="btn btn-danger" id="requpdate" name="requpdate">Update</button>
      <a href="courses.php" class="btn btn-secondary">Close</a>
    </div>
    <?php if(isset($msg)) {echo $msg; } ?>
  </form>
</div>
</div>  <!-- div Row close from header -->
</div>  <!-- div Conatiner-fluid close from header -->

<?php
include('./adminInclude/footer.php'); 
?>