<?php

use common\models\ModelMaster;
use yii\bootstrap5\ActiveForm;

$this->title = 'Company KGI History';
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
        <div class="alert  mt-10 pim-body bg-white">
            <div class="col-12">
                <div class="row">
                    <div class="col-6 font-size-12 pim-name pr-0 pl-5 text-start">
                        <a href="<?= Yii::$app->homeUrl ?>kgi/management/grid" class="mr-5 font-size-12">
                            <i class="fa fa-caret-left mr-3" aria-hidden="true"></i>
                            Back
                        </a>
                        <span class="">
                            <?= $kgiDetail["kgiName"] ?>
                        </span>
                    </div>
                    <div class="col-6 text-end">

                    </div>
                </div>

            </div>
            <div class="row">
                <?php
                if (isset($kgis) && count($kgis) > 0) {
                    $i = 0;
                    foreach ($kgis as $year => $kgiMonth) :
                        foreach ($kgiMonth as $month => $kgi):
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
                <div class="col-lg-4 col-md-6 col-12 ">
                    <div class="col-12 mt-10 mb-5 pim-big-box pim-<?= $colorFormat ?> pt-3 pl-15">
                        <div class="row">
                            <div class="col-5 pim-name"><?= $kgi["month"] ?> <?= $kgi["year"] ?></div>
                            <div class="col-7 text-end">

                                <!-- <a class="btn btn-bg-white-xs" data-bs-toggle="modal" data-bs-target="#staticBackdrop3"
                                    onclick="javascript:kgiHistory(<?= $kgi['kgiHistoryId'] ?>)">
                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Comment.png" alt="History"
                                        class="home-icon">
                                </a>
                                <a class="btn btn-bg-white-xs" data-bs-toggle="modal" data-bs-target="#staticBackdrop3"
                                    onclick="javascript:kgiHistory(<?= $kgi['kgiHistoryId'] ?>)">
                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Charts.png" alt="History"
                                        class="home-icon" style="margin-top: -3px;">
                                </a> -->
                                <!-- <a href="<?= Yii::$app->homeUrl ?>kgi/view/index/<?= ModelMaster::encodeParams(['kgiId' => $kgiId]) ?>"
                                    class="btn btn-bg-white-xs mr-5" style="margin-top: -3px;">
                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/eye.png" alt="History"
                                        class="pim-icon " style="margin-top: -2px;">
                                </a> -->
                                <a href="<?= Yii::$app->homeUrl ?>kgi/view/kgi-history/<?= ModelMaster::encodeParams(['kgiId' => $kgiId, 'openTab' => 1]) ?>"
                                    class="btn <?= $colorFormat == 'disable' ? 'btn-bg-gray-xs' : 'btn-bg-white-xs mr-5' ?> mr-5"
                                    style="margin-top: -3px; <?= $colorFormat == 'disable' ? 'pointer-events: none; opacity: 0.5;' : '' ?>">
                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/eye.png" alt="Chats"
                                        class="pim-icon " style="margin-top: -2px;">
                                </a>
                                <a href="<?= Yii::$app->homeUrl ?>kgi/view/kgi-history/<?= ModelMaster::encodeParams(['kgiId' => $kgiId, 'openTab' => 3]) ?>"
                                    class="btn <?= $colorFormat == 'disable' ? 'btn-bg-gray-xs' : 'btn-bg-white-xs mr-5' ?> mr-5"
                                    style="margin-top: -3px; <?= $colorFormat == 'disable' ? 'pointer-events: none; opacity: 0.5;' : '' ?>">
                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/comment.png" alt="Chats"
                                        class="pim-icon " style="margin-top: -2px;">
                                </a>
                                <a href="<?= Yii::$app->homeUrl ?>kgi/view/kgi-history/<?= ModelMaster::encodeParams(['kgiId' => $kgiId, 'openTab' => 4]) ?>"
                                    class="btn <?= $colorFormat == 'disable' ? 'btn-bg-gray-xs' : 'btn-bg-white-xs mr-5' ?> mr-5"
                                    style="margin-top: -3px; <?= $colorFormat == 'disable' ? 'pointer-events: none; opacity: 0.5;' : '' ?>">
                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/chart.png" alt="Chart"
                                        class="pim-icon" style="margin-top: -2px;">
                                </a>
                                <?php
                                            if ($colorFormat == 'disable') {
                                            ?>
                                <a class="btn btn-bg-blue-xs pr-2 pl-3 mr-5" data-bs-toggle="modal"
                                    data-bs-target="#update-kgi-modal-team"
                                    onclick="javascript:updateKgi(<?= $kgiId ?>)">
                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/setupwhite.svg"
                                        alt="History" style="margin-top: -3px; width: 12px; height: 14px;"
                                        class="home-icon">
                                </a>
                                <?php
                                            }
                                            ?>
                                <?php
                                            if ($i == 0 && $kgi["status"] == 2 && $role >= 5) {
                                            ?>
                                <a class="btn btn-bg-white-xs mr-5" style="margin-top: -3px;"
                                    onclick="javascript:prepareKgiNextTarget(<?= $kgi['kgiHistoryId'] ?>)">
                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/coppy.svg" alt="History"
                                        style="margin-top: -3px; width: 12px; height: 14px;" class="home-icon">
                                </a>
                                <?php
                                            }
                                            ?>
                                <?php
                                            //if ($role >= 5) {
                                            ?>
                                <!-- <a class="btn btn-xs btn-outline-danger" data-bs-toggle="modal" data-bs-target="#staticBackdrop4" onclick="javascript:prepareDeleteKgi(<?php // $kgi['kgiHistoryId'] 
                                                                                                                                                                                        ?>)">
													<i class="fa fa-trash-o" aria-hidden="true"></i>
												</a> -->
                                <?php
                                            //}
                                            ?>
                            </div>
                            <div class="col-9 mt-10 pl-28">
                                <div class="row">
                                    <div class="col-4 month-<?= $colorFormat ?> pt-2">Term</div>
                                    <div class="col-8 term-<?= $colorFormat ?>  pt-2">
                                        <?= $kgi['fromDate'] == "" ? 'Not set' : $kgi['fromDate'] ?> -
                                        <?= $kgi['toDate'] == "" ? 'Not set' : $kgi['toDate'] ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3 mt-10">
                                <div class="<?= $colorFormat ?>-tag text-center">
                                    <?= $kgi['status'] == 1 ? 'In process' : 'Completed' ?>
                                </div>
                            </div>
                            <div class="col-9  pl-15 pr-20 pt-5">
                                <div class="col-12 text-start pl-5 font-size-10">
                                    Assign on
                                </div>
                                <div class="col-12 <?= $colorFormat ?>-assign pt-2 pb-2">
                                    <div class="row">
                                        <div class="col-5 border-right-<?= $colorFormat ?> pl-10">
                                            <div class="row">
                                                <div class="col-2">
                                                    <?php
                                                                if (isset($kgi['kgiEmployee'][0])) {
                                                                ?>
                                                    <img src="<?= Yii::$app->homeUrl . $kgi['kgiEmployee'][0] ?>"
                                                        class="pim-pic-grid">
                                                    <?php
                                                                }
                                                                ?>
                                                </div>
                                                <div class="col-2 pic-after pt-0">
                                                    <?php
                                                                if (isset($kgi['kgiEmployee'][1])) {
                                                                ?>
                                                    <img src="<?= Yii::$app->homeUrl . $kgi['kgiEmployee'][1] ?>"
                                                        class="pim-pic-grid">
                                                    <?php
                                                                }
                                                                ?>
                                                </div>
                                                <div class="col-2 pic-after pt-0">
                                                    <?php
                                                                if (isset($kgi['kgiEmployee'][2])) {
                                                                ?>
                                                    <img src="<?= Yii::$app->homeUrl . $kgi['kgiEmployee'][2] ?>"
                                                        class="pim-pic-grid">
                                                    <?php
                                                                }
                                                                ?>
                                                </div>
                                                <div class="col-6 number-tag load-<?= $colorFormat ?> pr-0 pl-0 pt-3"
                                                    style="margin-left: -3px;height:22px;width: 30px;margin-top: 1px;">
                                                    <?= $kgi["employee"] ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-7 pl-5 pt-3">

                                            <?php
                                                        if ($role > 3) {
                                                        ?>
                                            <a href="<?= Yii::$app->homeUrl ?>kgi/assign/assign/<?= ModelMaster::encodeParams(['kgiId' => $kgiId, "companyId" => $kgi["companyId"], "save" => 0]) ?>"
                                                class="font-<?= $colorFormat ?>">
                                                Assigned Person
                                            </a>
                                            <?php
                                                        } else {
                                                        ?>
                                            <span class="font-<?= $colorFormat ?>">
                                                Assigned Person
                                            </span>
                                            <?php
                                                        }
                                                        ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 <?= $colorFormat ?>-assign pt-5 pb-2 mt-10">
                                    <!-- <div class="row">
                                        <div class="col-5 border-right-<?= $colorFormat ?> pr-2">
                                            <div class="row">
                                                <div class="col-2 pt-3">
                                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/team-<?= $colorFormat ?>.png"
                                                        class="first-layer-icon" style="margin-top: -4px;">
                                                </div>
                                                <div class="col-2 pic-after pt-5">

                                                </div>
                                                <div class="col-2 pic-after pt-0">

                                                </div>
                                                <div class="col-6 number-tag load-<?= $colorFormat ?> pr-0 pl-0 pt-3"
                                                    style="margin-left: -3px;height:22px;width: 30px;margin-top: 1px;">
                                                    <?= $kgi["countTeam"] ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-7 pl-5  pt-3 font-<?= $colorFormat ?>">
                                            <?php
                                            if ($role > 3) {
                                            ?>
                                            <a href="<?= Yii::$app->homeUrl ?>kgi/assign/assign/<?= ModelMaster::encodeParams(['kgiId' => $kgiId, "companyId" => $kgi["companyId"]]) ?>"
                                                class="font-<?= $colorFormat ?>">
                                                Assign Team
                                            </a>
                                            <?php
                                            } else { ?>
                                            <span class="font-<?= $colorFormat ?>">
                                                Assign Team
                                            </span>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div> -->
                                    <div class="row">
                                        <div class="col-5 border-right-<?= $colorFormat ?> pl-10">
                                            <div class="row">
                                                <div class="col-2 pt-3">
                                                    <img
                                                        src="<?= Yii::$app->homeUrl ?>images/icons/Settings/team-<?= $colorFormat ?>.png">
                                                </div>
                                                <div class="col-2 pic-after pt-0">

                                                </div>
                                                <div class="col-2 pic-after pt-0">

                                                </div>
                                                <div class="col-6 number-tag load-<?= $colorFormat ?> pr-0 pl-0 pt-3"
                                                    style="margin-left: -3px;height:22px;width: 30px;margin-top: 1px;">
                                                    <?= $kgi["countTeam"] ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-7 pl-5 pt-3">
                                            <?php
                                                        if ($role > 3) {
                                                        ?>
                                            <a href="<?= Yii::$app->homeUrl ?>kgi/assign/assign/<?= ModelMaster::encodeParams(['kgiId' => $kgiId, "companyId" => $kgi["companyId"]]) ?>"
                                                class="font-<?= $colorFormat ?>">
                                                Assign Team
                                            </a>
                                            <?php
                                                        } else { ?>
                                            <span class="font-<?= $colorFormat ?>">
                                                Assign Team
                                            </span>
                                            <?php
                                                        }
                                                        ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3 font-size-10 pt-15">
                                <div class="col-12 text-end">Quant Ratio</div>
                                <div class="col-12   pim-duedate font-size-9 pb-3 text-end">
                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/diamon.svg"
                                        class="pim-iconKFI" style="margin-top: -3px; margin-left: 3px;">
                                    <b><?= $kgi["quantRatio"] == 1 ? 'Quantity' : 'Quality' ?></b>
                                </div>
                                <div class="col-12 mt-6 mb-6 border-bottom-<?= $colorFormat ?>">
                                </div>
                                <div class="col-12  pr-0 mt-2 text-end">update Interval</div>
                                <div class="col-12   pim-duedate text-end"><b>
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/monthly.svg"
                                            class="pim-iconKFI" style="margin-top: -3px; margin-left: 3px;">
                                        <?= $kgi["unit"] ?>
                                    </b>
                                </div>
                            </div>
                            <div class="col-12 mt-10">
                                <div class="row">
                                    <div class="col-5 text-start pl-20">
                                        <div class="col-12 font-size-10">
                                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/Target.svg"
                                                class="pim-iconKFI" style="margin-top: 1px; margin-right: 3px;">
                                            Target
                                        </div>
                                        <div class="col-12 number-pim">
                                            <?php
                                                        $decimal = explode('.', $kgi["target"]);
                                                        if (isset($decimal[1])) {
                                                            if ($decimal[1] == '00') {
                                                                $show = number_format($decimal[0]);
                                                            } else {
                                                                $show = number_format($kgi["target"], 2);
                                                            }
                                                        } else {
                                                            $show = number_format($kgi["target"]);
                                                        }
                                                        ?>
                                            <b><?= $show ?><?= $kgi["amountType"] == 1 ? '%' : '' ?></b>
                                        </div>
                                    </div>
                                    <div class="col-2 symbol-pim text-center">
                                        <div class="col-12 pt-13 font-size-12"><?= $kgi["code"] ?></div>
                                    </div>
                                    <div class="col-5 text-end pr-20">
                                        <div class="col-12 font-size-10">Result
                                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/Result.svg"
                                                class="pim-iconKFI" style="margin-top: 1px; margin-left: 3px;">
                                        </div>
                                        <div class="col-12 number-pim">
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
                                            <b><?= $showResult ?><?= $kgi["amountType"] == 1 ? '%' : '' ?></b>

                                        </div>
                                    </div>
                                    <div class="col-12 pl-20 pr-20 pb-8">
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

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                            $i++;
                        endforeach;
                    endforeach;
                }
                ?>
            </div>
        </div>
    </div>
</div>
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
<?= $this->render('modal_confirm_next') ?>