<?php

$this->title = 'Rank Increasement';

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
                    <div class="col-lg-3">
                        <div class="col-12 Framerank">
                            Rank & Incasement
                        </div>
                    </div>
                    <div class="col-lg-3 mt-5">
                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Create(Small).png" class="Createsmall"><span class="adRank"> ADD RANK</span>
                    </div>
                    <div class="col-lg-6 text-end">
                        <span type="button" class="badge primarysave"> Save</span>
                    </div>
                </div>
                <div class="col-12">
                    <div class="alert p-2 trantRank mt-20">
                        <div class="row">
                            <div class="col-lg-1">
                                Rank
                            </div>
                            <div class="col-lg-3 text-center">
                                Score
                            </div>
                            <div class="col-lg-4 text-center">
                                evaluation score
                            </div>
                            <div class="col-lg-2">
                                Increment
                            </div>
                            <div class="col-lg-1">
                                bonus
                            </div>
                            <div class="col-lg-1">
                                Action
                            </div>
                        </div>
                    </div>
                    <div class="alert p-2 trantRow">
                        <div class="row">
                            <div class="col-lg-1 letter">
                                F
                            </div>
                            <div class="col-lg-3 ScoreSolid text-center">
                                <?= number_format(0) ?>-<?= number_format(11) ?>
                            </div>
                            <div class="col-lg-4 ScoreSolid">
                                <div class="progressRank">
                                    <div class="barent" style="width:15%">
                                        <span class="percent"></span>
                                    </div>
                                    <span class="badge badge-percent">F</span>
                                </div>
                            </div>
                            <div class="col-lg-2 ScoreSolid">
                                <?= number_format(0.0) ?>
                            </div>
                            <div class="col-lg-1 ScoreSolid">
                                <?= number_format(0.0) ?>
                            </div>
                            <div class="col-lg-1 ScoreSolid">
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/deletered.png" class="DeleteRound">
                            </div>
                        </div>
                    </div>
                    <div class="alert p-2 trantRow">
                        <div class="row">
                            <div class="col-lg-1 letter">
                                E
                            </div>
                            <div class="col-lg-3 ScoreSolid text-center">
                                <?= number_format(11) ?>-<?= number_format(20) ?>
                            </div>
                            <div class="col-lg-4 ScoreSolid">
                                <div class="progressRank">
                                    <div class="barent-1" style="width:15%">
                                        <span class="percent"></span>
                                    </div>
                                    <span class="badge badge-percent">E</span>
                                </div>
                            </div>
                            <div class="col-lg-2 ScoreSolid">
                                <?= number_format(0.0) ?>
                            </div>
                            <div class="col-lg-1 ScoreSolid">
                                <?= number_format(0.0) ?>
                            </div>
                            <div class="col-lg-1 ScoreSolid">
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/deletered.png" class="DeleteRound">
                            </div>
                        </div>
                    </div>
                    <div class="alert p-2 trantRow">
                        <div class="row">
                            <div class="col-lg-1 letter">
                                D
                            </div>
                            <div class="col-lg-3 ScoreSolid text-center">
                                <?= number_format(21) ?>-<?= number_format(30) ?>
                            </div>
                            <div class="col-lg-4 ScoreSolid">
                                <div class="progressRank">
                                    <div class="barent-2" style="width:15%">
                                        <span class="percent"></span>
                                    </div>
                                    <span class="badge badge-percent">D</span>
                                </div>
                            </div>
                            <div class="col-lg-2 ScoreSolid">
                                <?= number_format(0.0) ?>
                            </div>
                            <div class="col-lg-1 ScoreSolid">
                                <?= number_format(0.0) ?>
                            </div>
                            <div class="col-lg-1 ScoreSolid">
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/deletered.png" class="DeleteRound">
                            </div>
                        </div>
                    </div>
                    <div class="alert p-2 trantRow">
                        <div class="row">
                            <div class="col-lg-1 letter">
                                C
                            </div>
                            <div class="col-lg-3 ScoreSolid text-center">
                                <?= number_format(31) ?>-<?= number_format(40) ?>
                            </div>
                            <div class="col-lg-4 ScoreSolid">
                                <div class="progressRank">
                                    <div class="barent-3" style="width:15%">
                                        <span class="percent"></span>
                                    </div>
                                    <span class="badge badge-percent">C</span>
                                </div>
                            </div>
                            <div class="col-lg-2 ScoreSolid">
                                <?= number_format(1.5) ?>
                            </div>
                            <div class="col-lg-1 ScoreSolid">
                                <?= number_format(0.5) ?>
                            </div>
                            <div class="col-lg-1 ScoreSolid">
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/deletered.png" class="DeleteRound">
                            </div>
                        </div>
                    </div>
                    <div class="alert p-2 trantRow">
                        <div class="row">
                            <div class="col-lg-1 letter">
                                S
                            </div>
                            <div class="col-lg-3 ScoreSolid text-center">
                                <?= number_format(31) ?>-<?= number_format(40) ?>
                            </div>
                            <div class="col-lg-4 ScoreSolid">
                                <div class="progressRank">
                                    <div class="barent-4" style="width:15%">
                                        <span class="percent"></span>
                                    </div>
                                    <span class="badge badge-percent">S</span>
                                </div>
                            </div>
                            <div class="col-lg-2 ScoreSolid">
                                <?= number_format(1.5) ?>
                            </div>
                            <div class="col-lg-1 ScoreSolid">
                                <?= number_format(1.59) ?>
                            </div>
                            <div class="col-lg-1 ScoreSolid">
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/deletered.png" class="DeleteRound">
                            </div>
                        </div>
                    </div>
                    <div class="alert p-2 trantRow">
                        <div class="row">
                            <div class="col-lg-1 letter">
                                <input type="text" class="form-control numfixletter" placeholder="RANK">
                            </div>
                            <div class="col-lg-3 ScoreSolid">
                                <div class="row">
                                    <div class="col-4">
                                        <input type="text" class="form-control numfix" placeholder="Score">
                                    </div>
                                    <div class="col-4">
                                        <input type="text" class="form-control numfix" placeholder="Score">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 ScoreSolid">
                                <div class="progressRank">
                                    <div class="barent">
                                        <span class="percent"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2 ScoreSolid">
                                <input type="text" class="form-control numfix" placeholder="Increment">
                            </div>
                            <div class="col-lg-1 ScoreSolid">
                                <input type="text" class="form-control numfixbonus" placeholder="Bonus">
                            </div>
                            <div class="col-lg-1 ScoreSolid">
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/deletered.png" class="DeleteRound">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>