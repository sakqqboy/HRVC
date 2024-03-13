<table class="mt-10 table">
	<thead>
		<tr class="frame-table-header">
			<th style="border-top-left-radius:5px;border-bottom-left-radius:5px;">NAME</th>
			<th class="text-center">TIMELINE</th>
			<th class="text-center">ATTRIBUTE</th>
			<th class="text-center">TERM</th>
			<th class="text-center">MID</th>
			<th class="text-center">BONUS</th>
			<th class="text-center">SET EVALUATOR</th>
			<th class="text-center">PRGRESS</th>
			<th style="border-top-right-radius:5px;border-bottom-right-radius:5px;" class="text-center">ACTION</th>
		</tr>
	</thead>
	<tbody>
		<?php

		use common\models\ModelMaster;

		if (isset($data) && count($data) > 0) {
			foreach ($data as $frameId => $frame) :
				if ($frame["status"] == 1) {
					$class = 'border-left-primary';
				}
				if ($frame["status"] == 2) {
					$class = 'border-left-warning';
				}
				if ($frame["status"] == 3) {
					$class = 'border-left-danger';
				}
		?>
				<tr style="height: 5px;">
				</tr>
				<tr class="frame-table-tr" id="frame-<?= $frameId ?>">
					<td class="pt-10 pb-0 pl-0">
						<div class="<?= $class ?> col-12 pl-10 pt-12"><?= $frame["frameName"] ?></div>
					</td>
					<td class="border-left text-center td-frame" style="padding-top: 13px;"><?= $frame["timeLine"] ?></td>
					<td class="border-left text-center td-frame" style="padding-top: 13px;"><?= $frame["attribute"] ?></td>
					<td class="border-left text-center td-frame" style="padding-top: 13px;"><?= $frame["term"] ?></td>
					<td class="border-left text-center td-frame" style="padding-top: 12px;">
						<?php
						if ($frame["mid"] == 1) { ?>
							<i class="fa fa-check-circle text-primary  font-size-18" aria-hidden="true"></i>
						<?php
						} else { ?>
							<i class="fa fa-times-circle text-danger  font-size-18" aria-hidden="true"></i>
						<?php
						}
						?>
					</td>
					<td class="border-left text-center" style="padding-top: 12px;">
						<?php
						if ($frame["bonus"] == 1) { ?>
							<i class="fa fa-check-circle text-primary  font-size-18" aria-hidden="true"></i>
						<?php
						} else { ?>
							<i class="fa fa-times-circle text-danger  font-size-18" aria-hidden="true"></i>
						<?php
						}
						?>
					</td>
					<td class="border-left text-center"></td>
					<td class="border-left text-center"></td>
					<td class="border-left text-center">
						<div class="row pl-30 pr-20">
							<div class="col-9 border pt-5 bg-white">
								<a href="<?= Yii::$app->homeUrl ?>evaluation/environment/frame-setting/<?= ModelMaster::encodeParams(['frameId' => $frameId]) ?>" class="no-underline text-primary">
									<i class="fa fa-cog mr-5" aria-hidden="true"></i> Config
								</a>
							</div>
							<div class="col-3">
								<a href="javascript:deleteFrame(<?= $frameId ?>)" class="btn btn-sm btn-outline-danger font-size-10">
									<i class="fa fa-trash" aria-hidden="true"></i>
								</a>
							</div>
						</div>
					</td>
				</tr>

			<?php
			endforeach;
		} else {
			?>
			<tr class="frame-table-tr">
				<td colspan="9">Not set yet</td>
			</tr>
		<?php
		}
		?>
	</tbody>
</table>