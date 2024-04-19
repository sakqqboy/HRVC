<?php
include("../../../config/main_function.php");
$secure = "-%ekla!(m09)%1A7";
$connection = connectDB($secure);

$MajorItems = mysqli_real_escape_string($connection, $_POST['MajorItems']);
$med = mysqli_real_escape_string($connection, $_POST['med']);
?>
<option selected value="">---- select ----</option>
<?php
echo $sql_MediumItems = "SELECT * FROM tbl_pl_medium_df WHERE pl_major_id = '$MajorItems';";
$res_MediumItems = mysqli_query($connection, $sql_MediumItems) or die($connection->error);
while ($row_MediumItems = mysqli_fetch_assoc($res_MediumItems)) {
?>
    <option value="<?php echo $row_MediumItems['pl_medium_id']; ?>" <?php echo ($med == $row_MediumItems['pl_major_id']) ? "selected" : ""; ?> ><?php echo $row_MediumItems['medium_name']; ?></option>
<?php
}
mysqli_close($connection);
?>