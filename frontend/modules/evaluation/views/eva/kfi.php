<div class="col-12 font-weight-500 font-size-14 mt-10">KFI</div>
<?php
if (isset($employeeTermKfi) && count($employeeTermKfi) > 0) {
	foreach ($employeeTermKfi as $kfiId => $kfi) :
?>
		<div class="col-12 bg-white pl-5 pr-5 mt-10 pb-10" style="border-radius: 5px;min-height:100px;">
			<span class="font-size-12 text-secondary ">
				Weight <span class="font-b"><?= $kfi["weight"] ?> %</span>
			</span>
			<div class="row" style="margin-top: -10px;">
				<div class="col-2 pt-15">
					<span class="badge bg-primary" style="font-size: 8px;">PL</span>
					<span class="font-size-12 font-weight-500 mt-5 ml-10" style="position:absolute;">
						<?= $kfi["kfiName"] ?>
					</span>
				</div>
				<div class="col-1">
					<div class="col-12 font-size-12 text-center text-secondary">
						Target
					</div>
					<div class="col-12 font-size-12 text-center font-weight-500 mt-5 border-bottom pb-5">
						<?= number_format($kfi["target"]) ?>
					</div>
					<div class="col-12 font-size-12 text-center text-secondary">
						Result
					</div>
					<div class="col-12 font-size-12 mt-5">
						<input type="text" class="form-control font-size-12 pr-3 pl-3 pt-0 pb-0 text-end" id="kfi-result-<?= $kfi['kfiWeightId'] ?>" value="<?= $kfi['result'] ?>">
					</div>
				</div>
				<div class="col-4">
					<div class="row">
						<div class="col-6  pr-0 pl-0">
							<div class="col-12 text-secondary font-size-10 pl-0">Comment</div>
							<div class="row pr-5 pl-0 mt-5">
								<div class="col-3 font-size-10 text-center pt-15">Mid</div>
								<div class="col-9 ">
									<textarea class="form-control font-size-10 pt-3 pr-3 pl-3 pb-3" id="kfi-mid-comment-<?= $kfi['kfiWeightId'] ?>" style="height: 50px;"><?= $kfi['midComment'] ?></textarea>
								</div>
							</div>
						</div>
						<div class=" col-6 pr-0 pl-0">
							<div class="col-12 text-secondary font-size-10 pl-0">Comment</div>
							<div class="row pr-5 pl-0 mt-5">
								<div class="col-3 font-size-10 pt-15 pl-15 text-center">Final</div>
								<div class="col-9 pl-10">
									<textarea class="form-control font-size-10 pt-3 pr-3 pl-3 pb-3" id="kfi-primary-comment-<?= $kfi['kfiWeightId'] ?>" style=" height: 50px;"><?= $kfi['primaryComment'] ?></textarea>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-3 pt-30">
					<div class="row">
						<div class="col-2  font-size-12">Ratio</div>
						<div class="col-10  pr-0 pl-10">
							<div class="row">
								<div class="col-1 pr-0 pl-0 number-circle2">
									<span style="margin-top: -1px;position:absolute;margin-left:-3px;">1</span>
								</div>
								<div class="col-1 step-line">
								</div>
								<div class="col-1 pr-0 pl-0 number-circle-achived">
									<span style="margin-top: -1px;position:absolute;margin-left:-3px;">2</span>
								</div>
								<div class="col-1  step-line">
								</div>
								<div class="col-1  pr-0 pl-0 number-circle2">
									<span style="margin-top: -1px;position:absolute;margin-left:-3px;">3</span>
								</div>
								<div class="col-1  step-line">
								</div>
								<div class="col-1 pr-0 pl-0 number-circle2">
									<span style="margin-top: -1px;position:absolute;margin-left:-3px;">4</span>
								</div>
								<div class="col-1  step-line">
								</div>
								<div class="col-1 pr-0 pl-0 number-circle2">
									<span style="margin-top: -1px;position:absolute;margin-left:-3px;">5</span>
								</div>
								<div class="col-1  step-line">
								</div>
								<div class="col-1 pr-0 pl-0 number-circle2">
									<span style="margin-top: -1px;position:absolute;margin-left:-3px;">6</span>
								</div>
							</div>
							<div class="row" style="margin-left: -15px;width:260px;">
								<div class="pr-0 pl-0 font-size-10" style="width:16.6%;">
									<?= number_format($kfiWeight[$kfiId]["level1"]) ?> - <?= number_format($kfiWeight[$kfiId]["level1End"]) ?>
								</div>
								<div class="pr-0 pl-0 font-size-10" style="width:16.6%;">
									<?= number_format($kfiWeight[$kfiId]["level2"]) ?> - <?= number_format($kfiWeight[$kfiId]["level2End"]) ?>
								</div>
								<div class="pr-0 pl-0 font-size-10" style="width:16.6%;">
									<?= number_format($kfiWeight[$kfiId]["level3"]) ?> - <?= number_format($kfiWeight[$kfiId]["level3End"]) ?>
								</div>
								<div class="pr-0 pl-0 font-size-10" style="width:16.6%;">
									<?= number_format($kfiWeight[$kfiId]["level4"]) ?> - <?= number_format($kfiWeight[$kfiId]["level4End"]) ?>
								</div>
								<div class="pr-0 pl-0 font-size-10" style="width:16.6%;">
									<?= number_format($kfiWeight[$kfiId]["level5"]) ?> - <?= number_format($kfiWeight[$kfiId]["level5End"]) ?>
								</div>
								<div class="pr-0 pl-0 font-size-10 text-center" style="width:16.6%;">
									<?= number_format($kfiWeight[$kfiId]["level6"]) ?> - <?= number_format($kfiWeight[$kfiId]["level6End"]) ?>
								</div>
							</div>
						</div>

					</div>
				</div>
				<div class="col-1  pr-0 pl-0">
					<div class="col-12 font-size-12 text-center text-secondary pl-10">
						Achived Score
					</div>
					<div class="col-12 font-size-12 text-center font-weight-500 font-b mt-10" data-bs-toggle="modal" data-bs-target="#evaluator-score" style="cursor: pointer;" onclick="javascript:prepareKfiEvaluate(<?= $kfiId ?>,<?= $kfi['kfiWeightId'] ?>)">
						<i class="fa fa-trophy mr-5" aria-hidden="true"></i>
						<span class="font-size-16 font-b" id="everage-score-<?= $kfi['kfiWeightId'] ?>"><?= $kfi['point'] ?></span>
					</div>
				</div>
				<div class="col-1 pr-0 pl-0">
					<div id="progress1" data-bs-toggle="modal" data-bs-target="#staticBackdrop3" onclick="javascript:kfiHistory(<?= $kfiId ?>)" style="cursor: pointer;">
						<div data-num="0" id="totalPercent" class="progress-item1 " data-value="<?= $kfi['ratio'] ?>%" style="background: conic-gradient(rgb(41, 140, 233) calc(<?= $kfi['ratio'] ?>%), rgb(219, 239, 247) 0deg);width: 50px;height:50px;">
						</div>
					</div>
					<div class="col-12 font-size-10 text-center text-secondary  mt-10">
						Achived Score
					</div>
					<div class="col-12 text-center">
						<a href="javascript:saveKfiResult(<?= $kfi['kfiWeightId'] ?>)" class="btn btn-primary font-size-12 pt-0 pb-0">save</a>
					</div>
				</div>
			</div>
		</div>
	<?php
	endforeach;
} else {
	?>
	<div class="col-12 text-center font-size-14"> There are no item to evaluate.</div>
<?php
}
?>
<?= $this->render('kfi_detail') ?>
<?= $this->render('modal_kgi') ?>