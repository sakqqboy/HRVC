<?php
$this->title = 'Gloden';
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
                <div class="col-lg-2 col-12">
                    <span class="badge bg-primary-summary">PL</span> <span class="Profit-Loss">Profit & Loss Forecast</span>
                </div>
                <div class="col-lg-2 col-12">
                    <button type="button" class="btn btn-primary font-size-12"><i class="fa fa-magic" aria-hidden="true"></i>&nbsp;Register</button>
                </div>
                <div class="col-lg-4 col-12">
                    <button type="button" class="btn btn-light Data" data-bs-toggle="modal" data-bs-target="#DataDistionary"><i class="fa fa-info-circle" aria-hidden="true"></i> Data Dictionary</button>
                    <button type="button" class="btn btn-light Data"><i class="fa fa-line-chart" aria-hidden="true"></i> Comparison Charts</button>
                    <button type="button" class="btn btn-light Data"><i class="fa fa-arrow-circle-down" aria-hidden="true"></i> Export</button>
                </div>
                <div class="col-lg-2 col-12">
                    <select class="form-select example-tok" aria-label="Default select example">
                        <option selected value="">Select</option>
                        <option value="1">Tokyo Consulting Group</option>
                        <option value="2">Tokyo Consulting firm</option>
                    </select>
                </div>
                <div class="col-lg-1 col-12 text-end">
                    <i class="fa fa-filter" aria-hidden="true"></i> <i class="fa fa-plus content-Fitter" aria-hidden="true" data-bs-toggle="modal" data-bs-target="#Modalfitter"></i>
                </div>
                <div class="col-lg-1 col-12">
                    <span class="Fitter-PL">Fitter</span> <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
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
                                <span class="badge bg-primary">AAR</span> <strong>2022</strong>
                            </div>
                            <div class="col-2 AAR-2022">
                                <span class="badge bg-primary">AAR</span> <strong>2023</strong>
                            </div>
                            <div class="col-3 AAR-2022">
                                <span class="badge bg-warning text-dark">AT</span> <strong>2023</strong> <span class="badge bg-warning text-dark">ATR</span>
                            </div>
                            <div class="col-2 AAR-2022">
                                <span class="badge bg-primary">ATR</span> <strong>2024</strong>
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
                            <i class="fa fa-calendar-o font-size-11" aria-hidden="true"></i>
                            <div class="m-calendar"></div>
                        </div>
                        <div class="col-12 text-center">
                            <img src="<?= Yii::$app->homeUrl ?>image/network.png">
                        </div>
                        <div class="col-12 text-center pt-30">
                            <i class="fa fa-calendar-o font-size-11" aria-hidden="true"></i>
                            <div class="m-calendar"></div>
                        </div>
                        <div class="col-12 text-center">
                            <img src="<?= Yii::$app->homeUrl ?>image/network.png">
                        </div>
                        <div class="col-12 text-center pt-25">
                            <i class="fa fa-calendar-o font-size-11" aria-hidden="true"></i>
                            <div class="m-calendar"></div>
                        </div>
                        <div class="col-12 text-center">
                            <img src="<?= Yii::$app->homeUrl ?>image/network.png">
                        </div>
                        <div class="col-12 text-center pt-30">
                            <i class="fa fa-calendar-o font-size-11" aria-hidden="true"></i>
                            <div class="m-calendar"></div>
                        </div>
                        <div class="col-12 text-center">
                            <img src="<?= Yii::$app->homeUrl ?>image/network.png">
                        </div>
                        <div class="col-12 text-center pt-25">
                            <i class="fa fa-calendar-o font-size-11" aria-hidden="true"></i>
                            <div class="m-calendar"></div>
                        </div>
                        <div class="col-12 text-center">
                            <img src="<?= Yii::$app->homeUrl ?>image/network.png">
                        </div>
                        <div class="col-12 text-center pt-25">
                            <i class="fa fa-calendar-o font-size-11" aria-hidden="true"></i>
                            <div class="m-calendar"></div>
                        </div>
                        <div class="col-12 text-center">
                            <img src="<?= Yii::$app->homeUrl ?>image/network.png">
                        </div>
                        <div class="col-12 text-center pt-25">
                            <i class="fa fa-calendar-o font-size-11" aria-hidden="true"></i>
                            <div class="m-calendar"></div>
                        </div>
                        <div class="col-12 text-center">
                            <img src="<?= Yii::$app->homeUrl ?>image/network.png">
                        </div>
                        <div class="col-12 text-center pt-25">
                            <i class="fa fa-calendar-o font-size-11" aria-hidden="true"></i>
                            <div class="m-calendar"></div>
                        </div>
                        <div class="col-12 text-center">
                            <img src="<?= Yii::$app->homeUrl ?>image/network.png">
                        </div>
                        <div class="col-12 text-center pt-30">
                            <i class="fa fa-calendar-o font-size-11" aria-hidden="true"></i>
                            <div class="m-calendar"></div>
                        </div>
                        <div class="col-12 text-center">
                            <img src="<?= Yii::$app->homeUrl ?>image/network.png">
                        </div>
                        <div class="col-12 text-center pt-30">
                            <i class="fa fa-calendar-o font-size-11" aria-hidden="true"></i>
                            <div class="m-calendar"></div>
                        </div>
                        <div class="col-12 text-center">
                            <img src="<?= Yii::$app->homeUrl ?>image/network.png">
                        </div>
                        <div class="col-12 text-center pt-30">
                            <i class="fa fa-calendar-o font-size-11" aria-hidden="true"></i>
                            <div class="m-calendar"></div>
                        </div>
                        <div class="col-12 text-center">
                            <img src="<?= Yii::$app->homeUrl ?>image/network.png">
                        </div>
                        <div class="col-12 text-center pt-20">
                            <i class="fa fa-calendar-o font-size-11" aria-hidden="true"></i>
                            <div class="m-calendar"></div>
                        </div>
                        <div class="col-12 text-center">
                            <img src="<?= Yii::$app->homeUrl ?>image/network.png">
                        </div>
                        <div class="col-12 text-center pt-20">
                            <i class="fa fa-calendar-o font-size-11" aria-hidden="true"></i>
                            <div class="m-calendar"></div>
                        </div>
                        <div class="col-12 text-center">
                            <img src="<?= Yii::$app->homeUrl ?>image/network.png">
                        </div>
                        <div class="col-12 text-center pt-20">
                            <i class="fa fa-calendar-o font-size-11" aria-hidden="true"></i>
                            <div class="m-calendar"></div>
                        </div>
                        <div class="col-12 text-center">
                            <img src="<?= Yii::$app->homeUrl ?>image/network.png">
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="alert alert-secondary secondary-CurrentYear">
                        <div class="row">
                            <div class="col-lg-2 text-secondary">
                                BTH (฿)
                            </div>
                            <div class="col-lg-3">
                                <select class="form-select text-primary font-size-12" aria-label="Default select example">
                                    <option selected value="">None</option>
                                    <option value="1">2020</option>
                                    <option value="2">2021</option>
                                    <option value="3">2022</option>
                                    <option value="4">2024</option>
                                </select>
                            </div>
                            <div class="col-2 badge bg-light text-primary pt-9" style="height: 30px;">
                                <i class="fa fa-usd" aria-hidden="true"></i> Currency
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
                                            <i class="fa fa-caret-square-o-left" aria-hidden="true"></i>
                                        </div>
                                        <div class="col-lg-3 font-size-10 mt-3">
                                            <span class="badge bg-primary">AC</span> 2022
                                        </div>
                                        <div class="col-lg-3 font-size-10 mt-3">
                                            <span class="badge bg-success">AC</span> 2023
                                        </div>
                                        <div class="col-lg-3 font-size-10 mt-3">
                                            <span class="badge bg-warning">T</span> 2023
                                        </div>
                                        <div class="col-lg-3 font-size-10 mt-3">
                                            <span class="badge bg-primary">T</span> 2024
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
                                            <i class="fa fa-caret-square-o-left" aria-hidden="true"></i>
                                        </div>
                                        <div class="col-lg-3 font-size-10 mt-3">
                                            <span class="badge bg-primary">AC</span> 2022
                                        </div>
                                        <div class="col-lg-3 font-size-10 mt-3">
                                            <span class="badge bg-success">AC</span> 2023
                                        </div>
                                        <div class="col-lg-3 font-size-10 mt-3">
                                            <span class="badge bg-warning">T</span> 2023
                                        </div>
                                        <div class="col-lg-3 font-size-10 mt-3">
                                            <span class="badge bg-primary">T</span> 2024
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
                                            <i class="fa fa-caret-square-o-left" aria-hidden="true"></i>
                                        </div>
                                        <div class="col-lg-3 font-size-10 mt-3">
                                            <span class="badge bg-primary">AC</span> 2022
                                        </div>
                                        <div class="col-lg-3 font-size-10 mt-3">
                                            <span class="badge bg-success">AC</span> 2023
                                        </div>
                                        <div class="col-lg-3 font-size-10 mt-3">
                                            <span class="badge bg-warning">T</span> 2023
                                        </div>
                                        <div class="col-lg-3 font-size-10 mt-3">
                                            <span class="badge bg-primary">T</span> 2024
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
                    <i class="fa fa-filter" aria-hidden="true"></i> <i class="fa fa-plus content-Fitter1" aria-hidden="true"></i> &nbsp;&nbsp; Data Filter
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="col-12 mt-20">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="Previous">
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
                                <span class="T-bule"> T </span> &nbsp;&nbsp; Current Year Target
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
                    <div class="col-5 text-end font-size-13">
                        <img src="<?= Yii::$app->homeUrl ?>image/network.png"> Accumulate
                    </div>
                    <div class="col-5 text-end font-size-13">
                        <i class="fa fa-calendar-o" aria-hidden="true"></i> Monthly
                    </div>
                    <hr class="mt-5">
                </div>

                <div class="col-12 mt-20">
                    <span class="AC-Primary font-size-11"> AAR </span> &nbsp;&nbsp; Accumulate Actual Ratio
                </div>
                <div class="col-12 mt-20">
                    <span class="AC-Success font-size-11"> AAR </span> &nbsp;&nbsp; Accumulate Actual Ratio
                </div>
                <div class="col-12 mt-20">
                    <span class="T-Warning text-dark font-size-11"> AT </span> &nbsp;&nbsp;&nbsp; Accumulate Target
                </div>
                <div class="col-12 mt-20">
                    <span class="T-Warning text-dark font-size-11"> ATR </span> &nbsp;&nbsp; Accumulate Target ratio
                </div>
                <div class="col-12 mt-20">
                    <span class="T-bule font-size-11"> ATR </span> &nbsp;&nbsp; Accumulate Target ratio
                </div>
                <hr>
                <div class="col-12 mt-20">
                    <span class="AC-Success font-size-11"> AC </span> &nbsp;&nbsp; Actual
                </div>
                <div class="col-12 mt-20">
                    <span class="T-Warning font-size-11"> T </span> &nbsp;&nbsp; Target
                </div>
                <hr>
            </div>
        </div>
    </div>
</div>