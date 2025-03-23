<?php
use yii\widgets\DetailView;
?>
<div class="menu-view">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'parent',
            'route',
            'order',
            'data',
            'icon',
        ],
    ]) ?>
</div>
