<?php

use common\models\ModelMaster;
use yii\bootstrap5\ActiveForm;

$this->title = 'Self KGI History';
?>

<div class="col-12">
    <div class="col-12">
        <img src="<?= Yii::$app->homeUrl ?>images/icons/black-icons/FinancialSystem/Vector.png" class="home-icon mr-5"
            style="margin-top: -3px;">
        <strong class="pim-head-text"> Performance Indicator Matrices (PIM)</strong>
    </div>
    <div class="col-12 mt-10">
        <?= $this->render('header_filter_employee', [
            "role" => $role
        ]) ?>
        <div class="alert  mt-10 pim-body bg-white">
            <div class="col-12">
                <div class="row">
                    <div class="col-6 font-size-12 pim-name pr-0 pl-5 text-start">
                        <a href="<?= Yii::$app->homeUrl ?>kgi/kgi-personal/individual-kgi-grid"
                            class="mr-5 font-size-12">
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
                if (isset($kgiEmployeeHistory) && count($kgiEmployeeHistory) > 0) {
                    $i = 0;
                    foreach ($kgiEmployeeHistory as $year => $kgiMonth) :
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
                                            <a href="" class="btn btn-bg-white-xs">
                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/eye.png" alt="Chats"
                                                    class="pim-icon " style="margin-top: -2px;">
                                            </a>
                                            <?php
                                            if ($i == 0 && $kgi["status"] == 2) {
                                            ?>
                                                <a class="btn btn-bg-white-xs pr-2 pl-3"
                                                    onclick="javascript:prepareKgiEmployeeNextTarget(<?= $kgi['kgiEmployeeHistoryId'] ?>)">
                                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/coppy.svg" alt="History"
                                                        style="margin-top: -3px; width: 12px; height: 14px;" class="home-icon"> </a>
                                            <?php
                                            }
                                            ?>
                                            <a class="btn btn-bg-white-xs" data-bs-toggle="modal" data-bs-target="#staticBackdrop3"
                                                onclick="javascript:kgiHistory(<?= $kgi['kgiEmployeeHistoryId'] ?>)">
                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Comment.png" alt="History"
                                                    class="home-icon">
                                            </a>
                                            <a class="btn btn-bg-white-xs" data-bs-toggle="modal" data-bs-target="#staticBackdrop3"
                                                onclick="javascript:kgiHistory(<?= $kgi['kgiEmployeeHistoryId'] ?>)">
                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Charts.png" alt="History"
                                                    class="home-icon" style="margin-top: -3px;">
                                            </a>

                                            <?php
                                            if ($colorFormat == 'disable') {
                                            ?>
                                                <a class="btn btn-bg-blue-xs pr-2 pl-3 mr-5"
                                                    href="<?= Yii::$app->homeUrl ?>kgi/kgi-personal/update-personal-kgi/<?= ModelMaster::encodeParams(['kgiEmployeeId' => $kgiEmployeeId]) ?>">
                                                    <img src=" <?= Yii::$app->homeUrl ?>images/icons/Settings/setupwhite.svg"
                                                        alt="History" style="margin-top: -3px; width: 12px; height: 14px;"
                                                        class="home-icon">
                                                </a>
                                            <?php
                                            }
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
                                        <div class="col-12 font-size-10 pt-15">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="col-12 text-center">Quant Ratio</div>
                                                    <div class="col-12 font-size-9 text-center mt-1">
                                                        <i class="fa fa-diamond mr-2"
                                                            aria-hidden="true"></i><b><?= $kgi["quantRatio"] == 1 ? 'Quantity' : 'Quality' ?></b>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 border-left">
                                                    <div class="col-12 text-center">update Interval</div>
                                                    <div class="col-12 font-size-9 text-center mt-1"><b>
                                                            <?= $kgi["unit"] ?>
                                                        </b>
                                                    </div>
                                                </div>
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

                                                        if (empty($kgi["target"])) {
                                                            $show = '0.00'; // Default value if target is empty or null
                                                        } else {
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
                } else {
                    ?>
                    <div class="col-12 text-center">
                        There is no history
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
</div>
<?= $this->render('modal_confirm_next_employee') ?>