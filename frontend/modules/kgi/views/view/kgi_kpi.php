<?php

use common\models\ModelMaster;
use frontend\models\hrvc\KpiBranch;
use frontend\models\hrvc\Unit;

$this->title = 'KGI KPI';
?>
<div class="col-12 mt-90" style="display:none;">
    <div class="row">
        <div class="col-9">
            <i class="fa fa-share-alt font-size-20 mr-3" aria-hidden="true"></i>
            <strong class="font-size-20"><?= Yii::t('app', 'Related KPI for KGI') ?></strong>
        </div>
        <div class="col-3 text-end">
            <a href="<?= Yii::$app->homeUrl ?>kgi/management/assign-kgi" class="font-size-14 btn btn-outline-secondary">
                <i class="fa fa-chevron-left mr-5" aria-hidden="true"></i>
                <?= Yii::t('app', 'KGI Assign Management') ?>
            </a>
        </div>
        <div class="col-12 text-end mt-15">
            <a href="<?= Yii::$app->homeUrl ?>kgi/management/assign-kpi/<?= ModelMaster::encodeParams(['kgiId' => $kgiId]) ?>"
                class="no-underline-black">
                <i class="fa fa-cog font-size-26 font-b mr-5" aria-hidden="true"></i><?= Yii::t('app', 'Setting') ?>
            </a>
        </div>
    </div>
    <div class="col-12 mt-20 pt-10 pl-10 pb-10" style="border-radius: 10px;border-style:dotted;border-color:grey;">
        <strong><?= Yii::t('app', 'KGI') ?> : <?= $kgiDetail["kgiName"] ?></strong>
        <div class="row mt-20">
            <div class="col-lg-2 col-md-6 col-2 text-center">
                <div class="col-12 pt-25 pb-25 font-b font-size-20">
                    <?= Yii::t('app', $kgiDetail["monthName"]) ?>
                </div>
                <div class="col-12  text-center">
                    <p class="font-size-10 mb-20"><?= Yii::t('app', 'Priority') ?></p>
                    <div class="circle-Priority" style="margin-left: 70px !important;">
                        <?= $kgiDetail["priority"] ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-3">
                <div class="col-12 Quant-ratio-Backdrop3">
                    <?= Yii::t('app', 'Quant Ratio') ?>
                </div>
                <div class="col-12 diamond-con-Backdrop3 mt-10">
                    <i class="fa fa-diamond" aria-hidden="true"></i>
                    <span
                        id="quanRatioHistory"><?= $kgiDetail["quantRatio"] == 1 ? Yii::t('app', "Quantity") : Yii::t('app', "Quality") ?></span>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-3 text-center">
                <div class="col-12 bullseye-con-Backdrop3">
                    <i class="fa fa-bullseye" aria-hidden="true"></i> <?= Yii::t('app', 'Target') ?>
                </div>
                <div class="col-12 million-number-Backdrop3 mt-10" id="targetHistory">
                    <?= $kgiDetail["targetAmount"] ?>
                </div>
            </div>
            <div class="col-lg-1 col-md-6 col-3 text-center">
                <div class="col-12 padding-mark-Backdrop3 mt-25 " id="codeHistory">
                    <?= $kgiDetail["code"] ?>
                </div>
            </div>
            <div class="col-lg-3 cl-md-6 col-3 text-center">
                <div class="col-12 trophy-con-Backdrop3">
                    <i class="fa fa-trophy" aria-hidden="true"></i> <?= Yii::t('app', 'Result') ?>
                </div>
                <div class="col-12 million-number-Backdrop3 mt-10 " id="resultHistory">
                    <?= $kgiDetail["result"] ?>
                </div>
            </div>
            <div class="row" style="margin-top: -40px;">
                <div class="col-lg-2 col-md-6 col-5"></div>
                <div class="col-lg-4 col-md-6 col-6">
                    <div class="col-12 padding-update-Backdrop3">
                        <?= Yii::t('app', 'Update Interval') ?>
                    </div>
                    <div class="col-12 update-mouth-Backdrop3 mt-10" id="unitHistory">
                        <?= Yii::t('app', $kgiDetail["unitText"]) ?>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-6" style="margin-top:-20px;">
                    <div class="col-12 pt-20">
                        <div class="progress">
                            <div class="progress-bar" id="progressHistory"
                                style="background: rgb(47, 128, 237); margin-left: -50px; width:<?= (float)$kgiDetail["ratio"] > 100 ? '100' : $kgiDetail["ratio"] ?>%;">
                            </div>
                            <span class="badge rounded-pill  pro-load-Backdrop3"
                                id="decimalHistory"><?= $kgiDetail["ratio"] ?>%</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="col-12 mt-20">
        <u><b><?= Yii::t('app', 'Current related KPI') ?> (<?= count($kgiHasKpi) ?>)</b></u>
    </div>
    <div class="col-12 mt-20">

        <table class="table table-responsive-lg">
            <thead>
                <th><?= Yii::t('app', 'KPI Name') ?></th>
                <th><?= Yii::t('app', 'Target') ?></th>
                <th><?= Yii::t('app', 'Month') ?></th>
                <th><?= Yii::t('app', 'Unit') ?></th>
                <th><?= Yii::t('app', 'Branch') ?></th>
            </thead>
            <tbody>
                <?php
                if (isset($kgiHasKpi) && count($kgiHasKpi) > 0) {
                    $a = 1;
                    foreach ($kgiHasKpi as $kpi) : ?>
                        <tr>
                            <td>
                                <?= $a ?>.
                                <span class="font-b" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#kpi-view"
                                    onclick="javascript:kpiHistory(<?= $kpi['kpiId'] ?>)">
                                    <?= $kpi["kpiName"] ?>
                                </span>
                            </td>
                            <td><?php // number_format($kpi["targetAmount"], 2) 
                                ?></td>
                            <td><?= ModelMaster::shotMonthText($kpi["month"]) ?></td>
                            <td><?= Unit::unitName($kpi["unitId"]) ?></td>
                            <td>
                                <div class="col-12" style="line-height: 30px;">
                                    <?php
                                    $kpiBranch = KpiBranch::kpiBranch($kpi["kpiId"]);
                                    if (isset($kpiBranch) && count($kpiBranch) > 0) {
                                        $i = 1;
                                        foreach ($kpiBranch as $branch) :
                                            echo $i . '. ' . $branch["branchName"];
                                            if ($i < (count($kpiBranch))) {
                                                echo '<br>';
                                            }
                                            $i++;
                                        endforeach;
                                    }
                                    ?>
                                </div>
                            </td>
                        </tr>

                    <?php
                        $a++;
                    endforeach;
                } else { ?>
                    <tr style="line-height: 60px;">
                        <td class="text-center font-size-16" colspan="8">
                            <?= Yii::t('app', 'There are no related KPI for this KGI') ?>.
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
<div class="col-12 alert" style="height:400px;overflow-y: auto;">
    <div class="alert-box text-center">
        <?= Yii::t('app', 'S A V E D ! ! !') ?>
    </div>
    <div class="col-12" id="kpi">
        <?php
        if (isset($kgiHasKpi) && count($kgiHasKpi) > 0) {
            $i = 1;
        ?>
            <table class="table table-borderless">
                <thead>
                    <tr class="pim-table-header text-center">
                        <th class="text-start" style="border-top-left-radius: 4px;border-bottom-left-radius: 4px;">
                            <?= Yii::t('app', 'RELATED KEY PERFORMANCE INDICATOR') ?></th>
                        <th><?= Yii::t('app', 'MONTH') ?></th>
                        <th><?= Yii::t('app', 'UNIT') ?></th>
                        <th><?= Yii::t('app', 'TARGET') ?></th>
                        <th><?= Yii::t('app', 'CODE') ?></th>
                        <th><?= Yii::t('app', 'RATIO') ?></th>
                        <th style="width: 10%;"><?= Yii::t('app', 'TEAM') ?></th>
                        <th style="border-top-right-radius: 4px;border-bottom-right-radius: 4px;" class="text-end">
                            <?php if ($role >= 5) { ?>
                                <a class="btn-blue-sm font-size-12 text-center no-underline" id="editRelateKpi"
                                    style="padding-left: 10px;padding-right:10px;display:<?= count($kgiHasKpi) == 0 ? 'none' : '' ?>;line-height:14px;"
                                    href="javascript:showEditRelateKpi(1,<?= $kgiId ?>)">
                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/edit.svg" alt=""
                                        class="create-btn-icon mr-3" style="margin-top: -3px;width:16px;height:16px;"><?= Yii::t('app', 'Add') ?>/<?= Yii::t('app', 'Remove') ?>
                                </a>
                            <?php } ?>
                            <a class="btn-blue-sm font-size-12 text-center no-underline  mr-5 pl-10 pr-10" id="saveRelateKpi" style="display:none;"
                                href="javascript:showEditRelateKpi(2,<?= $kgiId ?>)">
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/save.svg" alt=""
                                    class="pim-icon mr-3" style="margin-top: -1px;"> <?= Yii::t('app', 'Save') ?>
                            </a>
                            <a class="btn-red-sm font-size-12 text-center no-underlinepl-10 pr-10" id="cancelRelateKpi" style="display:none;"
                                href="javascript:showEditRelateKpi(0,<?= $kgiId ?>)"><?= Yii::t('app', 'Cancel') ?></a>
                        </th>
                    </tr>
                </thead>
                <tbody id="kgiHasKpi">
                    <?php
                    foreach ($kgiHasKpi as $kpiId => $kpi):
                    ?>
                        <tr height="10">
                        </tr>
                        <tr id="kpi-<?= $kpiId ?>" class="text-center pim-table-text related-table-background">
                            <td class="text-start font-b pt-10 text-primary"
                                style="border-top-left-radius: 3px;border-bottom-left-radius: 3px;letter-spacing:0.5px;">
                                <?= $i ?>.
                                <?= $kpi["kpiName"] ?>
                            </td>
                            <td><?= $kpi["month"] ?></td>
                            <td><?= Yii::t('app', $kpi["unit"]) ?></td>
                            <td class="text-end"><?= $kpi["targetAmount"] ?></td>
                            <td><?= $kpi["code"] ?></td>
                            <td><?= $kpi["ratio"] ?></td>
                            <td>
                                <div class="col-12 info-assign" style="margin-top: -3px;">
                                    <div class="row">
                                        <div class="col-5 text-end" style="align-content:center;">
                                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/team-dark-blue.png"
                                                class="first-layer-icon ml-3">
                                        </div>
                                        <div class="col-3 number-tag load-info pr-3 pl-3 pt-1">
                                            <?= $kpi["countTeam"] ?>
                                        </div>

                                        <div class="col-4  text-center pl-0 pr-0" style="align-content:center;">
                                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/down-darkblue.png"
                                                style="width:10px;height:7px;cursor:pointer;"
                                                onclick="javascript:showTeamKpi(<?= $kpiId ?>,1)" id="show-<?= $kpiId ?>">
                                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/up-darkblue.png"
                                                style="display: none;width:10px;height:7px;cursor:pointer;"
                                                onclick="javascript:showTeamKpi(<?= $kpiId ?>,0)" id="hide-<?= $kpiId ?>">
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td style="border-top-right-radius: 3px;border-bottom-right-radius: 3px;">
                                <a href="<?= Yii::$app->homeUrl ?>kpi/view/kpi-history/<?= ModelMaster::encodeParams(['kpiId' => $kpiId]) ?>" target="_blank" class="no-underline ">
                                    <div class="col-12 pt-4 pb-4" style="background-color: #EDF5FF;color:#003276;cursor:pointer;">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/detail.png" class="icon-table">
                                        <?= Yii::t('app', 'Detail') ?>
                                    </div>
                                </a>
                            </td>
                        </tr>
                        <tr id="kpi-team-<?= $kpiId ?>" style="display:none;">

                        </tr>
                    <?php
                        $i++;
                    endforeach;

                    ?>
                </tbody>

            </table>
        <?php
        } else {
        ?>
            <div class="col-12 on-data-box mt-10 text-center">
                <div class="col-12">
                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/no-data.svg" class="no-data-img">
                </div>
                <div class="col-12 font-size-16 font-b mt-5">
                    <?= Yii::t('app', 'Looks like there are no KPIs linked to this component yet') ?>.
                </div>
                <div class="col-12 mt-10 text-secondary">
                    <?= Yii::t('app', 'Click “Add KPI” to associate relevant metrics and track performance effectively') ?>.
                </div>
                <div class="col-12 mt-10">
                    <?php if ($role >= 5) { ?>
                        <a href="javascript:showEditRelateKpi(1,<?= $kgiId ?>)" class="btn-blue font-size-14 no-underline">
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/plus-circle.svg" class="pim-icon mr-3"
                                style="margin-top: -1px;">
                            <?= Yii::t('app', 'Add KPI') ?>
                        </a>
                    <?php } ?>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
</div>