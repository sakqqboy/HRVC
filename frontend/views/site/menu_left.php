<?php

use common\helpers\Path;
use common\models\ModelMaster;
use frontend\models\hrvc\UserRole;

$session = Yii::$app->session;
?>
<div class="col-12">
        <div class="col-12">
                <a href="<?= Yii::$app->homeUrl ?>site/index">
                        <div class="col-12">
                                <img src="<?= Yii::$app->homeUrl ?>image/logo-hrvc-text.svg">
                        </div>
                </a>
        </div>
        <div class="col-12 text-under-logo text-center">
                <?= Yii::t('app', 'Enchance Visionary Consulting') ?>
        </div>
        <div class="btn-hrvc-home mt-20 font-size-16" style="font-weight:500;">
                <a href="<?= Yii::$app->homeUrl ?>site/index" class="text-light" style="text-decoration: none;">
                        <span>
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/others/home.svg" class="home-icon mr-7" style="margin-top: -3px;">
                        </span> <?= Yii::t('app', 'Home') ?>
                </a>
        </div>
        <div class="col-12 mt-20">
                <?php
                $role = UserRole::userRight();
                if ($role >= 2) {
                ?>
                        <div class="btn-group-menu">
                                <div class="row">
                                        <div class="col-2 pl-20">
                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/MasterSetting/group.svg" class="home-icon" style="margin-top: -3px;">
                                        </div>
                                        <div class="col-8 text-start pr-0 pl-5"><?= Yii::t('app', 'Group Management') ?></div>
                                        <div class="col-2 pr-0 pl-5 text-start">
                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/others/4.svg" class="home-icon" style="margin-top: -3px;cursor: pointer;display:<?= $session->has('group-management') ? '' : 'none' ?>;" onclick="javascript:hideGroupMenu('group-management')" id="group-management-hide">
                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/others/7.svg" class="home-icon" style="margin-top: -3px;cursor: pointer;display:<?= $session->has('group-management') ? 'none' : '' ?>" onclick="javascript:showGroupMenu('group-management')" id="group-management-show">
                                        </div>
                                </div>
                        </div>
                        <div id="group-management" style="display:<?= $session->has('group-management') ? '' : 'none' ?>;">
                                <?php
                                if ($role >= 5) {
                                ?>
                                        <div class="col-12 first-layer-manu">
                                                <a href="<?= Yii::$app->homeUrl ?>setting/group/create-group" class="no-underline">
                                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/MasterSetting/group.svg" class="first-layer-icon" style="margin-top: -3px;">
                                                        <?= Yii::t('app', 'Group Configuration') ?>
                                                </a>
                                        </div>
                                        <div class="col-12 first-layer-manu">
                                                <a href="<?= Yii::$app->homeUrl ?>setting/company/index" class="no-underline">
                                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/MasterSetting/company.svg" class="first-layer-icon" style="margin-top: -3px;">

                                                        <?= Yii::t('app', 'Company Information') ?>
                                                </a>
                                        </div>
                                        <div class="col-12 first-layer-manu">
                                                <a href="<?= Yii::$app->homeUrl ?>setting/branch/create/<?= ModelMaster::encodeParams(['companyId' => '']) ?>" class="no-underline">
                                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/others/branch.svg" class="first-layer-icon" style="margin-top: -3px;">
                                                        <?= Yii::t('app', 'Branch') ?> </a>
                                        </div>
                                        <div class="col-12 first-layer-manu">
                                                <a href="<?= Yii::$app->homeUrl ?>setting/department/create/<?= ModelMaster::encodeParams(['companyId' => '']) ?>" class="no-underline">
                                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/MasterSetting/department.svg" class="first-layer-icon" style="margin-top: -3px;">
                                                        <?= Yii::t('app', 'Department') ?>
                                                </a>
                                        </div>
                                        <div class="col-12 first-layer-manu">
                                                <a href="<?= Yii::$app->homeUrl ?>setting/team/create/<?= ModelMaster::encodeParams(['companyId' => '']) ?>" class="no-underline">
                                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/MasterSetting/team.svg" class="first-layer-icon" style="margin-top: -3px;">
                                                        <?= Yii::t('app', 'Team') ?>
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
                                                        <?= Yii::t('app', 'Employee') ?>
                                                </a>
                                        </div>
                                <?php
                                }
                                if ($role >= 5) {
                                ?>
                                        <div class="col-12 first-layer-manu">
                                                <a href="<?= Yii::$app->homeUrl ?>setting/title/index" class="no-underline">
                                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/MasterSetting/title.svg" class="first-layer-icon" style="margin-top: -3px;">
                                                        <?= Yii::t('app', 'Title') ?>
                                                </a>
                                        </div>

                                        <div class="col-12 first-layer-manu">
                                                <a href="<?= Yii::$app->homeUrl ?>setting/layer/index" class="no-underline">
                                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/MasterSetting/layer.svg" class="first-layer-icon" style="margin-top: -3px;">
                                                        <?= Yii::t('app', 'Management Layer') ?>
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
        <div class="col-12 mt-20">
                <div class="btn-group-menu">
                        <div class="row">
                                <div class="col-2 pl-20">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/FinancialSystem/fs.svg" class="home-icon" style="margin-top: -3px;">
                                </div>
                                <div class="col-8 text-start pr-0 pl-5"><?= Yii::t('app', 'Financial System') ?></div>
                                <div class="col-2 pr-0 pl-5 text-start">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/others/4.svg" class="home-icon" style="margin-top: -3px;cursor: pointer;display:<?= $session->has('financial-system') ? '' : 'none' ?>;" onclick="javascript:hideGroupMenu('financial-system')" id="financial-system-hide">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/others/7.svg" class="home-icon" style="margin-top: -3px;cursor: pointer;display:<?= $session->has('financial-system') ? 'none' : '' ?>;" onclick="javascript:showGroupMenu('financial-system')" id="financial-system-show">
                                </div>
                        </div>
                </div>
                <div id="financial-system" style="display:<?= $session->has('financial-system') ? '' : 'none' ?>;">

                        <div class="col-12 first-layer-manu">
                                <a href="<?= Path::fsModule() ?>?__id=<?= Yii::$app->user->id ?>" class="no-underline">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/FinancialSystem/dashboard.svg" class="first-layer-icon" style="margin-top: -3px;">
                                        <?= Yii::t('app', 'Dashboard') ?>
                                </a>
                        </div>
                        <div class="col-12 first-layer-manu">
                                <a href="<?= Path::fsModule() ?>?__id=<?= Yii::$app->user->id ?>" class="no-underline">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/FinancialSystem/pl_forecase.svg" class="first-layer-icon" style="margin-top: -3px;">
                                        <?= Yii::t('app', 'PL Forecast') ?>
                                </a>
                        </div>
                        <div class="col-12 first-layer-manu">
                                <a href="<?= Path::fsModule() ?>?__id=<?= Yii::$app->user->id ?>" class="no-underline">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/FinancialSystem/pl_config.svg" class="first-layer-icon" style="margin-top: -3px;">
                                        <?= Yii::t('app', 'PL Configuration') ?>
                                </a>
                        </div>
                        <div class="col-12 first-layer-manu">
                                <a href="<?= Path::fsModule() ?>?__id=<?= Yii::$app->user->id ?>" class="no-underline">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/FinancialSystem/golden.svg" class="first-layer-icon" style="margin-top: -3px;">
                                        <?= Yii::t('app', 'Golden Ratio') ?>
                                </a>
                        </div>
                        <div class="col-12 first-layer-manu">
                                <a href="<?= Path::fsModule() ?>?__id=<?= Yii::$app->user->id ?>" class="no-underline">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/FinancialSystem/forecast_account.svg" class="first-layer-icon" style="margin-top: -3px;">
                                        <?= Yii::t('app', 'Forecast Account') ?>
                                </a>
                        </div>
                        <div class="col-12 first-layer-manu">
                                <a href="<?= Path::fsModule() ?>?__id=<?= Yii::$app->user->id ?>" class="no-underline">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/FinancialSystem/currency.svg" class="first-layer-icon" style="margin-top: -3px;">
                                        <?= Yii::t('app', 'Currency Management') ?>
                                </a>
                        </div>
                </div>
        </div>
        <div class="col-12 mt-20">
                <div class="btn-group-menu">
                        <div class="row">
                                <div class="col-2 pl-20">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/PerformanceMatrices/performance.svg" class="home-icon2" style="margin-top: -3px;">
                                </div>
                                <div class="col-8 text-start pr-0 pl-5"><?= Yii::t('app', 'Performance Matrices') ?></div>
                                <div class="col-2 pr-0 pl-5 text-start">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/others/4.svg" class="home-icon" style="margin-top: -3px;cursor: pointer;display:<?= $session->has('performance-matrices') ? '' : 'none' ?>" onclick="javascript:hideGroupMenu('performance-matrices')" id="performance-matrices-hide">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/others/7.svg" class="home-icon" style="margin-top: -3px;cursor: pointer;display:<?= $session->has('performance-matrices') ? 'none' : '' ?>" onclick="javascript:showGroupMenu('performance-matrices')" id="performance-matrices-show">
                                </div>
                        </div>
                </div>
                <div id="performance-matrices" style="display:<?= $session->has('performance-matrices') ? '' : 'none' ?>;">
                        <div class="col-12 first-layer-manu">
                                <div class="col-12">
                                        <a href="<?= Yii::$app->homeUrl ?>home/default/dashboard" class="no-underline">
                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/FinancialSystem/dashboard.svg" class="first-layer-icon" style="margin-top: -3px;">
                                                <?= Yii::t('app', 'Dashboard') ?>
                                        </a>
                                </div>
                        </div>
                        <div class="col-12 first-layer-manu">
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/PerformanceMatrices/KFI.svg" class="first-layer-icon" style="margin-top: -3px;">
                                <a href="<?= Yii::$app->homeUrl ?>kfi/management/grid" class="no-underline">
                                        <?= Yii::t('app', "Financials") ?>
                                </a>
                                <span style="float: right;">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/others/6.svg" class="first-layer-icon" style="cursor:pointer;margin-top: -3px;display:<?= $session->has('third-layer-kfi') ? '' : 'none' ?>;" onclick="javascript:hideGroupMenu('third-layer-kfi')" id="third-layer-kfi-hide">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/others/6-1.svg" class="first-layer-icon" style="cursor:pointer;margin-top: -3px;display:<?= $session->has('third-layer-kfi') ? 'none' : '' ?>" onclick="javascript:showGroupMenu('third-layer-kfi')" id="third-layer-kfi-show">
                                </span>
                                <div class="col-12" id="third-layer-kfi" style="display:<?= $session->has('third-layer-kfi') ? '' : 'none' ?>;">
                                        <div class="col-12 second-layer-menu">
                                                <a href="<?= Yii::$app->homeUrl ?>kfi/management/grid" class="no-underline">
                                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/PerformanceMatrices/company.svg" class="first-layer-icon" style="margin-top: -3px;">
                                                        <?= Yii::t('app', 'Company KFI') ?>
                                                </a>
                                        </div>
                                </div>
                        </div>
                        <div class="col-12 first-layer-manu">
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/PerformanceMatrices/KGI.svg" class="first-layer-icon" style="margin-top: -3px;">
                                <a href="<?= Yii::$app->homeUrl ?>kgi/management/grid" class="no-underline">
                                        <?= Yii::t('app', 'Goals') ?>
                                </a>
                                <span style="float: right;">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/others/6.svg" class="first-layer-icon" style="cursor:pointer;margin-top: -3px;display:<?= $session->has('third-layer-kgi') ? '' : 'none' ?>;" onclick="javascript:hideGroupMenu('third-layer-kgi')" id="third-layer-kgi-hide">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/others/6-1.svg" class="first-layer-icon" style="cursor:pointer;margin-top: -3px;display:<?= $session->has('third-layer-kgi') ? 'none' : '' ?>" onclick="javascript:showGroupMenu('third-layer-kgi')" id="third-layer-kgi-show">
                                </span>
                                <div class="col-12" id="third-layer-kgi" style="display:<?= $session->has('third-layer-kgi') ? '' : 'none' ?>;">
                                        <div class="col-12 second-layer-menu">
                                                <a href="<?= Yii::$app->homeUrl ?>kgi/management/grid" class="no-underline">
                                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/PerformanceMatrices/company.svg" class="first-layer-icon" style="margin-top: -3px;">
                                                        <?= Yii::t('app', 'Company KGI') ?>
                                                </a>
                                        </div>
                                        <div class="col-12 second-layer-menu">
                                                <a href="<?= Yii::$app->homeUrl ?>kgi/kgi-team/team-kgi-grid" class="no-underline">
                                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/PerformanceMatrices/team.svg" class="first-layer-icon" style="margin-top: -3px;">
                                                        <?= Yii::t('app', 'Team KGI') ?>
                                                </a>
                                        </div>
                                        <div class="col-12 second-layer-menu">
                                                <a href="<?= Yii::$app->homeUrl ?>kgi/kgi-personal/individual-kgi-grid" class="no-underline">
                                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/PerformanceMatrices/self.svg" class="first-layer-icon" style="margin-top: -3px;">
                                                        <?= Yii::t('app', 'Self KGI') ?>
                                                </a>
                                        </div>
                                </div>
                        </div>
                        <div class="col-12 first-layer-manu">
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/PerformanceMatrices/KPI.svg" class="first-layer-icon" style="margin-top: -3px;">
                                <a href="<?= Yii::$app->homeUrl ?>kpi/management/grid" class="no-underline">
                                        <?= Yii::t('app', 'Performance') ?>
                                </a>
                                <span style="float: right;">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/others/6.svg" class="first-layer-icon" style="cursor:pointer;margin-top: -3px;display:<?= $session->has('third-layer-kpi') ? '' : 'none' ?>;" onclick="javascript:hideGroupMenu('third-layer-kpi')" id="third-layer-kpi-hide">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/others/6-1.svg" class="first-layer-icon" style="cursor:pointer;margin-top: -3px;display:<?= $session->has('third-layer-kpi') ? 'none' : '' ?>" onclick="javascript:showGroupMenu('third-layer-kpi')" id="third-layer-kpi-show">
                                </span>
                                <div class="col-12" id="third-layer-kpi" style="display:<?= $session->has('third-layer-kpi') ? '' : 'none' ?>;">
                                        <div class="col-12 second-layer-menu">
                                                <a href="<?= Yii::$app->homeUrl ?>kpi/management/grid" class="no-underline">
                                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/PerformanceMatrices/company.svg" class="first-layer-icon" style="margin-top: -3px;">
                                                        <?= Yii::t('app', 'Company KPI') ?>
                                                </a>
                                        </div>
                                        <div class="col-12 second-layer-menu">
                                                <a href="<?= Yii::$app->homeUrl ?>kpi/kpi-team/team-kpi-grid" class="no-underline">
                                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/PerformanceMatrices/team.svg" class="first-layer-icon" style="margin-top: -3px;">
                                                        <?= Yii::t('app', 'Team KPI') ?>
                                                </a>
                                        </div>
                                        <div class="col-12 second-layer-menu">
                                                <a href="<?= Yii::$app->homeUrl ?>kpi/kpi-personal/individual-kpi-grid" class="no-underline">
                                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/PerformanceMatrices/self.svg" class="first-layer-icon" style="margin-top: -3px;">
                                                        <?= Yii::t('app', 'Self KPI') ?>
                                                </a>
                                        </div>
                                </div>
                        </div>
                        <!-- </div> -->
                </div>
        </div>
        <div class="col-12 mt-20">
                <div class="btn-group-menu">
                        <div class="row">
                                <div class="col-2 pl-20">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/Evaluation/evaluation_system.svg" class="home-icon" style="margin-top: -3px;">
                                </div>
                                <div class="col-8 text-start pr-0 pl-5">
                                        <?= Yii::t('app', 'Evaluation System') ?></div>
                                <div class="col-2 pr-0 pl-5 text-start">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/others/4.svg" class="home-icon" style="margin-top: -3px;cursor: pointer;display:<?= $session->has('evaluation-system') ? '' : 'none' ?>;" onclick="javascript:hideGroupMenu('evaluation-system')" id="evaluation-system-hide">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/others/7.svg" class="home-icon" style="margin-top: -3px;cursor: pointer;display:<?= $session->has('evaluation-system') ? 'none' : '' ?>;" onclick="javascript:showGroupMenu('evaluation-system')" id="evaluation-system-show">
                                </div>
                        </div>
                </div>
                <div id="evaluation-system" style="display:<?= $session->has('evaluation-system') ? '' : 'none' ?>;">
                        <div class="col-12 first-layer-manu">
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/Evaluation/evaluation_system.svg" class="first-layer-icon" style="margin-top: -3px;">
                                <a href="<?= Yii::$app->homeUrl ?>evaluation/environment" class="no-underline">
                                        <?= Yii::t('app', 'Evaluation Environment') ?>
                                </a>
                                <span style="float: right;">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/others/6.svg" class="first-layer-icon" style="cursor:pointer;margin-top: -3px;display:<?= $session->has('evaluation-environment') ? '' : 'none' ?>;" onclick="javascript:hideGroupMenu('evaluation-environment')" id="evaluation-environment-hide">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/others/6-1.svg" class="first-layer-icon" style="cursor:pointer;margin-top: -3px;display:<?= $session->has('evaluation-environment') ? 'none' : '' ?>;" onclick="javascript:showGroupMenu('evaluation-environment')" id="evaluation-environment-show">
                                </span>
                        </div>
                        <div id="evaluation-environment" style="display:<?= $session->has('evaluation-environment') ? '' : 'none' ?>;">
                                <div class="col-12 second-layer-menu">
                                        <a href="<?= Yii::$app->homeUrl ?>home/dashboard" class="no-underline">
                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/Evaluation/progress.svg" class="first-layer-icon" style="margin-top: -3px;">
                                                <?= Yii::t('app', 'Progress Dashboard') ?>
                                        </a>
                                </div>
                                <div class="col-12 second-layer-menu">
                                        <a href="<?= Yii::$app->homeUrl ?>evaluation/salary/index" class="no-underline">
                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/Evaluation/salary.svg" class="first-layer-icon" style="margin-top: -3px;">
                                                <?= Yii::t('app', 'Salary Registeration') ?>
                                        </a>
                                </div>
                                <div class="col-12 second-layer-menu">
                                        <a href="" class="no-underline">
                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/Evaluation/performance.svg" class="first-layer-icon" style="margin-top: -3px;">
                                                <?= Yii::t('app', 'Performance') ?>
                                        </a>
                                        <span style="float: right;">
                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/others/6.svg" class="first-layer-icon" style="cursor:pointer;margin-top: -3px;display:<?= $session->has('third-layer-performane') ? '' : 'none' ?>;" onclick="javascript:hideGroupMenu('third-layer-performane')" id="third-layer-performane-hide">
                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/others/6-1.svg" class="first-layer-icon" style="cursor:pointer;margin-top: -3px;display:<?= $session->has('third-layer-performane') ? 'none' : '' ?>" onclick="javascript:showGroupMenu('third-layer-performane')" id="third-layer-performane-show">
                                        </span>
                                        <div class="col-12" id="third-layer-performane" style="display:<?= $session->has('third-layer-performane') ? '' : 'none' ?>;">
                                                <div class="col-12 third-layer-menu">
                                                        <a href="" class="no-underline">
                                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/Evaluation/company.svg" class="first-layer-icon" style="margin-top: -3px;">
                                                                <?= Yii::t('app', 'Company') ?>
                                                        </a>
                                                </div>
                                                <div class="col-12 third-layer-menu">
                                                        <a href="" class="no-underline">
                                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/Evaluation/self.svg" class="first-layer-icon" style="margin-top: -3px;">
                                                                <?= Yii::t('app', 'Individual') ?>
                                                        </a>
                                                </div>
                                        </div>
                                </div>
                        </div>
                </div>
        </div>
        <div class="col-12 mt-20">
                <div class="btn-group-menu">
                        <div class="row">
                                <div class="col-2 pl-20">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/BehavioralEvaluation/evaluation.svg" class="home-icon" style="margin-top: -3px;">
                                </div>
                                <div class="col-8 text-start pr-0 pl-5"><?= Yii::t('app', 'Behavioral Evaluation') ?></div>
                                <div class="col-2 pr-0 pl-5 text-start">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/others/4.svg" class="home-icon" style="margin-top: -3px;cursor: pointer;display:<?= $session->has('behavioral-evaluation') ? '' : 'none' ?>;" onclick="javascript:hideGroupMenu('behavioral-evaluation')" id="behavioral-evaluation-hide">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/others/7.svg" class="home-icon" style="margin-top: -3px;cursor: pointer;display:<?= $session->has('behavioral-evaluation') ? 'none' : '' ?>" onclick="javascript:showGroupMenu('behavioral-evaluation')" id="behavioral-evaluation-show">
                                </div>
                        </div>
                </div>
                <div id="behavioral-evaluation" style="display:<?= $session->has('behavioral-evaluation') ? '' : 'none' ?>;">
                        <div class="col-12 first-layer-manu">
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/BehavioralEvaluation/evaluation.svg" class="first-layer-icon" style="margin-top: -3px;">
                                <?= Yii::t('app', 'Behavioral Indicator') ?>
                                <span style="float: right;">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/others/6.svg" class="first-layer-icon" style="cursor:pointer;margin-top: -3px;display:none;display:<?= $session->has('behavioral-indicator') ? '' : 'none' ?>;" onclick="javascript:hideGroupMenu('behavioral-indicator')" id="behavioral-indicator-hide">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/others/6-1.svg" class="first-layer-icon" style="cursor:pointer;margin-top: -3px;display:<?= $session->has('behavioral-indicator') ? 'none' : '' ?>;" onclick="javascript:showGroupMenu('behavioral-indicator')" id="behavioral-indicator-show">
                                </span>
                        </div>
                        <div id="behavioral-indicator" style="display:<?= $session->has('behavioral-indicator') ? '' : 'none' ?>;">
                                <div class="col-12 second-layer-menu">
                                        <a href="<?= Yii::$app->homeUrl ?>kfi/management/grid" class="no-underline">
                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/BehavioralEvaluation/evaluation_portal.svg" class="first-layer-icon" style="margin-top: -3px;">
                                                <?= Yii::t('app', 'Behavior Portal') ?>
                                        </a>
                                </div>
                                <div class="col-12 second-layer-menu">
                                        <a href="<?= Yii::$app->homeUrl ?>kfi/management/grid" class="no-underline">
                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/BehavioralEvaluation/registeration.svg" class="first-layer-icon" style="margin-top: -3px;">
                                                <?= Yii::t('app', 'Registeration & Config') ?>
                                        </a>
                                </div>
                        </div>
                        <div class="col-12 first-layer-manu">
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/BehavioralEvaluation/360.svg" class="first-layer-icon" style="margin-top: -3px;">
                                <?= Yii::t('app', '360 Degree Evaluation') ?>
                        </div>
                        <div class="col-12 first-layer-manu">
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/BehavioralEvaluation/company_dashboard.svg" class="first-layer-icon" style="margin-top: -3px;">
                                <?= Yii::t('app', 'Company Dashboard') ?>
                                <span style="float: right;">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/others/6.svg" class="first-layer-icon" style="cursor:pointer;margin-top: -3px;display:<?= $session->has('company-dashboard') ? '' : 'none' ?>;" onclick="javascript:hideGroupMenu('company-dashboard')" id="company-dashboard-hide">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/others/6-1.svg" class="first-layer-icon" style="cursor:pointer;margin-top: -3px;display:<?= $session->has('company-dashboard') ? 'none' : '' ?>" onclick="javascript:showGroupMenu('company-dashboard')" id="company-dashboard-show">
                                </span>
                        </div>
                        <div id="company-dashboard" style="display:<?= $session->has('company-dashboard') ? '' : 'none' ?>;">
                                <div class="col-12 second-layer-menu">
                                        <a href="<?= Yii::$app->homeUrl ?>kfi/management/grid" class="no-underline">
                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/BehavioralEvaluation/template_board.svg" class="first-layer-icon" style="margin-top: -3px;">
                                                <?= Yii::t('app', 'Template Board') ?>
                                        </a>
                                </div>
                                <div class="col-12 second-layer-menu">
                                        <a href="<?= Yii::$app->homeUrl ?>kfi/management/grid" class="no-underline">
                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/BehavioralEvaluation/question_bank.svg" class="first-layer-icon" style="margin-top: -3px;">
                                                <?= Yii::t('app', 'Question Bank') ?>
                                        </a>
                                </div>
                                <div class="col-12 second-layer-menu">
                                        <a href="<?= Yii::$app->homeUrl ?>kfi/management/grid" class="no-underline">
                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/BehavioralEvaluation/my_360.svg" class="first-layer-icon" style="margin-top: -3px;">
                                                <?= Yii::t('app', 'My 360') ?>
                                        </a>
                                </div>
                                <div class="col-12 second-layer-menu">
                                        <a href="<?= Yii::$app->homeUrl ?>kfi/management/grid" class="no-underline">
                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/BehavioralEvaluation/my_portal.svg" class="first-layer-icon" style="margin-top: -3px;">
                                                <?= Yii::t('app', 'My Portal') ?>
                                        </a>
                                </div>
                        </div>
                </div>
        </div>
        <div class="col-12 mt-20 mb-10">
                <div class="btn-hrvc-home">
                        <a href="<?= Yii::$app->homeUrl ?>language/default/index" class="text-light" style="text-decoration: none;">
                                <span>
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/others/8.svg" class="home-icon" style="margin-top: -3px;">
                                </span> <?= Yii::t('app', 'Setting') ?>
                        </a>
                </div>
        </div>
</div>