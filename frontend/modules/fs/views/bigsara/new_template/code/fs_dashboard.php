<html>

<title>Financial Module Dashboard</title>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <link href="../css/layout/font.css?v=<?= date("YmdHis"); ?>" rel="stylesheet">
    <link href="../css/layout/layout.css?v=<?= date("YmdHis"); ?>" rel="stylesheet">
    <link href="../css/fs.css?v=<?= date("YmdHis"); ?>" rel="stylesheet">
    <link href="../css/fs_view.css?v=<?= date("YmdHis"); ?>" rel="stylesheet">
    <link href="../css/fs.module.css?v=<?= date("YmdHis"); ?>" rel="stylesheet">
</head>

<body>
    <div class="col-12">
        <div class="col-12 alert background-Planning">
            <div class="row">
                <div class="col-lg-6">
                    <div class="row">
                        <div class="col-5 fst1-modulesdashboard">
                            Financial Module Dashboard
                        </div>
                        <div class="col-3">
                            <button class="btn btn-primary btn-Create-sb pb-2 pt-2 pl-10" type="submit" data-bs-toggle="modal" data-bs-target="#staticBackdropmodulescreate"> <img src="../images/icons/Light/Light/24px/Create(Big).png" class="module_CreateBig">
                                Create</button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="row">
                        <div class="col-6">
                            <select class="form-select example-tok" aria-label="Default select example">
                                <option selected value="">Select</option>
                                <option value="1">Tokyo Consulting Group</option>
                                <option value="2">Tokyo Consulting firm</option>
                            </select>
                        </div>
                        <div class="col-5">
                            <div class="col-12">
                                <script>
                                    $('input[name="dates"]').daterangepicker();
                                </script>
                                <input type="month" class="form-control" style="border-radius: 20px;font-size:12px;" name="dates" value="01/01/2018 - 01/15/2018" />
                            </div>
                        </div>
                        <div class="col-1">
                            <i class="fa fa-search font-size-16 pt-10" aria-hidden="true" type="submit"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 pt-10">
                <div class="row">
                    <div class="col-3">
                        <div class="card" style="border-radius: 15px;border:none;">
                            <div class="row pl-15 pr-15 pb-10 pt-10">
                                <div class="col-lg-3">
                                    <img src="../image/cia.png" class="module_countrydashboard">
                                </div>
                                <div class="col-lg-9">
                                    <div class="col-12 module_nametokyo">
                                        Tokyo consulting Group
                                    </div>
                                    <div class="col-12">
                                        <img src="../image/Thailand.png" class="module_country">
                                        <span class="font-size-10"> Tokyo,Japan</span>
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
                    for ($i = 1; $i <= 6; $i++) {
                    ?>
                        <div class="col-lg-4" style="margin-top: <?= $i == 15 ?: '10px;' ?>">
                            <div class="card" style="border-radius: 7px;border:none;">
                                <div class="row pl-10 pr-10 pb-10 pt-10">
                                    <div class="col-lg-2">
                                        <img src="../image/search-google.png" class="module_countrydashboard">
                                    </div>
                                    <div class="col-lg-7">
                                        <div class="col-12 module_nametokyo">
                                            Tokyo consulting Group
                                        </div>
                                        <div class="col-12">
                                            <img src="../image/is.jpg" class="module_country">
                                            <span class="font-size-10"> Dhaka, Bangladesh</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="badge bg-light"><img src="../images/icons/Dark/48px/Edit.png" class="edit_png">
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
                                            <div class="Cf_m1"> Config <div class="text-end" style="margin-top:-15px;"> <i class="fa fa-external-link" aria-hidden="true" style="cursor: pointer;"></i></div>
                                            </div>
                                        </div>
                                        <div class="col-12 pt-10">
                                            <div class="Cf_m1"> PL Portal <div class="text-end" style="margin-top:-15px;"><i class="fa fa-external-link" aria-hidden="true" style="cursor: pointer;"></i></div>
                                            </div>
                                        </div>
                                        <div class="col-12 pt-25 text-end">
                                            <a href="#" class="font-size-12"> See Detail <img src="../images/icons/Dark/48px/angle-circle-right1.png" class="check-1_png"></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 text-center">
        <div class="btn-group" role="group" aria-label="First group">
            <button type="button" class="btn btn-light font-size-11"> <i class="fa fa-chevron-left" aria-hidden="true"></i>
                Previous</button>
        </div>
        <div class="btn-group" role="group" aria-label="Second group">
            <button type="button" class="btn btn-light font-size-11">1</button>
            <button type="button" class="btn btn-light font-size-11">2</button>
            <button type="button" class="btn btn-light font-size-11">3</button>
            <button type="button" class="btn btn-light font-size-11">4</button>
        </div>
        <div class="btn-group" role="group" aria-label="Third group">
            <button type="button" class="btn btn-light font-size-11"> Next <i class="fa fa-chevron-right" aria-hidden="true"></i></button>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="staticBackdropmodulescreate" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title text-primary" id="staticBackdropLabel"><i class="fa fa-magic text-primary" aria-hidden="true"></i> Create Financial Modules</h6>
                    <button type="button" class="btn-close font-size-13" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="col-12">
                                    <label for="exampleFormControl" class="form-label lb_moon"><span class="text-danger">*</span>
                                        Company</label>
                                    <select class="form-select pb-5 pt-5 font-size-13" aria-label="Default select example">
                                        <option selected value="">Select company</option>
                                        <option value="1">Tokyo consulting Firm</option>
                                        <option value="2">Tokyo Consulting Group</option>
                                        <option value="3">Tokyo Consulting Group</option>
                                    </select>
                                </div>
                                <div class="col-12 mt-30">
                                    <label for="start" class="form-label lb_moon"><span class="text-danger">*</span>
                                        Select FY Start Period</label>
                                    <div class="input-group flex-nowrap">
                                        <span class="input-group-text pb-5 pt-5 font-size-13" id="addon-wrapping" type="date"><img src="../images/icons/Dark/24px/Calender.png" class="Calender_big">
                                            Forecast Period</span>
                                        <input class="form-control pb-5 pt-5 font-size-13" type="month" id="start" name="start" min="2018-03" value="2018-05" />
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-4 pt-20">
                                            <label for="exampleFormControl" class="form-label lb_moon">Previous</label>
                                            <div class="bg-light-Actual pb-5 pt-5">2022</div>
                                        </div>
                                        <div class="col-4 pt-20">
                                            <label for="exampleFormControl" class="form-label lb_moon">Actual</label>
                                            <div class="bg-light-Actual pb-5 pt-5">2023</div>
                                        </div>
                                        <div class="col-4 pt-20">
                                            <label for="exampleFormControl" class="form-label lb_moon">Forecasted
                                                Year</label>
                                            <div class="bg-light-Actual pb-5 pt-5">2024</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="col-12">
                                    <label for="exampleFormControl" class="form-label lb_moon"><span class="text-danger">*</span>
                                        Branch</label>
                                    <select class="form-select pb-5 pt-5 font-size-13" aria-label="Default select example">
                                        <option selected value="">Select company</option>
                                        <option value="1">Tokyo consulting Firm</option>
                                        <option value="2">Tokyo Consulting Group</option>
                                        <option value="3">Tokyo Consulting Group</option>
                                    </select>
                                </div>
                                <div class="col-12 mt-30">
                                    <label for="end" class="form-label lb_moon"><span class="text-danger">*</span>
                                        Select FY End Period</label>
                                    <div class="input-group flex-nowrap font-size-13">
                                        <span class="input-group-text pb-5 pt-5 font-size-13" id="addon-wrapping" type="date"><img src="../images/icons/Dark/24px/Calender.png" class="Calender_big">
                                            Forecast Previod</span>
                                        <input type="month" class="form-control pb-5 pt-5 font-size-13" id="start" name="start" min="2018-03" value="2018-05" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="border:none;">
                    <button type="button" class="btn outlinelightgray" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary putlineprimary" data-bs-dismiss="modal">Create</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="linechart" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ...
                </div>
            </div>
        </div>
    </div>

    <div class="doughnut">
        <canvas id="donutChart" style="width:50%;max-width:250px"></canvas>

        <script>
            const xValues = [];
            const yValues = [55, 49];
            const barColors = [
                "rgb(30, 98, 233)",
                "rgb(165, 166, 166)"
            ];

            new Chart("donutChart", {
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
    </div>
</body>