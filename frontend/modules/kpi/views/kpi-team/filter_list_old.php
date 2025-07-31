<?php

use common\models\ModelMaster;
use frontend\models\hrvc\Branch;
use frontend\models\hrvc\Company;
use frontend\models\hrvc\Team;

?>
<div class="row">
    <div class="col-2 pr-5 pl-1">
        <select class="form-select font-size-12 <?= $companyId != "" ? 'select-pimselect' : 'select-pim' ?>"
            id="company-filter" onchange="applySelectStyle(this)">
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
    </div>
    <div class="col-2 pr-5 pl-1">
        <select class="form-select font-size-12 <?= $branchId != "" ? 'select-pimselect' : 'select-pim' ?>"
            id="branch-filter" <?= $companyId == "" ? 'disabled' : '' ?> onchange="applySelectStyle(this)">
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
    </div>
    <div class="col-2 pr-5 pl-1">
        <select class="form-select font-size-12 <?= $teamId != "" ? 'select-pimselect' : 'select-pim' ?>"
            id="team-filter" <?= $branchId == "" ? 'disabled' : '' ?> onchange="applySelectStyle(this)">
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
    </div>
    <div class="col-2 pr-5 pl-1">
        <select class="form-select font-size-12 <?= $month != "" ? 'select-pimselect' : 'select-pim' ?>"
            id="month-filter" onchange="applySelectStyle(this)">
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
    </div>
    <div class="col-2 pr-5 pl-1">
        <select class="form-select font-size-12 <?= $year != "" ? 'select-pimselect' : 'select-pim' ?>" id="year-filter"
            onchange="applySelectStyle(this)">
            <?php
            if (isset($year) && $year != "") { ?>
            <option value="<?= $year ?>"><?= $year ?></option>
            <?php
            }
            ?>
            <option value=""><?= Yii::t('app', 'Year') ?></option>
            <?php
            $yearList = 2022;
            $i = 1;
            while ($i < 20) {
                if ($yearList != $year) {
            ?>
            <option value="<?= $yearList ?>"><?= $yearList ?></option>
            <?php
                }
                $yearList += 1;
                $i++;
            }
            ?>
        </select>
    </div>
    <div class="col-1 pr-5 pl-1">
        <select class="form-select font-size-12 <?= $status != "" ? 'select-pimselect' : 'select-pim' ?>"
            id="status-filter" onchange="applySelectStyle(this)">
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
    </div>
    <div class="col-1 pl-0">
        <span class="btn font-size-12 justify-content-center d-flex align-items-center custom-button-select"
            onclick="javascript:kpiFilterForTeam()">
            <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/FilterWhite.svg" class="pim-search-icons me-2"
                style=" cursor: pointer;" onclick="javascript:kpiFilterForTeam()">
            <?= Yii::t('app', 'Filter') ?>
        </span>
    </div>
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