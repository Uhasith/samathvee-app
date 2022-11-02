<?php 
if(!isset($_SESSION)){ 
  session_start(); 
}
include_once('../dbConnection.php');


header('Content-type: application/json');

// Checking Email already Registered
if(isset($_POST['stuemail']) && isset($_POST['checkemail'])){
  $stuemail = $_POST['stuemail'];
  $sql = "SELECT stu_email FROM student WHERE stu_email='".$stuemail."'";
  $result = $conn->query($sql);
  $row = $result->num_rows;
  echo json_encode($row);
  }
 
 // Inserting or Adding New Student
 if(isset($_POST['stusignup']) && isset($_POST['stufname']) && isset($_POST['stulname']) && isset($_POST['stuemail']) && isset($_POST['stupass'])){
  $stufname = mysqli_real_escape_string($conn,$_POST['stufname']);
  $stulname = mysqli_real_escape_string($conn,$_POST['stulname']);
  $stuemail = mysqli_real_escape_string($conn,$_POST['stuemail']);
  $stupass = mysqli_real_escape_string($conn,$_POST['stupass']);

  // $verification_code = sha1($stuemail.time());
  // $verfication_URL  = 'http://localhost/Samathvee/Student/verify.php?code=' . $verification_code;

  $sql = "INSERT INTO student(stu_fname,stu_lname,stu_email,stu_pass,is_active) VALUES ('$stufname','$stulname',
   '$stuemail', '$stupass', false)";
 
  if($conn->query($sql) == TRUE){
    echo json_encode("OK");
  } else {
    echo json_encode("Failed");
  }

 // Mail sending code
  // $to	 		  = $stuemail; // Receiver
  // $sender		  = 'samathveeinstitute@gmail.com'; // Email address of the sender
  // $mail_subject = 'Verify Email Address';
  // $email_body   = '<p>Dear ' . $stufname . '</p>';
  // $email_body  .= '<p>Thank you for signing up. There is one more step.
  //                   Click below link to verify your email address in order to activate your account.</p>';
  // $email_body  .= '<p>' . $verfication_URL . '</p>';
  // $email_body  .= '<p>Thank You, <br>SAMATHVEE_INSTITUTE</p>';

  // $header       = "From: {$sender}\r\nContent-Type: text/html;";

  // $send_mail_result = mail($to, $mail_subject, $email_body, $header);
}

  // Student Login Verification
  if(!isset($_SESSION['is_login'])){
    if(isset($_POST['checkLogemail']) && isset($_POST['stuLogEmail']) && isset($_POST['stuLogPass'])){
      $stuLogEmail = $_POST['stuLogEmail'];
      $stuLogPass = $_POST['stuLogPass'];
      $sql = "SELECT stu_email, stu_pass FROM student WHERE stu_email='".$stuLogEmail."' AND stu_pass='".$stuLogPass."' " ;
      $result = $conn->query($sql);
      $row = $result->num_rows;
      
      if($row === 1){
        $_SESSION['is_login'] = true;
        $_SESSION['stuLogEmail'] = $stuLogEmail;
        echo json_encode($row);
      } else if($row === 0) {
        echo json_encode($row);
      }
    }
  }

?>