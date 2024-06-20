<?php

use Faker\Core\Number;

$this->title = "Eva";
?>
<div class="row mt-60 pr-0 pl-0">
	<div class="col-12  environment pt-10 pb-10">
		<div class="col-12 bg-white pl-20 pr-20" style="border-radius: 5px;">
			<div class="row">
				<div class="col-lg-3 col-6 pt-3 pb-3">
					<div class="row">
						<div class="col-4 pl-0">
							<img src="<?= Yii::$app->homeUrl ?><?= $employee['picture'] ?>" class="individualImage">
						</div>
						<div class="col-8 border-right pl-0 pr-5">
							<div class="col-12 pl-0 pr-0 font-weight-500 font-size-14">
								<?= $employee["employeeFirstname"] ?> <?= $employee["employeeSurename"] ?>
							</div>
							<div class="col-12 font-size-12 mt-15">
								<?= $employee["companyName"] ?>
							</div>
							<div class="col-12 font-size-10 mt-5">
								<img src="<?= Yii::$app->homeUrl ?>images/flag/thailand.png" class="imageEvaluatorcountry">
								<span class="mt-2 ml-5" style="position:absolute;">
									<?= $employee["city"] ?>, <?= $employee["countryName"] ?>
								</span>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-6  pt-3 pb-3">
					<div class="col-12 border-right pr-10" style="height: 80.516px;">
						<div class="col-12 pl-0 pr-0  font-size-13 border-bottom pb-5">
							<b class="text-primary mr-5"><?= $terms["termName"] ?></b> <?= $frameName ?>
						</div>
						<div class="col-12 pl-0 pr-0 mt-15">
							<div class="row">
								<div class="col-2 font-size-12 text-center">
									start
								</div>
								<?php

								if (isset($allTerms) && count($allTerms) > 0) {
									$i = 0;
									$line = 1;
									$current = 0;
									$next = 0;
									$lineStyle = "step-line-term";
									if (count($allTerms) == 4) {
										$line = 1;
									}
									if (count($allTerms) == 3) {
										$line = 2;
									}
									if (count($allTerms) == 1) {
										$line = 3;
									}
									if (count($allTerms) == 2) {
										$line = 5;
									}
									foreach ($allTerms as $at) :
										if ($at["status"] == 4) {
											$circle = "term-circle-pass";
										}
										if ($current == 1) {
											$next = 1;
										}
										if ($at["status"] == 1) {
											$circle = "term-circle-running";
											$current = 1;
											$lineStyle = "step-line-term-next";
										}
										if (count($allTerms) == 1) {
								?>
											<div class="col-<?= $line ?> step-line-term"></div>
										<?php
										}
										?>
										<div class="col-1 pr-0 pl-0 pt-1 <?= $next == 1 ? 'term-circle-next' : $circle ?>">
											<?= $at["termName"] ?></span>
										</div>
										<?php
										if ($i < count($allTerms) - 1 || count($allTerms) == 1) {
										?>
											<div class="col-<?= $line ?> <?= $lineStyle ?>"></div>
										<?php
										}
										?>
								<?php
										$i++;
									endforeach;
								}
								?>
								<div class="col-2 font-size-12 pr-0 pl-0 text-center">
									Finish
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-6  pt-3 pb-3 ">
					<div class="row">
						<div class="col-6">
							<div class="col-12 text-center pb-4 border-bottom font-size-13">
								Mid
							</div>
							<div class="col-12 pl-10 font-size-12 mt-5">
								<i class="fa fa-circle text-success mr-5" aria-hidden="true"></i> 1st Approval
							</div>
							<div class="col-12 pl-10 font-size-12 mt-5">
								<i class="fa fa-circle text-warning mr-5" aria-hidden="true"></i>
								2rd Approval
							</div>
						</div>
						<div class="col-6 border-right" style="height: 80.516px;">
							<div class="col-12 text-center pb-4 border-bottom font-size-13">
								Primary
							</div>
							<div class="col-12 pl-10 font-size-12 mt-5">
								<i class="fa fa-circle text-info mr-5" aria-hidden="true"></i> Waiting
							</div>
							<div class="col-12 pl-10 font-size-12 mt-5">
								<i class="fa fa-circle text-info mr-5" aria-hidden="true"></i> Waiting
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-6  pt-3 pb-3 ">
					<div class="row">
						<div class="col-6">
							<div class="col-12 text-center font-size-12 font-weight-500">
								Primary Evaluator
							</div>
						</div>
						<div class="col-6">
							<div class="col-12 text-center font-size-12 font-weight-500">
								Final Evaluator
							</div>

						</div>
						<div class="input-group mt-5">
							<span class="input-group-text group-btnprimary">1st</span>
							<span class="form-control group-controltext">
								<div class="row">
									<div class="col-md-6">
										<div class="row">
											<div class="col-1">
												<img src="<?= Yii::$app->homeUrl ?><?= $evaluator['primaryPic'] ?>" class="images2">
											</div>
											<div class="col-8 pl-5 pr-0">
												<span class="nameimages2">
													<div class="Directorfontsmall1"><?= $evaluator["primaryName"] == "" ? 'Not set' : $evaluator["primaryName"] ?></div>
													<div class="Directorfontsmall1"><?= $evaluator["primaryTitle"] ?>, <?= $evaluator["primaryBranch"] ?></div>
												</span>
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="row">
											<div class="col-7">
												<span class="nameimages2">
													<div class="Directorfontsmall2"> <?= $evaluator["finalName"] == "" ? 'Not set' : $evaluator["finalName"] ?></div>
													<div class="Directorfontsmall2"> <?= $evaluator["finalTitle"] ?>, <?= $evaluator["finalBranch"] ?></div>
												</span>
											</div>
											<div class="col-1 pr-10 pl-10">
												<img src="<?= Yii::$app->homeUrl ?><?= $evaluator['finalPic'] ?>" class="images3">
											</div>
										</div>
									</div>
								</div>
							</span>
							<span class="input-group-text group-btnprimary">2nd</span>
						</div>
					</div>
					<div class="col-12 mt-5">
						<span class="badge badge-pill badge-light border font-size-10" style="float: right;">
							<span class="text-danger">Deadline</span>
							<span class="text-dark">: <?= $terms["endDate"] ?></span>
						</span>
					</div>
				</div>
			</div>
		</div>
		<div class="col-12 bg-white pl-20 pr-20 mt-10 pb-10" style="border-radius: 5px;">
			<div class="row">
				<div class="col-4">
					<div class="col-12">
						<span class="font-b font-size-12 mr-15">
							Submit Progress
						</span>
						<span class=" font-size-12 mr-5"><i class="fa fa-check-circle text-success mr-5" aria-hidden="true"></i>1 of 4 steps completed</span>
					</div>
					<div class="col-12 pt-0">
						<div class="row pt-0">
							<div class="col-2 text-center pt-5 pb-5 pr-0 pl-0">
								<a href="javascript:evaluationType('kfi',<?= $employeeTermWeight['kfiWeight'] ?>,<?= count($employeeTermKfi) ?>)" class="btn btn-primary pt-0 pb-0 pr-15 pl-15 font-size-12 font-b">KFI</a>
							</div>
							<div class="col-1 pb-5 pr-0 pl-0 pt-8 text-center">
								<i class="fa fa-long-arrow-right" aria-hidden="true"></i>
							</div>
							<div class="col-2 text-center pt-5 pb-5 pb-5 pr-0 pl-0">
								<a href="javascript:evaluationType('kgi',<?= $employeeTermWeight['kgiWeight'] ?>,<?= $totalKgi ?>)" class="btn btn-light pt-0 pb-0 pr-15 pl-15 font-size-12 text-primary font-b">KGI</a>
							</div>
							<div class="col-1 pb-5 pr-0 pl-0 pt-8 text-center">
								<i class="fa fa-long-arrow-right" aria-hidden="true"></i>
							</div>
							<div class="col-2 text-center pr-0 pl-0 pt-5 pb-5">
								<a href="javascript:evaluationType('kpi',<?= $employeeTermWeight['kpiWeight'] ?>,<?= $totalKpi ?>)" class="btn btn-light pt-0 pb-0 pr-15 pl-15 font-size-12 text-primary font-b">KPI</a>
							</div>
							<div class="col-1 text-center pr-0 pl-0 pt-8">
								<i class="fa fa-long-arrow-right" aria-hidden="true"></i>
							</div>
							<div class="col-2 text-center pr-0 pl-0 pt-5 pb-5">
								<a class="btn btn-light pt-0 pb-0 pr-15 pl-15 font-size-12 text-primary font-b">Submit</a>
							</div>
							<div class="col-12 pl-7 pr-20" style="height: 10px;">
								<div class="progress" style="height:5px !important;">
									<div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:20%;height:5px !important;">
										<span class="sr-only"></span>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-4 text-center pt-25">
					<span class="badge bg-secondary border font-size-14 pt-10 pb-10 pl-20 pr-20" id="eva-type">KFI <?= $employeeTermWeight["kfiWeight"] ?>%</span>
				</div>
				<div class="col-4 pt-25">
					<div class="row">
						<div class="col-6 text-center font-weight-500 text-secondary font-size-14">
							Total Item<span class="badge bg-info border font-size-14 pt-7 pb-7 pl-7 pr-7 ml-5" id="total-item"><?= count($employeeTermKfi) ?></span>
						</div>
						<div class="col-6 text-end">
							<a href="<?= Yii::$app->homeUrl ?>home/dashboard" class="btn btn-primary text-light font-size-13">
								<i class="fa fa-angle-left mr-5" aria-hidden="true"></i> DASHBOARD
							</a>
						</div>
					</div>
				</div>
			</div>
			<div class="row pt-10" id="kfi-eva">
				<div class="col-12 environment pl-10 pr-10 pb-10 mb-10" style="min-height: 200px;">
					<?= $this->render('kfi', [
						"employeeTermKfi" => $employeeTermKfi,
						"kfiWeight" => $kfiWeight
					]) ?>
				</div>

			</div>
			<div class="row pt-10" style="display:none;" id="kgi-eva">
				<div class="col-12 environment pl-10 pr-10 pb-10 mb-10" style="min-height: 200px;">
					<?= $this->render('kgi', [
						"masterKgiTeam" => $masterKgiTeam,
						"masterKgiEmployee" => $masterKgiEmployee,
						"kgiTeamWeight" => $kgiTeamWeight,
						"kgiEmployeeWeight" => $kgiEmployeeWeight,
					]) ?>
				</div>
			</div>
			<div class="row pt-10" style="display:none;" id="kpi-eva">
				<div class="col-12 environment pl-10 pr-10 pb-10 mb-10" style="min-height: 200px;">
					<?= $this->render('kpi', [
						"masterKpiTeam" => $masterKpiTeam,
						"masterKpiEmployee" => $masterKpiEmployee,
						"kpiTeamWeight" => $kpiTeamWeight,
						"kpiEmployeeWeight" => $kpiEmployeeWeight
					]) ?>
				</div>
			</div>
		</div>

	</div>
</div>
<?= $this->render('evaluator_score') ?>