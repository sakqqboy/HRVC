<div class="modal fade" id="staticBackdrop4" tabindex="-1" aria-labelledby="staticBackdrop4Label" aria-hidden="true">
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
                <?= Yii::t('app', 'Deleting this KFI will remove all assigned employee teams and their history. You can recover this
                data within 7 working days. To restore it, please contact the system administrator') ?>.
            </div>
            <div class="modal-footer justify-content-end" style="border-top: none; padding-top: 20px;">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal"
                    style="width: 100px; display: flex; align-items: center; justify-content: center;">
                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/cancle.svg" alt="Cancel"
                        style="width: 14px; height: 14px; margin-right: 5px;">
                    <?= Yii::t('app', 'Cancel') ?>
                </button>
                <input type="hidden" id="kfiId-modal" value="">
                <a href="javascript:deleteKfi()" class="btn btn-outline-danger"
                    style="width: 100px; display: flex; align-items: center; justify-content: center; margin-left: 10px;"
                    onmouseover="this.querySelector('.pim-icon').src='<?= Yii::$app->homeUrl ?>images/icons/Settings/binwhite.svg'"
                    onmouseout="this.querySelector('.pim-icon').src='<?= Yii::$app->homeUrl ?>images/icons/Settings/binred.svg'">
                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/binred.svg" alt="Delete" class="pim-icon"
                        style="width: 14px; height: 14px; margin-right: 5px;">
                    <?= Yii::t('app', 'Delete') ?>
                </a>
            </div>
        </div>
    </div>
</div>


<script>
document.addEventListener("DOMContentLoaded", function() {
    let myModalEl = document.getElementById('staticBackdrop4');

    myModalEl.addEventListener('show.bs.modal', function() {
        let modal = document.querySelector(".modal");
        let backdrop = document.querySelector(".modal-backdrop");

        // ป้องกัน modal จากการโดน scale
        modal.style.transform = "scale(1)";
        modal.style.position = "fixed";
        modal.style.top = "50%";
        modal.style.left = "50%";
        modal.style.transform = "translate(-50%, -50%)";

        // ป้องกัน backdrop จากการโดน scale
        if (backdrop) {
            backdrop.style.transform = "scale(1)";
            backdrop.style.position = "fixed";
            backdrop.style.top = "0";
            backdrop.style.left = "0";
            backdrop.style.width = "100%";
            backdrop.style.height = "100%";
        }

        // ปรับ z-index ให้ modal อยู่บนสุด
        modal.style.zIndex = "1100";
        if (backdrop) {
            backdrop.style.zIndex = "1000";
        }
    });
});
</script>