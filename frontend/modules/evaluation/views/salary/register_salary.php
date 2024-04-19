<?php

use frontend\models\hrvc\Department;
use frontend\models\hrvc\Title;

$this->title = 'Salary Registeration';
?>
<div class="col-12 mt-70 alert-updated pt-10 pr-10 pl-10">
	<div class="row">
		<div class="col-5">
			<div class="row">
				<div class="col-12 updated_registersalary">
					Salary Registeration
					<button type="button" class="ADD-register pt-3 pb-3 ml-10 pr-20 pl-20" data-bs-toggle="modal" data-bs-target="#salaryRegistration">
						<img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/register-add.png" class="picregister-add">&nbsp; Add
					</button>
				</div>
			</div>
		</div>
		<div class="col-7">
			<div class="row">
				<div class="col-3  text-center">
					<div class="col-12 updated_evaluationQ">
						Evaluation Q4
					</div>
				</div>
				<div class="col-3  text-center">
					<span class="badge import_updated pt-10 pb-10 pr-15 pl-15">
						<img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/updatedownload.png" class="pic_updateddownload1"> Import
					</span>
				</div>
				<div class="col-3">
					<select class="form-select slec_updated" aria-label="Default select example" id="department" onchange="javascript:departmentTitle()">
						<?php
						if (isset($departmentId) && $departmentId !== '') {
						?>
							<option value="<?= $departmentId ?>"><?= Department::departmentNAme($departmentId) ?></option>
						<?php
						}
						?>
						<option value="">Department</option>
						<?php
						if (isset($departments) && count($departments) > 0) {
							foreach ($departments as $dep) :
						?>
								<option value="<?= $dep['departmentId'] ?>"><?= $dep['departmentName'] ?></option>
						<?php
							endforeach;
						}
						?>
					</select>
				</div>
				<div class="col-2 pr-0 pl-0">
					<select class="form-select slec_updated" aria-label="Default select example" id="title">
						<?php
						if (isset($titleId) && $titleId !== '') {
						?>
							<option value="<?= $titleId ?>"><?= Title::titleName($titleId) ?></option>
						<?php
						}
						?>
						<option value="">Title</option>
						<?php
						if (isset($titles) && count($titles) > 0) {
							foreach ($titles as $t) :
						?>
								<option value="<?= $t['titleId'] ?>"><?= $t['titleName'] ?></option>
						<?php
							endforeach;
						}
						?>
					</select>
				</div>
				<!-- <div class="col-2">
					<select class="form-select slec_updated" aria-label="Default select example">
						<option selected value="">Currency</option>
						<option value="1">Human Resource</option>
						<option value="2">Junior</option>
						<option value="3">Staff</option>
					</select>
				</div> -->
				<div class="col-1 text-center pt-3">
					<img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/24px/FilterPlus.png" class="Dark_filterupdated" onclick="javascript:filterSalaryRegister()" style="cursor: pointer;">
				</div>
			</div>
		</div>
	</div>
	<?php
	if (isset($department) && !empty($department)) {
		$departmentId = $department["departmentId"];
	} else {
		$departmentId = '';
	}

	if (isset($title) && !empty($title)) {
		$titleId = $title["departmentId"];
	} else {
		$titleId = '';
	}
	?>
	<input type="hidden" id="departmentId" value="<?= $departmentId ?>" value="<?= $departmentId ?>">
	<input type="hidden" id="titleId" value="<?= $titleId ?>" value="<?= $titleId ?>">
	<div class="col-12 environment  background_updateline pt-15 pr-10 pl-10">
		<div class="col-12 environment pr-10 pl-10 pb-10 ">
			<div class="row">
				<div class="col-lg-2 col-md-6 col-6">
					<div class="col-12 card pl-10 pr-10 pt-10 border-0">
						<div class="update_humanresource">
							<?= $departmentId != '' ? $department["departmentName"] : 'not set' ?>
						</div>
						<div class="Assiociate_updated">
							<?= $titleId != '' ? $title["titleName"] : 'not set' ?>
						</div>
						<div class="row mt-25 pb-10">
							<div class="col-8 pt-15" style="height: 30px;">
								<div class="progress" style="height: 8px;">
									<span class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></span>
								</div>
							</div>
							<div class="col-4 font-size-10 pt-13">
								<span class="font-b">9</span>/15
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-md-6 col-6">
					<div class="col-12 card pl-10 pr-10 pt-10 pb-20 border-0">
						<div class="row">
							<div class="col-6 update1_totaltitle1">
								Total Title Salary
							</div>
							<div class="col-6 text-end update1_totaltitle2 pr-10">
								฿ <?= number_format($totalEmployeeSalary) ?>
							</div>
						</div>
						<div class="col-12 pt-5 mt-27">
							<div class="row">
								<div class="salary-quartile  pr-7 pl-7 text-center">
									<div class="Mini_updated1 pr-0 pl-0"> Min
										<span class="text-primary"> 0%</span>
									</div>
									<div class="card badgeUp_dateborder" id="">
										<?= isset($quartileArr["min"]) ? number_format($quartileArr["min"]) : 0 ?>
									</div>
								</div>
								<div class="salary-quartile  pr-7 pl-7 text-center">
									<div class="Mini_updated1 pr-0 pl-0"> Low
										<span class="text-primary"> 25%</span>
									</div>
									<div class="card badgeUp_dateborder" id="">
										<?= isset($quartileArr["q1"]) ? number_format($quartileArr["q1"]) : 0 ?>
									</div>
								</div>
								<div class="salary-quartile brder pr-7 pl-7 text-center">
									<div class="Mini_updated1 pr-0 pl-0"> Medium
										<span class="text-primary"> 50%</span>
									</div>
									<div class="card badgeUp_dateborder" id="">
										<?= isset($quartileArr["q2"]) ? number_format($quartileArr["q2"]) : 0 ?>
									</div>
								</div>
								<div class="salary-quartile  pr-7 pl-7 text-center">
									<div class="Mini_updated1 pr-0 pl-0"> High
										<span class="text-primary"> 75%</span>
									</div>
									<div class="card badgeUp_dateborder" id="">
										<?= isset($quartileArr["q3"]) ? number_format($quartileArr["q3"]) : 0 ?>
									</div>
								</div>
								<div class="salary-quartile  pr-7 pl-7 text-center">
									<div class="Mini_updated1 pr-0 pl-0"> Max
										<span class="text-primary"> 100%</span>
									</div>
									<div class="card badgeUp_dateborder" id="">
										<?= isset($quartileArr["max"]) ? number_format($quartileArr["max"]) : 0 ?>
									</div>
								</div>
							</div>
							<div class="col-12 Minimum_dash"></div>
						</div>
					</div>
				</div>
				<div class="col-6">
					<div class="col-12 card border-0 pb-5">
						<div class="row pl-10 pr-10 ">
							<div class="col-12 update1_totaltitle1">
								Allowance
							</div>
						</div>
						<div class="row pr-10 pl-10 mt-8">
							<?php
							if (isset($departmentTitleAllowances) && count($departmentTitleAllowances) > 0) {
								foreach ($departmentTitleAllowances as $structureId => $allowance) :
							?>
									<div class="col-4 mb-7 pr-15 pl-15 ">
										<div class="row" style="border-radius: 2px;background-color:#F6F6F6;">
											<div class="col-8 pl-3 pr-3 pt-5 pb-5" style="font-size: 9px;">
												<i class="fa fa-minus-circle text-danger font-size-10" aria-hidden="true" style="cursor: pointer;"></i> &nbsp;<?= $allowance["structureName"] ?>
											</div>
											<div class="col-4 font-b pl-3 pr-3 text-end pt-5 pb-5" style="font-size: 9px;">
												<?= number_format($allowance["defaultValue"]) ?>
											</div>
										</div>
									</div>
								<?php
								endforeach;
							} else { ?>
								<div class="col-12 text-center pt-10 pb-40 font-size-16 font-b text-danger">Please set up this title salary</div>
							<?php
							}
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-12 mt-10">
			<?php
			if (isset($departmentTitleAllowances) && count($departmentTitleAllowances) > 0) {
			?>
				<table class="table">
					<thead>
						<tr class="frame-table-header">
							<th class="text-center" style="border-top-left-radius:5px;border-bottom-left-radius:5px;">EMPLOYEES</th>
							<?php
							foreach ($departmentTitleAllowances as $structureId => $allowance) :
							?>
								<th class="text-center font-size-10"><?= $allowance["structureName"] ?></th>
							<?php
							endforeach;
							?>
							<th class="text-center"> TOTAL</th>
							<th class="text-center" style="border-top-right-radius:5px;border-bottom-right-radius:5px;"> ACTION <i class="fa fa-pencil-square-o font-size-14 ml-10" aria-hidden="true" style="cursor: pointer;"></i></th>
						</tr>
					</thead>
					<tbody>
						<?php
						if (isset($titleEmployees) && count($titleEmployees) > 0) {
							foreach ($titleEmployees as $employeeId => $allowance) :
						?>
								<tr style="height: 5px;" id="employee1-<?= $employeeId ?>">
								</tr>
								<tr class="frame-table-tr" id="employee2-<?= $employeeId ?>">
									<td class=" pt-5 pb-5">
										<div class="row ">
											<div class="col-2">
												<img src="<?= Yii::$app->homeUrl ?><?= $allowance['picture'] ?>" class="brd_usering">
											</div>
											<div class="col-9">
												<span class="text_gray_AC font-b"> <?= $allowance["firstname"] ?> <?= $allowance["surename"] ?></span>
												<div class="text_gray_AC"> <?= $allowance["department"] ?> & <?= $allowance["title"] ?></div>
											</div>
										</div>
									</td>
									<?php
									if (isset($allowance["allowances"]) && count($allowance["allowances"]) > 0) {
										$total = 0;
										foreach ($allowance["allowances"] as $a) :
											$value = is_numeric($a) ? $a : 0;
									?>
											<td class="font-size-10 border-left text-end"><?= is_numeric($a) ? number_format($a) : $a ?></td>
									<?php
											$total += $value;
										endforeach;
									}
									?>
									<td class="text-end border-left font-size-11 font-weight-500"><?= number_format($total) ?></td>
									<td class="text-center border-left font-size-14 font-weight-500">
										<a href="javascript:employeeAllowance(<?= $employeeId ?>)" class="no-underline text-dark">
											<i class="fa fa-pencil-square-o font-size-13" aria-hidden="true" style="cursor: pointer;"></i>
										</a>
										<?php
										if ($total > 0) {
										?>
											<a href="javascript:deleteEmployeeSalary(<?= $employeeId ?>)" class="no-underline text-dark">
												<i class="fa fa-trash-o font-size-13 ml-10" aria-hidden="true" style="cursor: pointer;"></i>
											</a>
										<?php
										}
										?>
									</td>
								</tr>
						<?php
							endforeach;
						}
						?>
					</tbody>
				</table>
			<?php
			}
			?>
		</div>
	</div>
</div>
<input type="hidden" value="<?= $companyId ?>" id="companyId">
<?= $this->render('modal_create', [
	"company" => $company,
	"department" => $department,
	"employees" => $employees,
	"allowances" => $allowances
]) ?>
<!-- Modal -->