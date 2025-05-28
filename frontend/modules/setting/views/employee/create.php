<?php

use yii\bootstrap5\ActiveForm;
$statusform = 'create';
$this->title = 'Create Employee';
?>
<?php $form = ActiveForm::begin([
	'id' => 'create-employee',
	'method' => 'post',
	'options' => [
		'enctype' => 'multipart/form-data',
	],
	'action' => Yii::$app->homeUrl . 'setting/employee/save-create-employee'

]); ?>
<!-- Flatpickr CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<!-- Flatpickr JS -->
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<div class="company-group-body mt-50">
    <div class=" company-group-edit bg-white">
        <div class=" d-flex align-items-center gap-2">
            <a href="<?= Yii::$app->homeUrl ?>setting/team/index/"
                style="text-decoration: none; width:66px; height:26px;" class="btn-create-branch">
                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/back-white.svg"
                    style="width:18px; height:18px; margin-top:-3px;">
                Back
            </a>
            <div class="pim-name-title ml-10">
                Create Employee
            </div>
        </div>
        <div class="row update-group-body mt-20" style="gap: 60px;">
            <!-- Account Details -->
            <input type="hidden" id="systemAdmin" name="conten1" value="Account Details">
            <div>
                <!-- head -->
                <div class="between-center">
                    <div>
                        <span class="font-size-16 font-weight-600">
                            Account Details
                        </span>
                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/help.svg" data-toggle="tooltip"
                            data-placement="top" aria-label="Account Details" data-bs-original-title="Account Details">
                    </div>
                    <div class="d-flex align-items-center" style="gap: 10px;">
                        <span class="font-size-16 font-weight-600">
                            <span class="text-danger">* </span>
                            Employment Status
                        </span>
                        <select class="select-employee-status" aria-label="Default select example" name="status"
                            id="pim-status" onchange="javascript:changeStatusEmploywee()" required>
                            <option value="" disabled selected hidden style="color: var(--Helper-Text, #8A8A8A); ">
                                <?= Yii::t('app', 'Select') ?>
                            </option>
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

                </div>

                <div class="between-center mt-12">
                    <!-- body -->
                    <div>
                        <div class="avatar-upload" style="margin:0px">
                            <div class="avatar-preview" id="imagePreview" style="
                            background-color: white;
                            stroke-width: 1px;
                            stroke: var(--Primary-Blue---HRVC, #2580D3);
                            border-radius: 100%;
                            text-align: center;
                            cursor: pointer;
                        ">
                                <label for="imageUpload" class="upload-label" style="cursor: pointer;  display: block;">
                                    <img src="<?= Yii::$app->homeUrl ?>image/upload-iconimg.svg"
                                        style="width: 50px; height: auto;" alt="Upload Icon"> <br><br>
                                    <span>
                                        Upload <span style="font-size: 13px; color: #666;">
                                            or Drop </span>
                                    </span>
                                    <br>
                                    <span style="font-size: 13px; color: #666;">Branch Picture here</span>

                                </label>
                                <input type="file" name="image" id="imageUpload" class="upload up upload-checklist"
                                    style="display: none;">
                            </div>
                        </div>
                        <div style="text-align: center;">
                            <span class="font-size-14 font-weight-400 text-gray">
                                Acceptable file <br>
                                types: JPEG & PNG
                            </span>
                        </div>
                    </div>


                    <div class="vertical-line" style="height: 379px;"></div>

                    <div class="start-center" style="width: 822px; gap: 34px;">
                        <div class="flex-center" style="gap: 37px;">
                            <div>
                                <text class="font-size-16 font-weight-500"><span class="text-danger">* </span>
                                    System Login ID
                                </text>
                                <div class="input-group">
                                    <span class="input-group-text" style="background-color: white; border-right: none;">
                                        <img src="<?= Yii::$app->homeUrl ?>image/e-mail.svg" alt="Website"
                                            style="width: 20px; height: 20px;">
                                    </span>
                                    <input type="text" class="form-control font-size-14" id="mailId" name="mailId"
                                        placeholder="kaori@gmail.com" value=""
                                        style="width: 290.59px; border-left: none;">
                                </div>
                            </div>
                            <div>
                                <text class="font-size-16 font-weight-500"><span class="text-danger">* </span>
                                    Employee ID
                                </text>
                                <input type="text" class="form-control font-size-14" id="employeeId"" name=" employeeId"
                                    placeholder="Please assign the employee ID  " value="" style="width:  330.59px;">
                            </div>
                        </div>
                        <div class="flex-center" style="gap: 37px;">
                            <div>
                                <text class="font-size-16 font-weight-500"><span class="text-danger">* </span>
                                    Password
                                </text>

                                <div class="input-group">
                                    <span class="input-group-text" style="background-color: white; border-right: none;">
                                        <img src="<?= Yii::$app->homeUrl ?>image/e-lock.svg" alt="Website"
                                            style="width: 20px; height: 20px;">
                                    </span>
                                    <input type="password" class="form-control font-size-14" name="password"
                                        id="password" placeholder="Register Password here" value=""
                                        style="width: 245px; border-left: none; border-right: none;">
                                    <span class="input-group-text" onclick="togglePassword()"
                                        style="background-color: white; cursor: pointer; border-left: none;">
                                        <img src="<?= Yii::$app->homeUrl ?>image/e-pass.svg" id="toggleIcon"
                                            style="width: 20px; height: 20px; ">
                                    </span>
                                </div>

                            </div>
                            <div>
                                <text class="font-size-16 font-weight-500"><span class="text-danger">* </span>
                                    System Language Preference
                                </text>

                                <div class="input-group">
                                    <span class="input-group-text" style="background-color: white; border-right: none;">
                                        <img src="<?= Yii::$app->homeUrl ?>image/e-world.svg" alt="Website"
                                            style="width: 20px; height: 20px;">
                                    </span>

                                    <select class="form-select" style="width: 290.59px; border-left: none;"
                                        id="defaulLanguage" name="defaulLanguage" required="">
                                        <option value="" disabled selected hidden
                                            style="color: var(--Helper-Text, #8A8A8A); ">
                                            <?= Yii::t('app', 'Select preferred language') ?>
                                        </option>
                                        <?php
                                        foreach ($languages as $lang) {
                                            echo '<option value="' . htmlspecialchars($lang['languageId']) . '">' . htmlspecialchars($lang['languageName']) . '</option>';
                                        }
                                        ?>
                                    </select>

                                </div>
                            </div>
                        </div>

                        <div class="w-100">
                            <div class="w-100">
                                <text class="font-size-16 font-weight-500"><span class="text-danger">* </span>
                                    System Wide Permission Level </text>
                                <hr class="hr-group">
                            </div>

                            <div class="radio-wrapper">
                                <div class="radio-item">
                                    <input type="radio" id="staff" name="role" value="1" required>
                                    <span class="radio-cycle"></span>
                                    <label for="staff">Staff</label>
                                </div>
                                <div class="radio-item">
                                    <input type="radio" id="teamLeader" name="role" value="2">
                                    <span class="radio-cycle"></span>
                                    <label for="teamLeader">Team Leader</label>
                                </div>
                                <div class="radio-item">
                                    <input type="radio" id="hr" name="role" value="3">
                                    <span class="radio-cycle"></span>
                                    <label for="hr">HR</label>
                                </div>
                                <div class="radio-item">
                                    <input type="radio" id="manager" name="role" value="4">
                                    <span class="radio-cycle"></span>
                                    <label for="manager">Manager</label>
                                </div>
                                <div class="radio-item">
                                    <input type="radio" id="generalManager" name="role" value="5">
                                    <span class="radio-cycle"></span>
                                    <label for="generalManager">General Manager</label>
                                </div>
                                <div class="radio-item">
                                    <input type="radio" id="admin" name="role" value="6">
                                    <span class="radio-cycle"></span>
                                    <label for="admin">Admin</label>
                                </div>
                                <div class="radio-item">
                                    <input type="radio" id="systemAdmin" name="role" value="7">
                                    <span class="radio-cycle"></span>
                                    <label for="systemAdmin">System Admin</label>
                                </div>
                            </div>
                        </div>
                        <div class="w-100">
                            <div class="w-100">
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/help.svg" data-toggle="tooltip"
                                    data-placement="top" aria-label="Module Access"
                                    data-bs-original-title="Module Access">
                                <text class="font-size-16 font-weight-500"><span class="text-danger">* </span>
                                    Module Access
                                </text>
                                <hr class="hr-group">
                            </div>
                            <div class="checkbox-wrapper">
                                <?php foreach ($modules as $modul) { ?>
                                <div class="checkbox-item">
                                    <input type="checkbox" id="module_<?= $modul['moduleId'] ?>" name="moduleId[]"
                                        value="<?= $modul['moduleId'] ?>" class="module-check">
                                    <span class="checkbox-cycle"></span>
                                    <label for="module_<?= $modul['moduleId'] ?>"><?= $modul['moduleName'] ?></label>
                                </div>
                                <?php } ?>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
            <input type="hidden" id="systemAdmin" name="conten2" value="Contact & Personal Details">
            <!-- Contact & Personal Details -->
            <div>
                <div>
                    <!-- head -->
                    <span class="font-size-16 font-weight-600">
                        Contact & Personal Details
                    </span>
                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/help.svg" data-toggle="tooltip"
                        data-placement="top" aria-label=" Contact & Personal Details"
                        data-bs-original-title=" Contact & Personal Details">
                    <hr class="hr-group">
                </div>
                <div class="d-flex flex-column" style="gap: 40px">
                    <!-- body -->
                    <div class="row">
                        <div class="col-4 d-flex flex-column" style="gap: 12px;">
                            <text class="font-size-16 font-weight-500"><span class="text-danger">*
                                </span>Salutation</text>
                            <select class="form-select" name="salutation" id="salutation" style="border-left: none;"
                                required>
                                <option value="" disabled selected hidden style="color: var(--Helper-Text, #8A8A8A);">
                                    <?= Yii::t('app', 'Select') ?>
                                </option>
                                <option value="Mr.">Mr.</option>
                                <option value="Mrs.">Mrs.</option>
                                <option value="Miss">Miss</option>
                                <option value="Ms.">Ms.</option>
                                <option value="Dr.">Dr.</option>
                                <option value="Prof.">Prof.</option>
                            </select>
                        </div>
                        <div class="col-4 d-flex flex-column" style="gap: 12px;">
                            <text class="font-size-16 font-weight-500"><span class="text-danger">* </span>ddd</text>
                            <select class="form-select" name="gender" id="gender" style="border-left: none;" required>
                                <option value="" disabled selected hidden style="color: var(--Helper-Text, #8A8A8A); ">
                                    <?= Yii::t('app', 'Select') ?>
                                </option>
                                <option value="1">Male</option>
                                <option value="2">Female</option>
                            </select>
                        </div>
                        <div class="col-4 d-flex flex-column" style="gap: 12px;">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-4 d-flex flex-column" style="gap: 12px;">
                            <text class="font-size-16 font-weight-500"><span class="text-danger">* </span>First
                                Name</text>
                            <input type="text" name="employeeFirstname" id="employeeFirstname" class="form-control"
                                placeholder="Please Write the First Name" required>
                        </div>
                        <div class="col-4 d-flex flex-column" style="gap: 12px;">
                            <text class="font-size-16 font-weight-500"><span class="text-danger">* </span>Last
                                Name</text>
                            <input type="text" name="employeeSurename" id="employeeSurename" class="form-control"
                                placeholder="Please Write the Last Name" required>
                        </div>
                        <div class="col-4 d-flex flex-column" style="gap: 12px;">
                            <text class="font-size-16 font-weight-500"><span class="text-danger">*
                                </span>Nationality</text>
                            <div class="input-group">
                                <span class="input-group-text" style="background-color: white; border-right: none;">
                                    <img src="<?= Yii::$app->homeUrl ?>image/e-world.svg" alt="Website"
                                        style="width: 20px; height: 20px;">
                                </span>
                                <select class="form-select" name="nationalityId" id="nationalityId"
                                    style="border-left: none;" required>
                                    <option value="" disabled selected hidden
                                        style="color: var(--Helper-Text, #8A8A8A);">
                                        <?= Yii::t('app', 'Select Nationality') ?>
                                    </option>
                                    <?php
                                    if (isset($nationalities) && count($nationalities) > 0) {
                                        foreach ($nationalities as $nation) : ?>
                                    <option value="<?= $nation['numCode'] ?>"><?= $nation['nationalityName'] ?></option>
                                    <?php
                                        endforeach;
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4 d-flex flex-column" style="gap: 12px;">
                            <text class="font-size-16 font-weight-500"><span class="text-danger">* </span>Contact
                                Number</text>
                            <input type="text" name="telephoneNumber" id="telephoneNumber" class="form-control"
                                placeholder="e.g., +66 081 091 87" required>
                        </div>
                        <div class="col-4 d-flex flex-column" style="gap: 12px;">
                            <text class="font-size-16 font-weight-500">Emergency Contact</text>
                            <input type="text" name="emergencyTel" id="emergencyTel" class="form-control"
                                placeholder="e.g., +66 081 091 87">
                        </div>
                        <div class="col-4 d-flex flex-column" style="gap: 12px;">
                            <text class="font-size-16 font-weight-500"> Address</text>
                            <input type="text" name="address1" id="address1" class="form-control"
                                placeholder="e.g., 23 Elm Street, Apt 4B">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4 d-flex flex-column" style="gap: 12px;">
                            <text class="font-size-16 font-weight-500"><span class="text-danger">* </span>Personal
                                Email</text>
                            <div class="input-group">
                                <span class="input-group-text" style="background-color: white; border-right: none;">
                                    <img src="<?= Yii::$app->homeUrl ?>image/e-mail.svg" alt="Website"
                                        style="width: 20px; height: 20px;">
                                </span>
                                <input type="text" name="email" id="email" class="form-control"
                                    placeholder="kaori@gmail.com" style=" border-left: none;" required>
                            </div>
                        </div>
                        <div class="col-4 d-flex flex-column" style="gap: 12px;">
                            <text class="font-size-16 font-weight-500"><span class="text-danger">* </span>Marital
                                Status</text>
                            <div class="input-group">
                                <span class="input-group-text" style="background-color: white; border-right: none;">
                                    <img src="<?= Yii::$app->homeUrl ?>image/e-world.svg" alt="Website"
                                        style="width: 20px; height: 20px;">
                                </span>
                                <select class="form-select" name="maritalStatus" id="maritalStatus"
                                    style="border-left: none;" required>
                                    <option value="" disabled selected hidden
                                        style="color: var(--Helper-Text, #8A8A8A);">
                                        <?= Yii::t('app', 'Select') ?>
                                    </option>
                                    <option value="1">Single</option>
                                    <option value="2">Married</option>
                                    <option value="3">Divorced</option>
                                    <option value="4">Widowed</option>
                                    <option value="5">Separated</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-4 d-flex flex-column" style="gap: 12px;">
                            <label class="font-size-16 font-weight-500"><span class="text-danger">* </span>Date of
                                Birth</label>
                            <div class="input-group" id="group-birtdate" style="position: relative;">
                                <span class="input-group-text mid-center pb-10 pt-10"
                                    style="background-color: #C3C3C3; border:0.5px solid #818181; border-radius: 36px; width: 66px; z-index: 1; height: 40px;">
                                    <img src="<?= Yii::$app->homeUrl ?>image/calendar-gray.svg" alt="Calendar"
                                        style="width: 16px; height: 16px;">
                                </span>

                                <!-- คลิกเปิด calendar -->
                                <div class="form-control" id="birthdate-select"
                                    style="border-radius: 53px; text-align: center; cursor: pointer; position: absolute; width: 100%; height: 40px;">
                                    Select Birthday <i class="fa fa-angle-down pull-right mt-5" aria-hidden="true"></i>
                                </div>

                                <!-- input ที่ใช้ส่งค่าจริง -->
                                <input type="hidden" name="birthDa  te" id="birthDate" value="">
                            </div>

                            <!-- กล่อง calendar ที่จะโชว์เมื่อกด -->
                            <div id="calendar-birtdate"
                                style="position: absolute; margin-top: 75px; padding: 10px; border: 1px solid #ddd; border-radius: 10px; background: #fff; width: 100%; z-index: 1; display: none; justify-content: center; align-items: center;">
                                <input type="date" id="calendarInput" max="<?= date('Y-m-d') ?>" class="form-control">
                            </div>
                        </div>

                    </div>

                </div>
            </div>
            <input type="hidden" id="systemAdmin" name="conten3" value="Work Details">
            <!-- Work Details -->
            <div>
                <div>
                    <!-- head -->
                    <span class="font-size-16 font-weight-600">
                        Work Details
                    </span>
                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/help.svg" data-toggle="tooltip"
                        data-placement="top" aria-label=" Work Details" data-bs-original-title=" Work Details">
                    <hr class="hr-group">
                </div>
                <div class="d-flex flex-column" style="gap: 40px">
                    <!-- body -->
                    <div class="row">
                        <div class="col-4 d-flex flex-column" style="gap: 12px;">
                            <text class="font-size-16 font-weight-500"><span class="text-danger">*
                                </span>Select Company</text>
                            <div class="input-group">
                                <select class="form-select " id="companySelectId" name="companyId"
                                    style="appearance: none; background-image: none;">
                                    <option value=""><?= Yii::t('app', 'Select Company') ?></option>
                                    <?php if (isset($companies) && count($companies) > 0): ?>
                                    <?php foreach ($companies as $c): ?>
                                    <option value="<?= $c['companyId'] ?>" data-img="<?= $c['picture'] ?>">
                                        <?= $c['companyName'] ?>
                                    </option>
                                    <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                                <span class="input-group-text "
                                    style="background-color: #fff; border-left: none; gap: 5px; cursor: pointer;"
                                    onclick="document.getElementById('companySelectId').focus();">
                                    <div id="companyIcon" class="cycle-current-gray" style="width: 20px; height: 20px;">
                                        <img id="companyIconImg"
                                            src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/company.svg" alt="icon"
                                            style="width: 10px; height: 10px;">
                                    </div>
                                    <img src="<?= Yii::$app->homeUrl ?>image/drop-down.svg" alt="Dropdown"
                                        style="width: 10px; height: 10px;">
                                </span>
                            </div>
                        </div>
                        <div class="col-4 d-flex flex-column" style="gap: 12px;">
                            <text class="font-size-16 font-weight-500"><span class="text-danger">* </span>Select
                                Branch</text>
                            <!-- <select class="form-select" name="fff" id="fff" style="border-left: none;" required>
                                <option value="" disabled selected hidden style="color: var(--Helper-Text, #8A8A8A); ">
                                    <?= Yii::t('app', 'Select') ?>
                                </option>

                            </select> -->
                            <div class="input-group">
                                <select id="branchSelectId" brancSelect" class="form-select"
                                    style="border-right: none; width: 239px; appearance: none; background-image: none;"
                                    name="branchId" data-company-branch="branch" required disabled>
                                    <option value="" disabled selected hidden
                                        style="color: var(--Helper-Text, #8A8A8A); ">
                                        <?= Yii::t('app', 'Select from a Branch') ?>
                                    </option>
                                </select>

                                <span class="input-group-text"
                                    style="background-color: #e9ecef; border-left: none; gap: 5px; cursor: pointer;"
                                    onclick="document.getElementById('companySelectId').focus();">
                                    <div id="branchIcon" class="cycle-current-gray" style="width: 20px; height: 20px;">
                                        <img id="branchIconImg" src="<?= Yii::$app->homeUrl ?>image/branches-black.svg"
                                            alt="icon" style="width: 10px; height: 10px;">
                                    </div>
                                    <img src="<?= Yii::$app->homeUrl ?>image/drop-down.svg" alt="Dropdown"
                                        style="width: 10px; height: 10px;">
                                </span>
                            </div>
                        </div>
                        <div class="col-4 d-flex flex-column" style="gap: 12px;">
                            <text class="font-size-16 font-weight-500"><span class="text-danger">* </span>Select
                                Department</text>
                            <div class="input-group">
                                <select id="departmentSelectId" brancSelect" class="form-select"
                                    style="border-right: none; width: 239px; appearance: none; background-image: none;"
                                    name="departmentId" data-company-branch="department" required disabled>
                                    <option value="" disabled selected hidden
                                        style="color: var(--Helper-Text, #8A8A8A); ">
                                        <?= Yii::t('app', 'Select from a Department') ?>
                                    </option>
                                </select>

                                <span class="input-group-text"
                                    style="background-color: #e9ecef; border-left: none; gap: 5px; cursor: pointer;"
                                    onclick="document.getElementById('companySelectId').focus();">
                                    <div id="departmentIcon" class="cycle-current-gray"
                                        style="width: 20px; height: 20px;">
                                        <img id="departmentIconImg"
                                            src="<?= Yii::$app->homeUrl ?>image/departments-black.svg" alt="icon"
                                            style="width: 10px; height: 10px;">
                                    </div>
                                    <img src="<?= Yii::$app->homeUrl ?>image/drop-down.svg" alt="Dropdown"
                                        style="width: 10px; height: 10px;">
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-4 d-flex flex-column" style="gap: 12px;">
                            <text class="font-size-16 font-weight-500"><span class="text-danger">* </span>
                                Select Team
                            </text>
                            <div class="input-group">
                                <select id="teamSelectId" brancSelect" class="form-select"
                                    style="border-right: none; width: 239px; appearance: none; background-image: none;"
                                    name="teamId" data-company-branch="team" required disabled>
                                    <option value="" disabled selected hidden
                                        style="color: var(--Helper-Text, #8A8A8A); ">
                                        <?= Yii::t('app', 'Select from a Team') ?>
                                    </option>
                                </select>

                                <span class="input-group-text"
                                    style="background-color: #e9ecef; border-left: none; gap: 5px; cursor: pointer;"
                                    onclick="document.getElementById('companySelectId').focus();">
                                    <div id="teamIcon" class="cycle-current-gray" style="width: 20px; height: 20px;">
                                        <img id="teamIconImg" src="<?= Yii::$app->homeUrl ?>image/teams-black.svg"
                                            alt="icon" style="width: 10px; height: 10px;">
                                    </div>
                                    <img src="<?= Yii::$app->homeUrl ?>image/drop-down.svg" alt="Dropdown"
                                        style="width: 10px; height: 10px;">
                                </span>
                            </div>
                        </div>
                        <div class="col-4 d-flex flex-column" style="gap: 12px;">
                            <text class="font-size-16 font-weight-500"><span class="text-danger">* </span>
                                Work Email
                            </text>
                            <div class="input-group">
                                <span class="input-group-text" style="background-color: white; border-right: none;">
                                    <img src="<?= Yii::$app->homeUrl ?>image/e-mail.svg" alt="Website"
                                        style="width: 20px; height: 20px;">
                                </span>
                                <input type="text" style="border-left: none;" name="companyEmail" id="companyEmail"
                                    class="form-control" placeholder="kaori@gmail.com" required>
                            </div>
                        </div>

                        <div class="col-4 d-flex flex-column" style="gap: 12px;">
                            <label class="font-size-16 font-weight-500">
                                <span class="text-danger">* </span> Hiring Date
                            </label>
                            <div class="input-group" id="group-hiringdate" style="position: relative;">
                                <span class="input-group-text mid-center pb-10 pt-10" id="calendar-icon-hiring"
                                    style="background-color: #C3C3C3; border:0.5px solid #818181; border-radius: 36px; width: 66px; z-index: 1; height: 40px;">
                                    <img src="<?= Yii::$app->homeUrl ?>image/calendar-gray.svg" alt="Calendar"
                                        id="calendar-img-hiring" style="width: 16px; height: 16px;">
                                </span>

                                <div class="form-control" id="hiring-select"
                                    style="border-radius: 53px; text-align: center; cursor: pointer; position: absolute; width: 100%; height: 40px;">
                                    Select hiring Date <i class="fa fa-angle-down pull-right mt-5"
                                        aria-hidden="true"></i>
                                </div>

                                <input type="hidden" name="hiringDate" id="hiringDate" value="">
                            </div>

                            <div id="calendar-hiringdate"
                                style="position: absolute; margin-top: 75px; padding: 10px; border: 1px solid #ddd; border-radius: 10px; background: #fff; width: 100%; z-index: 1; display: none; justify-content: center; align-items: center;">
                                <input type="date" id="calendarInputHiring" max="<?= date('Y-m-d') ?>"
                                    class="form-control">
                            </div>
                        </div>


                    </div>

                    <div class="row">

                        <div class="col-4 d-flex flex-column" style="gap: 12px;">
                            <div style="display: flex;  align-items: center; gap: 5px;">
                                <span class="text-danger">* </span>
                                <label class="switch">
                                    <input type="checkbox" id="override-probation-employee" checked="">
                                    <span class="slider round"></span>
                                </label>
                                <label class="font-size-16 font-weight-500">
                                    Probation Period
                                </label>
                            </div>
                            <div class="input-group" id="group-due-term" style="position: relative;">
                                <span class="input-group-text pb-10 pt-10" id="due-term-icon-group"
                                    style="background-color: #C3C3C3; border:0.5px solid #818181; border-radius: 36px; gap: 4px; z-index: 1; height: 40px;">
                                    <img src="<?= Yii::$app->homeUrl ?>image/calendar-gray.svg" data-icon="calendar"
                                        id="start-img-probation" alt="Calendar" style="width: 16px; height: 16px;">
                                    <img src="<?= Yii::$app->homeUrl ?>image/weld-gray.svg" data-icon="weld" alt="Weld"
                                        id="weld-img-probation" style="width: 16px; height: 16px;">
                                    <img src="<?= Yii::$app->homeUrl ?>image/calendar-gray.svg" data-icon="calendar"
                                        id="end-img-probation" alt="Calendar" style="width: 16px; height: 16px;">
                                </span>


                                <!-- คลิกเปิด calendar -->
                                <div class="form-control" id="multi-due-term"
                                    style="border-radius: 53px; text-align: center; cursor: pointer; position: absolute; width: 100%; height: 40px;">
                                    Select the term <i class="fa fa-angle-down pull-right mt-5" aria-hidden="true"></i>
                                </div>
                                <!-- hidden inputs เพื่อเก็บค่า month และ year -->
                                <input type="hidden" id="probationStart" name="probationStart"
                                    value="<?= isset($data['probationStart']) ? $data['probationStart'] : '' ?>"
                                    required>
                                <input type="hidden" id="probationEnd" name="probationEnd"
                                    value="<?= isset($data['probationEnd']) ? $data['probationEnd'] : '' ?>" required>
                            </div>

                            <!-- กล่อง calendar ที่จะโชว์เมื่อกด -->
                            <div class="calendar-container" id="calendar-due-term"
                                style="display: none; position: absolute; margin-top: 80px; padding: 10px; border: 1px solid #ddd; border-radius: 10px; background: #fff; width: 650px; gap: 3px; z-index: 1;">
                                <!-- ปฏิทินสำหรับวันที่เริ่มต้น -->
                                <div id="startDatePicker"></div>
                                <!-- ปฏิทินสำหรับวันที่สิ้นสุด -->
                                <div id="endDatePicker"></div>
                            </div>
                        </div>

                        <div class="col-4 d-flex flex-column" style="gap: 12px;">

                        </div>
                        <div class="col-4 d-flex flex-column" style="gap: 12px;">

                        </div>

                    </div>
                </div>
            </div>
            <!-- Job Description -->
            <div>
                <div>
                    <!-- head -->
                    <span class="font-size-16 font-weight-600">
                        Job Description
                    </span>
                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/help.svg" data-toggle="tooltip"
                        data-placement="top" aria-label=" Job Description" data-bs-original-title=" Job Description">
                    <hr class="hr-group">
                </div>
                <div>
                    <!-- body -->
                    fff
                </div>
            </div>
            <!--  Attachments & Remarks -->
            <div>
                <div>
                    <!-- head -->
                    <span class="font-size-16 font-weight-600">
                        Attachments & Remarks
                    </span>
                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/help.svg" data-toggle="tooltip"
                        data-placement="top" aria-label=" Attachments & Remarks"
                        data-bs-original-title=" DeAttachments & Remarkstails">
                    <hr class="hr-group">
                </div>
                <div>
                    <!-- body -->
                    fff
                </div>
            </div>
            <!-- Certificates and Skill Tags -->
            <div>
                <div>
                    <!-- head -->
                    <span class="font-size-16 font-weight-600">
                        Certificates and Skill Tags
                    </span>
                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/help.svg" data-toggle="tooltip"
                        data-placement="top" aria-label=" Certificates and Skill Tags"
                        data-bs-original-title=" Certificates and Skill Tags">
                    <hr class="hr-group">
                </div>
                <div>
                    <!-- body -->
                    fff
                </div>
            </div>
            <!-- Others -->
            <div>
                <div>
                    <!-- head -->
                    <span class="font-size-16 font-weight-600">
                        Others
                    </span>
                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/help.svg" data-toggle="tooltip"
                        data-placement="top" aria-label="Others" data-bs-original-title="Others">
                    <hr class="hr-group">
                </div>
                <div>
                    <!-- body -->
                    fff
                </div>
            </div>

            <!-- กล่องรวม checkbox และปุ่ม -->
            <div class="d-flex flex-column align-items-end w-100" style="gap: 20px;">

                <!-- ✅ Checkbox: Email login -->
                <div class="d-flex justify-content-end align-items-center" style="gap: 10px;">
                    <input type="checkbox" id="sendEmail">
                    <label for="sendEmail" class="mb-0">Email login details to employee</label>
                </div>

                <!-- ✅ ปุ่ม Cancel + Save -->
                <div class="d-flex justify-content-end align-items-center" style="gap: 10px;">
                    <a href="<?= Yii::$app->homeUrl ?>setting/group/create-group" style="text-decoration: none;">
                        <button type="button" class="btn-cancel-group">
                            Cancel
                        </button>
                    </a>
                    <a href="<?= Yii::$app->homeUrl ?>setting/group/create-group" style="text-decoration: none;">
                        <button type="button" class="btn-cancel-group w-100">
                            Save as Draft
                            <img src="<?= Yii::$app->homeUrl ?>image/draft.svg">
                        </button>
                    </a>
                    <button type="submit" class="btn-save-group">
                        Save
                        <img src="<?= Yii::$app->homeUrl ?>image/save-icon.svg" alt="Save Icon"
                            style="width: 20px; height: 20px;">
                    </button>
                </div>

            </div>

        </div>
    </div>
</div>
<script>
const homeUrl = "<?= Yii::$app->homeUrl ?>";
document.getElementById('companySelectId').addEventListener('change', function() {
    const iconImg = document.getElementById('companyIconImg');
    const selectedOption = this.options[this.selectedIndex];
    const selectedImg = selectedOption.getAttribute('data-img');
    const selectedValue = this.value;
    const branchSelect = document.getElementById('branchSelectId');
    const branchSpan = branchSelect.nextElementSibling; // span ที่อยู่ถัดจาก select

    // เอา disabled ออก
    branchSelect.removeAttribute('disabled');

    // เปลี่ยนสี background
    if (branchSpan && branchSpan.classList.contains('input-group-text')) {
        branchSpan.style.backgroundColor = '#fff';
    }
    if (selectedValue !== '') {
        iconImg.src = homeUrl + selectedImg;
        iconImg.removeAttribute('style');
        iconImg.classList.add('card-tcf');
    } else {
        iconImg.src = '<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/company.svg';
    }
});

document.getElementById('branchSelectId').addEventListener('change', function() {
    const iconImg = document.getElementById('branchIconImg');
    const selectedValue = this.value;
    const iconDiv = document.getElementById('branchIcon');
    const departmentSelect = document.getElementById('departmentSelectId');
    const departmentSpan = departmentSelect.nextElementSibling; // span ที่อยู่ถัดจาก select

    // เอา disabled ออก
    departmentSelect.removeAttribute('disabled');

    // เปลี่ยนสี background
    if (departmentSpan && departmentSpan.classList.contains('input-group-text')) {
        departmentSpan.style.backgroundColor = '#fff';
    }
    if (selectedValue !== '') {
        iconImg.src = homeUrl + 'image/branches-black.svg';
        // alert(selectedValue);
        iconDiv.classList.remove('cycle-current-gray');
        iconDiv.classList.add('cycle-current-yellow');

    } else {
        iconDiv.classList.remove('cycle-current-yellow');
        iconDiv.classList.add('cycle-current-gray');
    }
});



document.getElementById('departmentSelectId').addEventListener('change', function() {
    const iconImg = document.getElementById('departmentIconImg');
    const selectedValue = this.value;
    const iconDiv = document.getElementById('departmentIcon');
    const teamSelect = document.getElementById('teamSelectId');
    const teamSpan = teamSelect.nextElementSibling; // span ที่อยู่ถัดจาก select

    // เอา disabled ออก
    teamSelect.removeAttribute('disabled');

    // เปลี่ยนสี background
    if (teamSpan && teamSpan.classList.contains('input-group-text')) {
        teamSpan.style.backgroundColor = '#fff';
    }

    if (selectedValue !== '') {
        iconImg.src = homeUrl + 'image/departments.svg';
        // alert(selectedValue);
        iconDiv.classList.remove('cycle-current-gray');
        iconDiv.classList.add('cycle-current-red');

    } else {
        iconDiv.classList.remove('cycle-current-red');
        iconDiv.classList.add('cycle-current-gray');
    }
});


document.getElementById('teamSelectId').addEventListener('change', function() {
    const iconImg = document.getElementById('teamIconImg');
    const selectedValue = this.value;
    const iconDiv = document.getElementById('teamIcon');
    if (selectedValue !== '') {
        iconImg.src = homeUrl + 'image/teams.svg';
        // alert(selectedValue);
        iconDiv.classList.remove('cycle-current-gray');
        iconDiv.classList.add('cycle-current-green');

    } else {
        iconDiv.classList.remove('cycle-current-green');
        iconDiv.classList.add('cycle-current-gray');
    }
});



document.getElementById('companySelectId').addEventListener('change', function() {
    const companyId = this.value;
    // alert(companyId);

    fetch('<?= Yii::$app->homeUrl ?>setting/company/company-branch-list', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-Token': '<?= Yii::$app->request->csrfToken ?>'
            },
            body: JSON.stringify({
                companyId: companyId
            })
        })
        .then(response => response.json())
        .then(data => {
            console.log("Fetched data:", data);
            const branchSelect = document.querySelector('[name="branchId"]');
            branchSelect.innerHTML =
                '<option value="" disabled selected hidden><?= Yii::t("app", "Select from a Branch") ?></option>';

            if (Array.isArray(data)) {
                data.forEach(branch => {
                    const option = document.createElement('option');
                    option.value = branch.branchId;
                    option.text = branch.branchName;
                    branchSelect.appendChild(option);
                });
            }
        });
});


