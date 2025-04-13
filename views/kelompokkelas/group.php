<?php

use app\models\Detailkelompokkelas;
use app\models\Murid;
use kartik\select2\Select2;
use yii\helpers\{Html, ArrayHelper, Url};
use yii\widgets\ActiveForm;

$this->title = $title;
// var_dump($data);die;
$id_murid = ArrayHelper::map(\app\models\Murid::find()->all(), 'id_murid', 'nama');

?>

<head>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" />
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
</head>

<body>
    <div>
        <h4 style="font-weight: bold;text-align: center;">DATA MURID KELAS <?= $data->nama_kelompok; ?></h4>
    </div>
    <hr width="50%">
    <br>
    <div class="col-12">
        <div class="row">
            <div class="col-md-4">
                <p>TAMBAHKAN MURID BARU</p>

                <div class="detailkelompokkelas-form">
                    <?php $form = ActiveForm::begin(); ?>

                    <?= $form->field($model, 'id_murid')->widget(Select2::className(), [
                        'data' => $id_murid,
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
                    <!-- <div class="box-header with-border">
                        <h3 class="box-title">Daftar Data Group Kelas <?= $data->nama_kelompok; ?></h3>
                    </div> -->
                    <div class="box-body">
                        <table id="example" class="display table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th style="text-align: center;">NO</th>
                                    <th style="text-align: center;">NAMA</th>
                                    <th style="text-align: center;">TGL LAHIR</th>
                                    <th style="text-align: center;">KELAS</th>
                                    <th style="text-align: center;">FOTO</th>
                                    <th style="text-align: center;">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                $datamurid = Detailkelompokkelas::find()->where(['id_kelompok' => $nd])->all();
                                foreach ($datamurid as $row): ?>
                                    <tr id="row-<?= $row->id_detail ?>">
                                        <td style="text-align: center;"><?= $no++ ?></td>
                                        <td><?= $row->mur->nama ?></td>
                                        <td style="text-align: center;"><?= $row->mur->tgl_lahir ?></td>
                                        <td style="text-align: center;"><?= $row->mur->kelas0->nama_kelas ?></td>
                                        <td style="text-align: center;">
                                            <img src="<?= Url::to('@web/uploads/murid/' . $row->mur->id_murid  . $row->mur->foto) ?>" alt="" width="50">
                                        </td>
                                        <td style="text-align: center;">
                                            <button class="btn btn-danger btn-xs btn-delete"
                                                data-id="<?= $row->id_detail ?>"
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