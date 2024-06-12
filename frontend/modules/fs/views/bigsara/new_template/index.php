<?php

use common\widgets\Alert;

@session_start();
require("config/main_function.php");
$secure = "-%ekla!(m09)%1A7";
$connection = connectDB($secure);
// var_dump($_GET);

$userId = mysqli_real_escape_string($connection, $_GET['id']);

$sql_select = "SELECT * FROM user a WHERE a.userId = '$userId' AND a.status = '1' ";
$rs_select = mysqli_query($connection, $sql_select) or die($connection->error);
$num_check = mysqli_num_rows($rs_select);

if ($num_check == 1) {
    $_SESSION['__id'] = $_GET['id'];
    header('location: main/index.php');
} else {
    echo '<script type="text/javascript">';
    echo "alert ('You do not have permission to access this page. Please log in again.');";
    echo 'window.location.href = "http://localhost/HRVC/frontend/web/site/login";';
    echo '</script>';
}
