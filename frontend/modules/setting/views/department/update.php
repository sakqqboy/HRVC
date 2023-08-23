<div class="card" style="border: none;border-radius:10px;">
	<div class="card-body">
		<div class="col-12 txt-bold">
			<?= $departmentName ?>
		</div>
		<div class="row">
			<div class="col-8 department-tokyo">
				<?= $companyName ?>
			</div>
			<div class="col-4 text-end pr-0">
				<a href="javascript:updateDepartment(<?= $departmentId + 543 ?>)" class="btn btn-sm btn-outline-dark mr-5 font-size-12"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> </a>
				<a href="javascript:deleteDepartment(<?= $departmentId + 543 ?>)" class="btn btn-sm btn-outline-danger font-size-12"><i class="fa fa-trash" aria-hidden="true"></i> </a>
			</div>
			<div class="col-12 bangladresh-hrvc2 mt-10">
				Branch : <img src="<?= Yii::$app->homeUrl ?><?= $flag ?>" class="bangladresh-hrvc1 ml-5 mr-5">
				<?= $branchName ?>
			</div>
		</div>
		<div class="row mt-10">
			<div class="col-5 show-height text-center font-b" style="padding-top:23%;">
				<a href="javascript:showTitleList(<?= $departmentId + 543 ?>)" class="no-underline-black">
					<i class="fa fa-plus-circle" aria-hidden="true"></i> Title
				</a>
				<div class="title-list text-start" id="title-list-<?= $departmentId + 543 ?>">

				</div>
			</div>
			<div class="col-7 department-sizesmall" id="title-department-<?= $departmentId + 543 ?>">
				<?php
				if (isset($titleDepartments) && count($titleDepartments) > 0) {
					foreach ($titleDepartments as $dpm2) : ?>
						<div class="col-12 mt-5">
							<?= $dpm2["titleName"] ?>
						</div>
				<?php
					endforeach;
				}
				?>
			</div>
		</div>
	</div>
</div>