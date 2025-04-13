<?php
use yii\widgets\DetailView;
?>
<div class="msmapel-view">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_msmapel',
            'nama',
            'status',
        ],
    ]) ?>
</div>