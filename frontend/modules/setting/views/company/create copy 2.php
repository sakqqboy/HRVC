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
<div class="company-group-edit">
    <div class="contrainer-body">
        <div class="col-12 banner-uploade" id="imagePreviewBanner">

        </div>

        <div class="row mb-100">
            <div class="col-12" style="margin-top:-50px; display: flex;">
                <div class="col-10 avatar-upload" style="margin-left:36px;">
                    <div class="avatar-preview" id="imagePreview" style="background-color: white;">
                        <label for="imageUpload" class="upload-label">
                            <img src="<?= Yii::$app->homeUrl ?>image/upload-img.svg" alt="Upload Icon">
                            <span>Upload</span>
                        </label>
                    </div>
                </div>
                <div class="col-2" style="display: flex; justify-content: center;  align-items: center; ">
                    <!-- ลบระยะห่างระหว่างรูปและรายละเอียด -->
                    <span class="fileUpload btn" style="padding: 0;">
                        <div id="upload" class="uplode-btn-group">
                            <img src="<?= Yii::$app->homeUrl ?>image/upload-white.svg" alt="Upload Icon">
                            Update
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
                                    <span class="text-danger">* </span><label class="name-text-update"
                                        for="groupName">Registered Group Name</label>
                                    <input type="text" class="form-control mt-12" name="groupName"
                                        placeholder="Write the name of Group" required>
                                </div>
                                <div class="form-group mb-30">
                                    <span class="text-danger">* </span> <label class="name-text-update"
                                        for="groupName">Display Name/Brand Name</label>
                                    <input type="text" class="form-control mt-12" name="displayName"
                                        placeholder="The name you want to show (example,. Google)" required>
                                </div>
                                <div class="form-group mb-30">
                                    <span class="text-danger">* </span><label class="name-text-update"
                                        for="tagLine">Slogan/Tagline</label>
                                    <input type="text" class="form-control mt-12" name="tagLine"
                                        placeholder="Write the Tagline of the group" required>
                                </div>
                                <div class="form-group mb-30">
                                    <span class="text-danger">* </span> <label class="name-text-update"
                                        for="founded">Founded</label>
                                    <div class="input-group">
                                        <span class="input-group-text mt-12"
                                            style="background-color: #BEDAFF; border-right: none;">
                                            <img src="<?= Yii::$app->homeUrl ?>image/calendar-blue.svg" alt="Founded"
                                                style="width: 20px; height: 20px;">
                                        </span>
                                        <input type="text" style="border-left: none;" class="form-control mt-12"
                                            name="founded" placeholder="" required>
                                    </div>
                                </div>
                                <div class="form-group mb-30">
                                    <span class="text-danger">* </span><label class="name-text-update"
                                        for="industry">Industry</label>
                                    <input type="text" class="form-control mt-12" name="industries"
                                        placeholder="Write the industry name" required>
                                </div>
                                <div class="form-group mb-30">
                                    <span class="text-danger">* </span> <label class="name-text-update"
                                        for="director">Group Director </label>
                                    <input type="text" class="form-control mt-12" name="director"
                                        placeholder="Write the name of Group" required>
                                </div>

                            </div>

                            <!-- Right Column -->
                            <div class="col-md-6">
                                <div class="form-group mb-30">
                                    <span class="text-danger">* </span> <label class="name-text-update"
                                        for="email">Group
                                        Email </label>
                                    <input type="email" class="form-control mt-12" name="email"
                                        placeholder="Write the email" required>
                                </div>
                                <div class="form-group mb-30">
                                    <span class="text-danger">* </span> <label class="name-text-update" for="phone">
                                        Contact/Phone Number </label>
                                    <input type="text" class="form-control mt-12" name="phone"
                                        placeholder="Write the phone number" required pattern="[0-9+\-]+"
                                        title="กรุณากรอกเฉพาะตัวเลข, + และ -"
                                        oninput="this.value = this.value.replace(/[^0-9+\-]/g, '');">
                                </div>


                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="row">
                        <div class="name-text-update">
                            <span class="profile-moon">*</span>
                            Group Description
                        </div>
                        <div>
                            <div class="alert alert-secondary" role="alert"
                                style="font-size: 14px; background-color: transparent; border: 0; ">
                                <textarea style="height: 527px;" name="about" class="form-control"></textarea>

                            </div>
                            <div class="col-12 text-end mt-10 pr-13">
                                <a href="<?= Yii::$app->homeUrl ?>setting/group/create-group"
                                    style="text-decoration: none;">
                                    <button type="button" class="btn-cancel-group"
                                        action="<?= Yii::$app->homeUrl ?>setting/group/create-group">Cancel</button>
                                </a>

                                <button type="submit" class="btn-save-group">Save
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
<?php ActiveForm::end(); ?>