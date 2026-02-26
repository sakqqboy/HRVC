<?php

use common\models\ModelMaster;
use yii\bootstrap5\ActiveForm;
use frontend\models\hrvc\Company;

$this->title = 'Evaluation';
?>
<style>
		/* ================= Layout ================= */
.submain-content {
    width: 100%;
    padding: 0 30px;
    min-height: 100vh;
    background: #ffffff;
}
</style>

<div class="col-12 mt-70">
    <div class="row">
        <div class="col-6">
            <div class="font-b font-size-18 pt-5">
                Select Company Salary Sheet
            </div>
        </div>
    </div>

    <div class="table-responsive mt-50">
        <table class="table align-middle">
            <thead class="table-light">
                <tr>
                    <th>Company Name</th>
                    <th class="text-center">Employees</th>
                    <th class="text-center">Currency</th>
                    <th class="text-center">Status</th>
                    <th class="text-end">Action</th>
                </tr>
            </thead>
            <tbody>

            <?php foreach ($environments as $environmentId => $environment): ?>

                <tr>
                    <!-- Company Name -->
                    <td>
                        <div class="d-flex align-items-center">
                            <div class="company-avatar me-3">
                                <img src="<?= Yii::$app->homeUrl ?><?= $environment['picture'] ?>"
                                     width="36"
                                     height="36"
                                     style="border-radius:50%;">
                            </div>
                            <div>
                                <?= $environment['branchName'] ?? '-' ?>
                            </div>
                        </div>
                    </td>

                    <!-- Employees -->
                    <td class="text-center">
                        <?= Company::totalEmployeeCompany($environment['companyId'] ?? 0) ?>
                    </td>

                    <!-- Currency -->
                    <td class="text-center">
                        <?= $environment['currency']['code'] ?? '-' ?>
                    </td>

                    <!-- Status -->
                    <td class="text-center">
                        <?php if (($environment['status'] ?? 0) == 1): ?>
                            <span class="badge bg-success">Active</span>
                        <?php else: ?>
                            <span class="badge bg-secondary">Inactive</span>
                        <?php endif; ?>
                    </td>

                    <!-- Action -->
                    <td class="text-end">
                        <a href="<?= Yii::$app->homeUrl ?>evaluation/salary/register/<?= ModelMaster::encodeParams(['companyId' => $environment['companyId'], "environmentId" => $environmentId]) ?>"
                           class="text-primary text-decoration-none">
                            Open Sheet →
                        </a>
                    </td>
                </tr>

            <?php endforeach; ?>

            </tbody>
        </table>
    </div>
</div>


<?php
$form = ActiveForm::begin([
	'id' => 'create-environment',
	'method' => 'post',
	'options' => [
		'enctype' => 'multipart/form-data',
	],

]); ?>
<input type="hidden" value="<?= Yii::$app->request->url ?>" name="previousUrl">

<?php ActiveForm::end(); ?>