<?php
$this->title = 'Add allocate weight';
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
                    <div class="col-5">
                        <div class="FrameEvaluation"> Weight Configuration Name</div>
                    </div>
                    <div class="col-4">
                        <input type="text" class="form-control" id="exampleInputtext" aria-describedby="">
                    </div>
                    <div class="col-3 text-end">
                        <button type="submit" class="btn btn-primary"><img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/save-2.png" class="Save-2"> SAVE</button>
                    </div>
                </div>
                <div class="row mt-20">
                    <div class="col-lg-3 alert alert-Evaluator">
                        <div class="col-12 alert alert-light">
                            <span><img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/24px/Team-1.png" class="widthSave-3"> <span class="Select-add">Select Participants</span></span>
                            <div class="row mt-10">
                                <div class="col-lg-5 col-md-6 col-6">
                                    <input type="color" class="form-control form-control-color" id="exampleColorInput" value="#0496FF" style="width:1.9rem;height:1.9rem;"> <span class="font-size-11"> Title</span>
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
                                    <img src="<?= Yii::$app->homeUrl ?>image/Watanabe.png" class="allocate-user"> Charles Bhattacharjya
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
                                    <img src="<?= Yii::$app->homeUrl ?>image/Watanabe.png" class="allocate-user"> Charles Bhattacharjya
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
                                    <img src="<?= Yii::$app->homeUrl ?>image/Watanabe.png" class="allocate-user"> Charles Bhattacharjya
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
                                    <img src="<?= Yii::$app->homeUrl ?>image/Watanabe.png" class="allocate-user"> Charles Bhattacharjya
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
                                    <img src="<?= Yii::$app->homeUrl ?>image/Watanabe.png" class="allocate-user"> Charles Bhattacharjya
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
                    <div class="col-lg-9">
                        <div class="row">
                            <div class="col-lg-2 col-md-6 col-12">
                                <div class="alert alert-Evaluator">
                                    <div class="col-12 PIM-allocate text-center">
                                        PIM
                                    </div>
                                    <div class="col-12 mt-10">
                                        <div id="progress1">
                                            <div data-num="85" class="progress-item1" data-value="85%" style="background: conic-gradient(rgb(41, 140, 233) calc(35%), rgb(219, 239, 247) 0deg);">85%</div>
                                        </div>
                                    </div>
                                    <div class="alert alert-white">
                                        <div class="col-12 mt-30">
                                            <div class="form-check" style="margin-left: -5px;">
                                                <input class="form-check-input" type="checkbox" value="" id="" checked>
                                                <label class="form-check-label" for="flexCheckChecked"></label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <span class="badge bg-chartpurple">
                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Light/Light/24px/charts.png" class="icons-KGI">
                                                <div class="mt-5"> KFI</div>
                                                <div class="mt-5">60%</div>
                                            </span>
                                        </div>
                                        <div class="col-12 mt-30">
                                            <div class="form-check" style="margin-left: -5px;">
                                                <input class="form-check-input" type="checkbox" value="" id="" checked>
                                                <label class="form-check-label" for="flexCheckChecked"></label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <span class="badge bg-chartwarn">
                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Light/Light/48px/KGI.png" class="icons-KGI">
                                                <div class="mt-5"> KGI</div>
                                                <div class="mt-5">20%</div>
                                            </span>
                                        </div>
                                        <div class="col-12 mt-30">
                                            <div class="form-check" style="margin-left: -5px;">
                                                <input class="form-check-input" type="checkbox" value="" id="" checked>
                                                <label class="form-check-label" for="flexCheckChecked"></label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <span class="badge bg-cha">
                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Light/Light/48px/KPI.png" class="icons-KGI">
                                                <div class="mt-5"> KPI</div>
                                                <div class=" mt-5">20%</div>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-10 col-md-6 col-12">
                                <div class="alert alert-Evaluator silly_scrollbar">
                                    <div class="card">
                                        <div class="row">
                                            <div class="col-3 flagkey">
                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/24px/KGI.png" class="icons-KGI2"> Key Goal Indicator
                                            </div>
                                            <div class="col-2">
                                                <div class="col-6 ADD-plus1-allocate">
                                                    <i class="fa fa-plus-circle" aria-hidden="true"></i> ADD
                                                </div>
                                            </div>
                                            <div class="col-2">
                                                <div class="col-6 Edit-plus1-allocate">
                                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i> EDIT
                                                </div>
                                            </div>
                                            <div class="col-2 text-end">
                                                <div class="col-12  AddParticipant">
                                                    Participants
                                                </div>
                                            </div>
                                            <div class="col-3 text-end">
                                                <span class="badge rounded-pill bg-gray">
                                                    <ul class="try-cricle">
                                                        <li class="tri-li"> <img src="/HRVC/frontend/web/image/avatar1.png" class="image-avatar1"></li>
                                                        <li class="tri-li"> <img src="/HRVC/frontend/web/image/Watanabe.png" class="image-avatar2"></li>
                                                        <a href="" class="none">
                                                            <li class="tri-li-number typenumber"> 27 </li>
                                                        </a>
                                                    </ul>
                                                </span>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-lg-2">
                                                <div class="card" style="width: 4rem;font-size:12px;">
                                                    <div class="card-header fonTotal">Total Sales <i class="fa fa-minus-circle add-minus-circle" aria-hidden="true"></i></div>
                                                    <div class="card-body text-dark">
                                                        <div class="col-12">
                                                            <span class="badge bg-lighttotal text-primary">
                                                                <?= number_format(598) ?>k
                                                            </span>
                                                        </div>
                                                        <div class="col-12 text-primary text-center pt-10">
                                                            <?= number_format(23) ?>%
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-2">
                                                <div class="card" style="width: 4rem;font-size:12px;">
                                                    <div class="card-header fonTotal">Profit <i class="fa fa-minus-circle add-minus-circle" aria-hidden="true"></i></div>
                                                    <div class="card-body text-dark">
                                                        <div class="col-12">
                                                            <span class="badge bg-lighttotal text-primary">
                                                                <?= number_format(562) ?>k
                                                            </span>
                                                        </div>
                                                        <div class="col-12 text-primary text-center pt-10">
                                                            <?= number_format(11) ?>%
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-2">
                                                <div class="card" style="width: 4rem; font-size:12px;">
                                                    <div class="card-header fonTotal">Net Profit <i class="fa fa-minus-circle add-minus-circle" aria-hidden="true"></i></div>
                                                    <div class="card-body text-dark">
                                                        <div class="col-12 text-center">
                                                            <span class="badge bg-lighttotal text-primary">
                                                                <?= number_format(100000) ?>k
                                                            </span>
                                                        </div>
                                                        <div class="col-12 text-primary text-center pt-10">
                                                            <?= number_format(8) ?>%
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-2">
                                                <div class="card" style="width: 4rem; font-size:12px;">
                                                    <div class="card-header fonTotal">Cost <i class="fa fa-minus-circle add-minus-circle" aria-hidden="true"></i></div>
                                                    <div class="card-body text-dark">
                                                        <div class="col-12">
                                                            <span class="badge bg-lighttotal text-primary">
                                                                <?= number_format(15) ?>%
                                                            </span>
                                                        </div>
                                                        <div class="col-12 text-primary text-center pt-10">
                                                            <?= number_format(8) ?>%
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-2">
                                                <div class="card" style="width: 4rem; font-size:12px;">
                                                    <div class="card-header fonTotal">labor <i class="fa fa-minus-circle add-minus-circle" aria-hidden="true"></i></div>
                                                    <div class="card-body text-dark">
                                                        <div class="col-12">
                                                            <span class="badge bg-lighttotal text-primary">
                                                                5 Times
                                                            </span>
                                                        </div>
                                                        <div class="col-12 text-primary text-center pt-10">
                                                            <?= number_format(8) ?>%
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-2">
                                                <div class="card" style="width: 4rem; font-size:12px;">
                                                    <div class="card-header fonTotal">Webinar <i class="fa fa-minus-circle add-minus-circle" aria-hidden="true"></i></div>
                                                    <div class="card-body text-dark">
                                                        <div class="col-12">
                                                            <span class="badge bg-lighttotal text-primary">
                                                                <?= number_format(458) ?>k
                                                            </span>
                                                        </div>
                                                        <div class="col-12 text-primary text-center pt-10">
                                                            <?= number_format(8) ?>%
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="row">
                                            <div class="col-3 flagkey">
                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/24px/KPI.png" class="icons-KGI2"> Key Performance Indicator
                                            </div>
                                            <div class="col-2">
                                                <div class="col-12 ADD-plus1-allocate">
                                                    <i class="fa fa-plus-circle" aria-hidden="true"></i> ADD
                                                </div>
                                            </div>
                                            <div class="col-2">
                                                <div class="col-12 Edit-plus1-allocate">
                                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i> EDIT
                                                </div>
                                            </div>
                                            <div class="col-2 text-end">
                                                <div class="col-12  AddParticipant">
                                                    Participants
                                                </div>
                                            </div>
                                            <div class="col-3 text-end">
                                                <span class="badge rounded-pill bg-gray">
                                                    <ul class="try-cricle">
                                                        <li class="tri-li"> <img src="/HRVC/frontend/web/image/avatar1.png" class="image-avatar1"></li>
                                                        <li class="tri-li"> <img src="/HRVC/frontend/web/image/Watanabe.png" class="image-avatar2"></li>
                                                        <a href="" class="none">
                                                            <li class="tri-li-number typenumber"> 10 </li>
                                                        </a>
                                                    </ul>
                                                </span>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-lg-2 col-md-6 col-6">
                                                <div class="card" style="width: 4rem; font-size:12px;">
                                                    <div class="card-header fonTotal">Total Sales <i class="fa fa-minus-circle add-minus-circle" aria-hidden="true"></i></div>
                                                    <div class="card-body text-dark">
                                                        <div class="col-12 text-center">
                                                            <span class="badge bg-lighttotal text-primary">
                                                                <?= number_format(598) ?>k
                                                            </span>
                                                        </div>
                                                        <div class="col-12 text-primary text-center pt-10">
                                                            <?= number_format(23) ?>%
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-md-6 col-6">
                                                <div class="card" style="width: 4rem;font-size:12px;">
                                                    <div class="card-header fonTotal">Total Sales</div>
                                                    <div class="card-body text-dark">
                                                        <div class="col-12 text-center">
                                                            <span class="badge bg-lighttotal text-primary">
                                                                <?= number_format(562) ?>k
                                                            </span>
                                                        </div>
                                                        <div class="col-12 text-primary text-center pt-10">
                                                            <?= number_format(11) ?>%
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-md-6 col-6">
                                                <div class="card" style="width: 4rem; font-size:12px;">
                                                    <div class="card-header fonTotal">Total Sales</div>
                                                    <div class="card-body text-dark">
                                                        <div class="col-12 text-center">
                                                            <span class="badge bg-lighttotal text-primary">
                                                                <?= number_format(100000) ?>k
                                                            </span>
                                                        </div>
                                                        <div class="col-12 text-primary text-center pt-10">
                                                            <?= number_format(8) ?>%
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-md-6 col-6">
                                                <div class="card" style="width: 4rem; font-size:12px;">
                                                    <div class="card-header fonTotal">Total Sales</div>
                                                    <div class="card-body text-dark">
                                                        <div class="col-12 text-center">
                                                            <span class="badge bg-lighttotal text-primary">
                                                                <?= number_format(100000) ?>k
                                                            </span>
                                                        </div>
                                                        <div class="col-12 text-primary text-center pt-10">
                                                            <?= number_format(8) ?>%
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-md-6 col-6">
                                                <div class="card" style="width: 4rem; font-size:12px;">
                                                    <div class="card-header fonTotal">Total Sales</div>
                                                    <div class="card-body text-dark">
                                                        <div class="col-12 text-center">
                                                            <span class="badge bg-lighttotal text-primary">
                                                                <?= number_format(100000) ?>k
                                                            </span>
                                                        </div>
                                                        <div class="col-12 text-primary text-center pt-10">
                                                            <?= number_format(8) ?>%
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-md-6 col-6">
                                                <div class="card" style="width: 4rem; font-size:12px;">
                                                    <div class="card-header fonTotal">Total Sales</div>
                                                    <div class="card-body text-dark">
                                                        <div class="col-12 text-center">
                                                            <span class="badge bg-lighttotal text-primary">
                                                                <?= number_format(100000) ?>k
                                                            </span>
                                                        </div>
                                                        <div class="col-12 text-primary text-center pt-10">
                                                            <?= number_format(8) ?>%
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