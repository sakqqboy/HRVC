<?php if (!empty($contentDetail)): ?>
<div>
    <!-- Display the contentDetail dynamically -->
    <?= print_r($contentDetail, true); ?>
</div>
<?php else: ?>
<p>No data available.</p>
<?php endif; ?>

<div class="tab-pane fade show active" role="tabpanel" id="tab-content-container">
    <div class="row">
        <!-- Card 1 -->
        <div class="col-md-4 mb-3">
            <div class="dashboard-kfi-top">
            </div>
            <div class="dashboard-kfi-card p-3 position-relative">
                <div class="card bg-white p-3" style="border: none;">
                    <div class="row align-items-center">
                        <!-- Left Section -->
                        <div class="col-7 text-start">
                            <span class="key-title">
                                <img src="<?=Yii::$app->homeUrl?>images/icons/black-icons/FinancialSystem/KFI.svg"
                                    class="home-icon mr-5">
                                Key Financial Indicator
                            </span>
                        </div>
                        <!-- Right Section -->
                        <div class="col-5 text-end">
                            <span class="completion-percentage">61%</span>
                            <span class="total-achievement">Total Achievement</span>
                        </div>
                        <div class="col-12 pt-3 d-flex justify-content-between">
                            <span class="total-progress">Total Progress</span>
                            <span class="total-k">Total KFI
                                <strong class="bold-text">15</strong>
                            </span>
                        </div>
                    </div>

                    <!-- Divider -->
                    <hr class="custom-hr">
                    <!-- Progress Bar -->
                    <div class="progress-dashboard">
                        <div class="progress-bar bg-KFI" style="width: 61%;" role="progressbar" aria-valuenow="61"
                            aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>

                <div class="card bg-white" style="border: none;">
                    <div class="key-title-container">
                        <div class="col-9 d-flex ">
                            <span class="key-total">Total Sales of non Japanese</span>
                        </div>

                        <div class="col-2 d-flex justify-content-between">
                            <!-- รูปแรก ชิดขวา -->
                            <span class="toggle-text">
                                <button class="show-more-btn">
                                    <img src="<?=Yii::$app->homeUrl?>images/icons/Settings/btn-KFI-left.svg"
                                        style="margin-top: 1px; margin-left: 3px;">
                                </button>
                            </span>
                            <!-- รูปสอง ชิดซ้าย -->
                            <span class="toggle-text">
                                <button class="show-more-btn">
                                    <img src="<?=Yii::$app->homeUrl?>images/icons/Settings/btn-KFI-right.svg"
                                        style="margin-top: 1px; margin-left: 3px;">
                                </button>
                            </span>
                        </div>
                        <div class="col-9"></div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center">
                        <div class="col-4 text-center">
                            <canvas id="pieChartKFI"></canvas>
                            <!-- ปรับขนาด canvas -->
                        </div>
                        <div class="col-4 text-start">
                            <small class="small-text text-muted">
                                <img src="<?=Yii::$app->homeUrl?>images/icons/Settings/Target.svg" class="pim-iconKFI"
                                    style="margin-top: 1px; margin-right: 3px;">
                                Target
                            </small>
                            <br>
                            <strong class="bold-text">1,000 M</strong>
                        </div>
                        <div class="col-4 text-end">
                            <small class="small-text text-muted">
                                Result
                                <img src="<?=Yii::$app->homeUrl?>images/icons/Settings/Result.svg" class="pim-iconKFI"
                                    style="margin-top: 1px; margin-left: 3px;">
                            </small>
                            <br>
                            <strong class="bold-text">902,566</strong>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-between align-items-center mt-3">
                    <div class="col-4 text-start">
                        <p class="small-text text-muted mb-0">Last Updated on</p>
                        <strong class="small-text">07/19/2024</strong>
                    </div>
                    <div class="col-4 text-center">
                        <button class="btn-update btn-KFI">
                            <img src="<?=Yii::$app->homeUrl?>images/icons/Settings/refresh.svg" class="mb-2"
                                style="width: 12px; height: 12px;">
                            Update
                        </button>
                    </div>
                    <div class="col-4 text-end">
                        <p class="small-textKFI mb-0">Due Update Date </p>
                        <strong class="small-text">07/19/2024</strong>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card 2 -->
        <div class="col-md-4 mb-3">
            <div class="dashboard-kgi-top"></div>
            <div class="dashboard-kgi-card p-3 position-relative">
                <div class="card bg-white p-3" style="border: none;">
                    <div class="row align-items-center">
                        <!-- Left Section -->
                        <div class="col-7 text-start">
                            <span class="key-title">
                                <img src="<?=Yii::$app->homeUrl?>images/icons/black-icons/FinancialSystem/KGI.svg"
                                    class="home-icon mr-5">
                                Key Goal Indicator
                            </span>
                        </div>
                        <!-- Right Section -->
                        <div class="col-5 text-end">
                            <span class="completion-percentage">49%</span>
                            <span class="total-achievement">Total Achievement</span>
                        </div>
                        <div class="col-12 pt-3 d-flex justify-content-between">
                            <span class="total-progress">Total Progress</span>
                            <span class="total-k">Total KGI
                                <strong class="bold-text">21</strong>
                            </span>
                        </div>
                    </div>

                    <!-- Divider -->
                    <hr class="custom-hr">
                    <!-- Progress Bar -->
                    <div class="progress-dashboard">
                        <div class="progress-bar bg-KGI" style="width: 49%;" role="progressbar" aria-valuenow="49"
                            aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>

                <div class="card bg-white" style="border: none;">
                    <div class="key-title-container">
                        <div class="col-9 d-flex ">
                            <span class="key-total">New Foreign Subscribe Clients</span>
                        </div>

                        <div class="col-2 d-flex justify-content-between">
                            <!-- รูปแรก ชิดขวา -->
                            <span class="toggle-text">
                                <button class="show-more-btn">
                                    <img src="<?=Yii::$app->homeUrl?>images/icons/Settings/btn-KGI-left.svg"
                                        style="margin-top: 1px; margin-left: 3px;">
                                </button>
                            </span>
                            <!-- รูปสอง ชิดซ้าย -->
                            <span class="toggle-text">
                                <button class="show-more-btn">
                                    <img src="<?=Yii::$app->homeUrl?>images/icons/Settings/btn-KGI-right.svg"
                                        style="margin-top: 1px; margin-left: 3px;">
                                </button>
                            </span>
                        </div>
                        <div class="col-9"></div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center">
                        <div class="col-4 text-center">
                            <canvas id="pieChartKGI"></canvas>
                        </div>
                        <div class="col-4 text-start">
                            <small class="small-text text-muted">
                                <img src="<?=Yii::$app->homeUrl?>images/icons/Settings/Target.svg" class="pim-iconKFI">
                                Target
                            </small>
                            <br>
                            <strong class="bold-text">12</strong>
                        </div>
                        <div class="col-4 text-end">
                            <small class="small-text text-muted">
                                Result
                                <img src="<?=Yii::$app->homeUrl?>images/icons/Settings/Result.svg" class="pim-iconKFI"
                                    style="margin-top: 1px; margin-left: 3px;">
                            </small>
                            <br>
                            <strong class="bold-text">9</strong>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-between align-items-center mt-3">
                    <div class="col-4 text-start">
                        <p class="small-text text-muted mb-0">Last Updated on</p>
                        <strong class="small-text">07/19/2024</strong>
                    </div>
                    <div class="col-4 text-center">
                        <button class="btn-update btn-KGI">
                            <img src="<?=Yii::$app->homeUrl?>images/icons/Settings/refresh-black.svg" class="mb-2"
                                style="width: 12px; height: 12px;">
                            Update
                        </button>
                    </div>
                    <div class="col-4 text-end">
                        <p class="small-textKGI mb-0">Due Update Date</p>
                        <strong class="small-text">07/19/2024</strong>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card 3 -->
        <div class="col-md-4 mb-3">
            <div class="dashboard-kpi-top"></div>
            <div class="dashboard-kpi-card p-3 position-relative">
                <div class="card bg-white p-3" style="border: none;">
                    <div class="row align-items-center">
                        <!-- Left Section -->
                        <div class="col-7 text-start">
                            <span class="key-title">
                                <img src="<?=Yii::$app->homeUrl?>images/icons/black-icons/FinancialSystem/KPI.svg"
                                    class="home-icon mr-5">
                                Key Performance Indicator
                            </span>
                        </div>
                        <!-- Right Section -->
                        <div class="col-5 text-end">
                            <span class="completion-percentage">31%</span>
                            <span class="total-achievement">Completed</span>
                        </div>
                        <div class="col-12 pt-3 d-flex justify-content-between">
                            <span class="total-progress">Total Progress</span>
                            <span class="total-k">Total KPI
                                <strong class="bold-text">31</strong>
                            </span>
                        </div>
                    </div>

                    <!-- Divider -->
                    <hr class="custom-hr">
                    <!-- Progress Bar -->
                    <div class="progress-dashboard">
                        <div class="progress-bar bg-KPI" style="width: 31%;" role="progressbar" aria-valuenow="31"
                            aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>

                <div class="card bg-white" style="border: none;">
                    <div class="key-title-container">
                        <div class="col-9 d-flex ">
                            <span class="key-total">New Foreign Subscribe Clients</span>
                        </div>

                        <div class="col-2 d-flex justify-content-between">
                            <!-- รูปแรก ชิดขวา -->
                            <span class="toggle-text">
                                <button class="show-more-btn">
                                    <img src="<?=Yii::$app->homeUrl?>images/icons/Settings/btn-KPI-left.svg">
                                </button>
                            </span>
                            <!-- รูปสอง ชิดซ้าย -->
                            <span class="toggle-text">
                                <button class="show-more-btn">
                                    <img src="<?=Yii::$app->homeUrl?>images/icons/Settings/btn-KPI-right.svg">
                                </button>
                            </span>
                        </div>
                        <div class="col-9"></div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center">
                        <div class="col-4 text-center">
                            <canvas id="pieChartKPI"></canvas>
                        </div>
                        <div class="col-4 text-start">
                            <small class="small-text text-muted">
                                <img src="<?=Yii::$app->homeUrl?>images/icons/Settings/Target.svg" class="pim-iconKFI">
                                Target
                            </small>
                            <br>
                            <strong class="bold-text">72%</strong>
                        </div>
                        <div class="col-4 text-end">
                            <small class="small-text text-muted">
                                Result
                                <img src="<?=Yii::$app->homeUrl?>images/icons/Settings/Result.svg" class="pim-iconKFI"
                                    style="margin-top: 1px; margin-left: 3px;">
                            </small>
                            <br>
                            <strong class="bold-text">50%</strong>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-between align-items-center mt-3">
                    <div class="col-4 text-start">
                        <p class="small-text text-muted mb-0">Last Updated on</p>
                        <strong class="small-text">07/19/2024</strong>
                    </div>
                    <div class="col-4 text-center d-flex justify-content-center align-items-center">
                        <button class="btn-update btn-KPI">
                            <img src="<?=Yii::$app->homeUrl?>images/icons/Settings/refresh.svg" class="mb-2"
                                style="width: 12px; height: 12px;">
                            Update
                        </button>
                    </div>
                    <div class="col-4 text-end">
                        <p class="small-textKPI mb-0">Due Update Date</p>
                        <strong class="small-text">07/19/2024</strong>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>

