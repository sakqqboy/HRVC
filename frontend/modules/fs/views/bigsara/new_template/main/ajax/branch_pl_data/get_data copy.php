<?php
include("../../../config/main_function.php");
$secure = "-%ekla!(m09)%1A7";
$connection = connectDB($secure);

$branchId = mysqli_real_escape_string($connection, $_POST['branchId']);
$startYear = mysqli_real_escape_string($connection, $_POST['start_year']);

$sql_acc = "SELECT * FROM tbl_branch_pl_account_code WHERE branchId = '$branchId' ORDER BY acc_code ASC";
$res_acc = mysqli_query($connection, $sql_acc) or die($connection->error);
$listAcc = array();
while ($row_acc = mysqli_fetch_assoc($res_acc)) {
    $acc_id = $row_acc['account_id'];
    $listAcc[] = array(
        "account_id" => $row_acc['account_id'],
        "acc_code" => $row_acc['acc_code'],
        "acc_name" => $row_acc['acc_name']
    );
}

$sql_select = "SELECT financial_start_month FROM branch WHERE branchId = '$branchId' ";
$res_select = mysqli_query($connection, $sql_select)  or die($connection->error);
$row_select = mysqli_fetch_assoc($res_select);
$startMonth = $row_select['financial_start_month'];
$listMonth = array();
for ($i = 0; $i < 12; $i++) {
    $currentMonth = ($startMonth + $i - 1) % 12 + 1;
    $currentYear = $startYear + floor(($startMonth + $i - 1) / 12);
    $monthName = date('F', mktime(0, 0, 0, $currentMonth, 1));
    $listMonth[] = array(
        "monthName" => $monthName,
        "month" => $currentMonth,
        "year" => $currentYear
    );
}

$accum_last_act = 0.00;
$accum_act = 0.00;
$accum_tar = 0.00;
$accum_next_tar = 0.00;

$rowData = array();
$sum_target = 0;

foreach ($listMonth as $rowMonth) {
    $monthName = $rowMonth['monthName'];
    $month = $rowMonth['month'];
    $year = $rowMonth['year'];
    $last_year = $year - 1;

    $rowData[] = array(
        "monthName" => $monthName,
        "month" => $month,
        "year" => $year,
        "data" => array()
    );


    foreach ($listAcc as $row_select) {
        $account_id = $row_select['account_id'];

        $sql_last_year = "SELECT * FROM tbl_branch_pl_data a 
        WHERE a.account_id = '$account_id' AND a.month = '$month' AND a.year = '$last_year'
        ORDER BY a.month ASC,a.year ASC ";
        $res_last_year = mysqli_query($connection, $sql_last_year) or die($connection->error);
        $row_last_year = mysqli_fetch_assoc($res_last_year);
        $last_act = $row_last_year['actual_amount'] == "" ? 0 : $row_last_year['actual_amount'];
        $accum_last_act += $last_act;

        $sql_data = "SELECT * FROM tbl_branch_pl_data a 
        WHERE a.account_id = '$account_id' AND a.month = '$month' AND a.year = '$year'
        ORDER BY a.month ASC,a.year ASC ";
        $res_data = mysqli_query($connection, $sql_data) or die($connection->error);
        $row_data = mysqli_fetch_assoc($res_data);

        $accum_act += $row_data['actual_amount'] == "" ? 0 : $row_data['actual_amount'];
        $accum_tar += $row_data['target_amount'] == "" ? 0 : $row_data['target_amount'];
        $accum_next_tar += $row_data['next_target_amount'] == "" ? 0 : $row_data['next_target_amount'];

        $rowData[count($rowData) - 1]['data'][] = array(
            "account_id" => $account_id,
            "monthName" => $monthName,
            "month" => $month,
            "year" => $year,
            "last_actual_amount" => $row_last_year['actual_amount'],
            "actual_amount" => $row_data['actual_amount'],
            "target_amount" => $row_data['target_amount'],
            "next_target_amount" => $row_data['next_target_amount'],
            "accum_last_act" => $row_last_year['accum_last_act'],
            "accum_act" => $row_data['accum_act'],
            "accum_tar" => $row_data['accum_tar'],
            "accum_next_tar" => $row_data['accum_next_tar']
        );
        $sum_target += $row_data['next_target_amount'];
    }
    $accum_last_act = 0.00;
    $accum_act = 0.00;
    $accum_tar = 0.00;
    $accum_next_tar = 0.00;
}


