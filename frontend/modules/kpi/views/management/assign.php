<?php

use common\models\ModelMaster;

$this->title = 'Assign KPI';
?>
<div class="col-12 mt-90">
    <div class="col-12">
        <i class="fa fa-tachometer font-size-20" aria-hidden="true"></i> <strong class="font-size-20"> <?= Yii::t('app', 'Assign Management') ?></strong>
    </div>
    <div class="col-12 mt-20">
        <?= $this->render('header_assign') ?>
        <div class="alert alert-white-5">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="col-12">
                        <?= Yii::t('app', 'Key Performance Indicator') ?>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="col-12">
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1" onclick="javascript:searchAssignKpi()"
                                style="cursor: pointer;">
                                <i class="fa fa-filter" aria-hidden="true"></i>
                            </span>
                            <select class="form-select font-size-13" aria-label="Default select example"
                                id="kpiMonthFilter">
                                <option selected value=""><?= Yii::t('app', 'Month') ?></option>
                                <?php
                                if (isset($months) && count($months) > 0) {
                                    foreach ($months as $value => $month) :
                                ?>
                                        <option value="<?= $value ?>"><?= Yii::t('app', $month) ?></option>
                                <?php
                                    endforeach;
                                }
                                ?>
                            </select>
                            <select class="form-select font-size-13" aria-label="Default select example"
                                id="kpiYearFilter">
                                <option selected value=""><?= Yii::t('app', 'Year') ?></option>
                                <option value=""><?= Yii::t('app', 'Year') ?></option>
                                <?php
                                $year = 2022;
                                $i = 1;
                                while ($i < 20) {
                                ?>
                                    <option value="<?= $year ?>"><?= $year ?></option>
                                <?php
                                    $year += 1;
                                    $i++;
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-col-12">
                    <a href="<?= Yii::$app->homeUrl ?>kpi/management/wait-approve" class="no-underline text-primary">
                        <?= Yii::t('app', 'Wait for approve KPI') ?>
                    </a>
                </div>
            </div>
            <div class="alert alert-light mt-10" role="alert">
                <table class="table table-striped">
                    <thead class="table table-secondary">
                        <tr class="secondary-setting">
                            <th><?= Yii::t('app', 'KPI Contents') ?></th>
                            <th><?= Yii::t('app', 'Branch') ?></th>
                            <th class="text-center"><?= Yii::t('app', 'Team') ?></th>
                            <th><?= Yii::t('app', 'Employee') ?></th>
                            <th class="text-center"><?= Yii::t('app', 'Target') ?></th>
                            <th><?= Yii::t('app', 'Month') ?></th>
                            <th>cccccccccccccccccccccccccKGI') ?></th>
                            <th class="text-center font-size-14">
                                <i class="fa fa-cog" aria-hidden="true"></i>
                            </th>
                            <!-- <th>Status</th> -->
                        </tr>
                    </thead>
                    <tbody id="assign-search-result">
                        <?php
                        if (isset($kpis) && count($kpis) > 0) {
                            foreach ($kpis as $kpiId => $kpi) :
                        ?>
                                <tr style="border-bottom: 10px white !important;" id="kpi-<?= $kpiId ?>">
                                    <td>
                                        <?= $kpi["kpiName"] ?>
                                    </td>

                                    <td>

                                        <div class="row">
                                            <div class="col-6 badge rounded-pill bg-setting">
                                                <img class="Image-Description" src="<?= Yii::$app->homeUrl . $kpi["flag"] ?>">
                                                <button id="hs-dropdown-avatar-more" class="number-rounded">
                                                    <span class="font-medium leading-none"
                                                        id="total-branch-<?= $kpiId ?>"><?= count($kpi["kpiBranch"]) ?></span>
                                                </button>
                                            </div>
                                            <div class="col-3 dashedshare mt-2 ml-2"
                                                onclick="javascript:kpiCompanyBranch(<?= $kpi['companyId'] ?>,<?= $kpiId ?>)"
                                                data-bs-toggle="modal" data-bs-target="#modalBranch">
                                                <i class="fa fa-share-alt share-alt-setting" aria-hidden="true"></i>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="row">
                                            <div class="col-1">
                                            </div>
                                            <div class="col-3  mt-2 text-center pr-25 font-size-11">
                                                <div class="text-center pt-3" id="totalTeam-<?= $kpiId ?>"
                                                    style="width:25px;height:25px;border-radius:100%;border: 1px solid rgb(58, 158, 230);">
                                                    <?= $kpi["countTeam"] ?>
                                                </div>
                                            </div>
                                            <!-- </div> -->
                                            <div class="col-3 dashedshare mt-2 ml-5" data-bs-target="#assign-kpi-team"
                                                data-bs-toggle="modal" onclick="javascript:assignKpiTeam(<?= $kpiId ?>)">
                                                <i class="fa fa-users share-alt-setting" aria-hidden="true"></i>
                                                <i class="fa fa-plus-circle circle5"></i>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="row">
                                            <div class="col-5 badge rounded-pill bg-setting text-start">
                                                <?php
                                                if (isset($kpi["kpiEmployee"]) && count($kpi["kpiEmployee"]) > 0) {
                                                    $e = 0;
                                                    foreach ($kpi["kpiEmployee"] as $employeeId => $emPic) :
                                                        if ($e < 2) { ?>
                                                            <img class="Image-Description" src="<?= Yii::$app->homeUrl . $emPic ?>">
                                                <?php
                                                        }
                                                        $e++;
                                                    endforeach;
                                                }
                                                ?>
                                                <button id="hs-dropdown-avatar-more" class="number-rounded">
                                                    <span class="font-medium leading-none"
                                                        id="totalEmployee-<?= $kpiId ?>"><?= count($kpi["kpiEmployee"]) ?></span>
                                                </button>
                                            </div>

                                            <div class="col-3 dashedshare mt-2 ml-5" data-bs-target="#kpi-employee-modal"
                                                data-bs-toggle="modal" onclick="javascript:kpiCompanyEmployee(<?= $kpiId ?>)">
                                                <i class="fa fa-user share-alt-setting" aria-hidden="true"></i>
                                                <i class="fa fa-plus-circle circle5"></i>
                                            </div>
                                            <div class="col-1">
                                                <!-- <i class="fa fa-plus-circle circle5"></i> -->
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-end"><?= $kpi["code"] ?> <?= $kpi["targetAmount"] ?></td>
                                    <td><?= $kpi["month"] ?></td>
                                    <td>
                                        <a href="<?= Yii::$app->homeUrl ?>kpi/management/kpi-kgi/<?= ModelMaster::encodeParams(['kpiId' => $kpiId]) ?>"
                                            class="no-underline-black">
                                            <b><?= $kpi["countKgiInKpi"] ?></b>
                                        </a>
                                    </td>
                                    <td class="text-end">
                                        <a href="<?= Yii::$app->homeUrl
                                                    ?>kpi/kpi-team/kpi-team-setting/<?= ModelMaster::encodeParams(['kpiId' => $kpiId])
                                                                                    ?>" class="btn btn-sm btn-primary mr-3" title="Team KPI setting">
                                            <i class="fa fa-users" aria-hidden="true"></i>
                                        </a>
                                        <a href="<?= Yii::$app->homeUrl ?>kpi/kpi-personal/indivisual-setting/<?= ModelMaster::encodeParams(['kpiId' => $kpiId]) ?>"
                                            class="btn btn-sm btn-info text-light" title="Indivisual KPI setting">
                                            <i class="fa fa-user" aria-hidden="true"></i>
                                        </a>
                                    </td>


                                </tr>
                        <?php
                            endforeach;
                        }
                        ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- <div class="col-12 navigation-next">
		<nav aria-label="Page navigation example">
			<ul class="pagination">
				<li class="page-item"><a class="page-link page-navigation" href="#"><i class="fa fa-chevron-left" aria-hidden="true"></i> Previous</a></li>
				<li class="page-item"><a class="page-link page-navigation" href="#">1</a></li>
				<li class="page-item"><a class="page-link page-navigation" href="#">2</a></li>
				<li class="page-item"><a class="page-link page-navigation" href="#">3</a></li>
				<li class="page-item"><a class="page-link page-navigation" href="#">Next <i class="fa fa-chevron-right" aria-hidden="true"></i></a></li>
			</ul>
		</nav>
	</div> -->
</div>
<?= $this->render('modal_branch') ?>
<?= $this->render('modal_employee') ?>
<?= $this->render('modal_assign_kpi_team') ?>