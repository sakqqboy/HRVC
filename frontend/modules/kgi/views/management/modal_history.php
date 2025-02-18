<style>
@media (max-width: 1935px) and (max-height: 950px) {
    .modal-content {
        transform: scale(0.95);
        transform-origin: top left;
        width: calc(100% / 0.95);
        /* height: calc(100% / 0.95); */
        /* overflow: hidden; */
    }

    .modal-dialog {
        transform: scale(0.95);
        transform-origin: top left;
        width: calc(100% / 0.95);
        /* height: calc(100% / 0.95); */
        right: 390px;
    }
}


@media (max-width: 1735px) and (max-height: 950px) {
    .modal-content {
        transform: scale(0.85);
        transform-origin: top left;
        width: calc(100% / 0.85);
        /* height: calc(100% / 0.85); */
        /* overflow: hidden; */
    }

    .modal-dialog {
        transform: scale(0.85);
        transform-origin: top left;
        width: calc(100% / 0.85);
        /* height: calc(100% / 0.85); */
        /* overflow: hidden; */
        left: -300px;
    }
}

@media (max-width: 1535px) and (max-height: 950px) {
    .modal-content {
        transform: scale(0.75);
        transform-origin: top left;
        width: calc(100% / 0.75);
        /* height: calc(100% / 0.75); */
        /* overflow: hidden; */
    }

    .modal-dialog {
        transform: scale(0.75);
        transform-origin: top left;
        width: calc(100% / 0.75);
        /* height: calc(100% / 0.75); */
        /* overflow: hidden; */
        left: -250px;
    }
}

@media (max-width: 1335px) and (max-height: 750px) {
    .modal-content {
        transform: scale(0.65);
        transform-origin: top left;
        width: calc(100% / 0.65);
        /* height: calc(100% / 0.65); */
        /* overflow: hidden; */
    }


}
</style>
<div class="modal fade" id="update-history-popup" tabindex="-1" aria-labelledby="updateHistoryModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="display: flex; padding: 25px 31px; width: 1560px; gap: 21px;">
            <div class="updatehistory" style="font-size: 30px; text-decoration-line: none;">
                <span class="modal-title-history" id="updateHistoryModalLabel">
                    <img src="<?= Yii::$app->homeUrl ?>image/refes-blue.svg" style="width: 26.998px; height: 26.999px;">
                    <?= Yii::t('app', 'History Update') ?>
                </span>
            </div>
            <div class="contrainer-body-detail" id="show-modal-history"
                style="display: flex; padding: 25px 34px; flex-direction: column; gap: 34px; ">
                <div style="display: flex; justify-content: space-between; align-items: center; width: 100%;">
                    <div class="col-7" style="display: flex; gap: 16px; flex-direction: column;">
                        <text class="text-black" id="month-year" style="font-size: 22px; font-weight: 600;">
                            month year
                        </text>
                        <text class="text-gray" id="formattedRange" style="font-size: 18px; font-weight: 400;">
                            formattedRange
                        </text>
                    </div>
                    <div class="col-5" style="display: flex; justify-content: center; align-items: center; gap: 20px;">
                        <div style="display: flex; gap: 15px; flex-direction: column;">
                            <text class="text-gray text-end" style="font-size: 18px; font-weight: 500;">
                                Total Achievement
                                <span class="text-black" id="Target" style="font-size: 18px; font-weight: 400;">
                                    Target
                                </span>
                                <span class="text-blue" id="Result" style="font-size: 18px; font-weight: 600;">
                                    /Result
                                </span>
                            </text>
                            <text class="text-gray text-end" style="font-size: 14px; font-weight: 400;">
                                Due Behind by
                                <span class="text-black text-end" id="DueBehind"
                                    style="font-size: 14px; font-weight: 500;">
                                    0%
                                </span>
                            </text>
                        </div>
                        <div style="width: 10%;">
                            <svg viewBox="0 0 36 36" class="circular-chart-create" xmlns="http://www.w3.org/2000/svg">
                                <!-- Background circle -->
                                <path class="circle-bg"
                                    d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"
                                    style="stroke: hsla(217, 100%, 91%, 1); stroke-width: 3;" fill="none" />
                                <path class="circle"
                                    d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"
                                    stroke="#4db8ff" stroke-width="3" fill="none" />

                                <!-- Percentage text in the middle -->
                                <text x="18" y="20.35" text-anchor="middle" dominant-baseline="middle"
                                    class="percentage" style="font-size: 8px; font-weight: bold; fill: #333;">
                                    0%
                                </text>
                            </svg>
                        </div>
                        <button type="button" class="btn-accept" data-bs-dismiss="modal">
                            <img src="<?= Yii::$app->homeUrl ?>image/check-box.svg" style="width: 18px; height: 18px;">
                            Accept As Final Result
                        </button>
                    </div>
                </div>
                <div
                    style="display: flex; justify-content: space-between; align-items: center; gap: 2.1px; width: 100%;">
                    <div class="alert  bg-white" style="width: 623px; height: 562px; padding: 22px 23px;">
                        <div style="display: flex;flex-direction: column;align-items: flex-start;gap: 23px;">
                            <div style="display: flex; justify-content: space-between;  width: 100%;">
                                <span class="text-blue" style="font-size: 18px; font-weight: 500;">
                                    Total Team Achievement
                                </span>
                                <div>
                                    <span class="text-gray" style="font-size: 18px; font-weight: 400;">
                                        Target
                                    </span>
                                    <span class="text-blue pr-10" style="font-size: 18px; font-weight: 600;">
                                        / Result
                                    </span>
                                </div>
                            </div>
                            <div class="tab-pane fade show active fade"
                                style="gap: 14px; width: 100%; max-height: 450px; overflow-y: auto;">
                                <ul id="history-list-team" class="list-unstyled small">

                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="alert  bg-white" style="width: 774.465px; height: 562px;">
                        <div style="display: flex;flex-direction: column;align-items: flex-start;gap: 23px;">
                            <div style="display: flex; justify-content: space-between;  width: 100%;">
                                <span class="text-blue" style="font-size: 18px; font-weight: 500;">
                                    Individual Achievement
                                </span>
                                <div>
                                    <span class="text-gray" style="font-size: 18px; font-weight: 400;">
                                        Target
                                    </span>
                                    <span class="text-blue pr-10" style="font-size: 18px; font-weight: 600;">
                                        / Result
                                    </span>
                                </div>
                            </div>
                            <div class="tab-pane fade show active fade"
                                style="gap: 14px; width: 100%; max-height: 450px; overflow-y: auto;">
                                <ul id="history-list-creater" class="list-unstyled small">
                                    <!-- ข้อมูล history จะถูกเพิ่มเข้ามาที่นี่ -->
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div style="display: flex; justify-content: flex-end; align-items: center; gap: 10px;">
                    <div class="text-gray text-end">
                        To view previous results, click the Order History<br>
                        button to review data from previous months.
                    </div>
                    <button type="button" class="btn-order-history" data-bs-dismiss="modal">Older History</button>
                    <button type="button" class="btn-order-history" data-bs-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>
</div>