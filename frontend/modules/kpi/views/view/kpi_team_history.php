<?php

use common\models\ModelMaster;
use yii\bootstrap5\ActiveForm;

$this->title = 'Team KPI History';
?>

<div class="col-12 mt-70 pt-20 pim-content1">
    <div class="d-flex justify-content-start pt-0 pb-0" style="line-height: 30px;">
        <img src="<?= Yii::$app->homeUrl ?>images/icons/black-icons/FinancialSystem/Group23177.svg"
            class="pim-head-icon mr-11 mt-2">
        <span class="pim-head-text mr-10"> <?= Yii::t('app', 'Performance Indicator Matrices') ?> (PIM)</span>
    </div>
    <?= $this->render('header_filter', [
        "role" => $role,
        "allCompany" => $allCompany,
        "companyPic" => $companyPic,
        "totalBranch" => $totalBranch
    ]) ?>
    <div class="col-12 mt-20" id="box-wrapper">
        <div class="bg-white-employee">
            <div class="font-size-12 pl-5" style="width: 100%;">
                <a href="<?= Yii::$app->homeUrl ?>kpi/kpi-team/team-kpi-grid" class="mr-5 pim-text-back">
                    <i class="fa fa-caret-left mr-3" aria-hidden="true"></i>
                    <?= Yii::t('app', 'Back') ?>
                </a>
                <span class="pim-name">
                    <?= $kpiDetail["kpiName"] ?>
                </span>
            </div>
            <div class="row mt-20" style="--bs-gutter-x:0px;">
                <?php
                if (isset($kpiTeamsHistory) && count($kpiTeamsHistory) > 0) {
                    $i = 0;
                    foreach ($kpiTeamsHistory as $year => $kpiMonth) :
                        foreach ($kpiMonth as $month => $kpi):
                            if ($kpi["isOver"] == 1 && $kpi["status"] != 2) {
                                $colorFormat = 'over';
                                 $statusText = "Due Passed";
                            } else {
                                if ($kpi["status"] == 1) {
                                    if ($kpi["isOver"] == 2) {
                                        $colorFormat = 'disable';
                                        $statusText = "Not Set";
                                    } else {
                                        $colorFormat = 'inprogress';
                                        $statusText = "In Progress";
                                    }
                                } else {
                                    $colorFormat = 'complete';
                                    $statusText = "Completed";
                                }
                            }
                            
                ?>

                <div class="col-lg-4 col-md-6 col-12 p-2">
                    <div class="pim-big-box-view pim-<?= $colorFormat ?>">
                        <div class="d-inline-flex" style="width:100%;">
                            <div class="d-flex pim-name-history" style="height: 32px;"><?= $kpi["month"] ?>
                                <?= $kpi["year"] ?>
                            </div>
                            <div class="flex-grow-1">
                                <div class="d-flex justify-content-end" style="height:32px;">
                                    <a href="<?= Yii::$app->homeUrl ?>kpi/kpi-team/kpi-team-history/<?= ModelMaster::encodeParams(['kpiId' => $kpiId, 'kpiTeamHistoryId' => $kpi['kpiTeamHistoryId'], 'kpiTeamId' => $kpiTeamId]) ?>"
                                        class="<?= $colorFormat == 'disable' ? 'pim-btn-disable' : 'pim-btn' ?> mr-5"
                                        style=" <?= $colorFormat == 'disable' ? 'pointer-events: none; opacity: 0.5;' : '' ?>">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/eye.svg" alt="View"
                                            class="pim-action-icon">
                                    </a>
                                    <a href="<?= Yii::$app->homeUrl ?>kpi/kpi-team/kpi-team-history/<?= ModelMaster::encodeParams(['kpiId' => $kpiId, 'kpiTeamHistoryId' => $kpi['kpiTeamHistoryId'], 'kpiTeamId' => $kpiTeamId, 'openTab' => 3]) ?>"
                                        class="<?= $colorFormat == 'disable' ? 'pim-btn-disable' : 'pim-btn' ?> mr-5"
                                        style=" <?= $colorFormat == 'disable' ? 'pointer-events: none; opacity: 0.5;' : '' ?>">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/comment.svg"
                                            alt="Chats" class="pim-action-icon">
                                    </a>
                                    <a href="<?= Yii::$app->homeUrl ?>kpi/kpi-team/kpi-team-history/<?= ModelMaster::encodeParams(['kpiId' => $kpiId, 'kpiTeamHistoryId' => $kpi['kpiTeamHistoryId'], 'kpiTeamId' => $kpiTeamId, 'openTab' => 4]) ?>"
                                        class="<?= $colorFormat == 'disable' ? 'pim-btn-disable' : 'pim-btn' ?>"
                                        style=" <?= $colorFormat == 'disable' ? 'pointer-events: none; opacity: 0.5;' : '' ?>">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/pim/chart.svg" alt="Chart"
                                            class="pim-action-icon">
                                    </a>
                                    <?php
                                                if ($colorFormat == 'disable') {
                                                ?>
                                    <a class="btn pim-btn-blue  ml-5"
                                        href="<?= Yii::$app->homeUrl ?>kpi/kpi-team/prepare-update/<?= ModelMaster::encodeParams(['kpiTeamId' => $kpiTeamId, 'kpiHistoryId' => 0]) ?>">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/setupwhite.svg"
                                            alt="History" style="margin-top: -2px;" class="pim-action-icon">
                                    </a>
                                    <?php
                                                }
                                                ?>
                                </div>
                            </div>
                        </div>
                        <div class="d-inline-flex mt-10" style="width:100%;">
                            <div class="d-flex justify-content-start pim-name-history">
                                <div class="month-period month-<?= $colorFormat ?>">Term</div>
                                <div class="term-period term-<?= $colorFormat ?>">
                                    <?= $kpi['fromDate'] == "" ? Yii::t('app', 'Not set') : $kpi['fromDate'] ?> -
                                    <?= $kpi['toDate'] == "" ? Yii::t('app', 'Not set') : $kpi['toDate'] ?>
                                </div>
                            </div>
                            <div class="flex-grow-1">
                                <div class="d-flex justify-content-end">
                                    <div class="status-tag <?= $colorFormat ?>-tag text-center">
                                        <?= Yii::t('app', $statusText) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 text-start font-size-12 mt-10" style="font-weight: 500;">
                            <?= Yii::t('app', 'Assign on') ?>
                        </div>
                        <div class="d-flex justify-content-start mt-5">
                            <div>
                                <div class="assign-new <?= $colorFormat ?>-assignNew">
                                    <div class="pim-picgroup">
                                        <?php if (!empty($kpi["kpiEmployee"]) && is_array($kpi["kpiEmployee"]) && count($kpi["kpiEmployee"]) != 0) {
                                                        $totalPic = count($kpi["kpiEmployee"]) >= 3 ? 3 : count($kpi["kpiEmployee"]);

                                                        if (isset($kpi['kpiEmployee'][0])) {
                                                            $userPicture1 = $kpi['kpiEmployee'][0];
                                                    ?>
                                        <img src="<?= Yii::$app->homeUrl . $userPicture1 ?>" class="pim-pic-gridNew">
                                        <?php
                                                        }
                                                        if (isset($kpi['kpiEmployee'][1])) {
                                                            $userPicture2 = $kpi['kpiEmployee'][1];
                                                        ?>
                                        <img src="<?= Yii::$app->homeUrl . $userPicture2 ?>"
                                            class="pim-pic-gridNew pic-after">
                                        <?php
                                                        }
                                                        if (isset($kpi['kpiEmployee'][2])) {
                                                            $userPicture3 = $kpi['kpiEmployee'][2];
                                                        ?>
                                        <img src="<?= Yii::$app->homeUrl . $userPicture3 ?>"
                                            class="pim-pic-gridNew pic-after">
                                        <?php
                                                        }
                                                    } else {
                                                        $totalPic = 0;
                                                    }
                                                    for ($i = 0; $i < (3 - $totalPic); $i++):
                                                        ?>
                                        <div
                                            class="pim-pic-disable <?= ($i > 0 || $totalPic > 0) ? 'pic-after' : '' ?>">
                                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/personblack.svg">
                                        </div>
                                        <?php
                                                    endfor;
                                                    ?>
                                        <div class="number-tagNew  load-<?= $colorFormat ?>  pic-after">
                                            <?= count($kpi["kpiEmployee"] ?? []) ?>
                                        </div>
                                    </div>
                                    <div class="border-right-<?= $colorFormat ?> ml-5 mr-3" style="height:23px;"></div>
                                    <?php
                                                if ($role > 3) {
                                                ?>
                                    <a href="<?= Yii::$app->homeUrl ?>kpi/assign/assign/<?= ModelMaster::encodeParams(['kpiId' => $kpiId, 'companyId' => $kpiDetail['companyId'], 'kpiTeamHistoryId' => $kpi['kpiTeamHistoryId'],]) ?>"
                                        class="font-<?= $colorFormat ?>"
                                        style="text-decoration: none; font-size: 12px; font-weight: 600;">
                                        <?= (is_countable($kpi["kpiEmployee"]) && count($kpi["kpiEmployee"]) > 0) 
                                            ? Yii::t('app', 'Assigned Person') 
                                            : Yii::t('app', 'Assign Person') ?>
                                    </a>
                                    <?php
                                                } else {
                                                ?>
                                    <a href="<?= Yii::$app->homeUrl ?>kpi/kpi-team/kpi-team-history/<?= ModelMaster::encodeParams(['kpiTeamId' => $kpiTeamId, 'kpiTeamHistoryId' => $kpi['kpiTeamHistoryId'], 'kpiId' => $kpiId, 'openTab' => 1]) ?>"
                                        class="font-<?= $colorFormat ?>"
                                        style="text-decoration: none; font-size: 12px; font-weight: 600;">
                                        <?= count($kpi["kpiEmployee"]) > 0 ? Yii::t('app', 'View Persons') : Yii::t('app', 'Not Yet') ?>
                                    </a>
                                    <?php
                                                }
                                                ?>
                                </div>
                                <div class="assign-new <?= $colorFormat ?>-assignNew mt-10">
                                    <div class="pim-picgroup">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/team-<?= $colorFormat ?>.svg"
                                            style="height:20px; width: 20px;" class="pim-pic-gridNew ml-15 mr-7">
                                        <div class="number-tagNew  load-<?= $colorFormat ?>">
                                            <?= $kpi["countTeam"] ?>
                                        </div>
                                    </div>
                                    <div class="border-right-<?= $colorFormat ?> ml-5 mr-3" style="height:23px;"></div>
                                    <?php
                                                if ($role > 3) {
                                                ?>
                                    <a href="<?= Yii::$app->homeUrl ?>kpi/assign/assign/<?= ModelMaster::encodeParams(['kpiId' => $kpiId, 'companyId' => $kpiDetail['companyId'], 'kpiTeamHistoryId' => $kpi['kpiTeamHistoryId'],]) ?>"
                                        class="font-<?= $colorFormat ?>"
                                        style="text-decoration: none; font-size: 12px; font-weight: 600;">
                                        <?= $kpi["countTeam"] > 0 ? Yii::t('app', 'Assigned Teams') : Yii::t('app', 'Assign Team') ?>
                                    </a>
                                    <?php
                                                } else {
                                                ?>
                                    <a href="<?= Yii::$app->homeUrl ?>kpi/kpi-team/kpi-team-history/<?= ModelMaster::encodeParams(['kpiTeamId' => $kpiTeamId, 'kpiTeamHistoryId' => $kpi['kpiTeamHistoryId'], 'kpiId' => $kpiId, 'openTab' => 1]) ?>"
                                        class="font-<?= $colorFormat ?>"
                                        style="text-decoration: none; font-size: 12px; font-weight: 600;">
                                        <?= $kpi["countTeam"] > 0 ? Yii::t('app', 'View Teams') : Yii::t('app', 'Not Yet') ?>
                                    </a>
                                    <?php
                                                }
                                                ?>
                                </div>
                            </div>
                            <div class="flex-grow-1" style="justify-items: end;">
                                <div class="pt-0" style="width: 80px;">
                                    <div class="col-12 text-start"
                                        style="font-size: 12px; font-weight: 400;line-height:12px;color:#717171;">
                                        <?= Yii::t('app', 'Quant Ratio') ?>
                                    </div>
                                    <div class="col-12 pim-duedate font-size-12 text-start mt-3">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/<?= $kpi["quantRatio"] == 1 ? 'quantity' : 'diamon' ?>.svg"
                                            class="pim-iconKFI" style="margin-top: -1px;">
                                        <b><?= $kpi["quantRatio"] == 1 ? Yii::t('app', 'Quantity') : Yii::t('app', 'Quality') ?></b>
                                    </div>
                                    <div class="mt-10 mb-7 border-bottom-<?= $colorFormat ?>" style="width:80px;"></div>
                                    <div class="col-12  pr-0  text-start"
                                        style="font-size: 12px; font-weight: 400;line-height:12px;color:#717171;">
                                        <?= Yii::t('app', 'Update Interval') ?>
                                    </div>
                                    <div class="col-12 pim-duedate font-size-12 text-start mt-3"><b>
                                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/monthly.svg"
                                                class="pim-iconKFI mr-2" style="margin-top: -3px;">
                                            <?= Yii::t('app', $kpi["unit"]) ?>
                                        </b>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mt-20">
                            <div class="row" style="--bs-gutter-x:0px;">
                                <div class="col-5 text-start">
                                    <div class="col-12 font-size-13">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/Target.svg"
                                            class="pim-iconKFI" style="margin-top: 1px; margin-right: 3px;">
                                        <?= Yii::t('app', 'Target') ?>
                                    </div>
                                    <div class="col-12 number-pim mt-5">
                                        <?php
                                                    if ($kpi["target"] != '') {
                                                        $decimal = explode('.', $kpi["target"]);
                                                        if (isset($decimal[1])) {
                                                            if ($decimal[1] == '00') {
                                                                $show = number_format($decimal[0]);
                                                            } else {
                                                                $show = number_format($kpi["target"], 2);
                                                            }
                                                        } else {
                                                            $show = number_format($kpi["target"]);
                                                        }
                                                    } else {
                                                        $show = 0;
                                                    }
                                                    ?>
                                        <b><?= $show ?><?= $kpi["amountType"] == 1 ? '%' : '' ?></b>
                                    </div>
                                </div>
                                <div class="col-2 symbol-pim text-center">
                                    <div class="col-12 pt-13 font-size-12"><?= $kpi["code"] ?></div>
                                </div>
                                <div class="col-5 text-end pr-20">
                                    <div class="col-12 font-size-13"><?= Yii::t('app', 'Result') ?>
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/Result.svg"
                                            class="pim-iconKFI" style="margin-top: 1px; margin-left: 3px;">
                                    </div>
                                    <div class="col-12 number-pim mt-5">
                                        <?php
                                                    if ($kpi["result"] != '') {
                                                        $decimalResult = explode('.', $kpi["result"]);
                                                        if (isset($decimalResult[1])) {
                                                            if ($decimalResult[1] == '00') {
                                                                $showResult = number_format($decimalResult[0]);
                                                            } else {
                                                                $showResult = number_format($kpi["result"], 2);
                                                            }
                                                        } else {
                                                            $showResult = number_format($kpi["result"]);
                                                        }
                                                    } else {
                                                        $showResult = 0;
                                                    }
                                                    ?>
                                        <b><?= $showResult ?><?= $kpi["amountType"] == 1 ? '%' : '' ?></b>

                                    </div>
                                </div>
                                <div class="col-12 mt-10">
                                    <?php
                                                $percent = explode('.', $kpi['ratio']);
                                                if (isset($percent[0]) && $percent[0] == '0') {
                                                    if (isset($percent[1])) {
                                                        if ($percent[1] == '00') {
                                                            $showPercent = 0;
                                                        } else {
                                                            $showPercent = round($kpi['ratio'], 1);
                                                        }
                                                    }
                                                } else {
                                                    $showPercent = round($kpi['ratio']);
                                                }
                                                ?>
                                    <div class="progress">
                                        <div class="progress-bar-<?= $colorFormat ?>"
                                            style="width:<?= $showPercent ?>%;"></div>
                                        <span class="progress-load load-<?= $colorFormat ?>"><?= $showPercent ?>%</span>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <?php
                            $i++;
                        endforeach;
                    endforeach;
                } else {
                    ?>
                <div class="col-12 text-center">
                    <?= Yii::t('app', 'There is no history') ?>
                </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
</div>
<?php
$form = ActiveForm::begin([
    'id' => 'update-kpi',
    'method' => 'post',
    'options' => [
        'enctype' => 'multipart/form-data',
    ],
    'action' => Yii::$app->homeUrl . 'kpi/kpi-team/update-kpi-team'

]); ?>
<?= $this->render('modal_update', [
    "units" => $units,
    "isManager" => $isManager,
    "months" => $months,
]) ?>
<?php ActiveForm::end(); ?>
<?= $this->render('modal_view', [
    "isManager" => $isManager
]) ?>
<?= $this->render('modal_issue') ?>
<?= $this->render('modal_confirm_next_team') ?>
<style>
.pim-btn {
    height: 25px;
    width: 25px;
    padding: 0px;
    justify-content: center;
    align-items: center;
    align-self: center;
}

.term-period {
    width: 140px;
    margin-left: -13px;
    border-radius: 20px;
    justify-content: end;
    padding-right: 7px;
}

.month-period {
    width: 40px;
    display: flex;
    justify-content: center;
    border-radius: 20px;
}

.status-tag {
    width: 90px;
}

.assign-new {
    height: 30px;
    width: 190px;
}

.bg-white-employee {
    min-height: calc(100vh - 200px);
    padding: 27px 20px 10px 20px;
}
</style>