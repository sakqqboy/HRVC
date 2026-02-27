<?php

use frontend\models\hrvc\Department;
use frontend\models\hrvc\Title;

$this->title = 'Salary Registeration';
?>
<!-- <script src="https://cdn.tailwindcss.com"></script> -->
<style>
		/* ================= Layout ================= */
.submain-content {
    width: 100%;
    padding: 0 30px;
    min-height: 100vh;
    background: #ffffff;
}

/* ================= Table Card ================= */
.salary-table-card {
    background: #ffffff;
    border: 1px solid #e5e7eb;
    border-radius: 8px;
    overflow: hidden;
}

/* ================= Table Base ================= */
.table-clean {
    width: 100%;
    min-width: 1000px;
    border-collapse: collapse;
}

/* ================= Header ================= */
.frame-table-header {
    background-color: #f3f4f6; /* เทาอ่อน */
}

.frame-table-header th {
    background-color: #f3f4f6; /* กันบาง browser ไม่เต็ม */
    padding: 18px 20px;
    font-size: 10px;
    font-weight: 500;
    color: #9ca3af;
    text-transform: uppercase;
    letter-spacing: 0.08em;
}


/* ================= Alignment Helpers ================= */
.text-start { text-align: left; }
.text-end { text-align: right; }
.text-center { text-align: center; }

/* ================= Employee Cell ================= */
.employee-row {
    display: flex;
    align-items: center;
}

.brd_usering {
    width: 42px;
    height: 42px;
    border-radius: 50%;
    object-fit: cover;
}

.employee-info {
    margin-left: 12px;
}

.employee-name {
    font-size: 14px;
    font-weight: 600;
    color: #111827;
}

.employee-sub {
    font-size: 11px;
    color: #9ca3af;
    margin-top: 3px;
}

/* ================= Numeric / Total ================= */
.numeric-cell {
    color: #374151;
}

.total-cell {
    font-weight: 600;
    color: #111827;
}

/* ================= Action ================= */
.action-cell i {
    color: #6b7280;
    transition: 0.2s;
    cursor: pointer;
}

.action-cell i:hover {
    color: #111827;
}

/* ================= Buttons ================= */
.btn-filter {
    padding: 6px 12px;
    background: #ffffff;
    border: 1px solid #f3f4f6;
    border-radius: 3px;
    font-size: 11px;
    color: #4b5563;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    cursor: pointer;
    transition: 0.2s;
}

.btn-filter:hover {
    background: #f9fafb;
}

.btn-primary-sm {
    padding: 6px 12px;
    background: #2580D3;
    color: #ffffff;
    border-radius: 3px;
    font-size: 11px;
    border: none;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    cursor: pointer;
    box-shadow: 0 1px 2px rgba(0,0,0,0.05);
    transition: 0.2s;
}

.btn-primary-sm:hover {
    background: #1e6bb3;
}

/* ================= Input ================= */
.search-wrapper {
    position: relative;
    width: 16rem;
}

.search-icon {
    position: absolute;
    left: 10px;
    top: 50%;
    transform: translateY(-50%);
    width: 14px;
    height: 14px;
    stroke: #9ca3af;
    pointer-events: none;
}

.input-clean {
    width: 100%;
    padding: 6px 16px 6px 32px;
    border: 1px solid #f3f4f6;
    border-radius: 3px;
    font-size: 12px;
    outline: none;
    transition: 0.2s;
}

.input-clean:focus {
    border-color: #2580D3;
}

.btn-orange-soft {
    display: inline-flex;
    align-items: center;
    gap: 8px;

    padding: 6px 12px;

    font-size: 12px;
    font-weight: 400;

    color: #ea580c;
    background-color: rgba(255, 237, 213, 0.5);

    border: 1px solid #ffedd5;
    border-radius: 3px;

    cursor: pointer;
    transition: background-color 0.2s ease;
}

.btn-orange-soft:hover {
    background-color: #ffedd5;
}
		</style>

