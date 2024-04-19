<?php
include("../../../config/main_function.php");
$secure = "-%ekla!(m09)%1A7";
$connection = connectDB($secure);

$branchId = mysqli_real_escape_string($connection, $_POST['branchId']);
$quarter = mysqli_real_escape_string($connection, $_POST['quarter']);
$breakdown_id = mysqli_real_escape_string($connection, $_POST['breakdown_id']);
$startYear = mysqli_real_escape_string($connection, $_POST['start_year']);

$sql_acc = "SELECT * FROM tbl_branch_pl_account_code WHERE branchId = '$branchId' AND breakdown_id = '$breakdown_id' ORDER BY acc_code ASC";
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

$rowData = array();
foreach ($list_month as $rowMonth) {
    $monthName = $rowMonth['monthName'];
    $month = $rowMonth['month'];
    $year = $rowMonth['year'];

    $rowData[] = array(
        "monthName" => $monthName,
        "month" => $month,
        "year" => $year,
        "data" => array()
    );

    foreach ($listAcc as $row_select) {
        $account_id = $row_select['account_id'];
        $sql_data = "SELECT * FROM tbl_branch_pl_data a 
        WHERE a.account_id = '$account_id' AND a.month = '$month' AND a.year = '$year'
        ORDER BY a.month ASC,a.year ASC ";
        $res_data = mysqli_query($connection, $sql_data) or die($connection->error);
        $row_data = mysqli_fetch_assoc($res_data);
        $rowData[count($rowData) - 1]['data'][] = array(
            "account_id" => $account_id,
            "monthName" => $monthName,
            "month" => $month,
            "year" => $year,
            "actual_amount" => $row_data['actual_amount'],
            "target_amount" => $row_data['target_amount'],
            "next_target_amount" => $row_data['next_target_amount']
        );
    }
}

?>

<div class="row mt-10 pr-20">
    <div class="scroll-container col-lg-4 pl-10">
        <div class="mt-15">
            <div class="scroll-content col-12">
                <div class="col-12 pr-10 pl-12">
                    <div class="row pt-2" style="background-color: #dee2e6;border-radius:2px;">
                        <div class="col-6 pl_textsale pb-10 pl-3">
                            ACCOUNT CODE
                        </div>
                        <div class="col-6 pl_textsale pb-10 pl-3">
                            ACCOUNT NAME
                        </div>
                    </div>
                </div>
                <div class="col-12 pr-12 pl-12 mt-5">
                    <?php
                    foreach ($listAcc as $row_select) {
                    ?>
                        <div class="row mb-7 pt-4 pb-4 border-buttom-bold" style="background-color: rgb(246 246 246);">
                            <div class="col-6 p-Gross">
                                <?php echo $row_select['acc_code']; ?>
                            </div>
                            <div class="col-6 p-Gross">
                                <?php echo $row_select['acc_name']; ?>
                            </div>
                        </div>
                    <?php
                    }

                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class="scroll-container col-lg-8 pl-10">
        <div class="mt-15">
            <?php
            foreach ($rowData as $row) {
            ?>
                <div class="scroll-content col-lg-4 col-sm-6 col-12">
                    <div class="col-12 pr-10 pl-12">
                        <div class="row py-3 pt-2 pb-2" style="background-color: #dee2e6;border-radius:2px;">
                            <div class="col-6 BTH-Month pl-3">
                                <?php echo $row['monthName']; ?> <?php echo $row['year']; ?>
                            </div>
                            <div class="col-6 caret-square text-end mt-3 pr-3">
                                <img src="../images/icons/Dark/48px/CoolapseAside.png" class="images_CoolapseAside">
                            </div>
                            <div class="col-lg-4 pl-15">
                                <div class="row">
                                    <div class="col-12 badge dge_AAR_green pt-3 mb-3" style="height: 13px;text-align: right;">
                                        AC <?php echo $row['year']; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 pl-15">
                                <div class="row">
                                    <div class="col-12 badge dge_AAR_warning pt-3 mb-3" style="height: 13px;text-align: right;">
                                        T <?php echo $row['year']; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 pl-15">
                                <div class="row">
                                    <div class="col-12 badge gbb_AC_blue pt-3 mb-3" style="height: 13px;text-align: right;">
                                        T <?php echo $row['year'] + 1; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 pr-12 pl-12 mt-5">
                        <?php
                        foreach ($row['data'] as $row_detail) {
                        ?>
                            <div class="row mb-7 pt-4 pb-4 border-buttom-bold" style="background-color: rgb(246 246 246);text-align: right;">
                                <div class="col-4">
                                    <input type="text" class="form-control edit-numbermonth text-center pr-2 pl-2" id="actual_amount" name="actual_amount" value="<?php echo $row_detail['actual_amount']; ?>" onchange="updateData('<?php echo $row_detail['account_id']; ?>','1','<?php echo $row_detail['month']; ?>','<?php echo $row_detail['year']; ?>',this.value,$(this))" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" placeholder="0">
                                </div>
                                <div class="col-4">
                                    <input type="text" class="form-control edit-numbermonth text-center pr-2 pl-2" id="target_amount" name="target_amount" value="<?php echo $row_detail['target_amount']; ?>" onchange="updateData('<?php echo $row_detail['account_id']; ?>','2','<?php echo $row_detail['month']; ?>','<?php echo $row_detail['year']; ?>',this.value,$(this))" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" placeholder="0">
                                </div>
                                <div class="col-4">
                                    <input type="text" class="form-control edit-numbermonth text-center pr-2 pl-2" id="next_target_amount" name="next_target_amount" value="<?php echo $row_detail['next_target_amount']; ?>" onchange="updateData('<?php echo $row_detail['account_id']; ?>','3','<?php echo $row_detail['month']; ?>','<?php echo $row_detail['year']; ?>',this.value,$(this))" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" placeholder="0">
                                </div>
                            </div>
                        <?php
                        }

                        ?>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>

<?php
mysqli_close($connection);
?>