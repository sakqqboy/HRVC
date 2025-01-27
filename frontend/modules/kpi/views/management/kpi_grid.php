<?php

use common\models\ModelMaster;
use yii\bootstrap5\ActiveForm;

$this->title = 'KPI Grid View';
?>
<div class="col-12">
    <div class="col-12">
        <img src="<?= Yii::$app->homeUrl ?>images/icons/black-icons/FinancialSystem/Vector.svg" class="home-icon mr-5"
            style="margin-top: -3px;">
        <strong class="pim-head-text"> <?= Yii::t('app', 'Performance Indicator Matrices') ?> (PIM) </strong>
    </div>
    <div class="col-12 mt-10">
        <?= $this->render('header_filter', [
            "role" => $role
        ]) ?>
        <div class="alert mt-10 pim-body bg-white">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-12  pr-0 pt-1">
                    <div class="row">
                        <div class="col-8">
                            <div class="row">
                                <div class="col-4 pim-type-tab-selected pr-0 pl-0 rounded-top-left">
                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/company.svg" alt="Company"
                                        class="pim-icon" style="width: 14px;height: 14px;padding-bottom: 4px;">
                                    <?= Yii::t('app', 'Company KPI') ?>
                                </div>
                                <div class="col-4  pr-0 pl-0 pim-type-tab">
                                    <a href="<?= Yii::$app->homeUrl ?>kpi/kpi-team/team-kpi-grid"
                                        class="no-underline-black ">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/team.svg" alt="Team"
                                            class="pim-icon" style="width: 13px;height: 13px;padding-bottom: 2px;">
                                        <?= Yii::t('app', 'Team KPI') ?>
                                    </a>
                                </div>
                                <div class="col-4 pim-type-tab pr-0 pl-0  rounded-top-right">
                                    <a href="<?= Yii::$app->homeUrl ?>kpi/kpi-personal/individual-kpi-grid"
                                        class="no-underline-black ">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/self.svg" alt="Self"
                                            class="pim-icon" style="width: 13px;height: 13px;padding-bottom: 3px;">
                                        <?= Yii::t('app', 'Self KPI') ?>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-4 pl-4">
                            <?php
                            if ($role >= 3) {
                            ?>
                            <!-- <button type="button" class="btn-createnew font-size-11" data-bs-toggle="modal"
                                data-bs-target="#create-kpi-modal" style="position:absolute;">
                                <?= Yii::t('app', 'Create New') ?>
                                <img src=" <?= Yii::$app->homeUrl ?>images/icons/Settings/plus.svg" alt="History"
                                    class="pim-icon ml-3" style="margin-top: -1px;">
                            </button> -->
                            <a type="button" class="btn-createnew pl-7 pr-7 pr-9 font-size-12"
                                href="<?= Yii::$app->homeUrl ?>kpi/management/create-kpi/"
                                style="text-decoration: none;">
                                <?= Yii::t('app', 'Create New') ?>
                                <img src=" <?= Yii::$app->homeUrl ?>images/icons/Settings/plus.svg" alt="History"
                                    class="pim-icon ml-3" style="margin-top: -1px;">
                            </a>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7 col-md-12 col-12 pt-1">
                    <?= $this->render('filter_list', [
                        "companies" => $companies,
                        "months" => $months
                    ]) ?>
                    <input type="hidden" id="type" value="grid">
                </div>
                <div class="col-lg-1 col-md-6 col-12 pr-0 text-end">
                    <div class="btn-group" role="group">
                        <a href="#" class="btn btn-primary font-size-12 pim-change-modes">
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/gridwhite.svg"
                                style="cursor: pointer;">
                        </a>
                        <a href="<?= Yii::$app->homeUrl . 'kpi/management/index' ?>"
                            class="btn btn-outline-primary font-size-12 pim-change-modes">
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/listblack.svg"
                                style="cursor: pointer;">
                        </a>

                    </div>
                </div>
            </div>
            <div class="col-12 mt-5">
                <div class="row">
                    <?php
                    if (isset($kpis) && count($kpis) > 0) {
                        foreach ($kpis as $kpiId => $kpi) :
                            //throw new Exception(print_r($kpi, true));
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
                    <div class="col-12 mt-10 mb-5 pim-big-box pim-<?= $colorFormat ?>" id="kpi-<?= $kpiId ?>">
                        <div class="row">
                            <div class="col-lg-3 col-md-5 col-12 pim-name pr-0">
                                <?= $kpi["kpiName"] ?>
                            </div>
                            <div class="col-lg-1 col-md-2 col-4 text-center">
                                <div class="<?= $colorFormat ?>-tag text-center">
                                    <?= $kpi['status'] == 1 ? 'In process' : 'Completed' ?>
                                </div>
                            </div>
                            <div class=" col-lg-3 col-md-3 col-4 pl-30">
                                <div class="row">
                                    <div class="col-4 month-<?= $colorFormat ?>">
                                        <?= $kpi['month'] == "" ?  Yii::t('app', 'Month') : Yii::t('app', $kpi['month']) ?>
                                    </div>
                                    <div class="col-8 term-<?= $colorFormat ?>">
                                        <?= $kpi['fromDate'] == "" ?  Yii::t('app', 'Not set') : $kpi['fromDate'] ?> -
                                        <?= $kpi['toDate'] == "" ? Yii::t('app', 'Not set') : $kpi['toDate'] ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-5 col-md-2 col-4 text-end pr-20">
                                <a href="<?= Yii::$app->homeUrl ?>kpi/view/kpi-history/<?= ModelMaster::encodeParams(['kpiId' => $kpiId, 'openTab' => 1]) ?>"
                                    class="btn <?= $colorFormat == 'disable' ? 'btn-bg-gray-xs' : 'btn-bg-white-xs mr-5' ?> mr-5"
                                    style="margin-top: -3px; <?= $colorFormat == 'disable' ? 'pointer-events: none; opacity: 0.5;' : '' ?>">
                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/eye.svg" alt="History"
                                        class="pim-icon" style="margin-top: -1px;">
                                </a>
                                <a href="<?= Yii::$app->homeUrl ?>kpi/view/index/<?= ModelMaster::encodeParams(['kpiId' => $kpiId, 'openTab' => 2]) ?>"
                                    class="btn <?= $colorFormat == 'disable' ? 'btn-bg-gray-xs' : 'btn-bg-white-xs mr-5' ?> mr-5"
                                    style="margin-top: -3px; <?= $colorFormat == 'disable' ? 'pointer-events: none; opacity: 0.5;' : '' ?>">
                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/history.svg" alt="History"
                                        class="pim-icon mr-3" style="margin-top: -2px;"><?= Yii::t('app', 'History') ?>
                                </a>
                                <a href="<?= Yii::$app->homeUrl ?>kpi/view/kpi-history/<?= ModelMaster::encodeParams(['kpiId' => $kpiId, 'openTab' => 3]) ?>"
                                    class="btn <?= $colorFormat == 'disable' ? 'btn-bg-gray-xs' : 'btn-bg-white-xs mr-5' ?> mr-5"
                                    style="margin-top: -3px; <?= $colorFormat == 'disable' ? 'pointer-events: none; opacity: 0.5;' : '' ?>">
                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/comment.svg" alt="Chats"
                                        class="pim-icon mr-3" style="margin-top: -2px;"><?= Yii::t('app', 'Chats') ?>
                                </a>
                                <a href="<?= Yii::$app->homeUrl ?>kpi/view/kpi-history/<?= ModelMaster::encodeParams(['kpiId' => $kpiId, 'openTab' => 4]) ?>"
                                    class="btn <?= $colorFormat == 'disable' ? 'btn-bg-gray-xs' : 'btn-bg-white-xs mr-5' ?> mr-5"
                                    style="margin-top: -3px; <?= $colorFormat == 'disable' ? 'pointer-events: none; opacity: 0.5;' : '' ?>">
                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/chart.svg" alt="Chart"
                                        class="pim-icon mr-3" style="margin-top: -2px;"><?= Yii::t('app', 'Chart') ?>
                                </a>
                                <?php
                                        if ($role >= 5) {
                                        ?>
                                <a class="btn btn-bg-red-xs" data-bs-toggle="modal" data-bs-target="#delete-kpi"
                                    onclick="javascript:prepareDeleteKpi(<?= $kpiId ?>)" style="margin-top: -3px;"
                                    onmouseover="this.querySelector('.pim-icon').src='<?= Yii::$app->homeUrl ?>images/icons/Settings/binwhite.svg'"
                                    onmouseout="this.querySelector('.pim-icon').src='<?= Yii::$app->homeUrl ?>images/icons/Settings/binred.svg'">
                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/binred.svg"
                                        class="pim-icon" style="margin-top: -2px;">
                                </a>
                                <?php
                                        }
                                        ?>
                            </div>
                            <div class="col-lg-3 pim-subheader-font border-right-<?= $colorFormat ?> mt-5">
                                <div class="row">
                                    <div class="col-12 text-start pl-22">
                                        <?= Yii::t('app', 'Assign on') ?>
                                    </div>
                                    <div class="col-9 pl-20 pr-0">
                                        <div class="col-12 mt-5 pt-2 pb-1">
                                            <div class="row">
                                                <div class="col-5 pr-2 pl-13">
                                                    <div class="row d-flex align-items-center"
                                                        style="min-height: 24px;">
                                                        <?php if ($kpi["countEmployee"] != 0) {
                                                                ?>
                                                        <div class="col-2">
                                                            <?php if (isset($kpi['kpiEmployee'][0])):
                                                                            $filePath = Yii::getAlias('@webroot') . '/' . $kpi['kpiEmployee'][0];
                                                                            if (file_exists($filePath) == 0) {
                                                                                $kpi['kpiEmployee'][0] = 'image/user.svg';
                                                                            }
                                                                        ?>
                                                            <img src="<?= Yii::$app->homeUrl . $kpi['kpiEmployee'][0] ?>"
                                                                class="pim-pic-gridNew">
                                                            <?php endif; ?>
                                                        </div>
                                                        <div class="col-2 pic-after pt-0">
                                                            <?php if (isset($kpi['kpiEmployee'][1])):
                                                                            $filePath = Yii::getAlias('@webroot') . '/' . $kpi['kpiEmployee'][1];
                                                                            if (file_exists($filePath) == 0) {
                                                                                $kpi['kpiEmployee'][1] = 'image/user.svg';
                                                                            }
                                                                        ?>
                                                            <img src="<?= Yii::$app->homeUrl . $kpi['kpiEmployee'][1] ?>"
                                                                class="pim-pic-gridNew">
                                                            <?php endif; ?>
                                                        </div>
                                                        <div class="col-2 pic-after pt-0">
                                                            <?php if (isset($kpi['kpiEmployee'][2])):
                                                                            $filePath = Yii::getAlias('@webroot') . '/' . $kpi['kpiEmployee'][2];
                                                                            if (file_exists($filePath) == 0) {
                                                                                $kpi['kpiEmployee'][2] = 'image/user.svg';
                                                                            }
                                                                        ?>
                                                            <img src="<?= Yii::$app->homeUrl . $kpi['kpiEmployee'][2] ?>"
                                                                class="pim-pic-gridNew">
                                                            <?php endif; ?>
                                                        </div>
                                                        <div
                                                            class="col-5 number-tagNew  <?= $kpi["countEmployee"] == 0 && $colorFormat != "disable"  ? 'load-yenlow' : 'load-'  . $colorFormat ?> ">
                                                            <?= $kpi["countEmployee"] ?>
                                                        </div>
                                                        <?php } else { ?>
                                                        <div class="col-2 ">
                                                            <div
                                                                class="<?= $kpi['countEmployee'] == 0 && $colorFormat != 'disable' ? 'pim-pic-yenlow' : 'pim-pic-' . $colorFormat ?>">
                                                                <img
                                                                    src="<?= Yii::$app->homeUrl ?>images/icons/Settings/personblack.svg">
                                                            </div>
                                                        </div>
                                                        <div class="col-2 pic-after pt-0">
                                                            <div
                                                                class="<?= $kpi['countEmployee'] == 0 && $colorFormat != 'disable' ? 'pim-pic-yenlow' : 'pim-pic-' . $colorFormat ?>">
                                                                <img
                                                                    src="<?= Yii::$app->homeUrl ?>images/icons/Settings/personblack.svg">
                                                            </div>
                                                        </div>
                                                        <div class="col-2 pic-after pt-0">
                                                            <div
                                                                class="<?= $kpi['countEmployee'] == 0 && $colorFormat != 'disable' ? 'pim-pic-yenlow' : 'pim-pic-' . $colorFormat ?>">
                                                                <img
                                                                    src="<?= Yii::$app->homeUrl ?>images/icons/Settings/personblack.svg">
                                                            </div>
                                                        </div>
                                                        <div
                                                            class="col-5 number-tagNew  <?= $kpi["countEmployee"] == 0 && $colorFormat != "disable"  ? 'load-yenlow' : 'load-'  . $colorFormat ?> ">
                                                            <?= $kpi["countEmployee"] ?>
                                                        </div>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                                <div
                                                    class="col-6 <?= $kpi["countEmployee"] == 0  && $colorFormat != "disable" ? 'yenlow-assignNew' : $colorFormat . '-assignNew' ?>">
                                                    <?php
                                                            if ($role <= 4) { // staff to team leader
                                                                if ($kpi["countEmployee"] > 0) {
                                                            ?>
                                                    <span class="pull-left">
                                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/view-<?= $colorFormat ?>.svg"
                                                            class="home-icon mr-2">
                                                    </span>
                                                    <a class="font-<?= $colorFormat ?>" style="top: 2px;"
                                                        href="<?= Yii::$app->homeUrl ?>kpi/view/kpi-history/<?= ModelMaster::encodeParams(['kpiId' => $kpiId, 'openTab' => 1]) ?>">
                                                        <?= Yii::t('app', 'View Assign') ?>
                                                    </a>
                                                    <?php
                                                                } else { ?>
                                                    <span class="pull-left">
                                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/view-<?= $colorFormat == 'disable' ? 'disable' : 'yenlow' ?>.svg"
                                                            class="home-icon mr-2">
                                                    </span>
                                                    <a class="font-black" style="top: 2px;">
                                                        <?= Yii::t('app', 'Not Assign') ?>
                                                    </a>
                                                    <?php
                                                                }
                                                            } else { // manager and over
                                                                if ($kpi["countEmployee"] > 0) { ?>
                                                    <span class="pull-left">
                                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/assign-<?= $colorFormat ?>.svg"
                                                            class="home-icon mr-2">
                                                    </span>
                                                    <a href="<?= Yii::$app->homeUrl ?>kpi/assign/assign/<?= ModelMaster::encodeParams(['kpiId' => $kpiId, "companyId" => $kpi["companyId"]]) ?>"
                                                        class="font-<?= $colorFormat ?>" style="top: 2px;">
                                                        <?= Yii::t('app', 'Edit Assign') ?>
                                                    </a>
                                                    <?php
                                                                } else { ?>
                                                    <span class="pull-left">
                                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/assign-<?= $colorFormat == 'disable' ? 'disable' : 'yenlow' ?>.svg"
                                                            class="home-icon mr-2">
                                                    </span>
                                                    <a href="<?= Yii::$app->homeUrl ?>kpi/assign/assign/<?= ModelMaster::encodeParams(['kpiId' => $kpiId, "companyId" => $kpi["companyId"]]) ?>"
                                                        class="font-black" style="top: 2px;">
                                                        <?= Yii::t('app', 'Assign Person') ?>
                                                    </a>
                                                    <?php
                                                                }
                                                            }
                                                            ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 mt-10 pt-5 pb-1">
                                            <div class="row">
                                                <div class="col-5 pr-2">
                                                    <div class="row d-flex align-items-center"
                                                        style="min-height: 24px;">
                                                        <div class="col-2">
                                                            <div class="pim-pic-<?= $colorFormat ?>">
                                                                <img
                                                                    src="<?= Yii::$app->homeUrl ?>images/icons/Settings/<?= $colorFormat == 'disable' ? 'teamblack' : 'teamwhite' ?>.svg">
                                                            </div>
                                                        </div>
                                                        <div class="col-2 pic-after pt-0">
                                                            <div class="pim-pic-<?= $colorFormat ?>">
                                                                <img
                                                                    src="<?= Yii::$app->homeUrl ?>images/icons/Settings/<?= $colorFormat == 'disable' ? 'teamblack' : 'teamwhite' ?>.svg">
                                                            </div>
                                                        </div>
                                                        <div class="col-2 pic-after pt-0">
                                                            <div class="pim-pic-<?= $colorFormat ?>">
                                                                <img
                                                                    src="<?= Yii::$app->homeUrl ?>images/icons/Settings/<?= $colorFormat == 'disable' ? 'teamblack' : 'teamwhite' ?>.svg">
                                                            </div>
                                                        </div>
                                                        <div class="col-5 number-tagNew load-<?= $colorFormat ?>">
                                                            <?= $kpi["countTeam"] ?>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div
                                                    class="col-6 <?= $kpi["countTeam"] == 0  && $colorFormat != "disable" ? 'yenlow-assignNew' : $colorFormat . '-assignNew' ?>">
                                                    <?php
                                                            if ($role <= 4) { // staff to team leader
                                                                if ($kpi["countTeam"] > 0) {
                                                            ?>
                                                    <span class="pull-left">
                                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/view-<?= $colorFormat ?>.svg"
                                                            class="home-icon mr-2">
                                                    </span>
                                                    <a class="font-<?= $colorFormat ?>" style="top: 2px;"
                                                        href="<?= Yii::$app->homeUrl ?>kpi/view/kpi-history/<?= ModelMaster::encodeParams(['kpiId' => $kpiId, 'openTab' => 1]) ?>">
                                                        <?= Yii::t('app', 'View Assign') ?>
                                                    </a>
                                                    <?php
                                                                } else { ?>
                                                    <span class="pull-left">
                                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/view-<?= $colorFormat == 'disable' ? 'disable' : 'yenlow' ?>.svg"
                                                            class="home-icon mr-2">
                                                    </span>
                                                    <a class="font-black" style="top: 2px;">
                                                        <?= Yii::t('app', 'Not Assign') ?>
                                                    </a>
                                                    <?php
                                                                }
                                                            } else { // manager and over
                                                                if ($kpi["countTeam"] > 0) { ?>
                                                    <span class="pull-left">
                                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/assign-<?= $colorFormat ?>.svg"
                                                            class="home-icon mr-2">
                                                    </span>
                                                    <a href="<?= Yii::$app->homeUrl ?>kpi/assign/assign/<?= ModelMaster::encodeParams(['kpiId' => $kpiId, "companyId" => $kpi["companyId"]]) ?>"
                                                        class="font-<?= $colorFormat ?>" style="top: 2px;">
                                                        <?= Yii::t('app', 'Edit Assign') ?>
                                                    </a>
                                                    <?php
                                                                } else { ?>
                                                    <span class="pull-left">
                                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/assign-<?= $colorFormat == 'disable' ? 'disable' : 'yenlow' ?>.svg"
                                                            class="home-icon mr-2">
                                                    </span>
                                                    <a href="<?= Yii::$app->homeUrl ?>kpi/assign/assign/<?= ModelMaster::encodeParams(['kpiId' => $kpiId, "companyId" => $kpi["companyId"]]) ?>"
                                                        class="font-black" style="top: 2px;">
                                                        <?= Yii::t('app', 'Assign Person') ?>
                                                    </a>
                                                    <?php
                                                                }
                                                            }
                                                            ?>
                                                </div>
                                                <div class="col-1">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-3" style="margin-top:-5px;">
                                        <div class="col-12 text-center priority-star">
                                            <?php
                                                    if ($kpi["priority"] == "A" || $kpi["priority"] == "B") {
                                                    ?>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <?php
                                                    }
                                                    if ($kpi["priority"] == "A" || $kpi["priority"] == "C") {
                                                    ?>
                                            <i class="fa fa-star big-star" aria-hidden="true"></i>
                                            <?php
                                                    }
                                                    if ($kpi["priority"] == "B") {
                                                    ?>
                                            <i class="fa fa-star ml-10" aria-hidden="true"></i>
                                            <?php
                                                    }
                                                    if ($kpi["priority"] == "A") {
                                                    ?>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <?php
                                                    }
                                                    ?>
                                        </div>
                                        <div class="col-12 text-center priority-box">
                                            <div class="col-12"><?= Yii::t('app', 'Priority') ?></div>
                                            <div class="col-12 text-priority"><?= $kpi["priority"] ?></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-1 pim-subheader-font border-right-<?= $colorFormat ?> mt-5 pl-10 pr-10">
                                <div class="col-12"><?= Yii::t('app', 'Quant Ratio') ?></div>
                                <div class="col-12 border-bottom-<?= $colorFormat ?> pb-10 pim-duedate">
                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/<?= $kpi["quantRatio"] == 1 ? 'quantity' : 'diamon' ?>.svg"
                                        class="pim-iconKFI" style="margin-top: -1px; margin-left: 3px;">
                                    <?= $kpi["quantRatio"] == 1 ? Yii::t('app', 'Quantity') : Yii::t('app', 'Quality') ?>
                                </div>
                                <div class="col-12 pr-0 pt-10 pl-0"><?= Yii::t('app', 'Update Interval') ?></div>
                                <div class="col-12  pim-duedate">
                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/monthly.svg"
                                        class="pim-iconKFI" style="margin-top: -1px; margin-left: 3px;">

                                    <?= Yii::t('app', $kpi["unit"]) ?>
                                </div>
                            </div>
                            <div class="col-lg-3 pim-subheader-font border-right-<?= $colorFormat ?> pr-15 pl-15 mt-5">
                                <div class="row">
                                    <div class="col-5 text-start">
                                        <div class="col-12">
                                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/Target.svg"
                                                class="pim-iconKFI" style="margin-top: 1px; margin-right: 3px;">
                                            <?= Yii::t('app', 'Target') ?>
                                        </div>
                                        <div class="col-12 mt-3 number-pim">
                                            <?php
                                                    $decimal = explode('.', $kpi["targetAmount"]);
                                                    if (isset($decimal[1])) {
                                                        if ($decimal[1] == '00') {
                                                            $show = $decimal[0];
                                                        } else {
                                                            $show = $kpi["targetAmount"];
                                                        }
                                                    } else {
                                                        $show = $kpi["targetAmount"];
                                                    }
                                                    ?>
                                            <?= $show ?><?= $kpi["amountType"] == 1 ? '%' : '' ?>
                                        </div>
                                    </div>
                                    <div class="col-2 symbol-pim text-center">
                                        <div class="col-12 pt-17"><?= $kpi["code"] ?></div>
                                    </div>
                                    <div class="col-5  text-end">
                                        <div class="col-12"><?= Yii::t('app', 'Result') ?>
                                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/Result.svg"
                                                class="pim-iconKFI" style="margin-top: 1px; margin-left: 3px;">
                                        </div>
                                        <div class="col-12 mt-3 number-pim">
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
                                            <?= $showResult ?><?= $kpi["amountType"] == 1 ? '%' : '' ?>
                                        </div>
                                    </div>
                                    <div class="col-12 pl-15 pr-10">
                                        <?php
                                                // $showPercent = round($kpi['ratio']);
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
                                                style="width:<?= $showPercent ?>%;">
                                            </div>
                                            <span
                                                class="progress-load load-<?= $colorFormat ?>"><?= $showPercent ?>%</span>
                                        </div>
                                    </div>
                                    <div class="col-4 pl-5 pr-5 mt-10">
                                        <div class="col-12 text-end"><?= Yii::t('app', 'Last Updated on') ?></div>
                                        <div class="col-12 text-end pim-duedate">
                                            <?= $kpi['nextCheck'] == "" ? 'Not set' : $kpi['nextCheck'] ?></div>
                                    </div>
                                    <div class="col-4 text-center mt-10 pt-6">
                                        <?php
                                                if ($colorFormat == 'disable' && $role >= 5) {
                                                ?>
                                        <div onclick="javascript:updateKpi(<?= $kpiId ?>)" class="pim-btn-setup"
                                            data-bs-toggle="modal" data-bs-target="#update-kpi-modal">
                                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/setupwhite.svg"
                                                class="mb-2" style="width: 12px; height: 12px;">
                                            <?= Yii::t('app', 'Setup') ?>
                                        </div>
                                        <?php
                                                } else if ($role >= 5) {
                                                ?>
                                        <div onclick=" javascript:updateKpi(<?= $kpiId ?>)"
                                            class="pim-btn-<?= $colorFormat ?>" data-bs-toggle="modal"
                                            data-bs-target="#update-kpi-modal">
                                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/refresh.svg"
                                                class="mb-2" style="width: 12px; height: 12px;">
                                            <?php if ($colorFormat == "complete") {
                                                            echo  Yii::t('app', "Edit");
                                                        } else if ($colorFormat == "over") {
                                                            echo  Yii::t('app', "Passed");
                                                        } else {
                                                            echo  Yii::t('app', "Update");
                                                        }
                                                        ?>
                                        </div>
                                        <?php
                                                } else { ?>
                                        <div class="pim-btn-disable" data-bs-target="#update-kgi-modal">
                                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/locked.svg"
                                                style="width: 12px; height: 12px;"> <?= Yii::t('app', 'Locked') ?>
                                        </div>
                                        <?php

                                                }
                                                ?>
                                    </div>
                                    <div class="col-4 pl-0 pr-5 mt-10">
                                        <div class="col-12 text-start font-<?= $colorFormat ?>">
                                            <?= Yii::t('app', 'Next Update Date') ?></div>
                                        <div class="col-12 text-start pim-duedate">
                                            <?= $kpi['nextCheck'] == "" ? Yii::t('app', 'Not set') : $kpi['nextCheck'] ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-5 pim-subheader-font mt-5">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-12 pr-3 pl-20">
                                        <div class="col-12 head-letter head-<?= $colorFormat ?>">
                                            <?= Yii::t('app', 'Issue') ?></div>
                                        <div class="col-12 body-letter body-letter-<?= $colorFormat ?>">
                                            <?= $kpi["issue"] ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12 pl-5 pr-20">
                                        <div class="col-12 head-letter head-<?= $colorFormat ?>">
                                            <?= Yii::t('app', 'Solution') ?></div>
                                        <div class="col-12 body-letter body-letter-<?= $colorFormat ?>">
                                            <?= $kpi["solution"] ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                        endforeach;
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

</div>
<?= $this->render('modal_view') ?>

<input type="hidden" value="create" id="acType">
<?php
$form = ActiveForm::begin([
    'id' => 'create-kpi',
    'method' => 'post',
    'options' => [
        'enctype' => 'multipart/form-data',
    ],
    'action' => Yii::$app->homeUrl . 'kpi/management/create-kpi'

]); ?>
<?= $this->render('modal_create', [
    "units" => $units,
    "companies" => $companies,
    "months" => $months
]) ?>
<?php ActiveForm::end(); ?>

<?php
$form = ActiveForm::begin([
    'id' => 'update-kpi',
    'method' => 'post',
    'options' => [
        'enctype' => 'multipart/form-data',
    ],
    'action' => Yii::$app->homeUrl . 'kpi/management/update-kpi'

]); ?>
<?= $this->render('modal_update', [
    "units" => $units,
    "companies" => $companies,
    "months" => $months,
    "isManager" => $isManager
]) ?>
<?php ActiveForm::end(); ?>
<?= $this->render('modal_delete') ?>
<?= $this->render('modal_issue') ?>
<?= $this->render('modal_team_history') ?>
<?= $this->render('modal_employee_history') ?>
<?= $this->render('modal_kgi') ?>