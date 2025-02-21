<?php

use common\models\ModelMaster;

$this->title = 'company';
?>

<div class="mt-90">
    <div class=" d-flex align-items-center gap-2">
        <img src="<?= Yii::$app->homeUrl ?>image/branch-icon-black.svg" style="width: 24px; height: 24px;">
        <div class="pim-name-title ml-10">
            Company
        </div>
        <a href="<?= Yii::$app->homeUrl ?>setting/company/create/<?= ModelMaster::encodeParams(['groupId' => $groupId]) ?>"
            style="text-decoration: none;">
            <button type="button" class="btn-create" style="padding: 3px 9px;"
                action="<?= Yii::$app->homeUrl ?>setting/group/create-group"><?= Yii::t('app', 'Create New') ?>
                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/plus.svg"
                    style="width:18px; height:18px; margin-top:-3px;">
            </button>
        </a>
    </div>

    <div class="company-group-edit mt-30">
        <div class="between-center" style="width: 100%;">
            <div class="col-7">
                Registered Companies
            </div>
            <div class="col-4" style="text-align: right;">
                <?= $this->render('filter_list', []) ?>
            </div>
            <div class="col-1 pr-0 text-end">
                <div class="btn-group" role="group">
                    <a href="#" class="btn btn-primary font-size-12 pim-change-modes">
                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/gridwhite.svg"
                            style="cursor: pointer;">
                    </a>
                    <a href="<?= Yii::$app->homeUrl . 'setting/company/index' ?>"
                        class="btn btn-outline-primary font-size-12 pim-change-modes">
                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/listblack.svg"
                            style="cursor: pointer;">
                    </a>
                </div>
            </div>
        </div>

        <div class="alert alert-branch-body" role="alert">
            <div class="row" id="company-branch">
                <?php
				if (isset($companies) && count($companies) > 0) {
					$i = 1;
					foreach ($companies as $company) :
						$maxLength = 200;
						$about = substr($company['about'], 0, $maxLength);
				?>
                <div class="col-lg-4 col-md-5 col-sm-3 col-12">
                    <div class="card" style="border: none;">
                        <div class="card-body" style="background: #F4F6F9;  border-radius: 5px;">
                            <div class="row">
                                <div class="col-12">
                                    <div class="between-center" style="
                                height: 60px;
                                gap: 17px;
                                width: 100%;">
                                        <div style="display: flex; align-items: center; gap: 17px;">
                                            <div class="mid-center"
                                                style="height: 60px; padding: 20.944px 4.189px; gap: 10.472px;">
                                                <?php
                                                    if ($company["picture"] != null) { ?>
                                                <img src="<?= Yii::$app->homeUrl ?><?= $company['picture'] ?>"
                                                    class="card-tcf">
                                                <?php
                                                    } else { ?>
                                                <img src="<?= Yii::$app->homeUrl . 'image/userProfile.png' ?>"
                                                    class="card-tcf">
                                                <?php
                                                    }
                                                ?>
                                            </div>
                                            <div class="header-crad-branch">
                                                <div class="name-crad-branch">
                                                    <?= $company['companyName'] ?>
                                                </div>
                                                <div class="city-crad-branch">
                                                    <img src="<?= Yii::$app->homeUrl ?><?= $company['flag'] ?>"
                                                        class="bangladresh-hrvc">
                                                    <?= $company['city'] ?>, <?= $company['countryName'] ?>
                                                </div>
                                            </div>
                                        </div>
                                        <span class="dropdown" href="#" id="dropdownMenuLink-1"
                                            data-bs-toggle="dropdown" style="align-self: flex-start;">
                                            <img src="<?= Yii::$app->homeUrl ?>/image/menu.svg" alt="icon"
                                                style="cursor: pointer;">
                                        </span>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink-1">
                                            <li class="pl-4 pr-4">
                                                <a href="<?= Yii::$app->homeUrl ?>setting/company/company-view/<?= ModelMaster::encodeParams(['companyId' => $company['companyId']]) ?>"
                                                    class="dropdown-itemNEWS pl-4  pr-20 mb-5"
                                                    style="margin-top: -3px;">
                                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/eye.svg"
                                                        alt="History" class="pim-icon mr-10" style="margin-top: -2px;">
                                                    View </a>
                                            </li>
                                            <li class="pl-4 pr-4">
                                                <a href="<?= Yii::$app->homeUrl ?>setting/company/update-company/<?= ModelMaster::encodeParams(['companyId' => $company['companyId']]) ?>"
                                                    class="dropdown-itemNEWS pl-4  pr-20 mb-5"
                                                    style="margin-top: -1px; ">
                                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/editblack.svg"
                                                        alt="History" class="pim-icon mr-10" style="margin-top: -2px;">
                                                    edit </a>
                                            </li>
                                            <li class="pl-4 pr-4">
                                                <a class="dropdown-itemNEW pl-4 pr-25" data-bs-toggle="modal"
                                                    data-bs-target="#delete-kpi-employee"
                                                    href="javascript:deleteCompany(<?= $company['companyId'] ?>)">
                                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/delete.svg"
                                                        alt="Delete" class="pim-icon mr-10" style="margin-top: -2px;">
                                                    Delete </a>
                                            </li>
                                        </ul>
                                    </div>


                                    <div class="between-center"
                                        style="align-self: stretch;  margin-left: 20px; margin-top: 10px; ">
                                        <div
                                            style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 18px; width: 100%;">
                                            <div class="row align-items-center">
                                                <div class="col-12 text-left">
                                                    <div class="circle-container">
                                                        <div class="cycle-current"><img
                                                                src="<?= Yii::$app->homeUrl ?>/image/branches.svg"
                                                                alt="icon">
                                                        </div>
                                                        <div class="cycle-current"><img
                                                                src="<?= Yii::$app->homeUrl ?>/image/branches.svg"
                                                                alt="icon">
                                                        </div>
                                                        <div class="cycle-current"><img
                                                                src="<?= Yii::$app->homeUrl ?>/image/branches.svg"
                                                                alt="icon">
                                                        </div>
                                                        <div class="text-name-current">
                                                            <?= $company['totalBranch'] ?>
                                                            <a
                                                                href="<?= Yii::$app->homeUrl ?>setting/branch/create/<?= ModelMaster::encodeParams(['companyId' => $company['companyId']]) ?>">
                                                                Branch
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row align-items-center">
                                                <div class="col-12 text-left">
                                                    <div class="circle-container">
                                                        <div class="cycle-current"><img
                                                                src="<?= Yii::$app->homeUrl ?>/image/departments.svg"
                                                                alt="icon">
                                                        </div>
                                                        <div class="cycle-current"><img
                                                                src="<?= Yii::$app->homeUrl ?>/image/departments.svg"
                                                                alt="icon">
                                                        </div>
                                                        <div class="cycle-current"><img
                                                                src="<?= Yii::$app->homeUrl ?>/image/departments.svg"
                                                                alt="icon">
                                                        </div>
                                                        <div class="text-name-current">
                                                            <?= $company['totalDepartment'] ?>
                                                            <a
                                                                href="<?= Yii::$app->homeUrl ?>setting/department/create/<?= ModelMaster::encodeParams(['companyId' => $company['companyId']]) ?>">
                                                                Departments
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row align-items-center">
                                                <div class="col-12 text-left">
                                                    <div class="circle-container">
                                                        <div class="cycle-current"><img
                                                                src="<?= Yii::$app->homeUrl ?>/image/teams.svg"
                                                                alt="icon">
                                                        </div>
                                                        <div class="cycle-current"><img
                                                                src="<?= Yii::$app->homeUrl ?>/image/teams.svg"
                                                                alt="icon">
                                                        </div>
                                                        <div class="cycle-current"><img
                                                                src="<?= Yii::$app->homeUrl ?>/image/teams.svg"
                                                                alt="icon">
                                                        </div>
                                                        <div class="text-name-current"><?= $company['totalTeam'] ?> <a
                                                                href="<?= Yii::$app->homeUrl ?>setting/team/create/<?= ModelMaster::encodeParams(['companyId' => $company['companyId']]) ?>">
                                                                Teams
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row align-items-center">
                                                <div class="col-12 text-left">
                                                    <div class="circle-container">
                                                        <div class="cycle-current"><img
                                                                src="<?= Yii::$app->homeUrl ?>/image/employees.svg"
                                                                alt="icon">
                                                        </div>
                                                        <div class="cycle-current"><img
                                                                src="<?= Yii::$app->homeUrl ?>/image/employees.svg"
                                                                alt="icon">
                                                        </div>
                                                        <div class="cycle-current"><img
                                                                src="<?= Yii::$app->homeUrl ?>/image/employees.svg"
                                                                alt="icon">
                                                        </div>
                                                        <div class="text-name-current"><?= $company['totalEmployee'] ?>
                                                            <a
                                                                href="<?= Yii::$app->homeUrl ?>setting/employee/index/<?= ModelMaster::encodeParams(['companyId' => $company['companyId']]) ?>">
                                                                Employees
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
						$i++;
					endforeach;
				}
				?>
            </div>
        </div>

    </div>
</div>