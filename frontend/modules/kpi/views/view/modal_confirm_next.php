<div class="modal fade" id="copy" tabindex="-1" aria-labelledby="staticBackdrop5" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="border-bottom:none;">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>
            <div class="col-6 text-start font-b font-size-18 pl-15" style="margin-top: -35px;">
                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/warning.svg" alt="History"
                    class="home-icon mr-5" style="margin-top:-7px;">
                Copy Notice
            </div>
            <div class="modal-body">

                <div class="col-12 text-start">
                    When copying PIM content, all existing values be carried forward to the next month, except for the
                    results. To update the target, please make
                    the necessary adjustment on the 'Assign Employee' page.
                </div>
            </div>
            <div class="col-12 text-end mt-20 pr-10 pb-10">
                <input type="hidden" id="kpiHistoryId" value="">
                <button type="button" class="btn btn-danger mr-10 btn-sm" data-bs-dismiss="modal">Cancel</button>
                <a href="javascript:kpiNextTarget()" class="btn btn-primary btn-sm">Copy
                    <i class="fa fa-clipboard ml-5" aria-hidden="true"></i>
                </a>
            </div>
        </div>
    </div>
</div>