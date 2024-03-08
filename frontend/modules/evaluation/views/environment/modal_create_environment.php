<div class="modal fade" id="create_environment" tabindex="-1" aria-labelledby="examdipleModalemployeeSearch" aria-hidden="true">
	<div class="modal-dialog  modal-lg">
		<div class="modal-content">
			<div class="container">
				<!-- <div id="create_environment_modal"> -->
				<div class="row mt-45 pr-30 pl-40">
					<div class="col-11 border-bottom pb-10 font-b font-size-20">
						Create Environment
					</div>
					<div class="col-1 border-bottom text-end pb-10 font-size-20 ">
						<i class="fa fa-times" aria-hidden="true" data-bs-dismiss="modal" style="cursor: pointer;"></i>
					</div>
				</div>
				<!-- </div> -->
				<div class="modal-body pr-30 pl-40 mt-20">
					<div class="row">
						<div class="col-5 font-b">
							<img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/24px/Company.png" class="circle-icon-dash-30 mr-10">
							Company
						</div>
						<div class="col-7">
							<select class="form-select" onchange="javascript:kgiFilter()()" required id="company-filter" name="companyId">
								<option value="">Company</option>
								<?php
								if (isset($companies) && count($companies) > 0) {
									foreach ($companies as $company) : ?>
										<option value="<?= $company["companyId"] ?>"><?= $company["companyName"] ?></option>
								<?php
									endforeach;
								}
								?>

							</select>
						</div>
					</div>
					<div class="row mt-20">
						<div class="col-5 font-b">
							<img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/24px/Department.png" class="circle-icon-dash-30 mr-10">
							Branch
						</div>
						<div class="col-7">
							<select class="form-select" id="branch-filter" name="branchId">
								<option value="">Branch</option>
							</select>
						</div>
					</div>
					<div class="row mt-40 mb-20">
						<div class="col-9 font-size-16 font-weight-500 mb-20">
							Evaluation Participants
						</div>
						<div class="col-12 font-size-18 font-b">
							<input type="checkbox" class="form-check-input mr-10" name="allEmployee">
							All Employee
						</div>
						<div class="col-12 font-size-12 mt-10">
							<span class="text-danger"> * </span>
							Selecting a branch includes all employees for evaluation
						</div>
					</div>
					<div class="row mt-40 mb-20">
						<div class="col-12 text-end">
							<button class="btn btn-primary" type="text">Create</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>