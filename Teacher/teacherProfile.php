<?php
if(!isset($_SESSION)){ 
  session_start(); 
}
define('TITLE', 'Teacher Profile');
define('PAGE', 'profile');
include('./teacherInclude/header.php'); 
include_once('../dbConnection.php');

 if(isset($_SESSION['is_teacher_login'])){
  $teachEmail = $_SESSION['teacherLogEmail'];
 } else {
  echo "<script> location.href='../index.php'; </script>";
 }

 $sql = "SELECT * FROM teacher WHERE teach_email='$teachEmail'";
 $result = $conn->query($sql);
 if($result->num_rows == 1){
 $row = $result->fetch_assoc();
 $teachId = $row["teach_id"];
 $teachFName = $row["teach_fname"]; 
 $teachLName = $row["teach_lname"]; 
 $teachTp = $row["teach_phone"];
 $teachSub = $row["teach_sub"];
 $teachImg = $row["teach_img"];

}

 if(isset($_REQUEST['updateTeachNameBtn'])){
  if(($_REQUEST['teachFName'] == "")){
   // msg displayed if required field missing
   $passmsg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2" role="alert"> Fill All Fileds </div>';
  } else {
   $teachFName = $_REQUEST["teachFName"];
   $teachLName = $_REQUEST["teachLName"];
   $teachSub = $_REQUEST["teachSub"];
   $teachTp = $_REQUEST["teachTp"];
   $teach_image = $_FILES['teachImg']['name']; 
   $teach_image_temp = $_FILES['teachImg']['tmp_name'];
   $img_folder = '../image/teach'. $teach_image; 
   move_uploaded_file($teach_image_temp, $img_folder);
   $sql = "UPDATE teacher SET teach_fname = '$teachFName',teach_lname = '$teachLName', teach_sub = '$teachSub',teach_phone = '$teachTp',  teach_img = '$img_folder' WHERE teach_email = '$teachEmail'";
   if($conn->query($sql) == TRUE){
   // below msg display on form submit success
   $passmsg = '<div class="alert alert-success col-sm-6 ml-5 mt-2" role="alert"> Updated Successfully </div>';
   } else {
   // below msg display on form submit failed
   $passmsg = '<div class="alert alert-danger col-sm-6 ml-5 mt-2" role="alert"> Unable to Update </div>';
      }
    }
 }

?>

<div class="col-sm-6 mt-5">
  <form class="mx-5" method="POST" enctype="multipart/form-data">


  
  <div class="form-group"><b>
      <label for="teachId">Teacher ID</label>
      <input type="text" class="form-control" id="teachId" name="teachId" value=" <?php if(isset($teachId)) {echo $teachId;} ?>" readonly>
    </div>
    <div class="form-group">
      <label for="teachEmail">Email</label>
      <input type="email" class="form-control" id="teachEmail" value=" <?php echo $teachEmail ?>" readonly>
    </div>
    <div class="form-group">
      <label for="teachFName">First Name</label>
      <input type="text" class="form-control" id="teachFName" name="teachFName" value=" <?php if(isset($teachFName)) {echo $teachFName;} ?>">
    </div>
    <div class="form-group">
      <label for="teachLName">Last Name</label>
      <input type="text" class="form-control" id="teachLName" name="teachLName" value=" <?php if(isset($teachLName)) {echo $teachLName;} ?>">
    </div>
    <div class="form-group">
      <!-- Student doesnt mean school student it also means learner -->
      <label for="teachSub">Course</label>
      <input type="text" class="form-control" id="teachSub" name="teachSub" value=" <?php if(isset($teachSub)) {echo $teachSub;} ?>">
    </div>
    <div class="form-group">
      <!-- Student doesnt mean school student it also means learner -->
      <label for="teachTp">Phone Number</label>
      <input type="text" class="form-control" id="teachTp" name="teachTp" value=" <?php if(isset($teachTp)) {echo $teachTp;} ?>">
    </div>
    
    <div class="form-group">
      <label for="teachImg">Upload Image</label>
      <input type="file" class="form-control-file" id="teachImg" name="teachImg">
    </div>
    <button type="submit" class="btn btn-primary" name="updateTeachNameBtn">Update</button>
    <?php if(isset($passmsg)) {echo $passmsg; } ?>
  </form>
 </div>
   </div>

 </div> <!-- Close Row Div from header file -->

 <?php
include('./teacherInclude/footer.php'); 
?>