<div class="modal fade" id="salaryRegistration" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="row pl-20 pr-20 pt-20">
				<div class="col-1">
					<div class="modal-title" id="exampleModalLabel">
						<img src="<?= Yii::$app->homeUrl ?><?= $company['picture'] ?>" class="logo_regis">
					</div>
				</div>
				<div class="col-7">
					<div class="col-12 font-size-15 font-b">
						<?= $company["companyName"] ?>
					</div>
					<div class="col-12 font-size-12 pt-5">
						<img src="<?= Yii::$app->homeUrl ?><?= $company['flag'] ?>" class="Log_name"> <?= $company["city"] ?>, <?= $company["countryName"] ?>
					</div>
				</div>
				<div class="col-4 text-end">
					<div class="col-12">
						<button type="button" class="btn-close font-size-10" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="col-12 font-size-16 font-weight-500">
						Salary Registration
					</div>
				</div>
				<hr>
			</div>
			<div class="modal-body pt-0">
				<div class="row">
					<div class="col-lg-4">
						<div class="col-12">
							<img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Team-1.png" style="width: 16px;margin-top: -5px;"> Select Participant
						</div>
						<div class="col-12">
							<div class="card pl-10 pr-10 pb-10 mt-10">
								<div class="col-12 font-size-14 font-weight-500">
									<?php

									use frontend\models\hrvc\Title;

									if (isset($department["departmentName"])) {
									?>
										<?= $department["departmentName"] ?>
									<?php
									}
									?>
								</div>
								<div class="col-12 pr-0 pl-0" style="overflow-y: auto;height:500px;">
									<?php
									if (isset($employees) && count($employees) > 0) {
										foreach ($employees as $titleId => $employeeTitle) :
									?>
											<div class="col-12 pt-10">

												<img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Rank-1.png" class="select_ranky">
												<span class="font-b font-size-13">
													<?= Title::titleName($titleId) ?>
												</span>
											</div>
											<?php
											if (isset($employeeTitle) && count($employeeTitle) > 0) {
												foreach ($employeeTitle as $employeeId => $employee) :
											?>
													<div class="col-12 font-size-11 pt-5 pb-5" id="select-employee-<?= $employeeId ?>" style="cursor: pointer;" onclick="javascript:employeeAllowance(<?= $employeeId ?>)">

														<!-- <input class="form-check-input" type="checkbox" onclick="javascript:employeeAllowace(<?php // $employeeId 
																											?>)" value="<?php // $employeeId 
																													?>" id="employee-<?php // $employeeId 
																																?>"> -->

														<img src="<?= Yii::$app->homeUrl ?><?= $employee['picture'] ?>" class="Log_name">
														<?= $employee["firstName"] ?> <?= $employee["sureName"] ?>

														<i class="fa fa-check float-end text-success" id="check-<?= $employeeId ?>" aria-hidden="true" style="display:<?= $employee['setSalary'] == 0 ? 'none' : '' ?>"></i>

													</div>
									<?php
												endforeach;
											}
										endforeach;
									}
									?>
								</div>
							</div>
						</div>
						<input type="hidden" id="currentSelect" value="">
					</div>
					<div class="col-lg-8">
						<div class="row">
							<div class="col-6">
								Salary Breakdown
							</div>
							<div class="col-6 text-end font-size-14 font-weight-500" id="employeeName"></div>
						</div>
						<div class="card" style="background-color: #F4F6F9;">
							<div class="row ">
								<div class="col-2 pr-0 ">
									<label for="inputBasePay" class="font-size-12">Basic Salary <span class="text-danger font-b">*</span></label>
								</div>
								<div class="col-6">
									<input type="text" class="form-control pt-4 pb-4 font-size-12 text-end" id="allowance-1" style="border-radius: 3px;">
								</div>
								<div class="col-4 alert-box2 text-center">
									Saved
								</div>
							</div>
							<hr>
							<div class="row pb-10">
								<?php
								if (isset($allowances) && count($allowances) > 0) {
									foreach ($allowances as $allowance) :
								?>
										<div class="col-2 mb-10">
											<label for="input" class="col-form-label font-size-11"><?= $allowance["structureName"] ?></label>
										</div>
										<div class="col-sm-4 mb-10">
											<input type="text" class="form-control pt-4 pb-4 font-size-12 text-end" id="allowance-<?= $allowance["structureId"] ?>" style="border-radius: 3px;" name="allowance[]">
										</div>
									<?php
									endforeach;
								} else {
									?>
									<div class="col-12 text-center pt-10">Please set up the allowances</div>
								<?php
								}
								?>
							</div>
						</div>
						<div class="col-12 text-end pt-10 pb-10">
							<input type="hidden" id="employeeId" value="" name="employeeId">

							<button type="button" class="btn btn-outline-danger pt-5 pb-5 font-size-13 pr-30 pl-30" style="border-radius: 3px;" data-bs-dismiss="modal">Cancel</button>

							<a href="javascript:saveEmployeeSalary()" class="btn btn-primary pt-5 pb-5 font-size-13 pr-30 pl-30" style="border-radius: 3px;display:none;" id="create-button">Create</a>
							<a href="javascript:saveEmployeeSalary()" class="btn btn-warning pt-5 pb-5 font-size-13 pr-30 pl-30" style="border-radius: 3px;display:none;" id="update-button">Update</a>
						</div>
						<div class="col-12 text-center text-danger mt-10" id="not-set">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>