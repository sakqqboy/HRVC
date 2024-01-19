<?php

use Faker\Core\Number;
use Faker\Extension\NumberExtension;

$this->title = 'Individual';
?>

<div class="col-12 mt-90 alert alert-Evaluator">
    <div class="row">
        <div class="col-lg-3 col-md-6 col-12">
            <div class="col-12 card individual_step1">
                <div class="row">
                    <div class="col-3">
                        <img src="<?= Yii::$app->homeUrl ?>image/Watanabe.png" class="process-username">
                    </div>
                    <div class="col-9">
                        <div class="Individual_step2_name">Teriyaki Bickleton</div>
                        <div class="Individual_step3_company"> Tokyo Consulting Firm Limited</div>
                        <div class="Individual_step4_country"><img src="<?= Yii::$app->homeUrl ?>image/is.jpg" class="imageIndividual_country1"> Dhaka, Bangladesh</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-7 col-md-6 col-6">
            <div class="col-12 card individual_step2">
                <div class="row">
                    <div class="col-3 individual_stepkey">
                        E3
                        <div class="">2022</div>
                    </div>
                    <div class="col-lg-6 col-6 col-6">
                        Performance Indicator Matrices
                    </div>
                    <div class="col-lg-3 col-md-6 col-6 individual_stepcompleted">
                        completed
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
                                <div class="col-6">
                                    <div role="progressbar_step_Blue" aria-valuenow="12" aria-valuemin="0" aria-valuemax="100" style="--value:12"></div>
                                </div>
                                <div class="col-6 mt-10">
                                    <div class="col-12">
                                        <span class="individual_weight"><?= number_format(59) ?></span> /<?= number_format(100) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-2 col-md-6 col-6">
            <div class="col-12 card individual_step3">
                <div class="col-12 individual_primary">
                    Primary Evaluator
                </div>
                <div class="col-12">
                    <img src="<?= Yii::$app->homeUrl ?>image/employee2.png" class="imagesstep_userlog"><a href="#"><span class="individual_firstname">&nbsp;Taiki Taninokuchi</span></a>
                </div>
                <div class="col-12 individual_primary">
                    Final Evaluator
                </div>
                <div class="col-12">
                    <img src="<?= Yii::$app->homeUrl ?>image/Mohammed.png" class="imagesstep_userlog"><a href="#"><span class="individual_firstname">&nbsp;Mohammed Foruge</span></a>
                </div>
            </div>
        </div>
    </div>
</div>