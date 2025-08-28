<?php
if (isset($kgiTeamEmployee) && count($kgiTeamEmployee) > 0) {
    foreach ($kgiTeamEmployee as $teamId => $kgiEmployee):
        $show = 0;
        if ($role == 3 && $teamId == $userTeamId) {
            $show = 1;
        }
        if ($role > 3) {
            $show = 1;
        }
        if (isset($kgiEmployee["team"])) {
            //throw new Exception(print_r($kgiEmployee["team"], true));
?>
            <div class="pim-assign-employee-header" id="team-employee-<?= $teamId ?>">
                <div class="font-size-12">
                    <div class="cycle-pim-assign-team" style="height: 25px;width:25px;">
                        <img src="<?= Yii::$app->homeUrl ?>image/teams.svg" alt="icon" style="height: 14px;width:14px;">
                    </div>
                </div>
                <div class="font-size-10" style="width:33%;">
                    <b><?= $kgiEmployee["team"]["teamName"] ?>, </b>
                    <span class="font-size-10"><?= $kgiEmployee["team"]["departmentName"] ?></span>
                </div>
                <div class="d-flex font-size-12" style="width:26%;">
                    <div class="me-auto pl-5">
                        <b><span id="total-team-target-<?= $teamId ?>"><?= number_format($kgiEmployee["team"]["totalTeamTarget"], 2) ?></span></b>
                    </div>
                    <div class="text-end">
                        <?php
                        if ($kgiEmployee["team"]["isMore"] == '1') {
                        ?>
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/arrow-up.svg" style="width:8px;">
                        <?php
                        }
                        if ($kgiEmployee["team"]["isMore"] == '0') {
                        ?>
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/arrow-equal.svg" style="width:8px;">
                        <?php
                        }
                        if ($kgiEmployee["team"]["isMore"] == '-1') {
                        ?>
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/arrow-down.svg" style="width:8px;">
                        <?php
                        }
                        ?>
                        <span class="font-size-10"><?= number_format($kgiEmployee["team"]["percentage"]) ?> %</span>
                    </div>
                </div>
                <div class="d-flex flex-grow-1 justify-content-start font-size-12  pl-10">
                    <div class="form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" checked>
                    </div>
                    <label class="label-switch" for="flexSwitchCheckDefault">Set Remark For All</label>
                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/blue-down.png" class="ms-auto" style="width:15px;height:17px;cursor:pointer;"
                        onclick="javascript:showEmployeeTeamTarget(<?= $teamId ?>)" id="show-<?= $teamId ?>">
                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/blue-up.png" class="ms-auto"
                        style="width:15px;height:17px;display:none;cursor:pointer;"
                        onclick="javascript:hideEmployeeTeamTarget(<?= $teamId ?>)" id="hide-<?= $teamId ?>">
                </div>
            </div>
        <?php
        }
        ?>
        <div class="col-12 pr-0 pl-0 mb-10" id="employee-in-team-<?= $teamId ?>" style="display:none;">
            <?php
            if (isset($kgiEmployee["employee"]) && count($kgiEmployee["employee"]) > 0) {
                $i = 0;
                foreach ($kgiEmployee["employee"] as $employeeId => $employee):
            ?>
                    <div class="col-12 bg-white border-bottom pl-10" style="height:40px;align-content: center;">
                        <div class="row" style="--bs-gutter-x:0px;">
                            <div class="col-5 font-size-12" style="align-content:center;">
                                <div class="row" style="--bs-gutter-x:0px;">
                                    <div class="col-1 text-center" style="align-content: center;">
                                        <?php
                                        if ($show == 1) {
                                        ?>
                                            <input type="checkbox" id="employee-<?= $employeeId ?>" class="from-check"
                                                <?= $employee["checked"] ?>>
                                            <?php
                                        } else {
                                            if ($employee["checked"] == "checked") {
                                            ?>
                                                <i class="fa fa-check-square text-primary font-size-16" aria-hidden="true"></i>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </div>
                                    <div class="col-2 text-center">
                                        <img src="<?= Yii::$app->homeUrl ?><?= $employee["picture"] ?>" class="employee-pic-circle">
                                    </div>
                                    <div class="col-9" style="align-content: center;">
                                        <span class="font-size-12"><b><?= $employee["employeeFirstname"] ?>
                                                <?= $employee["employeeSurename"] ?></b></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3 font-size-12 text-center" style="align-content:center;">
                                <?php
                                if ($show == 1) {
                                ?>
                                    <input type="text" class="assign-target text-end numberOnly employeeTarget employee-target-<?= $teamId ?> employee-<?= $teamId ?>-<?= $i ?>"
                                        name="employeeTarget[<?= $employeeId ?>]"
                                        placeholder="0.00" style="height: 28px;width:130px;"
                                        value="<?= $employee['target'] != "" ? number_format($employee['target'], 2) : '' ?>"
                                        id="employee-target-<?= $employeeId ?>"
                                        onkeyup="javascript:updateEmployeeTerget(event,<?= $teamId ?>,<?= $employeeId ?>)">
                                <?php
                                } else { ?>
                                    <input type="text" class="assign-target text-end employee-target-<?= $teamId ?>" name="employeeTarget[<?= $employeeId ?>]"
                                        placeholder="0.00" style="height: 28px;width:130px;"
                                        value="<?= $employee['target'] != "" ? number_format($employee['target'], 2) : '' ?>"
                                        id="employee-target-<?= $employeeId ?>" disabled>
                                    <input type="hidden" name="employeeTarget[<?= $employeeId ?>]" placeholder="0.00"
                                        value="<?= $employee['target'] != "" ? number_format($employee['target'], 2) : '' ?>"
                                        class="employee-target-<?= $teamId ?>"
                                        id="employee-target-<?= $employeeId ?>">
                                <?php
                                }
                                ?>
                            </div>
                            <div class="col-4 font-size-12 text-center pr-5 pl-5" style="display:flex;align-items:center">
                                <?php
                                if ($show == 1) {
                                ?>
                                    <textarea type="text" class="assign-target remark-<?= $teamId ?>-<?= $i ?>" id="employee-remark-<?= $employeeId ?>" name="employeeRemark[<?= $employeeId ?>]"
                                        style="height: 30px;width:100%;"
                                        onkeydown="javascript:checkEnter(event,<?= $teamId ?>,<?= $i ?>)"></textarea>
                                <?php
                                } else { ?>
                                    <textarea type=" text" class="assign-target" id="employee-remark-<?= $employeeId ?>" name="employeeRemark[<?= $employeeId ?>]" style="height: 30px;width:100%;" disabled></textarea>
                                    <input type="hidden" name="employeeRemark[<?= $employeeId ?>]">
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
            <?php
                    $i++;
                endforeach;
            }
            ?>
        </div>
<?php

    endforeach;
}
?>
<input type="hidden" id="nextIndex" value="0">