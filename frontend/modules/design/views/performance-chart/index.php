<?php
$this->title = 'Performance Chart';
?>

<div class="col-12 mt-90 alert background-Planning">
    <div class="col-12 planning">
        <i class="fa fa-database" aria-hidden="true"></i> Financial Planning
    </div>
    <div class="col-12 mt-20">
        <div class="shadow p-3 mb-5 bg-body rounded alert2-secondary3">
            <ul class="nav nav-pills" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link text-dark" id="pills-Forcast-tab" data-bs-toggle="pill" data-bs-target="#pills-Forcast" type="button" role="tab" aria-controls="pills-Forcast" aria-selected="true"> <i class="fa fa-usd" aria-hidden="true"></i> PL Forcast</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link text-dark" id="pills-Golden-tab" data-bs-toggle="pill" data-bs-target="#pills-Golden" type="button" role="tab" aria-controls="pills-Golden" aria-selected="false"> Golden Ratio</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link text-dark" id="pills-Accounts-tab" data-bs-toggle="pill" data-bs-target="#pills-Accounts" type="button" role="tab" aria-controls="pills-Accounts" aria-selected="false"> <i class="fa fa-clock-o" aria-hidden="true"></i> Forecast Accounts</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="col-12 mt-50">
        <div class="alert alert2-secondary3">
            <div class="row">
                <div class="col-lg-4 col-12">
                    <span class="badge bg-primary-summary">PL</span> <span class="Profit-Loss">Profit & Loss Forecast</span>
                </div>
                <div class="col-lg-8 col-12 text-end">
                    <button type="button" class="btn btn-light Data" data-bs-toggle="modal" data-bs-target="#DataDistionary"><i class="fa fa-info-circle" aria-hidden="true"></i> Data Dictionary</button>
                    <div class="btn-group" role="group" aria-label="Basic outlined example">
                        <button type="button" class="btn btn-outline-secondary font-size-12"><i class="fa fa-bar-chart" aria-hidden="true"></i></button>
                        <button type="button" class="btn btn-outline-secondary font-size-12">Performance Chart</button>
                        <button type="button" class="btn btn-outline-secondary font-size-12">IPL Analysis</button>
                        <button type="button" class="btn btn-outline-secondary font-size-12">PLF Overview</button>
                    </div>
                </div>
            </div>
            <div class="alert alert-secondary secondary-CurrentYear mt-20">
                <div class="row">
                    <div class="col-2 text-secondary">
                        <img src="<?= Yii::$app->homeUrl ?>image/calendar.png" style="width: 13px;"> &nbsp; <span class="font-size-12"> Current Year</span>
                    </div>
                    <div class="col-1">
                        <select class="form-select text-primary font-size-12" aria-label="Default select example" style="width: 6rem;">
                            <option selected value="">Select</option>
                            <option value="1">2020</option>
                            <option value="2">2021</option>
                            <option value="3">2022</option>
                            <option value="4">2024</option>
                        </select>
                    </div>
                    <div class="col-2 font-size-12 text-secondary pt-5 pl-25">
                        <img src="<?= Yii::$app->homeUrl ?>image/dollar.png" class="imagedollar"> Currency
                    </div>
                    <div class="col-1">
                        <select class="form-select text-primary font-size-12" aria-label="Default select example" style="width: 6rem;">
                            <option selected value=""> BTH (฿)</option>
                            <option value="1">2020</option>
                            <option value="2">2021</option>
                            <option value="3">2022</option>
                            <option value="4">2024</option>
                        </select>
                    </div>
                    <div class="col-2 font-size-12 pt-5 pl-25">
                        <img src="<?= Yii::$app->homeUrl ?>image/roundup.png"> Round Up
                    </div>
                    <div class="col-1">
                        <select class="form-select text-primary font-size-12" aria-label="Default select example" style="width: 6rem;">
                            <option selected value=""> None</option>
                            <option value="1">2020</option>
                            <option value="2">2021</option>
                            <option value="3">2022</option>
                            <option value="4">2024</option>
                        </select>
                    </div>
                    <div class="col-3 text-secondary font-size-12 pt-5 text-end">
                        <strong> F.Y. 2023 (Annual)</strong>
                    </div>
                </div>
            </div>
            <div class="row mt-30">
                <div class="col-lg-9">
                    <div class="col-12 text-primary">
                        <i class="fa fa-chevron-left" aria-hidden="true"></i> Data Table
                    </div>
                </div>
                <div class="col-lg-3 text-end">
                    <a href="" class="button-link"> <img src="<?= Yii::$app->homeUrl ?>image/ca-1.png" style="width: 30px;"></a>
                    <a href="" class="button-link"> <img src="<?= Yii::$app->homeUrl ?>image/network.png"></a>
                </div>
            </div>
            <div class="col-12 mt-30">
                <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>

                <div class="col-12 text-center font-size-18">
                    <strong> PLF 3-Years Performance Chart</strong>
                </div>

                <body>
                    <canvas id="mylineChart" style="width:100%;max-width:100%"></canvas>
                    <script>
                        const xValues = [950000, 1000000, 110000, 1200000, 1300000, 1400000, 1500000, 1600000, 1700000, 1800000, 1900000, 2000000];
                        const yValues = ["Jan", "Feb", "Mar", "Apr", "Jun", "Jul", "Aug", "May", "Sep", "Oct", "Nov", "Dec"];

                        new Chart("mylineChart", {
                            type: "line",
                            data: {
                                labels: xValues,
                                labels: yValues,
                                datasets: [{
                                    data: [700000, 750000, 800000, 750000, 740000, 750000, 800000, 850000, 1000000, 1200000, 1400000, 1500000],
                                    borderColor: "rgb(227, 175, 3)",

                                    fill: false
                                }, {
                                    data: [1100000, 1000000, 1200000, 1200000, 1310000, 1350000, 1250000, 1450000, 1490000, 1520000, 1550000, 1570000],
                                    borderColor: "#3430FF",
                                    fill: false
                                }, {
                                    data: [500000, 550000, 540000, 530000, 600000, 540000, 520000, 520000, 540000, 690000, 800000, 1000000],
                                    borderColor: "rgb(21, 121, 215)",
                                    fill: false
                                }, {
                                    data: [100000, 150000, 240000, 240000, 300000, 240000, 290000, 290000, 290000, 280000, 270000, 260000, 250000],
                                    borderColor: "green",
                                    fill: false
                                }]
                            },
                            options: {
                                legend: {
                                    display: false
                                }
                            }
                        });
                    </script>
                </body>
            </div>
            <div class="col-12 mt-30">
                <div class="alert  light-shadow-2" role="alert">
                    <div class="row">
                        <div class="col-lg-2">
                            <div class="alert light-shadow-3">
                                <div class="row">
                                    <div class="col-10 font-size-12">
                                        <strong> Variable Expense</strong>
                                    </div>
                                    <div class="col-2">
                                        <div>
                                            <input class="form-check-input" type="checkbox" id="checkboxNoLabel" value="" aria-label="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card" style="border:none;">
                                <div class="row font-size-12">
                                    <div class="col-7 pl-20">
                                        Actual
                                    </div>
                                    <div class="col-5">
                                        <div class="slidecontainer">
                                            <input type="range" min="1" max="100" value="50" class="slider" id="myRange">
                                        </div>
                                    </div>
                                    <div class="col-7 pl-20">
                                        Forecasted
                                    </div>
                                    <div class="col-5">
                                        fjhtjkokg
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="alert light-shadow-3">
                                <div class="row">
                                    <div class="col-10 font-size-12">
                                        <strong> Gross Profit</strong>
                                    </div>
                                    <div class="col-2">
                                        <div>
                                            <input class="form-check-input" type="checkbox" id="checkboxNoLabel" value="" aria-label="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card" style="border:none;">
                                <div class="row font-size-12">
                                    <div class="col-7 pl-20">
                                        Actual
                                    </div>
                                    <div class="col-5">
                                        <div class="chrome">
                                            <input id="myinput" min="0" max="60" type="range" value="30" />
                                        </div>
                                    </div>
                                    <div class="col-7 pl-20">
                                        Forecasted
                                    </div>
                                    <div class="col-5">
                                        yjhut7u
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="alert light-shadow-3">
                                <div class="row">
                                    <div class="col-10 font-size-12">
                                        <strong> Labor Cost</strong>
                                    </div>
                                    <div class="col-2">
                                        <div>
                                            <input class="form-check-input" type="checkbox" id="checkboxNoLabel" value="" aria-label="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card" style="border:none;">
                                <div class="row font-size-12">
                                    <div class="col-7 pl-20">
                                        Actual
                                    </div>
                                    <div class="col-5">
                                        yjhut7u
                                    </div>
                                    <div class="col-7 pl-20">
                                        Forecasted
                                    </div>
                                    <div class="col-5">
                                        yjhut7u
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="alert light-shadow-3">
                                <div class="row">
                                    <div class="col-10 font-size-12">
                                        <strong> Fixed Expense....</strong>
                                    </div>
                                    <div class="col-2">
                                        <div>
                                            <input class="form-check-input" type="checkbox" id="checkboxNoLabel" value="" aria-label="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card" style="border:none;">
                                <div class="row font-size-12">
                                    <div class="col-7 pl-20">
                                        Actual
                                    </div>
                                    <div class="col-5">
                                        jiytjuygj
                                    </div>
                                    <div class="col-7 pl-20">
                                        Forecasted
                                    </div>
                                    <div class="col-5">
                                        yjhut7u
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="alert light-shadow-3">
                                <div class="row">
                                    <div class="col-10 font-size-12">
                                        <strong> Non-Operating</strong>
                                    </div>
                                    <div class="col-2">
                                        <div>
                                            <input class="form-check-input" type="checkbox" id="checkboxNoLabel" value="" aria-label="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card" style="border:none;">
                                <div class="row font-size-12">
                                    <div class="col-7 pl-20">
                                        Actual
                                    </div>
                                    <div class="col-5">
                                        yjhut7u
                                    </div>
                                    <div class="col-7 pl-20">
                                        Forecasted
                                    </div>
                                    <div class="col-5">
                                        yjhut7u
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="alert light-shadow-3">
                                <div class="row">
                                    <div class="col-10 font-size-12">
                                        <strong> Operating Profit</strong>
                                    </div>
                                    <div class="col-2">
                                        <div>
                                            <input class="form-check-input" type="checkbox" id="checkboxNoLabel" value="" aria-label="...">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card" style="border:none;">
                                <div class="row font-size-12">
                                    <div class="col-7 pl-20">
                                        Actual
                                    </div>
                                    <div class="col-5">
                                        yjhut7u
                                    </div>
                                    <div class="col-7 pl-20">
                                        Forecasted
                                    </div>
                                    <div class="col-5">
                                        yjhut7u
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>