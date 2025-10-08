<?php
$show = 0;
if (isset($kgiHistoryEmployee) && count($kgiHistoryEmployee) > 0) {
	if ($role >= 5) {
		$show = 1;
	}
	foreach ($kgiHistoryEmployee as $kt):
		if ($kt["teamId"] == $teamId) {
			$show = 1;
		}
?>
		<li class="schedule-item mb-8" role="button" tabindex="0">
			<div class="row" style="display: flex; justify-content: space-between; align-items: center;">
				<div class="col-5 pl-0" style="display: flex; gap: 16px; align-items: center;">
					<div style="display: flex; justify-content: center; align-items: center;">
						<div class="col-5">
							<img src="<?= Yii::$app->homeUrl ?><?= $kt['picture'] ?>" class="width-ehsan-small" id="picture-history">
						</div>
					</div>
					<div style="display: flex; justify-content: center; align-items: center;">
						<span class="text-black text-truncate" title="<?= $kt['creater'] ?>" id="creater-history" style="font-size: 14px; font-weight: 500;width:125px;">
							<?= $kt["creater"] ?>
						</span>
					</div>
				</div>
				<div class="col-3">
					<div style="display: flex; justify-content: center;
					 align-items: center; background-color: rgb(215, 235, 255); border: 0.795px solid #2580D3; border-radius: 36px; padding: 3px 5px; z-index: 1;">
						<div style="display: flex; justify-content: start; align-items: center;width:100%;">
							<div class="pim-pic-info">
								<img src="<?= Yii::$app->homeUrl ?>image/teams.svg" alt="icon">
							</div>
							<div class="text-black pl-5 flex-grow-1 text-truncate" id="teamName-history" style="font-size: 12px; font-weight: 400;">
								<?= $kt["teamName"] ?>
							</div>
						</div>
					</div>
				</div>
				<div class="col-4" style="display: flex; flex-direction: column; text-align: right;padding-right: 8px;">
					<div>
						<span class="text-gray" id="target-history" style="font-size: 14px; font-weight: 400;">

							<?= number_format($kt["target"], 2) ?>
						</span>
						<span class="text-blue" id="result-history" style="font-size: 14px; font-weight: 500;">
							/<?= number_format($kt["result"], 2) ?>
						</span>
					</div>
					<span class="text-gray" id="createDate-history" style="font-size: 12px; font-weight: 400;">
						<?= $kt["createDateTime"] ?>
					</span>
				</div>
			</div>
		</li>
	<?php
	endforeach;
} else { ?>
	<li class="schedule-item mb-8" role="button" tabindex="0">
		<div class="row" style="display: flex; justify-content: center; align-items: center; height:45px;">No data</div>
	</li>
<?php
}
?>