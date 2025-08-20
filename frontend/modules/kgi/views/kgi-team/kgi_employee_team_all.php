<div class="col-lg-6" id="man-check">
    <div class="col-12 ligth-gray-box">
        <div class="row pl-15 pr-20 ">
            <div class="col-6 sub-tab-active pl-5">
                <?= Yii::t('app', 'Current Assigned Teams') ?>
            </div>
            <div class="col-6 sub-tab text-end pr-0">
                <div class="btn-group" role="group">
                    <a id="manCheckAll">
                        <img src="<?= Yii::$app->homeUrl ?>images/icons/pim/man-check-blue.svg"
                            style="cursor: pointer;width:28px;height:26px;">
                    </a>
                    <a id="sumAll1">
                        <img src="<?= Yii::$app->homeUrl ?>images/icons/pim/reward.svg"
                            style="cursor: pointer;width:28px;height:26px;">
                    </a>
                </div>
            </div>
        </div>
        <div class="col-12 mt-15 pt-0" style="height:400px;overflow-y: auto;">
            <div class="row" style="--bs-gutter-x:10px;">
                <?php

                use frontend\models\hrvc\Team;

                $allTeam = "";
                if (isset($kgiTeams) && count($kgiTeams) > 0) {
                    foreach ($kgiTeams as $teamId => $team):
                ?>
                        <div class="col-6 mb-15">
                            <div class="small-content-pim bg-white" style="cursor: pointer;" onclick="javascript:showTeamEmployee1(<?= $teamId ?>)" id="selectTeam1-<?= $teamId ?>">
                                <div class="pr-0 pl-0 d-flex align-items-center" style="width: 20%;">
                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/pim/team.svg" style="margin-left: -3px;width:40px;height:40px;">
                                    <div class="team-number-tag"><?= $team["totalEmployee"] ?></div>
                                </div>
                                <div class="pr-5 pl-5" style="line-height: 15px;width:65%;">
                                    <div class="font-size-14 text-b pl-0 pr-0" style="font-weight: 400;">
                                        <strong><?= $team['teamName'] ?></strong>
                                    </div>
                                    <div class="pl-0 pr-0 mt-5" style="font-size: 12px !important;font-weight: 400;color:#656565;">
                                        <?= $team['departmentName'] ?>
                                    </div>
                                </div>
                                <div class="border-left align-content-center pr-0" style="font-weight: 400;width:20%;justify-items: center;">
                                    <a href="javascript:void(0);" onclick="event.stopPropagation(); kgiTeamHistoryView(<?= $kgiId ?>, <?= $teamId ?>)" class="doubleplay-btn flex-all-center ml-5">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/pim/doubleplay-black.svg" style="width:18px;height:18px;">
                                    </a>

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
    <?= $this->render('kgi_employee_team', ["kgiTeams" => $kgiTeams, "kgiId" => $kgiId]) ?>
</div>
<div class="col-lg-6" id="kgi-employee">
    <div class="col-12 ligth-gray-box">
        <div class="row pl-15 pr-20">
            <div class="col-6  sub-tab-active pl-5">
                <?= Yii::t('app', 'Current Assigned Individuals') ?>
            </div>
            <div class="col-6 sub-tab">
            </div>
        </div>
        <div class="col-12  mt-15 pt-0" style="height:400px;overflow-y: auto;">
            <?php

            if (isset($kgiDetail) && count($kgiDetail) > 0) {
                foreach ($kgiDetail as $teamId => $employee):
            ?>
                    <div class="col-12 border-bottom mb-5 pb-5 d-flex align-items-center" id="team1-<?= $teamId ?>">
                        <img src="<?= Yii::$app->homeUrl ?>images/icons/pim/team.svg" class="title-team-icon mr-5">
                        <span class="col-12 font-size-16 text-b " style="font-weight: 600;">
                            <?= Team::teamName($teamId) ?>
                        </span>
                    </div>
                    <div class="col-12 pr-0 pl-0" id="employee1-<?= $teamId ?>">
                        <div class="row" style="--bs-gutter-x:10px;">
                            <?php

                            if (isset($employee) && count($employee) > 0) {
                                foreach ($employee as $employeeId => $em):
                            ?>
                                    <div class="col-6 mb-10">
                                        <div class="small-content-pim" style="height:60px;">
                                            <div class="row" style="--bs-gutter-x:0px;width:100%;">
                                                <div class="col-2 pr-0 pl-0 text-center align-content-center">
                                                    <img src="<?= Yii::$app->homeUrl ?><?= $em['picture'] ?>" class="pim-image-AssignMembers">
                                                </div>
                                                <div class="col-10 pl-5">
                                                    <div class="col-12 font-size-16 text-b text-truncate" style="font-weight: 600;">
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
    <?= $this->render('kgi_employee_all', ["kgiDetail" => $kgiDetail]) ?>
</div>
<script>
    $(document).ready(function() {
        $('#manCheckAll').on('click', function() {
            $('#man-check').show();
            $('#all').css("display", 'none');
            $('#kgi-employee').show();
            $('#employee-all').css("display", 'none');
            $("#viewType").val('grid');
        });
        $('#sumAll1').on('click', function() {
            $('#man-check').css("display", 'none');
            $('#all').show();
            $('#employee-all').show();
            $('#kgi-employee').css("display", 'none');
            $("#viewType").val('list');
        });
    });
</script>
<style>
    .percentage-view {
        font-size: 10px;
    }
</style>