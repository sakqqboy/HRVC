<?php

use common\models\ModelMaster;

$this->title = 'company profile';
?>

<div class="col-12" style="margin-top: 60px;">
	<div class="col-12" style="height: 180px;background-color:gray;">
		<?php
		if ($company["banner"] != null) { ?>
			<img src="<?= Yii::$app->homeUrl . $company['banner'] ?>" class="sad-1">
		<?php
		} else { ?>
			<img src="<?= Yii::$app->homeUrl . 'image/company.jpg' ?>" class="sad-1">
		<?php
		}
		?>
	</div>
	<!-- <div class="col-12 edit-update">
		<button type="button" class="btn btn-light"> <i class="fa fa-pencil" aria-hidden="true"></i> Update</button>
	</div> -->
	<div class="row">
		<div class="col-lg-2 col-md-5 col-12" style="margin-top:-100px;">
			<div class="avatar-upload" style="margin-left:20px;">
				<div class="avatar-preview">
					<?php
					if ($company["picture"] != null) { ?>
						<img src="<?= Yii::$app->homeUrl . $company['picture'] ?>" class="company-group-picture">
					<?php
					} else { ?>
						<img src="<?= Yii::$app->homeUrl . 'image/userProfile.png' ?>" class="company-group-picture">
					<?php
					}
					?>
				</div>
			</div>
		</div>
		<div class="col-lg-5 col-md-6 col-12">
			<div class="col-12 name-tokyo pl-30">
				<?= $company["companyName"] ?>
				<?php
				if ($company["headQuaterId"] == null) { ?>
					<span style="font-size: 11px;font-weight:100">(Head Quater)</span>
				<?php

				}
				?>
			</div>
			<!-- <div class="col-12 tokyo-small pl-30">
				<?php // $company['tagLine'] 
				?>
			</div> -->
		</div>
		<div class="col-lg-5 col-md-6 col-12 tcg-edit0 mt-40">
			<span class="tcg-edit"><?= $company['displayName'] ?> </span>
			<!-- <button type="button" class="btn btn-success"><i class="fa fa-th-large" aria-hidden="true"></i> Create</button> -->
			<a href="<?= Yii::$app->homeUrl ?>setting/company/update-company/<?= ModelMaster::encodeParams(['companyId' => $company['companyId']]) ?>" class="btn btn-primary  ml-10" style="margin-top: -20px;"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</a>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-6 col-md-6 col-12 in-for">
			<div class="col-12 Group-Information">
				Group Information
			</div>
			<div class="row mt-20">
				<div class="col-lg-6 col-md-6 col-12 name-head">
					Headquarter
				</div>
				<div class="col-lg-6 col-md-6 col-12 name-head0">
					<i class="fa fa-map-marker location" aria-hidden="true"></i> <span class="text-primary address-box">Shinjuku-ku, Tokyo</span>
				</div>
				<div class="col-lg-6 col-md-6 col-12 name-head mt-10">
					Address
				</div>
				<div class="col-lg-6 col-md-6 col-12 name-head0 mt-10" style="word-wrap: break-word;">
					<div class="address-box"><?= $company["location"] ?>
					</div>
				</div>
				<div class="col-lg-6 col-md-6 col-12 name-head mt-10">
					Established
				</div>
				<div class="col-lg-6 col-md-6 col-12 name-head0 mt-10">
					<?= $company["founded"] ?>
				</div>
				<div class="col-lg-6 col-md-6 col-12 name-head mt-10">
					Company/Director
				</div>
				<div class="col-lg-6 col-md-6 col-12 name-head0 mt-10">
					<?= $company["director"] ?>
				</div>
				<hr class="mt-20">
			</div>
			<div class="col-12 Group-Information">
				Contact Information
			</div>
			<div class="row mt-30">
				<div class="col-lg-6 col-md-6 col-12  name-head">
					Email
				</div>
				<div class="col-lg-6 col-md-6 col-12 name-head0">
					<span class="text-primary address-box0"><?= $company["email"] ?></span>
					<i class="fa fa-clipboard clipboard0" aria-hidden="true"></i>
				</div>
				<div class="col-lg-6 col-md-6 col-12 name-head mt-10">
					Contact

				</div>
				<div class="col-lg-6 col-md-6 col-12 name-head0 mt-10">
					<?= $company["contact"] ?>
					<i class="fa fa-clipboard clipboard0" aria-hidden="true"></i>
				</div>
				<div class="col-lg-6 col-md-6 col-12 name-head mt-10">
					Website
				</div>
				<div class="col-lg-6 col-md-6 col-12 name-head0 mt-10">
					<span class="text-primary address-box0"><?= $company["website"] ?></span> <i class="fa fa-clipboard clipboard0" aria-hidden="true"></i>
				</div>
			</div>
		</div>
		<div class="col-lg-6 col-md-6 col-12 box-about-company1">
			<div class="col-12 ABOUT-NAME">
				ABOUT
			</div>
			<div class="col-12 detail-tokyo mt-10">
				<?= $company["about"] ?>

			</div>
			<div class="col-12 mt-10">
				<p>Social Tag <span class="facebook"> <?= $company["socialTag"] ?></span> </p>
			</div>
		</div>
	</div>
	<hr>
	<div class="row">
		<div class="col-lg-3 col-md-6 col-6">
			<a href="<?= Yii::$app->homeUrl ?>setting/employee/index/<?= ModelMaster::encodeParams(['companyId' => $company['companyId']]) ?>" class="no-underline-black">
				<div class="alert alert-secondary-background" role="alert">
					<div class="row">
						<div class="col-4">
							<i class="fa fa-users" aria-hidden="true" style="font-size: 32px;padding-top: 15px;"></i>
						</div>
						<div class="col-2">
							<div class="col-12 text-primary">
								Employees
							</div>
							<div class="col-2 number-bold">
								<?= $totalEmployee ?>
							</div>
						</div>
					</div>
				</div>
			</a>
		</div>
		<div class="col-lg-3 col-md-6 col-6">
			<a href="<?= Yii::$app->homeUrl ?>setting/branch/create/<?= ModelMaster::encodeParams(['companyId' => $company['companyId']]) ?>" class="no-underline-black">
				<div class="alert alert-secondary-background" role="alert">
					<div class="row">
						<div class="col-4">
							<i class="fa fa-users" aria-hidden="true" style="font-size: 32px;padding-top: 15px;"></i>
						</div>
						<div class="col-2">
							<div class="col-12 text-primary">
								Branch
							</div>
							<div class="col-2 number-bold">
								<?= $totalBranch ?>
							</div>
						</div>
					</div>
				</div>
			</a>
		</div>
		<div class="col-lg-3 col-md-6 col-6">
			<a href="<?= Yii::$app->homeUrl ?>setting/department/create/<?= ModelMaster::encodeParams(['companyId' => $company['companyId']]) ?>" class="no-underline-black">
				<div class="alert alert-secondary-background" role="alert">
					<div class="row">
						<div class="col-4">
							<i class="fa fa-users" aria-hidden="true" style="font-size: 32px;padding-top: 15px;"></i>
						</div>
						<div class="col-2">
							<div class="col-12 text-primary">
								Departments
							</div>
							<div class="col-2 number-bold">
								<?= $totalDepartment ?>
							</div>
						</div>
					</div>
				</div>
			</a>
		</div>
		<div class="col-lg-3 col-md-6 col-6">
			<a href="<?= Yii::$app->homeUrl ?>setting/team/create/<?= ModelMaster::encodeParams(['companyId' => $company['companyId']]) ?>" class="no-underline-black">
				<div class="alert alert-secondary-background" role="alert">
					<div class="row">
						<div class="col-4">
							<i class="fa fa-users" aria-hidden="true" style="font-size: 32px;padding-top: 15px;"></i>
						</div>
						<div class="col-2">
							<div class="col-12 text-primary">
								Teams
							</div>
							<div class="col-2 number-bold">
								<?= $totalTeam ?>
							</div>
						</div>
					</div>
				</div>
			</a>
		</div>
	</div>
</div>