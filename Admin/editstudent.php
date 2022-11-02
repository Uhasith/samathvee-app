<?php 
if(!isset($_SESSION)){ 
  session_start(); 
}
define('TITLE', 'Edit Student');
define('PAGE', 'students');
include('./adminInclude/header.php'); 
include('../dbConnection.php');

 if(isset($_SESSION['is_admin_login'])){
  $adminEmail = $_SESSION['adminLogEmail'];
 } else {
  echo "<script> location.href='../index.php'; </script>";
 }
 // Update
 if(isset($_REQUEST['requpdate'])){
  // Checking for Empty Fields
  if(($_REQUEST['stu_id'] == "") || ($_REQUEST['stu_fname'] == "") ||
    ($_REQUEST['stu_lname'] == "")  || ($_REQUEST['stu_phone'] == "")||($_REQUEST['stu_address'] == "")|| 
     ($_REQUEST['stu_email'] == "") || ($_REQUEST['stu_pass'] == "") || ($_REQUEST['stu_detail'] == "")){
   // msg displayed if required field missing
   $msg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2" role="alert"> Fill All Fileds </div>';
  } else {
    // Assigning User Values to Variable
    $sid = $_REQUEST['stu_id'];
    $sfname = $_REQUEST['stu_fname'];
    $slname = $_REQUEST['stu_lname'];
    $stuPhone = $_REQUEST["stu_phone"];
    $stuAdd = $_REQUEST["stu_address"]; 
    $semail = $_REQUEST['stu_email'];
    $spass = $_REQUEST['stu_pass'];
    $socc = $_REQUEST['stu_detail'];
    
   $sql = "UPDATE student 
           SET stu_id = '$sid', 
               stu_fname = '$sfname',
               stu_lname = '$slname', 
               stu_phone = '$stuPhone',
               stu_address = '$stuAdd', 
               stu_email = '$semail', 
               stu_pass='$spass', 
               stu_detail='$socc' 
           WHERE stu_id = '$sid'";

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
  <h3 class="text-center">Update Student Details</h3>
  <?php
 if(isset($_REQUEST['view'])){
  $sql = "SELECT * FROM student WHERE stu_id = {$_REQUEST['id']}";
 $result = $conn->query($sql);
 $row = $result->fetch_assoc();
 }
 ?>
  <form action="" method="POST" enctype="multipart/form-data">
    <div class="form-group">
      <label for="stu_id">ID</label>
      <input type="text" class="form-control" id="stu_id" name="stu_id" value="<?php if(isset($row['stu_id'])) {echo $row['stu_id']; }?>"readonly>
    </div>
    <div class="form-group">
      <label for="stu_fname">First Name</label>
      <input type="text" class="form-control" id="stu_fname" name="stu_fname" value="<?php if(isset($row['stu_fname'])) {echo $row['stu_fname']; }?>">
    </div>
    <div class="form-group">
      <label for="stu_lname">Last Name</label>
      <input type="text" class="form-control" id="stu_lname" name="stu_lname" value="<?php if(isset($row['stu_lname'])) {echo $row['stu_lname']; }?>">
    </div>
    <div class="form-group">
      <label for="stu_phone">Student Phone NO</label>
      <input type="text" class="form-control" id="stu_phone" name="stu_phone" value=" <?php if(isset($row['stu_phone'])) {echo $row['stu_phone'];} ?>">
    </div>
    <div class="form-group">
      <label for="stu_address">Student Address</label>
      <input type="text" class="form-control" id="stu_address" name="stu_address" value=" <?php if(isset($row['stu_address'])) {echo $row['stu_address'];} ?>">
    </div>
    <div class="form-group">
      <label for="stu_email">Email</label>
      <input type="text" class="form-control" id="stu_email" name="stu_email" value="<?php if(isset($row['stu_email'])) {echo $row['stu_email']; }?>"readonly>
    </div>
    <div class="form-group">
      <label for="stu_pass">Password</label>
      <input type="text" class="form-control" id="stu_pass" name="stu_pass" value="<?php if(isset($row['stu_pass'])) {echo $row['stu_pass']; }?>">
    </div>
    <div class="form-group">
      <label for="stu_detail">Detail</label>
      <input type="text" class="form-control" id="stu_detail" name="stu_detail" value="<?php if(isset($row['stu_detail'])) {echo $row['stu_detail']; }?>">
    </div>
    <div class="text-center">
      <button type="submit" class="btn btn-danger" id="requpdate" name="requpdate">Update</button>
      <a href="students.php" class="btn btn-secondary">Close</a>
    </div>
    <?php if(isset($msg)) {echo $msg; } ?>
  </form>
</div>
</div>  <!-- div Row close from header -->
</div>  <!-- div Conatiner-fluid close from header -->

<?php
include('./adminInclude/footer.php'); 
?>