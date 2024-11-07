<div class="row">
    <div class="col-2 pr-5 pl-1">
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
    <!-- <div class="col-2 pr-10 text-end">
        <span class="font-size-12 buttom-pim">
            <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/FilterPlus.png" class="pim-search-icon"
                style="cursor: pointer;" onclick="javascript:kfiFilter()">
        </span>
    </div> -->
    <!-- <div class="col-2 pr-10 text-end">
        <span class="btn btn-primary font-size-12 justify-content-center d-flex align-items-center"
            style="--bs-btn-padding-x: 2.0rem; --bs-btn-padding-y: 0.16rem; border-radius: 50px;">
            <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/FilterWhite.svg" class="pim-search-icon"
                style="cursor: pointer;" onclick="javascript:kfiFilter()">
        </span>
    </div> -->

    <div class="col-2 pr-0 text-start">
        <span class="btn btn-primary font-size-12 justify-content-center d-flex align-items-center"
            style="--bs-btn-padding-x: 2.0rem; --bs-btn-padding-y: 0.16rem; border-radius: 50px; cursor: pointer;"
            onclick="javascript:kfiFilter()">
            <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/FilterWhite.svg" class="pim-search-icons me-2"
                style="cursor: pointer;">
            Filter
        </span>
    </div>
    <!-- </div> -->
</div>