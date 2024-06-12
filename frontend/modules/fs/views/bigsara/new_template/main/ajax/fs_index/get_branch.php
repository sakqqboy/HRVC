 <?php
    include("../../../config/main_function.php");
    $secure = "-%ekla!(m09)%1A7";
    $connection = connectDB($secure);

    $branchId = mysqli_real_escape_string($connection, $_POST['branchId']);

    if ($connection) {

        $sql_select = "SELECT a.branchName,b.companyName FROM branch a LEFT JOIN company b ON a.companyId = b.companyId WHERE a.branchId = '$branchId' ; ";
        $res_select = mysqli_query($connection, $sql_select)  or die($connection->error);
        $row_select = mysqli_fetch_assoc($res_select);

        if ($res_select) {
            $arr['result'] = 1;
            $arr['branchName'] = $row_select['branchName'];
            $arr['companyName'] = $row_select['companyName'];
        } else {
            $arr['result'] = 0;
        }
    } else {
        $arr['result'] = 9;
    }

    mysqli_close($connection);
    echo json_encode($arr);
    ?>