echo "<pre>";
    var_dump($rowData);
echo "</pre>";
?>

<div class="row mt-10 pr-0">
    <div class="scroll-container col-lg-12 pl-10">
        <div class="mt-15">
            <div class="scroll-content col-2">
                <div class="col-12 pl-5 pr-5">
                    <div class="col-12 pr-10 pl-12">
                        <div class="row py-2" style="background-color: #dee2e6;border-radius:2px;">
                            <div class="col-12 p-Gross mb-2 pb-2">
                                ACCOUNT CODE
                            </div>
                        </div>
                    </div>
                    <div class="col-12 pr-12 pl-12 mt-5">
                        <?php
                        foreach ($listAcc as $row_select) {
                        ?>
                            <div class="row mb-7 pt-4 pb-4 border-buttom-bold" style="background-color: rgb(246 246 246);font-size: 10px;">
                                <div class="col-12 p-Gross border-buttom mb-2 pb-2">
                                    <?php echo $row_select['acc_code']; ?>
                                </div>
                                <div class="col-12 p-Gross">
                                    Accumulated
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
            <?php
            foreach ($rowData as $row) {
            ?>
                <div class="scroll-content col-lg-4 col-sm-6 col-12">
                    <div class="col-12 pl-5 pr-5">
                        <div class="col-12 pr-10 pl-12">
                            <div class="row" style="background-color: #dee2e6;border-radius:2px;">
                                <div class="col-6 BTH-Month pl-3">
                                    <?php echo $row['monthName']; ?>
                                </div>
                                <div class="col-6 caret-square text-end mt-3 pr-3">
                                    <img src="../images/icons/Dark/48px/CoolapseAside.png" class="images_CoolapseAside">
                                </div>
                                <div class="col-lg-3 pl-15">
                                    <div class="row">
                                        <div class="col-6 badge gbb_AC_blue pt-3" style="height: 13px;">
                                            AC</div>
                                        <div class="col-6 AA-2022 pl-3"><?php echo $row['year'] - 1; ?></div>
                                    </div>
                                </div>
                                <div class="col-lg-3 pl-15">
                                    <div class="row">
                                        <div class="col-6 badge dge_AAR_green pt-3" style="height: 13px;">AC
                                        </div>
                                        <div class="col-6 AA-2022 pl-3"><?php echo $row['year']; ?></div>
                                    </div>
                                </div>
                                <div class="col-lg-3 pl-15">
                                    <div class="row">
                                        <div class="col-6 badge dge_AAR_warning pt-3" style="height: 13px;">
                                            T</div>
                                        <div class="col-6 AA-2022 pl-3"><?php echo $row['year']; ?></div>
                                    </div>
                                </div>
                                <div class="col-lg-3 pl-15">
                                    <div class="row">
                                        <div class="col-6 badge gbb_AC_blue pt-3" style="height: 13px;">
                                            T</div>
                                        <div class="col-6 AA-2022 pl-3"><?php echo $row['year'] + 1; ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 pr-12 pl-12 mt-5">
                            <?php
                            foreach ($row['data'] as $row_detail) {
                            ?>
                                <div class="row mb-7 pt-4 pb-4 border-buttom-bold" style="background-color: rgb(246 246 246);font-size: 10px;">
                                    <div class="col-3 border-buttom mb-2 pb-2">
                                        <?php echo $row_detail['last_actual_amount']; ?>
                                    </div>
                                    <div class="col-3 border-buttom mb-2 pb-2">
                                        <?php echo $row_detail['actual_amount']; ?>
                                    </div>
                                    <div class="col-3 border-buttom mb-2 pb-2">
                                        <?php echo $row_detail['target_amount']; ?>
                                    </div>
                                    <div class="col-3 border-buttom mb-2 pb-2">
                                        <?php echo $row_detail['next_target_amount']; ?>
                                    </div>
                                    <div class="col-3">
                                        <?php echo $row_detail['accum_last_act']; ?>
                                    </div>
                                    <div class="col-3">
                                        <?php echo $row_detail['accum_act']; ?>
                                    </div>
                                    <div class="col-3">
                                        <?php echo $row_detail['accum_tar']; ?><br>
                                        <?php echo $sum_target  ?>
                                    </div>
                                    <div class="col-3">
                                        <?php echo $row_detail['accum_next_tar']; ?>
                                    </div>

                                </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>

            <?php } ?>
        </div>
    </div>
</div>

<?php
mysqli_close($connection);
?>