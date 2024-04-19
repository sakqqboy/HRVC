<?php
session_start();
include('../../../config/main_function.php');
require('../../../PHPExcel-1.8/Classes/PHPExcel.php');
require('../../../PHPExcel-1.8/Classes/PHPExcel/IOFactory.php');
$secure = "-%ekla!(m09)%1A7";
$connection = connectDB($secure);

$select_medium = "SELECT md.pl_medium_id, md.medium_name, mj.pl_major_id, mj.major_name FROM tbl_pl_medium_df md
LEFT JOIN tbl_pl_major_df mj ON md.pl_major_id = mj.pl_major_id ;";
$rs_medium = mysqli_query($connection, $select_medium) or die($connection->error);
while ($row_medium = mysqli_fetch_assoc($rs_medium)) {
    $medium_array[] = array(
        "pl_medium_id" => $row_medium['pl_medium_id'],
        "medium_name" => $row_medium['medium_name'],
        "pl_major_id" => $row_medium['pl_major_id'],
        "major_name" => $row_medium['major_name']
    );
}

$select_breakdown = "SELECT bd.breakdown_id, bd.breakdown_name FROM tbl_pl_breakdown_df bd ;";
$rs_breakdown = mysqli_query($connection, $select_breakdown) or die($connection->error);
while ($row_breakdown = mysqli_fetch_assoc($rs_breakdown)) {
    $breakdown_array[] = array(
        "breakdown_id" => $row_breakdown['breakdown_id'],
        "breakdown_name" => $row_breakdown['breakdown_name']
    );
}

$select_cash_flow = "SELECT cf.cash_flow_id, cf.cash_flow_name FROM tbl_pl_cash_flow_df cf ;";
$rs_cash_flow = mysqli_query($connection, $select_cash_flow) or die($connection->error);
while ($row_cash_flow = mysqli_fetch_assoc($rs_cash_flow)) {
    $cash_flow_array[] = array(
        "cash_flow_id" => $row_cash_flow['cash_flow_id'],
        "cash_flow_name" => $row_cash_flow['cash_flow_name']
    );
}

$branchId = $_POST['branchId'];

$AccountingCode = 0;
$AccountingName = 1;
$Major = 2;
$Medium = 3;
$Breakdown = 4;
$CashFlow = 5;
$IncreaseAndDecrease = 6;

$inputFile = $_FILES['excelFile']['tmp_name'];

$inputFileType = PHPExcel_IOFactory::identify($inputFile);

$objReader = PHPExcel_IOFactory::createReader($inputFileType);

$objPHPExcel = $objReader->load($inputFile);

foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {

    $worksheets[$worksheet->getTitle()] = $worksheet->toArray();
}

$worksheets = array_shift($worksheets);
array_shift($worksheets);

$errorList = array();
$listOfInserted = array();

