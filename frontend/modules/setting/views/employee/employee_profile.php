<?php

use common\models\ModelMaster;

$this->title = 'view';
?>

<div class="col-12 mt-90">
	<div class="col-12 view-goback">
		<a href="<?= Yii::$app->homeUrl ?>setting/employee/index" class="no-underline-black">
			<i class="fa fa-caret-left font-size-22" aria-hidden="true"></i> &nbsp;Go Back
		</a>
	</div>
	<div class="alert alert-goback">
		<div class="col-12">
			<div class="alert alert-light mr-10 ml-10" style="border: none;">
				<div class="row">
					<div class="col-lg-2 col-md-6 col-12">
						<img src="<?= Yii::$app->homeUrl . $employee['picture'] ?>" class="imageView">
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
							<span class="badge bg-<?= $text ?> font-size-14 ml-20">Active</span>
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
							<div class="col-lg-12 col-md-6 col-12 box-shareprofile">
								<div class="row">
									<div class="col-4 font-size-14 share-pointer">
										<i class="fa fa-share-alt" aria-hidden="true"></i> Share Profile
									</div>
									<div class="col-2 font-size-14 share-pointer">
										<i class="fa fa-print" aria-hidden="true"></i> Print
									</div>
									<div class="col-4 font-size-14 share-pointer">
										<a href="<?= Yii::$app->homeUrl . $employee['resume'] ?>" target="_blank" style="text-decoration:none;">
											<i class="fa fa-cloud-download" aria-hidden="true"></i> Download CV
										</a>
									</div>
									<div class="col-2 font-size-14 share-pointer">
										<i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit
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
									<a class="link-2" href="" id="v-tabs-home-tab" data-mdb-toggle="tab" role="tab" aria-controls="v-tabs-home" aria-selected="true">Personal & Contact Details</a>
									<a class="link-2" href="" id="v-tabs-Work-tab" data-mdb-toggle="tab" role="tab" aria-controls="v-tabs-Work" aria-selected="false">Work Information</a>
									<a class="link-2" href="" id="v-tabs-Attach-tab" data-mdb-toggle="tab" role="tab" aria-controls="v-tabs-Attach" aria-selected="false">Attachments</a>
									<a class="link-2" href="" id="v-tabs-Salary-tab" data-mdb-toggle="tab" role="tab" aria-controls="v-tabs-Salary" aria-selected="false">Salary & Allowance</a>
									<a class="link-2" href="" id="v-tabs-Evaluation-tab" data-mdb-toggle="tab" role="tab" aria-controls="v-tabs-Evaluation" aria-selected="false">Evaluation</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-9 col-md-6 col-12" style="background-color: white;">
					<div class="row">
						<div class="col-lg-6 col-md-6 col-12 pr-30">
							<div class="col-12 mt-40 pl-10 font-size-18">
								<i class="fa fa-info-circle mr-10" aria-hidden="true"></i> Personal Information
							</div>
							<hr>
							<div class="row pl-20 font-size-14">
								<div class="col-5 mt-10">
									First Name
								</div>
								<div class="col-7 mt-10 view-font-bold">
									<?= $employee['employeeFirstname'] ?>
								</div>
								<div class="col-5 mt-20">
									Last Name
								</div>
								<div class="col-7 mt-20 view-font-bold">
									<?= $employee['employeeSurename'] ?>
								</div>
								<div class="col-5 mt-20">
									Nationality
								</div>
								<div class="col-7 mt-20 view-font-bold">
									<?= $employee['countryName'] ?>
								</div>
								<div class="col-5 mt-20">
									Date of Birth
								</div>
								<div class="col-7 mt-20 view-font-bold">
									<?= ModelMaster::dateNumberDash($employee['birthDate']) ?>
								</div>
								<div class="col-5 mt-20">
									Age
								</div>
								<div class="col-7 mt-20 view-font-bold">
									<?= $employee['age'] ?>
								</div>
								<div class="col-5 mt-20">
									Gender
								</div>
								<div class="col-7 mt-20 view-font-bold">
									<?php
									if ($employee['gender'] == 1) {
									?>
										Male <i class="fa fa-mars" aria-hidden="true"></i>
									<?php
									} else { ?>
										Female <i class="fa fa-venus" aria-hidden="true"></i>
									<?php
									}
									?>
								</div>

								<div class="col-5 mt-20">
									Address
								</div>
								<div class="col-7 mt-20 view-font-bold">
									<?= $employee['address1'] ?>
								</div>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-12 mt-40 pl-30" style="border-left: lightgrey solid thin;">
							<div class="col-12 font-size-18">
								<i class="fa fa-phone mr-10" aria-hidden="true"></i> Contact Information
							</div>
							<hr>
							<div class="row font-size-14">

								<div class="col-5  mt-10">
									Personal Email
								</div>
								<div class="col-7  mt-10 view-font-bold">
									<?= $employee['email'] ?> <i class="fa fa-clipboard view-cursor" aria-hidden="true"></i>
								</div>
								<div class="col-5 mt-20">
									Contact Number
								</div>
								<div class="col-7 mt-20 view-font-bold">
									<?= $employee['telephoneNumber'] ?> <i class="fa fa-clipboard view-cursor" aria-hidden="true"></i>
								</div>
								<div class="col-5 mt-20">
									Emergency Contact Number
								</div>
								<div class="col-7 mt-20 view-font-bold">
									<?= $employee['emergencyTel'] ?> <i class="fa fa-clipboard view-cursor" aria-hidden="true"></i>
								</div>
								<div class="col-5 mt-20">
									Company Mail
								</div>
								<div class="col-7 mt-20 view-font-bold1">
									<?= $employee['companyEmail'] ?> <i class="fa fa-clipboard view-cursor" aria-hidden="true"></i>
								</div>
								<div class="col-5 mt-20">
									Social Links
								</div>
								<div class="col-7 mt-20 view-font-bold">
									<?= $employee['socialLink'] ?>
									<!-- <p><i class="fa fa-facebook-square social-facebook" aria-hidden="true"></i> &nbsp;/watanabe <i class="fa fa-clipboard view-cursor" aria-hidden="true"></i></p> -->
									<!-- <p><i class="fa fa-twitter-square" aria-hidden="true"></i> &nbsp;/watanabetadawoki <i class="fa fa-clipboard view-cursor" aria-hidden="true"></i></p>
													<p><i class="fa fa-linkedin-square" aria-hidden="true"></i> &nbsp;/watanab546 <i class="fa fa-clipboard view-cursor" aria-hidden="true"></i></p> -->
								</div>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
</div>