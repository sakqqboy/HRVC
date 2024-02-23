<div class="header-pim">
	<ul class="nav nav-pills" id="pills-tab" role="tablist">

		<li class="header-item">
			<a href="<?= Yii::$app->homeUrl ?>kgi/kgi-personal/individual-kgi-grid" class="nav-link text-dark" id="pills-Group-tab" type="button" role="tab" aria-controls="pills-Group" aria-selected="false">
				<i class="fa fa-flag-o" aria-hidden="true"></i>
				Key Goal Indicator
			</a>
		</li>
		<li class="header-item">
			<a href="<?= Yii::$app->homeUrl ?>kpi/kpi-personal/individual-kpi-grid" class="nav-link text-dark active" id="pills-Performance-tab" type="button" role="tab" aria-controls="pills-Performance" aria-selected="false">
				<i class="fa fa-clock-o" aria-hidden="true"></i>
				Key Performance Indicator
			</a>
		</li>
		<li class="header-item presentation-end pr-20">
			<?php
			if ($role >= 3) {
			?>
				<a href="<?= Yii::$app->homeUrl ?>kpi/management/assign-kpi" class="nav-link text-dark" id="pills-Setting-tab" type="button" role="tab" aria-controls="pills-Action" aria-selected="false">
					<i class="fa fa-cog" aria-hidden="true"></i>
					Assign and approval
				</a>
			<?php
			}
			?>
		</li>
	</ul>
</div>