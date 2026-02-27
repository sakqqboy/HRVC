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
            <div class="font-b font-size-18 pt-5"
                    style="font-size:20px; font-weight:400; color:#111827; letter-spacing:-0.01em;">
                    Select Company Salary Sheet
            </div>
        </div>

        <div class="col-6 text-end">
            <button
                style="
                    padding:8px;
                    color:#9ca3af;
                    background:transparent;
                    border:none;
                    cursor:pointer;
                    transition: color 0.2s ease;
                "
                onmouseover="this.style.color='#111827'"
                onmouseout="this.style.color='#9ca3af'"
            >
                <svg xmlns="http://www.w3.org/2000/svg"
                    width="16"
                    height="16"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round">
                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                    <polyline points="7 10 12 15 17 10"></polyline>
                    <line x1="12" x2="12" y1="15" y2="3"></line>
                </svg>
            </button>
        </div>

    </div>

    <div class="table-responsive mt-50">
        <table style="
            width:100%;
            border-collapse:separate;
            border-spacing:0;
            background:#ffffff;
            border-radius:8px;
            overflow:hidden;
            box-shadow:0 1px 2px rgba(0,0,0,0.05), 
                    0 4px 12px rgba(0,0,0,0.04);
            border:1px solid #f3f4f6;
            font-family:Inter,system-ui,-apple-system,sans-serif;
        ">
            <thead>
                <tr style="
                    background:rgba(249,250,251,0.8);
                    border-bottom:1px solid #f3f4f6;
                ">
                    <th style="padding:12px 24px;font-size:10px;font-weight:400;color:#9ca3af;text-transform:uppercase;letter-spacing:0.12em;text-align:left;">
                        Company Name
                    </th>

                    <th style="padding:12px 24px;font-size:10px;font-weight:400;color:#9ca3af;text-transform:uppercase;letter-spacing:0.12em;text-align:center;">
                        Employees
                    </th>

                    <th style="padding:12px 24px;font-size:10px;font-weight:400;color:#9ca3af;text-transform:uppercase;letter-spacing:0.12em;text-align:center;">
                        Currency
                    </th>

                    <th style="padding:12px 24px;font-size:10px;font-weight:400;color:#9ca3af;text-transform:uppercase;letter-spacing:0.12em;text-align:left;">
                        Status
                    </th>

                    <th style="padding:12px 24px;font-size:10px;font-weight:400;color:#9ca3af;text-transform:uppercase;letter-spacing:0.12em;text-align:right;">
                        Action
                    </th>
                </tr>
            </thead>

            <tbody>
                <?php if (!empty($salaries)): ?>

                    <?php foreach ($salaries as $companyId => $salary): ?>

                        <tr style="border-bottom:1px solid #f9fafb;transition:.2s;"
                            onmouseover="this.style.background='rgba(59,130,246,0.05)'"
                            onmouseout="this.style.background=''">

                            <!-- Company -->
                            <td style="padding:16px 24px;">
                                <div style="display:flex;align-items:center;gap:12px;">
                                    <div style="width:32px;height:32px;border-radius:50%;overflow:hidden;border:1px solid #f3f4f6;">
                                        <img src="<?= Yii::$app->homeUrl . $salary['picture'] ?>"
                                            style="width:100%;height:100%;object-fit:cover;">
                                    </div>

                                    <div style="font-size:13px;color:#111827;">
                                        <?= $salary['companyName'] ?>
                                    </div>
                                </div>
                            </td>

                            <!-- Employees -->
                            <td style="padding:16px 24px;text-align:center;font-size:12px;color:#4b5563;">
                                <?= $salary['totlaCompany'] ?? 0 ?>
                            </td>

                            <!-- Currency -->
                            <td style="padding:16px 24px;text-align:center;font-size:11px;color:#9ca3af;">
                                <?= $salary['code'] ?? '-' ?>
                            </td>

                            <!-- Status -->
                            <td style="padding:16px 24px;">
                                <?php if (($salary['status'] ?? 0) == 1): ?>
                                    <span style="
                                        padding:2px 8px;
                                        background:#ecfdf5;
                                        color:#16a34a;
                                        font-size:10px;
                                        border-radius:2px;
                                        border:1px solid #d1fae5;">
                                        Active
                                    </span>
                                <?php else: ?>
                                    <span style="
                                        padding:2px 8px;
                                        background:#f3f4f6;
                                        color:#6b7280;
                                        font-size:10px;
                                        border-radius:2px;
                                        border:1px solid #e5e7eb;">
                                        Inactive
                                    </span>
                                <?php endif; ?>
                            </td>

                            <!-- Action -->
                            <td style="padding:16px 24px;text-align:right;">
                                <a href="<?= Yii::$app->homeUrl ?>evaluation/salary/register/<?= ModelMaster::encodeParams(['companyId' => $salary['companyId']]) ?>"
                                style="font-size:11px;color:#2580D3;text-decoration:none;"
                                onmouseover="this.style.textDecoration='underline'"
                                onmouseout="this.style.textDecoration='none'">
                                    Open Sheet →
                                </a>
                            </td>

                        </tr>

                    <?php endforeach; ?>

                <?php endif; ?>

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