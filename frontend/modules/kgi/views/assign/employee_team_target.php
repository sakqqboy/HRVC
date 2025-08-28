<div class="pim-assign-employee-header" id="team-employee-<?= $teamId ?>">
    <div class="font-size-12">
        <div class="cycle-pim-assign-team" style="height: 25px;width:25px;">
            <img src="<?= Yii::$app->homeUrl ?>image/teams.svg" alt="icon" style="height: 14px;width:14px;">
        </div>
    </div>
    <div class="font-size-10" style="width:33%;">
        <b><?= $teamDetail["teamName"] ?>, </b>
        <span class="font-size-10"><?= $teamDetail["departmentName"] ?></span>
    </div>
    <div class="d-flex font-size-12" style="width:26%;">
        <div class="me-auto pl-5">
            <b><span id="total-team-target-<?= $teamId ?>"><?= number_format($employeeTeamTarget["totalTarget"], 2) ?></span></b>
        </div>
        <div class="text-end">
            <?php
            if ($employeeTeamTarget["isMore"] == '1') {
            ?>
                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/arrow-up.svg" style="width:8px;">
            <?php
            }
            if ($employeeTeamTarget["isMore"] == '0') {
            ?>
                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/arrow-equal.svg" style="width:8px;">
            <?php
            }
            if ($employeeTeamTarget["isMore"] == '-1') {
            ?>
                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/arrow-down.svg" style="width:8px;">
            <?php
            }
            ?>
            <span class="font-size-10"><?= number_format($employeeTeamTarget["percentage"]) ?> %</span>
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
<div class="col-12 pr-0 pl-0 mb-10" id="employee-in-team-<?= $teamId ?>">
    <?php
    if (isset($employeeTeamTarget["employee"]) && count($employeeTeamTarget["employee"]) > 0) {
        $i = 0;
        foreach ($employeeTeamTarget["employee"] as $employeeId => $employee):
    ?>
            <div class="col-12 bg-white border-bottom pl-10" style="height:40px;align-content: center;">
                <div class="row" style="--bs-gutter-x:0px;">
                    <div class="col-5 font-size-12" style="align-content:center;">
                        <div class="row" style="--bs-gutter-x:0px;">
                            <div class="col-1 text-center" style="align-content: center;">

                                <input type="checkbox" id="employee-<?= $employeeId ?> employee-<?= $teamId ?>-<?= $i ?>" class="from-check" <?= $employee["checked"] ?>>

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
                        <input type="text" class="assign-target text-end numberOnly employeeTarget employee-target-<?= $teamId ?> employee-<?= $teamId ?>-<?= $i ?>"
                            name="employeeTarget[<?= $employeeId ?>]"
                            placeholder="0.00" style="height: 28px;width:130px;"
                            value="<?= $employee['target'] != "" ? number_format($employee['target'], 2) : '' ?>"
                            id="employee-target-<?= $employeeId ?>"
                            onkeyup="javascript:updateEmployeeTerget(event,<?= $teamId ?>,<?= $employeeId ?>)">
                    </div>
                    <div class="col-4 font-size-12 text-center pr-5 pl-5" style="display:flex;align-items:center">
                        <textarea type="text" class="assign-target remark-<?= $teamId ?>-<?= $i ?>" id="employee-remark-<?= $employeeId ?>" name="employeeRemark[<?= $employeeId ?>]"
                            style="height: 30px;width:100%;"
                            onkeydown="javascript:checkEnter(event,<?= $teamId ?>,<?= $i ?>)"></textarea>
                    </div>
                </div>
            </div>
    <?php
            $i++;
        endforeach;
    }
    ?>
</div>