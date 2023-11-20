<?php
$this->title = 'module';
?>

<div class="col-12 mt-90">
    <div class="alert al-sky">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-12">
                <div class="col-12 companyweight">
                    Company Performance Breakdown
                </div>
            </div>
            <div class="col-lg-2 col-md-6 col-12">
                <div class="col-12">
                    <button class="btn btn-primary but-fontCreate" type="button"> <i class="fa fa-magic" aria-hidden="true"></i> Create</button>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-12">
                <select class="form-select example-tok2" aria-label="Default select example">
                    <option selected value="">Tokyo Consulting Firm Limited</option>
                    <option value="1">Tokyo Consulting Firm co.,th</option>
                    <option value="2">Tokyo Consulting Firm</option>
                </select>
            </div>
            <div class="col-lg-2 col-md-6 col-12">
                <select class="form-select example-tok2" aria-label="Default select example">
                    <option selected value="">Evaluation Term</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                </select>
            </div>
            <div class="col-lg-1 col-12 text-end">
                <i class="fa fa-filter" aria-hidden="true"></i> <i class="fa fa-plus content-Fitter" aria-hidden="true" data-bs-toggle="modal" data-bs-target="#Modalfitter"></i>
            </div>
            <div class="col-lg-1 col-12">
                <span class="Fitter-PL"> More </span> <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
            </div>
        </div>
        <div class="alert alert-light mt-15">
            <div class="col-12 bbg-blue">
                <div class="row">
                    <div class="col-lg-1 col-md-6 col-12">
                        <img src="<?= Yii::$app->homeUrl ?>image/Maskgroup.png" class="mark1">
                    </div>
                    <div class="col-lg-3 col-md-6 col-12 Pvt pt-8">
                        <strong> Tokyo Consulting Firm Pvt. Ltd</strong>
                        <p class="font-size-12"><img src="<?= Yii::$app->homeUrl ?>image/Thailand.png" class="imagePvt"> Bangkok , Thailand</p>
                    </div>
                </div>
                <div class="row mt-10">
                    <div class="col-lg-3 col-md-6 col-12">
                        <div class="col-12 card bg-switch">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
                                <label class="form-check-label text-Chole" for="flexSwitchCheckChecked"> Chole</label>
                            </div>
                            <div class="col-12 database-financial">
                                <i class="fa fa-database" aria-hidden="true"></i> Financial Planning
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-12">
                        <div class="col-12 card bg-switch">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
                                <label class="form-check-label text-Chole" for="flexSwitchCheckChecked"> Included</label>
                            </div>
                            <div class="col-12 database-financial">
                                <i class="fa fa-tachometer" aria-hidden="true"></i> Permeance Matrices
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-12">
                        <div class="col-12 card bg-switch">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
                                <label class="form-check-label text-Chole" for="flexSwitchCheckChecked"> Included</label>
                            </div>
                            <div class="col-12 database-financial">
                                <div class="row">
                                    <div class="col-6">
                                        <img src="<?= Yii::$app->homeUrl ?>image/uer-text.png" class="uer"> Evaluation
                                    </div>
                                    <div class="col-6">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                            <label class="form-check-label" for="flexCheckDefault">
                                                Bonus
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-12">
                        <div class="col-12 card bg-switchgray">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckCheckedgray" checked>
                                <label class="form-check-label text-Excludedgray" for="flexSwitchCheckChecked"> Excluded</label>
                            </div>
                            <div class="col-12 database-financial">
                                <div class="col-12">
                                    <i class="fa fa-tasks" aria-hidden="true"></i> Behavioral Indicator (KBI)
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>

                <div class="col-12">
                    <div class="card">
                        <div class="card-header headergrayPIM">
                            <div class="row">
                                <div class="col-lg-4 text-start">
                                    <i class="fa fa-clock-o" aria-hidden="true"></i> Performance Indicator Matrices (PIM)
                                </div>
                                <div class="col-lg-8 text-end SetConfiguration">
                                    <span class="solid-cog"></span> &nbsp; <button class="btn btn-primary" type="button"><i class="fa fa-cog" aria-hidden="true"></i> Set Configuration </button>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-md-6 col-12">
                                <div class="solid-Matrices">
                                    <div class="col-12">
                                        <div class="overflow-hidden" style="width:100%; height:200px;">
                                            <canvas class="" id="chartDoughnut"></canvas>
                                        </div>
                                        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                                    </div>
                                    <div class="col-12 alert alert-light text-dark mt-20" style="border:none;">
                                        <i class="fa fa-line-chart text-primary" aria-hidden="true"></i> &nbsp; key Financial Indicator <span class="pl-30">19</span>
                                    </div>
                                    <div class="col-12 alert alert-light text-dark mt-20" style="border:none;">
                                        <i class="fa fa-flag-o text-warning" aria-hidden="true"></i> &nbsp; key Goal Indicator <span class="pl-50">17</span>
                                    </div>
                                    <div class="col-12 alert alert-light text-dark mt-20" style="border:none;">
                                        <i class="fa fa-clock-o text-danger" aria-hidden="true"></i> &nbsp; key Performance Indicator <span class="pl-20">41</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-9 col-md-6 col-12">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="card bg-title">
                                            <div class="card bg-white" style="border: none;">
                                                <div class="row">
                                                    <div class="col-9 Indicator">
                                                        <i class="fa fa-line-chart" aria-hidden="true"></i> key Financial Indicator
                                                    </div>
                                                    <div class="col-3">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" value="" id="checkboxcorrect">
                                                            <label class="form-check-label" for="flexCheckDefault"></label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 mt-20">
                                                <div class="card alert-primary cardcolpurple">
                                                    <div class="col-12 text-end">
                                                        <i class="fa fa-angle-left" aria-hidden="true"></i> <i class="fa fa-angle-right" aria-hidden="true"></i>
                                                    </div>
                                                    <div class="row mt-10 font-size-12">
                                                        <div class="col-2">
                                                            <span class="badge bg-PL text-white">PL</span>
                                                        </div>
                                                        <div class="col-10">Total Sales</div>
                                                    </div>
                                                    <div class="row mt-10">
                                                        <div class="col-3 colTarget">
                                                            <div class="col-12 text-secondary">
                                                                <i class="fa fa-bullseye" aria-hidden="true"></i> Target
                                                            </div>
                                                            <div class="col-12 pl-5">
                                                                <strong> <?= number_format(150) ?> M</strong>
                                                            </div>
                                                        </div>
                                                        <div class="col-1 colless">
                                                            <strong>
                                                                < </strong>
                                                        </div>
                                                        <div class="col-4 colResult">
                                                            <div class="col-12 text-secondary">
                                                                <i class="fa fa-trophy" aria-hidden="true"></i> Result
                                                            </div>
                                                            <div class="col-12 pl-5">
                                                                <strong> <?= number_format(261) ?> K</strong>
                                                            </div>
                                                        </div>
                                                        <div class="col-3">
                                                            <div class="col-12">
                                                                <div id="progress1">
                                                                    <div data-num="25" class="progress-item1" data-value="25%" style="background: conic-gradient(rgb(41, 140, 233) calc(35%), rgb(219, 239, 247) 0deg);">35%</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 colexternalKFI">
                                                    KFI Deshboard <i class="fa fa-external-link" aria-hidden="true"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="card bg-key">
                                            <div class="card bg-white" style="border: none;">
                                                <div class="row">
                                                    <div class="col-9 Indicator">
                                                        <i class="fa fa-flag-o" aria-hidden="true"></i> key Goal Indicator
                                                    </div>
                                                    <div class="col-3">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" value="" id="checkboxcorrect">
                                                            <label class="form-check-label" for="flexCheckDefault"></label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 mt-20">
                                                <div class="card alert-primary cardcolorange">
                                                    <div class="col-12 mt-10 font-size-12">
                                                        Increase
                                                        Company Demand
                                                    </div>
                                                    <div class="row mt-10">
                                                        <div class="col-3 colTarget">
                                                            <div class="col-12 text-secondary">
                                                                <i class="fa fa-bullseye" aria-hidden="true"></i> Target
                                                            </div>
                                                            <div class="col-12 pl-5">
                                                                <strong> <?= number_format(150) ?> M</strong>
                                                            </div>
                                                        </div>
                                                        <div class="col-1 colless">
                                                            <strong>
                                                                < </strong>
                                                        </div>
                                                        <div class="col-4 colResult">
                                                            <div class="col-12 text-secondary">
                                                                <i class="fa fa-trophy" aria-hidden="true"></i> Result
                                                            </div>
                                                            <div class="col-12 pl-5">
                                                                <strong> <?= number_format(261) ?> K</strong>
                                                            </div>
                                                        </div>
                                                        <div class="col-3">
                                                            <div class="col-12">
                                                                <div id="progress1">
                                                                    <div data-num="25" class="progress-item1" data-value="25%" style="background: conic-gradient(rgb(41, 140, 233) calc(35%), rgb(219, 239, 247) 0deg);">35%</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 colexternalKGI">
                                                    KGI Deshboard <i class="fa fa-external-link" aria-hidden="true"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="card bg-cardkeyPerformance">
                                            <div class="card bg-white" style="border: none;">
                                                <div class="row">
                                                    <div class="col-9 Indicator">
                                                        <i class="fa fa-clock-o" aria-hidden="true"></i> Key Performance Indicator
                                                        <div class="text-danger"> <i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Not Set</div>
                                                    </div>
                                                    <div class="col-3">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" value="" id="checkboxcorrect">
                                                            <label class="form-check-label" for="flexCheckDefault"></label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 mt-20">
                                                <div class="card alert-primary cardcolred">
                                                    <div class="col-12 mt-10 font-size-12">
                                                        <div class="text-dark"> No Data</div>
                                                    </div>
                                                </div>
                                                <div class="col-12 colexternalKPI">
                                                    KGI Deshboard <i class="fa fa-external-link" aria-hidden="true"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="card-header headergrayPIM">
                            <div class="row">
                                <div class="col-lg-4 text-start">
                                    <img src="<?= Yii::$app->homeUrl ?>image/uer-text.png" class="uer"> Evaluation
                                </div>
                                <div class="col-lg-8 text-end SetConfiguration">
                                    <span class="solid-cog"></span> &nbsp; <button class="btn btn-primary" type="button"><i class="fa fa-cog" aria-hidden="true"></i> Set Configuration </button>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-1 col-md-6 col-12">
                                <div class="dashcricleEvalue"><i class="fa fa-user pl-6" aria-hidden="true"></i></div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12 mt-8">
                                <span class="badge rounded-pill bg-gray">
                                    <ul class="try-cricle">
                                        <li class="tri-li"> <img src="/HRVC/frontend/web/image/avatar1.png" class="image-avatar1"></li>
                                        <li class="tri-li"> <img src="/HRVC/frontend/web/image/Watanabe.png" class="image-avatar2"></li>
                                        <li class="tri-li"> <img src="/HRVC/frontend/web/image/avatar3.png" class="image-avatar3"></li>
                                        <a href="" class="none">
                                            <li class="tri-li-number1"> 9 </li>
                                        </a>
                                    </ul>
                                </span>
                            </div>
                            <div class="col-12 mt-20 pl-30">
                                Employee Phase | 3rd Evaluation
                            </div>
                            <div class="col-12">
                                Evaluation Timeline | 21 Feb 22 - 21 Feb 23
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-2">
                                <div class="card gbg1">
                                    <div class="row">
                                        <div class="col-3">
                                            <img src="<?= Yii::$app->homeUrl ?>image/per.png" class="perr">
                                        </div>
                                        <div class="col-6">
                                            <div class="col-12">
                                                <div class="Ev">Ev Frame</div>
                                            </div>
                                            <div class="col-12 Ew">
                                                <i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Set
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="card gbg2">
                                    <div class="row">
                                        <div class="col-3">
                                            <img src="<?= Yii::$app->homeUrl ?>image/PMI.png" class="perr">
                                        </div>
                                        <div class="col-9">
                                            <div class="col-12">
                                                <div class="PMI"> PMI Weight Allocation</div>
                                            </div>
                                            <div class="col-12 Ews">
                                                <i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Set
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="card gbg3">
                                    <div class="row">
                                        <div class="col-3">
                                            <img src="<?= Yii::$app->homeUrl ?>image/guk.png" class="perr">
                                        </div>
                                        <div class="col-9">
                                            <div class="col-12">
                                                <div class="Ev"> Rank & Increasement</div>
                                            </div>
                                            <div class="col-12 Ew">
                                                <i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Set
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="card gbg4">
                                    <div class="row">
                                        <div class="col-3">
                                            <img src="<?= Yii::$app->homeUrl ?>image/salary.png" class="perr">
                                        </div>
                                        <div class="col-9">
                                            <div class="col-12">
                                                <div class="PMI"> Salary & Allowance Range</div>
                                            </div>
                                            <div class="col-12 Ews">
                                                <i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Set
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
    </div>
