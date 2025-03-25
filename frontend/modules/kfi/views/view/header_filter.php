<div class="alert alert-white-4">
    <div class="row header-filter-pim">
        <div class="col-8 ">
            <div style="display: inline-flex; align-items: center; gap: 19px;">
                <div class="    text-center">
                    <a href="<?= Yii::$app->homeUrl ?>kfi/management/grid" class="header-kfi-active">
                        <span>
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/black-icons/FinancialSystem/KFI.svg"
                                class="home-icon mr-5">
                        </span>
                        <?= Yii::t('app', 'Key Financial Indicator') ?>
                    </a>
                </div>
                <div class=" border-left  border-right text-center">
                    <a href="<?= Yii::$app->homeUrl ?>kgi/management/grid" class="header-kfi">
                        <span>
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/black-icons/FinancialSystem/KGI.svg"
                                class="home-icon mr-5">
                        </span>
                        <?= Yii::t('app', 'Key Goal Indicator') ?>
                    </a>
                </div>
                <div class="   text-center">
                    <a href="<?= Yii::$app->homeUrl ?>kpi/management/grid" class="header-kfi">
                        <span>
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/black-icons/FinancialSystem/KPI.svg"
                                class="home-icon mr-5">
                        </span>
                        <?= Yii::t('app', 'Key Performance Indicator') ?>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-2 text-end">
            <div class="col-12 pt-13">
                <?php
                if ($role >= 4) {
                ?>
                <!-- <a href="<?= Yii::$app->homeUrl ?>kfi/management/assign-kfi" class="nav-link text-dark" id="pills-Setting-tab" type="button" role="tab" aria-controls="pills-Action" aria-selected="false">
						Assign and approval
					</a> -->
                <?php
                }
                ?>
            </div>
        </div>
    </div>
</div>