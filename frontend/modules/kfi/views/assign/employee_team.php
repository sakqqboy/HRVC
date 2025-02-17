<?php
if (isset($kfiTeamEmployee) && count($kfiTeamEmployee) > 0) {
    foreach ($kfiTeamEmployee as $teamId => $kfiEmployee):
        if (isset($kfiEmployee["team"])) {
?>
<div class="col-12 bg-header-assign pb-0 pt-0 pr-8 mt-10" id="team-employee-<?= $teamId ?>">
    <div class="row">
        <div class="col-3">
            <div class="pl-10">
                <input type="checkbox" class="check-all-<?= $teamId ?>" onclick="checkAllEmployees(<?= $teamId ?>)"
                    style="top: 2px;">
                <label for="check-all-<?= $teamId ?>" class="font-size-12">Check All</label>
            </div>
        </div>
        <div class="col-4 font-size-12 pt-5 pb-3">
            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/team-black.png" style="width:15px;margin-top:-3px;"
                class="ml-5 mr-5">
            <b><?= $kfiEmployee["team"]["teamName"] ?>, </b><span class="col-12 font-size-10">
                <?= $kfiEmployee["team"]["departmentName"] ?></span>
        </div>
        <div class="col-5 font-size-12 pt-5 pb-3 text-center">
            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/blue-down.png"
                style="width:15px;margin-top:0px;float:right;cursor:pointer;" class="ml-5"
                onclick="javascript:showEmployeeTeamTarget(<?= $teamId ?>)" id="show-<?= $teamId ?>">
            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/blue-up.png"
                style="width:15px;margin-top:0px;float:right;display:none;cursor:pointer;" class="ml-5"
                onclick="javascript:hideEmployeeTeamTarget(<?= $teamId ?>)" id="hide-<?= $teamId ?>">
        </div>
    </div>
</div>
<?php
        }
        ?>
<div class="col-12 pr-0 pl-0" id="employee-in-team-<?= $teamId ?>" style="display:none;">
    <?php
        if (isset($kfiEmployee["employee"]) && count($kfiEmployee["employee"]) > 0) {
            foreach ($kfiEmployee["employee"] as $employeeId => $employee):
    ?>
    <div class="col-12 bg-white border-bottom">
        <div class="row">
            <div class="col-5 font-size-12 pt-5">
                <div class="row">
                    <div class="col-2 text-center pr-0 pl-0 pt-10">
                        <input type="checkbox" class="from-check ml-10 employee-checkbox-<?= $teamId ?>"
                            <?= $employee["checked"] ?> name="employee[<?= $employeeId ?>]"
                            id="employee-checkbox-<?= $employeeId ?>">
                    </div>
                    <div class="col-2 pr-5 pl-0 text-center">
                        <img src="<?= Yii::$app->homeUrl ?><?= $employee["picture"] ?>" class="employee-pic-circle">
                    </div>
                    <div class="col-8 pl-5 pt-5">
                        <span class="font-size-12"><b><?= $employee["employeeFirstname"] ?>
                                <?= $employee["employeeSurename"] ?></b></span>
                    </div>
                </div>
            </div>
            <div class="col-5 font-size-12 text-start pt-5">
                <?= Yii::t('app', $employee["titleName"]) ?>
            </div>

        </div>
    </div>
    <?php
            endforeach;
        }
    ?>
</div>
<?php
    endforeach;
}
?>

<script>
// ฟังก์ชันที่ทำงานเมื่อคลิกที่ checkbox "Check All"
function checkAllEmployees(teamId) {
    var checkboxes = document.querySelectorAll('#employee-in-team-' + teamId + ' input[type="checkbox"]');
    var checkAllCheckbox = document.querySelector('.check-all-' + teamId);

    // ตรวจสอบสถานะของเช็คบ็อกซ์ทั้งหมดในทีม
    if (checkAllCheckbox.checked) {
        checkboxes.forEach(function(checkbox) {
            checkbox.checked = true; // เลือกทั้งหมด
        });
    } else {
        checkboxes.forEach(function(checkbox) {
            checkbox.checked = false; // ยกเลิกการเลือกทั้งหมด
        });
    }
}

// ฟังก์ชันที่ตรวจสอบว่าเช็คบ็อกซ์ทั้งหมดถูกเลือกแล้วหรือไม่เมื่อโหลดหน้า
document.addEventListener("DOMContentLoaded", function() {
    var allTeamIds = document.querySelectorAll('[class^="check-all-"]'); // หา check-all ทุกทีม
    console.log(allTeamIds); // แสดงข้อมูล NodeList ของ check-all ทุกทีม

    allTeamIds.forEach(function(teamCheckbox) {
        // ตรวจสอบว่า classList มีมากกว่า 1 ค่าก่อนที่จะใช้ split
        if (teamCheckbox.classList.length > 1) {
            var teamId = teamCheckbox.classList[1].split('-')[1]; // ดึง teamId จาก class
            console.log(teamId); // แสดงค่า teamId

            var checkboxes = document.querySelectorAll('#employee-in-team-' + teamId +
                ' input[type="checkbox"]');
            console.log(checkboxes); // แสดงข้อมูล NodeList ของ checkboxes ของทีม

            // ตรวจสอบว่าเช็คบ็อกซ์ทุกอันถูกเลือกหรือยัง
            var allChecked = Array.from(checkboxes).every(function(checkbox) {
                return checkbox.checked;
            });

            // ถ้าทุกเช็คบ็อกซ์ถูกเลือก ให้ทำการเลือก "Check All"
            if (allChecked) {
                teamCheckbox.checked = true;
            }
        } else {
            console.warn('No teamId found for checkbox: ',
            teamCheckbox); // แจ้งเตือนหากไม่มี class ที่เป็น teamId
        }
    });
});
</script>