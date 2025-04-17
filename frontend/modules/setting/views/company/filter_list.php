<div style="display: flex; justify-content: flex-end; gap: 16px; align-items: center; width: 100%;">

    <select class="form-select font-size-12 select-pim" style="border-left: none;" name="country" required>
        <option value="" disabled selected hidden style="color: var(--Helper-Text, #8A8A8A);
                                                ">
            <?= Yii::t('app', 'Country') ?>
        </option>
        <?php foreach ($countries as $countryId => $country) : ?>
        <option value="<?= $countryId ?>"><?= $country ?></option>
        <?php endforeach; ?>
    </select>

    <span class="btn font-size-12 justify-content-center d-flex align-items-center custom-button-select"
        style="flex: 1; text-align: center;" onclick="">
        <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/FilterWhite.svg" class="pim-search-icons me-2"
            style="cursor: pointer;">
        <?= Yii::t('app', 'Filter') ?>
    </span>

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