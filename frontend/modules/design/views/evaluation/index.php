<?php
$this->title = 'Evaluation';
?>

<div class="col-12 mt-90 alert alert-Evaluator">
    <div class="alert alert-white">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-12">
                <div class="col-12 Environment">
                    Evaluation Environment
                </div>
            </div>
            <div class="col-lg-2 col-md-6 col-12">
                <div class="col-12">
                    <button type="submit" class="btn btn-primary"><img src="<?= Yii::$app->homeUrl ?>images/icons/Light/Light/24px/Create(Big).png" class="lightCreate"><span class="font-size-13"> Create</span> </button>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-12">
                <select class="form-select example-Dha" aria-label="Default select example">
                    <option selected value="">Select Menu</option>
                    <option value="1">Tokyo Consulting Firm Limited</option>
                    <option value="2">Tokyo Consulting Firm Limited</option>
                    <option value="3">Tokyo Consulting Firm Limited</option>
                </select>
            </div>
            <div class="col-lg-2 col-md-6 col-12">
                <select class="form-select example-Dha" aria-label="Default select example">
                    <option selected value="">Select Menu</option>
                    <option value="1">Dhaka, BD</option>
                    <option value="2">Dhaka, BD</option>
                    <option value="3">Dhaka, BD</option>
                </select>
            </div>
            <div class="col-lg-2 col-md-6 col-12">
                <div class="col-12 text-end">
                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/FilterPlus.png" class="imagesFilterPlus"> <span class="Moretop"> More</span> <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/3Dot.png" class="images3Dot">
                </div>
            </div>
        </div>
        <div class="col-12 mt-20">
            <div class="accordion" id="accordionPanelsStayOpenExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                        <button class="accordion-button bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                            <div class="col-1">
                                <img src="<?= Yii::$app->homeUrl ?>image/Maskgroup.png" class="imageslogoMaskTCF">
                            </div>
                            <div class="col-3 namelogoMask">
                                <div class="col-12 collapseTokyo">
                                    Tokyo Consulting Firm Pvt. Ltd
                                </div>
                                <div class="col-12 font-size-12">
                                    <img src="/HRVC/frontend/web/image/Flag-Turkey.png" class="imageEvaluatorcountry1"> Izmir, Turkey
                                </div>
                            </div>
                            <div class="col-3">

                            </div>

                            <!-- <div class="col-2">
                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i> <i class="fa fa-trash-o" aria-hidden="true"></i>
                            </div> -->
                        </button>
                    </h2>
                    <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingOne">
                        <div class="accordion-body">
                            <div class="alert p-2 trantRank mt-20">
                                <div class="row">
                                    <div class="col-lg-2">
                                        name
                                    </div>
                                    <div class="col-lg-1">
                                        timeline
                                    </div>
                                    <div class="col-lg-1">
                                        Attribute
                                    </div>
                                    <div class="col-lg-1">
                                        Evaluation
                                    </div>
                                    <div class="col-lg-1">
                                        MID-TERM
                                    </div>
                                    <div class="col-lg-2 text-center">
                                        Set Evaluator
                                    </div>
                                    <div class="col-lg-2 text-center">
                                        Progress
                                    </div>
                                    <div class="col-lg-2">
                                        action
                                    </div>
                                </div>
                            </div>
                            <div class="alert p-2 trantRankColor mt-20">
                                <div class="row">
                                    <div class="col-lg-2 NAMETYPE">
                                        Mid Term Evaluatio n Phase
                                    </div>
                                    <div class="col-lg-1 NAMETYPE">
                                        1st Jan 23 - 31st Dec 23
                                    </div>
                                    <div class="col-lg-1 NAMETYPE">
                                        Quarterly
                                    </div>
                                    <div class="col-lg-1 text-center NAMETYPE">
                                        E1
                                    </div>
                                    <div class="col-lg-1 text-center NAMETYPE">
                                        <i class="fa fa-check-circle co-lorskyblue" aria-hidden="true"></i>
                                    </div>
                                    <div class="col-lg-2 NAMETYPE">
                                        <span class="badge rounded-pill evaluationgray">
                                            <div class="row">
                                                <div class="col-2">
                                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Light/Light/48px/SelectFromCheckboxs-2.png" class="exclamation-circlewarning">
                                                </div>
                                                <div class="col-3">
                                                    <ul class="try-cricle">
                                                        <li class="tri-li"> <img src="<?= Yii::$app->homeUrl ?>image/avatar1.png" class="image-avatar1"></li>
                                                        <li class="tri-li"> <img src="<?= Yii::$app->homeUrl ?>image/Watanabe.png" class="image-avatar2"></li>
                                                        <li class="tri-li"> <img src="<?= Yii::$app->homeUrl ?>image/avatar3.png" class="image-avatar3"></li>
                                                        <a href="" class="none">
                                                            <li class="tri-li-number1"> 9 </li>
                                                        </a>
                                                    </ul>
                                                </div>
                                                <div class="col-2">
                                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Light/Light/48px/SelectFromCheckboxs.png" class="imageFromCheckboxs">
                                                </div>
                                            </div>
                                        </span>
                                    </div>
                                    <div class="col-lg-2 NAMETYPE">
                                        <div class="input-group">
                                            <input type="text" class="form-control formthlarge" placeholder="" aria-label="" aria-describedby="">
                                            <span class="input-group-text" id=""><i class="fa fa-th-large thlarge" aria-hidden="true"></i></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <span class="border border-1 borderconfig"><i class="fa fa-cog Cogconfig" aria-hidden="true"></i> <span class="Cogconfig">config</span> </span> &nbsp;&nbsp;
                                        <span class="border border-1 borderconfig"><i class="fa fa-trash Delectconfig" aria-hidden="true"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="alert p-2 trantRankColoryellow mt-20">
                                <div class="row">
                                    <div class="col-lg-2 NAMETYPE">
                                        Mid Term Evaluatio n Phase
                                    </div>
                                    <div class="col-lg-1 NAMETYPE">
                                        1st Jan 23 - 31st Dec 23
                                    </div>
                                    <div class="col-lg-1 NAMETYPE">
                                        Triannual
                                    </div>
                                    <div class="col-lg-1 text-center NAMETYPE">
                                        E2
                                    </div>
                                    <div class="col-lg-1 text-center NAMETYPE">
                                        <i class="fa fa-times-circle iconstimesred" aria-hidden="true"></i>
                                    </div>
                                    <div class="col-lg-2 NAMETYPE">
                                        <span class="badge rounded-pill evaluationgray">
                                            <div class="row">
                                                <div class="col-2">
                                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/SelectFromCheckboxs-2.png" class="exclamation-circlewarning">
                                                </div>
                                                <div class="col-3">
                                                    <ul class="try-cricle">
                                                        <li class="tri-li"> <img src="<?= Yii::$app->homeUrl ?>image/avatar1.png" class="image-avatar1"></li>
                                                        <li class="tri-li"> <img src="<?= Yii::$app->homeUrl ?>image/Watanabe.png" class="image-avatar2"></li>
                                                        <li class="tri-li"> <img src="<?= Yii::$app->homeUrl ?>image/avatar3.png" class="image-avatar3"></li>
                                                        <a href="" class="none">
                                                            <li class="tri-li-number1"> 9 </li>
                                                        </a>
                                                    </ul>
                                                </div>
                                                <div class="col-2">
                                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Light/Light/48px/SelectFromCheckboxs.png" class="imageFromCheckboxs">
                                                </div>
                                            </div>
                                        </span>
                                    </div>
                                    <div class="col-lg-2 NAMETYPE">
                                        <div class="input-group">
                                            <input type="text" class="form-control formthlarge" placeholder="" aria-label="" aria-describedby="">
                                            <span class="input-group-text" id=""><i class="fa fa-th-large thlarge" aria-hidden="true"></i></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <span class="border border-1 borderconfig"><i class="fa fa-cog Cogconfig" aria-hidden="true"></i> <span class="Cogconfig">config</span> </span> &nbsp;&nbsp;
                                        <span class="border border-1 borderconfig"><i class="fa fa-trash Delectconfig" aria-hidden="true"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="alert p-2 trantRankColorred mt-20">
                                <div class="row">
                                    <div class="col-lg-2 NAMETYPE">
                                        Mid Term Evaluatio n Phase
                                    </div>
                                    <div class="col-lg-1 NAMETYPE">
                                        1st Jan 23 - 31st Dec 23
                                    </div>
                                    <div class="col-lg-1 NAMETYPE">
                                        Half-yearly
                                    </div>
                                    <div class="col-lg-1 text-center NAMETYPE">
                                        E1
                                    </div>
                                    <div class="col-lg-1 text-center NAMETYPE">
                                        <i class="fa fa-check-circle  co-lorskyblue" aria-hidden="true"></i>
                                    </div>
                                    <div class="col-lg-2 NAMETYPE">
                                        <span class="badge rounded-pill evaluationgray">
                                            <div class="row">
                                                <div class="col-2">
                                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/SelectFromCheckboxs-2.png" class="exclamation-circlewarning">
                                                </div>
                                                <div class="col-3">
                                                    <ul class="try-cricle">
                                                        <li class="tri-li"> <img src="<?= Yii::$app->homeUrl ?>image/avatar1.png" class="image-avatar1"></li>
                                                        <li class="tri-li"> <img src="<?= Yii::$app->homeUrl ?>image/Watanabe.png" class="image-avatar2"></li>
                                                        <li class="tri-li"> <img src="<?= Yii::$app->homeUrl ?>image/avatar3.png" class="image-avatar3"></li>
                                                        <a href="" class="none">
                                                            <li class="tri-li-number1"> 9 </li>
                                                        </a>
                                                    </ul>
                                                </div>
                                                <div class="col-2">
                                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Light/Light/48px/SelectFromCheckboxs.png" class="imageFromCheckboxs">
                                                </div>
                                            </div>
                                        </span>
                                    </div>
                                    <div class="col-lg-2 NAMETYPE">
                                        <div class="input-group">
                                            <input type="text" class="form-control formthlarge" placeholder="" aria-label="" aria-describedby="">
                                            <span class="input-group-text" id=""><i class="fa fa-th-large thlarge" aria-hidden="true"></i></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <span class="border border-1 borderconfig"><i class="fa fa-cog Cogconfig" aria-hidden="true"></i> <span class="Cogconfig">config</span> </span> &nbsp;&nbsp;
                                        <span class="border border-1 borderconfig"><i class="fa fa-trash Delectconfig" aria-hidden="true"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="accordion mt-10" id="accordionPanelsStayOpenExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
                            <div class="col-1">
                                <img src="<?= Yii::$app->homeUrl ?>image/Maskgroup.png" class="imageslogoMaskTCF">
                            </div>
                            <div class="col-3 namelogoMask">
                                <div class="col-12 collapseTokyo">
                                    Tokyo Consulting Firm Pvt. Ltd
                                </div>
                                <div class="col-12 font-size-12">
                                    <img src="<?= Yii::$app->homeUrl ?>image/Thailand.png" class="imageEvaluatorcountry1"> Thailand
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="alert alert-light Framee">
                                    <div class="row">
                                        <div class="col-1 halfleft">
                                            Frames
                                        </div>
                                        <div class="col-2">
                                            <div class="col-12 Toa">
                                                ToTal
                                            </div>
                                        </div>
                                        <div class="col-2 sero"></div>
                                        <div class="col-4 borderscan">
                                            <img src="<?= Yii::$app->homeUrl ?>image/scan.png" class="imagescan"> <span class="font-size-11"> Create Frame</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3 ml-8">
                                <div class="alert alert-light Framee">
                                    <div class="row">
                                        <div class="col-1 halfleft">
                                            Salary
                                        </div>
                                        <div class="col-2">
                                            <div class="col-12 Toa">
                                                TotaL
                                                Registered
                                            </div>
                                        </div>
                                        <div class="col-2 sero"></div>
                                        <div class="col-4 borderscan">
                                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Salary.png" class="imagescan"> <span class="font-size-11"> Register Salary</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-1">
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Edit.png" class="iconsDarkedit">
                            </div>
                            <div class="col-1">
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Delete.png" class="iconsDarkedelete">
                            </div>
                        </button>
                    </h2>
                    <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingTwo">
                        <div class="accordion-body">
                            This is the second item's accordion body It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the though the transition does limit overflow.
                        </div>
                    </div>
                </div>
            </div>

            <div class="accordion mt-10" id="accordionPanelsStayOpenExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="panelsStayOpen-headingThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false" aria-controls="panelsStayOpen-collapseThree">
                            Accordion Item #3
                        </button>
                    </h2>
                    <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingThree">
                        <div class="accordion-body">
                            <strong>This is the third item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>