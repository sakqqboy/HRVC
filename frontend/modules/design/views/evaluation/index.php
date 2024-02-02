<?php
$this->title = 'Evaluation';
?>

<div class="col-12 mt-90 alert alert-Evaluator">
    <div class="alert alert-light">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-12">
                <div class="col-12 Environment">
                    Evaluation Environment
                </div>
            </div>
            <div class="col-lg-2 col-md-6 col-12">
                <div class="col-12">
                    <button type="submit" class="btn btn-primary but_createeva"><img src="<?= Yii::$app->homeUrl ?>images/icons/Light/Light/24px/Create(Big).png" class="lightCreate"><span class="font-size-12"> Create</span> </button>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-12 text-end">
                <select class="form-select example-Dha" aria-label="Default select example">
                    <option selected value="">Select Menu</option>
                    <option value="1">Tokyo Consulting Firm Limited</option>
                    <option value="2">Tokyo Consulting Firm Limited</option>
                    <option value="3">Tokyo Consulting Firm Limited</option>
                </select>
            </div>
            <div class="col-lg-3 col-md-6 col-12 text-end">
                <select class="form-select example-Dha" aria-label="Default select example">
                    <option selected value="">Select Menu</option>
                    <option value="1">Dhaka, BD</option>
                    <option value="2">Dhaka, BD</option>
                    <option value="3">Dhaka, BD</option>
                </select>
            </div>
            <div class="col-lg-1 col-md-6 col-12">
                <div class="col-12">
                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/FilterPlus.png" class="imagesFilterPlus">
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-12 col-xs-12">
                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                        <div class="panel panel-default" id="collapseOne_container">
                            <div class="panel-heading" role="tab" id="headingOne">
                                <div class="row">
                                    <div class="col-lg-1">
                                        <img src="<?= Yii::$app->homeUrl ?>image/Maskgroup.png" class="imageslogoMaskTCF">
                                    </div>
                                    <div class="col-lg-3 namelogoMask">
                                        <div class="col-12 collapseTokyo">
                                            Tokyo Consulting Firm Pvt. Ltd
                                        </div>
                                        <div class="col-12 font-size-11">
                                            <img src="<?= Yii::$app->homeUrl ?>image/Thailand.png" class="imageEvaluatorcountry1"> Thailand
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <img src="<?= Yii::$app->homeUrl ?>image/half.png" class="half_css">
                                        <div class="col-12 halfleft">Frames</div>
                                        <div class="col-12 Toa"> Total</div>
                                        <div class="col-12 circle_6">&nbsp;6</div>
                                        <div class="col-12 borderscan pl-5 pr-7 pb-5"><img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/bar-scan.png" class="imagescan"> <span class="text539DF3_1"> Create Frame</span></div>
                                    </div>
                                    <div class="col-lg-3">
                                        <img src="<?= Yii::$app->homeUrl ?>image/half.png" class="half_css">
                                        <div class="col-12 halfleft">Salary</div>
                                        <div class="col-12 Toa"> TotaL</div>
                                        <div class="col-12 Toa_Registered"> Registered</div>
                                        <div class="col-12 circle_6">&nbsp;9</div>
                                        <div class="col-12 borderscan pl-3 pr-3 pb-3"><img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Salary_1.png" class="imagescan"> <span class="text539DF3_1"> Register Salary</span></div>
                                    </div>
                                    <div class="col-lg-1">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Edit.png" class="iconsDarkedit-1">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Delete.png" class="iconsDarkedelete-1">

                                    </div>
                                    <div class="col-lg-1 panel-title mt-15">
                                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/24px/Selected-2.png" class="img_select24">
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                <div class="panel-body">
                                    <table class="table badge-gray-table">
                                        <thead>
                                            <tr id="tablebr-<?= $tabletr['tabletrId'] ?>">
                                            <?php
                                            while(isset($table) && count($tabletr) >0 ){
                                                
                                                <td scope="col">name</td>
                                                <td scope="col">timeline</td>
                                                <td scope="col">Attribute</td>
                                                <td scope="col">TERM</td>
                                                <td scope="col">MID</td>
                                                <td scope="col">Bonus</td>
                                                <td scope="col">Set Evaluator</td>
                                                <td scope="col">Progress</td>
                                                <td scope="col">Action</td>
                                                 }
                                                ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="trantRankColor">
                                                <td>1</td>
                                                <td>Mark</td>
                                                <td>Otto</td>
                                                <td>@mdo</td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td>Jacob</td>
                                                <td>Thornton</td>
                                                <td>@fat</td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>Larry the Bird</td>
                                                <td>@twitter</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default" id="collapseTwo_Container">
                        <div class="panel-heading" role="tab" id="headingTwo">
                            <div class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/24px/Selected-2.png" class="img_select24">
                                </a>
                            </div>
                        </div>
                        <div id="collapseTwo" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingTwo">
                            <div class="panel-body">
                                <p>Snakes are elongated, legless, carnivorous reptiles of the suborder Serpentes that can be distinguished from legless lizards by their lack of eyelids and external ears. Like all squamates, snakes are ectothermic, amniote vertebrates
                                    covered in overlapping scales. Many species of snakes have skulls with several more joints than their lizard ancestors, enabling them to swallow prey much larger than their heads with their highly mobile jaws. To accommodate their
                                    narrow bodies, snakes' paired organs (such as kidneys) appear one in front of the other instead of side by side, and most have only one functional lung. Some species retain a pelvic girdle with a pair of vestigial claws on either
                                    side of the cloaca.</p>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default" id="collapseThree_Container">
                        <div class="panel-heading" role="tab" id="headingThree">
                            <div class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/24px/Selected-2.png" class="img_select24">
                                </a>
                            </div>
                        </div>
                        <div id="collapseThree" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingThree">
                            <div class="panel-body">
                                <p>The meerkat or suricate (Suricata suricatta) is a small carnivoran belonging to the mongoose family (Herpestidae). It is the only member of the genus Suricata. Meerkats live in all parts of the Kalahari Desert in Botswana, in much
                                    of the Namib Desert in Namibia and southwestern Angola, and in South Africa. A group of meerkats is called a "mob", "gang" or "clan". A meerkat clan often contains about 20 meerkats, but some super-families have 50 or more members.
                                    In captivity, meerkats have an average life span of 12–14 years, and about half this in the wild.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<body>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>




