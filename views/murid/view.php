<?php

use yii\bootstrap\Html;
use yii\widgets\DetailView;
?>
<div class="murid-view">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-9">
                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'id_murid',
                        'nama',
                        'no_induk_sekolah',
                        'no_identitas',
                        'tgl_lahir',
                        'tempat_lahir',
                        'jenis_kelamin',
                        'alamat',
                        'no_tlp_ortu',
                        [
                            'attribute' => 'kelas',
                            'value' => function ($data) {
                                return $data->kelas0->nama_kelas;
                            },
                        ],
                        [
                            'attribute' => 'jurusan',
                            'value' => function ($data) {
                                return $data->jurusan0->nama_jurusan;
                            },
                        ],
                        'tahun_masuk',
                        [
                            'attribute' => 'status',
                            'value' => function ($data) {
                                return $data->status == 1 ? 'Aktif' : 'Tidak Aktif';
                            },
                        ],
                        'nama_ortu',
                        [
                            'attribute' => 'status_beasiswa',
                            'value' => function ($data) {
                                return $data->status_beasiswa == 1 ? 'Aktif' : 'Tidak Aktif';
                            },
                        ],
                        'catatan:ntext',
                        'user_id',
                    ],
                ]) ?>
            </div>
            <div class="col-md-3">
                <?= Html::img(Yii::getAlias('@web/uploads/murid/' . $model->id_murid . $model->foto), ['style' => ['width' => '300px']]) ?>
            </div>
        </div>
    </div>
</div>