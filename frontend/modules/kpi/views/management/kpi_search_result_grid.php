<?php

use common\models\ModelMaster;
use yii\bootstrap5\ActiveForm;

$this->title = 'KPI Grid View';
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
        <div class="alert mt-10 pim-body bg-white">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-12  pr-0 pt-1">
                    <div class="row">
                        <div class="col-8">
                            <div class="row">
                                <div class="col-4 pim-type-tab-selected pr-0 pl-0 rounded-top-left">
                                    Company KPI
                                </div>
                                <div class="col-4 pim-type-tab">
                                    <a href="<?= Yii::$app->homeUrl ?>kpi/kpi-team/team-kpi"
                                        class="no-underline-black ">
                                        Team KPI
                                    </a>
                                </div>
                                <div class="col-4 pim-type-tab rounded-top-right">
                                    <a href="<?= Yii::$app->homeUrl ?>kpi/kpi-personal/individual-kpi"
                                        class="no-underline-black ">
                                        Self KPI
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-4 pl-4">
                            <?php
                            if ($role >= 3) {
                            ?>
                                <button type="button" class="btn-createnew font-size-11" data-bs-toggle="modal"
                                    data-bs-target="#staticBackdrop5" style="position:absolute;"">
                                Create New <i class=" fa fa-magic ml-2" aria-hidden="true"></i>
                                </button>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7 col-md-12 col-12 pt-1">
                    <?= $this->render('filter_list_search', [
                        "companies" => $companies,
                        "months" => $months,
                        "companyId" => $companyId,
                        "branchId" => $branchId,
                        "teamId" => $teamId,
                        "month" => $month,
                        "status" => $status,
                        "yearSelected" => $year,
                        "branches" => $branches,
                        "teams" => $teams
                    ]) ?>
                    <input type="hidden" id="type" value="grid">
                </div>
                <div class="col-lg-1 col-md-6 col-12 pr-0 text-end">
                    <div class="btn-group" role="group">
                        <a href="#" class="btn btn-primary font-size-12 pim-change-modes">
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/gridwhite.svg"
                                style="cursor: pointer;">
                        </a>
                        <a href="<?= Yii::$app->homeUrl . 'kpi/management/index' ?>"
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
                    if (isset($kpis) && count($kpis) > 0) {
                        foreach ($kpis as $kpiId => $kpi) :
                            if ($kpi["isOver"] == 1 && $kpi["status"] != 2) {
                                $colorFormat = 'over';
                            } else {
                                if ($kpi["status"] == 1) {
                                    if ($kpi["isOver"] == 2) {
                                        $colorFormat = 'disable';
                                    } else {
                                        $colorFormat = 'inprogress';
                                    }
                                } else {
                                    $colorFormat = 'complete';
                                }
                            }
                    ?>
                            <div class="col-12 mt-10 mb-5 pim-big-box pim-<?= $colorFormat ?>" id="kpi-<?= $kpiId ?>">
                                <div class="row">
                                    <div class="col-lg-3 col-md-5 col-12 pim-name pr-0">
                                        <?= $kpi["kpiName"] ?>
                                    </div>
                                    <div class="col-lg-1 col-md-2 col-4 text-center">
                                        <div class="<?= $colorFormat ?>-tag text-center">
                                            <?= $kpi['status'] == 1 ? 'In process' : 'Completed' ?>
                                        </div>
                                    </div>
                                    <div class=" col-lg-3 col-md-3 col-4 pl-30">
                                        <div class="row">
                                            <div class="col-4 month-<?= $colorFormat ?>"><?= $kpi['month'] ?></div>
                                            <div class="col-8 term-<?= $colorFormat ?>">
                                                <?= $kpi['fromDate'] == "" ? 'Not set' : $kpi['fromDate'] ?> -
                                                <?= $kpi['toDate'] == "" ? 'Not set' : $kpi['toDate'] ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-5 col-md-2 col-4 text-end pr-20">
                                        <a href="<?= Yii::$app->homeUrl ?>kpi/view/index/<?= ModelMaster::encodeParams(['kpiId' => $kpiId]) ?>"
                                            class="btn btn-bg-white-xs mr-5" style="margin-top: -3px;">
                                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/eye.png" alt="History"
                                                class="pim-icon" style="margin-top: -1px;">
                                        </a>
                                        <a href="<?= Yii::$app->homeUrl ?>kpi/view/kpi-history/<?= ModelMaster::encodeParams(['kpiId' => $kpiId]) ?>"
                                            class="btn btn-bg-white-xs mr-5" style="margin-top: -3px;">
                                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Comment.png" alt="History"
                                                class="home-icon">
                                        </a>
                                        <a href="<?= Yii::$app->homeUrl ?>kpi/chart/company-chart/<?= ModelMaster::encodeParams(['kpiId' => $kpiId]) ?>"
                                            class="btn btn-bg-white-xs mr-5" style="margin-top: -3px;">
                                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Charts.png" alt="History"
                                                class="home-icon mr-3" style="margin-top: -3px;">Chart
                                        </a>
                                        <?php
                                        if ($role >= 5) {
                                        ?>
                                            <a class="btn btn-xs btn-outline-danger" data-bs-toggle="modal"
                                                data-bs-target="#delete-kpi" onclick="javascript:prepareDeleteKpi(<?= $kpiId ?>)"
                                                style="margin-top: -3px;">
                                                <i class="fa fa-trash-o" aria-hidden="true"></i>
                                            </a>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                    <div class="col-lg-3 pim-subheader-font border-right-<?= $colorFormat ?> mt-5">
                                        <div class="row">
                                            <div class="col-12 text-start pl-22">
                                                Assign on
                                            </div>
                                            <div class="col-9 pl-20 pr-0">
                                                <div class="col-12 <?= $colorFormat ?>-assign  mt-5 pt-2 pb-1">
                                                    <div class="row">
                                                        <div class="col-5 border-right-<?= $colorFormat ?> pr-2">
                                                            <div class="row">
                                                                <div class="col-2">
                                                                    <?php
                                                                    if (isset($kpi['kpiEmployee'][0])) {
                                                                    ?>
                                                                        <img src="<?= Yii::$app->homeUrl . $kpi['kpiEmployee'][0] ?>"
                                                                            class="pim-pic-grid">
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </div>
                                                                <div class="col-2 pic-after pt-0">
                                                                    <?php
                                                                    if (isset($kpi['kpiEmployee'][1])) {
                                                                    ?>
                                                                        <img src="<?= Yii::$app->homeUrl . $kpi['kpiEmployee'][1] ?>"
                                                                            class="pim-pic-grid">
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </div>
                                                                <div class="col-2 pic-after pt-0">
                                                                    <?php
                                                                    if (isset($kpi['kpiEmployee'][2])) {
                                                                    ?>
                                                                        <img src="<?= Yii::$app->homeUrl . $kpi['kpiEmployee'][2] ?>"
                                                                            class="pim-pic-grid">
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </div>
                                                                <div class="col-5 number-tag load-<?= $colorFormat ?> pr-0 pl-0 pt-1"
                                                                    style="margin-left: -3px;height:18px;width:30px;margin-top: 1px;">
                                                                    <?= $kpi["countEmployee"] ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-7 pl-3 pt-4 pr-15">
                                                            <?php
                                                            if ($role > 3) {
                                                            ?>
                                                                <a href="<?= Yii::$app->homeUrl ?>kpi/assign/assign/<?= ModelMaster::encodeParams(['kpiId' => $kpiId, "companyId" => $kpi["companyId"]]) ?>"
                                                                    class="font-<?= $colorFormat ?>">
                                                                    Assign Person
                                                                </a>
                                                            <?php
                                                            } else {
                                                            ?>
                                                                <span class="font-<?= $colorFormat ?>">
                                                                    Assign Person
                                                                </span>
                                                            <?php
                                                            }
                                                            ?>
                                                            <span class="pull-right">
                                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/assign-<?= $colorFormat ?>.png"
                                                                    class="home-icon" style="margin-top: -4px;">
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 <?= $colorFormat ?>-assign  mt-10 pt-5 pb-1">
                                                    <div class="row">
                                                        <div class="col-5 border-right-<?= $colorFormat ?> pr-2">
                                                            <div class="row">
                                                                <div class="col-4">
                                                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/team-<?= $colorFormat ?>.png"
                                                                        class="first-layer-icon ml-3" style="margin-top: -4px;">
                                                                </div>
                                                                <div class="col-4 number-tag load-<?= $colorFormat ?> pr-3 pl-3 pt-1 ml-5"
                                                                    style="height:18px;">
                                                                    <?= $kpi["countTeam"] ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-7 pl-3 pr-15">
                                                            <?php
                                                            if ($role > 3) {
                                                            ?>
                                                                <a href="<?= Yii::$app->homeUrl ?>kpi/assign/assign/<?= ModelMaster::encodeParams(['kpiId' => $kpiId, "companyId" => $kpi["companyId"]]) ?>"
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
                                                            <span class="pull-right"
                                                                style="display:<?= $kpi['isOver'] == 2 ? 'none;' : '' ?>">
                                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/assign-<?= $colorFormat ?>.png"
                                                                    class="home-icon" style="margin-top: -3px;">
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-3" style="margin-top:-5px;">
                                                <div class="col-12 text-center priority-star">
                                                    <?php
                                                    if ($kpi["priority"] == "A" || $kpi["priority"] == "B") {
                                                    ?>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                    <?php
                                                    }
                                                    if ($kpi["priority"] == "A" || $kpi["priority"] == "C") {
                                                    ?>
                                                        <i class="fa fa-star big-star" aria-hidden="true"></i>
                                                    <?php
                                                    }
                                                    if ($kpi["priority"] == "B") {
                                                    ?>
                                                        <i class="fa fa-star ml-10" aria-hidden="true"></i>
                                                    <?php
                                                    }
                                                    if ($kpi["priority"] == "A") {
                                                    ?>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                    <?php
                                                    }
                                                    ?>
                                                </div>
                                                <div class="col-12 text-center priority-box">
                                                    <div class="col-12">Priority</div>
                                                    <div class="col-12 text-priority"><?= $kpi["priority"] ?></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-1 pim-subheader-font border-right-<?= $colorFormat ?> mt-5 pl-10 pr-10">
                                        <div class="col-12">Quant Ratio</div>
                                        <div class="col-12 border-bottom-<?= $colorFormat ?> pb-10 pim-duedate">
                                            <i class="fa fa-diamond" aria-hidden="true"></i>
                                            <?= $kpi["quantRatio"] == 1 ? 'Quantity' : 'Quality' ?>
                                        </div>
                                        <div class="col-12 pr-0 pt-10 pl-0">update Interval</div>
                                        <div class="col-12  pim-duedate">
                                            <?= $kpi["unit"] ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 pim-subheader-font border-right-<?= $colorFormat ?> pr-15 pl-15 mt-5">
                                        <div class="row">
                                            <div class="col-5 text-start">
                                                <div class="col-12">Target</div>
                                                <div class="col-12 mt-3 number-pim">
                                                    <?php
                                                    $decimal = explode('.', $kpi["targetAmount"]);
                                                    if (isset($decimal[1])) {
                                                        if ($decimal[1] == '00') {
                                                            $show = $decimal[0];
                                                        } else {
                                                            $show = $kpi["targetAmount"];
                                                        }
                                                    } else {
                                                        $show = $kpi["targetAmount"];
                                                    }
                                                    ?>
                                                    <?= $show ?><?= $kpi["amountType"] == 1 ? '%' : '' ?>
                                                </div>
                                            </div>
                                            <div class="col-2 symbol-pim text-center">
                                                <div class="col-12 pt-17"><?= $kpi["code"] ?></div>
                                            </div>
                                            <div class="col-5  text-end">
                                                <div class="col-12">Result</div>
                                                <div class="col-12 mt-3 number-pim">
                                                    <?php
                                                    if ($kpi["result"] != '') {
                                                        $decimalResult = explode('.', $kpi["result"]);
                                                        if (isset($decimalResult[1])) {
                                                            if ($decimalResult[1] == '00') {
                                                                $showResult = number_format($decimalResult[0]);
                                                            } else {
                                                                $showResult = number_format($kpi["result"], 2);
                                                            }
                                                        } else {
                                                            $showResult = number_format($kpi["result"]);
                                                        }
                                                    } else {
                                                        $showResult = 0;
                                                    }
                                                    ?>
                                                    <?= $showResult ?><?= $kpi["amountType"] == 1 ? '%' : '' ?>
                                                </div>
                                            </div>
                                            <div class="col-12 pl-15 pr-10">
                                                <?php
                                                $percent = explode('.', $kpi['ratio']);
                                                if (isset($percent[0]) && $percent[0] == '0') {
                                                    if (isset($percent[1])) {
                                                        if ($percent[1] == '00') {
                                                            $showPercent = 0;
                                                        } else {
                                                            $showPercent = round($kpi['ratio'], 1);
                                                        }
                                                    }
                                                } else {
                                                    $showPercent = round($kpi['ratio']);
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
                                                    <?= $kpi['nextCheck'] == "" ? 'Not set' : $kpi['nextCheck'] ?></div>
                                            </div>
                                            <div class="col-4 text-center mt-10 pt-6">
                                                <?php
                                                if ($role > 3) {
                                                ?>
                                                    <div onclick="javascript:updateKpi(<?= $kpiId ?>)"
                                                        class="pim-btn-<?= $colorFormat ?>" data-bs-toggle="modal"
                                                        data-bs-target="#update-kpi-modal">
                                                        <i class="fa fa-refresh" aria-hidden="true"></i> Update
                                                    </div>
                                                <?php
                                                }
                                                ?>
                                            </div>
                                            <div class="col-4 pl-0 pr-5 mt-10">
                                                <div class="col-12 text-end font-<?= $colorFormat ?>">Next Update Date</div>
                                                <div class="col-12 text-end pim-duedate">
                                                    <?= $kpi['nextCheck'] == "" ? 'Not set' : $kpi['nextCheck'] ?></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-5 pim-subheader-font mt-5">
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-12 pr-3 pl-20">
                                                <div class="col-12 head-letter head-<?= $colorFormat ?>">Issue</div>
                                                <div class="col-12 body-letter body-letter-<?= $colorFormat ?>">
                                                    <?= $kpi["issue"] ?>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-12 pl-5 pr-20">
                                                <div class="col-12 head-letter head-<?= $colorFormat ?>">Solution</div>
                                                <div class="col-12 body-letter body-letter-<?= $colorFormat ?>">
                                                    <?= $kpi["solution"] ?>
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
    'id' => 'create-kpi',
    'method' => 'post',
    'options' => [
        'enctype' => 'multipart/form-data',
    ],
    'action' => Yii::$app->homeUrl . 'kpi/management/create-kpi'

]); ?>
<?= $this->render('modal_create', [
    "units" => $units,
    "companies" => $companies,
    "months" => $months
]) ?>
<?php ActiveForm::end(); ?>

<?php
$form = ActiveForm::begin([
    'id' => 'update-kpi',
    'method' => 'post',
    'options' => [
        'enctype' => 'multipart/form-data',
    ],
    'action' => Yii::$app->homeUrl . 'kpi/management/update-kpi'

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
<!-- end -->