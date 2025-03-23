<?php

use yii\widgets\DetailView;
?>
<div class="ms-jabatan-view">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_jabatan',
            'nama_jabatan',
            [
                'attribute' => 'status',
                'value' => function ($model) {
                    return $model->status == 1 ? 'Aktif' : 'Tidak Aktif';
                },
            ],
        ],
    ]) ?>
</div>