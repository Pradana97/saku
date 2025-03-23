<?php

use yii\widgets\DetailView;
?>
<div class="ms-jurusan-view">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id_jurusan',
            'nama_jurusan',
            [
                'attribute' => 'status',
                'value' => function ($model) {
                    return $model->status == 1 ? 'Aktif' : 'Tidak Aktif';
                },
            ],
        ],
    ]) ?>
</div>