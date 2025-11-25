<div style="display: flex; justify-content: flex-end; gap: 16px; align-items: center; width: 100%;">

    <select  id="countrySelect" class="font-size-12 select-pim" required>
        <option value="" disabled <?= empty($selectedCountryId) ? 'selected' : '' ?> hidden
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

    <select id="companySelect" class="font-size-12 select-pim" required>
        <option value="" disabled <?= empty($selectedCountryId) ? 'selected' : '' ?> hidden
            style="color: var(--Helper-Text, #8A8A8A);">
            <?= Yii::t('app', 'Company') ?>
        </option>
        <option value="" <?= empty($selectedCountryId) === 'all' ? 'selected' : '' ?>>
                <?= Yii::t('app', 'All') ?>
        </option>
        <?php foreach ($companies as $companyId => $company) : ?>
        <option value="<?= $company['companyId'] ?>">
            <?= $company['companyName'] ?>
        </option>
        <?php endforeach; ?>
    </select>

    <span class="justify-content-center d-flex align-items-center employee-filter-btn" style="cursor: pointer;"
        onclick="filterCountryBranch('<?=$page?>')">
        <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/FilterWhite.svg" class="pim-search-icons me-1">
        Filter
    </span>
</div>