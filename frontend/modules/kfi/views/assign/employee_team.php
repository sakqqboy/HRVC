<?php
if (isset($kfiTeamEmployee) && count($kfiTeamEmployee) > 0) {
    foreach ($kfiTeamEmployee as $teamId => $kfiEmployee):
        if (isset($kfiEmployee["team"])) {
?>
            <div class="col-12 bg-header-assign  pr-8 mt-10 pt-5 pb-5" id="team-employee-<?= $teamId ?>">
                <div class="row" style="--bs-gutter-x:0px;">
                    <div class="col-7 font-size-12">
                        <div class="d-inline-flex" style="height:20px;align-items: center;">
                            <input type="checkbox" class="check-all-<?= $teamId ?> custom-checkbox" id="check-all-<?= $teamId ?>" onclick="checkAllEmployees(<?= $teamId ?>)">
                            <label for="check-all-<?= $teamId ?>" class="custom-checkbox-label"></label>
                        </div>
                        <div class="d-inline-flex" style="height:20px;align-items: center;gap:8px;">
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/team.svg" style="width:15px;height:15px;">
                            <b><?= $kfiEmployee["team"]["teamName"] ?>, </b>
                            <span class="font-size-10"><?= $kfiEmployee["team"]["departmentName"] ?></span>
                        </div>
                    </div>
                    <div class="col-5 font-size-12  text-end">
                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/blue-down.png" style="width:15px;height:15px;cursor:pointer;"
                            onclick="javascript:showEmployeeTeamTarget(<?= $teamId ?>)" id="show-<?= $teamId ?>">
                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/blue-up.png" style="width:15px;height:15px;display:none;cursor:pointer;"
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
                                <div class="row" style="--bs-gutter-x:0px;">
                                    <div class="col-2 flex-all-center pb-5">
                                        <input type="checkbox" class="from-check employee-checkbox-<?= $teamId ?>"
                                            <?= $employee["checked"] ?> name="employee[<?= $employeeId ?>]"
                                            id="employee-checkbox-<?= $employeeId ?>">
                                    </div>
                                    <div class="col-10 pb-5  d-flex align-items-center ">
                                        <img src="<?= Yii::$app->homeUrl ?><?= $employee["picture"] ?>" class="employee-pic-circle mr-10">
                                        <b><?= $employee["employeeFirstname"] ?> <?= $employee["employeeSurename"] ?></b>
                                    </div>

                                </div>
                            </div>
                            <div class="col-7 font-size-12  d-flex align-items-center pb-5">
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