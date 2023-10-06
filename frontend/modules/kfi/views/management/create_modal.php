<div class="modal fade" id="staticBackdrop1" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header" style="height: 90px;">
				<h5 class="modal-title text-primary" id="staticBackdropLabel" style="margin-top:-20px;">
					<i class="fa fa-magic" aria-hidden="true"></i> Create KFI
				</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="margin-top:-20px;"></button>

			</div>
			<div class="col-12 font-size-16 font-b pl-20" style="margin-top:-35px;">
				<i class="fa fa-line-chart" aria-hidden="true"></i> Key Financial Indicator
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-lg-6 col-md-6 col-6">
						<div class="col-12">
							<label for="exampleFormControlInput1" class="form-label"><strong class="red">*</strong> KFI Contents</label>
							<input type="text" class="form-control" id="" name="kfiName" required>
						</div>
						<div class="col-12 pt-5">
							<label for="input" class="form-label"><strong class="red">*</strong> Company</label>
							<select class="form-select" name="company" id="companyId" onchange="javascript:companyMultiBrach()" required>
								<option value="">Select Company</option>
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
						<div class="col-12 mt-10">
							<label for="input" class="form-label"><strong class="red">*</strong> Branch</label>

							<div class="col-12 form-control">
								Select branch
								<i class="fa fa-angle-down pull-right mt-5" aria-hidden="true"></i>
							</div>
							<div class="col-12" id="show-multi-branch"></div>


						</div>
						<div class="col-12 mt-10">
							<label for="input" class="form-label"><strong class="red">*</strong> Department</label>
							<div class="col-12 form-control">
								Select Department
								<i class="fa fa-angle-down pull-right mt-5" aria-hidden="true"></i>
							</div>
							<div class="col-12" id="show-multi-department"></div>
						</div>
						<div class="col-12 pt-10">
							<label for="input" class="form-label"><strong class="red">*</strong> Check Unit</label>
							<div class="btn-group  col-12" role="group" aria-label="Basic outlined example">
								<?php
								if (isset($units) && count($units) > 0) {
									$i = 1;
									foreach ($units as $unit) :
										$style = "";
										$default = "";
										if ($i == 4) {
											$style = "border-radius:0 5px 5px 0;";
										}
										if ($i == 1) {
											//$style = "background-color:gray;";
											$default = 'btn-primary';
										}
								?>
										<button type="button" id="unit-<?= $unit['unitId'] ?>" class="btn border col-3  font-size-12 <?= $default ?>" onclick="javascript:selectUnit(<?= $unit['unitId'] ?>)" style="<?= $style ?>">
											<?= $unit["unitName"] ?>
										</button>
								<?php
										$i++;
									endforeach;
								}
								?>


								<input type="hidden" value="1" id="currentUnit" name="unit" required>
								<input type="hidden" value="1" id="previousUnit" required>
							</div>
						</div>
					</div>
					<div class="col-lg-6 col-md-6 col-6">
						<div class="col-12">
							<label for="exampleFormControlTextarea1" class="form-label"> KFI Details</label>
							<textarea class="form-control" name="detail" rows="9"></textarea>
						</div>
						<div class="row">
							<div class="col-lg-6 col-md-6 col-6 pt-10">
								<label for="exampleFormControl" class="form-label"><strong class="red">*</strong> Target Amount</label>
								<input type="number" class="form-control" name="amount" step="any" required>
							</div>
							<div class="col-lg-6 col-md-6 col-6 pt-10">
								<label for="exampleFormControl" class="form-label"><strong class="red">*</strong> Month</label>
								<select class="form-select" required name="month">
									<option value="">Select Month</option>
									<?php
									if (isset($months) && count($months) > 0) {
										foreach ($months as $value => $month) : ?>
											<option value="<?= $value ?>"><?= $month ?></option>
									<?php

										endforeach;
									}
									?>
								</select>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
				<button type="submit" class="btn btn-primary">Create</button>
			</div>
		</div>
	</div>
</div>