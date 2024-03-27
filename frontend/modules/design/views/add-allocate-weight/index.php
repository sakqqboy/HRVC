<?php
$this->title = 'Add allocate weight';
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
                <div class="row">
                    <div class="col-3">
                        <div class="WeightConfigurationName"> Weight Configuration Name</div>
                    </div>
                    <div class="col-4">
                        <input type="text" class="form-control pt-3 pb-3 font-size-14 text-secondary" id="" aria-describedby="" style="border-radius: 3px;">
                    </div>
                    <div class="col-5 text-end">
                        <div type="submit" class="btn btn-primary PMI1"><img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/save-2.png" class="Save-2">&nbsp;&nbsp; SAVE</div>
                    </div>
                </div>
                <div class="row mt-10">
                    <div class="col-lg-2 Participants_border">
                        <div class="col-12 pt-20 pl-3 pr-3">
                            <div class="bg-white pl-5 pr-5" style="border-radius: 3px;">
                                <div class="col-12">
                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/24px/Team-1.png" class="widthSave-3"> <span class="Select-add">Select Participants</span></span>
                                </div>
                                <div class="row mt-10">
                                    <div class="col-lg-4 col-md-6 col-6">
                                        <div class="font-size-10">
                                            <div class="put_title"><span class="pl-15">Title</span></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-8 col-md-6 col-6">
                                        <div class="form-check font-size-10">
                                            <input class="form-check-input" type="checkbox" value="" id="">
                                            <label class="form-check-label" for="">
                                                Dapartment
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 controlcheckboxSelect">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="">
                                <label class="form-check-label" for="">
                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Rank-1.png" class="pictureRank-1"> Manager <span class="badge rounded-pill bg-primary">MM</span>
                                </label>
                            </div>
                        </div>

                        <?php

                        for ($i = 1; $i <= 7; $i++) {

                        ?>

                            <div class="col-12 all-allocateuser">
                                <div class="form-check">
                                    <input class="form-check-input Accountsborderdark" type="checkbox" value="" id="">
                                    <label class="form-check-label label-username" for="">
                                        <img src="<?= Yii::$app->homeUrl ?>image/Watanabe.png" class="allocate-user"> <span style="font-size: 8px; letter-spacing: -0.1px;">Charles Bhattacharjya</span>
                                    </label>
                                </div>
                            </div>

                        <?php
                        }
                        ?>

                        <div class="col-12 controlcheckboxSelect">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="">
                                <label class="form-check-label" for="">
                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Rank-1.png" class="pictureRank-1"> Assistant Manager<span class="badge rounded-pill bg-primary">MM</span>
                                </label>
                            </div>
                        </div>
                        <?php

                        for ($i = 1; $i <= 5; $i++) {

                        ?>

                            <div class="col-12 all-allocateuser">
                                <div class="form-check">
                                    <input class="form-check-input Accountsborderdark" type="checkbox" value="" id="">
                                    <label class="form-check-label label-username" for="">
                                        <img src="<?= Yii::$app->homeUrl ?>image/Watanabe.png" class="allocate-user"> <span style="font-size: 8px; letter-spacing: -0.1px;">Charles Bhattacharjya</span>
                                    </label>
                                </div>
                            </div>

                        <?php
                        }
                        ?>

                    </div>
                    <div class="col-lg-1 col-md-6 col-12">
                        <div class="add_allocate_gray pt-5">
                            <div class="col-12 text_PIM">
                                PIM
                            </div>
                            <div class="col-12">
                                <div id="progress1">
                                    <div data-num="85" class="progress-item1" data-value="85%" style="background: conic-gradient(rgb(41, 140, 233) calc(35%), rgb(219, 239, 247) 0deg);width: 35px;height:35px;">85%</div>
                                </div>
                            </div>
                            <div class="white-kfi3">
                                <div class="col-12 pt-30">
                                    <div class="form-check pl-43">
                                        <input class="form-check-input" type="checkbox" value="" id="">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="bg-chartpurple">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Light/Light/48px/Charts.png" class="icons-KGI">
                                        <div class="font-size-10 text-white font-b"> KFI</div>
                                        <div class="font-size-10 text-white font-b">20%</div>
                                    </div>
                                </div>
                                <div class="col-12 mt-30">
                                    <div class="form-check pl-43">
                                        <input class="form-check-input" type="checkbox" value="" id="">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="bg-chartwarn">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Light/Light/48px/KGI.png" class="icons-KGI">
                                        <div class="font-size-10 text-white font-b"> KGI</div>
                                        <div class="font-size-10 text-white font-b">20%</div>
                                    </div>
                                </div>
                                <div class="col-12 mt-30">
                                    <div class="form-check pl-43">
                                        <input class="form-check-input" type="checkbox" value="" id="">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="bg-cha">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Light/Light/48px/KPI.png" class="icons-KGI">
                                        <div class="font-size-10 text-white font-b"> KPI</div>
                                        <div class="font-size-10 text-white font-b">20%</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-6 col-12">
                        <div class="add_allocate1 silly_scrollbar">
                            <div class="silly_evaluator">
                                <div class="row pl-15 pr-15 pt-15 pb-15">
                                    <div class="col-4 flagkey">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/24px/KGI.png" class="icons-KGI2"> Key Goal Indicator
                                    </div>
                                    <div class="col-2">
                                        <div class="ADD-plus1-allocate" type="submit">
                                            <a href="<?= Yii::$app->homeUrl ?>designfront/allocate-show" class="no-underline"><i class="fa fa-plus-circle" aria-hidden="true"></i>&nbsp;ADD</a>
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="Edit-plus1-allocate" type="submit">
                                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i> &nbsp;EDIT
                                        </div>
                                    </div>
                                    <div class="col-1">
                                        <div class="col-12  AddParticipant">
                                            Participants
                                        </div>
                                    </div>
                                    <div class="col-3 text-end">
                                        <span class="badge rounded-pill bg-gray pt-2 pb-2">
                                            <ul class="try-cricle">
                                                <li class="tri-li"> <img src="<?= Yii::$app->homeUrl ?>image/avatar1.png" class="image-avatar1"></li>
                                                <li class="tri-li"> <img src="<?= Yii::$app->homeUrl ?>image/Watanabe.png" class="image-avatar2"></li>
                                                <a href="" class="none">
                                                    <li class="number_user"> 99 </li>
                                                </a>
                                            </ul>
                                        </span>
                                    </div>
                                    <hr class="mt-5">
                                </div>

                                <div class="row pl-15 pr-10 pb-20">

                                    <?php
                                    for ($i = 1; $i <= 12; $i++) {
                                    ?>

                                        <div class="col-lg-2">
                                            <div class="card font-size-12">
                                                <div class="card-header fonTotal pl-2 pr-2">
                                                    Totalsales <span class="ml-15"><i class="fa fa-minus-circle add-minus-circle" aria-hidden="true"></i></span>
                                                </div>
                                                <div class="col-12 text-center">
                                                    <span class="badge bg-lighttotal">
                                                        <?= number_format(5888) ?>k
                                                    </span>
                                                </div>
                                                <div class="col-12 text-center pt-10 Blueformat">
                                                    <?= number_format(23) ?>%
                                                </div>
                                            </div>
                                        </div>

                                    <?php
                                    }
                                    ?>
                                    <div class="holder"></div>

                                </div>
                            </div>
                            <div class="silly_evaluator mt-20">
                                <div class="row pl-15 pr-15 pt-15 pb-15">
                                    <div class="col-4 flagkey">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/24px/KPI.png" class="icons-KGI2"> Key Performance Indicator
                                    </div>
                                    <div class="col-2">
                                        <div class="ADD-plus1-allocate" type="submit">
                                            <a href="<?= Yii::$app->homeUrl ?>designfront/allocate-show" class="no-underline"><i class="fa fa-plus-circle" aria-hidden="true"></i>&nbsp;ADD</a>
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="Edit-plus1-allocate" type="submit">
                                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>&nbsp;EDIT
                                        </div>
                                    </div>
                                    <div class="col-1">
                                        <div class="col-12 AddParticipant">
                                            Participants
                                        </div>
                                    </div>
                                    <div class="col-3 text-end">
                                        <span class="badge rounded-pill bg-gray pt-2 pb-2">
                                            <ul class="try-cricle">
                                                <li class="tri-li"> <img src="<?= Yii::$app->homeUrl ?>image/avatar1.png" class="image-avatar1"></li>
                                                <li class="tri-li"> <img src="<?= Yii::$app->homeUrl ?>image/Watanabe.png" class="image-avatar2"></li>
                                                <a href="" class="none">
                                                    <li class="number_user"> 2 </li>
                                                </a>
                                            </ul>
                                        </span>
                                    </div>
                                    <hr class="mt-5">
                                </div>

                                <div class="row pl-15 pr-10 pb-20">

                                    <?php
                                    for ($i = 1; $i <= 12; $i++) {
                                    ?>

                                        <div class="col-lg-2">
                                            <div class="card font-size-12">
                                                <div class="card-header fonTotal pl-2 pr-2">
                                                    Totalsales <span class="ml-15"><i class="fa fa-minus-circle add-minus-circle" aria-hidden="true"></i></span>
                                                </div>
                                                <div class="col-12 text-center">
                                                    <span class="badge bg-lighttotal">
                                                        <?= number_format(5888) ?>k
                                                    </span>
                                                </div>
                                                <div class="col-12 text-center pt-10 Blueformat">
                                                    <?= number_format(23) ?>%
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                    }
                                    ?>
                                    <div class="holder"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>