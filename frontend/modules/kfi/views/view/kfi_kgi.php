<?php

use common\models\ModelMaster;
use frontend\models\hrvc\KpiBranch;
use frontend\models\hrvc\Unit;

$this->title = 'KGI KPI';
?>

<?php // $this->render('modal_kpi_view') 
?>
<?php // $this->render('modal_team_history') 
?>
<?php // $this->render('modal_employee_history') 
?>
<div class="col-12">
    <div class="alert-box text-center">
        <?= Yii::t('app', 'S A V E D ! ! !') ?>
    </div>
    <div class="col-12" id="kgi">
        <?php
        if (isset($kfiHasKgi) && count($kfiHasKgi) > 0) {
        ?>
            <table class="table table-borderless">
                <thead>
                    <tr class="pim-table-header text-center">
                        <th class="text-start" style="border-top-left-radius: 4px;border-bottom-left-radius: 4px;"><?= Yii::t('app', 'RELATED KEY PERFORMANCE INDICATOR') ?></th>
                        <th><?= Yii::t('app', 'MONTH') ?></th>
                        <th><?= Yii::t('app', 'UNIT') ?></th>
                        <th><?= Yii::t('app', 'TARGET') ?></th>
                        <th><?= Yii::t('app', 'CODE') ?></th>
                        <th><?= Yii::t('app', 'RATIO') ?></th>
                        <th style="width: 10%;"><?= Yii::t('app', 'TEAM') ?></th>
                        <th style="border-top-right-radius: 4px;border-bottom-right-radius: 4px;" class="text-end">
                            <a class="btn-blue-sm font-size-12 text-center no-underline" id="editRelateKgi"
                                style="padding-left: 10px;padding-right:10px;display:<?= count($kfiHasKgi) == 0 ? 'none' : '' ?>"
                                href="javascript:showEditRelateKgi(1,<?= $kfiId ?>)">
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/edit.svg" alt=""
                                    class="pim-icon mr-3" style="margin-top: -1px;"><?= Yii::t('app', 'Add') ?>/<?= Yii::t('app', 'Remove') ?>
                            </a>
                            <a class="btn-blue-sm font-size-12 text-center no-underline  mr-5 pl-10 pr-10"
                                id="saveRelateKgi" style="display:none;"
                                href="javascript:showEditRelateKgi(2,<?= $kfiId ?>)">
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/save.svg" alt=""
                                    class="pim-icon mr-3" style="margin-top: -1px;"> <?= Yii::t('app', 'Save55') ?>
                            </a>
                            <a class="btn-red-sm font-size-12 text-center no-underline pl-10 pr-10" id="cancelRelateKgi"
                                style="display:none;" href="javascript:showEditRelateKgi(0,<?= $kfiId ?>)"><?= Yii::t('app', 'Cancel') ?></a>
                        </th>
                    </tr>
                </thead>
                <tbody id="kfiHasKgi">
                    <?php
                    $i = 1;
                    foreach ($kfiHasKgi as $kgiId => $kgi):
                    ?>
                        <tr height="10">
                        </tr>
                        <tr id="kgi-<?= $kgiId ?>" class="text-center pim-table-text related-table-background">
                            <td class="text-start font-b pt-10"
                                style="border-top-left-radius: 3px;border-bottom-left-radius: 3px;letter-spacing:0.5px;">
                                <input type="checkbox" id="check-relate-kgi" class="checkbox-sm mr-5" style="display:none;"
                                    value="<?= $kgiId ?>" name="kgi" <?= isset($ghp[$kgiId]) ? 'checked' : '' ?>>
                                <?= $i ?>.
                                <?= $kgi["kgiName"] ?>
                            </td>
                            <td><?= Yii::t('app', $kgi["month"]) ?></td>
                            <td><?= Yii::t('app', $kgi["unit"]) ?></td>
                            <td class="text-end"><?= $kgi["targetAmount"] ?></td>
                            <td><?= $kgi["code"] ?></td>
                            <td><?= $kgi["ratio"] ?></td>
                            <td>
                                <div class="col-12 info-assign" style="margin-top: -3px;">
                                    <div class="row">
                                        <div class="col-5 text-end" style="align-content:center;">
                                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/team-dark-blue.png"
                                                class="first-layer-icon ml-3" style="margin-top: -4px;">
                                        </div>
                                        <div class="col-3 number-tag load-info pr-3 pl-3 pt-1">
                                            <?= $kgi["countTeam"] ?>
                                        </div>

                                        <div class="col-4  text-center pl-0 pr-0" style="align-content:center;">
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
                                <a href="<?= Yii::$app->homeUrl ?>kgi/view/kgi-history/<?= ModelMaster::encodeParams(['kgiId' => $kgiId]) ?>" target="_blank" class="no-underline ">
                                    <div class="col-12 pt-4 pb-4" style="background-color: #EDF5FF;color:#003276;cursor:pointer;">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/detail.png" class="icon-table">
                                        <?= Yii::t('app', 'Detail') ?>
                                    </div>
                                </a>
                            </td>
                        </tr>
                        <tr id="kgi-team-<?= $kgiId ?>" style="display:none;">

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
            <div class="col-12 on-data-box text-center">
                <div class="">
                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/no-data.svg" class="no-data-img">
                </div>
                <div class="font-size-16 font-b mt-5">
                    <?= Yii::t('app', 'Looks like there are no KGIs linked to this component yet') ?>.
                </div>
                <div class="mt-10 text-secondary">
                    <?= Yii::t('app', 'Click “Add KGI” to associate relevant metrics and track performance effectively') ?>.
                </div>
                <div class="mt-10">
                    <?php if ($role >= 5) { ?>
                        <a href="javascript:showEditRelateKgi(1,<?= $kfiId ?>)" class="btn-blue font-size-14 no-underline">
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