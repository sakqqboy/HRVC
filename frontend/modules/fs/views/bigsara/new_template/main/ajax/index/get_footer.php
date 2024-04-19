<?php
include("../../../config/main_function.php");
$secure = "-%ekla!(m09)%1A7";
$connection = connectDB($secure);

$page = mysqli_real_escape_string($connection, $_POST['page']);
$companyId = mysqli_real_escape_string($connection, $_POST['companyId']);

$sql_branch = "SELECT a.*,b.*,c.countryName,c.flag FROM branch a 
LEFT JOIN company b ON a.companyId = b.companyId
LEFT JOIN country c ON b.countryId = c.countryId
WHERE a.companyId = '$companyId' ";
$res_branch = mysqli_query($connection, $sql_branch)  or die($connection->error);
$num_row = mysqli_num_rows($res_branch);

// echo $sql_company_group;

$page_count = ceil($num_row / 6);
// echo $page_count;

?>
<div class="btn-group" role="group" aria-label="First group">
    <?php if ($page > 1) { ?>
        <button type="button" class="btn btn-light font-size-11" onclick="getFooter(<?php echo $page - 1; ?>)"> <i class="fa fa-chevron-left" aria-hidden="true"></i>
            Previous</button>
    <?php } ?>
</div>
<div class="btn-group" role="group" aria-label="Second group">
    <?php for ($i = 1; $i <= $page_count; $i++) { ?>
        <button type="button" class="btn <?php echo ($i == $page) ? "btn-primary" : "btn-light"; ?> font-size-11" onclick="getFooter(<?php echo $i; ?>)"><?php echo $i; ?></button>
    <?php } ?>
</div>
<div class="btn-group" role="group" aria-label="Third group">
    <?php if ($page < $page_count) { ?>
        <button type="button" class="btn btn-light font-size-11" onclick="getFooter(<?php echo $page + 1; ?>)"> Next <i class="fa fa-chevron-right" aria-hidden="true"></i></button>
    <?php } ?>
</div>