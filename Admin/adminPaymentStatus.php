<?php
  define('TITLE', 'Payment Status');
  define('PAGE', 'paymentstatus');
  include('../dbConnection.php');
  include('./adminInclude/header.php'); 
  $PAYMENT_ID = "";
	
	if (isset($_POST["PAYMENT_ID"]) && $_POST["PAYMENT_ID"] != "") {
		$PAYMENT_ID = $_POST["PAYMENT_ID"];
	}

?>  <div class="col-sm-9 mt-5">
   <div class="container">
     <h2 class="text-center my-4">Payment Status </h2>
     <form method="post" action="">
     <div class="form-group row">
        <label class="offset-sm-3 col-form-label">Payment ID: </label>
        <div>
          <input class="form-control mx-3" id="PAYMENT_ID" tabindex="1" maxlength="20" size="20" name="PAYMENT_ID" autocomplete="off" value="<?php echo $PAYMENT_ID ?>">
        </div>
        <div>
          <input class="btn btn-primary mx-4" value="View" type="submit"	onclick="">
        </div>
      </div>
     </form>
    </div>
    <div class="container">
    <?php
      if (isset($_POST['PAYMENT_ID']))
      { 
        $sql = "SELECT PAYMENT_ID, amount FROM payment";
        $result = $conn->query($sql);
        while($row = $result->fetch_assoc()){
          if($_POST["PAYMENT_ID"] == $row["PAYMENT_ID"]){ ?>
          
            <div class="row justify-content-center">
              <div class="col-auto">
                <h2 class="text-center">Payment Receipt</h2>
                <table class="table table-bordered">
                  <tbody>
                      <tr >
                        <td><label>Payment ID</label></td>
                        <td><?php if (isset($row["PAYMENT_ID"])) echo $row["PAYMENT_ID"] ?></td>
                      </tr>
                      <tr >
                        <td><label>Amount</label></td>
                        <td><?php if (isset($row["amount"])) echo $row["amount"] ?></td>
                      </tr>
                      <tr >
                        <td><label>Status</label></td>
                        <td>Success</td>
                      </tr>
                      
                    </tbody>
                  </table>      
                  <form class = "d-print-none"> 
        <input class=" btn btn-danger" type="submit" value="print" onClick="window.print()">
         </form>
                </div>
              </div>
      <?php
      } } } ?>
      
      </div>
      </div>

    </div> 
    </div>  <!-- div Row close from header -->
</div>  <!-- div Conatiner-fluid close from header -->
<?php
include('./adminInclude/footer.php'); 
?> 
