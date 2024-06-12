<?php
include("../../../config/main_function.php");
$secure = "-%ekla!(m09)%1A7";
$connection = connectDB($secure);

$branchId = mysqli_real_escape_string($connection, $_POST['branchId']);

$sql_select_year = "SELECT MIN(a.year) AS year FROM tbl_branch_pl_data a
    LEFT JOIN tbl_branch_pl_account_code b ON a.account_id = b.account_id
    WHERE b.branchId = '$branchId'";
$res_select_year = mysqli_query($connection, $sql_select_year)  or die($connection->error);
$row_select_year = mysqli_fetch_assoc($res_select_year);
$year = $row_select_year['year'];

$current_year = date('Y');

$sql_select_month = "SELECT financial_start_month FROM branch WHERE branchId = '$branchId' ";
$res_select_month = mysqli_query($connection, $sql_select_month)  or die($connection->error);
$row_select_month = mysqli_fetch_assoc($res_select_month);
$startMonth = $row_select_month['financial_start_month'];

?>
<div class="text-secondary px-1">
    <img src="../image/calendar.png" style="width: 13px;"> &nbsp;
    <span class="font-size-12">Current Year</span>
</div>
<div class="col-2" id="show_year_graph_month">
    <select class="form-select text-primary" style="height: 25px;font-size:10px;" id="start_year" name="start_year" onchange="getData()">
        <?php
        for ($year = $year; $year <= $current_year; $year++) {
        ?>
            <option value="<?php echo $year; ?>" <?php echo $year == $current_year ? 'selected' : ''; ?>><?php echo $year; ?></option>
        <?php
        }
        ?>
    </select>
</div>
<div class="text-secondary px-1">
    <img src="../image/calendar.png" style="width: 13px;"> &nbsp;
    <span class="font-size-12">Current Month</span>
</div>
<div class="col-2" id="show_month_graph_month">
    <select class="form-select text-primary" style="height: 25px;font-size:10px;" id="start_month" name="start_month" onchange="getData()">
        <?php
        $months = [
            1 => "January", 2 => "February", 3 => "March", 4 => "April",
            5 => "May", 6 => "June", 7 => "July", 8 => "August",
            9 => "September", 10 => "October", 11 => "November", 12 => "December"
        ];

        foreach ($months as $num => $name) {
        ?>
            <option value='<?php echo $num; ?>' <?php echo $num == $startMonth ? 'selected' : ''; ?>><?php echo $name; ?></option>
        <?php
        }
        ?>
    </select>
</div>
<div class="text-secondary px-1">
    <img src="../image/roundup.png" style="width: 13px;"> &nbsp;
    <span class="font-size-12">Round Up</span>
</div>
<div class="col-2">
    <select class="form-select text-primary" style="height: 25px;font-size:10px;" id="rate" name="rate" onchange="getData()">
        <option value="1">Normal</option>
        <option value="1000">Thousand</option>
        <option value="1000000">Million</option>
    </select>
</div>