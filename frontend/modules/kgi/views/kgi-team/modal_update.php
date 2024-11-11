<div class="modal fade" id="update-kgi-modal-team" tabindex="-1" aria-labelledby="staticBackdropLabel2" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header" style="height: 100px;margin-top:-10px">
				<h5 class="modal-title text-primary" id="staticBackdropLabel2">
					<i class="fa fa-magic" aria-hidden="true"></i> Update <span id="team-name"></span> KGI
				</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="col-12 font-b" style="margin-top: -35px; padding-left:20px; font-size: 16px;">
				<i class="fa fa-flag" aria-hidden="true"></i> KGI : :<span class="ml-10" id="kgi-name"></span>
			</div>
			<div class="modal-body">
				<div class="col-12">
					<div class="col-12">
						<label for="exampleFormControlTextarea1" class="form-label font-size-13"> KGI Description</label>
						<div class="col-12 border  pt-5 pl-10 pb-5 text-secondary font-size-12" style="min-height: 50px;border-radius:5px;" id="kgi-detail"></div>
					</div>
					<div class="col-12 mt-10">
						<label for="exampleFormControlTextarea1" class="form-label font-size-13"> Team Remark</label>
						<div class="col-12 border  pt-5 pl-10 pb-5 text-secondary font-size-12" style="min-height: 50px;border-radius:5px;" id="kgi-remark"></div>
					</div>
					<div class="row">
						<div class="col-6 pt-10">
							<label for="exampleFormControl" class="form-label font-size-13">Quant Ratio</label>
							<div class="col-12 mt-5 pl-30 font-size-13  font-b" id="quant-ratio"></div>
						</div>
						<div class="col-6 pt-10">
							<label for="exampleFormControl" class="form-label font-size-13">Priority</label>
							<div class="col-12 mt-5 pl-30 font-size-13  font-b" id="priority"></div>
						</div>
						<div class="col-6 pt-10">
							<label for="exampleFormControl" class="form-label font-size-13">Amount Type</label>
							<div class="col-12 mt-5 pl-30 font-size-13  font-b" id="amount-type"></div>
						</div>
						<div class="col-6 pt-10">
							<label for="exampleFormControl" class="form-label font-size-13">Code</label>
							<div class="col-12 mt-5 pl-30 font-size-13  font-b" id="code"></div>
							<!-- <select class="form-select font-size-13" aria-label="Default select example" name="code" id="code-update">
								<option value="">
									<&nbsp;&nbsp;=&nbsp;&nbsp;>
								</option>
								<option value="<">&nbsp;&nbsp;<?= '<' ?>&nbsp;&nbsp;Result more than target</option>
								<option value="=">&nbsp;&nbsp;=&nbsp;&nbsp;Result equal target</option>
								<option value=">">&nbsp;&nbsp;>&nbsp;&nbsp;Result less than target</option>
							</select> -->
						</div>
						<div class="col-12 mt-10">
							<label for="input" class="form-label font-size-13"><strong class="red">*</strong> Check Unit</label>
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
										<button type="button" id="unit-<?= $unit['unitId'] ?>" class="btn border col-3 unit-<?= $i ?>  font-size-12 <?= $default ?>" style="<?= $style ?>">
											<?= $unit["unitName"] ?>
										</button>
								<?php
										$i++;
									endforeach;
								}
								?>


								<input type="hidden" value="" id="currentUnit" class="currentUnit" name="unit" required>
								<input type="hidden" value="" id="previousUnit" class="previousUnit" required>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-6 pt-10">
							<label for="exampleFormControl" class="form-label font-size-13"><strong class="red">*</strong> Status</label>
							<select class="form-select font-size-13" aria-label="Default select example" required name="status" id="status-update">
								<option value="1">Active</option>
								<option value="2">Finished</option>
							</select>
						</div>
						<div class="col-6">
							<div class="row">
								<div class="col-lg-6 col-md-6 col-6 pt-10">
									<label for="exampleFormControl" class="form-label font-size-13"><strong class="red">*</strong> Month</label>
									<select class="form-select font-size-13" required aria-label="Default select example" name="month" id="month-update">
										<option value="">Month</option>
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
								<div class="col-lg-6 col-md-6 col-6 pt-10">
									<label class="form-label font-size-12"><strong class="red">*</strong> Year</label>
									<select class="form-select font-size-12" required name="year" id="year-update">
										<option value="">Year</option>
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
							</div>
						</div>

						<div class="col-6 mt-10">
							<label for="exampleFormControl" class="form-label font-size-13"><strong class="red">*</strong> Target Amount</label>
							<input type="text" class="form-control font-size-13 text-end" id="target-amount" name="targetAmount" <?php // $isManager == 0 ? 'disabled' : '' 
																						?>>
						</div>
						<div class="col-6 mt-10">
							<label for="exampleFormControl" class="form-label font-size-13"><strong class="red">*</strong> Result</label>
							<input type="text" class="form-control text-end font-size-13" name="result" id="result">
						</div>
					</div>
					<div class="row mt-15">
						<div class="col-8">
							<div class="row">
								<div class="col-12 border-bottom">
									<label for="input" class="form-label font-size-13">
										<strong class="red">*</strong> Period Date
									</label>
								</div>
								<div class="col-6 mt-10">
									<div class="input-group">
										<div class="input-group">
											<span class="input-group-text font-size-12"><i class="fa fa-calendar-o" aria-hidden="true"></i>&nbsp;From</span>
											<input type="date" aria-label="" class="form-control font-size-12" required name="fromDate" id="from-date-update">
										</div>
									</div>
								</div>
								<div class="col-6 mt-10">
									<div class="input-group">
										<div class="input-group">
											<span class="input-group-text font-size-12"><i class="fa fa-calendar-o" aria-hidden="true"></i> &nbsp;&nbsp;To</span>
											<input type="date" aria-label="" class="form-control font-size-12" required name="toDate" id="to-date-update">
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-4">
							<div class="row">
								<div class="col-12 border-bottom">
									<label for="input" class="form-label font-size-13">
										<strong class="red">*</strong> Next Check Date
									</label>
								</div>
								<div class="col-12 mt-10">
									<div class="input-group">
										<span class="input-group-text font-size-12">
											<i class="fa fa-calendar-o" aria-hidden="true"></i> &nbsp;&nbsp; Date</span>
										<input type="date" aria-label="" class="form-control font-size-12 " id="nextCheckDate-update" required name="nextDate">
									</div>
								</div>

							</div>
						</div>
					</div>
					<div class="col-12 mt-10">
						<label for="exampleFormControlTextarea1" class="form-label font-size-13"> Remark</label>
						<textarea class="form-control" name="remark" rows="4"></textarea>
					</div>
				</div>
			</div>
			<div class="modal-footer" style="border: none;">
				<button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
				<button type="submit" class="btn btn-warning">Update</button>
			</div>
		</div>
	</div>
	<input type="hidden" id="kgiTeamId" name="kgiTeamId" value="">
</div>