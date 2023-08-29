<div class="row">
	<div class="col-lg-9 col-md-6 col-12 pl-30 e-valution font-size-17">
		<i class="fa fa-tachometer" aria-hidden="true"></i> Evaluation
	</div>
	<div class="col-lg-3 col-md-6 col-12 e-valution-view">
		VIEW IN DETAILS
	</div>
</div>
<hr>
<div class="col-lg-12 col-md-12 col-12 pl-20 pr-20">
	<div class="shadow p-3 bg-body rounded">
		<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
		<canvas id="myChart" style="width: 100%;height:390px;"></canvas>
		<script>
			const xValue = ['1Q', '2Q', '3Q', '4Q', '1Q', '2Q', '3Q', '4Q', '1Q', '2Q', '3Q', '4Q', '1Q', '2Q', '3Q', '4Q', '1Q', '2Q', '3Q', '4Q'];
			const yValue = ['0', '20', '30', '40', '50', '60', '70', '80', '90', '100']

			new Chart("myChart", {
				type: "line",
				data: {
					labels: xValue,
					datasets: [{
							data: [70, 60, 70, 60, 80, 70, 60, 50, 60, 70, 80, 70, 80, 70, 60, 70, 50, 70, 50, 55],
							borderColor: "red",
							lineTension: 0,
							fill: false

						}, {
							data: [60, 70, 60, 80, 70, 60, 50, 60, 70, 80, 70, 80, 70, 60, 70, 60, 70, 50, 70, 50],
							borderColor: "orange",
							lineTension: 0,
							fill: false

						},
						{
							data: [40, 50, 40, 30, 28, 35, 45, 56, 40, 43, 60, 40, 50, 50, 59, 40, 43, 56, 50, 48],
							borderColor: "blue",
							lineTension: 0,
							fill: false

						}
					]
				},
				options: {
					legend: {
						display: false
					},
				}
			});
		</script>
	</div>
</div>