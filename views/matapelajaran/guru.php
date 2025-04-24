<?php

use app\models\Gurumapel;
use kartik\select2\Select2;
use yii\helpers\{Html, ArrayHelper, Url};
use yii\widgets\ActiveForm;

$this->title = $title;
// var_dump($data);die;
$id_guru = ArrayHelper::map(\app\models\Pegawai::find()->all(), 'id_pegawai', 'nama');
?>

<head>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" />
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
</head>

<body>
    <div>
        <h4 style="font-weight: bold;text-align: center;">DATA GURU</h4>
    </div>
    <hr width="50%">
    <br>
    <div class="col-12">
        <div class="row">
            <div class="col-md-4">
                <p>TAMBAHKAN GURU</p>

                <div class="detailkelompokkelas-form">
                    <?php $form = ActiveForm::begin(); ?>

                    <?= $form->field($model, 'id_guru')->widget(Select2::className(), [
                        'data' => $id_guru,
                        'options' => ['placeholder' => 'pilih ...'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ])->label('Nama') ?>


                    <?php if (!Yii::$app->request->isAjax) { ?>
                        <div class="form-group">
                            <?= Html::submitButton($model->isNewRecord ? 'Simpan' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                            <?= Html::a('Kembali', ['index'], ['class' => 'btn btn-info']) ?>

                        </div>
                    <?php } ?>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
            <div class="col-md-8">

                <div class="box box-primary">

                    <div class="box-body">
                        <table id="example" class="display table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th style="text-align: center;">NO</th>
                                    <th style="text-align: center;">NAMA</th>
                                    <th style="text-align: center;">NIP</th>
                                    <th style="text-align: center;">FOTO</th>
                                    <th style="text-align: center;">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                $dataguru = Gurumapel::find()->where(['id_mapel' => $nd])->all();
                                foreach ($dataguru as $row): ?>
                                    <tr id="row-<?= $row->id_guru_mapel ?>">
                                        <td style="text-align: center;"><?= $no++ ?></td>
                                        <td><?= $row->guru->nama ?></td>
                                        <td style="text-align: center;"><?= $row->guru->nip ?></td>
                                        <td style="text-align: center;">
                                            <img src="<?= Url::to('@web/uploads/pegawai/' . $row->guru->id_pegawai  . $row->guru->foto) ?>" alt="" width="50">
                                        </td>
                                        <td style="text-align: center;">
                                            <button class="btn btn-danger btn-xs btn-delete"
                                                data-id="<?= $row->id_guru_mapel ?>"
                                                data-url="<?= Url::to(['delete-detail']) ?>">
                                                <i class="glyphicon glyphicon-trash"></i> Hapus
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

        </div>

    </div>
</body>

<script>
    $(document).ready(function() {
        $('#example').DataTable({
            "language": {
                "search": "Cari:",
                "lengthMenu": "Tampilkan _MENU_ data per halaman",
                "zeroRecords": "Data tidak ditemukan",
                "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                "infoEmpty": "Tidak ada data tersedia",
                "infoFiltered": "(disaring dari _MAX_ total data)"
            }
        });
    });
</script>
<?php
$this->registerJs(<<<JS

$(document).on('click', '.btn-delete', function(e) {
    e.preventDefault();
    var btn = $(this);
    var id = btn.data('id');
    var url = btn.data('url');

    if (confirm('Yakin ingin menghapus data ini?')) {
        $.ajax({
            type: 'POST',
            url: url,
            data: {id: id},
            success: function(response) {
                if (response.success) {
                    $('#row-' + id).fadeOut();
                } else {
                    alert('Gagal menghapus data');
                }
            },
            error: function() {
                alert('Terjadi kesalahan saat menghapus data');
            }
        });
    }
});
JS);
?>