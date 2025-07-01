<?php
use frontend\models\hrvc\Status;
use common\models\ModelMaster;
use yii\bootstrap5\ActiveForm;
// $statusfrom = 'create';

$urlSubmit = '';
if($statusfrom == 'Create'){
    $this->title = 'Create Employee';
    $urlSubmit = 'setting/employee/save-create-employee';
}else{
    $this->title = 'Update Employee';
    $urlSubmit = 'setting/employee/save-update-employee';
}
// $userModuleIds = array_column($userAccess, 'moduleId');  // [3, 4, 6]
$userModuleIds = [];

if (isset($userAccess) && is_array($userAccess) && !empty($userAccess)) {
    $userModuleIds = array_column($userAccess, 'moduleId');
}

$companyId = isset($employee['companyId']) ? $employee['companyId'] : '';

$companyId = isset($employee['companyId']) ? $employee['companyId'] : '';

$resumePath = isset($employee['resume']) ? $employee['resume'] : '';
$resumeFileName = basename($resumePath); // ดึงชื่อไฟล์จาก path เช่น bcRGoVHyu2.xlsx
$resumeExtension = pathinfo($resumeFileName, PATHINFO_EXTENSION); // xlsx


$agreementPath = isset($employee['agreement']) ? $employee['agreement'] : '';
$agreementFileName = basename($agreementPath);              // bcRGoVHyu2.xlsx
$agreementExtension = pathinfo($agreementFileName, PATHINFO_EXTENSION); // xlsx

$userCertificate = $userCertificate ?? []; // or fetch it from database
$userLanguage = isset($userLanguage) ? $userLanguage : [];

$LanguageId = '';

// echo '<pre>';
// print_r($mainLanguage);
// echo '</pre>';
// exit;
$statusTexArr = Status::allStatusText();
    ?>
