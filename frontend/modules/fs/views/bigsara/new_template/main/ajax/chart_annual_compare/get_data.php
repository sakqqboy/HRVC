<?php
include("../../../config/main_function.php");
$secure = "-%ekla!(m09)%1A7";
$connection = connectDB($secure);

function calculateDivide($numerator, $denominator)
{
    return $denominator == 0 ? 0 : $numerator / $denominator;
}

$branchId = mysqli_real_escape_string($connection, $_POST['branchId']);
$quarter = mysqli_real_escape_string($connection, $_POST['quarter']);
$startYear = mysqli_real_escape_string($connection, $_POST['start_year']);
$rate = mysqli_real_escape_string($connection, $_POST['rate']);

$list_breakdown = ["Sales", "Variable Expense", "Gross Profit (or Loss)", "Labor Cost", "Fixed Expense (Other)", "Fixed Expense", "Operating Profit (or Loss)", "Non-Operating Income", "Non-Operating Expense", "Ordinary Profit (or Loss)", "Break-Even Sales", "Marginal Profit Ratio"];
$list_breakdown_data = array();
for ($i = 0; $i < 12; $i++) {
    $list_breakdown_data[] = array(
        "list" => $i,
        "breakdown" => $list_breakdown[$i],
        "data" => array()
    );
}