</div>







<!-- <div class="col-lg-5 col-md-6 col-12">
    <div class="col-12 card card-InActive">
        <div class="row">
            <div class="col-2">
                <div class="col-12">
                    <div class="ac-p">PIM</div>
                </div>
                <div class="col-12">
                    <div class="Activegreen">Active</div>
                </div>
            </div>
            <div class="col-2">
                <div class="col-12">
                    <div class="ac-p">PL</div>
                </div>
                <div class="col-12">
                    <div class="InActivered">InActive</div>
                </div>
            </div>
            <div class="col-2">
                <div class="col-12">
                    <div class="ac-p">Evaluation</div>
                </div>
                <div class="col-12">
                    <div class="Activegreen">Active</div>
                </div>
            </div>
            <div class="col-2">
                <div class="col-12">
                    <div class="ac-p">Bonus</div>
                </div>
                <div class="col-12">
                    <div class="InActivered">Active</div>
                </div>
            </div>
            <div class="col-2">
                <div class="col-12">
                    <div class="ac-p">KBI</div>
                </div>
                <div class="col-12">
                    <div class="Activegreen">InActive</div>
                </div>
            </div>
            <div class="col-2">
                <div class="col-12">
                    <div class="ac-p">KAI</div>
                </div>
                <div class="col-12">
                    <div class="InActivered">Active</div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-lg-2 col-md-6 col-12">
    <div class="col-12 card card-InActive">
        <div class="col-12 Phase">
            Evaluation Phase
        </div>
        <div class="col-12">
            <select class="form-select" aria-label="Default select example" style="border:none;">
                <option selected value=""></option>
                <option value="1">E1</option>
                <option value="2">E2</option>
                <option value="3">E3</option>
            </select>
        </div>
    </div>
</div>
<div class="col-lg-1 col-md-6 col-12">
    <div class="col-12">
        <i class="fa fa-user-plus" aria-hidden="true"></i> &nbsp; <i class="fa fa-trash-o" aria-hidden="true"></i>
    </div>
    <div class="col-12">
        <select class="form-select" aria-label="Default select example" style="border:none;">
            <option selected value=""></option>
            <option value="1"></option>
            <option value="2"></option>
        </select>
    </div>
</div> -->