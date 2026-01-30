<?php

use common\models\ModelMaster;
use frontend\models\hrvc\KpiBranch;
use frontend\models\hrvc\Unit;

$this->title = Yii::t('app', 'KGI KPI');
?>

<div class="col-12" style=" height: 400px;overflow-y: auto;">
    <div class="alert-box text-center">
        <?= Yii::t('app', 'S A V E D ! ! !') ?>
    </div>
    <div class="col-12" id="kgi">
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
                                <a class="btn-blue-sm font-size-12 text-center no-underline" id="editRelateKgi"
                                    style="padding-left: 10px;padding-right:10px;display:<?= count($kgiHasKpi) == 0 ? 'none' : '' ?>;line-height:14px;"
                                    href="javascript:showEditRelateKgi(1,<?= $kpiId ?>)">
                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/edit.svg" alt=""
                                        class="create-btn-icon mr-3" style="margin-top: -3px;width:16px;height:16px;"><?= Yii::t('app', 'Add') ?>/<?= Yii::t('app', 'Remove') ?>
                                </a>
                            <?php } ?>
                            <a class="btn-blue-sm font-size-12 text-center no-underline  mr-5 pl-10 pr-10" id="saveRelateKgi" style="display:none;"
                                href="javascript:showEditRelateKgi(2,<?= $kpiId ?>)">
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/save.svg" alt=""
                                    class="pim-icon mr-3" style="margin-top: -1px;"> <?= Yii::t('app', 'Save') ?>
                            </a>
                            <a class="btn-red-sm font-size-12 text-center no-underlinepl-10 pr-10" id="cancelRelateKgi" style="display:none;"
                                href="javascript:showEditRelateKgi(0,<?= $kpiId ?>)"><?= Yii::t('app', 'Cancel') ?></a>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (isset($kgis["data"]) && count($kgis["data"]) > 0) {
                        $i = 1;
                        foreach ($kgis["data"] as $kgiId => $kgi):
                    ?>
                            <tr height="10">
                            </tr>
                            <tr id="kgi-<?= $kgiId ?>" class="text-center pim-table-text related-table-background">
                                <td class="text-start font-b pt-10"
                                    style="border-top-left-radius: 3px;border-bottom-left-radius: 3px;letter-spacing:0.5px;">
                                    <div class="text-truncate" style="max-width:300px;" title="<?= $kgi["kgiName"] ?>">
                                        <?= $i ?>.
                                        <?= $kgi["kgiName"] ?>
                                    </div>
                                </td>
                                <td><?= Yii::t('app', $kgi["month"]) ?></td>
                                <td><?= Yii::t('app', $kgi["unit"]) ?></td>
                                <td class="text-end"><?= $kgi["targetAmount"] ?></td>
                                <td><?= $kgi["code"] ?></td>
                                <td><?= $kgi["ratio"] ?></td>
                                <td>
                                    <div class="col-12 info-assign" style="margin-top: -3px;">
                                        <div class="row" style="--bs-gutter-x:0px;">
                                            <div class="col-4 pr-0 pl-0" style="align-content:center;">
                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/team-dark-blue.png"
                                                    class="first-layer-icon ml-3" style="margin-top: -4px;">
                                            </div>
                                            <div class="col-3 number-tag load-info pr-3 pl-3 pt-1">
                                                <?= $kgi["countTeam"] ?>
                                            </div>

                                            <div class="col-4  text-end pl-0 pr-5" style="align-content:center;">
                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/down-darkblue.png"
                                                    style="width:10px;height:7px;margin-top:-4px;cursor:pointer;"
                                                    onclick="javascript:showTeamKgi(<?= $kgiId ?>,1)" id="show-<?= $kgiId ?>">
                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/up-darkblue.png"
                                                    style="display: none;width:10px;height:7px;margin-top:-4px;cursor:pointer;"
                                                    onclick="javascript:showTeamKgi(<?= $kgiId ?>,0)" id="hide-<?= $kgiId ?>">
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td style="border-top-right-radius: 3px;border-bottom-right-radius: 3px;">
                                    <div class="col-12 pt-3" style="background-color: #EDF5FF;color:#003276;cursor:pointer;">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/detail.png" class="icon-table">
                                        <?= Yii::t('app', 'Detail') ?>
                                    </div>
                                </td>
                            </tr>
                            <tr id="kgi-team-<?= $kgiId ?>" style="display:none;">

                            </tr>
                        <?php
                            $i++;
                        endforeach;
                    } else {
                        ?>
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
                    <?= Yii::t('app', 'Click “Add KGI” to associate relevant metrics and track performance effectively') ?>.
                </div>
                <div class="col-12 mt-10">
                    <?php if ($role >= 5) { ?>
                        <a href="javascript:showEditRelateKgi(1,<?= $kpiId ?>)" class="btn-blue font-size-14 no-underline">
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/plus-circle.svg" class="pim-icon mr-3"
                                style="margin-top: -1px;">
                            <?= Yii::t('app', 'Add KGI') ?>
                        </a>
                    <?php } ?>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
</div>