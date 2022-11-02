<?php
if(!isset($_SESSION)){ 
  session_start(); 
}
define('TITLE', 'Students');
define('PAGE', 'students');
include('./adminInclude/header.php'); 
include('../dbConnection.php');

 if(isset($_SESSION['is_admin_login'])){
  $adminEmail = $_SESSION['adminLogEmail'];
 } else {
  echo "<script> location.href='../index.php'; </script>";
 }
?>
  <div class="col-sm-9 mt-5">
    <!--Table-->
    <p class=" bg-dark text-white p-2" style=" border-radius: 20px;">&nbsp; List of Students</p>
    <?php
      $sql = "SELECT * FROM student";
      $result = $conn->query($sql);
      if($result->num_rows > 0){
       echo '<table class="table table-hover table-primary">
       <thead>
        <tr>
         <th scope="col">Student ID</th>
         <th scope="col">First Name</th>
         <th scope="col">Last Name</th>
         <th scope="col">Address</th>
         <th scope="col">Phone Number</th>
         <th scope="col">Email</th>
         <th scope="col">Action</th>
         <th scope="col"></th>
        </tr>
       </thead>
       <tbody>';
        while($row = $result->fetch_assoc()){
          echo '<tr>';
          echo '<th scope="row">'.$row["stu_id"].'</th>';
          echo '<td>'. $row["stu_fname"].'</td>';
          echo '<td>'. $row["stu_lname"].'</td>';
          echo '<td>'. $row["stu_address"].'</td>';
          echo '<td>0'. $row["stu_phone"].'</td>';
          echo '<td>'.$row["stu_email"].'</td>';
          echo '<td>
           <form action="editstudent.php" method="POST" class="d-inline">
           <input type="hidden" name="id" value='. $row["stu_id"] .'>
           <button type="submit" class="btn btn-info mr-3" name="view" value="View">
           <i class="fas fa-pen"></i></button></form>  

          <form action="" method="POST" class="d-inline">
          <input type="hidden" name="id" value='. $row["stu_id"] .'>
          <button type="submit" class="btn btn-secondary" name="delete" value="Delete">
          <i class="far fa-trash-alt"></i></button>
         

         </form></td>
         </tr>';
        }

        echo '
         </tbody>
        </table>';
      } else {
        echo "0 Result";
      }
      if(isset($_REQUEST['delete'])){
       $sql = "DELETE FROM student WHERE stu_id = {$_REQUEST['id']}";
       if($conn->query($sql) === TRUE){
         // echo "Record Deleted Successfully";
         // below code will refresh the page after deleting the record
         echo '<meta http-equiv="refresh" content= "0;URL=?deleted" />';
         } else {
           echo "Unable to Delete Data";
         }
      }
     ?>
  </div>
 </div>  <!-- div Row close from header -->

</div>  <!-- div Conatiner-fluid close from header -->
<?php
include('./adminInclude/footer.php'); 
?>