foreach ($worksheets as $key => $row) {
    if ($row[$Major] == "" || $row[$Medium] == "" || $row[$Breakdown] == "" || $row[$CashFlow] == "" || $row[$AccountingCode] == "" || $row[$AccountingName] == "" || $row[$IncreaseAndDecrease] == "") {
        $errorList[] = array(
            "row" => $key,
            "text" => "Have blank cell."
        );
    }

    $indexMedium = array_search($row[$Medium], array_column($medium_array, 'medium_name'));
    if ($indexMedium !== false) {
        if (!in_array($row[$Major], array_column($medium_array, 'major_name'), $indexMedium)) {
            $errorList[] = array(
                "row" => $key,
                "text" => "Medium is incorrect Major."
            );
        } else {
            $pl_medium_id = $medium_array[$indexMedium]['pl_medium_id'];
            $pl_major_id = $medium_array[$indexMedium]['pl_major_id'];
        }
    } else {
        $errorList[] = array(
            "row" => $key,
            "text" => "Incorrect data."
        );
    }

    // if (!in_array($row[$Breakdown], array_column($breakdown_array, 'breakdown_name'))) {
    //     $errorList[] = array(
    //         "row" => $key,
    //         "text" => "Incorrect data."
    //     );
    // } else {
    //     $index_breakdown = array_search($row[$Breakdown], array_column($breakdown_array, 'breakdown_name'));
    //     if (!in_array($row[$Major], array_column($breakdown_array, 'breakdown_name'), $index_breakdown)) {
    //         $breakdown_id = $breakdown_array[$index]['breakdown_name'];
    //     }
    // }

    $indexBreakdown = array_search($row[$Breakdown], array_column($breakdown_array, 'breakdown_name'));
    if ($indexBreakdown !== false) {
        if (!in_array($row[$Breakdown], array_column($breakdown_array, 'breakdown_name'), $indexBreakdown)) {
            $errorList[] = array(
                "row" => $key,
                "text" => "incorrect Breakdown."
            );
        } else {
            $breakdown_id = $breakdown_array[$indexBreakdown]['breakdown_id'];
        }
    } else {
        $errorList[] = array(
            "row" => $key,
            "text" => "incorrect Breakdown."
        );
    }

    // if (!in_array($row[$CashFlow], array_column($cash_flow_array, 'cash_flow_name'))) {
    //     $errorList[] = array(
    //         "row" => $key,
    //         "text" => "Incorrect data."
    //     );
    // } else {
    //     $cash_flow_id = $cash_flow_array[$index]['cash_flow_id'];
    // }

    $indexCashFlow = array_search($row[$CashFlow], array_column($cash_flow_array, 'cash_flow_name'));
    if ($indexCashFlow !== false) {
        if (!in_array($row[$CashFlow], array_column($cash_flow_array, 'cash_flow_name'), $indexCashFlow)) {
            $errorList[] = array(
                "row" => $key,
                "text" => "incorrect CashFlow."
            );
        } else {
            $cash_flow_id = $cash_flow_array[$indexCashFlow]['cash_flow_id'];
        }
    } else {
        $errorList[] = array(
            "row" => $key,
            "text" => "incorrect CashFlow."
        );
    }


    if ($row[$IncreaseAndDecrease] != 1 && $row[$IncreaseAndDecrease] != -1 && $row[$IncreaseAndDecrease] != "None") {
        $errorList[] = array(
            "row" => $key,
            "text" => "Increase and Decrease in Cash Flow are Incorrect."
        );
    }

    if ($row[$IncreaseAndDecrease] == 1) {
        $cash_flow_type = "1";
    } else if ($row[$IncreaseAndDecrease] == -1) {
        $cash_flow_type = "2";
    } else if ($row[$IncreaseAndDecrease] == "None") {
        $cash_flow_type = "0";
    }

    $listOfInserted[] = array(
        "acc_code" => $row[$AccountingCode],
        "acc_name" => $row[$AccountingName],
        "pl_medium_id" => $pl_medium_id,
        "medium_name" => $row[$Major],
        "pl_major_id" => $pl_major_id,
        "major_name" => $row[$Medium],
        "breakdown_id" => $breakdown_id,
        "breakdown_name" => $row[$Breakdown],
        "cash_flow_id" => $cash_flow_id,
        "cash_flow_name" => $row[$CashFlow],
        "cash_flow_type" => $cash_flow_type
    );
}

