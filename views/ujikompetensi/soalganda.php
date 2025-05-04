<?php
$this->title = 'SOAL PILIHAN GANDA ' . $judul;

use app\models\Jawaban;
use app\models\Soal;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

$urlToggleStatus = Url::to(['ujikompetensi/togglestatusganda']);
$urlDelete = Url::to(['ujikompetensi/deleteajax']);
?>

<div class="soal-form">
    <?php $form = ActiveForm::begin([
        'id' => 'form-soal',
        'action' => ['ujikompetensi/savesoalganda', 'nd' => $nd, 'type' => 'pilihanganda'],
        'enableClientValidation' => false,
    ]); ?>

    <hr><b>BUAT SOAL</b><br><br>

    <?= $form->field($model, 'soal')->textarea(['rows' => 4]) ?>

    <?= $form->field($model, 'status')->widget(\kartik\switchinput\SwitchInput::class, [
        'pluginOptions' => [
            'onText' => 'Aktif',
            'offText' => 'Nonaktif',
            'onColor' => 'success',
            'offColor' => 'danger',
        ]
    ]) ?>
    <br>
    <b>JAWABAN PILIHAN GANDA</b><br><br>

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
    <?php
    $no = 1;
    $soal = Soal::find()->where(['id_uji' => $nd])->all();
    ?>
    <table>
        <tbody>
            <?php foreach ($soal as $row): ?>
                <tr>
                    <td style="width:5%; text-align:center; font-weight:bold; font-size:16px;"><?= $no++ ?></td>
                    <td style="width:65%; font-weight:bold; font-size:16px;"><?= $row->soal ?></td>
                    <td class="status-col" style="width:10%; text-align:center; font-size:16px; font-weight: bold;">
                        <?= $row->status == 1 ? 'Aktif' : 'Tidak Aktif'; ?>
                    </td>
                    <td style="width:10%; text-align:center;">
                        <button class="btn btn-primary btn-md btn-toggle-status" data-id="<?= $row->id_soal ?>" data-status="<?= $row->status ?>">
                            <?= $row->status == 1 ? 'Nonaktifkan' : 'Aktifkan' ?>
                        </button>
                    </td>
                    <td style="width:10%;">
                        <button class="btn btn-danger btn-md btn-hapus-soal" data-id="<?= $row->id_soal ?>">Hapus</button>
                    </td>
                </tr>
                <tr>
                    <td colspan="5">
                        <table style="width: 100%; margin-top: 10px;">
                            <thead>
                                <tr>
                                    <th style="width:10%; text-align:center;">Label</th>
                                    <th style="width:70%;">Jawaban</th>
                                    <th style="width:20%; text-align:center;">Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $jawaban = Jawaban::find()->where(['id_soal' => $row->id_soal])->all();
                                foreach ($jawaban as $i => $jwb):
                                    $label = chr(65 + $i);
                                ?>
                                    <tr>
                                        <td style="text-align:center;"><?= $label ?></td>
                                        <td><?= $jwb->jawab ?></td>
                                        <td style="text-align:center;">
                                            <?= $jwb->apa_benar === 'Y' ? '<span style="color:green; font-weight:bold;">✔ Benar</span>' : '<span style="color:red;">✘ Salah</span>' ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                <tr><td colspan="3"><hr></td></tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            <?php endforeach; ?>
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
                    form.find('input[type=radio]').prop('checked', false);
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

    $(document).on('click', '.btn-toggle-status', function(e) {
        e.preventDefault();
        var button = $(this);
        var id = button.data('id');

        $.post('$urlToggleStatus', { id: id }, function(res) {
            if (res.success) {
                $('#daftar-soal').html(res.soalHtml);
            } else {
                alert('Gagal mengubah status');
            }
        }).fail(function() {
            alert('Terjadi kesalahan saat mengubah status');
        });
    });

    $(document).on('click', '.btn-hapus-soal', function(e) {
        e.preventDefault();
        if (!confirm('Yakin ingin menghapus soal ini?')) return;

        var id = $(this).data('id');

        $.post('$urlDelete', { id: id }, function(res) {
            if (res.success) {
                $('#daftar-soal').html(res.soalHtml);
            } else {
                alert('Gagal menghapus soal');
            }
        }).fail(function() {
            alert('Terjadi kesalahan saat menghapus soal');
        });
    });
");
?>
