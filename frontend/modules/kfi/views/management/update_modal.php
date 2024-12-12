<div class="modal fade" id="staticBackdrop2" tabindex="-1" aria-labelledby="staticBackdrop2" aria-hidden="true">
	<!-- data-bs-backdrop="static" data-bs-keyboard="false" -->
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header" style="height: 90px;">
				<h5 class="modal-title text-primary" id="staticBackdropLabel" style="margin-top:-20px;">
					<i class="fa fa-magic" aria-hidden="true"></i> <?= Yii::t('app', 'Complete Setup') ?>
				</h5>
				<button type="button" class="btn-close" style="margin-top:-20px;" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="col-12 font-size-16 font-b pl-20" style="margin-top: -35px;">
				<i class="fa fa-flag" aria-hidden="true"></i> <?= Yii::t('app', 'Key Financial Indicator') ?>
			</div>
			<div class="modal-body mt-10">
				<div class="row">
					<div class="col-lg-6 col-md-6 col-6 font-size-14">
						<div class="col-12">
							<label for="exampleFormControlInput1" class="form-label"><?= Yii::t('app', 'KFI Contents') ?></label>
							<input type="text" class="form-control" value="" id="kfiName" name="kfiName">
						</div>
						<div class="col-12 pt-5 mt-5">
							<label for="input" class="form-label"><?= Yii::t('app', 'Company') ?></label>
							<select class="form-select" name="company" id="companyId-update" onchange="javascript:companyMultiBrachKfi()" required>
								<option value=""><?= Yii::t('app', 'Select Company') ?></option>
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
							<label for="input" class="form-label"><strong class="red">*</strong> <?= Yii::t('app', 'Branch') ?></label>

							<div class="col-12 form-control">
								<?= Yii::t('app', 'Select branch') ?>
								<i class="fa fa-angle-down pull-right mt-5" aria-hidden="true"></i>
							</div>
							<div class="col-12" id="show-multi-branch-update"></div>
						</div>
						<div class="col-12 mt-10">
							<label for="input" class="form-label"><strong class="red">*</strong> <?= Yii::t('app', 'Department') ?></label>
							<div class="col-12 form-control">
								<?= Yii::t('app', 'Select Department') ?>
								<i class="fa fa-angle-down pull-right mt-5" aria-hidden="true"></i>
							</div>
							<div class="col-12" id="show-multi-department-update"></div>
						</div>
						<div class="col-12 mt-15">
							<label for="input" class="form-label"> <?= Yii::t('app', 'Update Detail') ?></label>
							<input type="text" class="form-control" name="progressTitle">
						</div>
						<div class="col-12 pt-10 mt-5">
							<label for="input" class="form-label"><strong class="red">*</strong> <?= Yii::t('app', 'Check Unit') ?></label>
							<div class="btn-group mt-5 col-12" role="group" aria-label="Basic outlined example">
								<button type="button" class="btn btn border col-3  font-size-12 unit-1" onclick="javascript:selectUnitUpdate(1)"><?= Yii::t('app', 'Monthly') ?></button>
								<button type="button" class="btn btn border col-3  font-size-12 unit-2" onclick="javascript:selectUnitUpdate(2)"><?= Yii::t('app', 'Quaterly') ?></button>
								<button type="button" class="btn btn border col-3  font-size-12 unit-3" onclick="javascript:selectUnitUpdate(3)"><?= Yii::t('app', 'Half year') ?></button>
								<button type="button" class="btn btn border col-3  font-size-12 unit-4" onclick="javascript:selectUnitUpdate(4)"><?= Yii::t('app', 'Yearly') ?></button>
								<input type="hidden" value="" class="currentUnit" name="unit" required>
								<input type="hidden" value="" class="previousUnit" required>
							</div>
						</div>
						<div class="col-12 pt-5 mt-15 font-size-14">
							<div class="row">
								<div class="col-12 border-bottom">
									<label for="input" class="form-label"><strong class="red">*</strong> <?= Yii::t('app', 'Select Period') ?></label>
								</div>
								<div class="col-lg-6 col-md-6 col-12 mt-10">
									<div class="input-group">

										<div class="input-group">
											<span class="input-group-text font-size-12"><i class="fa fa-calendar-o" aria-hidden="true"></i>&nbsp;<?= Yii::t('app', 'From') ?></span>
											<input type="date" aria-label="" class="form-control font-size-12" required name="fromDate" id="from-date">
										</div>
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-12 mt-10">
									<div class="input-group">

										<div class="input-group">
											<span class="input-group-text font-size-12"><i class="fa fa-calendar-o" aria-hidden="true"></i> &nbsp;&nbsp;<?= Yii::t('app', 'To') ?></span>
											<input type="date" aria-label="" class="form-control font-size-12" required name="toDate" id="to-date">
										</div>
									</div>
								</div>
								<div class="col-lg-12 col-md-6 col-12 mt-10">
									<div class="input-group">
										<label for="input" class="form-label"><strong class="red">*</strong> <?= Yii::t('app', 'Next Check Date') ?></label>
										<div class="input-group">
											<span class="input-group-text font-size-12"><i class="fa fa-calendar-o" aria-hidden="true"></i> &nbsp;&nbsp; Date</span>
											<input type="date" aria-label="" class="form-control font-size-12" required name="nextCheckDate" id="nextCheckDate-update">
										</div>
									</div>
								</div>
							</div>
						</div>

					</div>
					<div class="col-lg-6 col-md-6 col-6 font-size-14">
						<div class="col-12">
							<label for="kfiDetail" class="form-label"> <?= Yii::t('app', 'KFI Details') ?></label>
							<textarea class="form-control" id="kfiDetail" rows="7" id="kfiDetail" name="detail"></textarea>
						</div>
						<div class="row">
							<div class="col-12 pt-10">
								<label for="exampleFormControl" class="form-label font-size-13"><strong class="red">*</strong> <?= Yii::t('app', 'Quant Ratio') ?></label>
								<select class="form-select font-size-13" id="quantRatio" name="quanRatio" required>
									<option value=""><?= Yii::t('app', 'Quantity') ?> <?= Yii::t('app', 'or') ?> <?= Yii::t('app', 'Quality') ?></option>
									<option value="1"><?= Yii::t('app', 'Quantity') ?></option>
									<option value="2"><?= Yii::t('app', 'Quality') ?></option>
								</select>
								<input type="hidden" name="kfiId" id="kfiId-update" value="">
							</div>
							<div class="col-lg-4 col-md-6 col-6 pt-10 mt-17">
								<label for="exampleFormControl" class="form-label font-size-13"><strong class="red">*</strong> <?= Yii::t('app', 'Amount Type') ?></label>
								<select class="form-select font-size-13" id="amountType" name="amountType" required>
									<option value="">% <?= Yii::t('app', 'or') ?> <?= Yii::t('app', 'Number') ?></option>
									<option value="1">%</option>
									<option value="2"><?= Yii::t('app', 'Number') ?></option>
								</select>
							</div>
							<div class="col-lg-8 col-md-6 col-6 pt-10  mt-17">
								<label for="exampleFormControl" class="form-label font-size-13"><strong class="red">*</strong> <?= Yii::t('app', 'Code') ?></label>
								<select class="form-select font-size-13" id="code" name="code" required>
									<option value="">
										<&nbsp;&nbsp;=&nbsp;&nbsp;>
									</option>
									<option value="<">&nbsp;&nbsp;<?= '<' ?>&nbsp;&nbsp;<?= Yii::t('app', 'Result more than target') ?></option>
									<option value="=">&nbsp;&nbsp;=&nbsp;&nbsp;<?= Yii::t('app', 'Result equal target') ?></option>
									<option value=">">&nbsp;&nbsp;>&nbsp;&nbsp;<?= Yii::t('app', 'Result less than targe') ?>t</option>
								</select>
							</div>
							<div class="col-lg-12 col-md-6 col-6 pt-10  mt-3">
								<label for="exampleFormControl" class="form-label font-size-13"><strong class="red">*</strong> <?= Yii::t('app', 'Status') ?></label>
								<select class="form-select font-size-13" id="kfiStatus" name="status" required>
									<option value=""><?= Yii::t('app', 'Active') ?> / <?= Yii::t('app', 'Finished') ?></option>
									<option value="1"><?= Yii::t('app', 'Active') ?></option>
									<option value="2"><?= Yii::t('app', 'Finished') ?></option>
								</select>
							</div>
							<div class="col-lg-6 col-md-6 col-6 pt-10  mt-3">
								<label for="exampleFormControl" class="form-label font-size-13"><?= Yii::t('app', 'Month') ?></label>
								<select class="form-select" required name="month" id="monthName">
									<option value=""><?= Yii::t('app', 'Select Month') ?></option>
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
								<label for="exampleFormControl" class="form-label font-size-13"><?= Yii::t('app', 'Year') ?></label>
								<select class="form-select" required name="year" id="year">
									<option value=""><?= Yii::t('app', 'Select Year') ?></option>
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
							<div class="col-12 mt-15">
								<label for="exampleFormControl" class="form-label font-size-13"><?= Yii::t('app', 'Target Amount') ?></label>
								<input type="text" class="form-control text-end" name="targetAmount" value="" id="targetAmount" <?= $isManager == 0 ? 'disabled' : '' ?>>
							</div>
							<div class="col-12  mt-15">
								<label for="exampleFormControl" class="form-label font-size-13"><strong class="red">*</strong> <?= Yii::t('app', 'Result') ?></label>
								<input type="text" class="form-control font-size-13 text-end" id="result" value="" name="result" required>
							</div>
							<div class="col-12 mt-10">
								<label class="form-label font-size-13"><?= Yii::t('app', 'Remark') ?></label>
								<textarea class="form-control font-size-13" id="remark" name="remark"></textarea>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="reset" class="btn btn-secondary" data-bs-dismiss="modal"><?= Yii::t('app', 'Cancel') ?></button>
				<button type="submit" class="btn btn-primary"><?= Yii::t('app', 'Update') ?></button>
			</div>
		</div>
	</div>
</div>