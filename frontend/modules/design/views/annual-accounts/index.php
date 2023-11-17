<?php

$this->title = 'Annual Future Accounts';
?>

<div class="col-12 mt-90 alert background-Planning">
    <div class="col-12 planning">
        <i class="fa fa-database" aria-hidden="true"></i> Financial Analysis
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
                        Annual Future Accounts
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
            <div class="col-12 alert backgroundforecastaccounts">
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-3 forecast-solid">
                        <div class="card" style="border:none;">
                            <div class="row">
                                <div class="col-lg-2 col-md-6 col-12">
                                    <span class="badge square-red1">P</span>
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
                                    <span class="badge square-blue1">Q</span>
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
                                    <span class="badge square-grey">F</span>
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
                                    <span class="badge square-green1">V</span>
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
            <div class="col-12 alert backgroundforecastaccounts">
                <div class="row">
                    <div class="col-lg-9 col-md-6 col-12">
                        <div class="alert backgroundforecastaccounts1">
                            <div class="row">
                                <div class="col-3" style="margin-top:-6px;">
                                    <img src="<?= Yii::$app->homeUrl ?>image/calendar.png" style="width: 13px;"> <span class="frt-cur"> Select Financial Year</span>
                                </div>
                                <div class="col-4">
                                    <select class="form-select annual-monthly" aria-label="Default select example">
                                        <option selected value=""> F.Y [Ang 2023 - July 2024]</option>
                                        <option value="1"> F.Y [Jan 2020 - Feb 2021]</option>
                                        <option value="2"> F.Y [Jan 2021 - Dec 2022]</option>
                                        <option value="3"> F.Y [Jan 2022 - Oct 2023]</option>
                                        <option value="4"> F.Y [Jan 2023 - Jul 2024]</option>
                                        <option value="5"> F.Y [Jan 2024 - Nov 2025]</option>
                                    </select>
                                </div>
                                <div class="col-5 text-end" style="margin-top:-6px;">
                                    <a href="" class="no-underline-black small-Annual"> Current Month</a> &nbsp;
                                    <a href="" class="no-underline-black small-Annual"> Annual</a> &nbsp;
                                    <a href="" class="no-underline-black small-Annual"> Comparison</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="row">
                                <div class="col-lg-3 col-md-6 col-12">
                                    <div class="card Body-Sales">
                                        <div class="col-12 text-end">
                                            <span class="badge bg-white Sales-sp">Sales</span>
                                        </div>
                                        <div class="col-12 pt-100 text-center">
                                            <strong> <?= number_format(45877745) ?></strong>
                                        </div>
                                        <div class="col-12 text-center pt-10 font-size-13">
                                            <span class="badge square-red">P</span>
                                            <span class="badge square-blue">Q</span> Sales
                                        </div>
                                    </div>
                                    <div class="col-12 card c-blacksale">
                                        <div class="row">
                                            <div class="col-2">
                                                <span class="badge Gross-square">M</span>
                                            </div>
                                            <div class="col-5 font-size-12 pt-5">
                                                Gross Profit Ratio
                                            </div>
                                            <div class="col-2">
                                                <span class="badge yn"> <?= number_format(45) ?>%</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-9 col-md-6 col-12">
                                    <div class="card Body-ExPense">
                                        <div class="col-12 text-end">
                                            <span class="badge bg-white Sales-sp">Variable Expense</span>
                                        </div>
                                        <div class="col-12 text-center">
                                            <strong> <?= number_format(561454888) ?></strong>
                                        </div>
                                        <div class="col-12 text-center pt-5">
                                            <span class="badge square-green">V</span>
                                            <span class="badge square-blue">Q</span> Variable Expense
                                        </div>
                                        <div class="col-12 card c-ExPense">
                                            <div class="row">
                                                <div class="col-1">
                                                    <span class="badge square-green">V</span>
                                                </div>
                                                <div class="col-6 font-size-12 pt-5">
                                                    Variable Expense Ratio
                                                </div>
                                                <div class="col-2">
                                                    <span class="badge pv"> <?= number_format(45) ?>%</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4 col-md-6 col-12">
                                            <div class="card body-purple">
                                                <div class="col-12 text-end">
                                                    <span class="badge bg-white Sales-sp">Gross Profit</span>
                                                </div>
                                                <div class="col-12 text-center pt-60">
                                                    <strong> <?= number_format(4793595) ?></strong>
                                                </div>
                                                <div class="col-12 text-center font-size-13">
                                                    <span class="badge Gross-square">M</span>
                                                    <span class="badge square-blue">Q</span> Gross Profit
                                                </div>
                                                <div class="col-12 card c-f">
                                                    <div class="row">
                                                        <div class="col-1">
                                                            <span class="badge square-grey1">F</span>
                                                        </div>
                                                        <div class="col-3">
                                                            / <span class="badge Gross-square">M</span> *
                                                        </div>
                                                        <div class="col-1">
                                                            <span class="badge square-blue2">Q</span>
                                                        </div>
                                                        <div class="col-5 pt-5 font-size-12">
                                                            Break-Even Point Ratio
                                                        </div>
                                                        <div class="col-2">
                                                            <span class="badge cf"><?= number_format(121.1) ?>%</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-8 col-md-6 col-12">
                                            <div class="card body-lightgrey">
                                                <div class="col-12 text-end">
                                                    <span class="badge bg-white Sales-sp">Fixed Expense</span>
                                                </div>
                                                <div class="row mt-30">
                                                    <div class="col-5">
                                                        <div class="col-12 text-center">
                                                            <strong> <?= number_format(840000) ?></strong>
                                                        </div>
                                                        <div class="col-12 text-center font-size-13">
                                                            <span class="badge square-grey">F</span> Fixed Expense (Others)
                                                        </div>
                                                    </div>
                                                    <div class="col-7">
                                                        <div class="col-12 Fixedother-solid">
                                                            <div class="col-12">
                                                                <span class="badge bg-white text-dark" style="border-radius: 2px;"><i class=" fa fa-users" aria-hidden="true"></i> Human Resource <?= number_format(2343) ?> </span>
                                                            </div>
                                                            <div class="users-solid1 mt-5">
                                                                Labor Share <span><?= number_format(36.2) ?>%</span>
                                                            </div>
                                                            <div class="users-solid1">
                                                                Labor Share <span><?= number_format(2.76) ?>%</span>
                                                            </div>
                                                            <div class="col-12">
                                                                <span class="badge bg-white text-dark mt-10" style="border-radius: 2px;"><i class="fa fa-cube" aria-hidden="true"></i> Goods <?= number_format(5486) ?> </span>
                                                            </div>
                                                            <div class="col-12">
                                                                <span class="badge bg-white text-dark mt-10" style="border-radius: 2px;"><i class="fa fa-codepen" aria-hidden="true"></i> Interest <?= number_format(2678) ?> </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 card Body-greenborder">
                                                <div class="col-12 text-end">
                                                    <span class="badge bg-white Sales-sp">Operating Profit</span>
                                                </div>
                                                <div class="col-12 card c-blackgreen">
                                                    <div class="row">
                                                        <div class="col-1">
                                                            <span class="badge dark-green">G</span>
                                                        </div>
                                                        <div class="col-7 font-size-12 pt-5">
                                                            Ordinary Profit to Net Sales Ratio
                                                        </div>
                                                        <div class="col-2">
                                                            <span class="badge bg-white sh">-<?= number_format(45) ?>% </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 text-center">
                                                    <i class="fa fa-caret-up f-caret-up" aria-hidden="true"></i> <strong><?= number_format(1200000) ?></strong>
                                                </div>
                                                <div class="col-12 text-center pt-10 font-size-13">
                                                    <span class="badge dark-green">G</span> Operating Profit
                                                </div>
                                                <div class="col-12 Total-Creativity">
                                                    Total Creativity by all Employees
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-12 Future-solid">
                        <div class="alert backgroundforecastaccountss">
                            <div class="col-12 Business-color">
                                Future & Business Competitiveness Rank
                            </div>
                        </div>
                        <div class="col-12 card cardexcellent">
                            <div class="col-9 excellent">
                                Super excellent company, has a
                                great reserve of energy
                            </div>
                            <div class="row">
                                <div class="col-4 pt-20 Super-solid">
                                    <strong>Under-<?= number_format(60) ?>%</strong>
                                    <p> BEP Ratio</p>
                                </div>
                                <div class="col-4 pt-20 ss-solid">
                                    <strong> <?= number_format(52) ?> - <?= number_format(60) ?> &nbsp;times</strong>
                                    <p>Fixed Expense Productivity</p>
                                </div>
                                <div class="col-4 pt-20 text-center font-size-14">
                                    "SS"
                                </div>
                            </div>
                        </div>
                        <div class="col-12 card cardexcellent">
                            <div class="col-9 excellent">
                                Excellent company, has some reserve
                                of energy
                            </div>
                            <div class="row">
                                <div class="col-4 pt-20 Super-solid">
                                    <strong><?= number_format(60) ?>% - <?= number_format(60) ?>% </strong>
                                    <p> BEP Ratio</p>
                                </div>
                                <div class="col-4 pt-20 ss-solid">
                                    <strong> <?= number_format(52) ?> - <?= number_format(60) ?> &nbsp;times</strong>
                                    <p>Fixed Expense Productivity</p>
                                </div>
                                <div class="col-4 pt-20 text-center font-size-14">
                                    "S"
                                </div>
                            </div>
                        </div>
                        <div class="col-12 card cardexcellent">
                            <div class="col-9 excellent">
                                Sound management company,
                                has well competitiveness
                            </div>
                            <div class="row">
                                <div class="col-4 pt-20 Super-solid">
                                    <strong><?= number_format(81) ?>% - <?= number_format(90) ?>% </strong>
                                    <p> BEP Ratio</p>
                                </div>
                                <div class="col-4 pt-20 ss-solid">
                                    <strong> <?= number_format(52) ?> - <?= number_format(60) ?> &nbsp;times</strong>
                                    <p>Fixed Expense Productivity</p>
                                </div>
                                <div class="col-4 pt-20 text-center font-size-14">
                                    "A"
                                </div>
                            </div>
                        </div>
                        <div class="col-12 card cardexcellent">
                            <div class="col-9 excellent">
                                Breakeven point company, cannot be
                                careless at all
                            </div>
                            <div class="row">
                                <div class="col-4 pt-20 Super-solid">
                                    <strong><?= number_format(91) ?>% - <?= number_format(100) ?>% </strong>
                                    <p> BEP Ratio</p>
                                </div>
                                <div class="col-4 pt-20 ss-solid">
                                    <strong> <?= number_format(52) ?> - <?= number_format(60) ?> &nbsp;times</strong>
                                    <p>Fixed Expense Productivity</p>
                                </div>
                                <div class="col-4 pt-20 text-center font-size-14">
                                    "B"
                                </div>
                            </div>
                        </div>
                        <div class="col-12 card cardexcellent">
                            <div class="col-9 excellent">
                                Deficit-ridden company, unsure future
                            </div>
                            <div class="row">
                                <div class="col-4 pt-20 Super-solid">
                                    <strong><?= number_format(101) ?>% - <?= number_format(200) ?>% </strong>
                                    <p> BEP Ratio</p>
                                </div>
                                <div class="col-4 pt-20 ss-solid">
                                    <strong> <?= number_format(52) ?> - <?= number_format(60) ?> &nbsp;times</strong>
                                    <p>Fixed Expense Productivity</p>
                                </div>
                                <div class="col-4 pt-20 text-center font-size-14">
                                    "C"
                                </div>
                            </div>
                        </div>
                        <div class="col-12 card cardexcellent">
                            <div class="col-9 excellent">
                                Breakeven point company, cannot be
                                careless at all
                            </div>
                            <div class="row">
                                <div class="col-4 pt-20 Super-solid">
                                    <strong>Over <?= number_format(200) ?>%</strong>
                                    <p> BEP Ratio</p>
                                </div>
                                <div class="col-4 pt-20 ss-solid">
                                    <strong> <?= number_format(52) ?> - <?= number_format(60) ?> &nbsp;times</strong>
                                    <p>Fixed Expense Productivity</p>
                                </div>
                                <div class="col-4 pt-20 text-center font-size-14">
                                    "D"
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>































