<?php
include("../../../config/main_function.php");
$secure = "-%ekla!(m09)%1A7";
$connection = connectDB($secure);

$limit = mysqli_real_escape_string($connection, $_POST['limit']);
$companyId = mysqli_real_escape_string($connection, $_POST['company_group']);
$sql_company_group = "SELECT a.*,b.countryName,b.flag FROM company a LEFT JOIN country b ON a.countryId = b.countryId WHERE a.companyId = '$companyId';";
$res_company_group = mysqli_query($connection, $sql_company_group)  or die($connection->error);
$row_company_group = mysqli_fetch_assoc($res_company_group);
?>

<div class="row">
    <div class="col-3">
        <div class="card" style="border-radius: 15px;border:none;">
            <div class="row pl-15 pr-15 pb-10 pt-10">
                <div class="col-lg-3">
                    <img src="../image/cia.png" class="module_countrydashboard">
                </div>
                <div class="col-lg-9">
                    <div class="col-12 module_nametokyo">
                        <?php echo $row_company_group['companyName']; ?>
                    </div>
                    <div class="col-12">
                        <img src="../<?php echo $row_company_group['flag']; ?>" class="module_country">
                        <span class="font-size-10"> <?php echo $row_company_group['city']; ?> , <?php echo $row_company_group['countryName']; ?></span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-7 pt-20 pb-10">
                    <div class="col-12 font-size-12 pl-20">
                        companies
                    </div>
                    <div class="col-12 font-size-15 text-dark pl-20">
                        <strong>15</strong>
                    </div>
                    <div class="col-12 modules_font  pt-10 pl-20">
                        <div class="B_Registered"></div>
                        <div style="margin-top:-11px;padding-left:13px;">11 Registered company</div>
                    </div>
                    <div class="col-12 modules_font pl-20">
                        <div class="G_Registered"></div>
                        <div style="margin-top:-11px;padding-left:13px;">4 Not Registered</div>
                    </div>
                </div>
                <div class="col-lg-5 pt-5">
                    <div class="doughnut bg-1000">
                        <canvas branch="donutChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-5">
        <div class="card" style="border-radius: 15px;border:none;">
            <div class="row pt-5 pb-5">
                <div class="col-lg-2">
                    <div class="col-12">
                        <div class="btn-group" role="group" aria-label="Basic outlined example">
                            <button type="button" class="btn btn-outline-primary modules_fontasome"><i class="fa fa-list" aria-hidden="true"></i></button>
                            <button type="button" class="btn btn-outline-primary modules_fontasome"><i class="fa fa-line-chart" aria-hidden="true" data-bs-toggle="modal" data-bs-target="#linechart"></i></button>
                        </div>
                    </div>
                </div>
                <div class="col-4 Quick_view">
                    Quick View
                </div>
                <div class="col-lg-3">
                    <select class="selectpiicker form-select modules_selectmenu1" aria-label="Default select example">
                        <option selected value="">select menu</option>
                        <option value="1">BTH(฿)</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                </div>
                <div class="col-lg-3 text-end">
                    <select class="selectpiicker form-select modules_selectmenu2">
                        <option selected value="">select menu</option>
                        <option value="1">Sales</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-6">
                    <ol class="ol_number">
                        <?php
                        for ($i = 1; $i <= 4; $i++) {
                        ?>
                            <li class="ol_solid">Asty lnc <div class="text-end" style="margin-top:-17px;font-weight:600;font-size:10px;">
                                    400k</div>
                            </li>

                        <?php
                        }
                        ?>
                    </ol>
                </div>
                <div class="col-6">
                    <ol class="ol_number">
                        <?php
                        for ($i = 1; $i <= 4; $i++) {
                        ?>
                            <li class="ol_solid">Asty lnc <div class="text-end" style="margin-top:-17px;font-weight:600;font-size:10px;">
                                    25.000M</div>
                            </li>

                        <?php
                        }
                        ?>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="col-4">
        <div class="card" style="border-radius: 15px;border:none;">
            <div class="row">
                <div class="col-lg-6">
                    <div class="col-12 pt-10 pb-10 pl-20 PL_configuration_modules">
                        PL Configuration
                    </div>

                    <div class="col-12 pl-20 pt-20">
                        <i class="fa fa-check check_green_modules font-size-12" aria-hidden="true"></i>
                        <span class="PL_Flow"> Registered PL Flow</span>
                    </div>
                    <div class="col-12 pl-20 pt-6">
                        <i class="fa fa-check check_green_modules font-size-12" aria-hidden="true"></i>
                        <span class="PL_Flow"> PL Category</span>
                    </div>
                    <div class="col-12 pl-20 pt-6">
                        <i class="fa fa-check check_green_modules font-size-12" aria-hidden="true"></i>
                        <span class="PL_Flow"> PL Sub-Category</span>
                    </div>
                    <div class="col-12 pl-20 pt-6">
                        <i class="fa fa-check check_green_modules font-size-12" aria-hidden="true"></i>
                        <span class="PL_Flow"> PL Category Breakdown</span>
                    </div>

                </div>
                <div class="col-lg-6">
                    <div class="col-12 pl-20 pt-20">
                        <i class="fa fa-check text-secondary font-size-12" aria-hidden="true"></i>
                        <span class="text-secondary font-size-12"> Registered PL Flow</span>
                    </div>

                    <div class="col-12">
                        <div class="badge bg-Modules-config1">Configuration Modules <img src="../images/icons/Dark/48px/ArrowRight.png" class="ArrowRight_png">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <?php
    $sql_branch = "SELECT a.*,b.*,c.countryName,c.flag FROM branch a 
        LEFT JOIN company b ON a.companyId = b.companyId
        LEFT JOIN country c ON b.countryId = c.countryId
        WHERE a.companyId = '$companyId' LIMIT $limit,6";
    $res_branch = mysqli_query($connection, $sql_branch)  or die($connection->error);
    while ($row_branch = mysqli_fetch_assoc($res_branch)) {
    ?>
        <div class="col-lg-4">
            <div class="card" style="border-radius: 7px;border:none;">
                <div class="row pl-10 pr-10 pb-10 pt-10">
                    <div class="col-lg-2">
                        <img src="../image/search-google.png" class="module_countrydashboard">
                    </div>
                    <div class="col-lg-7">
                        <div class="col-12 module_nametokyo">
                            <!-- <a href="register_pl_flow_add.php?branch=<?php echo $row_branch['branchId']; ?>" class="no-underline-black"><?php echo $row_branch['branchName']; ?></a> -->
                            <?php echo $row_branch['branchName']; ?>
                        </div>
                        <div class="col-12">
                            <img src="../<?php echo $row_company_group['flag']; ?>" class="module_country">
                            <span class="font-size-10"> <?php echo $row_branch['city']; ?> , <?php echo $row_branch['countryName']; ?></span>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="badge bg-light"><img src="../images/icons/Dark/48px/Edit.png" class="edit_png" onclick="getModalEditBranch(<?php echo $row_branch['branchId']; ?>)">
                        </div>
                        <div class="badge bg-light"><img src="../images/icons/Dark/48px/red-dele.png" class="delete_png">
                        </div>
                    </div>
                </div>
                <div class="row pl-10 pr-10 pb-10 pt-5">
                    <div class="col-8">
                        <div class="card" style="background-color:#f8f8f8;">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="col-12 Financial-Year-modules1">
                                        Financial Year
                                    </div>
                                    <div class="col-12 f2_num">
                                        2024
                                    </div>
                                    <div class="col-12 tr_num">
                                        jan 24 - dec 24
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="col-12 Current-modules2">
                                        <div class="badge rounded-pill bg-Current-m"> Current</div>
                                    </div>
                                    <div class="col-12" style="border-left: 1px lightgray solid;margin-top:10px;">
                                        <div class="col-12">
                                            <img src="../images/icons/Dark/48px/check-1.png" class="check-1_png"> <span class="font-size-10">Actual</span>
                                        </div>
                                        <div class="col-12">
                                            <img src="../images/icons/Dark/48px/check-1.png" class="check-1_png"> <span class="font-size-10">Target</span>
                                        </div>
                                        <div class="col-12">
                                            <img src="../images/icons/Dark/48px/check-1.png" class="check-1_png"> <span class="font-size-10">Forecasted</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-4 pt-8">
                        <div class="col-12">
                            <div class="Cf_m1" style="cursor: pointer;" onclick="location.href='register_pl_flow_add.php?branch=<?php echo $row_branch['branchId']; ?>'"> Config <div class="text-end" style="margin-top:-15px;"> <a><i class="fa fa-external-link" aria-hidden="true" style="cursor: pointer;"></i></a></div>
                            </div>
                        </div>
                        <div class="col-12 pt-10">
                            <div class="Cf_m1" style="cursor: pointer;" onclick="location.href='fs_index.php?branch=<?php echo $row_branch['branchId']; ?>'"> PL Portal <div class="text-end" style="margin-top:-15px;"><a><i class="fa fa-external-link" aria-hidden="true" style="cursor: pointer;"></i></a></div>
                            </div>
                        </div>
                        <div class="col-12 pt-25 text-end">
                            <!-- <a href="register_pl_flow_add.php?branch=<?php echo $row_branch['branchId']; ?>" class="font-size-12"> See Detail <img src="../images/icons/Dark/48px/angle-circle-right1.png" class="check-1_png"></a> -->
                            <a href="fs_fy.php?branch=<?php echo $row_branch['branchId']; ?>" class="font-size-12"> See Detail <img src="../images/icons/Dark/48px/angle-circle-right1.png" class="check-1_png"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php
    }
    ?>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>

<script>
    const bbb = document.getElementById('donutChart');
    const xValues = [];
    const yValues = [55, 49];
    const barColors = [
        "rgb(30, 98, 233)",
        "rgb(165, 166, 166)"
    ];

    new Chart(bbb, {
        type: "doughnut",
        data: {
            labels: xValues,
            datasets: [{
                backgroundColor: barColors,
                data: yValues
            }]
        },
        options: {
            title: {
                display: true
            }
        }
    });
</script>