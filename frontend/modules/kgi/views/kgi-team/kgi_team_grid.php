<?php

use common\models\ModelMaster;
use yii\bootstrap5\ActiveForm;

$this->title = "TEAM KGI";
?>
<div class="col-12">
    <div class="col-12">
        <img src="<?= Yii::$app->homeUrl ?>images/icons/black-icons/FinancialSystem/Vector.png" class="home-icon mr-5"
            style="margin-top: -3px;">
        <strong class="pim-head-text"> Team Key Goal Indicators</strong>
    </div>
    <div class="col-12 mt-10">
        <?= $this->render('header_filter', [
            "role" => $role
        ]) ?>
        <div class="alert mt-10 pim-body bg-white">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="row">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-3 pim-type-tab pr-0 pl-0">
                                    <a href="<?= Yii::$app->homeUrl ?>kgi/management/grid" class="no-underline-black ">
                                        Company KGI
                                    </a>
                                </div>
                                <div class="col-3 pim-type-tab-selected">
                                    Team KGI
                                </div>
                                <div class="col-3 pim-type-tab">
                                    <a href="<?= Yii::$app->homeUrl ?>kgi/kgi-personal/individual-kgi-grid" class="no-underline-black">
                                        Self KGI
                                    </a>
                                </div>
                                <div class="col-3 pr-0 pl-3 pt-0">
                                    <?php
                                    if ($role > 3) {
                                    ?>
                                        <div class="col-12 approval-box text-center pr-3">
                                            <?php
                                            if ($waitForApprove["totalReuest"] > 0) {
                                            ?>
                                                <a href="<?= Yii::$app->homeUrl ?>kgi/management/wait-approve"
                                                    style="text-decoration: none;color:#2580D3;">
                                                    <span class="approve-num mr-2"><?= $waitForApprove["totalReuest"] ?></span>
                                                    Approvals
                                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/approve.svg"
                                                        class="first-layer-icon pull-right" style="margin-top:-2px;">
                                                </a>
                                            <?php
                                            } else { ?>
                                                <a style="text-decoration: none;color:#2580D3;">
                                                    <span class="approve-num mr-2"><?= $waitForApprove["totalReuest"] ?></span>
                                                    Approvals
                                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/approve.svg"
                                                        class="first-layer-icon pull-right" style="margin-top:-2px;">
                                                </a>
                                            <?php
                                            }

                                            ?>
                                        </div>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-7 New-KFI">
                    <?= $this->render('filter_list', [
                        "companies" => $companies,
                        "months" => $months,
                        "companyId" => $companyId,
                        "branchId" => $branchId,
                        "teamId" => $teamId,
                        "month" => $month,
                        "status" => $status,
                        "year" => $year,
                    ]) ?>
                    <input type="hidden" id="type" value="grid">
                </div>


                <div class="col-lg-1 col-md-6 col-12 pr-0 text-end">
                    <div class="btn-group" role="group">
                        <a href="<?= Yii::$app->homeUrl ?>kgi/kgi-team/team-kgi-grid"
                            class="btn btn-primary font-size-12 pim-change-mode">
                            <i class="fa fa-th-large" aria-hidden="true"></i>
                        </a>
                        <a href="<?= Yii::$app->homeUrl ?>kgi/kgi-team/team-kgi"
                            class="btn btn-outline-primary font-size-12 pim-change-mode">
                            <i class="fa fa-list-ul" aria-hidden="true"></i>
                        </a>

                    </div>
                </div>
            </div>

            <div class="col-12 mt-5">
                <div class="row">
                    <?php
                    if (isset($teamKgis) && count($teamKgis) > 0) {
                        foreach ($teamKgis as $kgiTeamId => $kgi) :
                            $canEdit = 0;
                            if ($role > 3) {
                                $canEdit = 1;
                            } else {
                                if ($role == 3 && ($kgi["teamId"] == $userTeamId)) {
                                    $canEdit = 1;
                                }
                            }
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
                                    if ($kgi["status"] == 2) {
                                        $colorFormat = 'complete';
                                    } else {
                                        $colorFormat = 'inprogress';
                                    }
                                }
                            }
                    ?>
                            <div class="col-12 mt-10 mb-5 pim-big-box pim-<?= $colorFormat ?>" id="kgi-team-<?= $kgiTeamId ?>">
                                <div class="row">
                                    <div class="col-lg-3 col-md-5 col-12 pim-name pr-0">
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

                                        <span class="pim-normal-text mr-5">
                                            <?= $kgi["teamName"] ?>
                                        </span>
                                        <img src="<?= Yii::$app->homeUrl . 'images/icons/Settings/team-name.svg' ?>"
                                            class="pim-pic-grid mr-5" style="margin-top: -1px;font-size:12px;">
                                        <a class="btn btn-bg-white-xs mr-5"
                                            href="<?= Yii::$app->homeUrl ?>kgi/view/kgi-team-history/<?= ModelMaster::encodeParams(['kgiId' => $kgi['kgiId'], "kgiTeamId" => $kgiTeamId]) ?>"
                                            style="margin-top: -3px;">
                                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/eye.png" alt="History"
                                                class="pim-icon" style="margin-top: -1px;">
                                        </a>
                                        <a class="btn btn-bg-white-xs mr-5" data-bs-toggle="modal" data-bs-target="#kgi-issue"
                                            onclick="javascript:showKgiComment(<?= $kgi['kgiId'] ?>)" style="margin-top: -3px;">
                                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/comment.png" alt="History"
                                                class="pim-icon">
                                        </a>
                                        <a class="btn btn-bg-white-xs mr-5" data-bs-toggle="modal"
                                            data-bs-target="#staticBackdrop3" onclick="javascript:kgiHistory(<?= $kgiTeamId ?>)"
                                            style="margin-top: -3px;">
                                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/chart.png" alt="History"
                                                class="pim-icon mr-3" style="margin-top: -2px;">Chart
                                        </a>
                                        <?php
                                        if ($role >= 5) {
                                        ?>
                                            <a class="btn btn-bg-red-xs" data-bs-toggle="modal" data-bs-target="#delete-kgi-team"
                                                onclick="javascript:prepareDeleteKgiTeam(<?= $kgiTeamId ?>)"
                                                style="margin-top: -3px;">
                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/bin.png" alt="History"
                                                    class="pim-icon" style="margin-top: -2px;">
                                            </a>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                    <div class="col-lg-3 pim-subheader-font border-right-<?= $colorFormat ?> mt-5">
                                        <div class="row">
                                            <div class="col-12 text-start pl-20">
                                                Assign on
                                            </div>
                                            <div class="col-9 pl-10 pr-0">
                                                <div class="col-12 <?= $colorFormat ?>-assign  mt-5 pt-2 pb-2">
                                                    <div class="row">
                                                        <div class="col-5 border-right-<?= $colorFormat ?> pr-2">
                                                            <div class="row">
                                                                <div class="col-2">
                                                                    <?php
                                                                    if (isset($kgi['kgiEmployeeSelect'][0])) {
                                                                    ?>
                                                                        <img src="<?= Yii::$app->homeUrl . $kgi['kgiEmployeeSelect'][0] ?>"
                                                                            class="pim-pic-grid">
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </div>
                                                                <div class="col-2 pic-after pt-0">
                                                                    <?php
                                                                    if (isset($kgi['kgiEmployeeSelect'][1])) {
                                                                    ?>
                                                                        <img src="<?= Yii::$app->homeUrl . $kgi['kgiEmployeeSelect'][1] ?>"
                                                                            class="pim-pic-grid">
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </div>
                                                                <div class="col-2 pic-after pt-0">
                                                                    <?php
                                                                    if (isset($kgi['kgiEmployeeSelect'][2])) {
                                                                    ?>
                                                                        <img src="<?= Yii::$app->homeUrl . $kgi['kgiEmployeeSelect'][2] ?>"
                                                                            class="pim-pic-grid">
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </div>
                                                                <div class="col-5 number-tag load-<?= $colorFormat ?> pr-0 pl-0 pt-1"
                                                                    style="margin-left: -3px;height:18px;width: 30px;margin-top: 1px;">
                                                                    <?= $kgi["countTeamEmployee"] ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-7 pl-3 pr-13 pt-1">
                                                            <?php
                                                            if ($role >= 3) {
                                                            ?>
                                                                <a href="<?= Yii::$app->homeUrl ?>kgi/assign/assign/<?= ModelMaster::encodeParams(['kgiId' => $kgi["kgiId"], "companyId" => $kgi["companyId"]]) ?>"
                                                                    class="font-<?= $colorFormat ?>">
                                                                    Assign Teammate
                                                                </a>
                                                            <?php
                                                            } else { ?>
                                                                <span class="font-<?= $colorFormat ?>">
                                                                    Assign Teammate
                                                                </span>
                                                            <?php
                                                            }
                                                            ?>
                                                            <span class="pull-right"
                                                                style="display:<?= $kgi['isOver'] == 2 ? 'none;' : '' ?>">
                                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/assign-<?= $colorFormat ?>.png"
                                                                    class="home-icon" style="margin-top: -1px;">
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 disable-assign  mt-10 pt-5 pb-1">
                                                    <div class="row">
                                                        <div class="col-5 border-right pr-2">
                                                            <div class="row">
                                                                <div class="col-4">
                                                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/team-black.png"
                                                                        class="first-layer-icon ml-5" style="margin-top: -4px;">
                                                                </div>
                                                                <div class="col-4 number-tag load-disble pr-3 pl-3 ml-5"
                                                                    style="height:17px;">
                                                                    <?= $kgi["countTeam"] ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-7 pl-3 pr-13">
                                                            Teams
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
                                        <div class="col-12 border-bottom-<?= $colorFormat ?> pb-10 pim-normal-text">
                                            <i class="fa fa-diamond" aria-hidden="true"></i>
                                            <?= $kgi["quantRatio"] == 1 ? 'Quantity' : 'Quality' ?>
                                        </div>
                                        <div class="col-12 pr-0 pt-10 pl-0">update Interval</div>
                                        <div class="col-12  pim-normal-text">
                                            <?= $kgi["unit"] ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 pim-subheader-font border-right-<?= $colorFormat ?>  pr-15 pl-15 mt-5">
                                        <div class="row">
                                            <div class="col-5 text-start">
                                                <div class="col-12">Target</div>
                                                <div class="col-12 mt-3 number-pim">
                                                    <?php
                                                    if ($kgi["target"] != '') {
                                                        $decimal = explode('.', $kgi["target"]);
                                                        if (isset($decimal[1])) {
                                                            if ($decimal[1] == '00') {
                                                                $show = $decimal[0];
                                                            } else {
                                                                $show = $kgi["target"];
                                                            }
                                                        } else {
                                                            $show = $kgi["target"];
                                                        }
                                                    } else {
                                                        $show = 0.00;
                                                    }
                                                    ?>
                                                    <?= $show ?><?= $kgi["target"] == 1 ? '%' : '' ?>
                                                </div>
                                            </div>
                                            <div class="col-2 symbol-pim text-center">
                                                <div class="col-12 pt-17"><?= $kgi["code"] ?></div>
                                            </div>
                                            <div class="col-5  text-end">
                                                <div class="col-12">Result</div>
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
                                                if (isset($percent[1])) {
                                                    if ($percent[1] != '00') {
                                                        //$showPercent = $kgi['ratio'];
                                                        $showPercent = $percent[1];
                                                    } else {
                                                        $showPercent = $percent[0];
                                                    }
                                                } else {
                                                    $showPercent = $percent[0];
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
                                                <div class="col-12 text-start">Last Updated on</div>
                                                <div class="col-12 text-start pim-duedate">
                                                    <?= $kgi['nextCheckDate'] == "" ? 'Not set' : $kgi['nextCheckDate'] ?></div>
                                            </div>
                                            <div class="col-4 text-center mt-10 pt-6">
                                                <?php
                                                //if ($canEdit == 1 && $kgi["status"] != 2) {
                                                if ($canEdit == 1) {
                                                ?>
                                                    <div data-bs-toggle="modal" data-bs-target="#update-kgi-modal-team"
                                                        onclick="javascript:updateTeamKgi(<?= $kgiTeamId ?>)"
                                                        class="pim-btn-<?= $colorFormat ?>">
                                                        <i class="fa fa-refresh" aria-hidden="true"></i> Update
                                                    </div>
                                                <?php
                                                }
                                                ?>
                                            </div>
                                            <div class="col-4 pl-0 pr-5 mt-10">
                                                <div class="col-12 text-end font-<?= $colorFormat ?>">Next Update Date</div>
                                                <div class="col-12 text-end pim-duedate">
                                                    <?= $kgi['nextCheckDate'] == "" ? 'Not set' : $kgi['nextCheckDate'] ?></div>
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
                                            <div class="col-lg-6 col-md-6 col-12 pl-5 pr-20">
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

</div>
<?php
$form = ActiveForm::begin([
    'id' => 'update-kgi',
    'method' => 'post',
    'options' => [
        'enctype' => 'multipart/form-data',
    ],
    'action' => Yii::$app->homeUrl . 'kgi/kgi-team/update-kgi-team'

]); ?>
<?= $this->render('modal_update', [
    "units" => $units,
    "isManager" => $isManager,
    "months" => $months,
]) ?>
<?php ActiveForm::end(); ?>
<?= $this->render('modal_view', [
    "isManager" => $isManager
]) ?>
<?= $this->render('modal_issue') ?>
<?= $this->render('modal_delete') ?>