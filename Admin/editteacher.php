<?php 
if(!isset($_SESSION)){ 
  session_start(); 
}
define('TITLE', 'Edit Teacher');
define('PAGE', 'teachers');
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
  if(($_REQUEST['teach_id'] == "") || ($_REQUEST['teach_fname'] == "") ||
     ($_REQUEST['teach_lname'] == "") || ($_REQUEST['teach_email'] == "") || 
     ($_REQUEST['teach_pass'] == "") || ($_REQUEST['teach_sub'] == "") || ($_REQUEST['teach_phone'] == "")){
   // msg displayed if required field missing
   $msg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2" role="alert"> Fill All Fileds </div>';
  } else {
    // Assigning User Values to Variable
    $tid = $_REQUEST['teach_id'];
    $tfname = $_REQUEST['teach_fname'];
    $tlname = $_REQUEST['teach_lname'];
    $temail = $_REQUEST['teach_email'];
    $tpass = $_REQUEST['teach_pass'];
    $tsub = $_REQUEST['teach_sub'];
    $teachTp = $_REQUEST["teach_phone"];
    
   $sql = "UPDATE teacher SET teach_id = '$tid', 
                              teach_fname = '$tfname', 
                              teach_lname = '$tlname', 
                              teach_email = '$temail', 
                              teach_pass='$tpass', 
                              teach_sub='$tsub',
                              teach_phone = '$teachTp'
                           WHERE teach_id = '$tid'";
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
  <h3 class="text-center">Update Teacher Details</h3>
  <?php
 if(isset($_REQUEST['view'])){
  $sql = "SELECT * FROM teacher WHERE teach_id = {$_REQUEST['id']}";
 $result = $conn->query($sql);
 $row = $result->fetch_assoc();
 }
 ?>
  <form action="" method="POST" enctype="multipart/form-data">
    <div class="form-group">
      <label for="teach_id">ID</label>
      <input type="text" class="form-control" id="teach_id" name="teach_id" value="<?php if(isset($row['teach_id'])) {echo $row['teach_id']; }?>"readonly>
    </div>
    <div class="form-group">
      <label for="teach_fname">First Name</label>
      <input type="text" class="form-control" id="teach_nfame" name="teach_fname" value="<?php if(isset($row['teach_fname'])) {echo $row['teach_fname']; }?>">
    </div>
    <div class="form-group">
      <label for="teach_lname">Last Name</label>
      <input type="text" class="form-control" id="teach_lname" name="teach_lname" value="<?php if(isset($row['teach_lname'])) {echo $row['teach_lname']; }?>">
    </div>

    <div class="form-group">
      <label for="teach_email">Email</label>
      <input type="text" class="form-control" id="teach_email" name="teach_email" value="<?php if(isset($row['teach_email'])) {echo $row['teach_email']; }?>">
    </div>

    <div class="form-group">
      <label for="teach_pass">Password</label>
      <input type="text" class="form-control" id="teach_pass" name="teach_pass" value="<?php if(isset($row['teach_pass'])) {echo $row['teach_pass']; }?>">
    </div>
    <div class="form-group">
    
      <label for="teach_sub">Subject</label>
      <input type="text" class="form-control" id="teach_sub" name="teach_sub" value=" <?php if(isset($row['teach_sub'])) {echo $row['teach_sub']; } ?>">
    </div>
    <div class="form-group">
      <label for="teach_phone">Phone Number</label>
      <input type="text" class="form-control" id="teach_phone" name="teach_phone" value=" <?php if(isset($row['teach_phone'])) {echo $row['teach_phone'];} ?>">
    </div>
  
    <div class="text-center">
      <button type="submit" class="btn btn-danger" id="requpdate" name="requpdate">Update</button>
      <a href="teachers.php" class="btn btn-secondary">Close</a>
    </div>
    <?php if(isset($msg)) {echo $msg; } ?>
  </form>
</div>
</div>  <!-- div Row close from header -->
</div>  <!-- div Conatiner-fluid close from header -->

<?php
include('./adminInclude/footer.php'); 
?>