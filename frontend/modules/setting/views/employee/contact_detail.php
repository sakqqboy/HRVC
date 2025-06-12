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
    echo $interval . ' days to next Birthday';
} else {
    echo '-';
}
?>

<div class="d-flex row" style="gap: 40px;">
    <div class="w-100">
        <span class="font-size-16 font-weight-600">Contact & Personal Details</span>
        <hr class="hr-group">
    </div>

    <div class="start-center" style="gap: 30px; display: flex; flex-wrap: wrap;">
        <!-- Name -->
        <div style="display: flex; width: 100%; max-width: 600px;">
            <div style="flex: 4;">
                <span class="text-gray font-size-16 font-weight-400">Name</span>
            </div>
            <div style="flex: 8;">
                <span
                    class="font-size-16 font-weight-500"><?= $employee['employeeFirstname'] . ' ' . $employee['employeeSurename']  ?? '-' ?></span>
            </div>
        </div>

        <!-- Employee ID -->
        <div style="display: flex; width: 100%; max-width: 600px;">
            <div style="flex: 4;">
                <img src="<?= Yii::$app->homeUrl ?>image/e-employee.svg" alt="Website"
                    style="width: 20px; height: 20px;">
                <span class="text-gray font-size-16 font-weight-400">Employee ID</span>
            </div>
            <div style="flex: 8;">
                <span class="font-size-16 font-weight-500"><?= $employee['employeeNumber'] ?? '-' ?></span>
            </div>
        </div>

        <!-- Nationality -->
        <div style="display: flex; width: 100%; max-width: 600px;">
            <div style="flex: 4;">
                <img src="<?= Yii::$app->homeUrl ?>image/e-world.svg" alt="Website" style="width: 20px; height: 20px;">
                <span class="text-gray font-size-16 font-weight-400">Nationality</span>
            </div>
            <div style="flex: 8;">
                <span class="font-size-16 font-weight-500"><?= $employee['countryName'] ?? '-' ?></span>
            </div>
        </div>

        <!-- Gender -->
        <div style="display: flex; width: 100%; max-width: 600px;">
            <div style="flex: 4;">
                <span class="text-gray font-size-16 font-weight-400">Gender</span>
            </div>
            <div style="flex: 8;">
                <span class="font-size-16 font-weight-500">
                    <?php 
                    if($employee['gender'] == 1){
                        echo 'Male';
                    }else if($employee['gender'] == 2){
                        echo 'Female';
                    }
                    ?>
                </span>
            </div>
        </div>

        <!-- Date of Birth -->
        <div style="display: flex; width: 100%; max-width: 600px;">
            <div style="flex: 4;">
                <span class="text-gray font-size-16 font-weight-400">Date of Birth</span>
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
                <img src="<?= Yii::$app->homeUrl ?>image/e-birth.svg" alt="Website" style="width: 20px; height: 20px;">
                <span class="text-gray font-size-16 font-weight-400">Age</span>
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
                )->days . ' days to next Birthday')
                : '-' ?>
                    )
                </span>
            </div>
        </div>

        <!-- Marital Status -->
        <div style="display: flex; width: 100%; max-width: 600px;">
            <div style="flex: 4;">
                <span class="text-gray font-size-16 font-weight-400">Marital Status</span>
            </div>
            <div style="flex: 8;">
                <span class="font-size-16 font-weight-500">
                    <!-- <?= $employee['maritalStatus'] ?? '-' ?> -->
                    <?php if($employee['maritalStatus']){
                            if($employee['maritalStatus'] == 1){
                                echo 'Single';
                            }else if($employee['maritalStatus'] == 2){
                                echo 'Married';
                            }else if($employee['maritalStatus'] == 3){
                                echo 'Divorced';
                            }else if($employee['maritalStatus'] == 4){
                                echo 'Widowed';
                            }elseif($employee['maritalStatus'] == 5){
                                echo 'Separated';
                            }else{
                                echo '-';
                            }
                        }else{
                            echo '-';
                        }
                        ?>
                </span>
            </div>
        </div>

        <!-- Contact Number -->
        <div style="display: flex; width: 100%; max-width: 600px;">
            <div style="flex: 4;">
                <span class="text-gray font-size-16 font-weight-400">Contact Number</span>
            </div>
            <div style="flex: 8;">
                <span class="font-size-16 font-weight-500"><?= $employee['telephoneNumber'] ?? '-' ?></span>
            </div>
        </div>

        <!-- Emergency Contact -->
        <div style="display: flex; width: 100%; max-width: 600px;">
            <div style="flex: 4;">
                <span class="text-gray font-size-16 font-weight-400">Emergency Contact</span>
            </div>
            <div style="flex: 8;">
                <span class="font-size-16 font-weight-500"><?= $employee['emergencyTel'] ?? '-' ?></span>
            </div>
        </div>

        <!-- Work Email -->
        <div style="display: flex; width: 100%; max-width: 600px;">
            <div style="flex: 4;">
                <img src="<?= Yii::$app->homeUrl ?>image/e-mail.svg" alt="Website" style="width: 20px; height: 20px;">
                <span class="text-gray font-size-16 font-weight-400">Work Email</span>
            </div>
            <div style="flex: 8;">
                <span class="font-size-16 font-weight-500"><?= $employee['companyEmail'] ?? '-' ?></span>
            </div>
        </div>

        <!-- Personal Email -->
        <div style="display: flex; width: 100%; max-width: 600px;">
            <div style="flex: 4;">
                <img src="<?= Yii::$app->homeUrl ?>image/e-mail.svg" alt="Website" style="width: 20px; height: 20px;">
                <span class="text-gray font-size-16 font-weight-400">Personal Email</span>
            </div>
            <div style="flex: 8;">
                <span class="font-size-16 font-weight-500"><?= $employee['email'] ?? '-' ?></span>
            </div>
        </div>

        <!-- Address -->
        <div style="display: flex; width: 100%; max-width: 600px;">
            <div style="flex: 4;">
                <img src="<?= Yii::$app->homeUrl ?>image/e-address.svg" alt="Website"
                    style="width: 20px; height: 20px;">
                <span class="text-gray font-size-16 font-weight-400">Address</span>
            </div>
            <div style="flex: 8;">
                <span class="font-size-16 font-weight-500"><?= $employee['address1'] ?? '-' ?></span>
            </div>
        </div>

        <!-- Language (Primary) -->
        <div style="display: flex; width: 100%; max-width: 600px;">
            <div style="flex: 4;">
                <span class="text-gray font-size-16 font-weight-400">Language (Primary)</span>
            </div>
            <div style="flex: 8;">
                <span class="font-size-16 font-weight-500"><?= $employee['languagePrimary'] ?? '-' ?></span>
            </div>
        </div>

        <!-- Language (Additional) -->
        <div style="display: flex; width: 100%; max-width: 600px;">
            <div style="flex: 4;">
                <span class="text-gray font-size-16 font-weight-400">Language (Additional)</span>
            </div>
            <div style="flex: 8;">
                <span class="font-size-16 font-weight-500"><?= $employee['languageAdditional'] ?? '-' ?></span>
            </div>
        </div>

        <!-- LinkedIn -->
        <div style="display: flex; width: 100%; max-width: 600px;">
            <div style="flex: 4;">
                <span class="text-gray font-size-16 font-weight-400">LinkedIn</span>
            </div>
            <div style="flex: 8;">
                <span class="font-size-16 font-weight-500"><?= $employee['linkedin'] ?? '-' ?></span>
            </div>
        </div>

        <div style="display: flex; width: 100%; max-width: 600px;">
            <div style="flex: 4;">
                <span class="text-gray font-size-16 font-weight-400">About Employee</span>
            </div>
            <div style="flex: 8;">
                <span class="font-size-16 font-weight-500"><?= $employee['remark'] ?? '-' ?></span>
            </div>
        </div>
    </div>
</div>