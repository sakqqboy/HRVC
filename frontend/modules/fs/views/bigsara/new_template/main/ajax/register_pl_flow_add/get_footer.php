<?php
include("../../../config/main_function.php");
$secure = "-%ekla!(m09)%1A7";
$connection = connectDB($secure);

$page = mysqli_real_escape_string($connection, $_POST['page']);
$branchId = mysqli_real_escape_string($connection, $_POST['branchId']);
$sql_branch_account_code = "SELECT a.*,b.medium_name,c.major_name,d.cash_flow_name,e.breakdown_name FROM tbl_branch_pl_account_code a 
LEFT JOIN tbl_pl_medium_df b ON a.pl_medium_id = b.pl_medium_id
LEFT JOIN tbl_pl_major_df c ON b.pl_major_id = c.pl_major_id
LEFT JOIN tbl_pl_cash_flow_df d ON a.cash_flow_id = d.cash_flow_id
LEFT JOIN tbl_pl_breakdown_df e ON a.breakdown_id = e.breakdown_id 
WHERE branchId = '$branchId' ORDER BY a.acc_code ASC;";
$res_branch_account_code = mysqli_query($connection, $sql_branch_account_code)  or die($connection->error);
$num_row = mysqli_num_rows($res_branch_account_code);

// $index = 0; 

// while ($row_branch_account_code = mysqli_fetch_array($res_branch_account_code, MYSQLI_ASSOC)) {
//     if ($row_branch_account_code['acc_code'] === $search_value) {
//         echo "Value 'PL-07' found at index: $index";
//         break;
//     }
//     $index++;
// }

$page_count = ceil($num_row / 6);

?>
<div class="btn-group" role="group" aria-label="First group">
    <?php if ($page > 1) { ?>
        <button type="button" class="btn btn-light font-size-11" onclick="getFooter(<?php echo $page - 1; ?>)"> <i class="fa fa-chevron-left" aria-hidden="true"></i>
            Previous</button>
    <?php } ?>
</div>
<div class="btn-group" role="group" aria-label="Second group">
    <?php for ($i = 1; $i <= $page_count; $i++) { ?>
        <button type="button" class="btn <?php echo ($i == $page) ? "btn-primary" : "btn-light"; ?> font-size-11" onclick="getFooter(<?php echo $i; ?>)"><?php echo $i; ?></button>
    <?php } ?>
</div>
<div class="btn-group" role="group" aria-label="Third group">
    <?php if ($page < $page_count) { ?>
        <button type="button" class="btn btn-light font-size-11" onclick="getFooter(<?php echo $page + 1; ?>)"> Next <i class="fa fa-chevron-right" aria-hidden="true"></i></button>
    <?php } ?>
</div>