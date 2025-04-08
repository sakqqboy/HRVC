<div class="alert alert-white-4">
    <div class="row header-filter-pim">
        <div class="col-8 ">
            <div style="display: inline-flex; align-items: center; gap: 19px;">
                <div class=" text-center">
                    <a href="<?= Yii::$app->homeUrl ?>kfi/management/grid" class="header-kfi-active">
                        <span>
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/black-icons/FinancialSystem/Group289864.png"
                                class="home-icon mr-5">
                        </span>
                        <?= Yii::t('app', 'Key Financial Indicator') ?>
                    </a>
                </div>
                <div class="  border-left text-center">
                    <a href="<?= Yii::$app->homeUrl ?>kgi/management/grid" class="header-kfi">
                        <span>
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/black-icons/FinancialSystem/Vector-1.png"
                                class="home-icon mr-5">
                        </span>
                        <?= Yii::t('app', 'Key Goal Indicator') ?>
                    </a>
                </div>
                <div class=" border-left text-center">
                    <a href="<?= Yii::$app->homeUrl ?>kpi/management/grid" class="header-kfi">
                        <span>
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/KPI.png" class="home-icon mr-5">
                        </span>
                        <?= Yii::t('app', 'Key Performance Indicator') ?>
                    </a>
                </div>
            </div>
        </div>

    </div>
</div>