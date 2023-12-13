<?php
$this->title = 'Evaluation Frame';
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
                <div class="col-12">
                    <div class="FrameEvaluation"> Evaluation Frame</div>
                </div>
                <div class="row mt-30">
                    <div class="col-lg-4">
                        <div class="alert alert-Evaluator">
                            <div class="col-12">
                                <div class="calendar-container">
                                    <div class="calendar-month-arrow-container">
                                        <div class="calendar-month-year-container">
                                            <select class="calendar-years"></select>
                                            <select class="calendar-months">
                                            </select>
                                        </div>
                                        <div class="calendar-month-year">
                                        </div>
                                        <div class="calendar-arrow-container">
                                            <button class="calendar-today-button"></button>
                                            <button class="calendar-left-arrow"> <i class="fa fa-chevron-left" aria-hidden="true"></i> </button>
                                            <button class="calendar-right-arrow"> <i class="fa fa-chevron-right" aria-hidden="true"></i></button>
                                        </div>
                                    </div>
                                    <ul class="calendar-week">
                                    </ul>
                                    <ul class="calendar-days">
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="alert alert-Evaluator">
                            <div class="col-12">
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
                        <div class="alert alert-dashboard">
                            <div class="col-12">
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
                                                            <img src="/HRVC/frontend/web/images/icons/Dark/48px/Calender.png" class="cenler-arrows">
                                                            <img src="/HRVC/frontend/web/image/arrowss.png" class="iconsarrowss">
                                                            <img src="/HRVC/frontend/web/images/icons/Dark/48px/Calender.png" class="cenler-arrows">
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
                                                            <img src="/HRVC/frontend/web/images/icons/Dark/48px/Calender.png" class="cenler-arrows">
                                                            <img src="/HRVC/frontend/web/image/arrowss.png" class="iconsarrowss">
                                                            <img src="/HRVC/frontend/web/images/icons/Dark/48px/Calender.png" class="cenler-arrows">
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
                                                            <img src="/HRVC/frontend/web/images/icons/Dark/48px/Calender.png" class="cenler-arrows">
                                                            <img src="/HRVC/frontend/web/image/arrowss.png" class="iconsarrowss">
                                                            <img src="/HRVC/frontend/web/images/icons/Dark/48px/Calender.png" class="cenler-arrows">
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
                                                            <img src="/HRVC/frontend/web/images/icons/Dark/48px/Calender.png" class="cenler-arrows">
                                                            <img src="/HRVC/frontend/web/image/arrowss.png" class="iconsarrowss">
                                                            <img src="/HRVC/frontend/web/images/icons/Dark/48px/Calender.png" class="cenler-arrows">
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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>