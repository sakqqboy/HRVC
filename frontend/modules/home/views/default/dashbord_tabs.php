<div class="nav nav-tabs d-flex justify-content-between align-items-center">
    <!-- คำทางซ้าย -->
    <div>
        <h5 class="mb-0">Team of December 2024</h5>
    </div>
    <!-- แท็บทางขวา -->
    <ul class="nav nav-tabs dashboard-tabs justify-content-end" role="tablist">
        <li class="nav-item">

            <a class="nav-link active" id="company-kpi-tab" data-bs-toggle="tab" href="#company-kpi" role="tab"
                aria-controls="company-kpi" aria-selected="true">
                <img src="<?=Yii::$app->homeUrl?>images/icons/Settings/company.svg" alt="Company" class="pim-icon"
                    style="width: 14px; height: 14px; padding-bottom: 4px; margin-top: 5px">Company
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="team-kpi-tab" data-bs-toggle="tab" href="#team-kpi" role="tab"
                aria-controls="team-kpi" aria-selected="false">
                <img src="<?=Yii::$app->homeUrl?>images/icons/Settings/team.svg" alt="Team" class="pim-icon"
                    style="width: 13px; height: 13px; padding-bottom: 2px; margin-top: 2px">
                Team
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="self-kpi-tab" data-bs-toggle="tab" href="#self-kpi" role="tab"
                aria-controls="self-kpi" aria-selected="false">
                <img src="<?=Yii::$app->homeUrl?>images/icons/Settings/self.svg" alt="Self" class="pim-icon"
                    style="width: 13px; height: 13px; padding-bottom: 3px; margin-top: 2px">
                Self
            </a>
        </li>
    </ul>
</div>




