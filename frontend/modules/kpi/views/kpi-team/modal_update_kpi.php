<div class="modal fade" id="update-kpi-modal" tabindex="-1" aria-labelledby="staticBackdropLabel2" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header" style="height: 100px;margin-top:-10px">
				<h5 class="modal-title text-primary" id="staticBackdropLabel2"><i class="fa fa-magic" aria-hidden="true"></i> Edit KPI</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="col-12 font-b" style="margin-top: -35px; padding-left:20px; font-size: 16px;">
				<i class="fa fa-flag" aria-hidden="true"></i> <?= Yii::t('app', 'Key Goal Indicators') ?>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-lg-6 col-md-6 col-6 font-size-14">
						<div class="col-12">
							<label for="exampleFormControlInput1" class="form-label"><strong class="red">*</strong><?= Yii::t('app', 'KPI Contents') ?></label>
							<input type="text" class="form-control" id="kpiName-update" name="kpiName">
						</div>
						<div class="col-12 mt-10">
							<label for="input" class="form-label"><strong class="red">*</strong> <?= Yii::t('app', 'Company') ?></label>
							<select class="form-select companyId" id="companyId-update" required name="companyId" onchange="javascript:companyMultiBrachUpdate()">
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
						<div class="col-12 mt-10">
							<label for="input" class="form-label"><strong class="red">*</strong> <?= Yii::t('app', 'Team') ?></label>
							<div class="col-12 form-control">
								<?= Yii::t('app', 'Select Team') ?>
								<i class="fa fa-angle-down pull-right mt-5" aria-hidden="true"></i>
							</div>
							<div class="col-12" id="show-multi-team-update"></div>
						</div>
						<div class="col-12 mt-10">
							<label for="exampleFormControl" class="form-label font-size-13"> <?= Yii::t('app', 'Title Progress') ?></label>
							<input type="text" class="form-control font-size-13" name="historyName">
						</div>
						<div class="col-12 mt-10">
							<label for="input" class="form-label"><strong class="red">*</strong> <?= Yii::t('app', 'Check Unit') ?></label>
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
										<button type="button" id="unit-<?= $unit['unitId'] ?>" class="btn border col-3 unit-<?= $i ?>  font-size-12 <?= $default ?>" onclick="javascript:selectUnitUpdate(<?= $unit['unitId'] ?>)" style="<?= $style ?>">
											<?= Yii::t('app', $unit["unitName"]) ?>
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
						<div class="row mt-15">
							<div class="col-12 border-bottom">
								<label for="input" class="form-label">
									<strong class="red">*</strong> <?= Yii::t('app', 'Select Period') ?>
								</label>
							</div>
							<div class="col-lg-6 col-md-6 col-12 mt-10">
								<div class="input-group">
									<div class="input-group">
										<span class="input-group-text font-size-12"><i class="fa fa-calendar-o" aria-hidden="true"></i>&nbsp;<?= Yii::t('app', 'From') ?></span>
										<input type="date" aria-label="" class="form-control font-size-12" required name="fromDate" id="from-date-update">
									</div>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-12 mt-10">
								<div class="input-group">

									<div class="input-group">
										<span class="input-group-text font-size-12"><i class="fa fa-calendar-o" aria-hidden="true"></i> &nbsp;&nbsp;<?= Yii::t('app', 'To') ?></span>
										<input type="date" aria-label="" class="form-control font-size-12" required name="toDate" id="to-date-update">
									</div>
								</div>
							</div>

							<div class="col-12 mt-10">
								<div class="input-group">
									<label for="input" class="form-label"><strong class="red">*</strong> <?= Yii::t('app', 'Next Check Date') ?></label>
									<div class="input-group">
										<span class="input-group-text font-size-12">
											<i class="fa fa-calendar-o" aria-hidden="true"></i> &nbsp;&nbsp; <?= Yii::t('app', 'Date') ?></span>
										<input type="date" aria-label="" class="form-control font-size-12 " id="nextCheckDate-update" required name="nextDate">
									</div>
								</div>
							</div>
						</div>

					</div>
					<div class="col-lg-6 col-md-6 col-6">
						<div class="col-12">
							<label for="exampleFormControlTextarea1" class="form-label font-size-13"> <?= Yii::t('app', 'KGI Details') ?></label>
							<textarea class="form-control" id="detail-update" name="detail" rows="4"></textarea>
						</div>
						<div class="row">
							<div class="col-lg-6 col-md-6 col-6 pt-10">
								<label for="exampleFormControl" class="form-label font-size-13"><strong class="red">*</strong> <?= Yii::t('app', 'Quant Ratio') ?></label>
								<select class="form-select font-size-13" aria-label="Default select example" id="quantRatio-update" name="quantRatio">
									<option value=""><?= Yii::t('app', 'Quantity') ?> / <?= Yii::t('app', 'Quality') ?></option>
									<option value="1"><?= Yii::t('app', 'Quantity') ?></option>
									<option value="2"><?= Yii::t('app', 'Quality') ?></option>
								</select>
							</div>
							<div class="col-lg-6 col-md-6 col-6 pt-10">
								<label for="exampleFormControl" class="form-label font-size-13"><strong class="red">*</strong> <?= Yii::t('app', 'Priority') ?></label>
								<select class="form-select font-size-13" aria-label="Default select example" id="priority-update" name="priority">
									<option value="">A/B/C</option>
									<option value="A">A</option>
									<option value="B">B</option>
									<option value="C">C</option>
								</select>
							</div>
							<div class="col-lg-4 col-md-6 col-6 pt-10">
								<label for="exampleFormControl" class="form-label font-size-13"><strong class="red">*</strong> <?= Yii::t('app', 'Amount Type') ?></label>
								<select class="form-select font-size-13" aria-label="Default select example" name="amountType" id="amountType-update">
									<option value="">% <?= Yii::t('app', 'or') ?> <?= Yii::t('app', 'Number') ?></option>
									<option value="1">%</option>
									<option value="2"><?= Yii::t('app', 'Number') ?></option>
								</select>
							</div>
							<div class="col-lg-8 col-md-6 col-6 pt-10">
								<label for="exampleFormControl" class="form-label font-size-13"><strong class="red">*</strong> <?= Yii::t('app', 'Code<') ?>/label>
									<select class="form-select font-size-13" aria-label="Default select example" name="code" id="code-update">
										<option value="">
											<&nbsp;&nbsp;=&nbsp;&nbsp;>
										</option>
										<option value="<">&nbsp;&nbsp;<?= '<' ?>&nbsp;&nbsp;<?= Yii::t('app', 'Result more than target') ?></option>
										<option value="=">&nbsp;&nbsp;=&nbsp;&nbsp;<?= Yii::t('app', 'Result equal target') ?></option>
										<option value=">">&nbsp;&nbsp;>&nbsp;&nbsp;<?= Yii::t('app', 'Result less than target') ?></option>
									</select>
							</div>
							<div class="col-lg-4 col-md-4 col-6 pt-10">
								<label for="exampleFormControl" class="form-label font-size-13"><strong class="red">*</strong> <?= Yii::t('app', 'Status') ?></label>
								<select class="form-select font-size-13" aria-label="Default select example" name="status" id="status-update" required>

									<option value="1"><?= Yii::t('app', 'Active') ?></option>
									<option value="4"><?= Yii::t('app', 'Finished') ?></option>
								</select>
							</div>
							<div class="col-lg-4 col-md-4 col-6 pt-10">
								<label for="exampleFormControl" class="form-label font-size-13"><strong class="red">*</strong> <?= Yii::t('app', 'Month') ?></label>
								<select class="form-select font-size-13" aria-label="Default select example" name="month" id="month-update" required>
									<option value=""><?= Yii::t('app', 'Select Month') ?></option>
									<?php
									if (isset($months) && count($months) > 0) {
										foreach ($months as $value => $month) : ?>
											<option value="<?= $value ?>"><?= Yii::t('app', $month) ?></option>
									<?php
										endforeach;
									}
									?>
								</select>
							</div>
							<div class="col-lg-4 col-md-6 col-6 pt-10">
								<label class="form-label font-size-12"><strong class="red">*</strong> <?= Yii::t('app', 'Year') ?></label>
								<select class="form-select font-size-12" required name="year" id="year-update">
									<option value=""><?= Yii::t('app', 'Year') ?></option>
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
							<div class="col-12 mt-10">
								<label for="exampleFormControl" class="form-label font-size-13"><strong class="red">*</strong> <?= Yii::t('app', 'Target Amount') ?></label>
								<input type="text" class="form-control font-size-13 text-end" id="targetAmount-update" name="targetAmount" <?= $isManager == 0 ? 'disabled' : '' ?>>
							</div>
							<div class="col-12">
								<label for="exampleFormControl" class="form-label font-size-13"><strong class="red">*</strong> <?= Yii::t('app', 'Result') ?></label>
								<input type="text" class="form-control font-size-13 text-end" name="result" id="result-update">
							</div>
							<div class="col-12 mt-10">
								<label for="exampleFormControlTextarea1" class="form-label font-size-13"> <?= Yii::t('app', 'Remark') ?></label>
								<textarea class="form-control" name="remark" rows="4"></textarea>
							</div>
						</div>
					</div>
				</div>

			</div>
			<div class="modal-footer" style="border: none;">
				<button type="reset" class="btn btn-secondary" data-bs-dismiss="modal"><?= Yii::t('app', 'Cancel') ?></button>
				<a href="javascript:checkRequiredUpdateKpi()" class="btn btn-warning"><?= Yii::t('app', 'Update') ?></a>
			</div>
		</div>
	</div>
	<input type="hidden" id="kpiId" name="kpiId" value="">
</div>