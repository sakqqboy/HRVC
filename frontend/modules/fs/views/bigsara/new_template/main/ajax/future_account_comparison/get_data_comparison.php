<?php
include("../../../config/main_function.php");
$secure = "-%ekla!(m09)%1A7";
$connection = connectDB($secure);

function calculateDivide($numerator, $denominator)
{
    return $denominator == 0 ? 0 : $numerator / $denominator;
}

$branchId = mysqli_real_escape_string($connection, $_POST['branchId']);
$startYear = mysqli_real_escape_string($connection, $_POST['start_year']);
$endMonth = mysqli_real_escape_string($connection, $_POST['start_month']);
$rate = mysqli_real_escape_string($connection, $_POST['rate']);

$list_breakdown = ["Sales", "Variable Expense", "Gross Profit (or Loss)", "Labor Cost", "Fixed Expense (Other)", "Fixed Expense", "Operating Profit (or Loss)", "Non-Operating Income", "Non-Operating Expense", "Ordinary Profit (or Loss)", "Break-Even Sales", "Marginal Profit Ratio"];
$list_breakdown_data = array();
for ($i = 0; $i < $endMonth; $i++) {
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

// $sql_select = "SELECT financial_start_month FROM branch WHERE branchId = '$branchId' ";
// $res_select = mysqli_query($connection, $sql_select)  or die($connection->error);
// $row_select = mysqli_fetch_assoc($res_select);
// $startMonth = $row_select['financial_start_month'];

$list_month = array();

$currentMonth = $endMonth;
$currentYear = $startYear;
$monthName = date('F', mktime(0, 0, 0, $currentMonth, 1));

$first_date = "$monthName $currentYear";

$list_month[] = array(
    "list" => 0,
    "monthName" => $monthName,
    "month" => $currentMonth,
    "year" => $currentYear,
);

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
        $last_act = ($row_last_year['actual_amount'] == "" ? 0 : $row_last_year['actual_amount']) / $rate;
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

        $actual_amount = ($row_data['actual_amount'] == "" ? 0 : $row_data['actual_amount']) / $rate;
        $target_amount = ($row_data['target_amount'] == "" ? 0 : $row_data['target_amount']) / $rate;
        $next_target_amount = ($row_data['next_target_amount'] == "" ? 0 : $row_data['next_target_amount']) / $rate;

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
<div class="row">
    <div class="col-9">
        <div class="col-12 pt-2">
            <h6><?php echo $first_date; ?></h6>
        </div>
        <div class="col-12">
            <div class="row" style="height: 700px;">
                <div class="alert alert-sea popup d-flex align-items-center justify-content-evenly" style="top: 20%;left: 10%;width: 20%;height: 4%;">
                    Variable Expense Ratio
                    <span class="badge bg-light text-dark">
                        <?php
                        $Variable_Expense_Ratio = calculateDivide(round($listHead[1]['data'][0]['percent_accum_act'], 2), round($listHead[0]['data'][0]['percent_accum_act'], 2)) * 100;
                        echo round($Variable_Expense_Ratio, 2) . '%';
                        ?>
                    </span>
                </div>
                <div class="alert alert-violet popup d-flex align-items-center justify-content-evenly" style="top: 70%;left: 30%;width: 20%;height: 4%;">
                    Break-Even Point Ratio
                    <span class="badge bg-light text-dark">
                        <?php
                        $Break_Even_Point_Ratio = calculateDivide(round($listHead[4]['data'][0]['percent_accum_act'], 2), round($listHead[2]['data'][0]['percent_accum_act'], 2)) * 100;

                        if ($Break_Even_Point_Ratio < 60) {
                            $hilight = 1;
                        } elseif ($Break_Even_Point_Ratio >= 60 && $Break_Even_Point_Ratio <= 80) {
                            $hilight = 2;
                        } elseif ($Break_Even_Point_Ratio >= 81 && $Break_Even_Point_Ratio <= 90) {
                            $hilight = 3;
                        } elseif ($Break_Even_Point_Ratio >= 91 && $Break_Even_Point_Ratio <= 100) {
                            $hilight = 4;
                        } elseif ($Break_Even_Point_Ratio >= 101 && $Break_Even_Point_Ratio <= 200) {
                            $hilight = 5;
                        } else {
                            $hilight = 6;
                        }

                        echo round($Break_Even_Point_Ratio, 2) . '%';
                        ?>
                    </span>
                </div>
                <div class="alert alert-yellow popup d-flex align-items-center justify-content-evenly" style="top: 80%;left: 10%;width: 20%;height: 4%;">
                    Gross Profit Ratio
                    <span class="badge bg-light text-dark">
                        <?php
                        $Gross_Profit_Ratio = calculateDivide(round($listHead[2]['data'][0]['percent_accum_act'], 2), round($listHead[0]['data'][0]['percent_accum_act'], 2)) * 100;
                        echo round($Gross_Profit_Ratio, 2) . '%';
                        ?>
                    </span>
                </div>
                <div class="alert alert-lime popup d-flex align-items-center justify-content-evenly" style="top: 90%;left: 15%;width: 30%;height: 4%;">
                    Ordinary Profit to Net Sales Ratio
                    <span class="badge bg-light text-dark">
                        <?php
                        $Ordinary_Profit_to_Net_Sales_Ratio = calculateDivide(round($listHead[5]['data'][0]['percent_accum_act'], 2), round($listHead[0]['data'][0]['percent_accum_act'], 2)) * 100;
                        echo round($Ordinary_Profit_to_Net_Sales_Ratio, 2) . '%';
                        ?>
                    </span>
                </div>

                <div class="col-3 pr-2">
                    <div class="card card-yellow h-100" style="border: 1px solid rgba(254,229,180,255);background-color: rgba(255,242,219,255);">
                        <button class="btn btn-sm btn-outline-secondary bg-white" style="position: absolute;top: 10px;right: 10px;">Sales</button>
                        <div class=" d-flex align-items-center justify-content-center h-100">
                            <div class="text-center">
                                <h4 class="card-title"><?php echo round($listHead[0]['data'][0]['percent_accum_act'], 2); ?>%</h4>
                                <h5 class="card-text">
                                    <?php echo number_format($listHead[0]['data'][0]['accum_act'], 2); ?>
                                </h5>
                                <h5 class="card-text">
                                    Sales
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-9 pl-2">
                    <div class="row h-25">
                        <div class="col-12 h-100">
                            <div class="card card-sea h-100" style="border: 1px solid rgba(218,255,255,255);background-color: rgba(245,255,255,255);">
                                <button class="btn btn-sm btn-outline-secondary bg-white" style="position: absolute;top: 10px;right: 10px;">Variable Expense</button>
                                <div class=" d-flex align-items-center justify-content-center h-100">
                                    <div class="text-center">
                                        <h4 class="card-title"><?php echo round($listHead[1]['data'][0]['percent_accum_act'], 2); ?>%</h4>
                                        <h5 class="card-text">
                                            <?php echo number_format($listHead[1]['data'][0]['accum_act'], 2); ?>
                                        </h5>
                                        <h5 class="card-text">
                                            Variable Expense
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row pt-5 h-75">
                        <div class="col-4 pr-5 h-100">
                            <div class="card card-taro h-100">
                                <button class="btn btn-sm btn-outline-secondary bg-white" style="position: absolute;top: 10px;right: 10px;">Gross Profit</button>
                                <div class=" d-flex align-items-center justify-content-center h-100">
                                    <div class="text-center" style="margin-top: -150px">
                                        <h4 class="card-title"><?php echo round($listHead[2]['data'][0]['percent_accum_act'], 2); ?>%</h4>
                                        <h5 class="card-text">
                                            <?php echo number_format($listHead[2]['data'][0]['accum_act'], 2); ?>
                                        </h5>
                                        <h5 class="card-text">
                                            Gross Profit
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-8 pl-0 h-100">
                            <div class="row pb-5 h-75">
                                <div class="col-12 mb-0 h-100">
                                    <div class="card card-gray h-100">
                                        <button class="btn btn-sm btn-outline-secondary bg-white" style="position: absolute;top: 10px;right: 10px;">Fixed Expense (Other)</button>
                                        <div class=" d-flex align-items-center justify-content-center h-100">
                                            <div class="text-center">
                                                <h4 class="card-title"><?php echo round($listHead[4]['data'][0]['percent_accum_act'], 2); ?>%</h4>
                                                <h5 class="card-text">
                                                    <?php echo number_format($listHead[4]['data'][0]['accum_act'], 2); ?>
                                                </h5>
                                                <h5 class="card-text">
                                                    Fixed Expense (Other)
                                                </h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row h-25">
                                <div class="col-12 m-0 h-100">
                                    <div class="card card-lime h-100">
                                        <button class="btn btn-sm btn-outline-secondary bg-white" style="position: absolute;top: 10px;right: 10px;">Operating Profit</button>
                                        <div class=" d-flex align-items-center justify-content-center h-100">
                                            <div class="text-center">
                                                <h4 class="card-title"><?php echo round($listHead[5]['data'][0]['percent_accum_act'], 2); ?>%</h4>
                                                <h5 class="card-text">
                                                    <?php echo number_format($listHead[5]['data'][0]['accum_act'], 2); ?>
                                                </h5>
                                                <h5 class="card-text">
                                                    Operating Profit
                                                </h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-3" style="border-left: 1px solid lightgray;font-size: 12px;">
        <div class="card <?php echo $hilight == 1 ? 'alert-sea' : ''; ?>">
            <div class="row">
                <div class="col-9">
                    <div class="row">
                        <div class="col-12">
                            Super excellent company, has a great reserve of energy
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4 p-1 text-center" style="font-size: 12px;">
                            <b>UNDER 60%</b>
                            <p>BEF Ratio</p>
                        </div>
                        <div class="col-8 p-1 text-center" style="border-left: 1px solid lightgray;font-size: 12px;">
                            <b>OVER 1.66 times</b>
                            <p>Fixed Expense Productivity</p>
                        </div>
                    </div>
                </div>
                <div class="col-3 d-flex align-items-center justify-content-center" style="border-left: 1px solid lightgray;font-size: 24px;">
                    <b>"SS"</b>
                </div>
            </div>
        </div>
        <div class="card <?php echo $hilight == 2 ? 'alert-sea' : ''; ?>"">
            <div class=" row">
            <div class="col-9">
                <div class="row">
                    <div class="col-12">
                        Excellent company,has some reserve of energy
                    </div>
                </div>
                <div class="row">
                    <div class="col-4 p-1 text-center" style="font-size: 12px;">
                        <b>60%~80%</b>
                        <p>BEF Ratio</p>
                    </div>
                    <div class="col-8 p-1 text-center" style="border-left: 1px solid lightgray;font-size: 12px;">
                        <b>1.25~1.66 times</b>
                        <p>Fixed Expense Productivity</p>
                    </div>
                </div>
            </div>
            <div class="col-3 d-flex align-items-center justify-content-center" style="border-left: 1px solid lightgray;font-size: 24px;">
                <b>"S"</b>
            </div>
        </div>
    </div>
    <div class="card <?php echo $hilight == 3 ? 'alert-sea' : ''; ?>"">
            <div class=" row">
        <div class="col-9">
            <div class="row">
                <div class="col-12">
                    Sound management company, has well competitivenes
                </div>
            </div>
            <div class="row">
                <div class="col-4 p-1 text-center" style="font-size: 12px;">
                    <b>81%~90%</b>
                    <p>BEF Ratio</p>
                </div>
                <div class="col-8 p-1 text-center" style="border-left: 1px solid lightgray;font-size: 12px;">
                    <b>1.1~1.24 times</b>
                    <p>Fixed Expense Productivity</p>
                </div>
            </div>
        </div>
        <div class="col-3 d-flex align-items-center justify-content-center" style="border-left: 1px solid lightgray;font-size: 24px;">
            <b>"A"</b>
        </div>
    </div>
</div>
<div class="card <?php echo $hilight == 4 ? 'alert-sea' : ''; ?>"">
            <div class=" row">
    <div class="col-9">
        <div class="row">
            <div class="col-12">
                Breackeven point company, cannot be careless at all
            </div>
        </div>
        <div class="row">
            <div class="col-4 p-1 text-center" style="font-size: 12px;">
                <b>91%~100%</b>
                <p>BEF Ratio</p>
            </div>
            <div class="col-8 p-1 text-center" style="border-left: 1px solid lightgray;font-size: 12px;">
                <b>1.0~1.99 times</b>
                <p>Fixed Expense Productivity</p>
            </div>
        </div>
    </div>
    <div class="col-3 d-flex align-items-center justify-content-center" style="border-left: 1px solid lightgray;font-size: 24px;">
        <b>"B"</b>
    </div>
</div>
</div>
<div class="card <?php echo $hilight == 5 ? 'alert-sea' : ''; ?>"">
            <div class=" row">
    <div class="col-9">
        <div class="row">
            <div class="col-12">
                Deficit-ridden company, unsure future
            </div>
        </div>
        <div class="row">
            <div class="col-4 p-1 text-center" style="font-size: 12px;">
                <b>101%~200%</b>
                <p>BEF Ratio</p>
            </div>
            <div class="col-8 p-1 text-center" style="border-left: 1px solid lightgray;font-size: 12px;">
                <b>0.5~0.99 times</b>
                <p>Fixed Expense Productivity</p>
            </div>
        </div>
    </div>
    <div class="col-3 d-flex align-items-center justify-content-center" style="border-left: 1px solid lightgray;font-size: 24px;">
        <b>"C"</b>
    </div>
</div>
</div>
<div class="card <?php echo $hilight == 6 ? 'alert-sea' : ''; ?>"">
            <div class=" row">
    <div class="col-9">
        <div class="row">
            <div class="col-12">
                Deficit-ridden company, unsure future
            </div>
        </div>
        <div class="row">
            <div class="col-4 p-1 text-center" style="font-size: 12px;">
                <b>OVER 200%</b>
                <p>BEF Ratio</p>
            </div>
            <div class="col-8 p-1 text-center" style="border-left: 1px solid lightgray;font-size: 12px;">
                <b>Under 0.5 times</b>
                <p>Fixed Expense Productivity</p>
            </div>
        </div>
    </div>
    <div class="col-3 d-flex align-items-center justify-content-center" style="border-left: 1px solid lightgray;font-size: 24px;">
        <b>"D"</b>
    </div>
</div>
</div>
</div>
</div>

<?php
mysqli_close($connection);
?>