<?php 
include('./dbConnection.php');
session_start();
if(!isset($_SESSION['stuLogEmail'])) {
 echo "<script> location.href='loginorsignup.php'; </script>";
} 
else { 
 date_default_timezone_set('Asia/colombo');
 $today = date("Y-m-d H:i:s");
 if(isset($_POST['PAYMENT_ID']) && isset($_POST['TXN_AMOUNT']) && isset($_POST['stu_id']) ){
  $stu_id = $_POST['stu_id'];
  $payment_id = $_POST['PAYMENT_ID'];
  $stu_email = $_SESSION['stuLogEmail'];
  $course_id = $_SESSION['course_id'];
  $status = "Success";
  $amount = $_POST['TXN_AMOUNT'];
  $today = $today;
  $sql = "INSERT INTO payment(payment_id,stu_id, stu_email, course_id, status,  amount, payment_date) VALUES ('$payment_id','$stu_id', '$stu_email', '$course_id', '$status', '$amount', '$today')";
   if($conn->query($sql) == TRUE){
    echo "Redirecting to My Profile....";
    echo "<script> setTimeout(() => {
     window.location.href = './Student/myCourse.php';
   }, 1500); </script>";
   };
 } else {
 echo "<b>Transaction status is failure</b>" . "<br/>";
 }
}
?>