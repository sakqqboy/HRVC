<?php

use yii\bootstrap5\ActiveForm;

$urlSubmit = '';
$namePage = !empty($typePage) ? $typePage : " Create";

$this->title =  $namePage . ' Title';

if($namePage == "Create" ){
    $urlSubmit = 'setting/title/save-create-title';
}else{
    $urlSubmit = 'setting/title/save-update-title';
}

$form = ActiveForm::begin([
	'id' => 'create-title',
	'method' => 'post',
	'options' => [
		'enctype' => 'multipart/form-data',
	],
	'action' => Yii::$app->homeUrl . $urlSubmit
]);
 ?>
<div class="company-group-body">
    <div class="contrainer-body">
        <div class="col-12">
            <div class=" d-flex align-items-center gap-2">
                <a href="<?= Yii::$app->request->referrer ?: Yii::$app->homeUrl ?>"
                    style="text-decoration: none; width:66px; height:26px;" class="btn-create-branch">
                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/back-white.svg"
                        style="width:18px; height:18px; margin-top:-3px;">
                    <?= Yii::t('app', 'Back') ?>
                </a>
                <div class="pim-name-title ml-10">
                    <?= Yii::t('app', $namePage . ' Title') ?>
                </div>
            </div>
        </div>

        <div class="row update-group-body mt-20">
            <div class="col-3">
                <span class="font-size-18 font-weight-600 ">
                    <?= Yii::t('app', 'Associated Group') ?>
                </span>
                <div class="d-flex mb-20 mt-19" style="align-items: center; gap: 29px; align-self: stretch;">
                    <div class="avatar-preview">
                        <img src="<?= Yii::$app->homeUrl ?>images/branch/profile/Tp-bPC6u8a.png"
                            class="cycle-big-image">
                    </div>
                    <div class="start-center">
                        <span class="font-size-20 font-weight-500">
                            <?= Yii::t('app', 'Thailand consulting') ?>
                        </span>
                        <div class="col-12 font-size-14 tokyo-small">
                            <img src="<?= Yii::$app->homeUrl ?>image/hyphen.svg">
                            <?= Yii::t('app', 'What we give is What we get.') ?>
                        </div>
                    </div>
                </div>
                <span class="font-gray font-size-14 font-weight-400 ">
                    <?= Yii::t('app', 'All the titles created here will be associated with the Tokyo Consulting
                    Group and it’s subsidiaries
                    based on departments of each branch') ?>
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
                        <div class="input-group">
                            <input type="text" class="form-control mt-12" name="titleName" id="titleName"
                                value="<?= $title['titleName'] ?? '';?>" placeholder="Name of The Title">
                        </div>
                    </div>

                    <div class="col-6">
                        <!-- input3 -->
                        <label for="exampleFormControlInput1" class="form-label font-size-12 font-b"
                            style="margin-bottom: 7px;">
                            <span class="text-danger">* </span>
                            <?= Yii::t('app', 'Select Branch') ?>
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/help.svg" data-toggle="tooltip"
                                data-placement="top" aria-label="<?= Yii::t('app', 'Select to Branch') ?>"
                                data-bs-original-title="<?= Yii::t('app', 'Select to Branch') ?>">
                        </label>
                        <div class="input-group">
                            <?php if($branchName) {?>
                            <input type="hidden" id="branch" name="branchId" value="<?= $branchId?>">
                            <input type="text" class="form-control mt-12" value="<?= $branchName?>" disabled>
                            <span class="input-group-text mt-12"
                                style="background-color: #e9ecef; border-left: none; gap: 5px; ">
                                <div class="cycle-current-yellow" style="width: 20px; height: 20px;">

                                    <img src="<?= Yii::$app->homeUrl ?>image/branches-black.svg" alt="icon"
                                        style="width: 10px; height: 10px;">
                                </div>
                                <img src="<?= Yii::$app->homeUrl ?>image/drop-down.svg" alt="Dropdown"
                                    style="width: 10px; height: 10px;">
                            </span>
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
                                <div id="branchIcon" class="cycle-current-gray" style="width: 20px; height: 20px;">
                                    <img id="branchIconImg" src="<?= Yii::$app->homeUrl ?>image/branches-black.svg"
                                        alt="icon" style="width: 10px; height: 10px;">
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
                            <input type="hidden" id="companyId" name="companyId" value="<?= $companyId?>">
                            <input type="text" class="form-control mt-12" value="<?= $companyName?>" disabled>
                            <span class="input-group-text mt-12"
                                style="background-color: #e9ecef; border-left: none; gap: 5px;  ">
                                <div class="cycle-current-gray" style="width: 20px; height: 20px;">
                                    <img src="<?= Yii::$app->homeUrl . $companies['picture'] ?>" class="card-tcf">
                                </div>
                                <img src="<?= Yii::$app->homeUrl ?>image/drop-down.svg" alt="Dropdown"
                                    style="width: 10px; height: 10px;">
                            </span>
                            <?php }else{?>
                            <select class="form-select mt-12" id="companySelectId" name="companyId"
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
                            <span class="input-group-text mt-12"
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
                            <!-- <div class="col-12 font-b">
                                <input type="hidden" id="branch" name="departmentId" value="<?= $departmentId?>">
                                <?= $departmentName ?>
                            </div> -->
                            <input type="text" class="form-control mt-12" value="<?= $departmentName?>" disabled>
                            <span class="input-group-text mt-12"
                                style="background-color: #e9ecef; border-left: none; gap: 5px;  ">
                                <div class="cycle-current-red" style="width: 20px; height: 20px;">
                                    <img src="<?= Yii::$app->homeUrl ?>image/departments.svg" alt="icon"
                                        style="width: 10px; height: 10px;">
                                </div>
                                <img src="<?= Yii::$app->homeUrl ?>image/drop-down.svg" alt="Dropdown"
                                    style="width: 10px; height: 10px;">
                            </span>
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
                                <div id="departmentIcon" class="cycle-current-gray" style="width: 20px; height: 20px;">
                                    <img id="departmentIconImg"
                                        src="<?= Yii::$app->homeUrl ?>image/departments-black.svg" alt="icon"
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
                    <?= Yii::t('app', 'Title’s Job Description') ?>
                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/help.svg" data-toggle="tooltip"
                        data-placement="top" aria-label="<?= Yii::t('app', 'Title’s Job Description') ?>"
                        data-bs-original-title="<?= Yii::t('app', 'Title’s Job Description') ?>">
                </label>
                <hr class="hr-group">

                <div class="row" style="gap: 22px;">
                    <div class="row">
                        <label class="form-gro font-size-16 font-weight-600 font-b mb-12">
                            <?= Yii::t('app', 'Purpose of The Job') ?>
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/help.svg" data-toggle="tooltip"
                                data-placement="top" aria-label="<?= Yii::t('app', 'Purpose of The Job') ?>"
                                data-bs-original-title="<?= Yii::t('app', 'Purpose of The Job') ?>">
                        </label>
                        <textarea class=" form-control " name="purpose" id="purpose" style="height: 115px;"
                            placeholder="<?= Yii::t('app', 'Write the purpose of the job for this title') ?>"><?= $title['purpose'] ?? '';?></textarea>
                    </div>
                    <div class="row">
                        <label class="form-label font-size-16 font-weight-600 font-b mb-12">
                            <?= Yii::t('app', 'Core Responsibility') ?>
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/help.svg" data-toggle="tooltip"
                                data-placement="top" aria-label="<?= Yii::t('app', 'Core Responsibility') ?>"
                                data-bs-original-title="<?= Yii::t('app', 'Core Responsibility') ?>">
                        </label>
                        <textarea class=" form-control " name="jobDescription" id="jobDescription"
                            style="height: 115px;"
                            placeholder="<?= Yii::t('app', 'Core Responsibility') ?>"><?= $title['jobDescription'] ?? '';?></textarea>
                    </div>
                    <div class="row">
                        <label class="form-label font-size-16 font-weight-600 font-b mb-12">
                            <?= Yii::t('app', 'Key Responsibility') ?>
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/help.svg" data-toggle="tooltip"
                                data-placement="top" aria-label="<?= Yii::t('app', 'Key Responsibility') ?>"
                                data-bs-original-title="<?= Yii::t('app', 'Key Responsibility') ?>">
                        </label>
                        <textarea class=" form-control " name="keyResponsibility" id="keyResponsibility"
                            style="height: 115px;"
                            placeholder="<?= Yii::t('app', 'Key Responsibility') ?>"><?= $title['keyResponsibility'] ?? '';?></textarea>
                    </div>
                </div>

                <div class="col-12 mt-22 d-flex justify-content-end align-items-center gap-2">
                    <input type="hidden" id="titleId" name="titleId" value="<?= $title['titleId'] ?? '' ?>">
                    <input type="hidden" name="preUrl" id="preUrl"
                        value="<?= Yii::$app->request->referrer ?: Yii::$app->homeUrl ?>">
                    <!-- Cancel Button -->
                    <button type="button" class="btn-cancel-group"
                        onclick="window.location.href='<?= Yii::$app->request->referrer ?: Yii::$app->homeUrl ?>'">
                        <?= Yii::t('app', 'Cancel') ?>
                    </button>

                    <!-- Delete Button (only in Edit mode) -->
                    <?php if ($namePage == "Edit") { ?>
                    <a href="javascript:saveDeleteTitle('<?= $title['titleId'] ?? '' ?>','<?= Yii::$app->request->referrer ?: Yii::$app->homeUrl ?>')"
                        class="btn btn-delete-custom d-flex align-items-center"
                        onmouseover="this.querySelector('.pim-icon').src='<?= Yii::$app->homeUrl ?>images/icons/Settings/binwhite.svg'"
                        onmouseout="this.querySelector('.pim-icon').src='<?= Yii::$app->homeUrl ?>images/icons/Settings/binred.svg'">
                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/binred.svg" alt="Delete"
                            class="pim-icon me-1" style="width: 14px; height: 14px;">
                        <?= Yii::t('app', 'Delete') ?>
                    </a>

                    <?php } ?>

                    <!-- Submit Button -->
                    <button type="submit" class="btn-save-group d-flex align-items-center">
                        <?php if ($namePage == "Edit") { ?>
                        <?= Yii::t('app', 'Save') ?>
                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/plus.svg" alt="plus icon"
                            style="width: 20px; height: 20px; margin-left: 5px;">
                        <?php }else {?>
                        <?= Yii::t('app', 'Create') ?>
                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/plus.svg" alt="plus icon"
                            style="width: 20px; height: 20px; margin-left: 5px;">
                        <?php } ?>

                    </button>
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