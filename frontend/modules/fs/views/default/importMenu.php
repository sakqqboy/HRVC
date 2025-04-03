<?php
// $currentFile = basename($_SERVER['PHP_SELF']);
$branchId = '';
if ($_GET['id'] != '') {
    $branchId = $_GET['id'];
} else {
    $branchId = $_SESSION['firstBranchId'];
}

if ($_SERVER['HTTP_HOST'] == "localhost") {
    $url = 'http://localhost/HRVC/frontend/web/';
} else {
    $url = 'https://tcg-hrvc-system.com/';
}

if ($_SERVER['HTTP_HOST'] == "localhost") {
    $urlimg = '/HRVC/frontend/web/';
} else {
    $urlimg = 'https://tcg-hrvc-system.com/';
}

?>

<style>
#group-management,
#financial-system,
#performance-matrices,
#evaluation-system,
#behavioral-evaluation,
#company-dashboard,
#evaluation-environment,
#third-layer-kfi,
#third-layer-kpi,
#third-layer-kgi,
#third-layer-performane {
    overflow: hidden;
    max-height: 0;
    transition: max-height 0.5s ease-out, min-height 0.5s ease-out;
}

/* Sidebar */
.sidebar {
    position: fixed;
    top: 0;
    left: 0;
    height: 100%;
    width: 280px;
    font-family: 'SF Pro Display', 'sans-serif';
    font-size: 14px;
    background-color: #072033;
    /* สีพื้นหลังเมนู */
    color: #ffffff;
    padding: 64px 10px 20px 10px;
    overflow-y: auto;
    scrollbar-width: none;
    -ms-overflow-style: none;
}

.btn-hrvc-home {
    background-color: #043A5C;
    color: white;
    width: 100%;
    font-size: 16px;
    padding-top: 2%;
    padding-bottom: 2%;
    letter-spacing: 1px;
    text-align: center;
    border-radius: 3px;
    height: 37px;
}


.home-icon {
    height: 20px;
    width: 20px;
}

.btn-group-menu {
    background-color: #202940;
    color: white;
    width: 100%;
    font-size: 16px;
    font-weight: 500;
    padding-top: 3%;
    padding-bottom: 3%;
    letter-spacing: 0.5px;
    text-align: center;
    border-radius: 3px;
    font-weight: 500;
}

.first-layer-manu {
    padding-left: 20px;
    padding-right: 9px;
    margin-top: 16px;
    font-weight: 300;
    letter-spacing: 0px;
    font-size: 14px;
    color: #E2E5EE;
    line-height: 20px;
    /* padding: 0px; */
    border-bottom: none;
    /* padding: 10px; */
    /* border-bottom: 1px solid #ddd;*/
}

.first-layer-icon {
    height: 18px;
    width: 18px;
    margin-right: 2px;
}

.no-underline {
    text-decoration: none;
    color: white;
}

.second-layer-menu {
    padding-left: 20px;
    padding-right: 15px;
    margin-top: 10px;
    font-weight: 300;
    letter-spacing: 0px;
    font-size: 14px;
    line-height: 20px;
    color: white;
}

.third-layer-menu {
    padding-left: 25px;
    padding-right: 0px;
    margin-top: 8px;
    font-weight: 200;
    letter-spacing: 0px;
    font-size: 11px;
    color: white;
}

.group-menu {
    display: none;
    max-height: 0;
    overflow: hidden;
    opacity: 0;
    transition: max-height 0.5s ease-out, opacity 0.3s ease-out;
}


.group-menu.active {
    display: block;
    opacity: 1;
    transform: translateY(0);
}

.text-under-logo {
    letter-spacing: 1px;
    font-size: 11px;
    margin-top: 10px;
    padding-left: 10px;
    color: #ADBED6 !important;
    font-weight: 300;
}
</style>

