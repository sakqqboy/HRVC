<style>
/* Default */
#update-history-popup .modal-dialog,
#update-history-popup .modal-content {
    transform-origin: top left;
}

/* ขนาดจอใหญ่ */
@media (max-width: 1935px) and (max-height: 950px) {

    #update-history-popup .modal-dialog,
    #update-history-popup .modal-content {
        transform: scale(0.95);
        width: calc(100% / 0.95);
    }

    #update-history-popup .modal-dialog {
        right: 390px;
    }
}

/* จอเล็กลง */
@media (max-width: 1735px) and (max-height: 950px) {
    #update-history-popup .modal-content {
        transform: scale(0.75);
        width: calc(100% / 0.85);
    }

    #update-history-popup .modal-dialog {
        transform: scale(0.85);
        width: calc(100% / 0.85);
        left: -200px;
    }
}

/* จอเล็กกว่านี้ */
@media (max-width: 1535px) and (max-height: 950px) {
    #update-history-popup .modal-content {
        transform: scale(0.55);
        width: calc(100% / 0.75);
    }

    #update-history-popup .modal-dialog {
        transform: scale(0.75);
        width: calc(100% / 0.75);
        left: -250px;
    }
}

/* จอเล็กมาก */
@media (max-width: 1335px) and (max-height: 750px) {
    #update-history-popup .modal-content {
        transform: scale(0.65);
        width: calc(100% / 0.65);
    }
}
</style>

<div class="">
    <div class="modal fade" id="update-history-popup" tabindex="-1" aria-labelledby="updateHistoryModalLabel"
        aria-hidden="true">
        <div class="modal-dialog custom-update-history-modal">
            <div class="modal-content" style="display: flex; padding: 25px 31px; width: 1560px; gap: 21px;">
                <div class="updatehistory"
                    style="font-size: 30px; text-decoration-line: none; display: flex; justify-content: flex-start; width: 100%; text-align: left; align-items: center;">
                    <span class="modal-title-history" id="updateHistoryModalLabel">
                        <span class="modal-title-history" id="updateHistoryModalLabel">
                            <img src="<?= Yii::$app->homeUrl ?>image/refes-blue.svg"
                                style="width: 26.998px; height: 26.999px;">
                            <?= Yii::t('app', 'History Update') ?>
                        </span>
                </div>
                <div class="contrainer-body-detail" id="show-modal-history"
                    style="display: flex; padding: 25px 34px; flex-direction: column; gap: 34px; ">
                    <div style="display: flex; justify-content: space-between; align-items: center; width: 100%;">
                        <div class="col-7" style="display: flex; gap: 16px; flex-direction: column;">
                            <text class="text-black" id="mont-hyear" style="font-size: 22px; font-weight: 600;">
                                month/year
                            </text>
                            <text class="text-gray" id="formattedRange" style="font-size: 18px; font-weight: 400;">
                                format date
                            </text>
                        </div>
                        <div class="col-5"
                            style="display: flex; justify-content: center; align-items: center; gap: 20px;">
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
                                <svg viewBox="0 0 36 36" class="circular-chart-create"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <!-- Background circle -->
                                    <path class="circle-bg"
                                        d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"
                                        style="stroke: hsla(217, 100%, 91%, 1); stroke-width: 3;" fill="none" />
                                    <path class="circle"
                                        d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"
                                        stroke="#4db8ff" stroke-width="3" fill="none" stroke-dasharray="0, 100" />

                                    <!-- Percentage text in the middle -->
                                    <text x="18" y="20.35" text-anchor="middle" dominant-baseline="middle"
                                        class="percentage" style="font-size: 8px; font-weight: bold; fill: #333;">
                                        0%
                                    </text>
                                </svg>
                            </div>
                            <button type="button" class="btn-accept" data-bs-dismiss="modal">
                                <img src="<?= Yii::$app->homeUrl ?>image/check-box.svg"
                                    style="width: 18px; height: 18px;">
                                Accept As Final Result
                            </button>
                        </div>
                    </div>
                    <div
                        style="display: flex; justify-content: space-between; align-items: center; gap: 2.1px; width: 100%;">
                        <div class="alert  bg-white" style="width: 623px; height: 562px; padding: 22px 23px;">
                            <div style="display: flex;flex-direction: column;align-items: flex-start;">
                                <div style="display: flex; justify-content: space-between;  width: 100%;">
                                    <span class="text-blue" style="font-size: 18px; font-weight: 500;">
                                        Total Team Achievement
                                    </span>
                                    <div>
                                        <span class="text-gray" style="font-size: 18px; font-weight: 400;">
                                            Target
                                        </span>
                                        <span class="text-blue pr-10" style="font-size: 18px; font-weight: 600;">
                                            /Result
                                        </span>
                                    </div>
                                </div>
                                <div style="width: 100%; border-bottom: 0.5px solid #E4E4E4;"></div>
                                <div style="width: 40%; border-bottom: 2px solid #2580D3;"></div>
                                <div class="tab-pane fade show active fade pt-23"
                                    style="gap: 14px; width: 100%; max-height: 450px; overflow-y: auto;">
                                    <ul id="history-list-team" class="list-unstyled small">
                                        <li class="schedule-item mt-5" role="button" tabindex="0">
                                            <div class="row pt-10 pb-10"
                                                style="display: flex; justify-content: center; align-items: center; width: 100%; font-size: 18px; ">
                                                No data
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="alert  bg-white" style="width: 774.465px; height: 562px;">
                            <div style="display: flex;flex-direction: column;align-items: flex-start;">
                                <div style="display: flex; justify-content: space-between;  width: 100%;">
                                    <span class="text-blue" style="font-size: 18px; font-weight: 500;">
                                        Individual Achievement
                                    </span>
                                    <div>
                                        <span class="text-gray" style="font-size: 18px; font-weight: 400;">
                                            Target
                                        </span>
                                        <span class="text-blue pr-10" style="font-size: 18px; font-weight: 600;">
                                            /Result
                                        </span>
                                    </div>
                                </div>
                                <div style="width: 100%; border-bottom: 0.5px solid #E4E4E4;"></div>
                                <div style="width: 40%; border-bottom: 2px solid #2580D3;"></div>
                                <div class="tab-pane fade show active fade pt-23"
                                    style="gap: 14px; width: 100%; max-height: 450px; overflow-y: auto;">
                                    <ul id="history-list-creater" class="list-unstyled small">
                                        <li class="schedule-item mt-5" role="button" tabindex="0">
                                            <div class="row pt-10 pb-10"
                                                style="display: flex; justify-content: center; align-items: center; width: 100%; font-size: 18px; ">
                                                No data
                                            </div>
                                        </li>
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
</div>