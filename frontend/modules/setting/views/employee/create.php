<?php

use common\models\ModelMaster;
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
                                <input type="text" class="form-control font-size-14" id="employeeId" name=" employeeId"
                                    placeholder="Please assign the employee ID " value="" style="width:  330.59px;">
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
                                        if (isset($languages) && count($languages) > 0) {
                                            foreach ($languages as $lang) {
                                                echo '<option value="' . htmlspecialchars($lang['languageId']) . '">' . htmlspecialchars($lang['languageName']) . '</option>';
                                            }
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
                            <text class="font-size-16 font-weight-500"><span class="text-danger">* </span>Gender</text>
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
                                    <img class="cycle-current" id="flag"
                                        src="<?= Yii::$app->homeUrl ?>image/e-world.svg" alt="Website"
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
                                    <option value="<?= $nation['countryId'] ?>" data-flag="<?= $nation['flag'] ?>">
                                        <?= $nation['countryName'] ?>
                                    </option>
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
                <div class="between-center">
                    <!-- head -->
                    <div>
                        <span class="font-size-16 font-weight-600">
                            Work Details
                        </span>
                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/help.svg" data-toggle="tooltip"
                            data-placement="top" aria-label=" Work Details" data-bs-original-title=" Work Details">
                    </div>
                    <div>
                        <span class="text-gray font-size-13 font-weight-400 mr-12">Can’t find the company?</span>
                        <a href="<?= Yii::$app->homeUrl ?>setting/company/create/<?= ModelMaster::encodeParams(['groupId' => $groupId]) ?>"
                            class="text-blue font-size-13 font-weight-500">Register Company Here <img
                                src="<?= Yii::$app->homeUrl ?>image/see-all.svg" alt="icon"
                                style="cursor: pointer;"></a>
                    </div>

                </div>
                <hr class="hr-group">

                <div class="d-flex flex-column" style="gap: 40px">
                    <!-- body -->
                    <div class="row">
                        <div class="col-4 d-flex flex-column" style="gap: 12px;">
                            <text class="font-size-16 font-weight-500"><span class="text-danger">*
                                </span>Select Company
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/help.svg" data-toggle="tooltip"
                                    data-placement="top" aria-label="ttt" data-bs-original-title="ttt">
                            </text>
                            <div class="input-group">
                                <select class="form-select " id="companySelectId" name="companyId"
                                    style="appearance: none; background-image: none;">
                                    <option value=""><?= Yii::t('app', 'Which Company your are is working in ? ') ?>
                                    </option>
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
                            <text class="font-size-16 font-weight-500"><span class="text-danger">* </span>
                                Select Branch
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/help.svg" data-toggle="tooltip"
                                    data-placement="top" aria-label="ttt" data-bs-original-title="ttt">
                            </text>
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
                                        <?= Yii::t('app', 'Select from Branches') ?>
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
                            <text class="font-size-16 font-weight-500"><span class="text-danger">* </span>
                                Select Department
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/help.svg" data-toggle="tooltip"
                                    data-placement="top" aria-label="ttt" data-bs-original-title="ttt">
                            </text>
                            <div class="input-group">
                                <select id="departmentSelectId" brancSelect" class="form-select"
                                    style="border-right: none; width: 239px; appearance: none; background-image: none;"
                                    name="departmentId" data-company-branch="department" required disabled>
                                    <option value="" disabled selected hidden
                                        style="color: var(--Helper-Text, #8A8A8A); ">
                                        <?= Yii::t('app', 'In which Department?') ?>
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
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/help.svg" data-toggle="tooltip"
                                    data-placement="top" aria-label="ttt" data-bs-original-title="ttt">
                            </text>
                            <div class="input-group">
                                <select id="teamSelectId" brancSelect" class="form-select"
                                    style="border-right: none; width: 239px; appearance: none; background-image: none;"
                                    name="teamId" data-company-branch="team" required disabled>
                                    <option value="" disabled selected hidden
                                        style="color: var(--Helper-Text, #8A8A8A); ">
                                        <?= Yii::t('app', 'Select his/her team') ?>
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
                                <input type="hidden" name="overrideProbationEmployee"
                                    id="override-probation-employee-hidden" value="1">

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
                                <input type="hidden" id="fromDate" name="fromDate"
                                    value="<?= isset($data['probationStart']) ? $data['probationStart'] : '' ?>"
                                    required>
                                <input type="hidden" id="toDate" name="toDate"
                                    value="<?= isset($data['probationEnd']) ? $data['probationEnd'] : '' ?>" required>

                            </div>

                            <!-- กล่อง calendar ที่จะโชว์เมื่อกด -->
                            <div class="calendar-container" id="calendar-due-term"
                                style="display: none; position: absolute; margin-top: 80px; padding: 10px; border: 1px solid #ddd; border-radius: 10px; background: #fff; width: 650px; gap: 3px; z-index: 1;">
                                <!-- ปฏิทินสำหรับวันที่เริ่มต้น -->
                                <div id="startProbationPicker"></div>
                                <!-- ปฏิทินสำหรับวันที่สิ้นสุด -->
                                <div id="endProbationPicker"></div>
                            </div>
                        </div>

                        <div class="col-4 d-flex flex-column" style="gap: 12px;">

                        </div>
                        <div class="col-4 d-flex flex-column" style="gap: 12px;">

                        </div>

                    </div>
                </div>
            </div>

            <input type="hidden" id="systemAdmin" name="conten4" value="Job Description">
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
                    <div class="row">
                        <div class="col-4 d-flex flex-column" style="gap: 12px;">
                            <label class="font-size-16 font-weight-500">
                                <span class="text-danger">*</span> Employee’s Title
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/help.svg" data-toggle="tooltip"
                                    data-placement="top" aria-label="Employee’s Title"
                                    data-bs-original-title="Employee’s Title">
                            </label>

                            <div class="input-group">
                                <select id="titleSelectId" class="form-select"
                                    style="border-right: none; width: 239px; appearance: none; background-image: none;"
                                    name="titleId" data-company-branch="title" required disabled>
                                    <option value="" disabled selected hidden
                                        style="color: var(--Helper-Text, #8A8A8A);">
                                        <?= Yii::t('app', 'What your his/her Tile?') ?>
                                    </option>
                                    <!-- options will be populated dynamically -->
                                </select>

                                <span class="input-group-text"
                                    style="background-color: #e9ecef; border-left: none; gap: 5px; cursor: pointer;"
                                    onclick="document.getElementById('titleSelectId').focus();">
                                    <div id="titleIcon" class="cycle-current-gray" style="width: 20px; height: 20px;">
                                        <img id="titleIconImg" src="<?= Yii::$app->homeUrl ?>image/star-black.svg"
                                            alt="icon" style="width: 10px; height: 10px;">
                                    </div>
                                    <img src="<?= Yii::$app->homeUrl ?>image/drop-down.svg" alt="Dropdown"
                                        style="width: 10px; height: 10px;">
                                </span>
                            </div>
                        </div>

                        <div class="col-8 d-flex justify-content-end align-items-end">
                            <a href="<?= Yii::$app->homeUrl ?>setting/title/create/<?= ModelMaster::encodeParams(["companyId" => '', "branchId" => '', "departmentId" => '' ]) ?>"
                                class="text-blue font-size-13 font-weight-500">
                                Edit Job Description here
                                <img src="<?= Yii::$app->homeUrl ?>image/see-all.svg" alt="icon"
                                    style="cursor: pointer;">
                            </a>
                        </div>
                    </div>


                    <div id="descriptionTitle" class="alert bg-white mt-22">
                        <!-- ตอนยังไม่เลือก -->
                        <div class="create-crad-company" id="no-existing" style="background-color: #F9F9F9;">
                            <span class="font-size-15 font-weight-700 ">
                                Job Description has not been selected yet!
                            </span>
                            <span class="font-size-12 font-weight-400 font-gray">Select a job description template
                                from the list, and it will
                                appear here.
                            </span>
                        </div>

                    </div>
                </div>

                <input type="hidden" id="systemAdmin" name="conten5" value=" Attachments & Remarks">
                <!--  Attachments & Remarks -->
                <div>
                    <div>
                        <!-- head -->
                        <span class="font-size-16 font-weight-600">
                            Attachments & Remarks
                        </span>
                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/help.svg" data-toggle="tooltip"
                            data-placement="top" aria-label=" Attachments & Remarks"
                            data-bs-original-title=" DeAttachments & Remarks">
                        <hr class="hr-group">
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-12 ">
                            <span class="font-size-14 font-weight: 500;">Relevant Files</span>

                            <div class="col-lg-11 mt-5 mb-24">
                                <div id="upload-file1" class="form-control"
                                    style="border:1.22px dashed var(--Stroke-Bluish-Gray, #BBCDDE)">
                                    <div class="row">
                                        <div class="col-lg-2 center-center">
                                            <img id="icon-file1" src="<?= Yii::$app->homeUrl ?>image/file-big.svg"
                                                alt="icon" style="width: 40px; height: 40px;">
                                        </div>
                                        <div id="file-uplode-name1" class="col-lg-6 col-md-6 col-12"
                                            style="border-right:lightgray solid thin;">
                                            <label class="text-gray font-size-16 font-weight-500" for="resume">Upload
                                                Resume/CV here</label>
                                            <div class="text-secondary text-gray font-size-14">
                                                <span class="text-gray font-size-12">Supported - pdf, .doc, .docx</span>
                                            </div>
                                            <div id="filename-display1" class="font-size-16 font-weight-600 mt-2"></div>
                                        </div>
                                        <div id="file-edit1" class="col-lg-4 col-md-6 col-12 text-center pt-13">
                                            <label id="resume-btn" for="resume"
                                                class="text-blue font-size-16 font-weight-600" style="cursor: pointer;">
                                                Upload
                                                <img src="<?= Yii::$app->homeUrl ?>image/file-up-blue.svg" alt="icon"
                                                    style="width: 16px; height: 16px;">
                                            </label>
                                            <span class="ml-5 text-success" id="resume-check" style="display:none;">
                                                <i class="fa fa-check" aria-hidden="true"></i>
                                            </span>
                                        </div>
                                        <input id="resume" style="display:none;" type="file" name="resume"
                                            onchange="checkUploadFile(1)">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-11">
                                <div id="upload-file2" class="form-control"
                                    style="border:1.22px dashed var(--Stroke-Bluish-Gray, #BBCDDE)">
                                    <div class="row">
                                        <div class="col-lg-2 center-center">
                                            <img id="icon-file2" src="<?= Yii::$app->homeUrl ?>image/file-big.svg"
                                                alt="icon" style="width: 40px; height: 40px;">
                                        </div>
                                        <div id="file-uplode-name2" class="col-lg-6 col-md-6 col-12"
                                            style="border-right:lightgray solid thin;">
                                            <label class="text-gray font-size-16 font-weight-500" for="name">
                                                Upload Agreement Here
                                            </label>
                                            <div class="text-secondary text-gray  font-size-14">
                                                <span class="text-gray font-size-12"> Supported - pdf, .doc,
                                                    .docx</span>
                                            </div>
                                        </div>
                                        <div id="file-edit2" class="col-lg-4 col-md-6 col-12 text-center pt-13">
                                            <label id="agreement-btn" type="button" for="agreement"
                                                class="text-blue font-size-16 font-weight-600">
                                                Upload
                                                <img src="<?= Yii::$app->homeUrl ?>image/file-up-blue.svg" alt="icon"
                                                    style="width: 16px; height: 16px;">
                                            </label>
                                            <span class="ml-5 text-success" id="agreement-check" style="display:none;">
                                                <i class="fa fa-check" aria-hidden="true"></i>
                                            </span>

                                        </div>
                                        <input id="agreement" style="display:none;" type="file" name="agreement"
                                            onchange="javascript:checkUploadFile(2)">
                                    </div>
                                </div>
                            </div>

                            <input type="hidden" value="" id="hasResume">
                            <input type="hidden" value="" id="hasAgreement">

                        </div>

                        <div class="col-lg-6 col-md-6 col-12 pl-40">
                            <div class="col-12 font-size-14 font-weight: 500">
                                About the Employee
                            </div>
                            <div class="col-12 mt-5">
                                <textarea class="form-control" name="remark" style="height:276px;"></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <input type="hidden" id="systemAdmin" name="conten5" value=" Attachments & Remarks">
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

                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-12 " style="border-right:lightgray solid thin;">
                            <span class=" font-size-16 font-weight-500">
                                <span class="text-danger">* </span>
                                Certificate Achievements
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/help.svg" data-toggle="tooltip"
                                    data-placement="top" aria-label=" Certificates and Skill Tags"
                                    data-bs-original-title=" Certificates and Skill Tags">
                            </span>
                            <!-- เพิ่มรูป -->
                            <ul id="schedule-list" class="list-unstyled small  m-0 p-0 mt-12">
                                <!-- พอแอดแลวให้เอาข้อมูลจากอาเรย์ มาแสดงตรงนี้   -->
                                <!-- <li class="schedule-item" data-id="9"
                                    style="padding: 13px 20px; background-color: #FFFFFF;">
                                    <div class="row align-items-center dept-name">
                                        <div class="col-10 dept-label" style="font-weight: 600; font-size: 16px;">
                                        </div>
                                        <div class="col-2 text-end">
                                            <a href="#" style="cursor: pointer;" onclick="tttt"
                                                class="no-underline icon-delete">
                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/binred.svg"
                                                    alt="Delete" class="pim-icon bin-icon transition-icon">
                                            </a>
                                            <a href="#" class="no-underline icon-edit" onclick="tttt">
                                                <img src="<?= Yii::$app->homeUrl ?>image/edit-blue.svg" alt="Edit"
                                                    class="pim-icon edit-icon transition-icon"
                                                    style="margin-top: -3px;">
                                                <span class="text-blue edit-label transition-label"
                                                    style="font-weight: 500;">Edit</span>
                                            </a>
                                        </div>
                                    </div>
                                </li>  -->
                            </ul>
                            <button type="button" class="center-center bg-white mt-12"
                                style="padding: 13px 20px; height: 40px; width: 100%; border-radius: 5px; border: 0.5px solid #CBD5E1;"
                                onclick="openPopupModalCertificate()">
                                <span class="text-blue mr-6" style="font-weight: 600; font-size: 14px;"> Add
                                    More
                                </span>
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/plus-blue.svg" alt="LinkedIn"
                                    style="width: 20px; height: 20px;">
                            </button>
                        </div>

                        <div class="col-lg-6 col-md-6 col-12 pl-40">
                            <div class="company-group-edit bg-white">
                                <span class=" font-size-16 font-weight-500">
                                    <span class="text-danger">* </span>
                                    Certificate Achievements
                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/help.svg"
                                        data-toggle="tooltip" data-placement="top"
                                        aria-label=" Certificates and Skill Tags"
                                        data-bs-original-title=" Certificates and Skill Tags">
                                </span>
                                <div class="input-group mt-12">
                                    <span class="input-group-text" style="background-color: white; border-right: none;">
                                        <img id="flag"
                                            src="<?= Yii::$app->homeUrl ?>images/icons/Settings/plus-gray.svg"
                                            alt="Website" style="width: 20px; height: 20px;">
                                    </span>
                                    <input type="text" name="tttt" id="tttt" class="form-control"
                                        style=" border-left: none;  border-right: none;"
                                        placeholder="e.g., Python, Data Analysis, Communication  ">
                                    <span class="input-group-text" id="enterHint"
                                        style="background-color: #ffff; border-left: none; ">
                                        <div class="city-crad-company" id="hintText"
                                            style="background: var(--HRVC---Light-Text, #94989C);"><img
                                                src="<?= Yii::$app->homeUrl ?>image/enter-white.svg"
                                                style="width: 24px; height: 24px;">
                                            <span class="font-white">
                                                Enter to Save
                                            </span>
                                        </div>
                                    </span>
                                </div>

                                <div class="company-group-edit bg-white mt-20" style=" height: 141px;">

                                </div>
                            </div>
                        </div>
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
    <input type="hidden" id="certificateDataHidden" name="certificateData">

    <div class="modal fade" id="certificateModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" style="width: 120%;">
                <div class="row" id="certificateModalBody" style="width: 100%; padding: 60px; gap: 35px;">
                    <!-- AJAX content will be injected here -->
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="radioHighlight.js"></script>
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
        const departmentId = this.value;

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
        loadTeamsSelect(departmentId);


        const titileSelect = document.getElementById('titleSelectId');
        const titleSpan = titileSelect.nextElementSibling; // span ที่อยู่ถัดจาก select

        // เอา disabled ออก
        titileSelect.removeAttribute('disabled');

        // เปลี่ยนสี background
        if (titleSpan && titleSpan.classList.contains('input-group-text')) {
            titleSpan.style.backgroundColor = '#fff';
        }

        if (selectedValue !== '') {
            iconImg.src = homeUrl + 'image/departments.svg';
            //alert(selectedValue);
            iconDiv.classList.remove('cycle-current-gray');
            iconDiv.classList.add('cycle-current-red');

        } else {
            iconDiv.classList.remove('cycle-current-red');
            iconDiv.classList.add('cycle-current-gray');
        }
        loadTitlesSelect(departmentId);

    });


    document.getElementById('teamSelectId').addEventListener('change', function() {
        const iconImg = document.getElementById('teamIconImg');
        const selectedValue = this.value;
        const iconDiv = document.getElementById('teamIcon');
        if (selectedValue !== '') {
            iconImg.src = homeUrl + 'image/teams.svg';
            //alert(selectedValue);
            iconDiv.classList.remove('cycle-current-gray');
            iconDiv.classList.add('cycle-current-green');

        } else {
            iconDiv.classList.remove('cycle-current-green');
            iconDiv.classList.add('cycle-current-gray');
        }
    });


    document.getElementById('titleSelectId').addEventListener('change', function() {
        const iconImg = document.getElementById('titleIconImg');
        const selectedValue = this.value;
        const iconDiv = document.getElementById('titleIcon');
        if (selectedValue !== '') {
            iconImg.src = homeUrl + 'images/icons/white-icons/MasterSetting/title.svg';
            //alert(selectedValue);
            iconDiv.classList.remove('cycle-current-gray');
            iconDiv.classList.add('cycle-current-blue');

            //alert(selectedValue);

            fetch('<?= Yii::$app->homeUrl ?>setting/title/get-title-detail', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-Token': '<?= Yii::$app->request->csrfToken ?>'
                    },
                    body: JSON.stringify({
                        titleId: selectedValue
                    })
                })
                .then(response => response.json())
                .then(data => {
                    // ซ่อน "ยังไม่เลือก"
                    document.getElementById('no-existing').style.display = 'none';

                    // สร้าง HTML ใหม่สำหรับรายละเอียด
                    const html = `
                    <div>
                        <span class="font-size-20 font-weight-600">${data.titleName}</span>
                    </div>
                    <div class="center-center" style="gap: 63px; margin: 36px 29px;">
                        <div class="row" style="border-right:lightgray solid thin;">
                            <div class="row mb-36">
                                <span class="font-size-16 font-weight-500 mb-22">Purpose of the Job</span>
                                <span class="font-size-14 font-weight-400">${data.purpose}</span>
                            </div>
                            <div class="row">
                                <span class="font-size-16 font-weight-500 mb-22">Core Responsibility</span>
                                <span class="font-size-14 font-weight-400">${data.jobDescription}</span>
                            </div>
                        </div>
                        <div class="row">
                            <span class="font-size-16 font-weight-500 mb-22">Key Responsibility</span>
                            <span class="font-size-14 font-weight-400">${data.keyResponsibility}</span>
                        </div>
                    </div>
                `;
                    document.getElementById('descriptionTitle').innerHTML = html;
                });

        } else {
            iconDiv.classList.remove('cycle-current-blue');
            iconDiv.classList.add('cycle-current-gray');
        }


    });



    document.getElementById('companySelectId').addEventListener('change', function() {
        const companyId = this.value;
        //alert(companyId);

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
                    '<option value="" disabled selected hidden><?= Yii::t("app", "Select from Branches") ?></option>';

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

        //alert(beanchId);

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
                    '<option value="" disabled selected hidden><?= Yii::t("app", "In which Department?") ?></option>';

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

    document.getElementById('nationalityId').addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        const flagUrl = selectedOption.getAttribute('data-flag');
        // alert(flagUrl);
        if (flagUrl) {
            document.getElementById('flag').src = homeUrl + flagUrl;
        }
    });


    // ตัวแปรเก็บ certificate ทั้งหมด
    let certificates = [];

    function createSchedule() {
        // อ่านค่าจากฟอร์ม
        const cerName = document.getElementById('cerName').value.trim();
        const issuingName = document.getElementById('issuingName').value.trim();
        const fromDate = document.getElementById('fromCerDate').value.trim();
        const toDate = document.getElementById('toCerDate').value.trim();
        const credential = document.getElementById('credential').value.trim();
        const noExpiry = document.getElementById('noExpiryCheckbox').checked;

        // ตรวจสอบข้อมูลที่จำเป็น
        if (!cerName || !issuingName || (!fromDate && !noExpiry) || (!toDate && !noExpiry)) {
            alert('Please fill all required fields.');
            return;
        }

        // สร้าง object ข้อมูล certificate
        const cert = {
            cerName,
            issuingName,
            fromDate: noExpiry ? 'No expiry date' : fromDate,
            toDate: noExpiry ? '' : toDate,
            credential,
            noExpiry
        };

        // เก็บลงในอาเรย์
        certificates.push(cert);

        // แสดงผลลัพธ์ใน UL
        renderScheduleList();
        console.log(certificates);

        // เคลียร์ฟอร์มหลังเพิ่ม
        clearForm();

        // ปิดป็อปอัพ Bootstrap modal
        const certificateModalEl = document.getElementById('certificateModal');
        const modal = bootstrap.Modal.getInstance(certificateModalEl); // ดึง instance ของ modal ที่เปิดอยู่
        if (modal) {
            modal.hide(); // สั่งปิด modal
        }
    }


    function renderScheduleList() {
        const list = document.getElementById('schedule-list');
        list.innerHTML = ''; // เคลียร์ของเก่า

        certificates.forEach((cert, index) => {
            const li = document.createElement('li');
            li.classList.add('mb-2');
            li.innerHTML = `
                                <li class="schedule-item" data-id="9"
                                    style="padding: 13px 20px; background-color: #FFFFFF;">
                                    <div class="row align-items-center dept-name">
                                        <div class="col-9 dept-label" style="font-weight: 600; font-size: 16px;">
                                        ${cert.issuingName}
                                        </div>
                                        <div class="col-3 text-end">
                                            <a href="#" style="cursor: pointer;" onclick="tttt"
                                                class="no-underline icon-delete">
                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/binred.svg"
                                                    alt="Delete" class="pim-icon bin-icon transition-icon">
                                            </a>
                                            <a href="#" class="no-underline icon-edit" onclick="tttt">
                                                <img src="<?= Yii::$app->homeUrl ?>image/edit-blue.svg" alt="Edit"
                                                    class="pim-icon edit-icon transition-icon"
                                                    style="margin-top: -3px;">
                                                <span class="text-blue edit-label transition-label"
                                                    style="font-weight: 500;">Edit</span>
                                            </a>
                                        </div>
                                    </div>
                                </li> 
      `;
            list.appendChild(li);
        });
    }

    function clearForm() {
        document.getElementById('cerName').value = '';
        document.getElementById('issuingName').value = '';
        document.getElementById('fromCerDate').value = '';
        document.getElementById('toCerDate').value = '';
        document.getElementById('credential').value = '';
        document.getElementById('noExpiryCheckbox').checked = false;
        document.getElementById('cer-date-label').innerText = 'start date - end date';
        document.getElementById('multi-cer-term').style.pointerEvents = 'auto';
        document.getElementById('multi-cer-term').style.opacity = '1';
    }

    function removeCertificate(index) {
        certificates.splice(index, 1); // ลบ element ที่ index
        renderScheduleList();
    }
    r ` ปกติ
        // หรือใส่ selector อื่นถ้ามีหลายกลุ่ม
        initCheckboxSelection(); // เรียกใช้กับ `.checkbox -
        document.addEventListener("DOMContentLoaded", function() {
            initRadioSelection(); // เรียกใช้กับ `.radio-wrappewrapper`


        });
    </script>

    <?php ActiveForm::end(); ?>