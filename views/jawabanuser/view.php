<?php
use yii\widgets\DetailView;
?>
<div class="jawabanuser-view">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_jawabanuser',
            'id_soal',
            'id_jawaban',
            'user_id',
            'apa_benar',
        ],
    ]) ?>
</div>