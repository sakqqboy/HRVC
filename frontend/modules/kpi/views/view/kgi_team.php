<td colspan="8">
    <div class="row">
        <?php
        if (isset($kgiTeams) && count($kgiTeams) > 0) {
            foreach ($kgiTeams as $kgiTeam):
        ?>
                <div class="col-lg-4 col-md-3 col-sm-6 col-12   p-2">
                    <div class="col-12 pt-5 pb-5 pim-info">
                        <div class="row">
                            <div class="col-8 border-right">
                                <div class="col-12">
                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/team-blue.svg"
                                        class="pim-icon mr-3" style="margin-top:-4px;">
                                    <span class="font-size-12 font-b"><?= $kgiTeam["teamName"] ?></span>
                                    <div class="col-12 pim-subheader-font"><?= $kgiTeam["departmentName"] ?></div>
                                </div>
                                <div class="col-12 mt-10">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="row">
                                                <div class="col-2">
                                                    <?php
                                                    if (isset($kgiTeam['kgiEmployeeSelect'][0])) {
                                                    ?>
                                                        <img src="<?= Yii::$app->homeUrl . $kgiTeam['kgiEmployeeSelect'][0] ?>"
                                                            class="pim-pic-grid">
                                                    <?php
                                                    }
                                                    ?>
                                                </div>
                                                <div class="col-2 pic-after pt-0">
                                                    <?php
                                                    if (isset($kgiTeam['kgiEmployeeSelect'][1])) {
                                                    ?>
                                                        <img src="<?= Yii::$app->homeUrl . $kgiTeam['kgiEmployeeSelect'][1] ?>"
                                                            class="pim-pic-grid">
                                                    <?php
                                                    }
                                                    ?>
                                                </div>
                                                <div class="col-2 pic-after pt-0">
                                                    <?php
                                                    if (isset($kgiTeam['kgiEmployeeSelect'][2])) {
                                                    ?>
                                                        <img src="<?= Yii::$app->homeUrl . $kgiTeam['kgiEmployeeSelect'][2] ?>"
                                                            class="pim-pic-grid">
                                                    <?php
                                                    }
                                                    ?>
                                                </div>
                                                <div class="col-5 number-tag load-info pr-0 pl-0 pt-1"
                                                    style="margin-left: -3px;height:24px;width:24px;border-radius:100%;">
                                                    <?= $kgiTeam["countTeamEmployee"] ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6 text-end font-b font-size-10 pt-8">
                                            <?= $kgiTeam["target"] ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="col-12 mt-5">
                                    <div role="progressbar_step_Blue" aria-valuenow="<?= $kgiTeam["ratio"] ?>" aria-valuemin="0"
                                        aria-valuemax="100" style="--value:<?= (int)$kgiTeam["ratio"] ?>;margin-top:-3px;">
                                    </div>
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
</td>