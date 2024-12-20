<?php
$this->title = 'Actual Last Year';
?>


<div class="col-12 mt-90 alert background-Planning">
    <div class="col-12 planning">
        <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/FinanicalPlanning.png" class="images_Dark_FinanicalPlanning"> Financial Planning
    </div>
    <div class="col-12 mt-20">
        <div class="shadow p-3 mb-5 bg-body rounded alert2-secondary3">
            <ul class="nav nav-pills" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link text-dark" id="pills-Forcast-tab" data-bs-toggle="pill" data-bs-target="#pills-Forcast" type="button" role="tab" aria-controls="pills-Forcast" aria-selected="true"> <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/PL-Forecast.png" class="images_performance_PL"> PL Forcast</a>
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
                <div class="col-lg-9 col-md-6 col-12">
                    <div class="radio_Golden19"> Golden Ratio</div>
                </div>
                <div class="col-lg-3 col-md-6 col-12 text-end">
                    <select class="form-select example-tok2" aria-label="Default select example">
                        <option selected value="">Select</option>
                        <option value="1">Tokyo Consulting firm</option>
                        <option value="2">Tokyo Consulting Group</option>
                        <option value="3">Tokyo Consulting Group</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-6 col-12 mt-30">
                    <div class="badge bg-primary-sec3">
                        <div class="row">
                            <div class="col-4 text-secondary">
                                <img src="<?= Yii::$app->homeUrl ?>image/calendar.png" class="image-current-year">
                                <span class="Roundup_fontsmall"> Current Year </span>
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
                                <div class="text-secondary">
                                    <div class="FY" data-bs-toggle="modal" data-bs-target="#ModalFY"> F.Y. 2023</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-md-6 col-12 mt-30">
                    <div class="badge bg-primary-sec4">
                        <div class="row">
                            <div class="col-1 font-size-12 text-secondary pt-5">
                                <img src="<?= Yii::$app->homeUrl ?>image/dollar.png" class="imagedollar"> <span class="Roundup_fontsmall">Currency</span>
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
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Round-Up.png" class="Round_radio"><span class="Roundup_fontsmall">Round Up</span>
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
                                <a href="" class="no-underline-black link-Ideal" data-bs-toggle="modal" data-bs-target="#ModalIdealInput"> Ideal Golden Ratio</a>
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
                </div>
                <div class="col-12">
                    <div class="row mt-20">
                        <div class="col-lg-3 col-md-6 col-12 card al-pad" style="height: 553px;">
                            <div class="col-12 text-end">
                                <span class="badge bg-lig1 text-dark"> Sales</span>
                            </div>
                            <div class="col-12 text-center pt-100">
                                <strong> <?= number_format(4793595) ?></strong>
                            </div>
                            <div class="col-12 text-center">
                                Sales
                            </div>
                            <div class="col-12 allshadow-sales">
                                <div class="shadow-sm p-2 al-pad-copy rounded"> Gross Profit Ratio <span class="badge bg-lig1-sale text-dark"> <?= number_format(76.7) ?>%</span></div>
                            </div>
                        </div>
                        <div class="col-lg-9 col-md-6 col-12">
                            <div class="card alert-alinfo">
                                <div class="col-12 text-end">
                                    <span class="badge bg-lig1 text-dark"> Variable Expense</span>
                                </div>
                                <div class="col-12 text-center">
                                    <strong><?= number_format(4793595) ?></strong>
                                </div>
                                <div class="col-12 text-center">
                                    Variable Expense
                                </div>
                                <div class="col-5 allshadow-variableExpense">
                                    <div class="shadow-sm p-2 alert-alinfo-copy rounded"> Variable Expense Ratio <span class="badge bg-lig1-copy text-dark"> <?= number_format(45) ?>%</span></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-md-6 col-12">
                                    <div class="card alert-alpri1">
                                        <div class="col-12 text-end">
                                            <span class="badge bg-lig1 text-dark"> Gross Profit</span>
                                        </div>
                                        <div class="col-12 text-center pt-100">
                                            <strong> <?= number_format(4793595) ?></strong>
                                        </div>
                                        <div class="col-12 text-center">
                                            Gross Profit
                                        </div>
                                        <div class="col-12 allshadow-GrossProfit">
                                            <div class="shadow-sm p-2 alert-alpri1-copy rounded"> Gross Profit Ratio <span class="badge bg-lig1-Gross text-dark"> <?= number_format(53) ?>%</span></div>
                                        </div>
                                        <div class="col-12 pt-100"></div>
                                    </div>
                                </div>
                                <div class="col-lg-8 col-md-6 col-12 ">
                                    <div class="card alert-alpri2">
                                        <div class="col-12 text-end">
                                            <span class="badge bg-lig1 text-dark"> Labor Cost</span>
                                        </div>
                                        <div class="col-12 text-center">
                                            <strong> <?= number_format(8385679) ?></strong>
                                        </div>
                                        <div class="col-12 text-center">
                                            Labor Cost
                                        </div>
                                        <div class="col-7 allshadow-LaborCost">
                                            <div class="shadow-sm p-2 alert-alpri2-copy rounded">Labor Cost Ratio <span class="badge bg-lig1-LaborCost text-dark"> <?= number_format(40.7) ?>%</span></div>
                                        </div>
                                        <div class="col-7 allshadow-LaborCost1">
                                            <div class="shadow-sm p-2 alert-alpri2-copy rounded">Labor Ratio <span class="badge bg-lig1-LaborCost text-dark"> <?= number_format(76.7) ?>%</span></div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="card alert-alpri3">
                                                <div class="col-12 text-end">
                                                    <span class="badge bg-lig1 text-dark"> Fixed Expense (Others)</span>
                                                </div>
                                                <div class="col-12 text-center">
                                                    <strong> <?= number_format(755190) ?></strong>
                                                </div>
                                                <div class="col-12 text-center">
                                                    Fixed Expense (Others)
                                                </div>
                                                <div class="col-7 allshadow-FixedExpense">
                                                    <div class="shadow-sm p-2 alert-alpri3-copy rounded">Fixed Expense (Others) Radio<span class="badge bg-lig1-FixedExpense text-dark"> <?= number_format(76.7) ?>%</span></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="card alert-alpri4">
                                                <div class="col-12 text-end">
                                                    <span class="badge bg-lig1 text-dark"> Operating Profit</span>
                                                </div>
                                                <div class="col-12 text-center text-danger">
                                                    <strong> <?= number_format(-118417) ?></strong>
                                                </div>
                                                <div class="col-12 text-center">
                                                    Operating Profit
                                                </div>
                                                <div class="col-8 allshadow-Operating-Profit">
                                                    <div class="shadow-sm p-2  alert-alpri4-copy rounded"> Operating Profit Ratio <span class="badge bg-lig1-Operating text-dark"> <?= number_format(-0.6) ?>%</span></div>
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
                                Actual Last Year
                            </div>
                        </div>
                        <div class="col-lg-9 col-md-6 col-12 ">
                            <div class="card alert-alpri6">
                                <div class="row">
                                    <div class="col-1">
                                        Total
                                    </div>
                                    <div class="col-2 Ideal-solid">
                                        <span class="badge p-1 bg-white text-dark"><?= number_format(100) ?>%</span>
                                    </div>
                                    <div class="col-8 text-end">
                                        <span class="badge bg-white text-dark">
                                            <i class="fa fa-line-chart" aria-hidden="true"></i>&nbsp; Sales Growth Ratio
                                        </span>
                                    </div>
                                    <div class="col-1">
                                        <span class="badge p-1 alpri4 text-danger"><?= number_format(-23) ?>%</span>
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


