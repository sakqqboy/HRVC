<?php

use Faker\Core\Number;

$this->title = 'Bonus Management';

?>

<div class="col-12 mt-70 environment pt-10 pr-10 pl-20">
    <div class="row">
        <div class="col-lg-2 col-md-6 col-12 pr-0 pl-5">
            <div class="border-bottom pb-20">
                <div class="row">
                    <div class="col-5 text-center pr-5 pl-5">
                        <img src="<?= Yii::$app->homeUrl ?>image/BD.jpg" class="imagealertEvaluator">
                    </div>
                    <div class="col-7 font-size-14 font-b pr-5 pl-10 pt-0">
                        Tokyo Consulting Firm Pvt. Ltd
                    </div>
                </div>
            </div>
            <div class="col-12 Evaluator-country font-size-12 mt-10">
                &nbsp;&nbsp; <img src="<?= Yii::$app->homeUrl ?>image/Thailand.png" class="imageEvaluatorcountry"> Bangkok, Thailand
            </div>
            <div class="col-12 mt-20">
                <div class="mb-5 bg-body rounded-1 text-center font-size-12 pt-5 pr-5 pl-5 pb-5 font-weight-500 text-black-50">
                    Mid Term Evaluation Phase
                    <div class="E3 mt-5"> E3 </div>
                </div>
            </div>

            <div class="col-12 bg-white rounded-1 mt-40 pb-10">
                <div class="col-12 EvaluatorConfiguration pt-20 pl-10 border-bottom pb-20">
                    <i class="fa fa-cog mr-5" aria-hidden="true"></i>Set Configuration
                </div>
                <div class="col-12 mt-20">
                    <div class="rad-label pl-0 mt-10 pr-0">
                        <div class="col-12 pl-5 rad-text pr-3">
                            <i class="fa fa-check-circle-o text-success mr-10 font-size-18" aria-hidden="true"></i>
                            <span class="text-dark font-weight-500 ">Evaluation Frame</span>
                        </div>
                    </div>
                    <div class="Evaluationdeshed"></div>
                    <div class="rad-label pl-0 pr-0 pt-0">
                        <div class="col-12 pl-5 rad-text pr-3">
                            <i class="fa fa-circle mr-10 font-size-18 text-secondary" aria-hidden="true"></i>
                            <span class="text-dark font-weight-500">Weight Allocation</span>
                        </div>
                    </div>
                    <div class="Evaluationdeshed"></div>
                    <div class="rad-label pl-0 pr-0">
                        <div class="col-12 pl-5 rad-text pr-3">
                            <i class="fa fa-circle mr-10 font-size-18 text-secondary" aria-hidden="true"></i>
                            <span class="text-dark font-weight-500">Evaluator Settings</span>
                        </div>
                    </div>
                    <div class="Evaluationdeshed"></div>
                    <div class="rad-label pl-0 pr-0">
                        <div class="col-12 pl-5 rad-text pr-3">
                            <i class="fa fa-circle mr-10 font-size-18 text-secondary" aria-hidden="true"></i>
                            <span class="text-dark font-weight-500">Rank & Increasement</span>
                        </div>
                    </div>
                    <div class="Evaluationdeshed"></div>
                    <div class="rad-label pl-0 pr-0">
                        <div class="col-12 pl-5 rad-text pr-3">
                            <i class="fa fa-circle mr-10 font-size-18 text-secondary" aria-hidden="true"></i>
                            <span class="text-dark font-weight-500">Salary & Allowance Range</span>
                        </div>
                    </div>
                    <div class="Evaluationdeshed"></div>
                    <div class="rad-label pl-0 pr-0">
                        <div class="col-12 pl-5 rad-text pr-3">
                            <i class="fa fa-circle mr-10 font-size-18 text-secondary" aria-hidden="true"></i>
                            <span class="text-dark font-weight-500">Bonus calculation</span>
                        </div>
                    </div>
                    <div class="Evaluationdeshed"></div>
                    <div class="rad-label pl-0 pr-0">
                        <div class="col-12 pl-5 rad-text pr-3">
                            <i class="fa fa-circle mr-10 font-size-18 text-secondary" aria-hidden="true"></i>
                            <span class="text-dark font-weight-500">Promotion</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-10 col-md-6 col-12">
            <div class="bg-white pmi_bakgru">
                <div class="col-12">
                    <div class="row">
                        <div class="col-lg-4 col-md-6 col-2">
                            <div class="col-12 FrameSalaryAllowance">
                                Bonus <button class="btn btn-primary bonussubmit" type="submit"><img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/save.png" class="images-bonuesave">&nbsp; SAVE</button>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-6 col-2">
                            <i class="fa fa-exclamation-triangle picturebonus" aria-hidden="true"></i> <span class="font-size-10">16 Issues Pending</span>
                        </div>
                        <div class="col-lg-2 col-md-6 col-2 border-left">
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Currency.png" class="pictureCurrency3"><span class="font-size-10"> Currency</span>
                        </div>
                        <div class="col-lg-2 col-md-6 col-2">
                            <select class="form-select bonus-select" aria-label="Default select example">
                                <option selected value="">Select menu</option>
                                <option value="1">BTH (฿) </option>
                                <option value="2">BTH (฿) </option>
                                <option value="3">BTH (฿) </option>
                            </select>
                        </div>
                        <div class="col-lg-2 col-md-6 col-2 border-left">
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/FilterPlus.png" class="picture-FilterPlus-bonus"> <strong class="font-size-10"> More</strong> <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/3Dot.png" class="bonus-point">
                        </div>
                    </div>
                </div>
                <div class="col-12 BG-bonusgray">
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="alert BB-E3">
                                <div class="col-12">
                                    <span class="b4weight">E3</span><span class="b4E3"> Final Evaluation Phase</span>
                                </div>
                                <hr>
                                <div class="position-relative m-4">
                                    <div class="progress" style="height: 1px;">
                                        <div class="progress-bar" role="progressbar" style="width: 50%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <button type="button" class="position-absolute top-0 start-0 translate-middle btn btn-sm btn-primary rounded-pill" style="width: 2rem; height:2rem;">1</button>
                                    <button type="button" class="position-absolute top-0 start-50 translate-middle btn btn-sm btn-primary rounded-pill" style="width: 2rem; height:2rem;">2</button>
                                    <button type="button" class="position-absolute top-0 start-100 translate-middle btn btn-sm btn-secondary rounded-pill" style="width: 2rem; height:2rem;">3</button>
                                </div>
                            </div>
                            <div class="alert BB-E3">
                                <div class="row">
                                    <div class="col-lg-7 col-md-6 col-6">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Depaertment-blue.png" class="pictureDepartment1"> <span class="Departments12">12 Departments</span>
                                    </div>
                                    <div class="col-lg-5 col-md-6 col-6">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Rank-blue.png" class="accordion-rank1"><span class="Departments12"> 33 Title </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-9 border-left">
                            <div class="row mt-10">

                                <?php
                                for ($i = 1; $i <= 12; $i++) {
                                ?>
                                    <div class="col-lg-1">
                                        <div class="card-header bg-headerbonus">F</div>
                                        <div class="card-body bg-titleBudget">
                                            <div class="card-title">
                                                <div class="number-x">0.2 X</div>
                                                <div class="col-12"><img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/bonus-solid.png" class="images-solidbonus1"></div>
                                                <div class="row bonus-sm1">
                                                    <div class="col-sm-2" style="margin-left: 3px;">
                                                        0
                                                    </div>
                                                    <div class="col-sm-2" style="margin-left: -7px;">
                                                        11
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php

                                }
                                ?>

                            </div>
                            <div class="row">
                                <?php
                                for ($i = 1; $i <= 4; $i++) {
                                ?>

                                    <div class="col-lg-3">
                                        <div class="card text-white mb-3" style="border:none;">
                                            <div class="card-header bg-headerBudget">Total Budget <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/save-black.png" class="pictureEdit1"></div>
                                            <div class="card-body bg-titleBudget">
                                                <div class="card-title">
                                                    <div class="row">
                                                        <div class="col-1">
                                                            ฿
                                                        </div>
                                                        <div class="col-6">
                                                            <input type="number" style="width: 4rem;" class="edit-bonusnumber">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                <?php
                                }
                                ?>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 card">
                    <div class="row">
                        <div class="col-lg-1 col-md-6 col-6 salary-bonusAllsolid1">
                            <div class="salary1">Salary</div>
                            <div class="salary2">฿ <?= number_format(20000) ?> </div>
                        </div>
                        <div class="col-lg-2 col-md-6 col-6 border-right">
                            <div class="row">
                                <div class="col-1">
                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/imagelink-1.png" class="imagelink-1">
                                </div>
                                <div class="col-6 salary3">
                                    Evaluation
                                    Bonus
                                </div>
                                <div class="col-5 salary4">
                                    ฿ <span class="salary-red">(<?= number_format(53486) ?>)</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-6 salary-bonusAllsolid2">
                            <div class="row">
                                <div class="col-sm-2">
                                    <i class="fa fa-align-center" aria-hidden="true"></i>
                                </div>
                                <div class="col-sm-4 salary3">
                                    Budget
                                    adjustment
                                </div>
                                <div class="col-sm-6 salary4">
                                    ฿ <span class="salary-red">(<?= number_format(53486) ?>)</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-6 salary-bonusAllsolid4">
                            <div class="row">
                                <div class="col-sm-1">
                                    <i class="fa fa-align-center" aria-hidden="true"></i>
                                </div>
                                <div class="col-sm-2 salary3">
                                    Final
                                    adjustment
                                </div>
                                <div class="col-sm-2 salary4">
                                    ฿ <span class="salary-bule">(<?= number_format(53486) ?>)</span>
                                </div>
                                <div class="col-sm-2">
                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/like-smile.png" class="like-smile"><span class="font-size-10">Final Bonus</span>
                                </div>
                                <div class="col-sm-2">
                                    <div class="col-12 bottomsolid-salarybonus">
                                        <?= number_format(271537) ?>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/like-smile.png" class="like-smile"><span class="font-size-10">Payable Bonus Ratio</span>
                                </div>
                                <div class="col-sm-1">
                                    <div class="col-12 bottomsolid-salarybonus">
                                        <?= number_format(2) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="cd-F4F6F9">
                    <div class="row">
                        <div class="col-lg-3 col-md-6 col-3 bonus-employee1">
                            employee
                        </div>
                        <div class="col-lg-1 col-md-6 col-1  bonus-title1">
                            title
                        </div>
                        <div class="col-lg-1 col-md-6 col-1 bonus-rank1">
                            rank
                        </div>
                        <div class="col-lg-1 col-md-6 col-1 bonus-Bonus1">
                            Bonus
                        </div>
                        <div class="col-lg-1 col-md-6 col-1  bonus-SG1">
                            <span class="dropdown" href="#" role="but ton" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false"> Salary (SG) <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Selected-info.png" class="width3"></span>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <li class="font-size-10"><a class="dropdown-item" href="#">1</a> </li>
                                <li class="font-size-10"><a class="dropdown-item" href="#">2</a></li>
                                <li class="font-size-10"><a class="dropdown-item" href="#">3</a></li>
                            </ul>
                        </div>
                        <div class="col-lg-1 col-md-6 col-1  bonus-Eval1">
                            Eval.Bonus
                        </div>
                        <div class="col-lg-1 col-md-6 col-1  bonus-Adj1">
                            Adjustment
                        </div>
                        <div class="col-lg-1 col-md-6 col-1  bonus-Final1">
                            Final Adjustment
                        </div>
                        <div class="col-lg-1 col-md-6 col-1  bonus-Pay1">
                            Payable Bonus
                        </div>
                        <div class="col-lg-1 col-md-6 col-1  bonus-Pay1">
                            Payable Bonus
                        </div>
                    </div>
                </div>



                <div class="alert cd-F4F6F9">

                    <div class="col-12">
                        <span class="badge bg-primary">
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Light/Light/24px/Department.png" class="bonus-Department">
                        </span>
                        <span class="F4F6F9-Accounts"> Accounts &Taxation</span>
                    </div>

                    <?php
                    for ($i = 1; $i <= 6; $i++) {
                    ?>

                        <div class="row pt-20">
                            <div class="alert alert-light col-lg-12 col-md-6 col-12 crd-bonus-notborder">
                                <div class="row">
                                    <div class="col-lg-2 bonus-user">
                                        <img src="<?= Yii::$app->homeUrl ?>image/man.png" class="ladyjpg"> Ananta Kumar
                                    </div>
                                    <div class="col-lg-1 col-md-6 col-6 bonus-Position">
                                        Junior Associate
                                    </div>
                                    <div class="col-lg-1 col-md-6 col-6 bonus-rank">
                                        A
                                    </div>
                                    <div class="col-lg-1 col-md-6 col-6 bonus-Bonus">
                                        1.2 X
                                    </div>
                                    <div class="col-lg-1 col-md-6 col-6 bonus-SG">
                                        <?= number_format(66910) ?>
                                    </div>
                                    <div class="col-lg-1 col-md-6 col-6 bonus-Eval">
                                        <?= number_format(80293) ?>
                                    </div>
                                    <div class="col-lg-1 col-md-6 col-6 bonus-Adjustment">
                                        <i class="fa fa-caret-down text-danger font-size-12" aria-hidden="true"></i><span class="text-danger"> (<?= number_format(13209) ?>)</span>
                                    </div>
                                    <div class="col-lg-1 col-md-6 col-6 bonus-finaladjustment">
                                        <span class="finaladjustment-ml"> <?= number_format(80293) ?> <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/ture.png" class="width1"> <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/save-black.png" class="width2"></span>
                                    </div>
                                    <div class="col-lg-1 col-md-6 col-6 bonus-Pay">
                                        <?= number_format(67083) ?>
                                    </div>
                                    <div class="col-lg-1 col-md-6 col-6 bonus-Payable">
                                        1.01 X
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>