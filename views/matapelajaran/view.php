<?php
use yii\widgets\DetailView;
?>
<div class="matapelajaran-view">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_mapel',
            'id_msmapel',
            'status',
            'catatan',
            'id_kelompok',
        ],
    ]) ?>
</div>