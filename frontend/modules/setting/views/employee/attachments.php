<?php
$updateDateTime = $updateDateTime ??  '';
$resume = $resume ??  '';
$agreement = $agreement ??  '';

?>
<div class="d-flex row" style="gap: 32px;">
    <div class="w-100">
        <span class="font-size-16 font-weight-600">
            <?= Yii::t('app', 'Attachments') ?>
        </span>
        <hr class="hr-group">
    </div>

    <div class="between-center">
        <!-- ฝั่งซ้าย -->
        <div class="d-flex flex-column gap-2" style="width: 45%;">
            <span class="font-size-16 font-weight-600"><?= Yii::t('app', 'Resume / CV') ?></span>
            <div class="form-control p-3" style="border: 1px solid var(--Stroke-Bluish-Gray, #BBCDDE);">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <img src="http://localhost/HRVC/frontend/web/image/ex-file.svg" alt="icon"
                            style="width: 40px; height: 40px;">
                    </div>
                    <div class="col">
                        <label class="font-size-16 font-weight-600">test1.xlsx</label>
                        <div class="text-secondary font-size-14">
                            <span class="font-size-12">1.9 mb</span>
                        </div>
                        <div class="text-secondary font-size-14">
                            <span class="font-size-12">Uploaded on 16/06/2025</span>
                        </div>
                    </div>
                    <div class="col-auto d-flex justify-content-center align-items-center gap-3">
                        <!-- ปุ่ม edit/delete -->
                        <a href="#" onclick="javascript:showAction()"
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

        <!-- ฝั่งขวา (เหมือนฝั่งซ้าย) -->
        <div class="d-flex flex-column gap-2" style="width: 45%;">
            <span class="font-size-16 font-weight-600"><?= Yii::t('app', 'Agreement') ?></span>
            <div class="form-control p-3" style="border: 1px solid var(--Stroke-Bluish-Gray, #BBCDDE);">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <img src="http://localhost/HRVC/frontend/web/image/ex-file.svg" alt="icon"
                            style="width: 40px; height: 40px;">
                    </div>
                    <div class="col">
                        <label class="font-size-16 font-weight-600">test2.docx</label>
                        <div class="text-secondary font-size-14">
                            <span class="font-size-12">1.9 mb</span>
                        </div>
                        <div class="text-secondary font-size-14">
                            <span class="font-size-12">Uploaded on 16/06/2025</span>
                        </div>
                    </div>
                    <div class="col-auto d-flex justify-content-center align-items-center gap-3">
                        <!-- ปุ่ม edit/delete -->
                        <a href="#" onclick="javascript:showAction()"
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