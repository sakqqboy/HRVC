<?php
if (isset($kgiHistoryTeam) && count($kgiHistoryTeam) > 0) {
	foreach ($kgiHistoryTeam as $kht):
?>
		<li class="schedule-item mt-5" role="button" tabindex="0">
			<div style="display: flex; justify-content: space-between; align-items: center; width: 100%;">
				<!-- กลุ่มที่ชิดซ้าย -->
				<div style="display: flex; gap: 16px;">
					<div style="display: flex; justify-content: center; align-items: center;">
						<div class="cycle-current">
							<img src="<?= Yii::$app->homeUrl ?>image/teams.svg" alt="icon">
						</div>
					</div>
					<div style="display: flex; gap: 6px; flex-direction: column;">
						<text class="text-black" style="font-size: 16px; font-weight: 600;">
							<?= $kht["teamName"] ?>
						</text>
						<text class="text-gray" style="font-size: 14px; font-weight: 400;">
							<?= $kht["departmentName"] ?>
						</text>
					</div>
				</div>

				<!-- กลุ่มที่ชิดขวา -->
				<div style="display: flex;">
					<div>
						<div style="display: flex; gap: 6px; flex-direction: column;">
							<text class="text-end">
								<span class="text-gray" style="font-size: 18px; font-weight: 400;">
									<?= number_format($kht["target"], 2) ?>
								</span>
								<span class="text-blue" style="font-size: 18px; font-weight: 600;">
									/<?= number_format($kht["result"], 2) ?>
								</span>
							</text>
							<text class="text-gray text-end" style="font-size: 14px; font-weight: 400;">
								<?= $kht["createDateTime"] ?>
							</text>
						</div>
					</div>
				</div>
			</div>
		</li>
	<?php
	endforeach;
} else { ?>
	<li class="schedule-item mt-5" role="button" tabindex="0">
		<div class="col-12 text-center font-size-16">No data</div>
	</li>
<?php
}
?>