<?php
$this->title = 'SOAL PILIHAN GANDA ' . $judul;

use app\models\Jawaban;
use app\models\Soal;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<div class="soal-form">
    <?php $form = ActiveForm::begin([
        'id' => 'form-soal',
        'action' => ['ujikompetensi/savesoalganda', 'nd' => $nd, 'type' => 'pilihanganda'],
        'enableClientValidation' => false,
    ]); ?>

    <hr style="margin-top: 5px;">
    <b>BUAT SOAL</b>
    <br><br>

    <!-- Input teks soal -->
    <?= $form->field($model, 'soal')->textarea(['rows' => 4]) ?>

    <!-- Status aktif/nonaktif -->
    <?= $form->field($model, 'status')->widget(\kartik\switchinput\SwitchInput::class, [
        'pluginOptions' => [
            'onText' => 'Aktif',
            'offText' => 'Nonaktif',
            'onColor' => 'success',
            'offColor' => 'danger',
        ]
    ]) ?>
    <br>
    <b>JAWABAN PILIHAN GANDA</b>
    <br><br>

    <div class="row">
        <?php foreach (['A', 'B', 'C', 'D'] as $index => $label): ?>
            <div class="col-md-6">
                <div class="card" style="padding:10px; margin-bottom:15px; border:1px solid #ddd; border-radius:6px;">
                    <label><b>Jawaban <?= $label ?></b></label>
                    <?= $form->field($modelsJawaban[$index], "[$index]jawab")->textInput(['placeholder' => "Isi jawaban $label"])->label(false) ?>

                    <?= $form->field($modelsJawaban[$index], "[$index]apa_benar")->radioList([
                        'Y' => 'Jawaban Benar',
                        'T' => 'Jawaban Salah'
                    ])->label(false) ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <?php if (!Yii::$app->request->isAjax): ?>
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Simpan' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    <?php endif; ?>

    <?php ActiveForm::end(); ?>
</div>
<hr>
<div id="daftar-soal">
    <table>
        <tbody style="background-color: white;">
            <?php
            $no = 1;
            $soal = Soal::find()->where(['id_uji' => $nd])->all();
            foreach ($soal as $row):
            ?>
                <tr>
                    <td style="width:5% ; font-weight: bold; text-align: center; font-size: 16px;"><?= $no++; ?></td>
                    <td style="width:65% ; font-weight: bold; font-size: 16px;"><?= $row->soal; ?></td>
                    <td style="width:10% ; font-weight: bold;text-align: center; font-size: 16px;"><?= $row->status; ?></td>
                    <td style="width:10% ;">
                        <?= Html::a('<button class="btn btn-primary btn-md">Update</button>', ['ujikompetensi/update', 'id' => $row->id_soal]) ?>
                    </td>
                    <td style="width:10% ;">
                        <?= Html::a('<button class="btn btn-danger btn-md">Hapus</button>', ['ujikompetensi/delete', 'id' => $row->id_soal], [
                            'data' => [
                                'confirm' => 'Are you sure you want to delete this item?',
                                'method' => 'post',
                            ],
                        ]) ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="5">
                        <table style="width: 100%; background-color: #f9f9f9; margin-top: 10px;">
                            <thead>
                                <tr>
                                    <th style="width: 10%; text-align: center;">Label</th>
                                    <th style="width: 70%; text-align: left;">Jawaban</th>
                                    <th style="width: 20%; text-align: center;">Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $jawaban = Jawaban::find()->where(['id_soal' => $row->id_soal])->all();
                                foreach ($jawaban as $i => $row2):
                                    $label = chr(65 + $i); // A, B, C, D
                                ?>
                                    <tr>
                                        <td style="text-align: center;"><?= $label ?></td>
                                        <td><?= $row2->jawab ?></td>
                                        <td style="text-align: center;">
                                            <?php if ($row2->apa_benar === 'Y'): ?>
                                                <span style="color: green; font-weight: bold;">✔ Benar</span>
                                            <?php else: ?>
                                                <span style="color: red;">✘ Salah</span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                <tr>
                                    <td colspan="3">
                                        <hr>
                                    </td>

                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>

<?php
$this->registerJs("
    $('#form-soal').on('beforeSubmit', function(e) {
        e.preventDefault();
        var form = $(this);
        $.ajax({
            url: form.attr('action'),
            type: 'POST',
            data: form.serialize(),
            success: function(response) {
                if (response.status === 'success') {
                    alert('Soal berhasil disimpan');
                    form.trigger('reset');
                    form.find('input[type=radio]').prop('checked', false); // <--- Tambahkan ini
                    $('#daftar-soal').html(response.soalHtml);
                } else {
                    alert('Gagal menyimpan soal');
                }
            },
            error: function() {
                alert('Terjadi kesalahan di server');
            }
        });
        return false;
    });
");
?>