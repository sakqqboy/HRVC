<?php
$this->title = 'Financial Planning';
?>

<div class="col-12 mt-90 alert background-Planning">
    <div class="col-12 planning">
        <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/FinanicalPlanning.png" class="images_Dark_FinanicalPlanning"> Financial Planning
    </div>
    <div class="col-12 mt-20">
        <div class="shadow p-3 mb-5 bg-body rounded alert2-secondary3">
            <ul class="nav nav-pills" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link text-dark" id="pills-Forcast-tab" data-bs-toggle="pill" data-bs-target="#pills-Forcast" type="button" role="tab" aria-controls="pills-Forcast" aria-selected="true"><img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/PL-Forecast.png" class="images_performance_PL"> PL Forcast</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link text-dark" id="pills-Golden-tab" data-bs-toggle="pill" data-bs-target="#pills-Golden" type="button" role="tab" aria-controls="pills-Golden" aria-selected="false"> <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Golden-Ratio.png" class="images_performance_PL"> Golden Ratio</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link text-dark" id="pills-Accounts-tab" data-bs-toggle="pill" data-bs-target="#pills-Accounts" type="button" role="tab" aria-controls="pills-Accounts" aria-selected="false"> <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Designation-1.png" class="images_performance_PL"> Forecast Accounts</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="col-12 mt-50">
        <div class="alert alert2-secondary3">
            <div class="row">
                <div class="col-lg-2 col-12">
                    <span class="badge bg-primary-summary">PL</span> <span class="Profit-Loss">Profit & Loss Forecast</span>
                </div>
                <div class="col-lg-2 col-12">
                    <button type="button" class="btn btn-primary Register_financial"><i class="fa fa-magic" aria-hidden="true"></i>&nbsp;&nbsp; Register</button>
                </div>
                <div class="col-lg-4 col-12">
                    <button type="button" class="btn btn-light Data" data-bs-toggle="modal" data-bs-target="#DataDistionary"> <i class="fa fa-exclamation-circle" aria-hidden="true"></i> Data Dictionary</button>
                    <button type="button" class="btn btn-light Data"> <i class="fa fa-line-chart" aria-hidden="true"></i> Comparison Charts</button>
                    <button type="button" class="btn btn-light Data"> <i class="fa fa-arrow-circle-down" aria-hidden="true"></i> Export</button>
                </div>
                <div class="col-lg-2 col-12 select_buttongroup">
                    <select class="form-select example-tok" aria-label="Default select example">
                        <option selected value="">Select</option>
                        <option value="1">Tokyo Consulting Group</option>
                        <option value="2">Tokyo Consulting firm</option>
                    </select>
                </div>
                <div class="col-lg-2 col-12 text-end">
                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/FilterPlus.png" class="picture-FilterPlus-bonus"><span class="financial_filter" style="cursor:pointer;" data-bs-toggle="modal" data-bs-target="#Modalfitter">Filter</span> <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/3Dot.png" class="bonus-point">
                </div>
            </div>
            <div class="row mt-10">
                <div class="col-lg-4">
                    <div class="alert alert-secondary secondary-CurrentYear">
                        <div class="row">
                            <div class="col-5 text-secondary">
                                <img src="<?= Yii::$app->homeUrl ?>image/calendar.png" style="width: 13px;"> &nbsp; <span class="font-size-12"> Current Year</span>
                            </div>
                            <div class="col-4">
                                <select class="form-select text-primary font-size-12" aria-label="Default select example">
                                    <option selected value="">Select</option>
                                    <option value="1">2020</option>
                                    <option value="2">2021</option>
                                    <option value="3">2022</option>
                                    <option value="4">2024</option>
                                </select>
                            </div>
                            <div class="col-3 text-end">
                                <strong class="text-secondary font-size-12">F.Y.2023</strong>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="line"></div>
                        <div style="display:inline-block;font-size:11px;">ANNUAL SUMMARY</div>
                        <div class="line"></div>
                    </div>

                    <div class="col-12  alert alert-secondary secondary-CurrentYear mt-20">
                        <div class="row">
                            <div class="col-3 item">
                                items
                            </div>
                            <div class="col-2 AAR-2022">
                                <div class="badge dge_AAR">AAR</div><span class="AA-2022">2022</span>
                            </div>
                            <div class="col-2 AAR-2022">
                                <div class="badge dge_AAR_green">AAR</div> <span class="AA-2022">2023</span>
                            </div>
                            <div class="col-3 AAR-2022">
                                <div class="badge dge_AAR_warning">AT</div> <span class="AA-2022">2023</span>
                                <div class="badge dge_AAR_warning">ATR</div>
                            </div>
                            <div class="col-2 AAR-2022">
                                <div class="badge dge_AAR">ATR</div> <span class="AA-2022">2024</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 alert alert-secondary secondary-itemss">
                        <div class="row">
                            <div class="col-lg-3 p-Gross">
                                Sales
                            </div>
                            <div class="col-lg-2">
                                <div class="progress-solid">
                                    <div role="progressbar1" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100" style="--value:35"></div>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="progress-solid">
                                    <div role="progressbar2" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="--value:85"></div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="progress-solid">
                                    <span class="numberrformat"><?= number_format(24700) ?> </span>
                                    <div role="progressbar3" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="--value:100"></div>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="progress-solid">
                                    <div role="progressbar1" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="--value:100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="hr-top">
                    <div class="col-12 alert alert-secondary secondary-itemss">
                        <div class="row">
                            <div class="col-lg-3 p-Gross">
                                Gross Profit (or Loss)
                            </div>
                            <div class="col-lg-2">
                                <div class="progress-solid">
                                    <div role="progressbar1" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="--value:75"></div>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="progress-solid">
                                    <div role="progressbar2" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="--value:75"></div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="progress-solid">
                                    <span class="numberrformat"><?= number_format(24700) ?> </span>
                                    <div role="progressbar3" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="--value:100"></div>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="progress-solid">
                                    <div role="progressbar1" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="--value:100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="hr-top">
                    <div class="col-12 alert alert-secondary secondary-itemss">
                        <div class="row">
                            <div class="col-lg-3 p-Gross">
                                Labor Cost
                            </div>
                            <div class="col-lg-2">
                                <div class="progress-solid">
                                    <div role="progressbar1" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="--value:75"></div>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="progress-solid">
                                    <div role="progressbar2" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="--value:75"></div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="progress-solid">
                                    <span class="numberrformat"><?= number_format(24700) ?> </span>
                                    <div role="progressbar3" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="--value:100"></div>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="progress-solid">
                                    <div role="progressbar1" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="--value:100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="hr-top">
                    <div class="col-12 alert alert-secondary secondary-itemss">
                        <div class="row">
                            <div class="col-lg-3 p-Gross">
                                Fixed Expense (Other)
                            </div>
                            <div class="col-lg-2">
                                <div class="progress-solid">
                                    <div role="progressbar1" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="--value:75"></div>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="progress-solid">
                                    <div role="progressbar2" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="--value:75"></div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="progress-solid">
                                    <span class="numberrformat"><?= number_format(24700) ?> </span>
                                    <div role="progressbar3" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="--value:100"></div>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="progress-solid">
                                    <div role="progressbar1" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="--value:100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="hr-top">
                    <div class="col-12 alert alert-secondary secondary-itemss">
                        <div class="row">
                            <div class="col-lg-3 p-Gross">
                                Fixed Expense
                            </div>
                            <div class="col-lg-2">
                                <div class="progress-solid">
                                    <div role="progressbar1" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="--value:75"></div>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="progress-solid">
                                    <div role="progressbar2" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="--value:75"></div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="progress-solid">
                                    <span class="numberrformat"><?= number_format(24700) ?> </span>
                                    <div role="progressbar3" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="--value:100"></div>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="progress-solid">
                                    <div role="progressbar1" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="--value:100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="hr-top">
                    <div class="col-12 alert alert-secondary secondary-itemss">
                        <div class="row">
                            <div class="col-lg-3 p-Gross">
                                Operating Profit (or Loss)
                            </div>
                            <div class="col-lg-2">
                                <div class="progress-solid">
                                    <div role="progressbar1" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="--value:75"></div>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="progress-solid">
                                    <div role="progressbar2" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="--value:75"></div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="progress-solid">
                                    <span class="numberrformat"><?= number_format(24700) ?> </span>
                                    <div role="progressbar3" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="--value:100"></div>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="progress-solid">
                                    <div role="progressbar1" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="--value:100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="hr-top">
                    <div class="col-12 alert alert-secondary secondary-itemss">
                        <div class="row">
                            <div class="col-lg-3 p-Gross">
                                Non-Operating Income
                            </div>
                            <div class="col-lg-2">
                                <div class="progress-solid">
                                    <div role="progressbar1" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="--value:75"></div>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="progress-solid">
                                    <div role="progressbar2" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="--value:75"></div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="progress-solid">
                                    <span class="numberrformat"><?= number_format(24700) ?> </span>
                                    <div role="progressbar3" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="--value:100"></div>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="progress-solid">
                                    <div role="progressbar1" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="--value:100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="hr-top">
                    <div class="col-12 alert alert-secondary secondary-itemss">
                        <div class="row">
                            <div class="col-lg-3 p-Gross">
                                Non-Operating Expense
                            </div>
                            <div class="col-lg-2">
                                <div class="progress-solid">
                                    <div role="progressbar1" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="--value:75"></div>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="progress-solid">
                                    <div role="progressbar2" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="--value:75"></div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="progress-solid">
                                    <span class="numberrformat"><?= number_format(24700) ?> </span>
                                    <div role="progressbar3" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="--value:100"></div>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="progress-solid">
                                    <div role="progressbar1" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="--value:100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="hr-top">
                    <div class="col-12 alert alert-secondary secondary-itemss">
                        <div class="row">
                            <div class="col-lg-3 p-Gross">
                                Ordinary Profit (or Loss)
                            </div>
                            <div class="col-lg-2">
                                <div class="progress-solid">
                                    <div role="progressbar1" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="--value:75"></div>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="progress-solid">
                                    <div role="progressbar2" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="--value:75"></div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="progress-solid">
                                    <span class="numberrformat"><?= number_format(24700) ?> </span>
                                    <div role="progressbar3" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="--value:100"></div>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="progress-solid">
                                    <div role="progressbar1" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="--value:100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="hr-top">
                    <div class="col-12 alert alert-secondary secondary-itemss">
                        <div class="row">
                            <div class="col-lg-3 p-Gross">
                                Break-Even Point
                            </div>
                            <div class="col-lg-2">
                                <div class="progress-solid">
                                    <div role="progressbar1" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="--value:75"></div>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="progress-solid">
                                    <div role="progressbar2" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="--value:75"></div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="progress-solid">
                                    <span class="numberrformat"><?= number_format(24700) ?> </span>
                                    <div role="progressbar3" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="--value:100"></div>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="progress-solid">
                                    <div role="progressbar1" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="--value:100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="hr-top">
                    <div class="col-12 alert alert-secondary secondary-itemss">
                        <div class="row">
                            <div class="col-lg-3 p-Gross">
                                Marginal Profit Ratio
                            </div>
                            <div class="col-lg-2">
                                <div class="progress-solid">
                                    <div role="progressbar1" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="--value:75"></div>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="progress-solid">
                                    <div role="progressbar2" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="--value:75"></div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="progress-solid">
                                    <span class="numberrformat"><?= number_format(24700) ?> </span>
                                    <div role="progressbar3" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="--value:100"></div>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="progress-solid">
                                    <div role="progressbar1" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="--value:100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-1">
                    <div class="alert alert-secondary secondary-CurrentYear" style="border: none;margin-top:130px;padding-top:95px;">
                        <div class="col-12 text-center">
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Monthly.png" class="icons_Monthly">
                            <div class="m-calendar"></div>
                        </div>
                        <div class="col-12 text-center">
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Accumulated.png" class="icons_Monthly">
                        </div>
                        <div class="col-12 text-center pt-30">
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Monthly.png" class="icons_Monthly">
                            <div class="m-calendar"></div>
                        </div>
                        <div class="col-12 text-center">
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Accumulated.png" class="icons_Monthly">
                        </div>
                        <div class="col-12 text-center pt-25">
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Monthly.png" class="icons_Monthly">
                            <div class="m-calendar"></div>
                        </div>
                        <div class="col-12 text-center">
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Accumulated.png" class="icons_Monthly">
                        </div>
                        <div class="col-12 text-center pt-30">
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Monthly.png" class="icons_Monthly">
                            <div class="m-calendar"></div>
                        </div>
                        <div class="col-12 text-center">
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Accumulated.png" class="icons_Monthly">
                        </div>
                        <div class="col-12 text-center pt-25">
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Monthly.png" class="icons_Monthly">
                            <div class="m-calendar"></div>
                        </div>
                        <div class="col-12 text-center">
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Accumulated.png" class="icons_Monthly">
                        </div>
                        <div class="col-12 text-center pt-25">
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Monthly.png" class="icons_Monthly">
                            <div class="m-calendar"></div>
                        </div>
                        <div class="col-12 text-center">
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Accumulated.png" class="icons_Monthly">
                        </div>
                        <div class="col-12 text-center pt-25">
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Monthly.png" class="icons_Monthly">
                            <div class="m-calendar"></div>
                        </div>
                        <div class="col-12 text-center">
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Accumulated.png" class="icons_Monthly">
                        </div>
                        <div class="col-12 text-center pt-25">
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Monthly.png" class="icons_Monthly">
                            <div class="m-calendar"></div>
                        </div>
                        <div class="col-12 text-center">
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Accumulated.png" class="icons_Monthly">
                        </div>
                        <div class="col-12 text-center pt-30">
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Monthly.png" class="icons_Monthly">
                            <div class="m-calendar"></div>
                        </div>
                        <div class="col-12 text-center">
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Accumulated.png" class="icons_Monthly">
                        </div>
                        <div class="col-12 text-center pt-30">
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Monthly.png" class="icons_Monthly">
                            <div class="m-calendar"></div>
                        </div>
                        <div class="col-12 text-center">
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Accumulated.png" class="icons_Monthly">
                        </div>
                        <div class="col-12 text-center pt-30">
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Monthly.png" class="icons_Monthly">
                            <div class="m-calendar"></div>
                        </div>
                        <div class="col-12 text-center">
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Accumulated.png" class="icons_Monthly">
                        </div>
                        <div class="col-12 text-center pt-20">
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Monthly.png" class="icons_Monthly">
                            <div class="m-calendar"></div>
                        </div>
                        <div class="col-12 text-center">
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Accumulated.png" class="icons_Monthly">
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="alert alert-secondary secondary-CurrentYear">
                        <div class="row">
                            <div class="col-2 BTH1">
                                BTH (฿)
                            </div>
                            <div class="col-2 text-secondary financial_all_Roundup">
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Round-Up.png" class="images_Round-Up" data-bs-toggle="modal" data-bs-target="#RoundUp"> <span class="text_Roundup1">Round Up</span>
                            </div>
                            <div class="col-2 font-size-12">
                                <select class="form-select text-primary font-size-12" aria-label="Default select example">
                                    <option selected value="">None</option>
                                    <option value="1">2020</option>
                                    <option value="2">2021</option>
                                    <option value="3">2022</option>
                                    <option value="4">2024</option>
                                </select>

                            </div>
                            <div class="col-2 badge bg-light  pt-9" data-bs-toggle="modal" data-bs-target="#staticBackdropCurrency" style="height: 30px; cursor: pointer;">
                                <div class="circledollar">
                                    <i class="fa fa-usd pl-4 font-size-10" aria-hidden="true"></i><span class="Curr">Currency</span>
                                </div>
                            </div>
                            <div class="col-4 font-size-12 pt-5">
                                <ul class="nav nav-pills" id="pills-tab" role="tablist">
                                    <div class="col-3 nav-item" role="presentation">
                                        <a class="nav-link pt-table text-dark" id="pills-All-tab" data-bs-toggle="pill" data-bs-target="#pills-All" type="button" role="tab" aria-controls="pills-All" aria-selected="true"> All</a>
                                    </div>
                                    <div class="col-3 nav-item" role="presentation">
                                        <a class="nav-link pt-table text-dark" id="pills-Q1-tab" data-bs-toggle="pill" data-bs-target="#pills-Q1" type="button" role="tab" aria-controls="pills-Q1" aria-selected="false"> Q1</a>
                                    </div>
                                    <div class="col-3 nav-item" role="presentation">
                                        <a class="nav-link pt-table text-dark" id="pills-Q2-tab" data-bs-toggle="pill" data-bs-target="#pills-Q2" type="button" role="tab" aria-controls="pills-Q2" aria-selected="false"> Q2</a>
                                    </div>
                                    <div class="col-3 nav-item" role="presentation">
                                        <a class="nav-link pt-table text-dark" id="pills-Q3-tab" data-bs-toggle="pill" data-bs-target="#pills-Q3" type="button" role="tab" aria-controls="pills-Q3" aria-selected="false"> Q3</a>
                                    </div>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="line1"></div>
                        <div style="display:inline-block;font-size:11px;">QUARTERLY</div>
                        <div class="line1"></div>
                    </div>
                    <div class="row mt-20">
                        <div class="col-lg-4">
                            <div class="alert alert-secondary secondary-CurrentYear">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-lg-6 BTH-Month">
                                            January
                                        </div>
                                        <div class="col-lg-6 caret-square">
                                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/CoolapseAside.png" class="images_CoolapseAside">
                                        </div>
                                        <div class="col-lg-3 font-size-10 mt-3">
                                            <span class="badge gbb_AC_blue">AC</span> <span class="AA-2022">2022</span>
                                        </div>
                                        <div class="col-lg-3 font-size-10 mt-3">
                                            <span class="badge dge_AAR_green">AC</span> <span class="AA-2022">2023</span>
                                        </div>
                                        <div class="col-lg-3 font-size-10 mt-3">
                                            <span class="badge dge_AAR_warning">T</span> <span span class="AA-2022">2023</span>
                                        </div>
                                        <div class="col-lg-3 font-size-10 mt-3">
                                            <span class="badge gbb_AC_blue">T</span> <span span class="AA-2022">2024</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="alert alert-secondary secondary-itemss">
                                <div class="row">
                                    <div class="col-3 font-size-10">
                                        <?= number_format(1000) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(2000) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(1800) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(2500) ?>
                                    </div>
                                    <div class="number-solidd"></div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(1000) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(2000) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(1800) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(2500) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="alert alert-secondary secondary-CurrentYear">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-lg-6 BTH-Month">
                                            February
                                        </div>
                                        <div class="col-lg-6 caret-square">
                                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/CoolapseAside.png" class="images_CoolapseAside">
                                        </div>
                                        <div class="col-lg-3 font-size-10 mt-3">
                                            <span class="badge gbb_AC_blue">AC</span> <span class="AA-2022">2022</span>
                                        </div>
                                        <div class="col-lg-3 font-size-10 mt-3">
                                            <span class="badge dge_AAR_green">AC</span> <span class="AA-2022">2023</span>
                                        </div>
                                        <div class="col-lg-3 font-size-10 mt-3">
                                            <span class="badge dge_AAR_warning">T</span> <span span class="AA-2022">2023</span>
                                        </div>
                                        <div class="col-lg-3 font-size-10 mt-3">
                                            <span class="badge gbb_AC_blue">T</span> <span span class="AA-2022">2024</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="alert alert-secondary secondary-itemss">
                                <div class="row">
                                    <div class="col-3 font-size-10">
                                        <?= number_format(1000) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(2000) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(1800) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(2500) ?>
                                    </div>
                                    <div class="number-solidd"></div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(1000) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(2000) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(1800) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(2500) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="alert alert-secondary secondary-CurrentYear">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-lg-6 BTH-Month">
                                            March
                                        </div>
                                        <div class="col-lg-6 caret-square">
                                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/CoolapseAside.png" class="images_CoolapseAside">
                                        </div>
                                        <div class="col-lg-3 font-size-10 mt-3">
                                            <span class="badge gbb_AC_blue">AC</span> <span class="AA-2022">2022</span>
                                        </div>
                                        <div class="col-lg-3 font-size-10 mt-3">
                                            <span class="badge dge_AAR_green">AC</span> <span class="AA-2022">2023</span>
                                        </div>
                                        <div class="col-lg-3 font-size-10 mt-3">
                                            <span class="badge dge_AAR_warning">T</span> <span span class="AA-2022">2023</span>
                                        </div>
                                        <div class="col-lg-3 font-size-10 mt-3">
                                            <span class="badge gbb_AC_blue">T</span> <span span class="AA-2022">2024</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="alert alert-secondary secondary-itemss">
                                <div class="row">
                                    <div class="col-3 font-size-10">
                                        <?= number_format(1000) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(2000) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(1800) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(2500) ?>
                                    </div>
                                    <div class="number-solidd"></div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(1000) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(2000) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(1800) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(2500) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr style="margin-top: -10px;">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="alert alert-secondary secondary-itemss">
                                <div class="row">
                                    <div class="col-3 font-size-10">
                                        <?= number_format(1000) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(2000) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(1800) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(2500) ?>
                                    </div>
                                    <div class="number-solidd"></div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(1000) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(2000) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(1800) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(2500) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="alert alert-secondary secondary-itemss">
                                <div class="row">
                                    <div class="col-3 font-size-10">
                                        <?= number_format(1000) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(2000) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(1800) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(2500) ?>
                                    </div>
                                    <div class="number-solidd"></div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(1000) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(2000) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(1800) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(2500) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="alert alert-secondary secondary-itemss">
                                <div class="row">
                                    <div class="col-3 font-size-10">
                                        <?= number_format(1000) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(2000) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(1800) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(2500) ?>
                                    </div>
                                    <div class="number-solidd"></div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(1000) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(2000) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(1800) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(2500) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr style="margin-top: -10px;">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="alert alert-secondary secondary-itemss">
                                <div class="row">
                                    <div class="col-3 font-size-10">
                                        <?= number_format(1000) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(2000) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(1800) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(2500) ?>
                                    </div>
                                    <div class="number-solidd"></div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(1000) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(2000) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(1800) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(2500) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="alert alert-secondary secondary-itemss">
                                <div class="row">
                                    <div class="col-3 font-size-10">
                                        <?= number_format(1000) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(2000) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(1800) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(2500) ?>
                                    </div>
                                    <div class="number-solidd"></div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(1000) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(2000) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(1800) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(2500) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="alert alert-secondary secondary-itemss">
                                <div class="row">
                                    <div class="col-3 font-size-10">
                                        <?= number_format(1000) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(2000) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(1800) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(2500) ?>
                                    </div>
                                    <div class="number-solidd"></div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(1000) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(2000) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(1800) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(2500) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr style="margin-top: -10px;">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="alert alert-secondary secondary-itemss">
                                <div class="row">
                                    <div class="col-3 font-size-10">
                                        <?= number_format(1000) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(2000) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(1800) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(2500) ?>
                                    </div>
                                    <div class="number-solidd"></div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(1000) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(2000) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(1800) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(2500) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="alert alert-secondary secondary-itemss">
                                <div class="row">
                                    <div class="col-3 font-size-10">
                                        <?= number_format(1000) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(2000) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(1800) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(2500) ?>
                                    </div>
                                    <div class="number-solidd"></div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(1000) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(2000) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(1800) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(2500) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="alert alert-secondary secondary-itemss">
                                <div class="row">
                                    <div class="col-3 font-size-10">
                                        <?= number_format(1000) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(2000) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(1800) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(2500) ?>
                                    </div>
                                    <div class="number-solidd"></div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(1000) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(2000) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(1800) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(2500) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr style="margin-top: -10px;">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="alert alert-secondary secondary-itemss">
                                <div class="row">
                                    <div class="col-3 font-size-10">
                                        <?= number_format(1000) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(2000) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(1800) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(2500) ?>
                                    </div>
                                    <div class="number-solidd"></div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(1000) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(2000) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(1800) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(2500) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="alert alert-secondary secondary-itemss">
                                <div class="row">
                                    <div class="col-3 font-size-10">
                                        <?= number_format(1000) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(2000) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(1800) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(2500) ?>
                                    </div>
                                    <div class="number-solidd"></div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(1000) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(2000) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(1800) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(2500) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="alert alert-secondary secondary-itemss">
                                <div class="row">
                                    <div class="col-3 font-size-10">
                                        <?= number_format(1000) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(2000) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(1800) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(2500) ?>
                                    </div>
                                    <div class="number-solidd"></div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(1000) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(2000) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(1800) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(2500) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr style="margin-top: -10px;">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="alert alert-secondary secondary-itemss">
                                <div class="row">
                                    <div class="col-3 font-size-10">
                                        <?= number_format(1000) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(2000) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(1800) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(2500) ?>
                                    </div>
                                    <div class="number-solidd"></div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(1000) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(2000) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(1800) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(2500) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="alert alert-secondary secondary-itemss">
                                <div class="row">
                                    <div class="col-3 font-size-10">
                                        <?= number_format(1000) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(2000) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(1800) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(2500) ?>
                                    </div>
                                    <div class="number-solidd"></div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(1000) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(2000) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(1800) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(2500) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="alert alert-secondary secondary-itemss">
                                <div class="row">
                                    <div class="col-3 font-size-10">
                                        <?= number_format(1000) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(2000) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(1800) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(2500) ?>
                                    </div>
                                    <div class="number-solidd"></div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(1000) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(2000) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(1800) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(2500) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr style="margin-top: -10px;">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="alert alert-secondary secondary-itemss">
                                <div class="row">
                                    <div class="col-3 font-size-10">
                                        <?= number_format(1000) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(2000) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(1800) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(2500) ?>
                                    </div>
                                    <div class="number-solidd"></div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(1000) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(2000) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(1800) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(2500) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="alert alert-secondary secondary-itemss">
                                <div class="row">
                                    <div class="col-3 font-size-10">
                                        <?= number_format(1000) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(2000) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(1800) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(2500) ?>
                                    </div>
                                    <div class="number-solidd"></div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(1000) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(2000) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(1800) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(2500) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="alert alert-secondary secondary-itemss">
                                <div class="row">
                                    <div class="col-3 font-size-10">
                                        <?= number_format(1000) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(2000) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(1800) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(2500) ?>
                                    </div>
                                    <div class="number-solidd"></div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(1000) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(2000) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(1800) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(2500) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr style="margin-top: -10px;">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="alert alert-secondary secondary-itemss">
                                <div class="row">
                                    <div class="col-3 font-size-10">
                                        <?= number_format(1000) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(2000) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(1800) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(2500) ?>
                                    </div>
                                    <div class="number-solidd"></div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(1000) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(2000) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(1800) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(2500) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="alert alert-secondary secondary-itemss">
                                <div class="row">
                                    <div class="col-3 font-size-10">
                                        <?= number_format(1000) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(2000) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(1800) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(2500) ?>
                                    </div>
                                    <div class="number-solidd"></div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(1000) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(2000) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(1800) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(2500) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="alert alert-secondary secondary-itemss">
                                <div class="row">
                                    <div class="col-3 font-size-10">
                                        <?= number_format(1000) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(2000) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(1800) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(2500) ?>
                                    </div>
                                    <div class="number-solidd"></div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(1000) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(2000) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(1800) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(2500) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr style="margin-top: -10px;">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="alert alert-secondary secondary-itemss">
                                <div class="row">
                                    <div class="col-3 font-size-10">
                                        <?= number_format(1000) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(2000) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(1800) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(2500) ?>
                                    </div>
                                    <div class="number-solidd"></div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(1000) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(2000) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(1800) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(2500) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="alert alert-secondary secondary-itemss">
                                <div class="row">
                                    <div class="col-3 font-size-10">
                                        <?= number_format(1000) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(2000) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(1800) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(2500) ?>
                                    </div>
                                    <div class="number-solidd"></div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(1000) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(2000) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(1800) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(2500) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="alert alert-secondary secondary-itemss">
                                <div class="row">
                                    <div class="col-3 font-size-10">
                                        <?= number_format(1000) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(2000) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(1800) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(2500) ?>
                                    </div>
                                    <div class="number-solidd"></div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(1000) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(2000) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(1800) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(2500) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr style="margin-top: -10px;">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="alert alert-secondary secondary-itemss">
                                <div class="row">
                                    <div class="col-3 font-size-10">
                                        <?= number_format(1000) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(2000) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(1800) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(2500) ?>
                                    </div>
                                    <div class="number-solidd"></div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(1000) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(2000) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(1800) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(2500) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="alert alert-secondary secondary-itemss">
                                <div class="row">
                                    <div class="col-3 font-size-10">
                                        <?= number_format(1000) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(2000) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(1800) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(2500) ?>
                                    </div>
                                    <div class="number-solidd"></div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(1000) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(2000) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(1800) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(2500) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="alert alert-secondary secondary-itemss">
                                <div class="row">
                                    <div class="col-3 font-size-10">
                                        <?= number_format(1000) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(2000) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(1800) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(2500) ?>
                                    </div>
                                    <div class="number-solidd"></div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(1000) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(2000) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(1800) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(2500) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr style="margin-top: -10px;">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="alert alert-secondary secondary-itemss">
                                <div class="row">
                                    <div class="col-3 font-size-10">
                                        <?= number_format(1000) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(2000) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(1800) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(2500) ?>
                                    </div>
                                    <div class="number-solidd"></div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(1000) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(2000) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(1800) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(2500) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="alert alert-secondary secondary-itemss">
                                <div class="row">
                                    <div class="col-3 font-size-10">
                                        <?= number_format(1000) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(2000) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(1800) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(2500) ?>
                                    </div>
                                    <div class="number-solidd"></div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(1000) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(2000) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(1800) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(2500) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="alert alert-secondary secondary-itemss">
                                <div class="row">
                                    <div class="col-3 font-size-10">
                                        <?= number_format(1000) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(2000) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(1800) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(2500) ?>
                                    </div>
                                    <div class="number-solidd"></div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(1000) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(2000) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(1800) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(2500) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr style="margin-top: -10px;">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="alert alert-secondary secondary-itemss">
                                <div class="row">
                                    <div class="col-3 font-size-10">
                                        <?= number_format(1000) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(2000) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(1800) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(2500) ?>
                                    </div>
                                    <div class="number-solidd"></div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(1000) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(2000) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(1800) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(2500) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="alert alert-secondary secondary-itemss">
                                <div class="row">
                                    <div class="col-3 font-size-10">
                                        <?= number_format(1000) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(2000) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(1800) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(2500) ?>
                                    </div>
                                    <div class="number-solidd"></div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(1000) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(2000) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(1800) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(2500) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="alert alert-secondary secondary-itemss">
                                <div class="row">
                                    <div class="col-3 font-size-10">
                                        <?= number_format(1000) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(2000) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(1800) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(2500) ?>
                                    </div>
                                    <div class="number-solidd"></div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(1000) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(2000) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(1800) ?>
                                    </div>
                                    <div class="col-3 font-size-10">
                                        <?= number_format(2500) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr style="margin-top: -10px;">
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="Modalfitter" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content modal-fitter">
            <div class="modal-header" style="border: none;">
                <div id="ModalfitterLabel">
                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/FilterPlus.png" class="picture-FilterPlus-bonus border-change"> <span class="Data_Filterfinancial1"> Data Filter</span>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="col-12 mt-20">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="Previous">
                            <label class="form-check-label" for="flexCheckDefault">
                                <span class="AC-Primary"> AC </span> &nbsp;&nbsp; Previous Year Actual
                            </label>
                        </div>
                    </div>
                    <div class="col-12 mt-20">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="Previous">
                            <label class="form-check-label" for="flexCheckDefault">
                                <span class="AC-Success"> AC </span> &nbsp;&nbsp; Current Year Actual
                            </label>
                        </div>
                    </div>
                    <div class="col-12 mt-20">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="Previous">
                            <label class="form-check-label" for="flexCheckDefault">
                                <span class="T-Warning"> T </span> &nbsp;&nbsp; Current Year Target
                            </label>
                        </div>
                    </div>
                    <div class="col-12 mt-20">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="Previous">
                            <label class="form-check-label" for="flexCheckDefault">
                                <span class="T-bule"> T </span> &nbsp;&nbsp; Next year Target
                            </label>
                        </div>
                    </div>
                    <div class="text-Done" data-bs-dismiss="modal" aria-label="done">
                        Done
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


<div class="modal fade" id="staticBackdropCurrency" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabelCurrency" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="container">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel"> Currency Conversion Rate</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-6 pl-20">
                        <label for="Inputformselectmenu" class="form-label">Form</label>
                        <div class="input-group mb-3">
                            <select class="form-select" aria-label="Default select example">
                                <option selected value=""></option>
                                <option value="US" data-content="">One</option>
                                <option value="CA">Two</option>
                                <option value="TH">Three</option>
                            </select>
                            <input type="text" class="form-control" aria-label="" aria-describedby="menucountry">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="RoundUp" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropRoundUp" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="col-12 pt-20">
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Round-Up.png" class="images_Round-Up"> <span class="text_Roundup">Round Up</span>
                        </div>
                    </div>
                    <div class="col-lg-6 pt-10">
                        <form>
                            <input class="chosen-value" type="text" value="" id="">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>