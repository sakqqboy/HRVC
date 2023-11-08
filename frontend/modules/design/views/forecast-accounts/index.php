<?php
$this->title = 'Forecast Accounts';
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
                <div class="col-lg-9 col-md-6 col-12">
                    <div class="col-12">
                        Monthly Forecasted Accounts
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="col-12 text-end">
                        <select class="form-select example-tok1" aria-label="Default select example">
                            <option selected value="">Select</option>
                            <option value="1">Tokyo Consulting firm</option>
                            <option value="2">Tokyo Consulting Group</option>
                            <option value="3">Tokyo Consulting Group</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="alert bg-backgroundforecastaccounts">
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-3 forecast-solid">
                        <div class="card" style="border:none;">
                            <div class="row">
                                <div class="col-lg-2 col-md-6 col-12">
                                    <img src="<?= Yii::$app->homeUrl ?>image/pp.png" class="image-pp">
                                </div>
                                <div class="col-lg-4 col-md-6 col-12">
                                    <div class="col-12 forecast-price">
                                        <strong>Price</strong>
                                    </div>
                                    <div class="col-12 Product-Appeal">
                                        (Product Appeal)
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="row">
                                        <div class="col-7 Sensitivity">
                                            Sensitivity ratio
                                        </div>
                                        <div class="col-5 Sensitivity">
                                            <strong> <?= number_format(23.0) ?>%</strong>
                                        </div>
                                        <div class="col-7 Sensitivity">
                                            Sensitivity Rank
                                        </div>
                                        <div class="col-5 Sensitivity">
                                            <strong> <?= number_format(2) ?></strong>
                                        </div>
                                        <div class="col-7 Sensitivity">
                                            Strategic Rank
                                        </div>
                                        <div class="col-5 Sensitivity">
                                            <strong> N/A</strong>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-3 forecast-solid">
                        <div class="card" style="border:none;">
                            <div class="row">
                                <div class="col-lg-2 col-md-6 col-12">
                                    <img src="<?= Yii::$app->homeUrl ?>image/qq.png" class="image-pp">
                                </div>
                                <div class="col-lg-4 col-md-6 col-12">
                                    <div class="col-12 forecast-price">
                                        <strong>Quantity</strong>
                                    </div>
                                    <div class="col-12 Product-Appeal">
                                        (Sale Force)
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="row">
                                        <div class="col-7 Sensitivity">
                                            Sensitivity ratio
                                        </div>
                                        <div class="col-5 Sensitivity">
                                            <strong> <?= number_format(23.0) ?>%</strong>
                                        </div>
                                        <div class="col-7 Sensitivity">
                                            Sensitivity Rank
                                        </div>
                                        <div class="col-5 Sensitivity">
                                            <strong> <?= number_format(2) ?></strong>
                                        </div>
                                        <div class="col-7 Sensitivity">
                                            Strategic Rank
                                        </div>
                                        <div class="col-5 Sensitivity">
                                            <strong> N/A</strong>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-3 forecast-solid">
                        <div class="card" style="border:none;">
                            <div class="row">
                                <div class="col-lg-2 col-md-6 col-12">
                                    <img src="<?= Yii::$app->homeUrl ?>image/ff.png" class="image-pp">
                                </div>
                                <div class="col-lg-4 col-md-6 col-12">
                                    <div class="col-12 forecast-price">
                                        <strong>Fixed Expense</strong>
                                    </div>
                                    <div class="col-12 Product-Appeal">
                                        (Power)
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="row">
                                        <div class="col-7 Sensitivity">
                                            Sensitivity ratio
                                        </div>
                                        <div class="col-5 Sensitivity">
                                            <strong> <?= number_format(23.0) ?>%</strong>
                                        </div>
                                        <div class="col-7 Sensitivity">
                                            Sensitivity Rank
                                        </div>
                                        <div class="col-5 Sensitivity">
                                            <strong> <?= number_format(2) ?></strong>
                                        </div>
                                        <div class="col-7 Sensitivity">
                                            Strategic Rank
                                        </div>
                                        <div class="col-5 Sensitivity">
                                            <strong> N/A</strong>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-3 forecast-solid-display">
                        <div class="card" style="border:none;">
                            <div class="row">
                                <div class="col-lg-2 col-md-6 col-12">
                                    <img src="<?= Yii::$app->homeUrl ?>image/vv.png" class="image-pp">
                                </div>
                                <div class="col-lg-4 col-md-6 col-12">
                                    <div class="col-12 forecast-price">
                                        <strong>Variable Expense</strong>
                                    </div>
                                    <div class="col-12 Product-Appeal">
                                        (Negotiation & Technical Ability)
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="row">
                                        <div class="col-7 Sensitivity">
                                            Sensitivity ratio
                                        </div>
                                        <div class="col-5 Sensitivity">
                                            <strong> <?= number_format(23.0) ?>%</strong>
                                        </div>
                                        <div class="col-7 Sensitivity">
                                            Sensitivity Rank
                                        </div>
                                        <div class="col-5 Sensitivity">
                                            <strong> <?= number_format(2) ?></strong>
                                        </div>
                                        <div class="col-7 Sensitivity">
                                            Strategic Rank
                                        </div>
                                        <div class="col-5 Sensitivity">
                                            <strong> N/A</strong>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="alert bg-backgroundforecastaccounts">
                <div class="row">
                    <div class="col-lg-7 col-md-6 col-12">
                        <div class="alert alert-backgroundforecastaccountss">
                            <div class="row"></div>
                            <div class="col-12">
                                =fhn
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>