<div class="schedule-card p-3">
    <div class="tab-Navigation">
        <!-- Navigation -->
        <ul class="nav nav-pills schedule-tabs mb-3" role="tablist">
            <li class="col-6 nav-item text-center">
                <a class="nav-link active" id="upcoming-schedule-tab" data-bs-toggle="tab" href="#upcoming-schedule"
                    role="tab" aria-controls="upcoming-schedule" aria-selected="true">
                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/calendar-time.svg" alt="Company"
                        class="pim-icon" style="width: 14px; height: 14px;">
                    <?= Yii::t('app', 'Upcoming Schedule') ?>
                </a>
            </li>
            <li class="col-6 nav-item text-center">
                <a class="nav-link" id="pending-approvals-tab" data-bs-toggle="tab" href="#pending-approvals" role="tab"
                    aria-controls="pending-approvals" aria-selected="false">
                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/3person.svg" alt="Company" class="pim-icon"
                        style="width: 14px; height: 14px;">
                    <?= Yii::t('app', 'Pending Approvals') ?>
                </a>
            </li>
        </ul>
    </div>

    <div class="tab-content">
        <!-- Upcoming Schedule -->
        <div class="tab-pane fade show active fade" id="upcoming-schedule" role="tabpanel"
            aria-labelledby="upcoming-schedule-tab">
            <?= $this->render('upcoming') ?>

        </div>

        <!-- Pending Approvals -->
        <div class="tab-pane fade " id="pending-approvals" role="tabpanel" aria-labelledby="pending-approvals-tab">
            <?= $this->render('waiting_approval', [
                'pendingApprove' => $pendingApprove
            ]) ?>

        </div>
    </div>
</div>
<!-- View All button -->
<div class="text-ViewAllbutton">
    <a href="#" class="view-all-link"><?= Yii::t('app', 'View All') ?> </a>
</div>