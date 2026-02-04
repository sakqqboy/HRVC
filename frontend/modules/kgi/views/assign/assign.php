<?php

use yii\bootstrap5\ActiveForm;

$this->title = Yii::t('app', 'Assign KGI');
?>
<?php if (Yii::$app->session->hasFlash('alert-kgi')) : ?>

    <script>
        window.onload = function() {
            $('.alert-box-info').slideDown(500);
            setTimeout(function() {
                $('.alert-box-info').fadeOut(300);
            }, 3000);
        }
    </script>

<?php endif; ?>


<div class="col-12 mt-70 pt-20 pim-content1" onload="showAlertBox()">
    <div class="d-flex justify-content-start pt-0 pb-0" style="line-height: 30px;">
        <img src="<?= Yii::$app->homeUrl ?>images/icons/black-icons/FinancialSystem/Group23177.svg"
            class="pim-head-icon mr-11 mt-2">
        <span class="pim-head-text mr-10"> <?= Yii::t('app', 'Performance Indicator Matrices (PIM)') ?></span>
    </div>
    <?= $this->render('header_filter', [
        "role" => $role,
        "allCompany" => $allCompany,
        "companyPic" => $companyPic,
        "totalBranch" => $totalBranch,
        "page" => 'grid'
    ]) ?>
    <?php
    $form = ActiveForm::begin([
        'id' => 'update-kgi-team-employee',
        'method' => 'post',
        'options' => [
            'enctype' => 'multipart/form-data',
        ],
        'action' => Yii::$app->homeUrl . 'kgi/assign/update-team-kgi'

    ]); ?>

    <div class="col-12 mt-20" id="box-wrapper">
        <div class="bg-white-employee" id="pim-content">
            <div class="row" style="--bs-gutter-x:10px;">
                <div class="col-lg-5 col-12"><!-- left => select team -->
                    <div class="row" style="--bs-gutter-x:0px;">
                        <div class="col-9 text-truncate pim-name-title" style="display: flex; align-items: center; gap: 14px;">
                            <!-- <a href="<?= $url ?>" class="font-size-12 mr-10 font-weight-600" style="text-decoration: none;">
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/back.svg" class="mr-3" style="margin-top: -4px;">
                                <text class="pim-text-back">
                                    <?= Yii::t('app', 'Back') ?>
                                </text>
                            </a> -->
                            <a href="<?= $url ?>" style="text-decoration: none; width:70px; height:26px;" class="btn-create-branch">
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/back-white.svg" style="width:18px; height:18px; margin-top:-3px;">
                                <?= Yii::t('app', 'Back') ?>
                            </a>
                            <input type="hidden" id="url" name="url" value="<?= $url ?>">
                            <?= $kgiDetail["kgiName"] ?>
                        </div>
                        <div class="col-lg-3 text-end" style="line-height: 21px;align-content:center;">
                            <button class="btn-create font-size-12 ml-10" style="text-decoration: none;" type="submit">
                                <div class="ml-7 mr-7" style="gap: 5px;">
                                    <img src="<?= Yii::$app->homeUrl ?>image/save-whiet.svg" style="width:15px;margin-top:-3px;">
                                    <?= Yii::t('app', 'Save') ?>
                                </div>
                            </button>
                        </div>
                        <div class="col-12  ligth-gray-box mt-10 mb-10" style="height: 400px;overflow-y:auto;">
                            <div class="col-12 bg-white pl-8 pr-8 mt-8 mb-10">
                                <div class="row" style="--bs-gutter-x:0px;">
                                    <div class="col-6 font-size-12 pt-5 pb-3"><b><?= Yii::t('app', 'Assign Team') ?></b></div>
                                    <div class="col-6 text-end  font-size-12 pt-5 pb-3">
                                        <b><?= Yii::t('app', 'ALLOCATE') ?> &nbsp;&nbsp;<?= Yii::t('app', 'TARGET') ?></b>
                                    </div>
                                </div>
                            </div>
                            <?php
                            $totalTeam = 0;
                            $totalTarget = 0;
                            if (isset($teams) && count($teams) > 0) {
                                foreach ($teams as $team):
                                    $target = 0;
                                    $checked = "";
                                    if (isset($kgiTeams) && count($kgiTeams) > 0) {
                                        foreach ($kgiTeams as $kgiTeamId => $kgiTeam):
                                            if ($kgiTeam["teamId"] == $team['teamId']) {
                                                $target = $kgiTeam["target"];
                                                $checked = "checked";
                                                $totalTeam++;
                                                $totalTarget += $target;
                                            }
                                        endforeach;
                                    }
                                    if ($role == 3 && $team["teamId"] != $userTeamId) {
                                        $disableTeam = "disabled";
                                    } else {
                                        $disableTeam = "";
                                    }
                            ?>
                                    <div class="assign-team">
                                        <div class="">
                                            <input type="checkbox" name="team[<?= $team['teamId'] ?>]"
                                                id="team-<?= $team['teamId'] ?>" <?= $checked ?> class="from-check <?= $role <= 3 ? 'd-none' : '' ?>"
                                                value="<?= $team['teamId'] ?>"
                                                onclick="javascript:assignKgiToEmployeeInTeam(<?= $team['teamId'] ?>,<?= $kgiId ?>)">
                                            <!--kgi_employee-->
                                            <?php
                                            if ($role <= 3 && $checked == "checked") { ?>
                                                <i class="fa fa-check-square text-primary" aria-hidden="true"></i>
                                            <?php
                                            }
                                            if ($role <= 3 && $checked == '') { ?>
                                                <i class="fa fa-check-square text-primary invisible" aria-hidden="true"></i>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                        <div class="cycle-pim-assign-team">
                                            <img src="<?= Yii::$app->homeUrl ?>image/teams.svg" alt="icon">
                                        </div>

                                        <div class="font-size-12 " style="width:160px;line-height:12px;">
                                            <b><?= $team["teamName"] ?></b>
                                            <div class="font-size-10 text-truncate " style="width:150px;">
                                                <?= $team["departmentName"] ?>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1  text-end">
                                            <?php
                                            if ($disableTeam == "") {
                                            ?>
                                                <input type="text" class="assign-target text-end font-size-12 numberOnly teamTarget"
                                                    value="<?= $target > 0 ? number_format($target, 2) : '' ?>" onkeyup="javascript:calculateEmployeeTargetValue(event,<?= $team['teamId'] ?>)"
                                                    name="teamTarget[<?= $team['teamId'] ?>]" placeholder="0.00" id="teamTarget-<?= $team['teamId'] ?>">
                                            <?php
                                            } else {
                                            ?>
                                                <input type="text" placeholder="0.00" class="assign-target text-end font-size-12"
                                                    value="<?= $target > 0 ? number_format($target, 2) : '' ?>"
                                                    name="teamTarget[<?= $team['teamId'] ?>]" <?= $disableTeam ?>>
                                                <input type="hidden" value="<?= $target > 0 ? number_format($target, 2) : '' ?>"
                                                    name="teamTarget[<?= $team['teamId'] ?>]" id="teamTarget-<?= $team['teamId'] ?>">
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                            <?php
                                endforeach;
                            }
                            if ($totalTeam > 0) {
                                $teamAverage = $totalTarget / $totalTeam;
                            } else {
                                $teamAverage = 0;
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7 col-12"><!-- right => select each person in  team -->
                    <?php
                    if ($kgiTeamEmployee["base"]["totalTargetAll"] > $kgiDetail["targetAmount"]) {
                        if ($kgiDetail["targetAmount"] > 0) {
                            $percentage = (($kgiTeamEmployee["base"]["totalTargetAll"] / $kgiDetail["targetAmount"]) * 100) - 100;
                        } else {
                            $percentage = 0;
                        }
                        $isMoreSet = 1;
                    } else {
                        if ($kgiDetail["targetAmount"] > 0) {
                            $percentage = 100 - (($kgiTeamEmployee["base"]["totalTargetAll"] / $kgiDetail["targetAmount"]) * 100);
                        } else {
                            $percentage = 0;
                        }
                        $isMoreSet = 0;
                        if ($kgiTeamEmployee["base"]["totalTargetAll"] == $kgiDetail["targetAmount"]) {
                            $percentage = 0;
                            $isMoreSet = "-";
                        }
                    }
                    ?>
                    <div class="d-flex" style="width:100%;height:30px;">
                        <div class="summarize-assign border-right" style="width:25%;">
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/pim/curve.svg" class="pim-icon mr-5" alt="icon">
                            <?= Yii::t('app', 'Avg') ?>/<?= Yii::t('app', 'Team') ?>
                            <span class="font-size-12 ms-auto mr-5"><b><?= number_format($teamAverage) ?></b></span>
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/help.svg" alt="icon" style="width:14px;height:14px;cursor:pointer;">
                        </div>
                        <div class="alert-box-info text-center">
                            S A V E D ! ! !
                        </div>
                        <div class="summarize-assign border-right" style="width:34%;">
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/pim/curve.svg" class="pim-icon mr-5" alt="icon">
                            <?= Yii::t('app', 'Avg') ?>/<?= Yii::t('app', 'Individual') ?>
                            <span class="font-size-12 ms-auto mr-5"><b><?= number_format($kgiTeamEmployee["base"]["averageTarget"]) ?></b></span>
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/help.svg" alt="icon" style="width:14px;height:14px;cursor:pointer;">
                        </div>
                        <div class="summarize-assign border-right" style="width:25%;">
                            <div class="align-content-center text-center" style="line-height:14px;">
                                <span class="font-size-12"><b><?= number_format($kgiTeamEmployee["base"]["totalTargetAll"]) ?></b></span>
                                <div class="col-12 font-size-10"><?= Yii::t('app', 'Total Assigned Target') ?></div>
                            </div>
                            <div class="align-content-center text-center ms-auto">
                                <?php
                                if ($isMoreSet == "1") {
                                ?>
                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/arrow-up.svg" style="width:8px;">
                                <?php
                                }
                                if ($isMoreSet == "0") {
                                ?>
                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/arrow-down.svg" style="width:8px;">
                                <?php
                                }
                                ?>
                                <?= number_format($percentage, 1) ?>%
                            </div>

                        </div>
                        <div class="flex-grow-1 align-content-center text-center" style="line-height:14px;">
                            <span class="font-size-12"><b><?= number_format($kgiDetail["targetAmount"]) ?></b></span>
                            <div class="font-size-10">
                                <?= Yii::t('app', 'Master & Target') ?></div>
                        </div>

                    </div>
                    <div class="col-12 ligth-gray-box mb-10 mt-7" style="height: 400px;overflow-y:auto;">
                        <div class="col-12 bg-white pl-8 pr-8 mt-8 mb-10">
                            <div class="row">
                                <div class="col-5 font-size-12 pt-5 pb-3"><b><?= Yii::t('app', 'Assign Individuals') ?></b></div>
                                <div class="col-3 font-size-12 pt-5 pb-3 text-center">
                                    <?= Yii::t('app', 'ALLOCATE') ?> &nbsp;&nbsp;<?= Yii::t('app', 'TARGET') ?>
                                </div>
                                <div class="col-4 font-size-12 pt-5 pb-3 text-center"><?= Yii::t('app', 'REMARKS') ?></div>
                            </div>
                        </div>
                        <div class="col-12 pr-0 pl-0 pt-0" id="team-employee-target">
                            <?= $this->render('employee_team', [
                                "kgiTeamEmployee" => $kgiTeamEmployee,
                                "role" => $role,
                                "userTeamId" => $userTeamId
                            ]) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<input type="hidden" name="kgiId" value="<?= $kgiId ?>" id="kgiId">
<input type="hidden" name="companyId" value="<?= $companyId ?>">
<input type="hidden" name="month" value="<?= $kgiDetail["month"] ?>" id="month">
<input type="hidden" name="year" value="<?= $kgiDetail["year"] ?>" id="year">
<?php ActiveForm::end(); ?>