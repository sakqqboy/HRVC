<?php

use common\helpers\Path;
use common\models\ModelMaster;
use frontend\models\hrvc\UserRole;

?>
<div class="col-12">
        <div class="col-12 pl-5 pr-8 pt-20 text-center">
                <a href="<?= Yii::$app->homeUrl ?>site/index">
                        <div class="col-12">
                                <img src="<?= Yii::$app->homeUrl ?>image/logo-hrvc-text.png" class="hrvc-logo">
                        </div>
                </a>
        </div>
        <div class="col-12 text-under-logo text-center">
                GIVES YOU VISIONARY EXPERIENCE
        </div>
        <div class="col-12 mt-20 box-bnt-home">
                <div class="btn-hrvc-home">
                        <a href="<?= Yii::$app->homeUrl ?>site/index" class="text-light" style="text-decoration: none;"> <span>
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/others/home.png" class="home-icon" style="margin-top: -3px;">
                                </span> Home
                        </a>
                </div>
        </div>
        <div class="col-12 mt-20 box-bnt-home">
                <div class="btn-group-menu mb-10">
                        <div class="row">
                                <div class="col-2 pl-20">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/MasterSetting/Vector-1.png" class="home-icon" style="margin-top: -3px;">
                                </div>
                                <div class="col-8 text-center pr-0 pl-0">GROUP MANAGEMENT</div>
                                <div class="col-2 pr-0 pl-5 text-start">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/others/4.png" class="home-icon" style="margin-top: -3px;cursor: pointer;display:none;" onclick="javascript:hideGroupMenu('group-management')" id="group-management-hide">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/others/7.png" class="home-icon" style="margin-top: -3px;cursor: pointer;" onclick="javascript:showGroupMenu('group-management')" id="group-management-show">
                                </div>
                        </div>
                </div>
                <div id="group-management" style="display:none;">
                        <?php
                        $role = UserRole::userRight();
                        if ($role >= 2) {
                                if ($role >= 5) {
                        ?>
                                        <div class="col-12 first-layer-manu">
                                                <a href="<?= Yii::$app->homeUrl ?>setting/group/create-group" class="no-underline">
                                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/MasterSetting/Vector-1.png" class="first-layer-icon" style="margin-top: -3px;">
                                                        Group Information
                                                </a>
                                        </div>
                                        <div class="col-12 first-layer-manu">
                                                <a href="<?= Yii::$app->homeUrl ?>setting/company/index" class="no-underline">
                                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/MasterSetting/Vector-2.png" class="first-layer-icon" style="margin-top: -3px;">
                                                        Company Information
                                                </a>
                                        </div>
                                        <div class="col-12 first-layer-manu">
                                                <a href="<?= Yii::$app->homeUrl ?>setting/branch/create/<?= ModelMaster::encodeParams(['companyId' => '']) ?>" class="no-underline">
                                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/MasterSetting/Vector.png" class="first-layer-icon" style="margin-top: -3px;">
                                                        Branch </a>
                                        </div>
                                        <div class="col-12 first-layer-manu">
                                                <a href="<?= Yii::$app->homeUrl ?>setting/department/create/<?= ModelMaster::encodeParams(['companyId' => '']) ?>" class="no-underline">
                                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/MasterSetting/Vector-3.png" class="first-layer-icon" style="margin-top: -3px;">
                                                        Department
                                                </a>
                                        </div>
                                        <div class="col-12 first-layer-manu">
                                                <a href="<?= Yii::$app->homeUrl ?>setting/team/create/<?= ModelMaster::encodeParams(['companyId' => '']) ?>" class="no-underline">
                                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/MasterSetting/Vector-4.png" class="first-layer-icon" style="margin-top: -3px;">
                                                        Team
                                                </a>
                                        </div>
                                <?php
                                }
                                $isHr = UserRole::isHr();
                                if ($isHr == 1 || $role >= 5) {
                                ?>
                                        <div class="col-12 first-layer-manu">
                                                <a href="<?= Yii::$app->homeUrl ?>setting/employee/index/<?= ModelMaster::encodeParams(['companyId' => ''])
                                                                                                                ?>" class="no-underline">
                                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/MasterSetting/Vector-5.png" class="first-layer-icon" style="margin-top: -3px;">
                                                        Employee
                                                </a>
                                        </div>
                                <?php
                                }
                                if ($role >= 5) {
                                ?>
                                        <div class="col-12 first-layer-manu">
                                                <a href="<?= Yii::$app->homeUrl ?>setting/title/index" class="no-underline">
                                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/MasterSetting/Vector-6.png" class="first-layer-icon" style="margin-top: -3px;">
                                                        Title
                                                </a>
                                        </div>

                                        <div class="col-12 first-layer-manu">
                                                <a href="<?= Yii::$app->homeUrl ?>setting/layer/index" class="no-underline">
                                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/MasterSetting/Vector-7.png" class="first-layer-icon" style="margin-top: -3px;">
                                                        Management Layer
                                                </a>
                                        </div>
                        <?php
                                }
                        }
                        ?>
                </div>
        </div>
        <div class="col-12 mt-20 box-bnt-home">
                <div class="btn-group-menu">
                        <div class="row">
                                <div class="col-2 pl-20">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/FinancialSystem/Vector.png" class="home-icon" style="margin-top: -3px;">
                                </div>
                                <div class="col-8 text-center pr-0 pl-0">FINANCIAL SYSTEM</div>
                                <div class="col-2 pr-0 pl-5 text-start">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/others/4.png" class="home-icon" style="margin-top: -3px;cursor: pointer;display:none;" onclick="javascript:hideGroupMenu('financial-system')" id="financial-system-hide">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/others/7.png" class="home-icon" style="margin-top: -3px;cursor: pointer;" onclick="javascript:showGroupMenu('financial-system')" id="financial-system-show">
                                </div>
                        </div>
                </div>
                <div id="financial-system" style="display: none;">
                        <div class="col-12 first-layer-manu">
                                <a href="<?= Path::fsModule() ?>?__id=<?= Yii::$app->user->id ?>" class="no-underline">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/FinancialSystem/Vector.png" class="first-layer-icon" style="margin-top: -3px;">
                                        Financial Planning
                                </a>
                                <span style="float: right;">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/others/6.png" class="first-layer-icon" style="cursor:pointer;margin-top: -3px;display:none;" onclick="javascript:hideGroupMenu('financial-planing')" id="financial-planing-hide">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/others/6-1.png" class="first-layer-icon" style="cursor:pointer;margin-top: -3px;" onclick="javascript:showGroupMenu('financial-planing')" id="financial-planing-show">
                                </span>
                        </div>
                        <div id="financial-planing" style="display:none;">
                                <div class="col-12 second-layer-menu">
                                        <a href="<?= Path::fsModule() ?>?__id=<?= Yii::$app->user->id ?>" class="no-underline">
                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/FinancialSystem/Group289674.png" class="first-layer-icon" style="margin-top: -3px;">
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
                                </div>
                        </div>
                </div>
        </div>
        <div class="col-12 mt-20 box-bnt-home">
                <div class="btn-group-menu">
                        <div class="row">
                                <div class="col-2 pl-20">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/PerformanceMatrices/Group289706.png" class="home-icon2" style="margin-top: -3px;">
                                </div>
                                <div class="col-8 text-center pr-0 pl-0">Performance Matrices</div>
                                <div class="col-2 pr-0 pl-5 text-start">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/others/4.png" class="home-icon" style="margin-top: -3px;cursor: pointer;display:none;" onclick="javascript:hideGroupMenu('performance-matrices')" id="performance-matrices-hide">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/others/7.png" class="home-icon" style="margin-top: -3px;cursor: pointer;" onclick="javascript:showGroupMenu('performance-matrices')" id="performance-matrices-show">
                                </div>
                        </div>
                </div>
                <div id="performance-matrices" style="display: none;">
                        <div class="col-12 first-layer-manu">
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/PerformanceMatrices/Group289706.png" class="first-layer-icon2" style="margin-top: -3px;">
                                Performance Dashboard
                                <span style="float: right;">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/others/6.png" class="first-layer-icon" style="cursor:pointer;margin-top: -3px;display:none;" onclick="javascript:hideGroupMenu('performance-dashboard')" id="performance-dashboard-hide">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/others/6-1.png" class="first-layer-icon" style="cursor:pointer;margin-top: -3px;" onclick="javascript:showGroupMenu('performance-dashboard')" id="performance-dashboard-show">
                                </span>
                        </div>
                        <div id="performance-dashboard" style="display: none;">
                                <div class="col-12 second-layer-menu">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/PerformanceMatrices/Group289709.png" class="first-layer-icon" style="margin-top: -3px;">
                                        <a href="<?= Yii::$app->homeUrl ?>kfi/management/grid" class="no-underline">
                                                KFI Management
                                        </a>
                                        <span style="float: right;">
                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/others/6.png" class="first-layer-icon" style="cursor:pointer;margin-top: -3px;display:none;" onclick="javascript:hideGroupMenu('third-layer-kfi')" id="third-layer-kfi-hide">
                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/others/6-1.png" class="first-layer-icon" style="cursor:pointer;margin-top: -3px;" onclick="javascript:showGroupMenu('third-layer-kfi')" id="third-layer-kfi-show">
                                        </span>
                                        <div class="col-12" id="third-layer-kfi" style="display:none;">
                                                <div class="col-12 third-layer-menu">
                                                        <a href="<?= Yii::$app->homeUrl ?>kfi/management/grid" class="no-underline">
                                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/PerformanceMatrices/Group289709.png" class="first-layer-icon" style="margin-top: -3px;">
                                                                KFI Module
                                                        </a>
                                                </div>
                                                <div class="col-12 third-layer-menu">
                                                        <a href="<?= Yii::$app->homeUrl ?>kfi/management/grid" class="no-underline">
                                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/PerformanceMatrices/Group289848.png" class="first-layer-icon" style="margin-top: -3px;">
                                                                Assign
                                                        </a>
                                                </div>
                                        </div>
                                </div>
                                <div class="col-12 second-layer-menu">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/PerformanceMatrices/Vector-1.png" class="first-layer-icon" style="margin-top: -3px;">
                                        <a href="<?= Yii::$app->homeUrl ?>kgi/management/grid" class="no-underline">
                                                KGI Management
                                        </a>
                                        <span style="float: right;">
                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/others/6.png" class="first-layer-icon" style="cursor:pointer;margin-top: -3px;display:none;" onclick="javascript:hideGroupMenu('third-layer-kgi')" id="third-layer-kgi-hide">
                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/others/6-1.png" class="first-layer-icon" style="cursor:pointer;margin-top: -3px;" onclick="javascript:showGroupMenu('third-layer-kgi')" id="third-layer-kgi-show">
                                        </span>
                                        <div class="col-12" id="third-layer-kgi" style="display:none;">
                                                <div class="col-12 third-layer-menu">
                                                        <a href="<?= Yii::$app->homeUrl ?>kgi/management/grid" class="no-underline">
                                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/PerformanceMatrices/Vector-1.png" class="first-layer-icon" style="margin-top: -3px;">
                                                                KGI Module
                                                        </a>
                                                </div>
                                                <div class="col-12 third-layer-menu">
                                                        <a href="<?= Yii::$app->homeUrl ?>kgi/management/grid" class="no-underline">
                                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/PerformanceMatrices/Group289848.png" class="first-layer-icon" style="margin-top: -3px;">
                                                                Assign
                                                        </a>
                                                </div>
                                        </div>
                                </div>
                                <div class="col-12 second-layer-menu">

                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/PerformanceMatrices/Vector.png" class="first-layer-icon" style="margin-top: -3px;">
                                        <a href="<?= Yii::$app->homeUrl ?>kpi/management/grid" class="no-underline">
                                                KPI Management
                                        </a>
                                        <span style="float: right;">
                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/others/6.png" class="first-layer-icon" style="cursor:pointer;margin-top: -3px;display:none;" onclick="javascript:hideGroupMenu('third-layer-kpi')" id="third-layer-kpi-hide">
                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/others/6-1.png" class="first-layer-icon" style="cursor:pointer;margin-top: -3px;" onclick="javascript:showGroupMenu('third-layer-kpi')" id="third-layer-kpi-show">
                                        </span>
                                        <div class="col-12" id="third-layer-kpi" style="display:none;">
                                                <div class="col-12 third-layer-menu">
                                                        <a href="<?= Yii::$app->homeUrl ?>kpi/management/grid" class="no-underline">
                                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/PerformanceMatrices/Vector.png" class="first-layer-icon" style="margin-top: -3px;">
                                                                KPI Module
                                                        </a>
                                                </div>
                                                <div class="col-12 third-layer-menu">
                                                        <a href="<?= Yii::$app->homeUrl ?>kpi/management/grid" class="no-underline">
                                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/PerformanceMatrices/Group289848.png" class="first-layer-icon" style="margin-top: -3px;">
                                                                Assign
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
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/Evaluation/Group21321.png" class="home-icon" style="margin-top: -3px;">
                                </div>
                                <div class="col-8 text-center pr-0 pl-0">Evaluation System</div>
                                <div class="col-2 pr-0 pl-5 text-start">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/others/4.png" class="home-icon" style="margin-top: -3px;cursor: pointer;display:none;" onclick="javascript:hideGroupMenu('evaluation-system')" id="evaluation-system-hide">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/others/7.png" class="home-icon" style="margin-top: -3px;cursor: pointer;" onclick="javascript:showGroupMenu('evaluation-system')" id="evaluation-system-show">
                                </div>
                        </div>
                </div>
                <div id="evaluation-system" style="display: none;">
                        <div class="col-12 first-layer-manu">
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/Evaluation/Group21321.png" class="first-layer-icon" style="margin-top: -3px;">
                                <a href="<?= Yii::$app->homeUrl ?>evaluation/environment" class="no-underline">
                                        Evaluation Environment
                                </a>
                                <span style="float: right;">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/others/6.png" class="first-layer-icon" style="cursor:pointer;margin-top: -3px;display:none;" onclick="javascript:hideGroupMenu('evaluation-environment')" id="evaluation-environment-hide">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/others/6-1.png" class="first-layer-icon" style="cursor:pointer;margin-top: -3px;" onclick="javascript:showGroupMenu('evaluation-environment')" id="evaluation-environment-show">
                                </span>
                        </div>
                        <div id="evaluation-environment" style="display:none;">
                                <div class="col-12 second-layer-menu">
                                        <a href="<?= Yii::$app->homeUrl ?>home/dashboard" class="no-underline">
                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/Evaluation/Group29895.png" class="first-layer-icon" style="margin-top: -3px;">
                                                Progress Dashboard
                                        </a>
                                </div>
                                <div class="col-12 second-layer-menu">
                                        <a href="<?= Yii::$app->homeUrl ?>evaluation/salary/index" class="no-underline">
                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/Evaluation/Vector.png" class="first-layer-icon" style="margin-top: -3px;">
                                                Salary Registeration
                                        </a>
                                </div>
                                <div class="col-12 second-layer-menu">
                                        <a href="" class="no-underline">
                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/Evaluation/Group289710.png" class="first-layer-icon" style="margin-top: -3px;">
                                                Performance
                                        </a>
                                        <span style="float: right;">
                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/others/6.png" class="first-layer-icon" style="cursor:pointer;margin-top: -3px;display:none;" onclick="javascript:hideGroupMenu('third-layer-performane')" id="third-layer-performane-hide">
                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/others/6-1.png" class="first-layer-icon" style="cursor:pointer;margin-top: -3px;" onclick="javascript:showGroupMenu('third-layer-performane')" id="third-layer-performane-show">
                                        </span>
                                        <div class="col-12" id="third-layer-performane" style="display:none;">
                                                <div class="col-12 third-layer-menu">
                                                        <a href="" class="no-underline">
                                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/Evaluation/Group289855.png" class="first-layer-icon" style="margin-top: -3px;">
                                                                Company
                                                        </a>
                                                </div>
                                                <div class="col-12 third-layer-menu">
                                                        <a href="" class="no-underline">
                                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/Evaluation/Group289847.png" class="first-layer-icon" style="margin-top: -3px;">
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
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/BehavioralEvaluation/Group289716.png" class="home-icon" style="margin-top: -3px;">
                                </div>
                                <div class="col-8 text-center pr-0 pl-0">Behavioral Evaluation</div>
                                <div class="col-2 pr-0 pl-5 text-start">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/others/4.png" class="home-icon" style="margin-top: -3px;cursor: pointer;display:none;" onclick="javascript:hideGroupMenu('behavioral-evaluation')" id="behavioral-evaluation-hide">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/others/7.png" class="home-icon" style="margin-top: -3px;cursor: pointer;" onclick="javascript:showGroupMenu('behavioral-evaluation')" id="behavioral-evaluation-show">
                                </div>
                        </div>
                </div>
                <div id="behavioral-evaluation" style="display: none;">
                        <div class="col-12 first-layer-manu">
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/BehavioralEvaluation/Group289716.png" class="first-layer-icon" style="margin-top: -3px;">
                                Behavioral Indicator
                                <span style="float: right;">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/others/6.png" class="first-layer-icon" style="cursor:pointer;margin-top: -3px;display:none;" onclick="javascript:hideGroupMenu('behavioral-indicator')" id="behavioral-indicator-hide">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/others/6-1.png" class="first-layer-icon" style="cursor:pointer;margin-top: -3px;" onclick="javascript:showGroupMenu('behavioral-indicator')" id="behavioral-indicator-show">
                                </span>
                        </div>
                        <div id="behavioral-indicator" style="display: none;">
                                <div class="col-12 second-layer-menu">
                                        <a href="<?= Yii::$app->homeUrl ?>kfi/management/grid" class="no-underline">
                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/BehavioralEvaluation/Group289720.png" class="first-layer-icon" style="margin-top: -3px;">
                                                Behavior Portal
                                        </a>
                                </div>
                                <div class="col-12 second-layer-menu">
                                        <a href="<?= Yii::$app->homeUrl ?>kfi/management/grid" class="no-underline">
                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/BehavioralEvaluation/Group289854.png" class="first-layer-icon" style="margin-top: -3px;">
                                                Registeration & Config
                                        </a>
                                </div>
                        </div>
                        <div class="col-12 first-layer-manu">
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/BehavioralEvaluation/Group289853.png" class="first-layer-icon" style="margin-top: -3px;">
                                360 Degree Evaluation
                        </div>
                        <div class="col-12 first-layer-manu">
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/BehavioralEvaluation/Group289852.png" class="first-layer-icon" style="margin-top: -3px;">
                                Company Dashboard
                                <span style="float: right;">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/others/6.png" class="first-layer-icon" style="cursor:pointer;margin-top: -3px;display:none;" onclick="javascript:hideGroupMenu('company-dashboard')" id="company-dashboard-hide">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/others/6-1.png" class="first-layer-icon" style="cursor:pointer;margin-top: -3px;" onclick="javascript:showGroupMenu('company-dashboard')" id="company-dashboard-show">
                                </span>
                        </div>
                        <div id="company-dashboard" style="display:none;">
                                <div class="col-12 second-layer-menu">
                                        <a href="<?= Yii::$app->homeUrl ?>kfi/management/grid" class="no-underline">
                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/BehavioralEvaluation/Group289849.png" class="first-layer-icon" style="margin-top: -3px;">
                                                Template Board
                                        </a>
                                </div>
                                <div class="col-12 second-layer-menu">
                                        <a href="<?= Yii::$app->homeUrl ?>kfi/management/grid" class="no-underline">
                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/BehavioralEvaluation/Group289850.png" class="first-layer-icon" style="margin-top: -3px;">
                                                Question Bank
                                        </a>
                                </div>
                                <div class="col-12 second-layer-menu">
                                        <a href="<?= Yii::$app->homeUrl ?>kfi/management/grid" class="no-underline">
                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/BehavioralEvaluation/Group289851.png" class="first-layer-icon" style="margin-top: -3px;">
                                                My 360
                                        </a>
                                </div>
                                <div class="col-12 second-layer-menu">
                                        <a href="<?= Yii::$app->homeUrl ?>kfi/management/grid" class="no-underline">
                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/BehavioralEvaluation/Group289845.png" class="first-layer-icon" style="margin-top: -3px;">
                                                My Portal
                                        </a>
                                </div>
                        </div>
                </div>
        </div>
        <div class="col-12 mt-20 box-bnt-home mb-10">
                <div class="btn-hrvc-home">
                        <a href="<?= Yii::$app->homeUrl ?>site/index" class="text-light" style="text-decoration: none;"> <span>
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/others/8.png" class="home-icon" style="margin-top: -3px;">
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