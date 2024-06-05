<?php

use Faker\Core\Number;
use Faker\Extension\NumberExtension;

$this->title = 'Individual';
?>

<div class="col-12 mt-70 environment pt-10 pr-10 pl-10">
    <div class="row">
        <div class="col-lg-3 col-md-12 col-12">
            <div class="col-12 individual_step1">
                <div class="row mt-30">
                    <div class="col-lg-2 col-md-4 col-3">
                        <img src="<?= Yii::$app->homeUrl ?>image/Watanabe.png" class="individual_userlogin">
                    </div>
                    <div class="col-lg-10 col-md-8 col-9">
                        <div class="Individual_step2_name">Teriyaki Bickleton</div>
                        <div class="Individual_step3_company"> Tokyo Consulting Firm Limited</div>
                        <div class="Individual_step4_country"><img src="<?= Yii::$app->homeUrl ?>image/Thailand.png" class="imageIndividual_country1"> Dhaka, Bangladesh</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-7 col-md-12 col-12">
            <div class="individual_step2">
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-3">
                        <div class="individual_stepkey">E3</div>
                        <div class="individual_stepkey_number">2022</div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-6 performance_individual">
                        Performance Indicator Matrices
                    </div>
                    <div class="col-lg-3 col-md-6 col-3 individual_stepcompleted">
                        Completed
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-6 individual_solidkey">
                        <div class="col-12">
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Charts.png" class="imageindividual_Charts"> <span class="individual_Financial">Key Financial Indicator</span>
                        </div>
                        <div class="col-12">
                            <div class="row mt-10">
                                <div class="col-6">
                                    <div role="progressbar_step_Blue" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" style="--value:30"></div>
                                </div>
                                <div class="col-6">
                                    <div role="progressbar_step_Blue" aria-valuenow="18" aria-valuemin="0" aria-valuemax="100" style="--value:18"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-6 individual_solidkey">
                        <div class="col-12">
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/KGI.png" class="imageindividual_Charts"> <span class="individual_Financial">Key Goal Indicator</span>
                        </div>
                        <div class="col-12">
                            <div class="row mt-10">
                                <div class="col-6">
                                    <div role="progressbar_step_warning" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="--value:50"></div>
                                </div>
                                <div class="col-6">
                                    <div role="progressbar_step_warning" aria-valuenow="29" aria-valuemin="0" aria-valuemax="100" style="--value:29"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-6 individual_solidkey">
                        <div class="col-12">
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/KPI.png" class="imageindividual_Charts"> <span class="individual_Financial">Key Performance Indicator</span>
                        </div>
                        <div class="col-12">
                            <div class="row mt-10">
                                <div class="col-6">
                                    <div role="progressbar_step_danger" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" style="--value:20"></div>
                                </div>
                                <div class="col-6">
                                    <div role="progressbar_step_danger" aria-valuenow="12" aria-valuemin="0" aria-valuemax="100" style="--value:12"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-6">
                        <div class="col-12">
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Achievementstar.png" class="imageindividual_Charts"> <span class="individual_Financial">Total Achievement</span>
                        </div>
                        <div class="col-12">
                            <div class="row mt-10">
                                <div class="col-5">
                                    <div role="progressbar_step_Blue" aria-valuenow="12" aria-valuemin="0" aria-valuemax="100" style="--value:12"></div>
                                </div>
                                <div class="col-7 mt-10">
                                    <div class="col-12">
                                        <span class="individual_weight"><?= number_format(59) ?></span>/<?= number_format(100) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-2 col-md-12 col-12">
            <div class="col-12 individual_step3_hraf">
                <div class="col-12 individual_primary">
                    Primary Evaluator
                </div>
                <div class="col-12 mt-5">
                    <img src="<?= Yii::$app->homeUrl ?>image/employee2.png" class="imagesstep_userlog"><a href="#" class="trants_individual_firstname">Taiki Taninokuchi</a>
                </div>
                <div class="col-12 individual_primary">
                    Final Evaluator
                </div>
                <div class="col-12 mt-5">
                    <img src="<?= Yii::$app->homeUrl ?>image/Mohammed.png" class="imagesstep_userlog"><a href="#" class="trants_individual_firstname">Mohammed Foruge</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 col-md-12 col-sm-6 col-12">
            <div class="col-12 individual_Mypanel">
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-3 My_panel">
                        My Panel
                    </div>
                    <div class="col-lg-9 col-md-6 col-9 Panel-radio">
                        <div class="row">
                            <div class="col-4">
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Ellipseorange.png" class="imagesEllipse">
                                <span class="font-onorange"> ON GOING (Pending)</span>
                            </div>
                            <div class="col-5">
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Ellipseblue.png" class="imagesEllipse">
                                <span class="font-onorange"> Waiting For Mid Approval </span>
                            </div>
                            <div class="col-3">
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Ellipsegreen.png" class="imagesEllipse">
                                <span class="font-onorange"> Completed</span>&nbsp;
                                <i class="fa fa-info text-primary"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>

                <?php
                for ($i = 1; $i <= 2; $i++) {
                ?>

                    <div class="tb_mypanel mt-20">
                        <div class="row">
                            <div class="col-1">
                                <div class="tb_mypanel_e4">
                                    <div class="E41_weight">E4</div>
                                    <div class="E42_weight">2023</div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="spring">Spring Evaluation Ban</div>
                            </div>
                            <div class="col-3">
                                <div class="font-size-11">Mid</div>
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Ellipseorange.png" class="imagesEllipse"><span class="font-size-10"> ON GOING</span>
                            </div>
                            <div class="col-3">
                                <div class="font-size-11">Final Evaluation</div>
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Ellipseblue.png" class="imagesEllipse"><span class="font-size-10"> Waiting</span>
                            </div>
                            <div class="col-1">
                                <button type="submit" class="btn_My_panel_New">New</button>
                            </div>
                            <div class="col-1">
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/sendgry.png" class="sendcompleted1">
                            </div>
                        </div>
                    </div>

                <?php
                }
                ?>

                <?php
                for ($i = 1; $i <= 4; $i++) {
                ?>

                    <div class="tb_mypanel_blue mt-20">
                        <div class="row">
                            <div class="col-1">
                                <div class="tb_mypanel_e4">
                                    <div class="E41_weight">E4</div>
                                    <div class="E42_weight">2023</div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="spring">Spring Evaluation Ban</div>
                            </div>
                            <div class="col-3">
                                <div class="font-size-11">Mid</div>
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Ellipseorange.png" class="imagesEllipse"><span class="font-size-10"> ON GOING</span>
                            </div>
                            <div class="col-3">
                                <div class="font-size-11">Final Evaluation</div>
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Ellipseblue.png" class="imagesEllipse"><span class="font-size-10"> Waiting</span>
                            </div>
                            <div class="col-1">
                                <button type="submit" class="btn_My_panel_New">New</button>
                            </div>
                            <div class="col-1">
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/sendgry.png" class="sendcompleted1">
                            </div>
                        </div>
                    </div>

                <?php
                }
                ?>

                <div class="row mt-10">
                    <div class="col-7 text-end">
                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/mouse.png" class="mouse1e">
                    </div>
                    <div class="col-5 text-end">
                        <a href="" class="fontSeeAll"> See All</a>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-lg-6 col-md-12 col-12">
            <div class="col-12 individual_Mypanel">
                <div class="col-12 My_panel">
                    Subordinate Panel
                </div>
                <hr>

                <?php
                for ($i = 1; $i <= 6; $i++) {
                ?>

                    <div class="tb_mypanel_none mt-20">
                        <div class="row">
                            <div class="col-1">
                                <div class="tb_mypanel_e4">
                                    <div class="E41_weight">E4</div>
                                    <div class="E42_weight">2023</div>
                                </div>
                            </div>
                            <div class="col-5 pl-15">
                                <div class="row">
                                    <div class="col-3 text-end">
                                        <img src="<?= Yii::$app->homeUrl ?>image/catt.jpg" class="IMG">
                                    </div>
                                    <div class="col-9 pt-5">
                                        <div class="name_social">N.T_a🙊</div>
                                        <div class="position_name">Junior Executive, IT</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="font-size-11">Primary Evaluation</div>
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Ellipsegreen.png"> <span class="completed_textgreen">Completed</span>
                            </div>
                            <div class="col-2">
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/sendgry.png" class="sendcompleted2">
                            </div>
                        </div>
                    </div>

                <?php
                }
                ?>
                <div class="row mt-10">
                    <div class="col-7 text-end">
                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/mouse.png" class="mouse1e">
                    </div>
                    <div class="col-5 text-end">
                        <a href="" class="fontSeeAll"> See All</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>