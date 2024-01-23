<?php
$this->title = 'Financial edit';
?>


<div class="col-12 mt-90">
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
        <div class="col-12 mt-30">
            <div class="alert alert2-secondary3">
                <div class="row">
                    <div class="col-lg-3 col-12">
                        <span class="badge bg-primary-summary">PL</span> <span class="Profit-Loss">Profit & Loss Forecast</span>
                    </div>
                    <div class="col-lg-6 col-12">
                        <button type="button" class="btn btn-primary font-size-15"> Save</button>
                        <button type="cancel" class="btn btn-secondary font-size-15"> Cancel</button>
                    </div>
                    <div class="col-lg-3 col-12">
                        <select class="form-select example-tok" aria-label="Default select example">
                            <option selected value="">Select</option>
                            <option value="1">Tokyo Consulting Group</option>
                            <option value="2">Tokyo Consulting firm</option>
                        </select>
                    </div>
                    <div class="row mt-30">
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
                                <div style="display:inline-block;font-size:10px;">ANNUAL SUMMARY</div>
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
                            <div class="col-12 alert alert-secondary secondary-itemss">
                                <div class="row">
                                    <div class="col-lg-3 p-Gross">
                                        Variable Expense
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
                                <div class="col-12 text-center pencil-edit">
                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Edit.png" class="icons_Edits">
                                </div>
                                <div class="col-12 text-center pt-50">
                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Monthly.png" class="icons_Monthly">
                                    <div class="m-calendar"></div>
                                </div>
                                <div class="col-12 text-center">
                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Accumulated.png" class="icons_Monthly">
                                </div>
                                <div class="col-12 text-center pt-50">
                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Monthly.png" class="icons_Monthly">
                                    <div class="m-calendar"></div>
                                </div>
                                <div class="col-12 text-center">
                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Accumulated.png" class="icons_Monthly">
                                </div>
                                <div class="col-12 text-center pt-50">
                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Monthly.png" class="icons_Monthly">
                                    <div class="m-calendar"></div>
                                </div>
                                <div class="col-12 text-center">
                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Accumulated.png" class="icons_Monthly">
                                </div>
                                <div class="col-12 text-center pt-50">
                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Monthly.png" class="icons_Monthly">
                                    <div class="m-calendar"></div>
                                </div>
                                <div class="col-12 text-center">
                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Accumulated.png" class="icons_Monthly">
                                </div>
                                <div class="col-12 text-center pt-50">
                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Monthly.png" class="icons_Monthly">
                                    <div class="m-calendar"></div>
                                </div>
                                <div class="col-12 text-center">
                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Accumulated.png" class="icons_Monthly">
                                </div>
                                <div class="col-12 text-center pt-50">
                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Monthly.png" class="icons_Monthly">
                                    <div class="m-calendar"></div>
                                </div>
                                <div class="col-12 text-center">
                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Accumulated.png" class="icons_Monthly">
                                </div>
                                <div class="col-12 text-center pt-50">
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
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="alert alert-secondary secondary-CurrentYear">
                                <div class="row">
                                    <div class="col-lg-2">
                                    </div>
                                    <div class="col-lg-3">
                                    </div>
                                    <div class="col-2">
                                    </div>
                                    <div class="col-lg-5">
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
                                <div style="display:inline-block;font-size:11px;">ALL</div>
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
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="" placeholder="0">
                                            </div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="" placeholder="0">
                                            </div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="" placeholder="0">
                                            </div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="" placeholder="0">
                                            </div>
                                            <div class="number-solidd"></div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="" placeholder="0">
                                            </div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="" placeholder="0">
                                            </div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="" placeholder="0">
                                            </div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="" placeholder="0">
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
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="number-solidd"></div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
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
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="number-solidd"></div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="hr-top" style="margin-top:-10px;">
                            <div class="row mt-20">
                                <div class="col-lg-4">
                                    <div class="alert alert-secondary secondary-itemss">
                                        <div class="row">
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="number-solidd"></div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="alert alert-secondary secondary-itemss">
                                        <div class="row">
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="number-solidd"></div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="alert alert-secondary secondary-itemss">
                                        <div class="row">
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="number-solidd"></div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="hr-top" style="margin-top:-10px;">
                            <div class="row mt-20">
                                <div class="col-lg-4">
                                    <div class="alert alert-secondary secondary-itemss">
                                        <div class="row">
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="number-solidd"></div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="alert alert-secondary secondary-itemss">
                                        <div class="row">
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="number-solidd"></div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="alert alert-secondary secondary-itemss">
                                        <div class="row">
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="number-solidd"></div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="hr-top" style="margin-top:-10px;">
                            <div class="row mt-20">
                                <div class="col-lg-4">
                                    <div class="alert alert-secondary secondary-itemss">
                                        <div class="row">
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="number-solidd"></div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="alert alert-secondary secondary-itemss">
                                        <div class="row">
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="number-solidd"></div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="alert alert-secondary secondary-itemss">
                                        <div class="row">
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="number-solidd"></div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="hr-top" style="margin-top:-10px;">
                            <div class="row mt-20">
                                <div class="col-lg-4">
                                    <div class="alert alert-secondary secondary-itemss">
                                        <div class="row">
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="number-solidd"></div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="alert alert-secondary secondary-itemss">
                                        <div class="row">
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="number-solidd"></div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="alert alert-secondary secondary-itemss">
                                        <div class="row">
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="number-solidd"></div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="hr-top" style="margin-top:-10px;">
                            <div class="row mt-20">
                                <div class="col-lg-4">
                                    <div class="alert alert-secondary secondary-itemss">
                                        <div class="row">
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="number-solidd"></div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="alert alert-secondary secondary-itemss">
                                        <div class="row">
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="number-solidd"></div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="alert alert-secondary secondary-itemss">
                                        <div class="row">
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="number-solidd"></div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="hr-top" style="margin-top:-10px;">
                            <div class="row mt-20">
                                <div class="col-lg-4">
                                    <div class="alert alert-secondary secondary-itemss">
                                        <div class="row">
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="number-solidd"></div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="alert alert-secondary secondary-itemss">
                                        <div class="row">
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="number-solidd"></div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="alert alert-secondary secondary-itemss">
                                        <div class="row">
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="number-solidd"></div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="hr-top" style="margin-top:-10px;">
                            <div class="row mt-20">
                                <div class="col-lg-4">
                                    <div class="alert alert-secondary secondary-itemss">
                                        <div class="row">
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="number-solidd"></div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="alert alert-secondary secondary-itemss">
                                        <div class="row">
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="number-solidd"></div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="alert alert-secondary secondary-itemss">
                                        <div class="row">
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="number-solidd"></div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                            <div class="col-3">
                                                <input type="text" class="form-control edit-numbermonth" id="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="hr-top" style="margin-top:-10px;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>