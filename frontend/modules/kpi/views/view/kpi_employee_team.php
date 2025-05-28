<div class="col-12 ligth-gray-box">
    <div class="row pl-15 pr-20">
        <div class="col-6  sub-tab-active pl-5">
            <?= Yii::t('app', 'Current Assigned Teams') ?>
        </div>
        <div class="col-6 sub-tab text-end pr-0">
            <div class="btn-group" role="group">
                <a id="manCheck">
                    <img src="<?= Yii::$app->homeUrl ?>images/icons/pim/man-check.svg"
                        style="cursor: pointer;">
                </a>
                <a id="sunAll">
                    <img src="<?= Yii::$app->homeUrl ?>images/icons/pim/reward-blue.svg"
                        style="cursor: pointer;">
                </a>
            </div>
        </div>
    </div>
    <div class="col-12 mt-15 alert pt-0" style="height:500px;overflow-y: auto;">
        <div class="row">
            <?php
            $allTeam2 = "";
            if (isset($kpiTeams) && count($kpiTeams) > 0) {
                foreach ($kpiTeams as $teamId => $team):
            ?>
                    <div class="col-12 mb-15">
                        <div class="col-12 small-content-pim bg-white" style="cursor: pointer;" onclick="javascript:showTeamEmployee2(<?= $teamId ?>)" id="selectTeam2-<?= $teamId ?>">
                            <div class="row">
                                <div class="col-1 pr-0 pl-0 text-center">
                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/pim/team.svg" class="">
                                    <div class="team-number-tag"><?= $team["totalEmployee"] ?></div>
                                </div>
                                <div class="col-5">
                                    <div class="col-12 font-size-16 text-b" style="font-weight: 600;">
                                        <?= $team['teamName'] ?>
                                    </div>
                                    <div class="col-12" style="font-size: 14px !important;font-weight: 400;color:#656565;">
                                        <?= $team["departmentName"] ?>
                                    </div>
                                </div>
                                <div class="col-5 text-center text-end">
                                    <div class="col-12 font-size-18 text-b pr-0 text-end">
                                        <span style="font-size: 18px !important;font-weight: 500;"><?= $team['result'] ?></span>
                                        <span style="font-size: 18px !important;font-weight: 700;color:#2580D3;"> / <?= $team["target"] ?></span>
                                    </div>
                                    <div class="col-12 text-end" style="font-size: 14px !important;font-weight: 400;color:#656565;">
                                        <?= $team["updateDateTime"] ?>
                                    </div>
                                </div>
                                <div class="col-1 text-center pr-0 pl-0 pt-10" style="font-weight: 400;">
                                    <a href="javascript:void(0);" onclick="event.stopPropagation(); kpiTeamHistoryView(<?= $kpiId ?>, <?= $teamId ?>)" class="doubleplay-btn">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/pim/doubleplay-black.svg" class="">
                                    </a>

                                </div>
                            </div>
                        </div>
                    </div>
            <?php
                    $allTeam2 .= $teamId . ',';
                endforeach;
            }
            ?>
        </div>
    </div>
</div>
<input type="hidden" id="currentTeam2" value="all">
<input type="hidden" id="allTeam2" value="<?= $allTeam2 ?>">
<script>
    $(document).ready(function() {
        $('#manCheck').on('click', function() {
            $('#man-check').show();
            $('#all').css("display", 'none');
            $('#kpi-employee').show();
            $('#employee-all').css("display", 'none');
            $("#viewType").val('grid');
        });
        $('#sumAll').on('click', function() {
            $('#man-check').css("display", 'none');
            $('#all').show();
            $('#employee-all').show();
            $('#kpi-employee').css("display", 'none');
            $("#viewType").val('list');
        });
    });
</script>