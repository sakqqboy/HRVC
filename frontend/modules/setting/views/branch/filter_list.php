<div style="display: flex; justify-content: flex-end; gap: 16px; align-items: center; width: 100%;">

    <select id="countrySelect" class="form-select font-size-12 select-pim" style="border-left: none;" required>
        <option value="" disabled <?= empty($selectedCountryId) ? 'selected' : '' ?> hidden
            style="color: var(--Helper-Text, #8A8A8A);">
            <?= Yii::t('app', 'Country') ?>
        </option>
        <?php foreach ($countries as $countryId => $country) : ?>
        <option value="<?= $countryId ?>" <?= $countryIdOld == $countryId ? 'selected' : '' ?>>
            <?= $country ?>
        </option>
        <?php endforeach; ?>
    </select>

    <span class="btn font-size-12 justify-content-center d-flex align-items-center custom-button-select"
        onclick="filterCountryBranch('<?=$page?>')" style="flex: 1; text-align: center; cursor: pointer;">
        <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/FilterWhite.svg" class="pim-search-icons me-2">
        <?= Yii::t('app', 'Filter') ?>
    </span>

</div>