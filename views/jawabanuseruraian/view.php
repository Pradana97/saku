<?php
use yii\widgets\DetailView;
?>
<div class="jawabanuseruraian-view">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_jawabanuser',
            'id_uji',
            'user_id',
            'nilai',
        ],
    ]) ?>
</div>