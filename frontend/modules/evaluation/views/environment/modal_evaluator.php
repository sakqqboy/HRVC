<div class="modal fade" id="evaluator-setting" tabindex="-1" aria-labelledby="exampleModalLabelAssign" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="countheader">
				<div class="row pl-10 pr-10 pt-10">
					<div class="col-1" id="exampleModalLabelAssign">
						<img src="<?= Yii::$app->homeUrl ?>image/groupProfile.jpg" class="Profiles">
					</div>
					<div class="col-9 pl-20">
						<div class="font-size-13 font-b"><span id='employeeFirstname'></span> <span id='employeeSurename'></span> </div>
						<div class="font-size-12"> <span id="employeeTitle"></span>, <span id="employeeBranch"></span></div>
					</div>
					<div class="col-2 text-end font-size-13 pr-20 pt-10">
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<hr class="mt-10">
				</div>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-lg-6 col-md-6 col-12">
						<div class="col-12 font-size-13 font-b" style="margin-top: -25px;">
							Primary Evaluator
						</div>
						<div class="col-9 pl-30">
							<select class="form-select selectDefaultPrimary" aria-label="Default select example" onclick="javascript:branchCompany()" id="company-team">
								<option selected value="">Select this</option>
								<?php
								if (isset($companies) && count($companies) > 0) {
									foreach ($companies as $company) : ?>
										<option value="<?= $company['companyId'] ?>"><?= $company["companyName"] ?></option>
								<?php
									endforeach;
								}
								?>
							</select>
						</div>
						<div class="col-7 pl-30">
							<select class="form-select selectDefaultPrimary" aria-label="Default select example" id="branch-team">
								<option selected value="">Branch</option>
							</select>
						</div>
						<div class="col-12 card cardPrimaryEvaluator">
							<?php
							if (isset($employees) && count($employees) > 0) {
								foreach ($employees as $departmentName => $employee) :
							?>
									<div class="col-12 mt-5 pl-0">
										<div class="form-check pl-0">

											<label class="form-check-label" for="flexCheckDefault">
												<img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/24px/Department.png" class="DepartmentAccounts"> <?= $departmentName ?>
											</label>
										</div>
									</div>
									<div class="col-12">
										<?php
										if (isset($employee) && count($employee) > 0) {
											foreach ($employee as $employeeId => $em) :
										?>
												<div class="form-check evaluatorIT">
													<input class="form-check-input" type="radio" value="<?= $employeeId ?>" id="primary-eva-<?= $employeeId ?>" name="primary[]">
													<label class="form-check-label" for="primary-<?= $employeeId ?>">
														<img src="<?= Yii::$app->homeUrl ?><?= $em['picture'] ?>" class="imageDepartmentIT"> <?= $em["firstName"] ?> <?= $em["sureName"] ?>
													</label>
												</div>
										<?php
											endforeach;
										}
										?>
									</div>
							<?php
								endforeach;
							}
							?>

						</div>
					</div>
					<div class="col-lg-6 col-md-6 col-12">
						<div class="col-12 font-size-13 font-b" style="margin-top: -25px;">
							Final Evaluator
						</div>
						<div class="col-7 ml-30">
							<select class="form-select selectDefaultPrimary" aria-label="Default select example" onclick="javascript:branchCompany2()" id="company-team2">
								<option selected value="">Select this</option>
								<?php
								if (isset($companies) && count($companies) > 0) {
									foreach ($companies as $company) : ?>
										<option value="<?= $company['companyId'] ?>"><?= $company["companyName"] ?></option>
								<?php
									endforeach;
								}
								?>
							</select>
						</div>
						<div class="col-4 ml-30">
							<select class="form-select selectDefaultPrimary" aria-label="Default select example" id="branch-team2">
								<option selected value="">Branch</option>
							</select>
						</div>
						<div class="col-12 card cardPrimaryEvaluator">
							<?php
							if (isset($employees) && count($employees) > 0) {
								foreach ($employees as $departmentName => $employee) :
							?>
									<div class="col-12 mt-5 pl-0">
										<div class="form-check pl-0">
											<label class="form-check-label" for="">
												<img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/24px/Department.png" class="DepartmentAccounts"> <?= $departmentName ?>
											</label>
										</div>
									</div>
									<div class="col-12">
										<?php
										if (isset($employee) && count($employee) > 0) {
											foreach ($employee as $employeeId => $em) :
										?>
												<div class="form-check evaluatorIT">
													<input class="form-check-input" type="radio" value="<?= $employeeId ?>" id="final-eva-<?= $employeeId ?>" name="final[]">
													<label class="form-check-label" for="final-eva-<?= $employeeId ?>">
														<img src="<?= Yii::$app->homeUrl ?><?= $em['picture'] ?>" class="imageDepartmentIT"> <?= $em["firstName"] ?> <?= $em["sureName"] ?>
													</label>
												</div>
										<?php
											endforeach;
										}
										?>
									</div>
							<?php
								endforeach;
							}
							?>
						</div>
					</div>
				</div>
			</div>
			<div class="col-12 text-end pb-10 pr-15">
				<div type="submit" class="btn btn-primary SET" onclick="javascript:saveEvaluator()">SET</div>
				<input type="hidden" id="evaluateeId" value="">
				<input type="hidden" id="termId" value="<?= $termId ?>">
			</div>
		</div>
	</div>
</div>