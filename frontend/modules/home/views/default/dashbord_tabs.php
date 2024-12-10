<div class="nav nav-tabs d-flex justify-content-between align-items-center">
    <!-- คำทางซ้าย -->
    <div>
        <h5 class="mb-0">Team of December 2024</h5>
    </div>
    <!-- แท็บทางขวา -->
    <ul class="nav nav-tabs dashboard-tabs justify-content-end" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="company-tab" data-bs-toggle="tab" role="tab" aria-controls="company"
                aria-selected="true" onclick="loadCompanyTap(<?= $companyId ?>); return false;">
                <img src="<?=Yii::$app->homeUrl?>images/icons/Settings/company.svg" alt="Company" class="pim-icon"
                    style="width: 14px; height: 14px; padding-bottom: 4px; margin-top: 5px">Company
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="team-tab" data-bs-toggle="tab" role="tab" aria-controls="team" aria-selected="false"
                onclick="loadTeamTap(<?= $companyId ?>, <?= $teamId ?>); return false;">
                <img src="<?=Yii::$app->homeUrl?>images/icons/Settings/team.svg" alt="Team" class="pim-icon"
                    style="width: 13px; height: 13px; padding-bottom: 2px; margin-top: 2px"> Team
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="self-tab" data-bs-toggle="tab" role="tab" aria-controls="self" aria-selected="false"
                onclick="loadSelfTap(<?= $companyId ?>, <?= $teamId ?>, <?= $employeeId ?>); return false;">
                <img src="<?=Yii::$app->homeUrl?>images/icons/Settings/self.svg" alt="Self" class="pim-icon"
                    style="width: 13px; height: 13px; padding-bottom: 3px; margin-top: 2px"> Self
            </a>
        </li>
    </ul>
</div>

<!-- Tab Content -->
<!-- Tab Content -->
<div class="tab-content">
    <div class="tab-pane fade show active" role="tabpanel" id="tab-content-container">

    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(window).on('load', function() {
    loadCompanyTap(<?= $companyId ?>);
});
</script>