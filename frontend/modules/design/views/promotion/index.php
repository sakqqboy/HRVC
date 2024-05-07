<?php

use Faker\Core\Number;

$this->title = 'Promotion';
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
                        <div class="col-lg-3 col-md-6 col-6">
                            <div class="col-12  FrameSalaryAllowance">
                                Promotion Indicator
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-6 col-6">
                            <div class="col-12">
                                <div class="col-12 FrameSalaryAllowance">
                                    <button class="btn btn-primary bonussubmit" type="submit">Create New</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-7 col-md-6 col-6 text-end">
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/FilterPlus.png" class="picture-FilterPlus-bonus"> <strong class="font-size-13">More</strong> <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/3Dot.png" class="bonus-point">
                        </div>
                    </div>
                    <div class="col-12 BGPromotion">
                        <div class="row">
                            <div class="col-3">
                                <div class="col-12 BGPhase">
                                    <span class="font-Blu">E3</span><span class="b4E3"> Final Evaluation Phase</span>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="position-relative m-3">
                                    <div class="progress" style="height: 1px;">
                                        <div class="progress-bar" role="progressbar" style="width: 50%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <button type="button" class="position-absolute top-0 start-0 translate-middle btn btn-sm btn-primary rounded-pill" style="width: 2rem; height:2rem;">E1</button>
                                    <button type="button" class="position-absolute top-0 start-50 translate-middle btn btn-sm btn-primary rounded-pill" style="width: 2rem; height:2rem;">E2</button>
                                    <button type="button" class="position-absolute top-0 start-100 translate-middle btn btn-sm btn-secondary rounded-pill" style="width: 2rem; height:2rem;">E3</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="row">
                        <div class="col-lg-3 col-md-6 col-12">
                            <div class="PROMO-SET">
                                <div class="col-12 setpromotion-light">
                                    <span><img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/24px/Team-1.png" class="widthSave-3"> <span class="Select-add">Select Participants</span></span>
                                    <div class="row mt-5">
                                        <div class="col-lg-6 col-md-6 col-6">
                                            <div class="promotioncolortitle"></div> <span class="fnt-promotiontitle">Title</span>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-6">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
                                                <label class="form-check-label inlineDepartment1" for="inlineCheckbox1"> Department</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 controlcheckboxSelect">
                                    <div class="form-check E2F5FF-border">
                                        <input class="form-check-input" type="checkbox" value="" id="">
                                        <label class="form-check-label promotionbox-manager" for="defaultCheck">
                                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Rank-1.png" class="pictureRank-1"> Manager <span class="badge rounded-pill bg-primary promotionMM">MM</span>
                                        </label>
                                    </div>
                                </div>

                                <?php
                                for ($i = 1; $i <= 5; $i++) {
                                ?>

                                    <div class=" col-12 all-allocateuser">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                            <label class="form-check-label label-username" for="flexCheckDefault">
                                                <img src="<?= Yii::$app->homeUrl ?>image/Watanabe.png" class="allocate-user"> Charles Bhattacharjya
                                            </label>
                                        </div>
                                    </div>

                                <?php
                                }
                                ?>

                                <div class="col-12 controlcheckboxSelect">
                                    <div class="form-check E2F5FF-border">
                                        <input class="form-check-input" type="checkbox" value="" id="">
                                        <label class="form-check-label promotionbox-manager" for="defaultCheck">
                                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Rank-1.png" class="pictureRank-1"> Assistant Manager <span class="badge rounded-pill bg-primary promotionMM">MM</span>
                                        </label>
                                    </div>
                                </div>

                                <?php
                                for ($i = 1; $i <= 5; $i++) {
                                ?>

                                    <div class=" col-12 all-allocateuser">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                            <label class="form-check-label label-username" for="flexCheckDefault">
                                                <img src="<?= Yii::$app->homeUrl ?>image/Watanabe.png" class="allocate-user"> Charles Bhattacharjya
                                            </label>
                                        </div>
                                    </div>

                                <?php
                                }
                                ?>

                                <div class="col-12 controlcheckboxSelect">
                                    <div class="form-check E2F5FF-border">
                                        <input class="form-check-input" type="checkbox" value="" id="">
                                        <label class="form-check-label promotionbox-manager" for="defaultCheck">
                                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Rank-1.png" class="pictureRank-1"> Junior Excutive <span class="badge rounded-pill bg-primary promotionMM">MM</span>
                                        </label>
                                    </div>
                                </div>

                                <?php
                                for ($i = 1; $i <= 3; $i++) {
                                ?>

                                    <div class="col-12 all-allocateuser">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                            <label class="form-check-label label-username" for="flexCheckDefault">
                                                <img src="<?= Yii::$app->homeUrl ?>image/Watanabe.png" class="allocate-user"> Charles Bhattacharjya
                                            </label>
                                        </div>
                                    </div>

                                <?php
                                }
                                ?>

                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-12">
                            <div class="row">
                                <div class="col-4 set-Promotion">
                                    Set Promotion title
                                </div>
                                <div class="col-5">
                                    <input type="text" class="form-control setpromotiontitle" value="" id="">
                                </div>
                                <div class="col-3 text-end">
                                    <button class="btn btn-primary rounded-1 font-FFFsave" type="submit"><img src="<?= Yii::$app->homeUrl ?>/images/icons/Dark/48px/save.png" class="images-bonuesave0"> SAVE</button>
                                </div>
                            </div>

                            <div class="col-12 borderprotiongry">
                                <div class="alert-light">
                                    <div class="col-12">
                                        <span class="Promotion-Contents"> Promotion Contents</span> <i class="fa fa-plus-square-o PromotionAdd-Layer"></i>
                                    </div>
                                    <div class="col-12 PromotionSolid">
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-sm-4 col-6">
                                                <div class="form-check input-promotion-checkbox1">
                                                    <input class="form-check-input" type="checkbox" value="" id="defaultCheck">
                                                    <label class="form-check-label" for="defaultCheck1">
                                                        KPI Score more than 40 3 times continues
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-4 col-12 text-end">
                                                <div class="badge bg-conditionSet">Condition Set</div>
                                            </div>
                                            <div class="col-lg-1 col-md-6 col-sm-4 col-6">
                                                <i class="fa fa-edit Promotion-Edit"></i>
                                            </div>
                                            <div class="col-lg-1 col-md-6 col-sm-4 col-6">
                                                <i class="fa fa-trash Promotiontrash-danger" aria-hidden="true"></i>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-4 col-6">
                                                <div class="form-check input-promotion-checkbox1">
                                                    <input class="form-check-input" type="checkbox" value="" id="defaultCheck">
                                                    <label class="form-check-label" for="defaultCheck1">
                                                        Skill Checking
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-4 col-12 text-end">
                                                <div class="badge bg-conditionSetdanger">Condition Not Set</div>
                                            </div>
                                            <div class="col-lg-1 col-md-6 col-sm-4 col-6">
                                                <i class="fa fa-edit Promotion-Edit"></i>
                                            </div>
                                            <div class="col-lg-1 col-md-6 col-sm-4 col-6">
                                                <i class="fa fa-trash Promotiontrash-danger" aria-hidden="true"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-12">
                            <div class="PROMO-SET">
                                <span class="col-12 Set-Contents-Promotion">Set Contents</span> <span class="Weighttxtprimary">Weight</span>
                                <span class="Weighttxtprimary">Achievement</span>
                                <div class="bg-white mt-10 pb-5 pl-5 pr-5">
                                    <div class="alert aler-ALLDepartment">
                                        <div class="row">
                                            <div class="col-2 Pro-p1">
                                                P1
                                            </div>
                                            <div class="col-1 p1solid"></div>
                                            <div class="col-2 Pro-p1">
                                                40%
                                            </div>
                                            <div class="col-1 p1solid"></div>
                                            <div class="col-2 Pro-p1">
                                                60%
                                            </div>
                                            <hr class="positionp1">
                                        </div>
                                    </div>
                                    <div class="col-12 bg-ht">
                                        <div class="row">
                                            <div class="col-6 text-center">
                                                <div class="col-12 TOTAL-WEIGHT">
                                                    TOTAL WEIGHT
                                                </div>
                                                <div class="col-12">
                                                    <div class="font-size-13"><?= number_format(100) ?>%</div>
                                                </div>
                                            </div>
                                            <div class="col-6 text-center">
                                                <div class="col-12 TOTAL-WEIGHT">
                                                    TOTAL ACHIEVEMENT
                                                </div>
                                                <div class="col-12">
                                                    <div class="font-size-13"><?= number_format(70) ?>%</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-20">
                    <table class="table table-light">
                        <td>
                            Title
                        </td>
                        <td>
                            Promotion Contents
                        </td>
                        <td>
                            Achievement
                        </td>
                        <td>
                            Weight
                        </td>
                    </table>
                </div>
                <table class="table table-primary mt-10">
                    <thead>
                        <tr>
                            <td scope="col"><img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/rankb.png" class="wdranks"> Manager <span class="badge bg-primary">MM</span></td>
                            <td>
                                <table class="table table-light">
                                    <td>
                                        <span class="font-size-11">KPI Score more than 40 3 times continues</span>
                                        <span class="checkbox-wrapper-33">
                                            <label class="checkbox">
                                                <input class="checkbox__trigger visuallyhidden" type="checkbox" />
                                                <span class="checkbox__symbol">
                                                    <svg aria-hidden="true" class="icon-checkbox" width="28px" height="28px" viewBox="0 0 28 28" version="1" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M4 14l8 7L24 7"></path>
                                                    </svg>
                                                </span>
                                                <p class="checkbox__textwrapper">Times</p>
                                            </label>
                                        </span>
                                    </td>
                                    <td>
                                        40%
                                    </td>
                                    <td>
                                        60%
                                    </td>
                                    <td>
                                        <i class="fa fa-save"></i> <i class="fa fa-edit"></i>
                                    </td>
                                    <style>
                                        .checkbox-wrapper-33 {
                                            --s-xsmall: 0.625em;
                                            --s-small: 1.2em;
                                            --border-width: 1px;
                                            --c-primary: #308FFF;
                                            --c-primary-20-percent-opacity: rgb(95 17 232 / 20%);
                                            --c-primary-10-percent-opacity: rgb(95 17 232 / 10%);
                                            --t-base: 0.4s;
                                            --t-fast: 0.2s;
                                            --e-in: ease-in;
                                            --e-out: cubic-bezier(.11, .29, .18, .98);
                                        }

                                        .checkbox-wrapper-33 .visuallyhidden {
                                            border: 0;
                                            clip: rect(0 0 0 0);
                                            height: 1px;
                                            margin: -1px;
                                            overflow: hidden;
                                            padding: 0;
                                            position: absolute;
                                            width: 1px;
                                        }

                                        .checkbox-wrapper-33 .checkbox {
                                            display: flex;
                                            align-items: center;
                                            justify-content: flex-start;
                                        }

                                        .checkbox-wrapper-33 .checkbox+.checkbox {
                                            margin-top: var(--s-small);
                                        }

                                        .checkbox-wrapper-33 .checkbox__symbol {
                                            display: inline-block;
                                            display: flex;
                                            margin-right: calc(var(--s-small) * 0.7);
                                            border: var(--border-width) solid var(--c-primary);
                                            position: relative;
                                            border-radius: 0.1em;
                                            width: 1em;
                                            height: 1em;
                                            transition: box-shadow var(--t-base) var(--e-out), background-color var(--t-base);
                                            box-shadow: 0 0 0 0 var(--c-primary-10-percent-opacity);
                                        }

                                        .checkbox-wrapper-33 .checkbox__symbol:after {
                                            content: "";
                                            position: absolute;
                                            top: 0.5em;
                                            left: 0.5em;
                                            width: 0.10em;
                                            height: 0.10em;
                                            background-color: var(--c-primary-20-percent-opacity);
                                            opacity: 0;
                                            border-radius: 3em;
                                            transform: scale(1);
                                            transform-origin: 50% 50%;
                                        }

                                        .checkbox-wrapper-33 .checkbox .icon-checkbox {
                                            width: 0.7em;
                                            height: 0.7em;
                                            margin: auto;
                                            fill: none;
                                            stroke-width: 3;
                                            stroke: currentColor;
                                            stroke-linecap: round;
                                            stroke-linejoin: round;
                                            stroke-miterlimit: 10;
                                            color: var(--c-primary);
                                            display: inline-block;
                                        }

                                        .checkbox-wrapper-33 .checkbox .icon-checkbox path {
                                            transition: stroke-dashoffset var(--t-fast) var(--e-in);
                                            stroke-dasharray: 30px, 31px;
                                            stroke-dashoffset: 31px;
                                        }

                                        .checkbox-wrapper-33 .checkbox__textwrapper {
                                            margin: 0;
                                        }

                                        .checkbox-wrapper-33 .checkbox__trigger:checked+.checkbox__symbol:after {
                                            -webkit-animation: ripple-33 1.5s var(--e-out);
                                            animation: ripple-33 1.5s var(--e-out);
                                        }

                                        .checkbox-wrapper-33 .checkbox__trigger:checked+.checkbox__symbol .icon-checkbox path {
                                            transition: stroke-dashoffset var(--t-base) var(--e-out);
                                            stroke-dashoffset: 0px;
                                        }

                                        .checkbox-wrapper-33 .checkbox__trigger:focus+.checkbox__symbol {
                                            box-shadow: 0 0 0 0.25em var(--c-primary-20-percent-opacity);
                                        }

                                        @-webkit-keyframes ripple-33 {
                                            from {
                                                transform: scale(0);
                                                opacity: 1;
                                            }

                                            to {
                                                opacity: 0;
                                                transform: scale(20);
                                            }
                                        }

                                        @keyframes ripple-33 {
                                            from {
                                                transform: scale(0);
                                                opacity: 1;
                                            }

                                            to {
                                                opacity: 0;
                                                transform: scale(20);
                                            }
                                        }
                                    </style>

                                </table>
                            </td>


                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>













