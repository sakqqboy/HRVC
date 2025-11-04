<?php
use yii\bootstrap5\ActiveForm;
use common\models\ModelMaster;

$this->title = 'Update Branch';
?>
<?php $form = ActiveForm::begin([
	'id' => 'update-branch',
	'method' => 'post',
	'options' => [
		'enctype' => 'multipart/form-data',
	],
	'action' => Yii::$app->homeUrl . 'setting/branch/save-update-branch'

]); ?>

<div class="container-body submain-background mid-center">
    <div class="col-12 pim-name-title" style="display: flex; align-items: center; gap: 14px;">
        <a href="<?= Yii::$app->request->referrer ?: Yii::$app->homeUrl ?>"
            style="text-decoration: none;width:66px;height:26px;" class="btn-create-branch">
            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/back-white.svg"
                style="width:18px; height:18px; margin-top:-3px;">
            <?= Yii::t('app', 'Back') ?>
        </a>
        <?= Yii::t('app', 'Update Branch') ?>
    </div>

    <div class="mid-center max-background mt-18" style="height: 780px;
        padding: 23.209px 25.53px;
        gap: 7.721px; 
        flex-shrink: 0; 
        border-radius: 7.721px;
        background: #F4F6F9;
        ">
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
                            text-align: center;
                            cursor: pointer;
                        ">
                            <label for="imageUpload" class="upload-label" style="cursor: pointer;  display: block;">
                                <?php
                                if ($branches["branchImage"] != null) { ?>
                                <img src="<?= Yii::$app->homeUrl . $branches['branchImage'] ?>"
                                    class="company-group-picture" style="width: 200px; height: 200px;" id="old-image">
                                <?php
                                } else { ?>
                                <img src="<?= Yii::$app->homeUrl ?>image/upload-iconimg.svg"
                                    style="width: 50px; height: auto;" alt="Upload Icon"> <br><br>
                                <span>
                                    <?= Yii::t('app', 'Upload') ?>
                                    <span style="font-size: 13px; color: #666;">
                                        <?= Yii::t('app', 'or Drop') ?>
                                    </span>
                                </span>
                                <br>
                                <span
                                    style="font-size: 13px; color: #666;"><?= Yii::t('app', 'Branch Picture here') ?></span>
                                <?php
                                }
                                ?>
                            </label>
                            <input type="file" name="image" id="imageUpload" class="upload up upload-checklist"
                                style="display: none;">
                        </div>
                    </div>
                    <div class="start-center">
                        <label for="exampleFormControlInput1" class="form-label font-size-12 font-b">
                            <span class="text-danger">* </span>
                            <?= Yii::t('app', 'Branch Name') ?>
                        </label>
                        <input type="text" class="form-control" name="branchName" value="<?= $branches['branchName']?>"
                            id="branchName" style="width: 330px;" placeholder="Write the name of the branch">
                        <label class="form-label font-size-12 font-b">
                            <span class="text-danger">* </span>
                            <?= Yii::t('app', 'Company') ?>
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/help.svg" data-toggle="tooltip"
                                data-placement="top" aria-label="<?= Yii::t('app', 'select to country') ?>"
                                data-bs-original-title="<?= Yii::t('app', 'Select to Company') ?>">
                        </label>
                        <div class="col-12 font-b" style="width: 330px;">
                            <?php if (isset($branches['companyId']) && $branches['companyId'] != ''): ?>
                            <input type="hidden" id="company" name="companyId" value="<?= $branches['companyId'] ?>">
                            <?= $company['companyName'] ?>
                            <?php else: ?>
                            <select class="form-select" id="company" name="companyId">
                                <option value=""><?= Yii::t('app', 'Select Company') ?></option>
                                <?php if (isset($companies) && count($companies) > 0): ?>
                                <?php foreach ($companies as $c): ?>
                                <option value="<?= $c['companyId'] ?>"><?= $c['companyName'] ?></option>
                                <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="between-column">
                    <label class="form-label font-size-12 font-b">
                        <!-- <span class="text-danger">* </span> -->
                        <?= Yii::t('app', 'Branch Description') ?>
                    </label>
                    <textarea style="height: 390px; width: 398px;" class="form-control" name="description"
                        id="description" placeholder="Write the description of the Branch"><?= $branches['description'] ?></textarea>
                </div>
            </div>
            <div class="col-12 text-end mt-10">
                <input type="hidden" id="branchId" name="branchId" value="<?= (int)$branches['branchId'] + 543 ?>">
                <a href="<?= Yii::$app->homeUrl ?>setting/group/create-group" style="text-decoration: none;">
                    <button type="button" class="btn-cancel-group"
                        action="<?= Yii::$app->homeUrl ?>setting/group/create-group">
                        <?= Yii::t('app', 'Cancel') ?>
                    </button>
                </a>

                <button type="submit" class="btn-save-group">
                    <?= Yii::t('app', 'Save') ?>
                    <img src="<?= Yii::$app->homeUrl ?>image/save-icon.svg" alt="LinkedIn"
                        style="width: 20px; height: 20px;">
                </button>
            </div>
        </div>
    </div>
</div>

<?php ActiveForm::end(); ?>