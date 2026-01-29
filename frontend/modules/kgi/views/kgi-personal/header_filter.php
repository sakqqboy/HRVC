<?php
if (!isset($page)) {
    $page = 'grid';
}
?>
<div class="d-flex header-filter-pim">
    <div class="pim-head-upderline d-flex align-items-start justify-content-start">
        <div class="pim-type-box" style="min-width:206px;">
            <a href="<?= Yii::$app->homeUrl ?>kfi/management/<?= $page == 'grid' ? 'grid' : 'index' ?>" style="text-decoration: none;color: #30313D;">
                <span>
                    <img src="<?= Yii::$app->homeUrl ?>images/icons/black-icons/FinancialSystem/KFI.svg"
                        class="mr-5 pim-filter-head-icon">
                </span>
                <?= Yii::t('app', 'Key Financial Indicator') ?>
            </a>
        </div>
        <div class="pim-center-line"></div>
        <div class="header-kgi-active">
            <a style="text-decoration: none;color: #3C3D48;">
                <span>
                    <img src="<?= Yii::$app->homeUrl ?>images/icons/black-icons/FinancialSystem/KGI.svg"
                        class="mr-5 pim-filter-head-icon">
                </span>
                <?= Yii::t('app', 'Key Goal Indicator') ?>
            </a>
        </div>
        <div class="pim-center-line"></div>
        <div class="pim-type-box" style="min-width:235px;">
            <a href="<?= Yii::$app->homeUrl ?>kpi/kpi-personal/<?= $page == 'grid' ? 'individual-kpi-grid' : 'individual-kpi' ?>" style="text-decoration: none;color: #30313D;">
                <span>
                    <img src="<?= Yii::$app->homeUrl ?>images/icons/black-icons/FinancialSystem/KPI.svg"
                        class="mr-5 pim-filter-head-icon">
                </span>
                <?= Yii::t('app', 'Key Performance Indicator') ?>
            </a>
        </div>
    </div>
    <div class="d-flex flex-grow-1 pim-head-upderline2 align-items-center justify-content-end">
        <div class="pim-head-company align-content-center">
            <?php if (isset($companyPic) && count($companyPic) > 0) {
                $i = 0;
                foreach ($companyPic as $picture): ?>
                    <img src="<?= Yii::$app->homeUrl . $picture ?>" class="pim-header-pic <?= $i > 0 ? 'pim-head-pic-after' : '' ?>">
            <?php
                    $i++;
                endforeach;
            } ?>
            <div class="pim-head-num-tag pim-head-pic-after me-1"><?= $allCompany ?></div>

            <span><?= Yii::t('app', 'All Companies') ?> </span>
        </div>
        <div class="pim-center-line"></div>
        <div class="pim-head-branch">
            <img src="<?= Yii::$app->homeUrl ?>images/icons/pim/global.svg" class="me-1">
            <?= $totalBranch ?><?= Yii::t('app', 'Branches') ?>, <?= Yii::t('app', 'Multiple Countries') ?>
        </div>
    </div>
</div>