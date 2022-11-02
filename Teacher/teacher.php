<?php 
include('../dbConnection.php');
if(!isset($_SESSION)){ 
  session_start(); 
}
// setting header type to json, We'll be outputting a Json data
header('Content-type: application/json');

 // teacher Login Verification
 if(!isset($_SESSION['is_teacher_login'])){
   if(isset($_POST['checkLogemail']) && isset($_POST['teacherLogEmail']) && isset($_POST['teacherLogPass'])){
     $teacherLogEmail = $_POST['teacherLogEmail'];
     $teacherLogPass = $_POST['teacherLogPass'];
     $sql = "SELECT teach_email, teach_pass FROM teacher WHERE teach_email='".$teacherLogEmail."' AND teach_pass='".$teacherLogPass."'";
     $result = $conn->query($sql);
     $row = $result->num_rows;
     
     if($row === 1){
       $_SESSION['is_teacher_login'] = true;
       $_SESSION['teacherLogEmail'] = $teacherLogEmail;
       echo json_encode($row);
     } else if($row === 0) {
       echo json_encode($row);
     }
   }
 }

?>