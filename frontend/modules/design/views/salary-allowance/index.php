<?php

use Faker\Core\Number;

$this->title = 'Salary Allowance';

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
                    <div class="col-lg-3">
                        <div class="col-12 FrameSalaryAllowance">
                            Salary & Allowance
                        </div>
                    </div>
                    <div class="col-lg-1">
                        <button class="form-control cl-btn" type="button"><img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/FilterFull.png" class="pictureFilterFull"></button>
                    </div>
                    <div class="col-lg-2">
                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Department.png" class="pictureDepartment1"> <span class="font-size-12">Department</span>
                    </div>
                    <div class="col-lg-3">
                        <select class="form-select b1" aria-label="Default select example">
                            <option selected value="">Select menu</option>
                            <option value="1">Accounts & Taxation</option>
                            <option value="2">IT company</option>
                            <option value="3">Management</option>
                        </select>
                    </div>
                    <div class="col-lg-1 b2solid">
                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Currency.png" class="pictureCurrency3"><span class="font-size-10">Currency</span>
                    </div>
                    <div class="col-lg-2">
                        <select class="form-select b3" aria-label="Default select example">
                            <option selected value="">Select menu</option>
                            <option value="1">BTH (฿) </option>
                            <option value="2">BTH (฿) </option>
                            <option value="3">BTH (฿) </option>
                        </select>
                    </div>
                </div>
                <div class="alert alert-Evaluator mt-20">
                    <div class="row">
                        <div class="col-md-4 b4solid">
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
                        </div>
                        <div class="col-md-2">
                            <div class="card text-white mb-3" style="max-width: 18rem;border:none;">
                                <div class="card-header bg-headerBudget">Total Budget <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Edit.png" class="pictureEdit"></div>
                                <div class="card-body bg-titleBudget">
                                    <div class="card-title">
                                        ฿ <?= number_format(39489) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="card text-white mb-3" style="max-width: 18rem;border:none;">
                                <div class="card-header bg-headerBudget">Evaluated Salary <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Edit.png" class="pictureEdit"></div>
                                <div class="card-body bg-titleBudget">
                                    <div class="card-title">
                                        ฿ <?= number_format(39489) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="card text-white mb-3" style="max-width: 18rem;border:none;">
                                <div class="card-header bg-headerBudget">TAdjustment <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Edit.png" class="pictureEdit"></div>
                                <div class="card-body bg-titleBudget">
                                    <div class="card-title">
                                        ฿ <?= number_format(39489) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="card text-white mb-3" style="max-width: 18rem;border:none;">
                                <div class="card-header bg-headerBudget">Total New Salary<img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Edit.png" class="pictureEdit"></div>
                                <div class="card-body bg-titleBudget">
                                    <div class="card-title">
                                        ฿ <?= number_format(39489) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="alert alert-Evaluator mt-20">
                    <div class="row">
                        <div class="col-3">
                            <div class="col-12">
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Vector.png" class="pictureDepartment-salary"> <span class="linkAccounts"> Accounts & Taxation</ห>
                            </div>
                        </div>
                        <div class="col-1">
                            <span class="badge rounded-pill bg-gray bordertry-li1">
                                <ul class="try-cricle">
                                    <li class="tri-li"> <img src="<?= Yii::$app->homeUrl ?>image/avatar1.png" class="image-avatar1"></li>
                                    <li class="tri-li"> <img src="<?= Yii::$app->homeUrl ?>image/Watanabe.png" class="image-avatar2"></li>
                                    <li class="tri-li"> <img src="<?= Yii::$app->homeUrl ?>image/avatar3.png" class="image-avatar3"></li>
                                    <a href="" class="none">
                                        <li class="tri-li-number1 pt-3"> 27 </li>
                                    </a>
                                </ul>
                            </span>
                        </div>
                        <div class="col-1">
                            <div class="salary-Participating">
                                Participating Employees
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="alert alert-Achievement1">
                                <div class="row">
                                    <div class="col-sm-1">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Achievement.png" class="pictureAchievement-salary">
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="col-12 Achievement1">
                                            Achievement
                                        </div>
                                        <div class="col-12 Achievement1-number1">
                                            ฿<?= number_format(36860) ?>
                                        </div>
                                    </div>
                                    <div class="col-sm-1">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/budget-management3.png" class="picturebudget">
                                    </div>
                                    <div class="col-sm-5">
                                        <div class="col-12 Achievement1">
                                            Achievement
                                        </div>
                                        <div class="col-12 Achievement1-number1">
                                            ฿<?= number_format(36860) ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="alert alert-D6E6FF">
                                <span class="printer"> Generate Report &nbsp;&nbsp; <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/printer.png" class="printerpointer"></span>
                            </div>
                        </div>
                        <div class="col-1">
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Selected-3.png" class="UpdownSelected" type="button">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="container-accordion">
                            <div class="col-12 card card-accordion">
                                <div class="col-6">
                                    <span class="badge bg-sprank1"> <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Rank-1.png" class="accordion-rank1"></span> &nbsp;<span class="Manager">Manager</span> &nbsp;<span class="badge rounded-pill bg-primary-MM">MM</span>
                                </div>
                                <div class="col-12 mt-20">
                                    <div class="row">
                                        <div class="col-lg-1 col-md-6 col-12">
                                            <span class="badge rounded-pill bg-gray mt-30">
                                                <ul class="try-cricle">
                                                    <li class="tri-li"> <img src="<?= Yii::$app->homeUrl ?>image/avatar1.png" class="image-avatar1"></li>
                                                    <li class="tri-li"> <img src="<?= Yii::$app->homeUrl ?>image/Watanabe.png" class="image-avatar2"></li>
                                                    <li class="tri-li"> <img src="<?= Yii::$app->homeUrl ?>image/avatar3.png" class="image-avatar3"></li>
                                                    <a href="" class="none">
                                                        <li class="tri-li-number1 pt-3"> 9 </li>
                                                    </a>
                                                </ul>
                                            </span>
                                        </div>
                                        <div class="col-lg-3 col-md-6 col-12 accordion-Included">
                                            Included Employees
                                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Achievement.png" class="accordion-3Dot"><span class="B">B</span>
                                        </div>

                                        <div class="col-lg-6 col-md-6 col-12">
                                            <div class="col-12 accordion-minimum-solid"></div>
                                            <div class="row accordionpl_minimum">
                                                <div class="col-12 Minimum"> Minimum <span class="text-primary">0%</span></div>
                                                <div class="col-2 card accordion-C9E5FF">
                                                    <?= number_format(13291) ?>
                                                </div>
                                                <div class="col-2 card accordion-C9E5FF">
                                                    <?= number_format(18017) ?>
                                                </div>
                                                <div class="col-2 card accordion-C9E5FF">
                                                    <?= number_format(22743) ?>
                                                </div>
                                                <div class="col-2 card accordion-C9E5FF">
                                                    <?= number_format(27470) ?>
                                                </div>
                                                <div class="col-2 card accordion-C9E5FF">
                                                    <?= number_format(32196) ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-1 col-md-6 col-12">
                                            <span class="badge rounded-pill bg-D6FFDF">
                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/UP.png" class="accordion-UP"> <?= number_format(638) ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion"></div>
                                <div class="accordion-content">
                                    <hr>
                                    <p>fvfioggogkmoi</p>
                                </div>
                            </div>
                        </div>
                        <div class="container-accordion">
                            <div class="col-12 card card-accordion">
                                <div class="col-6">
                                    <span class="badge bg-sprank1"> <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Rank-1.png" class="accordion-rank1"></span> &nbsp;<span class="Manager">Assistant Manager</span> &nbsp;<span class="badge rounded-pill bg-primary-MM">MM</span>
                                </div>
                                <div class="col-12 mt-20">
                                    <div class="row">
                                        <div class="col-lg-1 col-md-6 col-12">
                                            <span class="badge rounded-pill bg-gray mt-30">
                                                <ul class="try-cricle">
                                                    <li class="tri-li"> <img src="<?= Yii::$app->homeUrl ?>image/avatar1.png" class="image-avatar1"></li>
                                                    <li class="tri-li"> <img src="<?= Yii::$app->homeUrl ?>image/Watanabe.png" class="image-avatar2"></li>
                                                    <li class="tri-li"> <img src="<?= Yii::$app->homeUrl ?>image/avatar3.png" class="image-avatar3"></li>
                                                    <a href="" class="none">
                                                        <li class="tri-li-number1 pt-3"> 9 </li>
                                                    </a>
                                                </ul>
                                            </span>
                                        </div>
                                        <div class="col-lg-3 col-md-6 col-12 accordion-Included">
                                            Included Employees
                                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Achievement.png" class="accordion-3Dot"><span class="B">B</span>
                                        </div>

                                        <div class="col-lg-6 col-md-6 col-12">
                                            <div class="col-12 accordion-minimum-solid"></div>
                                            <div class="row">
                                                <div class="col-12 Minimum"> Minimum <span class="text-primary">0%</span></div>
                                                <div class="col-2 card accordion-C9E5FF">
                                                    <?= number_format(13291) ?>
                                                </div>
                                                <div class="col-2 card accordion-C9E5FF">
                                                    <?= number_format(18017) ?>
                                                </div>
                                                <div class="col-2 card accordion-C9E5FF">
                                                    <?= number_format(22743) ?>
                                                </div>
                                                <div class="col-2 card accordion-C9E5FF">
                                                    <?= number_format(27470) ?>
                                                </div>
                                                <div class="col-2 card accordion-C9E5FF">
                                                    <?= number_format(32196) ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-1 col-md-6 col-12 ">
                                            <div class="col-12">
                                                <span class="badge rounded-pill bg-D6FFDF">
                                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/UP.png" class="accordion-UP"> <?= number_format(638) ?>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion"></div>
                                <div class="accordion-content">
                                    <hr>
                                    <p>fgkothotlroogokfgk</p>
                                </div>
                            </div>
                        </div>
                        <div class="container-accordion">
                            <div class="col-12 card card-accordion">
                                <div class="col-6">
                                    <span class="badge bg-sprank1"> <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Rank-1.png" class="accordion-rank1"></span> &nbsp;<span class="Manager">Junior Executive</span> &nbsp;<span class="badge rounded-pill bg-primary-MM">LM</span>
                                </div>
                                <div class="col-12 mt-20">
                                    <div class="row">
                                        <div class="col-lg-1 col-md-6 col-12">
                                            <span class="badge rounded-pill bg-gray mt-30">
                                                <ul class="try-cricle">
                                                    <li class="tri-li"> <img src="<?= Yii::$app->homeUrl ?>image/avatar1.png" class="image-avatar1"></li>
                                                    <li class="tri-li"> <img src="<?= Yii::$app->homeUrl ?>image/Watanabe.png" class="image-avatar2"></li>
                                                    <li class="tri-li"> <img src="<?= Yii::$app->homeUrl ?>image/avatar3.png" class="image-avatar3"></li>
                                                    <a href="" class="none">
                                                        <li class="tri-li-number1 pt-3"> 9 </li>
                                                    </a>
                                                </ul>
                                            </span>
                                        </div>
                                        <div class="col-lg-3 col-md-6 col-12 accordion-Included">
                                            Included Employees
                                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Achievement.png" class="accordion-3Dot"><span class="B">B</span>
                                        </div>

                                        <div class="col-lg-6 col-md-6 col-12">
                                            <div class="col-12 accordion-minimum-solid"></div>
                                            <div class="row">
                                                <div class="col-12 Minimum"> Minimum <span class="text-primary">0%</span></div>
                                                <div class="col-2 card accordion-C9E5FF">
                                                    <?= number_format(13291) ?>
                                                </div>
                                                <div class="col-2 card accordion-C9E5FF">
                                                    <?= number_format(18017) ?>
                                                </div>
                                                <div class="col-2 card accordion-C9E5FF">
                                                    <?= number_format(22743) ?>
                                                </div>
                                                <div class="col-2 card accordion-C9E5FF">
                                                    <?= number_format(27470) ?>
                                                </div>
                                                <div class="col-2 card accordion-C9E5FF">
                                                    <?= number_format(32196) ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-1 col-md-6 col-12 ">
                                            <div class="col-12">
                                                <span class="badge rounded-pill bg-D6FFDF">
                                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/UP.png" class="accordion-UP"> <?= number_format(638) ?>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion"></div>
                                <div class="accordion-content">
                                    <hr>
                                    <div class="row">
                                        <div class="col-lg-4 col-md-6 col-12 alert alert-Evaluator scrollbar-salaryallowanec" id="salary_scrollbar">
                                            <div class="row">
                                                <div class="col-md-6 tablesalary1">
                                                    Employees
                                                </div>
                                                <div class="col-md-3 tablesalary1">
                                                    Current
                                                </div>
                                                <div class="col-md-3 tablesalary1">
                                                    Rank
                                                </div>
                                            </div>
                                            <div class="col-12 alert p-2 salaryalert">
                                                <div class="row allclass">
                                                    <div class="col-lg-6 tableclass1">
                                                        <div class="col-12">
                                                            <img src="<?= Yii::$app->homeUrl ?>image/Watanabe.png" class="accordion-profile"><span class="namesalary">Ananta Kumar</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 tableclass1">
                                                        <?= number_format(1200) ?>
                                                    </div>
                                                    <div class="col-lg-3 tableA">
                                                        A+
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mt-5"></div>
                                            <div class="col-12 alert p-2 salaryalert">
                                                <div class="row allclass">
                                                    <div class="col-lg-6 tableclass1">
                                                        <div class="col-12">
                                                            <img src="<?= Yii::$app->homeUrl ?>image/Watanabe.png" class="accordion-profile"><span class="namesalary">Chalse Vortocharjjo</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 tableclass1">
                                                        <?= number_format(1200) ?>
                                                    </div>
                                                    <div class="col-lg-3 tableA">
                                                        B+
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mt-5"></div>
                                            <div class="col-12 alert p-2 salaryalert">
                                                <div class="row allclass">
                                                    <div class="col-lg-6 tableclass1">
                                                        <div class="col-12">
                                                            <img src="<?= Yii::$app->homeUrl ?>image/Watanabe.png" class="accordion-profile"><span class="namesalary">Shutra Dhar</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 tableclass1">
                                                        <?= number_format(1200) ?>
                                                    </div>
                                                    <div class="col-lg-3 tableA">
                                                        SS
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mt-5"></div>
                                            <div class="col-12 alert p-2 salaryalert">
                                                <div class="row allclass">
                                                    <div class="col-lg-6 tableclass1">
                                                        <div class="col-12">
                                                            <img src="<?= Yii::$app->homeUrl ?>image/Watanabe.png" class="accordion-profile"><span class="namesalary">Kazi Nazrul Islam</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 tableclass1">
                                                        <?= number_format(22000) ?>
                                                    </div>
                                                    <div class="col-lg-3 tableA">
                                                        S+
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mt-5"></div>
                                            <div class="col-12 alert p-2 salaryalert">
                                                <div class="row allclass">
                                                    <div class="col-lg-6 tableclass1">
                                                        <div class="col-12">
                                                            <img src="<?= Yii::$app->homeUrl ?>image/Watanabe.png" class="accordion-profile"><span class="namesalary">Robindro Nath Thakur</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 tableclass1">
                                                        <?= number_format(36000) ?>
                                                    </div>
                                                    <div class="col-lg-3 tableA">
                                                        D-
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6 col-12  alert alert-Evaluator scrollbar-salaryallowanec" id="salary_scrollbar">
                                            <div class="col-12 stepname">
                                                Rank & Salary Increment
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-12">
                                                    <div class="card" style="width: 4rem;font-size:12px;margin-left:-10px;">
                                                        <div class="card-header classA">A+</div>
                                                        <div class="card-body text-dark">
                                                            <div class="col-12 text-center classtext">
                                                                <?= number_format(879) ?>
                                                            </div>
                                                            <hr>
                                                            <div class="col-12 text-dark text-center pt-10">
                                                                <?= number_format(35) ?>%
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-12">
                                                    <div class="card" style="width: 4rem;font-size:12px;margin-left:-10px;">
                                                        <div class="card-header classA">A+</div>
                                                        <div class="card-body text-dark">
                                                            <div class="col-12 text-center classtext">
                                                                <?= number_format(879) ?>
                                                            </div>
                                                            <hr>
                                                            <div class="col-12 text-dark text-center pt-10">
                                                                <?= number_format(35) ?>%
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-4col-sm-4 col-12">
                                                    <div class="card" style="width: 3.9rem;font-size:12px;margin-left:-10px;">
                                                        <div class="card-header classA">A+</div>
                                                        <div class="card-body text-dark">
                                                            <div class="col-12 text-center classtext">
                                                                <?= number_format(879) ?>
                                                            </div>
                                                            <hr>
                                                            <div class="col-12 text-dark text-center pt-10">
                                                                <?= number_format(35) ?>%
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-12">
                                                    <div class="card" style="width: 4rem;font-size:12px;margin-left:-10px;">
                                                        <div class="card-header classA">A+</div>
                                                        <div class="card-body text-dark">
                                                            <div class="col-12 text-center classtext">
                                                                <?= number_format(879) ?>
                                                            </div>
                                                            <hr>
                                                            <div class="col-12 text-dark text-center pt-10">
                                                                <?= number_format(35) ?>%
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-12">
                                                    <div class="card" style="width: 4rem;font-size:12px;margin-left:-10px;">
                                                        <div class="card-header classA">A+</div>
                                                        <div class="card-body text-dark">
                                                            <div class="col-12 text-center classtext">
                                                                <?= number_format(879) ?>
                                                            </div>
                                                            <hr>
                                                            <div class="col-12 text-dark text-center pt-10">
                                                                <?= number_format(35) ?>%
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-4col-sm-4 col-12">
                                                    <div class="card" style="width: 3.9rem;font-size:12px;margin-left:-10px;">
                                                        <div class="card-header classA">A+</div>
                                                        <div class="card-body text-dark">
                                                            <div class="col-12 text-center classtext">
                                                                <?= number_format(879) ?>
                                                            </div>
                                                            <hr>
                                                            <div class="col-12 text-dark text-center pt-10">
                                                                <?= number_format(35) ?>%
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6 col-12 alert alert-Evaluator scrollbar-salaryallowanec" id="salary_scrollbar">
                                            <div class="row ">
                                                <div class="col-6">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="clickAllowance">
                                                        <label class="form-check-label colorAllowance" for="inlineCheckbox1">Allowance</label>
                                                    </div>
                                                </div>
                                                <div class="col-6 text-end cursor_AddLayer">
                                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Add-Layer.png" class="accordionAddLayer"><span class="addleyer"> Add</span>
                                                </div>
                                            </div>
                                            <div class="col-12 p-2 alert alert-ffff">
                                                <div class="row">
                                                    <div class="col-lg-7">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" value="Allowance2" id="">
                                                            <label class="form-check-label Qualification-Allowance" for=""> Qualification Allowance </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 Allowance2-solid">
                                                        <?= number_format(1000) ?>
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <img src="/HRVC/frontend/web/images/icons/Dark/48px/deletered.png" class="DeleteRound1">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 p-2 alert alert-ffff">
                                                <div class="row">
                                                    <div class="col-lg-7">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" value="Allowance2" id="">
                                                            <label class="form-check-label Qualification-Allowance" for=""> Food Allowance </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 Allowance2-solid">
                                                        <?= number_format(250) ?>
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <img src="/HRVC/frontend/web/images/icons/Dark/48px/deletered.png" class="DeleteRound1">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 p-2 alert alert-ffff">
                                                <div class="row">
                                                    <div class="col-lg-7">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" value="Allowance2" id="">
                                                            <label class="form-check-label Qualification-Allowance" for=""> Travelling Allowance </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 Allowance2-solid">
                                                        <?= number_format(1200) ?>
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <img src="/HRVC/frontend/web/images/icons/Dark/48px/deletered.png" class="DeleteRound1">
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
    </div>
</div>