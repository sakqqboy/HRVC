<?php

use common\models\ModelMaster;
use frontend\models\hrvc\Branch;
use frontend\models\hrvc\Company;
use frontend\models\hrvc\Team;

?>

<select class="form-select font-size-12 <?= $companyId != "" ? 'select-pimselect' : 'select-pim' ?>" id="company-filter"
    onchange="applySelectStyle(this)">
    <?php
    if (isset($companyId) && $companyId != "") { ?>
        <option value="<?= $companyId ?>"><?= Company::companyName($companyId) ?></option>
    <?php
        $branches = Branch::branchInCompany($companyId);
    }
    ?>
    <option value=""><?= Yii::t('app', 'Company') ?></option>
    <?php
    if (isset($companies) && count($companies) > 0) {
        foreach ($companies as $company) : ?>
            <option value="<?= $company['companyId'] ?>"><?= $company['companyName'] ?></option>
    <?php
        endforeach;
    }
    ?>
</select>
<select class="form-select font-size-12 <?= $branchId != "" ? 'select-pimselect' : 'select-pim' ?>" id="branch-filter"
    <?= $companyId == "" ? 'disabled' : '' ?> onchange="applySelectStyle(this)">
    <?php
    if (isset($branchId) && $branchId != "") { ?>
        <option value="<?= $branchId ?>"><?= Branch::branchName($branchId) ?></option>
    <?php
        $teams = Team::teamInBranch($branchId);
    }
    ?>
    <option value=""><?= Yii::t('app', 'Branch') ?></option>
    <?php
    if (isset($branches) && count($branches) > 0) {
        foreach ($branches as $branch) : ?>
            <option value="<?= $branch['branchId'] ?>"><?= $branch['branchName'] ?></option>
    <?php
        endforeach;
    }
    ?>

</select>
<select class="form-select font-size-12 <?= $teamId != "" ? 'select-pimselect' : 'select-pim' ?>" id="team-filter"
    <?= $branchId == "" ? 'disabled' : '' ?> onchange="applySelectStyle(this)">
    <?php
    if (isset($teamId) && $teamId != "") { ?>
        <option value="<?= $teamId ?>"><?= Team::teamName($teamId) ?></option>
    <?php
    } ?>
    <option value=""><?= Yii::t('app', 'Team') ?></option>
    <?php
    if (isset($teams) && count($teams) > 0) {
        foreach ($teams as $team) : ?>
            <option value="<?= $team['teamId'] ?>"><?= $team['teamName'] ?></option>
    <?php
        endforeach;
    }
    ?>
</select>
<select class="form-select font-size-12 <?= $month != "" ? 'select-pimselect' : 'select-pim' ?>" id="month-filter"
    onchange="applySelectStyle(this)">
    <?php
    if (isset($month) && $month != "") { ?>
        <option value="<?= $month ?>"><?= ModelMaster::monthFull()[$month] ?></option>
    <?php
    }
    ?>
    <option value=""><?= Yii::t('app', 'Month') ?></option>
    <?php
    if (isset($months) && count($months) > 0) {
        foreach ($months as $value => $month) : ?>
            <option value="<?= $value ?>"><?= Yii::t('app', $month) ?></option>
    <?php
        endforeach;
    }
    ?>
</select>
<select class="form-select font-size-12 <?= $yearSelected != '' ? 'select-pimselect' : 'select-pim' ?>" id="year-filter"
    onchange="applySelectStyle(this)">
    <?php
    if (isset($yearSelected) && $year != "") { ?>
        <option value="<?= $yearSelected ?>"><?= $yearSelected ?></option>
    <?php
    }
    ?>
    <option value=""><?= Yii::t('app', 'Year') ?></option>
    <?php
    $yearList = 2022;
    $i = 1;
    while ($i < 20) {
        if ($yearList != $yearSelected) {
    ?>
            <option value="<?= $yearList ?>"><?= $yearList ?></option>
    <?php
        }
        $yearList += 1;
        $i++;
    }
    ?>
</select>
<select class="form-select font-size-12 <?= $status != "" ? 'select-pimselect' : 'select-pim' ?>" id="status-filter"
    onchange="applySelectStyle(this)">
    <?php
    if (isset($status) && $status != "") {
        if ($status == 1) {
            $text = 'In Progress';
        }
        if ($status == 2) {
            $text = 'Completed';
        }
        if ($status == 3) {
            $text = 'Due Passed';
        }
        if ($status == 4) {
            $text = 'Not Set';
        }
    ?>
        <option value="<?= $status ?>"><?= $text ?></option>
    <?php
    }
    ?>
    <option value=""><?= Yii::t('app', 'Status') ?></option>
    <option value="1"><?= Yii::t('app', 'In Progress') ?></option>
    <option value="3"><?= Yii::t('app', 'Due Passed') ?></option>
    <option value="4"><?= Yii::t('app', 'Not Set') ?></option>
    <option value="2"><?= Yii::t('app', 'Completed') ?></option>
</select>
<span class="justify-content-center d-flex align-items-center employee-filter-btn" style="cursor: pointer;"
    onclick="javascript:kpiFilterForTeam()">
    <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/FilterWhite.svg" class="pim-search-icons">

</span>
<div class="btn-group <?= (Yii::$app->controller->action->id == 'draft' || Yii::$app->controller->action->id == 'draft-result') ? 'd-none' : '' ?>"
    role="group">
    <?php
    if ($page == 'grid') { ?>
        <a class="btn btn-primary font-size-12 pim-change-modes">
            <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/gridwhite.svg"
                style="cursor: pointer; width:15px;height:15px;">
        </a>
        <a href="<?= Yii::$app->homeUrl . 'kpi/kpi-personal/individual-kpi' ?>"
            class="btn btn-outline-primary font-size-12 pim-change-modes" style="border-color: #CBD5E1 !important;">
            <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/listblack.svg"
                style="cursor: pointer; width:15px;height:15px;">
        </a>
    <?php
    } else { ?>
        <a href="<?= Yii::$app->homeUrl . 'kpi/kpi-personal/individual-kpi-grid' ?>"
            class="btn btn-outline-primary font-size-12 pim-change-modes" style="border-color: #CBD5E1 !important;">
            <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/gridblack.svg"
                style="cursor: pointer; width:15px;height:15px;">
        </a>
        <a class="btn btn-primary font-size-12 pim-change-modes">
            <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/listwhite.svg"
                style="cursor: pointer; width:15px;height:15px;">
        </a>
    <?php
    }
    ?>
</div>

<script>
    function applySelectStyle(selectElement) {
        if (selectElement.value) {
            selectElement.classList.remove('select-pim');
            selectElement.classList.add('select-pimselect');
        } else {
            selectElement.classList.remove('select-pimselect');
            selectElement.classList.add('select-pim');
        }
    }
</script>
<style>
    .select-pim {
        width: 85px;
    }

    .select-pimselect {
        width: 85px;
    }

    .pim-change-modes {
        padding: 0px !important;
        width: 25px;
        display: flex;
        justify-content: center;
        align-items: center;
        border-color: #2F80ED !important;
        height: 25px;
    }
</style>