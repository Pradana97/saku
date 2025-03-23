<?php

use yii\widgets\DetailView;
?>
<div class="ms-kelas-view">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_kelas',
            'nama_kelas',
            [
                'attribute' => 'status',
                'value' => function ($model) {
                    return $model->status == 1 ? 'Aktif' : 'Tidak Aktif';
                },
            ],
        ],
    ]) ?>
</div>