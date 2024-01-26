<?php
$this->title = 'IPL Analysis';
?>

<div class="col-12 mt-90 alert background-Planning">
    <div class="col-12 planning">
        <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/FinanicalPlanning.png" class="images_Dark_FinanicalPlanning"> Financial Planning
    </div>
    <div class="col-12 mt-20">
        <div class="shadow p-3 mb-5 bg-body rounded alert2-secondary3">
            <ul class="nav nav-pills" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link text-dark" id="pills-Forcast-tab" data-bs-toggle="pill" data-bs-target="#pills-Forcast" type="button" role="tab" aria-controls="pills-Forcast" aria-selected="true"> <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/PL-Forecast.png" class="images_PLForecast"> PL Forcast</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link text-dark" id="pills-Golden-tab" data-bs-toggle="pill" data-bs-target="#pills-Golden" type="button" role="tab" aria-controls="pills-Golden" aria-selected="false"><img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Golden-Ratio.png" class="images_performance_PL"> Golden Ratio</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link text-dark" id="pills-Accounts-tab" data-bs-toggle="pill" data-bs-target="#pills-Accounts" type="button" role="tab" aria-controls="pills-Accounts" aria-selected="false"><img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Designation-1.png" class="images_performance_PL"> Forecast Accounts</a>
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
                        <button id="performancechart" type="button" class="btn btn-outline-secondary"><i class="fa fa-bar-chart" aria-hidden="true"></i></button>
                        <button id="performancechart" type="button" class="btn btn-outline-secondary">Performance Chart</button>
                        <button id="performancechart" type="button" class="btn btn-outline-secondary">IPL Analysis</button>
                        <button id="performancechart" type="button" class="btn btn-outline-secondary">PLF Overview</button>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="col-12 badge bg-primary-sec">
                        PL Content
                    </div>
                </div>
                <div class="col-lg-9 col-md-6 col-12 mt-30 badge bg-primary-sec1">
                    <div class="row">
                        <div class="col-1 text-secondary">
                            <img src="<?= Yii::$app->homeUrl ?>image/calendar.png" class="image-current-year">
                            <span class="font-size-12"> Current Year </span>
                        </div>
                        <div class="col-2 pl-40">
                            <select class="form-select  select-secondate" aria-label="Default select example">
                                <option selected value="">Select</option>
                                <option value="1">2020</option>
                                <option value="2">2021</option>
                                <option value="3">2022</option>
                                <option value="4">2024</option>
                            </select>
                        </div>
                        <div class="col-1  text-secondary">
                            <img src="<?= Yii::$app->homeUrl ?>image/dollar.png" class="imagedollar"> Currency
                        </div>
                        <div class="col-2">
                            <select class="form-select  select-secondate" aria-label="Default select example">
                                <option selected value=""> BTH (฿)</option>
                                <option value="1">2020</option>
                                <option value="2">2021</option>
                                <option value="3">2022</option>
                                <option value="4">2024</option>
                            </select>
                        </div>
                        <div class="col-2 font-size-12 text-secondary">
                            <img src="<?= Yii::$app->homeUrl ?>image/roundup.png"> Round Up
                        </div>
                        <div class="col-2">
                            <select class="form-select select-secondate" aria-label="Default select example">
                                <option selected value=""> None</option>
                                <option value="1">2020</option>
                                <option value="2">2021</option>
                                <option value="3">2022</option>
                                <option value="4">2024</option>
                            </select>
                        </div>
                        <div class="col-2">
                            <div class="text-secondary font-size-12">
                                <strong> F.Y. 2023 (Annual)</strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 text-end mt-20">
                <a href="" class="button-link"> <img src="<?= Yii::$app->homeUrl ?>image/ca-1.png" style="width: 30px;"></a>
                <a href="" class="button-link"> <img src="<?= Yii::$app->homeUrl ?>image/network.png"></a>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="shadow-none p-2 mb-12 bg-gray rounded">
                        <div class="row">
                            <div class="col-10">
                                <input type="text" class="shadow bg rounded" id="shadowPL">
                            </div>
                            <div class="col-2 form-check">
                                <input class="form-check-input" type="checkbox" value="" id="checkboxPL">
                            </div>
                        </div>
                    </div>
                    <!-- display;:none หน้าแก้ไขแล้วจะเป็นสีฟ้า -->
                    <div class="shadow-none p-2 mb-12 bg-sky rounded">
                        <div class="row">
                            <div class="col-2 form-check">
                                <input class="form-check-input" type="checkbox" value="" id="checkboxPLradio">
                            </div>
                            <div class="col-10">
                                <input type="text" class="shadow bg rounded" id="shadowPLinput">
                            </div>
                        </div>
                    </div>
                    <!-- end -->
                    <div class="shadow-none p-2 mb-12 bg-gray rounded">
                        <div class="row">
                            <div class="col-10">
                                <input type="text" class="shadow bg rounded" id="shadowPL">
                            </div>
                            <div class="col-2 form-check">
                                <input class="form-check-input" type="checkbox" value="" id="checkboxPL">
                            </div>
                        </div>
                    </div>
                    <div class="shadow-none p-2 mb-12 bg-gray rounded">
                        <div class="row">
                            <div class="col-10">
                                <input type="text" class="shadow bg rounded" id="shadowPL">
                            </div>
                            <div class="col-2 form-check">
                                <input class="form-check-input" type="checkbox" value="" id="checkboxPL">
                            </div>
                        </div>
                    </div>
                    <div class="shadow-none p-2 mb-12 bg-gray rounded">
                        <div class="row">
                            <div class="col-10">
                                <input type="text" class="shadow bg rounded" id="shadowPL">
                            </div>
                            <div class="col-2 form-check">
                                <input class="form-check-input" type="checkbox" value="" id="checkboxPL">
                            </div>
                        </div>
                    </div>
                    <div class="shadow-none p-2 mb-12 bg-gray rounded">
                        <div class="row">
                            <div class="col-10">
                                <input type="text" class="shadow bg rounded" id="shadowPL">
                            </div>
                            <div class="col-2 form-check">
                                <input class="form-check-input" type="checkbox" value="" id="checkboxPL">
                            </div>
                        </div>
                    </div>
                    <div class="shadow-none p-2 mb-12 bg-gray rounded">
                        <div class="row">
                            <div class="col-10">
                                <input type="text" class="shadow bg rounded" id="shadowPL">
                            </div>
                            <div class="col-2 form-check">
                                <input class="form-check-input" type="checkbox" value="" id="checkboxPL">
                            </div>
                        </div>
                    </div>
                    <div class="shadow-none p-2 mb-12 bg-gray rounded">
                        <div class="row">
                            <div class="col-10">
                                <input type="text" class="shadow bg rounded" id="shadowPL">
                            </div>
                            <div class="col-2 form-check">
                                <input class="form-check-input" type="checkbox" value="" id="checkboxPL">
                            </div>
                        </div>
                    </div>
                    <div class="shadow-none p-2 mb-12 bg-gray rounded">
                        <div class="row">
                            <div class="col-10">
                                <input type="text" class="shadow bg rounded" id="shadowPL">
                            </div>
                            <div class="col-2 form-check">
                                <input class="form-check-input" type="checkbox" value="" id="checkboxPL">
                            </div>
                        </div>
                    </div>
                    <div class="shadow-none p-2 mb-12 bg-gray rounded">
                        <div class="row">
                            <div class="col-10">
                                <input type="text" class="shadow bg rounded" id="shadowPL">
                            </div>
                            <div class="col-2 form-check">
                                <input class="form-check-input" type="checkbox" value="" id="checkboxPL">
                            </div>
                        </div>
                    </div>
                    <div class="shadow-none p-2 mb-12 bg-gray rounded">
                        <div class="row">
                            <div class="col-10">
                                <input type="text" class="shadow bg rounded" id="shadowPL">
                            </div>
                            <div class="col-2 form-check">
                                <input class="form-check-input" type="checkbox" value="" id="checkboxPL">
                            </div>
                        </div>
                    </div>
                    <div class="shadow-none p-2 mb-12 bg-gray rounded">
                        <div class="row">
                            <div class="col-10">
                                <input type="text" class="shadow bg rounded" id="shadowPL">
                            </div>
                            <div class="col-2 form-check">
                                <input class="form-check-input" type="checkbox" value="" id="checkboxPL">
                            </div>
                        </div>
                    </div>
                    <div class="shadow-none p-2 mb-12 bg-gray rounded">
                        <div class="row">
                            <div class="col-10">
                                <input type="text" class="shadow bg rounded" id="shadowPL">
                            </div>
                            <div class="col-2 form-check">
                                <input class="form-check-input" type="checkbox" value="" id="checkboxPL">
                            </div>
                        </div>
                    </div>
                    <div class="shadow-none p-2 mb-12 bg-gray rounded">
                        <div class="row">
                            <div class="col-10">
                                <input type="text" class="shadow bg rounded" id="shadowPL">
                            </div>
                            <div class="col-2 form-check">
                                <input class="form-check-input" type="checkbox" value="" id="checkboxPL">
                            </div>
                        </div>
                    </div>
                    <div class="shadow-none p-2 mb-12 bg-gray rounded">
                        <div class="row">
                            <div class="col-10">
                                <input type="text" class="shadow bg rounded" id="shadowPL">
                            </div>
                            <div class="col-2 form-check">
                                <input class="form-check-input" type="checkbox" value="" id="checkboxPL">
                            </div>
                        </div>
                    </div>
                    <div class="shadow-none p-2 mb-12 bg-gray rounded">
                        <div class="row">
                            <div class="col-10">
                                <input type="text" class="shadow bg rounded" id="shadowPL">
                            </div>
                            <div class="col-2 form-check">
                                <input class="form-check-input" type="checkbox" value="" id="checkboxPL">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-md-6 col-12">
                    <div class="col-12 text-primary">
                        <a href="" class="no-underline-primary font-size-13"> <i class="fa fa-chevron-left" aria-hidden="true"></i> Data Table</a>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="col-12 pt-30 font-size-18">
                                Variable Expense
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="col-12 pt-30 font-size-19 pl-30">
                                <strong> Individual P&L Analysis</strong>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-30">
                        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
                        <canvas id="mixed-chart" width="800" height="500"></canvas>
                    </div>
                    <div class="col-12">
                        <div class="alert light-shadow-2" role="alert">
                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="alert light-shadow-3">
                                        <div class="col-12 font-size-12">
                                            <strong> Current Year-2022</strong>
                                        </div>
                                    </div>

                                    <div class="card" style="border:none;">
                                        <div class="row font-size-12">
                                            <div class="col-7 pl-20 pt-8">
                                                Actual
                                            </div>
                                            <div class="col-5">
                                                <div class="col-12 pt-8">
                                                    <button type="button" class="example-iplAnalysis1"></button>
                                                </div>
                                            </div>
                                            <div class="col-7 pl-20 pt-10">
                                                Target
                                            </div>
                                            <div class="col-5 pt-10">
                                                <div class="col-12">
                                                    <button type="button" class="example-iplAnalysis2"></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="alert light-shadow-3">
                                        <div class="col-10 font-size-12">
                                            <strong> Previous Year</strong>
                                        </div>
                                    </div>
                                    <div class="card" style="border:none;">
                                        <div class="row font-size-12">
                                            <div class="col-7 pl-20 pt-8">
                                                Actual
                                            </div>
                                            <div class="col-5 pt-8">
                                                <div class="col-12">
                                                    <a href=""> <img src="<?= Yii::$app->homeUrl ?>image/graphlinechart.png" class="graph-linechart"></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="alert light-shadow-3">
                                        <div class="col-10 font-size-12">
                                            <strong> Forecasted Year</strong>
                                        </div>
                                    </div>
                                    <div class="card" style="border:none;">
                                        <div class="row font-size-12">
                                            <div class="col-5 pl-20 pt-8">
                                                Target
                                            </div>
                                            <div class="col-7 pt-8">
                                                <button type="button" class="examplebox-red"></button>
                                                <button type="button" class="examplebox-red"></button>
                                                <button type="button" class="examplebox-red"></button>
                                                <button type="button" class="examplebox-red"></button>
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
    </div>
