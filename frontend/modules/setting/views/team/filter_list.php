<?php

use common\models\ModelMaster;
use frontend\models\hrvc\Branch;
use frontend\models\hrvc\Company;
use frontend\models\hrvc\Department;
use frontend\models\hrvc\Employee;
use frontend\models\hrvc\Team;

?>
<div style="display: flex; justify-content: flex-end; gap: 16px; align-items: center; width: 100%;">

    <select class="form-select font-size-12 <?= !empty($companyIdOld) ? 'select-pimselect' : 'select-pim' ?>"
        id="company-filter" onchange="applySelectStyle(this)">
        <?php
            if (!empty($companyIdOld)) { ?>
        <option value="<?= $companyIdOld ?>"><?= Company::companyName($companyIdOld) ?></option>
        <?php
            $branches = Branch::branchInCompany($companyIdOld);
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

    <select class="form-select font-size-12 <?= !empty($branchIdOld) ? 'select-pimselect' : 'select-pim' ?>"
        id="branch-filter" <?= empty($companyIdOld) ? 'disabled' : '' ?> onchange="applySelectStyleGroup(this)">
        <?php
            if (!empty($branchIdOld)) { 
        ?>
        <option value="<?= $branchIdOld ?>"><?= Branch::branchName($branchIdOld) ?></option>
        <?php
                $departments = Department::departmentInBranch($branchIdOld);
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

    <select class="form-select font-size-12 <?= !empty($departmentIdOld) ? 'select-pimselect' : 'select-pim' ?>"
        id="department-filter" <?= empty($branchIdOld) ? 'disabled' : '' ?> onchange="applySelectStyle(this)">
        <?php if (!empty($departmentIdOld)) : ?>
        <option value="<?= $departmentIdOld ?>"><?= Department::departmentName($departmentIdOld) ?></option>
        <?php endif; ?>

        <option value=""><?= Yii::t('app', 'Department') ?></option>

        <?php foreach ($departments as $department) : ?>
        <option value="<?= $department['departmentId'] ?>">
            <?= $department['departmentName'] ?>
        </option>
        <?php endforeach; ?>
    </select>

    <!-- 
    <span class="btn font-size-12 justify-content-center d-flex align-items-center custom-button-select"
        onclick="filterTeam('<?= $page ?>')" style="flex: 1; text-align: center; cursor: pointer;">
        <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/FilterWhite.svg" class="pim-search-icons me-2">
        <?= Yii::t('app', 'Filter') ?>
    </span> -->

    <span class="justify-content-center d-flex align-items-center employee-filter-btn" style="cursor: pointer;"
        onclick="filterTeam('<?= $page ?>')">
        <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/FilterWhite.svg" class="pim-search-icons me-1">
        Filter
    </span>

</div>