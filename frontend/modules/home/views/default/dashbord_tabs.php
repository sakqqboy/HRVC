<?php
// ดึงเดือนและปีปัจจุบัน
$currentMonth = Yii::t('app', date('F')); // แปลชื่อเดือน
$currentYear = date('Y'); // ปี เช่น 2024
?>
<div class="nav nav-tabs d-flex justify-content-between align-items-center">
    <!-- ข้อความทางซ้าย -->
    <div>
        <h5 class="mb-0" id="header-text">
            <?= Yii::t('app', 'Company of') ?> <?= Yii::t('app', $currentMonth) ?> <?= Yii::t('app', $currentYear) ?></h5>
    </div>
    <!-- แท็บทางขวา -->
    <div class="d-flex pl-10  justify-content-left align-content-center mt-5">
        <a class="pim-type-tab-selected rounded-top-left justify-content-center align-items-center" id="company-tab" data-bs-toggle="tab" role="tab" aria-controls="company"
            aria-selected="true"
            onclick="updateHeader('<?= Yii::t('app', 'Company') ?>','company-tab'); loadCompanyTap(<?= $companyId ?>); return false;">
            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/company.svg"
                alt="<?= Yii::t('app', 'Company') ?>" class="mr-5">
            <?= Yii::t('app', 'Company') ?>
        </a>

        <a class="pim-type-tab justify-content-center align-items-center" id="team-tab" data-bs-toggle="tab" role="tab" aria-controls="team" aria-selected="false"
            onclick="updateHeader('<?= Yii::t('app', 'Team') ?>','team-tab'); loadTeamTap(<?= $teamId ?>); return false;">
            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/team.svg" alt="<?= Yii::t('app', 'Team') ?>" class="mr-5">
            <?= Yii::t('app', 'Team') ?>
        </a>

        <a class="pim-type-tab justify-content-center align-items-center" id="self-tab" data-bs-toggle="tab" role="tab" aria-controls="self" aria-selected="false"
            onclick="updateHeader('<?= Yii::t('app', 'Self') ?>','self-tab'); loadSelfTap(<?= $employeeId ?>); return false;">
            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/self.svg" alt="<?= Yii::t('app', 'Self') ?>" class="mr-5">
            <?= Yii::t('app', 'Self') ?>
        </a>
    </div>

</div>

<!-- Tab Content -->
<div class="tab-content">
    <div class="tab-pane fade show active" role="tabpanel" id="tab-content-container">

    </div>
</div>
<input type="hidden" id="currentTab" value="company-tab">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>

<script>
    $(window).on('load', function() {
        loadCompanyTap(<?= $companyId ?>);
    });

    function updateHeader(tabName, tabId) {
        const headerText = document.getElementById('header-text');
        const currentDate = new Date();
        const currentMonth = currentDate.toLocaleString('default', {
            month: 'long'
        });
        const currentYear = currentDate.getFullYear();
        let currentTab = document.getElementById("currentTab");

        document.getElementById(currentTab.value).classList.remove("pim-type-tab-selected");
        document.getElementById(currentTab.value).classList.add("pim-type-tab");
        document.getElementById(tabId).classList.add("pim-type-tab-selected");
        currentTab.value = tabId;
        // อัปเดตข้อความ
        headerText.textContent = `${tabName} <?= Yii::t('app', 'of') ?> ${currentMonth} ${currentYear}`;
    }
</script>