<!-- <div class="col-12 mt-20"> -->
<!-- <div class="col-12 mt-20"> -->
<!-- <div class="accordion" id="accordionPanelsStayOpen1"> -->
<!-- <div class="accordion-item"> -->
<!-- <h2 class="accordion-header" id="panelsStayOpen-headingOne">
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
                        <div class="alert alert-light Framee">
                            <div class="row">
                                <div class="col-1 halfleft">
                                    Frames
                                </div>
                                <div class="col-3">
                                    <div class="col-12 Toa">
                                        Total
                                    </div>
                                </div>
                                <div class="col-3">
                                    <img src="<?= Yii::$app->homeUrl ?>image/number-5.png" class="images-number2">
                                </div>
                                <div class="col-5 borderscan">
                                    <img src="<?= Yii::$app->homeUrl ?>image/scan.png" class="imagescan"> <span class="font-size-11"> Create Frame</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="alert alert-light Framee">
                            <div class="row">
                                <div class="col-1 halfleft">
                                    Salary
                                </div>
                                <div class="col-4">
                                    <div class="col-12 Toa">
                                        TotaL
                                        Registered
                                    </div>
                                </div>
                                <div class="col-2">
                                    <img src="<?= Yii::$app->homeUrl ?>image/number-2.png" class="images-number2">
                                </div>
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
            </h2> -->
<!-- <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingOne"> -->
<!-- <div class="accordion-body"> -->
<!-- <div class="alert p-2 trantRank mt-20">
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
                    </div> -->
<!-- <div class="alert p-2 trantRankColor mt-20"> -->
<!-- <div class="row">
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
                        </div> -->
<!-- </div> -->
<!-- <div class="alert p-2 trantRankColoryellow mt-20"> -->
<!-- <div class="row"> -->
<!-- <div class="col-lg-2 NAMETYPE">
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
                            </div> -->
<!-- <div class="col-lg-2 NAMETYPE"> -->
<!-- <span class="badge rounded-pill evaluationgray"> -->
<!-- <div class="row"> -->
<!-- <div class="col-2"> -->
<!-- <i class="fa fa-check-circle co-lorskyblue" aria-hidden="true"></i> -->
<!-- <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/SelectFromCheckboxs-3.png" class="exclamation-circlewarning"> -->
<!-- </div> -->
<!-- <div class="col-3">
                                            <ul class="try-cricle">
                                                <li class="tri-li"> <img src="<?= Yii::$app->homeUrl ?>image/avatar1.png" class="image-avatar1"></li>
                                                <li class="tri-li"> <img src="<?= Yii::$app->homeUrl ?>image/Watanabe.png" class="image-avatar2"></li>
                                                <li class="tri-li"> <img src="<?= Yii::$app->homeUrl ?>image/avatar3.png" class="image-avatar3"></li>
                                                <a href="" class="none">
                                                    <li class="tri-li-number1"> 9 </li>
                                                </a>
                                            </ul>
                                        </div> -->
