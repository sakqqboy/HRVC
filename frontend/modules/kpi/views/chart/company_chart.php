<?php

use common\models\ModelMaster;
use yii\bootstrap5\ActiveForm;

$this->title = 'Company KPI Chart';
?>
<script src="https://code.highcharts.com/highcharts.js"></script>
<div class="col-12">
	<div class="col-12">
		<img src="<?= Yii::$app->homeUrl ?>images/icons/black-icons/FinancialSystem/Vector.png" class="home-icon mr-5" style="margin-top: -3px;">
		<strong class="pim-head-text"> <?= Yii::t('app', 'Performance Indicator Matrices (PIM)') ?></strong>
	</div>
	<div class="col-12 mt-10">
		<?= $this->render('header_filter', [
			"role" => $role
		]) ?>
		<div class="alert  mt-10 pim-body bg-white">
			<div class="col-12">
				<div class="row">
					<div class="col-6 font-size-12 pim-name pr-0 pl-5 text-start">
						<a href="<?= Yii::$app->homeUrl ?>kpi/management/grid" class="mr-5 font-size-12">
							<i class="fa fa-caret-left mr-3" aria-hidden="true"></i>
							<?= Yii::t('app', 'Back') ?>
						</a>
						<span class="">
							<?= $kpiDetail["kpiName"] ?>
						</span>
					</div>
					<div class="col-6 text-end">

					</div>
				</div>

			</div>
			<div class="row">
				<div id="container" style="width:100%; height:100%;"></div>
				<script>
					Highcharts.chart('container', {
						chart: {
							type: 'line' // Base chart type
						},
						title: {
							text: 'Trend Chart',
							align: 'left',
							x: 20,
							style: {
								fontSize: '14px'
							}

						},
						xAxis: {
							categories: [<?= $month ?>]
						},
						yAxis: {
							title: {
								text: 'Amount'
							},
							min: 0
						},
						series: [{
								type: 'line', // Line chart for this series
								name: 'Actual',
								data: [<?= $result ?>],
								color: '#FFA800',
								lineWidth: 1,
								marker: {
									radius: 2 // Minimize the marker size for area chart too
								}
							},
							{
								type: 'area', // Area chart for this series
								name: 'Target',
								data: [<?= $target ?>],
								color: '#FFCA31',
								fillOpacity: 0.3,
								lineWidth: 0,
								marker: {
									radius: 2 // Minimize the marker size for area chart too
								}
							},
						]
					});
				</script>
			</div>
		</div>
	</div>
</div>