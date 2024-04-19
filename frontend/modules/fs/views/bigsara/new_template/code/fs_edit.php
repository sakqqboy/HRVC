<html>

<title>Financial Planning Edit</title>

<Head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="../css/layout/font.css?v=<?= date("YmdHis"); ?>" rel="stylesheet">
    <link href="../css/layout/layout.css?v=<?= date("YmdHis"); ?>" rel="stylesheet">
    <link href="../css/fs.css?v=<?= date("YmdHis"); ?>" rel="stylesheet">

</Head>

<body>
    <div class="col-12">
        <div class="col-12 alert background-Planning">
            <div class="col-12 planning">
                <img src="../images/icons/Dark/48px/FinanicalPlanning.png" class="images_Dark_FinanicalPlanning"> Financial Planning
            </div>
            <div class="col-12 mt-10">
                <div class="shadow pb-5 pt-5 mb-5 bg-body rounded alert2-secondary3">
                    <ul class="nav nav-pills" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link text-dark" id="pills-Forcast-tab" data-bs-toggle="pill" data-bs-target="#pills-Forcast" type="button" role="tab" aria-controls="pills-Forcast" aria-selected="true"><img src="../images/icons/Dark/48px/PL-Forecast.png" class="images_performance_PL"> PL Forcast</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link text-dark" id="pills-Golden-tab" data-bs-toggle="pill" data-bs-target="#pills-Golden" type="button" role="tab" aria-controls="pills-Golden" aria-selected="false"><img src="../images/icons/Dark/48px/Golden-Ratio.png" class="images_performance_PL"> Golden Ratio</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link text-dark" id="pills-Accounts-tab" data-bs-toggle="pill" data-bs-target="#pills-Accounts" type="button" role="tab" aria-controls="pills-Accounts" aria-selected="false"><img src="../images/icons/Dark/48px/Designation-1.png" class="images_performance_PL"> Forecast Accounts</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-12 mt-15">
                <div class="alert alert2-secondary3 pr-5">
                    <div class="row">
                        <div class="col-2">
                            <div class="row">
                                <div class="col-2 ">
                                    <span class="badge bg-primary-summary">PL</span>
                                </div>
                                <div class="col-10">
                                    Profit & Loss Forecast
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <button type="button" class="btn btn-primary bgrd-save">Save</button>
                            <button type="submit" class="btn  bgrd-cancel ml-10">Cancel</button>
                        </div>
                        <div class="col-3">
                            <select class="form-select example-tok">
                                <option selected value="">Select</option>
                                <option value="1">Tokyo Consulting Group</option>
                                <option value="2">Tokyo Consulting firm</option>
                            </select>
                        </div>
                        <div class="row mt-10 pr-0">
                            <div class="col-lg-5 col-11">
                                <div class="col-11">
                                    <div class="row " style="background-color: #dee2e6;border-radius:2px;">
                                        <div class="col-3 text-secondary pl-5 pr-2 pt-5">
                                            <img src="../image/calendar.png" style="width: 13px;"> &nbsp;
                                            <span class="font-size-12">Current Year</span>
                                        </div>
                                        <div class="col-4 pt-3 pb-3">
                                            <select class="form-select text-primary" style="height: 25px;font-size:10px;">
                                                <option value="2020">2020</option>
                                                <option value="2021">2021</option>
                                                <option value="2022">2022</option>
                                                <option value="2023">2024</option>
                                            </select>
                                        </div>
                                        <div class="col-5 text-end pt-10">
                                            <strong class="text-secondary font-size-12">F.Y.2023</strong>
                                        </div>
                                    </div>
                                    <div class="row pr-0 pl-0 mt-5">
                                        <div class="col-4 line mt-15"></div>
                                        <div class="col-4 font-size-10 mt-8 text-center" style="letter-spacing: 1px;">ANNUAL SUMMARY</div>
                                        <div class="col-4 line mt-15"></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-11">
                                        <div class="row mt-15 pb-5" style="background-color: #dee2e6;border-radius:2px;">
                                            <div class="col-3 item pt-5 border-right text-center">
                                                ITEMS
                                            </div>
                                            <div class="col-2">
                                                <div class="row pl-10">
                                                    <div class="col-5 badge dge_AAR_blue font-size-8 mt-5 pt-5 pl-3">AAR</div>
                                                    <div class="col-6 AA-2022 pl-3 pt-5">2022</div>
                                                </div>
                                            </div>
                                            <div class="col-2">
                                                <div class="row pl-10">
                                                    <div class="col-5 badge dge_AAR_green font-size-8 mt-5 pt-5 pl-3">AAR</div>
                                                    <div class="col-6 AA-2022 pl-3 pt-5">2023</div>
                                                </div>
                                            </div>
                                            <div class="col-3 pl-10">
                                                <div class="row">
                                                    <div class="col-4 badge dge_AAR_warning font-size-8 mt-5 pt-5">AT</div>
                                                    <div class="col-4 AA-2022 pt-5 pl-7">2023</div>
                                                    <div class="col-4 badge dge_AAR_warning font-size-8 mt-5 pt-5">ATR</div>
                                                </div>
                                            </div>
                                            <div class="col-2">
                                                <div class="row pl-12">
                                                    <div class="col-5 badge dge_AAR_light_blue font-size-8 mt-5 pt-5 pl-3 pr-3">ATR</div>
                                                    <div class="col-6 AA-2022 pl-3 pt-5">2024</div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                        for ($i = 1; $i <= 15; $i++) {
                                        ?>
                                            <div class="row mt-5 border-buttom pb-5">
                                                <div class="col-3 p-Gross border-right bg-light text-left pt-13">
                                                    Sales
                                                </div>
                                                <div class="col-2 border-right bg-light pt-5 pb-5">
                                                    <div role="progressbar1" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100" style="--value:35"></div>
                                                </div>
                                                <div class="col-2 border-right bg-light pt-5 pb-5">
                                                    <div role="progressbar2" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="--value:75"></div>
                                                </div>
                                                <div class="col-3 border-right bg-light pt-15 pb-5 pl-17">
                                                    <span class="numberrformat"><?= number_format(24700) ?> </span>
                                                    <div role="progressbar3" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="--value:100"></div>
                                                </div>
                                                <div class="col-2 bg-light pt-5 pb-5">
                                                    <div role="progressbar1" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="--value:100"></div>
                                                </div>
                                            </div>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                    <div class="col-1 mt-15  pl-15 pr-15">
                                        <div class="row">
                                            <div class="col-12 text-center pt-8 pb-18" style="background-color:#dee2e6;">
                                                <img src="../images/icons/Dark/48px/Edit.png" class="icons_Edits">
                                            </div>
                                        </div>
                                        <?php
                                        for ($i = 1; $i <= 15; $i++) {
                                        ?>
                                            <div class="row" style="height:<?= $i == 15 ? '38px;' : '51px;' ?>background-color:#dee2e6;">
                                                <div class="col-12 text-center">
                                                    <img src="../images/icons/Dark/48px/Monthly.png" class="icons_Monthly">
                                                    <div class="m-calendar mt-2"></div>
                                                </div>
                                                <div class="col-12 text-center" style="margin-top: <?= $i == 15 ? '-9px;' : '-18px;' ?>">
                                                    <img src="../images/icons/Dark/48px/Accumulated.png" class="icons_Monthly">
                                                </div>
                                            </div>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <div class="row " style="background-color: #dee2e6;border-radius:2px;">
                                    <div class="col-12 font-size-11 text-end pt-2 pb-3">
                                        <a class="btn btn-light font-size-10 no-border mr-5 font-b">All</a>
                                        <a class="btn btn-outline-secondary font-size-10 no-border mr-5 font-b">Q1</a>
                                        <a class="btn btn-outline-secondary font-size-10 no-border mr-5 font-b">Q2</a>
                                        <a class="btn btn-outline-secondary font-size-10 no-border font-b">Q3</a>
                                    </div>
                                </div>
                                <div class="row pr-0 pl-0 mt-5">
                                    <div class="col-5 line mt-15"></div>
                                    <div class="col-2 font-size-10 mt-8 text-center" style="letter-spacing: 1px;">ALL</div>
                                    <div class="col-5 line mt-15"></div>
                                </div>
                                <div class="row mt-15">
                                    <?php
                                    $months = ["January", "February", "March"];
                                    foreach ($months as $month) :
                                    ?>
                                        <div class="col-lg-4 col-sm-6 col-12 pl-5 pr-5">
                                            <div class="col-12 pr-10 pl-12">
                                                <div class="row" style="background-color: #dee2e6;border-radius:2px;">
                                                    <div class="col-6 BTH-Month pl-3">
                                                        <?= $month ?>
                                                    </div>
                                                    <div class="col-6 caret-square text-end mt-3 pr-3">
                                                        <img src="../images/icons/Dark/48px/CoolapseAside.png" class="images_CoolapseAside">
                                                    </div>
                                                    <div class="col-lg-3 pl-15">
                                                        <div class="row">
                                                            <div class="col-6 badge gbb_AC_blue pt-3" style="height: 13px;">AC</div>
                                                            <div class="col-6 AA-2022 pl-3">2022</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 pl-15">
                                                        <div class="row">
                                                            <div class="col-6 badge dge_AAR_green pt-3" style="height: 13px;">AC</div>
                                                            <div class="col-6 AA-2022 pl-3">2023</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 pl-15">
                                                        <div class="row">
                                                            <div class="col-6 badge dge_AAR_warning pt-3" style="height: 13px;">T</div>
                                                            <div class="col-6 AA-2022 pl-3">2023</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 pl-15">
                                                        <div class="row">
                                                            <div class="col-6 badge gbb_AC_blue pt-3" style="height: 13px;">T</div>
                                                            <div class="col-6 AA-2022 pl-3">2024</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 pr-12 pl-12 mt-5">
                                                <?php
                                                for ($i = 1; $i <= 15; $i++) {
                                                ?>
                                                    <div class="row mb-7 pt-4 pb-4 border-buttom-bold" style="background-color: rgb(246 246 246);">
                                                        <div class="col-3 border-buttom mb-2 pb-2">
                                                            <input type="text" class="form-control edit-numbermonth text-center pr-2 pl-2" id="" placeholder="0">
                                                        </div>
                                                        <div class="col-3 border-buttom mb-2 pb-2">
                                                            <input type="text" class="form-control edit-numbermonth text-center pr-2 pl-2" id="" placeholder="0">
                                                        </div>
                                                        <div class="col-3 border-buttom mb-2 pb-2">
                                                            <input type="text" class="form-control edit-numbermonth text-center pr-2 pl-2" id="" placeholder="0">
                                                        </div>
                                                        <div class="col-3 border-buttom mb-2 pb-2">
                                                            <input type="text" class="form-control edit-numbermonth text-center pr-2 pl-2" id="" placeholder="0">
                                                        </div>
                                                        <div class="col-3">
                                                            <input type="text" class="form-control edit-numbermonth text-center pr-2 pl-2" id="" placeholder="0">
                                                        </div>
                                                        <div class="col-3">
                                                            <input type="text" class="form-control edit-numbermonth text-center pr-2 pl-2" id="" placeholder="0">
                                                        </div>
                                                        <div class="col-3">
                                                            <input type="text" class="form-control edit-numbermonth text-center pr-2 pl-2" id="" placeholder="0">
                                                        </div>
                                                        <div class="col-3">
                                                            <input type="text" class="form-control edit-numbermonth text-center pr-2 pl-2" id="" placeholder="0">
                                                        </div>

                                                    </div>
                                                <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    <?php
                                    endforeach;
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