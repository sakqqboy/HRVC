<div class="alert alert2-secondary2">
	<ul class="nav nav-pills " id="pills-tab" role="tablist">
		<li class="nav-item" role="presentation">
			<a href="<?= Yii::$app->homeUrl ?>kfi/management/assign-kfi" class="nav-link text-dark" id="pills-Financial-tab" type="button" role="tab" aria-controls="pills-Financial" aria-selected="true">
				<i class="fa fa-line-chart" aria-hidden="true"></i> <?= Yii::t('app', 'Key Financial Indicator') ?>
			</a>
		</li>
		<li class="nav-item" role="presentation">
			<a href="<?= Yii::$app->homeUrl ?>kgi/management/assign-kgi" class="nav-link text-dark" id="pills-Group-tab" type="button" role="tab" aria-controls="pills-Group" aria-selected="false">
				<i class="fa fa-flag-o" aria-hidden="true"></i>
				<?= Yii::t('app', 'Key Goal Indicator') ?>
			</a>
		</li>
		<li class="nav-item" role="presentation">
			<a href="<?= Yii::$app->homeUrl ?>kpi/management/assign-kpi" class="nav-link text-dark active" id="pills-Performance-tab" type="button" role="tab" aria-controls="pills-Performance" aria-selected="false">
				<i class="fa fa-clock-o" aria-hidden="true"></i>
				<?= Yii::t('app', 'Key Performance Indicator') ?>
			</a>
		</li>
		<li class="nav-item " role="presentation">
			<a class="nav-link text-dark" id="pills-Action-tab" type="button" role="tab" aria-controls="pills-Action" aria-selected="false">
				<i class="fa fa-list-ul" aria-hidden="true"></i>
				<?= Yii::t('app', 'Key Action Indicator') ?>
			</a>
		</li>
		<li class="nav-item presentation-end" role="presentation">
			<a href="<?= Yii::$app->homeUrl ?>kpi/management/grid"> <span class="pl-20 pr-20 badge bg kfi-assignpage text-end" type="submit"> KPI </span></a>
		</li>

	</ul>
</div>