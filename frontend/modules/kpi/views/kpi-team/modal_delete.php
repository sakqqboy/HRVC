<style>
.delete-btn .pim-icon {
    content: url('<?= Yii::$app->homeUrl ?>images/icons/Settings/binred.svg');
    transition: 0.2s;
}

.delete-btn:hover .pim-icon {
    content: url('<?= Yii::$app->homeUrl ?>images/icons/Settings/binwhite.svg');
}
</style>
<div class="modal fade" id="delete-kpi-team" tabindex="-1" aria-labelledby="staticBackdrop4Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 8px; padding: 20px;">
            <div class="modal-header" style="border-bottom: none; padding-bottom: 0;">
                <h3 class="modal-title" id="staticBackdrop4Label" style="display: flex; align-items: center;">
                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/warning.svg" alt="Warning"
                        style="width: 24px; height: 24px; margin-right: 8px;">
                    <?= Yii::t('app', 'Deletion Warning') ?>
                </h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-start" style="font-size: 14px; color: #6c757d; padding-top: 10px;">
                <?= Yii::t('app', 'Deleting this KPI will remove all assigned employee teams and their history. You can recover this
                data within 7 working days. To restore it, please contact the system administrator') ?>.
            </div>
            <div class="modal-footer justify-content-end" style="border-top: none; padding-top: 20px;">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal"
                    style="width: 100px; display: flex; align-items: center; justify-content: center;">
                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/cancle.svg" alt="Cancel"
                        style="width: 14px; height: 14px; margin-right: 5px;">
                    <?= Yii::t('app', 'Cancel') ?>
                </button>
                <input type="hidden" id="kpiTeamId-modal" value="">
                <button type="button" class="btn btn-outline-danger delete-btn"
                    style="width: 100px; display: flex; align-items: center; justify-content: center; margin-left: 10px;"
                    onclick="deleteKpiTeam()">
                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/binred.svg" alt="Delete" class="pim-icon"
                        style="width: 14px; height: 14px; margin-right: 5px;">
                    <?= Yii::t('app', 'Delete') ?>
                </button>

            </div>
        </div>
    </div>
</div>

<script>
var deleteModal = document.getElementById('delete-kpi-team');
deleteModal.addEventListener('show.bs.modal', function(event) {
    var button = event.relatedTarget; // ปุ่มที่กด
    var kpiTeamId = button.getAttribute('data-id'); // ดึงค่า data-id
    document.getElementById('kpiTeamId-modal').value = kpiTeamId;
});
</script>