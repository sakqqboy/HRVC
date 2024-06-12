<?php
include("../../../config/main_function.php");
$secure = "-%ekla!(m09)%1A7";
$connection = connectDB($secure);

function calculateDivide($numerator, $denominator)
{
    return $denominator == 0 ? 0 : $numerator / $denominator;
}

function rankValue($value, $array, $order = 1)
{
    if (!in_array($value, $array)) {
        return "-";
    }

    if ($order == 1) {
        sort($array);
    } else {
        rsort($array);
    }

    $rank = array_search($value, $array) + 1;
    return $rank;
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

$p_rank = calculateDivide(floatval($listHead[5]['data'][0]['accum_act']), floatval($listHead[0]['data'][0]['accum_act'])) * 100;
$q_rank = calculateDivide(floatval($listHead[5]['data'][0]['accum_act']), floatval($listHead[2]['data'][0]['accum_act'])) * 100;
$f_rank = calculateDivide(floatval($listHead[5]['data'][0]['accum_act']), floatval($listHead[4]['data'][0]['accum_act'])) * 100;
$v_rank = calculateDivide(floatval($listHead[5]['data'][0]['accum_act']), floatval($listHead[1]['data'][0]['accum_act'])) * 100;

$array_rank = [$p_rank, $q_rank, $f_rank, $v_rank];
?>
<div class="row px-3 py-1">
    <div class="col-3 px-1 py-1" style="border-right: 1px solid gray;">
        <div class="card h-100 border-0 m-0">
            <div class="row" style="font-size: 14px;">
                <div class="col-4 p-1 d-flex align-items-center">
                    <div>
                        <span class="icon-red px-2 ms-2">P</span>
                    </div>
                    <div class="px-2">
                        <b>Price</b>
                        <br>
                        <small>(Product Appeal)</small>
                    </div>
                </div>
                <div class="col-8 p-1 table-responsive">
                    <table class="table table-borderless mb-0" style="font-size: 14px;">
                        <tbody>
                            <tr>
                                <td>Sensitivity Ratio</td>
                                <td class="text-center"><span class="ml-2"><?php echo round($p_rank, 2); ?> %</span></td>
                            </tr>
                            <tr>
                                <td>Sensitivity Rank</td>
                                <td class="text-center"><?php echo rankValue($p_rank, $array_rank, 1); ?> || <?php echo count($array_rank); ?></td>
                            </tr>
                            <tr>
                                <td>Strategic Rank</td>
                                <td class="text-center">N/A || N/A</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-3 px-1 py-1" style="border-right: 1px solid gray;">
        <div class="card h-100 border-0 m-0">
            <div class="row" style="font-size: 14px;">
                <div class="col-4 p-1 d-flex align-items-center">
                    <div>
                        <span class="icon-darkblue px-2 ms-2">Q</span>
                    </div>
                    <div class="px-2">
                        <b>Quantity</b>
                        <br>
                        <small>(Sale Force)</small>
                    </div>
                </div>
                <div class="col-8 p-1 table-responsive">
                    <table class="table table-borderless mb-0" style="font-size: 14px;">
                        <tbody>
                            <tr>
                                <td>Sensitivity Ratio</td>
                                <td class="text-center"><span class="ml-2"><?php echo round($q_rank, 2); ?> %</span></td>
                            </tr>
                            <tr>
                                <td>Sensitivity Rank</td>
                                <td class="text-center"><?php echo rankValue($q_rank, $array_rank, 1); ?> || <?php echo count($array_rank); ?></td>
                            </tr>
                            <tr>
                                <td>Strategic Rank</td>
                                <td class="text-center">N/A || N/A</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-3 px-1 py-1" style="border-right: 1px solid gray;">
        <div class="card h-100 border-0 m-0">
            <div class="row" style="font-size: 14px;">
                <div class="col-4 p-1 d-flex align-items-center">
                    <div>
                        <span class="icon-gray px-2 ms-2">F</span>
                    </div>
                    <div class="px-2">
                        <b>Fixed Expense</b>
                        <br>
                        <small>(Power)</small>
                    </div>
                </div>
                <div class="col-8 p-1 table-responsive">
                    <table class="table table-borderless mb-0" style="font-size: 14px;">
                        <tbody>
                            <tr>
                                <td>Sensitivity Ratio</td>
                                <td class="text-center"><span class="ml-2"><?php echo round($f_rank, 2); ?> %</span></td>
                            </tr>
                            <tr>
                                <td>Sensitivity Rank</td>
                                <td class="text-center"><?php echo rankValue($f_rank, $array_rank, 1); ?> || <?php echo count($array_rank); ?></td>
                            </tr>
                            <tr>
                                <td>Strategic Rank</td>
                                <td class="text-center">N/A || N/A</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-3 px-1 py-1">
        <div class="card h-100 border-0 m-0">
            <div class="row" style="font-size: 14px;">
                <div class="col-4 p-1 d-flex align-items-center">
                    <div>
                        <span class="icon-green px-2 ms-2">V</span>
                    </div>
                    <div class="px-2">
                        <b>Variable Expense</b>
                        <br>
                        <small>(Negotiation & Technical Ability)</small>
                    </div>
                </div>
                <div class="col-8 p-1 table-responsive">
                    <table class="table table-borderless mb-0" style="font-size: 14px;">
                        <tbody>
                            <tr>
                                <td>Sensitivity Ratio</td>
                                <td class="text-center"><span class="ml-2"><?php echo round($v_rank, 2); ?> %</span></td>
                            </tr>
                            <tr>
                                <td>Sensitivity Rank</td>
                                <td class="text-center"><?php echo rankValue($v_rank, $array_rank, 1); ?> || <?php echo count($array_rank); ?></td>
                            </tr>
                            <tr>
                                <td>Strategic Rank</td>
                                <td class="text-center">N/A || N/A</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>