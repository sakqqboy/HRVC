<div class="alert alert-white-4">
    <div class="row header-filter-pim">
        <div class="col-8 ">
            <div style="display: inline-flex; align-items: center; gap: 19px;">
                <div class="text-center">
                    <a href="<?= Yii::$app->homeUrl ?>kgi/kgi-team/team-kgi-grid" class="header-kgi-active">
                        <span>
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/black-icons/FinancialSystem/KGI.svg"
                                class="home-icon mr-5">
                        </span>
                        <?= Yii::t('app', 'Key Goal Self Indicator') ?>
                    </a>
                </div>
                <div class=" border-left text-center">
                    <a href="<?= Yii::$app->homeUrl ?>kpi/kpi-team/team-kpi-grid" class="header-kfi">
                        <span>
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/black-icons/FinancialSystem/KPI.svg"
                                class="home-icon mr-5">
                        </span>
                        <?= Yii::t('app', 'Key Performance Self Indicator') ?>
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