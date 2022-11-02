<?php
if(!isset($_SESSION)){ 
  session_start(); 
}
define('TITLE', 'Model Papers');
define('PAGE', 'modelpaper');
include('./teacherInclude/header.php'); 
include_once('../dbConnection.php');

if(isset($_SESSION['is_teacher_login'])){
     $teacherEmail = $_SESSION['teacherLogEmail'];
 } else {
  echo "<script> location.href='../index.php'; </script>";
 }
 $sql = "SELECT * FROM teacher WHERE teach_email='$teacherEmail'";
 $result = $conn->query($sql);
 if($result->num_rows == 1){
 $row = $result->fetch_assoc();
 $teachId = $row["teach_id"];
 
 }

 if(isset($_REQUEST['uploadmodelpaper'])){
  // Checking for Empty Fields
  if(($_REQUEST['p_name'] == "") || ($_REQUEST['p_desc'] == "")){
   // msg displayed if required field missing
   $msg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2" role="alert"> Fill All Fileds </div>';
  } else {
   // Assigning User Values to Variable
   $teach_id = $_REQUEST['teach_id'];
   $p_name = $_REQUEST['p_name'];
   $p_desc = $_REQUEST['p_desc'];
   $p_link = $_FILES['p_link']['name']; 
   $p_link_temp = $_FILES['p_link']['tmp_name'];
   $link_folder = '../papers/'.$p_link; 
   move_uploaded_file($p_link_temp, $link_folder);
    $sql = "INSERT INTO modelpapers (teach_id, p_name, p_desc, p_link) VALUES ('$teach_id','$p_name', '$p_desc','$link_folder')";
    if($conn->query($sql) == TRUE){
     // below msg display on form submit success
     $msg = '<div class="alert alert-success col-sm-6 ml-5 mt-2" role="alert"> paper Added Successfully </div>';
    } else {
     // below msg display on form submit failed
     $msg = '<div class="alert alert-danger col-sm-6 ml-5 mt-2" role="alert"> Unable to Add paper </div>';
    }
  }
  }
?>

<div class="col-sm-6 mt-5">
  <form class="mx-5" method="POST" enctype="multipart/form-data">
<b>
  <a class="navbar-brand ">Upload Model Papers</a>
  <div class="form-group">
      <label for="lesson_name">Teacher ID</label>
      <input type="text" class="form-control" id="teach_id" name="teach_id" value=" <?php if(isset($teachId)) {echo $teachId;} ?>" readonly>
    </div>
    <div class="form-group">
      <!-- Student doesnt mean school student it also means learner -->
      <label for="teachSub">Course Name</label>
      <input type="text" class="form-control" id="p_name" name="p_name" >
    </div>
    <div class="form-group">
      <!-- Student doesnt mean school student it also means learner -->
      <label for="teachSub">Description (Year)</label>
      <input type="text" class="form-control" id="p_desc" name="p_desc">
    </div>
    <div class="form-group">
      <label for="teachImg">Choose a file</label>
      <input type="file" class="form-control-file" id="p_link" name="p_link">
    </div>
    <button type="submit" class="btn btn-primary" name="uploadmodelpaper">Upload</button>
    <?php if(isset($msg)) {echo $msg; } ?>
  </form>
 </div>

 </div> <!-- Close Row Div from header file -->

 <?php
include('./teacherInclude/footer.php'); 
?>