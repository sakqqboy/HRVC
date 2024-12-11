<div class="modal fade" id="modalBranch" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalBranch" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content header-company">
			<div class="container">
				<div id="modalBranch" class="pt-10">
					<div class="row">
						<div class="col-11 font-b font-size-16" id="kfiName"></div>
						<div class="col-1 font-size-18">
							<i class="fa fa-times" aria-hidden="true" data-bs-dismiss="modal" style="cursor: pointer;"></i>
							</i>
						</div>
						<div class="col-12 font-size-14 mt-5" id="companyName"></div>
						<div class="col-12 text-center mt-10">
							<div class="row">
								<div class="col-6  text-end">
									<div class="Resolve-c" style="float: right;">
										<i class="fa fa-share-alt font-size-11 mt-8" aria-hidden="true" style="margin-left:-18px;position:absolute;"></i>
										</i>
									</div>
								</div>
								<div class="col-6 text-start pt-10 font-size-16 pl-0"><?= Yii::t('app', 'Branch') ?></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-body">
				<div class="card">
					<div class="col-12 pt-10" id="kfi-branch"></div>
					<div class="col-12">
						<div class="Resolve" data-bs-dismiss="modal"><?= Yii::t('app', 'Resolve') ?></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>