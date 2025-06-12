<?php

use common\models\ModelMaster;

$this->title = 'view';
?>

<div class="col-12 mt-90">
	<div class="col-12 view-goback">
		<a href="<?= Yii::$app->homeUrl ?>setting/employee/index/<?= ModelMaster::encodeParams(['companyId' => $employee['companyId']]) ?>" class="no-underline-black">
			<i class="fa fa-caret-left font-size-22" aria-hidden="true"></i> &nbsp;Go Back
		</a>
	</div>
	<div class="alert alert-goback">
		<div class="col-12">
			<div class="alert alert-light mr-10 ml-10" style="border: none;">
				<div class="row">
					<div class="col-lg-2 col-md-6 col-12">
						<?php
						if ($employee['picture'] == '') {
							if ($employee['gender'] == 1) {
								$picture = 'image/user.png';
							} else {
								$picture = 'image/lady.jpg';
							}
						?>

							<img src="<?= Yii::$app->homeUrl . $picture ?>" class="imageView">
						<?php
						} else { ?>
							<img src="<?= Yii::$app->homeUrl . $employee['picture'] ?>" class="imageView">
						<?php
						}
						?>

					</div>
					<div class="col-lg-10 col-md-6 col-12">
						<div class="con-12 mt-30">
							<span class="name-Tadawoki"><?= $employee['employeeFirstname'] ?>&nbsp;&nbsp;&nbsp;<?= $employee['employeeSurename'] ?></span>
							<?php
							if ($employee["statusName"] == "Active") {
								$text = "success";
							} else {
								$text = "danger";
							}
							?>
							<span class="badge bg-<?= $text ?> font-size-14 ml-20"><?= $employee["statusName"] ?></span>
						</div>
						<div class="row">
							<div class="col-lg-6 col-lg-6 col-12">
								<div class="col-12 pt-10 Director-view">
									<?= $employee["titleName"] ?>, <?= $employee["countryName"] ?>
								</div>
								<div class="col-12 pt-20 font-size-14">
									<i class="fa fa-calendar-o" aria-hidden="true"></i> &nbsp; <span class="text-dark"> Joined on </span><strong> <?= ModelMaster::dateNumberDash($employee['joinDate']) ?></strong>
									<span class="view-solid"></span> <i class="fa fa-birthday-cake pl-10" aria-hidden="true"></i> <span class="text-dark"> Age</span><strong> <?= $employee['age'] ?></strong>
									<span class="badge bg-secondary ml-10"> <?= $employee['employeeConditionName'] ?></span>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-12 text-end">
								<div class="col-12 pt-10">
									Working Place
								</div>
								<div class="col-12 pt-10 font-size-14 font-b">
									<img src="<?= Yii::$app->homeUrl ?><?= $employee["flag"] ?>" class="bd"> <?= $employee["companyName"] ?>, <?= $employee["countryName"] ?>
								</div>
							</div>
						</div>
						<div class="row mt-20">
							<div class="col-lg-12 col-md-6 col-12">
								<div class="row">
									<div class="col-3"></div>
									<div class="col-2 font-size-14 share-pointer">
										<!-- <i class="fa fa-share-alt" aria-hidden="true"></i> Share Profile -->
									</div>
									<div class="col-1 font-size-14 share-pointer">
										<a href="<?= Yii::$app->homeUrl ?>setting/employee/export-employee/<?= ModelMaster::encodeParams(["employeeId" => $employee["employeeId"]]) ?>" target="_blank" style="text-decoration:none;">
											<i class="fa fa-print" aria-hidden="true"></i> Print
										</a>
									</div>
									<div class="col-2 font-size-14 share-pointer">
										<?php
										if ($employee['resume'] != '') { ?>
											<a href="<?= Yii::$app->homeUrl . $employee['resume'] ?>" target="_blank" style="text-decoration:none;">
												<i class="fa fa-cloud-download" aria-hidden="true"></i> Download CV
											</a>
										<?php
										} else { ?>
											<a href="#" target="_blank" style="text-decoration:none;">
												<i class="fa fa-cloud-download" aria-hidden="true"></i> Download CV
											</a>
										<?php
										}
										?>
									</div>
									<div class="col-3 font-size-14 share-pointer text-center">

										<?php
										if ($employee['employeeAgreement'] != '') { ?>
											<a href="<?= Yii::$app->homeUrl . $employee['employeeAgreement'] ?>" target="_blank" style="text-decoration:none;">
												<i class="fa fa-cloud-download" aria-hidden="true"></i> Download Agreement
											</a>
										<?php
										} else { ?>
											<a href="<?= Yii::$app->homeUrl . $employee['employeeAgreement'] ?>" target="_blank" style="text-decoration:none;">
												<i class="fa fa-cloud-download" aria-hidden="true"></i> Download Agreement
											</a>
										<?php
										}
										?>

									</div>
									<div class="col-1 font-size-14 share-pointer">
										<a href="<?= Yii::$app->homeUrl ?>setting/employee/update/<?= ModelMaster::encodeParams(['employeeId' => $employee['employeeId']]) ?>" style="text-decoration:none;">
											<i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit
										</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row pr-20">
				<div class="col-lg-3 col-md-6 col-12">
					<div class="alert crd-background">
						<div class="col-12">
							<div class="col-12 mr-20 ml-20 font-size-28 font-b pt-20">
								Employee
								Information
							</div>
							<div class="pt-30">
								<div class="nav flex-column nav-tabs" id="v-tabs-tab" role="tablist" aria-orientation="vertical">
									<a href="javascript:showEmployeeView(1)" class="link-2 font-b" id="link1">Personal & Contact Details</a>
									<a href="javascript:showEmployeeView(2)" class="link-2" id="link2">Work Information</a>
									<a href="javascript:showEmployeeView(3)" class="link-2" id="link3">Attachments</a>
									<?php
									if (isset($canUseSalary) && $canUseSalary == 1) {
									?>
										<a href="javascript:showEmployeeView(4)" class="link-2" id="link4">Salary & Allowance</a>
										<a href="javascript:showEmployeeView(5)" class="link-2" id="link5">Evaluation</a>
									<?php
									}
									?>
									<input type="hidden" value="1" id="currentShow">
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-9 col-md-6 col-12" id='show1' style="background-color: white;">
					<?= $this->render('personal', ["employee" => $employee]) ?>
				</div>

				<div class="col-lg-9 col-md-6 col-12" id='show2' style="background-color: white;display:none;">
					<?= $this->render('work_info', ["employee" => $employee]) ?>
				</div>
				<div class="col-lg-9 col-md-6 col-12" id='show3' style="background-color: white;display:none;">
					<?= $this->render('attachments', [
						"resume" => $employee["resume"],
						"agreement" => $employee["employeeAgreement"],
						"updateDateTime" => ModelMaster::dateNumberDash($employee["updateDateTime"])
					]) ?>
				</div>
				<div class="col-lg-9 col-md-6 col-12" id='show4' style="background-color: white;display:none;">
					<?= $this->render('salary') ?>
				</div>
				<div class="col-lg-9 col-md-6 col-12" id='show5' style="background-color: white;display:none;">
					<?= $this->render('evaluation') ?>
				</div>
			</div>
		</div>
	</div>
</div>