<div class="modal fade" id="staticBackdrop2" tabindex="-1" aria-labelledby="staticBackdrop2" aria-hidden="true">
	<!-- data-bs-backdrop="static" data-bs-keyboard="false" -->
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header" style="height: 90px;">
				<h5 class="modal-title text-primary" id="staticBackdropLabel" style="margin-top:-20px;">
					<i class="fa fa-magic" aria-hidden="true"></i> Complete Setup
				</h5>
				<button type="button" class="btn-close" style="margin-top:-20px;" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="col-12 font-size-16 font-b pl-20" style="margin-top: -35px;">
				<i class="fa fa-flag" aria-hidden="true"></i> Key Financial Indicator
			</div>
			<div class="modal-body mt-10">
				<div class="row">
					<div class="col-lg-6 col-md-6 col-6 font-size-14">
						<div class="col-12">
							<label for="exampleFormControlInput1" class="form-label">KFI Contents</label>
							<input type="text" class="form-control" value="" id="kfiName">
						</div>
						<div class="col-12 pt-5 mt-5">
							<label for="input" class="form-label">Company</label>
							<select class="form-select" name="company" id="companyId-update" onchange="javascript:companyMultiBrachKfi()" required>
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
							<div class="col-12" id="show-multi-branch-update"></div>
						</div>
						<div class="col-12 mt-10">
							<label for="input" class="form-label"><strong class="red">*</strong> Department</label>
							<div class="col-12 form-control">
								Select Department
								<i class="fa fa-angle-down pull-right mt-5" aria-hidden="true"></i>
							</div>
							<div class="col-12" id="show-multi-department-update"></div>
						</div>
						<div class="col-12 mt-15">
							<label for="input" class="form-label"><strong class="red">*</strong> Update Detail</label>
							<input type="text" class="form-control" name="progressTitle" required>
						</div>
						<div class="col-12 pt-10 mt-5">
							<label for="input" class="form-label"><strong class="red">*</strong> Check Unit</label>
							<div class="btn-group mt-5 col-12" role="group" aria-label="Basic outlined example">
								<button type="button" class="btn btn border col-3  font-size-12 unit-1" onclick="javascript:selectUnitUpdate(1)">Monthly</button>
								<button type="button" class="btn btn border col-3  font-size-12 unit-2" onclick="javascript:selectUnitUpdate(2)">Weekly</button>
								<button type="button" class="btn btn border col-3  font-size-12 unit-3" onclick="javascript:selectUnitUpdate(3)">Quaterly</button>
								<button type="button" class="btn btn border col-3  font-size-12 unit-4" onclick="javascript:selectUnitUpdate(4)">Daily</button>
								<input type="hidden" value="" class="currentUnit" name="unit" required>
								<input type="hidden" value="" class="previousUnit" required>
							</div>
						</div>
						<div class="col-12 pt-5 mt-15 font-size-14">
							<div class="row">
								<div class="col-12 border-bottom">
									<label for="input" class="form-label"><strong class="red">*</strong> Select Period</label>

								</div>
								<div class="col-lg-6 col-md-6 col-12 mt-10">
									<div class="input-group">

										<div class="input-group">
											<span class="input-group-text font-size-12"><i class="fa fa-calendar-o" aria-hidden="true"></i>&nbsp;From</span>
											<input type="date" aria-label="" class="form-control font-size-12" required name="fromDate" id="from-date">
										</div>
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-12 mt-10">
									<div class="input-group">

										<div class="input-group">
											<span class="input-group-text font-size-12"><i class="fa fa-calendar-o" aria-hidden="true"></i> &nbsp;&nbsp;To</span>
											<input type="date" aria-label="" class="form-control font-size-12" required name="toDate" id="to-date">
										</div>
									</div>
								</div>
								<div class="col-lg-12 col-md-6 col-12 mt-10">
									<div class="input-group">
										<label for="input" class="form-label"><strong class="red">*</strong> Next Check Date</label>
										<div class="input-group">
											<span class="input-group-text font-size-12"><i class="fa fa-calendar-o" aria-hidden="true"></i> &nbsp;&nbsp; Date</span>
											<input type="date" aria-label="" class="form-control font-size-12" required name="nextCheckDate" id="nextCheckDate-update">
										</div>
									</div>
								</div>
							</div>

						</div>
						<div class="col-12 pt-5 pt-5 mt-10">
							<label for="exampleFormControl" class="form-label font-size-13">Target Amount</label>
							<input type="text" class="form-control text-end" value="" disabled id="targetAmount">
						</div>
					</div>
					<div class="col-lg-6 col-md-6 col-6 font-size-14">
						<div class="col-12">
							<label for="kfiDetail" class="form-label"> KFI Details</label>
							<textarea class="form-control" id="kfiDetail" rows="7" id="kfiDetail" name="detail"></textarea>
						</div>
						<div class="row">
							<div class="col-12 pt-10">
								<label for="exampleFormControl" class="form-label font-size-13"><strong class="red">*</strong> Quant Ratio</label>
								<select class="form-select font-size-13" id="quantRatio" name="quanRatio" required>
									<option value="">Quantity or Quality</option>
									<option value="1">Quantity</option>
									<option value="2">Quality</option>
								</select>
								<input type="hidden" name="kfiId" id="kfiId" value="">
							</div>
							<div class="col-lg-6 col-md-6 col-6 pt-10 mt-17">
								<label for="exampleFormControl" class="form-label font-size-13"><strong class="red">*</strong> Amount Type</label>
								<select class="form-select font-size-13" id="amountType" name="amountType" required>
									<option value="">% or Number</option>
									<option value="1">%</option>
									<option value="2">Number</option>
								</select>
							</div>
							<div class="col-lg-6 col-md-6 col-6 pt-10  mt-17">
								<label for="exampleFormControl" class="form-label font-size-13"><strong class="red">*</strong> Code</label>
								<select class="form-select font-size-13" id="code" name="code" required>
									<option value="">
										<&nbsp;&nbsp;=&nbsp;&nbsp;>
									</option>
									<option value="<">&nbsp;&nbsp;<?= '<' ?>&nbsp;&nbsp;</option>
									<option value="=">&nbsp;&nbsp;=&nbsp;&nbsp;</option>
									<option value=">">&nbsp;&nbsp;>&nbsp;&nbsp;</option>
								</select>
							</div>
							<div class="col-lg-12 col-md-6 col-6 pt-10  mt-3">
								<label for="exampleFormControl" class="form-label font-size-13"><strong class="red">*</strong> Status</label>
								<select class="form-select font-size-13" id="kfiStatus" name="status" required>
									<option value="">Active/Finished</option>
									<option value="1">Active</option>
									<option value="2">Finished</option>
								</select>
							</div>
							<div class="col-lg-6 col-md-6 col-6 pt-10  mt-3">
								<label for="exampleFormControl" class="form-label font-size-13">Month</label>
								<select class="form-select" required name="month" id="monthName">
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
							<div class="col-lg-6 col-md-6 col-6 pt-10  mt-3">
								<label for="exampleFormControl" class="form-label font-size-13">Year</label>
								<select class="form-select" required name="year" id="year">
									<option value="">Select Year</option>
									<?php
									$year = 2020;
									$thisYear = date('Y');
									while ($year < ($thisYear + 10)) { ?>
										<option value="<?= $year ?>"><?= $year ?></option>
									<?php
										$year++;
									}
									?>
								</select>
							</div>
							<div class="col-12  mt-15">
								<label for="exampleFormControl" class="form-label font-size-13"><strong class="red">*</strong> Result</label>
								<input type="number" step="any" class="form-control font-size-13 text-end" id="result" name="result" required>
							</div>
							<div class="col-12 mt-10">
								<label class="form-label font-size-13">Remark</label>
								<textarea class="form-control font-size-13" id="remark" name="remark"></textarea>
							</div>
						</div>
					</div>
				</div>
				<div class="col-12 pt-10">
					Set Ratio Formula
				</div>
				<div class="col-12 pt-10">
					<select class="form-select font-size-12 alert-primary-12 text-dark" aria-label="Default select example">
						<option selected>Use Custom Formula</option>
						<option value="1">One</option>
						<option value="2">Two</option>
						<option value="3">Three</option>
					</select>
				</div>
				<div class="alert alert-primary-12 mt-10" role="alert">
					<div class="alert alert-light">
						<div class="row">
							<div class="col-lg-2 col-md-6 col-12">
								<a href=""> <span class="badge bg-secondary text-white font-size-14"> <i class="fa fa-bullseye" aria-hidden="true"></i> Target</span></a>
							</div>
							<div class="col-lg-2 col-md-6 col-12">
								<a href=""> <span class="badge bg-secondary text-white font-size-14"> <i class="fa fa-trophy" aria-hidden="true"></i> Result </span></a>
							</div>
							<div class="col-lg-1 col-md-6 col-12">
								<button type="button" class="btn btn-primary"> + </button>
							</div>
							<div class="col-lg-1 col-md-6 col-12">
								<button type="button" class="btn btn-primary"> - </button>
							</div>
							<div class="col-lg-1 col-md-6 col-12">
								<button type="button" class="btn btn-primary"> / </button>
							</div>
							<div class="col-lg-1 col-md-6 col-12">
								<button type="button" class="btn btn-primary"> x </button>
							</div>
							<div class="col-lg-1 col-md-6 col-12">
								<button type="button" class="btn btn-secondary"> ( </button>
							</div>
							<div class="col-lg-1 col-md-6 col-12">
								<button type="button" class="btn btn-secondary"> ) </button>
							</div>
						</div>
					</div>
					<div class="alert alert-light">
						<div class="col-12 ">
							<input type="text" class="form-control" style="border: none;" placeholder="( [ Target ] + [ Result ] - [ Target ] )" name="formular">
						</div>
						<div class="mt-50"></div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
				<button type="submit" class="btn btn-primary">Update</button>
			</div>
		</div>
	</div>
</div>