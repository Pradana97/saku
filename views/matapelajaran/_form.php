<?php

use app\models\Kelompokkelas;
use app\models\Msmapel;
use kartik\select2\Select2;
use yii\helpers\{Html, ArrayHelper, Url};
use yii\widgets\ActiveForm;

$mapel =  ArrayHelper::map(Msmapel::find()->where(['status' => '1'])->all(), 'id_msmapel', 'nama');
$kelompok = ArrayHelper::map(Kelompokkelas::find()->where(['status' => '1'])->all(), 'id_kelompok', 'nama_kelompok');

?>
<div class="matapelajaran-form">
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_msmapel')->widget(Select2::className(), [
        'data' => $mapel,
        'options' => ['placeholder' => 'pilih ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]) ?>

    <?= $form->field($model, 'status')->widget(\kartik\switchinput\SwitchInput::class, [
        'pluginOptions' => [
            'onText' => 'Aktif',
            'offText' => 'Nonaktif',
            'onColor' => 'success',
            'offColor' => 'danger',
        ]
    ])->label('Status Mapel') ?>

    <?= $form->field($model, 'catatan')->textarea(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_kelompok')->widget(Select2::className(), [
        'data' => $kelompok,
        'options' => ['placeholder' => 'pilih ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]) ?>


    <?php if (!Yii::$app->request->isAjax) { ?>
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    <?php } ?>
    <?php ActiveForm::end(); ?>
</div>