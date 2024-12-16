<div class="col-lg-6">
    <div class="col-12 ligth-gray-box">
        <div class="row pl-15 pr-20">
            <div class="col-3  sub-tab-active pl-5">
                <?= Yii::t('app', 'Assigned Teams') ?>
            </div>
            <div class="col-9  sub-tab">
            </div>
        </div>
        <div class="col-12 mt-15 pt-0" style="height:295px;overflow-y: auto;">
            <div class="row">
                <?php
                if (isset($kgiTeams) && count($kgiTeams) > 0) {
                    foreach ($kgiTeams as $teamId => $team): ?>
                        <div class="col-lg-6 col-md-6 col-12 mb-10">
                            <div class="col-12 small-content bg-white pl-20">
                                <div class="row">
                                    <div class="col-2  pl-0 pr-0">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/team.svg"
                                            class="image-AssignMembers">
                                    </div>
                                    <div class="col-7 pl-10 border-right">
                                        <div class="col-12 font-size-12 text-b pr-0">
                                            <strong><?= $team['teamName'] ?></strong>
                                        </div>
                                        <div class="col-12 pim-employee-title" style="font-size: 10px !important;">
                                            <?= $team["departmentName"] ?>
                                        </div>
                                    </div>
                                    <div class="col-2 text-center pr-0 pl-0 pt-8" style="font-weight: 400;">
                                        <?= $team['totalEmployee'] ?>
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
    </div>
</div>
<div class="col-lg-6">
    <div class="col-12 ligth-gray-box">
        <div class="row pl-15 pr-20">
            <div class="col-3  sub-tab-active pl-5">
                <?= Yii::t('app', 'Assigned Individuals') ?>
            </div>
            <div class="col-9  sub-tab">
            </div>
        </div>
        <div class="col-12 alert bg-white mt-15 pt-0" style="height:280px;overflow-y: auto;">
            <div class="row">
                <?php
                if (isset($kgiDetail["kgiEmployeeDetail"]) && count($kgiDetail["kgiEmployeeDetail"]) > 0) {
                    foreach ($kgiDetail["kgiEmployeeDetail"] as $employeeId => $employee): ?>
                        <div class="col-lg-4 col-md-6 col-12 mt-10 pt-0" onclick="javascription:openEmployeeView(134,31)"
                            style="cursor: pointer;">
                            <div class="row">
                                <div class="col-3 pr-0 pl-0">
                                    <img src="<?= Yii::$app->homeUrl . $employee['picture'] ?>" class="image-AssignMembers">
                                </div>
                                <div class="col-9 pl-10">
                                    <div class="col-12 pim-employee-Name pr-0">
                                        <strong><?= $employee['name'] ?></strong>
                                    </div>
                                    <div class="col-12 pim-employee-title">
                                        <?= $employee['title'] ?>
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
    </div>
</div>