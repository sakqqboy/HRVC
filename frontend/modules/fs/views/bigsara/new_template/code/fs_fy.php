<html>

<title>PL register flow</title>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="../css/layout/font.css?v=<?= date("YmdHis"); ?>" rel="stylesheet">
    <link href="../css/layout/layout.css?v=<?= date("YmdHis"); ?>" rel="stylesheet">
    <link href="../css/fs.css?v=<?= date("YmdHis"); ?>" rel="stylesheet">
    <link href="../css/f_y.css?v=<?= date("YmdHis"); ?>" rel="stylesheet">

</head>

<body>
    <div class="alert background-Planning mt-10 font-family">
        <div class="col-12 pt-20 pb-20 pr-20 pl-20 font-family" style="background-color: white;border-radius:3px;">
            <div class="row">
                <div class="col-3">
                    <div class="col-12 font-b font-size-16">
                        Tokyo Consulting Firm Limited
                    </div>
                    <div class="col-12">
                        <img src="../image/is.jpg" class="FY_country"> <span class="font-size-12">Izmir, Turkey</span>
                    </div>
                </div>
                <div class="col-2 text-end">
                    <button class="btn btn-primary btn-Create-fy pb-4 pt-4" type="submit" data-bs-toggle="modal" data-bs-target="#staticBackdropmodulescreate"> <img src="../images/icons/Light/Light/24px/Create(Big).png" class="FY_CreateBig"> Create</button>
                </div>
                <div class="col-3">
                    <button class="btn btn-light btn-dashboard-fy text-primary pb-4 pt-4 font-size-12" type="submit" data-bs-toggle="modal" data-bs-target="#"> <i class="fa fa-th-large" aria-hidden="true"></i> Dashboard</button>
                </div>
                <div class="col-1">
                    <select class="form-select fy_select pt-5 pb-5" aria-label="Default select example">
                        <option selected value="">All</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                </div>
                <div class="col-2">
                    <select class="form-select fy_select pt-5 pb-5" aria-label="Default select example">
                        <option selected value="">Forecast</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                </div>
                <div class="col-1">
                    <select class="form-select fy_select pt-5 pb-5" aria-label="Default select example">
                        <option selected value="">F.Y</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                </div>
            </div>
            <div class="row mt-10">
                <div class="col-4">
                    <div class="alert" style="background-color: #f0f5fb;border:none;border-radius:5px;">
                        <div class="card table_fyfinancial border-0">
                            <div class="row">
                                <div class="col-3">
                                    <div class="col-12 tb-fy-financial">
                                        financial
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="col-12 tb-fy-financial">
                                        start date
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="col-12 tb-fy-financial">
                                        end date
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="col-12 tb-fy-financial text-center">
                                        view
                                    </div>
                                </div>
                            </div>
                        </div>


                        <?php
                        for ($i = 1; $i <= 13; $i++) {
                        ?>

                            <div class="card bg-white border-0 pl-10 pr-10">
                                <div class="row">
                                    <div class="col-3">
                                        <div class="col-12 tb-fy-financial">
                                            2020
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="col-12 tb-fy-financial">
                                            <i class="fa fa-clock-o text-primary" aria-hidden="true"></i> FEB 2020
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="col-12 tb-fy-financial">
                                            <i class="fa fa-clock-o text-primary" aria-hidden="true"></i> FEB 2020
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="col-12 tb-fy-financial text-center">
                                            <i class="fa fa-eye text-primary font-size-15 pl-5" aria-hidden="true" style="cursor: pointer;"></i>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        <?php
                        }
                        ?>

                    </div>
                </div>
                <div class="col-8 pb-20">
                    <div class="alert" style="background-color: #f0f5fb;border:none;border-radius:5px;">
                        <div class="row pt-10">
                            <div class="col-lg-10 col-md-2 col-sm-4 col-12">
                                <div class="row">
                                    <div class="col-1">
                                        <img src="../image/userProfile.png" class="country_company">
                                    </div>
                                    <div class="col-11 pl-20">
                                        <span class="font-size-13 font-b">Tokyo Consulting Firm Philippine</span>
                                        <div class="col-12"><img src="../image/is.jpg" class="FY_country"> <span class="font-size-12">Izmir, Turkey</span></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-4 col-12">
                                <div class="row">
                                    <div class="col-3">
                                        <button class="btn btn-outline-secondary pr-5 pl-5 pt-4 pb-4" type="submit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                                    </div>
                                    <div class="col-3">
                                        <button class="btn btn-outline-danger pr-5 pl-5 pt-4 pb-4" type="submit"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mt-20">
                            <div class="border-0 pb-3 pt-3" style="background-color: white;">
                                <div class="row">
                                    <?php
                                    for ($i = 1; $i <= 6; $i++) {
                                    ?>

                                        <div style="width:14.28% ;" class=" text-center pr-10 pl-10">
                                            <button class="btn bg-light font-size-12 pt-10 pb-10 pr-10 pl-10" type="button"> F.Y. 2024</button>
                                        </div>

                                    <?php
                                    }
                                    ?>
                                    <div style="width:14.28% ;" class="text-center pt-8">
                                        <img src="../images/icons/Dark/48px/Create(Small).png" class="plush_crt">
                                    </div>
                                </div>
                            </div>
                            <div class="card border-0 pb-10 pt-10">
                                <div class="row">
                                    <div class="col-4 text-center">
                                        <div class="months_fy_countrys">jan</div>
                                        <div class="months_fy_countrys_number">2024</div>
                                    </div>
                                    <div class="col-4 text-center">
                                        <div class="font-size-14">F.Y. 2024</div>
                                        <div class="font-b">Profit & Loss Forecast</div>
                                    </div>
                                    <div class="col-4 text-center">
                                        <div class="months_fy_countrys">dec</div>
                                        <div class="months_fy_countrys_number">2024</div>
                                    </div>
                                </div>
                                <div class="row font-size-14">
                                    <div class="col-6 mt-10">
                                        <div class="col-12">
                                            Sales
                                        </div>
                                    </div>
                                    <div class="col-6 mt-10">
                                        <div class="col-12">
                                            Gross Profit
                                        </div>
                                    </div>
                                </div>

                                <div class="row">

                                    <?php
                                    for ($i = 1; $i <= 2; $i++) {
                                    ?>
                                        <div class="col-6 mt-20">
                                            <div class="row pl-10 pr-10">
                                                <div class="col-2 font-size-12">
                                                    2022
                                                </div>
                                                <div class="col-10 mt-5">
                                                    <div class="progress" style="height: 9px;">
                                                        <div class="progress-bar" role="progressbar" style="width: 60%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                                <div class="col-2 font-size-12">
                                                    2023
                                                </div>
                                                <div class="col-10 mt-5">
                                                    <div class="progress" style="height: 9px;">
                                                        <div class="progress-bar" role="progressbar" style="width: 80%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    <?php
                                    }
                                    ?>
                                </div>
                                <div class="row">

                                    <?php
                                    for ($i = 1; $i <= 4; $i++) {
                                    ?>

                                        <div class="col-3 mt-20">
                                            <div class="col-12 text-center font-size-13">
                                                2020
                                            </div>
                                            <div class="row mt-10 pt-10 border-right" style="letter-spacing: 0.1px;">
                                                <div class="col-7 font-size-10">
                                                    <img src="../images/icons/Dark/48px/Achievement.png" style="width: 13px;"> Achievement
                                                </div>
                                                <div class="col-5 font-size-10">
                                                    49 Milion
                                                </div>
                                                <div class="col-7 font-size-10 mt-5">
                                                    <img src="../images/icons/Dark/48px/Target.png" style="width: 13px;"> Target
                                                </div>
                                                <div class="col-5 font-size-10 mt-5">
                                                    56 Milion
                                                </div>
                                            </div>
                                        </div>

                                    <?php
                                    }
                                    ?>

                                </div>
                                <div class="col-12 mt-30">
                                    <div class="card border-0 pt-5 pb-5" style="box-shadow: rgba(0, 0, 0, 0.12) 0px 1px 3px, rgba(0, 0, 0, 0.24) 0px 1px 2px;border-radius:4px;background-color:#ffffff;">
                                        <div class="row font-size-9 font-b">
                                            <div class="col-lg-1">
                                                SL :
                                            </div>
                                            <div class="col-lg-2">
                                                PL Name :
                                            </div>
                                            <div class="col-lg-2">
                                                PL Categories :
                                            </div>
                                            <div class="col-lg-2">
                                                PL Sub-categories :
                                            </div>
                                            <div class="col-lg-2">
                                                Categories Enddown :
                                            </div>
                                            <div class="col-lg-2">
                                                Cash Flow Categories :
                                            </div>
                                            <div class="col-lg-1 font-size-13">
                                                <div class="badge bg-primary text-white">3</div>
                                            </div>
                                        </div>
                                    </div>

                                    <?php
                                    for ($i = 1; $i <= 3; $i++) {
                                    ?>

                                        <div class="card mt-10 pt-4 pb-4" style="box-shadow: rgba(0, 0, 0, 0.1) 0px 0px 5px 0px, rgba(0, 0, 0, 0.1) 0px 0px 1px 0px;">
                                            <div class="row font-size-10">
                                                <div class="col-lg-1">
                                                    #01
                                                </div>
                                                <div class="col-lg-2">
                                                    PL-01 Expense
                                                </div>
                                                <div class="col-lg-2">
                                                    Expense coast
                                                </div>
                                                <div class="col-lg-2">
                                                    Sub-categories(Cast)
                                                </div>
                                                <div class="col-lg-2">
                                                    Laboor cast(CS)
                                                </div>
                                                <div class="col-lg-2">
                                                    Flow Categories :
                                                </div>
                                                <div class="col-lg-1">
                                                    <i class="fa fa-pencil-square-o text-primary font-size-14" aria-hidden="true" style="cursor: pointer;"></i>&nbsp;&nbsp;
                                                    <i class="fa fa-trash-o text-danger font-size-14" aria-hidden="true" style="cursor: pointer;"></i>
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
                </div>
            </div>
        </div>
    </div>
</body>



</html>