<!-- <div class="modal fade" id="delete-kgi-team" tabindex="-1" aria-labelledby="staticBackdrop5" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="border-bottom:none;">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="col-12 delete-Backdrop4">
                    Are you sure you want to do this?
                </div>
            </div>
            <div class="row text-center mt-20" style="border-bottom:none;">
                <div class="col-6 text-end">
                    <button type="button" class="btn btn-primary" style="width: 100px;"
                        data-bs-dismiss="modal">Cancel</button>
                </div>
                <div class="col-6 text-start">
                    <input type="hidden" id="kgiTeamId-modal" value="">
                    <a href="javascript:deleteKgiTeam()" class="btn btn-danger" style="width: 100px;">Delete</a>
                    <div class="mt-40"></div>
                </div>
            </div>
        </div>
    </div>
</div> -->


<div class="modal fade" id="delete-kgi-team" tabindex="-1" aria-labelledby="staticBackdrop4Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 8px; padding: 20px;">
            <div class="modal-header" style="border-bottom: none; padding-bottom: 0;">
                <h3 class="modal-title" id="staticBackdrop4Label" style="display: flex; align-items: center;">
                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/warning.svg" alt="Warning"
                        style="width: 24px; height: 24px; margin-right: 8px;">
                    Deletion Warning
                </h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-start" style="font-size: 14px; color: #6c757d; padding-top: 10px;">
                Deleting this KGI will remove all assigned employee teams and their history. You can recover this
                data within 7 working days. To restore it, please contact the system administrator.
            </div>
            <div class="modal-footer justify-content-end" style="border-top: none; padding-top: 20px;">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal"
                    style="width: 100px; display: flex; align-items: center; justify-content: center;">
                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/cancle.svg" alt="Cancel"
                        style="width: 14px; height: 14px; margin-right: 5px;">
                    Cancel
                </button>
                <a href="javascript:deleteKgiTeam()" class="btn btn-outline-danger"
                    style="width: 100px; display: flex; align-items: center; justify-content: center; margin-left: 10px;"
                    onmouseover="this.querySelector('.pim-icon').src='<?= Yii::$app->homeUrl ?>images/icons/Settings/binwhite.svg'"
                    onmouseout="this.querySelector('.pim-icon').src='<?= Yii::$app->homeUrl ?>images/icons/Settings/binred.svg'">
                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/binred.svg" alt="Delete" class="pim-icon"
                        style="width: 14px; height: 14px; margin-right: 5px;">
                    Delete
                </a>
            </div>
        </div>
    </div>
</div>