<!-- Modal F.Y -->
<div class="modal fade" id="ModalFY" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="margin-top: 370px;margin-left:80px;">
            <div class="modal-header">
                <div class="modal-title F_Y_Input pr-20 pl-20" id="ModalFY"><i class="fa fa-magic" aria-hidden="true"></i>&nbsp;&nbsp; FY Input</div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row mt-20 pr-20 pl-20">
                    <div class="col-sm-6">
                        <label for="exampleInputname" class="form-label Expense_Ratio">Variable Expense Ratio</label>
                        <input type="number" class="form-control Expense_input" id="exampleInputNumberPersen" aria-describedby="" placeholder=".................................%">
                    </div>
                    <div class="col-sm-6">
                        <label for="exampleInputname" class="form-label Expense_Ratio">Labor Cost Ratio</label>
                        <input type="number" class="form-control Expense_input" id="exampleInputNumberPersen" aria-describedby="" placeholder=".................................%">
                    </div>
                    <div class="col-sm-6 mt-20">
                        <label for="exampleInputname" class="form-label Expense_Ratio">Fixed Expense (Other) Ratio</label>
                        <input type="number" class="form-control Expense_input" id="exampleInputNumberPersen" aria-describedby="" placeholder=".................................%">
                    </div>
                    <div class="col-sm-6 mt-20">
                        <label for="exampleInputname" class="form-label Expense_Ratio">Operating Profit Ratio</label>
                        <input type="number" class="form-control Expense_input" id="exampleInputNumberPersen" aria-describedby="" placeholder=".................................%">
                    </div>
                </div>
            </div>
            <div class="modal-footer pr-30" style="border:none;" data-bs-dismiss="modal">
                <div type="button" class="badge bgCancelbodyfooter">Cancel</div>
                <div type="button" class="badge bgCreatefooter">Create</div>
            </div>
        </div>
    </div>
