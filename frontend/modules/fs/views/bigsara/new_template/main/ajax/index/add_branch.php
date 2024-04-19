<?php
include("../../../config/main_function.php");
$secure = "-%ekla!(m09)%1A7";
$connection = connectDB($secure);

// $branchId = getRandomID(10, 'branch', 'branchId');
$companyId = mysqli_real_escape_string($connection, $_POST['companyId']);
$branchName = mysqli_real_escape_string($connection, $_POST['branchName']);
$financial_start_month = mysqli_real_escape_string($connection, $_POST['financial_start_month']);
$description = mysqli_real_escape_string($connection, $_POST['note']);

$date = date('Y-m-d');

if ($connection) {

    $sql_insert = "INSERT INTO branch SET  
    companyId = '$companyId', 
    branchName = '$branchName', 
    financial_start_month = '$financial_start_month', 
    description = '$description',
    createDateTime = '$date'";

    $res_insert = mysqli_query($connection, $sql_insert)  or die($connection->error);

    $branchId = mysqli_insert_id($connection);
    // echo "<pre>";
    // var_dump($branchId);
    // echo "</pre>";

    if ($res_insert) {
        if ($_FILES['branch_logo'] != "") {
            $file = explode(".", $_FILES['branch_logo']['name']);
            $count2 = count($file) - 1;
            $file_surname = $file[$count2];
            $filename_images = md5(date('mds') . rand(111, 999) . date("hsid") . rand(111, 999)) . "." . $file_surname;
            if (in_array($file_surname, array('jpg', 'jpeg', 'JPG', 'JPEG', 'png', 'PNG'))) {
                if (move_uploaded_file($_FILES['branch_logo']['tmp_name'], "../../../images/company/logo/" . $filename_images)) {
                    $sql_img = "UPDATE branch SET
                    branch_logo = '$filename_images' 
                    WHERE branchId = '$branchId'";
                    $rs_img = mysqli_query($connection, $sql_img) or die($connection->error);
                }
            }
        }

        $sql_branch = "SELECT a.*,b.*,c.countryName,c.flag FROM branch a 
        LEFT JOIN company b ON a.companyId = b.companyId
        LEFT JOIN country c ON b.countryId = c.countryId
        WHERE a.companyId = '$companyId'";
        $res_branch = mysqli_query($connection, $sql_branch)  or die($connection->error);

        $index = 0;

        while ($row_branch = mysqli_fetch_array($res_branch, MYSQLI_ASSOC)) {
            // echo "<pre>";
            // var_dump($row_branch['branchId']);
            // echo "</pre>";
            if ($row_branch['branchId'] == $branchId) {
                // echo "index " . $index . "<br>";

                $page = ceil($index / 6);
                $arr['page'] = $page;
                break;
            }
            $index++;
        }

        $arr['result'] = 1;
    } else {
        $arr['result'] = 0;
    }
} else {
    $arr['result'] = 9;
}

echo json_encode($arr);
