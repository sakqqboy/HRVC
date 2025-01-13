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
<div class="col-12 company-group-edit">
    <div class="col-12 banner-uploade" id="imagePreviewBanner">
        <!-- <?php
		if ($group["banner"] != null) { ?>
        <img src="<?= Yii::$app->homeUrl . $group['banner'] ?>" class="sad-1" id="old-banner">
        <?php
		}
		?> -->
    </div>
    <div class="col-12 edit-update text-end" style="padding-right: 30px;">
        <div class="form-group">
            <span class="fileUpload btn" style="padding: 0;">
                <div id="upload" class="uplode-btn-group">
                    <img src="<?= Yii::$app->homeUrl ?>image/upload-white.svg" alt="Upload Icon">
                    Update
                </div>
                <input type="file" name="imageUploadBanner" id="imageUploadBanner" class="upload up upload-checklist"
                    id="up" />
            </span>
        </div>
    </div>
    <div class="row mb-41">
        <div class="col-lg-4 col-md-6 col-12 all-avatar">
            <div class="avatar-upload">
                <div class="avatar-preview" id="imagePreview" style="background-color: white;">
                    <label for="imageUpload" class="upload-label">
                        <img src="<?= Yii::$app->homeUrl ?>image/upload-img.svg" alt="Upload Icon">
                        <span>Upload</span>
                    </label>
                </div>
                <input type="file" id="imageUpload" accept=".png, .jpg, .jpeg" name="image" />
            </div>


        </div>
        <div class="col-lg-6 col-md-6 col-12">

        </div>
    </div>
    <div class="col-12">
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
                                    value="<?= $group['groupName'] ?>" placeholder="Write the name of Group" required>
                            </div>
                            <div class="form-group mb-30">
                                <span class="text-danger">* </span> <label class="name-text-update"
                                    for="groupName">Display Name/Brand Name</label>
                                <input type="text" class="form-control mt-12" name="groupName"
                                    value="<?= $group['displayName'] ?>"
                                    placeholder="The name you want to show (example,. Google)" required>
                            </div>
                            <div class="form-group mb-30">
                                <span class="text-danger">* </span><label class="name-text-update"
                                    for="tagLine">Slogan/Tagline</label>
                                <input type="text" class="form-control mt-12" name="tagLine"
                                    value="<?= $group['tagLine'] ?>" placeholder="Write the Tagline of the group"
                                    required>
                            </div>
                            <div class="form-group mb-30">
                                <span class="text-danger">* </span> <label class="name-text-update"
                                    for="founded">Founded</label>
                                <div class="input-group">
                                    <span class="input-group-text mt-12"
                                        style="background-color: #BEDAFF; border-right: none;">
                                        <img src="<?= Yii::$app->homeUrl ?>image/calendar-blue.svg" alt="LinkedIn"
                                            style="width: 20px; height: 20px;">
                                    </span>
                                    <input type="text" style="border-left: none;" class="form-control mt-12"
                                        name="linkedin" value="<?= $group['founded'] ?>" placeholder="" required>
                                </div>
                            </div>
                            <div class="form-group mb-30">
                                <span class="text-danger">* </span><label class="name-text-update"
                                    for="industry">Industry</label>
                                <input type="text" class="form-control mt-12" name="industries"
                                    value="<?= $group['industries'] ?>" placeholder="Write the industry name" required>
                            </div>
                            <div class="form-group mb-30">
                                <span class="text-danger">* </span> <label class="name-text-update" for="director">Group
                                    Director </label>
                                <input type="text" class="form-control mt-12" name="director"
                                    value="<?= $group['director'] ?>" placeholder="Write
                                    the name of Group" required>
                            </div>
                            <div class="form-group mb-30">
                                <span class="text-danger">* </span> <label class="name-text-update"
                                    for="addressLine">Address Line</label>
                                <input type="text" class="form-control mt-12" name="location"
                                    value="<?= $group['location'] ?>" placeholder="Write the email" required>
                            </div>
                            <div class="form-group mb-30">
                                <span class="text-danger">* </span> <label class="name-text-update"
                                    for="country">Country</label>
                                <select class="form-control mt-12" name="country" placeholder="Write the phone number"
                                    required>
                                    <option value="<?= $groupCountry['countryId'] ?>">
                                        <?= $groupCountry['countryName'] ?></option>
                                    <?php foreach ($countries as $countryId => $country) : ?>
                                    <option value="<?= $countryId ?>"><?= $country ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <!-- Right Column -->
                        <div class="col-md-6">
                            <div class="form-group mb-30">
                                <span class="text-danger">* </span> <label class="name-text-update" for="email">Group
                                    Email </label>
                                <input type="email" class="form-control mt-12" name="email"
                                    value="<?= $group['email'] ?>" placeholder="Write the email" required>
                            </div>
                            <div class="form-group mb-30">
                                <span class="text-danger">* </span> <label class="name-text-update" for="phone">
                                    Contact/Phone Number </label>
                                <input type="email" class="form-control mt-12" name="email"
                                    value="<?= $group['contact'] ?>" placeholder="Write the phone number" required>
                            </div>

                            <div class="form-group mb-30">
                                <span class="text-danger">* </span><label class="name-text-update"
                                    for="linkedin">LinkedIn Link</label>
                                <div class="input-group">
                                    <span class="input-group-text mt-12"
                                        style="background-color: white; border-right: none;">
                                        <img src="<?= Yii::$app->homeUrl ?>image/in-image.svg" alt="LinkedIn"
                                            style="width: 20px; height: 20px;">
                                    </span>
                                    <input type="text" style="border-left: none;" class="form-control mt-12"
                                        name="linkedin" value="<?= $group['socialLinkin'] ?>"
                                        placeholder="Copy & Paste the Group LinkedIn Link here" required>
                                </div>
                            </div>

                            <div class="form-group mb-30">
                                <span class="text-danger">* </span><label class="name-text-update" for="twitter">X
                                    (Twitter) Link</label>
                                <div class="input-group">
                                    <span class="input-group-text mt-12"
                                        style="background-color: white; border-right: none;">
                                        <img src="<?= Yii::$app->homeUrl ?>image/x-image.svg" alt="Twitter/X"
                                            style="width: 20px; height: 20px;">
                                    </span>
                                    <input type="text" style="border-left: none;" class="form-control mt-12"
                                        name="twitter" value="<?= $group['socialX'] ?>"
                                        placeholder="Copy & Paste the Group X (Twitter) Link here" required>
                                </div>
                            </div>

                            <div class="form-group mb-30">
                                <span class="text-danger">* </span><label class="name-text-update"
                                    for="facebook">Facebook Link</label>
                                <div class="input-group">
                                    <span class="input-group-text mt-12"
                                        style="background-color: white; border-right: none;">
                                        <img src="<?= Yii::$app->homeUrl ?>image/face-image.svg" alt="Facebook"
                                            style="width: 20px; height: 20px;">
                                    </span>
                                    <input type="text" style="border-left: none;" class="form-control mt-12"
                                        name="facebook" value="<?= $group['socialFacebook'] ?>"
                                        placeholder="Copy & Paste the Group Facebook Link here" required>
                                </div>
                            </div>

                            <div class="form-group mb-30">
                                <span class="text-danger">* </span><label class="name-text-update"
                                    for="instagram">Instagram Link</label>
                                <div class="input-group">
                                    <span class="input-group-text mt-12"
                                        style="background-color: white; border-right: none;">
                                        <img src="<?= Yii::$app->homeUrl ?>image/ig-image.svg" alt="Instagram"
                                            style="width: 20px; height: 20px;">
                                    </span>
                                    <input type="text" style="border-left: none;" class="form-control mt-12"
                                        name="instagram" value="<?= $group['socialInstargram'] ?>"
                                        placeholder="Copy & Paste the Group Instagram Link here" required>
                                </div>
                            </div>

                            <div class="form-group mb-30">
                                <span class="text-danger">* </span>
                                <label class="name-text-update" for="youtube">YouTube Link</label>
                                <div class="input-group">
                                    <span class="input-group-text mt-12"
                                        style="background-color: white; border-right: none;">
                                        <img src="<?= Yii::$app->homeUrl ?>image/yt-image.svg" alt="YouTube"
                                            style="width: 20px; height: 20px;">
                                    </span>
                                    <input type="text" style="border-left: none;" class="form-control mt-12"
                                        name="youtube" value="<?= $group['socialYoutube'] ?>"
                                        placeholder="Copy & Paste the Group YouTube Link here" required>
                                </div>
                            </div>

                            <div class="form-group mb-30">
                                <span class="text-danger">* </span> <label class="name-text-update"
                                    for="director">Website Link </label>
                                <div class="input-group">
                                    <span class="input-group-text mt-12"
                                        style="background-color: white; border-right: none;">
                                        <img src="<?= Yii::$app->homeUrl ?>image/web-image.svg" alt="YouTube"
                                            style="width: 20px; height: 20px;">
                                    </span>
                                    <input type="text" style="border-left: none;" class="form-control mt-12"
                                        name="youtube" value="<?= $group['website'] ?>"
                                        placeholder="Copy & Paste the Group YouTube Link here" required>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
            <div class="col-lg-6 col-md-6 col-12" style="padding-right: 40px;">
                <div class="row">
                    <div class="name-text-update">
                        <span class="profile-moon">*</span>
                        Group Description
                    </div>
                    <input type="hidden" name="groupId" value="<?= $group['groupId'] + 543 ?>">
                    <div>
                        <div class="alert alert-secondary" role="alert"
                            style="font-size: 14px; background-color: transparent; border: 0; ">
                            <textarea style="height: 527px;" name="about"
                                class="form-control"><?= $group['about'] ?></textarea>

                        </div>
                        <div class="col-12 text-end mt-10 pr-13">
                            <button class="btn-cancel-group">Cancel</button>
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
<?php ActiveForm::end(); ?>