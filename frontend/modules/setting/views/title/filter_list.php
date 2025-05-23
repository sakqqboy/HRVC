<?php

use common\models\ModelMaster;
use frontend\models\hrvc\Branch;
use frontend\models\hrvc\Company;
use frontend\models\hrvc\Department;
use frontend\models\hrvc\Employee;
use frontend\models\hrvc\Team;

?>
<div style="display: flex; justify-content: flex-end; gap: 16px; align-items: center; width: 100%;">
    <!-- <select id="companySelect" class="form-select font-size-12 select-pim" style="border-left: none;" required>
        <option value="" disabled <?= empty($companyIdOld) ? 'selected' : '' ?> hidden
            style="color: var(--Helper-Text, #8A8A8A);">
            <?= Yii::t('app', 'Company') ?>
        </option>
        <?php foreach ($companies as $company) : ?>
        <option value="<?= $company['companyId'] ?>" <?= $companyIdOld == $company['companyId'] ? 'selected' : '' ?>>
            <?= $company['companyName'] ?>

        </option>
        <?php endforeach; ?>
    </select>

    <select id="branchSelect" class="form-select font-size-12 select-pim" style="border-left: none;" required>
        <option value="" disabled <?= empty($branchIdOld) ? 'selected' : '' ?> hidden
            style="color: var(--Helper-Text, #8A8A8A);">
            <?= Yii::t('app', 'Branch') ?>
        </option>
        <?php foreach ($branches as $branch) : ?>
        <option value="<?= $branch['branchId'] ?>" <?= $branchIdOld == $branch['branchId'] ? 'selected' : '' ?>>
            <?= $branch['branchName'] ?>
        </option>
        <?php endforeach; ?>
    </select>

    <select id="departmentSelect" class="form-select font-size-12 select-pim" style="border-left: none;" required>
        <option value="" disabled <?= empty($departmentIdOld) ? 'selected' : '' ?> hidden
            style="color: var(--Helper-Text, #8A8A8A);">
            <?= Yii::t('app', 'Department') ?>
        </option>
        <?php foreach ($departments as $department) : ?>
        <option value="<?= $department['departmentId'] ?>"
            <?= $departmentIdOld == $department['departmentId'] ? 'selected' : '' ?>>
            <?= $department['departmentName'] ?>
        </option>
        <?php endforeach; ?>
    </select> -->

    <!-- <select class="form-select font-size-12 <?= !empty($companyIdOld) ? 'select-pimselect' : 'select-pim' ?>"
        id="companySelect" onchange="applySelectStyleGroup(this)">
        <?php if (!empty($companyIdOld)) : ?>
        <option value="<?= $companyIdOld ?>"><?= Company::companyName($companyIdOld) ?></option>
        <?php endif; ?>
        <option value=""><?= Yii::t('app', 'Company') ?></option>
        <?php foreach ($companies as $company) : ?>
        <option value="<?= $company['companyId'] ?>"><?= $company['companyName'] ?></option>
        <?php endforeach; ?>
    </select>

    <select class="form-select font-size-12 <?= !empty($branchIdOld) ? 'select-pimselect' : 'select-pim' ?>"
        id="branchSelect" <?= empty($companyIdOld) ? 'disabled' : '' ?> onchange="applySelectStyleGroup(this)">
        <?php if (!empty($branchIdOld)) : ?>
        <option value="<?= $branchIdOld ?>"><?= Branch::branchName($branchIdOld) ?></option>
        <?php endif; ?>
        <option value=""><?= Yii::t('app', 'Branch') ?></option>
        <?php if (!empty($branches)) :
        foreach ($branches as $branch) : ?>
        <option value="<?= $branch['branchId'] ?>"><?= $branch['branchName'] ?></option>
        <?php endforeach; endif; ?>
    </select>

    <select id="departmentSelect"
        class="form-select font-size-12 <?= !empty($departmentIdOld) ? 'select-pimselect' : 'select-pim' ?>"
        style="border-left: none;" onchange="applySelectStyleGroup(this)" <?= empty($branchIdOld) ? 'disabled' : '' ?>>

        <?php if (!empty($departmentIdOld)) : ?>
        <option value="<?= $departmentIdOld ?>"><?= Department::departmentName($departmentIdOld) ?></option>
        <?php endif; ?>

        <option value=""><?= Yii::t('app', 'Department') ?></option>

        <?php foreach ($departments as $department) : ?>
        <option value="<?= $department['departmentId'] ?>">
            <?= $department['departmentName'] ?>
        </option>
        <?php endforeach; ?>
    </select> -->

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
        id="branch-filter" <?= empty($companyIdOld) ? 'disabled' : '' ?> onchange="applySelectStyle(this)">
        <?php
            if (!empty($branchIdOld)) { 
        ?>
        <option value="<?= $branchIdOld ?>"><?= Branch::branchName($branchIdOld) ?></option>
        <?php
                $teams = Department::departmentInBranch($branchIdOld);
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

    <select id="departmentSelect"
        class="form-select font-size-12 <?= !empty($departmentIdOld) ? 'select-pimselect' : 'select-pim' ?>"
        style="border-left: none;" onchange="applySelectStyle(this)" <?= empty($branchIdOld) ? 'disabled' : '' ?>>

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


    <span class="btn font-size-12 justify-content-center d-flex align-items-center custom-button-select"
        onclick="filterTitle('<?= $page ?>')" style="flex: 1; text-align: center; cursor: pointer;">
        <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/FilterWhite.svg" class="pim-search-icons me-2">
        <?= Yii::t('app', 'Filter') ?>
    </span>

</div>