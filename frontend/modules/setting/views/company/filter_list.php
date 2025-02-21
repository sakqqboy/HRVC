<div style="display: flex; justify-content: flex-end; gap: 16px; align-items: center; width: 100%;">
    <select class="form-select font-size-12 select-pim" id="company-filter" onchange="applySelectStyle(this)"
        style="flex: 1;">
        <option value=""><?= Yii::t('app', 'Employee') ?></option>
        <option value=""><?= Yii::t('app', 'Employee') ?></option>

    </select>

    <select class="form-select font-size-12 select-pim" id="branch-filter" disabled onchange="applySelectStyle(this)"
        style="flex: 1;">
        <option value=""><?= Yii::t('app', 'Tokyo Co..') ?></option>
        <option value=""><?= Yii::t('app', 'Tokyo Co..') ?></option>

    </select>

    <select class="form-select font-size-12 select-pim" id="month-filter" onchange="applySelectStyle(this)"
        style="flex: 1;">
        <option value=""><?= Yii::t('app', 'Thailand') ?></option>
        <option value=""><?= Yii::t('app', 'Thailand') ?></option>

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