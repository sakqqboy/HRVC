<?php


use yii\widgets\ActiveForm;

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

<!-- 1. Flatpickr CSS + JS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<!-- 2. HTML Input -->

<link rel="stylesheet" href="<?= Yii::$app->homeUrl ?>assets/bootstrap4/css/bootstrap.min.css">
<div class="col-12 mt-60 pt-10 bg-white">
    <div class="d-flex banner-uploade" id="imagePreviewBanner" style=" filter: brightness(100%); transition: filter 0.3s; position: relative;  background-image:url(<?= !empty($group["banner"]) ? Yii::$app->homeUrl . $group['banner'] : "" ?>);">
        <img src="<?= Yii::$app->homeUrl ?>images/group/banner/group-banner.svg"
            class="create-group-banner"
            id="icon-banner" style="display:none;">
        <img src="" class="create-group-banner" id="old-banner" style="display:none;">
    </div>
    <!-- ปุ่มข้างล่าง แต่ดันขึ้นไปทับ -->
    <div class="center-center" id="banner-action-buttons"
        style="  position: absolute; left: 50%; transform: translateX(-50%); bottom: 1010px;  gap: 10px; "  >
        <!-- ปุ่มถังขยะ -->
        <div class="ellipse-box-icon"
            id="bin-banner"
            style="background-color:#fff0f0; opacity: 1; display:none;">
            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/binred.svg"
                style="width:14px; height:14px;">
            <span style="color:#BB2020;"><?= Yii::t('app', 'Remove') ?></span>
        </div>

        <!-- ปุ่มรีเฟรช -->
        <div class="ellipse-box-icon"
            id="refes-banner"
            style="background-color:#e6f1ff; opacity:1; display:none;">
            <img src="<?= Yii::$app->homeUrl ?>image/refes-blue.svg"
                style="width:14px; height:14px;">
            <span style="color:#2580D3;"><?= Yii::t('app', 'Change') ?></span>
        </div>
        <input type="file" id="imageUploadBanner" style="display:none;">
    </div>

    <div class="d-flex justify-content-start" style="width: 50px; margin-top: -100px;">
        <div class="ml-35 avatar-upload">
            <div class="avatar-preview" id="imagePreview" style='
                            background-color: white;
                            fill: #FFF;
                            stroke-width: 1px;
                            stroke: var(--Primary-Blue---HRVC, #2580D3);
                            border-radius: 100%;
                            text-align: center;
                            cursor: pointer;
                            padding:0px;
                            background-image:url(<?= !empty($group["picture"]) ? Yii::$app->homeUrl . $group['picture'] : "" ?>);
                        '>
                <label for="imageUpload" class="upload-label" id="imageUploadIcon" style="width:100%;">
                    <img id="icon-image" src="<?= Yii::$app->homeUrl . 'image/upload-iconimg.svg' ?>" style="width: 37px; height: 37px;  display: none;" alt="Upload Icon">
                    <span id="d-up-img1" class="mt-10" style="display: none;"> <?= Yii::t('app', 'Upload') ?> 
                    <span style="font-size: 13px; color: #666; "> <?= Yii::t('app', 'or Drop') ?> </span>
                    </span>
                    <br>
                    <span id="d-up-img2" style="font-size: 13px; color: #666;  display: none;">
                         <?= Yii::t('app', 'Group Picture here') ?>
                    </span>
                </label>
            </div>
            <div class="center-center" id="cer-action-buttons" style="
                                        position: absolute;
                                        bottom: 20px;
                                        left: 50%;
                                        transform: translateX(-50%);
                                        gap: 20px;
                                    ">
                                    <!-- ปุ่มลบ -->
                                    <div class="cycle-box-icon-little" style=" background-color: #fff0f0; display: none;  opacity: 1"
                                        id="bin-img">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/binred.svg"
                                            alt="Delete"
                                            style="width: 14px; height: 14px;">
                                    </div>

                                    <!-- ปุ่มรีเฟรช -->
                                    <div class="cycle-box-icon-little" style=" background-color: #e6f1ff; display: none;  opacity: 1"
                                        id="refes-img">
                                        <img src="<?= Yii::$app->homeUrl ?>image/refes-blue.svg" alt="Refresh"
                                            style="width: 14px; height: 14px;">
                                    </div>
            </div>
            <input type="file" name="image" id="imageUpload" class="upload up upload-checklist"
                    style="display: none;" />
        </div>
        <!-- <div class="flex-grow-1 pr-10" style="display: flex;justify-content: end;align-items: center;">
            <span class="fileUpload btn" style="padding: 0;">
                <div id="upload" class="create-employee-btn">
                    <img src="<?= Yii::$app->homeUrl ?>image/upload-white.svg" class="mr-3" alt="Upload Icon">
                    <?= Yii::t('app', 'Upload') ?>
                </div>
                <input type="file" name="imageUploadBanner" id="imageUploadBanner"
                    class="upload up upload-checklist" id="up" />
            </span>
        </div> -->
    </div>
    <div class="col-12 mt-28">
        <div class="row update-group-body" style="--bs-gutter-x:0px;">
            <div class="col-lg-4 col-md-6 col-12 pr-15">
                <div class="form-group mb-30">
                    <span class="text-danger">* </span><label class="name-text-update"
                        for="groupName"><?= Yii::t('app', 'Registered Group Name') ?></label>
                    <input type="text" class="form-control mt-12" name="groupName"
                        value="<?= $group['groupName'] ?>"
                        placeholder="<?= Yii::t('app', 'Write the name of Group') ?>" required>
                </div>
                <div class="form-group mb-30">
                    <span class="text-danger">* </span> <label class="name-text-update"
                        for="groupName"><?= Yii::t('app', 'Display Name/Brand Name') ?></label>
                    <input type="text" class="form-control mt-12" name="displayName"
                        value="<?= $group['displayName'] ?>"
                        placeholder="<?= Yii::t('app', 'The name you want to show (example,. Google)') ?>"
                        required>
                </div>
                <div class="form-group mb-30">
                    <label class="name-text-update"
                        for="tagLine"><?= Yii::t('app', 'Slogan/Tagline') ?></label>
                    <input type="text" class="form-control mt-12" name="tagLine"
                        value="<?= $group['tagLine'] ?>"
                        placeholder="<?= Yii::t('app', 'Write the Tagline of the group') ?>">
                </div>
                <div class="form-group mb-30">
                    <label class="name-text-update"
                        for="founded"><?= Yii::t('app', 'Founded') ?></label>
                    <div class="input-group">
                        <span class="input-group-text founded-icon mt-12"
                            style="background-color: #BEDAFF; border-right: none;">
                            <img src="<?= Yii::$app->homeUrl ?>image/calendar-blue.svg" alt="Founded"
                                style="width: 20px; height: 20px;">
                        </span>
                        <input type="text" id="founded" name="founded" class="form-control mt-12"
                            placeholder="Select date" value="<?= $group['founded'] ?>">
                    </div>

                </div>
                <div class="form-group mb-30">
                    <span class="text-danger">* </span><label class="name-text-update"
                        for="industry"><?= Yii::t('app', 'Industry') ?></label>
                    <input type="text" class="form-control mt-12" name="industries"
                        value="<?= $group['industries'] ?>"
                        placeholder="<?= Yii::t('app', 'Write the industry name') ?>" required>
                </div>
                <div class="form-group mb-30">
                    <label class="name-text-update"
                        for="director"><?= Yii::t('app', 'Head of Group') ?>
                    </label>
                    <input type="text" class="form-control mt-12" name="directorName" id="searchDirector"
                        value="<?= $group['directorName'] ?? '' ?>"
                        placeholder="<?= Yii::t('app', 'Write the name of director (firstname lastname)') ?>">
                    <input type="hidden" id="director" name="director" value="<?= $group['director'] ?? '' ?>">
                    <div class="director-list" id="director-list"></div>
                </div>
                <div class="form-group mb-30">
                    <label class="name-text-update"
                        for="addressLine"><?= Yii::t('app', 'Address Line') ?></label>
                    <input type="text" class="form-control mt-12" name="location"
                        value="<?= $group['location'] ?>"
                        placeholder="<?= Yii::t('app', 'Write the email') ?>">
                </div>
                <div class="form-group">
                    <label class="name-text-update"
                        for="email"><?= Yii::t('app', 'Group Email') ?>
                    </label>
                    <input type="email" class="form-control mt-12" name="email"
                        value="<?= $group['email'] ?>"
                        placeholder="<?= Yii::t('app', 'Write the email') ?>">
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-12 pl-15 pr-15">
                <div class="form-group mb-30">
                    <label class="name-text-update" for="phone">
                        <?= Yii::t('app', 'Contact/Phone Number') ?> </label>
                    <input type="text" class="form-control mt-12" name="phone"
                        value="<?= $group['contact'] ?>"
                        placeholder="<?= Yii::t('app', 'Write the phone number') ?>"
                        pattern="[0-9+\-]+" title="only number, + and -"
                        oninput="this.value = this.value.replace(/[^0-9+\-]/g, '');">
                </div>
                <div class="form-group mb-30">
                    <span class="text-danger">* </span> <label class="name-text-update" for="country">
                        <?= Yii::t('app', 'Countries in Operation') ?>
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
                            placeholder="<?= Yii::t('app', 'Write the phone number') ?>">
                            <option value="<?= $groupCountry['countryId'] ?>">
                                <?= $groupCountry['countryName'] ?></option>
                            <?php foreach ($countries as $countryId => $country) : ?>
                                <option value="<?= $countryId ?>"><?= $country ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group mb-30">
                    <label class="name-text-update"
                        for="director"><?= Yii::t('app', 'Website Link ') ?></label>
                    <div class="input-group">
                        <span class="input-group-text mt-12"
                            style="background-color: white; border-right: none;">
                            <img src="<?= Yii::$app->homeUrl ?>image/web-image.svg" alt="Website"
                                style="width: 20px; height: 20px;">
                        </span>
                        <input type="text" style="border-left: none;" class="form-control mt-12"
                            name="website" value="<?= $group['website'] ?>"
                            placeholder="<?= Yii::t('app', 'Copy & Paste the Group YouTube Link here') ?>">
                    </div>
                </div>
                <div class="form-group mb-30">
                    <label class="name-text-update"
                        for="linkedin"><?= Yii::t('app', 'LinkedIn Link') ?></label>
                    <div class="input-group">
                        <span class="input-group-text mt-12"
                            style="background-color: white; border-right: none;">
                            <img src="<?= Yii::$app->homeUrl ?>image/in-image.svg" alt="LinkedIn"
                                style="width: 20px; height: 20px;">
                        </span>
                        <input type="text" style="border-left: none;" class="form-control mt-12"
                            name="linkedin" value="<?= $group['socialLinkin'] ?>"
                            placeholder="<?= Yii::t('app', 'Copy & Paste the Group LinkedIn Link here') ?>">
                    </div>
                </div>

                <div class="form-group mb-30">
                    <label class="name-text-update" for="twitter">
                        <?= Yii::t('app', 'X (Twitter) Link') ?></label>
                    <div class="input-group">
                        <span class="input-group-text mt-12"
                            style="background-color: white; border-right: none;">
                            <img src="<?= Yii::$app->homeUrl ?>image/x-image.svg" alt="Twitter/X"
                                style="width: 20px; height: 20px;">
                        </span>
                        <input type="text" style="border-left: none;" class="form-control mt-12"
                            name="twitter" value="<?= $group['socialX'] ?>"
                            placeholder="<?= Yii::t('app', 'Copy & Paste the Group X (Twitter) Link here') ?>">
                    </div>
                </div>
                <div class="form-group mb-30">
                    <label class="name-text-update"
                        for="facebook"><?= Yii::t('app', 'Facebook Link') ?></label>
                    <div class="input-group">
                        <span class="input-group-text mt-12"
                            style="background-color: white; border-right: none;">
                            <img src="<?= Yii::$app->homeUrl ?>image/face-image.svg" alt="Facebook"
                                style="width: 20px; height: 20px;">
                        </span>
                        <input type="text" style="border-left: none;" class="form-control mt-12"
                            name="facebook" value="<?= $group['socialFacebook'] ?>"
                            placeholder="<?= Yii::t('app', 'Copy & Paste the Group Facebook Link here') ?>">
                    </div>
                </div>
                <div class="form-group mb-30">
                    <label class="name-text-update"
                        for="instagram"><?= Yii::t('app', 'Instagram Link') ?></label>
                    <div class="input-group">
                        <span class="input-group-text mt-12"
                            style="background-color: white; border-right: none;">
                            <img src="<?= Yii::$app->homeUrl ?>image/ig-image.svg" alt="Instagram"
                                style="width: 20px; height: 20px;">
                        </span>
                        <input type="text" style="border-left: none;" class="form-control mt-12"
                            name="instagram" value="<?= $group['socialInstargram'] ?>"
                            placeholder="<?= Yii::t('app', 'Copy & Paste the Group Instagram Link here') ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="name-text-update" for="youtube"><?= Yii::t('app', 'YouTube Link') ?></label>
                    <div class="input-group">
                        <span class="input-group-text mt-12"
                            style="background-color: white; border-right: none;">
                            <img src="<?= Yii::$app->homeUrl ?>image/yt-image.svg" alt="YouTube"
                                style="width: 20px; height: 20px;">
                        </span>
                        <input type="text" style="border-left: none;" class="form-control mt-12"
                            name="youtube" value="<?= $group['socialYoutube'] ?>"
                            placeholder="<?= Yii::t('app', 'Copy & Paste the Group YouTube Link here') ?>">
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-12 pl-15">
                <div class="form-group mb-30">
                    <input type="hidden" name="groupId">

                    <!-- <div class="alert alert-secondary" role="alert" style="font-size: 14px; background-color: transparent; border: 0; "> -->
                    <label class="name-text-update" for="groupDescription"><?= Yii::t('app', 'Group Description') ?></label>
                    <textarea style="height: 655px;" name="about" class="form-control mt-12" id="groupDescription"
                        placeholder="<?= Yii::t('app', 'Write the description of the group') ?>"><?= $group['about'] ?></textarea>
                </div>
                <!-- </div> -->
                <input type="hidden" name="groupId" value="<?= $group['groupId'] + 543 ?>">
                <div class="d-flex justify-content-end align-items-end gap-2" style="height: 85px;">
                    <a href="<?= Yii::$app->homeUrl ?>setting/group/display-group"
                        style="text-decoration: none;">
                        <button type="button" class="btn-cancel-group-new">Cancel</button>
                    </a>

                    <button type="submit" class="btn-save-group-new">
                        Save <img src="<?= Yii::$app->homeUrl ?>image/save-icon.svg" alt="LinkedIn" style="width: 13px; height: 14px;">
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>

<style>
    .submain-content {
        width: 100%;
        max-width: 100%;
        padding-left: 30px;
        padding-right: 30px;
        min-height: 100vh;
        /* flex: 1; */
        background-color: white;
    }

    .create-employee-btn {
        min-width: 78px;
        font-size: 12px;
        font-weight: 600;
    }

    .text-danger {
        font-size: 12px;
        font-weight: 700;
    }

    input::placeholder {
        font-size: 14px;
        font-weight: 400;
        color: #8A8A8A;
        ;
    }

    textarea::placeholder {
        font-size: 14px;
        font-weight: 400;
        color: #8A8A8A;
        ;
    }

    .form-select {
        color: #8A8A8A;
        font-size: 14px;
    }

    .form-select:valid {
        color: #212529;
    }

    .form-select option {
        color: #212529;
    }

    .form-control:focus,
    .form-select:focus {
        outline: none;
        border: 1px solid #a8a9aaff;
        box-shadow: 0 0 5px rgba(241, 245, 251, 0.5);
    }

    .input-group-text {

        padding: 6px 0px 6px 10px;
    }

    .form-control,
    .form-select {
        padding-left: 12px;
    }

    .founded-icon {
        padding-right: 10px;
    }
</style>