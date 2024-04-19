<?php
include_once('../../../config/main_function.php');
$secure = "-%ekla!(m09)%1A7";
$connection = connectDB($secure);

$account_id =  mysqli_real_escape_string($connection, $_POST['account_id']);
$type =  mysqli_real_escape_string($connection, $_POST['type']);
$month =  mysqli_real_escape_string($connection, $_POST['month']);
$year =  mysqli_real_escape_string($connection, $_POST['year']);
$value =  mysqli_real_escape_string($connection, $_POST['value']);
$value = $value == "" ? 0.00 : $value;

$conditon = "";
if ($type == '1') {
    $conditon = " actual_amount = '$value' ";
} elseif ($type == '2') {
    $conditon = " target_amount = '$value' ";
} elseif ($type == '3') {
    $conditon = " next_target_amount = '$value' ";
} else {
    $arr['result'] = 8;
    mysqli_close($connection);
    echo json_encode($arr);
    exit;
}

if ($connection) {

    $sql_check = "SELECT COUNT(*) AS count FROM tbl_branch_pl_data a WHERE a.account_id = '$account_id' AND a.month = '$month' AND a.year = '$year'";
    $rs_check = mysqli_query($connection, $sql_check) or die($connection->error);
    $row_check = mysqli_fetch_assoc($rs_check);
    if ($row_check['count'] > 0) {
        $sql_update = "UPDATE tbl_branch_pl_data SET
            $conditon
            WHERE account_id = '$account_id' AND month = '$month' AND year = '$year'";
        $res = mysqli_query($connection, $sql_update)  or die($connection->error);
    } else {
        $sql_insert = "INSERT INTO tbl_branch_pl_data SET account_id = '$account_id',month = '$month',year = '$year', $conditon ";
        $res = mysqli_query($connection, $sql_insert)  or die($connection->error);
    }

    if ($res) {
        $arr['result'] = 1;
    } else {
        $arr['result'] = 0;
    }
} else {
    $arr['result'] = 9;
}

mysqli_close($connection);
echo json_encode($arr);
