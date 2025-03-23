<?php

use yii\bootstrap\Html;
use yii\widgets\DetailView;
?>
<div class="pegawai-view">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-9">
                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        // 'id_pegawai',
                        'nama',
                        'nik',
                        'nip',
                        'tgl_lahir',
                        'jenis_kelamin',
                        'alamat',
                        'no_tlp',
                        'email',
                        [
                            'attribute' => 'jabatan',
                            'value' => function ($data) {
                                return $data->jabatan0->nama_jabatan;
                            },
                        ],
                    ],
                ]) ?>
            </div>
            <div class="col-md-3">
                <?= Html::img(Yii::getAlias('@web/uploads/pegawai/' . $model->id_pegawai . $model->foto), ['style' => ['width' => '200px']]) ?>
            </div>
        </div>
    </div>
</div>