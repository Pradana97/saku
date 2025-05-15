<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$this->title = '';
?>

<div>
    <h3 style="text-align: center;">SOAL URAIAN : <?= $judul; ?></h3>
    <hr style="width: 50%;">
</div>

<div>
    <p style="font-size: 12px; font-weight: bold;">
        NB: Silakan kerjakan soal berikut dengan menulis jawaban di kertas menggunakan tulisan tangan yang rapi.
        Setelah selesai, scan seluruh halaman jawaban dan gabungkan menjadi satu file PDF.
        Unggah file tersebut melalui tombol "Upload" di bawah
    </p>
</div>

<br>

<div>
    <table style="width: 100%; font-size: 16px; margin-left: 5%;">
        <?php $no = 1;
        foreach ($soal as $row): ?>
            <tr>
                <td style="padding-top: 5px;"><?= $no++; ?></td>
                <td style="padding-top: 5px;"><?= $row->soal; ?></td>
            </tr>
        <?php endforeach ?>
    </table>
</div>

<hr>

<div class="materi-form">
    <?php $form = ActiveForm::begin(); ?>

    <b>Dokumen Berformat PDF</b>
    <?= $form->field($model, 'dokumen')->fileInput([
        'id' => 'dokumen-input',
        'accept' => 'application/pdf'
    ])->label('') ?>

    <?php
    if ($model->dokumen != null) {
        $url = Yii::getAlias('@web/uploads/jawabanuser/' . $model->id_jawabanuser . $model->dokumen);
        $ext = pathinfo($model->dokumen, PATHINFO_EXTENSION);
        echo "<p>Jawaban yang Sudah di Upload</p>";
        if (in_array(strtolower($ext), ['jpg', 'jpeg', 'png', 'gif'])) {
            echo Html::img($url, ['style' => ['width' => '200px']]);
        } else {
            echo Html::a('Lihat / Unduh Dokumen', $url, ['target' => '_blank']);
        }
    }
    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Simpan' : 'Update', [
            'class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary'
        ]) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>