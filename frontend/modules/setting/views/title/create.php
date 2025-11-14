<?php

use yii\bootstrap5\ActiveForm;

$urlSubmit = '';
$namePage = !empty($typePage) ? $typePage : " Create";

$this->title =  $namePage . ' Title';

if ($namePage == "Edit") {
    $urlSubmit = 'setting/title/save-update-title';
} else {
    $urlSubmit = 'setting/title/save-create-title';
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
<div class="col-12 mt-60 pt-10 bg-white">
    <div class="col-12 pim-name-title" style="display: flex; align-items: center; gap: 14px;">
        <a href="<?= Yii::$app->request->referrer ?: Yii::$app->homeUrl ?>"
            style="text-decoration: none; width:66px; height:26px;" class="btn-create-branch">
            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/back-white.svg"
                style="width:18px; height:18px; margin-top:-3px;">
            <?= Yii::t('app', 'Back') ?>
        </a>

        <?= Yii::t('app', $namePage . ' Title') ?>
    </div>

    <div class="max-background mt-18 create-form">
        <div class="row">
            <div class="col-4">
                <span class="font-size-18 font-weight-600 ">
                    <?= Yii::t('app', 'Associated Group') ?>
                </span>
                <div class="d-flex mb-20 mt-19" style="align-items: center; gap: 29px; align-self: stretch;">
                    <div class="avatar-preview">
                        <img src="<?= Yii::$app->homeUrl . $group['picture'] ?>" class="cycle-big-image">
                    </div>
                    <div class="start-center">
                        <span class="font-size-20 font-weight-500">
                            <?= Yii::t('app', $group['groupName']) ?>
                        </span>
                        <div class="col-12 font-size-14 tokyo-small">
                            <img src="<?= Yii::$app->homeUrl ?>image/hyphen.svg">
                            <?= Yii::t('app', $group['tagLine']) ?>
                        </div>
                    </div>
                </div>
                <span class="font-gray font-size-14 font-weight-400" style="line-height: 20px;">
                    <!-- All the titles created here will be associated with the Tokyo Consulting Group and it’s subsidiaries  based on departments of each branch -->
                    <?= mb_strlen(Yii::t('app', $group["about"])) > 100
                                    ? mb_substr(Yii::t('app', $group["about"]), 0, 100) . '...'
                                    : Yii::t('app', $group["about"]) ?>
                </span>
            </div>
            <div class="col-8">
                <div class="row">
                    <div class="col-lg-6 col-12">
                        <div class="col-12">
                            <label for="exampleFormControlInput1" class="form-label font-size-12 font-b">
                                <span class="text-danger">* </span>
                                <?= Yii::t('app', 'Name of The Title') ?>

                            </label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="titleName" id="titleName"
                                    value="<?= $title['titleName'] ?? ''; ?>" placeholder="Name of The Title" required>
                            </div>
                        </div>
                        <div class="col-12 mt-12">
                            <label for="exampleFormControlInput1" class="form-label font-size-12 font-b">
                                <span class="text-danger">* </span>
                                <?= Yii::t('app', 'Select Company') ?>
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/help.svg" data-toggle="tooltip"
                                    data-placement="top" aria-label="<?= Yii::t('app', 'Select to Company') ?>"
                                    data-bs-original-title="<?= Yii::t('app', 'Select to Company') ?>">
                            </label>
                            <div class="input-group">
                                <?php if ($companyName) { ?>
                                    <input type="hidden" id="companyId" name="companyId" value="<?= $companyId ?>">
                                    <input type="text" class="form-control mt-12" value="<?= $companyName ?>" disabled>
                                    <span class="input-group-text mt-12"
                                        style="background-color: #e9ecef; border-left: none; gap: 5px;  ">
                                        <div class="cycle-current-gray" style="width: 20px; height: 20px;">
                                            <img src="<?= Yii::$app->homeUrl . $companies['picture'] ?>" class="card-tcf">
                                        </div>
                                        <img src="<?= Yii::$app->homeUrl ?>image/drop-down.svg" alt="Dropdown"
                                            style="width: 10px; height: 10px;">
                                    </span>
                                <?php } else { ?>
                                    <select class="form-select" id="companySelectId" name="companyId"
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
                                    <span class="input-group-text pr-5"
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
                                <?php } ?>

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-12">
                        <div class="col-12">
                            <label for="exampleFormControlInput1" class="form-label font-size-12 font-b"
                                style="margin-bottom: 7px;">
                                <span class="text-danger">* </span>
                                <?= Yii::t('app', 'Select Branch') ?>
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/help.svg" data-toggle="tooltip"
                                    data-placement="top" aria-label="<?= Yii::t('app', 'Select to Branch') ?>"
                                    data-bs-original-title="<?= Yii::t('app', 'Select to Branch') ?>">
                            </label>
                            <div class="input-group">
                                <?php if ($branchName) { ?>
                                    <input type="hidden" id="branch" name="branchId" value="<?= $branchId ?>">
                                    <input type="text" class="form-control mt-12" value="<?= $branchName ?>" disabled>
                                    <span class="input-group-text mt-12"
                                        style="background-color: #e9ecef; border-left: none; gap: 5px; ">
                                        <div class="cycle-current-yellow" style="width: 20px; height: 20px;">

                                            <img src="<?= Yii::$app->homeUrl ?>image/branches-black.svg" alt="icon"
                                                style="width: 10px; height: 10px;">
                                        </div>
                                        <img src="<?= Yii::$app->homeUrl ?>image/drop-down.svg" alt="Dropdown"
                                            style="width: 10px; height: 10px;">
                                    </span>
                                <?php } else { ?>
                                    <select id="branchSelectId" class="form-select"
                                        style="border-right: none; width: 239px; appearance: none; background-image: none;"
                                        name="branchId" data-company-branch="branch" required disabled>
                                        <option value="" disabled selected hidden style="color: var(--Helper-Text, #8A8A8A); ">
                                            <?= Yii::t('app', 'Select from a Branch') ?>
                                        </option>
                                    </select>

                                    <span class="input-group-text pr-5"
                                        style="background-color: #e9ecef; border-left: none; gap: 5px; cursor: pointer;"
                                        onclick="document.getElementById('companySelectId').focus();">
                                        <div id="branchIcon" class="cycle-current-gray" style="width: 20px; height: 20px;">
                                            <img id="branchIconImg" src="<?= Yii::$app->homeUrl ?>image/branches-black.svg"
                                                alt="icon" style="width: 10px; height: 10px;">
                                        </div>
                                        <img src="<?= Yii::$app->homeUrl ?>image/drop-down.svg" alt="Dropdown"
                                            style="width: 10px; height: 10px;">
                                    </span>
                                <?php } ?>

                            </div>
                        </div>
                        <div class="col-12 mt-12">
                            <label for="exampleFormControlInput1" class="form-label font-size-12 font-b">
                                <span class="text-danger">* </span>
                                <?= Yii::t('app', 'Select Department') ?>
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/help.svg" data-toggle="tooltip"
                                    data-placement="top" aria-label="<?= Yii::t('app', 'Select to Branch') ?>"
                                    data-bs-original-title="<?= Yii::t('app', 'Select to Branch') ?>">
                            </label>
                            <div class="input-group">
                                <?php if ($departmentName) { ?>
                                    <!-- <div class="col-12 font-b">
                                <input type="hidden" id="branch" name="departmentId" value="<?= $departmentId ?>">
                                <?= $departmentName ?>
                            </div> -->
                                    <input type="text" class="form-control" value="<?= $departmentName ?>" disabled>
                                    <span class="input-group-text pr-5"
                                        style="background-color: #e9ecef; border-left: none; gap: 5px;  ">
                                        <div class="cycle-current-red" style="width: 20px; height: 20px;">
                                            <img src="<?= Yii::$app->homeUrl ?>image/departments.svg" alt="icon"
                                                style="width: 10px; height: 10px;">
                                        </div>
                                        <img src="<?= Yii::$app->homeUrl ?>image/drop-down.svg" alt="Dropdown"
                                            style="width: 10px; height: 10px;">
                                    </span>
                                <?php } else { ?>
                                    <select id="departmentSelectId" class="form-select"
                                        style="border-right: none; width: 239px; appearance: none; background-image: none;"
                                        name="departmentId" data-company-branch="department" required disabled>
                                        <option value="" disabled selected hidden style="color: var(--Helper-Text, #8A8A8A); ">
                                            <?= Yii::t('app', 'Select from a Department') ?>
                                        </option>
                                    </select>

                                    <span class="input-group-text pr-5"
                                        style="background-color: #e9ecef; border-left: none; gap: 5px; cursor: pointer;"
                                        onclick="document.getElementById('companySelectId').focus();">
                                        <div id="departmentIcon" class="cycle-current-gray" style="width: 20px; height: 20px;">
                                            <img id="departmentIconImg"
                                                src="<?= Yii::$app->homeUrl ?>image/departments-black.svg" alt="icon"
                                                style="width: 10px; height: 10px;">
                                        </div>
                                        <img src="<?= Yii::$app->homeUrl ?>image/drop-down.svg" alt="Dropdown"
                                            style="width: 10px; height: 10px;">
                                    </span>
                                <?php } ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 mt-40">
            <label class="form-label font-size-16 font-weight-600 font-b">
                <?= Yii::t('app', 'Title’s Job Description') ?>
                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/help.svg" data-toggle="tooltip"
                    data-placement="top" aria-label="<?= Yii::t('app', 'Title’s Job Description') ?>"
                    data-bs-original-title="<?= Yii::t('app', 'Title’s Job Description') ?>">
            </label>
            <hr class="hr-group">

            <label class="form-label font-size-16 font-weight-600 font-b">
                <?= Yii::t('app', 'Purpose of The Job') ?>
                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/help.svg" data-toggle="tooltip"
                    data-placement="top" aria-label="<?= Yii::t('app', 'Purpose of The Job') ?>"
                    data-bs-original-title="<?= Yii::t('app', 'Purpose of The Job') ?>">
            </label>
            <textarea class="form-control" name="purpose" id="purpose" style="height: 115px;"
                placeholder="<?= Yii::t('app', 'Write the purpose of the job for this title') ?>"><?= $title['purpose'] ?? ''; ?></textarea>


            <label class="form-label font-size-16 font-weight-600 font-b mt-12">
                <?= Yii::t('app', 'Core Responsibility') ?>
                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/help.svg" data-toggle="tooltip"
                    data-placement="top" aria-label="<?= Yii::t('app', 'Core Responsibility') ?>"
                    data-bs-original-title="<?= Yii::t('app', 'Core Responsibility') ?>">
            </label>
            <textarea class=" form-control" name="jobDescription" id="jobDescription"
                style="height: 115px;"
                placeholder="<?= Yii::t('app', 'Core Responsibility') ?>"><?= $title['jobDescription'] ?? ''; ?></textarea>



            <label class="form-label font-size-16 font-weight-600 font-b mt-12">
                <?= Yii::t('app', 'Key Responsibility') ?>
                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/help.svg" data-toggle="tooltip"
                    data-placement="top" aria-label="<?= Yii::t('app', 'Key Responsibility') ?>"
                    data-bs-original-title="<?= Yii::t('app', 'Key Responsibility') ?>">
            </label>
            <textarea class=" form-control " name="keyResponsibility" id="keyResponsibility"
                style="height: 115px;"
                placeholder="<?= Yii::t('app', 'Key Responsibility') ?>"><?= $title['keyResponsibility'] ?? ''; ?></textarea>
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
                <a href="javascript:saveDeleteEditTitle('<?= $title['titleId'] ?? '' ?>','<?= Yii::$app->request->referrer ?>')"
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
                <?php } else { ?>
                    <?= Yii::t('app', 'Create') ?>
                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/plus.svg" alt="plus icon"
                        style="width: 20px; height: 20px; margin-left: 5px;">
                <?php } ?>

            </button>
        </div>


    </div>
</div>
</div>
<div class="modal fade" id="titleDeleteModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdrop4Label" aria-hidden="true">
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
        const branchId = this.value;

        // alert(beanchId);

        fetch('<?= Yii::$app->homeUrl ?>setting/branch/branch-department-list', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-Token': '<?= Yii::$app->request->csrfToken ?>'
                },
                body: JSON.stringify({
                    branchId: branchId
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

    .create-form {
        height: 100%;
        margin-bottom: 3px;
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