<?php

use common\models\ModelMaster;
use yii\bootstrap5\ActiveForm;

$this->title = 'KGI Grid View';
?>
<div class="col-12">
    <div class="col-12">
        <img src="<?= Yii::$app->homeUrl ?>images/icons/black-icons/FinancialSystem/Vector.png" class="home-icon mr-5"
            style="margin-top: -3px;">
        <strong class="pim-head-text"> Performance Indicator Matrices (PIM)</strong>
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
                                <div class="col-4 pim-type-tab-selected pr-0 pl-0  rounded-top-left">
                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/company.svg" alt="Company"
                                        class="pim-icon" style="width: 14px;height: 14px;padding-bottom: 4px;">
                                    Company KGI
                                </div>
                                <div class="col-4 pim-type-tab">
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
                    <?= $this->render('filter_list_search', [
                        "companies" => $companies,
                        "months" => $months,
                        "companyId" => $companyId,
                        "branchId" => $branchId,
                        "teamId" => $teamId,
                        "month" => $month,
                        "status" => $status,
                        "branches" => $branches,
                        "teams" => $teams,
                        "yearSelected" => $year
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
                                    <div class="col-4 month-<?= $colorFormat ?>"><?= $kgi['month'] ?></div>
                                    <div class="col-8 term-<?= $colorFormat ?>">
                                        <?= $kgi['fromDate'] == "" ? 'Not set' : $kgi['fromDate'] ?> -
                                        <?= $kgi['toDate'] == "" ? 'Not set' : $kgi['toDate'] ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-5 col-md-2 col-4 text-end pr-20">
                                <!-- <a href="<?= Yii::$app->homeUrl ?>kgi/view/kgi-history/<?= ModelMaster::encodeParams(['kgiId' => $kgiId]) ?>"
                                    class="btn btn-bg-white-xs mr-5" style="margin-top: -3px;">
                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/eye.png" alt="History"
                                        class="pim-icon" style="margin-top: -1px;">
                                </a>     
                                <a href="<?= Yii::$app->homeUrl ?>kgi/view/index/<?= ModelMaster::encodeParams(['kgiId' => $kgiId, 'openTab' => 2]) ?>"
                                    class="btn btn-bg-white-xs mr-5" style="margin-top: -3px;">
                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/history.svg" alt="History"
                                        class="pim-icon mr-3" style="margin-top: -2px;">History
                                </a>
                                <a href="<?= Yii::$app->homeUrl ?>kgi/view/kgi-history/<?= ModelMaster::encodeParams(['kgiId' => $kgiId, 'openTab' => 3]) ?>"
                                    class="btn btn-bg-white-xs mr-5" style="margin-top: -3px;">
                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/comment.png" alt="Chats"
                                        class="pim-icon mr-3" style="margin-top: -2px;">Chats
                                </a>
                                <a href="<?= Yii::$app->homeUrl ?>kgi/view/kgi-history/<?= ModelMaster::encodeParams(['kgiId' => $kgiId, 'openTab' => 4]) ?>"
                                    class="btn btn-bg-white-xs mr-5" style="margin-top: -3px;">
                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/chart.png" alt="Chart"
                                        class="pim-icon mr-3" style="margin-top: -2px;">Chart
                                </a> -->
                                <a href="<?= Yii::$app->homeUrl ?>kgi/view/kgi-history/<?= ModelMaster::encodeParams(['kgiId' => $kgiId]) ?>"
                                    class="btn <?= $colorFormat == 'disable' ? 'btn-bg-gray-xs' : 'btn-bg-white-xs mr-5' ?> mr-5"
                                    style="margin-top: -3px; <?= $colorFormat == 'disable' ? 'pointer-events: none; opacity: 0.5;' : '' ?>">
                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/eye.png" alt="History"
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
                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/comment.png" alt="Chats"
                                        class="pim-icon mr-3" style="margin-top: -2px;">Chats
                                </a>
                                <a href="<?= Yii::$app->homeUrl ?>kgi/view/kgi-history/<?= ModelMaster::encodeParams(['kgiId' => $kgiId, 'openTab' => 4]) ?>"
                                    class="btn <?= $colorFormat == 'disable' ? 'btn-bg-gray-xs' : 'btn-bg-white-xs mr-5' ?> mr-5"
                                    style="margin-top: -3px; <?= $colorFormat == 'disable' ? 'pointer-events: none; opacity: 0.5;' : '' ?>">
                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/chart.png" alt="Chart"
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
                                                        <div class="col-2">
                                                            <?php
                                                                    if (isset($kgi['kgiEmployee'][0])) {
                                                                    ?>
                                                            <img src="<?= Yii::$app->homeUrl . $kgi['kgiEmployee'][0] ?>"
                                                                class="pim-pic-gridNew">
                                                            <?php
                                                                    }
                                                                    ?>
                                                        </div>
                                                        <div class="col-2 pic-after pt-0">
                                                            <?php
                                                                    if (isset($kgi['kgiEmployee'][1])) {
                                                                    ?>
                                                            <img src="<?= Yii::$app->homeUrl . $kgi['kgiEmployee'][1] ?>"
                                                                class="pim-pic-gridNew">
                                                            <?php
                                                                    }
                                                                    ?>
                                                        </div>
                                                        <div class="col-2 pic-after pt-0">
                                                            <?php
                                                                    if (isset($kgi['kgiEmployee'][2])) {
                                                                    ?>
                                                            <img src="<?= Yii::$app->homeUrl . $kgi['kgiEmployee'][2] ?>"
                                                                class="pim-pic-gridNew">
                                                            <?php
                                                                    }
                                                                    ?>
                                                        </div>
                                                        <div
                                                            class="col-5 number-tagNew  <?= $kgi["countEmployee"] == 0 ? 'load-yenlow' : 'load-'  . $colorFormat ?> ">
                                                            <?= $kgi["countEmployee"] ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div
                                                    class="col-6 <?= $kgi["countEmployee"] == 0 ? 'yenlow-assignNew' : $colorFormat . '-assignNew' ?>">
                                                    <?php
														if ($colorFormat == "disable" || $role < 3) {
															// เงื่อนไข 1: ถ้า $colorFormat ไม่ใช่ "disable"
															?>
                                                    <span class="font-<?= $colorFormat ?> ml-16" style="top: 2px;">
                                                        View Assigned
                                                    </span>
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
                                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/assign-<?= $colorFormat ?>.png"
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
                                                                    src="<?= Yii::$app->homeUrl ?>images/icons/Settings/teamwhite.svg">
                                                            </div>
                                                        </div>
                                                        <div class="col-2 pic-after pt-0">
                                                            <div class="pim-pic-<?= $colorFormat ?>">
                                                                <img
                                                                    src="<?= Yii::$app->homeUrl ?>images/icons/Settings/teamwhite.svg">
                                                            </div>
                                                        </div>
                                                        <div class="col-2 pic-after pt-0">
                                                            <div class="pim-pic-<?= $colorFormat ?>">
                                                                <img
                                                                    src="<?= Yii::$app->homeUrl ?>images/icons/Settings/teamwhite.svg">
                                                            </div>
                                                        </div>
                                                        <div class="col-5 number-tagNew load-<?= $colorFormat ?>">
                                                            <?= $kgi["countTeam"] ?>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="col-6 <?= $colorFormat ?>-assignNew ">
                                                    <span class="pull-left"
                                                        style="display:<?= $kgi['isOver'] == 2 ? 'none;' : '' ?>">
                                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/assign-<?= $colorFormat ?>.png"
                                                            class="home-icon mr-2">
                                                    </span>
                                                    <?php
															if ($colorFormat != "disable" && $role > 3  ) {
																?>
                                                    <a href="<?= Yii::$app->homeUrl ?>kgi/assign/assign/<?= ModelMaster::encodeParams(['kgiId' => $kgiId, "companyId" => $kgi["companyId"]]) ?>"
                                                        class="font-<?= $colorFormat ?>" style="top: 2px;">
                                                        Assign Team
                                                    </a>
                                                    <?php
															} else { ?>
                                                    <span class="font-<?= $colorFormat ?> ml-16" style="top: 2px;">
                                                        View Team
                                                    </span>
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
                                                            $show = number_format($decimal[0]);
                                                        } else {
                                                            $show = number_format($kgi["targetAmount"], 2);
                                                        }
                                                    } else {
                                                        $show = number_format($kgi["targetAmount"]);
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
                                        if ($colorFormat == 'disable') {
                                        ?>
                                        <div onclick="javascript:updateKfi(<?= $kgiId ?>)" class="pim-btn-setup"
                                            data-bs-toggle="modal" data-bs-target="#update-kgi-modal">
                                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/setupwhite.svg"
                                                class="mb-2" style="width: 12px; height: 12px;"> Setup
                                        </div>
                                        <?php
                                            }else if ($colorFormat == 'complete') {
                                        ?>
                                        <div onclick="javascript:updateKgi(<?= $kgiId ?>)" class="pim-btn-complete"
                                            data-bs-toggle="modal" data-bs-target="#update-kgi-modal">
                                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/refresh.svg"
                                                class="mb-2" style="width: 12px; height: 12px;"> Edit
                                        </div>
                                        <?php
                                            }else if ($role >= 5){
                                        ?>
                                        <div onclick=" javascript:updateKgi(<?= $kgiId ?>)"
                                            class="pim-btn-<?= $colorFormat ?>" data-bs-toggle="modal"
                                            data-bs-target="#update-kgi-modal">
                                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/refresh.svg"
                                                class="mb-2" style="width: 12px; height: 12px;"> Update
                                        </div>
                                        <?php
                                            }
                                        ?>

                                        <!-- <?php
                                                if ($role > 3) {
                                                ?>
                                        <div onclick="javascript:updateKgi(<?= $kgiId ?>)"
                                            class="pim-btn-<?= $colorFormat ?>" data-bs-toggle="modal"
                                            data-bs-target="#update-kgi-modal">
                                            <i class="fa fa-refresh" aria-hidden="true"></i> Update
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
                    <?php
                        endforeach;
                    }
                    ?>
                </div>
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
    <!-- end -->