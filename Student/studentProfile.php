<?php
if(!isset($_SESSION)){ 
  session_start(); 
}
define('TITLE', 'Student Profile');
define('PAGE', 'profile');
include('./stuInclude/header.php'); 
include_once('../dbConnection.php');

 if(isset($_SESSION['is_login'])){
  $stuEmail = $_SESSION['stuLogEmail'];
 } else {
  echo "<script> location.href='../index.php'; </script>";
 }

 $sql = "SELECT * FROM student WHERE stu_email='$stuEmail'";
 $result = $conn->query($sql);
 if($result->num_rows == 1){
 $row = $result->fetch_assoc();
 $stuId = $row["stu_id"];
 $stuFName = $row["stu_fname"];
 $stuLName = $row["stu_lname"];
 $stuPhone = $row["stu_phone"];
 $stuAdd = $row["stu_address"];     
 $stu_detail = $row["stu_detail"];
 $stuImg = $row["stu_img"];

}

 if(isset($_REQUEST['updateStuNameBtn'])){
  if(($_REQUEST['stuFName'] == "")){
   // msg displayed if required field missing
   $passmsg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2" role="alert"> Fill All Fileds </div>';
  } else {
   $stuFName = $_REQUEST["stuFName"];
   $stuLName = $_REQUEST["stuLName"];
   $stuPhone = $_REQUEST["stuPhone"];
   $stuAdd = $_REQUEST["stuAdd"];
   $stu_detail = $_REQUEST["stu_detail"];
   $stu_image = $_FILES['stuImg']['name']; 
   $stu_image_temp = $_FILES['stuImg']['tmp_name'];
   $img_folder = '../image/stu/'. $stu_image; 
   move_uploaded_file($stu_image_temp, $img_folder);
   $sql = "UPDATE student SET stu_fname = '$stuFName',stu_lname = '$stuLName',stu_phone = '$stuPhone',stu_address = '$stuAdd',stu_detail = '$stu_detail', stu_img = '$img_folder' WHERE stu_email = '$stuEmail'";
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
    <div class="form-group">
      <label for="stuId">Student ID</label>
      <input type="text" class="form-control" id="stuId" name="stuId" value=" <?php if(isset($stuId)) {echo $stuId;} ?>" readonly>
    </div>
    <div class="form-group">
      <label for="stuEmail">Email</label>
      <input type="email" class="form-control" id="stuEmail" value=" <?php echo $stuEmail ?>" readonly>
    </div>
    <div class="form-group">
      <label for="stuFName">First Name</label>
      <input type="text" class="form-control" id="stuFName" name="stuFName" value=" <?php if(isset($stuFName)) {echo $stuFName;} ?>">
    </div>
    <div class="form-group">
      <label for="stuLName">Last Name</label>
      <input type="text" class="form-control" id="stuLName" name="stuLName" value=" <?php if(isset($stuLName)) {echo $stuLName;} ?>">
    </div>
    <div class="form-group">
      <label for="stuLName">Student Phone NO</label>
      <input type="text" class="form-control" id="stuPhone" name="stuPhone" value=" <?php if(isset($stuPhone)) {echo $stuPhone;} ?>">
    </div>
    <div class="form-group">
      <label for="stuLName">Student Address</label>
      <input type="text" class="form-control" id="stuAdd" name="stuAdd" value=" <?php if(isset($stuAdd)) {echo $stuAdd;} ?>">
    </div>
    <div class="form-group">
      <!-- Student doesnt mean school student it also means learner -->
      <label for="stu_detail">Student Detail</label>
      <input type="text" class="form-control" id="stu_detail" name="stu_detail" value=" <?php if(isset($stu_detail)) {echo $stu_detail;} ?>">
    </div>
    <div class="form-group">
      <label for="stuImg">Upload Image</label>
      <input type="file" class="form-control-file" id="stuImg" name="stuImg">
    </div>
    <button type="submit" class="btn btn-primary" name="updateStuNameBtn">Update</button>
    <?php if(isset($passmsg)) {echo $passmsg; } ?>
  </form>
 </div>

 </div> <!-- Close Row Div from header file -->

 <?php
include('./stuInclude/footer.php'); 
?>