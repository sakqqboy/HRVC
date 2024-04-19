<html>

<title>PL register type</title>

<Head>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="../css/layout/font.css?v=<?= date("YmdHis"); ?>" rel="stylesheet">
	<link href="../css/layout/layout.css?v=<?= date("YmdHis"); ?>" rel="stylesheet">
	<link href="../css/fs.css?v=<?= date("YmdHis"); ?>" rel="stylesheet">

</Head>

<body>
	<div class="alert background-Planning mt-10 font-family">
		<div class="row mt-10">
			<div class="col-2 pb-100">
				<?php
				include 'pl_menu.php';
				?>
			</div>
			<div class="col-10 pt-10 pr-10 pl-10 font-family" style="background-color: white;">
				<div class="col-12 font-size-16 font-b">
					Register PL Types
				</div>
				<div class="col-12 content-box mt-10">
					<div class="nav-top-menu-pl pl-20">
						<div class="row">
							<div class="col-3  pt-10 pb-10 font-size-12">
								<i class="fa fa-check-circle" aria-hidden="true"></i>
								Import PL Type
							</div>
							<div class="col-3  pt-10 pb-10 font-size-12">
								<i class="fa fa-check-circle" aria-hidden="true"></i>
								PL Category Breakdown
							</div>
							<div class="col-3 pt-10 pb-10 font-size-12">
								<i class="fa fa-check-circle" aria-hidden="true"></i>
								Cash Flow Category
							</div>
						</div>
					</div>
					<div class="col-12 text-center mt-10 pt-20 pb-20" style="background-color: white;border-radius:10px;">
						<span class="text-danger">*</span>
						<span class="font-size-12" style="letter-spacing: 0.5px;">Select Categories for Import Items</span>
						<input type="checkbox" class="form-check-input ml-10 mr-10 font-size-12">All
						<div class="row mt-10 pb-10 font-size-14">
							<div class="col-6 text-end font-size-12">
								<input type="checkbox" class="form-check-input mr-10"> PL Category Breakdown
							</div>
							<div class="col-6 text-start font-size-12">
								<input type="checkbox" class="form-check-input mr-10"> PL Category Breakdown
							</div>
							<div class="col-12 text-center mt-10">

								<button class="btn btn-success font-size-12" style="letter-spacing:0.5px;">
									<i class="fa fa-download mr-5" aria-hidden="true"></i> Download Sample Import Files
								</button>
							</div>
						</div>

						<div id="drop_zone" class="offset-3 col-6 drop-zone">
							<label class="drop-zone__prompt" for="file_input">Drag & Drop or choose files to upload<br>CSV file</label>
							<input type="file" id="file_input" multiple style="display:none;z-index:99">
							<script src="../js/upload.js?v=<?= date("YmdHis"); ?>"></script>
							<div class="offset-3 col-6 mt-30">

								<button class="import-button">
									<label for="file_input">
										<i class="fa fa-upload mr-10" aria-hidden="true"></i>
										IMPORT
									</label>
								</button>
								</label>
							</div>
						</div>
						<div class="row mt-10">
							<div class="offset-4 col-4 download-progress">
								<div class="col-12 text-start mb-10">
									<img src="../images/excel.png" style="height: 30px;" class="mr-10">
									<span class="font-size-12 font-b">Filename.csv</span>
								</div>
								<div class="progress">
									<div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
								</div>
							</div>
						</div>
						<div class="row mt-15">
							<div class="col-6 text-end">
								<button class="btn btn-danger pt-10 pb-10  font-size-14 font-b" style="width:120px;letter-spacing:1px;">
									Cancel
								</button>
							</div>
							<div class="col-6 text-start">
								<button class="btn btn-primary pt-10 pb-10  font-size-14 font-b" style="width:120px;letter-spacing:1px;">
									Done
								</button>
							</div>
							<div class="offset-5 col-2 alert alert-success mt-20">
								<i class="fa fa-check-circle mr-5" aria-hidden="true"></i>Successfully added
							</div>
						</div>

					</div>

				</div>

			</div>

		</div>

	</div>
	</div>
</body>

</html>