<!-- <div class="col-12">
    <div class="row">
       
        <div class="col-lg-6 col-md-6 col-6">
          
            <div class="col-12">
                <div class="card alert-light mt-20">
                    <div class="col-12">
                        <span class="Promotion-Contents"> Promotion Contents</span> <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Add-Layer.png" class="PromotionAdd-Layer">
                    </div>
                    <div class="col-12 PromotionSolid">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-4 col-6">
                                <div class="form-check input-promotion-checkbox1">
                                    <input class="form-check-input" type="checkbox" value="" id="defaultCheck">
                                    <label class="form-check-label" for="defaultCheck1">
                                        KPI Score more than 40 3 times continues
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-4 col-12 text-end">
                                <div class="badge bg-conditionSet">Condition Set</div>
                            </div>
                            <div class="col-lg-1 col-md-6 col-sm-4 col-6">
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Edit.png" class="Promotion-Edit">
                            </div>
                            <div class="col-lg-1 col-md-6 col-sm-4 col-6">
                                <i class="fa fa-trash Promotiontrash-danger" aria-hidden="true"></i>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-4 col-6">
                                <div class="form-check input-promotion-checkbox1">
                                    <input class="form-check-input" type="checkbox" value="" id="defaultCheck">
                                    <label class="form-check-label" for="defaultCheck1">
                                        Skill Checking
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-4 col-12 text-end">
                                <div class="badge bg-conditionSetdanger">Condition Not Set</div>
                            </div>
                            <div class="col-lg-1 col-md-6 col-sm-4 col-6">
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Edit.png" class="Promotion-Edit">
                            </div>
                            <div class="col-lg-1 col-md-6 col-sm-4 col-6">
                                <i class="fa fa-trash Promotiontrash-danger" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-6">
            <div class="alert alert-Evaluator">
                <div class="col-12">
                    <span class="Evaluator-SetContents">Set Contents</span> <span class="badge bg-blue">Weight</span> <span class="badge bg-blue">Achievement</span>
                </div>
                <div class="mt-10">
                    <div class="alert aler-ALLDepartment">
                        <div class="row">
                            <div class="col-2 Pro-p1">
                                P1
                            </div>
                            <div class="col-1 p1solid"></div>
                            <div class="col-2 Pro-p1">
                                40%
                            </div>
                            <div class="col-1 p1solid"></div>
                            <div class="col-2 Pro-p1">
                                60%
                            </div>
                            <hr class="positionp1">
                        </div>
                        <div class="row" style="margin-top:-420px">
                            <div class="col-2 Pro-p1">
                                P2
                            </div>
                            <div class="col-1 p1solid"></div>
                            <div class="col-2 Pro-p1">
                                40%
                            </div>
                            <div class="col-1 p1solid"></div>
                            <div class="col-2 Pro-p1">
                                60%
                            </div>
                            <hr class="positionp1">
                        </div>
                        <div class="col-12 bg-ht">
                            <div class="row">
                                <div class="col-6">
                                    <div class="col-12 TOTAL-WEIGHT">
                                        TOTAL WEIGHT
                                    </div>
                                    <div class="col-12">
                                        <div class=""><?= number_format(100) ?>%</div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="col-12 TOTAL-WEIGHT">
                                        TOTAL ACHIEVEMENT
                                    </div>
                                    <div class="col-12">
                                        <div class=""><?= number_format(70) ?>%</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> -->