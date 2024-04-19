<?php
include("../../../config/main_function.php");
$secure = "-%ekla!(m09)%1A7";
$connection = connectDB($secure);

$branchId = mysqli_real_escape_string($connection, $_POST['branchId']);
$breakdown_id = mysqli_real_escape_string($connection, $_POST['breakdown_id']);
$quarter = mysqli_real_escape_string($connection, $_POST['quarter']);
$startYear = mysqli_real_escape_string($connection, $_POST['start_year']);
$rate = mysqli_real_escape_string($connection, $_POST['rate']);

$sql_acc = "SELECT * FROM tbl_branch_pl_account_code WHERE branchId = '$branchId' AND breakdown_id = '$breakdown_id' ORDER BY acc_code ASC";
$res_acc = mysqli_query($connection, $sql_acc) or die($connection->error);
$list_acc = array();
while ($row_acc = mysqli_fetch_assoc($res_acc)) {
    $acc_id = $row_acc['account_id'];
    $list_acc[] = array(
        "account_id" => $row_acc['account_id'],
        "acc_code" => $row_acc['acc_code'],
        "acc_name" => $row_acc['acc_name'],
    );
}

$sql_select = "SELECT financial_start_month FROM branch WHERE branchId = '$branchId' ";
$res_select = mysqli_query($connection, $sql_select)  or die($connection->error);
$row_select = mysqli_fetch_assoc($res_select);
$startMonth = $row_select['financial_start_month'];

$list_time = array();
$list_month = array();

for ($i = 0; $i < 12; $i++) {
    $currentMonth = ($startMonth + $i - 1) % 12 + 1;
    $currentYear = $startYear + floor(($startMonth + $i - 1) / 12);
    $monthName = date('F', mktime(0, 0, 0, $currentMonth, 1));
    $Q = ceil(($i + 1) / 3);

    $list_time[] = array(
        "list" => $i,
        "monthName" => $monthName,
        "month" => $currentMonth,
        "year" => $currentYear,
        "quarter" => $Q
    );
}

if ($quarter != '') {
    $i = 0;
    foreach ($list_time as $key => $time) {
        if ($time['quarter'] == $quarter) {
            $list_month[] = array(
                "list" => $i,
                "monthName" => $time['monthName'],
                "month" => $time['month'],
                "year" => $time['year'],
                "quarter" => $time['quarter']
            );
            $i++;
        }
    }
} else {
    $list_month = $list_time;
}

$accum_last_act = 0.00;
$accum_act = 0.00;
$accum_tar = 0.00;
$accum_next_tar = 0.00;

$list_data = array();

foreach ($list_acc as $row_select) {
    $account_id = $row_select['account_id'];

    $list_data[] = array(
        "account_id" => $account_id,
        "data" => array()
    );

    foreach ($list_month as $rowMonth) {
        $monthName = $rowMonth['monthName'];
        $month = $rowMonth['month'];
        $year = $rowMonth['year'];
        $last_year = $year - 1;

        $sql_last_year = "SELECT * FROM tbl_branch_pl_data a 
         WHERE a.account_id = '$account_id' AND a.month = '$month' AND a.year = '$last_year'
         ORDER BY a.month ASC,a.year ASC ";
        $res_last_year = mysqli_query($connection, $sql_last_year) or die($connection->error);
        $row_last_year = mysqli_fetch_assoc($res_last_year);
        $last_act = ($row_last_year['actual_amount'] == "" ? 0 : $row_last_year['actual_amount']) / $rate;
        $accum_last_act += $last_act;

        $sql_data = "SELECT * FROM tbl_branch_pl_data a 
         WHERE a.account_id = '$account_id' AND a.month = '$month' AND a.year = '$year'
         ORDER BY a.month ASC,a.year ASC ";
        $res_data = mysqli_query($connection, $sql_data) or die($connection->error);
        $row_data = mysqli_fetch_assoc($res_data);

        $actual_amount = ($row_data['actual_amount'] == "" ? 0 : $row_data['actual_amount']) / $rate;
        $target_amount = ($row_data['target_amount'] == "" ? 0 : $row_data['target_amount']) / $rate;
        $next_target_amount = ($row_data['next_target_amount'] == "" ? 0 : $row_data['next_target_amount']) / $rate;

        $accum_act += $actual_amount;
        $accum_tar += $target_amount;
        $accum_next_tar += $next_target_amount;


        $list_data[count($list_data) - 1]['data'][] = array(
            "list" => $rowMonth['list'],
            "account_id" => $account_id,
            "monthName" => $monthName,
            "month" => $month,
            "year" => $year,
            "last_actual_amount" => $last_act,
            "actual_amount" => $actual_amount,
            "target_amount" => $target_amount,
            "next_target_amount" => $next_target_amount,
            "accum_last_act" => $accum_last_act,
            "accum_act" => $accum_act,
            "accum_tar" => $accum_tar,
            "accum_next_tar" => $accum_next_tar,
        );
    }

    $accum_last_act = 0.00;
    $accum_act = 0.00;
    $accum_tar = 0.00;
    $accum_next_tar = 0.00;
}

