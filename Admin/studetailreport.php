<?php
if(!isset($_SESSION)){ 
  session_start(); 
}
define('TITLE', 'Student Report');
define('PAGE', 'Student Report');
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
    <p style="font-size:200%" class=" bg-dark text-white text-center  p-2 mt-4"> Samathvee Student Details Report</p>
    <?php
      $sql = "SELECT * FROM student";
      $result = $conn->query($sql);
      if($result->num_rows > 0){
       echo '
       
       <table class="table table-hover table-info">
       <thead>
        <tr>
         
         <th scope="col">Student ID</th>
         <th scope="col">Email</th>
         <th scope="col">First Name</th>
         <th scope="col">Last Name</th>
         <th scope="col">Phone</th>
         <th scope="col">Address</th>
         <th scope="col">Other Detail</th>
         
        </tr>
       </thead>
       <tbody>';
        while($row = $result->fetch_assoc()){
            echo '<tr>
            <th scope="row">'.$row["stu_id"].'</th>
            <td>'.$row["stu_email"]. '</td>
            <td>'.$row["stu_fname"].'</td>
            <td>'.$row["stu_lname"].'</td>
            <td>'.$row["stu_phone"].'</td>
            <td>'.$row["stu_address"].'</td>
            <td>'.$row["stu_detail"].'</td>
          </tr> ';
        
          }

          echo '<form action="studetails.php" method="POST" class="d-inline">
          <button type="submit" class="btn btn-primary"  name="View" value="View">
          <i class="far fa-eye"></i></button></tbody>
        </table>';
        } else {
          echo "<div class='alert alert-warning col-sm-6 ml-5 mt-2' role='alert'> No Records Found ! </div>";
        }
      
     ?>
  </div>
 </div>  <!-- div Row close from header -->

</div>  <!-- div Conatiner-fluid close from header -->
<?php
include('./adminInclude/footer.php'); 
?>