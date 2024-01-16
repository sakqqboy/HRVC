<?php

use Faker\Core\Number;

$this->title = 'Promotion';
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
                <div class="col-12">
                    <div class="alert alert-Evaluator mt-20">
                        <div class="col-12">
                            <div class="card b4">
                                <div class="col-12">
                                    <span class="b4weight">E3</span><span class="b4E3"> Final Evaluation Phase</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="alert aler-ALLDepartment">
                        <div class="row">
                            <div class="col-lg-3 alert alert-Evaluator">
                                <div class="col-12 alert alert-light">
                                    <span><img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/24px/Team-1.png" class="widthSave-3"> <span class="Select-add">Select Participants</span></span>
                                    <div class="row mt-10">
                                        <div class="col-lg-5 col-md-6 col-6">
                                            <div class="badge bg-light border-1"></div> <span class="font-size-11"> Title</span>
                                        </div>
                                        <div class="col-lg-7 col-md-6 col-6">
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
                                        <label class="form-check-label" for="defaultCheck">
                                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Rank-1.png" class="pictureRank-1"> Manager <span class="badge rounded-pill bg-primary">MM</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-12 all-allocateuser">
                                    <div class="form-check">
                                        <input class="form-check-input Accountsborderdark" type="checkbox" value="" id="flexCheckDefault">
                                        <label class="form-check-label label-username" for="flexCheckDefault">
                                            <img src="<?= Yii::$app->homeUrl ?>image/Watanabe.png" class="allocate-user"> Charles Bhattacharjya
                                        </label>
                                    </div>
                                </div>
                                <div class="col-12 all-allocateuser">
                                    <div class="form-check">
                                        <input class="form-check-input Accountsborderdark" type="checkbox" value="" id="flexCheckDefault">
                                        <label class="form-check-label label-username" for="flexCheckDefault">
                                            <img src="<?= Yii::$app->homeUrl ?>image/Watanabe.png" class="allocate-user"> Biki Das
                                        </label>
                                    </div>
                                </div>
                                <div class="col-12 all-allocateuser">
                                    <div class="form-check">
                                        <input class="form-check-input Accountsborderdark" type="checkbox" value="" id="flexCheckDefault">
                                        <label class="form-check-label label-username" for="flexCheckDefault">
                                            <img src="<?= Yii::$app->homeUrl ?>image/Watanabe.png" class="allocate-user"> Charles Bhattacharjya
                                        </label>
                                    </div>
                                </div>
                                <div class="col-12 all-allocateuser">
                                    <div class="form-check">
                                        <input class="form-check-input Accountsborderdark" type="checkbox" value="" id="flexCheckDefault">
                                        <label class="form-check-label label-username" for="flexCheckDefault">
                                            <img src="<?= Yii::$app->homeUrl ?>image/Watanabe.png" class="allocate-user"> Biki Das
                                        </label>
                                    </div>
                                </div>
                                <div class="col-12 all-allocateuser">
                                    <div class="form-check">
                                        <input class="form-check-input Accountsborderdark" type="checkbox" value="" id="flexCheckDefault">
                                        <label class="form-check-label label-username" for="flexCheckDefault">
                                            <img src="<?= Yii::$app->homeUrl ?>image/Watanabe.png" class="allocate-user"> Charles Bhattacharjya
                                        </label>
                                    </div>
                                </div>
                                <div class="col-12 all-allocateuser">
                                    <div class="form-check">
                                        <input class="form-check-input Accountsborderdark" type="checkbox" value="" id="flexCheckDefault">
                                        <label class="form-check-label label-username" for="flexCheckDefault">
                                            <img src="<?= Yii::$app->homeUrl ?>image/Watanabe.png" class="allocate-user"> Biki Das
                                        </label>
                                    </div>
                                </div>
                                <div class="col-12 controlcheckboxSelect">
                                    <div class="form-check E2F5FF-border">
                                        <input class="form-check-input" type="checkbox" value="" id="">
                                        <label class="form-check-label" for="defaultCheck">
                                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Rank-1.png" class="pictureRank-1"> Assistant Manager <span class="badge rounded-pill bg-primary">MM</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-12 all-allocateuser">
                                    <div class="form-check">
                                        <input class="form-check-input Accountsborderdark" type="checkbox" value="" id="flexCheckDefault">
                                        <label class="form-check-label label-username" for="flexCheckDefault">
                                            <img src="<?= Yii::$app->homeUrl ?>image/Watanabe.png" class="allocate-user"> Charles Bhattacharjya
                                        </label>
                                    </div>
                                </div>
                                <div class="col-12 all-allocateuser">
                                    <div class="form-check">
                                        <input class="form-check-input Accountsborderdark" type="checkbox" value="" id="flexCheckDefault">
                                        <label class="form-check-label label-username" for="flexCheckDefault">
                                            <img src="<?= Yii::$app->homeUrl ?>image/Watanabe.png" class="allocate-user"> Biki Das
                                        </label>
                                    </div>
                                </div>
                                <div class="col-12 all-allocateuser">
                                    <div class="form-check">
                                        <input class="form-check-input Accountsborderdark" type="checkbox" value="" id="flexCheckDefault">
                                        <label class="form-check-label label-username" for="flexCheckDefault">
                                            <img src="<?= Yii::$app->homeUrl ?>image/Watanabe.png" class="allocate-user"> Charles Bhattacharjya
                                        </label>
                                    </div>
                                </div>
                                <div class="col-12 all-allocateuser">
                                    <div class="form-check">
                                        <input class="form-check-input Accountsborderdark" type="checkbox" value="" id="flexCheckDefault">
                                        <label class="form-check-label label-username" for="flexCheckDefault">
                                            <img src="<?= Yii::$app->homeUrl ?>image/Watanabe.png" class="allocate-user"> Biki Das
                                        </label>
                                    </div>
                                </div>
                                <div class="col-12 all-allocateuser">
                                    <div class="form-check">
                                        <input class="form-check-input Accountsborderdark" type="checkbox" value="" id="flexCheckDefault">
                                        <label class="form-check-label label-username" for="flexCheckDefault">
                                            <img src="<?= Yii::$app->homeUrl ?>image/Watanabe.png" class="allocate-user"> Charles Bhattacharjya
                                        </label>
                                    </div>
                                </div>
                                <div class="col-12 controlcheckboxSelect">
                                    <div class="form-check E2F5FF-border">
                                        <input class="form-check-input" type="checkbox" value="" id="">
                                        <label class="form-check-label" for="defaultCheck">
                                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Rank-1.png" class="pictureRank-1"> Junior Excutive <span class="badge rounded-pill bg-primary">MM</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-12 all-allocateuser">
                                    <div class="form-check">
                                        <input class="form-check-input Accountsborderdark" type="checkbox" value="" id="flexCheckDefault">
                                        <label class="form-check-label label-username" for="flexCheckDefault">
                                            <img src="<?= Yii::$app->homeUrl ?>image/Watanabe.png" class="allocate-user"> Charles Bhattacharjya
                                        </label>
                                    </div>
                                </div>
                                <div class="col-12 all-allocateuser">
                                    <div class="form-check">
                                        <input class="form-check-input Accountsborderdark" type="checkbox" value="" id="flexCheckDefault">
                                        <label class="form-check-label label-username" for="flexCheckDefault">
                                            <img src="<?= Yii::$app->homeUrl ?>image/Watanabe.png" class="allocate-user"> Biki Das
                                        </label>
                                    </div>
                                </div>
                                <div class="col-12 all-allocateuser">
                                    <div class="form-check">
                                        <input class="form-check-input Accountsborderdark" type="checkbox" value="" id="flexCheckDefault">
                                        <label class="form-check-label label-username" for="flexCheckDefault">
                                            <img src="<?= Yii::$app->homeUrl ?>image/Watanabe.png" class="allocate-user"> Charles Bhattacharjya
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-6">
                                <div class="row">
                                    <div class="col-5 set-Promotion">
                                        Set Promotion title
                                    </div>
                                    <div class="col-5">
                                        <input type="text" class="form-control setpromotiontitle" value="" id="">
                                    </div>
                                    <div class="col-2">
                                        <div class="col-12 FrameSalaryAllowance">
                                            <button class="btn btn-primary bonussubmit" type="submit">SAVE</button>
                                        </div>
                                    </div>
                                </div>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<nav class="accordion arrows">
    <input type="radio" name="accordion" id="cb0" />
    <section class="box">
        <label class="box-title cb0" for="cb0">LIGHT SHADES</label>
        <label class="box-close" for="acc-close"></label>
        <div class="box-content">Click on an item to open. Click on its header or the list header to close.</div>
    </section>
    <input type="radio" name="accordion" id="cb1" />
    <section class="box">
        <label class="box-title cb1" for="cb1">MEDIUM SHADES</label>
        <label class="box-close" for="acc-close"></label>
        <div class="box-content">Click on an item to open. Click on its header or the list header to close.</div>
    </section>
    <input type="radio" name="accordion" id="cb2" />
    <section class="box">
        <label class="box-title cb2" for="cb2">TAN SHADES</label>
        <label class="box-close" for="acc-close"></label>
        <div class="box-content">Add the class 'arrows' to nav.accordion to add dropdown arrows.</div>
    </section>
    <input type="radio" name="accordion" id="cb3" />
    <section class="box">
        <label class="box-title cb3" for="cb3">DEEP SHADES</label>
        <label class="box-close" for="acc-close"></label>
        <div class="box-content">Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Quisque finibus tristique nisi, maximus ullamcorper ante finibus eget.</div>
    </section>

    <input type="radio" name="accordion" id="acc-close" />
</nav>