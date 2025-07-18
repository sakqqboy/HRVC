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

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<!-- <div class="company-group-edit"> -->
<div class="company-group-body">
    <div class="contrainer-body">
        <div class="col-12 banner-uploade" id="imagePreviewBanner">
            <?php
			if ($company["banner"] != null) { ?>
            <img src="<?= Yii::$app->homeUrl . $company['banner'] ?>" class="sad-1" id="old-banner">
            <?php
			}
			?>
        </div>

        <div class="row mb-100">
            <div class="col-12" style="margin-top:-50px; display: flex;">
                <!-- <div class="col-10 avatar-upload" style="margin-left:36px;">
                    <div class="avatar-preview" id="imagePreview" style="background-color: white;">
                        <label for="imageUpload" class="upload-label">
                            <img src="<?= Yii::$app->homeUrl ?>image/upload-img.svg" alt="Upload Icon">
                            <span>Upload</span>
                        </label>
                    </div>
                </div> -->
                <div class="col-10 mb-15 avatar-upload" style="margin-left:36px;">
                    <div class="avatar-preview" id="imagePreview" style="
                            background-color: white;
                            fill: #FFF;
                            stroke-width: 1px;
                            stroke: var(--Primary-Blue---HRVC, #2580D3);
                            border-radius: 100%;
                            text-align: center;
                            cursor: pointer;
                        ">
                        <label for="imageUpload" class="upload-label" style="cursor: pointer;  display: block;">
                            <?php
                            if ($company["picture"] != null) { ?>
                            <img src="<?= Yii::$app->homeUrl . $company['picture'] ?>"
                                style="width: 200px; height: 200px;" class="company-group-picture" id="old-image">
                            <?php
                            } else { ?>
                            <img src="<?= Yii::$app->homeUrl . 'image/upload-iconimg.svg' ?>"
                                style="width: 50px; height: auto;" alt="Upload Icon"> <br><br>
                            <span style=""><?= Yii::t('app', 'Upload') ?><span style="font-size: 13px; color: #666;">
                                    <?= Yii::t('app', 'or Drop') ?></span></span><br>
                            <span
                                style="font-size: 13px; color: #666;"><?= Yii::t('app', 'Branch Picture here') ?></span>
                            <?php
                            }
                            ?>
                        </label>
                        <input type="file" name="image" id="imageUpload" class="upload up upload-checklist"
                            style="display: none;" />
                    </div>
                </div>

                <div class="col-2" style="display: flex; justify-content: center;  align-items: center; ">
                    <!-- ลบระยะห่างระหว่างรูปและรายละเอียด -->
                    <span class="fileUpload btn" style="padding: 0;">
                        <div id="upload" class="uplode-btn-group">
                            <img src="<?= Yii::$app->homeUrl ?>image/upload-white.svg" alt="Upload Icon">
                            <?= Yii::t('app', 'Update') ?>
                        </div>
                        <input type="file" name="imageUploadBanner" id="imageUploadBanner"
                            class="upload up upload-checklist" id="up" />
                    </span>
                </div>
            </div>
        </div>
        <div class="col-12 mt-50">
            <div class="row update-group-body">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="container">
                        <div class="row">
                            <!-- Left Column -->
                            <div class="col-md-6">
                                <div class="form-group mb-30">
                                    <span class="text-danger">* </span><label class="name-text-update" for="groupName">
                                        <?= Yii::t('app', 'Registered Company Name') ?>
                                    </label>
                                    <input type="text" class="form-control mt-12" id="colFormLabel" name="companyName"
                                        value="<?= $company['companyName'] ?>"
                                        placeholder="<?= Yii::t('app', 'Write the name of Group') ?>" required>
                                </div>
                                <div class="form-group mb-30">
                                    <span class="text-danger">* </span> <label class="name-text-update" for="groupName">
                                        <?= Yii::t('app', 'Display Name/Brand Name') ?>
                                    </label>
                                    <input type="text" class="form-control mt-12" name="displayName"
                                        value="<?= $company['displayName'] ?>"
                                        placeholder="<?= Yii::t('app', 'The name you want to show (example,. Google)') ?>"
                                        required>
                                </div>

                                <div class="form-group mb-30">

                                    <span class="text-danger">* </span>
                                    <label class="name-text-update"
                                        for="founded"><?= Yii::t('app', 'Founded') ?></label>

                                    <div class="input-group">
                                        <span class="input-group-text mt-12"
                                            style="background-color: #BEDAFF; border-right: none;">
                                            <img src="<?= Yii::$app->homeUrl ?>image/calendar-blue.svg" alt="Founded"
                                                style="width: 20px; height: 20px;">
                                        </span>
                                        <input type="text" id="founded" name="founded"
                                            value="<?= $company['founded'] ?>" class="form-control mt-12 text-center"
                                            placeholder="<?= Yii::t('app', 'Select date') ?>" required
                                            style="text-align: center;">
                                    </div>
                                </div>
                                <div class="form-group mb-30">
                                    <span class="text-danger">* </span><label class="name-text-update" for="industry">
                                        <?= Yii::t('app', 'Industry') ?>
                                    </label>
                                    <input type="text" class="form-control mt-12" name="industries"
                                        value="<?= $company['industries'] ?>"
                                        placeholder="<?= Yii::t('app', 'Write the industry name') ?>" required>
                                </div>
                                <div class="form-group mb-30">
                                    <span class="text-danger">* </span> <label class="name-text-update" for="director">
                                        <?= Yii::t('app', 'Country in Operation') ?>
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/help.svg"
                                            data-toggle="tooltip" data-placement="top"
                                            aria-label="<?= Yii::t('app', 'select to country') ?>"
                                            data-bs-original-title="<?= Yii::t('app', 'select to country') ?>">
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text mt-12"
                                            style="background-color: white; border-right: none;">
                                            <img src="<?= Yii::$app->homeUrl ?>image/web-gray.svg" alt="Website"
                                                style="width: 20px; height: 20px;">
                                        </span>
                                        <select class="form-select mt-12" style="border-left: none;" name="country"
                                            required>
                                            <!-- <option value="" disabled selected hidden style="color: var(--Helper-Text, #8A8A8A);
                                                ">
                                                <?= Yii::t('app', 'e.g., ASEAN, North America, Europe') ?>
                                            </option> -->
                                            <option value="<?= $companyCountry['countryId'] ?>">
                                                <?= $companyCountry['countryName'] ?></option>
                                            <?php foreach ($countries as $countryId => $country) : ?>
                                            <option value="<?= $countryId ?>"><?= $country ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>

                            </div>

                            <!-- Right Column -->
                            <div class="col-md-6">

                                <div class="form-group mb-30">
                                    <span class="text-danger">* </span> <label class="name-text-update" for="phone">
                                        <?= Yii::t('app', 'Contact/Phone Number') ?>
                                    </label>
                                    <input type="text" class="form-control mt-12" name="phone"
                                        value="<?= $company['contact'] ?>"
                                        placeholder="<?= Yii::t('app', 'Write the phonenumber') ?>" required
                                        pattern="[0-9+\-]+" title="กรุณากรอกเฉพาะตัวเลข, + และ -"
                                        oninput="this.value = this.value.replace(/[^0-9+\-]/g, '');">
                                </div>
                                <div class="form-group mb-30">
                                    <span class="text-danger">* </span> <label class="name-text-update" for="email">
                                        <?= Yii::t('app', 'Company’s General Email') ?>
                                    </label>
                                    <input type="email" class="form-control mt-12" name="email"
                                        value="<?= $company['email'] ?>"
                                        placeholder="<?= Yii::t('app', 'e.g., jp_paris_cs@tokyoconsultinggroup.com') ?>"
                                        required>
                                </div>
                                <div class="form-group mb-30">
                                    <span class="text-danger">* </span> <label class="name-text-update">
                                        <?= Yii::t('app', 'Company’s Address') ?>
                                    </label>
                                    <input type="text" class="form-control mt-12" name="location"
                                        value="<?= $company['location'] ?>"
                                        placeholder="<?= Yii::t('app', 'Please input the address here') ?>" required>
                                </div>

                                <div class="form-group mb-30">
                                    <span class="text-danger">* </span> <label class="name-text-update">
                                        <?= Yii::t('app', 'Head of Company') ?>
                                    </label>

                                    <div class="input-group">
                                        <span class="input-group-text mt-12"
                                            style="background-color: #ffff; border-right: none;">
                                            <img src="<?= Yii::$app->homeUrl ?>image/employee-black.svg" alt="Founded"
                                                style="width: 20px; height: 20px;">
                                        </span>

                                        <select class="form-select mt-12" style="border-left: none;" name="directorId"
                                            required>
                                            <option value="" disabled selected hidden style="color: var(--Helper-Text, #8A8A8A);
                                                ">
                                                <?= Yii::t('app', 'Select from employees') ?>
                                            </option>
                                            <?php foreach ($headQuater as $user): ?>
                                            <option value="<?= $user['employeeId'] ?>"
                                                <?= isset($company['directorId']) && $company['directorId'] == $user['employeeId'] ? 'selected' : '' ?>>
                                                <?= $user['employeeFirstname'] . ' ' . $user['employeeSurename'] ?>
                                            </option>
                                            <?php endforeach; ?>

                                        </select>
                                    </div>
                                </div>

                                <div class="form-group mb-30">
                                    <span class="text-danger"> <img src="<?= Yii::$app->homeUrl ?>image/think-ideit.svg"
                                            alt="Founded" style="width: 20px; height: 20px;"> </span> <label
                                        class="name-text-update"><?= Yii::t('app', 'Hints') ?></label>
                                    <div class="input-group">
                                        <text><?= Yii::t('app', 'To assign a company head, first add employees
                                            under the company. Then, go
                                            to the Company Details page, click Edit, and select a head from the
                                            available employees in the dropdown. Save the changes to confirm.') ?></text>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="row">
                        <div class="name-text-update">
                            <span class="profile-moon">*</span>
                            <?= Yii::t('app', 'Group Description') ?>
                        </div>
                        <div>
                            <div class="alert alert-secondary" role="alert"
                                style="font-size: 14px; background-color: transparent; border: 0; ">
                                <textarea style="height: 527px;" name="about"
                                    class="form-control"><?= Yii::t('app', $company['about'] ) ?></textarea>

                            </div>
                            <div class="col-12 text-end mt-10 pr-13">
                                <a href="<?= Yii::$app->homeUrl ?>setting/group/create-group"
                                    style="text-decoration: none;">
                                    <button type="button" class="btn-cancel-group"
                                        action="<?= Yii::$app->homeUrl ?>setting/group/create-group"><?= Yii::t('app', 'Cancel') ?></button>
                                </a>

                                <button type="submit" class="btn-save-group">
                                    <?= Yii::t('app', 'Save') ?>
                                    <img src="<?= Yii::$app->homeUrl ?>image/save-icon.svg" alt="LinkedIn"
                                        style="width: 20px; height: 20px;"></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<input type="hidden" name="companyId" value="<?= $company['companyId'] + 543 ?>">

<?php ActiveForm::end(); ?>