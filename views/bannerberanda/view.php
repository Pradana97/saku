<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
?>
<div class="bannerberanda-view">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'keterangan:ntext',
            'foto',
            'status',
        ],
    ]) ?>
<br>
    <?= Html::img(Yii::getAlias('@web/uploads/bannerberanda/'.$model->id.$model->foto), ['style' => ['width' => '200px']]) ?>
</div>