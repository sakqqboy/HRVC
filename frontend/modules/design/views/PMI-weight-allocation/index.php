<?php

$this->title = 'PMI Weight Allocation';

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
                <div class="row">
                    <div class="col-4">
                        <div class="FrameEvaluation"> PMI Weight Allocation</div>
                    </div>
                    <div class="col-4">
                        <button type="submit" class="btn text-white pt-3 pb-3" style="border-radius: 3px;background-color:#2580D3;font-size:13px;"> Allocate Weight</button>
                    </div>
                    <div class="col-4 text-end">
                        <button type="submit" class="btn btn-info Next-1 pt-4 pb-4"> Next <i class="fa fa-angle-double-right" aria-hidden="true"></i></button>
                    </div>
                </div>
                <div class="row mt-20">
                    <div class="col-lg-9">
                        <div class="col-12 andAccounts">
                            Accounts & Taxation
                        </div>
                        <div class="row mt-20">
                            <div class="col-lg-2 col-md-6 col-12">
                                <div class="alert alert-Evaluator">
                                    <div class="col-12 text_PIM">
                                        PIM
                                    </div>
                                    <div class="col-12 mt-10">
                                        <div id="progress1">
                                            <div data-num="85" class="progress-item1" data-value="85%" style="background: conic-gradient(rgb(41, 140, 233) calc(35%), rgb(219, 239, 247) 0deg);">85%</div>
                                        </div>
                                    </div>
                                    <div class="alert alert-white">
                                        <div class="col-12 mt-30">
                                            <div class="form-check" style="margin-left: -5px;">
                                                <input class="form-check-input" type="checkbox" value="" id="" checked>
                                                <label class="form-check-label" for="flexCheckChecked"></label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class=""></div>
                                            <span class="badge bg-chartpurple">
                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Light/Light/24px/charts.png" class="icons-KGI">
                                                <div class="mt-5"> KFI</div>
                                                <div class="mt-5">60%</div>
                                            </span>
                                        </div>
                                        <div class="col-12 mt-30">
                                            <div class="form-check" style="margin-left: -5px;">
                                                <input class="form-check-input" type="checkbox" value="" id="" checked>
                                                <label class="form-check-label" for="flexCheckChecked"></label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <span class="badge bg-chartwarn">
                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Light/Light/48px/KGI.png" class="icons-KGI">
                                                <div class="mt-5"> KGI</div>
                                                <div class="mt-5">20%</div>
                                            </span>
                                        </div>
                                        <div class="col-12 mt-30">
                                            <div class="form-check" style="margin-left: -5px;">
                                                <input class="form-check-input" type="checkbox" value="" id="" checked>
                                                <label class="form-check-label" for="flexCheckChecked"></label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <span class="badge bg-cha">
                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Light/Light/48px/KPI.png" class="icons-KGI">
                                                <div class="mt-5"> KPI</div>
                                                <div class=" mt-5">20%</div>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-10 col-md-6 col-12">
                                <div class="alert alert-Evaluator silly_scrollbar">
                                    <div class="card">
                                        <div class="row">
                                            <div class="col-5 flagkey">
                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/24px/KGI.png" class="icons-KGI2"> Key Goal Indicator
                                            </div>
                                            <div class="col-4 text-end">
                                                <div class="col-12 flagkey">
                                                    Participants
                                                </div>
                                            </div>
                                            <div class="col-3 text-end">
                                                <span class="badge rounded-pill bg-gray pt-2 pb-2">
                                                    <ul class="try-cricle">
                                                        <li class="tri-li"> <img src="<?= Yii::$app->homeUrl ?>image/avatar1.png" class="image-avatar1"></li>
                                                        <li class="tri-li"> <img src="<?= Yii::$app->homeUrl ?>image/Watanabe.png" class="image-avatar2"></li>
                                                        <a href="" class="none">
                                                            <li class="tri-li-number"> 2 </li>
                                                        </a>
                                                    </ul>
                                                </span>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <?php
                                            for ($i = 1; $i <= 6; $i++) {
                                            ?>

                                                <div class="col-lg-2">
                                                    <div class="card font-size-12" style="width: 3rem;margin-left:-3px;">
                                                        <div class="card-header fonTotal">Total Sales</div>
                                                        <div class="card-body text-dark">
                                                            <div class="col-12">
                                                                <span class="badge bg-lighttotal text-primary">
                                                                    <?= number_format(598) ?>k
                                                                </span>
                                                            </div>
                                                            <div class="col-12 text-primary text-center pt-10" style="font-size:9px;">
                                                                <?= number_format(23) ?>%
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            <?php
                                            }
                                            ?>
                                            <!-- <div class="col-lg-2">
                                                <div class="card" style="width: 4rem;font-size:12px;">
                                                    <div class="card-header fonTotal">Profit</div>
                                                    <div class="card-body text-dark">
                                                        <div class="col-12">
                                                            <span class="badge bg-lighttotal text-primary">
                                                                <?= number_format(562) ?>k
                                                            </span>
                                                        </div>
                                                        <div class="col-12 text-primary text-center pt-10">
                                                            <?= number_format(11) ?>%
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-2">
                                                <div class="card" style="width: 4rem; font-size:12px;">
                                                    <div class="card-header fonTotal">Net Profit</div>
                                                    <div class="card-body text-dark">
                                                        <div class="col-12 text-center">
                                                            <span class="badge bg-lighttotal text-primary">
                                                                <?= number_format(100000) ?>k
                                                            </span>
                                                        </div>
                                                        <div class="col-12 text-primary text-center pt-10">
                                                            <?= number_format(8) ?>%
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-2">
                                                <div class="card" style="width: 4rem; font-size:12px;">
                                                    <div class="card-header fonTotal">Cost</div>
                                                    <div class="card-body text-dark">
                                                        <div class="col-12">
                                                            <span class="badge bg-lighttotal text-primary">
                                                                <?= number_format(15) ?>%
                                                            </span>
                                                        </div>
                                                        <div class="col-12 text-primary text-center pt-10">
                                                            <?= number_format(8) ?>%
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-2">
                                                <div class="card" style="width: 4rem; font-size:12px;">
                                                    <div class="card-header fonTotal">labor</div>
                                                    <div class="card-body text-dark">
                                                        <div class="col-12">
                                                            <span class="badge bg-lighttotal text-primary">
                                                                5 Times
                                                            </span>
                                                        </div>
                                                        <div class="col-12 text-primary text-center pt-10">
                                                            <?= number_format(8) ?>%
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-2">
                                                <div class="card" style="width: 4rem; font-size:12px;">
                                                    <div class="card-header fonTotal">Webinar</div>
                                                    <div class="card-body text-dark">
                                                        <div class="col-12">
                                                            <span class="badge bg-lighttotal text-primary">
                                                                <?= number_format(458) ?>k
                                                            </span>
                                                        </div>
                                                        <div class="col-12 text-primary text-center pt-10">
                                                            <?= number_format(8) ?>%
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> -->
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="row">
                                            <div class="col-5 flagkey">
                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/24px/KPI.png" class="icons-KGI2"> Key Performance Indicator
                                            </div>
                                            <div class="col-4 text-end">
                                                <div class="col-12 flagkey">
                                                    Participants
                                                </div>
                                            </div>
                                            <div class="col-3 text-end">
                                                <span class="badge rounded-pill bg-gray pt-2 pb-2">
                                                    <ul class="try-cricle">
                                                        <li class="tri-li"> <img src="<?= Yii::$app->homeUrl ?>image/avatar1.png" class="image-avatar1"></li>
                                                        <li class="tri-li"> <img src="<?= Yii::$app->homeUrl ?>image/Watanabe.png" class="image-avatar2"></li>
                                                        <a href="" class="none">
                                                            <li class="tri-li-number"> 2 </li>
                                                        </a>
                                                    </ul>
                                                </span>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="card" style="width: 6rem;font-size:12px;">
                                                    <div class="card-header fonTotal">Total Sales</div>
                                                    <div class="card-body text-dark">
                                                        <div class="col-12 text-center">
                                                            <span class="badge bg-lighttotal text-primary">
                                                                <?= number_format(598) ?>k
                                                            </span>
                                                        </div>
                                                        <div class="col-12 text-primary text-center pt-10">
                                                            <?= number_format(23) ?>%
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="card" style="width: 6rem;font-size:12px;">
                                                    <div class="card-header fonTotal">Total Sales</div>
                                                    <div class="card-body text-dark">
                                                        <div class="col-12 text-center">
                                                            <span class="badge bg-lighttotal text-primary">
                                                                <?= number_format(562) ?>k
                                                            </span>
                                                        </div>
                                                        <div class="col-12 text-primary text-center pt-10">
                                                            <?= number_format(11) ?>%
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="card" style="width: 6rem; font-size:12px;">
                                                    <div class="card-header fonTotal">Total Sales</div>
                                                    <div class="card-body text-dark">
                                                        <div class="col-12 text-center">
                                                            <span class="badge bg-lighttotal text-primary">
                                                                <?= number_format(100000) ?>k
                                                            </span>
                                                        </div>
                                                        <div class="col-12 text-primary text-center pt-10">
                                                            <?= number_format(8) ?>%
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

                    <div class="col-lg-3 col-md-6 col-12">
                        <div class="col-12 txt-Weight mt-10">
                            <img src="<?= Yii::$app->homeUrl ?>image/weight.png" class="image-weight"> &nbsp; Weight Configurations
                        </div>
                        <div class="alert alert-Evaluator mt-15">
                            <div class="card background_E7F0FE pl-10 pr-10">

                                <?php
                                for ($i = 1; $i <= 8; $i++) {
                                ?>

                                    <div class="badge bg-white mt-10 pt-7 pb-7" style="border-radius: 1px;">
                                        <div class="row">
                                            <div class="col-10 border-edit  text-start">
                                                Internal Control
                                            </div>
                                            <div class="col-1">
                                                <i class="fa fa-pencil-square-o weight-pencil" aria-hidden="true"></i>
                                            </div>
                                            <div class="col-1">
                                                <i class="fa fa-trash weight-trash" aria-hidden="true"></i>
                                            </div>
                                        </div>
                                    </div>

                                <?php
                                }
                                ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>