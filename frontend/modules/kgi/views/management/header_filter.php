<div class="header-pim">
	<ul class="nav nav-pills" id="pills-tab" role="tablist">
		<li class="header-item">
			<a href="<?= Yii::$app->homeUrl ?>kfi/management/index" class="nav-link text-dark" id="pills-Financial-tab" type="button" role="tab" aria-controls="pills-Financial" aria-selected="true">
				<i class="fa fa-line-chart" aria-hidden="true"></i>
				Key Financial Indicator
			</a>
		</li>
		<li class="header-item">
			<a href="<?= Yii::$app->homeUrl ?>kgi/management/index" class="nav-link text-dark active" id="pills-Group-tab" type="button" role="tab" aria-controls="pills-Group" aria-selected="false">
				<i class="fa fa-flag-o" aria-hidden="true"></i>
				Key Goal Indicator
			</a>
		</li>
		<li class="header-item">
			<a href="<?= Yii::$app->homeUrl ?>kpi/management/index" class="nav-link text-dark" id="pills-Performance-tab" type="button" role="tab" aria-controls="pills-Performance" aria-selected="false">
				<i class="fa fa-clock-o" aria-hidden="true"></i>
				Key Performance Indicator
			</a>
		</li>
		<li class="header-item">
			<a class="nav-link text-dark" id="pills-Action-tab" type="button" role="tab" aria-controls="pills-Action" aria-selected="false">
				<i class="fa fa-list-ul" aria-hidden="true"></i>
				Key Action Indicator
			</a>
		</li>
		<li class="header-item presentation-end">
			<?php
			if ($role >= 3) {
			?>
				<a href="<?= Yii::$app->homeUrl ?>kgi/management/assign-kgi" class="nav-link text-dark" id="pills-Setting-tab" type="button" role="tab" aria-controls="pills-Action" aria-selected="false">
					<i class="fa fa-cog" aria-hidden="true"></i>
					Assign
				</a>
			<?php
			}
			?>
		</li>
	</ul>
</div>