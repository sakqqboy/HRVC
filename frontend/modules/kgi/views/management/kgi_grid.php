<?php

use common\models\ModelMaster;
use yii\bootstrap5\ActiveForm;

$this->title = 'KGI Grid View';
?>
<div class="col-12">
    <div class="col-12">
        <img src="<?= Yii::$app->homeUrl ?>images/icons/black-icons/FinancialSystem/Group23177.svg"
            class="home-icon mr-5" style="margin-top: -3px;">

        <span class="pim-head-text"> Performance Indicator Matrices (PIM)</span>
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
                                    Company KGI
                                </div>
                                <div class="col-4 pr-0 pl-0 pim-type-tab">
                                    <a href="<?= Yii::$app->homeUrl ?>kgi/kgi-team/team-kgi-grid"
                                        class="no-underline-black ">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/team.svg" alt="Team"
                                            class="pim-icon" style="width: 13px;height: 13px;padding-bottom: 2px;">
                                        Team KGI
                                    </a>
                                </div>
                                <div class="col-4 pim-type-tab rounded-top-right">
                                    <a href="<?= Yii::$app->homeUrl ?>kgi/kgi-personal/individual-kgi-grid"
                                        class="no-underline-black">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/self.svg" alt="Self"
                                            class="pim-icon" style="width: 13px;height: 13px;padding-bottom: 3px;">
                                        Self KGI
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-4 pl-4">
                            <?php
                            if ($role >= 3) {
                            ?>
                                <button type="button" class="btn-createnew font-size-11" data-bs-toggle="modal"
                                    data-bs-target="#staticBackdrop5" style="position:absolute;">
                                    Create New
                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/plus.svg" alt="History"
                                        class="pim-icon ml-3" style="margin-top: -1px;">
                                </button>
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
                        <a href="<?= Yii::$app->homeUrl . 'kgi/management/index' ?>"
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
                    if (isset($kgis) && count($kgis) > 0) {
                        foreach ($kgis as $kgiId => $kgi) :
                            //throw new exception(print_r($kgi, true));
                            if ($kgi["isOver"] == 1 && $kgi["status"] != 2) {
                                $colorFormat = 'over';
                            } else {
                                if ($kgi["status"] == 1) {
                                    if ($kgi["isOver"] == 2) {
                                        $colorFormat = 'disable';
                                    } else {
                                        $colorFormat = 'inprogress';
                                    }
                                } else {
                                    $colorFormat = 'complete';
                                }
                            }
                    ?>
                            <div class="col-12 mt-10 mb-5 pim-big-box pim-<?= $colorFormat ?>" id="kgi-<?= $kgiId ?>">
                                <div class="row">
                                    <div class="col-lg-3 col-md-5 col-12 pim-name">
                                        <?= $kgi["kgiName"] ?>
                                    </div>
                                    <div class="col-lg-1 col-md-2 col-4 text-center">
                                        <div class="<?= $colorFormat ?>-tag text-center">
                                            <?= $kgi['status'] == 1 ? 'In process' : 'Completed' ?>
                                        </div>
                                    </div>
                                    <div class=" col-lg-3 col-md-3 col-4 pl-30">
                                        <div class="row">
                                            <div class="col-4 month-<?= $colorFormat ?>">
                                                <?= $kgi['month'] == "" ? 'Month' : $kgi['month'] ?>
                                            </div>
                                            <div class="col-8 term-<?= $colorFormat ?>">
                                                <?= $kgi['fromDate'] == "" ? 'Not set' : $kgi['fromDate'] ?> -
                                                <?= $kgi['toDate'] == "" ? 'Not set' : $kgi['toDate'] ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-5 col-md-2 col-4 text-end pr-20">
                                        <a href="<?= Yii::$app->homeUrl ?>kgi/view/kgi-history/<?= ModelMaster::encodeParams(['kgiId' => $kgiId]) ?>"
                                            class="btn <?= $colorFormat == 'disable' ? 'btn-bg-gray-xs' : 'btn-bg-white-xs mr-5' ?> mr-5"
                                            style="margin-top: -3px; <?= $colorFormat == 'disable' ? 'pointer-events: none; opacity: 0.5;' : '' ?>">
                                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/eye.svg" alt="History"
                                                class="pim-icon" style="margin-top: -1px;">
                                        </a>
                                        <a href="<?= Yii::$app->homeUrl ?>kgi/view/index/<?= ModelMaster::encodeParams(['kgiId' => $kgiId, 'openTab' => 2]) ?>"
                                            class="btn <?= $colorFormat == 'disable' ? 'btn-bg-gray-xs' : 'btn-bg-white-xs mr-5' ?> mr-5"
                                            style="margin-top: -3px; <?= $colorFormat == 'disable' ? 'pointer-events: none; opacity: 0.5;' : '' ?>">
                                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/history.svg" alt="History"
                                                class="pim-icon mr-3" style="margin-top: -2px;">History
                                        </a>
                                        <a href="<?= Yii::$app->homeUrl ?>kgi/view/kgi-history/<?= ModelMaster::encodeParams(['kgiId' => $kgiId, 'openTab' => 3]) ?>"
                                            class="btn <?= $colorFormat == 'disable' ? 'btn-bg-gray-xs' : 'btn-bg-white-xs mr-5' ?> mr-5"
                                            style="margin-top: -3px; <?= $colorFormat == 'disable' ? 'pointer-events: none; opacity: 0.5;' : '' ?>">
                                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/comment.svg" alt="Chats"
                                                class="pim-icon mr-3" style="margin-top: -2px;">Chats
                                        </a>
                                        <a href="<?= Yii::$app->homeUrl ?>kgi/view/kgi-history/<?= ModelMaster::encodeParams(['kgiId' => $kgiId, 'openTab' => 4]) ?>"
                                            class="btn <?= $colorFormat == 'disable' ? 'btn-bg-gray-xs' : 'btn-bg-white-xs mr-5' ?> mr-5"
                                            style="margin-top: -3px; <?= $colorFormat == 'disable' ? 'pointer-events: none; opacity: 0.5;' : '' ?>">
                                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/chart.svg" alt="Chart"
                                                class="pim-icon mr-3" style="margin-top: -2px;">Chart
                                        </a>
                                        <?php
                                        if ($role >= 5) {
                                        ?>
                                            <a class="btn btn-bg-red-xs" data-bs-toggle="modal" data-bs-target="#delete-kgi"
                                                onclick="javascript:prepareDeleteKgi(<?= $kgiId ?>)" style="margin-top: -3px;"
                                                onmouseover="this.querySelector('.pim-icon').src='<?= Yii::$app->homeUrl ?>images/icons/Settings/binwhite.svg'"
                                                onmouseout="this.querySelector('.pim-icon').src='<?= Yii::$app->homeUrl ?>images/icons/Settings/binred.svg'">
                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/binred.svg" alt="History"
                                                    class="pim-icon" style="margin-top: -2px;">
                                            </a>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                    <div class="col-lg-3 pim-subheader-font border-right-<?= $colorFormat ?> mt-5">
                                        <div class="row">
                                            <div class="col-12 text-start pl-22 fw-bold text-dark">
                                                Assign on
                                            </div>
                                            <div class="col-9 pl-20 pr-0">
                                                <div class="col-12 mt-5 pt-2 pb-1">
                                                    <div class="row">
                                                        <div class="col-5 pr-2 pl-13">
                                                            <div class="row d-flex align-items-center"
                                                                style="min-height: 24px;">
                                                                <?php if ($kgi["countEmployee"] != 0) { ?>
                                                                    <div class="col-2">
                                                                        <?php if (isset($kgi['kgiEmployee'][0])): ?>
                                                                            <img src="<?= Yii::$app->homeUrl . $kgi['kgiEmployee'][0] ?>"
                                                                                class="pim-pic-gridNew">
                                                                        <?php endif; ?>
                                                                    </div>
                                                                    <div class="col-2 pic-after pt-0">
                                                                        <?php if (isset($kgi['kgiEmployee'][1])): ?>
                                                                            <img src="<?= Yii::$app->homeUrl . $kgi['kgiEmployee'][1] ?>"
                                                                                class="pim-pic-gridNew">
                                                                        <?php endif; ?>
                                                                    </div>
                                                                    <div class="col-2 pic-after pt-0">
                                                                        <?php if (isset($kgi['kgiEmployee'][2])): ?>
                                                                            <img src="<?= Yii::$app->homeUrl . $kgi['kgiEmployee'][2] ?>"
                                                                                class="pim-pic-gridNew">
                                                                        <?php endif; ?>
                                                                    </div>
                                                                    <div
                                                                        class="col-5 number-tagNew  <?= $kgi["countEmployee"] == 0 && $colorFormat != "disable"  ? 'load-yenlow' : 'load-'  . $colorFormat ?> ">
                                                                        <?= $kgi["countEmployee"] ?>
                                                                    </div>
                                                                <?php } else { ?>
                                                                    <div class="col-2 ">
                                                                        <div
                                                                            class="<?= $kgi['countEmployee'] == 0 && $colorFormat != 'disable' ? 'pim-pic-yenlow' : 'pim-pic-' . $colorFormat ?>">
                                                                            <img
                                                                                src="<?= Yii::$app->homeUrl ?>images/icons/Settings/personblack.svg">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-2 pic-after pt-0">
                                                                        <div
                                                                            class="<?= $kgi['countEmployee'] == 0 && $colorFormat != 'disable' ? 'pim-pic-yenlow' : 'pim-pic-' . $colorFormat ?>">
                                                                            <img
                                                                                src="<?= Yii::$app->homeUrl ?>images/icons/Settings/personblack.svg">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-2 pic-after pt-0">
                                                                        <div
                                                                            class="<?= $kgi['countEmployee'] == 0 && $colorFormat != 'disable' ? 'pim-pic-yenlow' : 'pim-pic-' . $colorFormat ?>">
                                                                            <img
                                                                                src="<?= Yii::$app->homeUrl ?>images/icons/Settings/personblack.svg">
                                                                        </div>
                                                                    </div>
                                                                    <div
                                                                        class="col-5 number-tagNew  <?= $kgi["countEmployee"] == 0 && $colorFormat != "disable"  ? 'load-yenlow' : 'load-'  . $colorFormat ?> ">
                                                                        <?= $kgi["countEmployee"] ?>
                                                                    </div>
                                                                <?php } ?>
                                                            </div>
                                                        </div>
                                                        <div
                                                            class="col-6 <?= $kgi["countEmployee"] == 0  && $colorFormat != "disable" ? 'yenlow-assignNew' : $colorFormat . '-assignNew' ?>">
                                                            <?php
                                                            if ($colorFormat == "disable" || $role < 3) {
                                                                // เงื่อนไข 1: ถ้า $colorFormat ไม่ใช่ "disable"
                                                            ?>
                                                                <span class="pull-left">
                                                                    <img src="
                                                        <?= Yii::$app->homeUrl ?>images/icons/Settings/view-<?= $colorFormat ?>.svg"
                                                                        class="home-icon mr-2">
                                                                </span>
                                                                <a class="font-<?= $colorFormat ?>" style="top: 2px;">
                                                                    View Assigned
                                                                </a>
                                                            <?php
                                                            } elseif ($kgi["countEmployee"] == 0) {
                                                                // เงื่อนไข 2: ถ้า $kgi["countEmployee"] เท่ากับ 0
                                                            ?>
                                                                <span class="pull-left">
                                                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/assign-yenlow.svg"
                                                                        class="home-icon mr-2">
                                                                </span>
                                                                <a href="<?= Yii::$app->homeUrl ?>kgi/assign/assign/<?= ModelMaster::encodeParams(['kgiId' => $kgiId, "companyId" => $kgi["companyId"], "save" => 0]) ?>"
                                                                    class="font-black" style="top: 2px;">
                                                                    Assign Person
                                                                </a>
                                                            <?php
                                                            } elseif ($role > 3) {
                                                                // เงื่อนไข 3: ถ้า $role มากกว่า 3
                                                            ?>
                                                                <span class="pull-left"
                                                                    style="display:<?= $kgi['isOver'] == 2 ? 'none;' : '' ?>">
                                                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/assign-<?= $colorFormat ?>.svg"
                                                                        class="home-icon mr-2">
                                                                </span>
                                                                <a href="<?= Yii::$app->homeUrl ?>kgi/assign/assign/<?= ModelMaster::encodeParams(['kgiId' => $kgiId, "companyId" => $kgi["companyId"], "save" => 0]) ?>"
                                                                    class="font-<?= $colorFormat ?>" style="top: 2px;">
                                                                    Edit Assigned
                                                                </a>
                                                            <?php
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 mt-10 pt-5 pb-1">
                                                    <div class="row">
                                                        <div class="col-5 pr-2">
                                                            <!-- <div class="row">
                                                        <div class="col-4">
                                                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/teamwhite.svg"
                                                                class="pim-pic-<?= $colorFormat ?>">
                                                        </div>
                                                        <div class=" col-4 number-tagNew load-<?= $colorFormat ?> pr-3
                                                                pl-3 pt-1 ml-5" style="height:18px;">
                                                            <?= $kgi["countTeam"] ?>
                                                        </div>
                                                    </div> -->
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
                                                                    <?= $kgi["countTeam"] ?>
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="col-6 <?= $colorFormat ?>-assignNew ">
                                                            <?php
                                                            if ($colorFormat != "disable" && $role > 3) {
                                                            ?>
                                                                <span class="pull-left"
                                                                    style="display:<?= $kgi['isOver'] == 2 ? 'none;' : '' ?>">
                                                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/assign-<?= $colorFormat ?>.svg"
                                                                        class="home-icon mr-2">
                                                                </span>
                                                                <a href="<?= Yii::$app->homeUrl ?>kgi/assign/assign/<?= ModelMaster::encodeParams(['kgiId' => $kgiId, "companyId" => $kgi["companyId"]]) ?>"
                                                                    class="font-<?= $colorFormat ?>" style="top: 2px;">
                                                                    Assign Team
                                                                </a>
                                                            <?php
                                                            } else { ?>
                                                                <span class="pull-left">
                                                                    <img src="
                                                        <?= Yii::$app->homeUrl ?>images/icons/Settings/view-<?= $colorFormat ?>.svg"
                                                                        class="home-icon mr-2">
                                                                </span>
                                                                <a class="font-<?= $colorFormat ?>" style="top: 2px;">
                                                                    View Team
                                                                </a>
                                                            <?php
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
                                                    if ($kgi["priority"] == "A" || $kgi["priority"] == "B") {
                                                    ?>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                    <?php
                                                    }
                                                    if ($kgi["priority"] == "A" || $kgi["priority"] == "C") {
                                                    ?>
                                                        <i class="fa fa-star big-star" aria-hidden="true"></i>
                                                    <?php
                                                    }
                                                    if ($kgi["priority"] == "B") {
                                                    ?>
                                                        <i class="fa fa-star ml-10" aria-hidden="true"></i>
                                                    <?php
                                                    }
                                                    if ($kgi["priority"] == "A") {
                                                    ?>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                    <?php
                                                    }
                                                    ?>
                                                </div>
                                                <div class="col-12 text-center priority-box">
                                                    <div class="col-12">Priority</div>
                                                    <div class="col-12 text-priority"><?= $kgi["priority"] ?></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-1 pim-subheader-font border-right-<?= $colorFormat ?> mt-5 pl-10 pr-10">
                                        <div class="col-12">Quant Ratio</div>
                                        <div class="col-12 border-bottom-<?= $colorFormat ?> pb-10 pim-duedate">
                                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/<?= $kgi["quantRatio"] == 1 ? 'quantity' : 'diamon' ?>.svg"
                                                class="pim-iconKFI" style="margin-top: -1px; margin-left: 3px;">
                                            <?= $kgi["quantRatio"] == 1 ? 'Quantity' : 'Quality' ?>
                                        </div>
                                        <div class="col-12 pr-0 pt-10 pl-0">update Interval</div>
                                        <div class="col-12  pim-duedate">
                                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/monthly.svg"
                                                class="pim-iconKFI" style="margin-top: -1px; margin-left: 3px;">
                                            <?= $kgi["unit"] ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 pim-subheader-font border-right-<?= $colorFormat ?> mt-5 pr-15 pl-15">
                                        <div class="row">
                                            <div class="col-5 text-start">
                                                <div class="col-12">
                                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/Target.svg"
                                                        class="pim-iconKFI" style="margin-top: 1px; margin-right: 3px;">
                                                    Target
                                                </div>
                                                <div class="col-12 mt-3 number-pim">
                                                    <?php
                                                    $decimal = explode('.', $kgi["targetAmount"]);
                                                    if (isset($decimal[1])) {
                                                        if ($decimal[1] == '00') {
                                                            $show = $decimal[0];
                                                        } else {
                                                            $show = $kgi["targetAmount"];
                                                        }
                                                    } else {
                                                        $show = $kgi["targetAmount"];
                                                    }
                                                    ?>
                                                    <?= $show ?><?= $kgi["amountType"] == 1 ? '%' : '' ?>
                                                </div>
                                            </div>
                                            <div class="col-2 symbol-pim text-center">
                                                <div class="col-12 pt-17"><?= $kgi["code"] ?></div>
                                            </div>
                                            <div class="col-5  text-end">
                                                <div class="col-12">Result
                                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/Result.svg"
                                                        class="pim-iconKFI" style="margin-top: 1px; margin-left: 3px;">
                                                </div>
                                                <div class="col-12 mt-3 number-pim">
                                                    <?php
                                                    if ($kgi["result"] != '') {
                                                        $decimalResult = explode('.', $kgi["result"]);
                                                        if (isset($decimalResult[1])) {

                                                            if ($decimalResult[1] == '00') {
                                                                $showResult = number_format($decimalResult[0]);
                                                            } else {
                                                                $showResult = number_format($kgi["result"], 2);
                                                            }
                                                        } else {
                                                            $showResult = number_format($kgi["result"]);
                                                        }
                                                    } else {
                                                        $showResult = 0;
                                                    }
                                                    ?>
                                                    <?= $showResult ?><?= $kgi["amountType"] == 1 ? '%' : '' ?>
                                                </div>
                                            </div>
                                            <div class="col-12 pl-15 pr-10">
                                                <?php
                                                $percent = explode('.', $kgi['ratio']);
                                                if (isset($percent[0]) && $percent[0] == '0') {
                                                    if (isset($percent[1])) {
                                                        if ($percent[1] == '00') {
                                                            $showPercent = 0;
                                                        } else {
                                                            $showPercent = round($kgi['ratio'], 1);
                                                        }
                                                    }
                                                } else {
                                                    $showPercent = round($kgi['ratio']);
                                                }
                                                ?>
                                                <div class="progress">
                                                    <div class="progress-bar-<?= $colorFormat ?>"
                                                        style="width:<?= $showPercent ?>%;"></div>
                                                    <span
                                                        class="progress-load load-<?= $colorFormat ?>"><?= $showPercent ?>%</span>
                                                </div>
                                            </div>
                                            <div class="col-4 pl-5 pr-5 mt-10">
                                                <div class="col-12 text-end">Last Updated on</div>
                                                <div class="col-12 text-end pim-duedate">
                                                    <?= $kgi['nextCheck'] == "" ? 'Not set' : $kgi['nextCheck'] ?></div>
                                            </div>
                                            <div class="col-4 text-center mt-10 pt-6">

                                                <?php
                                                if ($colorFormat == 'disable' && $role >= 5) {
                                                ?>
                                                    <div onclick="javascript:updateKgi(<?= $kgiId ?>)" class="pim-btn-setup"
                                                        data-bs-toggle="modal" data-bs-target="#update-kgi-modal">
                                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/setupwhite.svg"
                                                            class="mb-2" style="width: 12px; height: 12px;"> Setup
                                                    </div>
                                                <?php
                                                } else if ($role >= 5) {
                                                ?>
                                                    <div onclick=" javascript:updateKgi(<?= $kgiId ?>)"
                                                        class="pim-btn-<?= $colorFormat ?>" data-bs-toggle="modal"
                                                        data-bs-target="#update-kgi-modal">
                                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/refresh.svg"
                                                            class="mb-2" style="width: 12px; height: 12px;">
                                                        <?php if ($colorFormat == "complete") {
                                                            echo  "Edit";
                                                        } else if ($colorFormat == "over") {
                                                            echo  "Passed";
                                                        } else {
                                                            echo  "Update";
                                                        }
                                                        ?>
                                                    </div>
                                                <?php
                                                }
                                                ?>

                                                <!-- <?php
                                                        //if ($role > 3  && $kgi["status"] == 1) {
                                                        if ($role > 3) {
                                                        ?>
                                        <div onclick="javascript:updateKgi(<?= $kgiId ?>)"
                                            class="pim-btn-<?= $colorFormat ?>" data-bs-toggle="modal"
                                            data-bs-target="#update-kgi-modal">
                                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/setupwhite.svg"
                                                class="pim-iconKFI" style="margin-top: 1px; margin-left: 3px;"> Update
                                        </div>
                                        <?php
                                                        }
                                        ?> -->
                                            </div>
                                            <div class="col-4 pl-0 pr-5 mt-10">
                                                <div class="col-12 text-start font-<?= $colorFormat ?>">Next Update Date</div>
                                                <div class="col-12 text-start pim-duedate">
                                                    <?= $kgi['nextCheck'] == "" ? 'Not set' : $kgi['nextCheck'] ?></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-5 pim-subheader-font mt-5">
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-12 pr-3 pl-20">
                                                <div class="col-12 head-letter head-<?= $colorFormat ?>">Issue</div>
                                                <div class="col-12 body-letter body-letter-<?= $colorFormat ?>">
                                                    <?= $kgi["issue"] ?>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-12 pr-20">
                                                <div class="col-12 head-letter head-<?= $colorFormat ?>">Solution</div>
                                                <div class="col-12 body-letter body-letter-<?= $colorFormat ?>">
                                                    <?= $kgi["solution"] ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="col-12 kgi-grid-box <?php // $kgi['isOver'] == 1 ? 'bg-over' : 'bg-white' 
                                                                    ?>" id="kgi-<?php // $kgiId 
                                                                                ?>">
								<div class="row">
									<div class="col-lg-6 col-md-6 col-6 clients-employee">
										<i class="fa fa-flag" aria-hidden="true"></i> <?php // $kgi["kgiName"] 
                                                                                        ?>
										<span class="badge rounded-pill ml-5 <?php // $kgi['status'] == 4 ? 'bg-success' : 'bg-warning text-dark' 
                                                                                ?> "> <?php // $kgi['status'] == 4 ? 'Completed' : 'On process' 
                                                                                        ?></span>
										<span class="month-feb ml-10"><?php // $kgi["month"] 
                                                                        ?></span>
									</div>
									<div class="col-lg-6 col-md-6 col-6">
										<div class="row">
											<div class="col-5 text-end">
												<span class="badge rounded-badge bg-white pb-0">
													<div class="flex mb-5">
														<?php
                                                        /*if (isset($kgi["employee"]) && count($kgi["employee"]) > 0) {
															$e = 1;
															foreach ($kgi["employee"] as $emp) : ?>
																<img class="image-grid" src="<?= Yii::$app->homeUrl . $emp ?>">
														<?php
																if ($e == 3) {
																	break;
																}
																$e++;
															endforeach;
														}*/
                                                        ?>
														<a class="no-underline-black ml-2 mt-3 font-size-10" href="#"><?php // count($kgi["employee"]) 
                                                                                                                        ?></a>
													</div>
												</span>
												<span class="badge rounded-pill bg-bsc font-size-10">
													<i class="fa fa-users" aria-hidden="true"></i> <?php // $kgi["countTeam"] 
                                                                                                    ?>
												</span>
											</div>
											<div class="col-5">
												<div class="row">
													<div class="col-12 flex-tokyo text-end">
														<?php // $kgi["companyName"] 
                                                        ?>
													</div>
													<div class="col-12 tokyo-ima text-end">
														<img src="<?php // Yii::$app->homeUrl 
                                                                    ?><?php // $kgi["flag"] 
                                                                        ?>" class="image-flex"> <?php // $kgi["branch"] 
                                                                                                ?>, <?php //$kgi["countryName"] 
                                                                                                    ?>
													</div>
												</div>
											</div>
											<div class="col-lg-2 col-md-6 col-12 text-end">
												<button class="btn btn-sm btn-outline-secondary font-size-10" data-bs-toggle="modal" data-bs-target="#kgi-view" onclick="javascript:kgiHistory(<?php // $kgiId 
                                                                                                                                                                                                ?>)">
													<i class="fa fa-eye" aria-hidden="true"></i>
												</button>
												<?php
                                                //if ($role >= 4) {
                                                ?>
													<button class="btn btn-sm btn-outline-danger font-size-10" data-bs-toggle="modal" data-bs-target="#delete-kgi" onclick="javascript:prepareDeleteKgi(<?php // $kgiId 
                                                                                                                                                                                                        ?>)">
														<i class="fa fa-trash-o" aria-hidden="true"></i>
													</button>
												<?php
                                                //}
                                                ?>
											</div>
										</div>
									</div>
								</div>
								<div class="row pb-3" style="margin-top: -5px;">
									<div class="col-lg-2 col-md-6 col-12">
										<div class="col-12">
											<span class="badge rounded-pill slds-badge">
												Term <span class="text-dark font-size-10">: <?php // $kgi["fromDate"] 
                                                                                            ?> - <?php // $kgi["toDate"] 
                                                                                                    ?></span>
											</span>
											<?php
                                            //if ($role >= 3) {
                                            ?>
												<div class="col-12 font-size-12 text-center mt-5">
													Assign
												</div>
												<div class="col-12 pt-8 text-center">
													<a href="<?php //Yii::$app->homeUrl 
                                                                ?>kgi/kgi-team/kgi-team-setting/<?php //ModelMaster::encodeParams(['kgiId' => $kgiId]) 
                                                                                                ?>" class="btn btn-sm btn-primary mr-20 font-size-10" title="Team KGI setting">
														<i class="fa fa-users mr-3" aria-hidden="true"></i> Team
													</a>
													<a href="<?php // Yii::$app->homeUrl 
                                                                ?>kgi/kgi-personal/indivisual-setting/<?php // ModelMaster::encodeParams(['kgiId' => $kgiId]) 
                                                                                                        ?>" class="btn btn-sm btn-info text-light font-size-10" title="Indivisual KGI setting">
														<i class="fa fa-user mr-3" aria-hidden="true"></i> Person
													</a>
												</div>
											<?php
                                            //}
                                            ?>
										</div>

									</div>
									<div class="col-lg-2 col-md-6 col-12 sample-bordersolid">
										<div class="row">
											<div class="col-md-6">
												<div class="col-12 font-size-12 pt-5">
													Quant Ratio
												</div>
												<div class="col-12 Quality-diamond">
													<i class="fa fa-diamond" aria-hidden="true"></i> <?php // $kgi["quantRatio"] == 1 ? 'Quantity' : 'Quality' 
                                                                                                        ?>
												</div>
												<div class="col-12 font-size-10 pt-20" style="width: 10rem;">
													Update Interval
												</div>
												<div class="col-12 Quality-monthly0">
													<?php // $kgi["unit"] 
                                                    ?>
												</div>
											</div>
											<div class="col-md-6 text-center pt-5">
												<div class="col-12 font-size-12">
													Priority
												</div>
												<div class="col-12 mt-8 pl-17">
													<div class="circle-update text-center"><?php //$kgi["priority"] 
                                                                                            ?></div>
												</div>
											</div>
										</div>
									</div>
									<div class="col-lg-3 col-md-6 col-12 progress-bordersolid">
										<div class="row">
											<div class="col-md-5">
												<div class="col-12 target-progress text-center">
													<i class="fa fa-bullseye" aria-hidden="true"></i> Target
												</div>
												<div class="col-12 target-million text-center">
													<?php
                                                    // $decimal = explode('.', $kgi["targetAmount"]);
                                                    // if (isset($decimal[1])) {
                                                    // 	if ($decimal[1] == '00') {
                                                    // 		$show = $decimal[0];
                                                    // 	} else {
                                                    // 		$show = $kgi["targetAmount"];
                                                    // 	}
                                                    // } else {
                                                    // 	$show = $kgi["targetAmount"];
                                                    // }
                                                    ?>
													<?php //$show 
                                                    ?><?php // $kgi["amountType"] == 1 ? '%' : '' 
                                                        ?>
												</div>
											</div>
											<div class="col-md-2 text-center">
												<div class="col-12 target-plush mt-15">
													<?php // $kgi["code"] 
                                                    ?>
												</div>
											</div>
											<div class="col-md-5">
												<div class="col-12 target-progress text-center">
													<i class="fa fa-trophy" aria-hidden="true"></i> Result
												</div>
												<div class="col-12 target-million text-center">
													<?php
                                                    // if ($kgi["result"] != '') {
                                                    // 	$decimalResult = explode('.', $kgi["result"]);
                                                    // 	if (isset($decimalResult[1])) {
                                                    // 		if ($decimalResult[1] == '00') {
                                                    // 			$showResult = $decimalResult[0];
                                                    // 		} else {
                                                    // 			$showResult = $kgi["result"];
                                                    // 		}
                                                    // 	} else {
                                                    // 		$showResult = $kgi["result"];
                                                    // 	}
                                                    // } else {
                                                    // 	$showResult = 0;
                                                    // }
                                                    ?>
													<?php // $showResult 
                                                    ?><?php // $kgi["amountType"] == 1 ? '%' : '' 
                                                        ?>
												</div>
											</div>
										</div>
										<div class="col-12 mt-5">
											<div class="progress">
												<div class="progress-bar" style="width:<?php //$kgi['ratio'] 
                                                                                        ?>%;"></div>
												<?php
                                                // $decimal = explode(".", $kgi['ratio']);
                                                // if (isset($decimal[1]) && $decimal[1] == '00') {
                                                // 	$number = $decimal[0];
                                                // } else {
                                                // 	$number = $kgi['ratio'];
                                                // }
                                                ?>
												<span class="badge rounded-pill  pro-load2"><?php // $number 
                                                                                            ?>%</span>
											</div>
										</div>
										<div class="row" style="margin-top: -20px;">
											<div class="col-md-6">
												<div class="col-12 refresh0">
													<i class="fa fa-refresh mr-5" aria-hidden="true"></i> Latest Update
												</div>
												<div class="col-12 font-size-12 pt-5" style="font-weight: 700;">
													<?php // $kgi['periodCheck'] 
                                                    ?>
												</div>
											</div>
											<div class="col-md-6">
												<div class="row">
													<?php
                                                    // if ($role >= 4) {
                                                    // 	$col = 9;
                                                    // } else {
                                                    // 	$col = 12;
                                                    // } 
                                                    ?>
													<div class="col-12 font-size-10 font-b text-end">
														Next Update
														<?php
                                                        //if ($role >= 4) {
                                                        ?>
															<span class="pencil-nextupdate text-center ml-3" data-bs-toggle="modal" data-bs-target="#update-kgi-modal" onclick="javascript:updateKgi(<?php // $kgiId 
                                                                                                                                                                                                        ?>)">
																<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
															</span>
														<?php
                                                        //}
                                                        ?>
													</div>

												</div>
												<div class="col-12 font-size-10 text-end <?php // $kgi['isOver'] == 1 ? 'text-danger' : '' 
                                                                                            ?>" style="font-weight: 700;">
													<?php //$kgi['nextCheck'] 
                                                    ?>
												</div>
											</div>
										</div>
									</div>
									<div class="col-lg-5 col-md-6 col-12 card-bordersolid">
										<div class="row mt-15">
											<div class="col-md-6">
												<div class="col-12 dashed1" style="word-wrap: break-word;">
													<span class="text-dark font-size-11"> Issue</span>
													<p class="font-size-10 text-dark" id="lastest-issue-<?php //$kgiId 
                                                                                                        ?>"><?php //$kgi["issue"] 
                                                                                                            ?></p>
												</div>
											</div>
											<div class="col-md-6">
												<div class="col-12 dashed1" style="word-wrap: break-word;">
													<span class="text-dark font-size-11"> Solution</span>
													<p class="font-size-10 text-dark" id="lastest-solution-<?php // $kgiId 
                                                                                                            ?>"><?php //$kgi["solution"] 
                                                                                                                ?></p>
												</div>
											</div>
											<div class="col-12 text-end font-size-10 mt-3">
												<span data-bs-toggle="modal" data-bs-target="#kgi-issue" onclick="javascript:showKgiComment(<?php // $kgiId 
                                                                                                                                            ?>)" style="cursor: pointer;" class="text-primary">
													<i class="fa fa-eye mr-5" aria-hidden="true"></i>
													See more Issue & solution
												</span>
											</div>
										</div>
									</div>
								</div>
							</div> -->
                    <?php
                        endforeach;
                    }
                    ?>
                </div>
            </div>
            <!-- </div>
			</div> -->
        </div>
    </div>

</div>
<?= $this->render('modal_view') ?>

<input type="hidden" value="create" id="acType">
<?php
$form = ActiveForm::begin([
    'id' => 'create-kgi',
    'method' => 'post',
    'options' => [
        'enctype' => 'multipart/form-data',
    ],
    'action' => Yii::$app->homeUrl . 'kgi/management/create-kgi'

]); ?>
<?= $this->render('modal_create', [
    "units" => $units,
    "companies" => $companies,
    "months" => $months
]) ?>
<?php ActiveForm::end(); ?>

<?php
$form = ActiveForm::begin([
    'id' => 'update-kgi',
    'method' => 'post',
    'options' => [
        'enctype' => 'multipart/form-data',
    ],
    'action' => Yii::$app->homeUrl . 'kgi/management/update-kgi'

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
<?= $this->render('modal_kfi') ?>
<?= $this->render('modal_kpi') ?>

<!-- end -->