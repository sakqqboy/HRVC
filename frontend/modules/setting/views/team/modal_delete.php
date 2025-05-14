<div class="modal-dialog modal-dialog-centered">
    <div class="modal-content" style="border-radius: 8px; padding: 20px; align-items: normal; ">
        <div class="modal-header" style="border-bottom: none; padding-bottom: 0;">
            <h3 class="modal-title" id="staticBackdrop4Label">
                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/warning.svg" alt="Warning"
                    style="width: 24px; height: 24px; margin-right: 8px;">
                <?= Yii::t('app', 'Unable to Delete') ?>
            </h3>
            <a type="button" onclick="openCloseModal()" class="btn-close">
            </a>
        </div>
        <div class="modal-body text-start" style="font-size: 14px; color: #6c757d; padding-top: 10px;">
            <?= Yii::t('app', "To delete a department, it must be empty. Please detach all employees and teams from the department in the Teams and Employees sections first.") ?>.
        </div>
        <div class="modal-footer justify-content-end" style="border-top: none; padding-top: 20px;">
            <!-- ปุ่ม Continue -->
            <button type="button" class="btn btn-primary"
                style="width: 100px; display: flex; align-items: center; justify-content: center; background: #2580D3; border: none; color: white;"
                onclick="updateModalContent(<?= $departmentId ?>)">
                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/check-circle.svg" alt="Cancel"
                    style="width: 14px; height: 14px; margin-right: 5px;">
                <?= Yii::t('app', 'Continue') ?>
            </button>
        </div>
    </div>
</div>