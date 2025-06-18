<?php

// echo '<pre>';
// print_r($employee);
// echo '</pre>';
// exit;

$updateDateTime = '-';

if (!empty($employee['updateDateTime'])) {
    try {
        $dt = new DateTime($employee['updateDateTime']);
        // ฟอร์แมต dd/mm/YYYY HH:mm
        $updateDateTime = $dt->format('d/m/Y');
    } catch (Exception $e) {
        // ถ้าแปลงไม่ได้ ก็เก็บเป็น "-"
        $updateDateTime = '-';
    }
}
// $resume = $employee['resume'] ??  '';
// $agreement = $employee['employeeAgreement'] ??  '';

$resumePath = isset($employee['resume']) ? $employee['resume'] : '';
$resumeFileName = basename($resumePath); // ดึงชื่อไฟล์จาก path เช่น bcRGoVHyu2.xlsx
$resumeExtension = pathinfo($resumeFileName, PATHINFO_EXTENSION); // xlsx


$agreementPath = isset($employee['employeeAgreement']) ? $employee['employeeAgreement'] : '';
$agreementFileName = basename($agreementPath);              // bcRGoVHyu2.xlsx
$agreementExtension = pathinfo($agreementFileName, PATHINFO_EXTENSION); // xlsx

?>
<style>
.file-box-active {
    background-color: #F8FBFF !important;
    border: 1px solid #2580D3 !important;
}
</style>

