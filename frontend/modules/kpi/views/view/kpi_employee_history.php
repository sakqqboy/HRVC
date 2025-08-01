<?php

use common\models\ModelMaster;
use yii\bootstrap5\ActiveForm;

$this->title = 'Self KPI History';
?>

<div class="contrainer-body">
    <div class="col-12">
        <img src="<?= Yii::$app->homeUrl ?>images/icons/black-icons/FinancialSystem/Vector.svg" class="home-icon mr-5"
            style="margin-top: -3px;">
        <strong class="pim-head-text"> <?= Yii::t('app', 'Performance Indicator Matrices') ?> (PIM)</strong>
    </div>
    <div class="col-12 mt-10">
        <?= $this->render('header_filter_employee', [
            "role" => $role
        ]) ?>
        <div class="alert  mt-10 pim-body bg-white">
            <div class="col-12">
                <div class="row">
                    <div class="col-6 font-size-12 pim-name pr-0 pl-5 text-start">
                        <a href="<?= Yii::$app->homeUrl ?>kpi/kpi-personal/individual-kpi-grid"
                            class="mr-5 pim-text-back">
                            <i class="fa fa-caret-left mr-3" aria-hidden="true"></i>
                            <?= Yii::t('app', 'Back') ?>
                        </a>
                        <span class="">
                            <?= $kpiDetail["kpiName"] ?>
                        </span>
                    </div>
                    <div class="col-6 text-end">

                    </div>
                </div>

            </div>
            <div class="row">
                <?php
                if (isset($kpiEmployeeHistory) && count($kpiEmployeeHistory) > 0) {
                    $i = 0;
                    foreach ($kpiEmployeeHistory as $year => $kpiMonth) :
                        foreach ($kpiMonth as $month => $kpi):
                            if ($kpi["isOver"] == 1 && $kpi["status"] != 2) {
                                $colorFormat = 'over';
                            } else {
                                if ($kpi["status"] == 1) {
                                    if ($kpi["isOver"] == 2) {
                                        $colorFormat = 'disable';
                                    } else {
                                        $colorFormat = 'inprogress';
                                    }
                                } else {
                                    $colorFormat = 'complete';
                                }
                            }
                ?>
                            <div class="col-lg-4 col-md-6 col-12 ">
                                <div class="col-12 mt-10 mb-5 pim-big-box pim-<?= $colorFormat ?>">
                                    <div class="row">
                                        <div class="col-5 pim-name-history"><?= $kpi["month"] ?> <?= $kpi["year"] ?></div>
                                        <div class="col-7 text-end">
                                            <a href="<?= Yii::$app->homeUrl ?>kpi/kpi-personal/kpi-individual-history/<?= ModelMaster::encodeParams(['kpiId' => $kpiId, 'kpiEmployeeHistoryId' => $kpi["kpiEmployeeHistoryId"], 'kpiEmployeeId' => $kpiEmployeeId]) ?>"
                                                class="btn <?= $colorFormat == 'disable' ? 'btn-bg-gray-xs' : 'btn-bg-white-xs mr-5' ?> mr-5"
                                                style="margin-top: -3px; <?= $colorFormat == 'disable' ? 'pointer-events: none; opacity: 0.5;' : '' ?>">
                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/eye.svg" alt="Chats"
                                                    class="pim-icon " style="margin-top: -2px;">
                                            </a>
                                            <a href="<?= Yii::$app->homeUrl ?>kpi/kpi-personal/kpi-individual-history/<?= ModelMaster::encodeParams(['kpiId' => $kpiId, 'kpiEmployeeHistoryId' => $kpi["kpiEmployeeHistoryId"], 'kpiEmployeeId' => $kpiEmployeeId, 'openTab' => 3]) ?>"
                                                class="btn <?= $colorFormat == 'disable' ? 'btn-bg-gray-xs' : 'btn-bg-white-xs mr-5' ?> mr-5"
                                                style="margin-top: -3px; <?= $colorFormat == 'disable' ? 'pointer-events: none; opacity: 0.5;' : '' ?>">
                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/comment.svg" alt="Chart"
                                                    class="pim-icon" style="margin-top: -2px;">
                                            </a>
                                            <a href="<?= Yii::$app->homeUrl ?>kpi/kpi-personal/kpi-individual-history/<?= ModelMaster::encodeParams(['kpiId' => $kpiId, 'kpiEmployeeHistoryId' => $kpi["kpiEmployeeHistoryId"], 'kpiEmployeeId' => $kpiEmployeeId, 'openTab' => 4]) ?>"
                                                class="btn <?= $colorFormat == 'disable' ? 'btn-bg-gray-xs' : 'btn-bg-white-xs mr-5' ?> mr-5"
                                                style="margin-top: -3px; <?= $colorFormat == 'disable' ? 'pointer-events: none; opacity: 0.5;' : '' ?>">
                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/chart.svg" alt="Chart"
                                                    class="pim-icon" style="margin-top: -2px;">
                                            </a>
                                            <?php
                                            if ($colorFormat == 'disable') {
                                            ?>
                                                <a href="<?= Yii::$app->homeUrl ?>kpi/kpi-personal/update-personal-kpi/<?= ModelMaster::encodeParams(['kpiEmployeeId' => $kpiEmployeeId]) ?>"
                                                    class="btn btn-bg-blue-xs mr-5" style="margin-top: -3px;">
                                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/setupwhite.svg"
                                                        alt="History" style="margin-top: -3px; " class="home-icon">
                                                </a>
                                            <?php
                                            }
                                            ?>
                                            <?php
                                            //            if ($i == 0 && $kpi["status"] == 2 && $role >= 5) {
                                            ?>
                                            <!-- <a class="btn btn-bg-white-xs mr-5" style="margin-top: -3px;" data-bs-toggle="modal"
                                    data-bs-target="#staticBackdrop3"
                                    onclick="javascript:prepareKpiEmployeeNextTarget(<?php // $kpi['kpiEmployeeHistoryId'] 
                                                                                        ?>)">
                                    <img src="<?php // Yii::$app->homeUrl 
                                                ?>images/icons/Settings/coppy.svg" alt="History"
                                        style="margin-top: -3px; " class="home-icon">
                                </a> -->
                                            <?php
                                            //        }
                                            ?>
                                        </div>
                                        <div class="col-9 mt-25 pl-28">
                                            <div class="row">
                                                <div class="col-2 month-<?= $colorFormat ?> pt-2"><?= Yii::t('app', 'Term') ?></div>
                                                <div class="col-8 term-<?= $colorFormat ?>  pt-2">
                                                    <?= $kpi['fromDate'] == "" ? Yii::t('app', 'Not set') : $kpi['fromDate'] ?> -
                                                    <?= $kpi['toDate'] == "" ? Yii::t('app', 'Not set') : $kpi['toDate'] ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-3 mt-25">
                                            <div class="<?= $colorFormat ?>-tag text-center">
                                                <?= $colorFormat == 'disable'
                                                    ? Yii::t('app', 'Not Yet')
                                                    : ($kpi['status'] == 1
                                                        ? Yii::t('app', 'In process')
                                                        : Yii::t('app', 'Completed')) ?>
                                            </div>
                                        </div>
                                        <div class="col-6 pt-20">
                                            <div class="col-12 text-start pl-5 font-size-14" style="font-weight: 500;">
                                                <?= Yii::t('app', 'Assign on') ?>
                                            </div>
                                            <div class="col-12 <?= $colorFormat ?>-assign mt-18" style="padding: 7px 7px 7px 7px">
                                                <div class="row">
                                                    <div class="col-5 border-right-<?= $colorFormat ?> pl-10">
                                                        <div class="row">
                                                            <div class="col-2 pt-2">
                                                                <?php
                                                                if (isset($teamMate[0])) {
                                                                ?>
                                                                    <img src="<?= Yii::$app->homeUrl . $teamMate[0] ?>"
                                                                        class="pim-pic-grid " style="margin-left: -3px;">
                                                                <?php
                                                                }
                                                                ?>
                                                            </div>
                                                            <div class="col-2 pic-after pt-2">
                                                                <?php
                                                                if (isset($teamMate[1])) {
                                                                ?>
                                                                    <img src="<?= Yii::$app->homeUrl . $teamMate[1] ?>"
                                                                        class="pim-pic-grid" style="margin-left: -3px;">
                                                                <?php
                                                                }
                                                                ?>
                                                            </div>
                                                            <div class="col-2 pic-after pt-2">
                                                                <?php
                                                                if (isset($teamMate[2])) {
                                                                ?>
                                                                    <img src="<?= Yii::$app->homeUrl . $teamMate[2] ?>"
                                                                        class="pim-pic-grid" style="margin-left: -3px;">
                                                                <?php
                                                                }
                                                                ?>
                                                            </div>
                                                            <div class="col-6 number-tag load-<?= $colorFormat ?> pr-0 pl-0 pt-3"
                                                                style="margin-left: -3px; height:25px; width: 32px; margin-top: 2px;">
                                                                <?= $countTeamEmployee ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-7 pl-5 pt-3">

                                                        <?php
                                                        if ($role > 3) {
                                                        ?>
                                                            <a href="<?= Yii::$app->homeUrl ?>kpi/assign/assign/<?= ModelMaster::encodeParams(['kpiId' => $kpiId, "companyId" => $kpiDetail["companyId"]]) ?>"
                                                                class="font-<?= $colorFormat ?>"
                                                                style=" text-decoration: none; font-size: 16px; font-weight: 400;">
                                                                <?= Yii::t('app', 'View mate') ?>
                                                            </a>
                                                        <?php
                                                        } else {
                                                        ?>
                                                            <a href="<?= Yii::$app->homeUrl ?>kpi/assign/assign/<?= ModelMaster::encodeParams(['kpiId' => $kpiId, "companyId" => $kpiDetail["companyId"]]) ?>"
                                                                class="font-<?= $colorFormat ?>"
                                                                style=" text-decoration: none; font-size: 16px; font-weight: 400;">
                                                                <?= Yii::t('app', 'View mate') ?>
                                                            </a>
                                                        <?php
                                                        }
                                                        ?>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 <?= $colorFormat ?>-assign mt-20" style="padding: 7px 7px 7px 7px">
                                                <div class="row">
                                                    <div class="col-5 border-right-<?= $colorFormat ?> ">
                                                        <div class="row">
                                                            <div class="col-2 pl-0 pr-0">

                                                            </div>
                                                            <div class="col-2 pr-16 pt-5">
                                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/team-<?= $colorFormat ?>.svg"
                                                                    style="height:16px; width: 16px">
                                                            </div>
                                                            <div class="col-1 pl-0">

                                                            </div>
                                                            <div class="col-5 number-tag load-<?= $colorFormat ?> pt-3"
                                                                style="height:25px; width: 32px; margin-top: 1px;">
                                                                <?= $kpiDetail["countTeam"] ?>
                                                            </div>
                                                            <div class="col-2 pl-0 pr-0">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-7 pl-5 pt-3">

                                                        <?php
                                                        if ($role > 3) {
                                                        ?>
                                                            <a href="<?= Yii::$app->homeUrl ?>kpi/assign/assign/<?= ModelMaster::encodeParams(['kpiId' => $kpiId, "companyId" => $kpiDetail["companyId"]]) ?>"
                                                                class="font-<?= $colorFormat ?>"
                                                                style=" text-decoration: none; font-size: 16px; font-weight: 400;">
                                                                <?= Yii::t('app', 'View mate') ?>
                                                            </a>
                                                        <?php
                                                        } else {
                                                        ?>
                                                            <a href="<?= Yii::$app->homeUrl ?>kpi/assign/assign/<?= ModelMaster::encodeParams(['kpiId' => $kpiId, "companyId" => $kgiDetail["companyId"]]) ?>"
                                                                class="font-<?= $colorFormat ?>"
                                                                style=" text-decoration: none; font-size: 16px; font-weight: 400;">
                                                                <?= Yii::t('app', 'View mate') ?>
                                                            </a>
                                                        <?php
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                        </div>
                                        <div class="col-3 font-size-10 pl-35 pt-54">
                                            <div class="col-12 text-start" style="font-size: 12px; font-weight: 400;">
                                                <?= Yii::t('app', 'Quant Ratio') ?>
                                            </div>
                                            <div class="col-12   pim-duedate font-size-9 pb-3 text-start">
                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/<?= $kpi["quantRatio"] == 1 ? 'quantity' : 'diamon' ?>.svg"
                                                    class="pim-iconKFI" style="margin-top: -1px; margin-left: 3px;">
                                                <b><?= $kpi["quantRatio"] == 1 ? Yii::t('app', 'Quantity') : Yii::t('app', 'Quality') ?></b>
                                            </div>

                                            <div class="col-9 mt-16 mb-16 border-bottom-<?= $colorFormat ?>"></div>

                                            <div class="col-12 text-start" style="font-size: 12px; font-weight: 400;">
                                                <?= Yii::t('app', 'Update Interval') ?>
                                            </div>
                                            <div class="col-12   pim-duedate text-start"><b>
                                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/monthly.svg"
                                                        class="pim-iconKFI" style="margin-top: -3px; margin-left: 3px;">
                                                    <?= Yii::t('app', $kpi["unit"]) ?>
                                                </b>
                                            </div>
                                        </div>
                                        <div class="col-12 mt-15">
                                            <div class="row">
                                                <div class="col-5 text-start pl-20">
                                                    <div class="col-12 font-size-13">
                                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/Target.svg"
                                                            class="pim-iconKFI" style="margin-top: 1px; margin-right: 3px;">
                                                        <?= Yii::t('app', 'Target') ?>
                                                    </div>
                                                    <div class="col-12 number-pim">
                                                        <?php
                                                        if ($kpi["target"] != 0) {
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
                                                            $show = 0.00;
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
                                                    <div class="col-12 number-pim">
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
                                                <div class="col-12 pl-20 pr-20 pb-8">
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
                                                        $showPercent = round(floatval($kpi['ratio']));
                                                    }
                                                    ?>
                                                    <div class="progress">
                                                        <div class="progress-bar-<?= $colorFormat ?>"
                                                            style="width:<?= $showPercent ?>%;"></div>
                                                        <span
                                                            class="progress-load load-<?= $colorFormat ?>"><?= $showPercent ?>%</span>
                                                    </div>
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
<?= $this->render('modal_confirm_next_employee') ?>