<div class="sidebar">
    <div class="col-12">
        <a href="<?= $url ?>site/index">
            <div class="col-12">
                <img src="<?= $urlimg ?>image/logo-hrvc-text.svg">
            </div>
        </a>
    </div>
    <div class="col-12 text-under-logo text-center">
        Enchance Visionary Consulting
    </div>
    <div class="btn-hrvc-home" style="font-weight:500; margin-top: 20px;">
        <a href="<?= $url ?>site/index" class="text-light" style="text-decoration: none;">
            <span>
                <img src="<?= $urlimg ?>images/icons/white-icons/others/home.svg" class="home-icon"
                    style="margin-top: -3px; margin-right: 7px;">
            </span> Home
        </a>
    </div>
    <div class="col-12" style="margin-top: 20px;">
        <div class="btn-group-menu" onclick="javascript:toggleGroupMenuI('group-management')">
            <div class="row">
                <div class="col-2 " style="padding-left: 20px; ">
                    <img src="<?= $urlimg ?>images/icons/white-icons/MasterSetting/group.svg" class="home-icon"
                        style="margin-top: -3px;">
                </div>
                <div class="col-8 text-start pr-0 " style="padding-left: 5px; "> Group Management </div>
                <div class="col-2 pr-0  text-start" style="padding-left: 5px; ">

                    <img src="<?= $urlimg ?>images/icons/white-icons/others/4.svg" class="home-icon"
                        style="margin-top: 1px;cursor: pointer; display: none;" id="group-management-hide">
                    <img src="<?= $urlimg ?>images/icons/white-icons/others/7.svg" class="home-icon"
                        style="margin-top: 2px;cursor: pointer; display: block;" id="group-management-show">
                </div>
            </div>
        </div>
        <div id="group-management" style="display: none;">

            <div class="col-12 first-layer-manu">
                <a href="<?= $url ?>setting/group/create-group" class="no-underline" style="text-decoration: none;">
                    <img src="<?= $urlimg?>images/icons/white-icons/MasterSetting/group.svg" class="first-layer-icon"
                        style="margin-top: -3px; ">
                    Group Configuration
                </a>
            </div>
            <div class="col-12 first-layer-manu">
                <a href="<?= $url ?>setting/company/index" class="no-underline" style="text-decoration: none;">
                    <img src="<?= $urlimg?>images/icons/white-icons/MasterSetting/company.svg" class="first-layer-icon"
                        style="margin-top: -3px;">

                    Company Information
                </a>
            </div>
            <div class="col-12 first-layer-manu" onclick="linkMenu(localStorage.getItem('companyId'), 'branch')">
                <a href="javascript:void(0)" class="no-underline" style="text-decoration: none;">
                    <img src="<?= $urlimg?>images/icons/white-icons/others/branch.svg" class="first-layer-icon"
                        style="margin-top: -3px;">
                    Branch </a>
            </div>
            <div class="col-12 first-layer-manu" onclick="linkMenu(localStorage.getItem('companyId'), 'department')">
                <a href="javascript:void(0)" class="no-underline" style="text-decoration: none;">
                    <img src="<?= $urlimg?>images/icons/white-icons/MasterSetting/department.svg"
                        class="first-layer-icon" style="margin-top: -3px;">
                    Department
                </a>
            </div>
            <div class="col-12 first-layer-manu" onclick="linkMenu(localStorage.getItem('companyId'), 'team')">
                <a href="javascript:void(0)" class="no-underline" style="text-decoration: none;">
                    <img src="<?= $urlimg?>images/icons/white-icons/MasterSetting/team.svg" class="first-layer-icon"
                        style="margin-top: -3px;">
                    Team
                </a>
            </div>
            <div class="col-12 first-layer-manu" onclick="linkMenu(localStorage.getItem('companyId'), 'employee')">
                <a href="javascript:void(0)" class="no-underline" style="text-decoration: none;">
                    <img src="<?= $urlimg?>images/icons/white-icons/BehavioralEvaluation/my_portal.svg"
                        class="first-layer-icon" style="margin-top: -3px;">
                    Employee
                </a>
            </div>

            <div class="col-12 first-layer-manu">
                <a href="<?= $url ?>setting/title/index" class="no-underline" style="text-decoration: none;">
                    <img src="<?= $urlimg?>images/icons/white-icons/MasterSetting/title.svg" class="first-layer-icon"
                        style="margin-top: -3px;">
                    Title
                </a>
            </div>

            <div class="col-12 first-layer-manu">
                <a href="<?= $url ?>setting/layer/index" class="no-underline" style="text-decoration: none;">
                    <img src="<?= $urlimg?>images/icons/white-icons/MasterSetting/layer.svg" class="first-layer-icon"
                        style="margin-top: -3px;">
                    Management Layer
                </a>
            </div>

        </div>
    </div>
    <div class="col-12" style="margin-top: 20px;">
        <div class="btn-group-menu" onclick="javascript:toggleGroupMenuI('financial-system')">
            <div class="row">
                <div class="col-2 " style="padding-left: 20px; ">
                    <img src="<?= $urlimg ?>images/icons/white-icons/FinancialSystem/fs.svg" class="home-icon"
                        style="margin-top: -3px;">
                </div>
                <div class="col-8 text-start pr-0 " style="padding-left: 5px; "> Financial System </div>
                <div class="col-2 pr-0  text-start" style="padding-left: 5px; ">
                    <img src="<?= $urlimg ?>images/icons/white-icons/others/4.svg" class="home-icon"
                        style="margin-top: 1px;cursor: pointer; display: none;" id="financial-system-hide">
                    <img src="<?= $urlimg ?>images/icons/white-icons/others/7.svg" class="home-icon"
                        style="margin-top: 1px;cursor: pointer; display: block;" id="financial-system-show">
                </div>
            </div>
        </div>
        <div id="financial-system" style="display: none;">

            <div class="col-12 first-layer-manu">
                <a href="FinancialDashboard" class="no-underline" style="text-decoration: none;">
                    <img src="<?= $urlimg?>images/icons/white-icons/FinancialSystem/dashboard.svg"
                        class="first-layer-icon" style="margin-top: -3px;">
                    Dashboard
                </a>
            </div>
            <div class="col-12 first-layer-manu">
                <a href="FinancialProfitLossPortal?branch= " class="no-underline" style="text-decoration: none;">
                    <img src="<?= $urlimg?>images/icons/white-icons/FinancialSystem/pl_forecase.svg"
                        class="first-layer-icon" style="margin-top: -3px;">
                    PL Forecast
                </a>
            </div>
            <div class="col-12 first-layer-manu">
                <a href="FinancialConfiguration?branch= " class="no-underline" style="text-decoration: none;">
                    <img src="<?= $urlimg?>images/icons/white-icons/FinancialSystem/pl_config.svg"
                        class="first-layer-icon" style="margin-top: -3px;">
                    PL Configuration
                </a>
            </div>
            <div class="col-12 first-layer-manu">
                <a href="GoldenRatio?branch= " class="no-underline" style="text-decoration: none;">
                    <img src="<?= $urlimg?>images/icons/white-icons/FinancialSystem/golden.svg" class="first-layer-icon"
                        style="margin-top: -3px;">
                    Golden Ratio
                </a>
            </div>
            <div class="col-12 first-layer-manu">
                <a href="ForecastAccounts?branch= " class="no-underline" style="text-decoration: none;">
                    <img src="<?= $urlimg?>images/icons/white-icons/FinancialSystem/forecast_account.svg"
                        class="first-layer-icon" style="margin-top: -3px;">
                    Forecast Account
                </a>
            </div>
            <div class="col-12 first-layer-manu">
                <a href="CurrencyManagement" class="no-underline" style="text-decoration: none;">
                    <img src="<?= $urlimg?>images/icons/white-icons/FinancialSystem/currency.svg"
                        class="first-layer-icon" style="margin-top: -3px;">
                    Currency Management
                </a>
            </div>
        </div>
    </div>
    <div class="col-12" style="margin-top: 20px;">
        <div class="btn-group-menu" onclick="javascript:toggleGroupMenuI('performance-matrices')">
            <div class="row">
                <div class="col-2 " style="padding-left: 20px; ">
                    <img src="<?= $urlimg ?>images/icons/white-icons/PerformanceMatrices/performance.svg"
                        class="home-icon" style="margin-top: -3px;">
                </div>
                <div class="col-8 text-start pr-0 " style="padding-left: 5px; "> Performance Matrices </div>
                <div class="col-2 pr-0  text-start" style="padding-left: 5px; ">
                    <img src="<?= $urlimg ?>images/icons/white-icons/others/4.svg" class="home-icon"
                        style="margin-top: 2px;cursor: pointer; display: none;" id="performance-matrices-hide">
                    <img src="<?= $urlimg ?>images/icons/white-icons/others/7.svg" class="home-icon"
                        style="margin-top: 2px;cursor: pointer; display: block;" id="performance-matrices-show">
                </div>
            </div>
        </div>
        <div id="performance-matrices" style="display: none;">
            <div class="col-12 first-layer-manu">
                <div class="col-12">
                    <a href="<?= $url ?>home/default/dashboard" class="no-underline">
                        <img src="<?= $urlimg?>images/icons/white-icons/FinancialSystem/dashboard.svg"
                            class="first-layer-icon" style="margin-top: -3px;">
                        Dashboard
                    </a>
                </div>
            </div>
            <div class="col-12 first-layer-manu">
                <img src="<?= $urlimg?>images/icons/white-icons/PerformanceMatrices/KFI.svg" class="first-layer-icon"
                    style="margin-top: -3px;">
                <a href="<?= $url ?>kfi/management/grid" class="no-underline">
                    Financials
                </a>
                <span style="float: right;">
                    <img src="<?= $urlimg?>images/icons/white-icons/others/6.svg" class="first-layer-icon"
                        style="cursor:pointer;margin-top: 1px;  display: none;"
                        onclick="javascript:hideGroupMenu('third-layer-kfi')" id="third-layer-kfi-hide">
                    <img src="<?= $urlimg?>images/icons/white-icons/others/6-1.svg" class="first-layer-icon"
                        style="cursor:pointer;margin-top: 1px;  display: block;"
                        onclick="javascript:showGroupMenu('third-layer-kfi')" id="third-layer-kfi-show">
                </span>
                <div class="col-12" id="third-layer-kfi" style="display: none;">
                    <div class="col-12 second-layer-menu">
                        <a href="<?= $url ?>kfi/management/grid" class="no-underline">
                            <img src="<?= $urlimg?>images/icons/white-icons/PerformanceMatrices/company.svg"
                                class="first-layer-icon" style="margin-top: -3px;">
                            Company KFI
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-12 first-layer-manu">
                <img src="<?= $urlimg?>images/icons/white-icons/PerformanceMatrices/KGI.svg" class="first-layer-icon"
                    style="margin-top: -3px;">
                <a href="<?= $url ?>kgi/management/grid" class="no-underline">
                    Goals
                </a>
                <span style="float: right;">
                    <img src="<?= $urlimg?>images/icons/white-icons/others/6.svg" class="first-layer-icon"
                        style="cursor:pointer;margin-top: 1px;  display: none;"
                        onclick="javascript:hideGroupMenu('third-layer-kgi')" id="third-layer-kgi-hide">
                    <img src="<?= $urlimg?>images/icons/white-icons/others/6-1.svg" class="first-layer-icon"
                        style="cursor:pointer;margin-top: 1px;  display: block;"
                        onclick="javascript:showGroupMenu('third-layer-kgi')" id="third-layer-kgi-show">
                </span>
                <div class="col-12" id="third-layer-kgi" style="display: none;">
                    <div class="col-12 second-layer-menu">
                        <a href="<?= $url ?>kgi/management/grid" class="no-underline">
                            <img src="<?= $urlimg?>images/icons/white-icons/PerformanceMatrices/company.svg"
                                class="first-layer-icon" style="margin-top: -3px;">
                            Company KGI
                        </a>
                    </div>
                    <div class="col-12 second-layer-menu">
                        <a href="<?= $url ?>kgi/kgi-team/team-kgi-grid" class="no-underline">
                            <img src="<?= $urlimg?>images/icons/white-icons/PerformanceMatrices/team.svg"
                                class="first-layer-icon" style="margin-top: -3px;">
                            Team KGI
                        </a>
                    </div>
                    <div class="col-12 second-layer-menu">
                        <a href="<?= $url ?>kgi/kgi-personal/individual-kgi-grid" class="no-underline">
                            <img src="<?= $urlimg?>images/icons/white-icons/PerformanceMatrices/self.svg"
                                class="first-layer-icon" style="margin-top: -3px;">
                            Self KGI
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-12 first-layer-manu">
                <img src="<?= $urlimg?>images/icons/white-icons/PerformanceMatrices/KPI.svg" class="first-layer-icon"
                    style="margin-top: -3px;">
                <a href="<?= $url ?>kpi/management/grid" class="no-underline">
                    Performance
                </a>
                <span style="float: right;">
                    <img src="<?= $urlimg?>images/icons/white-icons/others/6.svg" class="first-layer-icon"
                        style="cursor:pointer;margin-top: 1px;  display: none;"
                        onclick="javascript:hideGroupMenu('third-layer-kpi')" id="third-layer-kpi-hide">
                    <img src="<?= $urlimg?>images/icons/white-icons/others/6-1.svg" class="first-layer-icon"
                        style="cursor:pointer;margin-top: 1px;  display: block;"
                        onclick="javascript:showGroupMenu('third-layer-kpi')" id="third-layer-kpi-show">
                </span>
                <div class="col-12" id="third-layer-kpi" style="display: none;">
                    <div class="col-12 second-layer-menu">
                        <a href="<?= $url ?>kpi/management/grid" class="no-underline">
                            <img src="<?= $urlimg?>images/icons/white-icons/PerformanceMatrices/company.svg"
                                class="first-layer-icon" style="margin-top: -3px;">
                            Company KPI
                        </a>
                    </div>
                    <div class="col-12 second-layer-menu">
                        <a href="<?= $url ?>kpi/kpi-team/team-kpi-grid" class="no-underline">
                            <img src="<?= $urlimg?>images/icons/white-icons/PerformanceMatrices/team.svg"
                                class="first-layer-icon" style="margin-top: -3px;">
                            Team KPI
                        </a>
                    </div>
                    <div class="col-12 second-layer-menu">
                        <a href="<?= $url ?>kpi/kpi-personal/individual-kpi-grid" class="no-underline">
                            <img src="<?= $urlimg?>images/icons/white-icons/PerformanceMatrices/self.svg"
                                class="first-layer-icon" style="margin-top: -3px;">
                            Self KPI
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12" style="margin-top: 20px;">
        <div class="btn-group-menu" onclick="javascript:toggleGroupMenuI('evaluation-system')">
            <div class="row">
                <div class="col-2 " style="padding-left: 20px; ">
                    <img src="<?= $urlimg ?>images/icons/white-icons/Evaluation/evaluation_system.svg" class="home-icon"
                        style="margin-top: -3px;">
                </div>
                <div class="col-8 text-start pr-0 " style="padding-left: 5px; "> Evaluation System </div>
                <div class="col-2 pr-0  text-start" style="padding-left: 5px; ">
                    <img src="<?= $urlimg ?>images/icons/white-icons/others/4.svg" class="home-icon"
                        style="margin-top: 1px;cursor: pointer; ;display: none;" id="evaluation-system-hide">
                    <img src="<?= $urlimg ?>images/icons/white-icons/others/7.svg" class="home-icon"
                        style="margin-top: 1px;cursor: pointer; display: block;" id="evaluation-system-show">
                </div>
            </div>
        </div>
        <div id="evaluation-system" style="display: none;">
            <div class="col-12 first-layer-manu">
                <img src="<?= $urlimg?>images/icons/white-icons/Evaluation/evaluation_system.svg"
                    class="first-layer-icon" style="margin-top: -3px;">
                <a class="no-underline">
                    Evaluation Environment
                </a>
                <span style="float: right;">
                    <img src="<?= $urlimg?>images/icons/white-icons/others/6.svg" class="first-layer-icon"
                        style="cursor:pointer;margin-top: 1px;  display: none;"
                        onclick="javascript:hideGroupMenu('evaluation-environment')" id="evaluation-environment-hide">
                    <img src="<?= $urlimg?>images/icons/white-icons/others/6-1.svg" class="first-layer-icon"
                        style="cursor:pointer;margin-top: 1px;  display: block;"
                        onclick="javascript:showGroupMenu('evaluation-environment')" id="evaluation-environment-show">
                </span>
            </div>
            <div id="evaluation-environment" style="display: none;">
                <div class="col-12 second-layer-menu">
                    <a class="no-underline">
                        <img src="<?= $urlimg?>images/icons/white-icons/Evaluation/progress.svg"
                            class="first-layer-icon" style="margin-top: -3px;">
                        Progress Dashboard
                    </a>
                </div>
                <div class="col-12 second-layer-menu">
                    <a class="no-underline">
                        <img src="<?= $urlimg?>images/icons/white-icons/Evaluation/salary.svg" class="first-layer-icon"
                            style="margin-top: -3px;">
                        Salary Registeration
                    </a>
                </div>
                <div class="col-12 second-layer-menu">
                    <a class="no-underline">
                        <img src="<?= $urlimg?>images/icons/white-icons/Evaluation/performance.svg"
                            class="first-layer-icon" style="margin-top: -3px;">
                        Performance
                    </a>
                    <span style="float: right;">
                        <img src="<?= $urlimg?>images/icons/white-icons/others/6.svg" class="first-layer-icon"
                            style="cursor:pointer;margin-top: 1px;  display: none;"
                            onclick="javascript:hideGroupMenu('third-layer-performane')"
                            id="third-layer-performane-hide">
                        <img src="<?= $urlimg?>images/icons/white-icons/others/6-1.svg" class="first-layer-icon"
                            style="cursor:pointer;margin-top: 1px;  display: block;"
                            onclick="javascript:showGroupMenu('third-layer-performane')"
                            id="third-layer-performane-show">
                    </span>
                    <div class="col-12" id="third-layer-performane">
                        <div class="col-12 third-layer-menu">
                            <a class="no-underline">
                                <img src="<?= $urlimg?>images/icons/white-icons/Evaluation/company.svg"
                                    class="first-layer-icon" style="margin-top: -3px;">
                                Company
                            </a>
                        </div>
                        <div class="col-12 third-layer-menu">
                            <a class="no-underline">
                                <img src="<?= $urlimg?>images/icons/white-icons/Evaluation/self.svg"
                                    class="first-layer-icon" style="margin-top: -3px;">
                                Individual
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12" style="margin-top: 20px;">
        <div class="btn-group-menu" onclick="javascript:toggleGroupMenuI('behavioral-evaluation')">
            <div class="row">
                <div class="col-2 " style="padding-left: 20px; ">
                    <img src="<?= $urlimg ?>images/icons/white-icons/BehavioralEvaluation/evaluation.svg"
                        class="home-icon" style="margin-top: -3px;">
                </div>
                <div class="col-8 text-start pr-0 " style="padding-left: 5px; "> Behavioral Evaluation </div>
                <div class="col-2 pr-0  text-start" style="padding-left: 5px; ">
                    <img src="<?= $urlimg ?>images/icons/white-icons/others/4.svg" class="home-icon"
                        style="margin-top: 1px;cursor: pointer; ;display: none;" id="behavioral-evaluation-hide">
                    <img src="<?= $urlimg ?>images/icons/white-icons/others/7.svg" class="home-icon"
                        style="margin-top: 1px;cursor: pointer; display: block;" id="behavioral-evaluation-show">
                </div>
            </div>
        </div>
        <div id="behavioral-evaluation" style="display: none;">
            <div class="col-12 first-layer-manu">
                <img src="<?= $urlimg?>images/icons/white-icons/BehavioralEvaluation/evaluation.svg"
                    class="first-layer-icon" style="margin-top: -3px;">
                Behavioral Indicator
            </div>
            <div id="behavioral-indicator">
                <div class="col-12 second-layer-menu">
                    <a class="no-underline">
                        <img src="<?= $urlimg?>images/icons/white-icons/BehavioralEvaluation/evaluation_portal.svg"
                            class="first-layer-icon" style="margin-top: -3px;">
                        Behavior Portal
                    </a>
                </div>
                <div class="col-12 second-layer-menu">
                    <a class="no-underline">
                        <img src="<?= $urlimg?>images/icons/white-icons/BehavioralEvaluation/registeration.svg"
                            class="first-layer-icon" style="margin-top: -3px;">
                        Registeration & Config
                    </a>
                </div>
            </div>
            <div class="col-12 first-layer-manu">
                <img src="<?= $urlimg?>images/icons/white-icons/BehavioralEvaluation/360.svg" class="first-layer-icon"
                    style="margin-top: -3px;">
                360 Degree Evaluation
            </div>
            <div class="col-12 first-layer-manu">
                <img src="<?= $urlimg?>images/icons/white-icons/BehavioralEvaluation/company_dashboard.svg"
                    class="first-layer-icon" style="margin-top: -3px;">
                Company Dashboard
                <span style="float: right;">
                    <img src="<?= $urlimg?>images/icons/white-icons/others/6.svg" class="first-layer-icon"
                        style="cursor:pointer;margin-top: 1px;  display: none;"
                        onclick="javascript:hideGroupMenu('company-dashboard')" id="company-dashboard-hide">
                    <img src="<?= $urlimg?>images/icons/white-icons/others/6-1.svg" class="first-layer-icon"
                        style="cursor:pointer;margin-top: 1px; display: block; "
                        onclick="javascript:showGroupMenu('company-dashboard')" id="company-dashboard-show">
                </span>
            </div>
            <div id="company-dashboard" style="display: none;">
                <div class="col-12 second-layer-menu">
                    <a class="no-underline">
                        <img src="<?= $urlimg?>images/icons/white-icons/BehavioralEvaluation/template_board.svg"
                            class="first-layer-icon" style="margin-top: -3px;">
                        Template Board
                    </a>
                </div>
                <div class="col-12 second-layer-menu">
                    <a class="no-underline">
                        <img src="<?= $urlimg?>images/icons/white-icons/BehavioralEvaluation/question_bank.svg"
                            class="first-layer-icon" style="margin-top: -3px;">
                        Question Bank
                    </a>
                </div>
                <div class="col-12 second-layer-menu">
                    <a class="no-underline">
                        <img src="<?= $urlimg?>images/icons/white-icons/BehavioralEvaluation/my_360.svg"
                            class="first-layer-icon" style="margin-top: -3px;">
                        My 360
                    </a>
                </div>
                <div class="col-12 second-layer-menu">
                    <a class="no-underline">
                        <img src="<?= $urlimg?>images/icons/white-icons/BehavioralEvaluation/my_portal.svg"
                            class="first-layer-icon" style="margin-top: -3px;">
                        My Portal
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12" style="margin-top: 20px; margin-bottom: 10px;">
        <div class="btn-hrvc-home">
            <a href="<?= $url ?>language/default/index" class="text-light" style="text-decoration: none;">
                <span>
                    <img src="<?= $urlimg?>images/icons/white-icons/others/8.svg" class="home-icon"
                        style="margin-top: -3px;">
                </span> Setting
            </a>
        </div>
    </div>

