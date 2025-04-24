<?php
use yii\widgets\DetailView;
?>
<div class="gurumapel-view">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_guru_mapel',
            'id_guru',
            'id_mapel',
            'status',
            'catatan',
        ],
    ]) ?>
</div>