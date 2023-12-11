<div class="modal fade" id="staticBackdrop5" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header" style="height: 100px;margin-top:-10px">
				<h5 class="modal-title text-primary" id="staticBackdropLabel"><i class="fa fa-magic" aria-hidden="true"></i> Create KGI</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="col-12 font-b" style="margin-top: -35px; padding-left:20px; font-size: 16px;">
				<i class="fa fa-flag" aria-hidden="true"></i> Key Goal Indicators
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-lg-6 col-md-6 col-6 font-size-14">
						<div class="col-12">
							<label for="exampleFormControlInput1" class="form-label"><strong class="red">*</strong>KGI Contents</label>
							<input type="text" class="form-control" placeholder="" name="kgiName">
						</div>
						<div class="col-12 mt-10">
							<label for="input" class="form-label"><strong class="red">*</strong> Company</label>
							<select class="form-select" id="companyId" required name="companyId" onchange="javascript:companyMultiBrach()">
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
						<div class="col-12 mt-10">
							<label for="input" class="form-label"><strong class="red">*</strong> Team</label>
							<div class="col-12 form-control">
								Select Team
								<i class="fa fa-angle-down pull-right mt-5" aria-hidden="true"></i>
							</div>
							<div class="col-12" id="show-multi-team"></div>
						</div>
						<div class="col-12 mt-10">
							<label for="input" class="form-label"><strong class="red">*</strong> Check Unit</label>
							<div class="btn-group col-12" role="group" aria-label="Basic outlined example">
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
						<div class="col-12 mt-10">
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
								<div class="col-12 mt-10">
									<div class="input-group">
										<label for="input" class="form-label"><strong class="red">*</strong> Next Check Date</label>
										<div class="input-group">
											<span class="input-group-text font-size-12">
												<i class="fa fa-calendar-o" aria-hidden="true"></i> &nbsp;&nbsp; Date</span>
											<input type="date" aria-label="" class="form-control font-size-12 " id="nextCheckDate-create" required name="nextDate">
										</div>
									</div>
								</div>
							</div>
						</div>

					</div>
					<div class="col-lg-6 col-md-6 col-6">
						<div class="col-12">
							<label for="exampleFormControlTextarea1" class="form-label"> KGI Details</label>
							<textarea class="form-control" name="detail" rows="4"></textarea>
						</div>
						<div class="row">
							<div class="col-lg-6 col-md-6 col-6 pt-10">
								<label for="exampleFormControl" class="form-label font-size-13"><strong class="red">*</strong> Quant Ratio</label>
								<select class="form-select font-size-13" aria-label="Default select example" name="quantRatio">
									<option value="">Quantity / Quality</option>
									<option value="1">Quantity</option>
									<option value="2">Quality</option>
								</select>
							</div>
							<div class="col-lg-6 col-md-6 col-6 pt-10">
								<label for="exampleFormControl" class="form-label font-size-13"><strong class="red">*</strong> Priority</label>
								<select class="form-select font-size-13" aria-label="Default select example" name="priority">
									<option value="">A/B/C</option>
									<option value="A">A</option>
									<option value="B">B</option>
									<option value="C">C</option>
								</select>
							</div>
							<div class="col-lg-4 col-md-6 col-6 pt-10">
								<label for="exampleFormControl" class="form-label font-size-13"><strong class="red">*</strong> Amount Type</label>
								<select class="form-select font-size-13" aria-label="Default select example" name="amountType">
									<option value="">% or Number</option>
									<option value="1">%</option>
									<option value="2">Number</option>
								</select>
							</div>
							<div class="col-lg-8 col-md-6 col-6 pt-10">
								<label for="exampleFormControl" class="form-label font-size-13"><strong class="red">*</strong> Code</label>
								<select class="form-select font-size-13" aria-label="Default select example" name="code">
									<option value="">
										<&nbsp;&nbsp;=&nbsp;&nbsp;>
									</option>
									<option value="<">&nbsp;&nbsp;<?= '<' ?>&nbsp;&nbsp;Result more than target</option>
									<option value="=">&nbsp;&nbsp;=&nbsp;&nbsp;Result equal target</option>
									<option value=">">&nbsp;&nbsp;>&nbsp;&nbsp;Result less than target</option>
								</select>
							</div>
							<div class="col-lg-6 col-md-6 col-6 pt-10">
								<label for="exampleFormControl" class="form-label font-size-13"><strong class="red">*</strong> Status</label>
								<select class="form-select font-size-13" aria-label="Default select example" name="status">
									<option value="">Active / Finished</option>
									<option value="1">Active</option>
									<option value="2">Finished</option>
								</select>
							</div>
							<div class="col-lg-6 col-md-6 col-6 pt-10">
								<label for="exampleFormControl" class="form-label font-size-13"><strong class="red">*</strong> Month</label>
								<select class="form-select font-size-13" aria-label="Default select example" name="month">
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
							<div class="col-12 mt-10">
								<label for="exampleFormControl" class="form-label font-size-13"><strong class="red">*</strong> Target Amount</label>
								<input type="text" class="form-control font-size-13" name="targetAmount">
							</div>
							<div class="col-12">
								<label for="exampleFormControl" class="form-label font-size-13"><strong class="red">*</strong> Result</label>
								<input type="text" class="form-control font-size-13" name="result">
							</div>
							<div class="col-12 mt-10 border-bottom pb-10">
								KGI Group
							</div>
							<div class="row mt-10" id="kgi-group-create">
								<span class="text-secondary"> Please select company ! ! !</span>
							</div>
						</div>
					</div>
				</div>
				<!-- <div class="col-12 pt-10">
					Set Ratio Formula
				</div>
				<div class="col-12 pt-10">
					<select class="form-select font-size-12 alert-primary-12 text-dark" aria-label="Default select example">
						<option selected value="">Use Custom Formula</option>
						<option value="1">One</option>
						<option value="2">Two</option>
						<option value="3">Three</option>
					</select>
				</div>
				<div class="alert alert-primary-12 mt-10" role="alert">
					<div class="alert alert-light">
						<div class="row">
							<div class="col-lg-4 col-md-6 col-12">
								<a href="#"> <span class="badge bg-secondary text-white font-size-14"> <i class="fa fa-bullseye" aria-hidden="true"></i> Target</span></a>

								<a href="#"> <span class="badge bg-secondary text-white font-size-14"> <i class="fa fa-trophy" aria-hidden="true"></i> Result </span></a>
							</div>
							<div class="col-lg-8 col-md-6 col-12 targrt-small">
								<a href="#"><span class="badge bg-primary text-white pl-10 pr-10"> +</span></a>

								<a href="#"> <span class="badge bg-primary text-white pl-10 pr-10"> - </button></a>

								<a href="#"> <span class="badge bg-primary text-white pl-10 pr-10"> / </span></a>

								<a href="#"> <span class="badge bg-primary text-white pl-10 pr-10"> x </span></a>

								<a href="#"> <span class="badge bg-secondary text-white pl-10 pr-10"> ( </span></a>

								<a href="#"> <span class="badge bg-secondary text-white  pl-10 pr-10"> ) </span></a>
							</div>
						</div>
					</div>
					<div class="alert alert-light">
						<div class="col-12">
							<input type="text" class="form-control" style="border: none;" placeholder="( [ Target ] + [ Result ] - [ Target ] )">
						</div>
						<div class="mt-50"></div>
					</div>
				</div> -->
			</div>
			<div class="modal-footer" style="border: none;">
				<button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
				<button type="submit" class="btn btn-primary">Create</button>
			</div>
		</div>
	</div>
</div>