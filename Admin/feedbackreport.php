<?php
if(!isset($_SESSION)){ 
  session_start(); 
}
define('TITLE', 'Samathvee Feedback Report');
define('PAGE', 'Feedback Report');
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
    <p style="font-size:200%" class=" bg-dark text-white text-center  p-2 mt-4">Samathvee Feedback Report</p>
    <?php
      $sql = "SELECT * FROM feedback";
      $result = $conn->query($sql);
      if($result->num_rows > 0){
       echo '
       
       <table class="table table-hover table-info">
       <thead>
        <tr>
         
         <th scope="col">Feedback ID</th>
         <th scope="col">Feedback Content</th>
         <th scope="col">Student ID</th>
         
        </tr>
       </thead>
       <tbody>';
        while($row = $result->fetch_assoc()){
          echo '<tr>';
          echo '<th scope="row">'.$row["f_id"].'</th>';
          echo '<td>'. $row["f_content"].'</td>';
          echo '<td>'. $row["stu_id"].'</td></tr>';
        
          }

          echo '<tr>
          <td><form class="d-print-none"><input class="btn btn-danger" type="submit" value="Print" onClick="window.print()"></form></td>
        </tr></tbody>
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