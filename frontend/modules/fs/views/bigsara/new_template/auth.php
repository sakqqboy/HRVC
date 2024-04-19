<?php
session_start();
require("config/main_function.php");
$secure = "-%ekla!(m09)%1A7";
$connection = connectDB($secure);

if ($connection) {
    $_SESSION["__id"] = 162;
    $result = 1;
} else {
    $result = 9;
}
$arr['result'] = $result;
echo json_encode($arr);
