<?php
$this->title = 'PLF Overview';
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
                        <button id="performancechart" type="button" class="btn btn-outline-secondary font-size-12"><i class="fa fa-bar-chart" aria-hidden="true"></i></button>
                        <button id="performancechart" type="button" class="btn btn-outline-secondary font-size-12">Performance Chart</button>
                        <button id="performancechart" type="button" class="btn btn-outline-secondary font-size-12">IPL Analysis</button>
                        <button id="performancechart" type="button" class="btn btn-outline-secondary font-size-12">PLF Overview</button>
                    </div>
                </div>
            </div>
            <div class="alert alert-secondary secondary-CurrentYear mt-20">
                <div class="row">
                    <div class="col-2">
                        <strong>PL Contents</strong>
                    </div>
                    <div class="col-2 text-secondary">
                        <img src="<?= Yii::$app->homeUrl ?>image/calendar.png" style="width: 13px;"> &nbsp; <span class="font-size-12"> Current Year</span>
                    </div>
                    <div class="col-2">
                        <select class="form-select text-primary font-size-12" aria-label="Default select example" style="width: 6rem;">
                            <option selected value="">Select</option>
                            <option value="1">2020</option>
                            <option value="2">2021</option>
                            <option value="3">2022</option>
                            <option value="4">2024</option>
                        </select>
                    </div>

                    <div class="col-6 text-secondary font-size-12 pt-5 text-end">
                        <strong> F.Y. 2023 (Annual)</strong>
                    </div>
                </div>
            </div>
            <div class="col-12 text-primary">
                <a href="" class="linedatatable"> <i class="fa fa-chevron-left" aria-hidden="true"></i> Data Table</a>
            </div>
            <div class="col-12 text-center">
                <strong> Annual Comparison Chart</strong>
            </div>
            <div class="row">
                <div class="col-lg-1 mt-60">
                    <div class="col-6 text-center">
                        <img src="<?= Yii::$app->homeUrl ?>image/network.png">
                    </div>
                    <div class="col-12 mt-5">
                        <span class="badge bg-primary">AAR</span>
                    </div>
                    <div class="col-12 mt-20">
                        <span class="badge bg-success">AAR</span>
                    </div>
                    <div class="col-12 mt-20">
                        <span class="badge bg-warning text-dark">ATR</span>
                    </div>
                    <div class="col-12 mt-20">
                        <span class="badge bg-primary">ATR</span>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="shadow p-3 mb-5 bg-body rounded mt-40">
                        <div class="col-12 badge bg light-shadow text-dark text-start">
                            Sales
                        </div>
                        <div class="row mt-10">
                            <div class="col-lg-3 font-size-12">
                                2022
                            </div>
                            <div class="col-lg-7 pt-5">
                                <div class="progress progress-thin" style="height: 10px;">
                                    <div class="progress-bar bg-bar-background-1" role="progressbar" style="width: 26%" aria-valuenow="26" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col-lg-2 font-size-12">
                                26%
                            </div>
                            <div class="col-lg-3 font-size-12">
                                2023
                            </div>
                            <div class="col-lg-7 pt-5">
                                <div class="progress progress-thin" style="height: 10px;">
                                    <div class="progress-bar bg-bar-background-2" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col-lg-2 font-size-12">
                                100%
                            </div>
                            <div class="col-lg-3 font-size-12">
                                2023 <span class="badge bg-primary font-size-10">C</span>
                            </div>
                            <div class="col-lg-7 pt-5">
                                <div class="progress progress-thin" style="height: 10px;">
                                    <div class="progress-bar bg-bar-background-3" role="progressbar" style="width: 82%" aria-valuenow="82" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col-lg-2 font-size-12">
                                82%
                            </div>
                            <div class="col-lg-3 font-size-12">
                                2024
                            </div>
                            <div class="col-lg-7 pt-5">
                                <div class="progress progress-thin" style="height: 10px;">
                                    <div class="progress-bar bg-bar-background-4" role="progressbar" style="width: 93%" aria-valuenow="93" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col-lg-2 font-size-12">
                                93%
                            </div>
                            <hr>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="shadow p-3  mb-5  bg-body rounded mt-40">
                        <div class="col-12 badge bg light-shadow text-dark text-start">
                            Sales
                        </div>
                        <div class="row mt-10">
                            <div class="col-lg-3 font-size-12">
                                2022
                            </div>
                            <div class="col-lg-7 pt-5">
                                <div class="progress progress-thin" style="height: 10px;">
                                    <div class="progress-bar bg-bar-background-1" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col-lg-2 font-size-12">
                                75%
                            </div>
                            <div class="col-lg-3 font-size-12">
                                2023
                            </div>
                            <div class="col-lg-7 pt-5">
                                <div class="progress progress-thin" style="height: 10px;">
                                    <div class="progress-bar bg-bar-background-2" role="progressbar" style="width: 65%" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col-lg-2 font-size-12">
                                65%
                            </div>
                            <div class="col-lg-3 font-size-12">
                                2023 <span class="badge bg-primary font-size-10">C</span>
                            </div>
                            <div class="col-lg-7 pt-5">
                                <div class="progress progress-thin" style="height: 10px;">
                                    <div class="progress-bar bg-bar-background-3" role="progressbar" style="width: 43%" aria-valuenow="43" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col-lg-2 font-size-12">
                                43%
                            </div>
                            <div class="col-lg-3 font-size-12">
                                2024
                            </div>
                            <div class="col-lg-7 pt-5">
                                <div class="progress progress-thin" style="height: 10px;">
                                    <div class="progress-bar bg-bar-background-4" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col-lg-2 font-size-12">
                                100%
                            </div>
                            <hr>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-1 mt-60">
                    <div class="col-6 text-center">
                        <img src="<?= Yii::$app->homeUrl ?>image/network.png">
                    </div>
                    <div class="col-12 mt-5">
                        <span class="badge bg-primary">AAR</span>
                    </div>
                    <div class="col-12 mt-20">
                        <span class="badge bg-success">AAR</span>
                    </div>
                    <div class="col-12 mt-20">
                        <span class="badge bg-warning text-dark">ATR</span>
                    </div>
                    <div class="col-12 mt-20">
                        <span class="badge bg-primary">ATR</span>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="shadow p-3 mb-5 bg-body rounded mt-40">
                        <div class="col-12 badge bg light-shadow text-dark text-start">
                            Sales
                        </div>
                        <div class="row mt-10">
                            <div class="col-lg-3 font-size-12">
                                2022
                            </div>
                            <div class="col-lg-7 pt-5">
                                <div class="progress progress-thin" style="height: 10px;">
                                    <div class="progress-bar bg-bar-background-1" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col-lg-2 font-size-12">
                                75%
                            </div>
                            <div class="col-lg-3 font-size-12">
                                2023
                            </div>
                            <div class="col-lg-7 pt-5">
                                <div class="progress progress-thin" style="height: 10px;">
                                    <div class="progress-bar bg-bar-background-2" role="progressbar" style="width: 65%" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col-lg-2 font-size-12">
                                65%
                            </div>
                            <div class="col-lg-3 font-size-12">
                                2023 <span class="badge bg-primary font-size-10">C</span>
                            </div>
                            <div class="col-lg-7 pt-5">
                                <div class="progress progress-thin" style="height: 10px;">
                                    <div class="progress-bar bg-bar-background-3" role="progressbar" style="width: 43%" aria-valuenow="43" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col-lg-2 font-size-12">
                                43%
                            </div>
                            <div class="col-lg-3 font-size-12">
                                2024
                            </div>
                            <div class="col-lg-7 pt-5">
                                <div class="progress progress-thin" style="height: 10px;">
                                    <div class="progress-bar bg-bar-background-4" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col-lg-2 font-size-12">
                                100%
                            </div>
                            <hr>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="shadow p-3  mb-5  bg-body rounded mt-40">
                        <div class="col-12 badge bg light-shadow text-dark text-start">
                            Sales
                        </div>
                        <div class="row mt-10">
                            <div class="col-lg-3 font-size-12">
                                2022
                            </div>
                            <div class="col-lg-7 pt-5">
                                <div class="progress progress-thin" style="height: 10px;">
                                    <div class="progress-bar bg-bar-background-1" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col-lg-2 font-size-12">
                                75%
                            </div>
                            <div class="col-lg-3 font-size-12">
                                2023
                            </div>
                            <div class="col-lg-7 pt-5">
                                <div class="progress progress-thin" style="height: 10px;">
                                    <div class="progress-bar bg-bar-background-2" role="progressbar" style="width: 65%" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col-lg-2 font-size-12">
                                65%
                            </div>
                            <div class="col-lg-3 font-size-12">
                                2023 <span class="badge bg-primary font-size-10">C</span>
                            </div>
                            <div class="col-lg-7 pt-5">
                                <div class="progress progress-thin" style="height: 10px;">
                                    <div class="progress-bar bg-bar-background-3" role="progressbar" style="width: 43%" aria-valuenow="43" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col-lg-2 font-size-12">
                                43%
                            </div>
                            <div class="col-lg-3 font-size-12">
                                2024
                            </div>
                            <div class="col-lg-7 pt-5">
                                <div class="progress progress-thin" style="height: 10px;">
                                    <div class="progress-bar bg-bar-background-4" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col-lg-2 font-size-12">
                                100%
                            </div>
                            <hr>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>