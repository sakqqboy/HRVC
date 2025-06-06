<div class="row">

    <div class="col-2 pr-5 pl-1">
        <select class="form-select font-size-12 select-pim" id="company-filter" onchange="applySelectStyle(this)">
            <option value=""><?= Yii::t('app', 'Company') ?></option>
            <?php
            if (isset($companies) && count($companies) > 0) {
                foreach ($companies as $company) :
                    if ($role <= 4) {
                        if ($companyId == $company["companyId"]) {
            ?>
                            <option value="<?= $company['companyId'] ?>"><?= $company['companyName'] ?></option>
                        <?php
                        }
                    } else { ?>
                        <option value="<?= $company['companyId'] ?>"><?= $company['companyName'] ?></option>
                    <?php
                    }
                    ?>

            <?php
                endforeach;
            }
            ?>
        </select>
    </div>
    <div class="col-2 pr-5 pl-1">
        <select class="form-select font-size-12 select-pim" id="branch-filter" onchange="applySelectStyle(this)"
            disabled>
            <option value=""><?= Yii::t('app', 'Branch') ?></option>
        </select>
    </div>
    <!-- <select class="form-select font-size-13" id="team-filter" disabled>
			<option value="">Team</option>
		</select> -->
    <div class="col-2 pr-5 pl-1">
        <select class="form-select font-size-12  select-pim" id="month-filter" onchange="applySelectStyle(this)">
            <option value=""><?= Yii::t('app', 'Month') ?></option>
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
    <div class="col-2 pr-5 pl-1">
        <select class="form-select font-size-12 select-pim" id="year-filter" onchange="applySelectStyle(this)">

            <option value=""><?= Yii::t('app', 'Year') ?></option>
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
        <select class="font-size-12 select-pim form-select" id="status-filter" onchange="applySelectStyle(this)">
            <option value=""><?= Yii::t('app', 'Status') ?></option>
            <option value="1"><?= Yii::t('app', 'In Progress') ?></option>
            <option value="3"><?= Yii::t('app', 'Due Passed') ?></option>
            <option value="4"><?= Yii::t('app', 'Not Set') ?></option>
            <option value="2"><?= Yii::t('app', 'Completed') ?></option>
        </select>
    </div>
    <!-- </div> -->

    <div class="col-2 pr-0 text-start">
        <span class="btn font-size-12 justify-content-center d-flex align-items-center custom-button-select"
            onclick="javascript:kpiFilter()">
            <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/FilterWhite.svg" class="pim-search-icons me-2"
                style="cursor: pointer;">
            <?= Yii::t('app', 'Filter') ?>
        </span>
    </div>

</div>


<script>
    function applySelectStyle(selectElement) {
        if (selectElement.value) {
            selectElement.classList.remove('select-pim');
            selectElement.classList.add('select-pimselect');
        } else {
            selectElement.classList.remove('select-pimselect');
            selectElement.classList.add('select-pim');
        }
    }
</script>