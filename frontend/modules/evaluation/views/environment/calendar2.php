<div class="row text-center mb-10 font-size-12 mt-10">
	<div class="title-day text-danger">Sun</div>
	<div class="title-day">Mon</div>
	<div class="title-day">Tue</div>
	<div class="title-day">Wed</div>
	<div class="title-day">Thu</div>
	<div class="title-day">Fri</div>
	<div class="title-day text-danger">Sat</div>
</div>
<div class="row">
	<div class="col-12 pt-5 pb-15">
		<?php
		if (isset($dateValue) && count($dateValue) > 0) {
			$totalCount = 0;
			$day = 1;
			foreach ($dateValue as $index => $value) :
				//throw new Exception(print_r($value, true));
				$dateArr = explode('-', $value["date"]);
				$day = (int)$dateArr[2];
				$month = $dateArr[1];
				$year = $dateArr[0];
				if (($totalCount % 7) == 0) { ?>
					<div class="row">
					<?php
				}
					?>
					<div class="day-box text-center mt-5 mouse-day pr-0 pl-0" id="<?= '2' . $day . (int)$month . $year ?>" onclick="javascript:selectDate(2,<?= $day ?>,<?= (int)$month ?>,<?= $year ?>)">
						<?= $day ?>
					</div>
					<?php
					$totalCount++;
					if (($totalCount % 7) == 0) { ?>
					</div>
		<?php
					}
				endforeach;
			}
		?>
	</div>
</div>