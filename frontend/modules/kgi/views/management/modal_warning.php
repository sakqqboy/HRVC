<div class="modal fade pr-0 pl-0" id="warning-kgi" tabindex="-1" aria-labelledby="staticBackdrop4Label"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered pr-0 pl-0" style="margin-left:750px;">
        <div class="modal-content" style="border-radius: 8px; padding: 20px;">
            <div class="modal-header" style="border-bottom: none; padding-bottom: 0;">
                <h3 class="modal-title" id="staticBackdrop4Label" style="display: flex; align-items: center;">
                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/warning.svg" alt="Warning"
                        style="width: 24px; height: 24px; margin-right: 8px;">
                    <?= Yii::t('app', 'Mistake Warning') ?>
                </h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-start" style="font-size: 14px; color: #6c757d; padding-top: 10px;">
                <?= Yii::t('app', "There are some teams that have not updated the status to completed yet, in order for to completed, all teams must update the status of this KGI to complete!") ?>.
            </div>
            <div class="modal-footer justify-content-end" style="border-top: none; padding-top: 20px;">
                <a class="btn btn-outline-danger" data-bs-dismiss="modal" aria-label="Close"
                    style="width: 100px; display: flex; align-items: center; justify-content: center; margin-left: 10px;"
                    onmouseover="this.querySelector('.pim-icon').src='<?= Yii::$app->homeUrl ?>images/icons/Settings/binwhite.svg'"
                    onmouseout="this.querySelector('.pim-icon').src='<?= Yii::$app->homeUrl ?>images/icons/Settings/binred.svg'">
                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/binred.svg" alt="Delete" class="pim-icon"
                        style="width: 14px; height: 14px; margin-right: 5px;">
                    <?= Yii::t('app', 'Close') ?>
                </a>
            </div>
        </div>
    </div>
</div>
<style>
/* @media (max-width: 1935px) and (max-height: 950px) {
        .modal-content {
            transform: scale(1) !important;
            transform-origin: top left;
            width: calc(100% / 1);
            
        }

        .modal-dialog {
            transform-origin: top left;
            width: calc(100% / 0.95);
            left: 0;
        }
    } */
</style>