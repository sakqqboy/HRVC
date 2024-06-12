 <?php
    include("../../../config/main_function.php");
    $secure = "-%ekla!(m09)%1A7";
    $connection = connectDB($secure);

    $branchId = mysqli_real_escape_string($connection, $_POST['branchId']);

    $sql_select = "SELECT MIN(a.year) AS year FROM tbl_branch_pl_data a
    LEFT JOIN tbl_branch_pl_account_code b ON a.account_id = b.account_id
    WHERE b.branchId = '$branchId'";
    $res_select = mysqli_query($connection, $sql_select)  or die($connection->error);
    $row_select = mysqli_fetch_assoc($res_select);
    $year = $row_select['year'];

    $current_year = date('Y');

    ?>
 <select class="form-select text-primary" style="height: 25px;font-size:10px;" id="start_year" name="start_year" onchange="getChart()">
     <?php
        for ($year = $year; $year <= $current_year; $year++) {
        ?>
         <option value="<?php echo $year; ?>" <?php echo $year==$current_year?'selected':''; ?>><?php echo $year; ?></option>
     <?php
        }
        ?>
 </select>