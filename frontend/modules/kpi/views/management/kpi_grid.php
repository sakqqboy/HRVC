<?php

use common\models\ModelMaster;
use yii\bootstrap5\ActiveForm;

$this->title = 'KPI Grid View';
?>

<div class="col-12 mt-70 pt-20">
    <div class="d-flex justify-content-start pt-0 pb-0" style="line-height: 30px;">
        <img src="<?= Yii::$app->homeUrl ?>images/icons/black-icons/FinancialSystem/Group23177.svg" class="pim-head-icon mr-11 mt-2">
        <span class="pim-head-text mr-10"> <?= Yii::t('app', 'Performance Indicator Matrices') ?> (PIM)</span>
        <?php
        if ($role >= 3) {
        ?>
            <a href="<?= Yii::$app->homeUrl ?>kpi/management/create-kpi"
                class="create-employee-btn mr-11">
                <?= Yii::t('app', 'Create New') ?>
                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/plus.svg" alt="History" class="create-btn-icon ml-3" style="margin-top: -3px;">
            </a>
        <?php
        }
        ?>
    </div>
    <?= $this->render('header_filter', [
        "role" => $role
    ]) ?>
    <div class="col-12 mt-10">

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
                                <a type="button" class="btn-createnew font-size-11"
                                    href="<?= Yii::$app->homeUrl ?>kpi/management/create-kpi/"
                                    style="position:absolute;text-decoration:none;">
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
                        "months" => $months,
                        "role" => $role,
                        "companyId" => $companyId
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
            <div class="col-12 mt-15">
                <div class="row">
                    <?php
                    if (isset($kpis) && count($kpis) > 0) {
                        foreach ($kpis as $kpiId => $kpi) :
                            if ($kpi["isOver"] == 1 && $kpi["status"] != 2) {
                                $colorFormat = 'over';
                                $statusText = 'Due Passed';
                            } else {
                                if ($kpi["status"] == 1) {
                                    if ($kpi["isOver"] == 2) {
                                        $colorFormat = 'disable';
                                        $statusText = 'Not Set';
                                    } else {
                                        $colorFormat = 'inprogress';
                                        $statusText = 'In-Progress';
                                    }
                                } else {
                                    $colorFormat = 'complete';
                                    $statusText = 'Completed';
                                }
                            }
                    ?>
                            <div class="col-12 mt-10 mb-5 pim-big-box pim-<?= $colorFormat ?>" id="kpi-<?= $kpiId ?>">
                                <div class="row">
                                    <div class="col-lg-3 col-md-5 col-12 pim-name">
                                        <?= $kpi["kpiName"] ?>
                                    </div>
                                    <div class="col-lg-1 col-md-2 col-4 text-center">
                                        <div class="<?= $colorFormat ?>-tag text-center">
                                            <?php
                                            if ($kpi['nextCheck'] == "") { ?>
                                                <?= Yii::t('app', 'Not set') ?>
                                            <?php
                                            } else { ?>
                                                <?= $statusText ?>
                                            <?php
                                            }
                                            ?>
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
                                    <div class="col-lg-5 col-md-2 col-4 text-end pr-20 pt-0" style="margin-top: -7px;">
                                        <a href="<?= Yii::$app->homeUrl ?>kpi/view/kpi-history/<?= ModelMaster::encodeParams(['kpiId' => $kpiId, 'openTab' => 1]) ?>"
                                            class="btn <?= $colorFormat == 'disable' ? 'btn-bg-gray-xs' : 'btn-bg-white-xs' ?> mr-5"
                                            style=" <?= $colorFormat == 'disable' ? 'pointer-events: none; opacity: 0.5;' : '' ?>">
                                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/eye.svg" alt="History"
                                                class="pim-icon" style="margin-top: 1px;">
                                        </a>
                                        <a href="<?= Yii::$app->homeUrl ?>kpi/view/index/<?= ModelMaster::encodeParams(['kpiId' => $kpiId, 'openTab' => 2]) ?>"
                                            class="btn <?= $colorFormat == 'disable' ? 'btn-bg-gray-xs' : 'btn-bg-white-xs' ?> mr-5"
                                            style=" <?= $colorFormat == 'disable' ? 'pointer-events: none; opacity: 0.5;' : '' ?>">
                                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/history.svg" alt="History"
                                                class="pim-icon mr-3"><?= Yii::t('app', 'History') ?>
                                        </a>
                                        <a href="<?= Yii::$app->homeUrl ?>kpi/view/kpi-history/<?= ModelMaster::encodeParams(['kpiId' => $kpiId, 'openTab' => 3]) ?>"
                                            class="btn <?= $colorFormat == 'disable' ? 'btn-bg-gray-xs' : 'btn-bg-white-xs' ?> mr-5"
                                            style=" <?= $colorFormat == 'disable' ? 'pointer-events: none; opacity: 0.5;' : '' ?>">
                                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/comment.svg" alt="Chats"
                                                class="pim-icon mr-3"><?= Yii::t('app', 'Chats') ?>
                                        </a>
                                        <a href="<?= Yii::$app->homeUrl ?>kpi/view/kpi-history/<?= ModelMaster::encodeParams(['kpiId' => $kpiId, 'openTab' => 4]) ?>"
                                            class="btn <?= $colorFormat == 'disable' ? 'btn-bg-gray-xs' : 'btn-bg-white-xs' ?> mr-5"
                                            style=" <?= $colorFormat == 'disable' ? 'pointer-events: none; opacity: 0.5;' : '' ?>">
                                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/chart.svg" alt="Chart"
                                                class="pim-icon mr-3"><?= Yii::t('app', 'Chart') ?>
                                        </a>
                                        <?php
                                        if ($role >= 5) {
                                        ?>
                                            <a class="btn btn-bg-red-xs" data-bs-toggle="modal" data-bs-target="#delete-kpi"
                                                onclick="javascript:prepareDeleteKpi(<?= $kpiId ?>)"
                                                onmouseover="this.querySelector('.pim-icon').src='<?= Yii::$app->homeUrl ?>images/icons/Settings/binwhite.svg'"
                                                onmouseout="this.querySelector('.pim-icon').src='<?= Yii::$app->homeUrl ?>images/icons/Settings/binred.svg'">
                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/binred.svg"
                                                    class="pim-icon">
                                            </a>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                    <div class="col-lg-3 pim-subheader-font border-right-<?= $colorFormat ?> mt-10">
                                        <div class="row">
                                            <div class="col-12 text-start pl-22 fw-bold text-dark">
                                                <?= Yii::t('app', 'Assign on') ?>
                                            </div>
                                            <div class="col-10 pl-20 pr-0 mt-10">
                                                <div class="col-12 pb-1">
                                                    <div class="row">
                                                        <div class="col-4 pr-2 pl-13">
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
                                                            class="col-5 <?= $kpi["countEmployee"] == 0  && $colorFormat != "disable" ? 'yenlow-assignNew' : $colorFormat . '-assignNew' ?>">
                                                            <?php
                                                            if ($role <= 4) { // staff to team leader
                                                                if ($kpi["countEmployee"] > 0) {
                                                            ?>
                                                                    <span class="pull-left">
                                                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/view-<?= $colorFormat ?>.svg"
                                                                            class="assing-icon mr-2">
                                                                    </span>
                                                                    <a class="font-<?= $colorFormat ?>" style="top: 2px;"
                                                                        href="<?= Yii::$app->homeUrl ?>kpi/view/kpi-history/<?= ModelMaster::encodeParams(['kpiId' => $kpiId, 'openTab' => 1]) ?>">
                                                                        <?= Yii::t('app', 'View Assign') ?>
                                                                    </a>
                                                                <?php
                                                                } else { ?>
                                                                    <span class="pull-left">
                                                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/view-<?= $colorFormat == 'disable' ? 'disable' : 'yenlow' ?>.svg"
                                                                            class="assing-icon mr-2">
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
                                                                            class="assing-icon mr-2">
                                                                    </span>
                                                                    <a href="<?= Yii::$app->homeUrl ?>kpi/assign/assign/<?= ModelMaster::encodeParams([
                                                                                                                            'kpiId' => $kpiId,
                                                                                                                            "companyId" => $kpi["companyId"],
                                                                                                                            "month" => $kpi["monthNumber"],
                                                                                                                            "year" => $kpi["year"]
                                                                                                                        ]) ?>"
                                                                        class="font-<?= $colorFormat ?>" style="top: 2px;">
                                                                        <?= Yii::t('app', 'Edit Assign') ?>
                                                                    </a>
                                                                <?php
                                                                } else { ?>
                                                                    <span class="pull-left">
                                                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/assign-<?= $colorFormat == 'disable' ? 'disable' : 'yenlow' ?>.svg"
                                                                            class="assing-icon mr-2">
                                                                    </span>
                                                                    <a href="<?= Yii::$app->homeUrl ?>kpi/assign/assign/<?= ModelMaster::encodeParams([
                                                                                                                            'kpiId' => $kpiId,
                                                                                                                            "companyId" => $kpi["companyId"],
                                                                                                                            "month" => $kpi["monthNumber"],
                                                                                                                            "year" => $kpi["year"]
                                                                                                                        ]) ?>"
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
                                                        <div class="col-4 pr-2">
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
                                                            class="col-5 <?= $kpi["countTeam"] == 0  && $colorFormat != "disable" ? 'yenlow-assignNew' : $colorFormat . '-assignNew' ?>">
                                                            <?php
                                                            if ($role <= 4) { // staff to team leader
                                                                if ($kpi["countTeam"] > 0) {
                                                            ?>
                                                                    <span class="pull-left">
                                                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/view-<?= $colorFormat ?>.svg"
                                                                            class="assing-icon mr-2">
                                                                    </span>
                                                                    <a class="font-<?= $colorFormat ?>" style="top: 2px;"
                                                                        href="<?= Yii::$app->homeUrl ?>kpi/view/kpi-history/<?= ModelMaster::encodeParams(['kpiId' => $kpiId, 'openTab' => 1]) ?>">
                                                                        <?= Yii::t('app', 'View Assign') ?>
                                                                    </a>
                                                                <?php
                                                                } else { ?>
                                                                    <span class="pull-left">
                                                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/view-<?= $colorFormat == 'disable' ? 'disable' : 'yenlow' ?>.svg"
                                                                            class="assing-icon mr-2">
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
                                                                            class="assing-icon mr-2">
                                                                    </span>
                                                                    <a href="<?= Yii::$app->homeUrl ?>kpi/assign/assign/<?= ModelMaster::encodeParams([
                                                                                                                            'kpiId' => $kpiId,
                                                                                                                            "companyId" => $kpi["companyId"],
                                                                                                                            "month" => $kpi["monthNumber"],
                                                                                                                            "year" => $kpi["year"]
                                                                                                                        ]) ?>"
                                                                        class="font-<?= $colorFormat ?>" style="top: 2px;">
                                                                        <?= Yii::t('app', 'Edit Assign') ?>
                                                                    </a>
                                                                <?php
                                                                } else { ?>
                                                                    <span class="pull-left">
                                                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/assign-<?= $colorFormat == 'disable' ? 'disable' : 'yenlow' ?>.svg"
                                                                            class="assing-icon mr-2">
                                                                    </span>
                                                                    <a href="<?= Yii::$app->homeUrl ?>kpi/assign/assign/<?= ModelMaster::encodeParams([
                                                                                                                            'kpiId' => $kpiId,
                                                                                                                            "companyId" => $kpi["companyId"],
                                                                                                                            "month" => $kpi["monthNumber"],
                                                                                                                            "year" => $kpi["year"]

                                                                                                                        ]) ?>"
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

                                            <div class="col-2 pr-0 pl-0" style="margin-top:5px;">
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
                                                <?php
                                                if ($kpi["priority"] != '') {
                                                ?>
                                                    <div class="col-12 text-center priority-box">
                                                        <div class="col-12"><?= Yii::t('app', 'Priority') ?></div>
                                                        <div class="col-12 text-priority"><?= $kpi["priority"] ?></div>
                                                    </div>
                                                <?php
                                                } else { ?>
                                                    <div class="col-12 text-center priority-box-null">
                                                        <div class="col-12"><?= Yii::t('app', 'Priority') ?></div>
                                                        <div class="col-12 text-priority">N/A</div>
                                                    </div>
                                                <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-1 pim-small-text border-right-<?= $colorFormat ?> pl-16 pr-10 mt-20">
                                        <div class="col-12"><?= Yii::t('app', 'Quant Ratio') ?></div>
                                        <div class="col-12 border-bottom-<?= $colorFormat ?> pb-10 pim-unit-text">
                                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/<?= $kpi["quantRatio"] == 1 ? 'quantity' : 'diamon' ?>.svg"
                                                class="pim-iconKFI" style="margin-top: -1px; margin-left: 3px;">
                                            <?= $kpi["quantRatio"] == 1 ? Yii::t('app', 'Quantity') : Yii::t('app', 'Quality') ?>
                                        </div>
                                        <div class="col-12 pr-0 pt-10 pl-0"><?= Yii::t('app', 'Update Interval') ?></div>
                                        <div class="col-12  pim-unit-text">
                                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/monthly.svg"
                                                class="pim-iconKFI" style="margin-top: -1px; margin-left: 3px;">
                                            <?= Yii::t('app', $kpi["unit"]) ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 pim-small-text border-right-<?= $colorFormat ?> mt-20 pr-15 pl-15">
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
                                                    $showPercent = round(floatval($kpi['ratio']));
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
                                            <div class="col-4 pl-5 pr-5 mt-16">
                                                <div class="col-12 text-end"><?= Yii::t('app', 'Last Updated on') ?></div>
                                                <div class="col-12 text-end pim-duedate">
                                                    <?= $kpi['lastestUpdate'] == "" ? 'Not set' : $kpi['lastestUpdate'] ?></div>
                                            </div>
                                            <div class="col-4 text-center mt-16 pt-5">
                                                <?php
                                                if ($colorFormat == 'disable' && $role >= 5) {
                                                ?>
                                                    <a href="<?= Yii::$app->homeUrl ?>kpi/management/prepare-update/<?= ModelMaster::encodeParams(['kpiId' => $kpiId, 'kpiHistoryId' => 0]) ?>"
                                                        style="display: flex; justify-content: center; align-items: center; padding: 7px 9px; height: 30px; gap: 6px; flex-shrink: 0;"
                                                        class="pim-btn-setup">
                                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/setupwhite.svg"
                                                            class="mb-2" style="width: 12px; height: 12px;">
                                                        <?= Yii::t('app', 'Setup') ?>
                                                    </a>
                                                <?php
                                                } else if ($colorFormat == "complete") {
                                                    // echo Yii::t('app', "Update");
                                                } else if ($role >= 5) {
                                                ?>
                                                    <a href="<?= Yii::$app->homeUrl ?>kpi/management/prepare-update/<?= ModelMaster::encodeParams(['kpiId' => $kpiId, 'kpiHistoryId' => 0]) ?>"
                                                        style="display: flex; justify-content: center; align-items: center; padding: 7px 9px; height: 30px; gap: 6px; flex-shrink: 0;"
                                                        class="pim-btn-<?= $colorFormat ?>">
                                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/refresh.svg"
                                                            class="mb-2" style="width: 12px; height: 12px;">
                                                        <?php
                                                        if ($colorFormat == "over") {
                                                            echo Yii::t('app', 'Update');
                                                        } else {
                                                            echo Yii::t('app', 'Update');
                                                        }
                                                        ?>
                                                    </a>
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
                                            <div class="col-4 pl-0 pr-5 mt-16">
                                                <div class="col-12 text-start font-<?= $colorFormat ?>">
                                                    <?= Yii::t('app', 'Next Update Date') ?></div>
                                                <div class="col-12 text-start pim-duedate">
                                                    <?= $kpi['nextCheck'] == "" ? Yii::t('app', 'Not set') : $kpi['nextCheck'] ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-5 pim-subheader-font mt-20">
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