<?php

use Faker\Core\Number;

$this->title = 'Evaluation Process&Status ';
?>


<div class="col-12 mt-70 environment pt-10 pr-10 pl-20">
    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6 col-6 Progress-weight">
            <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/EvaluationProgress.png" class="imagesEvaluation-Progress"> Progress Dashboard
        </div>
        <div class="col-lg-2 col-md-6 col-sm-6 col-6">
            <button class="btn bg-white btndashboard-white" type="button"><img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/dashblue.png" class="Dashboardblue"><span class="fontbluedashboard"> Dashboard</span></button>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-6">
            <select class="form-select processcompanytokyo" aria-label="Default select example">
                <option selected value="">Tokyo Consulting Firm Limited</option>
                <option value="1">Tokyo Consulting co.th</option>
                <option value="2">Tokyo Consulting Firm</option>
                <option value="3">Tokyo Consulting group</option>
            </select>
        </div>
        <div class="col-lg-2 col-md-6 col-sm-6 col-6">
            <select class="form-select EvaluationprocessTerm" aria-label="Default select example">
                <option selected value="">Evaluation Term</option>
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
            </select>
        </div>
        <div class="col-lg-2 col-md-6 col-sm-6 col-6 text-end">
            <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/FilterPlus.png" class="picture-FilterPlus-bonus"> <strong class="font-size-13">More</strong> <img src="/HRVC/frontend/web/images/icons/Dark/48px/3Dot.png" class="bonus-point" id="mymorepoint">
        </div>
    </div>
    <div class="col-12  bg-white alert-processlogo">

        <div class="row">
            <div class="col-lg-1 col-md-6 col-6">
                <img src="<?= Yii::$app->homeUrl ?>image/BD.jpg" class="imagesprocesslogo">
            </div>
            <div class="col-lg-3 col-md-6 col-6">
                <div class="col-12 process-consultingFirm">
                    Tokyo Consulting Firm Limited
                </div>
                <div class="col-12  pl-10">
                    <img src="<?= Yii::$app->homeUrl ?>image/Thailand.png" class="imageEvaluatorcountry"><span class="font-size-11"> Bangkok, Thailand</span>
                </div>
            </div>
            <div class="col-lg-8 col-md-6 col-6 slp">
                <div class="row">
                    <div class="col-6 processMidleft">
                        Mid Term Evaluation Phase
                    </div>
                    <div class="col-6 processMidright">
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <button type="button" class="btn btn-light groupprocessE3">E3</button>
                            <button type="button" class="btn btn-light groupprocessMid-Term">Mid-Term</button>
                            <button type="button" class="btn btn-light groupprocessMid-Term">Final Term</button>
                        </div>
                    </div>
                </div>
                <div class="col-12 alert-primaryweak">
                    <div class="row">
                        <div class="col-3">
                            <div class="bg-weak"> save submission</div>
                        </div>
                        <div class="col-2">
                            <div class="bg-weak"> meeting</div>
                        </div>
                        <div class="col-2">
                            <div class="bg-weak"> primary</div>
                        </div>
                        <div class="col-2">
                            <div class="bg-weak"> final</div>
                        </div>
                    </div>
                    <!-- <div class="row">
                        <div class="col-sm-2 text-center">
                            <div class="card border-E509CE3 mb-3">
                                <div class="card-header bg-E509CE3">Start</div>
                                <div class="card-body">
                                    <div class="card-title font-size-10">08</div>
                                    <div class="card-text font-size-10">June 23</div>
                                </div>
                            </div>
                        </div>
                        <div class="E509CE3-sol"></div>
                        <div class="col-sm-3">
                            <div class="bg-weak"> self submission</div>
                        </div>
                        <div class="col-sm-2">
                            <div class="alert meething"> meething</div>
                        </div>
                        <div class="position-relative m-4">
                            <div class="progress" style="height: 1px;">
                                <div class="progress-bar" role="progressbar" style="width: 50%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <div class="position-absolute top-0 start-0 translate-middle">
                                <div class="card border-E509CE3 mb-3">
                                    <div class="card-header bg-E509CE3">Start</div>
                                    <div class="card-body">
                                        <div class="card-title text-center font-size-13">08</div>
                                        <div class="card-text font-size-10">June 23</div>
                                    </div>
                                </div>
                            </div>
                            <div class="position-absolute top-0 start-50 translate-middle" style="width: 1rem; height:2rem;">
                                <label for="" style="width:6rem;">1 July 23</label>
                                <span class="badge rounded-pill bg-primary">self submission</span>
                            </div>
                            <button type="button" class="position-absolute top-0 start-100 translate-middle btn btn-sm btn-secondary rounded-pill" style="width: 2rem; height:2rem;">3</button>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
    </div>

    <?php
    for ($i = 1; $i <= 2; $i++) {
    ?>

        <div class="col-12 bg-white lg-white">
            <div class="row">
                <div class="col-3">
                    <div class="row">
                        <div class="col-2">
                            <img src="<?= Yii::$app->homeUrl ?>image/Watanabe.png" class="process-username">
                        </div>
                        <div class="col-6">
                            <div class="name0dashboardname"> Ananta Kumar</div>
                            <div class="name0dashboardaccount">Junior CEO</div>
                        </div>
                        <div class="col-4">
                            <span class="sts-e3">
                                E3, 2023
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-9 sts-solid">
                    <div class="row">
                        <div class="col-2 cta">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="submission"><span class="submissionlabel"> &nbsp;self submission</span>
                                <div class="completed-label">Completed</div>
                            </div>
                        </div>
                        <div class="col-2 cta2">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="submission"><span class="submissionlabel"> &nbsp;meeting</span>
                                <div class="completed-label">Completed</div>
                            </div>
                        </div>
                        <div class="col-2  cta2">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="submission"><span class="submissionlabel"> &nbsp;primary</span>
                                <div class="completed-label">Completed</div>
                            </div>
                        </div>
                        <div class="col-2  cta2">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="submission"><span class="submissionlabel"> &nbsp;primary</span>
                                <div class="completed-label">Completed</div>
                            </div>
                        </div>
                        <div class="col-2  cta3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="submission"><span class="submissionlabel"> &nbsp;completedtion</span>
                                <div class="completed-label">Completed</div>
                            </div>
                        </div>
                        <div class="col-2 rightCompleted"></div>
                    </div>
                </div>
            </div>
        </div>

    <?php
    }
    ?>

    <?php
    for ($i = 1; $i <= 1; $i++) {
    ?>

        <div class="col-12 bg-white lg-orange">
            <div class="row">
                <div class="col-3">
                    <div class="row">
                        <div class="col-2">
                            <img src="<?= Yii::$app->homeUrl ?>image/Watanabe.png" class="process-username">
                        </div>
                        <div class="col-6">
                            <div class="name0dashboardname"> Ananta Kumar</div>
                            <div class="name0dashboardaccount">Junior CEO</div>
                        </div>
                        <div class="col-4">
                            <span class="sts-e3">
                                E3, 2023
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-9 sts-solid">
                    <div class="row">
                        <div class="col-2 cgray">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" value="" id="Inprogress"><span class="submissionlabel"> &nbsp;self submission</span>
                                <div class="completed-label" for="completed-label">Completed</div>
                            </div>
                        </div>
                        <div class="col-2 cgray2">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" value="" id="Inprogress"><span class="submissionlabel"> &nbsp;meeting</span>
                                <div class="completed-label">In Progress</div>
                            </div>
                        </div>
                        <div class="col-2 cgray2">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" value="" id="Inprogress"><span class="submissionlabel"> &nbsp;primary</span>
                                <div class="completed-label">Waiting</div>
                            </div>
                        </div>
                        <div class="col-2 cgray2">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" value="" id="Inprogress"><span class="submissionlabel"> &nbsp;primary</span>
                                <div class="completed-label">Waiting</div>
                            </div>
                        </div>
                        <div class="col-2 cgray3">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" value="" id="Inprogress"><span class="submissionlabel"> &nbsp;completedtion</span>
                                <div class="completed-label">Waiting</div>
                            </div>
                        </div>
                        <div class="col-2 rightCompleted"></div>
                    </div>
                </div>
            </div>
        </div>
    <?php
    }
    ?>
</div>


<!-- <div class="containersss">
    <ul class="progressbar_step">
        <li class="step_1 active">Step 1</li>
        <li class="step_1">Step 2</li>
        <li class="step_1">Step 3</li>
        <li class="step_1">Step 4</li>
        <li class="step_1">Step 5</li>
    </ul>
</div> -->