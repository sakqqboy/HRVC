<li class="schedule-item mt-5" role="button" tabindex="0">
	<div style="display: flex; justify-content: space-between; align-items: center; width: 100%;">
		<div style="display: flex; gap: 16px; align-items: center;">
			<div style="display: flex; justify-content: center; align-items: center;">
				<div class="col-5">
					<img src="<?= Yii::$app->homeUrl ?>${item.picture}" class="width-ehsan-small" id="picture-history">
				</div>
			</div>
			<div style="display: flex; justify-content: center; align-items: center;">
				<span class="text-black" id="creater-history" style="font-size: 16px; font-weight: 500;">
					${item.creater}
				</span>
			</div>
		</div>

		<div style="display: flex; justify-content: center; align-items: center; background-color: rgb(215, 235, 255); border: 0.795px solid #2580D3; border-radius: 36px; padding: 3px 20px; z-index: 1;">
			<div style="display: flex; justify-content: center; align-items: center; gap: 8px;">
				<div class="cycle-current">
					<img src="<?= Yii::$app->homeUrl ?>image/teams.svg" alt="icon">
				</div>
				<span class="text-black" id="teamName-history" style="font-size: 16px; font-weight: 500;">
					${item.teamName}
				</span>
			</div>
		</div>

		<div style="display: flex; flex-direction: column; text-align: right;">
			<div>
				<span class="text-gray" id="target-history" style="font-size: 18px; font-weight: 400;">
					${item.target}
				</span>
				<span class="text-blue" id="result-history" style="font-size: 18px; font-weight: 600;">
					/${item.result}
				</span>
			</div>
			<span class="text-gray" id="createDate-history" style="font-size: 14px; font-weight: 400;">
				${item.createDateTime}
			</span>
		</div>
	</div>
</li>