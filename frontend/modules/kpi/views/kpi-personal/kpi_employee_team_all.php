<div class="col-lg-6" id="man-check">
    <div class="col-12 ligth-gray-box">
        <div class="row pl-15 pr-20">
            <div class="col-5  sub-tab-active pl-5">
                <?= Yii::t('app', 'Current Assigned Teams') ?>
            </div>
            <div class="col-7 sub-tab text-end pr-0">
                <div class="btn-group" role="group">
                    <a id="manCheckAll">
                        <img src="<?= Yii::$app->homeUrl ?>images/icons/pim/man-check-blue.svg"
                            style="cursor: pointer;">
                    </a>
                    <a id="sumAll1">
                        <img src="<?= Yii::$app->homeUrl ?>images/icons/pim/reward.svg"
                            style="cursor: pointer;">
                    </a>
                </div>
            </div>
        </div>
        <div class="col-12 mt-15 alert pt-0" style="height:500px;overflow-y: auto;">
            <div class="row">
                <?php

                use frontend\models\hrvc\Team;

                $allTeam = "";
                if (isset($kpiTeams) && count($kpiTeams) > 0) {
                    foreach ($kpiTeams as $teamId => $team):
                ?>
                        <div class="col-6 mb-15">
                            <div class="col-12 small-content-pim bg-white" style="cursor: pointer;" onclick="javascript:showTeamEmployee1(<?= $teamId ?>)" id="selectTeam1-<?= $teamId ?>">
                                <div class="row">
                                    <div class="col-2 pr-0 pl-0 text-center">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/pim/team.svg" class="">
                                        <div class="team-number-tag"><?= $team["totalEmployee"] ?></div>
                                    </div>
                                    <div class="col-8 border-right">
                                        <div class="col-12 font-size-16 text-b" style="font-weight: 600;">
                                            <strong><?= $team['teamName'] ?></strong>
                                        </div>
                                        <div class="col-12" style="font-size: 14px !important;font-weight: 400;color:#656565;">
                                            <?= $team["departmentName"] ?>
                                        </div>
                                    </div>
                                    <div class="col-2 text-center pr-0 pl-0 pt-10" style="font-weight: 400;">
                                        <a href="javascript:void(0);" onclick="event.stopPropagation(); kpiTeamHistoryView(<?= $kpiId ?>, <?= $teamId ?>)" class="doubleplay-btn">
                                            <img src="<?= Yii::$app->homeUrl ?>images/icons/pim/doubleplay-black.svg" class="">
                                        </a>

                                    </div>
                                </div>
                            </div>
                        </div>
                <?php
                        $allTeam .= $teamId . ',';
                    endforeach;
                }
                ?>
            </div>
        </div>
    </div>
</div>
<div class="col-lg-6" id="all" style="display:none;">
    <?= $this->render('kpi_employee_team', ["kpiTeams" => $kpiTeams, "kpiId" => $kpiId]) ?>
</div>
<div class="col-lg-6" id="kpi-employee">
    <div class="col-12 ligth-gray-box">
        <div class="row pl-15 pr-20">
            <div class="col-6  sub-tab-active pl-5">
                <?= Yii::t('app', 'Current Assigned Individuals') ?>
            </div>
            <div class="col-6 sub-tab">
            </div>
        </div>
        <div class="col-12 alert  mt-15 pt-0" style="height:500px;overflow-y: auto;">
            <?php

            if (isset($kpiDetail) && count($kpiDetail) > 0) {
                foreach ($kpiDetail as $teamId => $employee):
            ?>
                    <div class="col-12 border-bottom pb-10 pt-10 mb-10" id="team1-<?= $teamId ?>">
                        <img src="<?= Yii::$app->homeUrl ?>images/icons/pim/team.svg" class="mr-8 title-team-icon">
                        <span class="col-12 font-size-18 text-b " style="font-weight: 600;">
                            <?= Team::teamName($teamId) ?>
                        </span>
                    </div>
                    <div class="col-12" id="employee1-<?= $teamId ?>">
                        <div class="row">
                            <?php

                            if (isset($employee) && count($employee) > 0) {
                                foreach ($employee as $employeeId => $em):
                            ?>
                                    <div class="col-6 mb-15">
                                        <div class="col-12 small-content-pim" style="cursor: pointer;">
                                            <div class="row">
                                                <div class="col-2 pr-0 pl-0 text-center">
                                                    <img src="<?= Yii::$app->homeUrl ?><?= $em['picture'] ?>" class="pim-image-AssignMembers">
                                                </div>
                                                <div class="col-10">
                                                    <div class="col-12 font-size-16 text-b" style="font-weight: 600;">
                                                        <?= $em['employeeName'] ?>
                                                    </div>
                                                    <div class="col-12" style="font-size: 14px !important;font-weight: 400;color:#656565;">
                                                        <?= $em["title"] == '' ? 'Not set' : $em["title"] ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            <?php
                                endforeach;
                            }
                            ?>
                        </div>
                    </div>

            <?php

                endforeach;
            }
            ?>
        </div>
    </div>
</div>
<input type="hidden" id="currentTeam1" value="all">
<input type="hidden" id="allTeam1" value="<?= $allTeam ?>">
<div class="col-lg-6" id="employee-all" style="display:none;">
    <?= $this->render('kpi_employee_all', ["kpiDetail" => $kpiDetail]) ?>
</div>
<script>
    $(document).ready(function() {
        $('#manCheckAll').on('click', function() {
            $('#man-check').show();
            $('#all').css("display", 'none');
            $('#kpi-employee').show();
            $('#employee-all').css("display", 'none');
            $("#viewType").val('grid');
        });
        $('#sumAll1').on('click', function() {
            $('#man-check').css("display", 'none');
            $('#all').show();
            $('#employee-all').show();
            $('#kpi-employee').css("display", 'none');
            $("#viewType").val('list');
        });
    });
</script>