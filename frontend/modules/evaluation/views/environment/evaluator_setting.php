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
							<?php
							if (isset($pimEmployee) && count($pimEmployee) > 0) {
								$i = 1;
								foreach ($pimEmployee as $emId => $em) :
									if ($i <= 3) {
							?>
										<li class="tri-li"> <img src="<?= Yii::$app->homeUrl ?><?= $em['picture'] ?>" class="image-avatar<?= $i ?>"></li>
							<?php
									} else {
										break;
									}
									$i++;
								endforeach;
							}
							?>

							<a href="" class="none">
								<li class="tri-li-number1"> <?= count($pimEmployee) ?> </li>
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
								<td class="text-center" style="width:17%;"> KFI</td>
								<td class="text-center" style="width:17%;"> KGI</td>
								<td class="text-center" style="width:17%;"> KPI</td>
								<td class="text-center">
									<div class="row ">
										<div class="col-6 text-start">1<sup>st</sup> EVALUATOR</div>
										<div class="col-6 text-End pr-0">2<sup>rd</sup> EVALUATOR</div>
									</div>
								</td>
								<td class="text-center" style="border-top-right-radius:3px;"> </td>
							</tr>
						</thead>
						<tbody>
							<?php
							if (isset($employeePim) && count($employeePim) > 0) {
								foreach ($employeePim as $employeeId => $em) :
							?>
									<tr>
										<td>
											<div class="col-12 pr-0 pl-3 crdEmployeeslight1 pt-3 pb-5">
												<img src="<?= Yii::$app->homeUrl ?><?= $em['picture'] ?>" class="images1"> <span class="nameimages1"> <?= $em['firstName'] ?> <?= $em["sureName"] ?></span>
											</div>
										</td>
										<td>
											<div class="card crdEmployeeslight2">
												<div class="row">
													<div class="col-8 text-center pr-0 pl-10" style="border-right:#2580D3 solid thin;">
														<img src="<?= Yii::$app->homeUrl ?>images/icons/Light/Light/48px/SelectFromCheckboxs-3.png" class="check-circle-Employees1">
														<label class="form-check-label LabelEmployees" for="defaultCheck1"><?= $em["countAssignedKFI"] ?> Assigned &nbsp;</label>
													</div>
													<div class="col-3 pl-5 pr-5">
														<div id="">
															<div data-num="<?= $em['ratioKFI'] ?>" id="data-total-percent" class="progress-item1" data-value="<?= $em['ratioKFI'] ?>%" style="background: conic-gradient(rgb(41, 140, 233) calc(<?= $em['ratioKFI'] ?>%), rgb(219, 239, 247) 0deg);">
																<span id="totalPercent"><?= $em['ratioKFI'] ?>%</span>
															</div>
														</div>
													</div>
												</div>
											</div>
										</td>
										<td>
											<div class="card crdEmployeeslight3">
												<div class="row">
													<div class="col-8 text-center pr-0 pl-10" style="border-right: #FDCA40 solid thin;">
														<img src="<?= Yii::$app->homeUrl ?>images/icons/Light/Light/48px/SelectFromCheckboxs-3.png" class="check-circle-Employees2">
														<label class="form-check-label LabelEmployees2" for=""><?= $em["countAssignedKGI"] ?> Assigned &nbsp;</label>
													</div>
													<div class="col-3 pl-5 pr-5">

														<div id="">
															<div data-num="<?= $em['ratioKFI'] ?>" id="data-total-percent2" class="progress-item2" data-value2="<?= number_format($em['ratioKGI']) ?>%" style="background: conic-gradient(rgb(233,183,41) calc(<?= number_format($em['ratioKGI']) ?>%), rgb(247,245,219) 0deg);animation: .4s ease-out reverse;">
																<span id="totalPercent"><?= number_format($em['ratioKGI']) ?>%</span>
															</div>
														</div>
													</div>
												</div>
											</div>
										</td>
										<td>
											<div class="card crdEmployeeslight4">
												<div class="row">
													<div class="col-8 text-center pr-0 pl-10" style="border-right: #FF6939 solid thin;">
														<img src="<?= Yii::$app->homeUrl ?>images/icons/Light/Light/48px/SelectFromCheckboxs-3.png" class="check-circle-Employees3">
														<label class="form-check-label LabelEmployees3" for="defaultCheck2"><?= $em["countAssignedKPI"] ?> Assigned &nbsp;</label>
													</div>
													<div class="col-3 pl-5 pr-5">

														<div id="">
															<div data-num="<?= $em['ratioKPI'] ?>" id="data-total-percent2" class="progress-item3" data-value3="<?= number_format($em['ratioKPI']) ?>%" style="background: conic-gradient(rgb(239,39,58) calc(<?= number_format($em['ratioKPI']) ?>%), rgb(253,239,242) 0deg);animation: .4s ease-out reverse;">
																<span id="totalPercent"><?= number_format($em['ratioKPI']) ?>%</span>
															</div>
														</div>
													</div>
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
																<div class="col-8 pl-5 pr-0">
																	<span class="nameimages2">
																		<div class="Directorfontsmall1" id="primary-<?= $employeeId ?>"><?= $em["primaryName"] ?></div>
																		<div class="Directorfontsmall1" id="primary-title-<?= $employeeId ?>"><?= $em["primaryTitle"] ?><?= $em["primaryTitle"] == '' ? '' : ', ' . $em["primaryBranch"] ?></div>
																	</span>
																</div>
															</div>
														</div>
														<div class="col-md-6">
															<div class="row">
																<div class="col-7">
																	<span class="nameimages2">
																		<div class="Directorfontsmall2" id="final-<?= $employeeId ?>"><?= $em["finalName"] ?></div>
																		<div class="Directorfontsmall2" id="final-title-<?= $employeeId ?>"><?= $em["finalTitle"] ?><?= $em["finalTitle"] == '' ? '' : ', ' . $em["finalBranch"] ?></div>
																	</span>
																</div>
																<div class="col-1 pr-10 pl-10">
																	<img src="<?= Yii::$app->homeUrl ?>image/thai.jpg" class="images3">
																</div>
															</div>
														</div>
													</div>
												</span>
												<span class="input-group-text group-btnprimary">2nd</span>
											</div>
										</td>
										<td>
											<img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Assign.png" class="imagesAssingLight mt-13" style="cursor:pointer;" onclick="javascript:setEvaluator(<?= $employeeId ?>)">
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
<?= $this->render('modal_evaluator', [
	"companies" => $companies,
	"employees" => $employees,
	"termId" => $termId
]) ?>