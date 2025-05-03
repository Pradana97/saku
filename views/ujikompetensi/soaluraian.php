<?php

use app\models\Soal;
use yii\helpers\{Html, ArrayHelper, Url};
use yii\widgets\ActiveForm;

$this->title = 'SOAL URAIAN ' . $judul;

// URL helper untuk digunakan di JavaScript
$urlSave = Url::to(['ujikompetensi/savesoal', 'id_uji' => $nd, 'type' => 'uraian']);
$urlDelete = Url::to(['ujikompetensi/deletesoal']);
$urlEdit = Url::to(['ujikompetensi/editsoal']);
$urlToggle = Url::to(['ujikompetensi/togglestatus']);

?>

<div class="soal-form">
    <?php $form = ActiveForm::begin([
        'id' => 'form-soal',
        'action' => ['ujikompetensi/savesoal'],
        'enableClientValidation' => true,
    ]); ?>
    <hr style="margin-top: 5px;">
    <b>BUAT SOAL</b>
    <br><br>

    <?= $form->field($model, 'soal')->textarea(['rows' => 6])->label('Pertanyaan') ?>

    <?= $form->field($model, 'status')->widget(\kartik\switchinput\SwitchInput::class, [
        'pluginOptions' => [
            'onText' => 'Aktif',
            'offText' => 'Nonaktif',
            'onColor' => 'success',
            'offColor' => 'danger',
        ]
    ]) ?>

    <div class="form-group">
        <button type="button" id="btn-simpan-soal" class="btn btn-info">Simpan</button>
    </div>
    <?php ActiveForm::end(); ?>
</div>

<hr>
<p>
    <strong>NB:</strong> Untuk mengedit soal, silakan klik langsung pada bagian teks soal, kemudian ketik perubahan yang diinginkan. Setelah selesai, arahkan kursor ke bagian lain (klik di luar kolom) untuk menyimpan perubahan.
</p>
<div>
    <table border="1" style="width: 100%; border-collapse: collapse;" id="tabel-soal">
        <tbody style="background-color: white;">
            <?php
            $data = Soal::find()->where(['id_uji' => $nd])->all();
            $no = 1;
            foreach ($data as $row):
            ?>
                <tr>
                    <td style="width: 5%; text-align: center;"><?= $no++; ?></td>
                    <td class="editable-soal" data-id="<?= $row->id_soal ?>" style="padding-left: 5px; cursor: pointer;">
                        <?= Html::encode($row->soal); ?>
                    </td>
                    <td style="width: 10%; padding-left: 5px;">
                        <?= $row->status == 1 ? 'Aktif' : 'Tidak Aktif'; ?>
                    </td>
                    <td style="width: 10%; text-align: center;">
                        <a href="#"
                            class="btn btn-warning btn-sm btn-toggle-status"
                            data-id="<?= $row->id_soal ?>"
                            data-status="<?= $row->status ?>">
                            <?= $row->status == 1 ? 'Nonaktifkan' : 'Aktifkan' ?>
                        </a>
                    </td>
                    <td style="width: 10%; text-align: center;">
                        <?= Html::a(
                            'Hapus',
                            '#',
                            [
                                'class' => 'btn btn-danger btn-sm btn-hapus',
                                'data-id' => $row->id_soal,
                            ]
                        ) ?>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>

<?php
$js = <<<JS
$('#btn-simpan-soal').on('click', function(e) {
    e.preventDefault();
    var form = $('#form-soal');

    $(':input').each(function() {
        $(this).trigger('change');
    });

    $.ajax({
        url: '$urlSave',
        type: 'POST',
        data: form.serialize(),
        success: function(res) {
            if(res.success) {
                var statusText = res.status == 1 ? 'Aktif' : 'Tidak Aktif';
                var tombolAktif = '<a href="#" class="btn btn-warning btn-sm btn-toggle-status" data-id="' + res.id + '" data-status="' + res.status + '">' + (res.status == 1 ? 'Nonaktifkan' : 'Aktifkan') + '</a>';
                var tombolHapus = '<a href="#" class="btn btn-danger btn-sm btn-hapus" data-id="' + res.id + '">Hapus</a>';

                var newRow = '<tr>' +
                    '<td style="width: 5%; text-align: center;">' + res.no + '</td>' +
                    '<td class="editable-soal" data-id="' + res.id + '" style="width: 75%; padding-left: 5px; cursor: pointer;">' + res.soal + '</td>' +
                    '<td style="width: 10%; padding-left: 5px;">' + statusText + '</td>' +
                    '<td style="width: 10%; text-align: center;">' + tombolAktif + '</td>' +
                    '<td style="width: 10%; text-align: center;">' + tombolHapus + '</td>' +
                    '</tr>';
                
                $('#tabel-soal tbody').append(newRow);
                $('#soal-soal').val('');
            } else {
                alert('Gagal menyimpan');
            }
        },
        error: function() {
            alert('Terjadi kesalahan saat menyimpan.');
        }
    });
});

$(document).on('click', '.btn-hapus', function(e) {
    e.preventDefault();
    var idSoal = $(this).data('id');
    var row = $(this).closest('tr');

    if (confirm('Yakin ingin menghapus data ini?')) {
        $.ajax({
            url: '$urlDelete',
            type: 'POST',
            data: { id: idSoal },
            success: function(res) {
                if(res.success) {
                    row.remove();
                } else {
                    alert('Gagal menghapus data.');
                }
            },
            error: function() {
                alert('Terjadi kesalahan saat menghapus.');
            }
        });
    }
});

$(document).on('click', '.btn-toggle-status', function(e) {
    e.preventDefault();
    var idSoal = $(this).data('id');
    var btn = $(this);
    var row = btn.closest('tr');
    
    $.ajax({
        url: '$urlToggle',
        type: 'POST',
        data: { id: idSoal },
        success: function(res) {
            if(res.success) {
                var newStatus = res.status == 1 ? 'Aktif' : 'Tidak Aktif';
                var newText = res.status == 1 ? 'Nonaktifkan' : 'Aktifkan';
                btn.text(newText);
                row.find('td').eq(2).text(newStatus);
                btn.data('status', res.status);
            } else {
                alert('Gagal mengubah status');
            }
        },
        error: function() {
            alert('Terjadi kesalahan');
        }
    });
});

$(document).on('click', '.editable-soal', function() {
    var cell = $(this);
    var id = cell.data('id');
    var currentText = cell.text().trim();

    // Cegah double input
    if (cell.find('textarea').length > 0) return;

    var textarea = $('<textarea class="form-control" rows="3">').val(currentText);
    cell.html(textarea);
    textarea.focus();

    textarea.on('blur', function() {
        var newText = textarea.val().trim();

        if (newText === currentText || newText === '') {
            cell.text(currentText);
            return;
        }

        $.ajax({
            url: '$urlEdit',
            type: 'POST',
            data: {
                id: id,
                soal: newText
            },
            success: function(res) {
                if (res.success) {
                    cell.text(newText);
                } else {
                    alert('Gagal update soal');
                    cell.text(currentText);
                }
            },
            error: function() {
                alert('Terjadi kesalahan');
                cell.text(currentText);
            }
        });
    });
});
JS;

$this->registerJs($js);
?>