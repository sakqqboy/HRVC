<?php

use yii\bootstrap5\ActiveForm;

$this->title = 'Update Employee';
?>
<?php $form = ActiveForm::begin([
	'id' => 'update-employee',
	'method' => 'post',
	'options' => [
		'enctype' => 'multipart/form-data',
	],
	'action' => Yii::$app->homeUrl . 'setting/employee/save-update-employee'

]); ?>
<div class="col-12 mt-90">
	<div class="alert example-2 scrollbar-ripe-malinka alert-create0" role="alert">
		<div class="col-12 create2-one">
			Update Employee
		</div>
		<div class="col-12 mt-30 font-size-20" style="font-weight: 700;">
			Personal Information
		</div>
		<div class="col-12">
			<hr class="col-lg-10 col-12">
		</div>
		<div class="row">
			<div class="col-lg-3 col-md-6 col-12" style="border-right:lightgray solid thin">
				<div class="avatar-upload" style="margin-top: 17px;">
					<div class="avatar-edit">
						<input type='file' name="picture" id="imageUpload" accept=".png, .jpg, .jpeg" />
						<label for="imageUpload"></label>
					</div>
					<div class="avatar-preview">
						<div id="imagePreview">
							<img src="<?= Yii::$app->homeUrl . $employee['picture'] ?>" class="imageView" id="old-image">
						</div>
					</div>
				</div>
				<div class="col-12 acceptable font-size-12 text-center">
					<div class="col-12"> Acceptable file types: <strong> JPEG, PNG,</strong> </div>
					<div class="col-12 mt-2">Maximum file Size: 1 MB</div>
				</div>
			</div>

			<div class="col-lg-9 col-md-6 col-12 pl-20">
				<div class="row">
					<div class="col-lg-4 col-md-6 col-12 mt-10">
						<label class="form-label font-size-13"><strong class="text-danger">*</strong> First Name</label>
						<input type="text" class="form-control font-size-14" name="firstName" required value="<?= $employee['employeeFirstname'] ?>">
					</div>
					<div class="col-lg-4 col-md-6 col-12  mt-10">
						<label class="form-label font-size-13"><strong class="text-danger">*</strong> Last Name</label>
						<input type="text" class="form-control font-size-14" name="lastName" required value="<?= $employee['employeeSurename'] ?>">
					</div>
					<div class="col-lg-4 col-md-6 col-12  mt-10">
						<label class="form-label font-size-13"><strong class="text-danger">*</strong> Employee Number</label>
						<input type="text" class="form-control font-size-14" name="employeeNumber" required value="<?= $employee['employeeNumber'] ?>">
					</div>
					<div class="col-lg-4 col-md-6 col-12  mt-10">
						<label class="form-label font-size-13"><strong class="text-danger">*</strong> Joining Date</label>
						<input type="date" id="birthday" class="form-control font-size-14" name="joinDate" required value="<?= $employee['joinDate'] ?>">
					</div>
					<div class="col-lg-4 col-md-6 col-12 mt-10">
						<label class="form-label font-size-13"> Nationality </label>
						<select class="form-select font-size-14" name="nationality">
							<?php
							if (isset($oldData["nationality"])) { ?>

								<option value="<?= $oldData['nationality']['id'] ?>"><?= $oldData['nationality']['name'] ?></option>
							<?php
							}
							?>

							<?php
							if (isset($countries) && count($countries) > 0) {
								foreach ($countries as $countryId => $countryName) : ?>
									<option value="<?= $countryId ?>"><?= $countryName ?></option>
							<?php
								endforeach;
							}
							?>
						</select>
					</div>
					<!-- <div class="col-lg-3 col-md-6 col-3 mt-20">
						<label class="form-label font-size-13">Father's Name</label>
						<input type="text" class="form-control" placeholder="">
					</div>
					<div class="col-lg-3 col-md-6 col-3 mt-20">
						<label class="form-label font-size-13">Mother's Name</label>
						<input type="text" class="form-control font-size-14" placeholder="">
					</div> -->
					<div class="col-lg-4 col-md-6 col-12 mt-10">
						<label class="form-label font-size-13">
							<strong class="text-danger">*</strong> Date of Birth
						</label>
						<input type="date" id="birthday" class="form-control font-size-14" name="birthDate" required value="<?= $employee['birthDate'] ?>">
					</div>
					<div class="col-lg-5 col-md-6 col-12 mt-10">
						<label class="form-label font-size-13">
							<strong class="text-danger">*</strong> Address 1
						</label>
						<textarea name="address1" class="form-control font-size-14" required><?= $employee['address1'] ?></textarea>
					</div>
					<div class="col-lg-5 col-md-6 col-12 mt-10">
						<label class="form-label font-size-13">
							<strong class="text-danger">*</strong> Address 2
						</label>
						<textarea name="address2" class="form-control font-size-14" required><?= $employee['address2'] ?></textarea>
					</div>
					<div class="col-lg-2 col-md-6 col-12 mt-10">
						<label class="form-label font-size-13">
							<strong class="text-danger">*</strong> Gender
						</label>
						<select class="form-select font-size-14" name="gender" required>
							<?php
							if ($employee['gender'] = 1) { ?>
								<option value="1">Male</option>
								<option value="2">Female</option>
							<?php
							} else { ?>
								<option value="2">FeMale</option>
								<option value="1">Male</option>
							<?php

							}

							?>
						</select>
					</div>
				</div>
			</div>
		</div>
		<div class="col-12 mt-20 font-size-16" style="font-weight: 700;">
			Contact Information
		</div>
		<div class="col-12">
			<hr class="col-lg-10 col-12">
		</div>
		<div class="row">
			<div class="col-lg-3 col-md-6 col-12">
				<label class="form-label font-size-13"><strong class="text-danger">*</strong> Contact Number</label>
				<input type="text" class="form-control font-size-14" name="telephoneNumber" required value="<?= $employee['telephoneNumber'] ?>">
			</div>
			<div class="col-lg-3 col-md-6 col-12">
				<label class="form-label font-size-13"><strong class="text-danger">*</strong> Emergency Contact Number</label>
				<input type="text" class="form-control font-size-14" name="emergencyTel" required value="<?= $employee['emergencyTel'] ?>">

			</div>
			<div class="col-lg-3 col-md-6 col-12">
				<label class="form-label font-size-13"><strong class="text-danger">*</strong> Company Email</label>
				<input type="email" class="form-control font-size-14" name="companyEmail" required value="<?= $employee['companyEmail'] ?>">
			</div>
			<div class="col-lg-3 col-md-6 col-12">
				<label class="form-label font-size-13"><strong class="text-danger">*</strong> Personal Email</label>
				<input type="email" class="form-control font-size-14" name="personalEmail" required value="<?= $employee['email'] ?>">
			</div>
		</div>
		<div class="col-12 mt-30 font-size-16" style="font-weight: 700;">
			Work Information
		</div>
		<div class="col-12">
			<hr class="col-lg-10 col-12">
		</div>
		<input type="hidden" name="eId" value="<?= $employee['employeeId'] ?>">
		<div class="row">
			<div class="col-lg-3 col-md-6 col-12">
				<label class="form-label font-size-13"><strong class="text-danger">*</strong> Company</label>
				<select class="form-select font-size-14" id="company-team" name="company" onchange="javascript:branchCompany()">
					<?php
					if (isset($oldData["company"])) { ?>

						<option value="<?= $oldData['company']['id'] ?>"><?= $oldData['company']['name'] ?></option>
					<?php
					}
					?>
					<?php
					if (isset($companies) && count($companies) > 0) {
						foreach ($companies as $company) : ?>
							<option value="<?= $company['companyId'] ?>"><?= $company['companyName'] ?></option>
					<?php

						endforeach;
					}
					?>
				</select>
			</div>
			<div class="col-lg-3 col-md-6 col-12">
				<label class="form-label font-size-13"><strong class="text-danger">*</strong> Branch</label>
				<select class="form-select font-size-14" id="branch-team" name="branch" onchange="javascript:departmentBranch()">
					<?php
					if (isset($oldData["branch"])) { ?>

						<option value="<?= $oldData['branch']['id'] ?>"><?= $oldData['branch']['name'] ?></option>
					<?php
					}
					?>
				</select>
			</div>
			<div class="col-lg-3 col-md-6 col-12">
				<label class="form-label font-size-13"><strong class="text-danger">*</strong> Department Name</label>
				<select class="form-select font-size-14" name="department" id="department-team" onchange="javascript:teamDepartment()">
					<?php
					if (isset($oldData["department"])) { ?>

						<option value="<?= $oldData['department']['id'] ?>"><?= $oldData['department']['name'] ?></option>
					<?php
					}
					?>
				</select>
			</div>
			<div class="col-lg-3 col-md-6 col-12">
				<label class="form-label font-size-13"><strong class="text-danger">*</strong>Team</label>
				<select class="form-select font-size-14" name="team" id="team-department">
					<?php
					if (isset($oldData["team"])) { ?>

						<option value="<?= $oldData['team']['id'] ?>"><?= $oldData['team']['name'] ?></option>
					<?php
					}
					?>
				</select>
			</div>
			<div class="col-lg-3 col-md-6 col-12 mt-10">
				<label class="form-label font-size-13"><strong class="text-danger">*</strong>Title</label>
				<select class="form-select font-size-14" name="title">
					<?php
					if (isset($oldData["title"])) { ?>

						<option value="<?= $oldData['title']['id'] ?>"><?= $oldData['title']['name'] ?></option>
					<?php
					}
					?>
					<?php
					if (isset($titles) && count($titles) > 0) {
						foreach ($titles as $title) : ?>
							<option value="<?= $title['titleId'] ?>"><?= $title['titleName'] ?></option>
					<?php
						endforeach;
					}
					?>
				</select>
			</div>
			<div class="col-lg-3 col-md-6 col-12 mt-10">
				<label class="form-label font-size-13"><strong class="text-danger">*</strong> Working Hours</label>
				<select class="form-select font-size-14" name="workTime" required>
					<option value="<?= $employee['workingTime'] ?>"><?= $employee['workingTime'] ?> hrs.</option>
					<?php
					$i = 1;
					while ($i < 13) {
					?>
						<option value="<?= $i ?>"><?= $i ?> hr<?= $i == 1 ? '' : 's' ?>.</option>
					<?php
						$i++;
					}
					?>
				</select>
			</div>
			<div class="col-lg-3 col-md-6 col-12 mt-10">
				<label class="form-label font-size-13"><strong class="text-danger">*</strong> Employee Condition</label>
				<select class="form-select font-size-14" name="condition" required>
					<?php
					if (isset($oldData["condition"])) { ?>

						<option value="<?= $oldData['condition']['id'] ?>"><?= $oldData['condition']['name'] ?></option>
					<?php
					}
					?>
					<?php
					if (isset($conditions) && count($conditions) > 0) {
						foreach ($conditions as $c) : ?>
							<option value="<?= $c['employeeConditionId'] ?>"><?= $c["employeeConditionName"] ?></option>
					<?php
						endforeach;
					}
					?>
				</select>
			</div>
			<div class="col-lg-3 col-md-6 col-12 mt-10">
				<label class="form-label font-size-13"><strong class="text-danger">*</strong> Employee Status</label>
				<select class="form-select font-size-14" name="status" required>
					<?php
					if (isset($oldData["status"])) { ?>

						<option value="<?= $oldData['status']['id'] ?>"><?= $oldData['status']['name'] ?></option>
					<?php
					}
					?>
					<?php
					if (isset($status) && count($status) > 0) {
						foreach ($status as $s) : ?>
							<option value="<?= $s['statusId'] ?>"><?= $s["statusName"] ?></option>
					<?php
						endforeach;
					}
					?>
				</select>
			</div>

			<!-- <div class="col-lg-3 col-md-6 col-12 mt-10">
				<label class="form-label font-size-13"><strong class="text-danger">*</strong> Management</label>
				<select class="form-select font-size-14" name="management" required>
					<option value="">Select</option>
				</select>
			</div> -->
		</div>
		<div class="col-12 mt-30 font-size-16" style="font-weight: 700;">
			Attachments
		</div>
		<div class="col-12 mb-30">
			<hr class="col-lg-10 col-12">
		</div>
		<div class="row">
			<div class="col-lg-6 col-md-6 col-12 " style="border-right:lightgray solid thin;">
				<div class="col-lg-11">
					<div class="dashed">
						<div class="row pt-10 pb-10">
							<div class="col-lg-2 col-md-6 col-12  text-center">
								<!-- <img src="<?= Yii::$app->homeUrl ?>image/file-plus.png" class="image-file-plus"> -->
								<label for="files" class="btn choosefile">File</label>
								<input id="files" style="display:none;" type="file" name="resume">
							</div>
							<div class="col-lg-6 col-md-6 col-12 " style="border-right:lightgray solid thin;">
								<label for="name">Upload Resume</label>
								<div class="text-secondary font-size-14">Supported Files <span class="text-dark font-size-10"> - .pdf, .doc, .docx</span></div>
								<div class="text-secondary font-size-14">Maximum File Size 5 MB</div>
							</div>
							<div class="col-lg-4 col-md-6 col-12 text-center pt-20">
								<!-- <button type="button" class="btn btn-info text-white"> Upload</button> -->
								<?php
								if ($employee['resume'] != null) { ?>
									<a href="<?= Yii::$app->homeUrl . $employee['resume'] ?>" target="_blank" style="text-decoration: none;">
										<i class="fa fa-eye mr-5" aria-hidden="true"></i>View resume
									</a>
								<?php

								}

								?>
							</div>
						</div>
					</div>
				</div>
				<div class="mt-20"></div>
				<div class="col-lg-11">
					<div class="dashed">
						<div class="row pt-10 pb-10">
							<div class="col-lg-2 col-md-6 col-12 text-center">
								<!-- <img src="<?= Yii::$app->homeUrl ?>image/pdf.png" class="image-file-plus"> -->
								<label for="files" class="btn choosefile">File</label>
								<input id="files" style="display:none;" type="file" name="agreement">
							</div>
							<div class="col-lg-6 col-md-6 col-12" style="border-right:lightgray solid thin;">
								<label for="name"> Employee Agreement-DD.pdf</label>
								<p class="text-secondary font-size-14">
									Size 1.21 MB
								</p>
							</div>
							<div class="col-lg-4 col-md-6 col-12 text-center pt-8">
								<!-- <a type="button" class="btn btn-outline-secondary"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> -->
								<a type="button" class="btn btn-outline-secondary mr-20"><i class="fa fa-eye" aria-hidden="true"></i></a>

								<a type="button" class="btn btn-outline-danger"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
								<div class="col-12 mt-10">
									<?php
									if ($employee['employeeAgreement'] != null) { ?>
										<a href="<?= Yii::$app->homeUrl . $employee['employeeAgreement'] ?>" target="_blank" style="text-decoration: none;">
											<i class="fa fa-eye mr-5" aria-hidden="true"></i>View Agreement
										</a>
									<?php

									}

									?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-lg-6 col-md-6 col-12 pl-40">
				<div class="col-12 font-size-21">
					<i class="fa fa-briefcase" aria-hidden="true"></i> Remarks
				</div>
				<div class="col-12 mt-5">
					<textarea class="form-control" name="remark" style="height:160px;"><?= $employee['remark'] ?></textarea>
				</div>
			</div>
		</div>
		<div class="col-12 mt-20 font-size-16" style="font-weight: 700;">
			Other
		</div>
		<div class="col-12">
			<hr class="col-lg-10 col-12">
		</div>
		<div class="row">
			<div class="col-lg-4 col-12 z-1">
				<div class="col-12">
					<label class="form-label font-size-13">Languages Spoken</label>
					<input type="text" class="form-control font-size-14" name="language" value="<?= $employee['spoken'] ?>">
				</div>
				<div class="col-12 mt-10">
					<label class="form-label font-size-13">Social Links</label>
					<input type="text" class="form-control font-size-14" name="socialLink" value="<?= $employee['socialLink'] ?>">
				</div>
			</div>
			<div class="col-lg-6 col-12 z-1">
				<div class="row">
					<div class="col-12">
						<label class="form-label font-size-13">Employee right</label>
					</div>
					<?php

					if (isset($roles) && count($roles) > 0) {
						$i = 0;
						foreach ($roles as $role) :
							$check = '';
							if (($i % 2) == 0) {
								$class = "col-4";
							} else {
								$class = "col-6";
							}
							if (isset($userRoles[$role["roleId"]])) {
								$check = "checked";
							}

					?>
							<div class="<?= $class ?> mt-10 font-size-14">
								<input type="checkbox" name="role[]" class="checkbox-md mr-5" value="<?= $role['roleId'] ?>" <?= $check ?>> <?= $role["roleName"] ?>
							</div>
						<?php
							$i++;
						endforeach;
					} else {
						?>
						<div class="col-12 text-center mt-20 font-size-84">
							Cantact Administrator
						</div>
					<?php
					}
					?>


				</div>
			</div>
			<div class="col-12 text-end z-0" style="margin-top: -40px;">
				<button type="submit" class="btn btn-warning text-white"> Update</button>
			</div>
		</div>
	</div>
</div>
<?php ActiveForm::end(); ?>