<?php

use common\models\ModelMaster;
use yii\bootstrap5\ActiveForm;

$this->title = 'Rank & Increasement';
?>
<div class="col-4 alert-box2 text-center mt-40">
	Saved
</div>
<div class="col-12 mt-70 environment pt-10 pr-10 pl-20">
	<div class="row">
		<div class="col-2 pr-0 pl-5">
			<?= $this->render('menu_left', [
				"terms" => $terms,
				"environmentDetail" => $environmentDetail,
				"frameName" => $frameName,
				"termId" => $termId
			]) ?>
		</div>
		<div class="col-lg-10 col-md-6 col-12 environment">
			<div class="bg-white pmi_bakgru">
				<div class="col-12">
					<div class="row">
						<div class="col-3 FrameEvaluation">
							Rank & Increasement
						</div>
						<div class="col-lg-3 pl-0">
							<a href="<?= Yii::$app->homeUrl ?>designfront/add-rank" class="no-underline text-dark">
								<img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Create(Small).png" class="Createsmall"><span class="adRank"> ADD RANK</span>
							</a>
						</div>

					</div>
				</div>
				<div class="col-12 mt-20 pr-0">
					<table class="table table-borderless table-striped">
						<thead class="font-size-10">
							<th class="increasement-rank" style="width: 7%;">Rank</th>
							<th class="increasement-rank" style="width: 15%;">Score</th>
							<th class="increasement-rank" style="width: 20%;">evaluation score </th>
							<th class="increasement-rank" style="width: 7%;">Increment</th>
							<th class="increasement-rank" style="width: 7%;">bonus</th>
							<th class="increasement-rank" style="width: 5%;">Action</th>
						</thead>
						<tbody>
							<?php
							$form = ActiveForm::begin([
								'id' => 'create-rank',
								'method' => 'post',
								'options' => [
									'enctype' => 'multipart/form-data',
								],
								'action' => Yii::$app->homeUrl . 'evaluation/rank/save-rank'
							]); ?>
							<tr>
								<td class=" border-right">
									<input type="text" class="form-control font-size-12 pr-5 pl-5 text-center" name="rankName" id="rank-name" placeholder="RANK">
								</td>
								<td class=" border-right">
									<div class="row">
										<div class="col-5  pr-0 pl-10">
											<input type="text" class="form-control font-size-12 text-end" id="min" name="min" placeholder="Min">
										</div>
										<div class="col-2 font-b text-center pr-0 pl-0">
											-
										</div>
										<div class="col-5  pr-10 pl-0">
											<input type="text" class="form-control font-size-12 text-end" id="max" name="max" placeholder="Max">
										</div>
									</div>
								</td>
								<td class="border-right">
									<!-- <div class="col-12">
										<div class="progress" style="height: 10px;width:180px;">
											<div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
										</div>
									</div> -->
								</td>
								<td class="border-right">
									<div class="col-12">
										<input type="text" class="form-control font-size-12 text-center" id="increment" name="increasement" placeholder="INCREMENT">
									</div>
								</td>
								<td class="border-right">
									<div class="col-12">
										<input type="text" class="form-control font-size-12 text-center" id="bonus" name="bonus" placeholder="BONUS">
									</div>
								</td>
								<td class="text-center">
									<a href="javascript:checkRankIncreasement()" class="btn btn-primary font-size-12 pt-5 pb-5"> Save</a>
								</td>
								<input type="hidden" name="termId" id="termId" value="<?= $termId ?>">
							</tr>
							<?php ActiveForm::end(); ?>
							<tr style="height: 3px !important;">
								<td colspan="6">
							</tr>
							<?php
							// $rank = 'A';
							// $start = 0;
							// $end = 10;
							if (isset($ranks) && count($ranks) > 0) {
								foreach ($ranks as $rankId => $rank) :
									//for ($i = 1; $i <= 10; $i++) {
							?>
									<tr id="rank-<?= $rankId ?>">
										<td class="border-right">
											<div class="col-12 letter">
												<?= $rank["rankName"] ?>
											</div>
										</td>
										<td class="border-right">
											<div class="col-12 text-center font-size-12">
												<?= number_format($rank["min"], 2) ?> - <?= number_format($rank["max"], 1) ?>
											</div>
										</td>
										<td class="border-right">
											<div class="progressRank">

											</div>
											<div class="row" style="margin-top: -15px;">
												<?php
												$percent = $rank["min"] + 10;
												if ($percent >= 100) {
													$percent = 100;
												}
												?>
												<div class="barent" style="width:<?= $rank["min"] + 3 ?>%">
													<span class="percent"></span>
												</div>
												<div class="rank-box pr-3 pl-3 border">
												</div>
												<div class="badge badge-percent pt-2 text-center pr-0 pl-0"><?= $rank["rankName"] ?></div>
											</div>
										</td>
										<td class="border-right">
											<div class="col-12 text-center">
												<?= number_format($rank["increasement"], 1) ?>
											</div>
										</td>
										<td class="border-right">
											<div class="col-12  text-center">
												<?= number_format($rank["bonus"] ?? 0, 1) ?>
											</div>
										</td>
										<td class="text-center">
											<a href="javascript:deleteTermRank(<?= $rankId ?>)" style="cursor: pointer;">
												<img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/deletered.png" class="DeleteRound">
											</a>
										</td>
									</tr>

							<?php
								endforeach;
							}
							?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>