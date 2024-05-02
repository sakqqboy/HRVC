<div class="modal fade" id="evaluator-setting" tabindex="-1" aria-labelledby="exampleModalLabelAssign" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="countheader">
				<div class="row pl-10 pr-10 pt-10">
					<div class="col-1" id="exampleModalLabelAssign">
						<img src="<?= Yii::$app->homeUrl ?>image/groupProfile.jpg" class="Profiles">
					</div>
					<div class="col-9 pl-20">
						<div class="font-size-13 font-b"> AMI FARUQ </div>
						<div class="font-size-12"> Director, Gihu</div>
					</div>
					<div class="col-2 text-end font-size-13 pr-20 pt-10">
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<hr class="mt-10">
				</div>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-lg-6 col-md-6 col-12">
						<div class="col-12 font-size-13 font-b" style="margin-top: -25px;">
							Primary Evaluator
						</div>
						<div class="col-9 pl-30">
							<select class="form-select selectDefaultPrimary" aria-label="Default select example">
								<option selected value="">Select this</option>
								<option value="1">Tokyo Consulting Firm co.th</option>
								<option value="2">Tokyo Consulting Firm group</option>
								<option value="3">Tokyo Consulting Firm Limited</option>
							</select>
						</div>
						<div class="col-7 pl-30">
							<select class="form-select selectDefaultPrimary" aria-label="Default select example">
								<option selected value="">Select this</option>
								<option value="1">Branch</option>
								<option value="2">Title</option>
								<option value="3"> Employees</option>
							</select>
						</div>
						<div class="col-12 card cardPrimaryEvaluator">
							<div class="col-12 mt-10 pl-10">
								<div class="form-check">
									<input class="form-check-input Accountsborderdark" type="checkbox" value="" id="flexCheckDefault">
									<label class="form-check-label" for="flexCheckDefault">
										<img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/24px/Department.png" class="DepartmentAccounts"> Accounts
									</label>
								</div>
							</div>
							<div class="col-12">
								<?php
								for ($i = 1; $i <= 2; $i++) {
								?>
									<div class="form-check evaluatorIT">
										<input class="form-check-input Accountsborderdark" type="checkbox" value="" id="">
										<label class="form-check-label" for="">
											<img src="<?= Yii::$app->homeUrl ?>image/Watanabe.png" class="imageDepartmentIT"> Charles Bhattacharjya
										</label>
									</div>
								<?php
								}
								?>
							</div>

						</div>
					</div>
					<div class="col-lg-6 col-md-6 col-12">
						<div class="col-12 font-size-13 font-b" style="margin-top: -25px;">
							Final Evaluator
						</div>
						<div class="col-7 ml-30">
							<select class="form-select selectDefaultPrimary" aria-label="Default select example">
								<option selected value="">Select this</option>
								<option value="1">Tokyo Consulting Firm co.th</option>
								<option value="2">Tokyo Consulting Firm group</option>
								<option value="3">Tokyo Consulting Firm Limited</option>
							</select>
						</div>
						<div class="col-4 ml-30">
							<select class="form-select selectDefaultPrimary" aria-label="Default select example">
								<option selected value="">Select this</option>
								<option value="1">Branch</option>
								<option value="2">Title</option>
								<option value="3"> Employees</option>
							</select>
						</div>
						<div class="col-12 card cardPrimaryEvaluator">
							<div class="col-12 mt-10 pl-10">
								<div class="form-check">
									<input class="form-check-input Accountsborderdark" type="checkbox" value="" id="flexCheckDefault">
									<label class="form-check-label" for="flexCheckDefault">
										<img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/24px/Department.png" class="DepartmentAccounts"> Accounts
									</label>
								</div>
							</div>
							<div class="col-12">

								<?php
								for ($i = 1; $i <= 2; $i++) {
								?>

									<div class="form-check  evaluatorIT">
										<input class="form-check-input Accountsborderdark" type="checkbox" value="" id="flexCheckDefault">
										<label class="form-check-label" for="flexCheckDefault">
											<img src="<?= Yii::$app->homeUrl ?>image/Watanabe.png" class="imageDepartmentIT"> Charles Bhattacharjya
										</label>
									</div>

								<?php
								}
								?>

							</div>
							<div class="col-12 mt-10 pl-10">
								<div class="form-check">
									<input class="form-check-input Accountsborderdark" type="checkbox" value="" id="flexCheckDefault">
									<label class="form-check-label" for="flexCheckDefault">
										<img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/24px/Department.png" class="DepartmentAccounts"> IT
									</label>
								</div>
							</div>
							<div class="col-12">

								<?php
								for ($i = 1; $i <= 2; $i++) {
								?>
									<div class="form-check  evaluatorIT">
										<input class="form-check-input Accountsborderdark" type="checkbox" value="" id="flexCheckDefault">
										<label class="form-check-label" for="flexCheckDefault">
											<img src="<?= Yii::$app->homeUrl ?>image/Watanabe.png" class="imageDepartmentIT"> Charles Bhattacharjya
										</label>
									</div>

								<?php
								}
								?>

							</div>

							<div class="col-12 mt-10 pl-10">
								<div class="form-check">
									<input class="form-check-input Accountsborderdark" type="checkbox" value="" id="flexCheckDefault">
									<label class="form-check-label" for="flexCheckDefault">
										<img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/24px/Department.png" class="DepartmentAccounts"> MKT
									</label>
								</div>
							</div>
							<div class="col-12">

								<?php
								for ($i = 1; $i <= 5; $i++) {
								?>
									<div class="form-check  evaluatorIT">
										<input class="form-check-input Accountsborderdark" type="checkbox" value="" id="flexCheckDefault">
										<label class="form-check-label" for="flexCheckDefault">
											<img src="<?= Yii::$app->homeUrl ?>image/Watanabe.png" class="imageDepartmentIT"> Charles Bhattacharjya
										</label>
									</div>

								<?php
								}
								?>

							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-12 text-end pr-10 pb-10">
				<div type="submit" class="btn btn-primary SET" data-bs-dismiss="modal" aria-label="submit">SET</div>
			</div>
		</div>
	</div>
</div>