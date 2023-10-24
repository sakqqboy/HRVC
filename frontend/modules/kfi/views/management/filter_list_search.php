<?php

use common\models\ModelMaster;
use frontend\models\hrvc\Branch;
use frontend\models\hrvc\Company;
use frontend\models\hrvc\Team;

?>
<div class="col-12">
	<div class="input-group">
		<span class="input-group-text" style="cursor: pointer;" onclick="javascript:kfiFilter()">
			<i class="fa fa-filter" aria-hidden="true"></i></span>
		<select class="form-select font-size-13" id="company-filter">
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
		<select class="form-select font-size-13" id="branch-filter" <?= $companyId == "" ? 'disabled' : '' ?>>
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

		<select class="form-select font-size-13" id="month-filter">
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
		<select class="form-select font-size-13" id="year-filter">
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
		<select class="form-select font-size-13" id="status-filter">
			<?php
			if (isset($status) && $status != "") { ?>
				<option value="<?= $status ?>"><?= $status == 1 ? "Active" : "Finished" ?></option>
			<?php
			}
			?>
			<option value="">Status</option>
			<option value="1">Active</option>
			<option value="4">Finished</option>
		</select>
	</div>
</div>