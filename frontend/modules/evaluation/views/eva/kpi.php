<?php

use common\models\ModelMaster;

if (isset($masterKpiTeam) && count($masterKpiTeam) > 0) { ?>
	<div class="col-12 font-weight-500 font-size-14 mt-10">KPI Team</div>
	<?php
	foreach ($masterKpiTeam as $kpiTeamWeightId => $kpiTeam) :
	?>
		<div class="col-12 bg-white pl-5 pr-5 mt-10 pb-10" style="border-radius: 5px;min-height:100px;">
			<span class="font-size-12 text-secondary ">
				Weight <span class="font-b"><?= $kpiTeam["weight"] ?> %</span>
			</span>
			<div class="row" style="margin-top: -10px;">
				<div class="col-2 pt-15">
					<span class="badge bg-primary" style="font-size: 8px;">PL</span>
					<span class="font-size-12 font-weight-500 mt-5 ml-10" style="position:absolute;">
						<?= $kpiTeam["kpiName"] ?>
					</span>
				</div>
				<div class="col-1">
					<div class="col-12 font-size-12 text-center text-secondary">
						Target
					</div>
					<div class="col-12 font-size-12 text-center font-weight-500 mt-5">
						<?= number_format($kpiTeam["target"]) ?>
					</div>
					<div class="col-12 font-size-12 text-center text-secondary">
						Result
					</div>
					<div class="col-12 font-size-12 mt-5">
						<input type="text" class="form-control font-size-12 pr-3 pl-3 pt-0 pb-0 text-end" id="kpi-team-result-<?= $kpiTeamWeightId ?>" value="<?= $kpiTeam["result"] ?>">
					</div>
				</div>
				<div class="col-4">
					<div class="row">
						<div class="col-6  pr-0 pl-0">
							<div class="col-12 text-secondary font-size-10 pl-0">Comment</div>
							<div class="row pr-5 pl-0 mt-5">
								<div class="col-3 font-size-10 text-center pt-15">Mid</div>
								<div class="col-9 ">
									<textarea class="form-control font-size-10 pt-3 pr-3 pl-3 pb-3" id="kpi-team-mid-comment-<?= $kpiTeamWeightId ?>" style="height: 50px;"><?= $kpiTeam["midComment"] ?></textarea>
								</div>
							</div>
						</div>
						<div class="col-6  pr-0 pl-0">
							<div class="col-12 text-secondary font-size-10 pl-0">Comment</div>
							<div class="row pr-5 pl-0 mt-5">
								<div class="col-3 font-size-10 pt-15 pl-15 text-center">Primary</div>
								<div class="col-9 pl-10">
									<textarea class="form-control font-size-10 pt-3 pr-3 pl-3 pb-3" id="kpi-team-primary-comment-<?= $kpiTeamWeightId ?>" style="height: 50px;"><?= $kpiTeam["primaryComment"] ?></textarea>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-3 pt-30">
					<div class="row">
						<div class="col-3  font-size-12">Ratio</div>
						<div class="col-9  pr-0 pl-10">
							<div class="row">
								<div class="col-1 pr-0 pl-0 number-circle2">
									<span style="margin-top: -1px;position:absolute;margin-left:-3px;">1</span>
								</div>
								<div class="col-2 step-line"></div>
								<div class="col-1 pr-0 pl-0 number-circle-achived">
									<span style="margin-top: -1px;position:absolute;margin-left:-3px;">2</span>
								</div>
								<div class="col-2  step-line"></div>
								<div class="col-1  pr-0 pl-0 number-circle2">
									<span style="margin-top: -1px;position:absolute;margin-left:-3px;">3</span>
								</div>
								<div class="col-2  step-line"></div>
								<div class="col-1 pr-0 pl-0 number-circle2">
									<span style="margin-top: -1px;position:absolute;margin-left:-3px;">4</span>
								</div>
							</div>
							<div class="row" style="margin-left: -15px;width:230px;">
								<div class="pr-0 pl-5 font-size-10" style="width:25%;">
									<?= number_format($kpiTeamWeight[$kpiTeamWeightId]["level1"]) ?> - <?= number_format($kpiTeamWeight[$kpiTeamWeightId]["level1End"]) ?>
								</div>
								<div class="pr-0 pl-0 font-size-10" style="width:25%;">
									<?= number_format($kpiTeamWeight[$kpiTeamWeightId]["level2"]) ?> - <?= number_format($kpiTeamWeight[$kpiTeamWeightId]["level2End"]) ?>
								</div>
								<div class="pr-0 pl-0 font-size-10" style="width:25%;">
									<?= number_format($kpiTeamWeight[$kpiTeamWeightId]["level3"]) ?> - <?= number_format($kpiTeamWeight[$kpiTeamWeightId]["level3End"]) ?>
								</div>
								<div class="pr-0 pl-0 font-size-10" style="width:25%;">
									<?= number_format($kpiTeamWeight[$kpiTeamWeightId]["level4"]) ?> - <?= number_format($kpiTeamWeight[$kpiTeamWeightId]["level4End"]) ?>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-1  pr-0 pl-0">
					<div class="col-12 font-size-12 text-center text-secondary pl-10">
						Achived Score
					</div>
					<div class="col-12 font-size-12 text-center font-weight-500 font-b mt-10" data-bs-toggle="modal" data-bs-target="#kpi-team-evaluator-score" style="cursor: pointer;" onclick="javascript:prepareKpiTeamEvaluate(<?= $kpiTeam['kpiId'] ?>,<?= $kpiTeamWeightId ?>)">
						<i class="fa fa-trophy mr-5" aria-hidden="true"></i>
						<span class="font-size-16 font-b" id="kpi-team-everage-score-<?= $kpiTeamWeightId ?>"><?= $kpiTeam['point'] ?></span>
					</div>
				</div>
				<div class="col-1 pr-0 pl-0">
					<div id="progress1" data-bs-toggle="modal" data-bs-target="#kpi-view-team" onclick="javascript:kpiTeamHistoryEva(<?= $kpiTeam['kpiTeamId'] ?>)" style="cursor: pointer;">
						<div data-num="0" id="totalPercent" class="progress-item1 " data-value="<?= number_format($kpiTeam['ratio']) ?>%" style="background: conic-gradient(rgb(41, 140, 233) calc(<?= $kpiTeam['ratio'] ?>%), rgb(219, 239, 247) 0deg);width: 50px;height:50px;">
						</div>
					</div>
					<div class="col-12 font-size-10 text-center text-secondary  mt-10">
						Achived Score
					</div>
					<div class="col-12 text-center">
						<a href="javascript:saveKpiTeamResult(<?= $kpiTeamWeightId ?>)" class="btn btn-primary font-size-12 pt-0 pb-0">save</a>
					</div>
				</div>
			</div>
		</div>
	<?php
	endforeach;
}
if (isset($masterKpiEmployee) && count($masterKpiEmployee) > 0) { ?>
	<div class="col-12 font-weight-500 font-size-14 mt-10">Individual KPI</div>
	<?php
	foreach ($masterKpiEmployee as $kpiWeightId => $kpiEmployee) :
	?>
		<div class="col-12 bg-white pl-5 pr-5 mt-10 pb-10" style="border-radius: 5px;min-height:100px;">
			<span class="font-size-12 text-secondary ">
				Weight <span class="font-b"><?= $kpiEmployee["weight"] ?> %</span>
			</span>
			<div class="row" style="margin-top: -10px;">
				<div class="col-2 pt-15">
					<span class="badge bg-primary" style="font-size: 8px;">PL</span>
					<span class="font-size-12 font-weight-500 mt-5 ml-10" style="position:absolute;">
						<?= $kpiEmployee["kpiName"] ?>
					</span>
				</div>
				<div class="col-1">
					<div class="col-12 font-size-12 text-center text-secondary">
						Target
					</div>
					<div class="col-12 font-size-12 text-center font-weight-500 font-b mt-5">
						<?= number_format($kpiEmployee["target"]) ?>
					</div>
					<div class="col-12 font-size-12 text-center text-secondary">
						Result
					</div>
					<div class="col-12 font-size-12 mt-5">
						<input type="text" class="form-control font-size-12 pr-3 pl-3 pt-0 pb-0 text-end" id="kpi-employee-result-<?= $kpiWeightId ?>" value="<?= $kpiEmployee['result'] ?>">
					</div>
				</div>
				<div class="col-4">
					<div class="row">
						<div class="col-6  pr-0 pl-0">
							<div class="col-12 text-secondary font-size-10 pl-0">Comment</div>
							<div class="row pr-5 pl-0 mt-5">
								<div class="col-3 font-size-10 text-center pt-15">Mid</div>
								<div class="col-9 ">
									<textarea class="form-control font-size-10 pt-3 pr-3 pl-3 pb-3" id="kpi-employee-mid-comment-<?= $kpiWeightId ?>" style="height: 50px;"><?= $kpiEmployee['midComment'] ?></textarea>
								</div>
							</div>
						</div>
						<div class="col-6  pr-0 pl-0">
							<div class="col-12 text-secondary font-size-10 pl-0">Comment</div>
							<div class="row pr-5 pl-0 mt-5">
								<div class="col-3 font-size-10 pt-15 pl-15 text-center">Primary</div>
								<div class="col-9 pl-10">
									<textarea class="form-control font-size-10 pt-3 pr-3 pl-3 pb-3" id="kpi-employee-primary-comment-<?= $kpiWeightId ?>" style="height: 50px;"><?= $kpiEmployee['primaryComment'] ?></textarea>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-3 pt-30">
					<div class="row">
						<div class="col-3  font-size-12">Ratio</div>
						<div class="col-9  pr-0 pl-10">
							<div class="row">
								<div class="col-1 pr-0 pl-0 number-circle2">
									<span style="margin-top: -1px;position:absolute;margin-left:-3px;">1</span>
								</div>
								<div class="col-2 step-line"></div>
								<div class="col-1 pr-0 pl-0 number-circle-achived">
									<span style="margin-top: -1px;position:absolute;margin-left:-3px;">2</span>
								</div>
								<div class="col-2  step-line"></div>
								<div class="col-1  pr-0 pl-0 number-circle2">
									<span style="margin-top: -1px;position:absolute;margin-left:-3px;">3</span>
								</div>
								<div class="col-2  step-line"></div>
								<div class="col-1 pr-0 pl-0 number-circle2">
									<span style="margin-top: -1px;position:absolute;margin-left:-3px;">4</span>
								</div>
							</div>
							<div class="row" style="margin-left: -15px;width:230px;">
								<div class="pr-0 pl-5 font-size-10" style="width:25%;">
									<?= number_format($kpiEmployeeWeight[$kpiWeightId]["level1"]) ?> - <?= number_format($kpiEmployeeWeight[$kpiWeightId]["level1End"]) ?>
								</div>
								<div class="pr-0 pl-0 font-size-10" style="width:25%;">
									<?= number_format($kpiEmployeeWeight[$kpiWeightId]["level2"]) ?> - <?= number_format($kpiEmployeeWeight[$kpiWeightId]["level2End"]) ?>
								</div>
								<div class="pr-0 pl-0 font-size-10" style="width:25%;">
									<?= number_format($kpiEmployeeWeight[$kpiWeightId]["level3"]) ?> - <?= number_format($kpiEmployeeWeight[$kpiWeightId]["level3End"]) ?>
								</div>
								<div class="pr-0 pl-0 font-size-10" style="width:25%;">
									<?= number_format($kpiEmployeeWeight[$kpiWeightId]["level4"]) ?> - <?= number_format($kpiEmployeeWeight[$kpiWeightId]["level4End"]) ?>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-1  pr-0 pl-0">
					<div class="col-12 font-size-12 text-center text-secondary pl-10">
						Achived Score
					</div>
					<div class="col-12 font-size-12 text-center font-weight-500 font-b mt-10" data-bs-toggle="modal" data-bs-target="#kpi-employee-evaluator-score" style="cursor: pointer;" onclick="javascript:prepareKpiEmployeeEvaluate(<?= $kpiEmployee['kpiId'] ?>,<?= $kpiWeightId ?>)">
						<i class="fa fa-trophy mr-5" aria-hidden="true"></i>
						<span class="font-size-16 font-b" id="kpi-employee-everage-score-<?= $kpiWeightId ?>"><?= $kpiEmployee['point'] ?></span>
					</div>
				</div>
				<div class="col-1 pr-0 pl-0">
					<a href="<?= Yii::$app->homeUrl ?>kpi/kpi-personal/view-personal-kpi/<?= ModelMaster::encodeParams(['kpiEmployeeId' => $kpiEmployee['kpiEmployeeId']]) ?>" target="_blank" class="no-underline-black ">
						<div id="progress1">
							<div data-num="0" id="totalPercent" class="progress-item1 " data-value="<?= number_format($kpiEmployee['ratio']) ?>%" style="background: conic-gradient(rgb(41, 140, 233) calc(<?= $kpiEmployee['ratio'] ?>%), rgb(219, 239, 247) 0deg);width: 50px;height:50px;">
							</div>
						</div>
						<div class="col-12 font-size-10 text-center text-secondary  mt-10">
							Achived Score
						</div>
						<div class="col-12 text-center">
							<a href="javascript:saveKpiEmployeeResult(<?= $kpiWeightId ?>)" class="btn btn-primary font-size-12 pt-0 pb-0">save</a>
						</div>
					</a>
				</div>


			</div>
		</div>
	<?php
	endforeach;
}
if (count($masterKpiTeam) == 0 && count($masterKpiEmployee) == 0) {
	?>
	<div class="col-12 text-center font-size-14 pt-20"> There are no item to evaluate.</div>
<?php
}
?>
<?= $this->render('kpi_team_detail') ?>
<?= $this->render('evaluator_score_kpi_employee') ?>
<?= $this->render('evaluator_score_kpi_team') ?>