</div>


<script>
var $baseUrl = window.location.protocol + "/ / " + window.location.host;
if (window.location.host == 'localhost') {
    $baseUrl = window.location.protocol + "//" + window.location.host + '/HRVC/frontend/web/';
} else {
    $baseUrl = "https://tcg-hrvc-system.com/";
}
$baseUrl = $baseUrl;
const companyId = localStorage.getItem('companyId');

// function linkMenu(companyId, part) {
//     if (!companyId || isNaN(companyId)) {
//         alert("Invalid Company ID");
//         return;
//     }
//     var url = `${$baseUrl}fs/default/company-id`;
//     fetch(url, {
//             method: "POST",
//             headers: {
//                 "Content-Type": "application/json"
//             },
//             body: JSON.stringify({
//                 companyId: companyId
//             })
//         })
//         .then(response => {
//             if (!response.ok) {
//                 throw new Error("HTTP error! Status: " + response.status);
//             }
//             return response.json();
//         })
//         .then(data => {
//             console.log("API Response:", data);
//             aler(data.companyId);
//         })
//         .catch(error => {
//             console.error("Fetch error:", error);
//             alert("Error fetching company ID: " + error.message + url);
//         });
// }

// function linkMenu(companyId, part) {
//     // var url = "https://tcg-hrvc-system.com/fs/default/company-id";
//     var url = `${$baseUrl}fs/default/company-id`;


