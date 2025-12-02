<?php

use common\models\ModelMaster;
use yii\widgets\ActiveForm;

$this->title = 'Update Company';
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
<div class="col-12 mt-60 pt-10 bg-white">
    <div class="col-12 banner-uploade" id="imagePreviewBanner">
        <?php
        if (isset($company["banner"]) && !empty($company["banner"])) { ?>
            <img src="<?= Yii::$app->homeUrl . $company['banner'] ?>" class="sad-1" id="old-banner">
        <?php
        } else { ?>
            <img src="<?= Yii::$app->homeUrl ?>imagecompany.jpg" class="create-group-banner">
        <?php
        }
        ?>
    </div>


    <div class="d-flex justify-content-start" style="margin-top: -100px;">
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
                            background-image:url(<?= $company["picture"] != null ? Yii::$app->homeUrl . $company['picture'] : "" ?>);
                        '>
                <label  for="imageUpload" class="upload-label" style="cursor: pointer;">
                    <img id="icon-image" src="<?= Yii::$app->homeUrl . 'image/upload-iconimg.svg' ?>" style="width: 37px; height: 37px;  display: none;" alt="Upload Icon">
                    <span id="d-up-img1" class="mt-10" style=" display: none;"> <?= Yii::t('app', 'Upload') ?> 
                        <span style="font-size: 13px; color: #666;"> <?= Yii::t('app', 'or Drop') ?> </span>
                    </span>     
                    <br>
                    <span id="d-up-img2" style="font-size: 13px; color: #666;  display: none;">
                         <?= Yii::t('app', 'Company Picture here') ?>
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
        <div class="flex-grow-1 pr-10" style="display: flex;justify-content: end;align-items: center;">
            <!-- ลบระยะห่างระหว่างรูปและรายละเอียด -->
            <span class="fileUpload btn" style="padding: 0;">
                <div id="upload" class="create-employee-btn">
                    <img src="<?= Yii::$app->homeUrl ?>image/upload-white.svg" class="mr-3" alt="Upload Icon">
                    <?= Yii::t('app', 'Upload') ?>
                </div>
                <input type="file" name="imageUploadBanner" id="imageUploadBanner"
                    class="upload up upload-checklist" id="up" />
            </span>
        </div>
    </div>
    <div class="col-12 mt-28">
        <div class="row update-group-body" style="--bs-gutter-x:0px;">
            <div class="col-lg-4 col-md-6 col-12 pr-15">
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
                    <label class="name-text-update"
                        for="founded"><?= Yii::t('app', 'Founded') ?></label>

                    <div class="input-group">
                        <span class="input-group-text founded-icon mt-12"
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
                    <label class="name-text-update" for="industry">
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
            <div class="col-lg-4 col-md-6 col-12 pl-15 pr-15">

                <div class="form-group mb-30">
                    <label class="name-text-update" for="phone">
                        <?= Yii::t('app', 'Contact/Phone Number') ?>
                    </label>
                    <input type="text" class="form-control mt-12" name="phone"
                        value="<?= $company['contact'] ?>"
                        placeholder="<?= Yii::t('app', 'Write the phonenumber') ?>" required
                        pattern="[0-9+\-]+" title="Only number, + and -"
                        oninput="this.value = this.value.replace(/[^0-9+\-]/g, '');">
                </div>
                <div class="form-group mb-30">
                    <label class="name-text-update" for="email">
                        <?= Yii::t('app', 'Company’s General Email') ?>
                    </label>
                    <input type="email" class="form-control mt-12" name="email"
                        value="<?= $company['email'] ?>"
                        placeholder="<?= Yii::t('app', 'e.g., jp_paris_cs@tokyoconsultinggroup.com') ?>"
                        required>
                </div>
                <div class="form-group mb-30">
                    <label class="name-text-update">
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
            <div class="col-lg-4 col-md-6 col-12 pl-15">
                <div class="form-group mb-20">
                    <input type="hidden" name="groupId">
                    <label class="name-text-update" for="groupDescription"><?= Yii::t('app', 'Company Description') ?></label>
                    <textarea style="height: 527px;" name="about"
                        placeholder="Write the description of the Company" class="form-control mt-12"><?= Yii::t('app', $company['about']) ?></textarea>
                </div>
                <div class="d-flex justify-content-end align-items-end gap-2" style="height: 85px;">
                    <a href="<?= Yii::$app->request->referrer ?: Yii::$app->homeUrl . 'setting/company/company-grid' ?>"
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

<input type="hidden" name="companyId" value="<?= $company['companyId'] + 543 ?>">

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
        /* เอาเส้นสีน้ำเงิน default ออก */
        border: 1px solid #a8a9aaff;
        /* เปลี่ยนเป็นสีหลักของเว็บ */
        box-shadow: 0 0 5px rgba(241, 245, 251, 0.5);

        /* เงาเล็ก ๆ รอบ input */
        /* transition: all 0.2s ease-in-out; */
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