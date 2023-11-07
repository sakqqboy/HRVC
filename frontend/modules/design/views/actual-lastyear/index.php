<?php
$this->title = 'Actual Last Year';
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
                <div class="col-lg-2 col-md-6 col-12">
                    <strong class="font-size-19"> Golden Ratio</strong>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <button class="btn btn-primary" type="button"><i class="fa fa-magic" aria-hidden="true"></i> Register</button>
                </div>
                <div class="col-lg-4 col-md-6 col-12">
                    <select class="form-select example-tok1" aria-label="Default select example">
                        <option selected value="">Select</option>
                        <option value="1">Tokyo Consulting firm</option>
                        <option value="2">Tokyo Consulting Group</option>
                        <option value="3">Tokyo Consulting Group</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-6 col-12 mt-30 badge bg-primary-sec3">
                    <div class="row">
                        <div class="col-4 text-secondary">
                            <img src="<?= Yii::$app->homeUrl ?>image/calendar.png" class="image-current-year">
                            <span class="font-size-12"> Current Year </span>
                        </div>
                        <div class="col-3 pl-20">
                            <select class="form-select select-secondate" aria-label="Default select example">
                                <option selected value="">Select</option>
                                <option value="1">2020</option>
                                <option value="2">2021</option>
                                <option value="3">2022</option>
                                <option value="4">2024</option>
                            </select>
                        </div>
                        <div class="col-5 text-end">
                            <div class="text-secondary font-size-13">
                                <strong> F.Y. 2023</strong>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-md-6 col-12 badge bg-primary-sec4 mt-30">
                    <div class="row">
                        <div class="col-1 font-size-12 text-secondary pt-5">
                            <img src="<?= Yii::$app->homeUrl ?>image/dollar.png" class="imagedollar"> Currency
                        </div>
                        <div class="col-2 pt-5">
                            <select class="form-select  select-secondate" aria-label="Default select example">
                                <option selected value=""> BTH (฿)</option>
                                <option value="1">2020</option>
                                <option value="2">2021</option>
                                <option value="3">2022</option>
                                <option value="4">2023</option>
                                <option value="5">2024</option>
                            </select>
                        </div>
                        <div class="col-1 font-size-12 pt-5 text-secondary" style="margin-left:-35px;">
                            <img src="<?= Yii::$app->homeUrl ?>image/roundup.png"> Round Up
                        </div>
                        <div class="col-2 pt-5 pl-15">
                            <select class="form-select select-secondate" aria-label="Default select example">
                                <option selected value=""> None</option>
                                <option value="1">2020</option>
                                <option value="2">2021</option>
                                <option value="3">2022</option>
                                <option value="4">2024</option>
                            </select>
                        </div>
                        <div class="col-2" style="margin-left:-35px;">
                            <a href="" class="no-underline-black link-Ideal"> Ideal Golden Ratio</a>
                        </div>
                        <div class="col-2" style="margin-left:-30px;">
                            <a href="" class="no-underline-black link-Ideal"> Actual Last Year</a>
                        </div>
                        <div class="col-1" style="margin-left:-25px;">
                            <a href="" class="no-underline-black link-Ideal"> Current Year Target</a>
                        </div>
                        <div class="col-1" style="margin-left:55px;">
                            <a href="" class="no-underline-black link-Ideal"> Next Year Target</a>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="row mt-20">
                        <div class="col-lg-3 col-md-6 col-12 card al-pad">
                            <div class="col-12 text-end">
                                <span class="badge bg-lig1 text-dark"> Sales</span>
                            </div>
                            <div class="col-12 text-center pt-30">
                                Sales
                            </div>
                            <div class="col-12 text-center">
                                <strong> <?= number_format(100.0) ?>%</strong>
                            </div>
                        </div>
                        <div class="col-lg-9 col-md-6 col-12 ">
                            <div class="card alert-alinfo">
                                <div class="col-12 text-end">
                                    <span class="badge bg-lig1 text-dark"> Variable Expense</span>
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        Variable Expense
                                    </div>
                                    <div class="col-3">
                                        <strong><?= number_format(25.0) ?>%</strong>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-md-6 col-12">
                                    <div class="card alert-alpri1">
                                        <div class="col-12 text-end">
                                            <span class="badge bg-lig1 text-dark"> Gross Profit</span>
                                        </div>
                                        <div class="col-12 text-center pt-20">
                                            Gross Profit
                                        </div>
                                        <div class="col-12 text-center">
                                            <strong> <?= number_format(75.5) ?>%</strong>
                                        </div>
                                        <div class="col-12 pt-100"></div>
                                    </div>
                                </div>
                                <div class="col-lg-8 col-md-6 col-12 ">
                                    <div class="card alert-alpri2">
                                        <div class="col-12 text-end">
                                            <span class="badge bg-lig1 text-dark"> Labor Cost</span>
                                        </div>
                                        <div class="row">
                                            <div class="col-5">
                                                Labor Cost
                                            </div>
                                            <div class="col-3">
                                                <strong> <?= number_format(35.0) ?>%</strong>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="card alert-alpri3">
                                                <div class="col-12 text-end">
                                                    <span class="badge bg-lig1 text-dark"> Fixed Expense (Others)</span>
                                                </div>
                                                <div class="row">
                                                    <div class="col-5">
                                                        Fixed Expense (Others)
                                                    </div>
                                                    <div class="col-3">
                                                        <strong> <?= number_format(35.0) ?>%</strong>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="card alert-alpri4">
                                                <div class="col-12 text-end">
                                                    <span class="badge bg-lig1 text-dark"> Operating Profit</span>
                                                </div>
                                                <div class="row">
                                                    <div class="col-5">
                                                        Operating Profit
                                                    </div>
                                                    <div class="col-3">
                                                        <strong> <?= number_format(5.0) ?>%</strong>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3 col-md-6 col-12 card alert-alpri5">
                            <div class="col-12 text-center">
                                Ideal Golden Ratio
                            </div>
                        </div>
                        <div class="col-lg-9 col-md-6 col-12 ">
                            <div class="card alert-alpri6">
                                <div class="Ideal-solid">
                                    &nbsp; Total
                                    <div role="progressbar4" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="--value:100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>