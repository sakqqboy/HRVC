<style>
.custom-modal-content {
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
    background-color: #fff;
}
</style>
<div class="modal-dialog modal-dialog-centered">
    <div class="modal-content custom-modal-content" style="border-radius: 8px; padding: 20px; align-items: normal; ">
        <div class="modal-header" style="border-bottom: none; padding-bottom: 0;">
            <h3 class="modal-title" id="staticBackdrop4Label">
                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/warning.svg" alt="Warning"
                    style="width: 24px; height: 24px; margin-right: 8px;">
                <?= Yii::t('app', 'Unable to Delete') ?>
            </h3>
            <a href="javascript:void(0)" class="btn-close" onclick="closeWarningModal()" aria-label="Close"></a>
        </div>
        <div class="modal-body text-start" style="font-size: 14px; color: #6c757d; padding-top: 10px;">
            <?= Yii::t('app', "To delete a itle, it must be empty. Please detach all employees from the itle from the employee list first.") ?>.
        </div>
        <div class="modal-footer justify-content-end" style="border-top: none; padding-top: 20px;">
            <!-- ปุ่ม Continue -->
            <button type="button" class="btn btn-primary"
                style="width: 100px; display: flex; align-items: center; justify-content: center; background: #2580D3; border: none; color: white;"
                onclick="updateTitleModalContent('<?= $titleId ?>','<?= $preUrl ?>')">
                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/check-circle.svg" alt="Cancel"
                    style="width: 14px; height: 14px; margin-right: 5px;">
                <?= Yii::t('app', 'Continue') ?>
            </button>
        </div>
    </div>
</div>