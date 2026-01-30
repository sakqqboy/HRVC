<?php

use common\models\ModelMaster;
use frontend\models\hrvc\KpiBranch;
use frontend\models\hrvc\Unit;

$this->title = 'KGI KPI';
?>
<div class="col-12" style="height:400px;overflow-y: auto;">
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
                                <div class="text-truncate" style="max-width:300px;" title="<?= $kpi["kpiName"] ?>">
                                    <?= $i ?>.
                                    <?= $kpi["kpiName"] ?>
                                </div>
                            </td>
                            <td><?= Yii::t('app', $kpi["month"]) ?></td>
                            <td><?= Yii::t('app', $kpi["unit"]) ?></td>
                            <td class="text-end"><?= $kpi["targetAmount"] ?></td>
                            <td><?= $kpi["code"] ?></td>
                            <td><?= $kpi["ratio"] ?></td>
                            <td>
                                <div class="col-12 info-assign" style="margin-top: -3px;">
                                    <div class="row" style="--bs-gutter-x:0px;">
                                        <div class="col-4 pr-0 pl-0" style="align-content:center;">
                                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/team-dark-blue.png"
                                                class="first-layer-icon ml-3" style="margin-top: -4px;">
                                        </div>
                                        <div class="col-3 number-tag load-info pr-3 pl-3 pt-1">
                                            <?= $kpi["countTeam"] ?>
                                        </div>
                                        <div class="col-4  text-end pl-0 pr-5" style="align-content:center;">
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