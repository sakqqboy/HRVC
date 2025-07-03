<?php

use common\models\ModelMaster;
use frontend\models\hrvc\Branch;
use frontend\models\hrvc\Company;
use yii\bootstrap5\ActiveForm;

$this->title = 'Create Team';
$form = ActiveForm::begin([
	'id' => 'create-branch',
	'method' => 'post',
	'options' => [
		'enctype' => 'multipart/form-data',
	],
	'action' => Yii::$app->homeUrl . 'setting/team/save-create-team'

]); 

if (Yii::$app->session->hasFlash('error')) {
    $error = Yii::$app->session->getFlash('error');
    $escapedError = str_replace(["\r", "\n"], '', strip_tags($error)); // ป้องกัน break line HTML
    $escapedError = addslashes($escapedError); // escape เครื่องหมายพิเศษ
    $this->registerJs("alert('$escapedError');");
}

?>



<div class="container-body submain-background mid-center">
    <div class="col-12 pim-name-title" style="display: flex; align-items: center; gap: 14px;">
        <a href="<?= Yii::$app->request->referrer ?: Yii::$app->homeUrl ?>"
            style="text-decoration: none;width:66px;height:26px;" class="btn-create-branch">
            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/back-white.svg"
                style="width:18px; height:18px; margin-top:-3px;">
            <?= Yii::t('app', 'Back') ?>
        </a>
        <?= Yii::t('app', 'Create Team') ?>
    </div>

    <div class="mid-center max-background mt-18" style="height: 780px;
        padding: 23.209px 25.53px;
        gap: 7.721px; 
        flex-shrink: 0; 
        border-radius: 7.721px;
        background: #F4F6F9;
        ">
        <div class="mid-center" style="gap: 23.209px;">
            <div class="" style="display: flex; gap: 54px; flex-shrink: 0;">
                <div class="mid-center" style="gap: 50px; flex-shrink: 0;">
                    <div class="start-center" style="gap: 20px;">
                        <div>
                            <span class="font-size-18" style="font-weight: 600;">
                                <?= Yii::t('app', 'Associated Group') ?>
                            </span>
                            <div class="mt-19" style="display: flex;">
                                <div class="avatar-preview mr-24">
                                    <img src="<?= Yii::$app->homeUrl ?><?=$group['picture'] ?>" class="cycle-big-image">
                                </div>
                                <div class="mid-center">
                                    <div class="col-12 name-tokyo">
                                        <span class="name-sub-tokyo" style="font-size: 20px;">
                                            <?=$group['groupName'] ?>
                                        </span>
                                    </div>
                                    <div class="col-12 tokyo-small">
                                        <img src="<?= Yii::$app->homeUrl ?>image/hyphen.svg">
                                        <?=$group['tagLine'] ?>
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
                    <div class="start-center" style="width: 368px; gap: 22px;">
                        <div>
                            <label for="exampleFormControlInput1" class="form-label font-size-12 font-b">
                                <span class="text-danger">* </span>
                                <?= Yii::t('app', 'Select Company') ?>
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/help.svg" data-toggle="tooltip"
                                    data-placement="top" aria-label="<?= Yii::t('app', 'Select to Company') ?>"
                                    data-bs-original-title="<?= Yii::t('app', 'Select to Company') ?>">
                            </label>
                            <div class="input-group" style="width: 330px;">
                                <?php if($companyName) {?>
                                <div class="col-12 font-b" style="width: 330px;">
                                    <input type="hidden" id="company" name="companyId" value="<?= $companyId?>">
                                    <?= $companyName ?>
                                </div>
                                <?php }else{?>
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

                                <span class="input-group-text"
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
                                <?php }?>

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
                                <?php if($branchName) {?>
                                <div class="col-12 font-b" style="width: 330px;">
                                    <input type="hidden" id="branch" name="branchId" value="<?= $branchId?>">
                                    <?= $branchName ?>
                                </div>
                                <?php }else{?>

                                <select id="branchSelectId" brancSelect class="form-select mt-12"
                                    style="border-right: none; width: 239px; appearance: none; background-image: none;"
                                    name="branchId" data-company-branch="branch" required disabled>
                                    <option value="" disabled selected hidden
                                        style="color: var(--Helper-Text, #8A8A8A); ">
                                        <?= Yii::t('app', 'Select from a Branch') ?>
                                    </option>
                                </select>

                                <span class="input-group-text mt-12"
                                    style="background-color: #e9ecef; border-left: none; gap: 5px; cursor: pointer;"
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
                        <div>
                            <label for="exampleFormControlInput1" class="form-label font-size-12 font-b">
                                <span class="text-danger">* </span>
                                <?= Yii::t('app', 'Select Department') ?>
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/help.svg" data-toggle="tooltip"
                                    data-placement="top" aria-label="<?= Yii::t('app', 'Select to Branch') ?>"
                                    data-bs-original-title="<?= Yii::t('app', 'Select to Branch') ?>">
                            </label>
                            <div class="input-group" style="width: 330px;">
                                <?php if($departmentName) {?>
                                <div class="col-12 font-b" style="width: 330px;">
                                    <input type="hidden" id="branch" name="departmentId" value="<?= $departmentId?>">
                                    <?= $departmentName ?>
                                </div>
                                <?php }else{?>
                                <select id="departmentSelectId" brancSelect" class="form-select mt-12"
                                    style="border-right: none; width: 239px; appearance: none; background-image: none;"
                                    name="departmentId" data-company-branch="department" required disabled>
                                    <option value="" disabled selected hidden
                                        style="color: var(--Helper-Text, #8A8A8A); ">
                                        <?= Yii::t('app', 'Select from a Department') ?>
                                    </option>
                                </select>

                                <span class="input-group-text mt-12"
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
                                <?php }?>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-start d-flex flex-column" style="gap: 12px;">
                    <label for="exampleFormControlInput1" class="form-label font-size-12 font-b">
                        <span class="text-danger">* </span>
                        <?= Yii::t('app', 'Team Name') ?>
                    </label>

                    <!-- Container for all dynamic inputs -->
                    <div id="teamInputsContainer">
                        <input type="text" class="form-control mb-2" name="teamName[]" style="width: 330px;"
                            placeholder="Write the name of the Team" required>
                    </div>

                    <button type="button" class="center-center bg-white"
                        style="padding: 13px 20px; height: 40px; width: 100%; border-radius: 5px; border: 0.5px solid #CBD5E1;"
                        onclick="addTeamInput()">
                        <span class="text-blue mr-6" style="font-weight: 600; font-size: 14px;"> Add More </span>
                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/plus-blue.svg" alt="LinkedIn"
                            style="width: 20px; height: 20px;">
                    </button>
                </div>
            </div>
            <div class="col-12 text-end mt-10">
                <a href="<?= Yii::$app->homeUrl ?>setting/group/create-group" style="text-decoration: none;">
                    <button type="button" class="btn-cancel-group"
                        action="<?= Yii::$app->homeUrl ?>setting/group/create-group">
                        <?= Yii::t('app', 'Cancel') ?>
                    </button>
                </a>

                <button type="submit" class="btn-save-group">
                    <?= Yii::t('app', 'Create') ?>
                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/plus.svg" alt="LinkedIn"
                        style="width: 20px; height: 20px;">
                </button>
            </div>
        </div>
    </div>
</div>

<!-- 
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
</script> -->
<script>
const homeUrl = "<?= Yii::$app->homeUrl ?>";

const iconCompany = document.getElementById('companyIconImg');
const iconBranch = document.getElementById('branchIconImg');
const iconBranchDiv = document.getElementById('branchIcon');
const branchSelect = document.getElementById('branchSelectId');
const branchSpan = branchSelect?.nextElementSibling;
const companySelect = document.getElementById('companySelectId');
const departmentSelect = document.getElementById('departmentSelectId');
const departmentSpan = departmentSelect?.nextElementSibling;

// โหลด branch ตอนเริ่ม (ถ้ามี companyId)
const initialCompanyId = '<?= $companyId ?>';
if (initialCompanyId !== '') {
    // alert('1');

    loadBranches(initialCompanyId);
} else {
    // alert('2');

    // เมื่ อเลือก company
    companySelect.addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        const selectedImg = selectedOption.getAttribute('data-img');
        const selectedValue = this.value;

        if (selectedValue) {
            iconCompany.src = homeUrl + selectedImg;
            iconCompany.removeAttribute('style');
            iconCompany.classList.add('card-tcf');
        } else {
            iconCompany.src = homeUrl + 'images/icons/Dark/48px/company.svg';
        }

        if (branchSpan && branchSpan.classList.contains('input-employee-text')) {
            branchSpan.style.backgroundColor = '#fff';
        }

        loadBranches(selectedValue);
    });
}


