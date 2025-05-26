<?php

use yii\bootstrap5\ActiveForm;

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
                                <text class="font-size-16 font-weight-500"><span class="text-danger">* </span>System
                                    Login ID</text>
                                <div class="input-group">
                                    <span class="input-group-text" style="background-color: white; border-right: none;">
                                        <img src="<?= Yii::$app->homeUrl ?>image/web-gray.svg" alt="Website"
                                            style="width: 20px; height: 20px;">
                                    </span>
                                    <input type="text" class="form-control font-size-14" name="///"
                                        placeholder="kaori@gmail.com" value=""
                                        style="width: 290.59px; border-left: none;">
                                </div>
                            </div>
                            <div>
                                <text class="font-size-16 font-weight-500"><span class="text-danger">* </span>Employee
                                    ID</text>
                                <input type="text" class="form-control font-size-14" name="///"
                                    placeholder="Please assign the employee ID  " value="" style="width:  330.59px;">
                            </div>
                        </div>
                        <div class="flex-center" style="gap: 37px;">
                            <div>
                                <text class="font-size-16 font-weight-500"><span class="text-danger">* </span>Password
                                </text>

                                <div class="input-group">
                                    <span class="input-group-text" style="background-color: white; border-right: none;">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/mail.svg" alt="Website"
                                            style="width: 20px; height: 20px;">
                                    </span>
                                    <input type="text" class="form-control font-size-14" name="///"
                                        placeholder="Register Password here" value=""
                                        style="width: 290.59px; border-left: none;">
                                </div>
                            </div>
                            <div>
                                <text class="font-size-16 font-weight-500"><span class="text-danger">* </span>System
                                    Language Preference</text>

                                <div class="input-group">
                                    <span class="input-group-text" style="background-color: white; border-right: none;">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/lock.svg" alt="Website"
                                            style="width: 20px; height: 20px;">
                                    </span>
                                    <input type="text" class="form-control font-size-14" name="///"
                                        placeholder="Select preferred language" value=""
                                        style="width: 290.59px; border-left: none;">
                                </div>
                            </div>
                        </div>

                        <div class="w-100">
                            <div class="w-100">
                                <text class="font-size-16 font-weight-500"><span class="text-danger">* </span>System
                                    Wide Permission Level </text>
                                <hr class="hr-group">
                            </div>
                            <div>Staff</div>
                        </div>
                        <div class="w-100">
                            <div class="w-100">
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/help.svg" data-toggle="tooltip"
                                    data-placement="top" aria-label="Module Access"
                                    data-bs-original-title="Module Access">
                                <text class="font-size-16 font-weight-500"><span class="text-danger">* </span>Module
                                    Access </text>
                                <hr class="hr-group">
                            </div>
                            <div>Group Config</div>
                        </div>
                    </div>

                </div>
            </div>

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
                <div>
                    <!-- body -->
                    fff
                </div>
            </div>
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
                <div>
                    <!-- body -->
                    fff
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
<?php ActiveForm::end(); ?>