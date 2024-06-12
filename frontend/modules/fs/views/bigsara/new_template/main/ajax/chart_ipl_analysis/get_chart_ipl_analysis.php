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
$rate = mysqli_real_escape_string($connection, $_POST['rate'] == '' ? 1 : $_POST['rate']);
$breakdown_index = $_POST['breakdown_index'] ;
// $array_axis_X = array("x");

// $array_sale = array("Sales");
// $array_sale_budget = array("Sales Budget");

// $array_variable_expense = array("Variable Expense");
// $array_variable_expense_budget = array("Variable Expense Budget");

// $array_labor_cost = array("Labor Cost");
// $array_labor_cost_budget = array("Labor Cost Budget");

// $array_fixed_expense_other = array("Fixed Expense (Other)");
// $array_fixed_expense_other_budget = array("Fixed Expense (Other) Budget");

// $array_non_operating_income = array("Non-Operating Income");
// $array_non_operating_income_budget = array("Non-Operating Income Budget");

// $array_non_operating_expense = array("Non-Operating Expense");
// $array_non_operating_expense_budget = array("Non-Operating Expense Budget");

// $array_interest_and_devident_income = array("Interest and Devident Income");
// $array_interest_and_devident_income_budget = array("Interest and Devident Income Budget");

// $array_interest_expense = array("Interest Expense");
// $array_interest_expense_budget = array("Interest Expense Budget");

// $list_breakdown = ["Sales", "Variable Expense", "Gross Profit (or Loss)", "Labor Cost", "Fixed Expense (Other)", "Fixed Expense", "Operating Profit (or Loss)", "Non-Operating Income", "Non-Operating Expense", "Ordinary Profit (or Loss)", "Break-Even Sales", "Marginal Profit Ratio"];
// $list_breakdown_data = array();
// for ($i = 0; $i < 12; $i++) {
//     $list_breakdown_data[] = array(
//         "list" => $i,
//         "breakdown" => $list_breakdown[$i],
//         "data" => array()
//     );
// }

// $list_breakdown_Interest = array();
// for ($i = 0; $i < 4; $i++) {
// $list_breakdown_Interest[] = array(
//     "list" => $i,
//     "data" => array()
// );
// }


$array_data = array();

$colors = array(
    'rgba(255, 99, 132, 1)', // Red
    'rgba(54, 162, 235, 1)', // Blue
    'rgba(255, 206, 86, 1)', // Yellow
    'rgba(75, 192, 192, 1)', // Green
    'rgba(153, 102, 255, 1)', // Purple
    'rgba(255, 159, 64, 1)', // Orange
    'rgba(255, 0, 255, 1)', // Magenta
    'rgba(255, 99, 132, 1)'
);

$categories = array(
    "Sales",
    "Variable Expense",
    "Labor Cost",
    "Fixed Expense (Other)",
    "Non-Operating Income",
    "Non-Operating Expense",
    "Interest and Devident Income",
    "Interest Expense"
);

$budgets = array(
    "Sales Budget",
    "Variable Expense Budget",
    "Labor Cost Budget",
    "Fixed Expense (Other) Budget",
    "Non-Operating Income Budget",
    "Non-Operating Expense Budget",
    "Interest and Devident Income Budget",
    "Interest Expense Budget"
);

// $newArray = array();
// $categories = array();
// $budgets = array();

// foreach ($breakdown_index as $index) {
//     if (isset($base_categories[$index])) {
//         $categories[] = $base_categories[$index];
//     }
//     if (isset($base_budgets[$index])) {
//         $budgets[] = $base_budgets[$index];
//     }
// }

$array_data[] = array(
    "list" => 0,
    "data" => array("x"),
);

for ($i = 0; $i < 8; $i++) {
    $array_data[] = array(
        "list" => $i + 1,
        "data" => array($categories[$i]),
        "data_budget" => array($budgets[$i]),
    );
}

