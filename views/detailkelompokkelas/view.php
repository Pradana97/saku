<?php
use yii\widgets\DetailView;
?>
<div class="detailkelompokkelas-view">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_detail',
            'id_kelompok',
            'id_murid',
        ],
    ]) ?>
</div>