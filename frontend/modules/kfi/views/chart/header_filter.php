<div class="alert alert-white-4">
	<div class="row header-filter-pim">
		<div class="col-10 pt-13 pb-5 pl-0">
			<div class="row">
				<div class="col-3 border-right text-center">
					<a href="<?= Yii::$app->homeUrl ?>kfi/management/grid" class="header-kfi-active">
						<span>
							<img src="<?= Yii::$app->homeUrl ?>images/icons/black-icons/FinancialSystem/Group289864.png" class="home-icon mr-5">
						</span>
						<?= Yii::t('app', 'Key Financial Indicator)') ?>
					</a>
				</div>
				<div class="col-3 border-right text-center">
					<a href="<?= Yii::$app->homeUrl ?>kgi/management/grid" class="header-kfi">
						<span>
							<img src="<?= Yii::$app->homeUrl ?>images/icons/black-icons/FinancialSystem/Vector-1.png" class="home-icon mr-5">
						</span>
						<?= Yii::t('app', 'Key Goal Indicator') ?>
					</a>
				</div>
				<div class="col-3 text-center">
					<a href="<?= Yii::$app->homeUrl ?>kpi/management/grid" class="header-kfi">
						<span>
							<img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/KPI.png" class="home-icon mr-5">
						</span>
						<?= Yii::t('app', 'Key Performance Indicator') ?>
					</a>
				</div>
			</div>
		</div>
		<div class="col-2 text-end">
			<div class="col-12 pt-13">
				<?php
				//	if ($role >= 3) {
				?>
				<!-- <a href="<?php // Yii::$app->homeUrl 
						?>kgi/management/assign-kgi" class="nav-link text-dark" id="pills-Setting-tab" type="button" role="tab" aria-controls="pills-Action" aria-selected="false">
						<i class="fa fa-cog" aria-hidden="true"></i>
						<?= Yii::t('app', 'Assign and approval') ?>
					</a> -->
				<?php
				//	}
				?>
			</div>
		</div>
	</div>
</div>