<?php
session_start();
include('../../../config/main_function.php');
require('../../../PHPExcel-1.8/Classes/PHPExcel.php');
require('../../../PHPExcel-1.8/Classes/PHPExcel/IOFactory.php');
$secure = "-%ekla!(m09)%1A7";
$connection = connectDB($secure);

$branchId = $_POST['branchId'];

$month_col = 2;
$year_col = 3;

$inputFile = $_FILES['excelFile']['tmp_name'];

$inputFileType = PHPExcel_IOFactory::identify($inputFile);

$objReader = PHPExcel_IOFactory::createReader($inputFileType);

$objPHPExcel = $objReader->load($inputFile);
$worksheet = $objPHPExcel->getActiveSheet();

$listOfMonth = array();

for ($i = 0; $i < 12; $i++) {
    $month_Val = $worksheet->getCellByColumnAndRow($month_col, 1)->getValue();
    $year_Val = $worksheet->getCellByColumnAndRow($year_col, 1)->getValue();
    $listOfMonth[] = array(
        "key" => $i,
        "month" => $month_Val,
        "year" => $year_Val
    );
    $month_col += 3;
    $year_col += 3;
}

foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
    $worksheets[$worksheet->getTitle()] = $worksheet->toArray();
}

$worksheets = array_shift($worksheets);
array_shift($worksheets);

$startRow = 2;
$acc_code_col = 0;
$acc_name_col = 1;
$au = 2;
$tar = 3;
$n_tar = 4;

$listOfData = array();

foreach ($worksheets as $key => $row) {
    if ($key < $startRow) {
        continue;
    }

    $rowData = array(
        "acc_code" => $row[$acc_code_col],
        "acc_name" => $row[$acc_name_col],
        "data" => array()
    );

    foreach ($listOfMonth as $monthData) {
        $rowData['data'][] = array(
            "month" => $monthData['month'],
            "year" => $monthData['year'],
            "au" => floatval(str_replace(',', '', trim($row[$au]))),
            "tar" => floatval(str_replace(',', '', trim( $row[$tar]))),
            "n_tar" => floatval(str_replace(',', '', trim($row[$n_tar])))
        );
        $au += 3;
        $tar += 3;
        $n_tar += 3;
    }

    $au = 2;
    $tar = 3;
    $n_tar = 4;

    $listOfData[] = $rowData;
}

foreach ($listOfData as $key => $row) {
    $acc_code = $row['acc_code'];
    $sql_acc_id = "SELECT a.account_id FROM tbl_branch_pl_account_code a WHERE a.branchId = '$branchId' AND a.acc_code = '$acc_code'";
    $res_acc_id = mysqli_query($connection, $sql_acc_id) or die($connection->error);
    $row_acc_id = mysqli_fetch_assoc($res_acc_id);
    $account_id = $row_acc_id['account_id'];

    foreach ($row["data"] as $row_detail) {
        $month = $row_detail['month'];
        $year = $row_detail['year'];
        $actual_amount = $row_detail['au']==''?0:$row_detail['au'];
        $target_amount = $row_detail['tar']==''?0:$row_detail['tar'];
        $next_target_amount = $row_detail['n_tar']==''?0:$row_detail['n_tar'];

        $sql_check = "SELECT COUNT(*) AS count FROM tbl_branch_pl_data a WHERE a.account_id = '$account_id' AND a.month = '$month' AND a.year = '$year'";
        $rs_check = mysqli_query($connection, $sql_check) or die($connection->error);
        $row_check = mysqli_fetch_assoc($rs_check);
        if ($row_check['count'] > 0) {
            if ($actual_amount == "" && $target_amount == "" && $next_target_amount == "") {
                $sql_delete = "DELETE FROM tbl_branch_pl_data WHERE account_id = '$account_id' AND month = '$month' AND year = '$year'";
                $res_delete = mysqli_query($connection, $sql_delete)  or die($connection->error);
            } else {
                $sql_update = "UPDATE tbl_branch_pl_data SET
                actual_amount = '$actual_amount',
                target_amount = '$target_amount',
                next_target_amount = '$next_target_amount'
                WHERE account_id = '$account_id' AND month = '$month' AND year = '$year'";
                $res_update = mysqli_query($connection, $sql_update)  or die($connection->error);
            }
        } else {
            if ($actual_amount != "" || $target_amount != "" || $next_target_amount != "") {
                $sql_insert = "INSERT INTO tbl_branch_pl_data SET
                account_id = '$account_id',
                month = '$month',
                year = '$year',
                actual_amount = '$actual_amount',
                target_amount = '$target_amount',
                next_target_amount = '$next_target_amount' ";
                $res_insert = mysqli_query($connection, $sql_insert)  or die($connection->error);
            }
        }
    }
    $arr['response'] = 1;
}

mysqli_close($connection);
echo json_encode($arr);
