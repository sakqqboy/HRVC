<?php

use common\models\ModelMaster;
use yii\bootstrap5\ActiveForm;

$this->title = 'Update Group';
?>
<?php $form = ActiveForm::begin([
	'id' => 'create-group',
	'method' => 'post',
	'options' => [
		'enctype' => 'multipart/form-data',
	],
	'action' => Yii::$app->homeUrl . 'setting/group/save-update-group'

]); ?>
<div class="col-12" style="margin-top: 60px;background-color:white;padding-bottom:20px;">
	<div class="col-12" id="imagePreviewBanner" style="height: 180px;background-color:gray;">
		<?php
		if ($group["banner"] != null) { ?>
			<img src="<?= Yii::$app->homeUrl . $group['banner'] ?>" class="sad-1" id="old-banner">
		<?php
		}
		?>
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
						<?php
						if ($group["picture"] != null) { ?>
							<img src="<?= Yii::$app->homeUrl . $group['picture'] ?>" class="company-group-picture" id="old-image">
						<?php
						} else { ?>

						<?php
						}
						?>
					</div>

				</div>
			</div>
		</div>
		<div class="col-lg-6 col-md-6 col-12">
			<div class="form-companyname">
				<div class="row">
					<div class="col-5 Groupname1">
						Group Company Name <span class="profile-moon">*</span>
					</div>
					<div class="col-7">
						<input type="text" class="form-control" name="groupName" value="<?= $group['groupName'] ?>" required>
					</div>
					<div class="mt-20"></div>
					<div class="col-5">
						Tag line
					</div>
					<div class="col-7">
						<input type="text" class="form-control" name="tagLine" value="<?= $group['tagLine'] ?>">
					</div>
					<div class="mt-20"></div>
					<div class="col-5">
						Headquarter <span class="profile-moon">*</span>
					</div>
					<div class="col-7">
						<input type="text" class="form-control" id="colFormLabel" name="headQuaterName" value="<?= $group['headQuaterName'] ?>" required>
					</div>
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
				Group Company Profile
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
							<input type="text" class="form-control" name="displayName" value="<?= $group['displayName'] ?>" required>
						</div>
						<div class="mt-20"></div>
						<div class="col-3  pl-30">
							Website </div>
						<div class="col-9">
							<input type="text" class="form-control" name="website" value="<?= $group['website'] ?>">
						</div>
						<div class="mt-20"></div>
						<div class="col-3  pl-30">
							Address <span class="profile-moon">*</span>
						</div>
						<div class="col-9">
							<input type="text" class="form-control" name="location" value="<?= $group['location'] ?>" required>
						</div>
						<div class="mt-20"></div>
						<div class="col-12">
							<div class="row">
								<div class="col-3  pl-30">
									Country
								</div>
								<div class="col-4">
									<select class="form-control" name="country" required>
										<option value="<?= $groupCountry['countryId'] ?>"><?= $groupCountry['countryName'] ?></option>
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
									<input type="text" class="form-control" name="city" value="<?= $group['city'] ?>">
								</div>
								<div class="mt-20"></div>
								<div class="col-3  pl-30">
									Postal Code
								</div>
								<div class="col-4">
									<input type="text" class="form-control" value="<?= $group['postalCode'] ?>" name="postalCode">
								</div>
								<div class="mt-20"></div>
								<div class="col-3  pl-30">
									Industries <span class="profile-moon">*</span>
								</div>
								<div class="col-4">
									<input type="text" class="form-control" value="<?= $group['industries'] ?>" name="industries" required>
								</div>
								<div class="col-2">
									Email <span class="profile-moon">*</span>
								</div>
								<div class="col-3">
									<input type="email" class="form-control" name="email" value="<?= $group['email'] ?>">
								</div>
								<div class="mt-20"></div>
								<div class="col-3  pl-30">
									Founded
								</div>
								<div class="col-4">
									<input type="text" name="founded" class="form-control" value="<?= $group['founded'] ?>">
								</div>
								<div class="col-2">
									Contact <span class="profile-moon">*</span>
								</div>
								<div class="col-3">
									<input type="text" class="form-control" name="contact" value="<?= $group['contact'] ?>">
								</div>
								<div class="mt-20"></div>
								<div class="col-3 pl-30">
									Director <span class="profile-moon">*</span>
								</div>
								<div class="col-4">
									<input type="text" class="form-control" name="director" value="<?= $group['director'] ?>" required>
								</div>
								<div class="col-2">
									Social Tag
								</div>
								<div class="col-3">
									<input type="text" name="socialTag" class="form-control" value="<?= $group['socialTag'] ?>">
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
					<input type="hidden" name="groupId" value="<?= $group['groupId'] + 543 ?>">
					<div class="col-10">
						<div class="alert alert-secondary" role="alert" style="font-size: 14px;">
							<textarea style="height:410px;" name="about" class="form-control"><?= $group['about'] ?></textarea>

						</div>
						<div class="row">
							<div class="col-4">
								<a href="<?= Yii::$app->homeUrl ?>setting/company/create/<?= ModelMaster::encodeParams(['groupId' => $group['groupId']]) ?>" class="no-underline">
									<div class="alert alert-secondary text-center" role="alert">
										<div class="text-primary"> Companies</div>
										<i class="fa fa-plus mt-10" aria-hidden="true"></i>
									</div>
								</a>
							</div>
							<div class="col-4">
								<a href="<?= Yii::$app->homeUrl ?>setting/employee/create/<?= ModelMaster::encodeParams(['groupId' => $group['groupId']]) ?>" class="no-underline">
									<div class="alert alert-secondary text-center" role="alert">
										<div class="text-primary"> Employees</div>
										<i class="fa fa-plus mt-10" aria-hidden="true"></i>
									</div>
								</a>
							</div>
							<div class="col-4">
								<a href="<?= Yii::$app->homeUrl ?>setting/branch/create/<?= ModelMaster::encodeParams(['groupId' => $group['groupId']]) ?>" class="no-underline">
									<div class="alert alert-secondary text-center" role="alert">
										<div class="text-primary"> Branches</div>
										<i class="fa fa-plus mt-10" aria-hidden="true"></i>
									</div>
								</a>
							</div>
						</div>
						<div class="col-12 text-end mt-10">
							<button type="submit" class="btn btn-success">Apply Changes</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php ActiveForm::end(); ?>