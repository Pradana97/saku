<?php

use app\models\Matapelajaran;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use yii\helpers\{Html, ArrayHelper, Url};
use yii\widgets\ActiveForm;

$mapel = ArrayHelper::map(
    Matapelajaran::find()->where(['status' => '1'])->all(),
    'id_mapel',
    function ($model) {
        return $model->msmapel->nama; // pastikan relasinya benar
    },
    function ($model) {
        return $model->kelompok->nama_kelompok; // juga pastikan relasinya benar
    }
); ?>
<div class="materi-form">
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_mapel')->widget(Select2::className(), [
        'data' => $mapel,
        'options' => ['placeholder' => 'pilih ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ])->label('Nama Mapel') ?>

    <?= $form->field($model, 'nama_materi')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'keterangan')->textarea(['rows' => 6]) ?>

    <b>Dokumen Berformat PDF</b>
    <?= $form->field($model, 'dokumen')->fileInput(['accept' => 'application/pdf'])->label('') ?>

    <?php
    if ($model->dokumen != null) {
        $url = Yii::getAlias('@web/uploads/materi/' . $model->id_materi . $model->dokumen);
        $ext = pathinfo($model->dokumen, PATHINFO_EXTENSION);
        echo "<p>File Sebelumnya</p>";
        if (in_array(strtolower($ext), ['jpg', 'jpeg', 'png', 'gif'])) {
            echo Html::img($url, ['style' => ['width' => '200px']]);
        } else {
            echo Html::a('Lihat / Unduh Dokumen', $url, ['target' => '_blank']);
        }
    }
    ?>



    <?php if (!Yii::$app->request->isAjax) { ?>
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    <?php } ?>
    <?php ActiveForm::end(); ?>
</div>