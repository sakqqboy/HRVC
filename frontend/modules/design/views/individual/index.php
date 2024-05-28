<?php

use Faker\Core\Number;
use Faker\Extension\NumberExtension;

$this->title = 'Individual';
?>

<div class="col-12 mt-70 environment pt-10 pr-10 pl-20">
    <div class="row">
        <div class="col-lg-3 col-md-6 col-6">
            <div class="col-12 individual_step1">
                <div class="row">
                    <div class="col-2">
                        <img src="<?= Yii::$app->homeUrl ?>image/Watanabe.png" class="individual_userlogin">
                    </div>
                    <div class="col-10 pl-30 pt-5">
                        <div class="Individual_step2_name">Teriyaki Bickleton</div>
                        <div class="Individual_step3_company"> Tokyo Consulting Firm Limited</div>
                        <div class="Individual_step4_country"><img src="<?= Yii::$app->homeUrl ?>image/Thailand.png" class="imageIndividual_country1"> Dhaka, Bangladesh</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-7 col-md-6 col-6">
            <div class="individual_step2">
                <div class="row">
                    <div class="col-3">
                        <div class="individual_stepkey">E3</div>
                        <div class="individual_stepkey_number">2022</div>
                    </div>
                    <div class="col-lg-6 col-6 col-6 performance_individual">
                        Performance Indicator Matrices
                    </div>
                    <div class="col-lg-3 col-md-6 col-6 individual_stepcompleted">
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
        <div class="col-lg-2 col-md-6 col-6">
            <div class="col-12 individual_step3_hraf">
                <div class="col-12 individual_primary">
                    Primary Evaluator
                </div>
                <div class="col-12 mt-5">
                    <img src="<?= Yii::$app->homeUrl ?>image/employee2.png" class="imagesstep_userlog"><a href="#" class="trants_individual_firstname"><span class="individual_firstname">&nbsp;Taiki Taninokuchi</span></a>
                </div>
                <div class="col-12 individual_primary">
                    Final Evaluator
                </div>
                <div class="col-12 mt-5">
                    <img src="<?= Yii::$app->homeUrl ?>image/Mohammed.png" class="imagesstep_userlog"><a href="#" class="trants_individual_firstname"><span class="individual_firstname">&nbsp;Mohammed Foruge</span></a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-12">
            <div class="col-12 individual_Mypanel">
                <div class="row">
                    <div class="col-3 My_panel">
                        My Panel
                    </div>
                    <div class="col-9 Panel-radio">
                        <div class="row">
                            <div class="col-4">
                                <div class="ON-Orange"></div> <span class="font-onorange"> ON GOING (Pending)</span>
                            </div>
                            <div class="col-5">
                                <div class="ON-info"></div>
                                <div class="font-onorange"> Waiting For Mid Approval </div>
                            </div>
                            <div class="col-2">
                                <div class="ON-green"></div>
                                <div class="font-onorange"> Completed</div>
                            </div>
                            <div class="col-1">
                                <i class="fa fa-info text-primary"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>

                <?php
                for ($i = 1; $i <= 6; $i++) {
                ?>

                    <div class="tb_mypanel mt-20">
                        <div class="row">
                            <div class="col-1">
                                <div class="tb_mypanel_e4">
                                    <div class="E41_weight">E4</div>
                                    <div class="E42_weight">2023</div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="spring">Spring Evaluation Ban</div>
                            </div>
                            <div class="col-2">
                                <div class="font-size-11">Mid</div>
                                <span class="ON-Orange"></span><span class="font-size-10">ON GOING</span>
                            </div>
                            <div class="col-3">
                                <div class="font-size-11">Final Evaluation</div>
                                <div class="ON-info"></div><span class="font-size-10">Waiting</span>
                            </div>
                            <div class="col-2 border">
                                <button type="submit" class="btn_My_panel_New">New</button><img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/sendgry.png" class="sendcompleted">
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
                        <a href="" class="text-primary"> See All</a>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-12">
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
                            <div class="col-4">
                                <div class="row">
                                    <div class="col-3">
                                        <img src="<?= Yii::$app->homeUrl ?>image/catt.jpg" class="IMG">
                                    </div>
                                    <div class="col-9 pt-5">
                                        <div class="name_social">N.T_a🙊</div>
                                        <div class="position_name">Junior Executive, IT</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="font-size-11">Mid</div>
                                <div class="ON-Orange"></div><span class="font-size-10">ON GOING</span>
                            </div>
                            <div class="col-3">
                                <div class="font-size-11">Final Evaluation</div>
                                <span class="font-size-10">Waiting</span>
                            </div>
                            <div class="col-2">
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/sendgry.png" class="sendcompleted">
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
                        <a href="" class="textprimary"> See All</a>
                    </div>
                </div>
            </div>
        </div>
    </div>