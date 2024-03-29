<?php

$this->title = 'Rank Increasement';

?>

<div class="col-12 mt-70 environment pt-10 pr-10 pl-20">
    <div class="row">
        <div class="col-lg-2 col-md-6 col-12 pr-0 pl-5">
            <div class="border-bottom pb-20">
                <div class="row">
                    <div class="col-5 text-center pr-5 pl-5">
                        <img src="<?= Yii::$app->homeUrl ?>image/BD.jpg" class="imagealertEvaluator">
                    </div>
                    <div class="col-7 font-size-14 font-b pr-5 pl-10 pt-0">
                        Tokyo Consulting Firm Pvt. Ltd
                    </div>
                </div>
            </div>
            <div class="col-12 Evaluator-country font-size-12 mt-10">
                &nbsp;&nbsp; <img src="<?= Yii::$app->homeUrl ?>image/Thailand.png" class="imageEvaluatorcountry"> Bangkok, Thailand
            </div>
            <div class="col-12 mt-20">
                <div class="mb-5 bg-body rounded-1 text-center font-size-12 pt-5 pr-5 pl-5 pb-5 font-weight-500 text-black-50">
                    Mid Term Evaluation Phase
                    <div class="E3 mt-5"> E3 </div>
                </div>
            </div>

            <div class="col-12 bg-white rounded-1 mt-40 pb-10">
                <div class="col-12 EvaluatorConfiguration pt-20 pl-10 border-bottom pb-20">
                    <i class="fa fa-cog mr-5" aria-hidden="true"></i>Set Configuration
                </div>
                <div class="col-12 mt-20">
                    <div class="rad-label pl-0 mt-10 pr-0">
                        <div class="col-12 pl-5 rad-text pr-3">
                            <i class="fa fa-check-circle-o text-success mr-10 font-size-18" aria-hidden="true"></i>
                            <span class="text-dark font-weight-500 ">Evaluation Frame</span>
                        </div>
                    </div>
                    <div class="Evaluationdeshed"></div>
                    <div class="rad-label pl-0 pr-0 pt-0">
                        <div class="col-12 pl-5 rad-text pr-3">
                            <i class="fa fa-circle mr-10 font-size-18 text-secondary" aria-hidden="true"></i>
                            <span class="text-dark font-weight-500">Weight Allocation</span>
                        </div>
                    </div>
                    <div class="Evaluationdeshed"></div>
                    <div class="rad-label pl-0 pr-0">
                        <div class="col-12 pl-5 rad-text pr-3">
                            <i class="fa fa-circle mr-10 font-size-18 text-secondary" aria-hidden="true"></i>
                            <span class="text-dark font-weight-500">Evaluator Settings</span>
                        </div>
                    </div>
                    <div class="Evaluationdeshed"></div>
                    <div class="rad-label pl-0 pr-0">
                        <div class="col-12 pl-5 rad-text pr-3">
                            <i class="fa fa-circle mr-10 font-size-18 text-secondary" aria-hidden="true"></i>
                            <span class="text-dark font-weight-500">Rank & Increasement</span>
                        </div>
                    </div>
                    <div class="Evaluationdeshed"></div>
                    <div class="rad-label pl-0 pr-0">
                        <div class="col-12 pl-5 rad-text pr-3">
                            <i class="fa fa-circle mr-10 font-size-18 text-secondary" aria-hidden="true"></i>
                            <span class="text-dark font-weight-500">Salary & Allowance Range</span>
                        </div>
                    </div>
                    <div class="Evaluationdeshed"></div>
                    <div class="rad-label pl-0 pr-0">
                        <div class="col-12 pl-5 rad-text pr-3">
                            <i class="fa fa-circle mr-10 font-size-18 text-secondary" aria-hidden="true"></i>
                            <span class="text-dark font-weight-500">Bonus calculation</span>
                        </div>
                    </div>
                    <div class="Evaluationdeshed"></div>
                    <div class="rad-label pl-0 pr-0">
                        <div class="col-12 pl-5 rad-text pr-3">
                            <i class="fa fa-circle mr-10 font-size-18 text-secondary" aria-hidden="true"></i>
                            <span class="text-dark font-weight-500">Promotion</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-10 col-md-6 col-12">
            <div class="bg-white pmi_bakgru">
                <div class="col-12">
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="col-12 Framerank">
                                Rank & Incasement
                            </div>
                        </div>
                        <div class="col-lg-3 mt-5" style="cursor:pointer;">
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Create(Small).png" class="Createsmall"><span class="adRank"> ADD RANK</span>
                        </div>
                        <div class="col-lg-6 text-end">
                            <div type="button" class="badge primarysave"> Save</div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <table class="table p-2 trantRank mt-20">
                        <thead class="font-size-10">
                            <th>Rank</th>
                            <th>Score</th>
                            <th>evaluation score </th>
                            <th>Increment</th>
                            <th>bonus</th>
                            <th>Action</th>
                        </thead>
                    </table>
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