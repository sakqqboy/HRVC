<?php

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Alert;
use yii\helpers\ArrayHelper;

$this->title = Yii::t('app', 'Transtate');
?>
<div class="container">
    <?php if (Yii::$app->session->hasFlash('alert')) : ?>
        <?= Alert::widget([
            'body' => ArrayHelper::getValue(Yii::$app->session->getFlash('alert'), 'body'),
            'options' => ArrayHelper::getValue(Yii::$app->session->getFlash('alert'), 'options'),
        ]) ?>
    <?php endif; ?>
    <div class="col-lg-12">
        <div class="row" style="padding-top: 20px;">
            <div class="col-lg-12 head-bar-main" style="margin-bottom: 10px;">
                Translator
            </div>
            <div class="col-12 main-background">
                <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>English</th>
                            <th>Japanese</th>
                            <th>Thai</th>
                            <th>Chinese</th>
                            <th>Vietnam</th>
                            <th>Spanish</th>
                            <th>Indonesian</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $form = ActiveForm::begin([
                            'options' => [
                                'class' => 'panel panel-default form-horizontal',
                                'enctype' => 'multipart/form-data',
                                'method' => 'POST'
                            ],
                        ]);
                        ?>
                        <!-- <tr>
                            <td> </td>
                            <td><input class="form-control" name="english" placeholder="English" required></td>
                            <td><input class="form-control" name="japanese" placeholder="Japanese"></td>
                            <td><button class="btn seemore-btn ">Submit</button></td>
                        </tr> -->

                        <?php ActiveForm::end();
                        if (isset($language) && count($language) > 0) {
                            $i = 1;
                            foreach ($language as $lang) : ?>
                                <tr id="tran<?= $lang["translatorId"] ?>">
                                    <td><?= $i ?></td>
                                    <td><?= $lang["english"] ?></td>
                                    <td>
                                        <?= $lang["japanese"] ?>
                                        <!-- <input type="text" class="form-control" id="jp<?= $lang['translatorId'] ?>" value="<?= $lang['japanese'] ?>" onfocusout="javascript:updateTran(<?= $lang['translatorId'] ?>)">
                                        <span id="check<?= $lang['translatorId'] ?>" class="text-success success-update">
                                            <i class="fa fa-check" aria-hidden="true"></i>
                                        </span>
                                        <input type="hidden" id="oldValue<?= $lang['translatorId'] ?>" value="<?= $lang['japanese'] ?>">
                                        <span id="fail<?= $lang['translatorId'] ?>" class="text-danger success-update">
                                            <i class="fa fa-times" aria-hidden="true"></i>
                                        </span>
                                        <input type="hidden" id="oldValue<?= $lang['translatorId'] ?>" value="<?= $lang['japanese'] ?>"> -->
                                    </td>
                                    <td><?= $lang["thai"] ?></td>
                                    <td><?= $lang["chinese"] ?></td>
                                    <td><?= $lang["vietnam"] ?></td>
                                    <td><?= $lang["spanish"] ?></td>
                                    <td><?= $lang["spanish"] ?></td>
                                    <td class="text-center">
                                        <a class="btn btn-danger" href="javascript:deleteTran(<?= $lang["translatorId"] ?>)"><i class="fa fa-times" aria-hidden="true"></i></a>
                                    </td>
                                </tr>
                        <?php
                                $i++;
                            endforeach;
                        }
                        ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>