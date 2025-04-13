<?php
use yii\widgets\DetailView;
?>
<div class="kelompokkelas-view">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_kelompok',
            'nama_kelompok',
            'status',
            'catatan',
        ],
    ]) ?>
</div>