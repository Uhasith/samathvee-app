<?php
if(!isset($_SESSION)){ 
  session_start(); 
}
define('TITLE', ' Samathvee Course Detail Report');
define('PAGE', 'studetailreport');
include('./adminInclude/header.php'); 
include('../dbConnection.php');

 if(isset($_SESSION['is_admin_login'])){
  $adminEmail = $_SESSION['adminLogEmail'];
 } else {
  echo "<script> location.href='../index.php'; </script>";
 }
?>

<div class="col-sm-9 mt-5  mx-3">
  <form action="" class="mt-3 form-inline d-print-none">
    <div class="form-group mr-3"><b>
      <label for="checkid">Enter Course ID: </label>
      <input type="text" class="form-control " id="checkid" name="checkid" onkeypress="isInputNumber(event)"></b>
    </div>
    <button type="submit" class="btn btn-success">Search</button>
  </form>
  <?php
  $sql = "SELECT course_id FROM payment";
  $result = $conn->query($sql);
  
  while($row = $result->fetch_assoc()){
    if(isset($_REQUEST['checkid']) && $_REQUEST['checkid'] == $row['course_id']){
      $sql = "SELECT * FROM payment WHERE course_id = {$_REQUEST['checkid']}";


      $result = $conn->query($sql);
      $row = $result->fetch_assoc();
      if(($row['course_id']) == $_REQUEST['checkid']){ 
  
        $_SESSION['course_id'] = $row['course_id'];
        $_SESSION['stu_id'] = $row['stu_id'];
        $_SESSION['stu_email'] = $row['stu_email'];
        $_SESSION['payment_id'] = $row['payment_id'];
        $_SESSION['amount'] = $row['amount'];
        $_SESSION['status'] = $row['status'];
        ?>
  
        <h3 class="mt-5 bg-dark text-white p-2">Course ID : <?php if(isset($row['course_id'])) {echo $row['course_id']; } ?></h3>
             
        

  <!--Table view-->
        <?php
        $sql = "SELECT * FROM payment WHERE course_id = {$_REQUEST['checkid']}";
          $result = $conn->query($sql);
          echo '<table class="table">
            <thead>
              <tr>
              <th scope="col">Student ID</th>
              <th scope="col">Email</th>
              <th scope="col">Payment ID</th>
              <th scope="col">Payment Date</th>
              <th scope="col">Amount</th>
         
              </tr>
            </thead>
            <tbody>';
              while($row = $result->fetch_assoc()){
                echo '<tr>';
               
                echo '<td>'. $row["stu_id"].'</td>';
                echo '<td>'. $row["stu_email"].'</td>';
                echo '<td>'. $row["payment_id"].'</td>';
                echo '<td>'.$row["payment_date"].'</td>';
                echo '<td>'. $row["amount"].'</td>';
              }
              echo '<tr>
              <td><form class="d-print-none"><input class="btn btn-danger" type="submit" value="Print" onClick="window.print()"></form></td>
            </tr>
            </tr></tbody>
             </table>';
        } else {
          echo '<div class="alert alert-dark mt-4" role="alert">
          Course Not Found ! </div>';
        }
        if(isset($_REQUEST['delete'])){
         $sql = "DELETE FROM lesson WHERE lesson_id = {$_REQUEST['id']}";
         if($conn->query($sql) === TRUE){
           // echo "Record Deleted Successfully";
           // below code will refresh the page after deleting the record
           echo '<meta http-equiv="refresh" content= "0;URL=?deleted" />';
           } else {
             echo "Unable to Delete Data";
           } 
     } 
   } 
  } ?>
  
</div>
<!-- Only Number for input fields -->
<script>
  function isInputNumber(evt) {
    var ch = String.fromCharCode(evt.which);
    if (!(/[0-9]/.test(ch))) {
      evt.preventDefault();
    }
  }
</script>
 </div>  <!-- div Row close from header -->
 
 
</div>  <!-- div Conatiner-fluid close from header -->

<?php
include('./adminInclude/footer.php'); 
?>