<div class="col-12 mt-60 pt-10 bg-white">
	<div class="row">
		<div class="col-5">
			<div class="row">
				<!-- <div class="col-12 updated_registersalary">
					Salary Registeration
				</div> -->
				<div class="font-b font-size-18 pt-5"
                    style="font-size:20px; font-weight:400; color:#111827; letter-spacing:-0.01em;">
                   Salary Registeration
            	</div>
			</div>
		</div>
		<div class="col-7">
			<div class="d-flex align-items-center justify-content-end gap-2">
				<div class="col-3 text-center">
					<div class="col-12 updated_evaluationQ">
						Evaluation Q4
					</div>
				</div>
				<div class="col-3 text-center">
					<button class="btn-orange-soft">
						<svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-upload w-3.5 h-3.5">
						<path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4">
					</path><polyline points="17 8 12 3 7 8"></polyline><line x1="12" x2="12" y1="3" y2="15"></line></svg>Import</button>
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
	<div class="col-12 environment background_updateline pt-15 pr-10 pl-10">
		<div class="row align-items-center">
			<div class="col-6">
				<div style="position:relative;width:256px;">
					<svg xmlns="http://www.w3.org/2000/svg"
						width="24"
						height="24"
						viewBox="0 0 24 24"
						fill="none"
						stroke="currentColor"
						stroke-width="2"
						stroke-linecap="round"
						stroke-linejoin="round"
						style="
								position:absolute;
								left:10px;
								top:50%;
								transform:translateY(-50%);
								width:14px;
								height:14px;
								color:#9ca3af;
								z-index:2;
						">
						<circle cx="11" cy="11" r="8"></circle>
						<path d="m21 21-4.3-4.3"></path>
					</svg>
					<input type="text"
						placeholder="Search employees..."
						style="
								width:100%;
								padding:6px 16px 6px 32px;
								background:#ffffff;
								border:1px solid #f3f4f6;
								border-radius:3px;
								font-size:12px;
								outline:none;
								transition:all .2s ease;
						"
						onfocus="this.style.borderColor='#2580D3'"
						onblur="this.style.borderColor='#f3f4f6'">
				</div>
			</div>

			<div class="col-6">
				<div class="d-flex align-items-center justify-content-end gap-2">

					<!-- Department -->
					<select class="form-select slec_updated w-auto"
							id="department"
							onchange="departmentTitle()">
						<?php if (!empty($departmentId)): ?>
							<option value="<?= $departmentId ?>">
								<?= Department::departmentNAme($departmentId) ?>
							</option>
						<?php endif; ?>

						<option value="">Department</option>

						<?php foreach ($departments ?? [] as $dep): ?>
							<option value="<?= $dep['departmentId'] ?>">
								<?= $dep['departmentName'] ?>
							</option>
						<?php endforeach; ?>
					</select>

					<!-- Title -->
					<select class="form-select slec_updated w-auto" id="title">
						<?php if (!empty($titleId)): ?>
							<option value="<?= $titleId ?>">
								<?= Title::titleName($titleId) ?>
							</option>
						<?php endif; ?>

						<option value="">Title</option>

						<?php foreach ($titles ?? [] as $t): ?>
							<option value="<?= $t['titleId'] ?>">
								<?= $t['titleName'] ?>
							</option>
						<?php endforeach; ?>
					</select>

					<!-- Filter Button -->
					 <button class="btn-filter" onclick="filterSalaryRegister()">
						<svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-funnel w-3 h-3">
							<path d="M10 20a1 1 0 0 0 .553.895l2 1A1 1 0 0 0 14 21v-7a2 2 0 0 1 .517-1.341L21.74 4.67A1 1 0 0 0 21 3H3a1 1 0 0 0-.742 1.67l7.225 7.989A2 2 0 0 1 10 14z">
							</path>
						</svg>
						Filter
					</button>
	
					<button type="button"
						class="btn-primary-sm"
						data-bs-toggle="modal"
						data-bs-target="#salaryRegistration">

						<svg xmlns="http://www.w3.org/2000/svg"
							width="14"
							height="14"
							viewBox="0 0 24 24"
							fill="none"
							stroke="currentColor"
							stroke-width="2"
							stroke-linecap="round"
							stroke-linejoin="round"
							style="margin-bottom: 2px;"
							>
							<path d="M5 12h14"></path>
							<path d="M12 5v14"></path>
						</svg>

						Add Employee
					</button>

				</div>
			</div>
		</div>
					
		<div class="table-responsive mt-10">
			<?php
			if (isset($departmentTitleAllowances) && count($departmentTitleAllowances) > 0) {
			?>
				<table style="
					width:100%;
					border-collapse:separate;
					border-spacing:0;
					background:#ffffff;
					border-radius:8px;
					overflow:hidden;
					box-shadow:0 1px 2px rgba(0,0,0,0.05), 
							0 4px 12px rgba(0,0,0,0.04);
					border:1px solid #f3f4f6;
					font-family:Inter,system-ui,-apple-system,sans-serif;
				">
					<thead>
						 <tr style="
							background:rgba(249,250,251,0.8);
							border-bottom:1px solid #f3f4f6;
						">
							<th class="text-start"  style="padding:12px 24px;font-size:10px;font-weight:400;color:#9ca3af;text-transform:uppercase;letter-spacing:0.12em;text-align:left;">
								EMPLOYEES
							</th>
							<?php
							foreach ($departmentTitleAllowances as $structureId => $allowance) :
							?>
								<th class="text-end"  style="padding:12px 24px;font-size:10px;font-weight:400;color:#9ca3af;text-transform:uppercase;letter-spacing:0.12em;text-align:left;">
									<?= $allowance["structureName"] ?>
								</th>
							<?php
							endforeach;
							?>
							<th class="text-end"  style="padding:12px 24px;font-size:10px;font-weight:400;color:#9ca3af;text-transform:uppercase;letter-spacing:0.12em;text-align:left;"> 
								TOTAL
							</th>
							<th  class="text-center" style="padding:12px 24px;font-size:10px;font-weight:400;color:#9ca3af;text-transform:uppercase;letter-spacing:0.12em;text-align:left;">
								ACTION 
							</th>
						</tr>
					</thead>
					<tbody>
						<?php
						if (isset($titleEmployees) && count($titleEmployees) > 0) {
							foreach ($titleEmployees as $employeeId => $allowance) :
						?>
						
								<tr style="border-bottom:1px solid #f9fafb;transition:.2s;"
									onmouseover="this.style.background='rgba(59,130,246,0.05)'"
									onmouseout="this.style.background=''" id="employee1-<?= $employeeId ?>">
								</tr>
								<tr style="border-bottom:1px solid #f9fafb;transition:.2s;"
									onmouseover="this.style.background='rgba(59,130,246,0.05)'"
									onmouseout="this.style.background=''" id="employee2-<?= $employeeId ?>">
									<td style="padding:16px 24px;text-align:center;font-size:12px;color:#4b5563;">
										<div class="d-flex align-items-center">
											<img src="<?= Yii::$app->homeUrl ?><?= $allowance['picture'] ?>" class="brd_usering">
											<div class="ml-10">
												<div class="employee-name">
													<?= $allowance["firstname"] ?> <?= $allowance["surename"] ?>
												</div>
												<div class="employee-sub">
													<?= $allowance["department"] ?> • <?= $allowance["title"] ?>
												</div>
											</div>
										</div>
									</td>
									<?php
									if (isset($allowance["allowances"]) && count($allowance["allowances"]) > 0) {
										$total = 0;
										foreach ($allowance["allowances"] as $a) :
											$value = is_numeric($a) ? $a : 0;
									?>
											<td class="font-size-10  text-end"><?= is_numeric($a) ? number_format($a) : $a ?></td>
									<?php
											$total += $value;
										endforeach;
									}
									?>
									<td class="text-end  font-size-11 font-weight-500" style="padding:16px 24px;text-align:center;font-size:12px;color:#4b5563;">
										<?= number_format($total) ?>
									</td>
									<td class="text-center  font-size-14 font-weight-500" style="padding:16px 24px;text-align:center;font-size:12px;color:#4b5563;">
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