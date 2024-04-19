<?php

use common\models\ModelMaster;

$this->title = 'Weight Allocation';
?>
<div class="col-12 mt-70 environment pt-10 pr-10 pl-20">
	<div class="row">
		<div class="col-2 pr-0 pl-5">
			<?= $this->render('menu_left', [
				"terms" => $terms,
				"environmentDetail" => $environmentDetail,
				"frameName" => $frameName,
				"termId" => $termId
			]) ?>
		</div>
		<div class="col-lg-10 col-md-6 col-12 environment">
			<div class="bg-white pmi_bakgru">
				<div class="col-12">
					<div class="row">
						<div class="col-3 FrameEvaluation">
							Key Finalcial Indicator
						</div>
						<div class="col-9 text-end">
							<div class="row">
								<div class="col-6 text-start">
									<a class="btn btn-primary font-size-12 pt-3 pb-3" style="letter-spacing: 0.5px;">
										<i class="fa fa-floppy-o mr-3" aria-hidden="true"></i>
										APPLY SAVE
									</a>
								</div>
								<div class="col-6 text-end">
									<a class="btn btn-info font-size-12 pt-3 pb-3" style="letter-spacing: 0.5px;color:white;">
										<i class="fa fa-th-large mr-3" aria-hidden="true"></i>
										KFI Dashboard
									</a>
								</div>
							</div>

						</div>
					</div>
				</div>
				<div class="row mt-5">

				</div>
			</div>
		</div>
	</div>
</div>