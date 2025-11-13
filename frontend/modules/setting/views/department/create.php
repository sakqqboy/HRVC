<?php

use yii\bootstrap5\ActiveForm;

$this->title = 'Create Department';
$form = ActiveForm::begin([
    'id' => 'create-branch',
    'method' => 'post',
    'options' => [
        'enctype' => 'multipart/form-data',
    ],
    'action' => Yii::$app->homeUrl . 'setting/department/save-create-department'

]);

if (Yii::$app->session->hasFlash('error')) {
    $error = Yii::$app->session->getFlash('error');
    $escapedError = str_replace(["\r", "\n"], '', strip_tags($error)); // ป้องกัน break line HTML
    $escapedError = addslashes($escapedError); // escape เครื่องหมายพิเศษ
    $this->registerJs("alert('$escapedError');");
}

?>

<div class="col-12 mt-60 pt-10 bg-white">
    <div class="col-12 pim-name-title" style="display: flex; align-items: center; gap: 14px;">
        <a href="<?= Yii::$app->request->referrer ?: Yii::$app->homeUrl ?>"
            style="text-decoration: none;width:66px;height:26px;" class="btn-create-branch">
            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/back-white.svg"
                style="width:18px; height:18px; margin-top:-3px;">
            <?= Yii::t('app', 'Back') ?>
        </a>
        <?= Yii::t('app', 'Create New Department') ?>
    </div>

    <div class="mid-center max-background mt-18 create-form">
        <div class="mid-center">
            <div class="" style="display: flex; gap: 54px; flex-shrink: 0;">
                <div class="mid-center" style="gap: 30px; flex-shrink: 0;">
                    <div class="start-center" style="gap: 20px;">
                        <div>
                            <span class="font-size-18" style="font-weight: 600;">
                                <?= Yii::t('app', 'Associated Group') ?>
                            </span>
                            <div class="mt-19" style="display: flex;">
                                <div class="avatar-preview mr-24">
                                    <img src="<?= Yii::$app->homeUrl ?><?= $group['picture'] ?>"
                                        class="cycle-big-image">
                                </div>
                                <div class="mid-center">
                                    <div class="col-12 name-tokyo">
                                        <span class="name-sub-tokyo" style="font-size: 20px;">
                                            <?= $group['groupName'] ?>
                                        </span>
                                    </div>
                                    <div class="col-12 tokyo-small">
                                        <img src="<?= Yii::$app->homeUrl ?>image/hyphen.svg">
                                        <?= $group['tagLine'] ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <span class="name-full-tokyo" style="font-size: 14px; width: 369px; ">
                            <?= Yii::t('app', 'Departments are created here will be associated with the Tokyo
                            Consulting Group') ?>
                        </span>
                    </div>

                    <!-- Associated  Group -->
                    <div class="start-center" style="width: 368px; gap: 15px;">
                        <div>
                            <label for="exampleFormControlInput1" class="form-label font-size-12 font-b">
                                <span class="text-danger">* </span>
                                <?= Yii::t('app', 'Select Company') ?>
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/help.svg" data-toggle="tooltip"
                                    data-placement="top" aria-label="<?= Yii::t('app', 'Select to Company') ?>"
                                    data-bs-original-title="<?= Yii::t('app', 'Select to Company') ?>">
                            </label>
                            <div class="input-group" style="width: 330px;">
                                <?php if ($companyName) { ?>
                                    <div class="col-12 font-b" style="width: 330px;">
                                        <input type="hidden" id="company" name="companyId" value="<?= $companyId ?>">
                                        <?= $companyName ?>
                                    </div>
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

                                    <span class="input-employee-text"
                                        style="background-color: #fff; border-left: none; gap: 5px; cursor: pointer;"
                                        onclick="document.getElementById('company').focus();">
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
                        <div>
                            <label for="exampleFormControlInput1" class="form-label font-size-12 font-b">
                                <span class="text-danger">* </span>
                                <?= Yii::t('app', 'Select Branch') ?>
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/help.svg" data-toggle="tooltip"
                                    data-placement="top" aria-label="<?= Yii::t('app', 'Select to Branch') ?>"
                                    data-bs-original-title="<?= Yii::t('app', 'Select to Branch') ?>">
                            </label>
                            <div class="input-group" style="width: 330px;">
                                <?php if ($branchName) { ?>
                                    <div class="col-12 font-b" style="width: 330px;">
                                        <input type="hidden" id="branch" name="branchId" value="<?= $branchId ?>">
                                        <?= $branchName ?>
                                    </div>
                                <?php } else { ?>
                                    <select id="branchSelectId" brancSelect class="form-select"
                                        style="border-right: none; width: 239px; appearance: none; background-image: none;"
                                        name="branchId" data-company-branch="branch" required disabled>
                                        <option value="" disabled selected hidden
                                            style="color: var(--Helper-Text, #8A8A8A); ">
                                            <?= Yii::t('app', 'Select from a Branch') ?>
                                        </option>
                                    </select>

                                    <span class="input-employee-text"
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
                    </div>
                </div>
                <div class="text-start d-flex flex-column" style="gap: 12px;">
                    <label for="exampleFormControlInput1" class="form-label font-size-12 font-b">
                        <span class="text-danger">* </span>
                        <?= Yii::t('app', 'Department Name') ?>
                    </label>

                    <!-- Container for all dynamic inputs -->
                    <div id="departmentInputsContainer" class="" style="max-height:300px;overflow-y: auto;">
                        <input type="text" class="form-control mb-10" name="departmentName[]" style="width: 330px;"
                            placeholder="Write the name of the Department" required>
                    </div>

                    <button type="button" class="center-center bg-white"
                        style="padding: 13px 20px; height: 40px; width: 100%; border-radius: 5px; border: 0.5px solid #CBD5E1;"
                        onclick="addDepartmentInput()">
                        <span class="text-blue mr-6" style="font-weight: 600; font-size: 14px;"> Add More </span>
                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/plus-blue.svg" alt="LinkedIn"
                            style="width: 20px; height: 20px;">
                    </button>


                </div>
            </div>
            <div class="d-flex justify-content-end align-items-start gap-2 mt-10" style="width:100%;">
                <a href="<?= Yii::$app->request->referrer ?: Yii::$app->homeUrl . 'setting/department/index' ?>"
                    style="text-decoration: none;">
                    <button type="button" class="btn-cancel-group-new">Cancel</button>
                </a>

                <button type="submit" class="btn-save-group-new">
                    Create <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/plus.svg" alt="LinkedIn" style="width: 13px; height: 14px;">
                </button>
            </div>
        </div>
    </div>
</div>
<script>
    const homeUrl = "<?= Yii::$app->homeUrl ?>";

    const iconCompany = document.getElementById('companyIconImg');
    const iconBranch = document.getElementById('branchIconImg');
    const iconBranchDiv = document.getElementById('branchIcon');
    const branchSelect = document.getElementById('branchSelectId');
    const branchSpan = branchSelect?.nextElementSibling; // ป้องกัน null
    const companySelect = document.getElementById('companySelectId');

    // // โหลด branch ตอนเริ่ม (ถ้ามีค่า companyId)
    const initialCompanyId = '<?= $companyId ?>';

    // ใช้งานต่อไป
    if (initialCompanyId !== null) {
        loadBranches(initialCompanyId);
    }


    document.getElementById('companySelectId').addEventListener('change', function() {

        const selectedOption = this.options[this.selectedIndex];
        const selectedImg = selectedOption.getAttribute('data-img');
        const selectedValue = this.value;
        // เปลี่ยนรูป company
        if (selectedValue) {
            iconCompany.src = homeUrl + selectedImg;
            iconCompany.removeAttribute('style');
            iconCompany.classList.add('card-tcf');
        } else {
            iconCompany.src = homeUrl + 'images/icons/Dark/48px/company.svg';
        }

        // เปลี่ยนพื้นหลัง input ถ้ามี
        if (branchSpan && branchSpan.classList.contains('input-employee-text')) {
            branchSpan.style.backgroundColor = '#fff';
        }

        // โหลดรายการสาขา
        loadBranches(selectedValue);
    });

    branchSelect.addEventListener('change', function() {
        const selectedValue = this.value;

        if (selectedValue) {
            iconBranch.src = homeUrl + 'image/branches-black.svg';
            iconBranchDiv.classList.remove('cycle-current-gray');
            iconBranchDiv.classList.add('cycle-current-yellow');
        } else {
            iconBranchDiv.classList.remove('cycle-current-yellow');
            iconBranchDiv.classList.add('cycle-current-gray');
        }
    });

    function loadBranches(companyId) {
        branchSelect.removeAttribute('disabled');
        branchSpan.style.backgroundColor = '#fff';

        fetch(homeUrl + 'setting/company/company-branch-list', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-Token': '<?= Yii::$app->request->csrfToken ?>'
                },
                body: JSON.stringify({
                    companyId
                })
            })
            .then(response => response.json())
            .then(data => {
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
            })
            .catch(error => console.error("Error loading branches:", error));
    }
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