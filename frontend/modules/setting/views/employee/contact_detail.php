<?php
if (isset($employee['birthDate'])) {
    $birthDate = new DateTime($employee['birthDate']);
    $today = new DateTime();

    // ตั้งวันเกิดถัดไปในปีนี้
    $nextBirthday = new DateTime($today->format('Y') . '-' . $birthDate->format('m-d'));

    // ถ้าวันเกิดปีนี้ผ่านไปแล้ว ให้เพิ่มปี +1
    if ($nextBirthday < $today) {
        $nextBirthday->modify('+1 year');
    }

    // คำนวณจำนวนวัน
    $interval = $today->diff($nextBirthday)->days;
}
$contact = trim($employee['contact'] ?? '');

if ($contact === '') {
    $contactUrl = '#';
} elseif (filter_var($contact, FILTER_VALIDATE_URL)) {
    // กรณีเป็น URL เต็ม
    $contactUrl = $contact;
} else {
    // กรณีเป็น username → สร้าง URL LinkedIn
    $contactUrl = 'https://th.linkedin.com/in/' . urlencode($contact);
}
?>

<div class="d-flex row" style="gap: 40px;">
    <div class="w-100">
        <span class="font-size-16 font-weight-600"><?= Yii::t('app', 'Contact & Personal Details') ?></span>
        <hr class="hr-group">
    </div>

    <div class="start-center" style="gap: 30px; display: flex; flex-wrap: wrap;">
        <!-- Name -->
        <div style="display: flex; width: 100%; max-width: 600px;">
            <div style="flex: 4;">
                <span class="text-gray font-size-16 font-weight-400">
                    <?= Yii::t('app', 'Name') ?>
                </span>
            </div>
            <div style="flex: 8;">
                <span
                    class="font-size-16 font-weight-500"><?= $employee['employeeFirstname'] . ' ' . $employee['employeeSurename']  ?? '-' ?></span>
            </div>
        </div>

        <!-- Employee ID -->
        <div style="display: flex; width: 100%; max-width: 600px;">
            <div style="flex: 4;">
                <img src="<?= Yii::$app->homeUrl ?>image/e-employee.svg" alt="Employee"
                    style="width: 20px; height: 20px;">
                <span class="text-gray font-size-16 font-weight-400">
                    <?= Yii::t('app', 'Employee ID') ?>
                </span>
            </div>
            <div style="flex: 8;">
                <span class="font-size-16 font-weight-500"><?= $employee['employeeNumber'] ?? '-' ?></span>
            </div>
        </div>

        <!-- Nationality -->
        <div style="display: flex; width: 100%; max-width: 600px;">
            <div style="flex: 4;">
                <img src="<?= Yii::$app->homeUrl ?>image/e-world.svg" alt="Nationality"
                    style="width: 20px; height: 20px;">
                <span class="text-gray font-size-16 font-weight-400">
                    <?= Yii::t('app', 'Nationality') ?>
                </span>
            </div>

            <div style="flex: 8;">
                <?php
                $flag = 'image/e-world.svg'; // default fallback flag
                $nationalityName = 'Not set';
                if (!empty($employee['nationalityId'])) {
                    if (isset($nationality) && !empty($nationality)) {
                        $flag = $nationality["flag"];
                        $nationalityName = $nationality["nationalityName"];
                    }
                }
                ?>
                <span class="font-size-16 font-weight-500">
                    <img src="<?= Yii::$app->homeUrl . htmlspecialchars($flag) ?>" alt="country"
                        style="width: 20px; height: 20px; border: none; border-radius: 100%;">
                    <?= $nationalityName ?>
                </span>
            </div>
        </div>

        <!-- Gender -->
        <div style="display: flex; width: 100%; max-width: 600px;">
            <div style="flex: 4;">
                <span class="text-gray font-size-16 font-weight-400">
                    <?= Yii::t('app', 'Gender') ?>
                </span>
            </div>
            <div style="flex: 8;">
                <span class="font-size-16 font-weight-500">
                    <img src="<?= Yii::$app->homeUrl ?>image/male-img.svg" alt="Gender"
                        style="width: 20px; height: 20px;">
                    <?php
                    if ($employee['gender'] == 1) {
                        echo 'Male';
                    } else if ($employee['gender'] == 2) {
                        echo 'Female';
                    }
                    ?>
                </span>
            </div>
        </div>

        <!-- Date of Birth -->
        <div style="display: flex; width: 100%; max-width: 600px;">
            <div style="flex: 4;">
                <span class="text-gray font-size-16 font-weight-400">
                    <?= Yii::t('app', 'Date of Birth') ?>
                </span>
            </div>
            <div style="flex: 8;">
                <span class="font-size-16 font-weight-500">
                    <?= isset($employee['birthDate']) ? date('d/m/Y', strtotime($employee['birthDate'])) : '-' ?>
                </span>
            </div>
        </div>

        <!-- Age -->
        <div style="display: flex; width: 100%; max-width: 600px;">
            <div style="flex: 4;">
                <img src="<?= Yii::$app->homeUrl ?>image/e-birth.svg" alt="birth" style="width: 20px; height: 20px;">
                <span class="text-gray font-size-16 font-weight-400">
                    <?= Yii::t('app', 'Age') ?>
                </span>
            </div>
            <div style="flex: 8;">
                <span class="font-size-16 font-weight-500">
                    <?= isset($employee['birthDate']) ? (new DateTime())->diff(new DateTime($employee['birthDate']))->y . ' years' : '-' ?>
                </span>
                <span class="text-gray font-size-16 font-weight-500">(
                    <?= isset($employee['birthDate'])
                        ? ((new DateTime())->diff(
                            ($n = new DateTime(date('Y') . '-' . date('m-d', strtotime($employee['birthDate'])))) < new DateTime()
                                ? $n->modify('+1 year') : $n
                        )->days .  Yii::t('app', 'days to next Birthday'))
                        : '-' ?>
                    )
                </span>
            </div>
        </div>

        <!-- Marital Status -->
        <div style="display: flex; width: 100%; max-width: 600px;">
            <div style="flex: 4;">
                <span class="text-gray font-size-16 font-weight-400">
                    <?= Yii::t('app', 'Marital Status') ?>
                </span>
            </div>
            <div style="flex: 8;">
                <span class="font-size-16 font-weight-500">
                    <!-- <?= $employee['maritalStatus'] ?? '-' ?> -->
                    <?php if ($employee['maritalStatus']) {
                        if ($employee['maritalStatus'] == 1) {
                            echo 'Single';
                        } else if ($employee['maritalStatus'] == 2) {
                            echo 'Married';
                        } else if ($employee['maritalStatus'] == 3) {
                            echo 'Divorced';
                        } else if ($employee['maritalStatus'] == 4) {
                            echo 'Widowed';
                        } elseif ($employee['maritalStatus'] == 5) {
                            echo 'Separated';
                        } else {
                            echo '-';
                        }
                    } else {
                        echo '-';
                    }
                    ?>
                </span>
            </div>
        </div>

        <!-- Contact Number -->
        <div style="display: flex; width: 100%; max-width: 600px;">
            <div style="flex: 4;">
                <span class="text-gray font-size-16 font-weight-400">
                    <?= Yii::t('app', 'Contact Number') ?>
                </span>
            </div>
            <div style="flex: 8;">
                <span class="font-size-16 font-weight-500">
                    <?= $employee['telephoneNumber'] ?? '-' ?>
                    <img src="<?= Yii::$app->homeUrl ?>image/coppy.svg"
                        onclick="javascript:copyToClipboard(<?= $employee['telephoneNumber'] ?? '-' ?>)"
                        style="width: 10.884px; height: 12px;">
                </span>
            </div>
        </div>

        <!-- Emergency Contact -->
        <div style="display: flex; width: 100%; max-width: 600px;">
            <div style="flex: 4;">
                <span class="text-gray font-size-16 font-weight-400">
                    <?= Yii::t('app', 'Emergency Contact') ?>
                </span>
            </div>
            <div style="flex: 8;">
                <span class="font-size-16 font-weight-500">
                    <?= !empty($employee['emergencyTel']) ? htmlspecialchars($employee['emergencyTel']) : '-' ?>
                    <?php if (!empty($employee['emergencyTel'])): ?>
                        <img src="<?= Yii::$app->homeUrl ?>image/coppy.svg"
                            onclick="javascript:copyToClipboard(<?= $employee['emergencyTel'] ?? '-' ?>)"
                            style="width: 10.884px; height: 12px;">
                    <?php endif; ?>
                </span>
            </div>
        </div>

        <!-- Work Email -->
        <div style="display: flex; width: 100%; max-width: 600px;">
            <div style="flex: 4;">
                <img src="<?= Yii::$app->homeUrl ?>image/e-mail.svg" alt="mail" style="width: 20px; height: 20px;">
                <span class="text-gray font-size-16 font-weight-400">
                    <?= Yii::t('app', 'Work Email') ?>
                </span>
            </div>
            <div style="flex: 8;">
                <span class="font-size-16 font-weight-500">
                    <?= !empty($employee['companyEmail']) ? htmlspecialchars($employee['companyEmail']) : '-' ?>
                    <?php if (!empty($employee['companyEmail'])): ?>
                        <img src="<?= Yii::$app->homeUrl ?>image/coppy.svg"
                            onclick="javascript:copyToClipboard('<?= $employee['companyEmail'] ?? '-' ?>')"
                            style="width: 10.884px; height: 12px;">
                    <?php endif; ?>
                </span>
            </div>
        </div>

        <!-- Personal Email -->
        <div style="display: flex; width: 100%; max-width: 600px;">
            <div style="flex: 4;">
                <img src="<?= Yii::$app->homeUrl ?>image/e-mail.svg" alt="mail" style="width: 20px; height: 20px;">
                <span class="text-gray font-size-16 font-weight-400">
                    <?= Yii::t('app', 'Personal Email') ?>
                </span>
            </div>
            <div style="flex: 8;">
                <span class="font-size-16 font-weight-500">
                    <?= !empty($employee['email']) ? htmlspecialchars($employee['email']) : '-' ?>
                    <?php if (!empty($employee['email'])): ?>
                        <img src="<?= Yii::$app->homeUrl ?>image/coppy.svg"
                            onclick="javascript:copyToClipboard('<?= $employee['email'] ?? '-' ?>')"
                            style="width: 10.884px; height: 12px;">
                    <?php endif; ?>
                </span>
            </div>
        </div>

        <!-- Address -->
        <div style="display: flex; width: 100%; max-width: 600px;">
            <div style="flex: 4;">
                <img src="<?= Yii::$app->homeUrl ?>image/e-address.svg" alt="Address"
                    style="width: 20px; height: 20px;">
                <span class="text-gray font-size-16 font-weight-400">
                    <?= Yii::t('app', 'Address') ?>
                </span>
            </div>
            <div style="flex: 8;">
                <span class="font-size-16 font-weight-500">
                    <?= !empty($employee['address1']) ? htmlspecialchars($employee['address1']) : '-' ?>
                </span>
            </div>
        </div>

        <!-- Language (Primary) -->
        <div style="display: flex; width: 100%; max-width: 600px;">
            <div style="flex: 4;">
                <span class="text-gray font-size-16 font-weight-400">
                    <?= Yii::t('app', 'Language (Primary)') ?>
                </span>
            </div>
            <div style="flex: 8;">
                <div class="language-label" style="height: 30px;">
                    <?php
                    $flag1 = isset($UserLanguage[0]['flag']) ? $UserLanguage[0]['flag'] : 'image/e-world.svg';
                    ?>

                    <span class="font-size-16 font-weight-500">
                        <img src="<?= Yii::$app->homeUrl . htmlspecialchars($flag1) ?>" alt="Language"
                            style="width: 20px; height: 20px; border: none; border-radius: 100%;">
                        <?= $UserLanguage[0]['name'] ?? '-' ?>
                    </span>
                </div>

            </div>
        </div>

        <!-- Language (Additional) -->
        <div style="display: flex; width: 100%; max-width: 600px;">
            <div style="flex: 4;">
                <span class="text-gray font-size-16 font-weight-400">
                    <?= Yii::t('app', 'Language (Additional)') ?>
                </span>
            </div>
            <div style="display: flex; flex: 8; align-items: center;">
                <div class="language-label mr-25" style="height: 30px;">
                    <?php if (!empty($UserLanguage[1]['name'] ?? '')): ?>
                        <?php $flag1 = $UserLanguage[1]['flag'] ?? ''; ?>
                        <span class="font-size-16 font-weight-500">
                            <img src="<?= Yii::$app->homeUrl . htmlspecialchars($flag1) ?>"
                                alt="Language"
                                style="width: 20px; height: 20px; border: none; border-radius: 100%;">
                            <?= htmlspecialchars($UserLanguage[1]['name']) ?>
                        </span>
                    <?php else: ?>
                        <span class="font-size-16 font-weight-500">-</span>
                    <?php endif; ?>
                </div>

                <div class="language-label mr-25" style="height: 30px;">
                    <?php if (!empty($UserLanguage[2]['name'] ?? '')): ?>
                        <?php $flag2 = $UserLanguage[2]['flag'] ?? ''; ?>
                        <span class="font-size-16 font-weight-500">
                            <img src="<?= Yii::$app->homeUrl . htmlspecialchars($flag2) ?>"
                                alt="Language"
                                style="width: 20px; height: 20px; border: none; border-radius: 100%;">
                            <?= htmlspecialchars($UserLanguage[2]['name']) ?>
                        </span>
                    <?php else: ?>
                        <span class="font-size-16 font-weight-500">-</span>
                    <?php endif; ?>
                </div>

            </div>
        </div>

        <!-- LinkedIn -->
        <div style="display: flex; width: 100%; max-width: 600px;">
            <div style="flex: 4;">
                <span class="text-gray font-size-16 font-weight-400">
                    <?= Yii::t('app', 'LinkedIn') ?>
                </span>
            </div>
            <div style="flex: 8;  cursor: pointer;">
                <a href="<?= $contactUrl ?>" target="_blank" rel="noopener noreferrer">
                    <span class="condition-name badge font-size-16 font-weight-500"
                        style="width: 80px; height: 26px; flex-direction:row; gap: 3px;">
                        <img src="<?= Yii::$app->homeUrl ?>image/in-image-white.svg"
                            alt="LinkedIn"
                            style="width: 14px; height: 13px;">

                        <?= Yii::t('app', 'Visit') ?>

                        <img src="<?= Yii::$app->homeUrl ?>image/see-all-white.svg"
                            alt="icon"
                            style="width: 14px; height: 13px;">
                    </span>
                </a>
            </div>
        </div>

        <div style="display: flex; width: 100%; max-width: 600px; ">
            <div style="flex: 4;">
                <span class="text-gray font-size-16 font-weight-400">
                    <?= Yii::t('app', 'About Employee') ?>
                </span>
            </div>
            <div style="flex: 8;">
                <span class="font-size-16 font-weight-500"><?= !empty($employee['remark']) ? htmlspecialchars($employee['remark']) : '-' ?></span>
            </div>
        </div>
    </div>
</div>