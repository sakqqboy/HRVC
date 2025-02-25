<?php

use common\models\ModelMaster;
use frontend\models\hrvc\KpiBranch;
use frontend\models\hrvc\Unit;

$this->title = 'KGI KPI';
?>
<div class="alert col-12" style=" height: 551px;">
    <div class="alert-box text-center">
        <?= Yii::t('app', 'S A V E D ! ! !') ?>
    </div>
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
                <th style="border-top-right-radius: 4px;border-bottom-right-radius: 4px;">
                </th>
            </tr>
        </thead>
        <tbody>
            <?php
			if (isset($kgis) && count($kgis) > 0) {
				$i = 1;
				foreach ($kgis as $kgiId => $kgi):
			?>
            <tr height="10">
            </tr>
            <tr id="kgi-<?= $kgiId ?>" class="text-center pim-table-text related-table-background">
                <td class="text-start font-b pt-10"
                    style="border-top-left-radius: 3px;border-bottom-left-radius: 3px;letter-spacing:0.5px;">
                    <?= $i ?>.
                    <?= $kgi["kgiName"] ?>
                </td>
                <td><?= Yii::t('app', $kgi["month"]) ?></td>
                <td><?= Yii::t('app', $kgi["unit"]) ?></td>
                <td class="text-end"><?= $kgi["targetAmount"] ?></td>
                <td><?= $kgi["code"] ?></td>
                <td><?= $kgi["ratio"] ?></td>
                <td>
                    <div class="col-12 info-assign  pt-5 pb-2" style="margin-top: -3px;">
                        <div class="row">
                            <div class="col-4 text-end">
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/team-dark-blue.png"
                                    class="first-layer-icon ml-3" style="margin-top: -4px;">
                            </div>
                            <div class="col-3 number-tag load-info pr-3 pl-3 pt-1">
                                <?= $kgi["countTeam"] ?>
                            </div>

                            <div class="col-3  text-center pl-0 pr-0">
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
</div>