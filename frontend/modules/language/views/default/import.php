<?php



use yii\bootstrap5\ActiveForm;

use yii\bootstrap5\Alert;

use yii\helpers\ArrayHelper;



$form = ActiveForm::begin([

	'options' => [

		'class' => 'panel panel-default form-horizontal',

		'enctype' => 'multipart/form-data',

		'id' => 'import',

	],

]);

$this->title = 'Create Language';

?>

<div class="container pt-20">

	<div class="col-lg-12">

		<div class="row">

			<div class="col-lg-12 head-creat-news">

				Import Q & A

			</div>

			<div class="col-lg-12 create-upload-box">

				<div class="row">

					<div class="col-lg-6">

						<div class="col-lg-12 mt-20">

							<div class="form-group">

								<div class="input-group">

									<input type="text" class="form-control" readonly>

									<div class="input-group-btn">

										<span class="fileUpload btn btn-info">

											<span class="upl news-button" id="upload"><i class="fa fa-file" aria-hidden="true"></i> File .csv</span>

											<input type="file" name="languageFile" class="upload up" id="up" onchange="readURL(this);" />

										</span><!-- btn-orange -->

									</div><!-- btn -->

								</div><!-- group -->

							</div><!-- form-group -->

						</div>

						<div class="col-lg-12 mt-20">

							<button class="btn btn-primary form-control news-button" type="submit"><i class="fa fa-paper-plane" aria-hidden="true"></i> UPLOAD</button>

						</div>

					</div>

					<div class="col-lg-6 bordertest upload-result">

						<?php if (Yii::$app->session->hasFlash('alert')) : ?>

							<?= Alert::widget([

								'body' => ArrayHelper::getValue(Yii::$app->session->getFlash('alert'), 'body'),

								'options' => ArrayHelper::getValue(Yii::$app->session->getFlash('alert'), 'options'),

							]) ?>

						<?php endif; ?>

					</div>

				</div>





			</div>

			<?php ActiveForm::end(); ?>

		</div>

	</div>

</div>