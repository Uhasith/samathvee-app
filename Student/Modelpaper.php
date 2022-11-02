<?php
if(!isset($_SESSION)){ 
  session_start(); 
}
define('TITLE', 'Model Papers');
define('PAGE', 'Modelpaper');
include('./stuInclude/header.php'); 
include_once('../dbConnection.php');

 if(isset($_SESSION['is_login'])){
  $stuLogEmail = $_SESSION['stuLogEmail'];
 } else {
  echo "<script> location.href='../index.php'; </script>";
 }
?>
<div class="col-sm-9 mt-5">
    <!--Table-->
    <p class=" bg-dark text-white p-2">List of papers</p>
    <?php
      $sql = "SELECT * FROM modelpapers";
      $result = $conn->query($sql);
      if($result->num_rows > 0){
       echo '<table class="table" align="center">
       <thead class="thead-dark">
        <tr>
         <th scope="col">Paper ID</th>
         <th scope="col">Subject</th>
         <th scope="col">Description (year)</th>
         <th scope="col"></th>
        </tr>
        </thead>
       <tbody class = "table-primary">';


       
        while($row = $result->fetch_assoc()){
          echo '<tr>';
          echo '<th scope="row">'.$row["p_no"].'</th>';
          echo '<td>'. $row["p_name"].'</td>';
          echo '<td>'. $row["p_desc"].'</td>';
          

          echo '<td> <a href="/Samathvee/papers/">Download</a>
          </td>
  
         </tr>';
        }
       

        echo '</tbody>
        </table>';
      } else {
        echo "0 Result";
      }
      


     ?>
  

 <?php
include('./stuInclude/footer.php'); 
?>