//     fetch(url, {
//             method: "POST",
//             headers: {
//                 "Content-Type": "application/json"
//             },
//             body: JSON.stringify({
//                 companyId: companyId
//             }) // ✅ ส่ง JSON ที่ถูกต้อง
//         })
//         .then(response => {
//             if (!response.ok) {
//                 throw new Error("HTTP error! Status: " + response.status);
//             }
//             return response.json();
//         })
//         .then(data => {
//             console.log("API Response:", data); // ✅ ตรวจสอบค่าใน Console
//             alert("Response: " + (data.companyId ?? "No Data")); // ✅ ใช้ ?? กัน undefined
//             alert("Part: " + part);
//         })
//         .catch(error => {
//             console.error("Fetch error:", error);
//             alert("Error fetching company ID: " + error.message + url);
//         });
// }

function linkMenu(companyId, part) {
    var url = `${$baseUrl}fs/default/menu-company-id?companyId=${companyId}`;

    fetch(url, {
            method: "GET"
        }) // ✅ ใช้ GET Request
        .then(response => {
            if (!response.ok) {
                throw new Error("HTTP error! Status: " + response.status);
            }
            return response.json();
        })
        .then(data => {
            console.log("API Response:", data);
            // if (data.companyId) {
            //     let companyIdDecoded = decodeURIComponent(data.companyId);
            //     //     console.log("Decoded Company ID:", companyIdDecoded);
            //     if (part === "employee") {
            //         link = `${$baseUrl}setting/${part}/index/${data.companyId}`;
            //     } else {
            //         link = `${$baseUrl}setting/${part}/create/${data.companyId}`;
            //     }
            //     //     window.location.href = link;
            // } else {
            //     alert("Failed to get company ID");
            // }

            // if (part == "employee") {
            //     link = `${$baseUrl}setting/${part}/index/${data.companyId}`;
            // } else {
            //     link = `${$baseUrl}setting/${part}/create/${data.companyId}`;
            // }
            // window.location.href = link;

            alert("Response: " + (data.companyId ?? "No Data"));
            alert("Part: " + url);
        })
        .catch(error => {
            console.error("Fetch error:", error);
            alert("Error fetching company ID: " + error.message + url);
        });
}


