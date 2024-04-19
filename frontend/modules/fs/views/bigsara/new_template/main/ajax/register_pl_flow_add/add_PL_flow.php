 <?php
    include("../../../config/main_function.php");
    $secure = "-%ekla!(m09)%1A7";
    $connection = connectDB($secure);

    $account_id = getRandomID(10, 'tbl_branch_pl_account_code', 'account_id');
    $branchId = mysqli_real_escape_string($connection, $_POST['branchId']);
    $acc_code = mysqli_real_escape_string($connection, $_POST['acc_code']);
    $acc_name = mysqli_real_escape_string($connection, $_POST['acc_name']);
    $pl_medium_id = mysqli_real_escape_string($connection, $_POST['pl_medium_id']);
    $breakdown_id = mysqli_real_escape_string($connection, $_POST['breakdown_id']);
    $cash_flow_id = mysqli_real_escape_string($connection, $_POST['cash_flow_id']);
    $cash_flow_type = mysqli_real_escape_string($connection, $_POST['cash_flow_type']);
    $note = mysqli_real_escape_string($connection, $_POST['note']);


    if ($connection) {

        $sql_select = "SELECT IF(MAX(list_order) IS NULL, 0, MAX(list_order)) AS list_order FROM tbl_branch_pl_account_code;";
        $res_select = mysqli_query($connection, $sql_select)  or die($connection->error);
        $row_select = mysqli_fetch_assoc($res_select);
        $list_order = $row_select['list_order'];
        $list_order += 1;

        $sql_insert = "INSERT INTO tbl_branch_pl_account_code SET
        account_id = '$account_id',
        branchId = '$branchId',
        acc_code = '$acc_code',
        acc_name = '$acc_name',
        pl_medium_id = '$pl_medium_id',
        breakdown_id = '$breakdown_id',
        cash_flow_id = '$cash_flow_id',
        cash_flow_type = '$cash_flow_type',
        list_order = '$list_order',
        note = '$note'";
        $res_insert = mysqli_query($connection, $sql_insert)  or die($connection->error);

        if ($res_insert) {
            $sql_branch_account_code = "SELECT a.*,b.medium_name,c.major_name,d.cash_flow_name,e.breakdown_name FROM tbl_branch_pl_account_code a 
            LEFT JOIN tbl_pl_medium_df b ON a.pl_medium_id = b.pl_medium_id
            LEFT JOIN tbl_pl_major_df c ON b.pl_major_id = c.pl_major_id
            LEFT JOIN tbl_pl_cash_flow_df d ON a.cash_flow_id = d.cash_flow_id
            LEFT JOIN tbl_pl_breakdown_df e ON a.breakdown_id = e.breakdown_id 
            WHERE branchId = '$branchId' ORDER BY a.acc_code ASC;";
            $res_branch_account_code = mysqli_query($connection, $sql_branch_account_code)  or die($connection->error);
    
            $index = 0;
    
            while ($row_branch_account_code = mysqli_fetch_array($res_branch_account_code, MYSQLI_ASSOC)) {
                if ($row_branch_account_code['acc_code'] === $acc_code) {
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

    mysqli_close($connection);
    echo json_encode($arr);
    ?>