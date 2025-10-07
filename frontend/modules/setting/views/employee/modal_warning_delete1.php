<div class="modal fade" id="warning-delete-employee1" tabindex="-1" aria-labelledby="staticBackdrop4Label"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 8px; padding:20px;">
            <div style="width: 100%;">
                <span class="modal-title" id="staticBackdrop4Label"
                    style="display: flex;float:left;font-size:24px;font-weight:500;">
                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/warning.svg" alt="Warning" class="me-2">
                    <?= Yii::t('app', 'Deletion Warning') ?>
                </span>
            </div>
            <div class="modal-body text-start pr-0" style="font-size: 14px; color: #6c757d; padding-top: 10px;">
                <?= Yii::t('app', "You are about to delete the employee. If you proceed, all associated data will also be permanently deleted 
				from the system and cannot be retrieved. This action is irreversible. Do you want to continue?") ?>
            </div>
            <div class="d-flex justify-content-end" style="width:100%;border-top: none; padding-top: 20px;">
                <a href="javascript:void(0);"
                    class="btn btn-primary me-3 d-flex justify-content-center align-content-center"
                    data-bs-dismiss="modal" aria-label="Close" style="min-width: 100px;font-weight:500;">
                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/close-white.svg" class="me-2">
                    <?= Yii::t('app', 'Cancel') ?>
                </a>
                <a href="javascript:void(0);" class="d-flex btn btn-outline-danger"
                    style="min-width: 100px;font-weight:500;" onclick="javascript:deleteEmployee()"
                    onmouseover="this.querySelector('.confirm-delete').src='<?= Yii::$app->homeUrl ?>images/icons/Settings/binwhite.svg'"
                    onmouseout="this.querySelector('.confirm-delete').src='<?= Yii::$app->homeUrl ?>images/icons/Settings/bin.svg'">
                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/bin.svg" class="me-2 confirm-delete">
                    <?= Yii::t('app', 'Delete') ?>
                </a>
            </div>
        </div>
    </div>
    <input type="hidden" id="delete1-employee" value="">
</div>