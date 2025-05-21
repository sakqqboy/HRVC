<?php

use yii\bootstrap5\ActiveForm;

$this->title = 'Create Title';
$form = ActiveForm::begin([
	'id' => 'create-title',
	'method' => 'post',
	'options' => [
		'enctype' => 'multipart/form-data',
	],
	'action' => Yii::$app->homeUrl . 'setting/title/save-create-title'
]); ?>
<div class="company-group-body">
    <div class="contrainer-body">
        <div class="col-12">
            <div class=" d-flex align-items-center gap-2">
                <a href="" style="text-decoration: none; width:66px; height:26px;" class="btn-create-branch">
                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/back-white.svg"
                        style="width:18px; height:18px; margin-top:-3px;">
                    Back
                </a>
                <div class="pim-name-title ml-10">
                    Create Title
                </div>
            </div>
        </div>

        <div class="row update-group-body mt-20">
            <div class="col-3">
                <span class="font-size-18 font-weight-600 ">
                    Associated Group
                </span>
                <div class="d-flex mb-20 mt-19" style="align-items: center; gap: 29px; align-self: stretch;">
                    <div class="avatar-preview">
                        <img src="<?= Yii::$app->homeUrl ?>images/branch/profile/Tp-bPC6u8a.png"
                            class="cycle-big-image">
                    </div>
                    <div class="start-center">
                        <span class="font-size-20 font-weight-500">
                            Thailand consulting
                        </span>
                        <div class="col-12 font-size-14 tokyo-small">
                            <img src="<?= Yii::$app->homeUrl ?>image/hyphen.svg">
                            What we give is What we get.
                        </div>
                    </div>
                </div>
                <span class="font-gray font-size-14 font-weight-400 ">
                    All the titles created here will be associated with the Tokyo Consulting Group and it’s subsidiaries
                    based on departments of each branch
                </span>
            </div>
            <div class="col-9">
                <div class="row mb-3">
                    <div class="col-6">
                        <!-- input1 -->
                        <label for="exampleFormControlInput1" class="form-label font-size-12 font-b">
                            <span class="text-danger">* </span>
                            <?= Yii::t('app', 'Name of The Title') ?>

                        </label>
                        <input type="text" class="form-control mt-12" name="titleName" id="titleName"
                            placeholder="Name of The Title">
                    </div>

                    <div class="col-6">
                        <!-- input3 -->
                        <label for="exampleFormControlInput1" class="form-label font-size-12 font-b">
                            <span class="text-danger">* </span>
                            <?= Yii::t('app', 'Select Branch') ?>
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/help.svg" data-toggle="tooltip"
                                data-placement="top" aria-label="<?= Yii::t('app', 'Select to Branch') ?>"
                                data-bs-original-title="<?= Yii::t('app', 'Select to Branch') ?>">
                        </label>
                        <div class="input-group">
                            <?php if($branchName) {?>
                            <div class="col-12 font-b">
                                <input type="hidden" id="branch" name="branchId" value="<?= $branchId?>">
                                <?= $branchName ?>
                            </div>
                            <?php }else{?>
                            <select id="branchSelectId" brancSelect" class="form-select mt-12"
                                style="border-right: none; width: 239px; appearance: none; background-image: none;"
                                name="branchId" data-company-branch="branch" required>
                                <option value="" disabled selected hidden style="color: var(--Helper-Text, #8A8A8A); ">
                                    <?= Yii::t('app', 'Select from a Branch') ?>
                                </option>
                            </select>

                            <span class="input-group-text mt-12"
                                style="background-color: #fff; border-left: none; gap: 5px; cursor: pointer;"
                                onclick="document.getElementById('companySelectId').focus();">
                                <div class="cycle-current-gray" style="width: 20px; height: 20px;">
                                    <img src="<?= Yii::$app->homeUrl ?>image/branches-black.svg" alt="icon"
                                        style="width: 10px; height: 10px;">
                                </div>
                                <img src="<?= Yii::$app->homeUrl ?>image/drop-down.svg" alt="Dropdown"
                                    style="width: 10px; height: 10px;">
                            </span>
                            <?php }?>

                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-6">
                        <!-- input2 -->
                        <label for="exampleFormControlInput1" class="form-label font-size-12 font-b">
                            <span class="text-danger">* </span>
                            <?= Yii::t('app', 'Select Company') ?>
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/help.svg" data-toggle="tooltip"
                                data-placement="top" aria-label="<?= Yii::t('app', 'Select to Company') ?>"
                                data-bs-original-title="<?= Yii::t('app', 'Select to Company') ?>">
                        </label>
                        <div class="input-group">
                            <?php if($companyName) {?>
                            <div class="col-12 font-b">
                                <input type="hidden" id="company" name="companyId" value="<?= $companyId?>">
                                <?= $companyName ?>
                            </div>
                            <?php }else{?>
                            <select id="companySelectId" class="form-select mt-12"
                                style="border-right: none; width: 239px; appearance: none; background-image: none;"
                                name="companyId" data-company-branch="company" required>
                                <option value="" disabled selected hidden style="color: var(--Helper-Text, #8A8A8A); ">
                                    <?= Yii::t('app', 'Select from a Company') ?>
                                </option>
                                <?php
									if (!empty($companies)) {
										foreach ($companies as $company) {
											echo '<option value="' . $company['companyId'] . '">' . $company['companyName'] . '</option>';
										}
									}
									?>
                            </select>
                            <span class="input-group-text mt-12"
                                style="background-color: #fff; border-left: none; gap: 5px; cursor: pointer;"
                                onclick="document.getElementById('companySelectId').focus();">
                                <div class="cycle-current-gray" style="width: 20px; height: 20px;">
                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/company.svg" alt="icon"
                                        style="width: 10px; height: 10px;">
                                </div>
                                <img src="<?= Yii::$app->homeUrl ?>image/drop-down.svg" alt="Dropdown"
                                    style="width: 10px; height: 10px;">
                            </span>
                            <?php }?>

                        </div>
                    </div>

                    <div class="col-6">
                        <!-- input4 -->
                        <label for="exampleFormControlInput1" class="form-label font-size-12 font-b">
                            <span class="text-danger">* </span>
                            <?= Yii::t('app', 'Select Department') ?>
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/help.svg" data-toggle="tooltip"
                                data-placement="top" aria-label="<?= Yii::t('app', 'Select to Branch') ?>"
                                data-bs-original-title="<?= Yii::t('app', 'Select to Branch') ?>">
                        </label>
                        <div class="input-group">
                            <?php if($departmentName) {?>
                            <div class="col-12 font-b">
                                <input type="hidden" id="branch" name="departmentId" value="<?= $departmentId?>">
                                <?= $departmentName ?>
                            </div>
                            <?php }else{?>
                            <select id="departmentSelectId" brancSelect" class="form-select mt-12"
                                style="border-right: none; width: 239px; appearance: none; background-image: none;"
                                name="departmentId" data-company-branch="department" required>
                                <option value="" disabled selected hidden style="color: var(--Helper-Text, #8A8A8A); ">
                                    <?= Yii::t('app', 'Select from a Department') ?>
                                </option>
                            </select>

                            <span class="input-group-text mt-12"
                                style="background-color: #fff; border-left: none; gap: 5px; cursor: pointer;"
                                onclick="document.getElementById('companySelectId').focus();">
                                <div class="cycle-current-gray" style="width: 20px; height: 20px;">
                                    <img src="<?= Yii::$app->homeUrl ?>image/departments-black.svg" alt="icon"
                                        style="width: 10px; height: 10px;">
                                </div>
                                <img src="<?= Yii::$app->homeUrl ?>image/drop-down.svg" alt="Dropdown"
                                    style="width: 10px; height: 10px;">
                            </span>
                            <?php }?>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 mt-54">
                <label class="form-label font-size-16 font-weight-600 font-b">
                    Title’s Job Description <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/help.svg"
                        data-toggle="tooltip" data-placement="top" aria-label="Select to Company"
                        data-bs-original-title="Select to Company">
                </label>
                <hr class="hr-group">

                <div class="row" style="gap: 22px;">
                    <div class="row">
                        <label class="form-gro font-size-16 font-weight-600 font-b mb-12">
                            Purpose of The Job <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/help.svg"
                                data-toggle="tooltip" data-placement="top" aria-label="Select to Company"
                                data-bs-original-title="Select to Company">
                        </label>
                        <textarea class=" form-control " name="purpose" id="purpose" style="height: 115px;"
                            placeholder="Write the purpose of the job for this title"></textarea>
                    </div>
                    <div class="row">
                        <label class="form-label font-size-16 font-weight-600 font-b mb-12">
                            Core Responsibility <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/help.svg"
                                data-toggle="tooltip" data-placement="top" aria-label="Select to Company"
                                data-bs-original-title="Select to Company">
                        </label>
                        <textarea class=" form-control " name="jobDescription" id="jobDescription"
                            style="height: 115px;" placeholder="Core Responsibility"></textarea>
                    </div>
                    <div class="row">
                        <label class="form-label font-size-16 font-weight-600 font-b mb-12">
                            Key Responsibility <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/help.svg"
                                data-toggle="tooltip" data-placement="top" aria-label="Select to Company"
                                data-bs-original-title="Select to Company">
                        </label>
                        <textarea class=" form-control " name="keyResponsibility" id="keyResponsibility"
                            style="height: 115px;" placeholder="Key Responsibility"></textarea>
                    </div>
                </div>

                <div class="col-12 text-end mt-22">
                    <input type="hidden" id="branchId" value="">
                    <a href="<?= Yii::$app->homeUrl ?>setting/group/create-group" style="text-decoration: none;">
                        <button type="button" class="btn-cancel-group"
                            action="<?= Yii::$app->homeUrl ?>setting/group/create-group">
                            Cancel </button>
                    </a>

                    <button type="submit" class="btn-save-group">
                        Create <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/plus.svg" alt="LinkedIn"
                            style="width: 20px; height: 20px;">
                    </button>
                </div>

            </div>
        </div>
    </div>


    <script>
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
    </script>

    <?php ActiveForm::end(); ?>