<?php
if (isset($kfiTeamEmployee) && count($kfiTeamEmployee) > 0) {
    foreach ($kfiTeamEmployee as $teamId => $kfiEmployee):
        if (isset($kfiEmployee["team"])) {
?>
<style>
.custom-checkbox {
    display: none;
    /* ซ่อน checkbox */
}

.custom-checkbox-label {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 14px;
    height: 14px;
    border: 0.5px solid #2580D3;
    border-radius: 4px;
    cursor: pointer;
    background-color: #fff;
    margin-left: 10px;
}

.custom-checkbox-label::before {
    font-weight: bold;
    color: #2580D3;
}

.custom-checkbox:checked+.custom-checkbox-label {
    background-color: #2580D3;
}

.custom-checkbox:checked+.custom-checkbox-label::before {
    content: "✔";
    color: white;
    font-size: 10px;
}

/* เมื่อสถานะเป็นลบ (บางรายการไม่ได้เลือก) */
.custom-checkbox-label.minus::before {
    content: "⎻";
    font-size: 15px;
    font-weight: bold;
    /* padding-top: 4px; */
    color: #2580D3;
}
</style>
<div class="col-12 bg-header-assign pb-0 pt-0 pr-8 mt-10" id="team-employee-<?= $teamId ?>">
    <div class="row">
        <div class="col-7 font-size-12 pt-5 pb-3">
            <!-- Custom Check All Checkbox -->
            <input type="checkbox" class="check-all-<?= $teamId ?> custom-checkbox" id="check-all-<?= $teamId ?>"
                onclick="checkAllEmployees(<?= $teamId ?>)">
            <label for="check-all-<?= $teamId ?>" class="custom-checkbox-label"></label>
            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/team-black.png" style="width:15px;margin-top:-3px;"
                class="ml-5 mr-5">
            <b><?= $kfiEmployee["team"]["teamName"] ?>, </b><span
                class="col-12 font-size-10"><?= $kfiEmployee["team"]["departmentName"] ?></span>
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
function allEmployeesCheck(teamId) {
    var checkboxes = document.querySelectorAll('#employee-in-team-' + teamId + ' input[type="checkbox"]');
    var checkAllCheckbox = document.querySelector('.check-all-' + teamId);
    var checkAllLabel = document.querySelector('.check-all-' + teamId + ' + .custom-checkbox-label');

    var allChecked = true;
    var someChecked = false;
    // alert(0);
    // ตรวจสอบสถานะของ checkbox ทั้งหมดในทีม
    checkboxes.forEach(function(checkbox) {
        if (!checkbox.checked) {
            allChecked = false; // ถ้า checkbox ใดไม่ถูกเลือก
            // alert(0);
        } else {
            someChecked = true; // ถ้ามีบาง checkbox ที่ถูกเลือก
            // alert(1);
        }
    });

    // ถ้าทุก checkbox ถูกเลือก
    if (allChecked) {
        checkAllCheckbox.checked = true;
        checkAllLabel.classList.remove('minus');
        // checkAllLabel.style.top = "0px"; // เอา margin-top ออกถ้าถูกเลือกทั้งหมด
    } else if (someChecked) {
        checkAllCheckbox.checked = false;
        checkAllLabel.classList.add('minus');
        // checkAllLabel.style.top = "0px"; // เอา margin-top ออกถ้าบางตัวถูกเลือก  
        // alert(0);
    } else {
        checkAllCheckbox.checked = false;
        checkAllLabel.classList.remove('minus');
        checkAllLabel.style.top = "3px"; // เพิ่ม margin-top ถ้าไม่มีการเลือก
        // alert(0);
    }
}

// ฟังก์ชันที่ทำงานเมื่อคลิกที่ checkbox "Check All"
function checkAllEmployees(teamId) {
    var checkboxes = document.querySelectorAll('#employee-in-team-' + teamId + ' input[type="checkbox"]');
    var checkAllCheckbox = document.querySelector('.check-all-' + teamId);
    var checkAllLabel = document.querySelector('.check-all-' + teamId + ' + .custom-checkbox-label');

    // ถ้าเลือก "Check All"
    if (checkAllCheckbox.checked) {
        checkboxes.forEach(function(checkbox) {
            checkbox.checked = true; // เลือกทั้งหมด
        });
        checkAllLabel.classList.remove('minus'); // ลบเครื่องหมายลบ
        checkAllLabel.style.top = "0px"; // เอา margin-top ออกถ้าบางตัวถูกเลือก
    } else {
        checkboxes.forEach(function(checkbox) {
            checkbox.checked = false; // ยกเลิกการเลือกทั้งหมด
        });
        checkAllLabel.classList.remove('minus'); // ลบเครื่องหมายลบ
        checkAllLabel.style.top = "0px"; // เอา margin-top ออกถ้าบางตัวถูกเลือก
    }

    // เรียกใช้ allEmployeesCheck เพื่ออัปเดตสถานะของ Check All
    allEmployeesCheck(teamId);
}

document.addEventListener("DOMContentLoaded", function() {
    var allTeamCheckboxes = document.querySelectorAll('[class^="check-all-"]');

    allTeamCheckboxes.forEach(function(checkbox) {
        var teamId = checkbox.className.match(/check-all-(\d+)/)[1]; // ดึงตัวเลขจาก class name

        // เพิ่ม Event Listener ให้ Check All Checkbox ทำงาน
        checkbox.addEventListener("change", function() {
            var checkboxes = document.querySelectorAll('#employee-in-team-' + teamId +
                ' input[type="checkbox"]');
            var isChecked = checkbox.checked;

            // เมื่อคลิกที่ Check All จะเลือกหรือยกเลิกการเลือก checkbox ทุกตัว
            checkboxes.forEach(function(checkbox) {
                checkbox.checked = isChecked;
            });

            // เรียกใช้ checkAllEmployees เพื่ออัปเดตสถานะของ Check All
            allEmployeesCheck(teamId);
        });

        // เพิ่ม Event Listener สำหรับ checkbox ที่ individual
        var individualCheckboxes = document.querySelectorAll('.employee-checkbox-' + teamId);
        individualCheckboxes.forEach(function(individualCheckbox) {
            individualCheckbox.addEventListener("change", function() {
                // เมื่อมีการคลิกที่ individual checkbox ให้เรียก checkAllEmployees เพื่อเช็คสถานะ
                allEmployeesCheck(teamId);
            });
        });

        // เรียกใช้ checkAllEmployees เพื่อเช็คสถานะเริ่มต้น
        allEmployeesCheck(teamId);
    });
});
</script>