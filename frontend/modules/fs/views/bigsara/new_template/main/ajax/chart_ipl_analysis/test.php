 <?php
   include("../../../config/main_function.php");
   $secure = "-%ekla!(m09)%1A7";
   $connection = connectDB($secure);

   $sql_select = "SELECT account_id FROM tbl_branch_pl_account_code WHERE branchId = 67";
   $res_select = mysqli_query($connection, $sql_select)  or die($connection->error);
   while($row_select = mysqli_fetch_assoc($res_select)){
      $account_id = $row_select['account_id'];
      $sql_update = "UPDATE tbl_branch_pl_data SET  
      actual_amount = null
      WHERE account_id = '$account_id' AND year = '2024'";

   $res_update = mysqli_query($connection, $sql_update)  or die($connection->error);
}

   if ($res_update) {
      echo 'good job';
   }
   ?>
