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
                        <div class="col-lg-3 mt-5">
                            <a href="<?= Yii::$app->homeUrl ?>designfront/add-rank" class="no-underline text-dark">
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Create(Small).png" class="Createsmall"><span class="adRank"> ADD RANK</span>
                            </a>
                        </div>
                        <div class="col-lg-6 text-end">
                            <div type="button" class="badge primarysave"> Save</div>
                        </div>
                    </div>
                </div>
                <div class="col-12 mt-20">
                    <table class="table table-borderless table-striped">
                        <thead class="font-size-10">
                            <th class="increasement-rank">Rank</th>
                            <th class="increasement-rank">Score</th>
                            <th class="increasement-rank">evaluation score </th>
                            <th class="increasement-rank">Increment</th>
                            <th class="increasement-rank">bonus</th>
                            <th class="increasement-rank">Action</th>
                        </thead>
                        <tbody>

                            <?php
                            for ($i = 1; $i <= 4; $i++) {
                            ?>
                                <tr>
                                    <td>
                                        <div class="col-12 letter border-right">
                                            F
                                        </div>
                                    </td>
                                    <td>
                                        <div class="col-12 border-right text-center font-size-12">
                                            <?= number_format(0) ?>-<?= number_format(11) ?>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="progressRank border-right">
                                            <div class="barent" style="width:70%">
                                                <span class="percent"></span>
                                            </div>
                                            <span class="badge badge-percent">F</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="col-12 border-right text-center">
                                            <?= number_format(0.0) ?>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="col-12 border-right text-center">
                                            <?= number_format(0.0) ?>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="col-12 text-center">
                                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/deletered.png" class="DeleteRound">
                                        </div>
                                    </td>
                                </tr>

                            <?php
                            }
                            ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>