<?php

use common\helpers\Path;
use common\models\ModelMaster;
use frontend\models\hrvc\UserRole;

?>
<div class="col-lg-12 header1 scroll-container">
        <div class="col-12">
                <div class="col-12 mt-5">
                        <i class="fa fa-step-backward caret-left" aria-hidden="true"></i>
                </div>
                <div class="col-12 pl-10" style="margin-top: -20px;">
                        <a href="<?= Yii::$app->homeUrl ?>site/index">
                                <img src="<?= Yii::$app->homeUrl ?>image/Human.png" class="width-hrvc">
                        </a>
                </div>
                <div class="col-12 navbar-header pl-15">
                        <div class="col-12">
                                <a href="<?= Yii::$app->homeUrl ?>home/dashboard" class="no-underline">
                                        <i class="fa fa-th-large pr-10 mt-10" aria-hidden="true" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Tooltip on bottom"></i>
                                        Dashboard
                                </a>
                        </div>
                        <?php
                        $role = UserRole::userRight();
                        //if ($role >= 5) {
                        if ($role >= 2) {
                                if ($role >= 5) {
                        ?>
                                        <div class="col-12  haeder-company">
                                                Company Details
                                        </div>
                                        <div class="col-12">
                                                <a href="<?= Yii::$app->homeUrl ?>setting/group/create-group" class="no-underline">
                                                        <i class="fa fa-building-o pr-10 mt-20" aria-hidden="true"></i> Group Information
                                                </a>
                                        </div>
                                        <div class="col-12">
                                                <a href="<?= Yii::$app->homeUrl ?>setting/company/index" class="no-underline">
                                                        <i class="fa fa-home pr-10 mt-20" aria-hidden="true"></i> Company Name
                                                </a>
                                        </div>

                                        <div class="col-12">
                                                <a href="<?= Yii::$app->homeUrl ?>site/dashboard-kpi2" class="no-underline">
                                                        <i class="fa fa-book pr-10 mt-20" aria-hidden="true"></i> Culture Book
                                                </a>
                                        </div>

                                        <div class="col-12">
                                                <a href="<?= Yii::$app->homeUrl ?>setting/branch/create/<?= ModelMaster::encodeParams(['companyId' => '']) ?>" class="no-underline">
                                                        <i class="fa fa-users pr-10 mt-20" aria-hidden="true">

                                                        </i> Branch </a>
                                        </div>
                                        <div class="col-12">
                                                <a href="<?= Yii::$app->homeUrl ?>setting/department/create/<?= ModelMaster::encodeParams(['companyId' => '']) ?>" class="no-underline">
                                                        <i class="fa fa-code-fork pr-10 mt-20" aria-hidden="true"></i> Department
                                                </a>
                                        </div>
                                        <div class="col-12">
                                                <a href="<?= Yii::$app->homeUrl ?>setting/team/create/<?= ModelMaster::encodeParams(['companyId' => '']) ?>" class="no-underline">
                                                        <i class="fa fa-users pr-10 mt-20" aria-hidden="true">

                                                        </i> Team </a>
                                        </div>
                                <?php
                                }
                                $isHr = UserRole::isHr();
                                if ($isHr == 1 || $role >= 5) {
                                ?>
                                        <div class="col-12">
                                                <a href="<?= Yii::$app->homeUrl ?>setting/employee/index/<?= ModelMaster::encodeParams(['companyId' => ''])
                                                                                                                ?>" class="no-underline">
                                                        <i class="fa fa-user pr-10 mt-20" aria-hidden="true"></i>
                                                        Employee
                                                </a>
                                        </div>
                                <?php
                                }
                                if ($role >= 5) {
                                ?>
                                        <div class="col-12">
                                                <a href="<?= Yii::$app->homeUrl ?>setting/title/index" class="no-underline">
                                                        <i class="fa fa-users pr-10 mt-20" aria-hidden="true">
                                                        </i> Title </a>
                                        </div>

                                        <div class="col-12">
                                                <a href="<?= Yii::$app->homeUrl ?>setting/layer/index" class="no-underline">

                                                        <i class="fa fa-angle-double-up pr-10 mt-20" aria-hidden="true"></i> Management Layer
                                                </a>
                                        </div>
                        <?php
                                }
                        }
                        ?>

                        <div class="col-12 haeder-kpi">
                                KPI & KGI MANAGEMENT
                        </div>
                        <div class="col-12">
                                <a href="<?= Yii::$app->homeUrl ?>kfi/management/grid" class="no-underline">
                                        <i class="fa fa-bar-chart pr-10 mt-20" aria-hidden="true"></i>
                                        KFI Management
                                </a>
                        </div>
                        <div class="col-12">
                                <a href="<?= Yii::$app->homeUrl ?>kgi/management/grid" class="no-underline">
                                        <i class="fa fa-line-chart pr-10 mt-20" aria-hidden="true"></i>
                                        KGI Management
                                </a>
                        </div>
                        <div class="col-12">
                                <a href="<?= Yii::$app->homeUrl ?>kpi/management/grid" class="no-underline">
                                        <i class="fa fa-tachometer pr-10 mt-20" aria-hidden="true"></i>
                                        KPI Management
                                </a>
                        </div>
                        <div class="col-12 haeder-Evalution"> EVALUTION SETTINGS</div>
                        <div class="col-12">
                                <a href="<?= Yii::$app->homeUrl ?>evaluation/environment" class="no-underline">
                                        <i class="fa fa-pencil-square-o pr-10 mt-20" aria-hidden="true"></i>
                                        Evaluation
                                </a>
                        </div>
                        <div class="col-12">
                                <a href="<?= Yii::$app->homeUrl ?>evaluation/salary/index" class="no-underline">
                                        <i class="fa fa-usd pr-10 mt-20" aria-hidden="true"></i>
                                        Salary
                                </a>
                        </div>
                        <div class="col-12"> <a href="<?= Yii::$app->homeUrl ?>site/" class="no-underline"><i class="fa fa-history pr-10 mt-20" aria-hidden="true"></i> 360 Degree Evaluetion</a></div>
                        <div class="col-12 haeder-Evalution"> REPORTS</div>
                        <div class="col-12"> <a href="<?= Yii::$app->homeUrl ?>site/analysis" class="no-underline"><i class="fa fa-pie-chart pr-10 mt-20" aria-hidden="true"></i> Analysis</a></div>
                        <div class="col-12 haeder-Evalution">
                                <a href="<?= Path::fsModule() ?>?__id=<?= Yii::$app->user->id ?>" class="no-underline">
                                        Financial Planning
                                </a>
                        </div>
                        <div class="col-12 haeder-Evalution"> ADMIN SETTINGS</div>
                        <div class="col-12"> <a href="" class="no-underline"><i class="fa fa-user pr-10 mt-20" aria-hidden="true"></i> Admin</a></div>
                        <div class="col-12"> <a href="" class="no-underline"><i class="fa fa-sun-o pr-10 mt-20" aria-hidden="true"></i> Super admin</a></div>
                        <div class="col-12"> <a href="" class="no-underline"><i class="fa fa-bell-o pr-10 mt-20" aria-hidden="true"></i> Notification Center</a></div>
                </div>

        </div>
</div>