<?php

use app\models\Matapelajaran;
use app\models\Materi;
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
);

$materi = ArrayHelper::map(Materi::find()->all(), 'id_materi', 'nama_materi');
?>
<div class="ujikompetensi-form">
    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'id_mapel')->widget(Select2::className(), [
        'data' => $mapel,
        'options' => ['placeholder' => 'pilih ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ])->label('Mata Pelajaran') ?>

    <?= $form->field($model, 'id_materi')->widget(Select2::className(), [
        'data' => [],
        'options' => [
            'placeholder' => 'Pilih materi...',
            'id' => 'materi-id',
        ],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ])->label('Materi') ?>


    <?= $form->field($model, 'nama_ujikompetensi')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tanggal_dibuat')->widget(DatePicker::className(), [
        'pluginOptions' => [
            'format' => 'yyyy-mm-dd',
            'todayHighlight' => true,
            'autoclose' => true
        ]
    ]) ?>

    <?= $form->field($model, 'tanggal_akhir')->widget(DatePicker::className(), [
        'pluginOptions' => [
            'format' => 'yyyy-mm-dd',
            'todayHighlight' => true,
            'autoclose' => true
        ]
    ]) ?>

    <?= $form->field($model, 'keterangan')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'status')->dropDownList([
        'uraian' => 'Uraian',
        'ganda' => 'Pilihan Ganda',
    ], ['prompt' => 'Pilih jenis soal...']) ?>


    <?php if (!Yii::$app->request->isAjax) { ?>
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    <?php } ?>
    <?php ActiveForm::end(); ?>
</div>



<?php

$ajaxUrl = Url::to(['ujikompetensi/get-by-mapel']);
$script = <<<JS
$('#ujikompetensi-id_mapel').on('change', function() {
    var idMapel = $(this).val();
    $.ajax({
        url: '$ajaxUrl',
        type: 'GET',
        data: {id_mapel: idMapel},
        success: function(data) {
           
            var \$materi = $('#materi-id');
            \$materi.empty().trigger("change");
            $.each(data, function(key, value) {
                var newOption = new Option(value, key, false, false);
                \$materi.append(newOption).trigger('change');
            });
        }
    });
});
JS;
$this->registerJs($script);
?>