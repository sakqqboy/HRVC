<?php
$this->title = 'Golden';
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
                        <div class="col-lg-3 col-md-6 col-12 alert alert-info al-pad">
                            <div class="col-12 text-center">
                                <p> Sales</p>
                                <p class="font-size-18"> <?= number_format(100.0) ?>%</p>
                            </div>
                        </div>
                        <div class="col-lg-9 col-md-6 col-12 alert alert-alinfo">
                            <div class="col-12">
                                Variable Expense <span><?= number_format(25.0) ?>%</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>