<?php
use yii\widgets\DetailView;
?>
<div class="soal-view">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_soal',
            'id_uji',
            'soal:ntext',
            'type',
            'status',
        ],
    ]) ?>
</div>