<?php

$this->title = 'Weight Allocation';

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
                        <div class="col-4 FrameEvaluation">
                            <i class="fa fa-bar-chart font-size-14" aria-hidden="true"></i> Key Financial Indicator
                        </div>
                        <div class="col-2">
                            <div type="submit" class="PMI1"> <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/save-2.png" class="Save-2"> APPLY SAVE</div>
                        </div>
                        <div class="col-6 text-end">
                            <div type="submit" class="btn btn-primary pt-3 pb-3 font-size-13"><i class="fa fa-th-large text-white" aria-hidden="true"></i>&nbsp; KFI Dashboard</div>
                        </div>
                    </div>
                    <div class="row pt-20">
                        <div class="col-3">
                            <div class="col-12">
                                <span class="text-danger">*</span><span class="font-size-13">Achievement Target Setup</span>
                            </div>
                            <div class="col-12 font-size-10 pl-5">
                                Do You Want Level 3 As Default Target ?
                            </div>
                        </div>
                        <div class="col-2 pt-15">
                            <input type="radio" name="fruit"><span class="font-size-11"> YES</span>
                            <span class="pl-12"></span>
                            <input type="radio" name="fruit" onclick="javascript:showclickno()"><span class="font-size-11"> NO</span>
                        </div>
                        <div class="col-6 custom_bottom" id="showlevel">
                            <div class="col-12">
                                Choose Target Level <input type="radio" name="fruit"><span class="target_level"> Level1</span>&nbsp;<input type="radio" name="fruit"><span class="target_level"> Level2</span>
                                &nbsp;<input type="radio" name="fruit"><span class="target_level"> Level3</span>&nbsp;<input type="radio" name="fruit"><span class="target_level"> Level4</span> <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/save-trck.png" class="save-trck">
                            </div>
                        </div>
                        <div class="col-7 pt-15 text-end">
                            <div class="row">
                                <div class="col-10">
                                    <div class="col-12 font-size-12 text-end">
                                        Allocate percentage to all the selected
                                    </div>
                                    <div class="col-12 font-size-12 text-end">
                                        KFI contents to continue
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="procresscircle_deg">100%</div>
                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Wornning-blue.png" class="wb-progress">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <?php
                    for ($i = 1; $i <= 5; $i++) {
                    ?>

                        <div class="row">
                            <div class="col-1">
                                <label class="checkbox style-c">
                                    <input type="checkbox" />
                                    <div class="checkbox__checkmark"></div>
                                    <div class="checkbox__body"></div>
                                </label>
                            </div>
                            <div class="col-11 level_setup">
                                <div class="row">
                                    <div class="col-2 border-right pt-5 pl-12">
                                        <span class="set_PL">PL</span>
                                        <span class="font-size-11"> Gross Profit Ratio</span>
                                    </div>
                                    <div class="col-1 border-right">
                                        <div class="col-12 text-secondary font-size-11 text-center">
                                            Target
                                        </div>
                                        <div class="col-12 font-size-10 pt-3 text-secondary font-b text-center">
                                            <?= number_format(5846852) ?>
                                        </div>
                                    </div>
                                    <div class="col-2 pr-25" style="margin-left:5px;">
                                        <label class="checkbox style-f">
                                            <input type="checkbox" />
                                            <div class="checkbox__checkmark"></div>
                                            <div class="checkbox__body"></div>
                                        </label>
                                        <div class="input-group" style="margin-top: -16px;margin-left:5px;">
                                            <span class=" input-group-text Level-txt" id="inputGroup-sizing-sm">Level 1</span>
                                            <input type="text" class="form-control Level-txtinput" aria-label="Sizing example input">
                                        </div>
                                    </div>
                                    <div class="col-2 pr-25" style="margin-left:-10px;">
                                        <label class="checkbox style-f">
                                            <input type="checkbox" />
                                            <div class="checkbox__checkmark"></div>
                                            <div class="checkbox__body"></div>
                                        </label>
                                        <div class="input-group" style="margin-top: -16px;margin-left:5px;">
                                            <span class="input-group-text Level-txt" id="inputGroup-sizing-sm">Level 2</span>
                                            <input type="text" class="form-control Level-txtinput" aria-label="Sizing example input">
                                        </div>
                                    </div>
                                    <div class="col-2 pr-25" style="margin-left:-10px;">
                                        <label class="checkbox style-f">
                                            <input type="checkbox" />
                                            <div class="checkbox__checkmark"></div>
                                            <div class="checkbox__body"></div>
                                        </label>
                                        <div class="input-group" style="margin-top: -16px;margin-left:5px;">
                                            <span class=" input-group-text Level-txt" id="inputGroup-sizing-sm">Level 3</span>
                                            <input type="text" class="form-control Level-txtinput" aria-label="Sizing example input">
                                        </div>
                                    </div>
                                    <div class="col-2 border-right pr-25" style="margin-left:-10px;">
                                        <label class="checkbox style-f">
                                            <input type="checkbox" />
                                            <div class="checkbox__checkmark"></div>
                                            <div class="checkbox__body"></div>
                                        </label>
                                        <div class="input-group" style="margin-top: -16px;margin-left:5px;">
                                            <span class=" input-group-text Level-txt" id="inputGroup-sizing-sm">Level 4</span>
                                            <input type="text" class="form-control Level-txtinput" aria-label="Sizing example input">
                                        </div>
                                    </div>
                                    <div class="col-1 pt-8 all_allocate-show-weight">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/setting(Round).png" class="setting_png"> Weight
                                        <input class="form-control weight_round" type="text" placeholder="25%">
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