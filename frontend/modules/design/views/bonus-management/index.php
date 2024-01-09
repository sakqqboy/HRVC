<?php

use Faker\Core\Number;

$this->title = 'Bonus Management';

?>

<div class="col-12 mt-90 alert alert-Evaluator">
    <div class="row">
        <div class="col-lg-3 col-md-6 col-12">
            <div class="row">
                <div class="col-5">
                    <img src="<?= Yii::$app->homeUrl ?>image/BD.jpg" class="imagealertEvaluator">
                </div>
                <div class="col-7 setEvaluator">
                    Tokyo Consulting Firm Pvt. Ltd
                </div>
            </div>
            <div class="col-12 Evaluator-country">
                &nbsp;&nbsp; <img src="<?= Yii::$app->homeUrl ?>image/Thailand.png" class="imageEvaluatorcountry"> Bangkok, Thailand
            </div>
            <div class="col-12">
                <div class="shadow-sm p-3 mb-5 bg-body rounded mt-30">
                    <div class="Mid-Term"> Mid Term Evaluation Phase</div>
                    <div class="E3"> E3 </div>
                </div>
            </div>
            <div class="card" style="border:none;">
                <div class="col-12">
                    <div class="col-12 EvaluatorConfiguration">
                        <i class="fa fa-cog" aria-hidden="true"></i> &nbsp; Set Configuration
                    </div>
                    <hr>
                    <div class="col-12">
                        <div>
                            <label class="rad-label">
                                <input type="radio" class="rad-input" name="rad">
                                <div class="rad-design"></div>
                                <div class="rad-text"> Evaluation Frame</div>
                            </label>
                            <div class="Evaluationdeshed"></div>

                            <label class="rad-label">
                                <input type="radio" class="rad-input" name="rad">
                                <div class="rad-design"></div>
                                <div class="rad-text"> Weight Allocation</div>
                            </label>

                            <label class="rad-label">
                                <input type="radio" class="rad-input" name="rad">
                                <div class="rad-design"></div>
                                <div class="rad-text"> Evaluator Settings</div>
                            </label>

                            <label class="rad-label">
                                <input type="radio" class="rad-input" name="rad">
                                <div class="rad-design"></div>
                                <div class="rad-text">Rank & Increasement</div>
                            </label>

                            <label class="rad-label">
                                <input type="radio" class="rad-input" name="rad">
                                <div class="rad-design"></div>
                                <div class="rad-text"> Salary & Allowance Range</div>
                            </label>

                            <label class="rad-label">
                                <input type="radio" class="rad-input" name="rad">
                                <div class="rad-design"></div>
                                <div class="rad-text"> Bonus</div>
                            </label>

                            <label class="rad-label">
                                <input type="radio" class="rad-input" name="rad">
                                <div class="rad-design"></div>
                                <div class="rad-text"> Promotion</div>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-9 col-md-6 col-12">
            <div class="alert aler-ALLDepartment">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="col-12 FrameSalaryAllowance">
                            Bonus &nbsp; <button class="btn btn-primary bonussubmit" type="submit"><img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/save.png" class="images-bonuesave">&nbsp;&nbsp; SAVE</button>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <i class="fa fa-exclamation-triangle picturebonus" aria-hidden="true"></i> <span class="font-size-12">16 Issues Pending</span>
                    </div>

                    <div class="col-lg-2">
                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Currency.png" class="pictureCurrency3"><span class="font-size-10"> Currency</span>
                    </div>
                    <div class="col-lg-2">
                        <select class="form-select bonus-select" aria-label="Default select example">
                            <option selected value="">Select menu</option>
                            <option value="1">BTH (฿) </option>
                            <option value="2">BTH (฿) </option>
                            <option value="3">BTH (฿) </option>
                        </select>
                    </div>
                    <div class="col-lg-2">
                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/FilterPlus.png" class="picture-FilterPlus-bonus"> <strong class="font-size-13">More</strong> <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/3Dot.png" class="bonus-point">
                    </div>
                </div>
                <div class="alert alert-Evaluator mt-20">
                    <div class="row">
                        <div class="col-md-3 b4solid">
                            <div class="card b4">
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
                            <div class="card b4">
                                <div class="row">
                                    <div class="col-lg-7 col-md-6 col-6">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Department.png" class="pictureDepartment1"> <span class="font-size-12">12 Departments</span>
                                    </div>
                                    <div class="col-lg-5 col-md-6 col-6">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Rank-1.png" class="accordion-rank1"><span class="font-size-12"> 33 Title </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="row">
                                <div class="col-lg-1 text-center" style="width: 4rem;">
                                    <div class="card-header bg-headerbonus">F</div>
                                    <div class="card-body bg-titleBudget">
                                        <div class="card-title">
                                            <div class="pt-5 font-size-10">0.2 X</div>
                                            <div class="col-12"><img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/bonus-solid.png" class="images-solidbonus1"></div>
                                            <div class="row bonus-sm1">
                                                <div class="col-sm-2">
                                                    0
                                                </div>
                                                <div class="col-sm-2">
                                                    11
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-1  text-center" style="width: 4rem;margin-left:-17px;">
                                    <div class="card-header bg-headerbonus">E</div>
                                    <div class="card-body bg-titleBudget">
                                        <div class="card-title">
                                            <div class="pt-5 font-size-10">0.4 X</div>
                                            <div class="col-12"><img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/bonus-solid.png" class="images-solidbonus1"></div>
                                            <div class="row bonus-sm1">
                                                <div class="col-sm-2">
                                                    0
                                                </div>
                                                <div class="col-sm-2">
                                                    11
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-1  text-center" style="width: 4rem;margin-left:-17px;">
                                    <div class="card-header bg-headerbonus">D</div>
                                    <div class="card-body bg-titleBudget">
                                        <div class="card-title">
                                            <div class="pt-5 font-size-10">0.5 X</div>
                                            <div class="col-12"><img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/bonus-solid.png" class="images-solidbonus1"></div>
                                            <div class="row bonus-sm1">
                                                <div class="col-sm-2">
                                                    0
                                                </div>
                                                <div class="col-sm-2">
                                                    11
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-1  text-center" style="width: 4rem;margin-left:-17px;">
                                    <div class="card-header bg-headerbonus">C</div>
                                    <div class="card-body bg-titleBudget">
                                        <div class="card-title">
                                            <div class="pt-5 font-size-10">0.6 X</div>
                                            <div class="col-12"><img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/bonus-solid.png" class="images-solidbonus1"></div>
                                            <div class="row bonus-sm1">
                                                <div class="col-sm-2">
                                                    0
                                                </div>
                                                <div class="col-sm-2">
                                                    11
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-1  text-center" style="width: 4rem;margin-left:-17px;">
                                    <div class="card-header bg-headerbonus">B</div>
                                    <div class="card-body bg-titleBudget">
                                        <div class="card-title">
                                            <div class="pt-5 font-size-10">0.7 X</div>
                                            <div class="col-12"><img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/bonus-solid.png" class="images-solidbonus1"></div>
                                            <div class="row bonus-sm1">
                                                <div class="col-sm-2">
                                                    0
                                                </div>
                                                <div class="col-sm-2">
                                                    11
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-1  text-center" style="width: 4rem;margin-left:-17px;">
                                    <div class="card-header bg-headerbonus">B+</div>
                                    <div class="card-body bg-titleBudget">
                                        <div class="card-title">
                                            <div class="pt-5 font-size-10">1.2 X</div>
                                            <div class="col-12"><img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/bonus-solid.png" class="images-solidbonus1"></div>
                                            <div class="row bonus-sm1">
                                                <div class="col-sm-2">
                                                    0
                                                </div>
                                                <div class="col-sm-2">
                                                    11
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-1  text-center" style="width: 4rem;margin-left:-17px;">
                                    <div class="card-header bg-headerbonus">A</div>
                                    <div class="card-body bg-titleBudget">
                                        <div class="card-title">
                                            <div class="pt-5 font-size-10">1.6 X</div>
                                            <div class="col-12"><img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/bonus-solid.png" class="images-solidbonus1"></div>
                                            <div class="row bonus-sm1">
                                                <div class="col-sm-2">
                                                    0
                                                </div>
                                                <div class="col-sm-2">
                                                    11
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-1  text-center" style="width: 4rem;margin-left:-17px;">
                                    <div class="card-header bg-headerbonus">A+</div>
                                    <div class="card-body bg-titleBudget">
                                        <div class="card-title">
                                            <div class="pt-5 font-size-10">2.0 X</div>
                                            <div class="col-12"><img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/bonus-solid.png" class="images-solidbonus1"></div>
                                            <div class="row bonus-sm1">
                                                <div class="col-sm-2">
                                                    0
                                                </div>
                                                <div class="col-sm-2">
                                                    11
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-1  text-center" style="width: 4rem;margin-left:-17px;">
                                    <div class="card-header bg-headerbonus">S-</div>
                                    <div class="card-body bg-titleBudget">
                                        <div class="card-title">
                                            <div class="pt-5 font-size-10">2.4 X</div>
                                            <div class="col-12"><img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/bonus-solid.png" class="images-solidbonus1"></div>
                                            <div class="row bonus-sm1">
                                                <div class="col-sm-2">
                                                    0
                                                </div>
                                                <div class="col-sm-2">
                                                    11
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-1  text-center" style="width: 4rem;margin-left:-13px;">
                                    <div class="card-header bg-headerbonus">S</div>
                                    <div class="card-body bg-titleBudget">
                                        <div class="card-title">
                                            <div class="pt-5 font-size-10">2.8 X</div>
                                            <div class="col-12"><img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/bonus-solid.png" class="images-solidbonus1"></div>
                                            <div class="row bonus-sm1">
                                                <div class="col-sm-2">
                                                    0
                                                </div>
                                                <div class="col-sm-2">
                                                    11
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-1 text-center" style="width: 4rem;margin-left:-14px;">
                                    <div class="card-header bg-headerbonus">S+</div>
                                    <div class="card-body bg-titleBudget">
                                        <div class="card-title">
                                            <div class="pt-5 font-size-10">3.0 X</div>
                                            <div class="col-12"><img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/bonus-solid.png" class="images-solidbonus1"></div>
                                            <div class="row bonus-sm1">
                                                <div class="col-sm-2">
                                                    0
                                                </div>
                                                <div class="col-sm-2">
                                                    11
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-1 text-center" style="width: 4rem;margin-left:-15px;">
                                    <div class="card-header bg-headerbonus">SS</div>
                                    <div class="card-body bg-titleBudget">
                                        <div class="card-title">
                                            <div class="pt-5 font-size-10">3.1 X</div>
                                            <div class="col-12"><img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/bonus-solid.png" class="images-solidbonus1"></div>
                                            <div class="row bonus-sm1">
                                                <div class="col-sm-2">
                                                    0
                                                </div>
                                                <div class="col-sm-2">
                                                    11
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="card text-white mb-3" style="max-width: 8rem;border:none;">
                                        <div class="card-header bg-headerBudget">Total Budget <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/save-black.png" class="pictureEdit1"></div>
                                        <div class="card-body bg-titleBudget">
                                            <div class="card-title">
                                                <div class="row">
                                                    <div class="col-1">
                                                        ฿
                                                    </div>
                                                    <div class="col-6">
                                                        <input type="number" style="width: 5rem;" class="edit-bonusnumber">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="card text-white mb-3" style="max-width: 8rem;border:none;">
                                        <div class="card-header bg-headerBudget"><span class="header1-bonus">Evaluated Bonus</span><img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/save-black.png" class="pictureEdit1"></div>
                                        <div class="card-body bg-titleBudget">
                                            <div class="card-title">
                                                <div class="row">
                                                    <div class="col-1">
                                                        ฿
                                                    </div>
                                                    <div class="col-6">
                                                        <input type="number" style="width: 5rem;" class="edit-bonusnumber">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="card text-white mb-3" style="max-width: 8rem;border:none;">
                                        <div class="card-header bg-headerBudget">Adjustment <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/save-black.png" class="pictureEdit1"></div>
                                        <div class="card-body bg-titleBudget">
                                            <div class="card-title">
                                                <div class="row">
                                                    <div class="col-1">
                                                        ฿
                                                    </div>
                                                    <div class="col-6">
                                                        <input type="number" style="width: 5rem;" class="edit-bonusnumber">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="card text-white mb-3" style="max-width: 8rem;border:none;">
                                        <div class="card-header bg-headerBudget">Payable Bonus <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/save-black.png" class="pictureEdit1"></div>
                                        <div class="card-body bg-titleBudget">
                                            <div class="card-title">
                                                <div class="row">
                                                    <div class="col-1">
                                                        ฿
                                                    </div>
                                                    <div class="col-6">
                                                        <input type="number" style="width: 5rem;" class="edit-bonusnumber">
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
                <div class="card">
                    <div class="row">
                        <div class="col-lg-1 col-md-6 col-6 salary-bonusAllsolid1">
                            <div class="col-12 salary1">Salary</div>
                            <div class="col-12 salary2">฿ <?= number_format(20000) ?> </div>
                        </div>
                        <div class="col-lg-2 col-md-6 col-6">
                            <div class="row">
                                <div class="col-sm-1">
                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/imagelink-1.png" class="imagelink-1">
                                </div>
                                <div class="col-sm-4 salary3">
                                    Evaluation
                                    Bonuห
                                </div>
                                <div class="col-sm-6 salary4">
                                    ฿<span class="salary-red">(<?= number_format(53486) ?>)</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-6  salary-bonusAllsolid2">
                            <div class="row">
                                <div class="col-sm-1">
                                    <i class="fa fa-align-center" aria-hidden="true"></i>
                                </div>
                                <div class="col-sm-5 salary3">
                                    Budget
                                    adjustment
                                </div>
                                <div class="col-sm-5 salary4">
                                    ฿ <span class="salary-red">(<?= number_format(53486) ?>)</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-6 salary-bonusAllsolid3">
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
                <div class="alert cd-F4F6F9">
                    <div class="row">
                        <div class="col-sm-1"></div>
                        <div class="col-sm-2  bonus-employee1">
                            employee
                        </div>
                        <div class="col-sm-1  bonus-title1">
                            title
                        </div>
                        <div class="col-sm-1  bonus-rank1">
                            rank
                        </div>
                        <div class="col-sm-1  bonus-Bonus1">
                            Bonus
                        </div>
                        <div class="col-sm-1  bonus-SG1">
                            Salary (SG)
                        </div>
                        <div class="col-sm-1  bonus-Eval1">
                            Eval.Bonus
                        </div>
                        <div class="col-sm-1  bonus-Adj1">
                            Adjustment
                        </div>
                        <div class="col-sm-1  bonus-Final1">
                            Final Adjustment
                        </div>
                        <div class="col-sm-1  bonus-Pay1">
                            Payable Bonus
                        </div>
                        <div class="col-sm-1  bonus-Pay1">
                            Payable Bonus
                        </div>
                    </div>
                </div>
                <div class="alert cd-F4F6F9">
                    <div class="row">
                        <div class="col-lg-1 col-md-6 col-6">
                            <button type="submit" class="btn btn-primary"><img src="<?= Yii::$app->homeUrl ?>images/icons/Light/Light/24px/Department.png" class="bonus-Department"></button>
                            <span class="F4F6F9-Accounts"> Accounts & Taxation</span>
                        </div>
                        <div class="alert fff-white col-lg-11 col-md-6 col-12">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-2 bonus-user">
                                        <img src="<?= Yii::$app->homeUrl ?>image/man.png" class="ladyjpg"> Ananta Kumar
                                    </div>
                                    <div class="col-1 bonus-Position">
                                        Junior Associate
                                    </div>
                                    <div class="col-1 bonus-rank">
                                        A
                                    </div>
                                    <div class="col-1 bonus-Bonus">
                                        1.2 X
                                    </div>
                                    <div class="col-1 bonus-SG">
                                        <?= number_format(66910) ?>
                                    </div>
                                    <div class="col-1 bonus-Eval">
                                        <?= number_format(80293) ?>
                                    </div>
                                    <div class="col-1 bonus-Adjustment">
                                        <i class="fa fa-caret-down text-danger font-size-12" aria-hidden="true"></i><span class="text-danger">(<?= number_format(13209) ?>)</span>
                                    </div>
                                    <div class="col-2 bonus-finaladjustment">
                                        <?= number_format(80293) ?> <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/ture.png" class="width1"> <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/save-black.png" class="width2">
                                    </div>
                                    <div class="col-1 bonus-Pay">
                                        <?= number_format(67083) ?>
                                    </div>
                                    <!-- <div class="col-1 bonus-Payable">
                                        1.0 X
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<!-- <div class="alert cd-F4F6F9">
                    <div class="row">
                        <div class="col-lg-1 col-md-6 col-6">
                            <button type="submit" class="btn btn-primary"><img src="<?= Yii::$app->homeUrl ?>images/icons/Light/Light/24px/Department.png" class="bonus-Department"></button>
                            <span class="F4F6F9-Accounts"> Accounts & Taxation</span>
                        </div>
                        <div class="col-lg-11 col-md-6 col-12">
                            <div class="col-12">
                                <div class="alert fff-white">
                                    <div class="row">
                                        <div class="col-2 bonus-user">
                                            <img src="<?= Yii::$app->homeUrl ?>image/man.png" class="ladyjpg"> Ananta Kumar
                                        </div>
                                        <div class="col-1 bonus-Position">
                                            Junior Associate
                                        </div>
                                        <div class="col-1 bonus-rank">
                                            A
                                        </div>
                                        <div class="col-1 bonus-Bonus">
                                            1.2 X
                                        </div>
                                        <div class="col-1 bonus-SG">
                                        <?= number_format(66910) ?>
                                        </div>
                                        <div class="col-1 bonus-Eval">
                                            <?= number_format(80293) ?>
                                        </div>
                                        <div class="col-1 bonus-Adjustment">
                                            <i class="fa fa-caret-down text-danger font-size-12" aria-hidden="true"></i><span class="text-danger">(<?= number_format(13209) ?>)</span>
                                        </div>
                                        <div class="col-2 bonus-finaladjustment">
                                            <?= number_format(80293) ?> <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/ture.png" class="width1"> <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/save-black.png" class="width2">
                                        </div>
                                        <div class="col-1 bonus-Pay">
                                            <?= number_format(67083) ?>
                                        </div>
                                        <div class="col-1">
                                            1.0 X
                                        </div>
                                    </div>
                                </div>
                                <div class="alert fff-white">
                                    <div class="row">
                                        <div class="col-2 bonus-user">
                                            <img src="<?= Yii::$app->homeUrl ?>image/man.png" class="ladyjpg"> Chalse Vortocharjjo
                                        </div>
                                        <div class="col-1 bonus-Position">
                                            Senior Associate
                                        </div>
                                        <div class="col-1 bonus-rank">
                                            B
                                        </div>
                                        <div class="col-1 bonus-title">
                                            0.7 X
                                        </div>
                                        <div class="col-1 bonus-title">
                                            <?= number_format(35743) ?>
                                        </div>
                                        <div class="col-1 bonus-title">
                                            <?= number_format(5880) ?>
                                        </div>
                                        <div class="col-1 bonus-title">
                                            <i class="fa fa-caret-down text-danger font-size-12" aria-hidden="true"></i> <span class="text-danger">(<?= number_format(5880) ?>)</span>
                                        </div>
                                        <div class="col-1 bonus-title">
                                            <?= number_format(5880) ?>
                                        </div>
                                        <div class="col-1 bonus-title">
                                            <?= number_format(29863) ?>
                                        </div>
                                        <div class="col-1 bonus-Adjust">
                                            0.6 X
                                        </div>
                                    </div>
                                </div>
                                <div class="alert fff-white">
                                    <div class="row">
                                        <div class="col-2 bonus-user">
                                            <img src="<?= Yii::$app->homeUrl ?>image/man.png" class="ladyjpg"> Shutra Dhar
                                        </div>
                                        <div class="col-1 bonus-Position">
                                            Associate
                                        </div>
                                        <div class="col-1 bonus-rank">
                                            SS
                                        </div>
                                        <div class="col-1 bonus-title">
                                            0.7 X
                                        </div>
                                        <div class="col-1 bonus-title">
                                            <?= number_format(66910) ?>
                                        </div>
                                        <div class="col-1 bonus-title">
                                            <?= number_format(80293) ?>
                                        </div>
                                        <div class="col-1 bonus-title">
                                            <i class="fa fa-caret-down text-danger font-size-12" aria-hidden="true"></i>(<?= number_format(13209) ?>)
                                        </div>
                                        <div class="col-1 bonus-title">
                                            <?= number_format(80293) ?>
                                        </div>
                                        <div class="col-1 bonus-title">
                                            <?= number_format(80293) ?>
                                        </div>
                                        <div class="col-1 bonus-Adjust">
                                            <?= number_format(80293) ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="alert fff-white">
                                    <div class="row">
                                        <div class="col-2 bonus-user">
                                            <img src="<?= Yii::$app->homeUrl ?>image/man.png" class="ladyjpg"> Kazi Nazrul Islam
                                        </div>
                                        <div class="col-1 bonus-Position">
                                            Manager
                                        </div>
                                        <div class="col-1 bonus-rank">
                                            S
                                        </div>
                                        <div class="col-1 bonus-title">
                                            2.4 X
                                        </div>
                                        <div class="col-1 bonus-title">
                                            <?= number_format(66910) ?>
                                        </div>
                                        <div class="col-1 bonus-title">
                                            <?= number_format(80293) ?>
                                        </div>
                                        <div class="col-1 bonus-title">
                                            <i class="fa fa-caret-down text-danger font-size-12" aria-hidden="true"></i>(<?= number_format(13209) ?>)
                                        </div>
                                        <div class="col-1 bonus-title">
                                            <?= number_format(80293) ?>
                                        </div>
                                        <div class="col-1 bonus-title">
                                            <?= number_format(80293) ?>
                                        </div>
                                        <div class="col-1 bonus-Adjust">
                                            <?= number_format(80293) ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="alert fff-white">
                                    <div class="row">
                                        <div class="col-2 bonus-user">
                                            <img src="<?= Yii::$app->homeUrl ?>image/man.png" class="ladyjpg"> Robindro Nath Thakur
                                        </div>
                                        <div class="col-1 bonus-Position">
                                            Assistant Manager
                                        </div>
                                        <div class="col-1 bonus-rank">
                                            C
                                        </div>
                                        <div class="col-1 bonus-title">
                                            3.0 X
                                        </div>
                                        <div class="col-1 bonus-title">
                                            <?= number_format(66910) ?>
                                        </div>
                                        <div class="col-1 bonus-title">
                                            <?= number_format(80293) ?>
                                        </div>
                                        <div class="col-1 bonus-title">
                                            <i class="fa fa-caret-down text-danger font-size-12" aria-hidden="true"></i>(<?= number_format(13209) ?>)
                                        </div>
                                        <div class="col-1 bonus-title">
                                            <?= number_format(80293) ?>
                                        </div>
                                        <div class="col-1 bonus-title">
                                            <?= number_format(80293) ?>
                                        </div>
                                        <div class="col-1 bonus-Adjust">
                                            <?= number_format(80293) ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->