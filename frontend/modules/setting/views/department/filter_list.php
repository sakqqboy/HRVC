<?php

use common\models\ModelMaster;
use frontend\models\hrvc\Branch;
use frontend\models\hrvc\Company;
use frontend\models\hrvc\Employee;
use frontend\models\hrvc\Team;

?>
<div class="d-flex justify-content-end align-items-center  gap-2">

    <select id="countrySelect" class="font-size-12 select-pim" required>
        <option value="" disabled <?= empty($countryIdOld) ? 'selected' : '' ?> hidden
            style="color: var(--Helper-Text, #8A8A8A);">
            <?= Yii::t('app', 'Country') ?>
        </option>
        <option value="" <?= empty($selectedCountryId) === 'all' ? 'selected' : '' ?>>
                <?= Yii::t('app', 'All') ?>
        </option>
        <?php foreach ($countries as $countryId => $country) : ?>
        <option value="<?= $countryId ?>" <?= $countryIdOld == $countryId ? 'selected' : '' ?>>
            <?= $country ?>
        </option>
        <?php endforeach; ?>
    </select>

    <select class=" font-size-12 <?= !empty($companyIdOld) ? 'select-pimselect' : 'select-pim' ?>" id="company-filter"
        onchange="applySelectStyle(this)">
        <?php
        if (!empty($companyIdOld)) { ?>
        <option value="<?= $companyIdOld ?>"><?= Company::companyName($companyIdOld) ?></option>
        <?php
            $branches = Branch::branchInCompany($companyIdOld);
        }
        ?>
        <option value="" disabled <?= empty($companyIdOld) ? 'selected' : '' ?> hidden
            style="color: var(--Helper-Text, #8A8A8A);">
            <?= Yii::t('app', 'Company') ?>
        </option>
        <option value="" <?= empty($selectedCountryId) === 'all' ? 'selected' : '' ?>>
                <?= Yii::t('app', 'All') ?>
        </option>
        <?php
        if (isset($companies) && count($companies) > 0) {
            foreach ($companies as $company) : ?>
        <option value="<?= $company['companyId'] ?>"><?= $company['companyName'] ?></option>
        <?php
            endforeach;
        }
        ?>
    </select>

    <select class="form-select font-size-12 <?= !empty($branchIdOld) ? 'select-pimselect' : 'select-pim' ?>"
        id="branch-filter" <?= empty($companyIdOld) ? 'disabled' : '' ?> onchange="applySelectStyle(this)">
        <?php
        if (!empty($branchIdOld)) {
        ?>
        <option value="<?= $branchIdOld ?>"><?= Branch::branchName($branchIdOld) ?></option>
        <?php
            $teams = Team::teamInBranch($branchIdOld);
        }
        ?>
        <option value="" disabled <?= empty($branchIdOld) ? 'selected' : '' ?> hidden
            style="color: var(--Helper-Text, #8A8A8A);">
            <?= Yii::t('app', 'Branch') ?>
        </option>
        <option value="" <?= empty($selectedCountryId) === 'all' ? 'selected' : '' ?>>
                <?= Yii::t('app', 'All') ?>
        </option>
        <?php
        if (isset($branches) && count($branches) > 0) {
            foreach ($branches as $branch) : ?>
        <option value="<?= $branch['branchId'] ?>"><?= $branch['branchName'] ?></option>
        <?php
            endforeach;
        }
        ?>
    </select>

    <span class="justify-content-center d-flex align-items-center employee-filter-btn" style="cursor: pointer;"
        onclick="filterCountryDepartment('<?= $page ?>')">
        <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/FilterWhite.svg" class="pim-search-icons me-1">
        Filter
    </span>
</div>