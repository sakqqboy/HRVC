<?php

use yii\bootstrap5\ActiveForm;

$this->title = 'New Company';
?>
<?php $form = ActiveForm::begin([
	'id' => 'create-group',
	'method' => 'post',
	'options' => [
		'enctype' => 'multipart/form-data',
	],
	'action' => Yii::$app->homeUrl . 'setting/company/save-create-company'

]); ?>
<div class="col-12" style="margin-top: 60px;background-color:white;padding-bottom:20px;">
	<div class="col-12" id="imagePreviewBanner" style="height: 180px;background-color:gray;">
	</div>
	<div class="col-12 edit-update text-end" style="padding-right: 30px;">
		<div class="form-group">

			<span class="fileUpload btn btn-light">
				<div id="upload" class="uplode-btn"><i class="fa fa-upload" aria-hidden="true"></i> Update</div>
				<input type="file" name="imageUploadBanner" id="imageUploadBanner" class="upload up upload-checklist" id="up" />
			</span><!-- btn-orange -->
			<!-- group -->
		</div><!-- form-group -->

	</div>
	<div class="row">
		<div class="col-lg-4 col-md-6 col-12 all-avatar">
			<div class="avatar-upload">
				<div class="avatar-edit">
					<input type='file' id="imageUpload" accept=".png, .jpg, .jpeg" name="image" />
					<label for="imageUpload"></label>
				</div>
				<div class="avatar-preview" style="background-color:white;">
					<div id="imagePreview">
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-6 col-md-6 col-12">
			<div class="form-companyname">
				<div class="row">
					<?php
					if (isset($headQuater) && !empty($headQuater)) { ?>
						<div class="col-5 Groupname1">
							Company Name <span class="profile-moon">*</span>
						</div>
					<?php
					} else { ?>
						<div class="col-5 Groupname1">
							Head Quater Name <span class="profile-moon">*</span>
						</div>
					<?php

					}
					?>
					<div class="col-7">
						<input type="text" class="form-control" id="colFormLabel" name="companyName" required>
					</div>
					<div class="mt-20"></div>
					<!-- <div class="col-5">
						Tag line
					</div>
					<div class="col-7">
						<input type="text" class="form-control" id="colFormLabel" name="tagLine">
					</div> -->
					<div class="mt-20"></div>
					<?php
					if (isset($headQuater) && !empty($headQuater)) { ?>
						<div class="col-5">
							Headquarter <span class="profile-moon">*</span>
						</div>

						<div class="col-7">

							<input type="hidden" name="headQuaterId" value="<?= $headQuater["companyId"] + 543 ?>">

							<?= $headQuater["companyName"] ?>

						</div>
					<?php
					}
					?>
				</div>
			</div>
		</div>
	</div>
	<div class="col-12 mt-50">
		<div class="row">
			<div class="col-lg-6 col-md-6 col-12">
				<hr>
			</div>
			<div class="col-lg-6 col-md-6 col-12 text-end Groupname2" style="padding-right: 40px;">
				Company Profile
			</div>
		</div>
	</div>
	<div class="col-12" s>
		<div class="row">
			<div class="col-lg-6 col-md-6 col-12">
				<div class="col-12 mt-40">
					<div class="row">
						<div class="col-3 pl-30">
							Display <span class="profile-moon">*</span>
						</div>
						<div class="col-9">
							<input type="text" class="form-control" name="displayName" required>
						</div>
						<div class="mt-20"></div>
						<div class="col-3  pl-30">
							Website </div>
						<div class="col-9">
							<input type="text" class="form-control" name="website">
						</div>
						<div class="mt-20"></div>
						<div class="col-3  pl-30">
							Address <span class="profile-moon">*</span>
						</div>
						<div class="col-9">
							<input type="text" class="form-control" name="location" required>
						</div>
						<div class="mt-20"></div>
						<div class="col-12">
							<div class="row">
								<div class="col-3  pl-30">
									Country
								</div>
								<div class="col-4">
									<select class="form-control" name="country">
										<option value="">Select country</option>
										<?php
										if (isset($countries) && count($countries) > 0) {
											foreach ($countries as $countryId => $country) : ?>
												<option value="<?= $countryId ?>"><?= $country ?></option>
										<?php
											endforeach;
										}
										?>
									</select>

								</div>
								<div class="col-1">
									City
								</div>
								<div class="col-4">
									<input type="text" class="form-control" name="city">
								</div>
								<div class="mt-20"></div>
								<div class="col-3  pl-30">
									Postal Code
								</div>
								<div class="col-4">
									<input type="text" class="form-control" name="postalCode">
								</div>
								<div class="mt-20"></div>
								<div class="col-3  pl-30">
									Industries <span class="profile-moon">*</span>
								</div>
								<div class="col-4">
									<input type="text" class="form-control" name="industries" required>
								</div>
								<div class="col-2">
									Email <span class="profile-moon">*</span>
								</div>
								<div class="col-3">
									<input type="email" class="form-control" name="email">
								</div>
								<div class="mt-20"></div>
								<div class="col-3  pl-30">
									Founded
								</div>
								<div class="col-4">
									<input type="text" name="founded" class="form-control">
								</div>
								<div class="col-2">
									Contact <span class="profile-moon">*</span>
								</div>
								<div class="col-3">
									<input type="text" class="form-control" name="contact">
								</div>
								<div class="mt-20"></div>
								<div class="col-3 pl-30">
									Director <span class="profile-moon">*</span>
								</div>
								<div class="col-4">
									<input type="text" class="form-control" name="director" required>
								</div>
								<div class="col-2">
									Social Tag
								</div>
								<div class="col-3">
									<input type="text" name="socialTag" class="form-control">
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-6 col-md-6 col-12 mt-40" style="padding-right: 40px;">
				<div class="row">
					<div class="col-2 text-end" style="padding-top: 200px;font-size:14px;">
						ABOUT <span class="profile-moon">*</span>
					</div>
					<div class="col-10">
						<div class="alert alert-secondary" role="alert" style="font-size: 14px;">
							<textarea style="height:410px;" name="about" class="form-control"></textarea>

						</div>

					</div>
					<input type="hidden" name="groupId" value="<?= $groupId + 543 ?>">
					<div class="col-12 text-end mt-10">
						<button type="submit" class="btn btn-success">Create Company</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php ActiveForm::end(); ?>