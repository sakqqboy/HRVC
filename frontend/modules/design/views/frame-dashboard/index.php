<?php
$this->title = 'frame Dasdboard';
?>

<div class="col-12 mt-90 alert alert-FramDashboard">
    <div class="row">
        <div class="col-lg-6 col-md-6 col-12">
            <div class="col-12 text-start Dasdboard-start">
                Frame Dasdboard
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-12">
            <div class="row">
                <div class="col-9">
                    <div class="col-12 text-center">
                        <div class="YourChoose">Choose Your Frame To Display &nbsp;<i class="fa fa-exclamation-circle text-warning font-size-16" aria-hidden="true"></i></div>
                    </div>
                    <div class="row ml-100">
                        <div class="col-2 form-check">
                            <input class="form-check-input form-check-input-labelblack1" type="checkbox" value="labelblack1">
                            <?php
                            $season = array("E1");

                            foreach ($season as $element) {
                                echo "$element";
                            }
                            ?>
                        </div>
                        <div class="col-2 form-check">
                            <input class="form-check-input form-check-input-labelblack1" type="checkbox" value="labelblack1">
                            <?php
                            $season = array("E2");

                            foreach ($season as $element) {
                                echo "$element";
                            }
                            ?>
                        </div>
                        <div class="col-2 form-check">
                            <input class="form-check-input form-check-input-labelblack1" type="checkbox" value="labelblack1">
                            <?php
                            $season  = array("E3");

                            foreach ($season as $element) {
                                echo "$element";
                            }

                            ?>
                        </div>
                        <div class="col-2 form-check">
                            <input class="form-check-input form-check-input-labelblack1" type="checkbox" value="labelblack1">
                            <?php
                            $senson = array("E4");

                            foreach ($senson as $element) {
                                echo "$element";
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-3 text-end">
                    <button type="submit" class="btn btn-light Dashboardblue1"><i class="fa fa-th-large" aria-hidden="true"></i> Dashboard</button>


                </div>
            </div>
        </div>
    </div>
    <div class="col-12 alert alert-Evaluator mt-30">
        <div class="row">
            <div class="col-2">
                <strong>Spring Evaluation</strong>
            </div>
            <div class="col-10 SpringEvaluation">
                <div class="stepper-wrapper">
                    <span class="ontop">
                        <div class="Start-Date">Start Date</div>
                        <img src="<?= Yii::$app->homeUrl ?>image/mon.png" class="imagesmon">
                    </span>
                    <div class="stepper-item completed">
                        <div class="step-counter">E1</div>
                    </div>
                    <div class="stepper-item completed">
                        <div class="step-counter">E2</div>
                    </div>
                    <div class="stepper-item completed">
                        <div class="step-counter">E3</div>
                    </div>
                    <div class="stepper-item completed">
                        <div class="step-counter">E4</div>
                    </div>
                    <div class="stepper-item counter">
                        <div class="stepber"></div>
                    </div>
                    <span class="bottomon">
                        <div class="Start-Date">End Date</div>
                        <img src="<?= Yii::$app->homeUrl ?>image/mon.png" class="imagesmon">
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 alert  alert-Evaluator">
        <div class="col-12 alert alert-dashboard">
            <div class="row">
                <div class="col-lg-1 col-md-6 col-12">
                    <div class="col-12">
                        <button class="btn btn-primary E1">E1</button>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 col-12">
                    <div class="row mb-3">
                        <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Start</label>
                        <div class="col-sm-10">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control formstart" aria-label="" aria-describedby="basic-addon2">
                                <span class="input-group-text" id="basic-addon2"><img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Calender.png" class="imagesLight-calendar"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 col-12">
                    <div class="row mb-3">
                        <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Mid</label>
                        <div class="col-sm-10">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control formstart" aria-label="" aria-describedby="basic-addon2">
                                <span class="input-group-text" id="basic-addon2"><img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Calender.png" class="imagesLight-calendar"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 col-12">
                    <div class="row mb-3">
                        <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm">Finish</label>
                        <div class="col-sm-9">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control formstart" aria-label="" aria-describedby="basic-addon2">
                                <span class="input-group-text" id="basic-addon2"><img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Calender.png" class="imagesLight-calendar" type="date"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="col-12 pt-5">
                        Configure Modules Ready <span> <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Golden Ratio-1.png" class="imagesiconsDarkGolden"></span>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 col-12 text-center">
                    <div class="col-12 solidAllSet">
                        <span class="badge bg successredius ml-5">
                            <div class="form-check text-center">
                                <input class="form-check-input form-check-input-greenSet" type="checkbox" value="checkAllSet" id="">
                                <label class="form-check-label form-check-input-greenSet" for="flexCheckDefault"> All Set </label>
                            </div>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-9 col-md-6 col-12">
                <div class="alert alert-dashboard">
                    <div class="row">
                        <div class="col-8">
                            <div class="row rowTearmduration">
                                <div class="col-2">TERMS</div>
                                <div class="col-5">START</div>
                                <div class="col-3">FINISH</div>
                                <div class="col-1">DURATION</div>
                            </div>
                            <div class="col-12 mt-20">
                                <div class="alert p-2 trantRankColor">
                                    <div class="row settingDays">
                                        <div class="col-lg-2">
                                            <div class="col-12 Startsettingsolid">
                                                Goal Settings
                                            </div>
                                        </div>
                                        <div class="col-lg-5">
                                            <div class="row">
                                                <div class="col-7">
                                                    11th November 2023
                                                </div>
                                                <div class="col-4">
                                                    <span class="badge bg-clder">
                                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Calender.png" class="cenler-arrows">
                                                        <img src="<?= Yii::$app->homeUrl ?>image/arrowss.png" class="iconsarrowss">
                                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Calender.png" class="cenler-arrows">
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="col-12">
                                                11th November 2023
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="col-12 Startsettingsolid-left pl-5">
                                                65 Days
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="alert p-2 trantRankColor">
                                    <div class="row settingDays">
                                        <div class="col-lg-2">
                                            <div class="col-12 Startsettingsolid">
                                                Self Submission
                                            </div>
                                        </div>
                                        <div class="col-lg-5">
                                            <div class="row">
                                                <div class="col-7">
                                                    11th November 2023
                                                </div>
                                                <div class="col-4">
                                                    <span class="badge bg-clder">
                                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Calender.png" class="cenler-arrows">
                                                        <img src="<?= Yii::$app->homeUrl ?>image/arrowss.png" class="iconsarrowss">
                                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Calender.png" class="cenler-arrows">
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="col-12">
                                                11th November 2023
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="col-12 Startsettingsolid-left pl-5">
                                                65 Days
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="alert p-2 trantYellowColor">
                                    <div class="row settingDays">
                                        <div class="col-lg-2">
                                            <div class="col-12 Startsettingsolid">
                                                Mid Meeting
                                            </div>
                                        </div>
                                        <div class="col-lg-5">
                                            <div class="row">
                                                <div class="col-7">

                                                </div>
                                                <div class="col-4">
                                                    <span class="badge bg-clder">
                                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Calender.png" class="cenler-arrows">
                                                        <img src="<?= Yii::$app->homeUrl ?>image/arrowss.png" class="iconsarrowss">
                                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Calender.png" class="cenler-arrows">
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="col-12">

                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="col-12 Startsettingsolid-left pl-5">
                                                0 Days
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="alert p-2 trantRankColor">
                                    <div class="row settingDays">
                                        <div class="col-lg-2">
                                            <div class="col-12 Startsettingsolid">
                                                Goal Settings
                                            </div>
                                        </div>
                                        <div class="col-lg-5">
                                            <div class="row">
                                                <div class="col-7">
                                                    11th November 2023
                                                </div>
                                                <div class="col-4">
                                                    <span class="badge bg-clder">
                                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Calender.png" class="cenler-arrows">
                                                        <img src="<?= Yii::$app->homeUrl ?>image/arrowss.png" class="iconsarrowss">
                                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Calender.png" class="cenler-arrows">
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="col-12">
                                                11th November 2023
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="col-12 Startsettingsolid-left pl-5">
                                                7 Days
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Create(Small).png" class="CreateSmallicons"> &nbsp; <span class="font-size-13">ADD Another Term</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-3 rowBonus">
                            <div class="col-12 pl-10 text-center">
                                BONUS
                            </div>
                            <div class="col-12 text-center mt-20">
                                Does the evaluation includes bonus ?
                            </div>
                            <div class="col-12 card rowcardBonus">
                                <div class="row mt-8">
                                    <div class="col-6 text-end">
                                        <input class="form-check-input RadioYes" type="radio" name="flexRadioDefault" id="">
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            &nbsp; Yes
                                        </label>
                                    </div>
                                    <div class="col-6">
                                        <input class="form-check-input RadioYes" type="radio" name="flexRadioDefault" id="">
                                        <label class="form-check-label" for="flexRadioDefault2">
                                            No
                                        </label>
                                    </div>
                                </div>
                                <hr class="text-secondary">
                                <div class="col-12 text-center">
                                    Select Bonus Month
                                </div>
                                <div class="col-12 mt-15 text-center mb-10">
                                    <select class="form-select text-center font-size-12" aria-label="Default select example">
                                        <option selected value="">select</option>
                                        <option value="1">January</option>
                                        <option value="2">February</option>
                                        <option value="3">March</option>
                                        <option value="4">April</option>
                                        <option value="5">May</option>
                                        <option value="6">June</option>
                                        <option value="7">July</option>
                                        <option value="8">August</option>
                                        <option value="9">September</option>
                                        <option value="10">October</option>
                                        <option value="11">November</option>
                                        <option value="12">December</option>
                                    </select>
                                </div>
                            </div>
                            <div class="d-grid gap-2 col-12 mx-auto mt-15">
                                <span class="badge bg ApllySubmit" type="submit"> Aplly</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-12">
                <div class="alert alert-dashboard">
                    <div class="col-12 rowAvailable">
                        Available Evaluation Modules
                    </div>
                    <div class="col-12 mt-20">
                        <p class="on-p"> <i class="fa fa-check checkgreenbox" aria-hidden="true"></i> &nbsp;&nbsp; <span class="liEvaluation">Evaluation Frame</span></p>
                        <p class="on-p"> <i class="fa fa-check checkgreenbox" aria-hidden="true"></i> &nbsp;&nbsp; <span class="liEvaluation">Weight Allocation</span></p>
                        <p class="on-p"> <i class="fa fa-check checkgreenbox" aria-hidden="true"></i> &nbsp;&nbsp; <span class="liEvaluation">Evaluator Settings</span></p>
                        <p class="on-p"> <i class="fa fa-check checkgreenbox" aria-hidden="true"></i> &nbsp;&nbsp; <span class="liEvaluation">Salary & Allowance</span></p>
                        <p class="on-p"> <i class="fa fa-check checkgreenbox" aria-hidden="true"></i> &nbsp;&nbsp; <span class="liEvaluation">Bonus Configuration</span></p>
                        <p class="on-p"> <i class="fa fa-check checkgreenbox" aria-hidden="true"></i> &nbsp;&nbsp; <span class="liEvaluation">Promotion</span></p>
                    </div>
                    <div class="d-grid gap-2 col-12 mx-auto mt-15">
                        <span class="badge bg ApllySubmit" type="submit"> Configure Modules <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/ArrowRight.png" class="imagesArrowRight"> </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 alert  alert-Evaluator">
        <div class="col-12 alert alert-dashboard">
            <div class="row">
                <div class="col-lg-1 col-md-6 col-12">
                    <div class="col-12">
                        <button class="btn btn-primary E1">E1</button>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 col-12">
                    <div class="row mb-3">
                        <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Start</label>
                        <div class="col-sm-10">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control formstart" aria-label="" aria-describedby="basic-addon2">
                                <span class="input-group-text" id="basic-addon2"><img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Calender.png" class="imagesLight-calendar"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 col-12">
                    <div class="row mb-3">
                        <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Mid</label>
                        <div class="col-sm-10">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control formstart" aria-label="" aria-describedby="basic-addon2">
                                <span class="input-group-text" id="basic-addon2"><img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Calender.png" class="imagesLight-calendar"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 col-12">
                    <div class="row mb-3">
                        <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm">Finish</label>
                        <div class="col-sm-9">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control formstart" aria-label="" aria-describedby="basic-addon2">
                                <span class="input-group-text" id="basic-addon2"><img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Calender.png" class="imagesLight-calendar" type="date"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="col-12 pt-5">
                        Set all Dates to Continue <span> <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Golden Ratio-1.png" class="imagesiconsDarkGolden"></span>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 col-12 text-center">
                    <div class="col-12 solidAllSet">
                        <span class="badge bg yellowdius ml-5">
                            <div class="form-check">
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Light/Light/48px/SelectFromCheckboxs-2.png" class="imagesLightSelectFromCheckboxs-2"> &nbsp;
                                <!-- <input class="form-check-input form-check-input-yellowPending" type="checkbox" value="checkPending" id=""> -->
                                <label class="form-check-label form-check-input-yellowPending" for="flexCheckDefault"> Pending </label>
                            </div>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-9 col-md-6 col-12">
                <div class="alert alert-dashboard">
                    <div class="row">
                        <div class="col-8">
                            <div class="row rowTearmduration">
                                <div class="col-2">TERMS</div>
                                <div class="col-5">START</div>
                                <div class="col-3">FINISH</div>
                                <div class="col-1">DURATION</div>
                            </div>
                            <div class="col-12 mt-20">
                                <div class="alert p-2 trantYellowColor">
                                    <div class="row settingDays">
                                        <div class="col-lg-2">
                                            <div class="col-12 Startsettingsolid">
                                                Goal Settings
                                            </div>
                                        </div>
                                        <div class="col-lg-5">
                                            <div class="row">
                                                <div class="col-7">

                                                </div>
                                                <div class="col-4">
                                                    <span class="badge bg-clder">
                                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Calender.png" class="cenler-arrows">
                                                        <img src="<?= Yii::$app->homeUrl ?>image/arrowss.png" class="iconsarrowss">
                                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Calender.png" class="cenler-arrows">
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="col-12">

                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="col-12 Startsettingsolid-left pl-5">
                                                <?= number_format(0) ?> Days
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="alert p-2 trantYellowColor">
                                    <div class="row settingDays">
                                        <div class="col-lg-2">
                                            <div class="col-12 Startsettingsolid">
                                                Self Submission
                                            </div>
                                        </div>
                                        <div class="col-lg-5">
                                            <div class="row">
                                                <div class="col-7">

                                                </div>
                                                <div class="col-4">
                                                    <span class="badge bg-clder">
                                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Calender.png" class="cenler-arrows">
                                                        <img src="<?= Yii::$app->homeUrl ?>image/arrowss.png" class="iconsarrowss">
                                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Calender.png" class="cenler-arrows">
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="col-12">

                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="col-12 Startsettingsolid-left pl-5">
                                                <?= number_format(0) ?> Days
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="alert p-2 trantYellowColor">
                                    <div class="row settingDays">
                                        <div class="col-lg-2">
                                            <div class="col-12 Startsettingsolid">
                                                Mid Meeting
                                            </div>
                                        </div>
                                        <div class="col-lg-5">
                                            <div class="row">
                                                <div class="col-7">

                                                </div>
                                                <div class="col-4">
                                                    <span class="badge bg-clder">
                                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Calender.png" class="cenler-arrows">
                                                        <img src="<?= Yii::$app->homeUrl ?>image/arrowss.png" class="iconsarrowss">
                                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Calender.png" class="cenler-arrows">
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="col-12">

                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="col-12 Startsettingsolid-left pl-5">
                                                <?= number_format(0) ?> Days
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="alert p-2 trantYellowColor">
                                    <div class="row settingDays">
                                        <div class="col-lg-2">
                                            <div class="col-12 Startsettingsolid">
                                                Goal Settings
                                            </div>
                                        </div>
                                        <div class="col-lg-5">
                                            <div class="row">
                                                <div class="col-7">

                                                </div>
                                                <div class="col-4">
                                                    <span class="badge bg-clder">
                                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Calender.png" class="cenler-arrows">
                                                        <img src="<?= Yii::$app->homeUrl ?>image/arrowss.png" class="iconsarrowss">
                                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Calender.png" class="cenler-arrows">
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="col-12">

                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="col-12 Startsettingsolid-left pl-5">
                                                <?= number_format(0) ?> Days
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Create(Small).png" class="CreateSmallicons"> &nbsp; <span class="font-size-13">ADD Another Term</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-3 rowBonus">
                            <div class="col-12 pl-10 text-center">
                                BONUS
                            </div>
                            <div class="col-12 text-center mt-20">
                                Does the evaluation includes bonus ?
                            </div>
                            <div class="col-12 card rowcardBonus">
                                <div class="row mt-8">
                                    <div class="col-6 text-end">
                                        <input class="form-check-input RadioYes" type="radio" name="flexRadioDefault" id="">
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            &nbsp; Yes
                                        </label>
                                    </div>
                                    <div class="col-6">
                                        <input class="form-check-input RadioYes" type="radio" name="flexRadioDefault" id="">
                                        <label class="form-check-label" for="flexRadioDefault2">
                                            No
                                        </label>
                                    </div>
                                </div>
                                <hr class="text-secondary">
                                <div class="col-12 text-center">
                                    Select Bonus Month
                                </div>
                                <div class="col-12 mt-15 text-center mb-10">
                                    <select class="form-select text-center font-size-12" aria-label="Default select example">
                                        <option selected value="">select</option>
                                        <option value="1">January</option>
                                        <option value="2">February</option>
                                        <option value="3">March</option>
                                        <option value="4">April</option>
                                        <option value="5">May</option>
                                        <option value="6">June</option>
                                        <option value="7">July</option>
                                        <option value="8">August</option>
                                        <option value="9">September</option>
                                        <option value="10">October</option>
                                        <option value="11">November</option>
                                        <option value="12">December</option>
                                    </select>
                                </div>
                            </div>
                            <div class="d-grid gap-2 col-12 mx-auto mt-15">
                                <span class="badge bg ApllySubmit" type="submit"> Aplly</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-12">
                <div class="alert alert-dashboard">
                    <div class="col-12 rowAvailable">
                        Available Evaluation Modules
                    </div>
                    <div class="col-12 mt-20">
                        <p class="on-p"> <i class="fa fa-check checkgreenbox" aria-hidden="true"></i> &nbsp;&nbsp; <span class="liEvaluation">Evaluation Frame</span></p>
                        <p class="on-p"> <i class="fa fa-check checkgreenbox" aria-hidden="true"></i> &nbsp;&nbsp; <span class="liEvaluation">Weight Allocation</span></p>
                        <p class="on-p"> <i class="fa fa-check checkgreenbox" aria-hidden="true"></i> &nbsp;&nbsp; <span class="liEvaluation">Evaluator Settings</span></p>
                        <p class="on-p"> <i class="fa fa-check checkgreenbox" aria-hidden="true"></i> &nbsp;&nbsp; <span class="liEvaluation">Salary & Allowance</span></p>
                        <p class="on-p"> <i class="fa fa-check checkgreenbox" aria-hidden="true"></i> &nbsp;&nbsp; <span class="liEvaluation">Bonus Configuration</span></p>
                        <p class="on-p"> <i class="fa fa-check checkgreenbox" aria-hidden="true"></i> &nbsp;&nbsp; <span class="liEvaluation">Promotion</span></p>
                    </div>
                    <div class="d-grid gap-2 col-12 mx-auto mt-15">
                        <span class="badge bg ApllySubmit" type="submit"> Configure Modules <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/ArrowRight.png" class="imagesArrowRight"> </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




<!-- <div class="form-check form-check-inline mt-5">
                        <div class="form-check">
                            <input class="form-check-input form-check-input-checkE1" type="checkbox" value="checkE1" id="">
                            <label class="form-check-label form-check-input-checkE1" for="flexCheckDefault"> E1 </label>
                        </div>
                    </div>
                    <div class="form-check form-check-inline">
                        <div class="form-check">
                            <input class="form-check-input form-check-input-checkE2" type="checkbox" value="checkE2" id="">
                            <label class="form-check-label form-check-input-checkE2" for="flexCheckDefault"> E2 </label>
                        </div>
                    </div>
                    <div class="form-check form-check-inline">
                        <div class="form-check">
                            <input class="form-check-input form-check-input-checkE3" type="checkbox" value="checkE3" id="">
                            <label class="form-check-label form-check-input-checkE3" for="flexCheckDefault"> E3 </label>
                        </div>
                    </div>
                    <div class="form-check form-check-inline">
                        <div class="form-check">
                            <input class="form-check-input form-check-input-checkE4" type="checkbox" value="checkE4" id="">
                            <label class="form-check-label form-check-input-checkE4" for="flexCheckDefault"> E4 </label>
                        </div>
                    </div> -->