<?php $form = ActiveForm::begin([
	'id' => 'create-employee',
	'method' => 'post',
	'options' => [
		'enctype' => 'multipart/form-data',
	],
	'action' => Yii::$app->homeUrl . $urlSubmit

]); ?>
<!-- Flatpickr CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<!-- Flatpickr JS -->
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<div class="company-group-body mt-50">
    <div class=" company-group-edit bg-white">
        <div class=" d-flex align-items-center gap-2">
            <a href="javascript:history.back()" style="text-decoration: none; width:66px; height:26px;"
                class="btn-create-branch">
                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/back-white.svg"
                    style="width:18px; height:18px; margin-top:-3px;">
                <?= Yii::t('app', 'Back') ?>
            </a>
            <div class="pim-name-title ml-10">
                <?= Yii::t('app', $statusfrom.' Employee') ?>
            </div>
        </div>
        <div class="row update-group-body mt-20" style="gap: 60px;">
            <!-- Account Details -->
            <div>
                <!-- head -->
                <div class="between-center">
                    <div>
                        <span class="font-size-16 font-weight-600">
                            <?= Yii::t('app', 'Account Details') ?>
                        </span>
                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/help.svg" data-toggle="tooltip"
                            data-placement="top" aria-label="<?= Yii::t('app', 'Account Details') ?>"
                            data-bs-original-title="<?= Yii::t('app', 'Account Details') ?>">
                    </div>
                    <div class="d-flex align-items-center" style="gap: 10px;">
                        <span class="font-size-16 font-weight-600">
                            <span class="text-danger">* </span>
                            <?= Yii::t('app', 'Employment Status') ?>
                        </span>
                        <select class="select-employee-status" aria-label="Default select example" name="status"
                            id="pim-status" onchange="javascript:changeStatusEmployee()" required>
                            <option value="" disabled hidden
                                <?= empty($employee['employeeConditionId']) ? 'selected' : '' ?>
                                style="color: var(--Helper-Text, #8A8A8A);">
                                <?= Yii::t('app', 'Select') ?>
                            </option>

                            <!-- ปรับเอามาจากสเตตัส ปรับคอนโทรเลอร์ตอนเชฟด้วย และ ทำรอโหลดน้า ปรับนาวิเกชั้นเน็ก -->
                            <?php
                            // if (!empty($conditions)) {
                            //     $selectedId = $employee['employeeConditionId'] ?? null;
                            //     foreach ($conditions as $c) {
                            //         $selected = ($c['employeeConditionId'] == $selectedId) ? 'selected' : '';
                            //         echo '<option value="' . $c['employeeConditionId'] . '" ' . $selected . '>' . Yii::t('app', $c['employeeConditionName']) . '</option>';
                            //     }
                            // }
                            ?>
                            <!-- <?php
                            if (count($statusTexArr) > 0) {
                                foreach ($statusTexArr as $statusId => $status): ?>
                            <option value="<?= $statusId ?>"><?= Yii::t('app', $status["statusName"]) ?>
                                <?php
                                endforeach;
                            }
                            ?> -->
                            <?php
                            if (!empty($statusTexArr)) {
                                $selectedId = $employee['employeeConditionId'] ?? null;
                                foreach ($statusTexArr as $statusId => $status) {
                                    $selected = ($statusId == $selectedId) ? 'selected' : '';
                                    echo '<option value="' . $statusId . '" ' . $selected . '>' . Yii::t('app', $status["statusName"]) . '</option>';
                                }
                            }
                            ?>
                        </select>
                    </div>

                </div>

                <div class="between-center mt-12">
                    <!-- body -->
                    <div>
                        <div class="avatar-upload" style="margin:0px">
                            <div class="avatar-preview" style="
                            background-color: white;
                            stroke-width: 1px;
                            stroke: var(--Primary-Blue---HRVC, #2580D3);
                            border-radius: 100%;
                            text-align: center;
                            cursor: pointer;
                        ">

                                <label id="imgpreview" class="upload-label" style="cursor: pointer;  display: block;">
                                    <?php
                                    if (isset($employee) && $employee["image"] != null) { ?>
                                    <img id="old-image" src="<?= Yii::$app->homeUrl . $employee['image'] ?>"
                                        class="company-group-picture" style="width: 170px; height: 170px;">
                                    <?php
                                    } else { ?>
                                    <img id="old-image" src="<?= Yii::$app->homeUrl ?>image/upload-iconimg.svg"
                                        alt="Upload Icon"> <br><br>
                                    <span id="d-up-img1">
                                        <?= Yii::t('app', 'Upload') ?> <span style="font-size: 13px; color: #666;">
                                            <?= Yii::t('app', 'or Drop') ?> </span>
                                    </span>
                                    <br>
                                    <span id="d-up-img2" style="font-size: 13px; color: #666;">
                                        <?= Yii::t('app', 'Branch Picture here') ?>
                                    </span>
                                    <?php
                                    }
                                    ?>
                                </label>
                                <!-- ปุ่มลบ + ปุ่มรีเฟรช -->
                                <div class="center-center" id="cer-action-buttons" style="
                                        position: absolute;
                                        bottom: 10px;
                                        left: 50%;
                                        transform: translateX(-50%);
                                        gap: 10px;
                                    ">
                                    <!-- ปุ่มลบ -->
                                    <div class="cycle-box-icon" style=" background-color: #fff0f0; display: none;"
                                        id="bin-file">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/binred.svg"
                                            alt="Delete"
                                            style="width: 20px;height: 20px;padding-top: 0px;margin-top: 5px;margin-left: 7px;">
                                    </div>

                                    <!-- ปุ่มรีเฟรช -->
                                    <div class="cycle-box-icon" style=" background-color: #e6f1ff; display: none;"
                                        id="refes-file">
                                        <img src="<?= Yii::$app->homeUrl ?>image/refes-blue.svg" alt="Refresh"
                                            style="width: 18px; height: 18px;">
                                    </div>
                                </div>
                                <input type="file" name="image" id="imgUpload" class="upload up upload-checklist"
                                    style="display: none;">
                            </div>
                        </div>
                        <div style="text-align: center;">
                            <span class="font-size-14 font-weight-400 text-gray">
                                <?= Yii::t('app', 'Acceptable file') ?> <br>
                                <?= Yii::t('app', 'types: JPEG & PNG') ?>
                            </span>
                        </div>
                    </div>


                    <div class="vertical-line" style="height: 379px;"></div>

                    <div class="start-center" style="width: 822px; gap: 34px;">
                        <div class="flex-center" style="gap: 37px;">
                            <div>
                                <text class="font-size-16 font-weight-500"><span class="text-danger">* </span>
                                    <?= Yii::t('app', 'System Login ID') ?>
                                </text>
                                <div class="input-group">
                                    <span class="input-group-text" style="background-color: white; border-right: none;">
                                        <img src="<?= Yii::$app->homeUrl ?>image/e-mail.svg" alt="Website"
                                            style="width: 20px; height: 20px;">
                                    </span>
                                    <input type="text" class="form-control font-size-14" id="mailId" name="mailId"
                                        placeholder="kaori@gmail.com" value="<?= $userEmployee['mailId'] ?? '' ?>"
                                        style="width: 290.59px; border-left: none;">
                                </div>
                            </div>
                            <div>
                                <text class="font-size-16 font-weight-500"><span class="text-danger">* </span>
                                    <?= Yii::t('app', 'Employee ID') ?>
                                </text>
                                <input type="text" class="form-control font-size-14" id="employeeId" name=" employeeId"
                                    placeholder="<?= Yii::t('app', 'Please assign the employee ID') ?>"
                                    value="<?= $employee['employeeId'] ?? '' ?>" style="width:  330.59px;">
                            </div>
                        </div>
                        <div class="flex-center" style="gap: 37px;">
                            <div>
                                <text class="font-size-16 font-weight-500"><span class="text-danger">* </span>
                                    <?= Yii::t('app', 'Password') ?>
                                </text>

                                <div class="input-group">
                                    <span class="input-group-text" style="background-color: white; border-right: none;">
                                        <img src="<?= Yii::$app->homeUrl ?>image/e-lock.svg" alt="Website"
                                            style="width: 20px; height: 20px;">
                                    </span>
                                    <input type="password" class="form-control font-size-14" name="password"
                                        id="password" placeholder="<?= Yii::t('app', 'Register Password here') ?>"
                                        value="<?= $userEmployee['password'] ?? '' ?>"
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
                                    <?php
                                        $flag = 'image/e-world.svg'; // default fallback flag

                                        if (!empty($employee['defaultLanguage']) && !empty($languages)) {
                                            foreach ($languages as $lang) {
                                                if ($employee['defaultLanguage'] == $lang['languageId']) {
                                                    $flag = !empty($lang['flag']) ? $lang['flag'] : 'image/e-world.svg';
                                                    break;
                                                }
                                            }
                                        }
                                        // echo $flag ;
                                    ?>

                                    <?= Yii::t('app', 'System Language Preference') ?>
                                </text>

                                <div class="input-group">
                                    <span class="input-group-text" style="background-color: white; border-right: none;">
                                        <!-- <img class="cycle-current" src="<?= Yii::$app->homeUrl ?>image/e-world.svg"
                                            id="flag-dl" alt="Website" style="width: 20px; height: 20px; border: none;"> -->
                                        <img class="cycle-current" id="flag-dl"
                                            src="<?= Yii::$app->homeUrl . htmlspecialchars($flag) ?>" alt="Website"
                                            style="width: 20px; height: 20px; border: none;">
                                    </span>

                                    <select class="form-select" style="width: 290.59px; border-left: none;"
                                        id="defaultLanguage" name="defaultLanguage" required>
                                        <option value="" disabled hidden
                                            <?= empty($employee['defaultLanguage']) ? 'selected' : '' ?>
                                            style="color: var(--Helper-Text, #8A8A8A);">
                                            <?= Yii::t('app', 'Select preferred language') ?>
                                        </option>
                                        <?php
                                        if (isset($languages) && count($languages) > 0) {
                                            foreach ($languages as $lang) {
                                                $selected = (isset($employee) && $lang['languageId'] == $employee['defaultLanguage']) ? 'selected' : '';
                                                echo '<option value="' . htmlspecialchars($lang['languageId']) . '" ' . $selected .
                                                    ' data-flag="' . htmlspecialchars($lang['flag']?? '') . '">' .
                                                    htmlspecialchars($lang['languageName'?? '']) .
                                                    '</option>';
                                            }
                                        }
                                        ?>
                                    </select>


                                </div>
                            </div>
                        </div>

                        <?php $selectedRoleId = $userRole['roleid'] ?? null; ?>

                        <div class="w-100">
                            <div class="w-100">
                                <text class="font-size-16 font-weight-500"><span class="text-danger">* </span>
                                    <?= Yii::t('app', 'System Wide Permission Level') ?></text>
                                <hr class="hr-group">
                            </div>

                            <div class="radio-wrapper">
                                <?php
                                $roles = [
                                    1 => 'Staff',
                                    2 => 'Team Leader',
                                    3 => 'HR',
                                    4 => 'Manager',
                                    5 => 'General Manager',
                                    6 => 'Admin',
                                    7 => 'System Admin'
                                ];

                                foreach ($roles as $id => $label) {
                                    $checked = ($selectedRoleId == $id) ? 'checked' : '';
                                    $htmlId = strtolower(str_replace(' ', '', $label));
                                    echo <<<HTML
                                    <div class="radio-item">
                                        <input type="radio" id="{$htmlId}" name="role" value="{$id}" required {$checked}>
                                        <span class="radio-cycle"></span>
                                        <label for="{$htmlId}">{$label}</label>
                                    </div>
                                    HTML;
                                }
                                ?>
                            </div>
                        </div>

                        <div class="w-100">
                            <div class="w-100">
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/help.svg" data-toggle="tooltip"
                                    data-placement="top" aria-label="<?= Yii::t('app', 'Module Access') ?>"
                                    data-bs-original-title="<?= Yii::t('app', 'Module Access') ?>">
                                <text class="font-size-16 font-weight-500"><span class="text-danger">* </span>
                                    <?= Yii::t('app', 'Module Access') ?>
                                </text>
                                <hr class="hr-group">
                            </div>
                            <div class="checkbox-wrapper">
                                <?php foreach ($modules as $modul) {
                                    $isChecked = in_array($modul['moduleId'], $userModuleIds) ? 'checked' : '';
                                ?>
                                <div class="checkbox-item">
                                    <input type="checkbox" id="module_<?= $modul['moduleId'] ?>" name="moduleId[]"
                                        value="<?= $modul['moduleId'] ?>" class="module-check" <?= $isChecked ?>>
                                    <span class="checkbox-cycle"></span>
                                    <label for="module_<?= $modul['moduleId'] ?>"><?= $modul['moduleName'] ?></label>
                                </div>
                                <?php } ?>

                            </div>

                        </div>
                    </div>

                </div>
            </div>

            <!-- Contact & Personal Details -->
            <div>
                <div>
                    <!-- head -->
                    <span class="font-size-16 font-weight-600">
                        <?= Yii::t('app', 'Contact & Personal Details') ?>
                    </span>
                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/help.svg" data-toggle="tooltip"
                        data-placement="top" aria-label="<?= Yii::t('app', 'Contact & Personal Details') ?>"
                        data-bs-original-title="<?= Yii::t('app', 'Contact & Personal Details') ?>">
                    <hr class="hr-group">
                </div>
                <div class="d-flex flex-column" style="gap: 40px">
                    <!-- body -->
                    <div class="row">
                        <div class="col-4 d-flex flex-column" style="gap: 12px;">
                            <text class="font-size-16 font-weight-500"><span class="text-danger">*
                                </span><?= Yii::t('app', 'Salutation') ?></text>
                            <select class="form-select" name="salutation" id="salutation" style="border-left: none;"
                                required>
                                <option value="" disabled <?= empty($employee['salutation']) ? 'selected' : '' ?> hidden
                                    style="color: var(--Helper-Text, #8A8A8A);">
                                    <?= Yii::t('app', 'Select') ?>
                                </option>
                                <option value="Mr." <?= ($employee['salutation'] ?? '') === 'Mr.' ? 'selected' : '' ?>>
                                    <?= Yii::t('app', 'Mr.') ?>
                                </option>
                                <option value="Mrs."
                                    <?= ($employee['salutation'] ?? '') === 'Mrs.' ? 'selected' : '' ?>>
                                    <?= Yii::t('app', 'Mrs.') ?>
                                </option>
                                <option value="Miss"
                                    <?= ($employee['salutation'] ?? '') === 'Miss' ? 'selected' : '' ?>>
                                    <?= Yii::t('app', 'Miss') ?>
                                </option>
                                <option value="Ms." <?= ($employee['salutation'] ?? '') === 'Ms.' ? 'selected' : '' ?>>
                                    <?= Yii::t('app', 'Ms.') ?>
                                </option>
                                <option value="Dr." <?= ($employee['salutation'] ?? '') === 'Dr.' ? 'selected' : '' ?>>
                                    <?= Yii::t('app', 'Dr.') ?>
                                </option>
                                <option value="Prof."
                                    <?= ($employee['salutation'] ?? '') === 'Prof.' ? 'selected' : '' ?>>
                                    <?= Yii::t('app', 'Prof.') ?>
                                </option>
                            </select>
                        </div>
                        <div class="col-4 d-flex flex-column" style="gap: 12px;">
                            <text class="font-size-16 font-weight-500"><span class="text-danger">* </span>
                                <?= Yii::t('app', 'Gender') ?>
                            </text>
                            <select class="form-select" name="gender" id="gender" required>
                                <option value="" disabled <?= empty($employee['gender']) ? 'selected' : '' ?> hidden
                                    style="color: var(--Helper-Text, #8A8A8A);">
                                    <?= Yii::t('app', 'Select') ?>
                                </option>
                                <option value="1" <?= ($employee['gender'] ?? '') == '1' ? 'selected' : '' ?>>
                                    <?= Yii::t('app', 'Male') ?>
                                </option>
                                <option value="2" <?= ($employee['gender'] ?? '') == '2' ? 'selected' : '' ?>>
                                    <?= Yii::t('app', 'Female') ?>
                                </option>
                            </select>
                        </div>
                        <div class="col-4 d-flex flex-column" style="gap: 12px;">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-4 d-flex flex-column" style="gap: 12px;">
                            <text class="font-size-16 font-weight-500"><span class="text-danger">* </span>
                                <?= Yii::t('app', 'First Name') ?>
                            </text>
                            <input type="text" name="employeeFirstname" id="employeeFirstname" class="form-control"
                                placeholder="<?= Yii::t('app', 'Please Write the First Name') ?>"
                                value="<?=$employee['employeeFirstname'] ?? '' ?>" required>
                        </div>
                        <div class="col-4 d-flex flex-column" style="gap: 12px;">
                            <text class="font-size-16 font-weight-500"><span class="text-danger">* </span>
                                <?= Yii::t('app', 'Last Name') ?>
                            </text>
                            <input type="text" name="employeeSurename" id="employeeSurename" class="form-control"
                                placeholder="<?= Yii::t('app', 'Please Write the Last Name') ?>"
                                value="<?=$employee['employeeSurename'] ?? '' ?>" required>
                        </div>
                        <div class="col-4 d-flex flex-column" style="gap: 12px;">
                            <text class="font-size-16 font-weight-500"><span class="text-danger">* </span>
                                <?= Yii::t('app', 'Nationality') ?>
                            </text>
                            <div class="input-group">
                                <span class="input-group-text" style="background-color: white; border-right: none;">
                                    <?php
                                        $flag = 'image/e-world.svg'; // default fallback flag

                                        if (!empty($employee['nationalityId']) && !empty($nationalities)) {
                                            foreach ($nationalities as $nation) {
                                                if ($employee['defaultLanguage'] == $nation['countryId']) {
                                                    $flag = !empty($nation['flag']) ? $nation['flag'] : 'image/e-world.svg';
                                                    break;
                                                }
                                            }
                                        }
                                        // echo $flag ;
                                    ?>
                                    <img class="cycle-current" id="flag"
                                        src="<?= Yii::$app->homeUrl . htmlspecialchars($flag) ?>" alt="Website"
                                        style="width: 20px; height: 20px; border: none;">
                                </span>

                                <select class="form-select" name="nationalityId" id="nationalityId"
                                    style="border-left: none;" required>
                                    <option value="" disabled <?= empty($employee['nationalityId']) ? 'selected' : '' ?>
                                        hidden style="color: var(--Helper-Text, #8A8A8A);">
                                        <?= Yii::t('app', 'Select Nationality') ?>
                                    </option>
                                    <?php
                                    if (isset($nationalities) && count($nationalities) > 0) {
                                        foreach ($nationalities as $nation) :
                                            $selected = ($employee['nationalityId'] ?? '') == $nation['countryId'] ? 'selected' : '';
                                    ?>
                                    <option value="<?= $nation['countryId'] ?>" data-flag="<?= $nation['flag'] ?>"
                                        <?= $selected ?>>
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
                            <text class="font-size-16 font-weight-500"><span class="text-danger">* </span>
                                <?= Yii::t('app', 'Contact Number') ?>
                            </text>
                            <input type="text" name="telephoneNumber" id="telephoneNumber" class="form-control"
                                placeholder="e.g., +66 081 091 87" value="<?=$employee['telephoneNumber'] ?? '' ?>"
                                required>
                        </div>
                        <div class="col-4 d-flex flex-column" style="gap: 12px;">
                            <text class="font-size-16 font-weight-500">
                                <?= Yii::t('app', 'Emergency Contact') ?>
                            </text>
                            <input type="text" name="emergencyTel" id="emergencyTel" class="form-control"
                                placeholder="e.g., +66 081 091 87" value="<?=$employee['emergencyTel'] ?? '' ?>">
                        </div>
                        <div class="col-4 d-flex flex-column" style="gap: 12px;">
                            <text class="font-size-16 font-weight-500">
                                <?= Yii::t('app', 'Address') ?>
                            </text>
                            <input type="text" name="address1" id="address1" class="form-control"
                                placeholder="e.g., 23 Elm Street, Apt 4B" value="<?=$employee['address1'] ?? '' ?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4 d-flex flex-column" style="gap: 12px;">
                            <text class="font-size-16 font-weight-500"><span class="text-danger">* </span>
                                <?= Yii::t('app', 'Personal Email') ?>
                            </text>
                            <div class="input-group">
                                <span class="input-group-text" style="background-color: white; border-right: none;">
                                    <img src="<?= Yii::$app->homeUrl ?>image/e-mail.svg" alt="Website"
                                        style="width: 20px; height: 20px;">
                                </span>
                                <input type="text" name="email" id="email" class="form-control"
                                    placeholder="kaori@gmail.com" style=" border-left: none;"
                                    value="<?=$employee['email'] ?? '' ?>" required>
                            </div>
                        </div>
                        <div class="col-4 d-flex flex-column" style="gap: 12px;">
                            <text class="font-size-16 font-weight-500"><span class="text-danger">* </span>
                                <?= Yii::t('app', 'Marital Status') ?>
                            </text>
                            <div class="input-group">
                                <span class="input-group-text" style="background-color: white; border-right: none;">
                                    <img src="<?= Yii::$app->homeUrl ?>image/e-world.svg" alt="Website"
                                        style="width: 20px; height: 20px;">
                                </span>
                                <select class="form-select" name="maritalStatus" id="maritalStatus"
                                    style="border-left: none;" required>
                                    <option value="" disabled <?= empty($employee['maritalStatus']) ? 'selected' : '' ?>
                                        hidden style="color: var(--Helper-Text, #8A8A8A);">
                                        <?= Yii::t('app', 'Select') ?>
                                    </option>
                                    <option value="1"
                                        <?= (isset($employee['maritalStatus']) && $employee['maritalStatus'] == 1) ? 'selected' : '' ?>>
                                        <?= Yii::t('app', 'Single') ?>
                                    </option>
                                    <option value="2"
                                        <?= (isset($employee['maritalStatus']) && $employee['maritalStatus'] == 2) ? 'selected' : '' ?>>
                                        <?= Yii::t('app', 'Married') ?>
                                    </option>
                                    <option value="3"
                                        <?= (isset($employee['maritalStatus']) && $employee['maritalStatus'] == 3) ? 'selected' : '' ?>>
                                        <?= Yii::t('app', 'Divorced') ?>
                                    </option>
                                    <option value="4"
                                        <?= (isset($employee['maritalStatus']) && $employee['maritalStatus'] == 4) ? 'selected' : '' ?>>
                                        <?= Yii::t('app', 'Widowed') ?>
                                    </option>
                                    <option value="5"
                                        <?= (isset($employee['maritalStatus']) && $employee['maritalStatus'] == 5) ? 'selected' : '' ?>>
                                        <?= Yii::t('app', 'Separated') ?>
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-4 d-flex flex-column" style="gap: 12px;">
                            <label class="font-size-16 font-weight-500"><span class="text-danger">* </span>
                                <?= Yii::t('app', 'Date of Birth') ?>
                            </label>
                            <div class="input-group" id="group-birtdate" style="position: relative;">
                                <span class="input-group-text mid-center pb-10 pt-10"
                                    style="background-color: #C3C3C3; border:0.5px solid #818181; border-radius: 36px; width: 66px; z-index: 1; height: 40px;">
                                    <img src="<?= Yii::$app->homeUrl ?>image/calendar-gray.svg" alt="Calendar"
                                        style="width: 16px; height: 16px;">
                                </span>

                                <!-- คลิกเปิด calendar -->
                                <div class="form-control" id="birthdate-select"
                                    style="border-radius: 53px; text-align: center; cursor: pointer; position: absolute; width: 100%; height: 40px;">
                                    <?= Yii::t('app', 'Select Birthday') ?>
                                    <i class="fa fa-angle-down pull-right mt-5" aria-hidden="true"></i>
                                </div>

                                <!-- input ที่ใช้ส่งค่าจริง -->
                                <input type="hidden" name="birthDate" id="birthDate"
                                    value="<?=$employee['birthDate'] ?? '' ?>">
                            </div>

                            <!-- กล่อง calendar ที่จะโชว์เมื่อกด -->
                            <div id="calendar-birtdate"
                                style="position: absolute; margin-top: 75px; padding: 10px; border: 1px solid #ddd; border-radius: 10px; background: #fff; width: 100%; z-index: 1; display: none; justify-content: center; align-items: center;">
                                <input type="date" id="calendarInput" max="<?= date('d/m/Y') ?>" class="form-control">
                            </div>
                        </div>

                    </div>

                </div>
            </div>

            <!-- Work Details -->
            <div>
                <div class="between-center">
                    <!-- head -->
                    <div>
                        <span class="font-size-16 font-weight-600">
                            <?= Yii::t('app', 'Work Details') ?>
                        </span>
                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/help.svg" data-toggle="tooltip"
                            data-placement="top" aria-label="<?= Yii::t('app', 'Work Details') ?>"
                            data-bs-original-title="<?= Yii::t('app', 'Work Details') ?>">
                    </div>
                    <div>
                        <span class="text-gray font-size-13 font-weight-400 mr-12">
                            <?= Yii::t('app', 'Can’t find the company?') ?></span>
                        <a href="<?= Yii::$app->homeUrl ?>setting/company/create/<?= ModelMaster::encodeParams(['groupId' => $groupId]) ?>"
                            class="text-blue font-size-13 font-weight-500">
                            <?= Yii::t('app', 'Register Company Here') ?> <img
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
                                </span>
                                <?= Yii::t('app', 'Select Company') ?>
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/help.svg" data-toggle="tooltip"
                                    data-placement="top" aria-label="<?= Yii::t('app', 'Select Company') ?>"
                                    data-bs-original-title="<?= Yii::t('app', 'Select Company') ?>">
                            </text>
                            <div class="input-group">
                                <select class="form-select" id="companySelectId" name="companyId"
                                    style="appearance: none; background-image: none;">
                                    <option value=""><?= Yii::t('app', 'Which Company your are is working in ? ') ?>
                                    </option>
                                    <?php if (isset($companies) && count($companies) > 0): ?>
                                    <?php foreach ($companies as $c): ?>
                                    <option value="<?= $c['companyId'] ?>" data-img="<?= $c['picture'] ?>"
                                        <?= (isset($companyId) && $companyId == $c['companyId']) ? 'selected' : '' ?>>
                                        <?= $c['companyName'] ?>
                                    </option>
                                    <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                                <input type="hidden" name="companyIdValue" id="">
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
                                <?= Yii::t('app', 'Select Branch') ?>
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/help.svg" data-toggle="tooltip"
                                    data-placement="top" aria-label="<?= Yii::t('app', 'Select Branch') ?>"
                                    data-bs-original-title="<?= Yii::t('app', 'Select Branch') ?>">
                            </text>
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
                                <?= Yii::t('app', 'Select Department') ?>
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/help.svg" data-toggle="tooltip"
                                    data-placement="top" aria-label="<?= Yii::t('app', 'Select Department') ?>"
                                    data-bs-original-title="<?= Yii::t('app', 'Select Department') ?>">
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
                                <?= Yii::t('app', 'Select Team') ?>
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/help.svg" data-toggle="tooltip"
                                    data-placement="top" aria-label="<?= Yii::t('app', 'Select Team') ?>"
                                    data-bs-original-title="<?= Yii::t('app', 'Select Team') ?>">
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
                                <input type="hidden" name="employeeTeamId" id="employeeTeamId"
                                    value="<?= isset($employee['teamId']) ? $employee['teamId'] : '' ?>">

                            </div>
                        </div>
                        <div class="col-4 d-flex flex-column" style="gap: 12px;">
                            <text class="font-size-16 font-weight-500"><span class="text-danger">* </span>
                                <?= Yii::t('app', 'Work Email') ?>
                            </text>
                            <div class="input-group">
                                <span class="input-group-text" style="background-color: white; border-right: none;">
                                    <img src="<?= Yii::$app->homeUrl ?>image/e-mail.svg" alt="Website"
                                        style="width: 20px; height: 20px;">
                                </span>
                                <input type="text" style="border-left: none;" name="companyEmail" id="companyEmail"
                                    class="form-control" placeholder="kaori@gmail.com"
                                    value="<?= isset($employee['companyEmail']) ? $employee['companyEmail'] : '' ?>"
                                    required>
                            </div>
                        </div>

                        <div class="col-4 d-flex flex-column" style="gap: 12px;">
                            <label class="font-size-16 font-weight-500">
                                <span class="text-danger">* </span>
                                <?= Yii::t('app', 'Hiring Date') ?>
                            </label>
                            <div class="input-group" id="group-hiringdate" style="position: relative;">
                                <span class="input-group-text mid-center pb-10 pt-10" id="calendar-icon-hiring"
                                    style="background-color: #C3C3C3; border:0.5px solid #818181; border-radius: 36px; width: 66px; z-index: 1; height: 40px;">
                                    <img src="<?= Yii::$app->homeUrl ?>image/calendar-gray.svg" alt="Calendar"
                                        id="calendar-img-hiring" style="width: 16px; height: 16px;">
                                </span>

                                <div class="form-control" id="hiring-select"
                                    style="border-radius: 53px; text-align: center; cursor: pointer; position: absolute; width: 100%; height: 40px;">
                                    <?= Yii::t('app', 'Select hiring Date') ?>
                                    <i class="fa fa-angle-down pull-right mt-5" aria-hidden="true"></i>
                                </div>

                                <input type="hidden" name="hiringDate" id="hiringDate"
                                    value="<?= isset($employee['hiringDate']) ? $employee['hiringDate'] : '' ?>">
                            </div>

                            <div id="calendar-hiringdate"
                                style="position: absolute; margin-top: 75px; padding: 10px; border: 1px solid #ddd; border-radius: 10px; background: #fff; width: 100%; z-index: 1; display: none; justify-content: center; align-items: center;">
                                <input type="date" id="calendarInputHiring" max="<?= date('d/m/Y') ?>"
                                    class="form-control">
                            </div>
                        </div>


                    </div>

                    <div class="row">

                        <div class="col-4 d-flex flex-column" style="gap: 12px;">
                            <div style="display: flex;  align-items: center; gap: 5px;">
                                <span class="text-danger">* </span>
                                <label class="switch">
                                    <input type="checkbox" id="override-probation-employee"
                                        <?= (isset($employee['overrideProbationEmployee']) && $employee['overrideProbationEmployee'] == 1) ? 'checked' : '' ?>>
                                    <span class="slider round"></span>
                                </label>
                                <input type="hidden" name="overrideProbationEmployee"
                                    id="override-probation-employee-hidden" value="1">

                                <label class="font-size-16 font-weight-500">
                                    <?= Yii::t('app', 'Probation Period') ?>
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
                                    <?= Yii::t('app', 'Select the term') ?>
                                    <i class="fa fa-angle-down pull-right mt-5" aria-hidden="true"></i>
                                </div>
                                <!-- hidden inputs เพื่อเก็บค่า month และ year -->
                                <input type="hidden" id="fromDate" name="fromDate"
                                    value="<?= isset($employee['fromDate']) ? $employee['fromDate'] : '' ?>" required>
                                <input type="hidden" id="toDate" name="toDate"
                                    value="<?= isset($employee['toDate']) ? $employee['toDate'] : '' ?>" required>

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

            <!-- Job Description -->
            <div>
                <div>
                    <!-- head -->
                    <span class="font-size-16 font-weight-600">
                        <?= Yii::t('app', 'Job Description') ?>
                    </span>
                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/help.svg" data-toggle="tooltip"
                        data-placement="top" aria-label="<?= Yii::t('app', 'Job Description') ?>"
                        data-bs-original-title="<?= Yii::t('app', 'Job Description') ?>">
                    <hr class="hr-group">
                </div>
                <div>
                    <!-- body -->
                    <div class="row">
                        <div class="col-4 d-flex flex-column" style="gap: 12px;">
                            <label class="font-size-16 font-weight-500">
                                <span class="text-danger">*</span>
                                <?= Yii::t('app', 'Employee’s Title') ?>
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/help.svg" data-toggle="tooltip"
                                    data-placement="top" aria-label="<?= Yii::t('app', 'Employee’s Title') ?>"
                                    data-bs-original-title="<?= Yii::t('app', 'Employee’s Title') ?>">
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

                                    <input type="hidden" name="employeeTitleId" id="employeeTitleId"
                                        value="<?= isset($employee['titleId']) ? $employee['titleId'] : '' ?>">

                            </div>
                        </div>

                        <div class="col-8 d-flex justify-content-end align-items-end">
                            <a id="edit-job" href="" class="text-blue font-size-13 font-weight-500"
                                style="display: none;">
                                <?= Yii::t('app', 'Edit Job Description here') ?>
                                <img src="<?= Yii::$app->homeUrl ?>image/see-all.svg" alt="icon"
                                    style="cursor: pointer;">
                            </a>
                        </div>
                    </div>


                    <div id="descriptionTitle" class="alert bg-white mt-22">
                        <!-- ตอนยังไม่เลือก -->
                        <div class="create-crad-company" id="no-existing" style="background-color: #F9F9F9;">
                            <span class="font-size-15 font-weight-700 ">
                                <?= Yii::t('app', 'Job Description has not been selected yet!') ?>
                            </span>
                            <span class="font-size-12 font-weight-400 font-gray">
                                <?= Yii::t('app', 'Select a job description template
                                from the list, and it will
                                appear here.') ?>
                            </span>
                        </div>

                    </div>
                </div>

                <!--  Attachments & Remarks -->
                <div>
                    <div>
                        <!-- head -->
                        <span class="font-size-16 font-weight-600">
                            <?= Yii::t('app', 'Attachments & Remarks') ?>
                        </span>
                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/help.svg" data-toggle="tooltip"
                            data-placement="top" aria-label="<?= Yii::t('app', 'Attachments & Remarks') ?>"
                            data-bs-original-title="<?= Yii::t('app', 'Attachments & Remarks') ?>">
                        <hr class="hr-group">
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-12 ">
                            <span class="font-size-14 font-weight: 500;">
                                <?= Yii::t('app', 'Relevant Files') ?>
                            </span>

                            <div class="col-lg-11 mt-5 mb-24">
                                <div id="upload-file1" class="form-control" <?php if($resumeFileName){
                                ?> style="border: 1px solid var(--Stroke-Bluish-Gray, #BBCDDE);" <?php }else{ ?>
                                    style="border:1.22px dashed var(--Stroke-Bluish-Gray, #BBCDDE) " <?php } ?>>
                                    <div class="row">
                                        <div class="col-lg-2 center-center">
                                            <?php
                                                switch ($resumeExtension) {
                                                    case 'doc':
                                                        $iconFile = 'doc-file.svg';
                                                        break;
                                                    case 'mp4':
                                                        $iconFile = 'mp4-file.svg';
                                                        break;
                                                    case 'picture':
                                                        $iconFile = 'picture-file.svg';
                                                        break;
                                                    case 'file':
                                                        $iconFile = 'file-file.svg';
                                                        break;
                                                    case 'xml':
                                                        $iconFile = 'xml-file.svg';
                                                        break;
                                                    case 'ai':
                                                        $iconFile = 'ai-file.svg';
                                                        break;
                                                    case 'pds':
                                                        $iconFile = 'pds-file.svg';
                                                        break;
                                                    case 'pptx':
                                                        $iconFile = 'pptx-file.svg';
                                                        break;
                                                    case 'eps':
                                                        $iconFile = 'eps-file.svg';
                                                        break;
                                                    case 'zip':
                                                        $iconFile = 'zip-file.svg';
                                                        break;
                                                    case 'txt':
                                                        $iconFile = 'txt-file.svg';
                                                        break;
                                                    case 'pdf':
                                                        $iconFile = 'pdf-file.svg';
                                                        break;
                                                    case 'xlsx':
                                                        $iconFile = 'ex-file.svg';
                                                        break;
                                                    default:
                                                        $iconFile = 'file-big.svg'; // ไอคอน default
                                                }
                                                ?>
                                            <img id="icon-file1" src="<?= Yii::$app->homeUrl ?>image/<?= $iconFile ?>"
                                                alt="icon" style="width: 40px; height: 40px;">

                                        </div>
                                        <div id="file-uplode-name1" class="col-lg-6 col-md-6 col-12"
                                            style="border-right:lightgray solid thin;">
                                            <?php
                                            if($resumeFileName){
                                            ?>
                                            <label class="font-size-16 font-weight-600"
                                                for="name"><?=$resumeFileName?></label>
                                            <div class="text-secondary text-gray font-size-14">
                                                <span class="text-gray font-size-12"></span>
                                            </div>
                                            <?php
                                            }else{
                                            ?>
                                            <label class="text-gray font-size-16 font-weight-500" for="resume">
                                                <?= Yii::t('app', 'Upload Resume/CV here') ?>
                                            </label>
                                            <div class="text-secondary text-gray font-size-14">
                                                <span class="text-gray font-size-12">
                                                    <?= Yii::t('app', 'Supported - pdf, .doc, .docx') ?>
                                                </span>
                                            </div>
                                            <?php
                                            }
                                            ?>
                                            <div id="filename-display1" class="font-size-16 font-weight-600 mt-2"></div>
                                        </div>
                                        <div id="file-edit1"
                                            class="col-lg-4 d-flex justify-content-center align-items-center gap-3">
                                            <?php
                                            if($resumeFileName){
                                            ?>
                                            <a class="no-underline" href="#" onclick="viewFile(1); return false;">
                                                <img id="eye-file1"
                                                    src="<?= Yii::$app->homeUrl ?>images/icons/Settings/eye.svg"
                                                    alt="icon" style="width: 23px; height: 23px;">
                                            </a>
                                            <input type="hidden" id="resumePath" value="<?=$resumePath?>">
                                            <a class="no-underline " href="#" onclick="removeFile(1); return false;">
                                                <img id="bin-file1" class="mt-5 ml-9"
                                                    src="<?= Yii::$app->homeUrl ?>images/icons/Settings/binred.svg"
                                                    alt="icon" style="width: 28px; height: 28px;">
                                            </a>
                                            <a class="no-underline " href="#" onclick="resetUpload(1); return false;">
                                                <img id="refes-file1"
                                                    src="<?= Yii::$app->homeUrl ?>image/refes-blue.svg" alt="icon"
                                                    style="width: 18px; height: 18px;">
                                            </a>
                                            <?php
                                            }else{
                                            ?>

                                            <label id="resume-btn" for="resume"
                                                class="text-blue font-size-16 font-weight-600" style="cursor: pointer;">
                                                <?= Yii::t('app', 'Upload') ?>
                                                <img src="<?= Yii::$app->homeUrl ?>image/file-up-blue.svg" alt="icon"
                                                    style="width: 16px; height: 16px;">
                                            </label>
                                            <span class="ml-5 text-success" id="resume-check" style="display:none;">
                                                <i class="fa fa-check" aria-hidden="true"></i>
                                            </span>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                        <input id="resume" style="display:none;" type="file" name="resume"
                                            onchange="checkUploadFile(1)">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-11">
                                <div id="upload-file2" class="form-control" <?php if($agreementFileName){
                                ?> style="border: 1px solid var(--Stroke-Bluish-Gray, #BBCDDE);" <?php }else{ ?>
                                    style="border:1.22px dashed var(--Stroke-Bluish-Gray, #BBCDDE) " <?php } ?>>
                                    <div class="row">
                                        <div class="col-lg-2 center-center">
                                            <!-- <?php
                                            if($agreementExtension == 'pdf'){
                                            ?>
                                            <img id="icon-file2" src="<?= Yii::$app->homeUrl ?>image/pdf-file.svg"
                                                alt="icon" style="width: 40px; height: 40px;">
                                            <?php
                                            }else if($agreementExtension == 'xlsx'){
                                            ?>
                                            <img id="icon-file2" src="<?= Yii::$app->homeUrl ?>image/ex-file.svg"
                                                alt="icon" style="width: 40px; height: 40px;">
                                            <?php
                                            }else{
                                            ?>
                                            <img id="icon-file2" src="<?= Yii::$app->homeUrl ?>image/file-big.svg"
                                                alt="icon" style="width: 40px; height: 40px;">
                                            <?php
                                            }
                                            ?> -->
                                            <?php
                                                switch ($agreementExtension) {
                                                    case 'doc':
                                                        $iconFile = 'doc-file.svg';
                                                        break;
                                                    case 'mp4':
                                                        $iconFile = 'mp4-file.svg';
                                                        break;
                                                    case 'picture':
                                                        $iconFile = 'picture-file.svg';
                                                        break;
                                                    case 'file':
                                                        $iconFile = 'file-file.svg';
                                                        break;
                                                    case 'xml':
                                                        $iconFile = 'xml-file.svg';
                                                        break;
                                                    case 'ai':
                                                        $iconFile = 'ai-file.svg';
                                                        break;
                                                    case 'pds':
                                                        $iconFile = 'pds-file.svg';
                                                        break;
                                                    case 'pptx':
                                                        $iconFile = 'pptx-file.svg';
                                                        break;
                                                    case 'eps':
                                                        $iconFile = 'eps-file.svg';
                                                        break;
                                                    case 'zip':
                                                        $iconFile = 'zip-file.svg';
                                                        break;
                                                    case 'txt':
                                                        $iconFile = 'txt-file.svg';
                                                        break;
                                                    case 'pdf':
                                                        $iconFile = 'pdf-file.svg';
                                                        break;
                                                    case 'xlsx':
                                                        $iconFile = 'ex-file.svg';
                                                        break;
                                                    default:
                                                        $iconFile = 'file-big.svg'; // ไอคอน default
                                                }
                                                ?>
                                            <img id="icon-file2" src="<?= Yii::$app->homeUrl ?>image/<?= $iconFile ?>"
                                                alt="icon" style="width: 40px; height: 40px;">
                                        </div>
                                        <div id="file-uplode-name2" class="col-lg-6 col-md-6 col-12"
                                            style="border-right:lightgray solid thin;">
                                            <?php
                                            if($agreementFileName){
                                            ?>
                                            <label class="font-size-16 font-weight-600"
                                                for="name"><?=$agreementFileName?></label>
                                            <div class="text-secondary text-gray font-size-14">
                                                <span class="text-gray font-size-12"></span>
                                            </div>
                                            <?php
                                            }else{
                                            ?>
                                            <label class="text-gray font-size-16 font-weight-500" for="name">
                                                <?= Yii::t('app', 'Upload Agreement Here') ?>
                                            </label>
                                            <div class="text-secondary text-gray  font-size-14">
                                                <span class="text-gray font-size-12">
                                                    <?= Yii::t('app', 'Supported - pdf, .doc,
                                                    .docx') ?>
                                                </span>
                                            </div>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                        <div id="file-edit2"
                                            class="col-lg-4 d-flex justify-content-center align-items-center gap-3">

                                            <?php
                                            if($agreementFileName){
                                            ?>
                                            <a class="no-underline " href="#" onclick="viewFile(2); return false;">
                                                <img id="eye-file2"
                                                    src="<?= Yii::$app->homeUrl ?>images/icons/Settings/eye.svg"
                                                    alt="icon" style="width: 23px; height: 23px;">
                                            </a>
                                            <input type="hidden" id="agreementPath" value="<?=$agreementPath?>">
                                            <a class="no-underline " href="#" onclick="removeFile(2); return false;">
                                                <img id="bin-file2" class="mt-5 ml-9"
                                                    src="<?= Yii::$app->homeUrl ?>images/icons/Settings/binred.svg"
                                                    alt="icon" style="width: 28px; height: 28px;">
                                            </a>
                                            <a class="no-underline " href="#" onclick="resetUpload(2); return false;">
                                                <img id="refes-file2"
                                                    src="<?= Yii::$app->homeUrl ?>image/refes-blue.svg" alt="icon"
                                                    style="width: 18px; height: 18px;">
                                            </a>
                                            <?php
                                            }else{
                                            ?>
                                            <label id="agreement-btn" type="button" for="agreement"
                                                class="text-blue font-size-16 font-weight-600 ">
                                                <?= Yii::t('app', 'Upload') ?>
                                                <img src="<?= Yii::$app->homeUrl ?>image/file-up-blue.svg" alt="icon"
                                                    style="width: 16px; height: 16px;">
                                            </label>
                                            <span class="ml-5 text-success" id="agreement-check" style="display:none;">
                                                <i class="fa fa-check" aria-hidden="true"></i>
                                            </span>
                                            <?php
                                            }
                                            ?>
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
                                <?= Yii::t('app', 'About the Employee') ?>
                            </div>
                            <div class="col-12 mt-5">
                                <textarea class="form-control" name="remark"
                                    placeholder="Add any relevant details about the employee here"
                                    style="height:276px;"><?= isset($employee['remark']) ? $employee['remark'] : '' ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Certificates and Skill Tags -->
                <div>
                    <div>
                        <!-- head -->
                        <span class="font-size-16 font-weight-600">
                            <?= Yii::t('app', 'Certificates and Skill Tags') ?>
                        </span>
                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/help.svg" data-toggle="tooltip"
                            data-placement="top" aria-label="<?= Yii::t('app', 'Certificates and Skill Tags') ?>"
                            data-bs-original-title="<?= Yii::t('app', 'Certificates and Skill Tags') ?>">
                        <hr class="hr-group">
                    </div>

                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-12 " style="border-right:lightgray solid thin;">
                            <span class=" font-size-16 font-weight-500">
                                <span class="text-danger">* </span>
                                <?= Yii::t('app', 'Certificate Achievements') ?>
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/help.svg" data-toggle="tooltip"
                                    data-placement="top" aria-label="<?= Yii::t('app', 'Certificate Achievements') ?>"
                                    data-bs-original-title="<?= Yii::t('app', 'Certificate Achievements') ?>">
                            </span>
                            <!-- เพิ่มรูป -->
                            <ul id="schedule-list" class="list-unstyled small  m-0 p-0 mt-12">
                                <!-- พอแอดแลวให้เอาข้อมูลจากอาเรย์ มาแสดงตรงนี้   -->
                            </ul>
                            <button type="button" class="center-center bg-white mt-12"
                                style="padding: 13px 20px; height: 40px; width: 100%; border-radius: 5px; border: 0.5px solid #CBD5E1;"
                                onclick="openPopupModalCertificate()">
                                <span class="text-blue mr-6" style="font-weight: 600; font-size: 14px;">
                                    <?= Yii::t('app', 'Add Certificate') ?>
                                </span>
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/plus-blue.svg" alt="LinkedIn"
                                    style="width: 20px; height: 20px;">
                            </button>
                        </div>

                        <div class="col-lg-6 col-md-6 col-12 pl-40">
                            <div class="company-group-edit bg-white">
                                <span class=" font-size-16 font-weight-500">
                                    <span class="text-danger">* </span>
                                    <?= Yii::t('app', 'Skill Tags') ?>
                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/help.svg"
                                        data-toggle="tooltip" data-placement="top"
                                        aria-label="<?= Yii::t('app', 'Certificates and Skill Tags') ?>"
                                        data-bs-original-title="<?= Yii::t('app', 'Certificates and Skill Tags') ?>">
                                </span>
                                <div class="input-group mt-12">
                                    <span class="input-group-text" style="background-color: white; border-right: none;">
                                        <img id="skill-plus"
                                            src="<?= Yii::$app->homeUrl ?>images/icons/Settings/plus-gray.svg"
                                            alt="Website" style="width: 20px; height: 20px;">
                                    </span>
                                    <input type="text" name="skill" id="skill" class="form-control"
                                        style=" border-left: none;  border-right: none;"
                                        placeholder="<?= Yii::t('app', 'e.g., Python, Data Analysis, Communication') ?>">
                                    <span class="input-group-text" id="enterHint"
                                        style="background-color: #ffff; border-left: none; ">
                                        <div class="city-crad-company" id="hintText"
                                            style="background: var(--HRVC---Light-Text, #94989C);"><img
                                                src="<?= Yii::$app->homeUrl ?>image/enter-white.svg"
                                                style="width: 24px; height: 24px;">
                                            <span class="font-white">
                                                <?= Yii::t('app', 'Enter to add') ?>
                                            </span>
                                        </div>
                                    </span>
                                </div>

                                <div class="company-group-edit mt-20" id="skill-box"
                                    style="height: 141px; padding:10px; border: 1.22px dashed var(--Stroke-Bluish-Gray, #BBCDDE); background: var(--HRVC---Light-Text, #F9F9F9);">
                                    <div class="mid-center mt-30" id="skill-detail">
                                        <span class=" font-size-16 font-weight-600">
                                            <?= Yii::t('app', 'No skill tags has been added') ?>
                                        </span>
                                        <span class=" font-size-12 font-weight-400">
                                            <?= Yii::t('app', 'Please type in the skill box and press enter to add the skill tags for this employee') ?>
                                        </span>
                                    </div>

                                    <div id="skillTags"></div>
                                    <input type="hidden" name="skills" id="skillsHidden" required>
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
                            <?= Yii::t('app', 'Others') ?>
                        </span>
                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/help.svg" data-toggle="tooltip"
                            data-placement="top" aria-label="<?= Yii::t('app', 'Others') ?>"
                            data-bs-original-title="<?= Yii::t('app', 'Others') ?>">
                        <hr class="hr-group">
                    </div>
                    <div>
                        <!-- body -->
                        <div class="row">
                            <div class="col-4 d-flex flex-column" style="gap: 12px;">
                                <text class="font-size-16 font-weight-500"><span class="text-danger">*</span>
                                    <?= Yii::t('app', 'Primary Language Spoken') ?>
                                </text>
                                <div class="input-group">
                                    <span class="input-group-text" style="background-color: white; border-right: none;">
                                        <?php
                                            $flag = 'image/e-world.svg'; // default fallback flag

                                            if (!empty($userLanguage[0]['languageId']) && !empty($mainLanguage)) {
                                                foreach ($mainLanguage as $lang) {
                                                    if ($userLanguage[0]['languageId'] == $lang['LanguageId']) {
                                                        $flag = !empty($lang['flag']) ? $lang['flag'] : 'image/e-world.svg';
                                                        break;
                                                    }
                                                }
                                            }
                                        ?>
                                        <!-- <img class="cycle-current" id="flag"
                                        src="<?= Yii::$app->homeUrl . htmlspecialchars($flag) ?>" alt="Website"
                                        style="width: 20px; height: 20px; border: none;"> -->
                                        <img class="cycle-current" id="flag-ml"
                                            src="<?= Yii::$app->homeUrl . htmlspecialchars($flag) ?>" alt="Website"
                                            style="width: 20px; height: 20px; border: none;">
                                    </span>
                                    <?php
                                    // ดึงค่าภาษาเริ่มต้นจาก array ตำแหน่งที่ 0 (ถ้ามี)
                                    $selectedLanguageId = isset($userLanguage[0]['languageId']) ? $userLanguage[0]['languageId'] : '';
                                    ?>

                                    <select class="form-select" style="width: 290.59px; border-left: none;"
                                        id="mainLanguage" name="mainLanguage" required="">
                                        <option value="" disabled <?= $selectedLanguageId ? '' : 'selected' ?> hidden
                                            style="color: var(--Helper-Text, #8A8A8A); ">
                                            <?= Yii::t('app', 'Select preferred language') ?>
                                        </option>
                                        <?php
                                        if (!empty($mainLanguage)) {
                                            foreach ($mainLanguage as $lang) {
                                                $languageId = htmlspecialchars($lang['LanguageId'] ?? '');
                                                $flag = htmlspecialchars($lang['flag'] ?? '');
                                                $name = htmlspecialchars($lang['name'] ?? '');

                                                $selected = ($lang['LanguageId'] == ($selectedLanguageId ?? null)) ? 'selected' : '';

                                                echo '<option value="' . $languageId . '" ' . $selected .
                                                    ' data-flag="' . $flag . '">' .
                                                    $name .
                                                    '</option>';
                                            }
                                        }
                                        ?>
                                    </select>

                                </div>
                            </div>
                            <div class="col-4 d-flex flex-column" style="gap: 12px;">
                                <text class="font-size-16 font-weight-500"><span class="text-danger">* </span>
                                    <?= Yii::t('app', 'Level of Proficiency') ?>
                                </text>
                                <?php
                                // ดึงค่าภาษาเริ่มต้นจาก array ตำแหน่งที่ 0 (ถ้ามี)
                                $selectedLanguageId = isset($userLanguage[0]['lavel']) ? $userLanguage[0]['lavel'] : '';
                                ?>
                                <select class="form-select" name="lavelLanguage" id="lavelLanguage" required>
                                    <option value="" disabled <?= $selectedLanguageId ? '' : 'selected' ?> hidden
                                        style="color: var(--Helper-Text, #8A8A8A);">
                                        <?= Yii::t('app', 'Select') ?>
                                    </option>
                                    <option value="1" <?= $selectedLanguageId == '1' ? 'selected' : '' ?>>
                                        <?= Yii::t('app', 'Beginner') ?>
                                    </option>
                                    <option value="2" <?= $selectedLanguageId == '2' ? 'selected' : '' ?>>
                                        <?= Yii::t('app', 'Elementary') ?>
                                    </option>
                                    <option value="3" <?= $selectedLanguageId == '3' ? 'selected' : '' ?>>
                                        <?= Yii::t('app', 'Intermediate') ?>
                                    </option>
                                    <option value="4" <?= $selectedLanguageId == '4' ? 'selected' : '' ?>>
                                        <?= Yii::t('app', 'Upper
                                        Intermediate') ?>
                                    </option>
                                    <option value="5" <?= $selectedLanguageId == '5' ? 'selected' : '' ?>>
                                        <?= Yii::t('app', 'Advanced') ?>
                                    </option>
                                    <option value="6" <?= $selectedLanguageId == '6' ? 'selected' : '' ?>>
                                        <?= Yii::t('app', 'Fluent') ?>
                                    </option>
                                    <option value="7" <?= $selectedLanguageId == '7' ? 'selected' : '' ?>>
                                        <?= Yii::t('app', 'Native') ?>
                                    </option>
                                </select>


                            </div>
                            <div class="col-4 d-flex flex-column" style="gap: 12px;">
                                <text class="font-size-16 font-weight-500">
                                    <?= Yii::t('app', 'Linkedin Link') ?>
                                </text>
                                <div class="input-group">
                                    <span class="input-group-text "
                                        style="background-color: white; border-right: none;">
                                        <img src="<?= Yii::$app->homeUrl ?>image/in-image.svg" alt="LinkedIn"
                                            style="width: 20px; height: 20px;">
                                    </span>
                                    <input type="text" style="border-left: none;" class="form-control " name="linkedin"
                                        value="<?= isset($employee['linkedin']) ? $employee['linkedin'] : '' ?>"
                                        placeholder="<?= Yii::t('app', 'LinkedIn link here') ?>">
                                </div>
                            </div>

                            <div class="row mt-33">
                                <div class="col-4 d-flex flex-column" style="gap: 12px;">
                                    <span class=" font-size-16 font-weight-500">
                                        <?= Yii::t('app', 'Additional Languages') ?>
                                    </span>
                                    <div id="al">

                                    </div>
                                    <button type="button" id="addCertificateBtn" class="center-center bg-white"
                                        style="padding: 13px 20px; height: 40px; width: 100%; border-radius: 5px; border: 0.5px solid #CBD5E1;"
                                        onclick="addAdditionalLanguage()">
                                        <span class="text-blue mr-6" style="font-weight: 600; font-size: 14px;">
                                            <?= Yii::t('app', 'Add More') ?>
                                        </span>
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/plus-blue.svg"
                                            alt="LinkedIn" style="width: 20px; height: 20px;">
                                    </button>

                                </div>
                                <div class="col-4 d-flex flex-column" style="gap: 12px;">
                                    <span class="font-size-16 font-weight-500">
                                        <?= Yii::t('app', 'Additional Languages Level') ?>
                                    </span>

                                    <div id="ald">
                                        <span id="lockId-1"
                                            class="input-group-text d-flex justify-content-center align-items-center mt-12"
                                            style="background-color: #e9ecef; height: 40px;">
                                            <?= Yii::t('app', 'Add additional Language First') ?>
                                        </span>
                                    </div>

                                </div>
                                <div class="col-4 d-flex flex-column" style="gap: 12px;">
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- กล่องรวม checkbox และปุ่ม -->
                <div class="d-flex flex-column align-items-end w-100" style="gap: 20px;">

                    <!-- ✅ Checkbox: Email login -->
                    <div class="d-flex justify-content-end align-items-center" style="gap: 10px;">
                        <input type="checkbox" id="sendEmail" name="sendEmail" value="1">
                        <label for="sendEmail" class="mb-0">
                            <?= Yii::t('app', 'Email login details to employee') ?>
                        </label>
                    </div>

                    <!-- ✅ ปุ่ม Cancel + Save -->
                    <div class="d-flex justify-content-end align-items-center" style="gap: 10px;">
                        <a href="javascript:history.back()" style="text-decoration: none;">
                            <button type="button" class="btn-cancel-group">
                                <?= Yii::t('app', 'Cancel') ?>
                            </button>
                        </a>
                        <?php if($statusfrom == 'Update'){?>
                        <a href="<?= Yii::$app->homeUrl ?>setting/employee/delete-employee/<?= ModelMaster::encodeParams(['employeeId' => $employeeId, 'userId' => $userId]) ?>"
                            class="btn btn-delete-custom d-flex align-items-center"
                            onmouseover="this.querySelector('.pim-icon').src='<?= Yii::$app->homeUrl ?>images/icons/Settings/binwhite.svg'"
                            onmouseout="this.querySelector('.pim-icon').src='<?= Yii::$app->homeUrl ?>images/icons/Settings/binred.svg'">
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/binred.svg" alt="Delete"
                                class="pim-icon me-1" style="width: 14px; height: 14px;">
                            <?= Yii::t('app', 'Delete') ?>
                        </a>
                        <button type="submit" class="btn-save-group">
                            <img src="<?= Yii::$app->homeUrl ?>image/refece-whiet.svg" alt="Save Icon"
                                style="width: 20px; height: 20px;">
                            <?= Yii::t('app', 'Update') ?>
                        </button>
                        <?php }else{?>
                        <a style="text-decoration: none;">
                            <button type="button" id="saveDraftBtn" class="btn-cancel-group w-100">
                                <?= Yii::t('app', 'Save as Draft') ?>
                                <img src="<?= Yii::$app->homeUrl ?>image/draft.svg">
                            </button>
                        </a>
                        <button type="submit" class="btn-save-group">
                            <?= Yii::t('app', 'Save') ?>
                            <img src="<?= Yii::$app->homeUrl ?>image/save-icon.svg" alt="Save Icon"
                                style="width: 20px; height: 20px;">
                        </button>
                        <?php }?>
                    </div>

                </div>

            </div>
        </div>
    </div>
    <input type="hidden" id="emId" name="emId" value="<?= isset($employeeId) ? $employeeId : '' ?>">
    <input type="hidden" id="userId" name="userId" value="<?= isset($userId) ? $userId : '' ?>">

    <input type="hidden" id="certificateDataHidden" name="certificateData">
    <input type="hidden" id="cerDate" name="cerDate" value="0">
    <input type="hidden" id="darf" name="darf">

    <!-- container สำหรับเก็บ input ไฟล์ทั้งหมด -->
    <div id="imgInputsContainer"></div>
    <div id="fileInputsContainer"></div>
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
    let uploadedCerFile = null; // สำหรับ cerimage
    let uploadedCertificateFiles = []; // สำหรับ certificate (multiple files)
    let certificates = [];

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
            iconDiv.classList.remove('cycle-current-gray');
            iconDiv.classList.add('cycle-current-blue');

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
                    const el = document.getElementById('no-existing');
                    if (el) {
                        el.style.display = 'none';
                    }
                    const editJob = document.getElementById('edit-job');
                    editJob.style.display = 'block';
                    editJob.href =
                        `<?= Yii::$app->homeUrl ?>setting/title/create/${data.paramId}`;

                    // สร้าง HTML ใหม่สำหรับรายละเอียด
                    const html = `
                            <div>
                                <span class="font-size-20 font-weight-600">${data.titleName}</span>
                            </div>
                            <div class="center-center" style="gap: 63px; margin: 36px 29px;">
                                <div class="row" style="border-right:lightgray solid thin; width: 50%;"  >
                                    <div class="row mb-36">
                                        <span class="font-size-16 font-weight-500 mb-22">Purpose of the Job</span>
                                        <span class="font-size-14 font-weight-400">${data.purpose.replace(/\n/g, '<br>')}</span>
                                    </div>
                                    <div class="row">
                                        <span class="font-size-16 font-weight-500 mb-22">Core Responsibility</span>
                                        <span class="font-size-14 font-weight-400">${data.jobDescription.replace(/\n/g, '<br>')}</span>
                                    </div>
                                </div>
                                <div class="row" style="width: 50%;>
                                    <span class="font-size-16 font-weight-500 mb-22">Key Responsibility</span>
                                    <span class="font-size-14 font-weight-400">${data.keyResponsibility.replace(/\n/g, '<br>')}</span>
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
                const departmentSelect = document.querySelector('[name="departmentId"]');
                departmentSelect.innerHTML =
                    '<option value="" disabled selected hidden><?= Yii::t("app", "In which Department?") ?></option>';

                if (Array.isArray(data)) {
                    data.forEach(branch => {
                        const option = document.createElement('option');
                        option.value = branch.departmentId;
                        option.text = branch.departmentName;
                        departmentSelect.appendChild(option);
                    });
                }
            });
    });


    $(document).on('change', '#cerimage', function(e) {
        const file = e.target.files[0];
        if (file) {
            uploadedCerFile = file;
            $('#previewImage').attr('src', URL.createObjectURL(file));
            iconBinRe4();
        }
    });

    $(document).on('change', '#imgUpload', function(e) {
        const file = e.target.files[0];
        if (file) {
            uploadedCerFile = file;
            // alert('1');
            $('#old-image').attr('src', URL.createObjectURL(file));
            $('#d-up-img1').hide();
            $('#d-up-img2').hide();

            iconBinRe();
        }
    });



    $(document).on('click', '#bin-file4', function() {
        $('#cerimage').val('');
        uploadedCerFile = null;
        $('#previewImage').attr('src', '<?= Yii::$app->homeUrl ?>image/upload-plusimg.svg');
        $('#bin-file4, #refes-file4').hide();
    });

    $(document).on('click', '#refes-file4', function() {
        $('#cerimage').click(); // เปิด file picker
    });

    $(document).on('click', '#bin-file', function() {
        $('#imgUpload').val('');
        // uploadedCerFile = null;
        // $('#previewImage').hide();
        $('#old-image').attr('src', '<?= Yii::$app->homeUrl ?>image/upload-iconimg.svg');
        $('#d-up-img1').show();
        $('#d-up-img2').show();
        $('#bin-file, #refes-file').hide();
    });

    $(document).on('click', '#refes-file', function() {
        $('#imgUpload').click(); // เปิด file picker
    });

    $(document).on('click', '#imgpreview', function() {
        $('#imgUpload').click(); // เปิด file picker
    });

    $(document).on('change', '#certificate', function(e) {
        uploadedCertificateFiles = Array.from(e.target.files); // เก็บไฟล์หลายไฟล์
    });

    function iconBinRe4() {
        $('#bin-file4').show();
        $('#refes-file4').show();
    }

    function iconBinRe() {
        $('#bin-file').show();
        $('#refes-file').show();
    }

    function createSchedule() {
        if (!uploadedCerFile) {
            alert('Please upload a cerimage file first!');
            return;
        }

        const uniqueId = Date.now() + Math.floor(Math.random() * 1000); // สร้าง ID ไม่ซ้ำ

        // สำหรับ cerImageHidden
        const dtCer = new DataTransfer();
        dtCer.items.add(uploadedCerFile);
        const inputNameCer = 'cerImageHidden_' + uniqueId;
        const inputIdCer = 'cerImageHidden_' + uniqueId;
        const newInputCer = $('<input>', {
            type: 'file',
            name: inputNameCer,
            id: inputIdCer,
            style: 'display:none'
        });
        newInputCer[0].files = dtCer.files;
        $('#fileInputsContainer').append(newInputCer);

        // สำหรับ certificateHidden (อาจมีหลายไฟล์)
        if (uploadedCertificateFiles.length > 0) {
            uploadedCertificateFiles.forEach((file, index) => {
                const dtCert = new DataTransfer();
                dtCert.items.add(file);
                const inputNameCert = 'certificateHidden_' + uniqueId + '_' + index;
                const inputIdCert = 'certificateHidden_' + uniqueId + '_' + index;

                const newInputCert = $('<input>', {
                    type: 'file',
                    name: inputNameCert,
                    id: inputIdCert,
                    style: 'display:none'
                });
                newInputCert[0].files = dtCert.files;
                $('#imgInputsContainer').append(newInputCert);
            });
        }

        // อ่านค่าจากฟอร์ม
        const cerName = document.getElementById('cerName').value.trim();
        const issuingName = document.getElementById('issuingName').value.trim();
        const fromCerDate = document.getElementById('fromCerDate').value.trim();
        const toCerDate = document.getElementById('toCerDate').value.trim();
        const credential = document.getElementById('credential').value.trim();
        const noExpiry = document.getElementById('noExpiryCheckbox').checked;

        if (!cerName || !issuingName || (!fromCerDate && !noExpiry) || (!toCerDate && !noExpiry)) {
            alert('Please fill all required fields.');
            return;
        }

        const cert = {
            id: uniqueId,
            cerName,
            issuingName,
            fromCerDate: noExpiry ? 'No expiry date' : fromCerDate,
            toCerDate: noExpiry ? '' : toCerDate,
            credential,
            noExpiry
        };

        certificates.push(cert);
        renderScheduleList();
        clearForm();

        const certificateModalEl = document.getElementById('certificateModal');
        const modal = bootstrap.Modal.getInstance(certificateModalEl);
        if (modal) {
            $('#bin-file4').hide();
            $('#refes-file4').hide();
            modal.hide();
            console.log(certificates);
            document.getElementById('certificateDataHidden').value = JSON.stringify(certificates);
        }
    }

    function editSchedule(id) {
        // หา index ของ certificate ที่ต้องแก้ไขในอาร์เรย์ certificates
        const index = certificates.findIndex(cert => cert.id === id);
        if (index === -1) {
            alert('Certificate not found');
            return;
        }

        // ลบ input ไฟล์เก่า สำหรับ cerImageHidden ที่เกี่ยวข้องกับ id นี้
        $(`#fileInputsContainer input[id^="cerImageHidden_${id}"]`).remove();

        // ลบ input ไฟล์เก่า สำหรับ certificateHidden ที่เกี่ยวข้องกับ id นี้
        $(`#imgInputsContainer input[id^="certificateHidden_${id}_"]`).remove();

        // สร้าง input ไฟล์ใหม่ สำหรับ cerImageHidden (ถ้ามีไฟล์ใหม่อัพโหลด)
        if (uploadedCerFile) {
            const dtCer = new DataTransfer();
            dtCer.items.add(uploadedCerFile);
            const inputNameCer = 'cerImageHidden_' + id;
            const inputIdCer = 'cerImageHidden_' + id;
            const newInputCer = $('<input>', {
                type: 'file',
                name: inputNameCer,
                id: inputIdCer,
                style: 'display:none'
            });
            newInputCer[0].files = dtCer.files;
            $('#fileInputsContainer').append(newInputCer);
        }

        // สร้าง input ไฟล์ใหม่ สำหรับ certificateHidden (ถ้ามีไฟล์ใหม่อัพโหลด)
        if (uploadedCertificateFiles.length > 0) {
            uploadedCertificateFiles.forEach((file, index) => {
                const dtCert = new DataTransfer();
                dtCert.items.add(file);
                const inputNameCert = 'certificateHidden_' + id + '_' + index;
                const inputIdCert = 'certificateHidden_' + id + '_' + index;

                const newInputCert = $('<input>', {
                    type: 'file',
                    name: inputNameCert,
                    id: inputIdCert,
                    style: 'display:none'
                });
                newInputCert[0].files = dtCert.files;
                $('#imgInputsContainer').append(newInputCert);
            });
        }

        // อ่านค่าจากฟอร์ม
        const cerName = document.getElementById('cerName').value.trim();
        const issuingName = document.getElementById('issuingName').value.trim();
        const fromCerDate = document.getElementById('fromCerDate').value.trim();
        const toCerDate = document.getElementById('toCerDate').value.trim();
        const credential = document.getElementById('credential').value.trim();
        const noExpiry = document.getElementById('noExpiryCheckbox').checked;

        // ตรวจสอบค่าที่ต้องกรอก
        if (!cerName || !issuingName || (!fromCerDate && !noExpiry) || (!toCerDate && !noExpiry)) {
            alert('Please fill all required fields.');
            return;
        }

        // อัปเดตข้อมูล certificate ในอาร์เรย์
        certificates[index] = {
            id: id,
            cerName: cerName,
            issuingName: issuingName,
            fromCerDate: noExpiry ? 'No expiry date' : fromCerDate,
            toCerDate: noExpiry ? '' : toCerDate,
            credential: credential,
            noExpiry: noExpiry
        };

        // console.log(certificates);
        document.getElementById('certificateDataHidden').value = JSON.stringify(certificates);

        renderScheduleList();
        clearForm();

        // ซ่อน modal
        $('#certificateModal').modal('hide');
    }


    function renderScheduleList() {
        const list = document.getElementById('schedule-list');
        list.innerHTML = '';
        // console.log(certificates);

        certificates.forEach(cert => {
            const li = document.createElement('li');
            li.classList.add('mb-2');
            li.innerHTML = `
            <div class="schedule-item" data-id="${cert.id}"
                style="padding: 13px 20px; background-color: #FFFFFF;">
                <div class="row align-items-center dept-name">
                    <div class="col-9 dept-label" style="font-weight: 600; font-size: 16px;">
                        ${cert.cerName}
                    </div>
                    <div class="col-3 text-end">
                        <a href="javascript:void(0);" onclick="if(confirm('Do you want to delete this certificate?')) deleteCertificate(${cert.id});"
                            class="no-underline icon-delete">
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/binred.svg"
                                alt="Delete" class="pim-icon bin-icon transition-icon">
                        </a>
                        <a href="javascript:void(0);" class="no-underline icon-edit" onclick="editCertificate(${cert.id})">
                            <img src="<?= Yii::$app->homeUrl ?>image/edit-blue.svg" alt="Edit"
                                class="pim-icon edit-icon transition-icon"
                                style="margin-top: -3px;">
                            <span class="text-blue edit-label transition-label"
                                style="font-weight: 500;">Edit</span>
                        </a>
                    </div>
                </div>
            </div>
        `;
            list.appendChild(li);
        });
    }


    function editCertificate(id) {
        const cert = certificates.find(c => c.id === id);
        if (!cert) {
            alert('Certificate not found.');
            return;
        }

        const url = $url + 'setting/employee/modal-certificate';

        $.ajax({
            url: url,
            type: 'POST',
            data: {
                mode: 'edit', // เพิ่ม mode เพื่อแยก logic ฝั่ง PHP
                cert: JSON.stringify(cert),
            },
            success: function(response) {
                $('#certificateModalBody').html(response);
                $('#certificateModal').modal('show');
                setTimeout(() => {
                    initCerDateCalendar();
                }, 100);
            },
            error: function() {
                $('#certificateModalBody').html('<p class="text-danger">Failed to load content.</p>');
                $('#certificateModal').modal('show');
            }
        });
    }


    function deleteCertificate(id) {
        // ลบ certificate จาก array
        certificates = certificates.filter(cert => cert.id !== id);

        // ลบ cerImageHidden input
        document.getElementById('cerImageHidden_' + id)?.remove();

        // ลบ certificateHidden ทุก input ที่มี ID เริ่มต้นด้วย certificateHidden_{id}_
        const imgInputs = document.querySelectorAll(`#imgInputsContainer input[id^="certificateHidden_${id}_"]`);
        imgInputs.forEach(input => input.remove());

        // อัปเดต hidden input
        document.getElementById('certificateDataHidden').value = JSON.stringify(certificates);

        const url = $url + 'setting/employee/delete-certificate';

        $.ajax({
            url: url,
            type: 'POST',
            data: {
                mode: 'edit',
                id: id
            },
            success: function(response) {
                console.log("Deleted successfully:", response);
            },
            error: function(xhr, status, error) {
                console.error("Error deleting certificate:", error);
            }
        });

        // render ใหม่
        renderScheduleList();
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
    // companySelect.addEventListener('change', updateCompanyIconAndBranches);


    function updateSelectCheng() {
        const companySelect = document.getElementById('companySelectId');
        const iconImg = document.getElementById('companyIconImg');
        const branchSelect = document.getElementById('branchSelectId');
        const departmentSelect = document.getElementById('departmentSelectId');

        // const homeUrl = '<?= Yii::$app->homeUrl ?>';  // กำหนดตัวแปร homeUrl ให้ใช้ใน JS
        const selectedOption = companySelect.options[companySelect.selectedIndex];
        const selectedImg = selectedOption.getAttribute('data-img');
        const selectedValue = companySelect.value;

        const selectedBranchId = <?= isset($employee['branchId']) ? (int)$employee['branchId'] : 'null' ?>;
        const departmentSelectId =
            <?= isset($employee['departmentId']) ? (int)$employee['departmentId'] : 'null' ?>;

        // เปลี่ยนไอคอนรูปบริษัท
        if (selectedValue !== '') {
            iconImg.src = $url + selectedImg;
            iconImg.removeAttribute('style');
            iconImg.classList.add('card-tcf');
        } else {
            iconImg.src = $url + 'images/icons/Dark/48px/company.svg';
        }

        // เอา disabled ออกจาก select สาขา
        if (selectedBranchId !== null) {
            branchSelect.removeAttribute('disabled');

            // เปลี่ยนสี background ของ span ถ้ามี
            const branchSpan = branchSelect.nextElementSibling;
            if (branchSpan && branchSpan.classList.contains('input-group-text')) {
                branchSpan.style.backgroundColor = '#fff';
            }

            // โหลดข้อมูลสาขา

            fetch(homeUrl + 'setting/company/company-branch-list', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-Token': '<?= Yii::$app->request->csrfToken ?>'
                    },
                    body: JSON.stringify({
                        companyId: selectedValue
                    })
                })
                .then(response => response.json())
                .then(data => {
                    const branchSelect = document.getElementById('branchSelectId');

                    branchSelect.innerHTML =
                        '<option value="" disabled selected hidden><?= Yii::t("app", "Select from Branches") ?></option>';

                    if (Array.isArray(data)) {
                        data.forEach(branch => {
                            const option = document.createElement('option');
                            option.value = branch.branchId;
                            option.text = branch.branchName;

                            // ถ้า branchId ตรงกับของพนักงาน ให้ mark ว่า selected
                            if (selectedBranchId !== null && selectedBranchId === parseInt(branch
                                    .branchId)) {
                                option.selected = true;
                            }

                            branchSelect.appendChild(option);
                        });

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
                            iconDiv.classList.remove('cycle-current-gray');
                            iconDiv.classList.add('cycle-current-yellow');

                        } else {
                            iconDiv.classList.remove('cycle-current-yellow');
                            iconDiv.classList.add('cycle-current-gray');
                        }
                    }
                });

            if (departmentSelectId !== null) {
                departmentSelect.removeAttribute('disabled');

                // เปลี่ยนสี background ของ span ถ้ามี
                const departmentSpan = departmentSelect.nextElementSibling; // span ที่อยู่ถัดจาก select
                if (departmentSpan && departmentSpan.classList.contains('input-group-text')) {
                    departmentSpan.style.backgroundColor = '#fff';
                }

                fetch('<?= Yii::$app->homeUrl ?>setting/branch/branch-department-list', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-Token': '<?= Yii::$app->request->csrfToken ?>'
                        },
                        body: JSON.stringify({
                            beanchId: selectedBranchId
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        const departmentSelect = document.getElementById('departmentSelectId');

                        departmentSelect.innerHTML =
                            '<option value="" disabled selected hidden><?= Yii::t("app", "In which Department?") ?></option>';

                        if (Array.isArray(data)) {
                            data.forEach(branch => {
                                const option = document.createElement('option');
                                option.value = branch.departmentId;
                                option.text = branch.departmentName;

                                // ถ้า departmentId ตรงกับของพนักงาน ให้ mark ว่า selected
                                if (departmentSelectId !== null && departmentSelectId === parseInt(branch
                                        .departmentId)) {
                                    option.selected = true;
                                }


                                departmentSelect.appendChild(option);
                            });
                            // const departmentId = this.value;

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
                            loadTeamsSelect(departmentSelectId);


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
                                iconDiv.classList.remove('cycle-current-gray');
                                iconDiv.classList.add('cycle-current-red');

                            } else {
                                iconDiv.classList.remove('cycle-current-red');
                                iconDiv.classList.add('cycle-current-gray');
                            }
                            loadTitlesSelect(departmentSelectId);

                        }
                    });
            }
        }
    }

    document.addEventListener("DOMContentLoaded", function() {
        initRadioSelection(); // เรียกใช้กับ `.radio-wrappewrapper`
        initCheckboxSelection();
        flatpickrDate();
        updateSelectCheng();
        updateMultiDueTermState();
        changeStatusEmployee()
        changeSelectFlag()

        const loadedCertificates = <?= json_encode($userCertificate) ?>;
        // console.log(loadedCertificates);

        if (Array.isArray(loadedCertificates)) {
            loadedCertificates.forEach(item => {
                const cert = {
                    id: item.cerId,
                    cerName: item.cerName,
                    issuingName: item.issuing,
                    fromCerDate: item.noExpiry == 1 ? 'No expiry date' : item.fromCerDate,
                    toCerDate: item.noExpiry == 1 ? '' : item.toCerDate,
                    credential: item.credential,
                    noExpiry: item.noExpiry == 1,
                    certificate: item.certificate,
                    cerImage: item.cerImage
                };
                certificates.push(cert);
                document.getElementById('certificateDataHidden').value = JSON.stringify(certificates);
            });

            renderScheduleList(); // แสดงข้อมูล
        }

        let initialSkills = <?= json_encode($employee['skills'] ?? []) ?>;
        // console.log(initialSkills);
        if (typeof initialSkills === "string") {
            try {
                initialSkills = JSON.parse(initialSkills);
            } catch (e) {
                console.error("ไม่สามารถแปลง initialSkills:", e);
                initialSkills = [];
            }
        }

        if (Array.isArray(initialSkills)) {
            initialSkills.forEach(skill => {
                if (skill && !skillArray.includes(skill.toLowerCase())) {
                    skillArray.push(skill.toLowerCase());
                    addSkillTag(skill);
                }
            });
            updateHiddenInput();
        }

        const userLanguage = <?= json_encode($userLanguage ?? []) ?>;

        if (Array.isArray(userLanguage) && userLanguage.length > 0) {
            userLanguage.forEach(lang => {
                // console.log(userLanguage);
                addAdditionalLanguage(lang.languageId);
            });
        }
    });

    document.getElementById('create-employee').addEventListener('submit', function(e) {
        e.preventDefault();

        if (certificates.length !== cerImages.length || certificates.length !== certificatesFiles.length) {
            alert("ข้อมูลยังไม่ครบ กรุณาอัปโหลดรูปภาพและไฟล์ certificate ให้ครบทุกอัน");
            return;
        }

        const form = e.target;
        const formData = new FormData(form);

        formData.set('certificateData', JSON.stringify(certificates));

        cerImages.forEach((file, index) => {
            formData.append(`cerImage[${index}]`, file);
        });

        certificatesFiles.forEach((file, index) => {
            formData.append(`certificate[${index}]`, file);
        });

        fetch(form.action, {
                method: 'POST',
                body: formData
            })
            .then(res => res.text())
            .then(result => {
                console.log("ส่งเรียบร้อย", result);
                // ทำต่อ เช่น redirect หรือแจ้งเตือน
            })
            .catch(err => {
                console.error("เกิดข้อผิดพลาด", err);
            });
    });

    const skillPlus = document.getElementById("skill-plus");

    document.getElementById("skill").addEventListener("focus", function() {
        hintText.style.backgroundColor = "hsla(209, 70%, 49%, 1)";
        skillPlus.src = "<?= Yii::$app->homeUrl ?>images/icons/Settings/plus-blue.svg";
    });

    document.getElementById("skill").addEventListener("blur", function() {
        hintText.style.backgroundColor = "var(--HRVC---Light-Text, #94989C)";
        skillPlus.src = "<?= Yii::$app->homeUrl ?>images/icons/Settings/plus-gray.svg";
    });

    const skillArray = [];
    const skillBox = document.getElementById("skill-box");
    const skillDetail = document.getElementById("skill-detail");
    const skillInput = document.getElementById("skill");
    const skillTagsContainer = document.getElementById("skillTags");
    const hiddenInput = document.getElementById("skillsHidden");

    skillInput.addEventListener("keydown", function(event) {
        if (event.key === "Enter") {
            event.preventDefault();

            const value = skillInput.value.trim();

            if (value !== "" && !skillArray.includes(value.toLowerCase())) {
                skillArray.push(value.toLowerCase());
                addSkillTag(value);
                updateHiddenInput();
                skillInput.value = "";
            }
        }
    });

    function addSkillTag(skill) {
        const tag = document.createElement("span");
        tag.className = "skill-tag";
        tag.style.display = "inline-flex";
        tag.style.alignItems = "center";
        tag.style.gap = "4px";

        skillBox.style.backgroundColor = "#ffffff";
        skillBox.style.border = "0.5px solid #BBCDDE";
        skillDetail.style.display = "none"; // ซ่อน

        const removeBtn = document.createElement("span");
        removeBtn.innerHTML = `
        <svg xmlns="http://www.w3.org/2000/svg" width="19" height="18" viewBox="0 0 19 18" fill="none" style="cursor: pointer;">
        <g clip-path="url(#clip0_17970_18863)">
            <path fill-rule="evenodd" clip-rule="evenodd" d="M9.5 16.8755C5.15075 16.8755 1.625 13.3486 1.625 9.00049C1.625 4.65236 5.15075 1.12549 9.5 1.12549C13.8492 1.12549 17.375 4.65236 17.375 9.00049C17.375 13.3486 13.8492 16.8755 9.5 16.8755ZM9.5 0.000488281C4.52919 0.000488281 0.5 4.02799 0.5 9.00049C0.5 13.973 4.52919 18.0005 9.5 18.0005C14.4708 18.0005 18.5 13.973 18.5 9.00049C18.5 4.02799 14.4708 0.000488281 9.5 0.000488281ZM12.7158 5.783C12.4942 5.56363 12.1359 5.56363 11.9142 5.783L9.49664 8.20171L7.11387 5.81672C6.89394 5.59734 6.53731 5.59734 6.3185 5.81672C6.09856 6.03609 6.09856 6.39612 6.3185 6.61549L8.70126 8.99486L6.30164 11.3967C6.08058 11.6161 6.08058 11.9761 6.30164 12.2011C6.52326 12.4205 6.88212 12.4205 7.10374 12.2011L9.50336 9.79926L11.8861 12.1843C12.1061 12.4036 12.4627 12.4036 12.6821 12.1843C12.902 11.9649 12.902 11.6049 12.6821 11.3855L10.2987 9.00612L12.7158 6.58734C12.9369 6.36234 12.9369 6.008 12.7158 5.783Z" fill="#30313D"/>
        </g>
        <defs>
            <clipPath id="clip0_17970_18863">
            <rect width="18" height="18" fill="white" transform="translate(0.5 0.000488281)"/>
            </clipPath>
        </defs>
        </svg>
        `;
        removeBtn.style.marginRight = "6px"; // เพิ่มระยะห่างด้านขวา

        removeBtn.onclick = function() {
            const index = skillArray.indexOf(skill.toLowerCase());
            if (index > -1) {
                skillArray.splice(index, 1);
                tag.remove();
                updateHiddenInput();
            }
        };


        const skillText = document.createElement("span");
        skillText.textContent = skill;

        // ✅ เพิ่ม removeBtn ก่อน แล้วค่อยเพิ่มข้อความ
        tag.appendChild(removeBtn);
        tag.appendChild(skillText);

        skillTagsContainer.appendChild(tag);
    }

    function updateHiddenInput() {
        hiddenInput.value = JSON.stringify(skillArray);
    }

    let additionalLangCount = 0;
    const maxAdditionalLangs = 3;

    function addAdditionalLanguage(selectedValue = "") {
        // console.log(additionalLangCount);

        if (additionalLangCount >= maxAdditionalLangs) return;
        // ตรวจสอบ select ก่อนหน้าว่ามีค่าแล้วหรือไม่ (ถ้ามีแล้วไม่เพิ่ม)
        if (additionalLangCount > 0) {
            const previousSelect = document.getElementById(`mainLanguage${additionalLangCount}`);
            if (previousSelect && previousSelect.value === "") {
                return;
            }
        }


        if (additionalLangCount == 1) {
            <?php
                $LanguageId = isset($userLanguage[1]['languageId']) ? $userLanguage[1]['languageId'] : '';
            ?>
        } else if (additionalLangCount == 2) {
            <?php
                $LanguageId = isset($userLanguage[2]['languageId']) ? $userLanguage[2]['languageId'] : '';
            ?>
        } else if (additionalLangCount == 3) {
            <?php
                $LanguageId = isset($userLanguage[3]['languageId']) ? $userLanguage[3]['languageId'] : '';
            ?>
        }
        additionalLangCount++;

        const userLanguage = <?= json_encode($userLanguage) ?>;
        const mainLanguage = <?= json_encode($mainLanguage) ?>;
        // const additionalLangCount = 2; // สมมุติค่านี้ได้จากที่อื่น
        let languageId = '';
        let flag = 'image/e-world.svg';
        if (userLanguage.length >= additionalLangCount) {
            languageId = userLanguage[additionalLangCount - 1]?.languageId || '';
        }

        if (languageId) {
            const lang = mainLanguage.find(l => l.LanguageId == languageId);
            if (lang && lang.flag) {
                flag = lang.flag;
            }
        }

        // console.log("LanguageId:", languageId);
        // console.log("Flag URL:", flag);


        let langHtml = '';
        <?php if ($statusfrom === 'Update'): ?>
        langHtml = `
            <div class="input-group mt-12">
                <span class="input-group-text" style="background-color: white; border-right: none;">
                    <img class="cycle-current" id="flag-ml${additionalLangCount - 1}" src="<?= Yii::$app->homeUrl ?>${flag}" alt="Website"
                        style="width: 20px; height: 20px; border: none;">
                </span>
                <select class="form-select" style="border-left: none;"
                    id="mainLanguage${additionalLangCount - 1}" name="mainLanguage${additionalLangCount - 1}" required
                    onchange="handleLanguageChange(${additionalLangCount - 1})">
                    <option value="" disabled hidden style="color: var(--Helper-Text, #8A8A8A);">
                        <?= Yii::t('app', 'Select Additional Language') ?>
                    </option>
                    <?php if (isset($mainLanguage) && count($mainLanguage) > 0): ?>
                        <?php foreach ($mainLanguage as $lang): 
                            $selected = ($lang['LanguageId'] == $LanguageId) ? 'selected' : '';
                        ?>
                            <option value="<?= htmlspecialchars($lang['LanguageId']) ?>"
                                    data-flag="<?= htmlspecialchars($lang['flag'] ?? '') ?>"
                                    <?= $selected ?>>
                                <?= htmlspecialchars($lang['name']) ?>
                            </option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
            </div>
        `;

        <?php else: ?>
        langHtml = `
            <div class="input-group mt-12">
                <span class="input-group-text" style="background-color: white; border-right: none;">
                    <img class="cycle-current" id="flag-ml${additionalLangCount}" src="<?= Yii::$app->homeUrl ?>${flag}" alt="Website"
                        style="width: 20px; height: 20px; border: none;">
                </span>
                <select class="form-select" style="border-left: none;"
                    id="mainLanguage${additionalLangCount}" name="mainLanguage${additionalLangCount}" required
                    onchange="handleLanguageChange(${additionalLangCount})">
                    <option value="" disabled hidden style="color: var(--Helper-Text, #8A8A8A);">
                        <?= Yii::t('app', 'Select Additional Language') ?>
                    </option>
                    <?php if (isset($mainLanguage) && count($mainLanguage) > 0): ?>
                        <?php foreach ($mainLanguage as $lang): 
                            $selected = ($lang['LanguageId'] == $LanguageId) ? 'selected' : '';
                        ?>
                            <option value="<?= htmlspecialchars($lang['LanguageId']) ?>"
                                    data-flag="<?= htmlspecialchars($lang['flag'] ?? '') ?>"
                                    <?= $selected ?>>
                                <?= htmlspecialchars($lang['name']) ?>
                            </option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
            </div>
        `;
        <?php endif; ?>


        <?php if ($statusfrom === 'Update'): ?>
        if (additionalLangCount >= 2) {
            document.getElementById('al').insertAdjacentHTML('beforeend', langHtml);
            // ตั้งค่าที่เลือกให้ select ตัวล่าสุด ถ้ามี
            if (selectedValue) {
                const currentSelect = document.getElementById(`mainLanguage${additionalLangCount-1}`);
                if (currentSelect) {
                    currentSelect.value = selectedValue;
                }
            }
        }
        <?php elseif ($statusfrom === 'Create'): ?>
        // ตั้งค่าที่เลือกให้ select ตัวล่าสุด ถ้ามี
        if (selectedValue) {
            const currentSelect = document.getElementById(`mainLanguage${additionalLangCount}`);
            if (currentSelect) {
                currentSelect.value = selectedValue;
            }
        }
        document.getElementById('al').insertAdjacentHTML('beforeend', langHtml);
        <?php endif; ?>


        <?php if ($statusfrom === 'Update'): ?>
        //additionalLangCount = 1 2 3 4 ไม่เอา 1 
        const noId = additionalLangCount - 1; // 0 1 2 3
        if (additionalLangCount >= 3) { //2 3
            const lockSpan =
                `
            <span id="lockId-${noId}"
                class="input-group-text d-flex justify-content-center align-items-center mt-12"
                style="background-color: #e9ecef; height: 40px;">
                Add additional Language First
            </span>
            `; // lockId สร้าง 2 3 เพราะ 1 มีอยุ่แแล้ว แต่ 1 นั้น = 2 ในดาต้า = ต้องสร้างดาต้า ที่ 3 กับ 4 ใน lockId 2 กับ 3  lockId ก้จะมี 1 2 3
            document.getElementById('ald').insertAdjacentHTML('beforeend', lockSpan);
            // alert('lockId2');
            // alert(noId); //1,2
            // ต้องส่งค่า 1 2 3  เข้าไป ถ้าดาต้ามาเป็น 1 2 3 ต้องส่งไปแค่ 2 3 ซึ่งต้องแปลงเป็ย 1 2 ถ้าเป็น 1 2 3 4 ส่ง 2 3 4 แปลงเป็น 1 2 3
            // handleLanguageChange(additionalLangCount);
        }
        if (noId != 0) { // 1 2 3
            // alert('noId' + noId);
            handleLanguageChange(noId);
        }
        <?php elseif ($statusfrom === 'Create'): ?>
        if (additionalLangCount >= 2) {
            const lockSpan = `
            <span id="lockId-${additionalLangCount}"
                class="input-group-text d-flex justify-content-center align-items-center mt-12"
                style="background-color: #e9ecef; height: 40px;">
                Add additional Language First
            </span>
            `;
            document.getElementById('ald').insertAdjacentHTML('beforeend', lockSpan);
        }
        <?php endif; ?>

        if (additionalLangCount >= maxAdditionalLangs) {
            document.getElementById('addCertificateBtn')?.classList.add('d-none');
        } else {
            document.getElementById('addCertificateBtn')?.classList.remove('d-none');
        }
        // }

    }

    function handleLanguageChange(no) {
        const lang1 = document.getElementById('mainLanguage1');
        const lang2 = document.getElementById('mainLanguage2');
        const lang3 = document.getElementById('mainLanguage3');
        // alert('ee');

        function isDuplicate(value, others) {
            if (!value) return false;
            return others.some(otherValue => otherValue === value);
        }


        function replaceLockWithLevelSelect(lockId, levelName, levelId) {
            const lockSpan = document.getElementById(lockId);
            // lockId 1 2 3
            // เตรียมข้อมูลล่วงหน้าจาก PHP
            const languageLevels = {
                1: "<?= isset($userLanguage[1]['lavel']) ? $userLanguage[1]['lavel'] : '' ?>",
                2: "<?= isset($userLanguage[2]['lavel']) ? $userLanguage[2]['lavel'] : '' ?>",
                3: "<?= isset($userLanguage[3]['lavel']) ? $userLanguage[3]['lavel'] : '' ?>"
            };

            const levels = {
                1: 'Beginner',
                2: 'Elementary',
                3: 'Intermediate',
                4: 'Upper Intermediate',
                5: 'Advanced',
                6: 'Fluent',
                7: 'Native',
            };

            if (lockSpan) {
                let number = lockId.split('-')[1]; // ตัวเลขจาก lockId
                // alert('โหลดอาเรย์' + number);

                const arayData = languageLevels[number] || '';
                // alert(arayData);

                let options = `<option value="" disabled selected hidden style="color: var(--Helper-Text, #8A8A8A);">
                        <?= Yii::t('app', 'Select') ?>
                       </option>`;

                for (let val in levels) {
                    const selected = (val == arayData) ? 'selected' : '';
                    options += `<option value="${val}" ${selected}>${levels[val]}</option>`;
                }

                lockSpan.outerHTML = `
            <select class="form-select mt-12" name="lavelLanguage${no}" id="lavelLanguage${no}" required>
                ${options}
            </select>
        `;
            }

        }

        if (no === 1) { //additionalLangCount 2
            if (lang2 || lang3) {
                const val1 = lang1?.value || "";
                const valsOther = [(lang2?.value || ""), (lang3?.value || "")];
                if (val1 && isDuplicate(val1, valsOther)) {
                    alert('Language Duplicate');
                    lang1.value = "";
                }
            } else {
                // alert('โหลดlockId-1');
                replaceLockWithLevelSelect('lockId-1', 'lavelLanguage1', 'lavelLanguage1');
            }
        } else if (no === 2) { //additionalLangCount 3
            if (lang1 || lang3) {
                const val2 = lang2?.value || "";
                const valsOther = [(lang1?.value || ""), (lang3?.value || "")];
                if (val2 && isDuplicate(val2, valsOther)) {
                    alert('Language Duplicate');
                    lang2.value = "";
                } else {
                    // alert('โหลดlockId-2');
                    replaceLockWithLevelSelect('lockId-2', 'lavelLanguage2', 'lavelLanguage2');
                }
            }
        } else if (no === 3) {
            if (lang1 || lang2) {
                const val3 = lang3?.value || "";
                const valsOther = [(lang1?.value || ""), (lang2?.value || "")];
                if (val3 && isDuplicate(val3, valsOther)) {
                    alert('Language Duplicate');
                    lang3.value = "";
                } else {
                    replaceLockWithLevelSelect('lockId-3', 'lavelLanguage3', 'lavelLanguage3');
                }
            }
        }

        if (no === 1) {
            const selectElement = document.getElementById('mainLanguage1');
            const flagImg = document.getElementById('flag-ml1');


            if (selectElement && flagImg) {
                // console.log(selectElement);
                // console.log(flagImg);
                selectElement.addEventListener('change', function() {
                    const selectedOption = this.options[this.selectedIndex];
                    const flagUrl = selectedOption.getAttribute('data-flag');
                    if (flagUrl) {
                        // alert('1');
                        flagImg.src = homeUrl + flagUrl;
                    } else {
                        // alert('2');
                        flagImg.src = homeUrl + 'image/e-world.svg';
                    }
                });
            }
        }

        if (no === 2) {
            const selectElement = document.getElementById('mainLanguage2');
            const flagImg = document.getElementById('flag-ml2');

            if (selectElement && flagImg) {
                // console.log(selectElement);
                // console.log(flagImg);

                // ไม่ต้องใช้ getElementById อีกครั้ง!
                selectElement.addEventListener('change', function() {
                    const selectedOption = this.options[this.selectedIndex];
                    const flagUrl = selectedOption.getAttribute('data-flag');
                    if (flagUrl) {
                        flagImg.src = homeUrl + flagUrl;
                    } else {
                        flagImg.src = homeUrl + 'image/e-world.svg';
                    }
                });
            }
        }

    }
    document.getElementById('saveDraftBtn').addEventListener('click', function(e) {
        e.preventDefault();
        document.getElementById('darf').value = '1'; // set value
        document.getElementById('create-employee').submit(); // submit form
    });
    </script>

    <?php ActiveForm::end(); ?>