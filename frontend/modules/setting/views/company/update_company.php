<?php

use common\models\ModelMaster;
use yii\bootstrap5\ActiveForm;

$this->title = 'New Company';
?>
<?php $form = ActiveForm::begin([
	'id' => 'create-group',
	'method' => 'post',
	'options' => [
		'enctype' => 'multipart/form-data',
	],
	'action' => Yii::$app->homeUrl . 'setting/company/save-update-company'

]); ?>
<div class="contrainer-body" style="background-color:white;">
    <div class="col-12" style="height: 180px;background-color:gray;">
        <div class="col-12" id="imagePreviewBanner" style="height: 180px;background-color:gray;">
            <?php
			if ($company["banner"] != null) { ?>
            <img src="<?= Yii::$app->homeUrl . $company['banner'] ?>" class="sad-1" id="old-banner">
            <?php
			}
			?>
        </div>
    </div>
    <div class="col-12 edit-update text-end" style="padding-right: 30px;">
        <div class="form-group">

            <span class="fileUpload btn btn-light">
                <div id="upload" class="uplode-btn"><i class="fa fa-upload" aria-hidden="true"></i> Update</div>
                <input type="file" name="imageUploadBanner" id="imageUploadBanner" class="upload up upload-checklist"
                    id="up" />
            </span><!-- btn-orange -->
            <!-- group -->
        </div><!-- form-group -->

    </div>
    <div class="row">
        <div class="col-lg-4 col-md-6 col-12 all-avatar">
            <!-- <div class="avatar-upload">
                <div class="avatar-edit">
                    <input type='file' id="imageUpload" accept=".png, .jpg, .jpeg" name="image" />
                    <label for="imageUpload"></label>
                </div>
                <div class="avatar-preview" style="background-color:white;">
                    <div id="imagePreview">
                        <?php
						if ($company["picture"] != null) { ?>
                        <img src="<?= Yii::$app->homeUrl . $company['picture'] ?>" class="company-group-picture"
                            id="old-image">
                        <?php
						} else { ?>
                        <img src="<?= Yii::$app->homeUrl ?>image/upload-img.svg" alt="Upload Icon">
                        <span>Upload</span>
                        <?php
						}
						?>
                    </div>
                </div>
            </div> -->
            <div class="col-10 avatar-upload" style="padding-top: 100px;">
                <div class="avatar-preview" id="imagePreview" style="background-color: white;">
                    <label for="imageUpload" class="upload-label" style="cursor: pointer;">
                        <?php
						if ($company["picture"] != null) { ?>
                        <img src="<?= Yii::$app->homeUrl . $company['picture'] ?>" class="company-group-picture"
                            id="old-image">
                        <?php
						} else { ?>
                        <img src="<?= Yii::$app->homeUrl ?>image/upload-img.svg" alt="Upload Icon">
                        <span>Upload</span>
                        <?php
						}
						?>
                    </label>
                    <input type="file" name="image" id="imageUpload" class="upload up upload-checklist"
                        style="display: none;" />
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-12">
            <div class="form-companyname">
                <div class="row">
                    <?php
					if ($company["headQuaterId"] != null) { ?>
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
                        <input type="text" class="form-control" id="colFormLabel" name="companyName"
                            value="<?= $company['companyName'] ?>" required>
                    </div>
                    <div class="mt-20"></div>
                    <!-- <div class="col-5">
						Tag line
					</div>
					<div class="col-7">
						<input type="text" class="form-control" id="colFormLabel" name="tagLine" value="<?php // $company['tagLine'] 
																		?>">
					</div> -->
                    <div class="mt-20"></div>
                    <?php
					if ($company['headQuaterId'] != null) { ?>
                    <div class="col-5">
                        Headquarter <span class="profile-moon">*</span>
                    </div>

                    <div class="col-7">
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
                            <input type="text" class="form-control" name="displayName"
                                value="<?= $company['displayName'] ?>" required>
                        </div>
                        <div class="mt-20"></div>
                        <div class="col-3  pl-30">
                            Website </div>
                        <div class="col-9">
                            <input type="text" class="form-control" name="website" value="<?= $company['website'] ?>">
                        </div>
                        <div class="mt-20"></div>
                        <div class="col-3  pl-30">
                            Address <span class="profile-moon">*</span>
                        </div>
                        <div class="col-9">
                            <input type="text" class="form-control" name="location" required
                                value="<?= $company['location'] ?>">
                        </div>
                        <div class="mt-20"></div>
                        <div class="col-12">
                            <div class="row">
                                <div class="col-3  pl-30">
                                    Country
                                </div>
                                <div class="col-4">
                                    <select class="form-control" name="country" required>
                                        <option value="<?= $companyCountry['countryId'] ?>">
                                            <?= $companyCountry['countryName'] ?></option>
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
                                    <input type="text" class="form-control" name="city" value="<?= $company['city'] ?>">
                                </div>
                                <div class="mt-20"></div>
                                <div class="col-3  pl-30">
                                    Postal Code
                                </div>
                                <div class="col-4">
                                    <input type="text" class="form-control" name="postalCode"
                                        value="<?= $company['postalCode'] ?>">
                                </div>
                                <div class="mt-20"></div>
                                <div class="col-3  pl-30">
                                    Industries <span class="profile-moon">*</span>
                                </div>
                                <div class="col-4">
                                    <input type="text" class="form-control" name="industries" required
                                        value="<?= $company['industries'] ?>">
                                </div>
                                <div class="col-2">
                                    Email <span class="profile-moon">*</span>
                                </div>
                                <div class="col-3">
                                    <input type="email" class="form-control" name="email"
                                        value="<?= $company['email'] ?>">
                                </div>
                                <div class="mt-20"></div>
                                <div class="col-3  pl-30">
                                    Founded
                                </div>
                                <div class="col-4">
                                    <input type="text" name="founded" class="form-control"
                                        value="<?= $company['founded'] ?>">
                                </div>
                                <div class="col-2">
                                    Contact <span class="profile-moon">*</span>
                                </div>
                                <div class="col-3">
                                    <input type="text" class="form-control" name="contact"
                                        value="<?= $company['contact'] ?>">
                                </div>
                                <div class="mt-20"></div>
                                <div class="col-3 pl-30">
                                    Director <span class="profile-moon">*</span>
                                </div>
                                <div class="col-4">
                                    <input type="text" class="form-control" name="director" required
                                        value="<?= $company['director'] ?>">
                                </div>
                                <div class="col-2">
                                    Social Tag
                                </div>
                                <div class="col-3">
                                    <input type="text" name="socialTag" class="form-control"
                                        value="<?= $company['socialTag'] ?>">
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
                            <textarea style="height:410px;" name="about"
                                class="form-control"><?= $company['about'] ?></textarea>

                        </div>
                        <div class="row mt-20">
                            <div class="col-3">
                                <a href="<?= Yii::$app->homeUrl ?>setting/employee/create" class="no-underline">
                                    <div class="alert alert-secondary text-center col-12 pr-0 pl-0" role="alert"
                                        style="font-size: 13px;">
                                        <div class="text-primary"> Employees</div>
                                        <i class="fa fa-plus mt-10 plus-click0" aria-hidden="true"></i>
                                    </div>
                                </a>
                            </div>
                            <div class="col-3">
                                <a href="<?= Yii::$app->homeUrl ?>setting/branch/create/<?= ModelMaster::encodeParams(['companyId' => $company['companyId']]) ?>"
                                    class="no-underline">
                                    <div class="alert alert-secondary text-center  col-12 pr-0 pl-0" role="alert"
                                        style="font-size: 13px;">
                                        <div class="text-primary employee-center"> Branches</div>
                                        <i class="fa fa-plus mt-10 plus-click0" aria-hidden="true"></i>
                                    </div>
                                </a>
                            </div>
                            <div class="col-3">
                                <a href="<?= Yii::$app->homeUrl ?>setting/department/create/<?= ModelMaster::encodeParams(['companyId' => $company['companyId']]) ?>"
                                    class="no-underline-black">
                                    <div class="alert alert-secondary text-center  col-12 pr-0 pl-0" role="alert"
                                        style="font-size: 13px;">
                                        <div class="text-primary employee-center"> Departments</div>
                                        <i class="fa fa-plus mt-10 plus-click0" aria-hidden="true"></i>
                                    </div>
                                </a>
                            </div>
                            <div class="col-3">
                                <a href="<?= Yii::$app->homeUrl ?>setting/team/create/<?= ModelMaster::encodeParams(['companyId' => $company['companyId']]) ?>"
                                    class="no-underline-black">
                                    <div class="alert alert-secondary text-center col-12 pr-0 pl-0" role="alert"
                                        style="font-size: 13px;">
                                        <div class="text-primary employee-center"> Tearm</div>
                                        <i class="fa fa-plus mt-10 plus-click0" aria-hidden="true"></i>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-12 text-end mt-10">
                            <input type="hidden" name="companyId" value="<?= $company['companyId'] + 543 ?>">
                            <button type="submit" class="btn btn-primary"> Apply </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>