document.addEventListener("DOMContentLoaded", function() {
    document.querySelectorAll(".btn-group-menu").forEach(function(btn) {
        let groupname = btn.getAttribute("onclick").match(/'([^']+)'/)[1];
        let menu = document.getElementById(groupname);
        let showIcon = document.getElementById(groupname + "-show");
        let hideIcon = document.getElementById(groupname + "-hide");

        if (sessionStorage.getItem(groupname) === "show") {
            menu.style.display = "block";
            menu.style.maxHeight = "500px";
            showIcon.style.display = "none";
            hideIcon.style.display = "block";
        }

        btn.addEventListener("click", function() {
            if (menu.style.display === "none" || menu.style.maxHeight === "0px") {
                openMenu(menu, showIcon, hideIcon);
            } else {
                closeMenu(menu, showIcon, hideIcon);
            }
        });
    });
});

// ฟังก์ชันเปิดเมนูหลัก
function openMenu(menu, showIcon, hideIcon) {
    menu.style.display = "block";
    requestAnimationFrame(() => {
        menu.style.maxHeight = "500px";
        // alert(menu.scrollHeight);
    });
    showIcon.style.display = "none";
    hideIcon.style.display = "block";
    sessionStorage.setItem(menu.id, "show");
}

// ฟังก์ชันปิดเมนูหลัก
function closeMenu(menu, showIcon, hideIcon) {
    menu.style.maxHeight = "0px";
    setTimeout(() => {
        menu.style.display = "none";
    }, 500);
    showIcon.style.display = "block";
    hideIcon.style.display = "none";
    sessionStorage.setItem(menu.id, "hide");
}

