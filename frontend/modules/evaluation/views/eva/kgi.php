<?php

use common\models\ModelMaster;

if (isset($masterKgiTeam) && count($masterKgiTeam) > 0) { ?>
	<div class="col-12 font-weight-500 font-size-14 mt-10">KGI Team</div>
	<?php
	//throw new Exception(print_r($kgiTeamWeight, true));
	foreach ($masterKgiTeam as $kgiWeightId => $kgiTeam) :
		//throw new Exception(print_r($kgiTeam, true));
	?>
		<div class="col-12 bg-white pl-5 pr-5 mt-10 pb-10" style="border-radius: 5px;min-height:100px;">
			<span class="font-size-12 text-secondary ">
				Weight <span class="font-b"><?= $kgiTeam["weight"] ?> %</span>
			</span>
			<div class="row" style="margin-top: -10px;">
				<div class="col-2 pt-15">
					<span class="badge bg-primary" style="font-size: 8px;">PL</span>
					<span class="font-size-12 font-weight-500 mt-5 ml-10" style="position:absolute;">
						<?= $kgiTeam["kgiName"] ?>
					</span>
				</div>
				<div class="col-1">
					<div class="col-12 font-size-12 text-center text-secondary">
						Target
					</div>
					<div class="col-12 font-size-12 text-center font-weight-500 font-b mt-5">
						<?= number_format($kgiTeam["target"]) ?>
					</div>
					<div class="col-12 font-size-12 text-center text-secondary">
						Result
					</div>
					<div class="col-12 font-size-12 mt-5">
						<input type="text" class="form-control font-size-12 pr-3 pl-3 pt-0 pb-0 text-end" id="kgi-team-result-<?= $kgiWeightId ?>" value="<?= $kgiTeam['result'] ?>">
					</div>
				</div>
				<div class="col-4">
					<div class="row">
						<div class="col-6  pr-0 pl-0">
							<div class="col-12 text-secondary font-size-10 pl-0">Comment</div>
							<div class="row pr-5 pl-0 mt-5">
								<div class="col-3 font-size-10 text-center pt-15">Mid</div>
								<div class="col-9 ">
									<textarea class="form-control font-size-10 pt-3 pr-3 pl-3 pb-3" id="kgi-team-mid-comment-<?= $kgiWeightId ?>" style="height: 50px;"><?= $kgiTeam['midComment'] ?></textarea>
								</div>
							</div>
						</div>
						<div class="col-6  pr-0 pl-0">
							<div class="col-12 text-secondary font-size-10 pl-0">Comment</div>
							<div class="row pr-5 pl-0 mt-5">
								<div class="col-3 font-size-10 pt-15 pl-15 text-center">Primary</div>
								<div class="col-9 pl-10">
									<textarea class="form-control font-size-10 pt-3 pr-3 pl-3 pb-3" id="kgi-team-primary-comment-<?= $kgiWeightId ?>" style="height: 50px;"><?= $kgiTeam['primaryComment'] ?></textarea>
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
									<?= number_format($kgiTeamWeight[$kgiWeightId]["level1"]) ?> - <?= number_format($kgiTeamWeight[$kgiWeightId]["level1End"]) ?>
								</div>
								<div class="pr-0 pl-0 font-size-10" style="width:25%;">
									<?= number_format($kgiTeamWeight[$kgiWeightId]["level2"]) ?> - <?= number_format($kgiTeamWeight[$kgiWeightId]["level2End"]) ?>
								</div>
								<div class="pr-0 pl-0 font-size-10" style="width:25%;">
									<?= number_format($kgiTeamWeight[$kgiWeightId]["level3"]) ?> - <?= number_format($kgiTeamWeight[$kgiWeightId]["level3End"]) ?>
								</div>
								<div class="pr-0 pl-0 font-size-10" style="width:25%;">
									<?= number_format($kgiTeamWeight[$kgiWeightId]["level4"]) ?> - <?= number_format($kgiTeamWeight[$kgiWeightId]["level4End"]) ?>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-1  pr-0 pl-0">
					<div class="col-12 font-size-12 text-center text-secondary pl-10">
						Achived Score
					</div>
					<div class="col-12 font-size-12 text-center font-weight-500 font-b mt-10" data-bs-toggle="modal" data-bs-target="#kgi-team-evaluator-score" style="cursor: pointer;" onclick="javascript:prepareKgiTeamEvaluate(<?= $kgiTeam['kgiId'] ?>,<?= $kgiWeightId ?>)">
						<i class="fa fa-trophy mr-5" aria-hidden="true"></i>
						<span class="font-size-16 font-b" id="kgi-team-everage-score-<?= $kgiWeightId ?>"><?= $kgiTeam['point'] ?></span>
					</div>
				</div>
				<div class="col-1 pr-0 pl-0">
					<div id="progress1" data-bs-toggle="modal" data-bs-target="#kgi-view-team" onclick="javascript:kgiTeamHistory(<?= $kgiWeightId ?>)" style="cursor: pointer;">
						<div data-num="0" id="totalPercent" class="progress-item1 " data-value="<?= $kgiTeam['ratio'] ?>%" style="background: conic-gradient(rgb(41, 140, 233) calc(<?= $kgiTeam['ratio'] ?>%), rgb(219, 239, 247) 0deg);width: 50px;height:50px;">
						</div>
					</div>
					<div class="col-12 font-size-10 text-center text-secondary  mt-10">
						Achived Score
					</div>
					<div class="col-12 text-center">
						<a href="javascript:saveKgiTeamResult(<?= $kgiWeightId ?>)" class="btn btn-primary font-size-12 pt-0 pb-0">save</a>
					</div>
				</div>


			</div>
		</div>
	<?php
	endforeach;
}
if (isset($masterKgiEmployee) && count($masterKgiEmployee) > 0) { ?>
	<div class="col-12 font-weight-500 font-size-14 mt-10">Individual KGI</div>
	<?php
	foreach ($masterKgiEmployee as $kgiEmployeeId => $kgiEmployee) :
	?>
		<div class="col-12 bg-white pl-5 pr-5 mt-10 pb-10" style="border-radius: 5px;min-height:100px;">
			<span class="font-size-12 text-secondary ">
				Weight <span class="font-b"><?= $kgiEmployee["weight"] ?> %</span>
			</span>
			<div class="row" style="margin-top: -10px;">
				<div class="col-2 pt-15">
					<span class="badge bg-primary" style="font-size: 8px;">PL</span>
					<span class="font-size-12 font-weight-500 mt-5 ml-10" style="position:absolute;">
						<?= $kgiEmployee["kgiName"] ?>
					</span>
				</div>
				<div class="col-1">
					<div class="col-12 font-size-12 text-center text-secondary">
						Target
					</div>
					<div class="col-12 font-size-12 text-center font-weight-500 mt-5 border-bottom pb-5">
						<?= number_format($kgiEmployee["target"]) ?>
					</div>
					<div class="col-12 font-size-12 text-center text-secondary">
						Result
					</div>
					<div class="col-12 font-size-12 mt-5">
						<input type="text" class="form-control font-size-12 pr-3 pl-3 pt-0 pb-0 text-end" id="kgi-employee-result-<?= $kgiEmployee['kgiEmployeeWeightId'] ?>" value="<?= $kgiEmployee["result"] ?>">
					</div>
				</div>
				<div class="col-4">
					<div class="row">
						<div class="col-6  pr-0 pl-0">
							<div class="col-12 text-secondary font-size-10 pl-0">Comment</div>
							<div class="row pr-5 pl-0 mt-5">
								<div class="col-3 font-size-10 text-center pt-15">Mid</div>
								<div class="col-9 ">
									<textarea class="form-control font-size-10 pt-3 pr-3 pl-3 pb-3" id="kgi-employee-mid-comment-<?= $kgiEmployee['kgiEmployeeWeightId'] ?>" style="height: 50px;"><?= $kgiEmployee["midComment"] ?></textarea>
								</div>
							</div>
						</div>
						<div class="col-6  pr-0 pl-0">
							<div class="col-12 text-secondary font-size-10 pl-0">Comment</div>
							<div class="row pr-5 pl-0 mt-5">
								<div class="col-3 font-size-10 pt-15 pl-15 text-center">Primary</div>
								<div class="col-9 pl-10">
									<textarea class="form-control font-size-10 pt-3 pr-3 pl-3 pb-3" id="kgi-employee-primary-comment-<?= $kgiEmployee['kgiEmployeeWeightId'] ?>" style="height: 50px;"><?= $kgiEmployee["primaryComment"] ?></textarea>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-3 pt-30">
					<div class="row">
						<div class="col-3 font-size-12">Ratio</div>
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
									<?= number_format($kgiEmployeeWeight[$kgiEmployeeId]["level1"]) ?> - <?= number_format($kgiEmployeeWeight[$kgiEmployeeId]["level1End"]) ?>
								</div>
								<div class="pr-0 pl-0 font-size-10" style="width:25%;">
									<?= number_format($kgiEmployeeWeight[$kgiEmployeeId]["level2"]) ?> - <?= number_format($kgiEmployeeWeight[$kgiEmployeeId]["level2End"]) ?>
								</div>
								<div class="pr-0 pl-0 font-size-10" style="width:25%;">
									<?= number_format($kgiEmployeeWeight[$kgiEmployeeId]["level3"]) ?> - <?= number_format($kgiEmployeeWeight[$kgiEmployeeId]["level3End"]) ?>
								</div>
								<div class="pr-0 pl-0 font-size-10" style="width:25%;">
									<?= number_format($kgiEmployeeWeight[$kgiEmployeeId]["level4"]) ?> - <?= number_format($kgiEmployeeWeight[$kgiEmployeeId]["level4End"]) ?>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-1  pr-0 pl-0">
					<div class="col-12 font-size-12 text-center text-secondary pl-10">
						Achived Score
					</div>
					<div class="col-12 font-size-12 text-center font-weight-500 font-b mt-10" data-bs-toggle="modal" data-bs-target="#kgi-employee-evaluator-score" style="cursor: pointer;" onclick="javascript:prepareKgiEmployeeEvaluate(<?= $kgiEmployee['kgiId'] ?>,<?= $kgiEmployee['kgiEmployeeWeightId'] ?>)">
						<i class="fa fa-trophy mr-5" aria-hidden="true"></i>
						<span class="font-size-16 font-b" id="kgi-employee-everage-score-<?= $kgiEmployee['kgiEmployeeWeightId'] ?>"><?= $kgiEmployee['point'] ?></span>
					</div>
				</div>
				<div class="col-1 pr-0 pl-0">
					<a href="<?= Yii::$app->homeUrl ?>kgi/kgi-personal/view-personal-kgi/<?= ModelMaster::encodeParams(['kgiEmployeeId' => $kgiEmployeeId]) ?>" target="_blank" class="no-underline-black ">
						<div id="progress1">
							<div data-num="0" id="totalPercent" class="progress-item1 " data-value="<?= $kgiEmployee['ratio'] ?>%" style="background: conic-gradient(rgb(41, 140, 233) calc(<?= $kgiEmployee['ratio'] ?>%), rgb(219, 239, 247) 0deg);width: 50px;height:50px;">
							</div>
						</div>
					</a>
					<div class="col-12 font-size-10 text-center text-secondary  mt-10">
						Achived Score
					</div>
					<div class="col-12 text-center">
						<a href="javascript:saveKgiEmployeeResult(<?= $kgiEmployee['kgiEmployeeWeightId'] ?>)" class="btn btn-primary font-size-12 pt-0 pb-0">save</a>
					</div>
				</div>


			</div>
		</div>
	<?php
	endforeach;
}
if (count($masterKgiTeam) == 0 && count($masterKgiEmployee) == 0) {
	?>
	<div class="col-12 text-center font-size-14 pt-20"> There are no item to evaluate.</div>
<?php
}
?>
<?= $this->render('kgi_team_detail') ?>
<?= $this->render('kgi_employee_detail') ?>
<?= $this->render('evaluator_score_kgi_employee') ?>
<?= $this->render('evaluator_score_kgi_team') ?>