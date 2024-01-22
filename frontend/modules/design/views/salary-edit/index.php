<?php

$this->title = 'Salary Edit';
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
                                <div class="rad-text" type cunbmibt> Promotion</div>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-9 col-md-6 col-12">
            <div class="alert aler-ALLDepartment">
                <div class="col-12 FrameSalaryAllowance">
                    Salary & Allowance
                </div>
                <div class="alert alert-Evaluator mt-20">
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
                <div class="alert alert-F6F6F66">
                    <div class="col-12 edit-Range">
                        Range
                    </div>
                    <div class="row classmarginminimum">
                        <div class="col-12 salaryedit-Allminimumsolid"></div>
                        <div class="col-lg-2 col-md-6 col-6">
                            <div class="Minimum-0"> Minimumd <span class="text-308FFF">0%</span> </div>
                            <div class="card roundedborderedit">
                                <?= number_format(13782) ?>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-6 col-6">
                            <div class="Minimum-0"> Low <span class="text-308FFF">25%</span></div>
                            <div class="card roundedborderedit">
                                <?= number_format(13782) ?>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-6 col-6">
                            <div class="Minimum-0"> Medium <span class="text-308FFF">50%</span></div>
                            <div class="card roundedborderedit">
                                <?= number_format(13782) ?>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-6 col-6">
                            <div class="Minimum-0"> Hight <span class="text-308FFF">75%</span></div>
                            <div class="card roundedborderedit">
                                <?= number_format(13782) ?>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-6 col-6">
                            <div class="Minimum-0"> Max <span class="text-308FFF">100%</span></div>
                            <div class="card roundedborderedit">
                                <?= number_format(13782) ?>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-6">
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/U-turn.png" class="imagesU-turn">
                        </div>
                        <div class="col-lg-2 col-md-6 col-6 clsddMinimum">
                            Minimum <span class="text-308FFF"> 0% </span>
                        </div>
                        <div class="col-lg-2 col-md-6 col-6">
                            <input type="number" class="form-control formsMinimum">
                        </div>
                        <div class="col-lg-2 col-md-6 col-6">
                            <input type="number" class="form-control formsMinimum">
                        </div>
                        <div class="col-lg-2 col-md-6 col-6 classMax">
                            Max <span class="text-308FFF"> 100% </span>
                        </div>
                        <div class="col-lg-2 col-md-6 col-6">
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/U-trun2.png" class="imagesU-turn2">
                        </div>
                        <div class="col-lg-3 col-md-6 col-6 Sample-worrning">
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Wornning-blue.png" class="images-wornningblue"> Sample Range
                        </div>
                    </div>
                </div>
                <div class="alert alert-F6F6F66">
                    <div class="col-12 edit-Range">
                        Rank & Salary Increment
                    </div>
                    <div class="row">
                        <div class="col-lg-2 col-md-6 col-6">
                            <div class="col-12 score-salaryedit">
                                score
                            </div>
                            <div class="col-12 Increment-salaryedit">
                                Bonus Increment %
                            </div>
                        </div>
                        <div class="col-lg-1 col-md-6 col-6 set-mrg-salaryedit1">
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
                        <div class="col-lg-1 col-md-6 col-6 set-mrg-salaryedit1">
                            <div class="col-1 header-salaryedit">
                                E
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
                        <div class="col-lg-1 col-md-6 col-6 set-mrg-salaryedit1">
                            <div class="col-1 header-salaryedit">
                                D
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
                        <div class="col-lg-1 col-md-6 col-6 set-mrg-salaryedit1">
                            <div class="col-1 header-salaryedit">
                                C
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
                        <div class="col-lg-1 col-md-6 col-6 set-mrg-salaryedit1">
                            <div class="col-1 header-salaryedit">
                                B
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
                        <div class="col-lg-1 col-md-6 col-6 set-mrg-salaryedit1">
                            <div class="col-1 header-salaryedit">
                                B+
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
                        <div class="col-lg-1 col-md-6 col-6 set-mrg-salaryedit1">
                            <div class="col-1 header-salaryedit">
                                A
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
                        <div class="col-lg-1 col-md-6 col-6 set-mrg-salaryedit1">
                            <div class="col-1 header-salaryedit">
                                S-
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
                        <div class="col-lg-1 col-md-6 col-6 set-mrg-salaryedit1">
                            <div class="col-1 header-salaryedit">
                                S+
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
                        <div class="col-lg-1 col-md-6 col-6 set-mrg-salaryedit1">
                            <div class="col-1 header-salaryedit">
                                SS
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
                    </div>
                </div>
                <div class="col-12 text-end">
                    <button class="btn btn-primary rounded-1 font-308FFF" type="submit"><img src="/HRVC/frontend/web/images/icons/Dark/48px/save.png" class="images-bonuesave">&nbsp; SAVE</button>
                </div>
            </div>
        </div>
    </div>
</div>