// **ฟังก์ชันแสดงเมนูย่อย**
function showGroupMenu(groupname) {
    let submenu = document.getElementById(groupname);
    let treemenu = document.getElementById("evaluation-environment");

    submenu.style.display = "block";
    requestAnimationFrame(() => {
        submenu.style.maxHeight = "500px";
        treemenu.style.maxHeight = "500px";
        // alert(submenu.scrollHeight);
        adjustParentHeight(submenu);
    });

    document.getElementById(groupname + "-show").style.display = "none";
    document.getElementById(groupname + "-hide").style.display = "block";
}

// **ฟังก์ชันซ่อนเมนูย่อย**
function hideGroupMenu(groupname) {
    let submenu = document.getElementById(groupname);
    submenu.style.maxHeight = "0px";

    setTimeout(() => {
        submenu.style.display = "none";
        adjustParentHeight(submenu);
    }, 500);

    document.getElementById(groupname + "-show").style.display = "block";
    document.getElementById(groupname + "-hide").style.display = "none";
}

// **ฟังก์ชันปรับขนาดเมนูหลักให้พอดีกับเมนูย่อย**
function adjustParentHeight(childMenu) {
    let parentMenu = childMenu.closest("div[id]");
    if (parentMenu) {
        requestAnimationFrame(() => {
            parentMenu.style.maxHeight = parentMenu.scrollHeight + "px";
        });
    }
}
</script>