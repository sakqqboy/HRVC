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
            <strong class="font-size-20"><?= Yii::t('app', 'Related KGI for KPI ') ?></strong>
        </div>
        <div class="col-3 text-end">
            <a href="<?= Yii::$app->homeUrl ?>kgi/management/assign-kgi" class="font-size-14 btn btn-outline-secondary">
                <i class="fa fa-chevron-left mr-5" aria-hidden="true"></i>
                <?= Yii::t('app', 'KGI Assign Management') ?>
            </a>
        </div>
        <div class="col-12 text-end mt-15">
            <a href="<?= Yii::$app->homeUrl ?>kgi/management/assign-kpi/<?= ModelMaster::encodeParams(['kpiId' => $kpiId]) ?>"
                class="no-underline-black">
                <i class="fa fa-cog font-size-26 font-b mr-5" aria-hidden="true"></i><?= Yii::t('app', 'Setting') ?>
            </a>
        </div>
    </div>
    <div class="col-12 mt-20 pt-10 pl-10 pb-10" style="border-radius: 10px;border-style:dotted;border-color:grey;">
        <strong><?= Yii::t('app', 'KGI') ?> : <?= $kpiDetail["kpiName"] ?></strong>
        <div class="row mt-20">
            <div class="col-lg-2 col-md-6 col-2 text-center">
                <div class="col-12 pt-25 pb-25 font-b font-size-20">
                    <?= Yii::t('app', $kpiDetail["monthName"]) ?>
                </div>
                <div class="col-12  text-center">
                    <p class="font-size-10 mb-20"><?= Yii::t('app', 'Priority') ?></p>
                    <div class="circle-Priority" style="margin-left: 70px !important;">
                        <?= $kpiDetail["priority"] ?>
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
                        id="quanRatioHistory"><?= $kpiDetail["quantRatio"] == 1 ? Yii::t('app', "Quantity") : Yii::t('app', "Quality") ?></span>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-3 text-center">
                <div class="col-12 bullseye-con-Backdrop3">
                    <i class="fa fa-bullseye" aria-hidden="true"></i> <?= Yii::t('app', 'Target') ?>
                </div>
                <div class="col-12 million-number-Backdrop3 mt-10" id="targetHistory">
                    <?= $kpiDetail["targetAmount"] ?>
                </div>
            </div>
            <div class="col-lg-1 col-md-6 col-3 text-center">
                <div class="col-12 padding-mark-Backdrop3 mt-25 " id="codeHistory">
                    <?= $kpiDetail["code"] ?>
                </div>
            </div>
            <div class="col-lg-3 cl-md-6 col-3 text-center">
                <div class="col-12 trophy-con-Backdrop3">
                    <i class="fa fa-trophy" aria-hidden="true"></i> <?= Yii::t('app', 'Result') ?>
                </div>
                <div class="col-12 million-number-Backdrop3 mt-10 " id="resultHistory">
                    <?= $kpiDetail["result"] ?>
                </div>
            </div>
            <div class="row" style="margin-top: -40px;">
                <div class="col-lg-2 col-md-6 col-5"></div>
                <div class="col-lg-4 col-md-6 col-6">
                    <div class="col-12 padding-update-Backdrop3">
                        <?= Yii::t('app', 'Update Interval') ?>
                    </div>
                    <div class="col-12 update-mouth-Backdrop3 mt-10" id="unitHistory">
                        <?= Yii::t('app', $kpiDetail["unitText"]) ?>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-6" style="margin-top:-20px;">
                    <div class="col-12 pt-20">
                        <div class="progress">
                            <div class="progress-bar" id="progressHistory"
                                style="background: rgb(47, 128, 237); margin-left: -50px; width:<?= (float)$kpiDetail["ratio"] > 100 ? '100' : $kpiDetail["ratio"] ?>%;">
                            </div>
                            <span class="badge rounded-pill  pro-load-Backdrop3"
                                id="decimalHistory"><?= $kpiDetail["ratio"] ?>%</span>
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
<div class="alert col-12" style=" height: 551px;">
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