</div>
<!-- end -->

<!-- Modal Ideal Input -->
<div class="modal fade" id="ModalIdealInput" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="margin-top: 370px;margin-left:80px;">
            <div class="modal-header">
                <div class="modal-title F_Y_Input pr-20 pl-20" id="ModalIdealInput"><i class="fa fa-magic" aria-hidden="true"></i>&nbsp;&nbsp; Ideal Input</div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row mt-20 pr-20 pl-20">
                    <div class="col-sm-6">
                        <label for="exampleInputname" class="form-label Expense_Ratio">Sales</label>
                        <input type="number" class="form-control Expense_input" id="exampleInputNumberPersen" aria-describedby="" placeholder=".................................%">
                    </div>
                    <div class="col-sm-6">
                        <label for="exampleInputname" class="form-label Expense_Ratio">Fixed Expense (Other) Ratio</label>
                        <input type="number" class="form-control Expense_input" id="exampleInputNumberPersen" aria-describedby="" placeholder=".................................%">
                    </div>
                    <div class="col-sm-6">
                        <label for="exampleInputname" class="form-label Expense_Ratio">Variable Expense Ratio</label>
                        <input type="number" class="form-control Expense_input" id="exampleInputNumberPersen" aria-describedby="" placeholder=".................................%">
                    </div>
                    <div class="col-sm-6">
                        <label for="exampleInputname" class="form-label Expense_Ratio">Operating Profit Ratio</label>
                        <input type="number" class="form-control Expense_input" id="exampleInputNumberPersen" aria-describedby="" placeholder=".................................%">
                    </div>
                    <div class="col-sm-6">
                        <label for="exampleInputname" class="form-label Expense_Ratio">Labor Cost</label>
                        <input type="number" class="form-control Expense_input" id="exampleInputNumberPersen" aria-describedby="" placeholder=".................................%">
                    </div>
                </div>
            </div>
            <div class="modal-footer pr-30" style="border:none;" data-bs-dismiss="modal">
                <div type="button" class="badge bgCancelbodyfooter">Cancel</div>
                <div type="button" class="badge bgCreatefooter">Create</div>
            </div>
        </div>
    </div>
</div>
<!-- end -->