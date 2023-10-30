<?php
$this->title = 'IPL Analysis';
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
            <div class="row">
                <div class="col-lg-2 col-md-6 col-12">
                    <div class="col-12 alert alert-secondary secondary-CurrentYear mt-20">
                        PL Content
                    </div>
                </div>
                <div class="alert alert-secondary secondary-CurrentYear">
                    <div class="col-lg-10 col-md-6 col-12 mt-20">
                        <div class="row">
                            <div class="col-2 text-secondary border">
                                <img src="<?= Yii::$app->homeUrl ?>image/calendar.png" style="width: 12px;">
                                <span class="font-size-12"> Current Year </span>
                            </div>
                            <div class="col-2">
                                <select class="form-select text-primary font-size-12" aria-label="Default select example">
                                    <option selected value="">Select</option>
                                    <option value="1">2020</option>
                                    <option value="2">2021</option>
                                    <option value="3">2022</option>
                                    <option value="4">2024</option>
                                </select>
                            </div>
                            <div class="col-2 font-size-12 text-secondary pt-5 pl-25">
                                <img src="<?= Yii::$app->homeUrl ?>image/dollar.png" class="imagedollar"> Currency
                                <!-- <div class="usd-border"><i class="fa fa-usd fa-1x pl-5" aria-hidden="true"></i></div>  -->
                            </div>
                            <div class="col-2">
                                <select class="form-select text-primary font-size-12" aria-label="Default select example">
                                    <option selected value=""> BTH (฿)</option>
                                    <option value="1">2020</option>
                                    <option value="2">2021</option>
                                    <option value="3">2022</option>
                                    <option value="4">2024</option>
                                </select>
                            </div>
                            <div class="col-1 font-size-12 pt-5 pl-25">
                                <img src="<?= Yii::$app->homeUrl ?>image/roundup.png"> Round Up
                            </div>
                            <div class="col-2">
                                <select class="form-select text-primary font-size-12" aria-label="Default select example">
                                    <option selected value=""> None</option>
                                    <option value="1">2020</option>
                                    <option value="2">2021</option>
                                    <option value="3">2022</option>
                                    <option value="4">2024</option>
                                </select>
                                <div class="text-secondary font-size-12  text-end">
                                    <strong> F.Y. 2023 (Annual)</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>