<!-- <div class="col-12 mt-90 alert background-Planning">
    <div class="col-12 planning">
        <i class="fa fa-database" aria-hidden="true"></i> Financial Analysis
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
                        Annual Future Accounts
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
                                    <span class="badge square-red1">P</span>
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
                                    <span class="badge square-blue1">Q</span>
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
                                    <span class="badge square-grey">F</span>
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
                                    <span class="badge square-green1">V</span>
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
                    <div class="col-lg-9 col-md-6 col-12">
                        <div class="alert alert-backgroundforecastaccountss">
                            <div class="row">
                                <div class="col-3">
                                    <img src="<?= Yii::$app->homeUrl ?>image/calendar.png" style="width: 13px;"> <span class="frt-cur"> Select Financial Year</span>
                                </div>
                                <div class="col-4">
                                    <select class="form-select annual-monthly" aria-label="Default select example">
                                        <option selected value=""> F.Y [Ang 2023 - July 2024]</option>
                                        <option value="1"> F.Y [Jan 2020 - Feb 2021]</option>
                                        <option value="2"> F.Y [Jan 2021 - Dec 2022]</option>
                                        <option value="3"> F.Y [Jan 2022 - Oct 2023]</option>
                                        <option value="4"> F.Y [Jan 2023 - Jul 2024]</option>
                                        <option value="5"> F.Y [Jan 2024 - Nov 2025]</option>
                                    </select>
                                </div>
                                <div class="col-2">
                                    <a href="" class="no-underline-black small-Annual"> Current&nbsp;Month</a>
                                </div>
                                <div class="col-1">
                                    <a href="" class="no-underline-black small-Annual"> Annual</a>
                                </div>
                                <div class="col-2">
                                    <a href="" class="no-underline-black small-Annual"> Comparison</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="row">
                                <div class="col-lg-3 col-md-6 col-12">
                                    <div class="card Body-Sales">
                                        <div class="col-12 text-end">
                                            <span class="badge bg-white Sales-sp">Sales</span>
                                        </div>
                                        <div class="col-12 pt-90 text-center">
                                            <strong> <?= number_format(45877745) ?></strong>
                                        </div>
                                        <div class="col-12 text-center pt-10 font-size-13">
                                            <span class="badge square-red">P</span>
                                            <span class="badge square-blue">Q</span> Sales
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-9 col-md-6 col-12">
                                    <div class="card Body-ExPense">
                                        <div class="col-12 text-end">
                                            <span class="badge bg-white Sales-sp">Variable Expense</span>
                                        </div>
                                        <div class="col-12 text-center">
                                            <strong> <?= number_format(561454888) ?></strong>
                                        </div>
                                        <div class="col-12 text-center pt-5">
                                            <span class="badge square-green">V</span>
                                            <span class="badge square-blue">Q</span> Variable Expense
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4 col-md-6 col-12">
                                            <div class="card body-purple">
                                                <div class="col-12 text-end">
                                                    <span class="badge bg-white Sales-sp">Gross Profit</span>
                                                </div>
                                                <div class="col-12 text-center pt-60">
                                                    <strong> <?= number_format(4793595) ?></strong>
                                                </div>
                                                <div class="col-12 text-center font-size-13">
                                                    <span class="badge Gross-square">M</span>
                                                    <span class="badge square-blue">Q</span> Gross Profit
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-8 col-md-6 col-12">
                                            <div class="card body-lightgrey">
                                                <div class="col-12 text-end">
                                                    <span class="badge bg-white Sales-sp">Fixed Expense</span>
                                                </div>
                                                <div class="row mt-30">
                                                    <div class="col-5">
                                                        <div class="col-12 text-center">
                                                            <strong> <?= number_format(840000) ?></strong>
                                                        </div>
                                                        <div class="col-12 text-center font-size-13">
                                                            <span class="badge square-grey">F</span> Fixed Expense (Others)
                                                        </div>
                                                    </div>
                                                    <div class="col-7">
                                                        <div class="col-12 Fixedother-solid">
                                                            <span class="badge bg-white text-dark" style="border-radius: 2px;"><i class=" fa fa-users" aria-hidden="true"></i> Human Resource <?= number_format(2343) ?> </span>
                                                            <div class="users-solid1 mt-5">
                                                                Labor Share <span><?= number_format(36.2) ?>%</span>
                                                            </div>
                                                            <div class="users-solid1">
                                                                Labor Share <span><?= number_format(2.76) ?>%</span>
                                                            </div>
                                                            <span class="badge bg-white text-dark mt-10" style="border-radius: 2px;"><i class="fa fa-cube" aria-hidden="true"></i> Goods <?= number_format(5486) ?> </span>
                                                            <span class="badge bg-white text-dark mt-10" style="border-radius: 2px;"><i class="fa fa-codepen" aria-hidden="true"></i> Interest <?= number_format(2678) ?> </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 card Body-greenborder">
                                                <div class="col-12 text-end">
                                                    <span class="badge bg-white Sales-sp">Operating Profit</span>
                                                </div>
                                                <div class="col-12 text-center">
                                                    <i class="fa fa-caret-up f-caret-up" aria-hidden="true"></i> <strong><?= number_format(576) ?></strong>
                                                </div>
                                                <div class="col-12 text-center pt-10 font-size-13">
                                                    <span class="badge dark-green">G</span> Operating Profit
                                                </div>
                                                <div class="col-12 Total-Creativity">
                                                    Total Creativity by all Employees
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-12 Future-solid">
                        <div class="alert alert-backgroundforecastaccountss">
                            <div class="col-12 Business-color">
                                Future & Business Competitiveness Rank
                            </div>
                        </div>
                        <div class="col-12 card cardexcellent">
                            <div class="col-7 excellent">
                                Super excellent company, has a
                                great reserve of energy
                            </div>
                            <div class="row">
                                <div class="col-4 pt-20 Super-solid">
                                    <strong><span>Under-</span><?= number_format(60) ?>%</strong>
                                    <p> BEP Ratio</p>
                                </div>
                                <div class="col-4 pt-20 ss-solid">
                                    <strong> <?= number_format(52) ?>&nbsp;times</strong>
                                    <p>Fixed Expense Productivity</p>
                                </div>
                                <div class="col-4 pt-20 text-center font-size-20">
                                    "SS"
                                </div>
                            </div>
                        </div>
                        <div class="col-12 card cardexcellent">
                            <div class="col-7 excellent">
                                Excellent company, has some reserve
                                of energy
                            </div>
                            <div class="row">
                                <div class="col-4 pt-20 Super-solid">
                                    <strong><span>Under-</span><?= number_format(60) ?>%</strong>
                                    <p> BEP Ratio</p>
                                </div>
                                <div class="col-4 pt-20 ss-solid">
                                    <strong> <?= number_format(164) ?>&nbsp;times</strong>
                                    <p>Fixed Expense Productivity</p>
                                </div>
                                <div class="col-4 pt-20 text-center font-size-20">
                                    "S"
                                </div>
                            </div>
                        </div>
                        <div class="col-12 card cardexcellent">
                            <div class="col-7 excellent">
                                Sound management company,
                                has well competitiveness
                            </div>
                            <div class="row">
                                <div class="col-4 pt-20 Super-solid">
                                    <strong><span>Under-</span><?= number_format(60) ?>%</strong>
                                    <p> BEP Ratio</p>
                                </div>
                                <div class="col-4 pt-20 ss-solid">
                                    <strong> <?= number_format(350) ?>&nbsp;times</strong>
                                    <p>Fixed Expense Productivity</p>
                                </div>
                                <div class="col-4 pt-20 text-center font-size-20">
                                    "A"
                                </div>
                            </div>
                        </div>
                        <div class="col-12 card cardexcellent">
                            <div class="col-7 excellent">
                                Breakeven point company, cannot be
                                careless at all
                            </div>
                            <div class="row">
                                <div class="col-4 pt-20 Super-solid">
                                    <strong><span>Under-</span><?= number_format(60) ?>%</strong>
                                    <p> BEP Ratio</p>
                                </div>
                                <div class="col-4 pt-20 ss-solid">
                                    <strong> <?= number_format(350) ?>&nbsp;times</strong>
                                    <p>Fixed Expense Productivity</p>
                                </div>
                                <div class="col-4 pt-20 text-center font-size-20">
                                    "B"
                                </div>
                            </div>
                        </div>
                        <div class="col-12 card cardexcellent">
                            <div class="col-7 excellent">
                                Deficit-ridden company, unsure future
                            </div>
                            <div class="row">
                                <div class="col-4 pt-20 Super-solid">
                                    <strong><span>Under-</span><?= number_format(60) ?>%</strong>
                                    <p> BEP Ratio</p>
                                </div>
                                <div class="col-4 pt-20 ss-solid">
                                    <strong> <?= number_format(133) ?>&nbsp;times</strong>
                                    <p>Fixed Expense Productivity</p>
                                </div>
                                <div class="col-4 pt-20 text-center font-size-20">
                                    "C"
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> -->