<?php
if(!isset($_SESSION)){ 
  session_start(); 
}
define('TITLE', 'Add Teacher');
define('PAGE', 'teachers');
include('./adminInclude/header.php'); 
include('../dbConnection.php');

 if(isset($_SESSION['is_admin_login'])){
  $adminEmail = $_SESSION['adminLogEmail'];
 } else {
  echo "<script> location.href='../index.php'; </script>";
 }
 if(isset($_REQUEST['newTeachSubmitBtn'])){
  // Checking for Empty Fields
  if(($_REQUEST['teach_fname'] == "") || ($_REQUEST['teach_lname'] == "") || ($_REQUEST['teach_email'] == "") || ($_REQUEST['teach_pass'] == "") || ($_REQUEST['teach_sub'] == "")){
   // msg displayed if required field missing
   $msg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2" role="alert"> Fill All Fileds </div>';
  } else {
   // Assigning User Values to Variable
   $teach_fname = $_REQUEST['teach_fname'];
   $teach_lname = $_REQUEST['teach_lname'];
   $teach_email = $_REQUEST['teach_email'];
   $teach_pass = $_REQUEST['teach_pass'];
   $teach_sub = $_REQUEST['teach_sub'];
   

    $sql = "INSERT INTO teacher (teach_fname,teach_lname, teach_email, teach_pass, teach_sub)
             VALUES ('$teach_fname','$teach_lname', '$teach_email', '$teach_pass', '$teach_sub')";
    if($conn->query($sql) == TRUE){
     // below msg display on form submit success
     $msg = '<div class="alert alert-success col-sm-6 ml-5 mt-2" role="alert"> Teacher Added Successfully </div>';
    } else {
     // below msg display on form submit failed
     $msg = '<div class="alert alert-danger col-sm-6 ml-5 mt-2" role="alert"> Unable to Add Teacher </div>';
    }
  }
  }
 ?>
<div class="col-sm-6 mt-5  mx-3 jumbotron">
  <h3 class="text-center">Add New Teacher</h3>
  <form action="" method="POST" enctype="multipart/form-data">
    <div class="form-group">
      <label for="teach_fname">First Name</label>
      <input type="text" class="form-control" id="teach_fname" name="teach_fname">
    </div>
    <div class="form-group">
      <label for="teach_lname">Last Name</label>
      <input type="text" class="form-control" id="teach_lname" name="teach_lname">
    </div>
    <div class="form-group">
      <label for="teach_email">Email</label>
      <input type="text" class="form-control" id="teach_email" name="teach_email">
    </div>
    <div class="form-group">
      <label for="teach_pass">Password</label>
      <input type="text" class="form-control" id="teach_pass" name="teach_pass">
    </div>
 
    <div class="form-group">
      <label for="teach_sub">Subject</label>
      <input type="text" class="form-control" id="teach_sub" name="teach_sub">
    </div>
    <div class="text-center">
      <button type="submit" class="btn btn-danger" id="newStuSubmitBtn" name="newStuSubmitBtn">Submit</button>
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