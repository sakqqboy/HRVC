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
$resume = $employee['resume'] ??  '';
$agreement = $employee['employeeAgreement'] ??  '';


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

    <div class="between-center">
        <div class="d-flex flex-column gap-2" style="width: 45%;">
            <span class="font-size-16 font-weight-600"><?= Yii::t('app', 'Resume / CV') ?></span>
            <a href="#" class="form-control p-3 no-underline" id="resume-btn"
                onclick="toggleActiveFileBox('resume-btn'); return false;"
                style="border: 1px solid var(--Stroke-Bluish-Gray, #BBCDDE);">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <img src="<?= Yii::$app->homeUrl ?>image/ex-file.svg" alt="icon"
                            style="width: 40px; height: 40px;">
                    </div>
                    <div class="col">
                        <label class="text-black font-size-16 font-weight-600"><?= $resume ?></label>
                        <div class="text-secondary font-size-14">
                            <span class="font-size-12">1.9 mb</span>
                        </div>
                        <div class="text-secondary font-size-14">
                            <span class="font-size-12">Uploaded on <?= $updateDateTime ?></span>
                        </div>
                    </div>
                    <div class="col-auto d-flex justify-content-center align-items-center gap-3">
                        <buttom href="#" onclick="javascript:showAction()"
                            class="d-flex align-items-center action-employee-btn justify-content-center"
                            id="normal-action">
                            <img src="/HRVC/frontend/web/image/download-blue.svg" class="me-2"
                                style="width: 18px;height:18px;">
                            <?= Yii::t('app', 'Download') ?>
                        </buttom>
                    </div>
                </div>
            </a>
        </div>

        <div class="d-flex flex-column gap-2" style="width: 45%;">
            <span class="font-size-16 font-weight-600"><?= Yii::t('app', 'Agreement') ?></span>
            <a href="#" class="form-control p-3 no-underline" id="agreement-btn"
                onclick="toggleActiveFileBox('agreement-btn'); return false;"
                style="border: 1px solid var(--Stroke-Bluish-Gray, #BBCDDE);">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <img src="<?= Yii::$app->homeUrl ?>image/ex-file.svg" alt="icon"
                            style="width: 40px; height: 40px;">
                    </div>
                    <div class="col">
                        <label class="text-black font-size-16 font-weight-600"><?= $agreement ?></label>
                        <div class="text-secondary font-size-14">
                            <span class="font-size-12">1.9 mb</span>
                        </div>
                        <div class="text-secondary font-size-14">
                            <span class="font-size-12">Uploaded on <?= $updateDateTime ?></span>
                        </div>
                    </div>
                    <div class="col-auto d-flex justify-content-center align-items-center gap-3">
                        <buttom href="#" onclick="javascript:showAction()"
                            class="d-flex align-items-center action-employee-btn justify-content-center"
                            id="normal-action">
                            <img src="/HRVC/frontend/web/image/download-blue.svg" class="me-2"
                                style="width: 18px;height:18px;">
                            <?= Yii::t('app', 'Download') ?>
                        </buttom>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <div class="center-center">
        <div class="col-12">
            <div class="w-100">
                <span class="font-size-16 font-weight-600">
                    <?= Yii::t('app', 'Document Preview') ?>
                </span>
            </div>
            <div class="myIframe mt-24">
                <?php
				if ($resume != '' && $resume != null) {
					$type = explode('.', $resume);
					if ($type[1] != 'pdf') { ?>
                <iframe
                    src="https://view.officeapps.live.com/op/embed.aspx?src=https://tcg-hrvc-system.com/<?= $resume ?>"
                    id="file1" style="display: none;"></iframe>
                <?php
					} else { ?>
                <iframe src="<?= Yii::$app->homeUrl . $resume ?>" title="description" id="file1"
                    style="display: none;"></iframe>
                <?php
					}
				}
				if ($agreement != '' && $agreement != null) {
					$type = explode('.', $agreement);
					if ($type[1] != 'pdf') { ?>
                <iframe
                    src="https://view.officeapps.live.com/op/embed.aspx?src=https://tcg-hrvc-system.com/<?= $agreement ?>"
                    id="file2" style="display: none;"></iframe>
                <?php
					} else {
					?>
                <iframe src="<?= Yii::$app->homeUrl . $agreement ?>" title="description" id="file2"
                    style="display: none;"></iframe>
                <?php
					}
				}
				?>
            </div>
        </div>
    </div>
</div>