<?php

$this->title = 'Salary Edit';
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
                <div class="col-12 FrameSalaryAllowance">
                    Salary & Allowance
                </div>
                <div class="bg-Salary-edit">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-3 col-6">
                            <div class="col-12">
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Vector.png" class="pictureDepartment-salary-edit"> <span class="accounts-edit1">Accounts & Taxation</span>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-3 col-6">
                            <div class="col-12 text-end">
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Rank-blue.png" class="accordion-rank1-edit"> &nbsp;<span class="accounts-edit1"> Junior Executive</span> &nbsp; <span class="badge rounded-pill bg-primary-MM">LM</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="alert-F6F6F66">
                    <div class="col-12 edit-Range">
                        Range
                    </div>
                    <div class="row classmarginminimum">
                        <div class="col-12 salaryedit-Allminimumsolid"></div>
                        <div class="col-lg-2 col-md-6 col-2">
                            <div class="Minimum-0"> Minimum <span class="text-308FFF">0%</span> </div>
                            <div class="card roundedborderedit">
                                <?= number_format(13782) ?>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-6 col-2">
                            <div class="Minimum-0"> Low <span class="text-308FFF">25%</span></div>
                            <div class="card roundedborderedit">
                                <?= number_format(13782) ?>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-6 col-2">
                            <div class="Minimum-0"> Medium <span class="text-308FFF">50%</span></div>
                            <div class="card roundedborderedit">
                                <?= number_format(13782) ?>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-6 col-2">
                            <div class="Minimum-0"> Hight <span class="text-308FFF">75%</span></div>
                            <div class="card roundedborderedit">
                                <?= number_format(13782) ?>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-6 col-2">
                            <div class="Minimum-0"> Max <span class="text-308FFF">100%</span></div>
                            <div class="card roundedborderedit">
                                <?= number_format(13782) ?>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-6 col-2 Sample-worrning">
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Wornning-blue.png" class="images-wornningblue"> Sample Range
                        </div>
                        <div class="row">
                            <div class="col-lg-2 col-md-6 col-2">
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/U-turn.png" class="imagesU-turn">
                            </div>
                            <div class="col-lg-2 col-md-6 col-2 clsddMinimum">
                                Minimum <span class="text-308FFF"> 0% </span>
                            </div>
                            <div class="col-lg-2 col-md-5 col-2">
                                <input type="text" class="form-control formsMinimum">
                            </div>
                            <div class="col-lg-2 col-md-6 col-2">
                                <input type="text" class="form-control formsMinimum">
                            </div>
                            <div class="col-lg-2 col-md-6 col-2 classMax">
                                Max <span class="text-308FFF"> 100% </span>
                            </div>
                            <div class="col-lg-2 col-md-6 col-2">
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/U-trun2.png" class="imagesU-turn2">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="alert-F6F6F66">
                    <div class="col-12 edit-Range">
                        Rank & Salary Increment
                    </div>
                    <div class="row">
                        <div class="col-lg-2 col-md-6 col-2">
                            <div class="col-12 score-salaryedit">
                                score
                            </div>
                            <div class="col-12 Increment-salaryedit">
                                Bonus Increment %
                            </div>
                        </div>
                        <?php
                        for ($i = 1; $i <= 10; $i++) {
                        ?>
                            <div class="col-lg-1 col-md-6 col-2 set-mrg-salaryedit1">
                                <div class="col-1 header-salaryedit">
                                    F
                                </div>&nbsp;
                                <div class="col-1">
                                    <input type="text" class="form-control number-salaryedit" id="" placeholder="879">
                                </div>
                                <div class="col-1 width-lineblock">
                                    <div class="linesalaryEdit1"></div>
                                    <div style="display: inline-block;font-size:11px;"><img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/uploadlink.png" class="images-linesalaryEdit1"></div>
                                    <div class="linesalaryEdit2"></div>
                                </div>
                                <div class="col-1">
                                    <input type="text" class="form-control number-salaryedit2" id="" placeholder="35%" disabled>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
                <div class="col-12 text-end mt-10">
                    <button class="btn btn-primary rounded-1 font-308FFF" type="submit"><img src="/HRVC/frontend/web/images/icons/Dark/48px/save.png" class="images-bonuesave">&nbsp; SAVE</button>
                </div>
            </div>
        </div>
    </div>
</div>