$list_breakdown_Interest = array();
for ($i = 0; $i < 4; $i++) {
    $list_breakdown_Interest[] = array(
        "list" => $i,
        "data" => array()
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

for ($breakdown_id = 1; $breakdown_id <= 8; $breakdown_id++) {

    $list_data[] = array(
        "breakdown_id" => $breakdown_id,
        "data" => array()
    );

    foreach ($list_month as $rowMonth) {
        $monthName = $rowMonth['monthName'];
        $month = $rowMonth['month'];
        $year = $rowMonth['year'];
        $last_year = $year - 1;

        $sql_last_year = "SELECT 
        IF(SUM(a.actual_amount), SUM(a.actual_amount), 0) AS actual_amount,
        IF(SUM(a.target_amount), SUM(a.target_amount), 0) AS target_amount,
        IF(SUM(a.next_target_amount), SUM(a.next_target_amount), 0) AS next_target_amount
        FROM tbl_branch_pl_data a 
        LEFT JOIN tbl_branch_pl_account_code b ON a.account_id = b.account_id 
        WHERE b.branchId = '$branchId' AND b.breakdown_id = '$breakdown_id' AND a.month = '$month' AND a.year = '$last_year' 
        ORDER BY a.month ASC,a.year ASC";
        $res_last_year = mysqli_query($connection, $sql_last_year) or die($connection->error);
        $row_last_year = mysqli_fetch_assoc($res_last_year);
        $last_act = ($row_last_year['actual_amount'] == "" ? 0 : $row_last_year['actual_amount']);
        $accum_last_act += $last_act;

        $sql_data = "SELECT 
        IF(SUM(a.actual_amount), SUM(a.actual_amount), 0) AS actual_amount,
        IF(SUM(a.target_amount), SUM(a.target_amount), 0) AS target_amount,
        IF(SUM(a.next_target_amount), SUM(a.next_target_amount), 0) AS next_target_amount
        FROM tbl_branch_pl_data a 
        LEFT JOIN tbl_branch_pl_account_code b ON a.account_id = b.account_id 
        WHERE b.branchId = '$branchId' AND b.breakdown_id = '$breakdown_id' AND a.month = '$month' AND a.year = '$year' 
        ORDER BY a.month ASC,a.year ASC";

        $res_data = mysqli_query($connection, $sql_data) or die($connection->error);
        $row_data = mysqli_fetch_assoc($res_data);

        $actual_amount = ($row_data['actual_amount'] == "" ? 0 : $row_data['actual_amount']);
        $target_amount = ($row_data['target_amount'] == "" ? 0 : $row_data['target_amount']);
        $next_target_amount = ($row_data['next_target_amount'] == "" ? 0 : $row_data['next_target_amount']);

        $accum_act += $actual_amount;
        $accum_tar += $target_amount;
        $accum_next_tar += $next_target_amount;


        $list_data[count($list_data) - 1]['data'][] = array(
            "list" => $rowMonth['list'],
            "breakdown_id" => $breakdown_id,
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
            "accum_next_tar" => $accum_next_tar
        );
    }

    $accum_last_act = 0.00;
    $accum_act = 0.00;
    $accum_tar = 0.00;
    $accum_next_tar = 0.00;
}

foreach ($list_data as $data) {

    if ($data['breakdown_id'] == 1) {
        $list_breakdown_data[0]['data'] = $data['data'];
    } else if ($data['breakdown_id'] == 2) {
        $list_breakdown_data[1]['data'] = $data['data'];
    } else if ($data['breakdown_id'] == 3) {
        $list_breakdown_data[3]['data'] = $data['data'];
    } else if ($data['breakdown_id'] == 4) {
        $list_breakdown_data[4]['data'] = $data['data'];
    } elseif ($data['breakdown_id'] == 5) {
        $list_breakdown_Interest[0]['data'] = $data['data'];
    } else if ($data['breakdown_id'] == 6) {
        $list_breakdown_Interest[1]['data'] = $data['data'];
    } elseif ($data['breakdown_id'] == 7) {
        $list_breakdown_Interest[2]['data'] = $data['data'];
    } else if ($data['breakdown_id'] == 8) {
        $list_breakdown_Interest[3]['data'] = $data['data'];
    }
}

for ($i = 0; $i <= count($list_month) - 1; $i++) {
    $last_act = floatval($list_breakdown_data[0]['data'][$i]['last_actual_amount']) - floatval($list_breakdown_data[1]['data'][$i]['last_actual_amount']);
    $actual_amount = floatval($list_breakdown_data[0]['data'][$i]['actual_amount']) - floatval($list_breakdown_data[1]['data'][$i]['actual_amount']);
    $target_amount = floatval($list_breakdown_data[0]['data'][$i]['target_amount']) - floatval($list_breakdown_data[1]['data'][$i]['target_amount']);
    $next_target_amount = floatval($list_breakdown_data[0]['data'][$i]['next_target_amount']) - floatval($list_breakdown_data[1]['data'][$i]['next_target_amount']);
    $accum_last_act = floatval($list_breakdown_data[0]['data'][$i]['accum_last_act']) - floatval($list_breakdown_data[1]['data'][$i]['accum_last_act']);
    $accum_act = floatval($list_breakdown_data[0]['data'][$i]['accum_act']) - floatval($list_breakdown_data[1]['data'][$i]['accum_act']);
    $accum_tar = floatval($list_breakdown_data[0]['data'][$i]['accum_tar']) - floatval($list_breakdown_data[1]['data'][$i]['accum_tar']);
    $accum_next_tar = floatval($list_breakdown_data[0]['data'][$i]['accum_next_tar']) - floatval($list_breakdown_data[1]['data'][$i]['accum_next_tar']);

    $list_breakdown_data[2]['data'][] = array(
        "list" => $list_breakdown_data[0]['data'][$i]['list'],
        "monthName" => $list_breakdown_data[0]['data'][$i]['monthName'],
        "month" => $list_breakdown_data[0]['data'][$i]['month'],
        "year" => $list_breakdown_data[0]['data'][$i]['year'],
        "last_actual_amount" => $last_act,
        "actual_amount" => $actual_amount,
        "target_amount" => $target_amount,
        "next_target_amount" => $next_target_amount,
        "accum_last_act" => $accum_last_act,
        "accum_act" => $accum_act,
        "accum_tar" => $accum_tar,
        "accum_next_tar" => $accum_next_tar
    );

    $last_act = floatval($list_breakdown_data[3]['data'][$i]['last_actual_amount']) + floatval($list_breakdown_data[4]['data'][$i]['last_actual_amount']);
    $actual_amount = floatval($list_breakdown_data[3]['data'][$i]['actual_amount']) + floatval($list_breakdown_data[4]['data'][$i]['actual_amount']);
    $target_amount = floatval($list_breakdown_data[3]['data'][$i]['target_amount']) + floatval($list_breakdown_data[4]['data'][$i]['target_amount']);
    $next_target_amount = floatval($list_breakdown_data[3]['data'][$i]['next_target_amount']) + floatval($list_breakdown_data[4]['data'][$i]['next_target_amount']);
    $accum_last_act = floatval($list_breakdown_data[3]['data'][$i]['accum_last_act']) + floatval($list_breakdown_data[4]['data'][$i]['accum_last_act']);
    $accum_act = floatval($list_breakdown_data[3]['data'][$i]['accum_act']) + floatval($list_breakdown_data[4]['data'][$i]['accum_act']);
    $accum_tar = floatval($list_breakdown_data[3]['data'][$i]['accum_tar']) + floatval($list_breakdown_data[4]['data'][$i]['accum_tar']);
    $accum_next_tar = floatval($list_breakdown_data[3]['data'][$i]['accum_next_tar']) + floatval($list_breakdown_data[4]['data'][$i]['accum_next_tar']);

    $list_breakdown_data[5]['data'][] = array(
        "list" => $list_breakdown_data[3]['data'][$i]['list'],
        "monthName" => $list_breakdown_data[3]['data'][$i]['monthName'],
        "month" => $list_breakdown_data[3]['data'][$i]['month'],
        "year" => $list_breakdown_data[3]['data'][$i]['year'],
        "last_actual_amount" => $last_act,
        "actual_amount" => $actual_amount,
        "target_amount" => $target_amount,
        "next_target_amount" => $next_target_amount,
        "accum_last_act" => $accum_last_act,
        "accum_act" => $accum_act,
        "accum_tar" => $accum_tar,
        "accum_next_tar" => $accum_next_tar
    );

    //Non-Operating Income + Interest and Devident Income
    $last_act = floatval($list_breakdown_Interest[0]['data'][$i]['last_actual_amount']) + floatval($list_breakdown_Interest[2]['data'][$i]['last_actual_amount']);
    $actual_amount = floatval($list_breakdown_Interest[0]['data'][$i]['actual_amount']) + floatval($list_breakdown_Interest[2]['data'][$i]['actual_amount']);
    $target_amount = floatval($list_breakdown_Interest[0]['data'][$i]['target_amount']) + floatval($list_breakdown_Interest[2]['data'][$i]['target_amount']);
    $next_target_amount = floatval($list_breakdown_Interest[0]['data'][$i]['next_target_amount']) + floatval($list_breakdown_Interest[2]['data'][$i]['next_target_amount']);
    $accum_last_act = floatval($list_breakdown_Interest[0]['data'][$i]['accum_last_act']) + floatval($list_breakdown_Interest[2]['data'][$i]['accum_last_act']);
    $accum_act = floatval($list_breakdown_Interest[0]['data'][$i]['accum_act']) + floatval($list_breakdown_Interest[2]['data'][$i]['accum_act']);
    $accum_tar = floatval($list_breakdown_Interest[0]['data'][$i]['accum_tar']) + floatval($list_breakdown_Interest[2]['data'][$i]['accum_tar']);
    $accum_next_tar = floatval($list_breakdown_Interest[0]['data'][$i]['accum_next_tar']) + floatval($list_breakdown_Interest[2]['data'][$i]['accum_next_tar']);

    $list_breakdown_data[7]['data'][] = array(
        "list" => $list_breakdown_Interest[0]['data'][$i]['list'],
        "breakdown_id" => $list_breakdown_Interest[0]['data'][$i]['breakdown_id'],
        "monthName" => $list_breakdown_Interest[0]['data'][$i]['monthName'],
        "month" => $list_breakdown_Interest[0]['data'][$i]['month'],
        "year" => $list_breakdown_Interest[0]['data'][$i]['year'],
        "last_actual_amount" => $last_act,
        "actual_amount" => $actual_amount,
        "target_amount" => $target_amount,
        "next_target_amount" => $next_target_amount,
        "accum_last_act" => $accum_last_act,
        "accum_act" => $accum_act,
        "accum_tar" => $accum_tar,
        "accum_next_tar" => $accum_next_tar
    );

    //Non-Operating Expense + Interest Expense
    $last_act = floatval($list_breakdown_Interest[1]['data'][$i]['last_actual_amount']) + floatval($list_breakdown_Interest[3]['data'][$i]['last_actual_amount']);
    $actual_amount = floatval($list_breakdown_Interest[1]['data'][$i]['actual_amount']) + floatval($list_breakdown_Interest[3]['data'][$i]['actual_amount']);
    $target_amount = floatval($list_breakdown_Interest[1]['data'][$i]['target_amount']) + floatval($list_breakdown_Interest[3]['data'][$i]['target_amount']);
    $next_target_amount = floatval($list_breakdown_Interest[1]['data'][$i]['next_target_amount']) + floatval($list_breakdown_Interest[3]['data'][$i]['next_target_amount']);
    $accum_last_act = floatval($list_breakdown_Interest[1]['data'][$i]['accum_last_act']) + floatval($list_breakdown_Interest[3]['data'][$i]['accum_last_act']);
    $accum_act = floatval($list_breakdown_Interest[1]['data'][$i]['accum_act']) + floatval($list_breakdown_Interest[3]['data'][$i]['accum_act']);
    $accum_tar = floatval($list_breakdown_Interest[1]['data'][$i]['accum_tar']) + floatval($list_breakdown_Interest[3]['data'][$i]['accum_tar']);
    $accum_next_tar = floatval($list_breakdown_Interest[1]['data'][$i]['accum_next_tar']) + floatval($list_breakdown_Interest[3]['data'][$i]['accum_next_tar']);

    $list_breakdown_data[8]['data'][] = array(
        "list" => $list_breakdown_Interest[1]['data'][$i]['list'],
        "breakdown_id" => $list_breakdown_Interest[1]['data'][$i]['breakdown_id'],
        "monthName" => $list_breakdown_Interest[1]['data'][$i]['monthName'],
        "month" => $list_breakdown_Interest[1]['data'][$i]['month'],
        "year" => $list_breakdown_Interest[1]['data'][$i]['year'],
        "last_actual_amount" => $last_act,
        "actual_amount" => $actual_amount,
        "target_amount" => $target_amount,
        "next_target_amount" => $next_target_amount,
        "accum_last_act" => $accum_last_act,
        "accum_act" => $accum_act,
        "accum_tar" => $accum_tar,
        "accum_next_tar" => $accum_next_tar
    );
}

for ($i = 0; $i <= count($list_month) - 1; $i++) {
    $last_act = floatval($list_breakdown_data[2]['data'][$i]['last_actual_amount']) - floatval($list_breakdown_data[5]['data'][$i]['last_actual_amount']);
    $actual_amount = floatval($list_breakdown_data[2]['data'][$i]['actual_amount']) - floatval($list_breakdown_data[5]['data'][$i]['actual_amount']);
    $target_amount = floatval($list_breakdown_data[2]['data'][$i]['target_amount']) - floatval($list_breakdown_data[5]['data'][$i]['target_amount']);
    $next_target_amount = floatval($list_breakdown_data[2]['data'][$i]['next_target_amount']) - floatval($list_breakdown_data[5]['data'][$i]['next_target_amount']);
    $accum_last_act = floatval($list_breakdown_data[2]['data'][$i]['accum_last_act']) - floatval($list_breakdown_data[5]['data'][$i]['accum_last_act']);
    $accum_act = floatval($list_breakdown_data[2]['data'][$i]['accum_act']) - floatval($list_breakdown_data[5]['data'][$i]['accum_act']);
    $accum_tar = floatval($list_breakdown_data[2]['data'][$i]['accum_tar']) - floatval($list_breakdown_data[5]['data'][$i]['accum_tar']);
    $accum_next_tar = floatval($list_breakdown_data[2]['data'][$i]['accum_next_tar']) - floatval($list_breakdown_data[5]['data'][$i]['accum_next_tar']);

    $list_breakdown_data[6]['data'][] = array(
        "list" => $list_breakdown_data[2]['data'][$i]['list'],
        "monthName" => $list_breakdown_data[2]['data'][$i]['monthName'],
        "month" => $list_breakdown_data[2]['data'][$i]['month'],
        "year" => $list_breakdown_data[2]['data'][$i]['year'],
        "last_actual_amount" => $last_act,
        "actual_amount" => $actual_amount,
        "target_amount" => $target_amount,
        "next_target_amount" => $next_target_amount,
        "accum_last_act" => $accum_last_act,
        "accum_act" => $accum_act,
        "accum_tar" => $accum_tar,
        "accum_next_tar" => $accum_next_tar
    );
}

for ($i = 0; $i <= count($list_month) - 1; $i++) {

    $last_act = (floatval($list_breakdown_data[6]['data'][$i]['last_actual_amount']) + floatval($list_breakdown_data[7]['data'][$i]['last_actual_amount'])) - floatval($list_breakdown_data[8]['data'][$i]['last_actual_amount']);
    $actual_amount = (floatval($list_breakdown_data[6]['data'][$i]['actual_amount']) + floatval($list_breakdown_data[7]['data'][$i]['actual_amount'])) - floatval($list_breakdown_data[8]['data'][$i]['actual_amount']);
    $target_amount = (floatval($list_breakdown_data[6]['data'][$i]['target_amount']) + floatval($list_breakdown_data[7]['data'][$i]['target_amount'])) - floatval($list_breakdown_data[8]['data'][$i]['target_amount']);
    $next_target_amount = (floatval($list_breakdown_data[6]['data'][$i]['next_target_amount']) + floatval($list_breakdown_data[7]['data'][$i]['next_target_amount'])) - floatval($list_breakdown_data[8]['data'][$i]['next_target_amount']);
    $accum_last_act = (floatval($list_breakdown_data[6]['data'][$i]['accum_last_act']) + floatval($list_breakdown_data[7]['data'][$i]['accum_last_act'])) - floatval($list_breakdown_data[8]['data'][$i]['accum_last_act']);
    $accum_act = (floatval($list_breakdown_data[6]['data'][$i]['accum_act']) + floatval($list_breakdown_data[7]['data'][$i]['accum_act'])) - floatval($list_breakdown_data[8]['data'][$i]['accum_act']);
    $accum_tar = (floatval($list_breakdown_data[6]['data'][$i]['accum_tar']) + floatval($list_breakdown_data[7]['data'][$i]['accum_tar'])) - floatval($list_breakdown_data[8]['data'][$i]['accum_tar']);
    $accum_next_tar = (floatval($list_breakdown_data[6]['data'][$i]['accum_next_tar']) + floatval($list_breakdown_data[7]['data'][$i]['accum_next_tar'])) - floatval($list_breakdown_data[8]['data'][$i]['accum_next_tar']);

    $list_breakdown_data[9]['data'][] = array(
        "list" => $list_breakdown_data[6]['data'][$i]['list'],
        "monthName" => $list_breakdown_data[6]['data'][$i]['monthName'],
        "month" => $list_breakdown_data[6]['data'][$i]['month'],
        "year" => $list_breakdown_data[6]['data'][$i]['year'],
        "last_actual_amount" => $last_act,
        "actual_amount" => $actual_amount,
        "target_amount" => $target_amount,
        "next_target_amount" => $next_target_amount,
        "accum_last_act" => $accum_last_act,
        "accum_act" => $accum_act,
        "accum_tar" => $accum_tar,
        "accum_next_tar" => $accum_next_tar
    );
}


for ($i = 0; $i <= count($list_month) - 1; $i++) {
    $last_act = calculateDivide(floatval($list_breakdown_data[2]['data'][$i]['last_actual_amount']), floatval($list_breakdown_data[0]['data'][$i]['last_actual_amount'])) * 100;
    $actual_amount = calculateDivide(floatval($list_breakdown_data[2]['data'][$i]['actual_amount']), floatval($list_breakdown_data[0]['data'][$i]['actual_amount'])) * 100;
    $target_amount = calculateDivide(floatval($list_breakdown_data[2]['data'][$i]['target_amount']), floatval($list_breakdown_data[0]['data'][$i]['target_amount'])) * 100;
    $next_target_amount = calculateDivide(floatval($list_breakdown_data[2]['data'][$i]['next_target_amount']), floatval($list_breakdown_data[0]['data'][$i]['next_target_amount'])) * 100;
    $accum_last_act = calculateDivide(floatval($list_breakdown_data[2]['data'][$i]['accum_last_act']), floatval($list_breakdown_data[0]['data'][$i]['accum_last_act'])) * 100;
    $accum_act = calculateDivide(floatval($list_breakdown_data[2]['data'][$i]['accum_act']), floatval($list_breakdown_data[0]['data'][$i]['accum_act'])) * 100;
    $accum_tar = calculateDivide(floatval($list_breakdown_data[2]['data'][$i]['accum_tar']), floatval($list_breakdown_data[0]['data'][$i]['accum_tar'])) * 100;
    $accum_next_tar = calculateDivide(floatval($list_breakdown_data[2]['data'][$i]['accum_next_tar']), floatval($list_breakdown_data[0]['data'][$i]['accum_next_tar'])) * 100;

    $list_breakdown_data[11]['data'][] = array(
        "list" => $list_breakdown_data[2]['data'][$i]['list'],
        "monthName" => $list_breakdown_data[2]['data'][$i]['monthName'],
        "month" => $list_breakdown_data[2]['data'][$i]['month'],
        "year" => $list_breakdown_data[2]['data'][$i]['year'],
        "last_actual_amount" => $last_act,
        "actual_amount" => $actual_amount,
        "target_amount" => $target_amount,
        "next_target_amount" => $next_target_amount,
        "accum_last_act" => $accum_last_act,
        "accum_act" => $accum_act,
        "accum_tar" => $accum_tar,
        "accum_next_tar" => $accum_next_tar
    );
}

for ($i = 0; $i <= count($list_month) - 1; $i++) {
    $last_act = calculateDivide(floatval($list_breakdown_data[5]['data'][$i]['last_actual_amount']), (calculateDivide(floatval($list_breakdown_data[2]['data'][$i]['last_actual_amount']), floatval($list_breakdown_data[0]['data'][$i]['last_actual_amount']))));
    $actual_amount = calculateDivide(floatval($list_breakdown_data[5]['data'][$i]['actual_amount']), (calculateDivide(floatval($list_breakdown_data[2]['data'][$i]['actual_amount']), floatval($list_breakdown_data[0]['data'][$i]['actual_amount']))));
    $target_amount = calculateDivide(floatval($list_breakdown_data[5]['data'][$i]['target_amount']), (calculateDivide(floatval($list_breakdown_data[2]['data'][$i]['target_amount']), floatval($list_breakdown_data[0]['data'][$i]['target_amount']))));
    $next_target_amount = calculateDivide(floatval($list_breakdown_data[5]['data'][$i]['next_target_amount']), (calculateDivide(floatval($list_breakdown_data[2]['data'][$i]['next_target_amount']), floatval($list_breakdown_data[0]['data'][$i]['next_target_amount']))));
    $accum_last_act = calculateDivide(floatval($list_breakdown_data[5]['data'][$i]['accum_last_act']), (calculateDivide(floatval($list_breakdown_data[2]['data'][$i]['accum_last_act']), floatval($list_breakdown_data[0]['data'][$i]['accum_last_act']))));
    $accum_act = calculateDivide(floatval($list_breakdown_data[5]['data'][$i]['accum_act']), (calculateDivide(floatval($list_breakdown_data[2]['data'][$i]['accum_act']), floatval($list_breakdown_data[0]['data'][$i]['accum_act']))));
    $accum_tar = calculateDivide(floatval($list_breakdown_data[5]['data'][$i]['accum_tar']), (calculateDivide(floatval($list_breakdown_data[2]['data'][$i]['accum_tar']), floatval($list_breakdown_data[0]['data'][$i]['accum_tar']))));
    $accum_next_tar = calculateDivide(floatval($list_breakdown_data[5]['data'][$i]['accum_next_tar']), (calculateDivide(floatval($list_breakdown_data[2]['data'][$i]['accum_next_tar']), floatval($list_breakdown_data[0]['data'][$i]['accum_next_tar']))));

    $list_breakdown_data[10]['data'][] = array(
        "list" => $list_breakdown_data[5]['data'][$i]['list'],
        "monthName" => $list_breakdown_data[5]['data'][$i]['monthName'],
        "month" => $list_breakdown_data[5]['data'][$i]['month'],
        "year" => $list_breakdown_data[5]['data'][$i]['year'],
        "last_actual_amount" => $last_act,
        "actual_amount" => $actual_amount,
        "target_amount" => $target_amount,
        "next_target_amount" => $next_target_amount,
        "accum_last_act" => $accum_last_act,
        "accum_act" => $accum_act,
        "accum_tar" => $accum_tar,
        "accum_next_tar" => $accum_next_tar
    );
}


///head
$listHead = array();
for ($i = 0; $i < 12; $i++) {
    $listHead[] = array(
        "list" => $i,
        "breakdown" => $list_breakdown[$i],
        "data" => array()
    );
}

$listHead[0]['data'][] = array(
    "breakdown_id" => $list_breakdown_data[0]['data'][count($list_month) - 1]['breakdown_id'],
    "last_actual_amount" => $list_breakdown_data[0]['data'][count($list_month) - 1]['last_actual_amount'],
    "actual_amount" => $list_breakdown_data[0]['data'][count($list_month) - 1]['actual_amount'],
    "target_amount" => $list_breakdown_data[0]['data'][count($list_month) - 1]['target_amount'],
    "next_target_amount" => $list_breakdown_data[0]['data'][count($list_month) - 1]['next_target_amount'],
    "accum_last_act" => $list_breakdown_data[0]['data'][count($list_month) - 1]['accum_last_act'],
    "accum_act" => $list_breakdown_data[0]['data'][count($list_month) - 1]['accum_act'],
    "accum_tar" => $list_breakdown_data[0]['data'][count($list_month) - 1]['accum_tar'],
    "accum_next_tar" => $list_breakdown_data[0]['data'][count($list_month) - 1]['accum_next_tar'],
    "percent_accum_last_act" => (calculateDivide(floatval($list_breakdown_data[0]['data'][count($list_month) - 1]['accum_last_act']), floatval($list_breakdown_data[0]['data'][count($list_month) - 1]['accum_last_act']))) * 100,
    "percent_accum_act" => (calculateDivide(floatval($list_breakdown_data[0]['data'][count($list_month) - 1]['accum_act']), floatval($list_breakdown_data[0]['data'][count($list_month) - 1]['accum_tar']))) * 100,
    "percent_accum_tar" => (calculateDivide(floatval($list_breakdown_data[0]['data'][count($list_month) - 1]['accum_tar']), floatval($list_breakdown_data[0]['data'][count($list_month) - 1]['accum_tar']))) * 100,
    "percent_accum_next_tar" => (calculateDivide(floatval($list_breakdown_data[0]['data'][count($list_month) - 1]['accum_next_tar']), floatval($list_breakdown_data[0]['data'][count($list_month) - 1]['accum_next_tar']))) * 100
);

for ($i = 1; $i < 11; $i++) {
    $listHead[$i]['data'][] = array(
        "breakdown_id" => $list_breakdown_data[$i]['data'][count($list_month) - 1]['breakdown_id'],
        "last_actual_amount" => $list_breakdown_data[$i]['data'][count($list_month) - 1]['last_actual_amount'],
        "actual_amount" => $list_breakdown_data[$i]['data'][count($list_month) - 1]['actual_amount'],
        "target_amount" => $list_breakdown_data[$i]['data'][count($list_month) - 1]['target_amount'],
        "next_target_amount" => $list_breakdown_data[$i]['data'][count($list_month) - 1]['next_target_amount'],
        "accum_last_act" => $list_breakdown_data[$i]['data'][count($list_month) - 1]['accum_last_act'],
        "accum_act" => $list_breakdown_data[$i]['data'][count($list_month) - 1]['accum_act'],
        "accum_tar" => $list_breakdown_data[$i]['data'][count($list_month) - 1]['accum_tar'],
        "accum_next_tar" => $list_breakdown_data[$i]['data'][count($list_month) - 1]['accum_next_tar'],
        "percent_accum_last_act" => (calculateDivide(floatval($list_breakdown_data[$i]['data'][count($list_month) - 1]['accum_last_act']), floatval($list_breakdown_data[0]['data'][count($list_month) - 1]['accum_last_act']))) * 100,
        "percent_accum_act" => (calculateDivide(floatval($list_breakdown_data[$i]['data'][count($list_month) - 1]['accum_act']), floatval($list_breakdown_data[0]['data'][count($list_month) - 1]['accum_tar']))) * 100,
        "percent_accum_tar" => (calculateDivide(floatval($list_breakdown_data[$i]['data'][count($list_month) - 1]['accum_tar']), floatval($list_breakdown_data[0]['data'][count($list_month) - 1]['accum_tar']))) * 100,
        "percent_accum_next_tar" => (calculateDivide(floatval($list_breakdown_data[$i]['data'][count($list_month) - 1]['accum_next_tar']), floatval($list_breakdown_data[0]['data'][count($list_month) - 1]['accum_next_tar']))) * 100
    );
}

$listHead[11]['data'][] = array(
    "breakdown_id" => $list_breakdown_data[11]['data'][count($list_month) - 1]['breakdown_id'],
    "last_actual_amount" => $list_breakdown_data[11]['data'][count($list_month) - 1]['last_actual_amount'],
    "actual_amount" => $list_breakdown_data[11]['data'][count($list_month) - 1]['actual_amount'],
    "target_amount" => $list_breakdown_data[11]['data'][count($list_month) - 1]['target_amount'],
    "next_target_amount" => $list_breakdown_data[11]['data'][count($list_month) - 1]['next_target_amount'],
    "percent_accum_last_act" => $list_breakdown_data[11]['data'][count($list_month) - 1]['accum_last_act'],
    "percent_accum_act" => $list_breakdown_data[11]['data'][count($list_month) - 1]['accum_act'],
    "percent_accum_tar" => $list_breakdown_data[11]['data'][count($list_month) - 1]['accum_tar'],
    "percent_accum_next_tar" => $list_breakdown_data[11]['data'][count($list_month) - 1]['accum_next_tar'],
    // "percent_accum_last_act" => (calculateDivide(floatval($list_breakdown_data[0]['data'][count($list_month) - 1]['accum_last_act']), floatval($list_breakdown_data[0]['data'][count($list_month) - 1]['accum_last_act']))) * 100,
    // "percent_accum_act" => (calculateDivide(floatval($list_breakdown_data[0]['data'][count($list_month) - 1]['accum_act']), floatval($list_breakdown_data[0]['data'][count($list_month) - 1]['accum_tar']))) * 100,
    // "percent_accum_tar" => (calculateDivide(floatval($list_breakdown_data[0]['data'][count($list_month) - 1]['accum_tar']), floatval($list_breakdown_data[0]['data'][count($list_month) - 1]['accum_tar']))) * 100,
    // "percent_accum_next_tar" => (calculateDivide(floatval($list_breakdown_data[0]['data'][count($list_month) - 1]['accum_next_tar']), floatval($list_breakdown_data[0]['data'][count($list_month) - 1]['accum_next_tar']))) * 100
);
?>

<div class="row mt-10 pl-10">
    <div class="col-1 text-center" style="background-color: white;">
        <div class="col-12 text-center mt-15 mb-10">
            <img src="../images/icons/Dark/48px/Accumulated.png" class="icons_Monthly">
        </div>
        <div class="col-12 mt-5">
            <span class="badge bgAAR-1">AAR</span>
        </div>
        <div class="col-12 mt-5">
            <span class="badge bgAAR1_green">AAR</span>
        </div>
        <div class="col-12 mt-5">
            <span class="badge bgART1warning">ATR</span>
        </div>
        <div class="col-12 mt-5">
            <span class="badge bgATRworm">ATR</span>
        </div>
    </div>
    <div class="col-11">
        <div class="row" id="show_data">
            <?php
            for ($i = 0; $i < 4; $i++) {
                foreach ($listHead[$i]['data'] as $row_detail) {
            ?>
                    <div class="mr-10 pr-0" style="width: 24.14%;">
                        <div class="shadow p-2 bg-body rounded">
                            <div class="col-12 badge bg light-shadow text-dark text-start">
                                <?php echo $listHead[$i]['breakdown']; ?>
                            </div>
                            <div class="row mt-10">
                                <div class="row">
                                    <div class="col-lg-3 text-secondary font-size-12">
                                        <?php echo $startYear - 1; ?>
                                    </div>
                                    <div class="col-lg-7 pt-5 mt-2 pr-0 pl-0">
                                        <div class="progress progress-thin" style="height: 8px;">
                                            <div class="progress-bar bg-bar-background-1" role="progressbar" style="width: <?php echo round($row_detail['percent_accum_last_act']); ?>%;" aria-valuenow="<?php echo round($row_detail['percent_accum_last_act']); ?>" aria-valuemin="0" aria-valuemax="300"></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 text-secondary font-size-12 text-end pr-0">
                                        <?php echo round($row_detail['percent_accum_last_act']); ?>%
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 text-secondary font-size-12">
                                        <?php echo $startYear; ?>
                                    </div>
                                    <div class="col-lg-7  mt-2 pr-0 pl-0">
                                        <div class="progress progress-thin" style="height: 8px;">
                                            <div class="progress-bar bg-bar-background-2" role="progressbar" style="width: <?php echo round($row_detail['percent_accum_act']); ?>%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="300"></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 text-secondary font-size-12 text-end pr-0">
                                        <?php echo round($row_detail['percent_accum_act']); ?>%
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 font-size-12">
                                        <?php echo $startYear; ?> <span class="badge bdg-2580D3">C</span>
                                    </div>
                                    <div class="col-lg-7  mt-2 pr-0 pl-0">
                                        <div class="progress progress-thin" style="height: 8px;">
                                            <div class="progress-bar bg-bar-background-3" role="progressbar" style="width: <?php echo round($row_detail['percent_accum_tar']); ?>%" aria-valuenow="<?php echo round($row_detail['percent_accum_tar']); ?>" aria-valuemin="0" aria-valuemax="300"></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 font-size-12 text-end pr-0">
                                        <?php echo round($row_detail['percent_accum_tar']); ?>%
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 text-secondary font-size-12">
                                        <?php echo $startYear + 1; ?>
                                    </div>
                                    <div class="col-lg-7  mt-2 pr-0 pl-0">
                                        <div class="progress progress-thin" style="height: 8px;">
                                            <div class="progress-bar bg-bar-background-4" role="progressbar" style="width: <?php echo round($row_detail['percent_accum_next_tar']); ?>%" aria-valuenow="<?php echo round($row_detail['percent_accum_next_tar']); ?>" aria-valuemin="0" aria-valuemax="300"></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 text-secondary font-size-12 text-end pr-0">
                                        <?php echo round($row_detail['percent_accum_next_tar']); ?>%
                                    </div>
                                </div>
                            </div>
                            <div class="border-bottom"></div>
                        </div>
                    </div>
            <?php
                }
            }
            ?>
        </div>
    </div>
</div>

<div class="row mt-10 pl-10">
    <div class="col-1 text-center" style="background-color: white;">
        <div class="col-12 text-center mt-15 mb-10">
            <img src="../images/icons/Dark/48px/Accumulated.png" class="icons_Monthly">
        </div>
        <div class="col-12 mt-5">
            <span class="badge bgAAR-1">AAR</span>
        </div>
        <div class="col-12 mt-5">
            <span class="badge bgAAR1_green">AAR</span>
        </div>
        <div class="col-12 mt-5">
            <span class="badge bgART1warning">ATR</span>
        </div>
        <div class="col-12 mt-5">
            <span class="badge bgATRworm">ATR</span>
        </div>
    </div>
    <div class="col-11">
        <div class="row" id="show_data">
            <?php
            for ($i = 4; $i < 8; $i++) {
                foreach ($listHead[$i]['data'] as $row_detail) {
            ?>
                    <div class="mr-10 pr-0" style="width: 24.14%;">
                        <div class="shadow p-2 bg-body rounded">
                            <div class="col-12 badge bg light-shadow text-dark text-start">
                                <?php echo $listHead[$i]['breakdown']; ?>
                            </div>
                            <div class="row mt-10">
                                <div class="row">
                                    <div class="col-lg-3 text-secondary font-size-12">
                                        <?php echo $startYear - 1; ?>
                                    </div>
                                    <div class="col-lg-7 pt-5 mt-2 pr-0 pl-0">
                                        <div class="progress progress-thin" style="height: 8px;">
                                            <div class="progress-bar bg-bar-background-1" role="progressbar" style="width: <?php echo round($row_detail['percent_accum_last_act']); ?>%;" aria-valuenow="<?php echo round($row_detail['percent_accum_last_act']); ?>" aria-valuemin="0" aria-valuemax="300"></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 text-secondary font-size-12 text-end pr-0">
                                        <?php echo round($row_detail['percent_accum_last_act']); ?>%
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 text-secondary font-size-12">
                                        <?php echo $startYear; ?>
                                    </div>
                                    <div class="col-lg-7  mt-2 pr-0 pl-0">
                                        <div class="progress progress-thin" style="height: 8px;">
                                            <div class="progress-bar bg-bar-background-2" role="progressbar" style="width: <?php echo round($row_detail['percent_accum_act']); ?>%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="300"></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 text-secondary font-size-12 text-end pr-0">
                                        <?php echo round($row_detail['percent_accum_act']); ?>%
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 font-size-12">
                                        <?php echo $startYear; ?> <span class="badge bdg-2580D3">C</span>
                                    </div>
                                    <div class="col-lg-7  mt-2 pr-0 pl-0">
                                        <div class="progress progress-thin" style="height: 8px;">
                                            <div class="progress-bar bg-bar-background-3" role="progressbar" style="width: <?php echo round($row_detail['percent_accum_tar']); ?>%" aria-valuenow="<?php echo round($row_detail['percent_accum_tar']); ?>" aria-valuemin="0" aria-valuemax="300"></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 font-size-12 text-end pr-0">
                                        <?php echo round($row_detail['percent_accum_tar']); ?>%
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 text-secondary font-size-12">
                                        <?php echo $startYear + 1; ?>
                                    </div>
                                    <div class="col-lg-7  mt-2 pr-0 pl-0">
                                        <div class="progress progress-thin" style="height: 8px;">
                                            <div class="progress-bar bg-bar-background-4" role="progressbar" style="width: <?php echo round($row_detail['percent_accum_next_tar']); ?>%" aria-valuenow="<?php echo round($row_detail['percent_accum_next_tar']); ?>" aria-valuemin="0" aria-valuemax="300"></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 text-secondary font-size-12 text-end pr-0">
                                        <?php echo round($row_detail['percent_accum_next_tar']); ?>%
                                    </div>
                                </div>
                            </div>
                            <div class="border-bottom"></div>
                        </div>
                    </div>
            <?php
                }
            }
            ?>
        </div>
    </div>
</div>

<div class="row mt-10 pl-10">
    <div class="col-1 text-center" style="background-color: white;">
        <div class="col-12 text-center mt-15 mb-10">
            <img src="../images/icons/Dark/48px/Accumulated.png" class="icons_Monthly">
        </div>
        <div class="col-12 mt-5">
            <span class="badge bgAAR-1">AAR</span>
        </div>
        <div class="col-12 mt-5">
            <span class="badge bgAAR1_green">AAR</span>
        </div>
        <div class="col-12 mt-5">
            <span class="badge bgART1warning">ATR</span>
        </div>
        <div class="col-12 mt-5">
            <span class="badge bgATRworm">ATR</span>
        </div>
    </div>
    <div class="col-11">
        <div class="row" id="show_data">
            <?php
            for ($i = 8; $i < 11; $i++) {
                foreach ($listHead[$i]['data'] as $row_detail) {
            ?>
                    <div class="mr-10 pr-0" style="width: 24.14%;">
                        <div class="shadow p-2 bg-body rounded">
                            <div class="col-12 badge bg light-shadow text-dark text-start">
                                <?php echo $listHead[$i]['breakdown']; ?>
                            </div>
                            <div class="row mt-10">
                                <div class="row">
                                    <div class="col-lg-3 text-secondary font-size-12">
                                        <?php echo $startYear - 1; ?>
                                    </div>
                                    <div class="col-lg-7 pt-5 mt-2 pr-0 pl-0">
                                        <div class="progress progress-thin" style="height: 8px;">
                                            <div class="progress-bar bg-bar-background-1" role="progressbar" style="width: <?php echo round($row_detail['percent_accum_last_act']); ?>%;" aria-valuenow="<?php echo round($row_detail['percent_accum_last_act']); ?>" aria-valuemin="0" aria-valuemax="300"></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 text-secondary font-size-12 text-end pr-0">
                                        <?php echo round($row_detail['percent_accum_last_act']); ?>%
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 text-secondary font-size-12">
                                        <?php echo $startYear; ?>
                                    </div>
                                    <div class="col-lg-7  mt-2 pr-0 pl-0">
                                        <div class="progress progress-thin" style="height: 8px;">
                                            <div class="progress-bar bg-bar-background-2" role="progressbar" style="width: <?php echo round($row_detail['percent_accum_act']); ?>%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="300"></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 text-secondary font-size-12 text-end pr-0">
                                        <?php echo round($row_detail['percent_accum_act']); ?>%
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 font-size-12">
                                        <?php echo $startYear; ?> <span class="badge bdg-2580D3">C</span>
                                    </div>
                                    <div class="col-lg-7  mt-2 pr-0 pl-0">
                                        <div class="progress progress-thin" style="height: 8px;">
                                            <div class="progress-bar bg-bar-background-3" role="progressbar" style="width: <?php echo round($row_detail['percent_accum_tar']); ?>%" aria-valuenow="<?php echo round($row_detail['percent_accum_tar']); ?>" aria-valuemin="0" aria-valuemax="300"></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 font-size-12 text-end pr-0">
                                        <?php echo round($row_detail['percent_accum_tar']); ?>%
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 text-secondary font-size-12">
                                        <?php echo $startYear + 1; ?>
                                    </div>
                                    <div class="col-lg-7  mt-2 pr-0 pl-0">
                                        <div class="progress progress-thin" style="height: 8px;">
                                            <div class="progress-bar bg-bar-background-4" role="progressbar" style="width: <?php echo round($row_detail['percent_accum_next_tar']); ?>%" aria-valuenow="<?php echo round($row_detail['percent_accum_next_tar']); ?>" aria-valuemin="0" aria-valuemax="300"></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 text-secondary font-size-12 text-end pr-0">
                                        <?php echo round($row_detail['percent_accum_next_tar']); ?>%
                                    </div>
                                </div>
                            </div>
                            <div class="border-bottom"></div>
                        </div>
                    </div>
            <?php
                }
            }
            ?>
        </div>
    </div>
</div>

<?php
mysqli_close($connection);
?>