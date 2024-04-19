<?php
include("../../../config/main_function.php");
$secure = "-%ekla!(m09)%1A7";
$connection = connectDB($secure);

$branchId = mysqli_real_escape_string($connection, $_POST['branchId']);
$breakdown_id = mysqli_real_escape_string($connection, $_POST['breakdown_id']);

$sql_select = "SELECT * FROM tbl_pl_breakdown_df";
$res_select = mysqli_query($connection, $sql_select)  or die($connection->error);

?>

<select class="form-select text-primary" style="height: 25px;font-size:10px;" id="breakdown_id" name="breakdown_id" onchange="getLoadData()">
    <?php
    while ($row = mysqli_fetch_assoc($res_select)) {
    ?>
        <option value="<?php echo $row['breakdown_id']; ?>" <?php echo $row['breakdown_id']==$breakdown_id?'selected':''; ?>><?php echo $row['breakdown_name']; ?></option>
    <?php
    }
    ?>
</select>