<?php

$this->title = 'Add';
?>

<div class="col-12" style="margin-top: 60px;background-color:white;padding-bottom:20px;">
	<div class="col-12" id="imagePreviewBanner" style="height: 180px;background-color:gray;">



	</div>
	<div class="col-12 edit-update text-end" style="padding-right: 30px;">
		<div class="form-group">

			<span class="fileUpload btn btn-light">
				<div id="upload" class="uplode-btn"><i class="fa fa-upload" aria-hidden="true"></i> Update</div>
				<input type="file" name="imageUploadBanner" id="imageUploadBanner" class="upload up upload-checklist" id="up" />
			</span><!-- btn-orange -->
			<!-- group -->
		</div><!-- form-group -->

	</div>
	<div class="row">
		<div class="col-lg-4 col-md-6 col-12 all-avatar">
			<div class="avatar-upload">
				<div class="avatar-edit">
					<input type='file' id="imageUpload" accept=".png, .jpg, .jpeg" name="image" />
					<label for="imageUpload"></label>
				</div>
				<div class="avatar-preview" style="background-color:white;">
					<div id="imagePreview">
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-6 col-md-6 col-12">
			<div class="form-companyname">
				<div class="row">
					<div class="col-5 Groupname1">
						Group Company Name <span class="profile-moon">*</span>
					</div>
					<div class="col-7">
						<input type="text" class="form-control" id="colFormLabel" required>
					</div>
					<div class="mt-20"></div>
					<div class="col-5">
						Tag line
					</div>
					<div class="col-7">
						<input type="text" class="form-control" id="colFormLabel">
					</div>
					<div class="mt-20"></div>
					<div class="col-5">
						Headquarter <span class="profile-moon">*</span>
					</div>
					<div class="col-7">
						<input type="text" class="form-control" id="colFormLabel" required>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-12 mt-50">
		<div class="row">
			<div class="col-lg-6 col-md-6 col-12">
				<hr>
			</div>
			<div class="col-lg-6 col-md-6 col-12 text-end Groupname2" style="padding-right: 40px;">
				Group Company Profile
			</div>
		</div>
	</div>
	<div class="col-12" s>
		<div class="row">
			<div class="col-lg-6 col-md-6 col-12">
				<div class="col-12 mt-40">
					<div class="row">
						<div class="col-3 pl-30">
							Display <span class="profile-moon">*</span>
						</div>
						<div class="col-9">
							<input type="text" class="form-control" id="colFormLabel">
						</div>
						<div class="mt-20"></div>
						<div class="col-3  pl-30">
							Website </div>
						<div class="col-9">
							<input type="text" class="form-control" id="colFormLabel">
						</div>
						<div class="mt-20"></div>
						<div class="col-3  pl-30">
							Address <span class="profile-moon">*</span>
						</div>
						<div class="col-9">
							<input type="text" class="form-control" id="colFormLabel">
						</div>
						<div class="mt-20"></div>
						<div class="col-12">
							<div class="row">
								<div class="col-3  pl-30">
									Country
								</div>
								<div class="col-4">
									<input type="text" class="form-control" id="colFormLabel">
								</div>
								<div class="col-1">
									City
								</div>
								<div class="col-4">
									<input type="text" class="form-control" id="colFormLabel">
								</div>
								<div class="mt-20"></div>
								<div class="col-3  pl-30">
									Postal Code
								</div>
								<div class="col-4">
									<input type="text" class="form-control" id="colFormLabel">
								</div>
								<div class="mt-20"></div>
								<div class="col-3  pl-30">
									Industries <span class="profile-moon">*</span>
								</div>
								<div class="col-4">
									<input type="text" class="form-control" id="colFormLabel">
								</div>
								<div class="col-2">
									Email <span class="profile-moon">*</span>
								</div>
								<div class="col-3">
									<input type="email" class="form-control" id="colFormLabel">
								</div>
								<div class="mt-20"></div>
								<div class="col-3  pl-30">
									Founded
								</div>
								<div class="col-4">
									<input type="text" class="form-control" id="colFormLabel">
								</div>
								<div class="col-2">
									Contact <span class="profile-moon">*</span>
								</div>
								<div class="col-3">
									<input type="text" class="form-control" id="colFormLabel">
								</div>
								<div class="mt-20"></div>
								<div class="col-3 pl-30">
									Director <span class="profile-moon">*</span>
								</div>
								<div class="col-4">
									<input type="text" class="form-control" id="colFormLabel">
								</div>
								<div class="col-2">
									Social Tag
								</div>
								<div class="col-3">
									<input type="text" class="form-control" id="colFormLabel">
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-6 col-md-6 col-12 mt-40" style="padding-right: 40px;">
				<div class="row">
					<div class="col-2 text-end" style="padding-top: 200px;font-size:14px;">
						ABOUT <span class="profile-moon">*</span>
					</div>
					<div class="col-10">
						<div class="alert alert-secondary" role="alert" style="font-size: 14px;">
							<textarea style="height:410px;" class="form-control"></textarea>

						</div>
						<div class="row">
							<div class="col-4">
								<div class="alert alert-secondary text-center" role="alert">
									<div class="text-primary"> Companies</div>
									<i class="fa fa-plus mt-10" aria-hidden="true"></i>
								</div>
							</div>
							<div class="col-4">
								<div class="alert alert-secondary text-center" role="alert">
									<div class="text-primary"> Employees</div>
									<i class="fa fa-plus mt-10" aria-hidden="true"></i>
								</div>
							</div>
							<div class="col-4">
								<div class="alert alert-secondary text-center" role="alert">
									<div class="text-primary"> Branches</div>
									<i class="fa fa-plus mt-10" aria-hidden="true"></i>
								</div>
							</div>
						</div>
						<div class="col-12 text-end mt-10">
							<button type="button" class="btn btn-success">Apply Changes</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>