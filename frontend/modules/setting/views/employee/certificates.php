<div class="d-flex row" style="gap: 32px;">
    <div class="w-100">
        <span class="font-size-16 font-weight-600">
            <?= Yii::t('app', 'Certificates') ?>
        </span>
        <hr class="hr-group">

        <div class="mt-22">
            <?php foreach ($UserCertificate as $cert): ?>

            <div class="d-flex mb-32" style="gap: 38px;">
                <div class="avatar-upload" style="margin:0px">
                    <div class="avatar-preview " id="cerPreview" style="
                        position: relative;
                        background-color: white;
                        fill: #FFF; 
                        border: 0.909px solid var(--Stroke-Bluish-Gray, #BBCDDE);
                        border-radius: 3.636px;
                        width: 100px;
                        height: 100px;
                        padding: 10px;
                        text-align: center;
                        cursor: pointer;
                    ">
                        <label for="cerimage" class="upload-label"
                            style="display: block; width: 100%; max-width: 300px;">
                            <?php if($cert['cerImage']){ ?>
                            <img src="<?= Yii::$app->homeUrl . $cert['cerImage'] ?>" alt="Certificate Image"
                                style="width: 100%; height: auto; display: block;">
                            <?php } else { ?>
                            <img src="<?= Yii::$app->homeUrl ?>image/no-img.svg" alt="Certificate Image"
                                style="width: 100%; height: auto; display: block;">
                            <?php }?>
                        </label>
                    </div>
                </div>

                <div class="row" style="gap: 12px; min-width: 70%; max-width: 100%; ">
                    <div class="row">
                        <span class="font-size-16 font-weight-700"><?= $cert['cerName'] ?></span>
                        <span class="text-gray font-size-14 font-weight-400"><?= $cert['issuing'] ?></span>
                        <?php
                        $from = $cert['fromCerDate'] ? date('M Y', strtotime($cert['fromCerDate'])) : '-';
                        $to = ($cert['noExpiry'] == 1 || empty($cert['toCerDate'])) ? 'No Expiry' : date('M Y', strtotime($cert['toCerDate']));
                        ?>
                        <span class="text-gray font-size-14 font-weight-400">
                            Issued <?= $from ?> <?= $to !== 'No Expiry' ? " . Expires $to" : '' ?>
                        </span>
                    </div>
                    <div class="container">
                        <a href="credential"
                            class=" d-flex align-items-center action-employee-btn justify-content-center"
                            id="normal-action" style="min-width: 20%; max-width: 25%;">
                            Show Credentials
                            <img src="<?= Yii::$app->homeUrl ?>image/show-blue.svg" class="me-2 ml-9"
                                style="width: 14px;height:14px;">
                        </a>
                    </div>
                </div>

                <div class="row" style="display: block; max-width: 150px; max-height: 100px;">
                    <label for="certificate" class="upload-label"
                        style="display: block; width: 100%; max-width: 300px;">
                        <?php if($cert['certificate']){ ?>
                        <img src="<?= Yii::$app->homeUrl . $cert['certificate']?>">
                        <?php } else { ?>
                        <img src="<?= Yii::$app->homeUrl ?>image/no-cer.svg">
                        <?php }?>
                    </label>
                </div>
            </div>
            <?php endforeach; ?>

        </div>
    </div>

    <div class="w-100 mt-46">
        <span class="font-size-16 font-weight-600">
            <?= Yii::t('app', 'Skill Tags') ?>
        </span>
        <hr class="hr-group">
        <div class="mt-22">
            <?php
            $skills = $employee['skills'];
            if (is_string($skills)) {
                $skills = json_decode($skills, true); // แปลง JSON เป็น array ถ้าจำเป็น
            }
            ?>

            <div id="skillTags" class="d-flex flex-wrap" style="gap: 8px;">
                <?php foreach ($skills as $skill): ?>
                <span class="skill-tag d-inline-flex align-items-center"
                    style="gap: 4px; background: #2580D3; color: #30313D; padding: 4px 10px; border-radius: 20px;">
                    <span class="text-white font-size-13 font-weight-400"><?= htmlspecialchars($skill) ?></span>
                </span>
                <?php endforeach; ?>
            </div>

        </div>
    </div>

</div>