document.getElementById('branchSelectId').addEventListener('change', function() {
    const beanchId = this.value;

    // alert(beanchId);

    fetch('<?= Yii::$app->homeUrl ?>setting/branch/branch-department-list', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-Token': '<?= Yii::$app->request->csrfToken ?>'
            },
            body: JSON.stringify({
                beanchId: beanchId
            })
        })
        .then(response => response.json())
        .then(data => {
            console.log("Fetched data:", data);
            const branchSelect = document.querySelector('[name="departmentId"]');
            branchSelect.innerHTML =
                '<option value="" disabled selected hidden><?= Yii::t("app", "Select from the departments") ?></option>';

            if (Array.isArray(data)) {
                data.forEach(branch => {
                    const option = document.createElement('option');
                    option.value = branch.departmentId;
                    option.text = branch.departmentName;
                    branchSelect.appendChild(option);
                });
            }
        });
});


document.getElementById('departmentSelectId').addEventListener('change', function() {
    const departmentId = this.value;

    fetch('<?= Yii::$app->homeUrl ?>setting/department/department-team-list', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-Token': '<?= Yii::$app->request->csrfToken ?>'
            },
            body: JSON.stringify({
                departmentId: departmentId
            })
        })
        .then(response => response.json())
        .then(data => {
            const teamSelect = document.getElementById('teamSelectId');
            teamSelect.innerHTML =
                '<option value="" disabled selected hidden><?= Yii::t("app", "Select from a Team") ?></option>';

            if (data && typeof data === 'object') {
                Object.values(data).forEach(team => {
                    const option = document.createElement('option');
                    option.value = team.teamId;
                    option.textContent = team.teamName;
                    teamSelect.appendChild(option);
                });
                teamSelect.disabled = false; // เปิดการใช้งาน dropdown
            }
        });
});
</script>
<?php ActiveForm::end(); ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="radioHighlight.js"></script>
<script>
flatpickr("#birthdate-select", {
    dateFormat: "d-M-Y",
    maxDate: "today",
    onChange: function(selectedDates, dateStr, instance) {
        // เปลี่ยนข้อความใน #birthdate-select
        document.getElementById("birthdate-select").innerHTML = `
            ${dateStr} <i class="fa fa-angle-down pull-right mt-5" aria-hidden="true"></i>
        `;

        // เซ็ตค่าวันเกิดใน hidden input
        document.getElementById("birthDate").value = dateStr;

        // เปลี่ยนรูปภาพ calendar เป็น calendar-blue.svg
        const calendarImg = document.querySelector('#group-birtdate img');
        if (calendarImg) {
            calendarImg.src = "<?= Yii::$app->homeUrl ?>image/calendar-blue.svg";
        }

        // เปลี่ยน background-color และ border ของ input-group-text
        const inputGroupText = document.querySelector('#group-birtdate .input-group-text');
        if (inputGroupText) {
            inputGroupText.style.backgroundColor = "rgb(215, 235, 255)";
            inputGroupText.style.border = "0.5px solid rgb(190, 218, 255)";
        }
    }
});

flatpickr("#hiring-select", {
    dateFormat: "Y-m-d",
    maxDate: "today",
    onChange: function(selectedDates, dateStr, instance) {
        document.getElementById("hiringDate").value = dateStr;
        document.getElementById("hiring-select").innerHTML = dateStr;

        // เปลี่ยนสีพื้นหลัง & icon
        document.getElementById("calendar-icon-hiring").style.backgroundColor = "rgb(215, 235, 255)";
        document.getElementById("calendar-icon-hiring").style.border = "0.5px solid rgb(190, 218, 255)";
        document.getElementById("calendar-img-hiring").src =
            "<?= Yii::$app->homeUrl ?>image/calendar-blue.svg";
    }
});


document.addEventListener("DOMContentLoaded", function() {
    initRadioSelection(); // เรียกใช้กับ `.radio-wrapper` ปกติ
    // หรือใส่ selector อื่นถ้ามีหลายกลุ่ม
    initCheckboxSelection(); // เรียกใช้กับ `.checkbox-wrapper`


});
</script>