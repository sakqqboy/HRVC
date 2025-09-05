    <div style="flex: 1;">
        <div class="text-left position-relative">
            <div class="d-flex align-items-center">
                <div class="col-4 text-center position-relative">
                    <img src="<?= Yii::$app->homeUrl ?><?= $employeeProfile['picture'] ?>"
                        class="profile-picture rounded-circle mb-3" alt="User Avatar"
                        style="width: 100px; height: 100px;">
                    <span class="condition-name badge position-absolute bottom-0 start-50 translate-middle-x">
                        <?= $employeeProfile['employeeConditionName'] ?>
                </div>
                <div class="col-8 ms-3">
                    <h6 class="profile-name mb-0">
                        <?= $employeeProfile['employeeFirstname'] ?> <?= $employeeProfile['employeeSurename'] ?>
                    </h6>
                    <p class="profile-role text-muted small mb-0"><?= $employeeProfile['titleName'] ?>
                        <?php
                        if (!empty($employeeProfile['shortTag'])) {
                            echo "(" . $employeeProfile['shortTag'] . ")";
                        }
                        ?>
                    </p>
                    <p class="profile-rolesub text-muted small mb-0"><?= $employeeProfile['titleName'] ?></p>
                </div>
            </div>
        </div>

        <ul class="profile-details list-unstyled small mt-10">
            <li class="d-inline-flex">


                <div class="text-truncate" style="max-width:270px;">
                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/mail.svg" alt="Company" class="pim-icon mr-5"
                        style="width: 14px; height: 14px;">
                    <?= $employeeProfile["email"] ?>
                </div>
                <a href="javascript:copyToClipboard('<?= $employeeProfile['email'] ?>')" class="pim-icon copy-btn"
                    data-email="<?= $employeeProfile['email'] ?>">
                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/coppy.svg" alt="Copy Email"
                        class="pim-icon" style="width: 14.512px; height: 16px;">
                </a>
            </li>
            <li>
                <text>
                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/employee.svg" alt="Company" class="pim-icon mr-5"
                        style="width: 14px; height: 14px;">
                    Employee ID:
                </text>
                <!-- เอาemploye number -->
                <strong>
                    <?= $employeeProfile['employeeNumber'] ?>
                </strong>

            </li>
            <li>
                <text>
                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/calendar.svg" alt="Company" class="pim-icon mr-5"
                        style="width: 14px; height: 14px;">
                    Employee Since :
                </text>
                <strong>
                    <?php
                    $formattedDate = date("jS F Y", strtotime($employeeProfile['joinDate']));
                    echo $formattedDate;
                    ?>
                </strong>
            </li>
        </ul>
        <hr class="custom-hr mb-10">
    </div>
    <br>
    <br>

    <div style="flex: 2;">
        <div class="text-start">
            <div class="d-flex align-items-center">
                <!-- รูปโปรไฟล์ -->
                <img src="<?= Yii::$app->homeUrl ?>images/testimg/TCF.svg" class="profile-picture rounded-circle mb-3"
                    alt="User Avatar" style="width: 60px;">

                <!-- ข้อมูลโปรไฟล์ -->
                <div class="ms-3">
                    <h6 class="profile-name small mb-0 text-start"><?= $employeeProfile['companyName'] ?></h6>
                    <p class="profile-role text-muted small mb-0 text-start">
                        <img src="<?= Yii::$app->homeUrl ?><?= $employeeProfile['flag'] ?>"
                            class="profile-picture rounded-circle mb-3" alt="User Avatar"
                            style="width: 18px; height: 18px;">
                        <?= $employeeProfile['city'] ?>, <?= $employeeProfile['countryName'] ?>
                    </p>
                </div>
            </div>
        </div>
    </div>