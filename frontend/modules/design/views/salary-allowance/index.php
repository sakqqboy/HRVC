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
                                <div class="rad-text"> Bonus calculation</div>
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
                            <div class="all">
                                <div class="accordion">Website Analytics and Performance</div>
                            </div>
                            <div class="accordion-content">
                                <hr>
                                <p>
                                    We believe that in order to have a successful website, you need to constantly adjust and adapt to the data provided by your website visitors. Here at Pierre Web Development, we have narrowed down the specific key performance indicators that will dramatically boost your success with connecting to target markets. We will provide a basic metric dashboard based on how much traffic your site gets, detailed analytical reports that show which parts of your website is the most popular among visitors as well as access to tools you can use to make meaningful decisions based on this data.
                                </p>
                            </div>

                            <div class="mt-10"></div>
                            <button class="accordion">Digital Marketing</button>
                            <div class="accordion-content">
                                <hr>
                                <p>
                                    We know that every great website focuses on helping you get more business and building a brand that your ideal customers will love and support. We can help you set up a great, SEO-focused content strategy, a paid ads campaign, email marketing integration with Mailchimp as well as a social media marketing campaign. We also use popular website analytic tools to track your site's performance and provide you with weekly analytic reports to help bolster your growth.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>