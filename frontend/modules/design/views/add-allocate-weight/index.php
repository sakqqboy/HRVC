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
                <div class="row">
                    <div class="col-lg-2 Participants_border">
                        <div class="col-12 pt-20 pl-3 pr-3">
                            <div class="bg-white pl-5 pr-5">
                                <div class="col-12">
                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/24px/Team-1.png" class="widthSave-3"> <span class="Select-add">Select Participants</span></span>
                                </div>
                                <div class="row mt-10">
                                    <div class="col-lg-4 col-md-6 col-6">
                                        <!-- <div class="put_title pl-3">
                                            Title
                                        </div> -->
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="" id="" checked style="border-radius:4px;width:10px;">
                                            <label class="form-check-label" for="">
                                                Title
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-8 col-md-6 col-6">
                                        <div class="form-check font-size-10">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                            <label class="form-check-label" for="flexCheckDefault">
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
                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Rank-1.png" class="pictureRank-1"><span style="font-size: 10px; letter-spacing: -0.1px;"> Assistant Manager </span><span class="badge rounded-pill bg-primary">MM</span>
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