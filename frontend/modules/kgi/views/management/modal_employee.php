<div class="modal fade" id="kgi-employee-modal" tabindex="-1" aria-labelledby="examdipleModalemployeeSearch" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-lg">
		<div class="modal-content">
			<div class="container">
				<div id="kgi-employee-modal">
					<div class="row">
						<div class="col-12 text-end font-size-18">
							<i class="fa fa-times" aria-hidden="true" data-bs-dismiss="modal" style="cursor: pointer;"></i>
							</i>
						</div>
						<input type="hidden" id="kgiId" value="">
						<div class="col-1 pr-0 mt-20 text-end" style="margin-top:-15px;">

							<div class="Resolve-c text-center">
								<i class="fa fa-user font-size-11" aria-hidden="true"></i>
							</div>
							<span class="company-c"> </span>
						</div>
						<div class="col-11 mt-20 Employees-0 pt-5" style="margin-top:-15px;"> <?= Yii::t('app', 'Employees') ?></div>
						<div class="col-lg-4 col-12 mt-20">
							<div class="col-12">
								<select class="form-select " onchange="javascript:searchKgiEmployee()" id="search-employee-department">
								</select>
							</div>
						</div>
						<div class="col-lg-4 col-12 mt-20">
							<div class="col-12">
								<select class="form-select " onchange="javascript:searchKgiTeam()" id="search-employee-team">
									<option value=""><?= Yii::t('app', 'Team') ?></option>
								</select>
							</div>
						</div>
						<div class="col-lg-4 col-12 mt-20">
							<div class="col-12">
								<span class="submit-search">
									<i class="fa fa-search" aria-hidden="true"></i></i>
								</span>
								<input class="form-control rounded pl-35" id="search-employee-kgi" type="search" placeholder="Search" aria-label="Search" onkeyup="javascript:searchKgiEmployee()">
							</div>
							<div class="border mt-5 pt-10 pl-10 search-employee-box" id="search-employee-box">

							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-body">
				<div class="card card-company">
					<div class="row pb-10" id="employeeInBranch" style="max-height: 400px;overflow-y:auto;">
					</div>
				</div>
			</div>
		</div>
	</div>
</div>