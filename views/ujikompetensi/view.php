<?php
use yii\widgets\DetailView;
?>
<div class="ujikompetensi-view">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_uji',
            'id_mapel',
            'id_materi',
            'nama_ujikompetensi',
            'tanggal_dibuat',
            'keterangan:ntext',
            'status',
        ],
    ]) ?>
</div>