</div>

<div class="modal fade" id="DataDistionary" tabindex="-1" aria-labelledby="DataDistionaryLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content modal-DataDistionary">
            <div class="modal-header" style="border: none;">
                <div id="DataDistionaryLabel">
                    Data Dictionary
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-6 Accumulate_text">
                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Accumulated.png" class="Dark_Monthly"> Accumulate
                    </div>
                    <div class="col-6 Accumulate_text">
                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Monthly.png" class="Dark_Monthly"> Monthly
                    </div>
                    <hr class="mt-5">
                </div>
                <div class="row">
                    <div class="col-4 text-end">
                        <span class="AC-Primary"> AAR </span>
                    </div>
                    <div class="col-8 AC-Accumulate">
                        Accumulate Actual Ratio
                    </div>
                    <div class="col-4 text-end">
                        <span class="AC-Success"> AAR </span>
                    </div>
                    <div class="col-8 AC-Accumulate">
                        Accumulate Actual Ratio
                    </div>
                    <div class="col-4 text-end">
                        <span class="T-Warning"> AT </span>
                    </div>
                    <div class="col-8 AC-Accumulate">
                        Accumulate Target
                    </div>
                    <div class="col-4 text-end">
                        <span class="T-Warning"> ATR </span>
                    </div>
                    <div class="col-8 AC-Accumulate">
                        Accumulate Target ratio
                    </div>
                    <div class="col-4 text-end">
                        <span class="T-bule"> ATR </span>
                    </div>
                    <div class="col-8 AC-Accumulate">
                        Accumulate Target ratio
                    </div>
                    <hr>

                    <div class="col-4 text-end">
                        <span class="AC-Success"> AC </span>
                    </div>
                    <div class="col-8 AC-Accumulate">
                        Actual
                    </div>
                    <div class="col-4 text-end">
                        <span class="T-Warning"> T </span>
                    </div>
                    <div class="col-8 AC-Accumulate">
                        Actual
                    </div>
                    <hr>
                </div>
            </div>
        </div>
    </div>
</div>