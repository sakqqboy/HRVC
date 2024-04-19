<?php
$this->title = 'Term Detail';
?>
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
				<div class="row">
					<div class="col-3">
						<div class="FrameEvaluation"> Evaluator Settings</div>
					</div>
					<div class="col-2 text-Participating text-center pt-8">
						Participating Employees
					</div>
					<div class="col-1 pl-0 pt-5">
						<span class="badge rounded-pill bg-gray">
							<li class="tri-li"> <img src="/HRVC/frontend/web/image/avatar1.png" class="image-avatar1"></li>
							<li class="tri-li"> <img src="/HRVC/frontend/web/image/Watanabe.png" class="image-avatar2"></li>
							<li class="tri-li"> <img src="/HRVC/frontend/web/image/avatar3.png" class="image-avatar3"></li>
							<a href="" class="none">
								<li class="tri-li-number1"> 5 </li>
							</a>
						</span>
					</div>
					<div class="col-2 text-end pl-0 pr-0 font-size-12 pt-8">
						<img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Team-1.png" class="imagessettingsTerm1"> Employees
					</div>
					<div class="col-3 pr-0 pl-0 pr-0 text-end">

						<input class="search-input" type="text" placeholder="Search">
						<i class="fa fa-search search-btn" aria-hidden="true"></i>
					</div>
					<div class="col-1 text-end">
						<img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/FilterPlus.png" class="imagessettingsFillerPlus ">
					</div>
				</div>
				<div class="col-12 mt-15">
					<table class="table">
						<thead>
							<tr class="frame-table-header thead-evaluator">
								<td class="text-start" style="border-top-left-radius:3px;">EMPLOYEES</td>
								<td class="text-center"> KEY FINANCIAL INDICATOR</td>
								<td class="text-center"> KEY GROUP INDICATOR</td>
								<td class="text-center"> KEY PERFORMANCE INDICATOR</td>
								<td class="text-center">
									<div class="row">
										<div class="col-6 text-start">PRIMARY EVALUATOR</div>
										<div class="col-6 text-End">FINAL EVALUATOR</div>
									</div>
								</td>
								<td class="text-center" style="border-top-right-radius:3px;"> </td>
							</tr>
						</thead>
						<tbody>
							<?php
							if (isset($employeePim) && count($employeePim) > 0) {
								foreach ($employeePim as $em) :
							?>
									<tr>
										<td>
											<div class="col-12 pr-0 pl-3 crdEmployeeslight1 pt-3 pb-5">
												<img src="<?= Yii::$app->homeUrl ?><?= $em['picture'] ?>" class="images1"> <span class="nameimages1"> <?= $em['firstName'] ?> <?= $em["sureName"] ?></span>
											</div>
										</td>
										<td>
											<div class="card crdEmployeeslight2">
												<div class="text-group">
													<img src="<?= Yii::$app->homeUrl ?>images/icons/Light/Light/48px/SelectFromCheckboxs-3.png" class="check-circle-Employees1">
													<!-- <input class="form-check-input form-check-input-checkEmployees1" type="checkbox" value="InputEmployees" id=""> -->
													<label class="form-check-label LabelEmployees" for="defaultCheck1">6 Assigned &nbsp;</label>
													<span>
														<div role="progressbarprimary" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="--value:20"></div>
													</span>
												</div>
											</div>
										</td>
										<td>
											<div class="card crdEmployeeslight3">
												<div class="text-group">
													<img src="<?= Yii::$app->homeUrl ?>images/icons/Light/Light/48px/SelectFromCheckboxs-3.png" class="check-circle-Employees2">
													<!-- <input class="form-check-input form-check-input-checkEmployees2" type="checkbox" value="InputEmployees2" id=""> -->
													<label class="form-check-label LabelEmployees2" for="defaultCheck2">2 Assigned &nbsp;</label>
													<span>
														<div role="progressbaryellow" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="--value:80"></div>
													</span>
												</div>
											</div>
										</td>
										<td>
											<div class="card crdEmployeeslight4">
												<div class="text-group">
													<img src="<?= Yii::$app->homeUrl ?>images/icons/Light/Light/48px/SelectFromCheckboxs-3.png" class="check-circle-Employees3">
													<!-- <input class="form-check-input form-check-input-checkEmployees3" type="checkbox" value="InputEmployees3" id=""> -->
													<label class="form-check-label LabelEmployees3" for="defaultCheck2">12 Assigned &nbsp;</label>
													<span>
														<div role="progressbarred" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="--value:40"></div>
													</span>
												</div>
											</div>
										</td>
										<td>
											<div class="input-group mb-3">
												<span class="input-group-text group-btnprimary">1st</span>
												<span class="form-control group-controltext">
													<div class="row">
														<div class="col-md-6">
															<div class="row">
																<div class="col-1">
																	<img src="<?= Yii::$app->homeUrl ?>image/thai.jpg" class="images2">
																</div>
																<div class="col-5">
																	<span class="nameimages2">
																		<div class="Directorfontsmall1"> Guru</div>
																		<div class="Directorfontsmall1"> Director</div>
																	</span>
																</div>
															</div>
														</div>
														<div class="col-md-6">
															<div class="row">
																<div class="col-5">
																	<span class="nameimages2">
																		<div class="Directorfontsmall2"> Vikrant</div>
																		<div class="Directorfontsmall2"> Title</div>
																	</span>
																</div>
																<div class="col-1">
																	<img src="<?= Yii::$app->homeUrl ?>image/thai.jpg" class="images3">
																</div>
															</div>
														</div>
													</div>
												</span>
												<span class="input-group-text group-btnprimary">2nd</span>
											</div>
										</td>
										<td><img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Assign.png" class="imagesAssingLight mt-13"></td>
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