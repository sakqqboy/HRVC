<?php
$this->title = 'Evaluation';
?>
<div class="col-12 mt-70 ">
	<div class="row">
		<div class="col-6">
			<div class="row">
				<div class="col-5 text-start font-b font-size-18 pt-5">Evaluation Environment</div>
				<div class="col-7">
					<a href="" class="btn btn-primary but_createeva">
						<img src="<?= Yii::$app->homeUrl ?>images/icons/Light/Light/24px/Create(Big).png" class="lightCreate">
						<span class="font-size-12"> Create</span>
					</a>
				</div>
			</div>
		</div>
		<div class="col-6 ">
			<div class="row">
				<div class="col-6 text-end pr-0">
					<select class="form-select example-Dha" aria-label="Default select example">
						<option selected value="">Company</option>
						<option value="1">Tokyo Consulting Firm Limited</option>
						<option value="2">Tokyo Consulting Firm Limited</option>
						<option value="3">Tokyo Consulting Firm Limited</option>
					</select>
				</div>
				<div class="col-5 text-end  pr-0">
					<select class="form-select example-Dha" aria-label="Default select example">
						<option selected value="">Branch</option>
						<option value="1">Dhaka, BD</option>
						<option value="2">Dhaka, BD</option>
						<option value="3">Dhaka, BD</option>
					</select>
				</div>
				<div class="col-1">
					<img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/FilterPlus.png" class="imagesFilterPlus">
				</div>
			</div>
		</div>
	</div>
	<?php
	for ($i = 1; $i <= 10; $i++) {
	?>
		<div class="col-12 mt-15 environment ">
			<div class="row">
				<div class="col-1 text-center pt-5">
					<img src="<?= Yii::$app->homeUrl ?>image/Maskgroup.png" class="imageslogoMaskTCF">
				</div>
				<div class="col-3 namelogoMask">
					<div class="col-12 collapseTokyo">
						Tokyo Consulting Firm Pvt. Ltd
					</div>
					<div class="col-12 font-size-12">
						<img src="/HRVC/frontend/web/image/Flag-Turkey.png" class="imageEvaluatorcountry1"> Izmir, Turkey
					</div>
				</div>
				<div class="col-3 pt-5 pb-5">
					<div class="row">
						<div class="col-2 halfleft pt-13 pb-8 text-center pr-0 pl-0">
							Frames
						</div>
						<div class="col-4 bg-white pt-8 pb-5 pr-0">
							<div class="row">
								<div class="col-6 font-size-10 text-secondary pt-3 mt-3">
									TOTAL<br>
									<div>&nbsp; </div>
								</div>
								<div class="col-6 number-circle text-center pt-3 pr-0 pl-0 font-b mt-3">
									20
								</div>
							</div>

						</div>

						<div class="col-5 borderscan bg-white pt-11 pb-8 border-left pr-5 pl-5">
							<div class="col-12 pt-0 pb-3 text-center bg-light text-primary" style="box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;cursor:pointer;">
								<img src="<?= Yii::$app->homeUrl ?>image/scan.png" class="imagescan mr-5">
								<span class="font-size-10"> Create Frame</span>
							</div>
						</div>
					</div>
				</div>
				<div class="col-3 pt-5 pb-5">
					<div class="row">
						<div class="col-2 halfleft pt-13 pb-8 text-center pr-0 pl-0">
							Salary
						</div>
						<div class="col-5 bg-white pt-8 pb-8 pr-0">
							<div class="row">
								<div class="col-7 font-size-10 text-secondary pt-3">
									TOTAL REGISTERED
								</div>
								<div class="col-5 number-circle text-center pt-3 pr-0 pl-0 mt-3 font-b">
									9
								</div>
							</div>
						</div>

						<div class="col-5 borderscan bg-white pt-11 pb-8 border-left pr-5 pl-5">
							<div class="col-12 pt-0 pb-3 text-center bg-light text-primary" style="box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;cursor:pointer;">
								<img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Salary.png" class="imagescan mr-5">
								<span class="font-size-10">Register salary</span>
							</div>
						</div>
					</div>
				</div>
				<div class="col-1 pl-3 pr-3 text-center pt-13">
					<a href="" class="btn-outline-secondary btn font-size-12 pl-0 pr-0" style="width:30px;height:30px;">
						<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
					</a>
					<a href="" class="btn-outline-danger btn font-size-12 pl-0 pr-0 ml-8" style="width:30px;height:30px;">
						<i class="fa fa-trash" aria-hidden="true"></i>
					</a>
				</div>
				<div class="col-1 border-left text-center pt-13">
					<a href="" class="btn-primary btn font-size-12 pl-0 pr-0" style="width:35px;height:35px;display:none;">
						<i class="fa fa-chevron-up" aria-hidden="true"></i>
					</a>
					<a href="" class="btn-primary btn font-size-12 pl-0 pr-0" style="width:35px;height:35px;">
						<i class="fa fa-chevron-down" aria-hidden="true"></i>
					</a>
				</div>
			</div>
		</div>
	<?php
	}
	?>
</div>