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
        <select class="form-select font-size-12 <?= $branchId != "" ? 'select-pimselect' : 'select-pim' ?>" id="branch-filter"
            <?= $branchId == "" ? 'disabled' : '' ?> onchange="applySelectStyle(this)">
            <?php
            if (isset($branchId) && $branchId != "") { ?>
                <option value="<?= $branchId ?>"><?= Branch::branchName($branchId) ?></option>
            <?php
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
                    <option value="<?= $value ?>"><?= $month ?></option>
            <?php
                endforeach;
            }
            ?>
        </select>
    </div>
    <div class="col-2 pr-5 pl-1">
        <select class="form-select font-size-12 <?= $yearSelected != "" ? 'select-pimselect' : 'select-pim' ?>"
            id="year-filter" onchange="applySelectStyle(this)">
            <?php
            if (isset($yearSelected) && $yearSelected != "") { ?>
                <option value="<?= $yearSelected ?>"><?= $yearSelected ?></option>
            <?php
            }
            ?>
            <option value=""><?= Yii::t('app', 'Year') ?></option>
            <?php
            $year = 2022;
            $i = 1;
            while ($i < 20) {
                if ($year != $yearSelected) {
            ?>
                    <option value="<?= $year ?>"><?= $year ?></option>
            <?php
                }
                $year += 1;
                $i++;
            }
            ?>
        </select>
    </div>
    <div class="col-2 pr-1 pl-1">
        <select class="form-select font-size-12 <?= $status != "" ? 'select-pimselect' : 'select-pim' ?>" id="status-filter"
            onchange="applySelectStyle(this)">
            <?php
            if (isset($status) && $status != "") { ?>
                <option value="<?= $status ?>"><?= $status == 1 ? Yii::t('app', "Active") : Yii::t('app', 'Finished') ?></option>
            <?php
            }
            ?>
            <option value=""><?= Yii::t('app', 'Status') ?></option>
            <option value="1"><?= Yii::t('app', 'Active') ?></option>
            <option value="2"><?= Yii::t('app', 'Finished') ?></option>
        </select>
    </div>

    <div class="col-2 pr-0 text-start">
        <span class="btn font-size-12 justify-content-center d-flex align-items-center custom-button-select"
            onclick="javascript:kgiFilter()">
            <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/FilterWhite.svg" class="pim-search-icons me-2"
                style="cursor: pointer;">
            <?= Yii::t('app', 'Filter') ?>
        </span>
        <!-- </div> -->
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