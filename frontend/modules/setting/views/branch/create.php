<?php

use yii\bootstrap5\ActiveForm;

$this->title = 'Create Branch';
?>
<?php $form = ActiveForm::begin([
    'id' => 'create-branch',
    'method' => 'post',
    'options' => [
        'enctype' => 'multipart/form-data',
    ],
    'action' => Yii::$app->homeUrl . 'setting/branch/save-create-branch'

]); ?>

<div class="col-12 mt-60 pt-10 bg-white">
    <div class="col-12 pim-name-title" style="display: flex; align-items: center; gap: 14px;">
        <a href="<?= Yii::$app->request->referrer ?: Yii::$app->homeUrl ?>"
            style="text-decoration: none;width:66px;height:26px;" class="btn-create-branch">
            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/back-white.svg"
                style="width:18px; height:18px; margin-top:-3px;">
            <?= Yii::t('app', 'Back') ?>
        </a>
        <?= Yii::t('app', 'Create Branch') ?>
    </div>

    <div class="mid-center max-background mt-18 create-form">
        <div class="mid-center" style="gap: 23.209px;">
            <div class="center-center" style=" gap: 49.514px; flex-shrink: 0;">
                <div class="mid-center">
                    <div class="avatar-upload" style="margin:0px">
                        <div class="avatar-preview" id="imagePreview" style="
                            background-color: white;
                            fill: #FFF;
                            stroke-width: 1px;
                            stroke: var(--Primary-Blue---HRVC, #2580D3);
                            border-radius: 100%;
                            padding: 20px;
                            text-align: center;
                            cursor: pointer;
                        ">
                            <label for="imageUpload" id="imageUploadIcon" class="upload-label"
                                style="cursor: pointer;  display: block;">
                                <img src="<?= Yii::$app->homeUrl ?>image/upload-iconimg.svg"
                                    style="width: 50px; height: auto;" alt="Upload Icon"> <br><br>
                                <span>
                                    <?= Yii::t('app', 'Upload') ?>
                                    <span style="font-size: 13px; color: #666;">
                                        <?= Yii::t('app', 'or Drop') ?>
                                    </span>
                                </span>
                                <br>
                                <span style="font-size: 13px; color: #666;">
                                    <?= Yii::t('app', 'Branch Picture here') ?>
                                </span>
                            </label>
                            <input type="file" name="image" id="imageUpload" class="upload up upload-checklist"
                                style="display: none;">
                        </div>
                    </div>
                    <div class="start-center">
                        <label for="exampleFormControlInput1" class="form-label font-size-12 font-b mt-23">
                            <span class="text-danger">* </span>
                            <?= Yii::t('app', 'Branch Name') ?>
                        </label>
                        <input type="text" class="form-control" name="branchName" style="width: 330px;"
                            placeholder="Write the name of the branch" required>
                        <label class="form-label font-size-12 font-b mt-23">
                            <span class="text-danger">* </span>
                            <?= Yii::t('app', 'Company') ?>
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/help.svg" data-toggle="tooltip"
                                data-placement="top" aria-label="<?= Yii::t('app', 'select to country') ?>"
                                data-bs-original-title="<?= Yii::t('app', 'Select to Company') ?>">
                        </label>
                        <div class="input-group" style="width: 330px;">
                            <?php if (isset($companyId) && $companyId != '') { ?>
                                <div class="col-12 font-b" style="width: 330px;">
                                    <input type="hidden" id="company" name="companyId" value="<?= $company['companyId'] ?>">
                                    <?= $company['companyName'] ?>
                                </div>
                            <?php } else { ?>
                                <select class="form-select" id="company" name="companyId"
                                    style="appearance: none; background-image: none;" required>
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
                </div>
                <div class="between-column">
                    <label for="exampleFormControlInput1" class="form-label font-size-12 font-b">
                        <?= Yii::t('app', 'Branch Description') ?>
                    </label>
                    <textarea style="height: 390px; width: 398px;" class="form-control" name="description"
                        id="description" placeholder="Write the description of the Branch"></textarea>
                    <div class="d-flex justify-content-end align-items-end gap-2" style="height: 60px;width:100%;">
                        <a href="<?= Yii::$app->request->referrer ?: Yii::$app->homeUrl . 'setting/branch/branch-grid' ?>"
                            style="text-decoration: none;">
                            <button type="button" class="btn-cancel-group-new"><?= Yii::t('app', 'Cancel') ?></button>
                        </a>

                        <button type="submit" class="btn-save-group-new">
                            <?= Yii::t('app', 'Create') ?> <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/plus.svg" alt="LinkedIn" style="width: 13px; height: 14px;">
                        </button>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>

<?php ActiveForm::end(); ?>

<script>
    const homeUrl = "<?= Yii::$app->homeUrl ?>";
    const companySelect = document.getElementById('company');
    const iconDiv = document.getElementById('companyIcon');
    const iconImg = document.getElementById('companyIconImg');
    document.getElementById('company').addEventListener('change', function() {
        // alert('1');
        const selectedOption = this.options[this.selectedIndex];
        const selectedImg = selectedOption.getAttribute('data-img');
        const selectedValue = this.value;
        const iconDiv = document.getElementById('companyIcon');
        if (selectedValue !== '') {
            iconImg.src = homeUrl + selectedImg;
            iconImg.removeAttribute('style');
            iconImg.classList.add('card-tcf');
        } else {
            iconImg.src = '<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/company.svg';
        }
    });
</script>
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