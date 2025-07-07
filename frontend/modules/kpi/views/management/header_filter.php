<div class="d-flex header-filter-pim mt-15">
    <div class="pim-head-upderline d-flex align-items-start justify-content-between">
        <div class="pim-type-box" style="min-width:206px;">
            <a href="<?= Yii::$app->homeUrl ?>kfi/management/grid" style="text-decoration: none;color: #30313D;">
                <span>
                    <img src="<?= Yii::$app->homeUrl ?>images/icons/black-icons/FinancialSystem/KFI.svg"
                        class="mr-5 pim-filter-head-icon">
                </span>
                <?= Yii::t('app', 'Key Financial Indicator') ?>
            </a>
        </div>
        <div class="pim-center-line"></div>
        <div class="pim-type-box" style="min-width:182px;">
            <a href="<?= Yii::$app->homeUrl ?>kgi/management/grid" style="text-decoration: none;color: #3C3D48;">
                <span>
                    <img src="<?= Yii::$app->homeUrl ?>images/icons/black-icons/FinancialSystem/KGI.svg"
                        class="mr-5 pim-filter-head-icon">
                </span>
                <?= Yii::t('app', 'Key Goal Indicator') ?>
            </a>
        </div>
        <div class="pim-center-line"></div>
        <div class="header-kpi-active">
            <a href="<?= Yii::$app->homeUrl ?>kpi/management/grid" style="text-decoration: none;color: #30313D;">
                <span>
                    <img src="<?= Yii::$app->homeUrl ?>images/icons/black-icons/FinancialSystem/KPI.svg"
                        class="mr-5 pim-filter-head-icon">
                </span>
                <?= Yii::t('app', 'Key Performance Indicator') ?>
            </a>
        </div>
    </div>
    <div class="d-flex flex-grow-1 pim-head-upderline2 align-items-center justify-content-end">
        <div class="pim-head-company align-content-center">All Companies</div>
        <div class="pim-center-line"></div>
        <div class="pim-head-branch align-content-center">39 Branches, Multiple Countries</div>
    </div>
</div>