$sql_select = "SELECT financial_start_month FROM branch WHERE branchId = '$branchId' ";
$res_select = mysqli_query($connection, $sql_select)  or die($connection->error);
$row_select = mysqli_fetch_assoc($res_select);
$startMonth = $row_select['financial_start_month'];

$list_time = array();
$list_month = array();


for ($j = 0; $j < 3; $j++) {
    for ($i = 0; $i < 12; $i++) {
        $currentMonth = ($startMonth + $i - 1) % 12 + 1;
        $currentYear = $startYear + floor(($startMonth + $i - 1) / 12);
        // $monthName = date('F', mktime(0, 0, 0, $currentMonth, 1));
        $monthName = date('M', mktime(0, 0, 0, $currentMonth, 1));
        $Q = ceil(($i + 1) / 3);

        // $formattedDate = sprintf("%d-%02d-01", $currentYear, $currentMonth);
        // $formattedDate = sprintf("%d-%02d", $currentYear, $currentMonth);
        $formattedDate = sprintf("%s%d", substr($monthName, 0, 3), substr($currentYear, -2));

        $array_data[0]['data'][] = $formattedDate;

        $list_time[] = array(
            "list" => $i,
            "monthName" => $monthName,
            "month" => $currentMonth,
            "year" => $currentYear,
            "quarter" => $Q
        );
    }

    $startYear++;
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

for ($list = 1; $list <= 8; $list++) {
    $count = 1;
    foreach ($list_month as $rowMonth) {
        $monthName = $rowMonth['monthName'];
        $month = $rowMonth['month'];
        $year = $rowMonth['year'];

        $sql_data = "SELECT 
        SUM(a.actual_amount) AS actual_amount,
        SUM(a.target_amount) AS target_amount
        FROM tbl_branch_pl_data a 
        LEFT JOIN tbl_branch_pl_account_code b ON a.account_id = b.account_id 
        WHERE b.branchId = '$branchId' AND b.breakdown_id = '$list' AND a.month = '$month' AND a.year = '$year' 
        ORDER BY a.month ASC,a.year ASC";

        $res_data = mysqli_query($connection, $sql_data) or die($connection->error);
        $row_data = mysqli_fetch_assoc($res_data);

        $actual_amount = ($row_data['actual_amount'] == "" ? 0 : $row_data['actual_amount']) / $rate;
        $target_amount = ($row_data['target_amount'] == "" ? 0 : $row_data['target_amount']) / $rate;
        $actual_amount = round($actual_amount, 2);
        $target_amount = round($target_amount, 2);

        if ($row_data['actual_amount'] != '') {
            $array_data[$list]['data'][] = $actual_amount;
            // if ($array_data[$list]['data_budget'][$count - 1] != null) {
            //     $array_data[$list]['data_budget'][] = $actual_amount;
            // } else {
            $array_data[$list]['data_budget'][] = null;
            // }
        } else {
            if ($row_data['target_amount'] != '') {
                if ($array_data[$list]['data_budget'][$count - 1] == '' && $array_data[$list]['data'][$count - 1] != '') {
                    $array_data[$list]['data_budget'][$count - 1] = $array_data[$list]['data'][$count - 1];
                }
                $array_data[$list]['data'][] = null;
                $array_data[$list]['data_budget'][] = $target_amount;
            } else {
                $array_data[$list]['data'][] = null;
                $array_data[$list]['data_budget'][] = null;
            }
        }

        $count++;
    }
}
// $i=1;
// foreach ($array_data as $value) {
//     if ($array_data[1]['data'][$i] != null ||)
//     $array_data[9]['data'][$i] = $array_data[1]['data'][$i] - $array_data[2]['data'][$i];
//     $array_data[9]['data_budget'][$i] = $array_data[1]['data_budget'][$i] - $array_data[2]['data_budget'][$i];
// }

echo json_encode($array_data);
