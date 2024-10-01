<?php

use common\models\ModelMaster;
use frontend\models\hrvc\Branch;
use frontend\models\hrvc\Company;
use frontend\models\hrvc\Team;

?>
<div class="row">
	<div class="col-1 pr-10 text-end">
		<span>
			<img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/FilterPlus.png" class="pim-search-icon" style="cursor: pointer;" onclick="javascript:kfiFilter()">
		</span>
	</div>
	<div class="col-3 pr-5 pl-1">
		<select class="form-select font-size-12 select-pim" id="company-filter">
			<?php
			if (isset($companyId) && $companyId != "") { ?>
				<option value="<?= $companyId ?>"><?= Company::companyName($companyId) ?></option>
			<?php
			}
			?>
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
		<select class="form-select font-size-12 select-pim" id="branch-filter" <?= $companyId == "" ? 'disabled' : '' ?>>
			<?php
			if (isset($branchId) && $branchId != "") { ?>
				<option value="<?= $branchId ?>"><?= Branch::branchName($branchId) ?></option>
			<?php
			}
			?>
			<option value="">Branch</option>
			<?php
			if (isset($branches) && count($branches) > 0) {
				foreach ($branches as $branch) : ?>
					<option value="<?= $branch['branchId'] ?>"><?= $branch['branchName'] ?></option>
			<?php
				endforeach;
			}
			?>

		</select>
	</div>
	<div class="col-2 pr-5 pl-1">
		<select class="form-select font-size-12 select-pim" id="month-filter">
			<?php
			if (isset($month) && $month != "") { ?>
				<option value="<?= $month ?>"><?= ModelMaster::monthFull()[$month] ?></option>
			<?php
			}
			?>
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
			<?php
			if (isset($yearSelected) && $yearSelected != "") { ?>
				<option value="<?= $yearSelected ?>"><?= $yearSelected ?></option>
			<?php
			}
			?>
			<option value="">Year</option>
			<?php
			$year = 2022;
			$i = 1;
			while ($i < 20) {
				if ($year != $yearSelected) {
			?>
					<option value="<?= $year ?>"><?= $year ?></option>
			<?php
				}
				$year += 1;
				$i++;
			}
			?>
		</select>
	</div>
	<div class="col-2 pr-1 pl-1">
		<select class="form-select font-size-12 select-pim" id="status-filter">
			<?php
			if (isset($status) && $status != "") { ?>
				<option value="<?= $status ?>"><?= $status == 1 ? "Active" : "Finished" ?></option>
			<?php
			}
			?>
			<option value="">Status</option>
			<option value="1">Active</option>
			<option value="2">Finished</option>
		</select>
	</div>
</div>