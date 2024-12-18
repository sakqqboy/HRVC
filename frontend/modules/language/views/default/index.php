<?php

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Alert;
use yii\helpers\ArrayHelper;

$this->title = Yii::t('app', 'Transtate');
?>
<script>
    window.onload = function() {
        searchWord();
    }
</script>
<div class="container">
    <?php if (Yii::$app->session->hasFlash('alert')) : ?>
        <?= Alert::widget([
            'body' => ArrayHelper::getValue(Yii::$app->session->getFlash('alert'), 'body'),
            'options' => ArrayHelper::getValue(Yii::$app->session->getFlash('alert'), 'options'),
        ]) ?>
    <?php endif; ?>
    <div class="col-lg-12 mt-10">
        <div class="row">
            <div class="col-lg-12 font-size-16 font-b" style="margin-bottom: 10px;">
                Search English word.
                <a href="<?= Yii::$app->homeUrl ?>language/default/create" class="btn btn-primary font-size-14 float-end pl-5 pr-5">+ <?= Yii::t('app', 'Add new word') ?></a>
            </div>
            <div class="col-12">
                <input type="text" name="" class="form-control pl-35 font-size-16" id="search-english" onkeyup="javascript:searchWord()" value="<?= $english ?>">
                <div class="ml-10" style="margin-top: -30px; width:20px;position:absolute;"></span><i class="fa fa-search text-secondary" aria-hidden="true"></i></div>
            </div>

            <div class="col-12 alert mt-10 pim-body bg-white" id="word-result">

            </div>
        </div>
    </div>

</div>