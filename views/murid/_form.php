<?php

use app\models\MsJurusan;
use app\models\MsKelas;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use yii\helpers\{Html, ArrayHelper, Url};
use yii\widgets\ActiveForm;

$dataid = ArrayHelper::map(\app\models\Userid::find()->all(), 'id', 'username');
$kelas = ArrayHelper::map(MsKelas::find()->where(['status' => '1'])->all(), 'id_kelas', 'nama_kelas');
$jurusan = ArrayHelper::map(MsJurusan::find()->where(['status' => '1'])->all(), 'id_jurusan', 'nama_jurusan');

?>
<div class="murid-form">
    <?php $form = ActiveForm::begin(); ?>
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-5">
                <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'no_induk_sekolah')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'no_identitas')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'tgl_lahir')->widget(DatePicker::className(), [
                    'pluginOptions' => [
                        'format' => 'yyyy-mm-dd',
                        'todayHighlight' => true,
                        'autoclose' => true
                    ]
                ]) ?>

                <?= $form->field($model, 'tempat_lahir')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'jenis_kelamin')->dropDownList([
                    'L' => 'Laki-laki',
                    'P' => 'Perempuan'
                ], ['prompt' => 'Pilih ...']) ?>

                <?= $form->field($model, 'alamat')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'tahun_masuk')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-5">

                <?= $form->field($model, 'kelas')->widget(Select2::className(), [
                    'data' => $kelas,
                    'options' => ['placeholder' => 'pilih ...'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]) ?>

                <?= $form->field($model, 'jurusan')->widget(Select2::className(), [
                    'data' => $jurusan,
                    'options' => ['placeholder' => 'pilih ...'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]) ?>

                <?= $form->field($model, 'nama_ortu')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'no_tlp_ortu')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'status_beasiswa')->widget(\kartik\switchinput\SwitchInput::class, [
                    'pluginOptions' => [
                        'onText' => 'Aktif',
                        'offText' => 'Nonaktif',
                        'onColor' => 'success',
                        'offColor' => 'danger',
                    ]
                ]) ?>

                <?= $form->field($model, 'status')->widget(\kartik\switchinput\SwitchInput::class, [
                    'pluginOptions' => [
                        'onText' => 'Aktif',
                        'offText' => 'Nonaktif',
                        'onColor' => 'success',
                        'offColor' => 'danger',
                    ]
                ])->label('Status Data') ?>

                <?= $form->field($model, 'catatan')->textarea(['rows' => 6]) ?>
            </div>
            <div class="col-md-2">
                <?= $form->field($model, 'user_id')->widget(Select2::className(), [
                    'data' => $dataid,
                    'options' => ['placeholder' => 'Select ...'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]) ?>

                <?= $form->field($model, 'foto')->fileInput(['onchange' => 'previewImage(this)'])->label('Foto') ?>

                <?php
                if ($model->foto != null) {
                ?>
                    <p>File Sebelumnya</p>
                    <p style="width: 10%;">
                        <?= Html::img(Yii::getAlias('@web/uploads/murid/' . $model->id_murid . $model->foto), ['style' => ['width' => '200px']]) ?>
                    </p>
                <?php } ?>
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