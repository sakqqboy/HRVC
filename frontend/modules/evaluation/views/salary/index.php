<?php

use common\models\ModelMaster;
use frontend\models\hrvc\Company;
use frontend\models\hrvc\Department;

$this->title = 'Salary Setting';
?>
<div class="col-12 mt-70 alert-updated pt-10 pr-10 pl-10">
	<div class="row">
		<div class="col-6 updated_registersalary">
			Salary Setting
			<a href="<?= Yii::$app->homeUrl ?>evaluation/salary/create-salary" class="badge bg-primary pt-5 pb-5 ml-10 pr-20 pl-20 no-underline">
				<i class="fa fa-usd" aria-hidden="true"></i>&nbsp; Create Salary
			</a>
			<a href="<?= Yii::$app->homeUrl ?>evaluation/salary/allowance" class="badge bg-warning text-dark pt-5 pb-5 ml-10 pr-20 pl-20 no-underline">
				<i class="fa fa-plus" aria-hidden="true"></i>&nbsp; Create Allowance
			</a>
		</div>
		<div class="col-6">
			<div class="row">
				<div class="col-4">
					<select class="form-select  font-size-12 pt-3 pb-3" onchange="javascript:companyDepartment()" id="company">

						<?php
						if (isset($companyId) && $companyId != '') {
						?>
							<option value="<?= $companyId ?>"><?= $companyName ?></option>
						<?php
						}
						?>
						<option value="">Company</option>
						<?php

						if (isset($companies) && count($companies) > 0) {
							foreach ($companies as $company) : ?>
								<option value="<?= $company['companyId'] ?>">
									<?= $company['companyName'] ?>
								</option>
						<?php
							endforeach;
						}
						?>
					</select>
				</div>
				<div class=" col-4">
					<select class="form-select font-size-12 pt-3 pb-3" id="department" onchange="javascript:departmentTitle()">
						<?php
						if (isset($departmentId) && $departmentId != '') {
						?>
							<option value="<?= $departmentId ?>"><?= $departmentName ?></option>
						<?php
						}
						?>
						<option value="">Department</option>
						<?php
						if (isset($departments) && count($departments) > 0) {
							foreach ($departments as $department) : ?>
								<option value="<?= $department['departmentId'] ?>">
									<?= $department['departmentName'] ?>
								</option>
						<?php
							endforeach;
						}
						?>
					</select>
				</div>
				<div class="col-4">
					<div class="input-group">
						<select class="form-select font-size-12 pt-3 pb-3" id="title" name="title">
							<?php
							if (isset($titleId) && $titleId != '') {
							?>
								<option value="<?= $titleId ?>"><?= $titleName ?></option>
							<?php
							}
							?>
							<option value="">Title</option>
							<?php
							if (isset($titles) && count($titles) > 0) {
								foreach ($titles as $title) : ?>
									<option value="<?= $title['titleId'] ?>">
										<?= $title['titleName'] ?>
									</option>
							<?php
								endforeach;
							}
							?>
						</select>
						<span class="input-group-text pt-3 pb-3" style="cursor: pointer;" onclick="javascript:filterSalary()">

							<i class="fa fa-filter" aria-hidden="true"></i>
						</span>
					</div>
				</div>
			</div>
		</div>
		<div class="col-12">
			<div class="col-12 card pl-10 pr-10 pt-10 border-0 font-size-12 mt-10 mb-10">
				<?php
				if (isset($salaries) && count($salaries) > 0) {
					foreach ($salaries as $companyId => $departmentSalary) : ?>
						<div class="col-12 font-weight-500 font-size-12">
							<?= Company::companyName($companyId) ?>
						</div>
						<div class="col-12 mt-5">
							<table class="table">
								<thead>
									<tr class="frame-table-header">
										<th style="border-top-left-radius:5px;border-bottom-left-radius:5px;">No</th>
										<th> Title</th>
										<th> Allowances & Default Value</th>
										<th class="text-center" style="border-top-right-radius:5px;border-bottom-right-radius:5px;"> ACTION </th>
									</tr>
								</thead>
								<tbody>
									<?php
									if (isset($departmentSalary) && count($departmentSalary) > 0) {
										foreach ($departmentSalary as $departmentId => $titleSalary) :
									?>
											<tr style="height: 10px;">
											</tr>
											<tr style="background-color:#EEE9E9;">
												<td colspan="4" class="font-size-12 font-weight-500 pt-5 pb-5">
													<?= Department::departmentNAme($departmentId) ?>
												</td>
											</tr>
											<?php
											if (isset($titleSalary) && count($titleSalary) > 0) {
												$i = 1;
												foreach ($titleSalary as $titleId => $salary) :
											?>
													<tr id="title-salary-<?= $salary['salaryId'] ?>">
														<td><?= $i ?>.</td>
														<td><?= $salary["titleName"] ?></td>
														<td>
															<?php
															$total = 0;
															if (isset($salary["salaryAllowances"]) && count($salary["salaryAllowances"]) > 0) {
																$j = 1;
																foreach ($salary["salaryAllowances"] as $salaryStructureId => $allowance) : ?>
																	<div class="col-12 border-bottom">
																		<div class="row">
																			<div class="col-7 font-size-12">
																				<?= $j . '.&nbsp;' . $allowance["structureName"] ?>
																			</div>
																			<div class="col-5 text-end font-size-11">
																				<?= number_format($allowance["defaultValue"], 2) ?>&nbsp;
																			</div>
																		</div>

																	</div>
															<?php
																	$total += $allowance["defaultValue"];
																	$j++;
																endforeach;
															}
															?>
														</td>
														<td style="width:25%;">
															<div class="row">
																<div class="col-6 font-size-12 font-b  text-end ">TOTAL</div>
																<div class="col-6  font-size-14 font-b text-end"><?= number_format($total, 2) ?> <?= $salary['currency']["code"] ?></div>
																<div class="col-12  mt-3 text-end pt-10">
																	<a href="<?= Yii::$app->homeUrl ?>evaluation/salary/update-company-salary/<?= ModelMaster::encodeParams(['salaryId' => $salary['salaryId']]) ?>" class="btn btn-warning font-size-12 pr-8 pl-8 pt-4 pb-4 mr-10">
																		<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
																	</a>
																	<a href="javascript:deleteCompanySalary(<?= $salary['salaryId'] ?>)" class="btn btn-danger font-size-12 pr-8 pl-8 pt-4 pb-4">
																		<i class="fa fa-trash-o" aria-hidden="true"></i>
																	</a>
																</div>
															</div>
														</td>
													</tr>
									<?php
													$i++;
												endforeach;
											}
										endforeach;
									}
									?>

								</tbody>
							</table>
						</div>
				<?php
					endforeach;
				}
				?>
			</div>
		</div>
	</div>
</div>