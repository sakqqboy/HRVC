<?php

use common\models\ModelMaster;
use frontend\models\hrvc\Branch;
use frontend\models\hrvc\Company;
?>
<select class="select-pim form-select" id="company-filter" onchange="applySelectStyle(this)">
    <?php
    if (isset($companyId) && $companyId != "") { ?>
        <option value="<?= $companyId ?>"><?= Company::companyName($companyId) ?></option>
    <?php
    }
    if ($role > 4) {
    ?>
        <option value=""><?= Yii::t('app', 'Company') ?></option>
        <?php
        if (isset($companies) && count($companies) > 0) {
            foreach ($companies as $company) :

        ?>
                <option value="<?= $company['companyId'] ?>"><?= $company['companyName'] ?></option>
                <?php

                ?>

    <?php
            endforeach;
        }
    }
    ?>
</select>

<select class="select-pim form-select" id="branch-filter" <?= $companyId == "" ? 'disabled' : '' ?> onchange="applySelectStyle(this)">
    <?php
    if (isset($branchId) && $branchId != "") { ?>
        <option value="<?= $branchId ?>"><?= Branch::branchName($branchId) ?></option>
    <?php
    }
    ?>
    <option value="">Branch</option>
    <?php
    if (isset($branches) && count($branches) > 0) {
        foreach ($branches as $branch) : ?>
            <option value="<?= $branch['branchId'] ?>"><?= $branch['branchName'] ?></option>
    <?php
        endforeach;
    }
    ?>
</select>

<select class="select-pim form-select" id="month-filter" onchange="applySelectStyle(this)">
    <?php
    if (isset($month) && $month != "") { ?>
        <option value="<?= $month ?>"><?= Yii::t('app', ModelMaster::monthFull()[$month]) ?></option>
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


<select class="select-pim form-select" id="year-filter" onchange="applySelectStyle(this)">
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
<select class="select-pim form-select" id="status-filter" onchange="applySelectStyle(this)">
    <option value=""><?= Yii::t('app', 'Status') ?></option>
    <option value="1"><?= Yii::t('app', 'In Progress') ?></option>
    <option value="3"><?= Yii::t('app', 'Due Passed') ?></option>
    <option value="4"><?= Yii::t('app', 'Not Set') ?></option>
    <option value="2"><?= Yii::t('app', 'Completed') ?></option>
</select>
<span class="justify-content-center d-flex align-items-center employee-filter-btn" style="cursor: pointer;"
    onclick="javascript:kfiFilter()">
    <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/FilterWhite.svg" class="pim-search-icons me-1">
    <?= Yii::t('app', 'Filter') ?>
</span>
<div class="btn-group <?= (Yii::$app->controller->action->id == 'draft' || Yii::$app->controller->action->id == 'draft-result') ? 'd-none' : '' ?>" role="group">
    <?php
    if ($page == 'grid') { ?>
        <a href="#" class="btn btn-primary font-size-12 pim-change-modes">
            <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/gridwhite.svg" style="cursor: pointer; margin-top:2px;">
        </a>
        <a href="<?= Yii::$app->homeUrl . 'kfi/management/index' ?>"
            class="btn btn-outline-primary font-size-12 pim-change-modes" style="border-color: #CBD5E1 !important;">
            <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/listblack.svg" style="cursor: pointer; margin-top:2px;">
        </a>
    <?php
    } else { ?>
        <a href="<?= Yii::$app->homeUrl . 'kfi/management/grid' ?>"
            class="btn btn-outline-primary font-size-12 pim-change-modes" style="border-color: #CBD5E1 !important;">
            <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/gridblack.svg" style="cursor: pointer; margin-top:2px;">
        </a>
        <a href="#" class="btn btn-primary font-size-12 pim-change-modes">
            <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/listwhite.svg" style="cursor: pointer; margin-top:2px;">
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