<?php

use yii\bootstrap5\ActiveForm;

$this->title = 'Create Group';
?>
<?php $form = ActiveForm::begin([
	'id' => 'create-group',
	'method' => 'post',
	'options' => [
		'enctype' => 'multipart/form-data',
	],
]); ?>
<!-- 1. Flatpickr CSS + JS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<!-- 2. HTML Input -->
<!-- <input type="text" id="founded" name="founded" class="form-control mt-12" placeholder="Select date" required> -->


<link rel="stylesheet" href="<?= Yii::$app->homeUrl ?>assets/bootstrap4/css/bootstrap.min.css">
<div class="company-group-edit">
    <div class="contrainer-body">
        <div class="col-12 banner-uploade" id="imagePreviewBanner">

        </div>

        <div class="row mb-100">
            <div class="col-12" style="margin-top:-50px; display: flex;">
                <div class="col-10 mb-15 avatar-upload" style="margin-left:36px;">
                    <div class="avatar-preview" id="imagePreview" style="
                            background-color: white;
                            fill: #FFF;
                            stroke-width: 1px;
                            stroke: var(--Primary-Blue---HRVC, #2580D3);
                            border-radius: 100%;
                            padding: 20px;
                            text-align: center;
                            cursor: pointer;
                        ">
                        <label for="imageUpload" class="upload-label" style="cursor: pointer;  display: block;">

                            <img src="<?= Yii::$app->homeUrl . 'image/upload-iconimg.svg' ?>"
                                style="width: 50px; height: auto;" alt="Upload Icon"> <br><br>
                            <span style=""><?= Yii::t('app', 'Upload') ?><span style="font-size: 13px; color: #666;">
                                    <?= Yii::t('app', 'or Drop') ?></span></span><br>
                            <span
                                style="font-size: 13px; color: #666;"><?= Yii::t('app', 'Branch Picture here') ?></span>

                        </label>
                        <input type="file" name="image" id="imageUpload" class="upload up upload-checklist"
                            style="display: none;" />
                    </div>
                </div>

                <!-- <div class="col-10 mb-15 avatar-upload" style="margin-left:36px;">
                    <div class="avatar-preview" id="imagePreview" style="
                            background-color: white;
                            fill: #FFF;
                            stroke-width: 1px;
                            stroke: var(--Primary-Blue---HRVC, #2580D3);
                            border-radius: 100%;
                            padding: 20px;
                            text-align: center;
                            cursor: pointer;
                        ">
                        <label for="imageUpload" class="upload-label" style="cursor: pointer; display: block;">
                            <img src="<?= Yii::$app->homeUrl . 'image/upload-iconimg.svg' ?>"
                                style="width: 50px; height: auto;" alt="Upload Icon"> <br><br>
                            <span style=""><?= Yii::t('app', 'Upload') ?><span style="font-size: 13px; color: #666;"> or
                                    Drop </span></span><br>
                            <span style="font-size: 13px; color: #666;">Branch Picture here</span>

                        </label>
                        <input type=" file" name="image" id="imageUpload" class="upload up upload-checklist"
                            style="display: none;" />
                    </div>
                </div> -->


                <div class="col-2 mb-15" style="display: flex; justify-content: center;  align-items: center; ">
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
                                    <span class="text-danger">* </span><label class="name-text-update"
                                        for="groupName"><?= Yii::t('app', 'Registered Group Name') ?></label>
                                    <input type="text" class="form-control mt-12" name="groupName"
                                        placeholder="<?= Yii::t('app', 'Write the name of Group') ?>" required>
                                </div>
                                <div class="form-group mb-30">
                                    <span class="text-danger">* </span> <label class="name-text-update"
                                        for="groupName"><?= Yii::t('app', 'Display Name/Brand Name') ?></label>
                                    <input type="text" class="form-control mt-12" name="displayName"
                                        placeholder="<?= Yii::t('app', 'The name you want to show (example,. Google)') ?>"
                                        required>
                                </div>
                                <div class="form-group mb-30">
                                    <span class="text-danger">* </span><label class="name-text-update"
                                        for="tagLine"><?= Yii::t('app', 'Slogan/Tagline') ?></label>
                                    <input type="text" class="form-control mt-12" name="tagLine"
                                        placeholder="<?= Yii::t('app', 'Write the Tagline of the group') ?>" required>
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
                                            class="form-control mt-12 text-center" placeholder="Select date" required
                                            style="text-align: center;">
                                    </div>

                                </div>
                                <div class="form-group mb-30">
                                    <span class="text-danger">* </span><label class="name-text-update"
                                        for="industry"><?= Yii::t('app', 'Industry') ?></label>
                                    <input type="text" class="form-control mt-12" name="industries"
                                        placeholder="<?= Yii::t('app', 'Write the industry name') ?>" required>
                                </div>
                                <div class="form-group mb-30">
                                    <span class="text-danger">* </span> <label class="name-text-update"
                                        for="director"><?= Yii::t('app', 'Group Director') ?>
                                    </label>
                                    <input type="text" class="form-control mt-12" name="director"
                                        placeholder="<?= Yii::t('app', 'Write the name of Group') ?>" required>
                                </div>
                                <div class="form-group mb-30">
                                    <span class="text-danger">* </span> <label class="name-text-update"
                                        for="addressLine"><?= Yii::t('app', 'Address Line') ?></label>
                                    <input type="text" class="form-control mt-12" name="location"
                                        placeholder="<?= Yii::t('app', 'Write the email') ?>" required>
                                </div>
                                <div class="form-group mb-30">
                                    <span class="text-danger">* </span> <label class="name-text-update"
                                        for="director"><?= Yii::t('app', 'Country in Operation') ?></label>
                                    <div class="input-group">
                                        <span class="input-group-text mt-12"
                                            style="background-color: white; border-right: none;">
                                            <img src="<?= Yii::$app->homeUrl ?>image/web-image.svg" alt="Website"
                                                style="width: 20px; height: 20px;">
                                        </span>
                                        <select class="form-control mt-12" style="border-left: none;" name="country"
                                            required>
                                            <option value="" disabled selected hidden style="color: var(--Helper-Text, #8A8A8A);
                                                ">
                                                <?= Yii::t('app', 'e.g., ASEAN, North America, Europe') ?>
                                            </option>
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
                                    <span class="text-danger">* </span> <label class="name-text-update"
                                        for="email"><?= Yii::t('app', 'Group Email') ?>
                                    </label>
                                    <input type="email" class="form-control mt-12" name="email"
                                        placeholder="<?= Yii::t('app', 'Write the email') ?>" required>
                                </div>
                                <div class="form-group mb-30">
                                    <span class="text-danger">* </span> <label class="name-text-update" for="phone">
                                        <?= Yii::t('app', 'Contact/Phone Number') ?> </label>
                                    <input type="text" class="form-control mt-12" name="phone"
                                        placeholder="<?= Yii::t('app', 'Write the phone number') ?>" required
                                        pattern="[0-9+\-]+" title="กรุณากรอกเฉพาะตัวเลข, + และ -"
                                        oninput="this.value = this.value.replace(/[^0-9+\-]/g, '');">
                                </div>

                                <div class="form-group mb-30">
                                    <span class="text-danger">* </span><label class="name-text-update"
                                        for="linkedin"><?= Yii::t('app', 'LinkedIn Link') ?></label>
                                    <div class="input-group">
                                        <span class="input-group-text mt-12"
                                            style="background-color: white; border-right: none;">
                                            <img src="<?= Yii::$app->homeUrl ?>image/in-image.svg" alt="LinkedIn"
                                                style="width: 20px; height: 20px;">
                                        </span>
                                        <input type="text" style="border-left: none;" class="form-control mt-12"
                                            name="linkedin"
                                            placeholder="<?= Yii::t('app', 'Copy & Paste the Group LinkedIn Link here') ?>"
                                            required>
                                    </div>
                                </div>

                                <div class="form-group mb-30">
                                    <span class="text-danger">* </span><label class="name-text-update" for="twitter">
                                        <?= Yii::t('app', 'X (Twitter) Link') ?></label>
                                    <div class="input-group">
                                        <span class="input-group-text mt-12"
                                            style="background-color: white; border-right: none;">
                                            <img src="<?= Yii::$app->homeUrl ?>image/x-image.svg" alt="Twitter/X"
                                                style="width: 20px; height: 20px;">
                                        </span>
                                        <input type="text" style="border-left: none;" class="form-control mt-12"
                                            name="twitter"
                                            placeholder="<?= Yii::t('app', 'Copy & Paste the Group X (Twitter) Link here') ?>"
                                            required>
                                    </div>
                                </div>

                                <div class="form-group mb-30">
                                    <span class="text-danger">* </span><label class="name-text-update"
                                        for="facebook"><?= Yii::t('app', 'Facebook Link') ?></label>
                                    <div class="input-group">
                                        <span class="input-group-text mt-12"
                                            style="background-color: white; border-right: none;">
                                            <img src="<?= Yii::$app->homeUrl ?>image/face-image.svg" alt="Facebook"
                                                style="width: 20px; height: 20px;">
                                        </span>
                                        <input type="text" style="border-left: none;" class="form-control mt-12"
                                            name="facebook"
                                            placeholder="<?= Yii::t('app', 'Copy & Paste the Group Facebook Link here') ?>"
                                            required>
                                    </div>
                                </div>

                                <div class="form-group mb-30">
                                    <span class="text-danger">* </span><label class="name-text-update"
                                        for="instagram"><?= Yii::t('app', 'Instagram Link') ?></label>
                                    <div class="input-group">
                                        <span class="input-group-text mt-12"
                                            style="background-color: white; border-right: none;">
                                            <img src="<?= Yii::$app->homeUrl ?>image/ig-image.svg" alt="Instagram"
                                                style="width: 20px; height: 20px;">
                                        </span>
                                        <input type="text" style="border-left: none;" class="form-control mt-12"
                                            name="instagram"
                                            placeholder="<?= Yii::t('app', 'Copy & Paste the Group Instagram Link here') ?>"
                                            required>
                                    </div>
                                </div>

                                <div class="form-group mb-30">
                                    <span class="text-danger">* </span>
                                    <label class="name-text-update" for="youtube"><?= Yii::t('app', 'YouTube Link') ?>
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text mt-12"
                                            style="background-color: white; border-right: none;">
                                            <img src="<?= Yii::$app->homeUrl ?>image/yt-image.svg" alt="YouTube"
                                                style="width: 20px; height: 20px;">
                                        </span>
                                        <input type="text" style="border-left: none;" class="form-control mt-12"
                                            name="youtube"
                                            placeholder="<?= Yii::t('app', 'Copy & Paste the Group YouTube Link here') ?>"
                                            required>
                                    </div>
                                </div>

                                <div class="form-group mb-30">
                                    <span class="text-danger">* </span> <label class="name-text-update"
                                        for="director"><?= Yii::t('app', 'Website Link ') ?></label>
                                    <div class="input-group">
                                        <span class="input-group-text mt-12"
                                            style="background-color: white; border-right: none;">
                                            <img src="<?= Yii::$app->homeUrl ?>image/web-image.svg" alt="Website"
                                                style="width: 20px; height: 20px;">
                                        </span>
                                        <input type="text" style="border-left: none;" class="form-control mt-12"
                                            name="website"
                                            placeholder="<?= Yii::t('app', 'Copy & Paste the Group YouTube Link here') ?>"
                                            required>
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
                        <input type="hidden" name="groupId">
                        <div>
                            <div class="alert alert-secondary" role="alert"
                                style="font-size: 14px; background-color: transparent; border: 0; ">
                                <textarea style="height: 527px;" name="about" class="form-control"
                                    placeholder="<?= Yii::t('app', 'Write the description of the group') ?>"></textarea>

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

<script>
// function getOrdinalSuffix(day) {
//     if (day > 3 && day < 21) return 'th';
//     switch (day % 10) {
//         case 1:
//             return 'st';
//         case 2:
//             return 'nd';
//         case 3:
//             return 'rd';
//         default:
//             return 'th';
//     }
// }

// flatpickr("#founded", {
//     dateFormat: "Y-m-d", // format ที่ส่งไป server
//     altInput: true,
//     altFormat: "F Y", // ชั่วคราว จะเปลี่ยนทีหลัง
//     onChange: function(selectedDates, dateStr, instance) {
//         if (selectedDates.length > 0) {
//             const d = selectedDates[0];
//             const day = d.getDate();
//             const month = d.toLocaleString('default', {
//                 month: 'long'
//             });
//             const year = d.getFullYear();
//             const suffix = getOrdinalSuffix(day);

//             const formatted = `${suffix} ${month} ${year}`;
//             instance.altInput.value = formatted;
//         }
//     }
// });
</script>