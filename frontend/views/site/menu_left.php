<?php

use common\helpers\Path;
use common\models\ModelMaster;
use frontend\models\hrvc\UserRole;

?>
<div class="col-12">
        <div class="col-12 pl-5 pr-8 pt-20 text-center">
                <a href="<?= Yii::$app->homeUrl ?>site/index">
                        <div class="col-12">
                                <img src="<?= Yii::$app->homeUrl ?>image/logo-hrvc-text.svg">
                        </div>
                </a>
        </div>
        <div class="col-12 text-under-logo text-center">
                GIVES YOU VISIONARY EXPERIENCE
        </div>
        <div class="col-12 mt-20 box-bnt-home">
                <div class="btn-hrvc-home">
                        <a href="<?= Yii::$app->homeUrl ?>site/index" class="text-light" style="text-decoration: none;"> <span>
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/others/home.svg" class="home-icon" style="margin-top: -3px;">
                                </span> <?= Yii::t('app', 'Home') ?>
                        </a>
                </div>
        </div>
        <div class="col-12 mt-20 box-bnt-home">
                <?php
                $role = UserRole::userRight();
                if ($role >= 2) {
                ?>
                        <div class="btn-group-menu mb-10">
                                <div class="row">
                                        <div class="col-2 pl-20">
                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/MasterSetting/group.svg" class="home-icon" style="margin-top: -3px;">
                                        </div>
                                        <div class="col-8 text-center pr-0 pl-0">Group Management</div>
                                        <div class="col-2 pr-0 pl-5 text-start">
                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/others/4.svg" class="home-icon" style="margin-top: -3px;cursor: pointer;display:none;" onclick="javascript:hideGroupMenu('group-management')" id="group-management-hide">
                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/others/7.svg" class="home-icon" style="margin-top: -3px;cursor: pointer;" onclick="javascript:showGroupMenu('group-management')" id="group-management-show">
                                        </div>
                                </div>
                        </div>
                        <div id="group-management" style="display:none;">
                                <?php

                                if ($role >= 5) {
                                ?>
                                        <div class="col-12 first-layer-manu">
                                                <a href="<?= Yii::$app->homeUrl ?>setting/group/create-group" class="no-underline">
                                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/MasterSetting/group.svg" class="first-layer-icon" style="margin-top: -3px;">
                                                        Group Configuration
                                                </a>
                                        </div>
                                        <div class="col-12 first-layer-manu">
                                                <a href="<?= Yii::$app->homeUrl ?>setting/company/index" class="no-underline">
                                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/MasterSetting/company.svg" class="first-layer-icon" style="margin-top: -3px;">
                                                        Company Information
                                                </a>
                                        </div>
                                        <div class="col-12 first-layer-manu">
                                                <a href="<?= Yii::$app->homeUrl ?>setting/branch/create/<?= ModelMaster::encodeParams(['companyId' => '']) ?>" class="no-underline">
                                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/others/branch.svg" class="first-layer-icon" style="margin-top: -3px;">
                                                        Branch </a>
                                        </div>
                                        <div class="col-12 first-layer-manu">
                                                <a href="<?= Yii::$app->homeUrl ?>setting/department/create/<?= ModelMaster::encodeParams(['companyId' => '']) ?>" class="no-underline">
                                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/MasterSetting/department.svg" class="first-layer-icon" style="margin-top: -3px;">
                                                        Department
                                                </a>
                                        </div>
                                        <div class="col-12 first-layer-manu">
                                                <a href="<?= Yii::$app->homeUrl ?>setting/team/create/<?= ModelMaster::encodeParams(['companyId' => '']) ?>" class="no-underline">
                                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/MasterSetting/team.svg" class="first-layer-icon" style="margin-top: -3px;">
                                                        Team
                                                </a>
                                        </div>
                                <?php
                                }
                                $isHr = UserRole::isHr();
                                if ($isHr == 1 || $role >= 2) {
                                ?>
                                        <div class="col-12 first-layer-manu">
                                                <a href="<?= Yii::$app->homeUrl ?>setting/employee/index/<?= ModelMaster::encodeParams(['companyId' => ''])
                                                                                                                ?>" class="no-underline">
                                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/BehavioralEvaluation/my_portal.svg" class="first-layer-icon" style="margin-top: -3px;">
                                                        Employee
                                                </a>
                                        </div>
                                <?php
                                }
                                if ($role >= 5) {
                                ?>
                                        <div class="col-12 first-layer-manu">
                                                <a href="<?= Yii::$app->homeUrl ?>setting/title/index" class="no-underline">
                                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/MasterSetting/title.svg" class="first-layer-icon" style="margin-top: -3px;">
                                                        Title
                                                </a>
                                        </div>

                                        <div class="col-12 first-layer-manu">
                                                <a href="<?= Yii::$app->homeUrl ?>setting/layer/index" class="no-underline">
                                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/MasterSetting/layer.svg" class="first-layer-icon" style="margin-top: -3px;">
                                                        Management Layer
                                                </a>
                                        </div>
                                <?php
                                }
                                ?>
                        </div>
                <?php
                }
                ?>
        </div>
        <div class="col-12 mt-20 box-bnt-home">
                <div class="btn-group-menu">
                        <div class="row">
                                <div class="col-2 pl-20">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/FinancialSystem/fs.svg" class="home-icon" style="margin-top: -3px;">
                                </div>
                                <div class="col-8 text-center pr-0 pl-0">Financial System</div>
                                <div class="col-2 pr-0 pl-5 text-start">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/others/4.svg" class="home-icon" style="margin-top: -3px;cursor: pointer;display:none;" onclick="javascript:hideGroupMenu('financial-system')" id="financial-system-hide">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/others/7.svg" class="home-icon" style="margin-top: -3px;cursor: pointer;" onclick="javascript:showGroupMenu('financial-system')" id="financial-system-show">
                                </div>
                        </div>
                </div>
                <div id="financial-system" style="display: none;">
                        <div class="col-12 first-layer-manu">
                                <div class="col-12">
                                        <a href="<?= Path::fsModule() ?>?__id=<?= Yii::$app->user->id ?>" class="no-underline col-12">
                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/FinancialSystem/dashboard.svg" class="first-layer-icon" style="margin-top: -3px;">
                                                Dashboard
                                        </a>
                                </div>
                                <div class="col-12 mt-10">
                                        <a href="<?= Path::fsModule() ?>?__id=<?= Yii::$app->user->id ?>" class="no-underline">
                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/FinancialSystem/pl_forecase.svg" class="first-layer-icon" style="margin-top: -3px;">
                                                PL Forecast
                                        </a>
                                </div>
                                <div class="col-12 mt-10">
                                        <a href="<?= Path::fsModule() ?>?__id=<?= Yii::$app->user->id ?>" class="no-underline">
                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/FinancialSystem/pl_config.svg" class="first-layer-icon" style="margin-top: -3px;">
                                                PL Configuration
                                        </a>
                                </div>
                                <div class="col-12 mt-10">
                                        <a href="<?= Path::fsModule() ?>?__id=<?= Yii::$app->user->id ?>" class="no-underline">
                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/FinancialSystem/golden.svg" class="first-layer-icon" style="margin-top: -3px;">
                                                Golden Ratio
                                        </a>
                                </div>
                                <div class="col-12 mt-10">
                                        <a href="<?= Path::fsModule() ?>?__id=<?= Yii::$app->user->id ?>" class="no-underline">
                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/FinancialSystem/forecast_account.svg" class="first-layer-icon" style="margin-top: -3px;">
                                                Forecast Account
                                        </a>
                                </div>
                                <div class="col-12 mt-10">
                                        <a href="<?= Path::fsModule() ?>?__id=<?= Yii::$app->user->id ?>" class="no-underline">
                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/FinancialSystem/currency.svg" class="first-layer-icon" style="margin-top: -3px;">
                                                Currency Management
                                        </a>
                                </div>
                                <!-- <span style="float: right;">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/others/6.svg" class="first-layer-icon" style="cursor:pointer;margin-top: -3px;display:none;" onclick="javascript:hideGroupMenu('financial-planing')" id="financial-planing-hide">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/others/6-1.svg" class="first-layer-icon" style="cursor:pointer;margin-top: -3px;" onclick="javascript:showGroupMenu('financial-planing')" id="financial-planing-show">
                                </span> -->
                        </div>
                        <div id="financial-planing" style="display:none;">
                                <!-- <div class="col-12 second-layer-menu">
                                        <a href="<?= Path::fsModule() ?>?__id=<?= Yii::$app->user->id ?>" class="no-underline">
                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/FinancialSystem/Group289674.svg" class="first-layer-icon" style="margin-top: -3px;">
                                                Profit & Loss (PL Forecase)
                                        </a>
                                </div>
                                <div class="col-12 second-layer-menu">
                                        <a href="<?= Path::fsModule() ?>?__id=<?= Yii::$app->user->id ?>" class="no-underline">
                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/FinancialSystem/Group289729.png" class="first-layer-icon" style="margin-top: -3px;">
                                                Golden Ratio (GR)
                                        </a>
                                </div>
                                <div class="col-12 second-layer-menu">
                                        <a href="<?= Path::fsModule() ?>?__id=<?= Yii::$app->user->id ?>" class="no-underline">
                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/FinancialSystem/Group289730.png" class="first-layer-icon" style="margin-top: -3px;">
                                                Forecase Accounts(FA)
                                        </a>
                                </div> -->
                        </div>
                </div>
        </div>
        <div class="col-12 mt-20 box-bnt-home">
                <div class="btn-group-menu">
                        <div class="row">
                                <div class="col-2 pl-20">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/PerformanceMatrices/Performance.svg" class="home-icon2" style="margin-top: -3px;">
                                </div>
                                <div class="col-8 text-center pr-0 pl-0">Performance Matrices</div>
                                <div class="col-2 pr-0 pl-5 text-start">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/others/4.svg" class="home-icon" style="margin-top: -3px;cursor: pointer;display:none;" onclick="javascript:hideGroupMenu('performance-matrices')" id="performance-matrices-hide">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/others/7.svg" class="home-icon" style="margin-top: -3px;cursor: pointer;" onclick="javascript:showGroupMenu('performance-matrices')" id="performance-matrices-show">
                                </div>
                        </div>
                </div>
                <div id="performance-matrices" style="display: none;">
                        <div class="col-12 first-layer-manu">
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/PerformanceMatrices/performance.svg" class="first-layer-icon2" style="margin-top: -3px;">
                                Performance Dashboard
                                <span style="float: right;">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/others/6.svg" class="first-layer-icon" style="cursor:pointer;margin-top: -3px;display:none;" onclick="javascript:hideGroupMenu('performance-dashboard')" id="performance-dashboard-hide">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/others/6-1.svg" class="first-layer-icon" style="cursor:pointer;margin-top: -3px;" onclick="javascript:showGroupMenu('performance-dashboard')" id="performance-dashboard-show">
                                </span>
                        </div>
                        <div id="performance-dashboard" style="display: none;">
                                <div class="col-12 second-layer-menu">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/PerformanceMatrices/KFI.svg" class="first-layer-icon" style="margin-top: -3px;">
                                        <a href="<?= Yii::$app->homeUrl ?>kfi/management/grid" class="no-underline">
                                                Financials
                                        </a>
                                        <span style="float: right;">
                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/others/6.svg" class="first-layer-icon" style="cursor:pointer;margin-top: -3px;display:none;" onclick="javascript:hideGroupMenu('third-layer-kfi')" id="third-layer-kfi-hide">
                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/others/6-1.svg" class="first-layer-icon" style="cursor:pointer;margin-top: -3px;" onclick="javascript:showGroupMenu('third-layer-kfi')" id="third-layer-kfi-show">
                                        </span>
                                        <div class="col-12" id="third-layer-kfi" style="display:none;">
                                                <div class="col-12 third-layer-menu">
                                                        <a href="<?= Yii::$app->homeUrl ?>kfi/management/grid" class="no-underline">
                                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/PerformanceMatrices/KFI.svg" class="first-layer-icon" style="margin-top: -3px;">
                                                                Company KFI
                                                        </a>
                                                </div>
                                        </div>
                                </div>
                                <div class="col-12 second-layer-menu">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/PerformanceMatrices/KGI.svg" class="first-layer-icon" style="margin-top: -3px;">
                                        <a href="<?= Yii::$app->homeUrl ?>kgi/management/grid" class="no-underline">
                                                Goals
                                        </a>
                                        <span style="float: right;">
                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/others/6.svg" class="first-layer-icon" style="cursor:pointer;margin-top: -3px;display:none;" onclick="javascript:hideGroupMenu('third-layer-kgi')" id="third-layer-kgi-hide">
                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/others/6-1.svg" class="first-layer-icon" style="cursor:pointer;margin-top: -3px;" onclick="javascript:showGroupMenu('third-layer-kgi')" id="third-layer-kgi-show">
                                        </span>
                                        <div class="col-12" id="third-layer-kgi" style="display:none;">
                                                <div class="col-12 third-layer-menu">
                                                        <a href="<?= Yii::$app->homeUrl ?>kgi/management/grid" class="no-underline">
                                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/PerformanceMatrices/company.svg" class="first-layer-icon" style="margin-top: -3px;">
                                                                Company KGI
                                                        </a>
                                                </div>
                                                <div class="col-12 third-layer-menu">
                                                        <a href="<?= Yii::$app->homeUrl ?>kgi/kgi-team/team-kgi-grid" class="no-underline">
                                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/PerformanceMatrices/team.svg" class="first-layer-icon" style="margin-top: -3px;">
                                                                Team KGI
                                                        </a>
                                                </div>
                                                <div class="col-12 third-layer-menu">
                                                        <a href="<?= Yii::$app->homeUrl ?>kgi/kgi-personal/individual-kgi-grid" class="no-underline">
                                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/PerformanceMatrices/self.svg" class="first-layer-icon" style="margin-top: -3px;">
                                                                Self KGI
                                                        </a>
                                                </div>
                                        </div>
                                </div>
                                <div class="col-12 second-layer-menu">

                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/PerformanceMatrices/KPI.svg" class="first-layer-icon" style="margin-top: -3px;">
                                        <a href="<?= Yii::$app->homeUrl ?>kpi/management/grid" class="no-underline">
                                                Performance
                                        </a>
                                        <span style="float: right;">
                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/others/6.svg" class="first-layer-icon" style="cursor:pointer;margin-top: -3px;display:none;" onclick="javascript:hideGroupMenu('third-layer-kpi')" id="third-layer-kpi-hide">
                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/others/6-1.svg" class="first-layer-icon" style="cursor:pointer;margin-top: -3px;" onclick="javascript:showGroupMenu('third-layer-kpi')" id="third-layer-kpi-show">
                                        </span>
                                        <div class="col-12" id="third-layer-kpi" style="display:none;">
                                                <div class="col-12 third-layer-menu">
                                                        <a href="<?= Yii::$app->homeUrl ?>kpi/management/grid" class="no-underline">
                                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/PerformanceMatrices/company.svg" class="first-layer-icon" style="margin-top: -3px;">
                                                                Company KPI
                                                        </a>
                                                </div>
                                                <div class="col-12 third-layer-menu">
                                                        <a href="<?= Yii::$app->homeUrl ?>kpi/kpi-team/team-kpi-grid" class="no-underline">
                                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/PerformanceMatrices/team.svg" class="first-layer-icon" style="margin-top: -3px;">
                                                                Team KPI
                                                        </a>
                                                </div>
                                                <div class="col-12 third-layer-menu">
                                                        <a href="<?= Yii::$app->homeUrl ?>kpi/kpi-personal/individual-kpi-grid" class="no-underline">
                                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/PerformanceMatrices/self.svg" class="first-layer-icon" style="margin-top: -3px;">
                                                                Self KPI
                                                        </a>
                                                </div>
                                        </div>
                                </div>
                        </div>
                </div>
        </div>
        <div class="col-12 mt-20 box-bnt-home">
                <div class="btn-group-menu">
                        <div class="row">
                                <div class="col-2 pl-20">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/Evaluation/evaluation_system.svg" class="home-icon" style="margin-top: -3px;">
                                </div>
                                <div class="col-8 text-center pr-0 pl-0">Evaluation System</div>
                                <div class="col-2 pr-0 pl-5 text-start">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/others/4.svg" class="home-icon" style="margin-top: -3px;cursor: pointer;display:none;" onclick="javascript:hideGroupMenu('evaluation-system')" id="evaluation-system-hide">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/others/7.svg" class="home-icon" style="margin-top: -3px;cursor: pointer;" onclick="javascript:showGroupMenu('evaluation-system')" id="evaluation-system-show">
                                </div>
                        </div>
                </div>
                <div id="evaluation-system" style="display: none;">
                        <div class="col-12 first-layer-manu">
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/Evaluation/evaluation_system.svg" class="first-layer-icon" style="margin-top: -3px;">
                                <a href="<?= Yii::$app->homeUrl ?>evaluation/environment" class="no-underline">
                                        Evaluation Environment
                                </a>
                                <span style="float: right;">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/others/6.svg" class="first-layer-icon" style="cursor:pointer;margin-top: -3px;display:none;" onclick="javascript:hideGroupMenu('evaluation-environment')" id="evaluation-environment-hide">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/others/6-1.svg" class="first-layer-icon" style="cursor:pointer;margin-top: -3px;" onclick="javascript:showGroupMenu('evaluation-environment')" id="evaluation-environment-show">
                                </span>
                        </div>
                        <div id="evaluation-environment" style="display:none;">
                                <div class="col-12 second-layer-menu">
                                        <a href="<?= Yii::$app->homeUrl ?>home/dashboard" class="no-underline">
                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/Evaluation/progress.svg" class="first-layer-icon" style="margin-top: -3px;">
                                                Progress Dashboard
                                        </a>
                                </div>
                                <div class="col-12 second-layer-menu">
                                        <a href="<?= Yii::$app->homeUrl ?>evaluation/salary/index" class="no-underline">
                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/Evaluation/salary.svg" class="first-layer-icon" style="margin-top: -3px;">
                                                Salary Registeration
                                        </a>
                                </div>
                                <div class="col-12 second-layer-menu">
                                        <a href="" class="no-underline">
                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/Evaluation/performance.svg" class="first-layer-icon" style="margin-top: -3px;">
                                                Performance
                                        </a>
                                        <span style="float: right;">
                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/others/6.svg" class="first-layer-icon" style="cursor:pointer;margin-top: -3px;display:none;" onclick="javascript:hideGroupMenu('third-layer-performane')" id="third-layer-performane-hide">
                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/others/6-1.svg" class="first-layer-icon" style="cursor:pointer;margin-top: -3px;" onclick="javascript:showGroupMenu('third-layer-performane')" id="third-layer-performane-show">
                                        </span>
                                        <div class="col-12" id="third-layer-performane" style="display:none;">
                                                <div class="col-12 third-layer-menu">
                                                        <a href="" class="no-underline">
                                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/Evaluation/company.svg" class="first-layer-icon" style="margin-top: -3px;">
                                                                Company
                                                        </a>
                                                </div>
                                                <div class="col-12 third-layer-menu">
                                                        <a href="" class="no-underline">
                                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/Evaluation/self.svg" class="first-layer-icon" style="margin-top: -3px;">
                                                                Indevidual
                                                        </a>
                                                </div>
                                        </div>
                                </div>
                        </div>
                </div>
        </div>
        <div class="col-12 mt-20 box-bnt-home">
                <div class="btn-group-menu">
                        <div class="row">
                                <div class="col-2 pl-20">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/BehavioralEvaluation/evaluation.svg" class="home-icon" style="margin-top: -3px;">
                                </div>
                                <div class="col-8 text-center pr-0 pl-0">Behavioral Evaluation</div>
                                <div class="col-2 pr-0 pl-5 text-start">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/others/4.svg" class="home-icon" style="margin-top: -3px;cursor: pointer;display:none;" onclick="javascript:hideGroupMenu('behavioral-evaluation')" id="behavioral-evaluation-hide">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/others/7.svg" class="home-icon" style="margin-top: -3px;cursor: pointer;" onclick="javascript:showGroupMenu('behavioral-evaluation')" id="behavioral-evaluation-show">
                                </div>
                        </div>
                </div>
                <div id="behavioral-evaluation" style="display: none;">
                        <div class="col-12 first-layer-manu">
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/BehavioralEvaluation/evaluation.svg" class="first-layer-icon" style="margin-top: -3px;">
                                Behavioral Indicator
                                <span style="float: right;">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/others/6.svg" class="first-layer-icon" style="cursor:pointer;margin-top: -3px;display:none;" onclick="javascript:hideGroupMenu('behavioral-indicator')" id="behavioral-indicator-hide">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/others/6-1.svg" class="first-layer-icon" style="cursor:pointer;margin-top: -3px;" onclick="javascript:showGroupMenu('behavioral-indicator')" id="behavioral-indicator-show">
                                </span>
                        </div>
                        <div id="behavioral-indicator" style="display: none;">
                                <div class="col-12 second-layer-menu">
                                        <a href="<?= Yii::$app->homeUrl ?>kfi/management/grid" class="no-underline">
                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/BehavioralEvaluation/evaluation_portal.svg" class="first-layer-icon" style="margin-top: -3px;">
                                                Behavior Portal
                                        </a>
                                </div>
                                <div class="col-12 second-layer-menu">
                                        <a href="<?= Yii::$app->homeUrl ?>kfi/management/grid" class="no-underline">
                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/BehavioralEvaluation/registeration.svg" class="first-layer-icon" style="margin-top: -3px;">
                                                Registeration & Config
                                        </a>
                                </div>
                        </div>
                        <div class="col-12 first-layer-manu">
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/BehavioralEvaluation/360.svg" class="first-layer-icon" style="margin-top: -3px;">
                                360 Degree Evaluation
                        </div>
                        <div class="col-12 first-layer-manu">
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/BehavioralEvaluation/company_dashboard.svg" class="first-layer-icon" style="margin-top: -3px;">
                                Company Dashboard
                                <span style="float: right;">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/others/6.svg" class="first-layer-icon" style="cursor:pointer;margin-top: -3px;display:none;" onclick="javascript:hideGroupMenu('company-dashboard')" id="company-dashboard-hide">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/others/6-1.svg" class="first-layer-icon" style="cursor:pointer;margin-top: -3px;" onclick="javascript:showGroupMenu('company-dashboard')" id="company-dashboard-show">
                                </span>
                        </div>
                        <div id="company-dashboard" style="display:none;">
                                <div class="col-12 second-layer-menu">
                                        <a href="<?= Yii::$app->homeUrl ?>kfi/management/grid" class="no-underline">
                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/BehavioralEvaluation/template_board.svg" class="first-layer-icon" style="margin-top: -3px;">
                                                Template Board
                                        </a>
                                </div>
                                <div class="col-12 second-layer-menu">
                                        <a href="<?= Yii::$app->homeUrl ?>kfi/management/grid" class="no-underline">
                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/BehavioralEvaluation/question_bank.svg" class="first-layer-icon" style="margin-top: -3px;">
                                                Question Bank
                                        </a>
                                </div>
                                <div class="col-12 second-layer-menu">
                                        <a href="<?= Yii::$app->homeUrl ?>kfi/management/grid" class="no-underline">
                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/BehavioralEvaluation/my_360.svg" class="first-layer-icon" style="margin-top: -3px;">
                                                My 360
                                        </a>
                                </div>
                                <div class="col-12 second-layer-menu">
                                        <a href="<?= Yii::$app->homeUrl ?>kfi/management/grid" class="no-underline">
                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/BehavioralEvaluation/my_portal.svg" class="first-layer-icon" style="margin-top: -3px;">
                                                My Portal
                                        </a>
                                </div>
                        </div>
                </div>
        </div>
        <div class="col-12 mt-20 box-bnt-home mb-10">
                <div class="btn-hrvc-home">
                        <a href="<?= Yii::$app->homeUrl ?>site/index" class="text-light" style="text-decoration: none;"> <span>
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/others/8.svg" class="home-icon" style="margin-top: -3px;">
                                </span> Setting
                        </a>
                </div>
        </div>
        <!-- <div class="col-12 navbar-header pl-15">
                <div class="col-12 haeder-Evalution"> EVALUTION SETTINGS</div>
                <div class="col-12">
                        <a href="<?php // Yii::$app->homeUrl 
                                        ?>evaluation/environment" class="no-underline">
                                <i class="fa fa-pencil-square-o pr-10 mt-20" aria-hidden="true"></i>
                                Evaluation
                        </a>
                </div>
                <div class="col-12">
                        <a href="<?php // Yii::$app->homeUrl 
                                        ?>evaluation/salary/index" class="no-underline">
                                <i class="fa fa-usd pr-10 mt-20" aria-hidden="true"></i>
                                Salary
                        </a>
                </div>
                <div class="col-12"> <a href="<?php //Yii::$app->homeUrl 
                                                ?>site/" class="no-underline"><i class="fa fa-history pr-10 mt-20" aria-hidden="true"></i> 360 Degree Evaluetion</a></div>
                <div class="col-12 haeder-Evalution"> REPORTS</div>
                <div class="col-12"> <a href="<?php // Yii::$app->homeUrl 
                                                ?>site/analysis" class="no-underline"><i class="fa fa-pie-chart pr-10 mt-20" aria-hidden="true"></i> Analysis</a></div>
                <div class="col-12 haeder-Evalution">
                        <a href="<?php // Path::fsModule() 
                                        ?>?__id=<?php // Yii::$app->user->id 
                                                ?>" class="no-underline">
                                Financial Planning
                        </a>
                </div>
                <div class="col-12 haeder-Evalution"> ADMIN SETTINGS</div>
                <div class="col-12"> <a href="" class="no-underline"><i class="fa fa-user pr-10 mt-20" aria-hidden="true"></i> Admin</a></div>
                <div class="col-12"> <a href="" class="no-underline"><i class="fa fa-sun-o pr-10 mt-20" aria-hidden="true"></i> Super admin</a></div>
                <div class="col-12"> <a href="" class="no-underline"><i class="fa fa-bell-o pr-10 mt-20" aria-hidden="true"></i> Notification Center</a></div>
        </div> -->


</div>