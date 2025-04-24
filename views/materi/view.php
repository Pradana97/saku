<?php

use yii\widgets\DetailView;
?>
<div class="materi-view">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id_materi',
            [
                'attribute' => 'id_mapel',
                'value' => function ($data) {
                    return $data->mapel->msmapel->nama;
                },
                'label' => 'Mata Pelajaran',
            ],
            'nama_materi',

            [
                'attribute' => 'created_date',
                'label' => 'Mata Tgl Upload',
            ],
            'keterangan:ntext',
            [
                'attribute' => 'dokumen',
                'format' => 'raw',
                'value' => function ($model) {
                    if ($model->dokumen) {
                        $url = Yii::getAlias('@web/uploads/materi/' . $model->id_materi . $model->dokumen); // sesuaikan path
                        return '<a href="' . $url . '" target="_blank">Lihat / Unduh Dokumen</a>';
                    }
                    return '(Tidak ada dokumen)';
                },
            ],
        ],
    ]) ?>
</div>