// echo "<pre>";
// var_dump($list_data);
// echo "</pre>";

?>

<div class="row mt-10 pr-0">
    <div class="scroll-container col-lg-4 pl-10">
        <div class="mt-15">
            <div class="scroll-content col-12">
                <div class="col-12 pl-5 pr-5">
                    <div class="col-12 pr-10 pl-12">
                        <div class="row py-2" style="background-color: #dee2e6;border-radius:2px;">
                            <div class="col-6 p-Gross mb-2 pb-2 border-right">
                                ACCOUNT CODE
                            </div>
                            <div class="col-6 p-Gross mb-2 pb-2">
                                ACCOUNT NAME
                            </div>
                        </div>
                    </div>
                    <div class="col-12 pr-12 pl-12 mt-5">
                        <?php
                        foreach ($list_acc as $row_select) {
                        ?>
                            <div class="row mb-7 pt-4 pb-4 border-buttom-bold" style="background-color: rgb(246 246 246);font-size: 10px;">
                                <div class="col-6 p-Gross border-buttom mb-2 pb-2 border-right">
                                    <?php echo $row_select['acc_code']; ?>
                                </div>
                                <div class="col-6 p-Gross border-buttom mb-2 pb-2">
                                    <?php echo $row_select['acc_name']; ?>
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
        </div>
    </div>
    <div class="scroll-container col-lg-8 pl-10">
        <div class="mt-15">
            <?php
            foreach ($list_month as $row) {
                $list = $row['list'];
            ?>
                <div class="scroll-content col">
                    <div class="col-12 pl-5 pr-5">
                        <div class="col-12 pr-10 pl-12">
                            <div class="row pt-2 pb-2" style="background-color: #dee2e6;border-radius:2px;">
                                <div class="col-6 BTH-Month pl-3">
                                    <?php echo $row['monthName']; ?> <?php echo $row['year']; ?>
                                </div>
                                <div class="col-6 caret-square text-end mt-3 pr-3">
                                    <img src="../images/icons/Dark/48px/CoolapseAside.png" class="images_CoolapseAside">
                                </div>
                                <div class="col-lg-3 pl-15">
                                    <div class="row">
                                        <div class="col-12 badge gbb_AC_blue pt-3" style="height: 13px;text-align: right;">
                                            AC <?php echo $row['year'] - 1; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 pl-15">
                                    <div class="row">
                                        <div class="col-12 badge dge_AAR_green pt-3" style="height: 13px;text-align: right;">
                                            AC <?php echo $row['year']; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 pl-15">
                                    <div class="row">
                                        <div class="col-12 badge dge_AAR_warning pt-3" style="height: 13px;text-align: right;">
                                            T <?php echo $row['year']; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 pl-15">
                                    <div class="row">
                                        <div class="col-12 badge gbb_AC_blue pt-3" style="height: 13px;text-align: right;">
                                            T <?php echo $row['year'] + 1; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 pr-12 pl-12 mt-5">
                            <?php
                            foreach ($list_data as $data) {
                                foreach ($data['data'] as $row_detail) {
                                    if ($row_detail['list'] == $list) {
                            ?>
                                        <div class="row mb-7 pt-4 pb-4 border-buttom-bold" style="background-color: rgb(246 246 246);font-size: 10px;text-align: right;">
                                            <div class="col-3 border-buttom mb-2 pb-2">
                                                <?php echo number_format($row_detail['last_actual_amount'],2); ?>
                                            </div>
                                            <div class="col-3 border-buttom mb-2 pb-2">
                                                <?php echo number_format($row_detail['actual_amount'],2); ?>
                                            </div>
                                            <div class="col-3 border-buttom mb-2 pb-2">
                                                <?php echo number_format($row_detail['target_amount'],2); ?>
                                            </div>
                                            <div class="col-3 border-buttom mb-2 pb-2">
                                                <?php echo number_format($row_detail['next_target_amount'],2); ?>
                                            </div>
                                            <div class="col-3">
                                                <?php echo number_format($row_detail['accum_last_act'],2); ?>
                                            </div>
                                            <div class="col-3">
                                                <?php echo number_format($row_detail['accum_act'],2); ?>
                                            </div>
                                            <div class="col-3">
                                                <?php echo number_format($row_detail['accum_tar'],2); ?>
                                            </div>
                                            <div class="col-3">
                                                <?php echo number_format($row_detail['accum_next_tar'],2); ?>
                                            </div>

                                        </div>
                            <?php
                                    }
                                }
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