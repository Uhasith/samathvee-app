<?php
if(!isset($_SESSION)){ 
  session_start(); 
}
define('TITLE', 'Release Marks');
define('PAGE', 'releaseMarks');
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
 if(isset($_REQUEST['updatemarksBtn'])){
  // Checking for Empty Fields
  if(($_REQUEST['marks_subject'] == "") || ($_REQUEST['marks_desc'] == "")){
   // msg displayed if required field missing
   $msg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2" role="alert"> Fill All Fileds </div>';
  } else {
   // Assigning User Values to Variable
   $teach_id = $_REQUEST['teach_id'];
   $marks_subject = $_REQUEST['marks_subject'];
   $marks_desc = $_REQUEST['marks_desc'];
   $marks_link = $_FILES['marks_link']['name']; 
   $marks_link_temp = $_FILES['marks_link']['tmp_name'];
   $link_folder = '../marks/'.$marks_link; 
   move_uploaded_file($marks_link_temp, $link_folder);
    $sql = "INSERT INTO marks (teach_id,marks_subject, marks_desc, marks_link) VALUES ('$teach_id','$marks_subject', '$marks_desc','$link_folder')";
    if($conn->query($sql) == TRUE){
     // below msg display on form submit success
     $msg = '<div class="alert alert-success col-sm-6 ml-5 mt-2" role="alert"> Marks Added Successfully </div>';
    } else {
     // below msg display on form submit failed
     $msg = '<div class="alert alert-danger col-sm-6 ml-5 mt-2" role="alert"> Unable to Add Marks </div>';
    }
  }
  }
   ?>


<div class="col-sm-6 mt-5">
  <form class="mx-5" method="POST" enctype="multipart/form-data">
<b>
  <a class="navbar-brand ">Release Marks</a>
  <div class="form-group">
      <label for="lesson_name">Teacher ID</label>
      <input type="text" class="form-control" id="teach_id" name="teach_id" value=" <?php if(isset($teachId)) {echo $teachId;} ?>" readonly>
    </div>
  <div class="form-group">
      <label for="lesson_name">Subject</label>
      <input type="text" class="form-control" id="marks_subject" name="marks_subject">
    </div>
    <div class="form-group">
      <label for="lesson_desc">Marks Description</label>
      <textarea class="form-control" id="marks_desc" name="marks_desc" row=2></textarea>
    </div>
    <div class="form-group">
      <label for="lesson_link">Mark sheet Link</label>
      <input type="file" class="form-control-file" id="marks_link" name="marks_link">
    </div>
    <button type="submit" class="btn btn-primary" id="updatemarksBtn" name="updatemarksBtn">Release Marks</button>
    <?php if(isset($msg)) {echo $msg; } ?>
  </form>
 </div>

 </div> <!-- Close Row Div from header file -->






<?php
include('./teacherInclude/footer.php'); 
?>