 <?php
    include("../../../config/main_function.php");
    $secure = "-%ekla!(m09)%1A7";
    $connection = connectDB($secure);

    $branchId = mysqli_real_escape_string($connection, $_POST['branchId']);
    $current_year = mysqli_real_escape_string($connection, $_POST['current_year']);
    $next_year = $current_year + 1;

    $sql_select = "SELECT * 
    FROM tbl_branch_pl_account_code  
    WHERE branchId = '$branchId' ORDER BY acc_code ASC";
    $res_select = mysqli_query($connection, $sql_select)  or die($connection->error);
    $num_select = mysqli_num_rows($res_select);

    $sql_start_m = "SELECT 
    bn.financial_start_month
    FROM branch bn WHERE branchId = '$branchId'";
    $res_start_m = mysqli_query($connection, $sql_start_m);
    $row_start_m = mysqli_fetch_assoc($res_start_m);
    $start_month = $row_start_m['financial_start_month'];
    $next_month = $start_month - 1;



    ?>

 <div class="row mt-10 pr-0">
     <div class="col-lg-4">
         <div class="row">
             <div class="col-12">
                 <div class="row mt-15 pb-5" style="background-color: #dee2e6;border-radius:2px;height: 10%;">
                     <div class="col-6 item pt-5 border-right text-center">
                         ACCOUNT CODE
                     </div>
                     <div class="col-6 item pt-5 border-right text-center">
                         ACCOUNT NAME
                     </div>
                 </div>

                 <?php
                    while ($row_select = mysqli_fetch_assoc($res_select)) {
                    ?>
                     <div class="row pt-4 pb-4 border-buttom-bold" style="background-color: rgb(246 246 246);height: 10%">
                         <div class="col-6 p-Gross border-right bg-light text-left">
                             <?php echo $row_select['acc_code']; ?>
                         </div>
                         <div class="col-6 p-Gross border-right bg-light text-left">
                             <?php echo $row_select['acc_name']; ?>
                         </div>
                     </div>
                 <?php } ?>
             </div>
         </div>
     </div>
     <div class="scroll-container col-lg-8 pl-10">
         <div class="mt-15">
             <?php
                // Loop for 12 months
                for ($i = 0; $i < 12; $i++) {
                    $month = ($start_month + $i) % 12;
                    if ($month == 0) $month = 12;
                    $year = $current_year + intval(($start_month + $i - 1) / 12);
                    $monthName = date('F', mktime(0, 0, 0, $month, 1)); // 'F' returns the full month name
                    $monthNum = date('n', mktime(0, 0, 0, $month, 1)); // 'F' returns the full month name
              
                ?>
                 <div class="scroll-content col-lg-4 col-sm-6 col-12">
                     <div class="col-12 pr-10 pl-12">
                         <div class="row" style="background-color: #dee2e6;border-radius:2px;">
                             <div class="col-6 BTH-Month pl-3">
                                 <?php echo $monthName; ?>
                             </div>
                             <div class="col-6 caret-square text-end mt-3 pr-3">
                                 <img src="../images/icons/Dark/48px/CoolapseAside.png" class="images_CoolapseAside">
                             </div>
                             <div class="col-lg-4 pl-15">
                                 <div class="row">
                                     <div class="col-6 badge dge_AAR_green pt-3" style="height: 13px;">AC</div>
                                     <div class="col-6 AA-2022 pl-3"><?php echo $year; ?></div>
                                 </div>
                             </div>
                             <div class="col-lg-4 pl-15">
                                 <div class="row">
                                     <div class="col-6 badge dge_AAR_warning pt-3" style="height: 13px;">T</div>
                                     <div class="col-6 AA-2022 pl-3"><?php echo $year; ?></div>
                                 </div>
                             </div>
                             <div class="col-lg-4 pl-15">
                                 <div class="row">
                                     <div class="col-6 badge gbb_AC_blue pt-3" style="height: 13px;">T</div>
                                     <div class="col-6 AA-2022 pl-3"><?php echo $year + 1; ?></div>
                                 </div>
                             </div>
                         </div>
                     </div>
                     <div class="col-12 pr-12 pl-12 mt-5">
                         <?php
                            for ($j = 1; $j <= $num_select; $j++) {

                            ?>
                             <div class="row mb-7 pt-4 pb-4 border-buttom-bold" style="background-color: rgb(246 246 246);">
                                 <div class="col-4">
                                     <input type="text" class="form-control edit-numbermonth text-center pr-2 pl-2" id="actual_amount" name="actual_amount" value="<?php echo $row['actual_amount']; ?>" placeholder="0">
                                 </div>
                                 <div class="col-4">
                                     <input type="text" class="form-control edit-numbermonth text-center pr-2 pl-2" id="target_amount" name="target_amount" value="<?php echo $row['target_amount']; ?>" placeholder="0">
                                 </div>
                                 <div class="col-4">
                                     <input type="text" class="form-control edit-numbermonth text-center pr-2 pl-2" id="next_target_amount" name="next_target_amount" value="<?php echo $row['next_target_amount']; ?>" placeholder="0">
                                 </div>
                             </div>
                         <?php
                            }

                            ?>
                     </div>
                 </div>
             <?php } ?>
         </div>
     </div>
 </div>

 <?php
    mysqli_close($connection);
    ?>