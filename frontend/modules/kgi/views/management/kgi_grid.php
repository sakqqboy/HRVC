<?php

use common\models\ModelMaster;
use yii\bootstrap5\ActiveForm;

$this->title = 'KGI Grid View';
?>
<div class="contrainer-body">
    <div class="col-12">
        <img src="<?= Yii::$app->homeUrl ?>images/icons/black-icons/FinancialSystem/Group23177.svg"
            class="home-icon mr-5" style="margin-top: -3px;">

        <span class="pim-head-text"> <?= Yii::t('app', 'Performance Indicator Matrices') ?> (PIM)</span>
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
                                    <?= Yii::t('app', 'Company KGI') ?>
                                </div>
                                <div class="col-4 pr-0 pl-0 pim-type-tab">
                                    <a href="<?= Yii::$app->homeUrl ?>kgi/kgi-team/team-kgi-grid"
                                        class="no-underline-black ">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/team.svg" alt="Team"
                                            class="pim-icon" style="width: 13px;height: 13px;padding-bottom: 2px;">
                                        <?= Yii::t('app', 'Team KGI') ?>
                                    </a>
                                </div>
                                <div class="col-4 pim-type-tab rounded-top-right">
                                    <a href="<?= Yii::$app->homeUrl ?>kgi/kgi-personal/individual-kgi-grid"
                                        class="no-underline-black">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/self.svg" alt="Self"
                                            class="pim-icon" style="width: 13px;height: 13px;padding-bottom: 3px;">
                                        <?= Yii::t('app', 'Self KGI') ?>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-4 pl-4">
                            <?php
                            if ($role >= 3) {
                            ?>
                            <!-- <button type="button" class="btn-createnew font-size-11" data-bs-toggle="modal"
                                    data-bs-target="#staticBackdrop5" style="position:absolute;">
                                    <?php // Yii::t('app', 'Create New') 
                                    ?>
                                    <img src="<?php // Yii::$app->homeUrl 
                                                ?>images/icons/Settings/plus.svg" alt="History"
                                        class="pim-icon ml-3" style="margin-top: -1px;">
                                </button> -->
                            <a href="<?= Yii::$app->homeUrl ?>kgi/management/create-kgi"
                                class="btn-createnew font-size-11" style="position:absolute;text-decoration:none;">
                                <?= Yii::t('app', 'Create New') ?>
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/plus.svg" alt="History"
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
                            //    throw new exception(print_r($kgi, true));
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
                                    <?= $kgi['status'] == 1 ?  Yii::t('app', 'In process') :  Yii::t('app', 'Completed') ?>
                                </div>
                            </div>
                            <div class=" col-lg-3 col-md-3 col-4 pl-30">
                                <div class="row">
                                    <div class="col-4 month-<?= $colorFormat ?>">
                                        <?= $kgi['month'] == "" ? Yii::t('app', 'Month') : Yii::t('app', $kgi['month']) ?>
                                    </div>
                                    <div class="col-8 term-<?= $colorFormat ?>">
                                        <?= $kgi['fromDate'] == "" ? Yii::t('app', 'Not set') : $kgi['fromDate'] ?> -
                                        <?= $kgi['toDate'] == "" ? Yii::t('app', 'Not set') : $kgi['toDate'] ?>
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
                                        class="pim-icon mr-3" style="margin-top: -2px;"><?= Yii::t('app', 'History') ?>
                                </a>
                                <a href="<?= Yii::$app->homeUrl ?>kgi/view/kgi-history/<?= ModelMaster::encodeParams(['kgiId' => $kgiId, 'openTab' => 3]) ?>"
                                    class="btn <?= $colorFormat == 'disable' ? 'btn-bg-gray-xs' : 'btn-bg-white-xs mr-5' ?> mr-5"
                                    style="margin-top: -3px; <?= $colorFormat == 'disable' ? 'pointer-events: none; opacity: 0.5;' : '' ?>">
                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/comment.svg" alt="Chats"
                                        class="pim-icon mr-3" style="margin-top: -2px;"><?= Yii::t('app', 'Chats') ?>
                                </a>
                                <a href="<?= Yii::$app->homeUrl ?>kgi/view/kgi-history/<?= ModelMaster::encodeParams(['kgiId' => $kgiId, 'openTab' => 4]) ?>"
                                    class="btn <?= $colorFormat == 'disable' ? 'btn-bg-gray-xs' : 'btn-bg-white-xs mr-5' ?> mr-5"
                                    style="margin-top: -3px; <?= $colorFormat == 'disable' ? 'pointer-events: none; opacity: 0.5;' : '' ?>">
                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/chart.svg" alt="Chart"
                                        class="pim-icon mr-3" style="margin-top: -2px;"><?= Yii::t('app', 'Chart') ?>
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
                                        <?= Yii::t('app', 'Assign on') ?>
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
                                                            <? else : ?>
                                                            <img src="<?= Yii::$app->homeUrl . 'image/user.svg' ?>"
                                                                class="pim-pic-gridNew">
                                                            <?php endif; ?>
                                                        </div>
                                                        <div class="col-2 pic-after pt-0">
                                                            <?php if (isset($kgi['kgiEmployee'][1])): ?>
                                                            <img src="<?= Yii::$app->homeUrl . $kgi['kgiEmployee'][1] ?>"
                                                                class="pim-pic-gridNew">
                                                            <? else : ?>
                                                            <img src="<?= Yii::$app->homeUrl . 'image/user.svg' ?>"
                                                                class="pim-pic-gridNew">
                                                            <?php endif; ?>
                                                        </div>
                                                        <div class="col-2 pic-after pt-0">
                                                            <?php if (isset($kgi['kgiEmployee'][2])): ?>
                                                            <img src="<?= Yii::$app->homeUrl . $kgi['kgiEmployee'][2] ?>"
                                                                class="pim-pic-gridNew">
                                                            <? else : ?>
                                                            <img src="<?= Yii::$app->homeUrl . 'image/user.svg' ?>"
                                                                class="pim-pic-gridNew">
                                                            <?php endif; ?>
                                                        </div>
                                                        <div
                                                            class="col-5 number-tagNew  <?= $kgi["countEmployee"] == 0 && $colorFormat != "disable"  ? 'load-yenlow' : 'load-'  . $colorFormat ?> ">
                                                            <?= $kgi["countEmployee"] ?>
                                                        </div>
                                                        <?php } else { ?>
                                                        <div class="col-2 ">
                                                            <div class="
                                                                <?= $role >= 3
                                                                        ? ($kgi["countEmployee"] == 0 && $colorFormat != "disable"
                                                                            ? 'pim-pic-yenlow'
                                                                            : 'pim-pic-'  . $colorFormat)
                                                                        : ($kgi["countEmployee"] == 0  && $colorFormat != "disable"
                                                                            ? 'pim-pic-yenlow'
                                                                            : 'pim-pic-'  . $colorFormat)
                                                                ?>
                                                                ">
                                                                <img
                                                                    src="<?= Yii::$app->homeUrl ?>images/icons/Settings/personblack.svg">

                                                            </div>
                                                        </div>
                                                        <div class="col-2 pic-after pt-0">
                                                            <div class="
                                                                <?= $role >= 3
                                                                        ? ($kgi["countEmployee"] == 0 && $colorFormat != "disable"
                                                                            ? 'pim-pic-yenlow'
                                                                            : 'pim-pic-'  . $colorFormat)
                                                                        : ($kgi["countEmployee"] == 0  && $colorFormat != "disable"
                                                                            ? 'pim-pic-yenlow'
                                                                            : 'pim-pic-'  . $colorFormat)
                                                                ?>
                                                                ">
                                                                <img
                                                                    src="<?= Yii::$app->homeUrl ?>images/icons/Settings/personblack.svg">
                                                            </div>
                                                        </div>
                                                        <div class="col-2 pic-after pt-0">
                                                            <div class="
                                                                <?= $role >= 3
                                                                        ? ($kgi["countEmployee"] == 0 && $colorFormat != "disable"
                                                                            ? 'pim-pic-yenlow'
                                                                            : 'pim-pic-'  . $colorFormat)
                                                                        : ($kgi["countEmployee"] == 0  && $colorFormat != "disable"
                                                                            ? 'pim-pic-yenlow'
                                                                            : 'pim-pic-'  . $colorFormat)
                                                                ?>
                                                                ">
                                                                <img
                                                                    src="<?= Yii::$app->homeUrl ?>images/icons/Settings/personblack.svg">
                                                            </div>
                                                        </div>
                                                        <div class="col-5 number-tagNew
                                                            <?= $role >= 3
                                                                        ? ($kgi["countEmployee"] == 0 && $colorFormat != "disable"
                                                                            ? 'load-yenlow'
                                                                            : 'load-'  . $colorFormat)
                                                                        : ($kgi["countEmployee"] == 0  && $colorFormat != "disable"
                                                                            ? 'load-yenlow'
                                                                            : 'load-'  . $colorFormat)
                                                            ?>
                                                           ">
                                                            <?= $kgi["countEmployee"] ?>
                                                        </div>
                                                        <?php } ?>
                                                    </div>
                                                </div>

                                                <?php if ($role <= 4) { ?>
                                                <div
                                                    class="col-6 <?= $kgi["countEmployee"] == 0 ? ($colorFormat == 'disable' ? 'disable' : 'yenlow') : $colorFormat ?>-assignNew ">

                                                    <span class="pull-left">
                                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/view-<?= $kgi["countEmployee"] == 0 ? ($colorFormat == 'disable' ? 'disable' : 'yenlow') : $colorFormat ?>.svg"
                                                            class="home-icon mr-2">
                                                    </span>

                                                    <a href="<?= ($kgi["countEmployee"] > 0 && $colorFormat != 'disable') ? Yii::$app->homeUrl . 'kgi/view/kgi-history/' . ModelMaster::encodeParams(['kgiId' => $kgiId]) : '#' ?>"
                                                        class="font-<?= $kgi["countEmployee"] == 0 ? ($colorFormat == 'disable' ? 'disable' : 'black') : $colorFormat ?>"
                                                        style="<?= ($kgi["countEmployee"] == 0 || $colorFormat == 'disable') ? 'pointer-events: none; color: black; text-decoration: none; top: 2px;' : 'top: 2px;' ?>">
                                                        <?php if ($kgi["countEmployee"] == 0 && $colorFormat == 'disable') { ?>
                                                        <?= Yii::t('app', 'Not Assign') ?>
                                                        <?php } elseif ($kgi["countEmployee"] == 0) { ?>
                                                        <?= Yii::t('app', 'Not Assign') ?>
                                                        <?php } else { ?>
                                                        <?= Yii::t('app', 'View Assign') ?>
                                                        <?php } ?>
                                                    </a>

                                                </div>
                                                <?php  } else { ?>
                                                <div
                                                    class="col-6 <?= $kgi["countEmployee"] == 0 ? ($colorFormat == 'disable' ? 'disable' : 'yenlow') : $colorFormat ?>-assignNew ">
                                                    <span class="pull-left">
                                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/assign-<?= $kgi["countEmployee"] == 0 ? ($colorFormat == 'disable' ? 'disable' : 'yenlow') : $colorFormat ?>.svg"
                                                            class="home-icon mr-2">
                                                    </span>
                                                    <a href="<?= Yii::$app->homeUrl ?>kgi/assign/assign/<?= ModelMaster::encodeParams(['kgiId' => $kgiId, "companyId" => $kgi["companyId"]]) ?>"
                                                        class="font-<?= $kgi["countEmployee"] == 0 ? ($colorFormat == 'disable' ? 'disable' : 'black') : $colorFormat ?>"
                                                        style="top: 2px;">
                                                        <?php if ($kgi["countEmployee"] == 0 && $colorFormat == 'disable') { ?>
                                                        <?= Yii::t('app', 'Assign Person') ?>
                                                        <?php  } else if ($kgi["countEmployee"] == 0) { ?>
                                                        <?= Yii::t('app', 'Assign Person') ?>
                                                        <?php } else {  ?>
                                                        <?= Yii::t('app', 'Edit Assign') ?>
                                                        <?php } ?>
                                                    </a>
                                                </div>
                                                <?php }  ?>
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
                                                            <?= $kgi["countTeam"] ?>
                                                        </div>
                                                    </div>

                                                </div>
                                                <?php if ($role <= 4) { ?>
                                                <div
                                                    class="col-6 <?= $kgi["countTeam"] == 0 ? ($colorFormat == 'disable' ? 'disable' : 'yenlow') : $colorFormat ?>-assignNew ">

                                                    <span class="pull-left">
                                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/view-<?= $kgi["countTeam"] == 0 ? ($colorFormat == 'disable' ? 'disable' : 'yenlow') : $colorFormat ?>.svg"
                                                            class="home-icon mr-2">
                                                    </span>

                                                    <a href="<?= ($kgi["countTeam"] > 0 || $colorFormat != 'disable') ? Yii::$app->homeUrl . 'kgi/view/kgi-history/' . ModelMaster::encodeParams(['kgiId' => $kgiId]) : '#' ?>"
                                                        class="font-<?= ($kgi["countTeam"] == 0 && $colorFormat == 'disable') ? 'black' : $colorFormat ?>"
                                                        style="top: 2px; <?= ($kgi["countTeam"] == 0 || $colorFormat == 'disable') ? 'pointer-events: none; color: black; text-decoration: none; top: 2px;'  : '' ?>">
                                                        <?php if ($kgi["countTeam"] == 0 && $colorFormat == 'disable') { ?>
                                                        <?= Yii::t('app', 'Not Assign') ?>
                                                        <?php } elseif ($kgi["countTeam"] == 0) { ?>
                                                        <?= Yii::t('app', 'Not Team') ?>
                                                        <?php } else { ?>
                                                        <?= Yii::t('app', 'View Assign') ?>
                                                        <?php } ?>
                                                    </a>

                                                </div>
                                                <?php  } else { ?>
                                                <div
                                                    class="col-6 <?= $kgi["countTeam"] == 0 ? ($colorFormat == 'disable' ? 'disable' : 'yenlow') : $colorFormat ?>-assignNew ">
                                                    <span class="pull-left">
                                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/assign-<?= $kgi["countTeam"] == 0 ? ($colorFormat == 'disable' ? 'disable' : 'yenlow') : $colorFormat ?>.svg"
                                                            class="home-icon mr-2">
                                                    </span>
                                                    <a href="<?= Yii::$app->homeUrl ?>kgi/assign/assign/<?= ModelMaster::encodeParams(['kgiId' => $kgiId, "companyId" => $kgi["companyId"]]) ?>"
                                                        class="font-<?= ($kgi["countTeam"] == 0 && $colorFormat == 'disable') ? 'black' : $colorFormat ?>"
                                                        style="top: 2px; <?= ($kgi["countTeam"] == 0 && $colorFormat == 'disable') ?: '' ?>">
                                                        <?php if ($kgi["countTeam"] == 0 && $colorFormat == 'disable') { ?>
                                                        <?= Yii::t('app', 'Assign Team') ?>
                                                        <?php  } else if ($kgi["countTeam"] == 0) { ?>
                                                        <?= Yii::t('app', 'Assign Team') ?>
                                                        <?php } else {  ?>
                                                        <?= Yii::t('app', 'Edit Assign') ?>
                                                        <?php } ?>
                                                    </a>
                                                </div>
                                                <?php }  ?>
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
                                        <?php
                                                if ($kgi["priority"] != '') {
                                                ?>
                                        <div class="col-12 text-center priority-box">
                                            <div class="col-12"><?= Yii::t('app', 'Priority') ?></div>
                                            <div class="col-12 text-priority"><?= $kgi["priority"] ?></div>
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
                            <div class="col-lg-1 pim-subheader-font border-right-<?= $colorFormat ?> mt-5 pl-10 pr-10">
                                <div class="col-12"><?= Yii::t('app', 'Quant Ratio') ?></div>
                                <div class="col-12 border-bottom-<?= $colorFormat ?> pb-10 pim-duedate">
                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/<?= $kgi["quantRatio"] == 1 ? 'quantity' : 'diamon' ?>.svg"
                                        class="pim-iconKFI" style="margin-top: -1px; margin-left: 3px;">
                                    <?= $kgi["quantRatio"] == 1 ? Yii::t('app', 'Quantity') : Yii::t('app', 'Quality') ?>
                                </div>
                                <div class="col-12 pr-0 pt-10 pl-0"><?= Yii::t('app', 'Update Interval') ?></div>
                                <div class="col-12  pim-duedate">
                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/monthly.svg"
                                        class="pim-iconKFI" style="margin-top: -1px; margin-left: 3px;">
                                    <?= Yii::t('app', $kgi["unit"]) ?>
                                </div>
                            </div>
                            <div class="col-lg-3 pim-subheader-font border-right-<?= $colorFormat ?> mt-5 pr-15 pl-15">
                                <div class="row">
                                    <div class="col-5 text-start">
                                        <div class="col-12">
                                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/Target.svg"
                                                class="pim-iconKFI" style="margin-top: 1px; margin-right: 3px;">
                                            <?= Yii::t('app', 'Target') ?>
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
                                        <div class="col-12"><?= Yii::t('app', 'Result') ?>
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
                                        <div class="col-12 text-end"><?= Yii::t('app', 'Last Updated on') ?></div>
                                        <div class="col-12 text-end pim-duedate">
                                            <?= $kgi['nextCheck'] == "" ? 'Not set' : $kgi['nextCheck'] ?></div>
                                    </div>
                                    <div class="col-4 text-center mt-10">

                                        <?php
                                                if ($colorFormat == 'disable' && $role >= 5) {
                                                ?>
                                        <a href="<?= Yii::$app->homeUrl . 'kgi/management/prepare-update/' . ModelMaster::encodeParams(['kgiId' => $kgiId, 'kgiHistoryId' => 0]) ?>"
                                            style="display: flex; justify-content: center; align-items: center; padding: 7px 9px; height: 30px; gap: 6px; flex-shrink: 0;"
                                            class="pim-btn-setup">
                                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/setupwhite.svg"
                                                class="mb-2" style="width: 12px; height: 12px;">
                                            <?= Yii::t('app', 'Setup') ?>
                                        </a>
                                        <?php
                                                } else if ($colorFormat == "complete") {
                                                    // echo Yii::t('app', "Update");
                                        
                                                } else if ($role >= 5 ) {
                                        ?>
                                        <a href="<?= Yii::$app->homeUrl . 'kgi/management/prepare-update/' . ModelMaster::encodeParams(['kgiId' => $kgiId, 'kgiHistoryId' => 0]) ?>"
                                            style="display: flex; justify-content: center; align-items: center; padding: 7px 9px; height: 30px; gap: 6px; flex-shrink: 0;"
                                            class="pim-btn-<?= $colorFormat ?>">
                                            <!-- data-bs-toggle="modal" data-bs-target="#update-kgi-modal"> -->
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
                                    <div class="col-4 pl-0 pr-5 mt-10">
                                        <div class="col-12 text-start font-<?= $colorFormat ?>">
                                            <?= Yii::t('app', 'Next Update Date') ?></div>
                                        <div class="col-12 text-start pim-duedate">
                                            <?= $kgi['nextCheck'] == "" ? 'Not set' : $kgi['nextCheck'] ?></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-5 pim-subheader-font mt-5">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-12 pr-3 pl-20">
                                        <div class="col-12 head-letter head-<?= $colorFormat ?>">
                                            <?= Yii::t('app', 'Issue') ?></div>
                                        <div class="col-12 body-letter body-letter-<?= $colorFormat ?>">
                                            <?= $kgi["issue"] ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12 pr-20">
                                        <div class="col-12 head-letter head-<?= $colorFormat ?>">
                                            <?= Yii::t('app', 'Solution') ?></div>
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