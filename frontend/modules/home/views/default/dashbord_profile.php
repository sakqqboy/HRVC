<div class="text-left position-relative">
    <div class="d-flex align-items-center">
        <div class="col-4 text-center position-relative">
            <img src="<?=Yii::$app->homeUrl?><?= $employeeProfile['picture'] ?>"
                class="profile-picture rounded-circle mb-3" alt="User Avatar" style="width: 80px; height: 80px;">
            <span class="badge bg-primary position-absolute bottom-0 start-50 translate-middle-x p-1">
                <?= $employeeProfile['employeeConditionName'] ?>
            </span>
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
            <p class="profile-role text-muted small mb-0"><?= $employeeProfile['titleName'] ?></p>
        </div>
    </div>
</div>

<ul class="profile-details list-unstyled small mt-10">
    <li>
        <strong>
            <img src="<?=Yii::$app->homeUrl?>images/icons/Settings/mail.svg" alt="Company" class="pim-icon"
                style="width: 14px; height: 14px;">
        </strong>
        <?php 
        if (strlen($employeeProfile["email"]) > 30) {
            $email = substr($employeeProfile["email"], 0, 30) . '. . .';
        } else {
            $email = $employeeProfile["email"];
        }        
        echo $email; ?>
        <a href="javascript:copyToClipboard('<?= $employeeProfile['email'] ?>')" class="pim-icon copy-btn"
            data-email="<?= $employeeProfile['email'] ?>">
            <img src="<?=Yii::$app->homeUrl?>images/icons/Settings/coppy.svg" alt="Copy Email" class="pim-icon"
                style="width: 14px; height: 14px; padding-bottom: 4px; margin-top: 5px">
        </a>
    </li>
    <li>
        <strong>
            <img src="<?=Yii::$app->homeUrl?>images/icons/Settings/employee.svg" alt="Company" class="pim-icon"
                style="width: 14px; height: 14px;">
            Employee ID:
        </strong>
        <?= $employeeProfile['employeeId'] ?>
    </li>
    <li>
        <strong>
            <img src="<?=Yii::$app->homeUrl?>images/icons/Settings/calendar.svg" alt="Company" class="pim-icon"
                style="width: 14px; height: 14px;">
            Employee Since :
        </strong>
        <?php
        $formattedDate = date("jS F Y", strtotime($employeeProfile['joinDate']));
        echo $formattedDate;
        ?>
    </li>
</ul>
<hr class="custom-hr mb-10">
<div class="text-left">
    <div class="d-flex align-items-center">
        <img src="<?=Yii::$app->homeUrl?>images/testimg/TCF.svg" class="profile-picture rounded-circle mb-3"
            alt="User Avatar" style="width: 40px;">
        <div class="ms-3">
            <h6 class="profile-name small mb-0"><?= $employeeProfile['companyName'] ?></h6>
            <p class="profile-role text-muted small mb-0">
                <img src="<?=Yii::$app->homeUrl?><?= $employeeProfile['flag'] ?>"
                    class="profile-picture rounded-circle mb-3" alt="User Avatar" style="width: 14px; height: 14px;">
                <?= $employeeProfile['city'] ?>, <?= $employeeProfile['nationalityName'] ?>
            </p>
        </div>
    </div>
</div>