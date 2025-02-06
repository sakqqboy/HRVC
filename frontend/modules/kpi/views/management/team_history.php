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
							Accounting & Outsourcing de... <!-- หรือใช้ข้อมูลอื่นจาก item -->
						</text>
					</div>
				</div>

				<!-- กลุ่มที่ชิดขวา -->
				<div style="display: flex;">
					<div>
						<div style="display: flex; gap: 6px; flex-direction: column;">
							<text class="text-end">
								<span class="text-gray" style="font-size: 18px; font-weight: 400;">
									${item.target} <!-- แสดง target -->
								</span>
								<span class="text-blue" style="font-size: 18px; font-weight: 600;">
									/${item.result} <!-- แสดง result -->
								</span>
							</text>
							<text class="text-gray text-end" style="font-size: 14px; font-weight: 400;">
								${item.createDateTime} <!-- แสดงวันที่ที่สร้าง -->
							</text>
						</div>
					</div>
				</div>
			</div>
		</li>
<?php
	endforeach;
}
?>