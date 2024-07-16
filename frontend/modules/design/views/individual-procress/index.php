<?php

use Faker\Core\Number;
use Faker\Extension\NumberExtension;

$this->title = 'Individual Procress';

?>

<div class="col-12 mt-70 environment pt-10 pr-10 pl-10">
    <div class="bg-white pl-5 pr-5" style="border-radius: 5px;">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="individual_procress_step1">
                    <div class="row">
                        <div class="col-lg-4">
                            <img src="<?= Yii::$app->homeUrl ?>image/cat-1.jpg" class="individual_procress_image1">
                        </div>
                        <div class="col-lg-8">
                            <div class="procress_step_name">Teriyaki Bickleton </div>
                            <div class="procress_step_namecompany">Tokyo Consulting Firm Limited</div>
                            <div class="procress_step_country"> <img src="<?= Yii::$app->homeUrl ?>image/Spain.jpg" class="individual_procress_image2"> Japan</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="individual_procress_step2">
                    <div class="col-12">
                        <span class="b4weight">E3</span> <span class="b4E3"> Evaluation Phase</span>
                    </div>
                    <hr>
                    <div class="stepper-wrapper">
                        <div class="stepper-item">
                            <div class="step-counter">E1</div>
                        </div>
                        <div class="stepper-item">
                            <div class="step-counter">E2</div>
                        </div>
                        <div class="stepper-item">
                            <div class="step-counter">E3</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="individual_procress_step3">
                    <div class="row border-right">
                        <div class="col-md-6">
                            <div class="col-12 procress1_mid">MID</div>
                            <hr>
                            <div class="col-12 procress2_approval"><img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Ellipsegreen.png" class="imagesEllipse"> 1ST APPROVAL</div>
                            <div class="col-12 procress2_approval"><img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Ellipseorange.png" class="imagesEllipse"> 2nd APPROVAL</div>
                        </div>
                        <div class="col-md-6">
                            <div class="col-12 procress1_mid">FINAL</div>
                            <hr>
                            <div class="col-12 procress2_approval"><img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Ellipseblue.png" class="imagesEllipse"> Waiting</div>
                            <div class="col-12 procress2_approval"><img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Ellipseblue.png" class="imagesEllipse"> Waiting</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-6">
                <div class="row mt-15">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                        <div class="col-12 font-size-10 font-b">
                            Primary Evaluator
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                        <div class="col-12 font-size-10 font-b">
                            Final Evaluator
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3 mt-15">
                    <span class="input-group-text group-btnprimary pl-4 pr-5">1st</span>
                    <span class="form-control group-controltext">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-1">
                                        <img src="<?= Yii::$app->homeUrl ?>image/Watanabe.png" class="images2">
                                    </div>
                                    <div class="col-5">
                                        <span class="nameimages2">
                                            <div class="Directorfontsmall1"> Guru Rathon</div>
                                            <div class="Directorfontsmall1"> Director</div>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 border-left">
                                <div class="row">
                                    <div class="col-5">
                                        <span class="nameimages2">
                                            <div class="Directorfontsmall2"> Rathon</div>
                                            <div class="Directorfontsmall2"> title</div>
                                        </span>
                                    </div>

                                    <div class="col-1">
                                        <img src="<?= Yii::$app->homeUrl ?>image/Watanabe.png" class="images3">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </span>
                    <span class="input-group-text group-btnprimary pr-3 pl-2">2nd</span>
                </div>
                <span class="badge progressindividual_deadline_day">
                    <span class="text-danger">deadline</span>
                    <span class="text-secondary">: Mon,</span>
                    <span class="text-dark">Feb 28,2024</span>
                </span>
            </div>
        </div>
    </div>
    <div class="bg-white pl-10 pr-10 mt-20 pt-30" style="border-radius: 5px;">
        <div class="row">
            <div class="col-lg-8 col-md-6 col-sm-6 col-6">
                <div class="col-12">
                    <span class="Submit_Progress1">Submit Progress</span>
                    <span id="myP" class=""><i class="fa fa-check-circle-o right_cir_1st" aria-hidden="true"></i> <span id="number_steps_first">0</span> of 3 completed</span>
                </div>
                <div class="col-12 pt-10 pl-10">
                    <span class="text_b_kgi"> KFI</span> <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/arrow-solid.png">
                    <span class="text_b_kgi"> KGI</span> <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/arrow-solid.png">
                    <span class="text_b_kgi"> KPI</span> <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/arrow-solid.png">
                    <button class="submitprogress_arrow" onclick="move();this.disabled='true'">Submit</button>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-6 text-end text-primary">
                <a href="#" class="no-underline-primary"><i class="fa fa-chevron-circle-left" aria-hidden="true"></i> Back</a>
            </div>
        </div>
        <div class="d-grid mx-auto mt-20">
            <div class="submit_bcg">
                <div class="row">
                    <?php
                    for ($i = 1; $i <= 3; $i++) {
                    ?>
                        <div class="col-lg-3 procress_step_card">
                            <div class="col-12">
                                <span class="shadow_badgewhite"><img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/row_1.png" class="individual_step_kgi"></span> <span class="individual_procress_kfi">KFI</span>
                            </div>
                            <div class="col-12 pt-20">
                                <div class="col-12">
                                    <i class="fa fa-check-circle-o right_cir" aria-hidden="true"></i> <span class="pl-5 text-secondary">MID Evaluation</span>
                                </div>
                                <div class="col-12 pl-20 pt-5">
                                    <i class="fa fa-check-circle right_cir_1st" aria-hidden="true"></i> <span class="font-size-12 font-b text-secondary">1ST APPROVAL</span>
                                </div>
                                <div class="col-12 pl-20 pt-5">
                                    <i class="fa fa-check-circle right_cir_1st" aria-hidden="true"></i> <span class="font-size-12 font-b text-secondary">2nd APPROVAL</span>
                                </div>
                            </div>
                            <div class="col-12 pt-20">
                                <div class="col-12">
                                    <i class="fa fa-check-circle-o right_cir_nf" aria-hidden="true"></i> <span class="pl-5 text-secondary">MID Evaluation</span>
                                </div>
                                <div class="col-12 pl-20 pt-5">
                                    <i class="fa fa-check-circle right_cir_1st_nf" aria-hidden="true"></i> <span class="font-size-12 font-b text-secondary">Waiting</span>
                                </div>
                                <div class="col-12 pl-20 pt-5">
                                    <i class="fa fa-check-circle right_cir_1st_nf" aria-hidden="true"></i> <span class="font-size-12 font-b text-secondary">Waiting</span>
                                </div>
                            </div>
                        </div>

                    <?php
                    }
                    ?>
                    <div class="col-12 text-center pb-20">
                        <button class="btn btn-primary pl-60 pr-60 pt-3 pb-3" type="submit">SUBMIT</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>