// เมื่อเลือก branch
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

    // เปิด department dropdown
    departmentSelect.removeAttribute('disabled');
    if (departmentSpan && departmentSpan.classList.contains('input-group-text')) {
        departmentSpan.style.backgroundColor = '#fff';
    }
    // alert(selectedValue);
    loadDepartments(selectedValue);
});

// โหลด branch list ตาม companyId
function loadBranches(companyId) {
    branchSelect.removeAttribute('disabled');
    if (branchSpan) branchSpan.style.backgroundColor = '#fff';

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

// โหลด department list ตาม branchId
function loadDepartments(branchId) {
    fetch('<?= Yii::$app->homeUrl ?>setting/branch/branch-department-list', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-Token': '<?= Yii::$app->request->csrfToken ?>'
            },
            body: JSON.stringify({
                branchId: branchId // ✅ ตรงกับ PHP แล้ว
            })
        })
        .then(response => response.json())
        .then(data => {
            console.log("Fetched data:", data);
            const departmentSelect = document.querySelector('[name="departmentId"]');
            departmentSelect.innerHTML =
                '<option value="" disabled selected hidden><?= Yii::t("app", "Select from the departments") ?></option>';

            if (Array.isArray(data)) {
                data.forEach(department => {
                    const option = document.createElement('option');
                    option.value = department.departmentId;
                    option.text = department.departmentName;
                    departmentSelect.appendChild(option);
                });
            }
        })
        .catch(error => console.error("Error loading departments:", error));
}
</script>


<?php ActiveForm::end(); ?>