<script>
$(document).ready(function() {
    function createPieChart(chartId, percentage, colors) {
        const ctx = document.getElementById(chartId).getContext('2d');

        const data = {
            datasets: [{
                data: [percentage * 100, 100 - percentage * 100], // คำนวณเปอร์เซ็นต์
                backgroundColor: colors,
                borderWidth: 0
            }]
        };

        const options = {
            responsive: true,
            cutoutPercentage: 70, // ลดขนาดของรูตรงกลาง
            plugins: {
                tooltip: {
                    enabled: false // ปิด tooltip
                }
            },
            animation: {
                onComplete: function() {
                    const width = this.chart.width;
                    const height = this.chart.height;
                    const ctx = this.chart.ctx;

                    ctx.restore();
                    ctx.font = "14px Arial"; // ขนาดฟอนต์
                    ctx.fillStyle = "#000"; // สีข้อความ
                    ctx.textAlign = "center"; // กำหนดให้อยู่กลาง
                    ctx.textBaseline = "middle"; // แนวตั้งกลาง

                    const centerX = width / 2;
                    const centerY = height / 2;

                    const percentageText = `${Math.round(percentage * 100)}%`;
                    ctx.fillText(percentageText, centerX, centerY);
                    ctx.save();
                }
            }
        };

        return new Chart(ctx, {
            type: 'pie',
            data: data,
            options: options
        });
    }

    const percentageKFI = 0.34;
    const percentageKGI = 0.84;
    const percentageKPI = 0.54;

    createPieChart('pieChartKFI', percentageKFI, ['#748EE9', '#CCD7FF']);
    createPieChart('pieChartKGI', percentageKGI, ['#FDCA40', '#FFF2D6']);
    createPieChart('pieChartKPI', percentageKPI, ['#FF715B', '#FFEAE6']);

});
</script>