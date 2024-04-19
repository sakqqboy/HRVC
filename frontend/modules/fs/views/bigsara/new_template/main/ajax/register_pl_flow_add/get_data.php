<?php
include("../../../config/main_function.php");
$secure = "-%ekla!(m09)%1A7";
$connection = connectDB($secure);

$branchId = mysqli_real_escape_string($connection, $_POST['branchId']);
$limit = mysqli_real_escape_string($connection, $_POST['limit']);
$sql_branch_account_code = "SELECT a.*,b.medium_name,c.major_name,d.cash_flow_name,e.breakdown_name FROM tbl_branch_pl_account_code a 
LEFT JOIN tbl_pl_medium_df b ON a.pl_medium_id = b.pl_medium_id
LEFT JOIN tbl_pl_major_df c ON b.pl_major_id = c.pl_major_id
LEFT JOIN tbl_pl_cash_flow_df d ON a.cash_flow_id = d.cash_flow_id
LEFT JOIN tbl_pl_breakdown_df e ON a.breakdown_id = e.breakdown_id 
WHERE branchId = '$branchId' ORDER BY a.acc_code ASC LIMIT $limit,6 ;";
$res_branch_account_code = mysqli_query($connection, $sql_branch_account_code)  or die($connection->error);
while ($row = mysqli_fetch_assoc($res_branch_account_code)) {
?>

    <div class="col-4">
        <div class="card pl-20 pr-20">

            <div class="row pl-10 pr-10 pt-10 pb-10">
                <div class="col-lg-6 font-size-12">
                    <?php echo $row['acc_code']; ?>
                </div>
                <div class="col-lg-6 text-end">
                    <div class="badge bg-light  text-secondary" style="cursor: pointer;" onclick="getModalEditPL('<?php echo $row['account_id']; ?>')"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></div>
                    <div class="badge bg-light text-danger" style="cursor: pointer;"><i class="fa fa-trash-o" aria-hidden="true"></i></div>
                </div>
            </div>

            <div class="col-12 pt-15 pl-10 pr-10 font-size-12">
                <span class="font-size-10"> PL Account Name</span> <span class="font-b pl-10"><?php echo $row['acc_name']; ?></span>
            </div>
            <div class="col-12 border-left pl-10 pr-10 mt-10">
                <div class="col-12">
                    <span class="font-size-10">PL Categories</span> <span class="font-b pl-10 font-size-12"><?php echo $row['major_name']; ?></span>
                </div>
                <div class="col-12 pt-20 font-size-12">
                    <span class="font-size-10"> PL Sub-Company</span> <span class="font-b pl-10"><?php echo $row['medium_name']; ?></span>
                </div>
            </div>
            <div class="col-12 pt-15 pl-10 pr-10 font-size-12">
                <span class="font-size-10"> PL Breakdown</span> <span class="font-b pl-10"><?php echo $row['breakdown_name']; ?></span>
            </div>
            <div class="col-12 pt-15 pl-10 pr-10 font-size-12">
                <span class="font-size-10"> Cash From Categories</span> <span class="font-b pl-10"><?php echo $row['cash_flow_name']; ?></span>
            </div>
            <div class="col-12 text-end mt-20 pr-10 pb-10">
                <div class="row">
                    <div class="col-8 font-size-12">
                        Type
                    </div>
                    <div class="col-4 font-size-12 font-b" style="cursor: pointer;">
                        <?php if ($row['cash_flow_type'] == '1') {
                            echo "<label class='text-success'>Increase (+)</label>";
                        } else if ($row['cash_flow_type'] == '2') {
                            echo "<label class='text-danger'>Decrease (-)</label>";
                        } else {
                            echo "<label >None</label>";
                        } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php } ?>