<div class="d-flex row" style="gap: 32px;">
    <div class="w-100">
        <span class="font-size-16 font-weight-600">
            <?= Yii::t('app', 'Attachments') ?>
        </span>
        <hr class="hr-group">
    </div>
    <?php
                                                switch ($resumeExtension) {
                                                    case 'doc':
                                                        $iconFile = 'doc-file.svg';
                                                        break;
                                                    case 'mp4':
                                                        $iconFile = 'mp4-file.svg';
                                                        break;
                                                    case 'picture':
                                                        $iconFile = 'picture-file.svg';
                                                        break;
                                                    case 'file':
                                                        $iconFile = 'file-file.svg';
                                                        break;
                                                    case 'xml':
                                                        $iconFile = 'xml-file.svg';
                                                        break;
                                                    case 'ai':
                                                        $iconFile = 'ai-file.svg';
                                                        break;
                                                    case 'pds':
                                                        $iconFile = 'pds-file.svg';
                                                        break;
                                                    case 'pptx':
                                                        $iconFile = 'pptx-file.svg';
                                                        break;
                                                    case 'eps':
                                                        $iconFile = 'eps-file.svg';
                                                        break;
                                                    case 'zip':
                                                        $iconFile = 'zip-file.svg';
                                                        break;
                                                    case 'txt':
                                                        $iconFile = 'txt-file.svg';
                                                        break;
                                                    case 'pdf':
                                                        $iconFile = 'pdf-file.svg';
                                                        break;
                                                    case 'xlsx':
                                                        $iconFile = 'ex-file.svg';
                                                        break;
                                                    default:
                                                        $iconFile = 'file-big.svg'; // ไอคอน default
                                                }
                                                ?>
    <div class="between-center">
        <div class="d-flex flex-column gap-2" style="width: 45%;">
            <span class="font-size-16 font-weight-600"><?= Yii::t('app', 'Resume / CV') ?></span>
            <div class="form-control p-3 no-underline" id="resume-btn"
                data-url="<?= Yii::$app->homeUrl . ltrim($resumePath, '/') ?>"
                onclick="handleFileBoxClick('resume-btn');"
                style="border: 1px solid var(--Stroke-Bluish-Gray, #BBCDDE); cursor: pointer;">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <img src="<?= Yii::$app->homeUrl ?>image/<?= $iconFile ?>" alt="icon"
                            style="width: 40px; height: 40px;">
                    </div>
                    <div class="col">
                        <label class="text-black font-size-16 font-weight-600"><?= $resumeFileName ?></label>
                        <div class="text-secondary font-size-14">
                            <span class="font-size-12">1.9 mb</span>
                        </div>
                        <div class="text-secondary font-size-14">
                            <span class="font-size-12">Uploaded on <?= $updateDateTime ?></span>
                        </div>
                    </div>
                    <div class="col-auto d-flex justify-content-center align-items-center gap-3">
                        <a href="<?= Yii::$app->homeUrl ?><?= $resumePath ?>" download
                            onclick="event.stopPropagation();"
                            class="d-flex align-items-center action-employee-btn justify-content-center"
                            id="normal-action">
                            <img src="/HRVC/frontend/web/image/download-blue.svg" class="me-2"
                                style="width: 18px;height:18px;">
                            <?= Yii::t('app', 'Download') ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <?php
                                                switch ($agreementExtension) {
                                                    case 'doc':
                                                        $iconFile = 'doc-file.svg';
                                                        break;
                                                    case 'mp4':
                                                        $iconFile = 'mp4-file.svg';
                                                        break;
                                                    case 'picture':
                                                        $iconFile = 'picture-file.svg';
                                                        break;
                                                    case 'file':
                                                        $iconFile = 'file-file.svg';
                                                        break;
                                                    case 'xml':
                                                        $iconFile = 'xml-file.svg';
                                                        break;
                                                    case 'ai':
                                                        $iconFile = 'ai-file.svg';
                                                        break;
                                                    case 'pds':
                                                        $iconFile = 'pds-file.svg';
                                                        break;
                                                    case 'pptx':
                                                        $iconFile = 'pptx-file.svg';
                                                        break;
                                                    case 'eps':
                                                        $iconFile = 'eps-file.svg';
                                                        break;
                                                    case 'zip':
                                                        $iconFile = 'zip-file.svg';
                                                        break;
                                                    case 'txt':
                                                        $iconFile = 'txt-file.svg';
                                                        break;
                                                    case 'pdf':
                                                        $iconFile = 'pdf-file.svg';
                                                        break;
                                                    case 'xlsx':
                                                        $iconFile = 'ex-file.svg';
                                                        break;
                                                    default:
                                                        $iconFile = 'file-big.svg'; // ไอคอน default
                                                }
                                                ?>
        <div class="d-flex flex-column gap-2" style="width: 45%;">
            <span class="font-size-16 font-weight-600"><?= Yii::t('app', 'Agreement') ?></span>
            <div class="form-control p-3 no-underline" id="agreement-btn"
                data-url="<?= Yii::$app->homeUrl . ltrim($agreementPath, '/') ?>"
                onclick="handleFileBoxClick('agreement-btn'); return false;"
                style="border: 1px solid var(--Stroke-Bluish-Gray, #BBCDDE); cursor: pointer;">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <img src="<?= Yii::$app->homeUrl ?>image/<?= $iconFile ?>" alt="icon"
                            style="width: 40px; height: 40px;">
                    </div>
                    <div class="col">
                        <label class="text-black font-size-16 font-weight-600"><?= $agreementFileName ?></label>
                        <div class="text-secondary font-size-14">
                            <span class="font-size-12">1.9 mb</span>
                        </div>
                        <div class="text-secondary font-size-14">
                            <span class="font-size-12">Uploaded on <?= $updateDateTime ?></span>
                        </div>
                    </div>
                    <div class="col-auto d-flex justify-content-center align-items-center gap-3">
                        <a href="<?= Yii::$app->homeUrl ?><?= $agreementPath ?>" download
                            onclick="event.stopPropagation();"
                            class="d-flex align-items-center action-employee-btn justify-content-center"
                            id="normal-action">
                            <img src="/HRVC/frontend/web/image/download-blue.svg" class="me-2"
                                style="width: 18px;height:18px;">
                            <?= Yii::t('app', 'Download') ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="center-center">
        <div class="col-12">
            <div class="w-100">
                <span class="font-size-16 font-weight-600">
                    <?= Yii::t('app', 'Document Preview') ?>
                </span>
            </div>
            <div class="company-group-edit mt-20" id="doc-box"
                style="height: 141px; padding:10px; border: 1.22px dashed var(--Stroke-Bluish-Gray, #BBCDDE); background: var(--HRVC---Light-Text, #F9F9F9);">
                <div class="mid-center mt-30">
                    <span class=" font-size-16 font-weight-600">
                        <?= Yii::t('app', 'The selected Document cant be previewed') ?>
                    </span>
                    <span class=" font-size-12 font-weight-400">
                        <?= Yii::t('app', 'Preview is currently supported for PDF, DOCX, and image files only. Excel files (e.g., XLS, XLSX) are not supported at this time.') ?>
                    </span>
                </div>
            </div>

            <div class="myIframe mt-24" style="border: none;">

            </div>
        </div>
    </div>
</div>