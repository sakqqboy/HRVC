<?php

use common\models\ModelMaster;

?>

<div class="row">
	<div class="col-lg-6 col-md-6 col-12 pr-30">
		<div class="col-12 mt-40 pl-10 font-size-18">
			<i class="fa fa-info-circle mr-10" aria-hidden="true"></i> Personal Information
		</div>
		<hr>
		<div class="row pl-20 font-size-14">
			<div class="col-5 mt-10">
				First Name
			</div>
			<div class="col-7 mt-10 view-font-bold">
				<?= $employee['employeeFirstname'] ?>
			</div>
			<div class="col-5 mt-20">
				Last Name
			</div>
			<div class="col-7 mt-20 view-font-bold">
				<?= $employee['employeeSurename'] ?>
			</div>
			<div class="col-5 mt-20">
				Nationality
			</div>
			<div class="col-7 mt-20 view-font-bold">
				<?= $employee['nationalityName'] ?>
			</div>
			<div class="col-5 mt-20">
				Date of Birth
			</div>
			<div class="col-7 mt-20 view-font-bold">
				<?= ModelMaster::dateNumberDash($employee['birthDate']) ?>
			</div>
			<div class="col-5 mt-20">
				Age
			</div>
			<div class="col-7 mt-20 view-font-bold">
				<?= $employee['age'] ?>
			</div>
			<div class="col-5 mt-20">
				Gender
			</div>
			<div class="col-7 mt-20 view-font-bold">
				<?php
				if ($employee['gender'] == 1) {
				?>
					Male <i class="fa fa-mars" aria-hidden="true"></i>
				<?php
				} else { ?>
					Female <i class="fa fa-venus" aria-hidden="true"></i>
				<?php
				}
				?>
			</div>

			<div class="col-5 mt-20">
				Address
			</div>
			<div class="col-7 mt-20 view-font-bold">
				<?= $employee['address1'] ?>
			</div>
		</div>
	</div>
	<div class="col-lg-6 col-md-6 col-12 mt-40 pl-30" style="border-left: lightgrey solid thin;">
		<div class="col-12 font-size-18">
			<i class="fa fa-phone mr-10" aria-hidden="true"></i> Contact Information
		</div>
		<hr>
		<div class="row font-size-14">

			<div class="col-5  mt-10">
				Personal Email
			</div>
			<div class="col-7  mt-10 view-font-bold word-fit">
				<?= $employee['email'] ?>
				<i class="fa fa-clipboard view-cursor" aria-hidden="true" onclick="javascript:copyToClipboard('<?= $employee['email'] ?>')"></i>
			</div>
			<div class="col-5 mt-20">
				Contact Number
			</div>
			<div class="col-7 mt-20 view-font-bold">
				<?= $employee['telephoneNumber'] ?>
				<i class="fa fa-clipboard view-cursor" aria-hidden="true" onclick="javascript:copyToClipboard('<?= $employee['telephoneNumber'] ?>')"></i>
			</div>
			<div class="col-5 mt-20">
				Emergency Contact Number
			</div>
			<div class="col-7 mt-20 view-font-bold">
				<?= $employee['emergencyTel'] ?>
				<i class="fa fa-clipboard view-cursor" aria-hidden="true" onclick="javascript:copyToClipboard('<?= $employee['emergencyTel'] ?>')"></i>
			</div>
			<div class="col-5 mt-20">
				Company Mail
			</div>
			<div class="col-7 mt-20 view-font-bold1 word-fit">
				<?= $employee['companyEmail'] ?>
				<i class="fa fa-clipboard view-cursor" aria-hidden="true" onclick="javascript:copyToClipboard('<?= $employee['companyEmail'] ?>')"></i>
			</div>
			<div class="col-5 mt-20">
				Social Links
			</div>
			<div class="col-7 mt-20 view-font-bold">
				<?= $employee['socialLink'] ?>
				<!-- <p><i class="fa fa-facebook-square social-facebook" aria-hidden="true"></i> &nbsp;/watanabe <i class="fa fa-clipboard view-cursor" aria-hidden="true"></i></p> -->
				<!-- <p><i class="fa fa-twitter-square" aria-hidden="true"></i> &nbsp;/watanabetadawoki <i class="fa fa-clipboard view-cursor" aria-hidden="true"></i></p>
													<p><i class="fa fa-linkedin-square" aria-hidden="true"></i> &nbsp;/watanab546 <i class="fa fa-clipboard view-cursor" aria-hidden="true"></i></p> -->
			</div>
		</div>
	</div>
</div>