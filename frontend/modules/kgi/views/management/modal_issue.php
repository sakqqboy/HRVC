<div class="modal fade" id="kgi-issue" tabindex="-1" aria-labelledby="exampleModalfirstoneLabel" aria-hidden="true">
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header" style="border-bottom:none;">
				<div class="modal-title Modalfirstone" id="exampleModalfirstoneLabel">
					<i class="fa fa-line-chart" aria-hidden="true"></i> <span id="kgi-name-issue">
				</div>
				<div class="modal-title Modalfirstone" id="company-issue"></div>
			</div>
			<div class="fsm"><span id="branch-issue"></span>, <span id="country-issue"></span> <img id="flag-issue" class="Round1"></div>
			<div class="modal-body">
				<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
					<div class="row col-12">
						<div class="col-2 text-center">
							<span class="link-3 text-primary" style="border-bottom:5px #0d6efd solid;" id="pills-Issues-tab-kgi" data-bs-toggle="pill" data-bs-target="#pills-Issues" type="button" role="tab" aria-controls="pills-Issues" aria-selected="true">
								<?= Yii::t('app', 'Issues') ?>
							</span>
						</div>
						<div class="col-2 text-center">
							<span class="link-3" id="pills-History-tab-kgi" data-bs-toggle="pill" data-bs-target="#pills-History" type="button" role="tab" aria-controls="pills-History" aria-selected="false">
								<?= Yii::t('app', 'History') ?>
							</span>
						</div>
					</div>
				</ul>
				<div class="row" style="margin-top: -7px;">
					<hr style="border:3px solid lightgray">
				</div>
				<div class="tab-content" id="pills-tabContent">
					<div class="tab-pane fade show active" id="pills-Issues" role="tabpanel" aria-labelledby="pills-Issues-tab-kgi">
					</div>
					<div class="tab-pane fade" id="pills-History" role="tabpanel" aria-labelledby="pills-History-tab-kgi">

					</div>
				</div>
			</div>
		</div>
	</div>
</div>