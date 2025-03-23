<?php

use app\models\MsJabatan;
use kartik\select2\Select2;
use yii\helpers\{Html, ArrayHelper, Url};
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

$data = ArrayHelper::map(MsJabatan::find()->where(['status' => '1'])->all(), 'id_jabatan', 'nama_jabatan');
$dataid = ArrayHelper::map(\app\models\Userid::find()->all(), 'id', 'username');
?>
<div class="pegawai-form">
    <?php $form = ActiveForm::begin(); ?>
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-5">
                <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'nik')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'nip')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'tgl_lahir')->widget(DatePicker::className(), [
                    'pluginOptions' => [
                        'format' => 'yyyy-mm-dd',
                        'todayHighlight' => true,
                        'autoclose' => true
                    ]
                ]) ?>

                <?= $form->field($model, 'jenis_kelamin')->dropDownList([
                    'L' => 'Laki-laki',
                    'P' => 'Perempuan'
                ], ['prompt' => 'Pilih ...']) ?>

            </div>
            <div class="col-md-5">
                <?= $form->field($model, 'alamat')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'no_tlp')->textInput(['type' => 'number', 'maxlength' => true]) ?>

                <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'jabatan')->widget(Select2::className(), [
                    'data' => $data,
                    'options' => ['placeholder' => 'Select ...'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]) ?>

                <?= $form->field($model, 'foto')->fileInput(['onchange' => 'previewImage(this)'])->label('File') ?>


            </div>
            <div class="col-md-2">
                <?php
                if ($model->foto != null) {
                ?>
                    <p>File Sebelumnya</p>
                    <p style="width: 10%;">
                        <?= Html::img(Yii::getAlias('@web/uploads/pegawai/' . $model->id_pegawai . $model->foto), ['style' => ['width' => '200px']]) ?>
                    </p>
                <?php } ?>
                <?= $form->field($model, 'id_user')->widget(Select2::className(), [
                    'data' => $dataid,
                    'options' => ['placeholder' => 'Select ...'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]) ?>
            </div>
        </div>
    </div>

    <?php if (!Yii::$app->request->isAjax) { ?>
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    <?php } ?>
    <?php ActiveForm::end(); ?>
</div>