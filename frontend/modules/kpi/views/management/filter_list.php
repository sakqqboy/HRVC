<div class="row">
	<div class="col-1 pr-10 text-end">
		<span>
			<img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/FilterPlus.png" class="pim-search-icon" style="cursor: pointer;" onclick="javascript:kpiFilter()">
		</span>
	</div>
	<div class="col-3 pr-5 pl-1">
		<select class="form-select font-size-12 select-pim" id="company-filter">
			<option value="">Company</option>
			<?php
			if (isset($companies) && count($companies) > 0) {
				foreach ($companies as $company) : ?>
					<option value="<?= $company['companyId'] ?>"><?= $company['companyName'] ?></option>
			<?php
				endforeach;
			}
			?>
		</select>
	</div>
	<div class="col-2 pr-5 pl-1">
		<select class="form-select font-size-12 select-pim" id="branch-filter" disabled>
			<option value="">Branch</option>
		</select>
	</div>
	<!-- <select class="form-select font-size-13" id="team-filter" disabled>
			<option value="">Team</option>
		</select> -->
	<div class="col-2 pr-5 pl-1">
		<select class="form-select font-size-12  select-pim" id="month-filter">
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
	<div class="col-2 pr-5 pl-1">
		<select class="form-select font-size-12 select-pim" id="year-filter">

			<option value="">Year</option>
			<?php
			$year = 2022;
			$i = 1;
			while ($i < 20) {
			?>
				<option value="<?= $year ?>"><?= $year ?></option>
			<?php
				$year += 1;
				$i++;
			}
			?>
		</select>
	</div>
	<div class="col-2 pr-1 pl-1">
		<select class="font-size-12 select-pim form-select" id="status-filter">
			<option value="">Status</option>
			<option value="1">Active</option>
			<option value="2">Finished</option>
		</select>
	</div>
	<!-- </div> -->
</div>