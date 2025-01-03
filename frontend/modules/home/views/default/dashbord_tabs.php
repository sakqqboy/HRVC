<?php
// ดึงเดือนและปีปัจจุบัน
$currentMonth = Yii::t('app', date('F')); // แปลชื่อเดือน
$currentYear = date('Y'); // ปี เช่น 2024
?>
<div class="nav nav-tabs d-flex justify-content-between align-items-center">
    <!-- ข้อความทางซ้าย -->
    <div>
        <h5 class="mb-0" id="header-text">
            <?= Yii::t('app', 'Company of {month} {year}', ['month' => $currentMonth, 'year' => $currentYear]) ?></h5>
    </div>
    <!-- แท็บทางขวา -->
    <ul class="nav nav-tabs dashboard-tabs justify-content-end" role="tablist">
        <li class="nav-item rounded-top-left">
            <a class="nav-link active" id="company-tab" data-bs-toggle="tab" role="tab" aria-controls="company"
                aria-selected="true"
                onclick="updateHeader('<?= Yii::t('app', 'Company') ?>'); loadCompanyTap(<?= $companyId ?>); return false;">
                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/company.svg"
                    alt="<?= Yii::t('app', 'Company') ?>" class="pim-icon"
                    style="width: 14px; height: 14px; padding-bottom: 4px; margin-top: 5px">
                <?= Yii::t('app', 'Company') ?>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="team-tab" data-bs-toggle="tab" role="tab" aria-controls="team" aria-selected="false"
                onclick="updateHeader('<?= Yii::t('app', 'Team') ?>'); loadTeamTap(<?= $teamId ?>); return false;">
                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/team.svg" alt="<?= Yii::t('app', 'Team') ?>"
                    class="pim-icon" style="width: 13px; height: 13px; padding-bottom: 2px; margin-top: 2px">
                <?= Yii::t('app', 'Team') ?>
            </a>
        </li>
        <li class="nav-item rounded-top-right">
            <a class="nav-link" id="self-tab" data-bs-toggle="tab" role="tab" aria-controls="self" aria-selected="false"
                onclick="updateHeader('<?= Yii::t('app', 'Self') ?>'); loadSelfTap(<?= $employeeId ?>); return false;">
                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/self.svg" alt="<?= Yii::t('app', 'Self') ?>"
                    class="pim-icon" style="width: 13px; height: 13px; padding-bottom: 3px; margin-top: 2px">
                <?= Yii::t('app', 'Self') ?>
            </a>
        </li>
    </ul>
</div>

<!-- Tab Content -->
<div class="tab-content">
    <div class="tab-pane fade show active" role="tabpanel" id="tab-content-container">

    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>

<script>
$(window).on('load', function() {
    loadCompanyTap(<?= $companyId ?>);
});

function updateHeader(tabName) {
    const headerText = document.getElementById('header-text');
    const currentDate = new Date();
    const currentMonth = currentDate.toLocaleString('default', {
        month: 'long'
    });
    const currentYear = currentDate.getFullYear();

    // อัปเดตข้อความ
    headerText.textContent = `${tabName} <?= Yii::t('app', 'of') ?> ${currentMonth} ${currentYear}`;
}
</script>