<!-- <div class="col-2">
                                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Light/Light/48px/SelectFromCheckboxs.png" class="imageFromCheckboxs">
                                        </div> -->
<!-- </div> -->
<!-- </span> -->
<!-- </div> -->
<!-- <div class="col-lg-2 NAMETYPE">
                                <div class="input-group">
                                    <input type="text" class="form-control formthlarge" placeholder="" aria-label="" aria-describedby="">
                                    <span class="input-group-text" id=""><i class="fa fa-th-large thlarge" aria-hidden="true"></i></span>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <span class="border border-1 borderconfig"><i class="fa fa-cog Cogconfig" aria-hidden="true"></i> <span class="Cogconfig">config</span> </span> &nbsp;&nbsp;
                                <span class="border border-1 borderconfig"><i class="fa fa-trash Delectconfig" aria-hidden="true"></i></span>
                            </div> -->
<!-- </div> -->
<!-- </div> -->
<!-- <div class="alert p-2 trantRankColorred mt-20"> -->
<!-- <div class="row"> -->
<!-- <div class="col-lg-2 NAMETYPE">
                                Mid Term Evaluatio n Phase
                            </div>
                            <div class="col-lg-1 NAMETYPE">
                                1st Jan 23 - 31st Dec 23
                            </div>
                            <div class="col-lg-1 NAMETYPE">
                                Half-yearly
                            </div> -->
<!-- <div class="col-lg-1 text-center NAMETYPE">
                                E1
                            </div> -->
<!-- <div class="col-lg-1 text-center NAMETYPE">
                                <i class="fa fa-check-circle  co-lorskyblue" aria-hidden="true"></i>
                            </div> -->
<!-- <div class="col-lg-2 NAMETYPE"> -->
<!-- <span class="badge rounded-pill evaluationgray"> -->
<!-- <div class="row"> -->
<!-- <div class="col-2"> -->
<!-- <i class="fa fa-check-circle co-lorskyblue" aria-hidden="true"></i> -->
<!-- <img src="<?= Yii::$app->homeUrl ?>images/icons/Light/Light/48px/SelectFromCheckboxs-2.png" class="exclamation-circlewarning"> -->
<!-- </div> -->
<!-- <div class="col-3">
                                            <ul class="try-cricle">
                                                <li class="tri-li"> <img src="<?= Yii::$app->homeUrl ?>image/avatar1.png" class="image-avatar1"></li>
                                                <li class="tri-li"> <img src="<?= Yii::$app->homeUrl ?>image/Watanabe.png" class="image-avatar2"></li>
                                                <li class="tri-li"> <img src="<?= Yii::$app->homeUrl ?>image/avatar3.png" class="image-avatar3"></li>
                                                <a href="" class="none">
                                                    <li class="tri-li-number1"> 9 </li>
                                                </a>
                                            </ul>
                                        </div> -->
<!-- <div class="col-2">
                                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Light/Light/48px/SelectFromCheckboxs.png" class="imageFromCheckboxs">
                                        </div> -->
<!-- </div> -->
<!-- </span> -->
<!-- </div> -->
<!-- <div class="col-lg-2 NAMETYPE">
                                <div class="input-group">
                                    <input type="text" class="form-control formthlarge" placeholder="" aria-label="" aria-describedby="">
                                    <span class="input-group-text" id=""><i class="fa fa-th-large thlarge" aria-hidden="true"></i></span>
                                </div>
                            </div> -->
<!-- <div class="col-lg-2">
                                <span class="border border-1 borderconfig"><i class="fa fa-cog Cogconfig" aria-hidden="true"></i> <span class="Cogconfig">config</span> </span> &nbsp;&nbsp;
                                <span class="border border-1 borderconfig"><i class="fa fa-trash Delectconfig" aria-hidden="true"></i></span>
                            </div> -->
<!-- </div> -->
<!-- </div> -->
<!-- </div> -->
<!-- </div> -->
<!-- </div> -->
<!-- </div> -->
<!-- <div class="accordion mt-10" id="accordionPanelsStayOpen2"> -->
<!-- <div class="accordion-item"> -->
<!-- <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
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
                                <div class="col-2"></div>
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
            </h2> -->
<!-- <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingTwo">
                <div class="accordion-body">
                    This is the second item's accordion body It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the though the transition does limit overflow.
                </div>
            </div> -->
<!-- </div> -->
<!-- </div> -->
<!-- <div class="accordion mt-10" id="accordionPanelsStayOpen3"> -->
<!-- <div class="accordion-item">
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
</div> -->
<!-- </div> -->
<!-- </div> -->
<!-- </div> -->