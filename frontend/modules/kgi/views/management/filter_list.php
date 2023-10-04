<div class="col-12">
	<div class="input-group">
		<span class="input-group-text" style="cursor: pointer;" onclick="javascript:kgiFilter()">
			<i class="fa fa-filter" aria-hidden="true"></i></span>
		<select class="form-select font-size-13" id="company-filter">
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
		<select class="form-select font-size-13" id="branch-filter" disabled>
			<option value="">Branch</option>
		</select>
		<select class="form-select font-size-13" id="team-filter" disabled>
			<option value="">Team</option>
		</select>
		<select class="form-select font-size-13" id="month-filter">
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

		<select class="form-select font-size-13" id="status-filter">
			<option value="">Status</option>
			<option value="1">Active</option>
			<option value="4">Finished</option>
		</select>
	</div>
</div>