<!-- Tab Content -->
<div class="tab-content">
    <div class="tab-pane fade show active" id="company-kpi" role="tabpanel" aria-labelledby="company-kpi-tab">
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
                                <strong>34%</strong>
                            </div>
                            <div class="col-4 text-start">
                                <small class="small-text text-muted">
                                    <img src="<?=Yii::$app->homeUrl?>images/icons/Settings/Target.svg"
                                        class="pim-iconKFI" style="margin-top: 1px; margin-right: 3px;">
                                    Target
                                </small>
                                <br>
                                <strong class="bold-text">1,000 M</strong>
                            </div>
                            <div class="col-4 text-end">
                                <small class="small-text text-muted">
                                    Result
                                    <img src="<?=Yii::$app->homeUrl?>images/icons/Settings/Result.svg"
                                        class="pim-iconKFI" style="margin-top: 1px; margin-left: 3px;">
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
                                <strong>80%</strong>
                            </div>
                            <div class="col-4 text-start">
                                <small class="small-text text-muted">
                                    <img src="<?=Yii::$app->homeUrl?>images/icons/Settings/Target.svg"
                                        class="pim-iconKFI">
                                    Target
                                </small>
                                <br>
                                <strong class="bold-text">12</strong>
                            </div>
                            <div class="col-4 text-end">
                                <small class="small-text text-muted">
                                    Result
                                    <img src="<?=Yii::$app->homeUrl?>images/icons/Settings/Result.svg"
                                        class="pim-iconKFI" style="margin-top: 1px; margin-left: 3px;">
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
                                <strong>79%</strong>
                            </div>
                            <div class="col-4 text-start">
                                <small class="small-text text-muted">
                                    <img src="<?=Yii::$app->homeUrl?>images/icons/Settings/Target.svg"
                                        class="pim-iconKFI">
                                    Target
                                </small>
                                <br>
                                <strong class="bold-text">72%</strong>
                            </div>
                            <div class="col-4 text-end">
                                <small class="small-text text-muted">
                                    Result
                                    <img src="<?=Yii::$app->homeUrl?>images/icons/Settings/Result.svg"
                                        class="pim-iconKFI" style="margin-top: 1px; margin-left: 3px;">
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


    <div class="tab-pane fade" id="team-kpi" role="tabpanel" aria-labelledby="team-kpi-tab">
        <div class="tab-pane fade show active" id="company-kpi" role="tabpanel" aria-labelledby="company-kpi-tab">
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
                                <div class="progress-bar bg-KFI" style="width: 61%;" role="progressbar"
                                    aria-valuenow="61" aria-valuemin="0" aria-valuemax="100"></div>
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
                                    <strong>34%</strong>
                                </div>
                                <div class="col-4 text-start">
                                    <small class="small-text text-muted">
                                        <img src="<?=Yii::$app->homeUrl?>images/icons/Settings/Target.svg"
                                            class="pim-iconKFI" style="margin-top: 1px; margin-right: 3px;">
                                        Target
                                    </small>
                                    <br>
                                    <strong class="bold-text">1,000 M</strong>
                                </div>
                                <div class="col-4 text-end">
                                    <small class="small-text text-muted">
                                        Result
                                        <img src="<?=Yii::$app->homeUrl?>images/icons/Settings/Result.svg"
                                            class="pim-iconKFI" style="margin-top: 1px; margin-left: 3px;">
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
                                <div class="progress-bar bg-KGI" style="width: 49%;" role="progressbar"
                                    aria-valuenow="49" aria-valuemin="0" aria-valuemax="100"></div>
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
                                    <strong>80%</strong>
                                </div>
                                <div class="col-4 text-start">
                                    <small class="small-text text-muted">
                                        <img src="<?=Yii::$app->homeUrl?>images/icons/Settings/Target.svg"
                                            class="pim-iconKFI">
                                        Target
                                    </small>
                                    <br>
                                    <strong class="bold-text">12</strong>
                                </div>
                                <div class="col-4 text-end">
                                    <small class="small-text text-muted">
                                        Result
                                        <img src="<?=Yii::$app->homeUrl?>images/icons/Settings/Result.svg"
                                            class="pim-iconKFI" style="margin-top: 1px; margin-left: 3px;">
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
                                    <img src="<?=Yii::$app->homeUrl?>images/icons/Settings/refresh-black.svg"
                                        class="mb-2" style="width: 12px; height: 12px;">
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
                                <div class="progress-bar bg-KPI" style="width: 31%;" role="progressbar"
                                    aria-valuenow="31" aria-valuemin="0" aria-valuemax="100"></div>
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
                                    <strong>79%</strong>
                                </div>
                                <div class="col-4 text-start">
                                    <small class="small-text text-muted">
                                        <img src="<?=Yii::$app->homeUrl?>images/icons/Settings/Target.svg"
                                            class="pim-iconKFI">
                                        Target
                                    </small>
                                    <br>
                                    <strong class="bold-text">72%</strong>
                                </div>
                                <div class="col-4 text-end">
                                    <small class="small-text text-muted">
                                        Result
                                        <img src="<?=Yii::$app->homeUrl?>images/icons/Settings/Result.svg"
                                            class="pim-iconKFI" style="margin-top: 1px; margin-left: 3px;">
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
    </div>

    <div class="tab-pane fade" id="self-kpi" role="tabpanel" aria-labelledby="self-kpi-tab">
        <div class="tab-pane fade show active" id="company-kpi" role="tabpanel" aria-labelledby="company-kpi-tab">
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
                                <div class="progress-bar bg-KFI" style="width: 61%;" role="progressbar"
                                    aria-valuenow="61" aria-valuemin="0" aria-valuemax="100"></div>
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
                                    <strong>34%</strong>
                                </div>
                                <div class="col-4 text-start">
                                    <small class="small-text text-muted">
                                        <img src="<?=Yii::$app->homeUrl?>images/icons/Settings/Target.svg"
                                            class="pim-iconKFI" style="margin-top: 1px; margin-right: 3px;">
                                        Target
                                    </small>
                                    <br>
                                    <strong class="bold-text">1,000 M</strong>
                                </div>
                                <div class="col-4 text-end">
                                    <small class="small-text text-muted">
                                        Result
                                        <img src="<?=Yii::$app->homeUrl?>images/icons/Settings/Result.svg"
                                            class="pim-iconKFI" style="margin-top: 1px; margin-left: 3px;">
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
                                <div class="progress-bar bg-KGI" style="width: 49%;" role="progressbar"
                                    aria-valuenow="49" aria-valuemin="0" aria-valuemax="100"></div>
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
                                    <strong>80%</strong>
                                </div>
                                <div class="col-4 text-start">
                                    <small class="small-text text-muted">
                                        <img src="<?=Yii::$app->homeUrl?>images/icons/Settings/Target.svg"
                                            class="pim-iconKFI">
                                        Target
                                    </small>
                                    <br>
                                    <strong class="bold-text">12</strong>
                                </div>
                                <div class="col-4 text-end">
                                    <small class="small-text text-muted">
                                        Result
                                        <img src="<?=Yii::$app->homeUrl?>images/icons/Settings/Result.svg"
                                            class="pim-iconKFI" style="margin-top: 1px; margin-left: 3px;">
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
                                    <img src="<?=Yii::$app->homeUrl?>images/icons/Settings/refresh-black.svg"
                                        class="mb-2" style="width: 12px; height: 12px;">
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
                                <div class="progress-bar bg-KPI" style="width: 31%;" role="progressbar"
                                    aria-valuenow="31" aria-valuemin="0" aria-valuemax="100"></div>
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
                                    <strong>79%</strong>
                                </div>
                                <div class="col-4 text-start">
                                    <small class="small-text text-muted">
                                        <img src="<?=Yii::$app->homeUrl?>images/icons/Settings/Target.svg"
                                            class="pim-iconKFI">
                                        Target
                                    </small>
                                    <br>
                                    <strong class="bold-text">72%</strong>
                                </div>
                                <div class="col-4 text-end">
                                    <small class="small-text text-muted">
                                        Result
                                        <img src="<?=Yii::$app->homeUrl?>images/icons/Settings/Result.svg"
                                            class="pim-iconKFI" style="margin-top: 1px; margin-left: 3px;">
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
    </div>
</div>