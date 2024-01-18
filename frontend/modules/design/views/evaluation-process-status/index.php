<?php

use Faker\Core\Number;

$this->title = 'Evaluation Process&Status ';
?>


<div class="col-12 mt-90 alert alert-Evaluator">
    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6 col-6 Progress-weight">
            <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/EvaluationProgress.png" class="imagesEvaluation-Progress"> Progress Dashboard
        </div>
        <div class="col-lg-2 col-md-6 col-sm-6 col-6">
            <button class="btn btndashboard-white" type="button"><img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/dashblue.png" class="Dashboardblue"><span class="fontbluedashboard"> Dashboard</span></button>
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
            <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/FilterPlus.png" class="picture-FilterPlus-bonus"> <strong class="font-size-13">More</strong> <img src="/HRVC/frontend/web/images/icons/Dark/48px/3Dot.png" class="bonus-point">
        </div>
    </div>
    <div class="col-12 alert alert-light mt-20">
        <div class="row">
            <div class="col-lg-1 col-md-6 col-6">
                <img src="<?= Yii::$app->homeUrl ?>image/BD.jpg" class="imagesprocesslogo">
            </div>
            <div class="col-lg-3 col-md-6 col-6">
                <div class="col-12 process-consultingFirm">
                    Tokyo Consulting Firm Limited
                </div>
                <div class="col-12 mt-5">
                    <img src="<?= Yii::$app->homeUrl ?>image/Thailand.png" class="imageEvaluatorcountry"> Bangkok, Thailand
                </div>
            </div>
            <div class="col-lg-8 col-md-6 col-6 slp">
                <div class="row">
                    <div class="col-6 processMidleft">
                        Mid Term Evaluation Phase
                    </div>
                    <div class="col-6 processMidright">
                        <!-- <div class="btn-group" role="group" aria-label="Basic outlined example">
                            <button type="button" class="btn groupprocessE3">E3</button>
                            <button type="button" class="btn groupprocessMid-Term">Mid-Term</button>
                            <button type="button" class="btn btn-outline-primary">Final Term</button>
                        </div> -->
                        <div class="btn-group" role="group" aria-label="Basic outlined example">
                            <button type="button" class="btn btn-outline-secondary group-mounthly">E3</button>
                            <button type="button" class="btn btn-outline-secondary group-mounthly">Mid-Term</button>
                            <button type="button" class="btn btn-outline-secondary group-mounthly">Final Term</button>
                        </div>
                    </div>
                </div>
                <div class="col-12 alert alert-primaryweak">
                    <!-- <div class="col-sm-2 text-center">
                            <div class="card border-E509CE3 mb-3">
                                <div class="card-header bg-E509CE3">Start</div>
                                <div class="card-body">
                                    <div class="card-title font-size-16">08</div>
                                    <div class="card-text font-size-13">June 23</div>
                                </div>
                            </div>
                        </div> -->
                    <!-- <div class='progress_status'>
                        <div class='progress_inner'> -->
                    <!-- <div class='progress_inner__step'>
                                <label for='step-1'>Start order</label>
                            </div>
                            <div class='progress_inner__step'>
                                <label for='step-2'>Prepare gift</label>
                            </div>
                            <div class='progress_inner__step'>
                                <label for='step-3'>Pack gift</label>
                            </div>
                            <div class='progress_inner__step'>
                                <label for='step-4'>Decorate box</label>
                            </div>
                            <div class='progress_inner__step'>
                                <label for='step-5'>Send gift</label>
                            </div>
                            <input checked='checked' id='step-1' name='step' type='radio'>
                            <input id='step-2' name='step' type='radio'>
                            <input id='step-3' name='step' type='radio'>
                            <input id='step-4' name='step' type='radio'>
                            <input id='step-5' name='step' type='radio'>
                            <div class='progress_inner__bar'></div>
                            <div class='progress_inner__bar--set'></div> -->
                    <!-- <div class='progress_inner__tabs'>
                                <div class='tab tab-0'>
                                    <h1>Start order</h1>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris tortor ipsum, eleifend vitae massa non, dignissim finibus eros. Maecenas non eros tristique nisl maximus sollicitudin.</p>
                                </div>
                                <div class='tab tab-1'>
                                    <h1>Prepare gift</h1>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris tortor ipsum, eleifend vitae massa non, dignissim finibus eros. Maecenas non eros tristique nisl maximus sollicitudin.</p>
                                </div>
                                <div class='tab tab-2'>
                                    <h1>Pack gift</h1>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris tortor ipsum, eleifend vitae massa non, dignissim finibus eros. Maecenas non eros tristique nisl maximus sollicitudin.</p>
                                </div>
                                <div class='tab tab-3'>
                                    <h1>Decorate box</h1>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris tortor ipsum, eleifend vitae massa non, dignissim finibus eros. Maecenas non eros tristique nisl maximus sollicitudin.</p>
                                </div>
                                <div class='tab tab-4'>
                                    <h1>Send gift</h1>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris tortor ipsum, eleifend vitae massa non, dignissim finibus eros. Maecenas non eros tristique nisl maximus sollicitudin.</p>
                                </div>
                            </div> -->
                    <!-- <div class='progress_inner__status'>
                                <div class='box_base'></div>
                                <div class='box_lid'></div>
                                <div class='box_ribbon'></div>
                                <div class='box_bow'>
                                    <div class='box_bow__left'></div>
                                    <div class='box_bow__right'></div>
                                </div>
                                <div class='box_item'></div>
                                <div class='box_tag'></div>
                                <div class='box_string'></div>
                            </div> -->
                    <!-- </div>
                    </div> -->
                    <!-- <div class="E509CE3-sol"></div>
                        <div class="col-sm-3">
                            <div class="alert bg-weak"> self submission</div>
                        </div>
                        <div class="col-sm-2">
                            <div class="alert meething"> meething</div>
                        </div> -->
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 alert bg-white lg-white" role="alert">
        <div class="row">
            <div class="col-1">
                <img src="<?= Yii::$app->homeUrl ?>image/Watanabe.png" class="process-username">

            </div>
            <div class="col-2">
                <div class="name0dashboardname"> Ananta Kumar</div>
                <div class="name0dashboardaccount">Junior CEO</div>
            </div>
            <div class="col-1 sts-e3">
                E3, 2023
            </div>
            <div class="col-8 sts-solid">
                <div class="row">
                    <div class="col-2 alert cta">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="submission"><span class="submissionlabel"> &nbsp;self submission</span>
                            <div class="completed-label">Completed</div>
                        </div>
                    </div>
                    <div class="col-2 alert cta2">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="submission"><span class="submissionlabel"> &nbsp;meeting</span>
                            <div class="completed-label">Completed</div>
                        </div>
                    </div>
                    <div class="col-2 alert cta2">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="submission"><span class="submissionlabel"> &nbsp;primary</span>
                            <div class="completed-label">Completed</div>
                        </div>
                    </div>
                    <div class="col-2 alert cta2">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="submission"><span class="submissionlabel"> &nbsp;primary</span>
                            <div class="completed-label">Completed</div>
                        </div>
                    </div>
                    <div class="col-2 alert cta3">
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
    <div class="col-12 alert bg-white lg-orange" role="alert">
        <div class="row">
            <div class="col-1">
                <img src="<?= Yii::$app->homeUrl ?>image/Watanabe.png" class="process-username">

            </div>
            <div class="col-2">
                <div class="name0dashboardname"> Ananta Kumar</div>
                <div class="name0dashboardaccount">Junior CEO</div>
            </div>
            <div class="col-1 sts-e3">
                E3, 2023
            </div>
            <div class="col-8 sts-solid">
                <div class="row">
                    <div class="col-2 alert cta">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="submission"><span class="submissionlabel"> &nbsp;self submission</span>
                            <div class="completed-label" for="completed-label">Completed</div>
                        </div>
                    </div>
                    <div class="col-2 alert cgray">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" value="" id="Inprogress"><span class="submissionlabel"> &nbsp;meeting</span>
                            <div class="completed-label">In Progress</div>
                        </div>
                    </div>
                    <div class="col-2 alert cgray2">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="Inprogress"><span class="submissionlabel"> &nbsp;primary</span>
                            <div class="completed-label">Waiting</div>
                        </div>
                    </div>
                    <div class="col-2 alert cgray2">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="Inprogress"><span class="submissionlabel"> &nbsp;primary</span>
                            <div class="completed-label">Waiting</div>
                        </div>
                    </div>
                    <div class="col-2 alert cgray3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="Inprogress"><span class="submissionlabel"> &nbsp;completedtion</span>
                            <div class="completed-label">Waiting</div>
                        </div>
                    </div>
                    <div class="col-2 rightCompleted"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 alert bg-white lg-orange" role="alert">
        <div class="row">
            <div class="col-1">
                <img src="<?= Yii::$app->homeUrl ?>image/Watanabe.png" class="process-username">

            </div>
            <div class="col-2">
                <div class="name0dashboardname"> Ananta Kumar</div>
                <div class="name0dashboardaccount">Junior CEO</div>
            </div>
            <div class="col-1 sts-e3">
                E3, 2023
            </div>
            <div class="col-8 sts-solid">
                <div class="row">
                    <div class="col-2 alert cta">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="submission"><span class="submissionlabel"> &nbsp;self submission</span>
                            <div class="completed-label" for="completed-label">Completed</div>
                        </div>
                    </div>
                    <div class="col-2 alert cgray">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" value="" id="Inprogress"><span class="submissionlabel"> &nbsp;meeting</span>
                            <div class="completed-label">In Progress</div>
                        </div>
                    </div>
                    <div class="col-2 alert cgray2">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="Inprogress"><span class="submissionlabel"> &nbsp;primary</span>
                            <div class="completed-label">Waiting</div>
                        </div>
                    </div>
                    <div class="col-2 alert cgray2">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="Inprogress"><span class="submissionlabel"> &nbsp;primary</span>
                            <div class="completed-label">Waiting</div>
                        </div>
                    </div>
                    <div class="col-2 alert cgray3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="Inprogress"><span class="submissionlabel"> &nbsp;completedtion</span>
                            <div class="completed-label">Waiting</div>
                        </div>
                    </div>
                    <div class="col-2 rightCompleted"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 alert bg-white lg-orange" role="alert">
        <div class="row">
            <div class="col-1">
                <img src="<?= Yii::$app->homeUrl ?>image/Watanabe.png" class="process-username">

            </div>
            <div class="col-2">
                <div class="name0dashboardname"> Ananta Kumar</div>
                <div class="name0dashboardaccount">Junior CEO</div>
            </div>
            <div class="col-1 sts-e3">
                E3, 2023
            </div>
            <div class="col-8 sts-solid">
                <div class="row">
                    <div class="col-2 alert cta">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="submission"><span class="submissionlabel"> &nbsp;self submission</span>
                            <div class="completed-label" for="completed-label">Completed</div>
                        </div>
                    </div>
                    <div class="col-2 alert cgray">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" value="" id="Inprogress"><span class="submissionlabel"> &nbsp;meeting</span>
                            <div class="completed-label">In Progress</div>
                        </div>
                    </div>
                    <div class="col-2 alert cgray2">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="Inprogress"><span class="submissionlabel"> &nbsp;primary</span>
                            <div class="completed-label">Waiting</div>
                        </div>
                    </div>
                    <div class="col-2 alert cgray2">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="Inprogress"><span class="submissionlabel"> &nbsp;primary</span>
                            <div class="completed-label">Waiting</div>
                        </div>
                    </div>
                    <div class="col-2 alert cgray3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="Inprogress"><span class="submissionlabel"> &nbsp;completedtion</span>
                            <div class="completed-label">Waiting</div>
                        </div>
                    </div>
                    <div class="col-2 rightCompleted"></div>
                </div>
            </div>
        </div>
    </div>
</div>