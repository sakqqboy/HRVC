 <?php
    @session_start();
    include("../../../config/main_function.php");
    $secure = "-%ekla!(m09)%1A7";
    $connection = connectDB($secure);

    // $companyId = mysqli_real_escape_string($connection, $_POST['companyId']);
    $userId = $_SESSION["__id"];
    ?>
 <select class="form-select example-tok" id="company_group" aria-label="Default select example" onchange="changeCompanyGroup(this.value)">
     <option disabled value="">------Select------</option>
     <?php
        $sql_select = "SELECT c.* FROM user a 
        LEFT JOIN employee b ON a.employeeId = b.employeeId
        LEFT JOIN company c ON b.companyId = c.companyId
        WHERE a.userId = '$userId'";
        $res_select = mysqli_query($connection, $sql_select)  or die($connection->error);
        while ($row_select = mysqli_fetch_assoc($res_select)) {
        ?>
         <option <?php echo ($row_select['companyId'] == $companyId ? "selected" : "") ?> value="<?php echo $row_select['companyId']; ?>"><?php echo $row_select['companyName']; ?></option>
     <?php } ?>
 </select>