if (count($errorList) > 0) {
    saveFileToServer($errorList);
    $arr['response'] = 0;
    mysqli_close($connection);
    echo json_encode($arr);
    die();
} else {

    if (count($listOfInserted) > 0) {
        foreach ($listOfInserted as $request) {
            $acc_code_post = mysqli_real_escape_string($connection, $request['acc_code']);
            $acc_name_post = mysqli_real_escape_string($connection, $request['acc_name']);
            $pl_medium_id_post = mysqli_real_escape_string($connection, $request['pl_medium_id']);
            $medium_name_post = mysqli_real_escape_string($connection, $request['medium_name']);
            $pl_major_id_post = mysqli_real_escape_string($connection, $request['pl_major_id']);
            $major_name_post = mysqli_real_escape_string($connection, $request['major_name']);
            $breakdown_id_post = mysqli_real_escape_string($connection, $request['breakdown_id']);
            $breakdown_name_post = mysqli_real_escape_string($connection, $request['breakdown_name']);
            $cash_flow_id_post = mysqli_real_escape_string($connection, $request['cash_flow_id']);
            $cash_flow_name_post = mysqli_real_escape_string($connection, $request['cash_flow_name']);
            $cash_flow_type_post = mysqli_real_escape_string($connection, $request['cash_flow_type']);

            $sql_check = "SELECT COUNT(*) AS count FROM tbl_branch_pl_account_code a WHERE a.acc_code = '$acc_code_post' AND a.branchId = '$branchId' ;";
            $rs_check = mysqli_query($connection, $sql_check) or die($connection->error);
            $row_check = mysqli_fetch_assoc($rs_check);

            if ($row_check['count'] >= 1) {
                $sql_update = "UPDATE tbl_branch_pl_account_code SET
                acc_name = '$acc_name_post',
                pl_medium_id = '$pl_medium_id_post',
                breakdown_id = '$breakdown_id_post',
                cash_flow_id = '$cash_flow_id_post',
                cash_flow_type = '$cash_flow_type_post'
                WHERE branchId = '$branchId' AND acc_code = '$acc_code_post' ";
                $res_update = mysqli_query($connection, $sql_update)  or die($connection->error);
                // echo "<pre>";
                // echo ($sql_update);
                // echo "</pre>";
            } else {
                $account_id_post = getRandomID(10, 'tbl_branch_pl_account_code', 'account_id');

                $sql_select = "SELECT IF(MAX(list_order) IS NULL, 0, MAX(list_order)) AS list_order FROM tbl_branch_pl_account_code WHERE branchId = '$branchId';";
                $res_select = mysqli_query($connection, $sql_select)  or die($connection->error);
                $row_select = mysqli_fetch_assoc($res_select);
                $list_order = $row_select['list_order'];
                $list_order_post += 1;

                $sql_insert = "INSERT INTO tbl_branch_pl_account_code SET
                account_id = '$account_id_post',
                branchId = '$branchId',
                acc_code = '$acc_code_post',
                acc_name = '$acc_name_post',
                pl_medium_id = '$pl_medium_id_post',
                breakdown_id = '$breakdown_id_post',
                cash_flow_id = '$cash_flow_id_post',
                cash_flow_type = '$cash_flow_type_post',
                list_order = '$list_order_post' ";
                $res_insert = mysqli_query($connection, $sql_insert)  or die($connection->error);
                // echo "<pre>";
            }
        }
        $arr['page'] = 1;
        $arr['response'] = 1;
    } else {
        $arr['response'] = 2;
    }

    mysqli_close($connection);
    echo json_encode($arr);
}

function saveFileToServer($errorList)
{

    $inputFile = $_FILES['excelFile']['tmp_name'];
    $inputFileType = PHPExcel_IOFactory::identify($inputFile);
    $objReader = PHPExcel_IOFactory::createReader($inputFileType);
    $objPHPExcel = $objReader->load($inputFile);
    $sheet = $objPHPExcel->setActiveSheetIndex(0);

    foreach ($errorList as $error) {

        $row = $error['row'] + 2;

        $sheet->getStyle('A' . $row . ':G' . $row)->applyFromArray(
            array(
                'fill' => array(
                    'type' => PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array('rgb' => 'FF0000')
                )
            )
        );

        $objPHPExcel->getActiveSheet()->setCellValue('H' . $row, $error['text']);
    }

    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
    $objWriter->save('ErrorFiles.xlsx');
}
