<div class="modal fade pr-0 pl-0" id="warning-kpi" tabindex="-1" aria-labelledby="staticBackdrop4Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered pr-0 pl-0" style="margin-left:750px;">
        <div class="modal-content" style="border-radius: 8px; padding: 20px; width:800px;">
            <div class="d-flex" style="border-bottom: none; padding-bottom: 0;width:100%">
                <div class="modal-title pull-left font-size-36" id="staticBackdrop4Label" style="display: flex; align-items: center;">
                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/warning.svg" alt="Warning"
                        style="width: 35px; height: 35px; margin-right: 10px;">
                    <?= Yii::t('app', 'Mistake Warning') ?>
                </div>
                <div class="flex-grow-1 align-content-center text-end font-size-24">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

            </div>
            <div class="modal-body text-start mt-20" style="font-size: 24px; color: #6c757d; padding-top: 10px;line-height: 35px;
    letter-spacing: 0.5px;">
                <?= Yii::t('app', "There are some persons in team who have not updated the status to completed yet, in order for to completed, all members must update the status of this personal kgi to complete!") ?>.
            </div>
            <div class="modal-footer text-end w-100 pt-0 pb-0" style="border-top: none;">
                <a class="btn btn-outline-danger text-center pt-0 pb-0" data-bs-dismiss="modal" aria-label="Close"
                    style="width: 100px;text-decoration: none;font-size:26px !important;font-weight:500;">
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