<div style="display: flex; justify-content: flex-end; gap: 16px; align-items: center; width: 100%;">
    <select id="companySelect" class="form-select font-size-12 select-pim" style="border-left: none;" required>
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
    </select>

    <span class="btn font-size-12 justify-content-center d-flex align-items-center custom-button-select"
        onclick="filterTitle('<?= $page ?>')" style="flex: 1; text-align: center; cursor: pointer;">
        <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/FilterWhite.svg" class="pim-search-icons me-2">
        <?= Yii::t('app', 'Filter') ?>
    </span>

</div>