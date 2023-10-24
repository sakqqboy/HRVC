<?php

use common\models\ModelMaster;
use frontend\models\hrvc\Company;

$this->title = 'Group profile';
?>

<div class="col-12" style="margin-top: 60px;">
	<div class="col-12" style="height: 180px;background-color:gray;">
		<?php
		if ($group["banner"] != null) { ?>
			<img src="<?= Yii::$app->homeUrl . $group['banner'] ?>" class="sad-1">
		<?php
		} else { ?>
			<img src="<?= Yii::$app->homeUrl . 'image/group.jpg' ?>" class="sad-1">
		<?php
		}
		?>

	</div>
	<!-- <div class="col-12 edit-update text-end" style="padding-right: 30px;">
		<a href="" class="btn btn-light"> <i class="fa fa-pencil" aria-hidden="true"></i> Update</a>
	</div> -->
	<div class="row">
		<div class="col-lg-2 col-md-5 col-12" style="margin-top:-100px;">
			<div class="avatar-upload" style="margin-left:20px;">
				<div class="avatar-preview">
					<?php
					if ($group["picture"] != null) { ?>
						<img src="<?= Yii::$app->homeUrl . $group['picture'] ?>" class="company-group-picture">
					<?php
					} else { ?>


						<img src="<?= Yii::$app->homeUrl . 'image/groupProfile.jpg' ?>" class="company-group-picture">
					<?php
					}
					?>
				</div>
			</div>
		</div>
		<div class="col-lg-5 col-md-4 col-12">
			<div class="col-12 name-tokyo pl-30">
				<?= $group['groupName'] ?>
			</div>
			<div class="col-12 tokyo-small pl-30">
				<?= $group['tagLine'] ?>
			</div>
		</div>
		<div class="col-lg-5 col-md-3 col-12 tcg-edit0 mt-40">
			<span class="tcg-edit"><?= $group['displayName'] ?> </span>
			<a href="<?= Yii::$app->homeUrl ?>setting/group/update-group/<?= ModelMaster::encodeParams(['groupId' => $group['groupId']]) ?>" class="btn btn-success ml-40" style="margin-top: -20px;">
				<i class="fa fa-pencil" aria-hidden="true"></i> Edit
			</a>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-4 col-md-4 col-12 all-information">
			<div class="col-12 Group-Information mb-20">
				Group Information
			</div>
			<div class="row">
				<div class="col-lg-5 col-md-6 col-12 name-head">
					Headquarter
				</div>
				<div class="col-lg-7 col-md-6 col-12 name-head0">
					<i class="fa fa-map-marker location" aria-hidden="true"></i>
					<span class="text-primary address-box"><?= $group["headQuaterName"] ?></span>
				</div>
				<div class="col-lg-5 col-md-6 col-12 name-head mt-10">
					Address
				</div>
				<div class="col-lg-7 col-md-6 col-12 name-head0 mt-10">
					<div class="address-box">
						<?= $group["location"] ?>
					</div>
				</div>
				<div class="col-lg-5 col-md-6 col-12 name-head mt-10">
					Established
				</div>
				<div class="col-lg-7 col-md-6 col-12 name-head0 mt-10">
					<?= $group["founded"] ?>
				</div>
				<div class="col-lg-5 col-md-6 col-12 name-head mt-10">
					Company/Director
				</div>
				<div class="col-lg-7 col-md-6 col-12 name-head0 mt-10">
					<img src="<?= Yii::$app->homeUrl ?>image/Mask-group.png"> <?= $group["director"] ?>
				</div>
				<hr class="mt-20">
			</div>
			<div class="col-12 Group-Information mb-20">
				Contact Information
			</div>
			<div class="row">
				<div class="col-lg-5 col-md-6 col-12  name-head mt-10">
					Email
				</div>
				<div class="col-lg-7 col-md-6 col-12 name-head0 mt-10">
					<span class="text-primary address-box0"> <?= $group["email"] ?></span>&nbsp;
					<i class="fa fa-clipboard clipboard0 " aria-hidden="true" onclick="javascript:copyToClipboard('<?= $group['email'] ?>')"></i>
				</div>
				<div class="col-lg-5 col-md-6 col-12 name-head mt-10">
					Phone
				</div>
				<div class="col-lg-7 col-md-6 col-12 name-head0 mt-10">
					<?= $group["contact"] ?>&nbsp;&nbsp;
					<i class="fa fa-clipboard clipboard0" aria-hidden="true" onclick="javascript:copyToClipboard('<?= $group['contact'] ?>')"></i>
				</div>
				<div class="col-lg-5 col-md-6 col-12 name-head mt-10">
					Website
				</div>
				<div class="col-lg-7 col-md-6 col-12 name-head0 mt-10">
					<span class="text-primary address-box0">
						<a href="<?= $group['website'] ?>" target="_blank">
							<?= $group["website"] ?>
						</a>
					</span>&nbsp;&nbsp;
					<i class="fa fa-clipboard clipboard0" aria-hidden="true" onclick="javascript:copyToClipboard('<?= $group['website'] ?>')"></i>
				</div>
				<hr class="mt-20">
			</div>

		</div>
		<div class="col-lg-5 col-md-4 col-12 box-about0">
			<div class="col-12 ABOUT-NAME mb-20">
				ABOUT
			</div>
			<div class="col-12 detail-tokyo">
				<?= $group["about"] ?>

			</div>
			<div class="col-12 mt-10">
				<p>Social Tag <span class="facebook"> <?= $group["socialTag"] ?></span> </p>
			</div>
		</div>
		<div class="col-lg-3 col-md-4 col-12 home-tokyo">
			<div class="row">
				<div class="col-lg-2 col-md-2 col-12">
					<i class="fa fa-building building0" aria-hidden="true"></i>
				</div>
				<div class="col-lg-7 col-md-7 col-12 Affiliated0">
					Affiliated Companies
				</div>
				<div class="col-lg-3 col-md-3 col-12 box-27" style="font-weight:700;">
					<?= count($companyGroup) ?>
				</div>
			</div>
			<hr>
			<div class="col-12">

				<?php
				if (isset($companyGroup) && count($companyGroup) > 0) {
					$i = 0;
					foreach ($companyGroup as $company) :
				?>
						<a href="<?= Yii::$app->homeUrl . 'setting/company/company-view/' . ModelMaster::encodeParams([
									'companyId' => $company['companyId']
								]) ?>" class="no-underline" style="color:black;">
							<div class="row <?= $i > 0 ? 'mt-10' : '' ?> affiliated-list">
								<div class="col-lg-3 col-md-4 col-4">
									<img src="<?= Yii::$app->homeUrl . $company['picture'] ?>" class="width-TCF-BD">
								</div>
								<div class="col-lg-9 col-md-8 col-8">
									<div class="tokyoconsultinggroup">
										<?= $company['companyName'] ?>
										<?php
										if ($company['headQuaterId'] == null) {
										?>
											<span style="font-size: 11px;font-weight:100;">(head Quater)</span>
										<?php
										}
										?>
									</div>
									<i class="fa fa-map-marker FT mr-5" aria-hidden="true"></i><?= $company["city"] ?>, <?= $company["countryName"] ?>
									<div class="numberemployees"><?= Company::totalEmployeeCompany($company['companyId']) ?> Employees</div>
								</div>
							</div>
						</a>
					<?php
						$i++;
					endforeach;
				}
				if (count($companyGroup) > 5) {
					?>
					<div class="col-12 text-end">
						<a href="#"> See All </a>
					</div>
				<?php
				}
				?>

			</div>
		</div>
	</div>
	<div class="row mt-10">
		<div class="col-lg-3 col-md-4 col-6">
			<div class="alert alert-secondary-background" role="alert">
				<div class="row">
					<div class="col-4">
						<i class="fa fa-users" aria-hidden="true" style="font-size: 25px;padding-top: 18px;"></i>
					</div>
					<div class="col-2">
						<a href="<?= Yii::$app->homeUrl ?>setting/branch/create/<?= ModelMaster::encodeParams(['companyId' => '']) ?>" style="text-decoration: none;">
							<div class="col-12 text-primary">
								Branch
							</div>
							<div class="col-2 number-bold text-black">
								<?= $totalBranches ?>
							</div>
						</a>
					</div>

				</div>
			</div>
		</div>
		<div class="col-lg-3 col-md-4 col-6">
			<div class="alert alert-secondary-background" role="alert">
				<div class="row">
					<div class="col-4">
						<i class="fa fa-users" aria-hidden="true" style="font-size: 25px;padding-top: 18px;"></i>
					</div>
					<div class="col-2">
						<a href="<?= Yii::$app->homeUrl ?>setting/department/create/<?= ModelMaster::encodeParams(['companyId' => '']) ?>" style="text-decoration: none;">
							<div class="col-12 text-primary">
								Department
							</div>
							<div class="col-2 number-bold text-black">
								<?= $totalDepartment ?>
							</div>
						</a>
					</div>

				</div>
			</div>
		</div>
		<div class="col-lg-3 col-md-4 col-6">
			<div class="alert alert-secondary-background" role="alert">
				<div class="row">
					<div class="col-4">
						<i class="fa fa-users" aria-hidden="true" style="font-size: 25px;padding-top: 18px;"></i>
					</div>
					<div class="col-2">
						<a href="<?= Yii::$app->homeUrl ?>setting/team/create/<?= ModelMaster::encodeParams(['companyId' => '']) ?>" style="text-decoration: none;">
							<div class="col-12 text-primary">
								Team
							</div>
							<div class="col-2 number-bold text-black">
								<?= $totalTeam ?>
							</div>
						</a>
					</div>

				</div>
			</div>
		</div>
		<div class="col-lg-3 col-md-4 col-6">
			<div class="alert alert-secondary-background" role="alert">
				<div class="row">
					<div class="col-4">
						<i class="fa fa-users" aria-hidden="true" style="font-size: 25px;padding-top: 18px;"></i>
					</div>
					<div class="col-2">
						<a href="<?= Yii::$app->homeUrl ?>setting/employee/index/<?= ModelMaster::encodeParams(['companyId' => '']) ?>" style="text-decoration: none;">
							<div class="col-12 text-primary">
								Employee
							</div>
							<div class="col-2 number-bold text-black">
								<?= $totalEmployees ?>
							</div>
						</a>
					</div>
				</div>
			</div>
		</div>

	</div>
</div>