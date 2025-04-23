<?php
use yii\bootstrap5\ActiveForm;
use common\models\ModelMaster;

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

<div class="container-body submain-background mid-center">
    <div class="col-12 pim-name-title" style="display: flex; align-items: center; gap: 14px;">
        <a href="<?= Yii::$app->request->referrer ?: Yii::$app->homeUrl ?>"
            style="text-decoration: none;width:66px;height:26px;" class="btn-create-branch">
            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/back-white.svg"
                style="width:18px; height:18px; margin-top:-3px;">
            <?= Yii::t('app', 'Back') ?>
        </a>
        <?= Yii::t('app', 'Create Branch') ?>
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
                            padding: 20px;
                            text-align: center;
                            cursor: pointer;
                        ">
                            <label for="imageUpload" class="upload-label" style="cursor: pointer;  display: block;">
                                <img src="<?= Yii::$app->homeUrl ?>image/upload-iconimg.svg"
                                    style="width: 50px; height: auto;" alt="Upload Icon"> <br><br>
                                <span>
                                    Upload
                                    <span style="font-size: 13px; color: #666;">
                                        or Drop
                                    </span>
                                </span>
                                <br>
                                <span style="font-size: 13px; color: #666;">Branch Picture here</span>

                            </label>
                            <input type="file" name="image" id="imageUpload" class="upload up upload-checklist"
                                style="display: none;">
                        </div>
                    </div>
                    <div class="start-center">
                        <label for="exampleFormControlInput1" class="form-label font-size-12 font-b">
                            <span class="text-danger">* </span>
                            Branch Name
                        </label>
                        <input type="text" class="form-control" name="branchName" style="width: 330px;"
                            placeholder="Write the name of the branch">
                        <label class="form-label font-size-12 font-b">
                            <span class="text-danger">* </span>
                            Company
                        </label>
                        <div class="col-12 font-b" style="width: 330px;">
                            <?php if (isset($companyId) && $companyId != ''): ?>
                            <input type="hidden" id="company" name="companyId" value="<?= $company['companyId'] ?>">
                            <?= $company['companyName'] ?>
                            <?php else: ?>
                            <select class="form-select" id="company" name="companyId">
                                <option value="">Select Company</option>
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
                    <label for="exampleFormControlInput1" class="form-label font-size-12 font-b">
                        <span class="text-danger">* </span>
                        Branch Description</label>
                    <textarea style="height: 390px; width: 398px;" class="form-control" name="description"
                        id="description" placeholder="Write the description of the Branch"></textarea>
                </div>
            </div>
            <div class="col-12 text-end mt-10">
                <input type="hidden" id="branchId" value="">
                <a href="<?= Yii::$app->homeUrl ?>setting/group/create-group" style="text-decoration: none;">
                    <button type="button" class="btn-cancel-group"
                        action="<?= Yii::$app->homeUrl ?>setting/group/create-group">Cancel</button>
                </a>

                <button type="submit" class="btn-save-group">
                    Create <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/plus.svg" alt="LinkedIn"
                        style="width: 20px; height: 20px;">
                </button>
            </div>
        </div>
    </div>
</div>

<?php ActiveForm::end(); ?>